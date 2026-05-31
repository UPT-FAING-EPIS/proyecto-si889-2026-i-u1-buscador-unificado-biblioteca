<?php

namespace App\Controllers;

use App\Services\ElibroSearchService;

class ElibroController
{
	private ElibroSearchService $searchService;

	public function __construct()
	{
		$this->searchService = new ElibroSearchService();
	}

	public function search(): void
	{
		$query = trim($_GET['q'] ?? '');

		if ($query === '') {
			$this->jsonResponse(['error' => 'Missing q parameter'], 400);
			return;
		}

		$books = $this->searchService->searchBooks($query);
		$this->jsonResponse(['data' => $books], 200);
	}

	private function jsonResponse(array $data, int $statusCode = 200): void
	{
		http_response_code($statusCode);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
}
