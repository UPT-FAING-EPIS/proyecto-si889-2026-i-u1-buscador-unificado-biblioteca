<?php

class SavedBook
{
	private ?int $id = null;
	private string $user_uuid = '';
	private string $codigo = '';
	private ?string $fecha_guardado = null;

	public function __construct(array $data = [])
	{
		if (isset($data['id'])) {
			$this->id = (int) $data['id'];
		}

		$this->user_uuid = $data['user_uuid'] ?? '';
		$this->codigo = $data['codigo'] ?? '';
		$this->fecha_guardado = $data['fecha_guardado'] ?? null;
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function setId(?int $id): void
	{
		$this->id = $id;
	}

	public function getUserUuid(): string
	{
		return $this->user_uuid;
	}

	public function setUserUuid(string $user_uuid): void
	{
		$this->user_uuid = $user_uuid;
	}

	public function getCodigo(): string
	{
		return $this->codigo;
	}

	public function setCodigo(string $codigo): void
	{
		$this->codigo = $codigo;
	}

	public function getFechaGuardado(): ?string
	{
		return $this->fecha_guardado;
	}

	public function setFechaGuardado(?string $fecha_guardado): void
	{
		$this->fecha_guardado = $fecha_guardado;
	}
}
