<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;

class SearchAggregator
{
	private MatchService $matchService;

	public function __construct(?MatchService $matchService = null)
	{
		$this->matchService = $matchService ?? new MatchService();
	}

	public function searchAll(string $query): array
	{
		try {
			$services = require __DIR__ . '/../Config/services.php';
			$targets = [
				$services['inventory'] ?? null,
				$services['alpha'] ?? null,
				$services['elibro'] ?? null,
			];
			$serviceNames = [
				'inventory',
				'alpha',
				'elibro',
			];

			$client = new Client();
			$promises = [];

			foreach ($targets as $index => $baseUrl) {
				if (!is_string($baseUrl) || $baseUrl === '') {
					continue;
				}

				$serviceName = $serviceNames[$index] ?? (string) $index;
				$promises[$serviceName] = $client->getAsync(rtrim($baseUrl, '/') . '/search?q=' . urlencode($query));
			}

			$settled = Utils::settle($promises)->wait();
			$results = [];

			foreach ($settled as $serviceName => $item) {
				if (($item['state'] ?? '') !== 'fulfilled') {
					continue;
				}

				$response = $item['value'];
				$decoded = json_decode((string) $response->getBody(), true);

				if (!is_array($decoded)) {
					continue;
				}

				$items = [];
				if (isset($decoded['data']) && is_array($decoded['data'])) {
					$items = $decoded['data'];
				} elseif (array_is_list($decoded)) {
					$items = $decoded;
				} else {
					$items = [$decoded];
				}

				$normalized = $this->matchService->normalize($items, (string) $serviceName);
				$results = array_merge($results, $normalized);
			}

			return $results;
		} catch (\Throwable $e) {
			return [];
		}
	}
}
