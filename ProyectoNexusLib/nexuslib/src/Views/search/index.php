<?php
use App\Models\Inventario;
use App\Models\Libro;

include __DIR__ . '/../layouts/header.php'; 

$esBusqueda = isset($_GET['q']) && trim($_GET['q']) !== '';
$modoFisico = (isset($_SESSION['biblioteca_modo']) && $_SESSION['biblioteca_modo'] === 'fisico');
?>

<div class="container-fluid px-4">
    <?php if ($esBusqueda): ?>
        <div class="row mb-4">
            <div class="col-12 border-bottom border-secondary pb-3">
                <h4 class="text-secondary fw-light">
                    Resultados para: <span class="text-white fw-bold">"<?= htmlspecialchars($_GET['q']) ?>"</span>
                    <small class="ms-2 badge bg-dark border border-secondary text-secondary">
                        <?= count($resultados) ?> encontrados
                    </small>
                </h4>
            </div>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-dark border-danger text-danger shadow-lg">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-4">
            <?php foreach ($resultados as $item): 
                $libro = $item['libro'] ?? null;
                $inventario = $item['inventario'] ?? null;
                if (!($libro instanceof Libro)) continue;
            ?>
                <div class="col">
                    <?php $linkId = !empty($libro->isbn) ? $libro->isbn : ($libro->id_libro ?? ''); ?>
                    <a href="index.php?action=details&id=<?= urlencode($linkId) ?>" class="text-decoration-none text-reset d-block book-card-link">
                        <div class="book-card">
                        <div class="position-relative">
                            <?php if ($inventario instanceof Inventario): ?>
                                <span class="badge-status badge-local">Físico</span>
                            <?php else: ?>
                                <span class="badge-status badge-digital">Digital</span>
                            <?php endif; ?>

                            <div class="book-cover">
                                <?php if ($libro->portada_url): ?>
                                    <img src="<?= $libro->portada_url ?>" alt="<?= htmlspecialchars($libro->titulo) ?>">
                                <?php else: ?>
                                    <div class="no-cover d-flex align-items-center justify-content-center bg-dark h-100 w-100">
                                        <i class="bi bi-book text-secondary fs-1"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="book-card-body">
                            <span class="book-author d-block w-100 text-truncate" title="<?= htmlspecialchars($libro->autor) ?>">
                                <?= htmlspecialchars($libro->autor) ?>
                            </span>
                            <span class="book-cat-label d-block w-100 text-truncate" title="<?= htmlspecialchars($libro->categoria ?? 'General') ?>">
                                <?= htmlspecialchars($libro->categoria ?? 'General') ?>
                            </span>
                        </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <div class="welcome-section text-center py-5">
            <h1 class="display-4 fw-bold">Nexus<span class="text-cyan">Lib</span></h1>
            <p class="text-secondary fs-5">Explora el conocimiento unificado de la Facultad de Ingeniería</p>
        </div>

        <?php
        $iconosCategorias = [
            'Biografía' => 'bi-person-badge',
            'Ciencia ficción' => 'bi-rocket-takeoff',
            'Cuentos' => 'bi-stars',
            'Diccionarios' => 'bi-translate',
            'Ensayos' => 'bi-feather',
            'Filosofía' => 'bi-lightbulb',
            'Historia' => 'bi-bank',
            'Novelas' => 'bi-book',
            'Poesía' => 'bi-chat-heart',
        ];

        foreach (($datosHome ?? []) as $nombreCat => $librosCategoria):
            $icono = $iconosCategorias[$nombreCat] ?? 'bi-collection';
        ?>
            <div class="category-section">
                <div class="category-header">
                    <div class="d-flex align-items-center">
                        <i class="bi <?= $icono ?> text-cyan fs-5 me-2"></i>
                        <h3 class="category-title"><?= $nombreCat ?></h3>
                    </div>
                    <a href="index.php?action=category&name=<?= urlencode($nombreCat) ?>" class="text-secondary small text-decoration-none">
                        Ver más <i class="bi bi-caret-right-fill"></i>
                    </a>
                </div>
                
                <button class="prev"><i class="fa-solid fa-chevron-left"></i></button>
                <button class="next"><i class="fa-solid fa-chevron-right"></i></button>
                <div class="books-scroll">
                    <?php if (empty($librosCategoria)): ?>
                        <div class="book-card">
                            <div class="book-cover d-flex align-items-center justify-content-center bg-dark h-100 w-100">
                                <i class="bi bi-journal-x text-secondary fs-1"></i>
                            </div>
                            <div class="book-card-body">
                                <span class="book-author">Sin resultados</span>
                                <span class="book-cat-label"><?= htmlspecialchars($nombreCat) ?></span>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($librosCategoria as $item):
                            $libro = $item['libro'] ?? null;
                            if (!($libro instanceof Libro)) {
                                continue;
                            }
                            $linkId = !empty($libro->isbn) ? $libro->isbn : ($libro->id_libro ?? '');
                        ?>
                            <a href="index.php?action=details&id=<?= urlencode($linkId) ?>" class="text-decoration-none text-reset d-block book-card-link">
                                <div class="book-card">
                                    <div class="book-cover">
                                        <?php if (!empty($libro->portada_url)): ?>
                                            <img src="<?= htmlspecialchars($libro->portada_url) ?>" alt="<?= htmlspecialchars($libro->titulo ?? '') ?>">
                                        <?php else: ?>
                                            <div class="no-cover d-flex align-items-center justify-content-center bg-dark h-100 w-100">
                                                <i class="bi bi-book text-secondary fs-1"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="book-card-body">
                                        <span class="book-author d-block w-100 text-truncate" title="<?= htmlspecialchars($libro->autor) ?>"><?= htmlspecialchars($libro->autor) ?></span>
                                        <span class="book-cat-label d-block w-100 text-truncate" title="<?= htmlspecialchars($nombreCat) ?>"><?= htmlspecialchars($nombreCat) ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>