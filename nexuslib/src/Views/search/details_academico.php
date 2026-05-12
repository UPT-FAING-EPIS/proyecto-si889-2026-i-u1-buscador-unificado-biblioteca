<?php include __DIR__ . '/../layouts/header.php'; ?>

<?php if (isset($errorApi)): ?>
    <div class="alert alert-danger mb-4">
        <strong>⚠️ Error:</strong> <?= htmlspecialchars($errorApi) ?>
    </div>
<?php endif; ?>

<?php if (isset($detalleAcademico) && is_array($detalleAcademico) && empty($detalleAcademico['error'])): ?>
    <?php
        $titulo = $detalleAcademico['titulo'] ?? 'Sin título';
        $autor = $detalleAcademico['autor'] ?? 'Autor desconocido';
        $resumen = $detalleAcademico['resumen'] ?? '';
        $fecha = $detalleAcademico['fecha'] ?? 'No disponible';
        $editorial = $detalleAcademico['editorial'] ?? 'Desconocida';
        $volumen = $detalleAcademico['volumen'] ?? null;
        $numero = $detalleAcademico['numero'] ?? null;
        $paginas = $detalleAcademico['paginas'] ?? null;
        $doi = $detalleAcademico['doi'] ?? '';
        $eid = $detalleAcademico['eid'] ?? '';
        $citas = (int) ($detalleAcademico['citedby_count'] ?? 0);
        $linkOriginal = $detalleAcademico['link_original'] ?? '#';
        $linkScopus = $detalleAcademico['link_scopus'] ?? '#';

        $bibliografiaPartes = array_filter([
            !empty($volumen) ? 'Vol. ' . $volumen : null,
            !empty($numero) ? 'No. ' . $numero : null,
            !empty($paginas) ? 'pp. ' . $paginas : null,
        ]);
        $bibliografiaLinea = implode(' | ', $bibliografiaPartes);

        $doiHTML = '';
        if (!empty($doi)) {
            $doiHTML = '<span class="text-secondary fw-semibold">DOI:</span> <code class="text-cyan">' . htmlspecialchars($doi) . '</code>';
        }
        
        $eidHTML = '';
        if (!empty($eid)) {
            $eidHTML = '<span class="text-secondary fw-semibold">ID Scopus:</span> <code class="text-cyan">' . htmlspecialchars($eid) . '</code>';
        }
    ?>
    <div class="academic-detail-shell">
        <div class="academic-hero">
            <div class="academic-hero__eyebrow">
                <span class="glow-dot"></span>
                Artículo académico
            </div>
            <h1 class="academic-hero__title"><?= htmlspecialchars($titulo) ?></h1>
            <p class="academic-hero__author"><?= htmlspecialchars($autor) ?></p>
            <div class="academic-hero__meta">
                <span class="cited-badge">🔥 <?= $citas ?> Citas en Scopus</span>
                <?php if (!empty($doi)): ?>
                    <span class="meta-chip">DOI: <?= htmlspecialchars($doi) ?></span>
                <?php endif; ?>
                <?php if (!empty($eid) && $eid !== '-'): ?>
                    <span class="meta-chip meta-chip--soft">EID: <?= htmlspecialchars($eid) ?></span>
                <?php endif; ?>
            </div>
            <?php
            // Watchlist button for details page (moved inside academic-hero for correct positioning)
            $bookKeyDetail = $doi ?: ($eid ?: '');
            $isSavedDetail = false;
            if (!empty($bookKeyDetail) && isset($_SESSION['user_id'])) {
                try {
                    $adapterDetail = new \App\Adapters\MySQLLocalAdapter();
                    $wlDetail = $adapterDetail->getWatchlistByUser((int) $_SESSION['user_id']);
                    foreach ($wlDetail as $w) {
                        if (($w['book_key'] ?? '') === (string) $bookKeyDetail) { $isSavedDetail = true; break; }
                    }
                } catch (\Throwable $e) {}
            }
            ?>
            <?php if (!empty($bookKeyDetail)): ?>
                <button id="detail-watchlist-btn" class="watchlist-btn" data-book-key="<?= htmlspecialchars($bookKeyDetail) ?>" data-source="academic" data-titulo="<?= htmlspecialchars($titulo) ?>" data-autor="<?= htmlspecialchars($autor) ?>" title="Guardar para más tarde" style="position: absolute; top:12px; right:12px; z-index:9999;">
                    <i class="<?= $isSavedDetail ? 'fas fa-bookmark' : 'far fa-bookmark' ?>" style="font-size:22px;"></i>
                </button>
            <?php endif; ?>
        </div>

