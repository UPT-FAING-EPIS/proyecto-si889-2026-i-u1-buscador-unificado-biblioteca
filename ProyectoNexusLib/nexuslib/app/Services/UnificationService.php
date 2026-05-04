<?php

namespace App\Services;

use App\Adapters\GoogleBooksAdapter;
use App\Adapters\MySQLLocalAdapter;
use App\Models\Libro;

class UnificationService
{
	private const MAPEO_CATEGORIAS = [
		'Biografía' => 'biography',
		'Ciencia ficción' => 'science fiction',
		'Cuentos' => 'short stories',
		'Diccionarios' => 'dictionaries',
		'Ensayos' => 'essays',
		'Filosofía' => 'philosophy',
		'Historia' => 'history',
		'Novelas' => 'fiction',
		'Poesía' => 'poetry'
	];

	public function __construct(
		private MySQLLocalAdapter $localAdapter,
		private GoogleBooksAdapter $googleBooksAdapter
	) {
	}

	public function obtenerLibroCompleto(string $isbn): array|Libro|null
	{
		$resultadoLocal = $this->localAdapter->buscarPorIsbn($isbn);

		if ($resultadoLocal !== null) {
			return $resultadoLocal;
		}

		$libroGoogle = $this->googleBooksAdapter->buscarPorIsbn($isbn);

		if ($libroGoogle !== null) {
			return $libroGoogle;
		}

		return null;
	}

	public function obtenerPorAutor(string $autor): ?array
	{
		return $this->localAdapter->buscarPorAutor($autor);
	}

	public function getCombinedBooksByCategory(string $categoria, int $limit = 20): array
	{
		$limit = max(1, min(40, $limit));
		$categoria = $this->limpiarCategoria($categoria);
		$terminoGoogle = self::MAPEO_CATEGORIAS[$categoria] ?? $categoria;

		$resultados = [];
		$librosLocales = $this->localAdapter->buscarPorCategoriaExacta($categoria, $limit);

		foreach ($librosLocales as $item) {
			$libro = $item['libro'] ?? null;
			if (!$libro instanceof Libro) {
				continue;
			}

			$libro->origen = 'local';
			$resultados[] = [
				'libro' => $libro,
				'inventario' => $item['inventario'] ?? null,
			];
		}

		$localCount = count($resultados);
		$faltantes = max(0, $limit - $localCount);

		if ($faltantes > 0) {
			$queryGoogle = 'subject:"' . $terminoGoogle . '"';
			$librosGoogle = $this->googleBooksAdapter->buscarGeneral($queryGoogle, $faltantes, 0);

			foreach ($librosGoogle as $libroGoogle) {
				if (!$libroGoogle instanceof Libro) {
					continue;
				}

				$libroGoogle->origen = 'google';
				$resultados[] = [
					'libro' => $libroGoogle,
					'inventario' => null,
				];
			}
		}

		return array_slice($resultados, 0, $limit);
	}

	public function buscarPorCategoria(string $termino, int $limit = 10, int $startIndex = 0): array
	{
		$limit = max(1, min(40, $limit));
		$startIndex = max(0, $startIndex);
		$termino = trim($termino);

		if ($termino === '') {
			return [];
		}

		return $this->busquedaInteligente('subject:"' . $termino . '"', [
			'origen' => 'todos',
			'limit' => $limit,
			'start_index' => $startIndex,
		]);
	}

	private function limpiarCategoria(string $categoria): string
	{
		$categoria = trim(preg_replace('/\s+/', ' ', $categoria) ?? $categoria);

		return $categoria;
	}

	private function normalizarTexto(string $texto): string
	{
		$texto = trim($texto);
		$textoMinuscula = mb_strtolower($texto, 'UTF-8');
		$textoAscii = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $textoMinuscula);

