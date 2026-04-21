<?php
namespace App\Strategies;

use App\Models\Libro;

interface SearchStrategy {
    public function buscar(string $termino): array|Libro|null;
}