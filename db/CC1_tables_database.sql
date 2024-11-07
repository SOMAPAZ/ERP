CREATE SCHEMA IF NOT EXISTS `master_facturaction` ;

USE `master_facturaction`;

CREATE TABLE IF NOT EXISTS `billing` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_user` bigint NOT NULL,
  `year` tinyint NOT NULL,
  `month` tinyint NOT NULL,
  `id_amountwater` tinyint NOT NULL,
  `water_late` decimal(10,2) NOT NULL,
  `water_iva` decimal(10,2) NOT NULL,
  `water_late_discount` decimal(10,2) NOT NULL,
  `drain` decimal(10,2) NOT NULL,
  `drain_late` decimal(10,2) NOT NULL,
  `drain_late_discount` decimal(10,2) NOT NULL,
  `drain_iva` decimal(10,2) NOT NULL,
  `id_sanitation` decimal(10,2) NOT NULL,
  `sanitation_late` decimal(10,2) NOT NULL,
  `sanitation_late_discount` decimal(10,2) NOT NULL,
  `sanitation_iva` decimal(10,2) NOT NULL,
  `date_billing` datetime NOT NULL,
  `foliate` varchar(6) NOT NULL,
  `id_agreement` bigint,
  `advance_payment` decimal(10,2),
  `advance_payment_water` decimal(10,2),
  `advance_payment_drain` decimal(10,2),
  `advance_payment_sanitation` decimal(10,2),
  `advance_payment_iva` decimal(10,2),
  `id_employment` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `colony` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `consume_intake` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_intaketype` bigint NOT NULL,
  `id_consumtype` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `consume_type` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `intake_type` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `locality` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `service_status` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `service_type` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `zone` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user` varchar(240) NOT NULL,
  `lastname` varchar(240),
  `phone` varchar(12),
  `address` varchar(240) NOT NULL,
  `reference` mediumtext,
  `id_colony` bigint NOT NULL,
  `id_locality` bigint NOT NULL,
  `id_zone` bigint NOT NULL,
  `block` varchar(48),
  `int_num` varchar(10),
  `ext_num` varchar(10),
  `mail` varchar(48),
  `rfc` char(13),
  `clave_elector` char(18),
  `id_usertype` bigint NOT NULL,
  `id_intaketype` bigint NOT NULL,
  `id_servicetype` bigint NOT NULL,
  `id_servicestatus` bigint NOT NULL,
  `id_consumtype` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `agreenmets` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_user` bigint NOT NULL,
  `foliate` varchar(11),
  `beneficiary` varchar(48) NOT NULL,
  `phone_benef` varchar(12) NOT NULL,
  `debt` decimal(10,2) NOT NULL,
  `period_init` date NOT NULL,
  `period_end` date NOT NULL,
  `months` tinyint NOT NULL,
  `advance_payment` decimal(10,2) NOT NULL,
  `comment` varchar(240) NOT NULL,
  `discharge_date` date NOT NULL,
  `id_status_agreement` bigint NOT NULL,
  `id_employment` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `status_agreements` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `payments_agreements` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_agreement` bigint NOT NULL,
  `payment_number` int NOT NULL,
  `quantity_months` bigint NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_payment` date NOT NULL,
  `id_status_agreement_payment` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `status_agreement_payment` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `employments` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(24) NOT NULL,
  `lastaname` varchar(48) NOT NULL,
  `mail` varchar(48) NOT NULL,
  `password` char(60) NOT NULL,
  `id_rol` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- NUEVAS TABLAS

