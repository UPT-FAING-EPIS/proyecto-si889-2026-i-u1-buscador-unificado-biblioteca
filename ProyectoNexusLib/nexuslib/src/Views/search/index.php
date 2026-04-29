<?php
use App\Models\Inventario;
use App\Models\Libro;

// Importamos el cabezal (CSS, Navbar)
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-primary">NexusLib</h1>
            <p class="lead">Encuentra libros fisicos y digitales desde un solo lugar</p>
            
            <form action="" method="GET" class="mt-4">
                <div class="row g-2">
                    <div class="col-md-10">
                        <input type="text" name="q" class="form-control form-control-lg shadow-sm" 
                               placeholder="Buscar por título, autor o ISBN..." 
                               value="<?= htmlspecialchars($_GET['q'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-lg w-100 shadow-sm" type="submit">
                            <i class="bi bi-search"></i> Buscar
                        </button>
                    </div>
                </div>

                <div class="filter-bar">
                    <div class="d-flex align-items-center gap-3 mt-2 flex-wrap">
                        <div style="max-width: 250px; width: 100%;">
                            <label for="origen" class="small text-muted fw-bold mb-1 d-block">Origen</label>
                            <select id="origen" name="origen" class="form-select shadow-sm">
                                <option value="todos" <?= ($_GET['origen'] ?? 'todos') === 'todos' ? 'selected' : '' ?>>Todos</option>
                                <option value="fisicos" <?= ($_GET['origen'] ?? '') === 'fisicos' ? 'selected' : '' ?>>Solo Fisicos</option>
                                <option value="digitales" <?= ($_GET['origen'] ?? '') === 'digitales' ? 'selected' : '' ?>>Solo Digitales</option>
                            </select>
                        </div>

                        <div style="max-width: 220px; width: 100%;">
                            <label for="orden" class="small text-muted fw-bold mb-1 d-block">Orden</label>
                            <select id="orden" name="orden" class="form-select shadow-sm">
                                <option value="" <?= ($_GET['orden'] ?? '') === '' ? 'selected' : '' ?>>Relevancia</option>
                                <option value="titulo" <?= ($_GET['orden'] ?? '') === 'titulo' ? 'selected' : '' ?>>Titulo (A-Z)</option>
                            </select>
                        </div>

                        <div class="form-check form-switch mt-4">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="solo_disponibles"
                                name="solo_disponibles"
                                value="1"
                                <?= isset($_GET['solo_disponibles']) ? 'checked' : '' ?>
                            >
                            <label class="form-check-label" for="solo_disponibles">
                                Solo disponibles
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-dismissible alert-danger shadow-sm">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>¡Ops!</strong> <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['q'])): ?>
            <div class="text-center mb-4">
                <p class="lead mb-0">
                    Se encontraron <?php echo count($resultados); ?> recursos para "<?php echo htmlspecialchars((string) $termino, ENT_QUOTES, 'UTF-8'); ?>"
                </p>
            </div>
        <?php endif; ?>

        <div class="row row-cols-1 row-cols-lg-2 g-4">
            <?php foreach ($resultados as $item): ?>
                <?php
                    $libro = $item['libro'] ?? null;
                    $inventario = $item['inventario'] ?? null;
                ?>

                <?php if ($libro instanceof Libro): ?>
                    <div class="col">
                        <div class="card h-100 flex-row overflow-hidden border-0 shadow-sm book-card">
                            <div class="flex-shrink-0" style="width: 160px; min-width: 160px; height: 220px; background-color: #f8f9fa;">
                                <?php if ($libro->portada_url): ?>
                                    <img src="<?php echo $libro->portada_url; ?>" class="w-100 h-100" alt="Portada" style="object-fit: cover; height: 100%; background-color: #f8f9fa;">
                                <?php else: ?>
                                    <div class="border-end d-flex align-items-center justify-content-center text-muted w-100 h-100" style="background-color: #f8f9fa;">
                                        <div class="text-center px-2">
                                            <i class="bi bi-book" style="font-size: 2rem;"></i>
                                            <div class="small mt-1">Sin portada</div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="card-body d-flex flex-column p-3 min-w-0">
                                <div class="d-flex justify-content-end gap-2 mb-2">
                                    <?php if ($inventario instanceof Inventario): ?>
                                        <span class="badge-local" style="font-size: 0.68rem;">Local</span>
                                    <?php endif; ?>
                                    <?php if (!empty($libro->digital_link) || !($inventario instanceof Inventario)): ?>
                                        <span class="badge-digital" style="font-size: 0.68rem;">Digital</span>
                                    <?php endif; ?>
                                </div>

                                <h5 class="fw-bold mb-1 text-truncate-2">
                                    <span class="text-primary">
                                        <?= htmlspecialchars($libro->titulo); ?>
                                    </span>
                                </h5>

                                <p class="card-text mb-1 small text-muted text-truncate">
                                    <?= htmlspecialchars($libro->autor); ?>
                                </p>

                                <p class="card-text mb-0 small">
                                    <span class="text-muted">ISBN:</span>
                                    <span><?= htmlspecialchars($libro->isbn); ?></span>
                                </p>

                                <div class="d-flex justify-content-end small text-muted pt-2 gap-2 flex-wrap mb-2">
                                    <?php if ($inventario instanceof Inventario): ?>
                                        <span class="badge bg-light text-dark border">Stock: <?= (int) $inventario->stock; ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-info text-white border">Acceso Online</span>
                                    <?php endif; ?>
                                </div>

                                <a href="?action=details&q=<?= $libro->isbn ?>" class="btn rounded-pill btn-preview w-100 mt-auto">
                                    <i class="bi bi-eye"></i> Leer Vista Previa
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<?php 
// Importamos el pie de página (Scripts JS)
include __DIR__ . '/../layouts/footer.php'; 
?>