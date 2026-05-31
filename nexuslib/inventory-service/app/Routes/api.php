<?php

header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Compute a path relative to the current script to support XAMPP subfolders.
$path = '';
if (!empty($_SERVER['PATH_INFO'])) {
	$path = $_SERVER['PATH_INFO'];
} else {
	$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
	$script = $_SERVER['SCRIPT_NAME'] ?? '';

	if ($script !== '' && strpos($requestPath, $script) === 0) {
		$path = substr($requestPath, strlen($script));
	} else {
		$scriptDir = rtrim(dirname($script), '/\\');
		if ($scriptDir !== '' && strpos($requestPath, $scriptDir) === 0) {
			$path = substr($requestPath, strlen($scriptDir));
		} else {
			$path = $requestPath;
		}
	}
}

$path = ($path === '' || $path === false) ? '/' : '/' . ltrim($path, '/');

// Match the internal reserve endpoint anchored to the path portion only
if ($method === 'POST' && $path === '/internal/reserve') {
	$raw = file_get_contents('php://input');
	$data = json_decode($raw, true) ?: [];
	$registro = isset($data['registro']) ? (int) $data['registro'] : 0;

	if ($registro <= 0) {
		http_response_code(400);
		echo json_encode(['error' => 'Missing or invalid registro']);
		return;
	}

	try {
		require_once __DIR__ . '/../Config/Database.php';
		require_once __DIR__ . '/../Repositories/InventoryRepositoryInterface.php';
		require_once __DIR__ . '/../Repositories/InventoryRepository.php';
		require_once __DIR__ . '/../Services/AvailabilityService.php';

		$pdo = Database::getConnection();
		$repo = new InventoryRepository($pdo);
		$service = new AvailabilityService($repo);

		$ok = $service->marcarComoReservado($registro);

		if ($ok) {
			http_response_code(200);
			echo json_encode(['success' => true]);
			return;
		}

		http_response_code(400);
		echo json_encode(['error' => 'Registro not found or cannot be reserved']);
		return;
	} catch (Throwable $e) {
		http_response_code(500);
		echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
		return;
	}
}

if ($method === 'POST' && $path === '/internal/release') {
	$raw = file_get_contents('php://input');
	$data = json_decode($raw, true) ?: [];
	$registro = isset($data['registro']) ? (int) $data['registro'] : 0;

	if ($registro <= 0) {
		http_response_code(400);
		echo json_encode(['error' => 'Missing or invalid registro']);
		return;
	}

	try {
		require_once __DIR__ . '/../Config/Database.php';
		require_once __DIR__ . '/../Repositories/InventoryRepositoryInterface.php';
		require_once __DIR__ . '/../Repositories/InventoryRepository.php';
		require_once __DIR__ . '/../Services/AvailabilityService.php';

		$pdo = Database::getConnection();
		$repo = new InventoryRepository($pdo);
		$service = new AvailabilityService($repo);

		$ok = $service->marcarComoDisponible($registro);

		if ($ok) {
			http_response_code(200);
			echo json_encode(['success' => true]);
			return;
		}

		http_response_code(400);
		echo json_encode(['error' => 'Registro not found or cannot be released']);
		return;
	} catch (Throwable $e) {
		http_response_code(500);
		echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
		return;
	}
}

http_response_code(404);
echo json_encode(['error' => 'Internal route not found']);
