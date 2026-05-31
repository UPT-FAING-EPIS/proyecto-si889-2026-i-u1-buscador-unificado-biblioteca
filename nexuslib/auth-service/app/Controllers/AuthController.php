<?php

require_once __DIR__ . '/../Services/AuthService.php';

class AuthController
{
	private AuthService $auth;

	public function __construct(AuthService $auth)
	{
		$this->auth = $auth;
	}

	/** Respuesta JSON uniforme */
	private function jsonResponse($data, int $statusCode = 200)
	{
		http_response_code($statusCode);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		return null;
	}

	public function register()
	{
		$body = json_decode(file_get_contents('php://input'), true) ?: [];
		$name = $body['name'] ?? null;
		$email = $body['email'] ?? null;
		$password = $body['password'] ?? null;

		if (!$name || !$email || !$password) {
			return $this->jsonResponse(['error' => 'Faltan datos requeridos'], 400);
		}

		$ok = $this->auth->register($name, $email, $password);
		if ($ok) {
			return $this->jsonResponse(['success' => true], 200);
		}

		return $this->jsonResponse(['error' => 'No se pudo registrar el usuario'], 400);
	}

	public function login()
	{
		$body = json_decode(file_get_contents('php://input'), true) ?: [];
		$email = $body['email'] ?? null;
		$password = $body['password'] ?? null;

		if (!$email || !$password) {
			return $this->jsonResponse(['error' => 'Faltan credenciales'], 400);
		}

		$ok = $this->auth->login($email, $password);
		if ($ok) {
			return $this->jsonResponse(['success' => true], 200);
		}

		return $this->jsonResponse(['error' => 'Credenciales inválidas'], 401);
	}

	public function logout()
	{
		$this->auth->logout();
		return $this->jsonResponse(['success' => true], 200);
	}
}

