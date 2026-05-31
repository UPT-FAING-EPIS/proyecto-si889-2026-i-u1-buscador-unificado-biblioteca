<?php

namespace App\Adapters;

use App\Config\ScraperConfig;
use App\Models\LibroAlpha;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler;

class AlphaCloudScraper
{
	public function search(string $query): array
	{
		try {
			$client = new Client([
				'verify' => false,
				'headers' => [
					'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
				],
			]);
			$url = 'https://www.alphaeditorialcloud.com/library/search/' . urlencode($query);

			$response = $client->get($url);
			$html = (string) $response->getBody();
			$crawler = new Crawler($html);
			$items = [];

			$crawler->filter('article.Issue')->each(function (Crawler $node) use (&$items) {
				$id = null;
				$titulo = 'Desconocido';
				$autor = 'Desconocido';
				$portadaUrl = null;
				$enlaceAlpha = null;

				if ($node->count() > 0) {
					$id = trim((string) ($node->attr('data-id') ?? ''));
					$enlaceAlpha = trim((string) ($node->attr('data-url') ?? ''));
				}

				if ($node->filter('h2.Issue-title')->count() > 0) {
					$titulo = trim($node->filter('h2.Issue-title')->first()->text('Desconocido'));
				}

				if ($node->filter('.Issue-author p')->count() > 0) {
					$autor = trim($node->filter('.Issue-author p')->first()->text('Desconocido'));
				}

				if ($node->filter('.Issue-cover img')->count() > 0) {
					$coverNode = $node->filter('.Issue-cover img')->first();
					$portadaUrl = trim((string) ($coverNode->attr('src') ?? ''));
				}

				$items[] = [
					'id' => $id,
					'titulo' => $titulo,
					'autor' => $autor,
					'portada_url' => $portadaUrl,
					'enlace_alpha' => $enlaceAlpha,
				];
			});

			return $items;
		} catch (GuzzleException $e) {
			return [];
		} catch (\Throwable $e) {
			return [[
				'id' => 'ERROR',
				'titulo' => 'Error en el Scraper Alpha',
				'autor' => $e->getMessage(),
				'portada_url' => null,
				'enlace_alpha' => null
			]];
		}
	}
}
