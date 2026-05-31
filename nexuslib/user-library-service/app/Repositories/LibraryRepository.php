<?php

require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../Models/SavedBook.php';
require_once __DIR__ . '/../Models/ReservedBook.php';
require_once __DIR__ . '/LibraryRepositoryInterface.php';

class LibraryRepository implements LibraryRepositoryInterface
{
	private PDO $pdo;

	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function saveBook(SavedBook $book): bool
	{
		try {
			$sql = 'INSERT INTO saved_books (user_uuid, codigo) VALUES (:user_uuid, :codigo)';
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':user_uuid', $book->getUserUuid(), PDO::PARAM_STR);
			$stmt->bindValue(':codigo', $book->getCodigo(), PDO::PARAM_STR);
			$ok = $stmt->execute();

			if ($ok) {
				$book->setId((int) $this->pdo->lastInsertId());
			}

			return $ok;
		} catch (PDOException $e) {
			if ($e->getCode() === '23000') {
				return false;
			}

			return false;
		}
	}

	public function getSavedBooksByUser(string $uuid): array
	{
		$sql = 'SELECT id, user_uuid, codigo, fecha_guardado FROM saved_books WHERE user_uuid = :user_uuid ORDER BY fecha_guardado DESC, id DESC';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_uuid', $uuid, PDO::PARAM_STR);
		$stmt->execute();

		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$books = [];

		foreach ($rows as $row) {
			$books[] = new SavedBook($row);
		}

		return $books;
	}

	public function reserveBook(ReservedBook $book): bool
	{
		try {
			$sql = 'INSERT INTO reserved_books (user_uuid, registro, estado) VALUES (:user_uuid, :registro, :estado)';
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':user_uuid', $book->getUserUuid(), PDO::PARAM_STR);
			$stmt->bindValue(':registro', $book->getRegistro(), PDO::PARAM_INT);
			$stmt->bindValue(':estado', $book->getEstado(), PDO::PARAM_STR);
			$ok = $stmt->execute();

			if ($ok) {
				$book->setId((int) $this->pdo->lastInsertId());
			}

			return $ok;
		} catch (PDOException $e) {
			if ($e->getCode() === '23000') {
				return false;
			}

			return false;
		}
	}

	public function getReservedBooksByUser(string $uuid): array
	{
		$sql = 'SELECT id, user_uuid, registro, estado, fecha_reserva FROM reserved_books WHERE user_uuid = :user_uuid ORDER BY fecha_reserva DESC, id DESC';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_uuid', $uuid, PDO::PARAM_STR);
		$stmt->execute();

		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$books = [];

		foreach ($rows as $row) {
			$books[] = new ReservedBook($row);
		}

		return $books;
	}

	public function deleteReservation(string $userUuid, int $registro): bool
	{
		try {
			$sql = 'DELETE FROM reserved_books WHERE user_uuid = :user_uuid AND registro = :registro';
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':user_uuid', $userUuid, PDO::PARAM_STR);
			$stmt->bindValue(':registro', $registro, PDO::PARAM_INT);
			$stmt->execute();

			return ($stmt->rowCount() > 0);
		} catch (PDOException $e) {
			return false;
		}
	}
}