CREATE TABLE IF NOT EXISTS `invoice_history` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_user` bigint NOT NULL,
  `folio` varchar(11) NOT NULL,
  `date_invoice` varchar(16) NOT NULL,
  `date_initial` varchar(16) NOT NULL,
  `date_final` varchar(16) NOT NULL,
  `amount` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `payment_invoice` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_user` bigint NOT NULL, 
  `folio` varchar(11) NOT NULL,
  `date` varchar(16) NOT NULL,
  `date_initial` varchar(16) NOT NULL,
  `date_final` varchar(16) NOT NULL,
  `cancelated` tinyint NOT NULL,
  `current_water` decimal(10,2) NOT NULL,
  `current_water_discount` decimal(10,2) NOT NULL,
  `water_late` decimal(10,2) NOT NULL,
  `water_iva` decimal(10,4) NOT NULL,
  `water_surcharge` decimal(10,2) NOT NULL,
  `water_surcharge_discount` decimal(10,2) NOT NULL,
  `current_drain` decimal(10,2) NOT NULL,
  `current_drain_discount` decimal(10,2) NOT NULL,
  `drain_late` decimal(10,2) NOT NULL,
  `drain_iva` decimal(10,4) NOT NULL,
  `drain_surcharge` decimal(10,2) NOT NULL,
  `drain_surcharge_discount` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `iva` decimal(10,4) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `billing` ADD CONSTRAINT billing_id_user_fk FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
ALTER TABLE `consume_intake` ADD CONSTRAINT consume_intake_id_consumtype_fk FOREIGN KEY (`id_consumtype`) REFERENCES `consume_type` (`id`);
ALTER TABLE `consume_intake` ADD CONSTRAINT consume_intake_id_intaketype_fk FOREIGN KEY (`id_intaketype`) REFERENCES `intake_type` (`id`);
ALTER TABLE `users` ADD CONSTRAINT users_id_colony_fk FOREIGN KEY (`id_colony`) REFERENCES `colony` (`id`);
ALTER TABLE `users` ADD CONSTRAINT users_id_consumtype_fk FOREIGN KEY (`id_consumtype`) REFERENCES `consume_type` (`id`);
ALTER TABLE `users` ADD CONSTRAINT users_id_intaketype_fk FOREIGN KEY (`id_intaketype`) REFERENCES `intake_type` (`id`);
ALTER TABLE `users` ADD CONSTRAINT users_id_locality_fk FOREIGN KEY (`id_locality`) REFERENCES `locality` (`id`);
ALTER TABLE `users` ADD CONSTRAINT users_id_zone_fk FOREIGN KEY (`id_zone`) REFERENCES `zone` (`id`);
ALTER TABLE `users` ADD CONSTRAINT users_id_servicestatus_fk FOREIGN KEY (`id_servicestatus`) REFERENCES `service_status` (`id`);
ALTER TABLE `users` ADD CONSTRAINT users_id_servicetype_fk FOREIGN KEY (`id_servicetype`) REFERENCES `service_type` (`id`);
ALTER TABLE `users` ADD CONSTRAINT users_id_usertype_fk FOREIGN KEY (`id_usertype`) REFERENCES `user_type` (`id`);
ALTER TABLE `agreenmets` ADD CONSTRAINT agreenmets_id_user_fk FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
ALTER TABLE `agreenmets` ADD CONSTRAINT agreements_id_status_agreement_fk FOREIGN KEY (`id_status_agreement`) REFERENCES `status_agreements` (`id`);
ALTER TABLE `payments_agreements` ADD CONSTRAINT payments_agreements_id_status_agreement_payment_fk FOREIGN KEY (`id_status_agreement_payment`) REFERENCES `status_agreement_payment` (`id`);
ALTER TABLE `payments_agreements` ADD CONSTRAINT payments_agreements_id_agreement_fk FOREIGN KEY (`id_agreement`) REFERENCES `agreenmets` (`id`);
ALTER TABLE `employments` ADD CONSTRAINT employments_id_rol_fk FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);
ALTER TABLE `billing` ADD CONSTRAINT billing_id_employments_fk FOREIGN KEY (`id_employment`) REFERENCES `employments` (`id`);
ALTER TABLE `agreenmets` ADD CONSTRAINT agreenmets_id_employments_fk FOREIGN KEY (`id_employment`) REFERENCES `employments` (`id`);
-- NUEVAS LLAVES FORANEAS
ALTER TABLE `invoice_history` ADD CONSTRAINT invoice_history_id_users_fk FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
ALTER TABLE `payment_invoice` ADD CONSTRAINT payment_invoice_id_users_fk FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
