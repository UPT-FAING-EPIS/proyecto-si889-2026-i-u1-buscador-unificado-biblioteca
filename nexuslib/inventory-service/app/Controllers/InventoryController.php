<?php

require_once __DIR__ . '/../Services/InventoryService.php';

class InventoryController
{
	private InventoryService $service;

	public function __construct(InventoryService $service)
	{
		$this->service = $service;
	}

	public function search(): void
	{
		$keyword = trim($_GET['q'] ?? '');

		if ($keyword === '') {
			$this->jsonResponse(['error' => 'Missing q parameter'], 400);
			return;
		}

		$results = $this->service->searchCatalog($keyword);
		$payload = array_map([$this, 'resourceToArray'], $results);

		$this->jsonResponse(['data' => $payload], 200);
	}

	public function details(): void
	{
		$codigo = trim($_GET['codigo'] ?? '');

		if ($codigo === '') {
			$this->jsonResponse(['error' => 'Missing codigo parameter'], 400);
			return;
		}

		$results = $this->service->getExemplares($codigo);
		$payload = array_map([$this, 'resourceToArray'], $results);

		$this->jsonResponse(['data' => $payload], 200);
	}

	private function jsonResponse(array $data, int $statusCode = 200): void
	{
		http_response_code($statusCode);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	private function resourceToArray(Resource $resource): array
	{
		return [
			'registro' => $resource->getRegistro(),
			'codigo' => $resource->getCodigo(),
			'titulo' => $resource->getTitulo(),
			'autor' => $resource->getAutor(),
			'biblioteca' => $resource->getBiblioteca(),
			'tipo' => $resource->getTipo(),
			'procedencia' => $resource->getProcedencia(),
			'fecha' => $resource->getFecha(),
			'estado' => $resource->getEstado(),
		];
	}
}
