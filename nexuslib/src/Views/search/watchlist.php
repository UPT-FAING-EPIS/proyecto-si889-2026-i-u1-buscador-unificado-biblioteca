
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="row">
    <div class="col-12">
        <h2 class="mb-4"><i class="bi bi-bookmark-heart text-cyan"></i> Mi lista de lectura</h2>
        
        <?php if (empty($watchlist)): ?>
            <div class="alert alert-dark text-center py-5">
                <i class="bi bi-bookmark fs-1 d-block mb-3"></i>
                <p>No tienes libros guardados.</p>
                <a href="/nexuslib/index.php" class="btn btn-outline-light">Explorar libros</a>
            </div>
        <?php else: ?>
            <div class="books-scroll">
                <?php foreach ($watchlist as $item): ?>
                    <?php
                    $linkId = $item['book_key'];
                    $linkAction = 'details';
                    ?>
                    <div class="book-card" data-book-key="<?= htmlspecialchars($item['book_key']) ?>">
                        <a href="/nexuslib/index.php?action=<?= $linkAction ?>&id=<?= urlencode($linkId) ?>" class="book-card-link">
                            <div class="book-cover">
                                <span class="badge-status badge-digital">
                                    Académico
                                </span>
                                <div class="no-cover">📖</div>
                            </div>
                            <div class="book-card-body">
                                <span class="book-author"><?= htmlspecialchars($item['autor']) ?></span>
                                <span class="book-cat-label"><?= htmlspecialchars($item['titulo']) ?></span>
                            </div>
                        </a>
                        <button class="btn btn-sm btn-danger mt-2 remove-watchlist" data-book-key="<?= htmlspecialchars($item['book_key']) ?>">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.querySelectorAll('.remove-watchlist').forEach(btn => {
    btn.addEventListener('click', async () => {
        const bookKey = btn.dataset.bookKey;
        const response = await fetch('/nexuslib/index.php?action=remove-watchlist', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ book_key: bookKey })
        });
        if (response.ok) {
            btn.closest('.book-card').remove();
            if (document.querySelectorAll('.book-card').length === 0) {
                location.reload();
            }
        }
    });
});
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
