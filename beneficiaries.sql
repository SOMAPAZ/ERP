/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `beneficiaries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `lastname` varchar(60) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `relationship` varchar(24) DEFAULT NULL,
  `clave_elector` varchar(20) DEFAULT NULL,
  `id_user` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `beneficiaries_id_user_fk` (`id_user`),
  CONSTRAINT `beneficiaries_id_user_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `beneficiaries` (`id`, `name`, `lastname`, `email`, `phone`, `relationship`, `clave_elector`, `id_user`) VALUES
(1, 'Nombre_1', 'Apellido_1', 'correo@correo.com', '3642316549', 'Hermano', 'A123456789012345678', 1);
INSERT INTO `beneficiaries` (`id`, `name`, `lastname`, `email`, `phone`, `relationship`, `clave_elector`, `id_user`) VALUES
(2, 'Nombre_2', 'Apellido_2', 'correo2@correo.com', '6432136212', 'Hijo', 'B987654321098765432', 2);
INSERT INTO `beneficiaries` (`id`, `name`, `lastname`, `email`, `phone`, `relationship`, `clave_elector`, `id_user`) VALUES
(3, 'Nombre_2', 'Apellido_2', 'correo2@correo.com', '6432136212', 'Hijo', 'C345678901234567890', 1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;