CREATE TABLE reserved_books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_uuid CHAR(36) NOT NULL COMMENT 'UUID proveniente del auth-service',
    registro INT NOT NULL COMMENT 'Registro del ejemplar físico',
    estado VARCHAR(50) DEFAULT 'Pendiente',
    fecha_reserva DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_reserved (user_uuid, registro) -- Evita reservar el mismo ejemplar 2 veces
);