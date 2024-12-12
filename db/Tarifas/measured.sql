-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-12-2024 a las 23:28:49
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
-- Estructura de tabla para la tabla `measured`
--

DROP TABLE IF EXISTS `measured`;
CREATE TABLE IF NOT EXISTS `measured` (
  `id` bigint NOT NULL,
  `id_intaketype` bigint DEFAULT NULL,
  `id_consumtype` bigint DEFAULT NULL,
  `year` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `liminf` bigint DEFAULT NULL,
  `limsup` bigint DEFAULT NULL,
  `excm3` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_intaketype` (`id_intaketype`),
  KEY `id_consumtype` (`id_consumtype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `measured`
--

INSERT INTO `measured` (`id`, `id_intaketype`, `id_consumtype`, `year`, `amount`, `liminf`, `limsup`, `excm3`) VALUES
(1, 2, 11, '2021', 76.00, 0, 19, 4.00),
(2, 2, 12, '2021', 103.00, 0, 25, 4.12),
(3, 3, 5, '2021', 85.50, 0, 19, 4.50),
(4, 3, 6, '2021', 125.00, 0, 25, 5.00),
(5, 5, 5, '2021', 152.00, 0, 19, 8.00),
(6, 5, 6, '2021', 375.00, 0, 25, 15.00),
(7, 5, 7, '2021', 750.00, 0, 30, 25.00),
(8, 5, 8, '2021', 980.00, 0, 35, 28.00),
(9, 3, 5, '2022', 88.92, 0, 19, 4.68),
(10, 3, 6, '2022', 130.00, 0, 25, 5.20),
(11, 2, 11, '2022', 78.28, 0, 19, 4.12),
(12, 2, 12, '2022', 106.09, 0, 25, 4.24),
(13, 5, 5, '2022', 161.12, 0, 19, 8.48),
(14, 5, 6, '2022', 397.50, 0, 25, 15.90),
(15, 5, 8, '2022', 1038.80, 0, 35, 29.68),
(16, 5, 7, '2022', 795.00, 0, 30, 26.50),
(17, 2, 11, '2023', 84.85, 0, 20, 4.46),
(18, 2, 12, '2023', 115.00, 0, 25, 4.46),
(19, 3, 5, '2023', 96.39, 0, 20, 5.07),
(20, 3, 6, '2023', 140.92, 0, 25, 5.64),
(21, 5, 5, '2023', 174.65, 0, 20, 9.19),
(22, 5, 6, '2023', 430.89, 0, 25, 17.23),
(23, 5, 7, '2023', 861.78, 0, 30, 28.73),
(24, 5, 8, '2023', 1126.06, 0, 35, 32.17),
(25, 2, 11, '2024', 84.85, 0, 20, 4.46),
(26, 2, 12, '2024', 115.00, 0, 25, 4.60),
(27, 3, 5, '2024', 96.39, 0, 20, 5.07),
(28, 3, 6, '2024', 140.92, 0, 25, 5.64),
(29, 5, 5, '2024', 174.65, 0, 20, 9.19),
(30, 5, 6, '2024', 430.89, 0, 25, 17.23),
(31, 5, 7, '2024', 861.78, 0, 30, 28.73),
(32, 5, 8, '2024', 1126.06, 0, 35, 32.17);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `measured`
--
ALTER TABLE `measured`
  ADD CONSTRAINT `measured_ibfk_1` FOREIGN KEY (`id_intaketype`) REFERENCES `intake_type` (`id`),
  ADD CONSTRAINT `measured_ibfk_2` FOREIGN KEY (`id_consumtype`) REFERENCES `consume_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
