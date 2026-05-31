CREATE TABLE saved_books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_uuid CHAR(36) NOT NULL COMMENT 'UUID proveniente del auth-service',
    codigo VARCHAR(100) NOT NULL COMMENT 'Código del libro general',
    fecha_guardado DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_saved (user_uuid, codigo) -- ¡La magia anti-duplicados!
);