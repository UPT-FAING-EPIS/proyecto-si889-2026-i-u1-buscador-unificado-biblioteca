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
		public readonly ?string $portada_url
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
		);
	}
}
