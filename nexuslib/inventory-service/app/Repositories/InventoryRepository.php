<?php

require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../Models/Resource.php';
require_once __DIR__ . '/InventoryRepositoryInterface.php';

class InventoryRepository implements InventoryRepositoryInterface
{
	private PDO $pdo;

	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

    public function searchResources(string $keyword): array
    {
        $sql = "
            SELECT
                registro,
                codigo,
                titulo,
                autor,
                biblioteca,
                tipo,
                procedencia,
                fecha,
                estado
            FROM inventory
            WHERE titulo LIKE :keyword_titulo
               OR autor LIKE :keyword_autor
            ORDER BY titulo ASC, registro ASC
        ";

        $stmt = $this->pdo->prepare($sql);
        $search = '%' . trim($keyword) . '%';
        
        // Le pasamos el mismo dato, pero a sus respectivos parámetros únicos
        $stmt->bindValue(':keyword_titulo', $search, PDO::PARAM_STR);
        $stmt->bindValue(':keyword_autor', $search, PDO::PARAM_STR);
        
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $resources = [];

        foreach ($rows as $row) {
            $resources[] = $this->hydrateResource($row);
        }

        return $resources;
    }

	public function getExemplaresByCodigo(string $codigo): array
	{
		$sql = "
			SELECT
				registro,
				codigo,
				titulo,
				autor,
				biblioteca,
				tipo,
				procedencia,
				fecha,
				estado
			FROM inventory
			WHERE codigo = :codigo
			ORDER BY registro ASC
		";

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':codigo', $codigo, PDO::PARAM_STR);
		$stmt->execute();

		$rows = $stmt->fetchAll();
		$resources = [];

		foreach ($rows as $row) {
			$resources[] = $this->hydrateResource($row);
		}

		return $resources;
	}

	public function getEstadoByRegistro(int $registro): ?string
	{
		$sql = 'SELECT estado FROM inventory WHERE registro = :registro LIMIT 1';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':registro', $registro, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row === false || $row === null) {
			return null;
		}

		return $row['estado'] ?? null;
	}

	public function updateEstadoByRegistro(int $registro, string $estado): bool
	{
		$sql = 'UPDATE inventory SET estado = :estado WHERE registro = :registro';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':estado', $estado, PDO::PARAM_STR);
		$stmt->bindValue(':registro', $registro, PDO::PARAM_INT);
		$stmt->execute();

		return ($stmt->rowCount() > 0);
	}

	private function hydrateResource(array $row): Resource
	{
		$resource = new Resource();

		$resource->setRegistro(isset($row['registro']) ? (int) $row['registro'] : null);
		$resource->setCodigo($row['codigo'] ?? null);
		$resource->setTitulo($row['titulo'] ?? '');
		$resource->setAutor($row['autor'] ?? null);
		$resource->setBiblioteca($row['biblioteca'] ?? null);
		$resource->setTipo($row['tipo'] ?? null);
		$resource->setProcedencia($row['procedencia'] ?? null);
		$resource->setFecha($row['fecha'] ?? null);
		$resource->setEstado($row['estado'] ?? 'Disponible');

		return $resource;
	}
}
