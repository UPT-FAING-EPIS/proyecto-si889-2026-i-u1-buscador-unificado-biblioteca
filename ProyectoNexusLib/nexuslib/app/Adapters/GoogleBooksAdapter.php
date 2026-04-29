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

    public function buscarGeneral(string $termino): array
    {
        $apiKey = $_ENV['GOOGLE_BOOKS_API_KEY'] ?? '';
        $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($termino) . "&maxResults=10&key=" . $apiKey;

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

        if (!is_array($data) || empty($data['items']) || !is_array($data['items'])) {
            return [];
        }

        $libros = [];

        foreach ($data['items'] as $item) {
            if (!is_array($item) || empty($item['volumeInfo']) || !is_array($item['volumeInfo'])) {
                continue;
            }

            $libros[] = $this->mapToLibro($item);
        }

        return $libros;
    }

    private function mapToLibro(array $item, string $fallbackIsbn = ''): Libro
    {
        $volumeInfo = is_array($item['volumeInfo'] ?? null) ? $item['volumeInfo'] : [];
        $authors = $volumeInfo['authors'] ?? [];
        $categories = $volumeInfo['categories'] ?? [];
        $imageLinks = $volumeInfo['imageLinks'] ?? [];

        $autor = 'Autor desconocido';
        if (is_array($authors) && $authors !== []) {
            $autor = implode(', ', array_map('strval', $authors));
        } elseif (is_string($authors) && $authors !== '') {
            $autor = $authors;
        }

        $categoria = 'General';
        if (is_array($categories) && isset($categories[0]) && $categories[0] !== '') {
            $categoria = (string) $categories[0];
        } elseif (is_string($categories) && $categories !== '') {
            $categoria = $categories;
        }

        $portadaUrl = null;
        if (is_array($imageLinks)) {
            $thumbnail = $imageLinks['thumbnail'] ?? null;
            $smallThumbnail = $imageLinks['smallThumbnail'] ?? null;
            $portadaUrl = is_string($thumbnail) && $thumbnail !== ''
                ? $thumbnail
                : (is_string($smallThumbnail) && $smallThumbnail !== '' ? $smallThumbnail : null);
        }

        $isbn = $fallbackIsbn;
        if ($isbn === '') {
            $identifiers = $volumeInfo['industryIdentifiers'] ?? [];
            if (is_array($identifiers)) {
                foreach ($identifiers as $identifier) {
                    if (is_array($identifier) && !empty($identifier['identifier'])) {
                        $isbn = (string) $identifier['identifier'];
                        break;
                    }
                }
            }
        }

        return new Libro(
            id_libro: 0,
            titulo: (string) ($volumeInfo['title'] ?? ''),
            autor: $autor,
            isbn: $isbn,
            categoria: $categoria,
            digital_link: isset($volumeInfo['infoLink']) ? (string) $volumeInfo['infoLink'] : null,
            portada_url: $portadaUrl
        );
    }
}