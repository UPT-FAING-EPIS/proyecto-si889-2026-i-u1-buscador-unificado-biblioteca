<?php

// Front controller para auth-service

// Cargar componentes (sin autoload)
require_once __DIR__ . '/../app/Config/Database.php';
require_once __DIR__ . '/../app/Models/User.php';
require_once __DIR__ . '/../app/Repositories/UserRepository.php';
require_once __DIR__ . '/../app/Services/SessionService.php';
require_once __DIR__ . '/../app/Services/AuthService.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
/** routes */
$routes = require __DIR__ . '/../app/Routes/api.php';

// Crear dependencias
try {
	$pdo = Database::getConnection();
} catch (\Throwable $e) {
	http_response_code(500);
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode(['error' => 'DB connection error'], JSON_UNESCAPED_UNICODE);
	exit;
}

$repo = new UserRepository($pdo);
$session = new SessionService();
$authService = new AuthService($repo, $session);
$controller = new AuthController($authService);

// Resolver ruta
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$lookup = $method . ' ' . $path;

if (isset($routes[$lookup])) {
	$action = $routes[$lookup];
	if (method_exists($controller, $action)) {
		$controller->{$action}();
		exit;
	}
}

http_response_code(404);
header('Content-Type: application/json; charset=utf-8');
echo json_encode(['error' => 'Not Found'], JSON_UNESCAPED_UNICODE);
exit;

