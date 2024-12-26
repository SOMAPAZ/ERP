-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-12-2024 a las 19:25:15
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `master_facturaction`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formats`
--

DROP TABLE IF EXISTS `formats`;
CREATE TABLE IF NOT EXISTS `formats` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `id_account` bigint DEFAULT NULL,
  `year` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `iva` bigint NOT NULL,
  `edit` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_formats_account` (`id_account`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `formats`
--

INSERT INTO `formats` (`id`, `id_account`, `year`, `amount`, `iva`, `edit`) VALUES
(1, 3, 2024, 70.75, 1, 0),
(2, 4, 2024, 153.89, 1, 0),
(3, 5, 2024, 153.89, 1, 0),
(4, 6, 2024, 153.89, 1, 0),
(5, 7, 2024, 153.89, 1, 0),
(6, 8, 2024, 78.15, 1, 0),
(7, 9, 2024, 506.86, 1, 0),
(8, 10, 2024, 30.82, 1, 0),
(11, 3, 2025, 73.93, 1, 0),
(12, 4, 2025, 160.82, 1, 0),
(13, 5, 2025, 160.82, 1, 0),
(14, 6, 2025, 160.82, 1, 0),
(15, 7, 2025, 160.82, 1, 0),
(16, 8, 2025, 81.67, 1, 0),
(17, 9, 2025, 529.67, 1, 0),
(18, 10, 2025, 32.21, 1, 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `formats`
--
ALTER TABLE `formats`
  ADD CONSTRAINT `fk_formats_account` FOREIGN KEY (`id_account`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
