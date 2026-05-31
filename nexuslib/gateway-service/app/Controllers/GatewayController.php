<?php

namespace App\Controllers;

use App\Services\SearchAggregator;
use App\Services\RequestForwarder;

class GatewayController
{
	private RequestForwarder $forwarder;

	public function __construct(RequestForwarder $forwarder)
	{
		$this->forwarder = $forwarder;
	}

	/**
	 * Maneja la petición hacia un microservicio destino.
	 * @param string $service
	 * @param string $endpoint
	 */
	public function handleRequest(string $service, string $endpoint): void
	{
		$services = require __DIR__ . '/../Config/services.php';

		if (!isset($services[$service])) {
			http_response_code(404);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode(['error' => 'Service not found']);
			return;
		}

		$base = rtrim($services[$service], '/');
		$targetUrl = $base . '/' . ltrim($endpoint, '/');

		$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
		$allHeaders = function_exists('getallheaders') ? getallheaders() : [];
		$body = file_get_contents('php://input');

		// Convert headers associative to simple array of strings
		$hdrs = [];
		if (is_array($allHeaders)) {
			foreach ($allHeaders as $k => $v) {
				if (is_int($k)) {
					$hdrs[] = $v;
				} else {
					$hdrs[$k] = $v;
				}
			}
		}

		$resp = $this->forwarder->forward($method, $targetUrl, $hdrs, $body);

		http_response_code((int)$resp['status']);
		// Passthrough content (assume already JSON or appropriate)
		echo $resp['body'];
	}

	public function search(): void
	{
		$query = trim($_GET['q'] ?? '');

		if ($query === '') {
			http_response_code(400);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode(['error' => 'Missing q parameter'], JSON_UNESCAPED_UNICODE);
			return;
		}

		$aggregator = new SearchAggregator();
		$results = $aggregator->searchAll($query);

		http_response_code(200);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode(['data' => $results], JSON_UNESCAPED_UNICODE);
	}
}

