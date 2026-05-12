
<?php include __DIR__ . '/../layouts/header.php'; ?>

<?php if (isset($detalleAcademico) && is_array($detalleAcademico) && empty($detalleAcademico['error'])): ?>
<div class="row g-4 align-items-start">
    <div class="col-md-3 text-center">
        <div class="bg-dark rounded p-5 shadow-sm h-100 d-flex flex-column justify-content-center">
            <span class="badge bg-primary mb-3">Artículo académico</span>
            <i class="bi bi-journal-text fs-1 text-cyan"></i>
            <?php if (!empty($detalleAcademico['citedby_count'])): ?>
                <div class="mt-3">
                    <span class="badge bg-warning text-dark">Citas: <?= (int) $detalleAcademico['citedby_count'] ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-9">
        <span class="badge bg-success mb-2"><?= htmlspecialchars($detalleAcademico['editorial'] ?? 'Scopus') ?></span>
        <h1 class="mb-2"><?= htmlspecialchars($detalleAcademico['titulo'] ?? 'Sin título') ?></h1>
        <h4 class="text-cyan"><?= htmlspecialchars($detalleAcademico['autor'] ?? 'Autor desconocido') ?></h4>

        <div class="row g-3 mt-3 mb-4">
            <div class="col-md-4">
                <div class="bg-dark rounded p-3 h-100">
                    <small class="text-secondary d-block">Fecha</small>
                    <strong><?= htmlspecialchars($detalleAcademico['fecha'] ?? 'No disponible') ?></strong>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-dark rounded p-3 h-100">
                    <small class="text-secondary d-block">Editorial</small>
                    <strong><?= htmlspecialchars($detalleAcademico['editorial'] ?? 'Desconocida') ?></strong>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-dark rounded p-3 h-100">
                    <small class="text-secondary d-block">Citas</small>
                    <strong><?= (int) ($detalleAcademico['citedby_count'] ?? 0) ?></strong>
                </div>
            </div>
        </div>

        <?php if (!empty($detalleAcademico['resumen'])): ?>
            <div class="bg-dark rounded p-4 mb-4">
                <h5 class="mb-3">Resumen completo</h5>
                <p class="mb-0"><?= nl2br(htmlspecialchars($detalleAcademico['resumen'])) ?></p>
            </div>
        <?php endif; ?>

        <div class="d-flex flex-wrap gap-2 mb-4">
            <?php if (!empty($detalleAcademico['link_original'])): ?>
                <a href="<?= htmlspecialchars($detalleAcademico['link_original']) ?>" class="btn btn-primary" target="_blank" rel="noopener">
                    <i class="bi bi-box-arrow-up-right"></i> Abrir enlace original
                </a>
            <?php endif; ?>
            <?php if (!empty($detalleAcademico['link_scopus'])): ?>
                <a href="<?= htmlspecialchars($detalleAcademico['link_scopus']) ?>" class="btn btn-outline-light" target="_blank" rel="noopener">
                    <i class="bi bi-search"></i> Ver en Scopus
                </a>
            <?php endif; ?>
            <a href="/nexuslib/index.php?action=academicos" class="btn btn-outline-secondary">
                ← Volver a resultados
            </a>
        </div>

        <?php if (!empty($detalleAcademico['doi'])): ?>
            <p><strong>DOI:</strong> <code><?= htmlspecialchars($detalleAcademico['doi']) ?></code></p>
        <?php endif; ?>
    </div>
</div>

<?php elseif (isset($errorApi)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($errorApi) ?></div>

<?php elseif ($libroObj): ?>
<div class="row">
    <div class="col-md-3 text-center">
        <?php if ($libroObj->portada_url): ?>
            <img src="<?= htmlspecialchars($libroObj->portada_url) ?>" class="img-fluid rounded shadow">
        <?php else: ?>
            <div class="bg-dark rounded p-5 text-center"><i class="bi bi-book fs-1"></i></div>
        <?php endif; ?>
    </div>
    <div class="col-md-9">
        <span class="badge bg-info mb-2">📱 Digital</span>
        <h1><?= htmlspecialchars($libroObj->titulo) ?></h1>
        <h4 class="text-cyan"><?= htmlspecialchars($libroObj->autor) ?></h4>
        <p><strong>ISBN:</strong> <?= htmlspecialchars($libroObj->isbn) ?></p>
        <?php if ($libroObj->descripcion): ?>
            <p><?= nl2br(htmlspecialchars($libroObj->descripcion)) ?></p>
        <?php endif; ?>
        
        <div class="mt-4">
            <h5>⭐ Calificar</h5>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="star-rating mb-2">
                    <input type="radio" name="rating" value="5" id="star5"><label for="star5">★</label>
                    <input type="radio" name="rating" value="4" id="star4"><label for="star4">★</label>
                    <input type="radio" name="rating" value="3" id="star3"><label for="star3">★</label>
                    <input type="radio" name="rating" value="2" id="star2"><label for="star2">★</label>
                    <input type="radio" name="rating" value="1" id="star1"><label for="star1">★</label>
                </div>
                <textarea id="comment-text" class="form-control bg-dark text-white mb-2" rows="3" placeholder="Tu comentario..."></textarea>
                <button id="submit-review" class="btn btn-primary">Enviar</button>
            <?php else: ?>
                <p><a href="/nexuslib/index.php?action=login">Inicia sesión</a> para calificar</p>
            <?php endif; ?>
        </div>
        
        <div class="mt-4">
            <h5>💬 Comentarios</h5>
            <div id="comments-container">Cargando...</div>
        </div>
    </div>
</div>

<script>
const bookKey = 'google:<?= $libroObj->google_id ?: $libroObj->isbn ?>';

async function loadComments() {
    const res = await fetch(`index.php?action=get-book-stats&book_key=${bookKey}`);
    const data = await res.json();
    if (data.comments?.length) {
        document.getElementById('comments-container').innerHTML = data.comments.map(c => `
            <div class="bg-dark p-3 rounded mb-2">
                <strong><?= htmlspecialchars($_SESSION['user']['nombre'] ?? 'Usuario') ?></strong>
                <small class="text-secondary">${new Date(c.created_at).toLocaleDateString()}</small>
                <p class="mt-1">${escapeHtml(c.comentario)}</p>
            </div>
        `).join('');
    } else {
        document.getElementById('comments-container').innerHTML = '<p>No hay comentarios</p>';
    }
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

document.getElementById('submit-review')?.addEventListener('click', async () => {
    const rating = document.querySelector('input[name="rating"]:checked')?.value;
    const comentario = document.getElementById('comment-text')?.value;
    if (!rating) return alert('Selecciona una calificación');
    
    await fetch('/nexuslib/index.php?action=add-comment', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({book_key: bookKey, source: 'google', rating, comentario})
    });
    location.reload();
});

loadComments();
</script>
<?php else: ?>
    <div class="alert alert-danger">Libro no encontrado</div>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
