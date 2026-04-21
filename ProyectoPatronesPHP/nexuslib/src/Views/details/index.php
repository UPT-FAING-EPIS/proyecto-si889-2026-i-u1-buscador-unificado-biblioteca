<?php
use App\Models\Inventario;
use App\Models\Libro;


$libro = null;
$inventario = null;

if (is_array($resultado) && isset($resultado['libro'])) {
    $libro = $resultado['libro'];
    $inventario = $resultado['inventario'] ?? null;
} elseif ($resultado instanceof Libro) {
    $libro = $resultado;
}
?>

<?php include __DIR__ . '/../layouts/header.php'; ?>

<?php if (!($libro instanceof Libro)): ?>
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                Lo sentimos, no pudimos cargar los detalles de este recurso en este momento. Por favor, intenta de nuevo.
            </div>
            <a href="javascript:history.back()" class="btn btn-outline-secondary btn-lg">Volver</a>
        </div>
    </div>
    <?php include __DIR__ . '/../layouts/footer.php'; ?>
    <?php return; ?>
<?php endif; ?>

<div class="row mt-4">
    <div class="col-md-4 text-center">
        <div class="mx-auto mb-4 shadow-sm border rounded d-flex align-items-center justify-content-center overflow-hidden" style="max-width: 300px; height: 400px; background-color: #f8f9fa;">
            <?php if (!empty($libro->portada_url)): ?>
                <img src="<?= $libro->portada_url ?>" alt="Portada" class="w-100 h-100" style="object-fit: contain;">
            <?php else: ?>
                <div class="d-flex flex-column align-items-center justify-content-center w-100 h-100 text-muted">
                    <i class="bi bi-book" style="font-size: 6rem;"></i>
                    <p class="mt-2 fw-bold mb-0">Sin portada</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="col-md-8">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Buscador</a></li>
            <li class="breadcrumb-item active">Detalles del Libro</li>
          </ol>
        </nav>

        <h1 class="display-4 fw-bold text-primary"><?= $libro->titulo ?></h1>
        <p class="lead">Por: <strong><?= $libro->autor ?></strong></p>
        <hr>

        <div class="row mb-4">
            <div class="col-sm-6">
                <p><strong>ISBN:</strong> <?= $libro->isbn ?></p>
                <p><strong>Categoría:</strong> <?= $libro->categoria ?? 'General' ?></p>
            </div>
            <div class="col-sm-6">
                <span class="badge <?= $inventario && $inventario->hasStock() ? 'bg-success' : 'bg-danger' ?> p-2">
                    <?= $inventario ? $inventario->stock . ' unidades en stock' : 'Sin stock local' ?>
                </span>
            </div>
        </div>

        <div class="card border-primary mb-4 shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">
                <i class="bi bi-geo-alt-fill"></i> ¿Dónde encontrarlo físicamente?
            </div>
            <div class="card-body bg-light">
                <?php if ($inventario): ?>
                    <h5 class="card-title text-dark"><?= $inventario->getUbicacionFormateada() ?></h5>
                    <p class="card-text">Dirígete al <strong><?= $inventario->piso ?></strong> y busca el estante <strong><?= $inventario->estante ?></strong>. Los libros están ordenados por categoría.</p>
                <?php else: ?>
                    <p class="card-text text-muted">Este libro es de consulta externa (Google Books). No tiene ubicación física en nuestra biblioteca.</p>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($libro->digital_link): ?>
            <a href="<?= $libro->digital_link ?>" target="_blank" class="btn btn-info btn-lg me-2">
                <i class="bi bi-cloud-download"></i> Recurso Digital
            </a>
        <?php endif; ?>
        
        <a href="javascript:history.back()" class="btn btn-outline-secondary btn-lg">Volver</a>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>