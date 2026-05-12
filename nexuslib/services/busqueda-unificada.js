
function getAppBasePath() {
  // Asegurar que siempre usamos /nexuslib/ como base del proyecto
  return "/nexuslib/";
}

export async function buscarEnTodasLasAPIs(termino) {
  const basePath = getAppBasePath();
  const url = `${basePath}index.php?action=search-external&q=${encodeURIComponent(termino)}`;
  const response = await fetch(url, {
    headers: { "Accept": "application/json" }
  });

  if (!response.ok) {
    throw new Error(`Error al consultar el controlador PHP: ${response.status}`);
  }

  return response.json();
}
