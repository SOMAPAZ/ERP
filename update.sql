ALTER TABLE `employments` CHANGE `lastaname` `lastname` varchar(48) NOT NULL;

ALTER TABLE `status_agreements` CHANGE `name` `name` varchar(24) NOT NULL;

CREATE TABLE IF NOT EXISTS zone (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(240) NOT NULL
);

ALTER TABLE users ADD COLUMN id_zone bigint NOT NULL AFTER id_locality;

ALTER TABLE users ADD CONSTRAINT users_id_zone_fk FOREIGN KEY (`id_zone`) REFERENCES zone (`id`);