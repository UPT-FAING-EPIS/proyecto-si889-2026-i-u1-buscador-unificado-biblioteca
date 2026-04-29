<?php

namespace App\Models;

use PDO;
use PDOException;

class Database
{
	private static ?PDO $connection = null;

	private function __construct()
	{
	}

	public static function getConnection(): PDO
	{
		if (self::$connection === null) {
			$host = $_ENV['DB_HOST'] ?? '';
			$dbname = $_ENV['DB_NAME'] ?? '';
			$user = $_ENV['DB_USER'] ?? '';
			$pass = $_ENV['DB_PASS'] ?? '';

			$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";

			try {
				self::$connection = new PDO($dsn, $user, $pass, [
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				]);
			} catch (PDOException $e) {
				throw new PDOException('Database connection failed: ' . $e->getMessage(), (int) $e->getCode(), $e);
			}
		}

		return self::$connection;
	}
}
