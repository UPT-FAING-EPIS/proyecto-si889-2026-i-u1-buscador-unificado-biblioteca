
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Resultados de búsqueda</h2>
        
        <?php if (empty($resultados)): ?>
            <div class="alert alert-dark">No se encontraron resultados.</div>
        <?php else: ?>
            <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                <?php foreach ($resultados as $item):
                    $libro = $item['libro'];
                    $cardItem = [
                        'titulo' => $libro->titulo,
                        'autor' => $libro->autor,
                        'fuente' => 'Digital',
                        'portada_url' => $libro->portada_url ?? null,
                        'doi' => $libro->doi ?? null,
                        'eid' => $libro->eid ?? null,
                        'google_id' => $libro->google_id ?? null,
                        'isbn' => $libro->isbn ?? null,
                        'id_libro' => $libro->id_libro ?? null,
                        'origen' => $libro->origen ?? null,
                        'link' => $libro->google_id ? 'https://books.google.com/books?id=' . $libro->google_id : '#',
                    ];
                    $item = $cardItem;
                    include __DIR__ . '/../layouts/card_libro.php';
                endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
