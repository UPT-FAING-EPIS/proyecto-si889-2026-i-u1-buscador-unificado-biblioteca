<?php

namespace App\Controllers;

use App\Adapters\GoogleBooksAdapter;
use App\Adapters\MySQLLocalAdapter;
use App\Models\Libro;
use App\Services\UnificationService;

class SearchController
{
    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $action = (string) ($_GET['action'] ?? '');

        if ($action === 'set-mode') {
            $modo = (string) ($_POST['mode'] ?? $_GET['mode'] ?? 'virtual');

            if (in_array($modo, ['fisico', 'virtual'], true)) {
                $_SESSION['biblioteca_modo'] = $modo;
            }

            exit;
        }

        $modoActual = $_SESSION['biblioteca_modo'] ?? 'virtual';

        $origen = ($modoActual === 'fisico') ? 'local' : 'todos';

        if ($action === 'live-search') {
            $this->handleLiveSearch($modoActual);
            return;
        }

        if ($action === 'category') {
            $this->category($modoActual);
            return;
        }

        if ($action === 'search') {
            $this->search($modoActual);
            return;
        }

        if ($action === 'search-more') {
            $this->searchMore($modoActual);
            return;
        }

        if ($action === 'details') {
            $id = trim((string) ($_GET['id'] ?? $_GET['q'] ?? ''));
            if ($id === '') {
                header('HTTP/1.1 400 Bad Request');
                echo 'ID de libro requerido';
                return;
            }

            $service = $this->getUnificationService($modoActual);
            $libro = $service->getBookById($id);

            if ($libro instanceof Libro) {
                $libro = $this->aplicarFallbackOpenLibrary($libro);
            }

            require __DIR__ . "/../../src/Views/search/details.php";
            return;
        }

        $esVistaDetalles = $action === 'details';
        $resultados = [];
        $datosHome = [];
        $resultado = null;
        $termino = trim((string) ($_GET['q'] ?? ''));
        $esBusqueda = isset($_GET['q']) && $termino !== '';
        $origen = ($modoActual === 'fisico') ? 'local' : 'todos';
        $orden = trim((string) ($_GET['orden'] ?? 'relevancia'));
        $soloDisponibles = isset($_GET['disponible']) || isset($_GET['solo_disponibles']);
        $error = null;
        $service = $this->getUnificationService($modoActual);

        if ($esBusqueda) {
            $filtros = [
                'origen' => $origen,
                'orden' => $orden,
                'solo_disponibles' => $soloDisponibles,
            ];

            $resultados = $service->busquedaInteligente($termino, $filtros);

            if ($esVistaDetalles && isset($resultados[0])) {
                $resultado = $resultados[0];
            }

            if (empty($resultados)) {
                $error = 'No se encontró información para el término proporcionado.';
            }
        } else {
            $limiteHome = 20;
            $categoriasPrincipales = [
                'Biografía' => 'biography',
                'Ciencia ficción' => 'science fiction',
                'Cuentos' => 'short stories',
                'Diccionarios' => 'dictionaries',
                'Ensayos' => 'essays',
                'Filosofía' => 'philosophy',
                'Historia' => 'history',
                'Novelas' => 'novel',
                'Poesía' => 'poetry',
            ];

            foreach ($categoriasPrincipales as $categoria => $categoriaEnIngles) {
                $terminoCategoria = $modoActual === 'virtual'
                    ? 'subject:"' . $categoriaEnIngles . '"'
                    : $categoria;

                $datosHome[$categoria] = $service->busquedaInteligente(
                    $terminoCategoria,
                    [
                        'origen' => $origen,
                        'limit' => $limiteHome,
                    ]
                );
            }
        }

