<?php

namespace App\Controllers;

use App\Adapters\GoogleBooksAdapter;
use App\Adapters\MySQLLocalAdapter;
use App\Models\Libro;
use App\Services\UnificationService;
use App\Services\GoogleAuth;
use App\Services\ApiExternaService;

class SearchController
{
    private MySQLLocalAdapter $localAdapter;
    
    public function __construct(
        private UnificationService $unificationService,
        private GoogleBooksAdapter $googleBooksAdapter,
        ?MySQLLocalAdapter $localAdapter = null
    ) {
        $this->localAdapter = $localAdapter ?? new MySQLLocalAdapter();
    }

    // ==================== VISTAS PRINCIPALES ====================
    
    public function index(): void
    {
        $apiService = new ApiExternaService();
        $scopusDestacados = [];
        $scienceDirectDestacados = [];
        $resultadosAcademicosPorCategoria = [];

        if (empty($_GET['q'])) {
            // ==================== APIs (Scopus) ====================
            $scopusDestacados = $apiService->buscarEnScopus('"computer science" OR "artificial intelligence"', 20);
            $scienceDirectDestacados = $apiService->buscarEnScienceDirect('engineering', 20);

            // Categorías académicas de Scopus
            $categoriasAcademicas = [
                'Inteligencia Artificial' => 'artificial intelligence',
                'Machine Learning' => 'machine learning',
                'Medicina' => 'medicine',
                'Biología' => 'biology',
                'Biografía' => 'biography',
                'Ciencia ficción' => '"science fiction"',
                'Novelas' => 'fiction',
                'Filosofía' => 'philosophy'
            ];

            foreach ($categoriasAcademicas as $nombreCat => $terminoCat) {
                $resultadosScopus = $apiService->buscarEnScopus($terminoCat, 10);
                $resultadosScienceDirect = $apiService->buscarEnScienceDirect($terminoCat, 10);

                $mezclaCat = [];

                if (is_array($resultadosScopus) && !isset($resultadosScopus['error'])) {
                    $mezclaCat = array_merge($mezclaCat, $resultadosScopus);
                }

                if (is_array($resultadosScienceDirect) && !isset($resultadosScienceDirect['error'])) {
                    $mezclaCat = array_merge($mezclaCat, $resultadosScienceDirect);
                }

                $resultadosAcademicosPorCategoria[$nombreCat] = [
                    'articulos' => $mezclaCat,
                    'termino' => $terminoCat
                ];
            }
        }

        require __DIR__ . '/../../src/Views/search/index.php';
    }


    public function details($id): void
    {
        $libroObj = $this->googleBooksAdapter->buscarPorVolumeId($id);
        
        if (!$libroObj) {
            $libroObj = $this->googleBooksAdapter->buscarPorIsbn($id);
        }
        
        if (!$libroObj) {
            header('Location: /nexuslib/index.php');
            exit;
        }
        
        $bookKey = 'google:' . ($libroObj->google_id ?: $libroObj->isbn);
        $this->localAdapter->incrementBookViews($bookKey, 'google');
        $statsData = $this->localAdapter->getBookStatsWithComments($bookKey);
        
        require __DIR__ . '/../../src/Views/search/details.php';
    }

    public function detallesAcademico(string $id = ''): void
    {
        $doi = trim($id ?: ($_GET['id'] ?? ''));

        if ($doi === '') {
            header('Location: /nexuslib/index.php?action=academicos');
            exit;
        }

        $apiService = new ApiExternaService();
        $detalleAcademico = $apiService->obtenerDetallePorDoi($doi);

        if (isset($detalleAcademico['error'])) {
            $errorApi = $detalleAcademico['error'];
        }

        require __DIR__ . '/../../src/Views/search/details_academico.php';
    }
    
    public function category(): void
    {
        $nombreCategoria = $_GET['name'] ?? 'Biografía';
        $page = (int) ($_GET['page'] ?? 1);
        $isAjax = ($_GET['ajax'] ?? 0) == 1;
        
        // Obtener libros de Google Books por categoría
        $terminoGoogle = '';
        $mapaCategorias = [
            'Biografía' => 'biography',
            'Ciencia ficción' => 'science fiction',
            'Novelas' => 'fiction',
            'Poesía' => 'poetry',
            'Historia' => 'history',
            'Filosofía' => 'philosophy'
        ];
        $terminoGoogle = $mapaCategorias[$nombreCategoria] ?? $nombreCategoria;
        
        $librosGoogle = $this->googleBooksAdapter->buscarGeneral('subject:"' . $terminoGoogle . '"', 20);
        
        if ($isAjax) {
            header('Content-Type: text/html');
            foreach ($librosGoogle as $libro) {
                $this->renderBookCard($libro, $nombreCategoria);
            }
            return;
        }
        
        $librosRelacionados = array_map(function($libro) {
            return ['libro' => $libro, 'inventario' => null];
        }, $librosGoogle);
        
        require __DIR__ . '/../../src/Views/search/category.php';
    }
    
