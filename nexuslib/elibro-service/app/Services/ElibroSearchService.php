<?php

namespace App\Services;

use App\Adapters\ElibroScraper;

class ElibroSearchService
{
	private ElibroScraper $scraper;

	public function __construct()
	{
		$this->scraper = new ElibroScraper();
	}

	public function searchBooks(string $query): array
	{
		return $this->scraper->search($query);
	}
}
