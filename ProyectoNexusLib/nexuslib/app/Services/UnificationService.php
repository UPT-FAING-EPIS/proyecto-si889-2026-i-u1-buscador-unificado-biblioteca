<?php

namespace App\Services;

use App\Adapters\GoogleBooksAdapter;
use App\Adapters\MySQLLocalAdapter;
use App\Models\Libro;

class UnificationService
{
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

	public function busquedaInteligente(string $termino, array $filtros = []): array
	{
		$resultados = [];
		$resultadosLocales = $this->localAdapter->buscarGeneral($termino);

		if ($resultadosLocales !== null && $resultadosLocales !== []) {
			$resultados = array_merge($resultados, $resultadosLocales);
		}

		$terminoNormalizado = trim($termino);
		$esIsbn = ctype_digit($terminoNormalizado)
			&& (strlen($terminoNormalizado) === 10 || strlen($terminoNormalizado) === 13);

		if ($esIsbn) {
			$libroGoogle = $this->googleBooksAdapter->buscarPorIsbn($terminoNormalizado);

			if ($libroGoogle !== null) {
				$resultados[] = [
					'libro' => $libroGoogle,
					'inventario' => null,
				];
			}
		} else {
			$librosGoogle = $this->googleBooksAdapter->buscarGeneral($terminoNormalizado);

			foreach ($librosGoogle as $libroGoogle) {
				$resultados[] = [
					'libro' => $libroGoogle,
					'inventario' => null,
				];
			}
		}

		$origen = strtolower((string) ($filtros['origen'] ?? 'todos'));
		$orden = strtolower((string) ($filtros['orden'] ?? 'relevancia'));
		$soloDisponibles = !empty($filtros['solo_disponibles']);

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

		return $resultadosFiltrados;
	}
}