    // ==================== AUTENTICACIÓN ====================
    
    public function handleLogin(): void
    {
        $auth = new GoogleAuth($this->localAdapter);
        header('Location: ' . $auth->getLoginUrl());
        exit;
    }
    
    public function handleAuthCallback(): void
    {
        $code = $_GET['code'] ?? '';
        if (empty($code)) {
            header('Location: /nexuslib/index.php?error=auth_failed');
            exit;
        }
        
        $auth = new GoogleAuth($this->localAdapter);
        $user = $auth->authenticate($code);
        
        if ($user) {
            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $user['id_usuario'];
            header('Location: /nexuslib/index.php');
        } else {
            header('Location: /nexuslib/index.php?error=auth_failed');
        }
        exit;
    }
    
    public function handleLogout(): void
    {
        session_destroy();
        header('Location: /nexuslib/index.php');
        exit;
    }
    
    // ==================== WATCHLIST ====================
    
    public function handleAddWatchlist(): void
    {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            echo json_encode(['error' => 'No autenticado']);
            exit;
        }
        
        $input = json_decode(file_get_contents('php://input'), true);
        $bookKey = trim((string) ($input['book_key'] ?? ''));
        $source = trim((string) ($input['source'] ?? 'academic'));

        if ($bookKey === '' || str_starts_with(strtolower($bookKey), 'local:') || !$this->esIdentificadorAcademico($bookKey)) {
            http_response_code(422);
            echo json_encode(['error' => 'Solo se permite guardar artículos académicos (DOI/EID).']);
            exit;
        }

        if (!in_array($source, ['academic', 'scopus', 'sciencedirect'], true)) {
            $source = 'academic';
        }

        $this->localAdapter->addWatchlistItem(
            $_SESSION['user_id'],
            $bookKey,
            $source,
            $input['titulo'] ?? '',
            $input['autor'] ?? ''
        );
        
