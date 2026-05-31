
<?php

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/UserRepositoryInterface.php';

/**
 * Implementación del repositorio de usuarios usando PDO.
 */
class UserRepository implements UserRepositoryInterface
{
	private \PDO $pdo;

	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function findByEmail(string $email): ?User
	{
		$sql = 'SELECT id_user, uuid, name, email, password, role, status, created_at, updated_at FROM users WHERE email = :email LIMIT 1';
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute([':email' => $email]);
		$row = $stmt->fetch(\PDO::FETCH_ASSOC);

		if (!$row) {
			return null;
		}

		return new User($row);
	}

	public function findById(int $id_user): ?User
	{
		$sql = 'SELECT id_user, uuid, name, email, password, role, status, created_at, updated_at FROM users WHERE id_user = :id_user LIMIT 1';
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute([':id_user' => $id_user]);
		$row = $stmt->fetch(\PDO::FETCH_ASSOC);

		if (!$row) {
			return null;
		}

		return new User($row);
	}

	public function save(User $user): bool
	{
		try {
			$sql = 'INSERT INTO users (uuid, name, email, password) VALUES (UUID(), :name, :email, :password)';
			$stmt = $this->pdo->prepare($sql);

			$ok = $stmt->execute([
				':name'     => $user->name,
				':email'    => $user->email,
				':password' => $user->password,
			]);

			if ($ok) {
				$lastId = (int)$this->pdo->lastInsertId();
				if ($lastId > 0) {
					$user->id_user = $lastId;
					// Recuperar uuid y timestamps generados por la BD
					$refresh = $this->findById($lastId);
					if ($refresh !== null) {
						$user->uuid = $refresh->uuid;
						$user->created_at = $refresh->created_at;
						$user->updated_at = $refresh->updated_at;
					}
				}
				return true;
			}

			return false;
		} catch (\PDOException $e) {
			return false;
		}
	}
}

