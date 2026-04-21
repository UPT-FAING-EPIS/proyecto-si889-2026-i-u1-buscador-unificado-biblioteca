<?php

namespace App\Models;

class Inventario
{
	public function __construct(
		public int $id_inventario,
		public int $id_libro,
		public string $piso,
		public string $estante,
		public int $stock
	) {
	}

	public function getUbicacionFormateada(): string
	{
		return $this->piso . ' - ' . $this->estante;
	}

	public function hasStock(): bool
	{
		return $this->stock > 0;
	}
}
