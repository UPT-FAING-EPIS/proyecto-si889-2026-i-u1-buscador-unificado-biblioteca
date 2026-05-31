<?php

require_once __DIR__ . '/../Repositories/LibraryRepositoryInterface.php';

class SavedBooksService
{
	private LibraryRepositoryInterface $repository;

	public function __construct(LibraryRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	public function saveBook(SavedBook $book): bool
	{
		return $this->repository->saveBook($book);
	}

	public function getSavedBooks(string $uuid): array
	{
		return $this->repository->getSavedBooksByUser($uuid);
	}
}
