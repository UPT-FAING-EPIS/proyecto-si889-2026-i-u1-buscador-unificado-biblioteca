<?php


require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$googleAdapter = new App\Adapters\GoogleBooksAdapter();

$controller = new App\Controllers\SearchController(
	new App\Services\UnificationService(
		new App\Adapters\MySQLLocalAdapter(),
		$googleAdapter
	),
	$googleAdapter
);
$action = (string) ($_GET['action'] ?? '');

switch ($action) {
	case 'details_local':
		$controller->detailsLocal($_GET['id'] ?? '');
		break;
	case 'details':
	default:
		$controller->index();
		break;
}