<?php

require_once __DIR__ . '/vendor/autoload.php';

// Cargar variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Instanciar adaptadores
$googleAdapter = new App\Adapters\GoogleBooksAdapter();
$localAdapter = new App\Adapters\MySQLLocalAdapter();

// Servicio de unificación
$unificationService = new App\Services\UnificationService($googleAdapter);

// Controlador
$controller = new App\Controllers\SearchController($unificationService, $googleAdapter, $localAdapter);

// Obtener acción
$action = $_GET['action'] ?? '';

// Router
if (empty($action)) {
    // Delegar a controlador para cargar datos y mostrar vista principal
    $controller->index();
} else {
    switch ($action) {
        case 'details_local':
            header('Location: /nexuslib/index.php?action=academicos&error=local_disabled');
            exit;
        case 'login':
            $controller->handleLogin();
            break;
        case 'auth-callback':
            $controller->handleAuthCallback();
            break;
        case 'logout':
            $controller->handleLogout();
            break;
        case 'add-watchlist':
            $controller->handleAddWatchlist();
            break;
        case 'remove-watchlist':
            $controller->handleRemoveWatchlist();
            break;
        case 'watchlist':
            $controller->handleWatchlist();
            break;
        case 'add-comment':
            $controller->handleAddComment();
            break;
        case 'get-book-stats':
            $controller->handleGetBookStats();
            break;
        case 'search-external':
            $controller->handleSearchExternalApis();
            break;
        case 'category':
            $controller->category();
            break;
        case 'search-more':
            $controller->searchMore();
            break;
        case 'live-search':
            $controller->liveSearch();
            break;
        case 'details':
            $controller->detallesAcademico($_GET['id'] ?? '');
            break;
        case 'academicos':
            $controller->buscarAcademicos($_GET['q'] ?? $_GET['termino'] ?? '');
            break;
        default:
            header('Location: /nexuslib/index.php?action=academicos');
            exit;
    }
}
