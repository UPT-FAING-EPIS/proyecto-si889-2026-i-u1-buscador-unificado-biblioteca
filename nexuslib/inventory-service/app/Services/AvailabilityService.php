<?php

require_once __DIR__ . '/../Repositories/InventoryRepositoryInterface.php';

class AvailabilityService
{
	private InventoryRepositoryInterface $repository;

	public function __construct(InventoryRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Marca un ejemplar como 'Reservado'.
	 * - Si no existe el registro, devuelve false.
	 * - Si ya está 'Reservado', devuelve true (idempotencia).
	 * - Si estaba en otro estado y se actualiza correctamente, devuelve true.
	 */
	public function marcarComoReservado(int $registro): bool
	{
		$current = $this->repository->getEstadoByRegistro($registro);

		if ($current === null) {
			return false;
		}

		if (trim($current) === 'Reservado') {
			return true;
		}

		return $this->repository->updateEstadoByRegistro($registro, 'Reservado');
	}

	/**
	 * Marca un ejemplar como 'Disponible'.
	 * - Si no existe el registro, devuelve false.
	 * - Si ya está 'Disponible', devuelve true (idempotencia).
	 * - Si estaba en otro estado y se actualiza correctamente, devuelve true.
	 */
	public function marcarComoDisponible(int $registro): bool
	{
		$current = $this->repository->getEstadoByRegistro($registro);

		if ($current === null) {
			return false;
		}

		if (trim($current) === 'Disponible') {
			return true;
		}

		return $this->repository->updateEstadoByRegistro($registro, 'Disponible');
	}
}