<?php if (!defined('NEXUS_WATCHLIST_BUTTON_STYLES')): define('NEXUS_WATCHLIST_BUTTON_STYLES', true); ?>
<style>
    /* Floating watchlist button styles (glassmorphism) */
    #detail-watchlist-btn.watchlist-btn { width:44px; height:44px; border-radius:50%; display:flex; align-items:center; justify-content:center; background: rgba(15,23,42,0.7); backdrop-filter: blur(4px); border: 1px solid rgba(255,255,255,0.06); transition: background .22s ease, transform .18s ease; }
    #detail-watchlist-btn.watchlist-btn i { transition: transform .22s ease, color .3s ease; color: rgba(255,255,255,0.95); font-size:22px; }
    #detail-watchlist-btn.watchlist-btn:hover { background: rgba(15,23,42,0.82); transform: translateY(-2px); }
    #detail-watchlist-btn.watchlist-btn:hover i { transform: scale(1.12); }
    #detail-watchlist-btn.watchlist-btn i.fas { color: #f59e0b !important; }
</style>
<?php endif; ?>

        <!-- Duplicate old watchlist button removed. Floating button remains inside .academic-hero -->

        <div class="row g-4 mt-1">
            <div class="col-lg-8">
                <div class="glass-panel h-100">
                    <div class="section-heading">Abstract</div>
                    <?php if (!empty($resumen)): ?>
                        <div class="academic-abstract">
                            <?= nl2br(htmlspecialchars($resumen)) ?>
                        </div>
                    <?php else: ?>
                        <div class="academic-empty">No hay resumen disponible para este artículo.</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="metadata-container" style="display: flex; flex-direction: column; gap: 0.4rem; text-align: left; font-size: 0.9rem; line-height: 1.45; color: #f8fafc; padding-top: 0.25rem;">
                    <div style="position: absolute; top: 12px; right: 12px; display: flex; gap: 0.25rem;">
                        <?php if (!empty($linkScopus) && $linkScopus !== '#'): ?>
                            <a href="<?= htmlspecialchars($linkScopus) ?>" class="scopus-action" target="_blank" rel="noopener" title="Ver métricas en Scopus">
                                <i class="bi bi-box-arrow-up-right"></i>
                            </a>
                        <?php endif; ?>
                        <button class="citation-copy-btn" type="button" title="Copiar en formato APA 7" data-autor="<?= htmlspecialchars($autor) ?>" data-anno="<?= htmlspecialchars(substr($fecha, 0, 4)) ?>" data-titulo="<?= htmlspecialchars($titulo) ?>" data-revista="<?= htmlspecialchars($editorial) ?>" data-volumen="<?= htmlspecialchars($volumen ?? '') ?>" data-numero="<?= htmlspecialchars($numero ?? '') ?>" data-paginas="<?= htmlspecialchars($paginas ?? '') ?>" data-doi="<?= htmlspecialchars($doi) ?>">
                            <i class="bi bi-clipboard"></i>
                        </button>
                    </div>
                    <div class="section-heading" style="margin-bottom: 1rem; padding-bottom: 0;">
                        METADATOS
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                        <i class="bi bi-calendar3 text-secondary" style="margin-top: 0.1rem;"></i>
                        <span><?= htmlspecialchars($fecha ?: '-') ?></span>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                        <i class="bi bi-journal-text text-secondary" style="margin-top: 0.1rem;"></i>
                        <span>
                            <?= htmlspecialchars($editorial) ?>
                            <?php if (!empty($bibliografiaLinea)): ?>
                                <span class="text-secondary"> | </span><span><?= htmlspecialchars($bibliografiaLinea) ?></span>
                            <?php endif; ?>
                        </span>
                    </div>

                    <?php if (!empty($doiHTML)): ?>
                        <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                            <i class="bi bi-tag text-secondary" style="margin-top: 0.1rem;"></i>
                            <span><?= $doiHTML ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($eidHTML)): ?>
                        <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                            <i class="bi bi-tag text-secondary" style="margin-top: 0.1rem;"></i>
                            <span><?= $eidHTML ?></span>
                        </div>
                    <?php endif; ?>

                    <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                        <i class="bi bi-graph-up text-secondary" style="margin-top: 0.1rem;"></i>
                        <span><?= $citas ?> citas</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-bar mt-4">
            <a href="<?= htmlspecialchars($linkOriginal) ?>" class="btn btn-warning btn-lg action-btn" target="_blank" rel="noopener">
                <i class="bi bi-box-arrow-up-right"></i> Leer Artículo Completo
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-danger">No se encontró información académica para este artículo.</div>
<?php endif; ?>