        echo json_encode(['success' => true]);
        exit;
    }
    
    public function handleRemoveWatchlist(): void
    {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            echo json_encode(['error' => 'No autenticado']);
            exit;
        }
        
        $input = json_decode(file_get_contents('php://input'), true);
        $this->localAdapter->removeWatchlistItem($_SESSION['user_id'], $input['book_key'] ?? '');
        
        echo json_encode(['success' => true]);
        exit;
    }
    
    public function handleWatchlist(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /nexuslib/index.php');
            exit;
        }
        
        $watchlist = $this->localAdapter->getWatchlistByUser($_SESSION['user_id']);
        require __DIR__ . '/../../src/Views/search/watchlist.php';
    }
    
    // ==================== COMENTARIOS Y CALIFICACIONES ====================
    
    public function handleAddComment(): void
    {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            echo json_encode(['error' => 'No autenticado']);
            exit;
        }
        
        $input = json_decode(file_get_contents('php://input'), true);
        $this->localAdapter->addComment(
            $_SESSION['user_id'],
            $input['book_key'] ?? '',
            $input['source'] ?? '',
            (int) ($input['rating'] ?? 0),
            $input['comentario'] ?? ''
        );
        
        echo json_encode(['success' => true]);
        exit;
    }
    
    public function handleGetBookStats(): void
    {
        $bookKey = $_GET['book_key'] ?? '';
        $data = $this->localAdapter->getBookStatsWithComments($bookKey);
        echo json_encode($data);
        exit;
    }
    
    // ==================== APIS EXTERNAS ====================
    
    public function handleSearchExternalApis(): void
    {
        $query = $_GET['q'] ?? '';
        $apiService = new ApiExternaService();
        $resultados = $apiService->busquedaUnificada($query, 20);
        echo json_encode($resultados);
        exit;
    }
    
    // ==================== BÚSQUEDA ACADÉMICA ====================
    
    public function buscarAcademicos(string $termino = ''): void
    {
        $termino = trim($termino ?: ($_GET['q'] ?? ''));
        $fuenteSeleccionada = $_GET['source'] ?? 'all';
        $pagina = max(1, (int) ($_GET['page'] ?? 1));
        $esAjax = (int) ($_GET['ajax'] ?? 0) === 1;
        $resultadosAcademicos = [];
        $errorApi = null;

        if (!empty($termino)) {
            $apiService = new ApiExternaService();

            if ($fuenteSeleccionada === 'scopus') {
                $start = ($pagina - 1) * 20;
                $resultadosAcademicos = $apiService->buscarEnScopus($termino, 20, $start);
            } elseif ($fuenteSeleccionada === 'sciencedirect') {
                $start = ($pagina - 1) * 20;
                $resultadosAcademicos = $apiService->buscarEnScienceDirect($termino, 20, $start);
            } else {
                $resultadosAcademicos = $apiService->busquedaUnificada($termino, 20, $pagina);
            }

            if (isset($resultadosAcademicos['error'])) {
                $errorApi = $resultadosAcademicos['error'];
                $resultadosAcademicos = [];
            }

            $resultadosAcademicos = $this->deduplicarResultadosAcademicos($resultadosAcademicos);

            if ($esAjax) {
                header('Content-Type: text/html; charset=UTF-8');
                $this->renderAcademicCards($resultadosAcademicos);
                exit;
            }
        }

        require __DIR__ . '/../../src/Views/search/academicos.php';
    }

    private function deduplicarResultadosAcademicos(array $resultados): array
    {
        $vistos = [];
        $filtrados = [];

        foreach ($resultados as $item) {
            if (!is_array($item)) {
                continue;
            }

            $doi = strtolower(trim((string) ($item['doi'] ?? '')));
            $eid = strtolower(trim((string) ($item['eid'] ?? '')));
            $clave = $doi !== '' ? 'doi:' . $doi : ($eid !== '' ? 'eid:' . $eid : null);

            if ($clave === null || isset($vistos[$clave])) {
                continue;
            }

            $vistos[$clave] = true;
            $filtrados[] = $item;
        }

        return $filtrados;
    }

    private function renderAcademicCards(array $resultadosAcademicos): void
    {
        foreach ($resultadosAcademicos as $item) {
            if (!is_array($item)) {
                continue;
            }

            include __DIR__ . '/../../src/Views/layouts/card_libro.php';
        }
    }

    private function esIdentificadorAcademico(string $valor): bool
    {
        return (bool) preg_match('/^(10\.\d{4,9}\/\S+|2-s2\.0-|SCOPUS:)/i', trim($valor));
    }
    
    // ==================== MÉTODOS AUXILIARES ====================
    
    public function liveSearch(): void
    {
        $query = trim($_GET['q'] ?? '');
        echo json_encode(['autores' => [], 'libros' => []]);
        exit;
    }
    
    public function searchMore(): void
    {
        $q = $_GET['q'] ?? '';
        $type = $_GET['type'] ?? 'title';
        $page = (int) ($_GET['page'] ?? 1);
        $isAjax = ($_GET['ajax'] ?? 0) == 1;
        $limit = 20;
        $startIndex = ($page - 1) * $limit;
        
        if ($type === 'author') {
            $resultados = $this->unificationService->buscarPorAutor($q, $limit, $startIndex);
        } else {
            $resultados = $this->unificationService->buscarPorTitulo($q, $limit, $startIndex);
        }
        
        if ($isAjax) {
            header('Content-Type: text/html');
            foreach ($resultados as $item) {
                if (isset($item['libro']) && $item['libro'] instanceof Libro) {
                    $this->renderBookCard($item['libro'], $item['libro']->categoria ?? 'General');
                }
            }
            return;
        }
        
        require __DIR__ . '/../../src/Views/search/search_grid.php';
    }
    
    private function renderBookCard(Libro $libro, string $categoria): void
    {
        $linkId = (string) ($libro->google_id ?: $libro->isbn);
        $linkAction = 'details';
        $badgeClass = 'badge-digital';
        $badgeText = 'Digital';
        ?>
        <a href="/nexuslib/index.php?action=<?= $linkAction ?>&id=<?= urlencode($linkId) ?>" class="book-card-link">
            <div class="book-card">
                <div class="book-cover">
                    <span class="badge-status <?= $badgeClass ?>"><?= $badgeText ?></span>
                    <?php if ($libro->portada_url): ?>
                        <img src="<?= htmlspecialchars($libro->portada_url) ?>">
                    <?php else: ?>
                        <div class="no-cover">📖</div>
                    <?php endif; ?>
                </div>
                <div class="book-card-body">
                    <span class="book-author"><?= htmlspecialchars(substr($libro->autor, 0, 30)) ?></span>
                    <span class="book-cat-label"><?= htmlspecialchars($categoria) ?></span>
                </div>
            </div>
        </a>
        <?php
    }
}
