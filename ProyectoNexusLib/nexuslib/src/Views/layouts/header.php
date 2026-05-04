<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexusLib</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'>
    <link rel="stylesheet" href="/nexuslib/public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <script type='text/javascript' src='https://www.google.com/books/jsapi.js'></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-nexus mb-4">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
        <span class="me-2">📚</span> NexusLib
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nexusNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nexusNavbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white fw-bold" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-book me-2"></i>LIBROS
            <i class="bi bi-chevron-down ms-2" style="font-size: 0.85rem;"></i>
          </a>
          <ul class="dropdown-menu">
            <!-- <li><a class="dropdown-item" href="#">Artículos</a></li> -->
            <li><a class="dropdown-item" href="index.php?action=category&name=Biografía">Biografía</a></li>
            <li><a class="dropdown-item" href="index.php?action=category&name=Ciencia%20ficci%C3%B3n">Ciencia ficción</a></li>
            <li><a class="dropdown-item" href="index.php?action=category&name=Cuentos">Cuentos</a></li>
            <li><a class="dropdown-item" href="index.php?action=category&name=Diccionarios">Diccionarios</a></li>
            <li><a class="dropdown-item" href="index.php?action=category&name=Ensayos">Ensayos</a></li>
            <li><a class="dropdown-item" href="index.php?action=category&name=Filosof%C3%ADa">Filosofía</a></li>
            <li><a class="dropdown-item" href="index.php?action=category&name=Historia">Historia</a></li>
            <li><a class="dropdown-item" href="index.php?action=category&name=Novelas">Novelas</a></li>
            <li><a class="dropdown-item" href="index.php?action=category&name=Poes%C3%ADa">Poesía</a></li>
            <!-- <li><a class="dropdown-item" href="#">Tesis</a></li> -->
          </ul>
        </li>
      </ul>

      <div id="liveSearchContainer" class="mx-lg-4 flex-grow-1 position-relative">
        <form action="index.php" method="get" class="search-wrapper d-flex align-items-center">
          <input type="hidden" name="action" value="search">
          <button type="submit" id="searchBtn" class="search-btn btn btn-dark d-flex align-items-center justify-content-center me-2">
            <i class="bi bi-search"></i>
          </button>
          <input type="text" id="liveSearch" name="q" class="form-control bg-dark text-white" placeholder="Busca por título o autor...">
        </form>
        <div id="searchOverlay" class="search-results-overlay"></div>
      </div>

      <button class="btn btn-outline-light rounded-pill px-4 fw-bold" type="button">
        MENÚ
      </button>
    </div>
  </div>
</nav>

<div class="container-fluid px-md-5 main-content">