		return $textoAscii === false ? $textoMinuscula : strtolower($textoAscii);
	}

	public function buscarPorAutor(string $query, int $limit = 20, int $startIndex = 0): array
	{
		$limit = max(1, min(40, $limit));
		$startIndex = max(0, $startIndex);
		$query = trim($query);

		if ($query === '') {
			return [];
		}

		$resultados = [];
		$isFirstPage = ($startIndex === 0);

		if ($isFirstPage) {
			$resultadosLocales = $this->localAdapter->searchByAuthor($query, $limit);

			if ($resultadosLocales !== [] && $resultadosLocales !== null) {
				foreach ($resultadosLocales as &$item) {
					$libro = $item['libro'] ?? null;
					if ($libro instanceof Libro) {
						$libro->origen = 'local';
					}
				}
				unset($item);
				$resultados = array_merge($resultados, $resultadosLocales);
			}

			$localCount = count($resultados);
			$faltantes = max(0, $limit - $localCount);

			if ($faltantes > 0) {
				$queryGoogle = 'inauthor:"' . $query . '"';
				$librosGoogle = $this->googleBooksAdapter->buscarGeneral($queryGoogle, $faltantes, 0);

				foreach ($librosGoogle as $libroGoogle) {
					if (!$libroGoogle instanceof Libro) {
						continue;
					}

					$libroGoogle->origen = 'google';
					$resultados[] = [
						'libro' => $libroGoogle,
						'inventario' => null,
					];
				}
			}
		} else {
			$queryGoogle = 'inauthor:"' . $query . '"';
			$librosGoogle = $this->googleBooksAdapter->buscarGeneral($queryGoogle, $limit, $startIndex);

			foreach ($librosGoogle as $libroGoogle) {
				if (!$libroGoogle instanceof Libro) {
					continue;
				}

				$libroGoogle->origen = 'google';
				$resultados[] = [
					'libro' => $libroGoogle,
					'inventario' => null,
				];
			}
		}

		return array_slice($resultados, 0, $limit);
	}

	public function buscarPorTitulo(string $query, int $limit = 20, int $startIndex = 0): array
	{
		$limit = max(1, min(40, $limit));
		$startIndex = max(0, $startIndex);
		$query = trim($query);

		if ($query === '') {
			return [];
		}

		$resultados = [];
		$isFirstPage = ($startIndex === 0);

		if ($isFirstPage) {
			$resultadosLocales = $this->localAdapter->searchByTitle($query, $limit);

			if ($resultadosLocales !== [] && $resultadosLocales !== null) {
				foreach ($resultadosLocales as &$item) {
					$libro = $item['libro'] ?? null;
					if ($libro instanceof Libro) {
						$libro->origen = 'local';
					}
				}
				unset($item);
				$resultados = array_merge($resultados, $resultadosLocales);
			}

			$localCount = count($resultados);
			$faltantes = max(0, $limit - $localCount);

			if ($faltantes > 0) {
				$queryGoogle = 'intitle:"' . $query . '"';
				$librosGoogle = $this->googleBooksAdapter->buscarGeneral($queryGoogle, $faltantes, 0);

				foreach ($librosGoogle as $libroGoogle) {
					if (!$libroGoogle instanceof Libro) {
						continue;
					}

					$libroGoogle->origen = 'google';
					$resultados[] = [
						'libro' => $libroGoogle,
						'inventario' => null,
					];
				}
			}
		} else {
			$queryGoogle = 'intitle:"' . $query . '"';
			$librosGoogle = $this->googleBooksAdapter->buscarGeneral($queryGoogle, $limit, $startIndex);

			foreach ($librosGoogle as $libroGoogle) {
				if (!$libroGoogle instanceof Libro) {
					continue;
				}

				$libroGoogle->origen = 'google';
				$resultados[] = [
					'libro' => $libroGoogle,
					'inventario' => null,
				];
			}
		}

		return array_slice($resultados, 0, $limit);
	}

	public function getBookById(string $id): array|Libro|null
	{
		$id = trim($id);

		// Detect ISBN (10 or 13 digits)
		$plain = preg_replace('/[^0-9Xx]/', '', $id);
		if (ctype_digit($plain) && (strlen($plain) === 10 || strlen($plain) === 13)) {
			// try local first
			$local = $this->localAdapter->buscarPorIsbn($plain);
			if ($local !== null && isset($local['libro'])) {
				return $local['libro'];
			}

			// fallback to Google by ISBN
			return $this->googleBooksAdapter->buscarPorIsbn($plain);
		}

		// Otherwise, try as Google volume ID
		$fromGoogle = $this->googleBooksAdapter->buscarPorVolumeId($id);
		if ($fromGoogle !== null) {
			return $fromGoogle;
		}

		// Last attempt: try local general search (id might be a DB id or other key)
		$localResults = $this->localAdapter->buscarGeneral($id, 1);
		if (!empty($localResults) && isset($localResults[0]['libro'])) {
			return $localResults[0]['libro'];
		}

		return null;
	}

	public function getLocalBookById(int|string $id): ?array
	{
		return $this->localAdapter->buscarPorId($id);
	}

	public function busquedaInteligente(string $termino, array $filtros = []): array
	{
		$origen = strtolower((string) ($filtros['origen'] ?? 'todos'));
		$orden = strtolower((string) ($filtros['orden'] ?? 'relevancia'));
		$soloDisponibles = !empty($filtros['solo_disponibles']);
		$limit = (int) ($filtros['limit'] ?? 10);
		$limit = max(1, min(40, $limit));

		$startIndex = (int) ($filtros['start_index'] ?? 0);
		$isFirstPage = ($startIndex === 0);

		$resultados = [];
		$consultarLocal = !in_array($origen, ['digital', 'digitales'], true) && $isFirstPage;
		$consultarGoogle = !in_array($origen, ['local', 'fisicos'], true);

		if ($consultarLocal) {
			$resultadosLocales = $this->localAdapter->buscarGeneral($termino, $limit);

			if ($resultadosLocales !== null && $resultadosLocales !== []) {
				foreach ($resultadosLocales as &$itemLocal) {
					$libroLocal = $itemLocal['libro'] ?? null;
					if ($libroLocal instanceof Libro) {
						$libroLocal->origen = 'local';
					}
				}
				unset($itemLocal);

				$resultados = array_merge($resultados, $resultadosLocales);
			}
		}

		$terminoNormalizado = trim($termino);
		$esIsbn = ctype_digit($terminoNormalizado)
			&& (strlen($terminoNormalizado) === 10 || strlen($terminoNormalizado) === 13);

		if ($consultarGoogle && $esIsbn) {
			$libroGoogle = $this->googleBooksAdapter->buscarPorIsbn($terminoNormalizado);

			if ($libroGoogle !== null) {
				$resultados[] = [
					'libro' => $libroGoogle,
					'inventario' => null,
				];
			}
		} elseif ($consultarGoogle) {
			$librosGoogle = $this->googleBooksAdapter->buscarGeneral($terminoNormalizado, $limit, $startIndex);

			foreach ($librosGoogle as $libroGoogle) {
				$resultados[] = [
					'libro' => $libroGoogle,
					'inventario' => null,
				];
			}
		}

		$resultadosFiltrados = array_filter(
			$resultados,
			static function (array $item) use ($origen, $soloDisponibles): bool {
				$libro = $item['libro'] ?? null;
				$inventario = $item['inventario'] ?? null;

				if (!$libro instanceof Libro) {
					return false;
				}

				$esLocal = $inventario !== null;
				$esDigital = $inventario === null || !empty($libro->digital_link);

				if (($origen === 'local' || $origen === 'fisicos') && !$esLocal) {
					return false;
				}

				if (($origen === 'digital' || $origen === 'digitales') && !$esDigital) {
					return false;
				}

				if ($soloDisponibles && $esLocal && isset($inventario->stock) && (int) $inventario->stock <= 0) {
					return false;
				}

				return true;
			}
		);

		$resultadosFiltrados = array_values($resultadosFiltrados);

		if ($orden === 'titulo') {
			usort(
				$resultadosFiltrados,
				static fn(array $a, array $b): int => strcasecmp(
					(string) (($a['libro']->titulo ?? '')),
					(string) (($b['libro']->titulo ?? ''))
				)
			);
		}

		return array_slice($resultadosFiltrados, 0, $limit);
	}
}
