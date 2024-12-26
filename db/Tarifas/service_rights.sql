-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-12-2024 a las 19:26:03
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
-- Estructura de tabla para la tabla `service_rights`
--

DROP TABLE IF EXISTS `service_rights`;
CREATE TABLE IF NOT EXISTS `service_rights` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `id_service` bigint DEFAULT NULL,
  `id_intaketype` bigint DEFAULT NULL,
  `year` bigint DEFAULT NULL,
  `iva` int NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_service` (`id_service`),
  KEY `id_intaketype` (`id_intaketype`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `service_rights`
--

INSERT INTO `service_rights` (`id`, `id_service`, `id_intaketype`, `year`, `iva`, `amount`) VALUES
(1, 1, 2, 2024, 1, 2037.84),
(2, 1, 3, 2024, 1, 2436.22),
(3, 1, 5, 2024, 1, 2436.22),
(4, 1, 6, 2024, 1, 2436.22),
(5, 1, 7, 2024, 1, 2436.22),
(6, 1, 8, 2024, 1, 2436.22),
(7, 1, 9, 2024, 1, 2436.22),
(8, 2, 2, 2024, 1, 2037.84),
(9, 2, 3, 2024, 1, 2436.22),
(10, 2, 5, 2024, 1, 2436.22),
(11, 2, 6, 2024, 1, 2436.22),
(12, 2, 7, 2024, 1, 2436.22),
(13, 2, 8, 2024, 1, 2436.22),
(14, 2, 9, 2024, 1, 2436.22),
(15, 3, 2, 2024, 1, 516.29),
(16, 3, 3, 2024, 1, 962.70),
(17, 4, 3, 2024, 1, 724.78),
(18, 4, 2, 2024, 1, 516.29),
(19, 1, 2, 2025, 1, 2129.54),
(20, 1, 3, 2025, 1, 2545.85),
(21, 1, 5, 2025, 1, 2545.85),
(22, 1, 6, 2025, 1, 2545.85),
(23, 1, 7, 2025, 1, 2545.85),
(24, 1, 8, 2025, 1, 2545.85),
(25, 1, 9, 2025, 1, 2545.85),
(26, 3, 2, 2025, 1, 539.52),
(27, 3, 3, 2025, 1, 1006.02),
(30, 2, 2, 2025, 0, 2129.54),
(31, 2, 3, 2025, 1, 2545.85),
(32, 2, 5, 2025, 1, 2545.85),
(33, 2, 6, 2025, 1, 2545.85),
(34, 2, 7, 2025, 1, 2545.85),
(35, 2, 8, 2025, 1, 2545.85),
(36, 2, 9, 2025, 1, 2545.85),
(37, 4, 2, 2025, 0, 539.52),
(38, 4, 3, 2025, 1, 757.40);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `service_rights`
--
ALTER TABLE `service_rights`
  ADD CONSTRAINT `service_rights_ibfk_1` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `service_rights_ibfk_2` FOREIGN KEY (`id_intaketype`) REFERENCES `intake_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
