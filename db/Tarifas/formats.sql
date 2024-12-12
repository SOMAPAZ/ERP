-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-12-2024 a las 23:29:25
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
  `id` bigint NOT NULL,
  `id_account` bigint DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `iva` bigint DEFAULT NULL,
  `editable` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_account` (`id_account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `formats`
--

INSERT INTO `formats` (`id`, `id_account`, `amount`, `iva`, `editable`) VALUES
(1, 1, 0.00, 0, 0),
(2, 2, 0.00, 1, 0),
(3, 3, 0.00, 1, 0),
(4, 4, 0.00, 1, 0),
(5, 5, 0.00, 1, 0),
(6, 6, 1658.00, 1, 0),
(7, 7, 250.00, 1, 0),
(8, 8, 0.00, 0, 0),
(9, 9, 0.00, 1, 0),
(10, 10, 810.00, 1, 0),
(11, 11, 0.00, 1, 0),
(12, 12, 198.00, 1, 0),
(13, 13, 0.00, 1, 0),
(14, 14, 0.00, 1, 0),
(15, 15, 0.00, 1, 0),
(16, 16, 0.00, 1, 0),
(17, 17, 250.00, 1, 0),
(18, 18, 0.00, 0, 0),
(19, 19, 0.00, 0, 0),
(20, 20, 0.00, 0, 0),
(21, 21, 97.00, 1, 0),
(22, 22, 97.00, 1, 0),
(23, 23, 50.00, 1, 0),
(24, 24, 0.00, 0, 0),
(25, 25, 0.00, 1, 0),
(26, 26, 0.00, 1, 0),
(27, 27, 0.00, 1, 0),
(28, 28, 0.00, 0, 0),
(29, 29, 0.00, 1, 0),
(30, 30, 0.00, 0, 0),
(31, 31, 1658.00, 1, 0),
(32, 32, 48.00, 1, 0),
(33, 33, 0.00, 1, 0),
(34, 34, 0.00, 0, 1),
(35, 35, 0.00, 0, 1),
(36, 36, 0.00, 0, 1),
(37, 37, 0.00, 1, 1),
(38, 38, 0.00, 0, 1),
(39, 39, 0.00, 0, 1),
(40, 40, 0.00, 1, 1),
(41, 41, 0.00, 0, 0),
(42, 42, 0.00, 0, 0),
(43, 43, 0.00, 0, 0),
(44, 44, 0.00, 0, 0),
(45, 45, 0.00, 1, 0),
(46, 46, 0.00, 1, 0),
(47, 47, 0.00, 1, 0),
(48, 48, 78.62, 0, 0),
(49, 49, 0.00, 0, 0),
(50, 50, 118.00, 1, 0),
(51, 51, 0.00, 1, 1),
(52, 52, 0.00, 0, 1),
(53, 53, 0.00, 0, 0),
(54, 54, 0.00, 1, 0),
(55, 55, 0.00, 1, 0),
(56, 56, 0.00, 1, 1),
(57, 57, 0.00, 0, 0),
(58, 58, 0.00, 1, 0),
(59, 59, 0.00, 0, 0),
(60, 60, 0.00, 0, 0),
(61, 61, 0.00, 0, 1),
(62, 62, 0.00, 0, 0),
(63, 63, 153.89, 1, 0),
(64, 64, 0.00, 1, 1),
(65, 65, 391.56, 1, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `formats`
--
ALTER TABLE `formats`
  ADD CONSTRAINT `formats_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `account` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
