
<?php

/**
 * Interface para el patrón Repositorio de usuarios.
 * Mantengo el namespace global para compatibilidad con el resto del proyecto.
 */
interface UserRepositoryInterface
{
	/**
	 * Busca un usuario por su email.
	 * @param string $email
	 * @return User|null
	 */
	public function findByEmail(string $email): ?User;

	/**
	 * Busca un usuario por su id_user (PK autoincrement).
	 * @param int $id_user
	 * @return User|null
	 */
	public function findById(int $id_user): ?User;

	/**
	 * Inserta un nuevo usuario en la base de datos.
	 * Debe usar la función UUID() en MySQL para el campo `uuid`.
	 * @param User $user
	 * @return bool True si se insertó correctamente.
	 */
	public function save(User $user): bool;
}

