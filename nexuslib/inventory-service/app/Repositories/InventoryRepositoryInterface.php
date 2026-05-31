<?php

interface InventoryRepositoryInterface
{
	public function searchResources(string $keyword): array;

	public function getExemplaresByCodigo(string $codigo): array;

	// Devuelve el estado actual del ejemplar identificado por registro, o null si no existe
	public function getEstadoByRegistro(int $registro): ?string;

	// Actualiza el estado del ejemplar identificado por registro. Devuelve true si se actualizó al menos una fila.
	public function updateEstadoByRegistro(int $registro, string $estado): bool;
}