        $view = $esVistaDetalles ? 'details/index.php' : 'search/index.php';
        require __DIR__ . "/../../src/Views/$view";
    }

    public function category(?string $modoActual = null): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $modoActual ??= $_SESSION['biblioteca_modo'] ?? 'virtual';

        $page = max(1, (int) ($_GET['page'] ?? 1));
        $perPage = 20;
        $startIndex = ($page - 1) * $perPage;

        $nombreCategoria = trim((string) ($_GET['name'] ?? ''));
        if ($nombreCategoria === '') {
            $nombreCategoria = 'Biografía';
        }

        $mapeoCategorias = [
            'Biografía' => 'Biography',
            'Ciencia ficción' => 'Science Fiction',
            'Cuentos' => 'Short Stories',
            'Diccionarios' => 'Dictionaries',
            'Ensayos' => 'Essays',
            'Filosofía' => 'Philosophy',
            'Historia' => 'History',
            'Novelas' => 'Novels',
            'Poesia' => 'Poetry',
        ];

        $terminoIngles = $mapeoCategorias[$nombreCategoria] ?? $nombreCategoria;

        $service = $this->getUnificationService($modoActual);
        $librosRelacionados = $service->buscarPorCategoria($terminoIngles, $perPage, $startIndex);

        $isAjax = (int) ($_GET['ajax'] ?? 0) === 1;

        if ($isAjax) {
            header('Content-Type: text/html; charset=utf-8');

            foreach ($librosRelacionados as $item) {
                $libro = $item['libro'] ?? null;
                if (!($libro instanceof \App\Models\Libro)) {
                    continue;
                }

                $linkId = !empty($libro->isbn) ? $libro->isbn : ($libro->id_libro ?? '');
                $titulo = htmlspecialchars($libro->titulo ?? '', ENT_QUOTES, 'UTF-8');
                $autor = htmlspecialchars($libro->autor ?? '', ENT_QUOTES, 'UTF-8');
                $portada = htmlspecialchars($libro->portada_url ?? '', ENT_QUOTES, 'UTF-8');
                $catEsc = urlencode($nombreCategoria);

                echo '<a href="index.php?action=details&id=' . urlencode($linkId) . '" class="text-decoration-none text-reset d-block book-card-link">';
                echo '<div class="book-card">';
                echo '<div class="book-cover">';
                if (!empty($portada)) {
                    echo '<img src="' . $portada . '" alt="' . $titulo . '">';
                } else {
                    echo '<div class="no-cover d-flex align-items-center justify-content-center bg-dark h-100 w-100">';
                    echo '<i class="bi bi-book text-secondary fs-1"></i>';
                    echo '</div>';
                }
                echo '</div>';
                echo '<div class="book-card-body">';
                echo '<span class="book-author d-block w-100 text-truncate" title="' . $autor . '">' . $autor . '</span>';
                echo '<span class="book-cat-label d-block w-100 text-truncate" title="' . htmlspecialchars($nombreCategoria, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($nombreCategoria, ENT_QUOTES, 'UTF-8') . '</span>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
            }

            return;
        }

        require __DIR__ . "/../../src/Views/search/category.php";
    }

    public function search(?string $modoActual = null): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $modoActual ??= $_SESSION['biblioteca_modo'] ?? 'virtual';

        $query = trim((string) ($_GET['q'] ?? ''));
        if ($query === '') {
            $resultadosAutores = [];
            $resultadosTitulos = [];
        } else {
            $service = $this->getUnificationService($modoActual);
            $resultadosAutores = $service->buscarPorAutor($query, 20);
            $resultadosTitulos = $service->buscarPorTitulo($query, 20);
        }

        require __DIR__ . "/../../src/Views/search/results.php";
    }

    public function searchMore(?string $modoActual = null): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $modoActual ??= $_SESSION['biblioteca_modo'] ?? 'virtual';

        $q = trim((string) ($_GET['q'] ?? ''));
        $type = trim((string) ($_GET['type'] ?? 'title'));
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $perPage = 20;
        $startIndex = ($page - 1) * $perPage;
        $isAjax = (int) ($_GET['ajax'] ?? 0) === 1;

        $service = $this->getUnificationService($modoActual);
        
        if ($type === 'author') {
            $resultados = $service->buscarPorAutor($q, $perPage, $startIndex);
        } elseif ($type === 'title') {
            $resultados = $service->buscarPorTitulo($q, $perPage, $startIndex);
        } else {
            $resultados = [];
        }

        if ($isAjax) {
            header('Content-Type: text/html; charset=utf-8');

            foreach ($resultados as $item) {
                $libro = $item['libro'] ?? null;
                if (!($libro instanceof \App\Models\Libro)) {
                    continue;
                }

                $linkId = !empty($libro->isbn) ? $libro->isbn : ($libro->id_libro ?? '');
                $titulo = htmlspecialchars($libro->titulo ?? '', ENT_QUOTES, 'UTF-8');
                $autor = htmlspecialchars($libro->autor ?? '', ENT_QUOTES, 'UTF-8');
                $portada = htmlspecialchars($libro->portada_url ?? '', ENT_QUOTES, 'UTF-8');
                $categoria = htmlspecialchars($libro->categoria ?? 'General', ENT_QUOTES, 'UTF-8');

                echo '<a href="index.php?action=details&id=' . urlencode($linkId) . '" class="text-decoration-none text-reset d-block book-card-link">';
                echo '<div class="book-card">';
                echo '<div class="book-cover">';
                if (!empty($portada)) {
                    echo '<img src="' . $portada . '" alt="' . $titulo . '">';
                } else {
                    echo '<div class="no-cover d-flex align-items-center justify-content-center bg-dark h-100 w-100">';
                    echo '<i class="bi bi-book text-secondary fs-1"></i>';
                    echo '</div>';
                }
                echo '</div>';
                echo '<div class="book-card-body">';
                echo '<span class="book-author d-block w-100 text-truncate" title="' . $autor . '">' . $autor . '</span>';
                echo '<span class="book-cat-label d-block w-100 text-truncate" title="' . $categoria . '">' . $categoria . '</span>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
            }

            return;
        }

        require __DIR__ . "/../../src/Views/search/search_grid.php";
    }

    private function handleLiveSearch(string $modo): void
    {
        $query = trim((string) ($_GET['q'] ?? ''));
        if ($query === '') {
            echo json_encode(['autores' => [], 'libros' => []]);
            exit;
        }

        $service = $this->getUnificationService($modo);
        $resultados = $service->busquedaInteligente($query, ['origen' => ($modo === 'fisico' ? 'local' : 'todos')]);

        $autores = [];
        $libros = [];

        foreach ($resultados as $res) {
            $libros[] = [
                'id' => $res->getIsbn(),
                'titulo' => $res->getTitulo()
            ];
            
            if (!in_array($res->getAutor(), array_column($autores, 'nombre'))) {
                $autores[] = ['nombre' => $res->getAutor()];
            }
        }

        header('Content-Type: application/json');
        echo json_encode([
            'autores' => array_slice($autores, 0, 3),
            'libros' => array_slice($libros, 0, 5)
        ]);
        exit;
    }

    private function getUnificationService(string $modo): UnificationService
    {
        $localAdapter = new MySQLLocalAdapter();
        $googleAdapter = new GoogleBooksAdapter();

        return new UnificationService($localAdapter, $googleAdapter);
    }

    private function aplicarFallbackOpenLibrary(Libro $libro): Libro
    {
        if ($libro->embeddable) {
            return $libro;
        }

        $isbn = trim((string) $libro->isbn);
        if ($isbn === '') {
            return $libro;
        }

        $previewInfo = $this->consultarOpenLibraryViewApi($isbn);
        if ($previewInfo === null) {
            return $libro;
        }

        $preview = strtolower((string) ($previewInfo['preview'] ?? ''));
        if (!in_array($preview, ['full', 'borrow'], true)) {
            return $libro;
        }

        return new Libro(
            id_libro: $libro->id_libro,
            titulo: $libro->titulo,
            autor: $libro->autor,
            isbn: $libro->isbn,
            categoria: $libro->categoria,
            digital_link: $libro->digital_link,
            portada_url: $libro->portada_url,
            descripcion: $libro->descripcion,
            num_paginas: $libro->num_paginas,
            categorias: $libro->categorias,
            embeddable: true,
            fuente_lectura: 'openlibrary',
            openlibrary_olid: $this->extraerOpenLibraryOlid($previewInfo)
        );
    }

    private function consultarOpenLibraryViewApi(string $isbn): ?array
    {
        $url = 'https://openlibrary.org/api/books?bibkeys=ISBN:' . urlencode($isbn) . '&format=json&jscmd=viewapi';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false || $response === '') {
            return null;
        }

        $data = json_decode($response, true);
        if (!is_array($data)) {
            return null;
        }

        return $data['ISBN:' . $isbn] ?? null;
    }

    private function extraerOpenLibraryOlid(array $previewInfo): ?string
    {
        foreach (['info_url', 'preview_url'] as $field) {
            $url = (string) ($previewInfo[$field] ?? '');
            if ($url === '') {
                continue;
            }

            if (preg_match('~/books/(OL[0-9A-Z]+[A-Z0-9]*)/~i', $url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }
}