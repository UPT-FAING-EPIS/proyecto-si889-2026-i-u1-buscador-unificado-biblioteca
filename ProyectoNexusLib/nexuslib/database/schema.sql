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
	(1, 'Clean Code', 'Robert C. Martin', '9780132350884', 'Ingeniería de Software', 'https://elhacker.info/manuales/Lenguajes%20de%20Programacion/Codigo%20limpio%20-%20Robert%20Cecil%20Martin.pdf', 'https://ia600507.us.archive.org/view_archive.php?archive=/13/items/olcovers554/olcovers554-L.zip&file=5547794-L.jpg'),
	(2, 'Design Patterns', 'Erich Gamma', '9780201633610', 'Ingeniería de Software', NULL, 'https://ia600404.us.archive.org/view_archive.php?archive=/33/items/l_covers_0010/l_covers_0010_82.zip&file=0010827043-L.jpg'),
	(3, 'The Pragmatic Programmer', 'Andrew Hunt', '9780135957059', 'Ingeniería de Software', 'https://drive.google.com/file/d/1n55-9FCL8p4gqPyYXpZh2y22YgCpRriF/view', 'https://m.media-amazon.com/images/I/5187sT8UjmL._SY445_SX342_ML2_.jpg'),
	(4, 'Cien años de soledad', 'Gabriel García Márquez', '9780307474728', 'Literatura', NULL, 'https://ia801705.us.archive.org/view_archive.php?archive=/29/items/l_covers_0008/l_covers_0008_06.zip&file=0008065355-L.jpg'),
	(5, 'Crónica de una muerte anunciada', 'Gabriel García Márquez', '9781400034956', 'Literatura', 'https://biblioteca.sanmartincusco.edu.pe/wp-content/uploads/2020/12/Garcia-Marquez.Cronica-de-una-muerte-anunciada.pdf', 'https://ia601204.us.archive.org/view_archive.php?archive=/26/items/olcovers74/olcovers74-L.zip&file=745056-L.jpg'),
	(6, 'Introduction to Algorithms', 'Thomas H. Cormen', '9780262033848', 'Ciencias de la Computación', NULL, 'https://ia601701.us.archive.org/view_archive.php?archive=/4/items/l_covers_0011/l_covers_0011_10.zip&file=0011106524-L.jpg'),
	(7, 'Head First Design Patterns', 'Eric Freeman', '9780596007126', 'Ingeniería de Software', 'https://ebooks.karbust.me/Technology/Head%20First%20Design%20Patterns%20-%20Building%20Extensible%20and%20Maintainable%20Object-Oriented%20Software%20-%20Eric%20Freeman,%20Elisabeth%20Robson%20-%20O%27Reilly%20Media%20(2020).pdf', 'https://ia801507.us.archive.org/view_archive.php?archive=/14/items/olcovers38/olcovers38-L.zip&file=388950-L.jpg'),
	(8, 'Don Quijote de la Mancha', 'Miguel de Cervantes', '9788424116286', 'Literatura', 'https://www.suneo.mx/literatura/subidas/Miguel%20de%20Cervantes%20El%20Ingenioso%20Hidalgo%20Don%20Quijote%20de%20la%20Mancha.pdf', 'https://images.cdn2.buscalibre.com/fit-in/360x360/73/b6/73b6fd96c31d26e2b6a3531808c1188c.jpg'),
	(9, 'Database System Concepts', 'Abraham Silberschatz', '9780073523323', 'Ciencias de la Computación', NULL, 'https://ia601705.us.archive.org/view_archive.php?archive=/29/items/l_covers_0008/l_covers_0008_63.zip&file=0008635569-L.jpg'),
	(10, 'Artificial Intelligence: A Modern Approach', 'Stuart Russell', '9780136042594', 'Ciencias de la Computación', NULL, 'https://ia803105.us.archive.org/view_archive.php?archive=/19/items/olcovers694/olcovers694-L.zip&file=6941675-L.jpg'),
	(11, 'Clean Architecture', 'Robert C. Martin', '9780134494166', 'Ingeniería de Software', 'https://drive.google.com/file/d/175e3WmWH_hauW8mMbWFJXkY56tEuMfCX/view', 'https://ia801705.us.archive.org/view_archive.php?archive=/29/items/l_covers_0008/l_covers_0008_51.zip&file=0008510059-L.jpg'),
	(12, 'Clean Agile', 'Robert C. Martin', '9780135781869', 'Metodologías Ágiles', NULL, 'https://ia600404.us.archive.org/view_archive.php?archive=/33/items/l_covers_0010/l_covers_0010_22.zip&file=0010222947-L.jpg'),
	(13, 'El amor en los tiempos del cólera', 'Gabriel García Márquez', '9780307387264', 'Literatura', NULL, 'https://ia802807.us.archive.org/view_archive.php?archive=/10/items/olcovers236/olcovers236-L.zip&file=2360550-L.jpg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
