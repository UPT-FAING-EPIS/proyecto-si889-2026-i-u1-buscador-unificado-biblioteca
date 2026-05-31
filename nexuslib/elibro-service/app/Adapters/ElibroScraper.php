<?php

namespace App\Adapters;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ElibroScraper
{
	public function search(string $query): array
	{
		try {
			$client = new Client();
			$url = 'https://elibro.net/api/collection_titles_search/?page_size=50&page=1';

			$response = $client->post($url, [
				'json' => [
					'type' => 'quicksearch',
					'q' => $query,
					'lang' => 'sp',
					'channel' => 'bf4daf71-e3d8-487a-bfb4-fee6d9a22d0a',
				],
			]);
			$data = json_decode((string) $response->getBody(), true);
			$items = [];

			foreach (($data['results'] ?? []) as $item) {
				$items[] = [
					'id' => $item['id'] ?? null,
					'titulo' => $item['title_name'] ?? 'Desconocido',
					'autor' => implode(', ', $item['contributors'] ?? ['Desconocido']),
					'portada_url' => $item['cover'] ?? null,
					'enlace_elibro' => 'https://elibro.net/es/lc/bibliotecaupt/titulos/' . ($item['id'] ?? ''),
				];
			}

			return $items;
		} catch (GuzzleException $e) {
			return [];
		} catch (\Throwable $e) {
			return [[
				'id' => 'ERROR',
				'titulo' => 'Error en Scraper eLibro',
				'autor' => $e->getMessage(),
				'portada_url' => null,
				'enlace_elibro' => null,
			]];
		}
	}
}
