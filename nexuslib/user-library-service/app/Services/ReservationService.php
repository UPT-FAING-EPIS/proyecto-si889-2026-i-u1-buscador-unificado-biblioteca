<?php

require_once __DIR__ . '/../Repositories/LibraryRepositoryInterface.php';

class ReservationService
{
	private LibraryRepositoryInterface $repository;
	private string $inventoryReserveUrl = 'http://localhost/nexuslib/inventory-service/public/index.php/internal/reserve';
	private string $inventoryReleaseUrl = 'http://localhost/nexuslib/inventory-service/public/index.php/internal/release';

	public function __construct(LibraryRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	public function reserveBook(ReservedBook $book): bool
	{
		$saved = $this->repository->reserveBook($book);

		if (!$saved) {
			return false;
		}

		$this->notifyInventoryReservation($book);

		return true;
	}

	public function getReservedBooks(string $uuid): array
	{
		return $this->repository->getReservedBooksByUser($uuid);
	}

	public function cancelReservation(string $userUuid, int $registro): array
	{
		$deleted = $this->repository->deleteReservation($userUuid, $registro);

		if (!$deleted) {
			return [
				'success' => false,
				'error' => 'No se pudo eliminar la reserva',
			];
		}

		$this->notifyInventoryRelease($registro);

		return [
			'success' => true,
		];
	}

	private function notifyInventoryReservation(ReservedBook $book): void
	{
		$registro = $book->getRegistro();

		if ($registro <= 0) {
			error_log('ReservationService: invalid registro for inventory sync');
			return;
		}

		$payload = json_encode(['registro' => $registro]);
		if ($payload === false) {
			error_log('ReservationService: failed to encode inventory sync payload');
			return;
		}

		$options = [
			'http' => [
				'method' => 'POST',
				'header' => "Content-Type: application/json\r\n" .
					"Accept: application/json\r\n" .
					"Content-Length: " . strlen($payload) . "\r\n",
				'content' => $payload,
				'timeout' => 3,
				'ignore_errors' => true,
			],
		];

		$context = stream_context_create($options);
		$response = @file_get_contents($this->inventoryReserveUrl, false, $context);

		if ($response === false) {
			$error = error_get_last();
			error_log('ReservationService: inventory sync failed' . ($error['message'] ?? ''));
		}
	}

	private function notifyInventoryRelease(int $registro): void
	{
		if ($registro <= 0) {
			error_log('ReservationService: invalid registro for inventory release sync');
			return;
		}

		$payload = json_encode(['registro' => $registro]);
		if ($payload === false) {
			error_log('ReservationService: failed to encode inventory release payload');
			return;
		}

		$options = [
			'http' => [
				'method' => 'POST',
				'header' => "Content-Type: application/json\r\n" .
					"Accept: application/json\r\n" .
					"Content-Length: " . strlen($payload) . "\r\n",
				'content' => $payload,
				'timeout' => 3,
				'ignore_errors' => true,
			],
		];

		$context = stream_context_create($options);
		$response = @file_get_contents($this->inventoryReleaseUrl, false, $context);

		if ($response === false) {
			$error = error_get_last();
			error_log('ReservationService: inventory release sync failed' . ($error['message'] ?? ''));
		}
	}
}
