<?php

namespace App\Controllers;

use App\Adapters\GoogleBooksAdapter;
use App\Adapters\MySQLLocalAdapter;
use App\Services\UnificationService;

class SearchController
{
	public function index(): void
	{
		$action = (string) ($_GET['action'] ?? '');
		$esVistaDetalles = $action === 'details';
		$seIntentoBusqueda = isset($_GET['q']);
		$resultados = [];
		$resultado = null;
		$termino = trim((string) ($_GET['q'] ?? ''));
		$origen = trim((string) ($_GET['origen'] ?? 'todos'));
		$orden = trim((string) ($_GET['orden'] ?? 'relevancia'));
		$soloDisponibles = isset($_GET['disponible']) || isset($_GET['solo_disponibles']);
		$error = null;

		if ($seIntentoBusqueda) {
			if ($termino === '') {
				$error = 'Debes proporcionar un termino para realizar la busqueda.';
			} else {
			$service = new UnificationService(
				new MySQLLocalAdapter(),
				new GoogleBooksAdapter()
			);

			$filtros = [
				'origen' => $origen,
				'orden' => $orden,
				'solo_disponibles' => $soloDisponibles,
			];

			$resultados = $service->busquedaInteligente($termino, $filtros);

			if ($esVistaDetalles && isset($resultados[0])) {
				$resultado = $resultados[0];
			}

			if ($resultados === []) {
				$error = 'No se encontro informacion para el termino proporcionado.';
			}
			}
		}

		$view = $esVistaDetalles ? 'details/index.php' : 'search/index.php';
        require __DIR__ . "/../../src/Views/$view";
	}
}
