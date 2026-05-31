<?php

interface LibraryRepositoryInterface
{
	public function saveBook(SavedBook $book): bool;

	public function getSavedBooksByUser(string $uuid): array;

	public function reserveBook(ReservedBook $book): bool;

	public function getReservedBooksByUser(string $uuid): array;

	public function deleteReservation(string $userUuid, int $registro): bool;
}
