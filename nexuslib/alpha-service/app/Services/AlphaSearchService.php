<?php

namespace App\Services;

use App\Adapters\AlphaCloudScraper;

class AlphaSearchService
{
	private AlphaCloudScraper $scraper;

	public function __construct()
	{
		$this->scraper = new AlphaCloudScraper();
	}

	public function searchBooks(string $query): array
	{
		return $this->scraper->search($query);
	}
}
