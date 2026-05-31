<?php

require_once __DIR__ . '/../Repositories/InventoryRepositoryInterface.php';

class InventoryService
{
	private InventoryRepositoryInterface $repository;

	public function __construct(InventoryRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	public function searchCatalog(string $keyword): array
	{
		return $this->repository->searchResources($keyword);
	}

	public function getExemplares(string $codigo): array
	{
		return $this->repository->getExemplaresByCodigo($codigo);
	}
}
