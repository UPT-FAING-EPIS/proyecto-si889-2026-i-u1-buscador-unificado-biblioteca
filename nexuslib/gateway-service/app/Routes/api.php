<?php

use App\Controllers\GatewayController;
use App\Services\RequestForwarder;

$forwarder = new RequestForwarder();
$controller = new GatewayController($forwarder);

// Obtenemos una ruta relativa al script para soportar subcarpetas en XAMPP
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

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET' && $path === '/search') {
	$controller->search();
	return;
}

// Buscamos la palabra 'api/' seguida de dos bloques de texto (servicio y endpoint)
if (preg_match('/\/api\/([a-zA-Z0-9_-]+)\/([a-zA-Z0-9_-]+)/', $path, $matches)) {
	$service = $matches[1];
	$endpoint = $matches[2];

	$controller->handleRequest($service, $endpoint);
	return;
}

http_response_code(404);
header('Content-Type: application/json; charset=utf-8');
echo json_encode(["error" => "Gateway endpoint not found"]);
