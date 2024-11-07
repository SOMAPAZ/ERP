ALTER TABLE billing
  DROP id_amountwater;
ALTER TABLE billing ADD water DECIMAL(10,2) NOT NULL AFTER month;
ALTER TABLE `billing`
  DROP `id_sanitation`;
ALTER TABLE `billing` ADD `sanitation` DECIMAL(10,2) NOT NULL AFTER `drain_iva`;
ALTER TABLE `billing` CHANGE `year` `year` INT(10) NOT NULL;
ALTER TABLE `billing` CHANGE `date_billing` `date_billing` VARCHAR(16) NOT NULL;
ALTER TABLE `billing` CHANGE `id_employment` `id_employment` BIGINT(20) NULL;
