<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="text-center py-5">
    <h1 class="display-4 fw-bold">Nexus<span class="text-cyan">Lib</span></h1>
    <p class="text-secondary">Explora artículos académicos en Scopus y ScienceDirect</p>
</div>

<!-- ==================== SECCIÓN: ARTÍCULOS DESTACADOS DE SCOPUS ==================== -->
<?php if (!empty($scopusDestacados) && !isset($scopusDestacados['error']) && is_array($scopusDestacados)): ?>
<div class="category-section mt-4">
    <div class="category-header">
        <h3 class="category-title">🎓 Artículos destacados (Scopus)</h3>
        <a href="/nexuslib/index.php?action=academicos&q=<?= urlencode('"computer science" OR "artificial intelligence"') ?>&mode=category&source=scopus" class="text-cyan ver-mas-link">Ver más →</a>
    </div>
    <div class="carousel-wrapper">
        <button class="arrow prev" type="button"><i class="bi bi-chevron-left"></i></button>
        <div class="books-scroll">
            <?php foreach (array_slice($scopusDestacados, 0, 20) as $item): ?>
                <?php include __DIR__ . '/../layouts/card_libro.php'; ?>
            <?php endforeach; ?>
        </div>
        <button class="arrow next" type="button"><i class="bi bi-chevron-right"></i></button>
    </div>
</div>
<?php elseif (isset($scopusDestacados['error'])): ?>
<div class="alert alert-warning">
    ⚠️ No se pudieron cargar artículos de Scopus. Verifica tu API key.
</div>
<?php endif; ?>

<!-- ==================== SECCIÓN: ARTÍCULOS DESTACADOS DE SCIENCEDIRECT ==================== -->
<?php if (is_array($scienceDirectDestacados) && isset($scienceDirectDestacados['error'])): ?>
<div class="alert alert-danger mt-5">
    ⚠️ Error en ScienceDirect: <?= htmlspecialchars($scienceDirectDestacados['error']) ?>
</div>
<?php elseif (!empty($scienceDirectDestacados) && is_array($scienceDirectDestacados)): ?>
<div class="category-section mt-5">
    <div class="category-header">
        <h3 class="category-title">🎓 Artículos destacados (ScienceDirect)</h3>
        <a href="/nexuslib/index.php?action=academicos&q=<?= urlencode('engineering') ?>&mode=category&source=sciencedirect" class="text-cyan ver-mas-link">Ver más →</a>
    </div>
    <div class="carousel-wrapper">
        <button class="arrow prev" type="button"><i class="bi bi-chevron-left"></i></button>
        <div class="books-scroll">
            <?php foreach (array_slice($scienceDirectDestacados, 0, 20) as $item): ?>
                <?php include __DIR__ . '/../layouts/card_libro.php'; ?>
            <?php endforeach; ?>
        </div>
        <button class="arrow next" type="button"><i class="bi bi-chevron-right"></i></button>
    </div>
</div>
<?php elseif (is_array($scienceDirectDestacados)): ?>
<div class="alert alert-warning mt-5">
    ℹ️ No se encontraron artículos destacados en ScienceDirect con el término actual
</div>
<?php endif; ?>

<!-- ==================== SECCIÓN: CATEGORÍAS ACADÉMICAS (SCOPUS) ==================== -->
<?php if (!empty($resultadosAcademicosPorCategoria) && is_array($resultadosAcademicosPorCategoria)): ?>
    <?php foreach ($resultadosAcademicosPorCategoria as $nombreCat => $datosCat): ?>
        <?php $articulos = $datosCat['articulos']; ?>
        <?php $terminoTecnico = $datosCat['termino']; ?>
        <?php if (!empty($articulos) && is_array($articulos)): ?>
        <div class="category-section mt-5">
            <div class="category-header">
                <h3 class="category-title">📖 <?= htmlspecialchars($nombreCat) ?></h3>
                <a href="/nexuslib/index.php?action=academicos&q=<?= urlencode($terminoTecnico) ?>&mode=category" class="text-cyan ver-mas-link">Ver más →</a>
            </div>
            <div class="carousel-wrapper">
                <button class="arrow prev" type="button"><i class="bi bi-chevron-left"></i></button>
                <div class="books-scroll">
                    <?php foreach (array_slice($articulos, 0, 20) as $item): ?>
                        <?php include __DIR__ . '/../layouts/card_libro.php'; ?>
                    <?php endforeach; ?>
                </div>
                <button class="arrow next" type="button"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Se removió la sección de biblioteca local y su modal asociado. -->

<?php include __DIR__ . '/../layouts/footer.php'; ?>
