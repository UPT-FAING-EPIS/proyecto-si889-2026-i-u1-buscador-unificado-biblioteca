<?php include __DIR__ . '/../layouts/header.php'; ?>
<?php $termino = $termino ?? ($_GET['q'] ?? ''); ?>

<div class="text-center py-4">
    <h1 class="display-5 fw-bold">🎓 Búsqueda Académica</h1>
    <p class="text-secondary">Resultados de Scopus y ScienceDirect</p>
</div>

<?php
// $fuenteSeleccionada viene del controlador con valor por defecto 'all'
$fuenteSeleccionada = $fuenteSeleccionada ?? 'all';
$terminoUrl = urlencode($termino ?? ($_GET['q'] ?? ''));
$mode = $_GET['mode'] ?? '';
$name = $_GET['name'] ?? '';

$modeParam = '&mode=' . urlencode($mode);
$nameParam = ($mode === 'category' && $name !== '') ? '&name=' . urlencode($name) : '';

// 1. Primero definimos el texto de la fuente
$textosFuentes = [
    'all' => 'Todos',
    'scopus' => 'Solo Scopus',
    'sciencedirect' => 'Solo ScienceDirect'
];
$labelFuente = $textosFuentes[$fuenteSeleccionada] ?? 'Todos';

// 2. Definimos el label de forma única y consistente
$dropdownLabel = 'Filtrar: ' . $labelFuente;
?>

<div class="d-flex justify-content-start mb-4 px-3 academicos-filters">
    <div class="dropdown">
        <button class="btn btn-outline-cyan dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-filter"></i> <?= $dropdownLabel ?>
        </button>
        <ul class="dropdown-menu dropdown-menu-dark border-cyan">
            <li><a class="dropdown-item" href="index.php?action=academicos&q=<?= $terminoUrl ?>&source=all<?= $modeParam . $nameParam ?>">Todos</a></li>
            <li><a class="dropdown-item" href="index.php?action=academicos&q=<?= $terminoUrl ?>&source=scopus<?= $modeParam . $nameParam ?>">Scopus</a></li>
            <li><a class="dropdown-item" href="index.php?action=academicos&q=<?= $terminoUrl ?>&source=sciencedirect<?= $modeParam . $nameParam ?>">ScienceDirect</a></li>
        </ul>
    </div>
</div>

<?php if (!empty($termino) && (($_GET['mode'] ?? '') !== 'category')): ?>
    <div class="alert alert-info text-center">
        <i class="bi bi-search"></i> Mostrando resultados para: <strong><?= htmlspecialchars($termino) ?></strong>
    </div>
<?php endif; ?>

<?php if (isset($errorApi)): ?>
    <div class="alert alert-warning">
        <strong>⚠️ Error:</strong> <?= htmlspecialchars($errorApi) ?>
    </div>
<?php endif; ?>

<?php if (empty($termino)): ?>
    <div class="text-center py-5">
        <i class="bi bi-search fs-1 text-secondary"></i>
        <p class="mt-3">Usa el buscador para encontrar artículos en Scopus y ScienceDirect.</p>
        <form action="index.php" method="get" class="d-flex justify-content-center mt-3">
            <input type="hidden" name="action" value="academicos">
            <input type="text" name="q" class="form-control w-50" placeholder="Ej: artificial intelligence, machine learning, medicina...">
            <button type="submit" class="btn btn-primary ms-2">Buscar</button>
        </form>
    </div>
<?php elseif (empty($resultadosAcademicos)): ?>
    <div class="text-center py-5">
        <i class="bi bi-journal-x fs-1 text-secondary"></i>
        <p class="mt-3">No se encontraron artículos para "<strong><?= htmlspecialchars($termino) ?></strong>".</p>
        <p class="text-secondary">Prueba con otros términos o verifica tu conexión.</p>
        <a href="/nexuslib/index.php" class="btn btn-outline-light">Volver al inicio</a>
    </div>
<?php else: ?>
    <div id="academic-results-list" style="display: flex; flex-wrap: wrap; gap: 20px;">
        <?php foreach ($resultadosAcademicos as $index => $item): ?>
            <?php include __DIR__ . '/../layouts/card_libro.php'; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty($termino) && !empty($resultadosAcademicos)): ?>
    <div class="text-center mt-4">
        <button id="load-more-academicos" type="button" class="btn btn-outline-cyan px-4 py-2 fw-semibold">
            Cargar más
        </button>
    </div>
<?php endif; ?>

<style>
.card:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
    box-shadow: 0 10px 20px rgba(0,0,0,0.3);
}

.academicos-filters {
    position: relative;
    z-index: 100;
}

.academicos-filters .dropdown-menu {
    z-index: 2000 !important;
}
</style>

<script>
(function () {
    const loadMoreButton = document.getElementById('load-more-academicos');
    const resultsList = document.getElementById('academic-results-list');

    if (!loadMoreButton || !resultsList) {
        return;
    }

    let currentPage = 1;

    const getCurrentUrlParams = () => {
        const searchParams = new URLSearchParams(window.location.search);
        searchParams.set('action', 'academicos');
        searchParams.set('ajax', '1');
        searchParams.set('page', String(currentPage));
        return searchParams;
    };

    loadMoreButton.addEventListener('click', async () => {
        currentPage += 1;
        loadMoreButton.disabled = true;
        loadMoreButton.textContent = 'Cargando...';

        try {
            const requestParams = getCurrentUrlParams();
            const response = await fetch(`index.php?${requestParams.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error('La respuesta de red no fue exitosa.');
            }

            const data = await response.text();
            const html = data.trim();

            if (!html) {
                loadMoreButton.remove();
                return;
            }

            resultsList.insertAdjacentHTML('beforeend', html);
        } catch (error) {
            currentPage = Math.max(1, currentPage - 1);
            loadMoreButton.disabled = false;
            loadMoreButton.textContent = 'Cargar más';
            console.error(error);
            return;
        }

        loadMoreButton.disabled = false;
        loadMoreButton.textContent = 'Cargar más';
    });
})();
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
