
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="row">
    <div class="col-12">
        <h2 class="mb-4"><i class="bi bi-tag text-cyan"></i> <?= htmlspecialchars($nombreCategoria) ?></h2>
        
        <div class="books-grid" style="display: flex; flex-wrap: wrap; gap: 20px;">
            <?php foreach ($librosRelacionados as $item):
                $libro = $item['libro'];
                $linkId = $libro->google_id ?: $libro->isbn;
                $linkAction = 'details';
            ?>
                <a href="/nexuslib/index.php?action=<?= $linkAction ?>&id=<?= urlencode($linkId) ?>" class="book-card-link">
                    <div class="book-card">
                        <div class="book-cover">
                            <span class="badge-status badge-digital">
                                Digital
                            </span>
                            <?php if ($libro->portada_url): ?>
                                <img src="<?= htmlspecialchars($libro->portada_url) ?>">
                            <?php else: ?>
                                <div class="no-cover">📖</div>
                            <?php endif; ?>
                        </div>
                        <div class="book-card-body">
                            <span class="book-author"><?= htmlspecialchars($libro->autor) ?></span>
                            <span class="book-cat-label"><?= htmlspecialchars($nombreCategoria) ?></span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
