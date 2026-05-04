<?php
use App\Models\Inventario;
use App\Models\Libro;

include __DIR__ . '/../layouts/header.php';

$libroObj = $libro ?? null;
$inventarioObj = $inventario ?? null;
$autorNombre = trim((string) ($libroObj->autor ?? 'Autor desconocido'));
$categoriaNombre = trim((string) ($libroObj->categoria ?? ''));
$isbn = trim((string) ($libroObj->isbn ?? ''));
$authorLink = 'index.php?action=search-more&q=' . urlencode($autorNombre) . '&type=author';
$piso = ($inventarioObj instanceof Inventario) ? (string) ($inventarioObj->piso ?? 'No disponible') : 'No disponible';
$estante = ($inventarioObj instanceof Inventario) ? (string) ($inventarioObj->estante ?? 'No disponible') : 'No disponible';
$stock = ($inventarioObj instanceof Inventario) ? (int) ($inventarioObj->stock ?? 0) : 0;
?>

<div class="container-fluid" style="background: var(--bg-body); padding: 30px 20px;">
    <div class="container">
        <?php if (!($libroObj instanceof Libro)): ?>
            <div class="alert alert-dark border-danger text-danger">No se encontro el libro fisico solicitado.</div>
        <?php else: ?>
            <div class="book-details-card book-detail-card p-4 mb-4 rounded-4">
                <div class="d-flex align-items-start gap-4 flex-column flex-md-row">
                    <div style="width:145px; flex:0 0 145px;">
                        <?php if (!empty($libroObj->portada_url)): ?>
                            <img src="<?= htmlspecialchars($libroObj->portada_url) ?>" alt="<?= htmlspecialchars($libroObj->titulo ?? 'Portada') ?>" class="detail-cover">
                        <?php else: ?>
                            <div class="no-cover d-flex align-items-center justify-content-center" style="width:145px;height:200px;border-radius:6px;background:#0f172a;">
                                <i class="bi bi-book text-secondary fs-1"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex-grow-1 w-100">
                        <span class="badge-status badge-local mb-2">En Biblioteca</span>
                        <h2 class="book-title mb-2"><?= htmlspecialchars($libroObj->titulo ?? 'Titulo desconocido') ?></h2>
                        <a href="<?= htmlspecialchars($authorLink) ?>" class="author-name author-link author-link-local d-inline-block text-decoration-none mb-2">
                            <?= htmlspecialchars($autorNombre) ?>
                        </a>

                        <?php if ($categoriaNombre !== ''): ?>
                            <div class="mb-2">
                                <span class="badge category-badge"><?= htmlspecialchars($categoriaNombre) ?></span>
                            </div>
                        <?php endif; ?>

                        <p class="isbn-text mb-3"><span class="text-secondary">ISBN:</span> <?= htmlspecialchars($isbn !== '' ? $isbn : 'No disponible') ?></p>

                        <div class="quick-info-row inventory-grid mb-4">
                            <div>
                                <div class="quick-info-item h-100">
                                    <div class="quick-info-icon"><i class="bi bi-layers"></i></div>
                                    <div>
                                        <span class="quick-info-label">Piso</span>
                                        <span class="quick-info-value"><?= htmlspecialchars($piso) ?></span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="quick-info-item h-100">
                                    <div class="quick-info-icon"><i class="bi bi-grid"></i></div>
                                    <div>
                                        <span class="quick-info-label">Estante</span>
                                        <span class="quick-info-value"><?= htmlspecialchars($estante) ?></span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="quick-info-item h-100">
                                    <div class="quick-info-icon"><i class="bi bi-box"></i></div>
                                    <div>
                                        <span class="quick-info-label">Stock</span>
                                        <span class="quick-info-value <?= $stock > 0 ? 'text-success' : 'text-danger' ?>"><?= $stock ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-warning btn-reserve-book-custom btn-lg">
                                <i class="bi bi-bookmark-check me-2"></i>Reservar Libro
                            </button>
                            <a href="javascript:history.back()" class="btn btn-outline-light btn-lg">Volver</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($libroObj instanceof Libro): ?>
            <div class="description-container text-center">
                <?php $rawDesc = trim((string) ($libroObj->descripcion ?? '')); ?>
                <?php $cleanDesc = $rawDesc !== '' ? strip_tags($rawDesc) : 'Sin sinopsis disponible.'; ?>
                <p id="bookDescription" class="book-description-local clamped mx-auto">
                    <?= nl2br(htmlspecialchars($cleanDesc)) ?>
                </p>

                <?php if ($rawDesc !== ''): ?>
                    <div class="mt-2">
                        <button id="toggleDescription" class="toggle-desc-btn" style="display: none;">▼ Ver más</button>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
