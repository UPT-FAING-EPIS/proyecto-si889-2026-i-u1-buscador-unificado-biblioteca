<?php

namespace App\Adapters;

use App\Models\Database;
use App\Models\Inventario;
use App\Models\Libro;
use PDO;

class MySQLLocalAdapter
{
	private PDO $connection;

	public function __construct()
	{
		$this->connection = Database::getConnection();
	}

	public function buscarPorIsbn(string $isbn): ?array
	{
		$sql = 'SELECT
				l.id_libro,
				l.titulo,
				l.autor,
				l.isbn,
				l.categoria,
				l.digital_link,
				l.portada_url,
				i.id_inventario,
				i.id_libro AS inventario_id_libro,
				i.piso,
				i.estante,
				i.stock
			FROM libros l
			INNER JOIN inventario i ON i.id_libro = l.id_libro
			WHERE l.isbn = :isbn
			LIMIT 1';

		$stmt = $this->connection->prepare($sql);
		$stmt->bindValue(':isbn', $isbn);
		$stmt->execute();

		$row = $stmt->fetch();

		if ($row === false) {
			return null;
		}

		$libro = Libro::fromArray($row);

		$inventario = new Inventario(
			id_inventario: (int) $row['id_inventario'],
			id_libro: (int) $row['inventario_id_libro'],
			piso: (string) $row['piso'],
			estante: (string) $row['estante'],
			stock: (int) $row['stock']
		);

		return [
			'libro' => $libro,
			'inventario' => $inventario,
		];
	}

    public function buscarPorAutor(string $autor): ?array
    {
        $sql = 'SELECT 
                    l.id_libro, 
                    l.titulo, 
                    l.autor, 
                    l.isbn, 
                    l.categoria, 
                    l.digital_link, 
                    l.portada_url,
                    i.id_inventario, 
                    i.id_libro AS inventario_id_libro, 
                    i.piso, 
                    i.estante, 
                    i.stock
                FROM libros l
                INNER JOIN inventario i ON i.id_libro = l.id_libro
                WHERE l.autor LIKE :autor
                LIMIT 1';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':autor', '%' . $autor . '%');
        $stmt->execute();

        $row = $stmt->fetch();

        if ($row === false) {
            return null;
        }

        $libro = Libro::fromArray($row);

        $inventario = new Inventario(
            id_inventario: (int) $row['id_inventario'],
            id_libro: (int) $row['inventario_id_libro'],
            piso: (string) $row['piso'],
            estante: (string) $row['estante'],
            stock: (int) $row['stock']
        );

        return [
            'libro' => $libro,
            'inventario' => $inventario,
        ];
    }

	public function buscarGeneral(string $termino, int $limit = 10): ?array
	{
		$limit = max(1, min(40, $limit));
		$sql = 'SELECT
					l.id_libro,
					l.titulo,
					l.autor,
					l.isbn,
					l.categoria,
					l.digital_link,
					l.portada_url,
					i.id_inventario,
					i.id_libro AS inventario_id_libro,
					i.piso,
					i.estante,
					i.stock
				FROM libros l
				INNER JOIN inventario i ON i.id_libro = l.id_libro
				WHERE l.titulo LIKE :termino_like
				   OR l.autor LIKE :termino_like
				   OR l.isbn = :termino_exacto
				LIMIT ' . $limit;

		$stmt = $this->connection->prepare($sql);
		$stmt->bindValue(':termino_like', '%' . $termino . '%');
		$stmt->bindValue(':termino_exacto', $termino);
		$stmt->execute();

		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if ($rows === []) {
			return null;
		}

		$resultados = [];

		foreach ($rows as $row) {
			$libro = Libro::fromArray($row);

			$inventario = new Inventario(
				id_inventario: (int) $row['id_inventario'],
				id_libro: (int) $row['inventario_id_libro'],
				piso: (string) $row['piso'],
				estante: (string) $row['estante'],
				stock: (int) $row['stock']
			);

			$resultados[] = [
				'libro' => $libro,
				'inventario' => $inventario,
			];
		}

		return $resultados;
	}
}
