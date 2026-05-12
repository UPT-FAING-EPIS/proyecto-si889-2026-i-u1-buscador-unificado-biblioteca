<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="hero-section">
    <h1>Resultados para "<span class="text-cyan"><?= htmlspecialchars($_GET['q'] ?? '') ?></span>"</h1>
    <p class="text-secondary"><?= count($resultados) ?> libros encontrados</p>
</div>

<?php if (empty($resultados)): ?>
    <div class="text-center py-5">
        <i class="bi bi-emoji-frown fs-1 text-secondary"></i>
        <p class="mt-3">No se encontraron resultados para tu búsqueda.</p>
        <p class="text-secondary">Prueba con otras palabras o revisa la ortografía.</p>
        <a href="/nexuslib/index.php" class="btn-google mt-3">Volver al inicio</a>
    </div>
<?php else: ?>
    <div class="books-scroll" style="flex-wrap: wrap; justify-content: center;">
        <?php foreach ($resultados as $item):
            $libro = $item['libro'];
            $linkId = $libro->google_id ?: $libro->isbn;
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
                        <span class="book-author"><?= htmlspecialchars(substr($libro->autor, 0, 35)) ?></span>
                        <span class="book-cat-label"><?= htmlspecialchars($libro->categoria ?? 'General') ?></span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