<style>
.academic-detail-shell {
    color: #f8fafc;
}
.academic-hero {
    background: linear-gradient(145deg, rgba(15, 23, 42, 0.96), rgba(17, 24, 39, 0.9));
    border: 1px solid rgba(34, 211, 238, 0.15);
    border-radius: 28px;
    padding: 2rem;
    box-shadow: 0 24px 80px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
}
.academic-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at top right, rgba(34, 211, 238, 0.16), transparent 35%),
                radial-gradient(circle at bottom left, rgba(245, 158, 11, 0.12), transparent 30%);
    pointer-events: none;
}
.academic-hero > * {
    position: relative;
    z-index: 1;
}
.academic-hero__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    color: #cbd5e1;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.14em;
    margin-bottom: 1rem;
}
.glow-dot {
    width: 10px;
    height: 10px;
    border-radius: 999px;
    background: #22d3ee;
    box-shadow: 0 0 18px rgba(34, 211, 238, 0.9);
}
.academic-hero__title {
    font-size: clamp(2rem, 4vw, 3.6rem);
    line-height: 1.05;
    font-weight: 800;
    margin-bottom: 0.7rem;
}
.academic-hero__author {
    font-size: 1.15rem;
    color: #93c5fd;
    margin-bottom: 1.2rem;
}
.academic-hero__meta {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}
.cited-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.7rem 1rem;
    border-radius: 999px;
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
    color: #0f172a;
    font-weight: 800;
    box-shadow: 0 12px 30px rgba(245, 158, 11, 0.3);
}
.meta-chip {
    display: inline-flex;
    align-items: center;
    padding: 0.7rem 1rem;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.07);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #e2e8f0;
}
.glass-panel {
    background: rgba(15, 23, 42, 0.82);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 24px;
    padding: 1.5rem;
    backdrop-filter: blur(12px);
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.22);
}
.section-heading {
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.14em;
    color: #22d3ee;
    margin-bottom: 1rem;
    font-weight: 700;
}
.academic-abstract {
    font-size: 1.05rem;
    line-height: 1.9;
    color: #e2e8f0;
    white-space: pre-wrap;
}
.academic-empty {
    color: #94a3b8;
    padding: 1rem 0;
}
.academic-table td {
    padding: 0.8rem 0.4rem;
    border-color: rgba(255, 255, 255, 0.06) !important;
}
.academic-table td:first-child {
    width: 32%;
    font-size: 0.88rem;
}
.academic-table code {
    background: rgba(34, 211, 238, 0.08);
    padding: 0.3rem 0.45rem;
    border-radius: 8px;
}
.text-cyan {
    color: #22d3ee;
}
.action-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}
.action-btn {
    min-width: 240px;
    padding: 0.95rem 1.3rem;
    border-radius: 18px;
    font-weight: 700;
    box-shadow: 0 18px 30px rgba(0, 0, 0, 0.25);
}
.action-btn--ghost {
    background: rgba(255, 255, 255, 0.03);
}
@media (max-width: 768px) {
    .academic-hero {
        padding: 1.3rem;
        border-radius: 22px;
    }
    .action-btn {
        width: 100%;
        min-width: 0;
    }
}
</style>

<style>
.metadata-container {
    background: rgba(15, 23, 42, 0.72);
    border: 1px solid rgba(148, 163, 184, 0.14);
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
    box-shadow: none;
    position: relative;
}

.metadata-container .scopus-action {
    font-size: 1rem;
    padding: 8px;
    color: #94a3b8;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    transition: all 0.3s ease;
    background: transparent;
}

.metadata-container .scopus-action:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
}

.metadata-container .citation-copy-btn {
    font-size: 1rem;
    padding: 8px;
    color: #94a3b8;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    transition: all 0.3s ease;
    background: transparent;
    border: none;
    cursor: pointer;
}

.metadata-container .citation-copy-btn:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
}

.metadata-container .citation-copy-btn.copied {
    color: #22c55e;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyBtn = document.querySelector('.citation-copy-btn');
    if (!copyBtn) return;

    copyBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        const autor = this.getAttribute('data-autor') || '';
        const anno = this.getAttribute('data-anno') || '';
        const titulo = this.getAttribute('data-titulo') || '';
        const revista = this.getAttribute('data-revista') || '';
        const volumen = this.getAttribute('data-volumen') || '';
        const numero = this.getAttribute('data-numero') || '';
        const paginas = this.getAttribute('data-paginas') || '';
        const doi = this.getAttribute('data-doi') || '';

        let citation = '';

        // Procesar autor: si hay "et al" o múltiples autores, usar como está; si no, capitalizar
        let autorFinal = autor.trim();
        if (autorFinal.toLowerCase().includes('et al')) {
            citation += autorFinal;
        } else {
            citation += autorFinal;
        }

        // Añadir año
        if (anno) {
            citation += ' (' + anno + '). ';
        } else {
            citation += ' (s.f.). ';
        }

        // Añadir título
        citation += titulo;

        // Construcción de la parte de revista/volumen/etc
        let metadatos = [];
        if (revista) metadatos.push(revista);
        if (volumen) metadatos.push('Vol. ' + volumen);
        if (numero) metadatos.push('No. ' + numero);
        if (paginas) metadatos.push('pp. ' + paginas);

        if (metadatos.length > 0) {
            citation += '. ' + metadatos.join(', ');
        }

        // Añadir DOI
        if (doi) {
            citation += '. https://doi.org/' + doi;
        }

        citation += '.';

        // Copiar al portapapeles
        navigator.clipboard.writeText(citation).then(() => {
            // Mostrar feedback visual
            const originalIcon = this.innerHTML;
            this.innerHTML = '<i class="bi bi-check"></i>';
            this.classList.add('copied');

            // Revertir después de 2 segundos
            setTimeout(() => {
                this.innerHTML = originalIcon;
                this.classList.remove('copied');
            }, 2000);
        }).catch(err => {
            console.error('Error al copiar:', err);
        });
    });
});
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>