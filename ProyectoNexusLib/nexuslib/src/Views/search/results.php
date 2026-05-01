<?php
use App\Models\Libro;

include __DIR__ . '/../layouts/header.php';

$resultadosAutores = $resultadosAutores ?? [];
$resultadosTitulos = $resultadosTitulos ?? [];
$query = trim((string) ($_GET['q'] ?? ''));
?>

<div class="container-fluid px-4">
    <div class="welcome-section text-center py-4">
        <h2 class="fw-bold text-white">Resultados de búsqueda</h2>
        <p class="text-secondary">Búsqueda: <span class="text-cyan fw-bold"><?= htmlspecialchars($query) ?></span></p>
    </div>

    <!-- Sección Autores -->
    <div class="category-section">
        <div class="category-header">
            <div class="d-flex align-items-center">
                <i class="bi bi-person-badge text-cyan fs-5 me-2"></i>
                <h3 class="category-title"><?= htmlspecialchars($query) ?> en nombres de autores</h3>
            </div>
            <a href="index.php?action=search-more&q=<?= urlencode($query) ?>&type=author" class="text-secondary small text-decoration-none">
                Ver más <i class="bi bi-caret-right-fill"></i>
            </a>
        </div>

        <?php if (empty($resultadosAutores)): ?>
            <div class="alert alert-dark border-secondary text-secondary mx-3 my-3">
                <i class="bi bi-info-circle me-2"></i>
                No se encontraron autores para esta búsqueda
            </div>
        <?php else: ?>
            <button class="prev"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="next"><i class="fa-solid fa-chevron-right"></i></button>
            <div class="books-scroll">
                <?php foreach ($resultadosAutores as $item):
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
                                <span class="book-cat-label d-block w-100 text-truncate" title="<?= htmlspecialchars($libro->categoria ?? 'General') ?>"><?= htmlspecialchars($libro->categoria ?? 'General') ?></span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Sección Títulos -->
    <div class="category-section">
        <div class="category-header">
            <div class="d-flex align-items-center">
                <i class="bi bi-book text-cyan fs-5 me-2"></i>
                <h3 class="category-title"><?= htmlspecialchars($query) ?> en títulos de libros</h3>
            </div>
            <a href="index.php?action=search-more&q=<?= urlencode($query) ?>&type=title" class="text-secondary small text-decoration-none">
                Ver más <i class="bi bi-caret-right-fill"></i>
            </a>
        </div>

        <?php if (empty($resultadosTitulos)): ?>
            <div class="alert alert-dark border-secondary text-secondary mx-3 my-3">
                <i class="bi bi-info-circle me-2"></i>
                No se encontraron títulos para esta búsqueda
            </div>
        <?php else: ?>
            <button class="prev"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="next"><i class="fa-solid fa-chevron-right"></i></button>
            <div class="books-scroll">
                <?php foreach ($resultadosTitulos as $item):
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
                                    <span class="book-cat-label d-block w-100 text-truncate" title="<?= htmlspecialchars($libro->categoria ?? 'General') ?>"><?= htmlspecialchars($libro->categoria ?? 'General') ?></span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

