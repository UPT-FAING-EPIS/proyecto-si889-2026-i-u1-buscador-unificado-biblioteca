-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.17.0.7270
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para bd_nexus
CREATE DATABASE IF NOT EXISTS `bd_nexus` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bd_nexus`;

-- Volcando estructura para tabla bd_nexus.inventario
CREATE TABLE IF NOT EXISTS `inventario` (
  `id_inventario` int(11) NOT NULL AUTO_INCREMENT,
  `id_libro` int(11) NOT NULL,
  `piso` varchar(50) NOT NULL,
  `estante` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_inventario`),
  KEY `fk_libro_inventario` (`id_libro`),
  CONSTRAINT `fk_libro_inventario` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bd_nexus.inventario: ~13 rows (aproximadamente)
INSERT INTO `inventario` (`id_inventario`, `id_libro`, `piso`, `estante`, `stock`) VALUES
	(1, 1, 'Piso 2', 'Estante A-10', 5),
	(2, 2, 'Piso 2', 'Estante A-12', 0),
	(3, 3, 'Piso 2', 'Estante B-01', 3),
	(4, 4, 'Piso 1', 'Estante L-05', 10),
	(5, 5, 'Piso 1', 'Estante L-05', 2),
	(6, 6, 'Piso 3', 'Estante C-20', 0),
	(7, 7, 'Piso 2', 'Estante A-15', 4),
	(8, 8, 'Piso 1', 'Estante L-01', 8),
	(9, 9, 'Piso 3', 'Estante D-02', 6),
	(10, 10, 'Piso 3', 'Estante D-10', 3),
	(11, 11, 'Piso 2', 'Estante A-11', 3),
	(12, 12, 'Piso 2', 'Estante A-13', 2),
	(13, 13, 'Piso 1', 'Estante L-06', 4);

-- Volcando estructura para tabla bd_nexus.libros
CREATE TABLE IF NOT EXISTS `libros` (
  `id_libro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(150) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `digital_link` text DEFAULT NULL,
  `portada_url` text DEFAULT NULL,
  PRIMARY KEY (`id_libro`),
  UNIQUE KEY `isbn` (`isbn`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bd_nexus.libros: ~13 rows (aproximadamente)
INSERT INTO `libros` (`id_libro`, `titulo`, `autor`, `isbn`, `categoria`, `digital_link`, `portada_url`) VALUES
	(1, 'Steve Jobs', 'Walter Isaacson', '9781451648539', 'Biografía', 'https://elhacker.info/manuales/Lenguajes%20de%20Programacion/Codigo%20limpio%20-%20Robert%20Cecil%20Martin.pdf', 'https://bookscompany.pe/wp-content/uploads/2025/02/9788499897318.jpg'),
	(2, 'Leonardo da Vinci', 'Walter Isaacson', '9781501139154', 'Biografía', NULL, 'https://images.cdn2.buscalibre.com/fit-in/360x360/60/e9/60e9a905bdfc59e6765b2e148a3ee670.jpg'),
	(3, 'Dune', 'Frank Herbert', '9780441172719', 'Ciencia ficción', 'https://drive.google.com/file/d/1n55-9FCL8p4gqPyYXpZh2y22YgCpRriF/view', 'https://images.cdn2.buscalibre.com/fit-in/360x360/0d/73/0d739e6e0e837d7637f97f9aad3639b4.jpg'),
	(4, 'Fundación', 'Isaac Asimov', '9788497599245', 'Ciencia ficción', NULL, 'https://www.libreriasur.com.pe/imagenes/9788497/978849759922.webp'),
	(5, 'El Aleph', 'Jorge Luis Borges', '9788420633114', 'Cuentos', 'https://biblioteca.sanmartincusco.edu.pe/wp-content/uploads/2020/12/Garcia-Marquez.Cronica-de-una-muerte-anunciada.pdf', 'https://images.cdn1.buscalibre.com/fit-in/360x360/fd/af/fdafb136b6266281c67c860626a8490d.jpg'),
	(6, 'Diccionario de la lengua española', 'RAE', '9788467041897', 'Diccionarios', NULL, 'https://images.cdn1.buscalibre.com/fit-in/360x360/ff/24/ff24a643f40f32770b3ff74390cdb702.jpg'),
	(7, 'El laberinto de la soledad', 'Octavio Paz', '9788437505329', 'Ensayos', 'https://ebooks.karbust.me/Technology/Head%20First%20Design%20Patterns%20-%20Building%20Extensible%20and%20Maintainable%20Object-Oriented%20Software%20-%20Eric%20Freeman,%20Elisabeth%20Robson%20-%20O%27Reilly%20Media%20(2020).pdf', 'https://images.cdn2.buscalibre.com/fit-in/360x360/52/29/5229d448f38502b9d23da8de04e5dec8.jpg'),
	(8, 'Así habló Zaratustra', 'Friedrich Nietzsche', '9788420650913', 'Filosofía', 'https://www.suneo.mx/literatura/subidas/Miguel%20de%20Cervantes%20El%20Ingenioso%20Hidalgo%20Don%20Quijote%20de%20la%20Mancha.pdf', 'https://images.cdn1.buscalibre.com/fit-in/360x360/76/d1/76d106c929541eb2e86b3e61b8c7b8d3.jpg'),
	(9, 'Sapiens: De animales a dioses', 'Yuval Noah Harari', '9788499926223', 'Historia', NULL, 'https://www.libreriasur.com.pe/imagenes/9788419/978841939971.webp'),
	(10, 'Rayuela', 'Julio Cortázar', '9788420471006', 'Novelas', NULL, 'https://images.cdn3.buscalibre.com/fit-in/360x360/90/53/905322d10841b36aa311dbd5c90d92ed.jpg'),
	(11, 'Veinte poemas de amor y una canción desesperada', 'Pablo Neruda', '9788420643441', 'Poesía', 'https://drive.google.com/file/d/175e3WmWH_hauW8mMbWFJXkY56tEuMfCX/view', 'https://images.cdn3.buscalibre.com/fit-in/360x360/c5/ba/c5baee49526be2285b994485dc34dab3.jpg'),
	(12, 'Pedro Páramo', 'Juan Rulfo', '9788437604183', 'Novelas', NULL, 'https://images.cdn1.buscalibre.com/fit-in/360x360/ab/9e/ab9e7cc07f22e747d51d725d437cede3.jpg'),
	(13, 'Las venas abiertas de América Latina', 'Eduardo Galeano', '9789682325564', 'Historia', NULL, 'https://images.cdn1.buscalibre.com/fit-in/360x360/af/0d/af0dc0451c536102cbf847d41f691db5.jpg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
