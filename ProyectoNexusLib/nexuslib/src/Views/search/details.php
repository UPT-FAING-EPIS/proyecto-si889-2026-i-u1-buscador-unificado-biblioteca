<?php
include __DIR__ . '/../layouts/header.php';

$libroObj = $libro ?? null;
$libro = $libroObj;
$librosRelacionados = $librosRelacionados ?? [];

// Prepare categories list (show only first category for display)
$cats = [];
$firstCategory = null;
if ($libroObj !== null) {
    if (!empty($libroObj->categorias) && is_array($libroObj->categorias)) {
        $cats = $libroObj->categorias;
        $firstCategory = $cats[0] ?? null;
    } elseif (!empty($libroObj->categoria)) {
        $cats = [$libroObj->categoria];
        $firstCategory = $libroObj->categoria;
    }
}
?>

<div class="container-fluid" style="background: var(--bg-body); padding: 30px 20px;">
    <div class="container">
        <?php if ($libroObj === null): ?>
            <div class="alert alert-dark border-danger text-danger">No se encontró el libro solicitado.</div>
        <?php else: ?>
            <div class="book-details-card p-4 mb-4 rounded-4">
                <div class="d-flex align-items-start gap-4">
                    <div style="width:145px; flex:0 0 145px;">
                        <?php if (!empty($libroObj->portada_url)): ?>
                            <img src="<?= htmlspecialchars($libroObj->portada_url) ?>" alt="<?= htmlspecialchars($libroObj->titulo ?? 'Portada') ?>" class="detail-cover">
                        <?php else: ?>
                            <div class="no-cover d-flex align-items-center justify-content-center" style="width:145px;height:200px;border-radius:6px;background:#0f172a;">
                                <i class="bi bi-book text-secondary fs-1"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex-grow-1">
                        <p class="mb-1 author-name"><?= htmlspecialchars($libroObj->autor ?? 'Autor desconocido') ?></p>
                        <h2 class="book-title mb-2"><?= htmlspecialchars($libroObj->titulo ?? 'Título desconocido') ?></h2>

                        <p class="meta small text-secondary mb-3">
                            <?php if (!empty($libroObj->num_paginas)): ?>
                                <?= htmlspecialchars($libroObj->num_paginas) ?> páginas
                            <?php endif; ?>
                            <?php if (!empty($libroObj->num_paginas) && !empty($libroObj->descripcion)): ?> - <?php endif; ?>
                            <?php if (!empty($libroObj->descripcion) && preg_match('/(\d{4})/', $libroObj->descripcion, $m)): ?>
                                <?= htmlspecialchars($m[1]) ?>
                            <?php endif; ?>
                        </p>

                        <div class="mb-3">
                            <?php if ($firstCategory !== null): ?>
                                <span class="badge bg-secondary text-dark me-1"><?= htmlspecialchars($firstCategory) ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <button id='open-reader-btn' class='btn-read' data-isbn='<?= htmlspecialchars($libro->isbn ?? '') ?>'><i class='fas fa-book-open'></i> Vista Previa</button>
                            <?php $googleId = $libro->google_id ?? null; $googleHref = $googleId ? 'https://books.google.com/books?id=' . rawurlencode($googleId) : ($libro->digital_link ?? '#'); ?>
                            <a href="<?= htmlspecialchars($googleHref) ?>" target="_blank" class="btn-google"><i class='fas fa-external-link-alt'></i> Ver en Google Books</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4 text-center">
                <?php $rawDesc = trim((string) ($libroObj->descripcion ?? '')); ?>
                <?php $cleanDesc = $rawDesc !== '' ? strip_tags($rawDesc) : 'Sin sinopsis disponible.'; ?>
                <p id="bookDescription" class="book-description clamped mx-auto">
                    <?= nl2br(htmlspecialchars($cleanDesc)) ?>
                </p>

                <?php if ($rawDesc !== ''): ?>
                    <div class="mt-2">
                        <button id="toggleDescription" class="toggle-desc-btn" style="display: none;">▼ Ver más</button>
                    </div>
                <?php endif; ?>
            </div>

            <div id='viewerCanvas' style='width: 100%; height: 600px; display: none; margin-top: 20px;'></div>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
<script type="text/javascript">
    if (typeof google !== 'undefined') {
        google.books.load(); 
    }
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
