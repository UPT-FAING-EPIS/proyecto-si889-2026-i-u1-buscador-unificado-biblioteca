<?php

namespace App\Models;

class Libro
{
	public function __construct(
		public readonly int $id_libro,
		public readonly string $titulo,
		public readonly string $autor,
		public readonly string $isbn,
		public readonly ?string $categoria,
		public readonly ?string $digital_link,
		public readonly ?string $portada_url,
		public readonly ?string $descripcion = null,
		public readonly ?int $num_paginas = null,
		public readonly array|null $categorias = null,
		public readonly bool $embeddable = false,
		public readonly ?string $fuente_lectura = null,
		public readonly ?string $openlibrary_olid = null
	) {
	}

	public static function fromArray(array $data): self
	{
		return new self(
			id_libro: (int) ($data['id_libro'] ?? 0),
			titulo: (string) ($data['titulo'] ?? ''),
			autor: (string) ($data['autor'] ?? ''),
			isbn: (string) ($data['isbn'] ?? ''),
			categoria: isset($data['categoria']) ? (string) $data['categoria'] : null,
			digital_link: isset($data['digital_link']) ? (string) $data['digital_link'] : null,
			portada_url: isset($data['portada_url']) ? (string) $data['portada_url'] : null,
			descripcion: isset($data['descripcion']) ? (string) $data['descripcion'] : null,
			num_paginas: isset($data['num_paginas']) ? (int) $data['num_paginas'] : null,
			categorias: isset($data['categorias']) && is_array($data['categorias']) ? $data['categorias'] : (isset($data['categorias']) ? [$data['categorias']] : null),
			embeddable: (bool) ($data['embeddable'] ?? false),
			fuente_lectura: isset($data['fuente_lectura']) ? (string) $data['fuente_lectura'] : null,
			openlibrary_olid: isset($data['openlibrary_olid']) ? (string) $data['openlibrary_olid'] : null,
		);
	}
}
