<?php
/**
 * card_libro.php
 * 
 * Componente reutilizable para renderizar una tarjeta de portada
 * 
 * Variables esperadas:
 * - $item (array): Datos del libro/artículo con keys: titulo, fuente, portada_url, doi, eid, google_id, isbn, id_libro, origen, link
 */

// Academic-only detail URL.
$identificadorArticulo = $item['doi'] ?? ($item['eid'] ?? ($item['google_id'] ?? ($item['isbn'] ?? '')));
$detalleUrl = !empty($identificadorArticulo)
    ? '/nexuslib/index.php?action=details&id=' . urlencode((string) $identificadorArticulo)
    : ($item['link'] ?? '#');

// Badge de fuente dentro de la portada.
$fuente = $item['fuente'] ?? 'Académico';
$badgeClass = match ($fuente) {
    'Scopus' => 'bg-primary',
    'ScienceDirect' => 'bg-success',
    'Biblioteca' => 'bg-success',
    'Digital' => 'bg-info',
    default => 'bg-secondary'
};

$forceString = static function ($value): string {
    return is_scalar($value) ? (string) $value : '';
};

$autorPortada = htmlspecialchars($forceString($item['autor'] ?? 'Autor desconocido'));
$tituloPortada = htmlspecialchars($forceString($item['titulo'] ?? 'Sin título'));
?>

<?php
// Build watchlist data
$bookKey = $item['doi'] ?? $item['eid'] ?? $item['google_id'] ?? $item['isbn'] ?? '';
$watchSaved = false;
if (isset($_SESSION['user_id']) && !empty($bookKey)) {
    try {
        $adapter = new \App\Adapters\MySQLLocalAdapter();
        $wl = $adapter->getWatchlistByUser((int) $_SESSION['user_id']);
        foreach ($wl as $w) {
            if (($w['book_key'] ?? '') === (string) $bookKey) { $watchSaved = true; break; }
        }
    } catch (\Throwable $e) {
        // ignore DB errors in view
    }
}
?>
<?php if (!defined('NEXUS_WATCHLIST_BUTTON_STYLES')): define('NEXUS_WATCHLIST_BUTTON_STYLES', true); ?>
<style>
    .watchlist-btn { width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; background: rgba(15,23,42,0.7); backdrop-filter: blur(4px); border: 1px solid rgba(255,255,255,0.04); transition: background 0.2s ease, transform 0.18s ease; z-index: 10; }
    .watchlist-btn i { transition: transform .25s ease, color .3s ease; color: rgba(255,255,255,0.9); }
    .watchlist-btn:hover { background: rgba(15,23,42,0.82); }
    .watchlist-btn:hover i { transform: scale(1.12); }
    .watchlist-btn i.fas { color: #f59e0b !important; }
</style>
<?php endif; ?>

<a href="<?= htmlspecialchars($detalleUrl) ?>" class="book-card-link text-decoration-none d-inline-block">
    <div class="book-card mx-auto">
        <div class="book-cover" style="position: relative;">
            <span class="badge-status <?= $badgeClass ?>" style="left: 8px; right: auto;">
                <?= htmlspecialchars($fuente) ?>
            </span>
            <!-- Watchlist button (top-right) -->
            <?php if (!empty($bookKey)): ?>
            <button class="watchlist-btn" data-book-key="<?= htmlspecialchars($bookKey) ?>" data-source="academic" data-titulo="<?= $tituloPortada ?>" data-autor="<?= $autorPortada ?>" aria-label="Guardar para más tarde" title="Guardar para más tarde" style="position: absolute; top:8px; right:8px;">
                <i class="<?= $watchSaved ? 'fas fa-bookmark' : 'far fa-bookmark' ?> watchlist-icon" style="font-size:16px;"></i>
            </button>
            <?php endif; ?>
            <?php if (!empty($item['portada_url'])): ?>
                <img src="<?= htmlspecialchars($item['portada_url']) ?>" alt="<?= $tituloPortada ?>">
            <?php else: ?>
                <div class="no-cover" style="background: linear-gradient(180deg, #0f172a 0%, #020617 100%); display: flex; flex-direction: column; justify-content: center; align-items: flex-start; text-align: left; padding: 15px; gap: 0.35rem; overflow: hidden;">
                    <span style="display: -webkit-box; width: 100%; color: #ffffff; font-size: 0.7rem; line-height: 1.1; font-weight: 700; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.65); -webkit-box-orient: vertical; -webkit-line-clamp: 4; overflow: hidden; text-overflow: ellipsis; margin-bottom: 12px;">
                        <?= $tituloPortada ?>
                    </span>
                    <span style="display: flex; align-items: center; gap: 0.3rem; width: 100%; color: rgba(255, 255, 255, 0.6); font-size: 0.65rem; line-height: 1.25; font-style: italic;">
                        <svg width="11" height="11" viewBox="0 0 24 24" aria-hidden="true" focusable="false" style="flex: 0 0 auto; fill: currentColor; opacity: 0.9;">
                            <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-4.418 0-8 2.239-8 5v3h16v-3c0-2.761-3.582-5-8-5z" />
                        </svg>
                        <span><?= $autorPortada ?></span>
                    </span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</a>
