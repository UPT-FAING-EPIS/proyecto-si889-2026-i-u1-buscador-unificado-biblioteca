<?php

require_once __DIR__ . '/../Models/SavedBook.php';
require_once __DIR__ . '/../Models/ReservedBook.php';
require_once __DIR__ . '/../Services/SavedBooksService.php';
require_once __DIR__ . '/../Services/ReservationService.php';

class LibraryController
{
	private SavedBooksService $savedBooksService;
	private ReservationService $reservationService;

	public function __construct(SavedBooksService $savedBooksService, ReservationService $reservationService)
	{
		$this->savedBooksService = $savedBooksService;
		$this->reservationService = $reservationService;
	}

	public function save(): void
	{
		$data = $this->getInputData();
		$userUuid = trim($data['user_uuid'] ?? ($_GET['user_uuid'] ?? ''));
		$codigo = trim($data['codigo'] ?? ($_GET['codigo'] ?? ''));

		if ($userUuid === '' || $codigo === '') {
			$this->jsonResponse(['error' => 'Faltan datos requeridos'], 400);
			return;
		}

		$book = new SavedBook([
			'user_uuid' => $userUuid,
			'codigo' => $codigo,
		]);

		if (!$this->savedBooksService->saveBook($book)) {
			$this->jsonResponse(['error' => 'No se pudo guardar el libro'], 400);
			return;
		}

		$this->jsonResponse(['success' => true], 201);
	}

	public function getSaved(): void
	{
		$userUuid = trim($_GET['user_uuid'] ?? '');

		if ($userUuid === '') {
			$this->jsonResponse(['error' => 'Falta user_uuid'], 400);
			return;
		}

		$books = $this->savedBooksService->getSavedBooks($userUuid);
		$payload = array_map([$this, 'savedBookToArray'], $books);

		$this->jsonResponse(['data' => $payload], 200);
	}

	public function reserve(): void
	{
		$data = $this->getInputData();
		$userUuid = trim($data['user_uuid'] ?? ($_GET['user_uuid'] ?? ''));
		$registro = isset($data['registro']) ? (int) $data['registro'] : (int) ($_GET['registro'] ?? 0);
		$estado = trim($data['estado'] ?? ($_GET['estado'] ?? 'Pendiente'));

		if ($userUuid === '' || $registro <= 0) {
			$this->jsonResponse(['error' => 'Faltan datos requeridos'], 400);
			return;
		}

		$book = new ReservedBook([
			'user_uuid' => $userUuid,
			'registro' => $registro,
			'estado' => $estado === '' ? 'Pendiente' : $estado,
		]);

		if (!$this->reservationService->reserveBook($book)) {
			$this->jsonResponse(['error' => 'No se pudo reservar el ejemplar'], 400);
			return;
		}

		$this->jsonResponse(['success' => true], 201);
	}

	public function cancel(): void
	{
		$data = $this->getInputData();
		$userUuid = trim($data['user_uuid'] ?? ($_GET['user_uuid'] ?? ''));
		$registro = isset($data['registro']) ? (int) $data['registro'] : (int) ($_GET['registro'] ?? 0);

		if ($userUuid === '' || $registro <= 0) {
			$this->jsonResponse(['error' => 'Faltan datos requeridos'], 400);
			return;
		}

		$result = $this->reservationService->cancelReservation($userUuid, $registro);
		$statusCode = !empty($result['success']) ? 200 : 400;
		$this->jsonResponse($result, $statusCode);
	}

	public function getReserved(): void
	{
		$userUuid = trim($_GET['user_uuid'] ?? '');

		if ($userUuid === '') {
			$this->jsonResponse(['error' => 'Falta user_uuid'], 400);
			return;
		}

		$books = $this->reservationService->getReservedBooks($userUuid);
		$payload = array_map([$this, 'reservedBookToArray'], $books);

		$this->jsonResponse(['data' => $payload], 200);
	}

	private function getInputData(): array
	{
		$raw = file_get_contents('php://input');
		if ($raw === false || trim($raw) === '') {
			return [];
		}

		$decoded = json_decode($raw, true);
		return is_array($decoded) ? $decoded : [];
	}

	private function jsonResponse(array $data, int $statusCode = 200): void
	{
		http_response_code($statusCode);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	private function savedBookToArray(SavedBook $book): array
	{
		return [
			'id' => $book->getId(),
			'user_uuid' => $book->getUserUuid(),
			'codigo' => $book->getCodigo(),
			'fecha_guardado' => $book->getFechaGuardado(),
		];
	}

	private function reservedBookToArray(ReservedBook $book): array
	{
		return [
			'id' => $book->getId(),
			'user_uuid' => $book->getUserUuid(),
			'registro' => $book->getRegistro(),
			'estado' => $book->getEstado(),
			'fecha_reserva' => $book->getFechaReserva(),
		];
	}
}
