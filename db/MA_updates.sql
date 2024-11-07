ALTER TABLE billing
  DROP id_amountwater;
ALTER TABLE billing ADD water DECIMAL(10,2) NOT NULL AFTER month;
ALTER TABLE `billing`
  DROP `id_sanitation`;
ALTER TABLE `billing` ADD `sanitation` DECIMAL(10,2) NOT NULL AFTER `drain_iva`;
