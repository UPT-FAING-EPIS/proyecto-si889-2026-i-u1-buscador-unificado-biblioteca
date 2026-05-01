<?php
use App\Models\Libro;

include __DIR__ . '/../layouts/header.php';

$nombreCategoria = $nombreCategoria ?? 'Biografía';
$librosRelacionados = $librosRelacionados ?? [];
?>

<div class="container-fluid px-4 py-4">
    <div class="container">
        <h2 class="category-title mb-4"><?= htmlspecialchars($nombreCategoria) ?></h2>

        <div class="books-grid">
            <?php if (empty($librosRelacionados)): ?>
                <div class="book-card">
                    <div class="book-cover d-flex align-items-center justify-content-center bg-dark h-100 w-100">
                        <i class="bi bi-journal-x text-secondary fs-1"></i>
                    </div>
                    <div class="book-card-body">
                        <span class="book-author">Sin resultados</span>
                        <span class="book-cat-label"><?= htmlspecialchars($nombreCategoria) ?></span>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($librosRelacionados as $item):
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
                                <span class="book-author d-block w-100 text-truncate" title="<?= htmlspecialchars($libro->autor ?? '') ?>"><?= htmlspecialchars($libro->autor ?? '') ?></span>
                                <span class="book-cat-label d-block w-100 text-truncate" title="<?= htmlspecialchars($nombreCategoria) ?>"><?= htmlspecialchars($nombreCategoria) ?></span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

    <div class="container text-center my-4">
        <?php $currentPage = isset($page) ? (int)$page : 1; ?>
        <button type="button" id="load-more-btn" class="load-more-btn" aria-label="Cargar más resultados"><?= 'Cargar más resultados' ?></button>
    </div>

    <script>
    (function () {
        const btn = document.getElementById('load-more-btn');
        const grid = document.querySelector('.books-grid');
        if (!btn || !grid) return;

        const categoryName = <?= json_encode($nombreCategoria) ?>;
        let page = <?= $currentPage ?>;

        btn.addEventListener('click', async function () {
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Cargando...';

            const targetPage = page + 1;
            const url = 'index.php?action=category&name=' + encodeURIComponent(categoryName) + '&page=' + targetPage + '&ajax=1';

            try {
                const resp = await fetch(url, { credentials: 'same-origin' });
                if (!resp.ok) throw new Error('Network response was not ok');
                const data = await resp.text();

                if (data.trim() === '') {
                    btn.textContent = 'No hay más resultados';
                    btn.disabled = true;
                } else {
                    grid.insertAdjacentHTML('beforeend', data);
                    page = targetPage;
                    btn.textContent = originalText;
                    btn.disabled = false;
                }
            } catch (err) {
                console.error(err);
                btn.textContent = originalText;
                btn.disabled = false;
            }
        });
    })();
    </script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>