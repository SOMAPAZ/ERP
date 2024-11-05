-- FORANEAS
ALTER TABLE `billing` DROP FOREIGN KEY `billing_id_user_fk`;
ALTER TABLE `agreenmets` DROP FOREIGN KEY `agreenmets_id_user_fk`;

DROP TABLE `master_facturaction`.`users`;

CREATE TABLE IF NOT EXISTS users (
  `id` bigint NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user` varchar(24) NOT NULL,
  `lastname` varchar(48),
  `phone` varchar(12),
  `address` varchar(48) NOT NULL,
  `reference` mediumtext,
  `id_colony` bigint,
  `id_locality` bigint,
  `id_zone` bigint,
  `block` varchar(48),
  `int_num` smallint,
  `ext_num` smallint,
  `mail` varchar(48),
  `rfc` char(13),
  `clave_elector` char(18),
  `id_usertype` bigint NOT NULL,
  `id_intaketype` bigint NOT NULL,
  `id_servicetype` bigint NOT NULL,
  `id_servicestatus` bigint NOT NULL,
  `id_consumtype` bigint NOT NULL
);

ALTER TABLE billing ADD CONSTRAINT billing_id_user_fk FOREIGN KEY (`id_user`) REFERENCES users(`id`);
ALTER TABLE users ADD CONSTRAINT users_id_colony_fk FOREIGN KEY (`id_colony`) REFERENCES colony (`id`);

ALTER TABLE users ADD CONSTRAINT users_id_consumtype_fk FOREIGN KEY (`id_consumtype`) REFERENCES consume_type (`id`);
ALTER TABLE users ADD CONSTRAINT users_id_intaketype_fk FOREIGN KEY (`id_intaketype`) REFERENCES intake_type (`id`);
ALTER TABLE users ADD CONSTRAINT users_id_locality_fk FOREIGN KEY (`id_locality`) REFERENCES locality (`id`);
ALTER TABLE users ADD CONSTRAINT users_id_servicestatus_fk FOREIGN KEY (`id_servicestatus`) REFERENCES service_status (`id`);
ALTER TABLE users ADD CONSTRAINT users_id_servicetype_fk FOREIGN KEY (`id_servicetype`) REFERENCES service_type (`id`);
ALTER TABLE users ADD CONSTRAINT users_id_usertype_fk FOREIGN KEY (`id_usertype`) REFERENCES user_type (`id`);
ALTER TABLE agreenmets ADD CONSTRAINT agreenmets_id_user_fk FOREIGN KEY (`id_user`) REFERENCES users (`id`);

ALTER TABLE `users` CHANGE `int_num` `int_num` VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE `users` CHANGE `ext_num` `ext_num` VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE `users` CHANGE `address` `address` VARCHAR(240) NULL DEFAULT NULL;
ALTER TABLE `users` CHANGE `user` `user` VARCHAR(240) NOT NULL;
ALTER TABLE `users` CHANGE `lastname` `lastname` VARCHAR(240) NOT NULL;