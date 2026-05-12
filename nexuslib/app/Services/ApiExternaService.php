<?php

namespace App\Services;

class ApiExternaService
{
    private string $apiKey;

    public function __construct()
    {
        // Usamos la misma clave para ambas APIs de Elsevier
        $this->apiKey = $_ENV['SCOPUS_API_KEY'] ?? '';
    }

    /**
     * Busca artículos en Scopus (Veloz, hasta 2025 y con mínimo de citas)
     */
    public function buscarEnScopus(string $query, int $limite = 20, int $start = 0): array
    {
        if (empty($this->apiKey)) {
            return ['error' => 'No API key for Scopus'];
        }

        // Filtro: Menor a 2026 (hasta 2025) Y con más de 50 citas para asegurar importancia
        $queryConFiltro = $query . ' AND PUBYEAR < 2026 AND CITEDBY(>50)';

        $url = "https://api.elsevier.com/content/search/scopus?query=" . urlencode($queryConFiltro) . "&count=" . $limite . "&start=" . max(0, $start);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "X-ELS-APIKey: {$this->apiKey}",
            "Accept: application/json"
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        // Tiempos de espera de seguridad
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            return ['error' => "Scopus error: HTTP $httpCode"];
        }

        $data = json_decode($response, true);
        
        return $this->formatearResultadosScopus($data);
    }

    /**
     * Busca artículos en ScienceDirect (Veloz, hasta 2025 y con mínimo de citas)
     */
    public function buscarEnScienceDirect(string $query, int $limite = 20, int $start = 0): array
    {
        if (empty($this->apiKey)) {
            return ['error' => 'No API key for ScienceDirect'];
        }

        // Filtro: Editorial Elsevier, año hasta 2025 Y con más de 50 citas
        $queryConFiltro = $query . ' AND PUBLISHER(Elsevier) AND PUBYEAR < 2026 AND CITEDBY(>50)';
        
        $url = "https://api.elsevier.com/content/search/scopus?query=" . urlencode($queryConFiltro) . "&count=" . $limite . "&start=" . max(0, $start);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "X-ELS-APIKey: {$this->apiKey}",
            "Accept: application/json"
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        // Tiempos de espera de seguridad
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false) {
            return ['error' => 'Error de conexión con ScienceDirect'];
        }

        if ($httpCode !== 200) {
            return ['error' => "ScienceDirect respondió con código HTTP $httpCode"];
        }

        $data = json_decode($response, true);
        return $this->formatearResultadosScopus($data, 'ScienceDirect');
    }

    /**
     * Obtiene el detalle profundo de un artículo por DOI usando Scopus
     */
    public function obtenerDetallePorDoi(string $doi): array
    {
        if (empty($this->apiKey)) {
            return ['error' => 'No API key for Scopus'];
        }

        $doi = trim($doi);
        if ($doi === '') {
            return ['error' => 'DOI vacío'];
        }

        $campoBusqueda = 'DOI';
        if (preg_match('/^(2-s2\.0-|SCOPUS:)/i', $doi)) {
            $campoBusqueda = 'EID';
        }

        $query = $campoBusqueda . '(' . $doi . ')';
        $url = 'https://api.elsevier.com/content/search/scopus?query=' . urlencode($query) . '&count=1';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "X-ELS-APIKey: {$this->apiKey}",
            'Accept: application/json'
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false) {
            return ['error' => 'Error de conexión con Scopus'];
        }

        if ($httpCode !== 200) {
            return ['error' => "Scopus respondió con código HTTP $httpCode"];
        }

        $data = json_decode($response, true);
        $entry = $data['search-results']['entry'][0] ?? null;

        if (!is_array($entry)) {
            return ['error' => 'No se encontró información para ese DOI'];
        }

        $titulo = $entry['dc:title'] ?? 'Sin título';
        $autor = $entry['dc:creator'] ?? 'Autor desconocido';
        $resumen = $entry['dc:description'] ?? null;
        $fecha = $entry['prism:coverDate'] ?? '';
        $editorial = $entry['prism:publicationName'] ?? 'Desconocida';
        $citas = (int) ($entry['citedby-count'] ?? 0);
        $doiEncontrado = $entry['prism:doi'] ?? $doi;

        $linkOriginal = null;
        if (!empty($doiEncontrado)) {
            $linkOriginal = 'https://doi.org/' . $doiEncontrado;
        }

        $linkScopus = null;
        if (isset($entry['link']) && is_array($entry['link'])) {
            foreach ($entry['link'] as $enlace) {
                if (($enlace['@ref'] ?? '') === 'scopus') {
                    $linkScopus = $enlace['@href'] ?? null;
                    break;
                }
            }
        }

        return [
            'titulo' => $titulo,
            'autor' => $autor,
            'resumen' => $resumen,
            'fecha' => $fecha,
            'editorial' => $editorial,
            'link_original' => $linkOriginal,
            'link_scopus' => $linkScopus,
            'citedby_count' => $citas,
            'doi' => $doiEncontrado,
            'volumen' => $entry['prism:volume'] ?? null,
            'numero' => $entry['prism:issueIdentifier'] ?? null,
            'paginas' => $entry['prism:pageRange'] ?? null,
            'eid' => $entry['eid'] ?? null,
            'fuente' => 'Scopus'
        ];
    }

    /**
     * Convierte los resultados de Scopus en un array simple
     */
    private function formatearResultadosScopus(array $data, string $fuente = 'Scopus'): array
    {
        $libros = [];
        
        if (!isset($data['search-results']['entry']) || !is_array($data['search-results']['entry'])) {
            return $libros;
        }
        
        foreach ($data['search-results']['entry'] as $item) {
            $titulo = $item['dc:title'] ?? 'Sin título';
            $autor = $item['dc:creator'] ?? 'Autor desconocido';

            // Obtener DOI (Digital Object Identifier) para enlace directo
            $doi = $item['prism:doi'] ?? null;
            $eid = $item['eid'] ?? null;
            $link = null;

            if ($doi) {
                $link = "https://doi.org/" . $doi;
            } elseif (isset($item['link']) && is_array($item['link'])) {
                foreach ($item['link'] as $enlace) {
                    if (($enlace['@ref'] ?? '') === 'scopus') {
                        $link = $enlace['@href'] ?? null;
                        break;
                    }
                }
            }

            if ($fuente === 'Scopus' && $link !== null && stripos($link, 'sciencedirect.com') !== false) {
                continue;
            }

            // Obtener ISSN o ISBN
            $issn = $item['prism:issn'] ?? '';
            $isbn = $item['prism:isbn'] ?? '';

            $revista = $item['prism:publicationName'] ?? 'ScienceDirect';

            $libros[] = [
                'titulo' => $titulo,
                'autor' => $autor,
                'isbn' => !empty($isbn) ? $isbn : $issn,
                'año' => substr($item['prism:coverDate'] ?? '', 0, 4),
                'fuente' => $fuente,
                'link' => $link,
                'doi' => $doi,
                'eid' => $eid,
                'resumen' => $item['dc:description'] ?? null,
                'revista' => $revista,
                'volumen' => $item['prism:volume'] ?? null,
                'numero' => $item['prism:issueIdentifier'] ?? null,
                'paginas' => $item['prism:pageRange'] ?? null
            ];
        }
        
        return $libros;
    }

    /**
     * Convierte los resultados de ScienceDirect en un array simple
     */
    private function formatearResultadosScienceDirect(array $data): array
    {
        $libros = [];
        
        if (!isset($data['search-results']['entry']) || !is_array($data['search-results']['entry'])) {
            return $libros;
        }
        
        foreach ($data['search-results']['entry'] as $item) {
            $titulo = $item['dc:title'] ?? 'Sin título';
            $autor = $item['dc:creator'] ?? 'Autor desconocido';
            
            // Obtener DOI
            $doi = $item['prism:doi'] ?? null;
            $link = null;
            
            if ($doi) {
                $link = "https://doi.org/" . $doi;
            } elseif (isset($item['link']) && is_array($item['link'])) {
                foreach ($item['link'] as $enlace) {
                    if (($enlace['@ref'] ?? '') === 'scopus') {
                        $link = $enlace['@href'] ?? null;
                        break;
                    }
                }
            }
            
            $libros[] = [
                'titulo' => $titulo,
                'autor' => $autor,
                'isbn' => $item['prism:isbn'] ?? '',
                'año' => substr($item['prism:coverDate'] ?? '', 0, 4),
                'fuente' => 'ScienceDirect',
                'link' => $link,
                'doi' => $doi,
                'resumen' => $item['dc:description'] ?? null,
                'revista' => $item['prism:publicationName'] ?? null
            ];
        }
        
        return $libros;
    }
    
    /**
     * Busca en ambas plataformas y unifica los resultados
     */
    public function busquedaUnificada(string $termino, int $limite = 20, int $pagina = 1): array
    {
        $resultados = [];
        $limite = max(1, $limite);
        $pagina = max(1, $pagina);
        $limitePorFuente = max(1, intdiv($limite, 2));
        $startPorFuente = ($pagina - 1) * $limitePorFuente;
        
        // Intentar Scopus
        $scopus = $this->buscarEnScopus($termino, $limitePorFuente, $startPorFuente);
        if (!isset($scopus['error']) && is_array($scopus)) {
            $resultados = array_merge($resultados, $scopus);
        }
        
        // Intentar ScienceDirect
        $sciencedirect = $this->buscarEnScienceDirect($termino, $limitePorFuente, $startPorFuente);
        if (!isset($sciencedirect['error']) && is_array($sciencedirect)) {
            $resultados = array_merge($resultados, $sciencedirect);
        }
        
        return $this->eliminarDuplicadosAcademicos($resultados);
    }

    /**
     * Elimina duplicados académicos por DOI/EID y, como respaldo, por enlace o huella de metadatos.
     */
    private function eliminarDuplicadosAcademicos(array $resultados): array
    {
        $unicos = [];
        $vistos = [];

        foreach ($resultados as $item) {
            if (!is_array($item)) {
                continue;
            }

            $clave = $this->obtenerClaveAcademica($item);
            if ($clave === null) {
                continue;
            }

            if (isset($vistos[$clave])) {
                continue;
            }

            $vistos[$clave] = true;
            $unicos[] = $item;
        }

        return $unicos;
    }

    /**
     * Construye una clave estable para evitar duplicados entre páginas y fuentes.
     */
    private function obtenerClaveAcademica(array $item): ?string
    {
        $doi = strtolower(trim((string) ($item['doi'] ?? '')));
        if ($doi !== '') {
            return 'doi:' . $doi;
        }

        $eid = strtolower(trim((string) ($item['eid'] ?? '')));
        if ($eid !== '') {
            return 'eid:' . $eid;
        }

        $link = strtolower(trim((string) ($item['link'] ?? '')));
        if ($link !== '') {
            return 'link:' . $link;
        }

        $titulo = strtolower(trim((string) ($item['titulo'] ?? '')));
        $autor = strtolower(trim((string) ($item['autor'] ?? '')));
        $anio = strtolower(trim((string) ($item['año'] ?? '')));

        if ($titulo === '' && $autor === '' && $anio === '') {
            return null;
        }

        return 'meta:' . sha1($titulo . '|' . $autor . '|' . $anio);
    }
}
