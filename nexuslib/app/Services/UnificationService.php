<?php

namespace App\Services;

use App\Adapters\GoogleBooksAdapter;

class UnificationService
{
    private const MAPEO_CATEGORIAS = [
        'Biografía' => 'biography',
        'Ciencia ficción' => 'science fiction',
        'Cuentos' => 'short stories',
        'Ensayos' => 'essays',
        'Filosofía' => 'philosophy',
        'Historia' => 'history',
        'Novelas' => 'fiction',
        'Poesía' => 'poetry'
    ];

    public function __construct(
        private GoogleBooksAdapter $googleBooksAdapter
    ) {}

    public function getCombinedBooksByCategory(string $categoria, int $limit = 20): array
    {
        $limit = max(1, min(40, $limit));
        $terminoGoogle = self::MAPEO_CATEGORIAS[$categoria] ?? $categoria;
        $resultados = [];

        $librosGoogle = $this->googleBooksAdapter->buscarGeneral('subject:"' . $terminoGoogle . '"', $limit, 0);
        foreach ($librosGoogle as $libro) {
            $libro->origen = 'google';
            $resultados[] = ['libro' => $libro, 'inventario' => null];
        }
        
        return array_slice($resultados, 0, $limit);
    }

    public function buscarPorAutor(string $query, int $limit = 20, int $startIndex = 0): array
    {
        $resultados = [];

        $google = $this->googleBooksAdapter->buscarGeneral('inauthor:"' . $query . '"', $limit, $startIndex);
        foreach ($google as $libro) {
            $libro->origen = 'google';
            $resultados[] = ['libro' => $libro, 'inventario' => null];
        }
        
        return $resultados;
    }

    public function buscarPorTitulo(string $query, int $limit = 20, int $startIndex = 0): array
    {
        $resultados = [];

        $google = $this->googleBooksAdapter->buscarGeneral('intitle:"' . $query . '"', $limit, $startIndex);
        foreach ($google as $libro) {
            $libro->origen = 'google';
            $resultados[] = ['libro' => $libro, 'inventario' => null];
        }
        
        return $resultados;
    }

    public function busquedaInteligente(string $termino, array $filtros = []): array
    {
        $limit = min(40, max(1, $filtros['limit'] ?? 10));
        $resultados = [];

        $google = $this->googleBooksAdapter->buscarGeneral($termino, $limit);
        foreach ($google as $libro) {
            $libro->origen = 'google';
            $resultados[] = ['libro' => $libro, 'inventario' => null];
        }
        
        return $resultados;
    }
}
