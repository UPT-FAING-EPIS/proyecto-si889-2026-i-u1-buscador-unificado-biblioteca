<?php
$user = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexusLib - Biblioteca Virtual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="/nexuslib/src/assets/css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }
        .navbar-nexus {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding: 1rem 2rem;
            position: relative;
            z-index: 1070 !important;
        }
        .navbar-nexus .container-fluid {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #22d3ee !important;
        }
        .text-cyan {
            color: #22d3ee;
        }
        .hero-section {
            text-align: center;
            padding: 3rem 1rem;
            background: rgba(0,0,0,0.2);
            border-radius: 20px;
            margin-bottom: 2rem;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .category-section {
            margin-bottom: 2.5rem;
            position: relative;
        }
        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0 0.5rem;
        }
        .category-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #f8fafc;
            margin: 0;
        }
        .books-scroll {
            display: flex;
            gap: 1.2rem;
            overflow-x: auto;
            padding: 0.5rem 0.5rem 1rem 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: #22d3ee #1e293b;
        }
        .books-scroll::-webkit-scrollbar {
            height: 6px;
        }
        .books-scroll::-webkit-scrollbar-track {
            background: #1e293b;
            border-radius: 10px;
        }
        .books-scroll::-webkit-scrollbar-thumb {
            background: #22d3ee;
            border-radius: 10px;
        }
        .book-card {
            width: 160px;
            flex-shrink: 0;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }
        .book-card:hover {
            transform: translateY(-8px);
        }
        .book-cover {
            width: 160px;
            height: 220px;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            background: #1e293b;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }
        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .badge-status {
            position: absolute;
            top: 8px;
            right: 8px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: bold;
            z-index: 2;
            backdrop-filter: blur(4px);
        }
        .badge-digital {
            background: rgba(34, 211, 238, 0.9);
            color: #0f172a;
        }
        .badge-local {
            background: rgba(16, 185, 129, 0.9);
            color: white;
        }
        .book-card-body {
            padding: 0.6rem 0.2rem;
        }
        .book-author {
            font-size: 0.8rem;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #f8fafc;
            font-weight: 500;
        }
        .book-cat-label {
            font-size: 0.7rem;
            color: #22d3ee;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .no-cover {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            background: linear-gradient(135deg, #1e293b, #0f172a);
        }
        .book-card-link {
            text-decoration: none;
            color: inherit;
        }
        .search-wrapper {
            display: flex;
            align-items: center;
            background: rgba(255,255,255,0.1);
            border-radius: 40px;
            padding: 0.5rem 1rem;
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s;
        }
        .search-wrapper:focus-within {
            border-color: #22d3ee;
            box-shadow: 0 0 15px rgba(34,211,238,0.3);
        }
        .search-wrapper input {
            background: transparent;
            border: none;
            color: white;
            flex: 1;
            padding: 0.5rem;
            font-size: 0.9rem;
        }
        .search-wrapper input:focus {
            outline: none;
        }
        .search-wrapper button {
            background: transparent;
            border: none;
            color: #22d3ee;
            cursor: pointer;
        }
        .btn-google {
            background: linear-gradient(135deg, #4285f4, #357ae8);
            color: white;
            border-radius: 30px;
            padding: 8px 22px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-google:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(66,133,244,0.4);
            color: white;
        }
        .btn-watchlist {
            background: rgba(34, 211, 238, 0.15);
            border: 1px solid #22d3ee;
            border-radius: 30px;
            padding: 8px 18px;
            color: #22d3ee;
            text-decoration: none;
            align-self: center;
            transition: all 0.3s;
        }
        .btn-watchlist:hover {
            background: #22d3ee;
            color: #0f172a;
        }

        /* ensure profile dropdown/button doesn't get pushed vertically */
        .dropdown .btn {
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }
        .dropdown-menu {
            margin-bottom: 0 !important;
            z-index: 9999 !important;
        }

        .navbar-nexus .dropdown {
            position: relative;
        }

        .navbar-nexus .dropdown > .dropdown-menu {
            position: absolute;
            z-index: 2000 !important;
        }

        .navbar-nav .nav-item.dropdown {
            position: relative;
        }

        .navbar-nav .nav-item.dropdown > .dropdown-menu {
            z-index: 9999 !important;
        }

        .ver-mas-link {
            color: #22d3ee;
            text-decoration: none;
            font-size: 0.85rem;
            background: rgba(34,211,238,0.1);
            padding: 5px 12px;
            border-radius: 20px;
            transition: all 0.3s;
        }
        .ver-mas-link:hover {
            background: rgba(34,211,238,0.2);
            color: #22d3ee;
        }
        .footer {
            background: rgba(0,0,0,0.3);
            margin-top: 3rem;
            padding: 1.5rem;
            text-align: center;
        }
        .modal-content {
            border-radius: 15px;
        }
        .btn-close-white {
            filter: invert(1);
        }
        @media (max-width: 768px) {
            .container-custom { padding: 0 1rem; }
            .book-card { width: 130px; }
            .book-cover { width: 130px; height: 180px; }
            .hero-section h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
<script>
    window.NexusUserId = <?= isset($_SESSION['user_id']) ? json_encode($_SESSION['user_id']) : 'null' ?>;
</script>
<style>
    .watchlist-btn:hover { background: rgba(0,0,0,0.6) !important; transform: translateY(-2px); }
    .watchlist-btn .fas { transition: color 120ms ease-in-out; }
    .watchlist-btn { width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); border: none; z-index: 10; }
    .watchlist-btn i.fas { color: #f59e0b !important; }
    .watchlist-btn i.far { color: rgba(255,255,255,0.9) !important; }
    .dropdown-menu { z-index: 9999 !important; }
    .navbar-collapse { overflow: visible !important; }
    .container-fluid { overflow: visible !important; }
</style>
<nav class="navbar navbar-expand-lg navbar-dark navbar-nexus">
    <div class="container-fluid">
        <a class="navbar-brand" href="/nexuslib/index.php">📚 NexusLib</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Categorías</a>
                    <ul class="dropdown-menu dropdown-menu-dark border-cyan">
                        <li><a class="dropdown-item" href="/nexuslib/index.php?action=academicos&q=<?= urlencode('"computer science" OR "artificial intelligence"') ?>&mode=category&source=scopus">🎓 Artículos destacados (Scopus)</a></li>
                        <li><a class="dropdown-item" href="/nexuslib/index.php?action=academicos&q=<?= urlencode('engineering') ?>&mode=category&source=sciencedirect">🎓 Artículos destacados (ScienceDirect)</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/nexuslib/index.php?action=academicos&q=<?= urlencode('artificial intelligence') ?>&mode=category">📖 Inteligencia Artificial</a></li>
                        <li><a class="dropdown-item" href="/nexuslib/index.php?action=academicos&q=<?= urlencode('machine learning') ?>&mode=category">📖 Machine Learning</a></li>
                        <li><a class="dropdown-item" href="/nexuslib/index.php?action=academicos&q=<?= urlencode('medicine') ?>&mode=category">📖 Medicina</a></li>
                        <li><a class="dropdown-item" href="/nexuslib/index.php?action=academicos&q=<?= urlencode('biology') ?>&mode=category">📖 Biología</a></li>
                        <li><a class="dropdown-item" href="/nexuslib/index.php?action=academicos&q=<?= urlencode('biography') ?>&mode=category">📖 Biografía</a></li>
                        <li><a class="dropdown-item" href="/nexuslib/index.php?action=academicos&q=<?= urlencode('"science fiction"') ?>&mode=category">📖 Ciencia ficción</a></li>
                        <li><a class="dropdown-item" href="/nexuslib/index.php?action=academicos&q=<?= urlencode('fiction') ?>&mode=category">📖 Novelas</a></li>
                        <li><a class="dropdown-item" href="/nexuslib/index.php?action=academicos&q=<?= urlencode('philosophy') ?>&mode=category">📖 Filosofía</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex gap-2 align-items-center">
                <?php if ($user): ?>
                    <a class="btn-watchlist me-2" href="/nexuslib/index.php?action=watchlist">📖 Ver más tarde</a>
                <?php endif; ?>
                <form class="d-flex" action="/nexuslib/index.php" method="get">
                    <input type="hidden" name="action" value="academicos">
                    <div class="search-wrapper">
                        <input type="text" name="q" placeholder="Buscar artículos académicos..." value="<?= (($_GET['mode'] ?? '') === 'category') ? '' : htmlspecialchars($_GET['q'] ?? '') ?>">
                        <button type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
                <?php if ($user): ?>
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle rounded-pill" type="button" data-bs-toggle="dropdown">
                            👤 <?= htmlspecialchars(explode(' ', $user['nombre'])[0]) ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark border-cyan">
                            <li><a class="dropdown-item" href="/nexuslib/index.php?action=logout">Cerrar sesión</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="/nexuslib/index.php?action=login" class="btn-google">
                        <i class="bi bi-google"></i> Ingresar
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<div class="container-custom mt-4">
