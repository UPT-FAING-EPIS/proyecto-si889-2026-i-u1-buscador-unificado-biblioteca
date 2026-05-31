<?php

require_once __DIR__ . '/../Repositories/UserRepositoryInterface.php';
require_once __DIR__ . '/SessionService.php';
require_once __DIR__ . '/../Models/User.php';

/**
 * Servicio de autenticación que utiliza un UserRepository y SessionService.
 */
class AuthService
{
	private UserRepositoryInterface $repo;
	private SessionService $session;

	public function __construct(UserRepositoryInterface $repo, SessionService $session)
	{
		$this->repo = $repo;
		$this->session = $session;
	}

	/**
	 * Registra un nuevo usuario.
	 * @param string $name
	 * @param string $email
	 * @param string $password
	 * @return bool
	 */
	public function register(string $name, string $email, string $password): bool
	{
		$hashed = password_hash($password, PASSWORD_BCRYPT);

		$user = new User([
			'name' => $name,
			'email' => $email,
			'password' => $hashed,
		]);

		return $this->repo->save($user);
	}

	/**
	 * Intenta autenticar al usuario y guarda datos en sesión si tiene éxito.
	 * @param string $email
	 * @param string $password
	 * @return bool
	 */
	public function login(string $email, string $password): bool
	{
		$user = $this->repo->findByEmail($email);
		if ($user === null) {
			return false;
		}

		if (!password_verify($password, $user->password)) {
			return false;
		}

		$this->session->start();
		$this->session->set('id_user', $user->id_user);
		$this->session->set('uuid', $user->uuid);
		$this->session->set('name', $user->name);
		$this->session->set('role', $user->role);

		return true;
	}

	/**
	 * Cierra la sesión del usuario.
	 */
	public function logout(): void
	{
		$this->session->destroy();
	}
}

