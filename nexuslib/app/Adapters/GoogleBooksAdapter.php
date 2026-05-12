<?php

namespace App\Adapters;

use App\Models\Libro;

class GoogleBooksAdapter
{
    public function buscarPorIsbn(string $isbn): ?Libro
    {
        $apiKey = $_ENV['GOOGLE_BOOKS_API_KEY'] ?? '';
        $url = "https://www.googleapis.com/books/v1/volumes?q=isbn:" . urlencode($isbn) . "&maxResults=1&key=" . $apiKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            return null;
        }

        $data = json_decode($response, true);

        if (!is_array($data) || empty($data['items'][0]['volumeInfo'])) {
            return null;
        }

        return $this->mapToLibro($data['items'][0], $isbn);
    }

    public function buscarPorVolumeId(string $volumeId): ?Libro
    {
        $apiKey = $_ENV['GOOGLE_BOOKS_API_KEY'] ?? '';
        $url = "https://www.googleapis.com/books/v1/volumes/" . urlencode($volumeId) . "?key=" . $apiKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            return null;
        }

        $data = json_decode($response, true);

        if (!is_array($data) || empty($data['volumeInfo'])) {
            return null;
        }

        return $this->mapToLibro($data, '', (string) ($data['id'] ?? $volumeId));
    }

    public function buscarGeneral(string $termino, int $maxResults = 10, int $startIndex = 0): array
    {
        $maxResults = max(1, min(40, $maxResults));
        $startIndex = max(0, $startIndex);
        $apiKey = $_ENV['GOOGLE_BOOKS_API_KEY'] ?? '';
        $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($termino)
            . "&maxResults=" . $maxResults
            . "&startIndex=" . $startIndex
            . "&key=" . $apiKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            return [];
        }

        $data = json_decode($response, true);

        if (!is_array($data) || empty($data['items'])) {
            return [];
        }

        $libros = [];
        foreach ($data['items'] as $item) {
            $libros[] = $this->mapToLibro($item);
        }

        return $libros;
    }

    private function mapToLibro(array $item, string $fallbackIsbn = '', ?string $fallbackGoogleId = null): Libro
    {
        $volumeInfo = $item['volumeInfo'] ?? [];
        $authors = $volumeInfo['authors'] ?? [];
        $categories = $volumeInfo['categories'] ?? [];
        $imageLinks = $volumeInfo['imageLinks'] ?? [];

        $autor = is_array($authors) && !empty($authors) ? implode(', ', $authors) : 'Autor desconocido';
        $categoria = is_array($categories) && !empty($categories) ? (string) $categories[0] : null;
        $portadaUrl = $imageLinks['thumbnail'] ?? $imageLinks['smallThumbnail'] ?? null;

        $isbn = $fallbackIsbn;
        if ($isbn === '') {
            $identifiers = $volumeInfo['industryIdentifiers'] ?? [];
            foreach ($identifiers as $identifier) {
                if (isset($identifier['identifier'])) {
                    $isbn = (string) $identifier['identifier'];
                    break;
                }
            }
        }

        return new Libro(
            id_libro: 0,
            titulo: (string) ($volumeInfo['title'] ?? ''),
            autor: $autor,
            isbn: $isbn,
            categoria: $categoria,
            digital_link: $volumeInfo['infoLink'] ?? null,
            portada_url: $portadaUrl,
            descripcion: $volumeInfo['description'] ?? null,
            num_paginas: $volumeInfo['pageCount'] ?? null,
            categorias: $categories ?: null,
            embeddable: false,
            fuente_lectura: 'google',
            google_id: (string) ($item['id'] ?? $fallbackGoogleId ?? ''),
            origen: 'google'
        );
    }
}
