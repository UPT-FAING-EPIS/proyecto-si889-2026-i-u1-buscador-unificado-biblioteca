<?php

namespace App\Strategies;

use App\Models\Libro;
use App\Services\UnificationService;

class FilterByAuthor implements SearchStrategy
{
	public function __construct(private UnificationService $service)
	{
	}

	public function buscar(string $termino): array|Libro|null
	{
		return $this->service->obtenerPorAutor($termino);
	}
}
