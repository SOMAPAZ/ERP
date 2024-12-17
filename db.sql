CREATE SCHEMA IF NOT EXISTS master_facturaction;

CREATE TABLE IF NOT EXISTS master_facturaction.users (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user varchar(500) NOT NULL,
  lastname varchar(500),
  phone varchar(500),
  address varchar(500) NOT NULL,
  reference mediumtext,
  id_colony bigint NOT NULL,
  id_locality bigint NOT NULL,
  id_zone bigint NOT NULL,
  block varchar(500),
  int_num varchar(500),
  ext_num varchar(500),
  mail varchar(500),
  rfc char,
  clave_elector char,
  id_usertype bigint NOT NULL,
  id_intaketype bigint NOT NULL,
  id_servicetype bigint NOT NULL,
  id_servicestatus bigint NOT NULL,
  id_consumtype bigint NOT NULL,
  id_userStorage int,
  storage_height int,
  inhabitants int,
  stored_water decimal(10, 2),
  id_type_peson int
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.users (id);
CREATE INDEX master_facturaction_users_id_colony_fk ON master_facturaction.users (id_colony);
CREATE INDEX master_facturaction_users_id_consumtype_fk ON master_facturaction.users (id_consumtype);
CREATE INDEX master_facturaction_users_id_intaketype_fk ON master_facturaction.users (id_intaketype);
CREATE INDEX master_facturaction_users_id_locality_fk ON master_facturaction.users (id_locality);
CREATE INDEX master_facturaction_users_id_zone_fk ON master_facturaction.users (id_zone);
CREATE INDEX master_facturaction_users_id_servicestatus_fk ON master_facturaction.users (id_servicestatus);
CREATE INDEX master_facturaction_users_id_servicetype_fk ON master_facturaction.users (id_servicetype);
CREATE INDEX master_facturaction_users_id_usertype_fk ON master_facturaction.users (id_usertype);
CREATE INDEX master_facturaction_id_userStorage ON master_facturaction.users (id_userStorage);

CREATE TABLE IF NOT EXISTS master_facturaction.status_report (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500)
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.status_report (id);

CREATE TABLE IF NOT EXISTS master_facturaction.user_type (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.user_type (id);

CREATE TABLE IF NOT EXISTS master_facturaction.colony (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.colony (id);

CREATE TABLE IF NOT EXISTS master_facturaction.billing (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_user bigint NOT NULL,
  year int NOT NULL,
  month tinyint NOT NULL,
  water decimal(10, 2) NOT NULL,
  water_late decimal(10, 2) NOT NULL,
  water_iva decimal(10, 2) NOT NULL,
  water_late_discount decimal(10, 2) NOT NULL,
  drain decimal(10, 2) NOT NULL,
  drain_late decimal(10, 2) NOT NULL,
  drain_late_discount decimal(10, 2) NOT NULL,
  drain_iva decimal(10, 2) NOT NULL,
  sanitation decimal(10, 2) NOT NULL,
  sanitation_late decimal(10, 2) NOT NULL,
  sanitation_late_discount decimal(10, 2) NOT NULL,
  sanitation_iva decimal(10, 2) NOT NULL,
  date_billing varchar(500),
  foliate varchar(500),
  folio_descuento varchar(500) NOT NULL,
  status int NOT NULL,
  id_agreement bigint,
  advance_payment decimal(10, 2),
  advance_payment_water decimal(10, 2),
  advance_payment_drain decimal(10, 2),
  advance_payment_sanitation decimal(10, 2),
  advance_payment_iva decimal(10, 2),
  id_employment bigint
);

CREATE INDEX master_facturaction_billing_id_user_fk ON master_facturaction.billing (id_user);
CREATE INDEX master_facturaction_billing_id_status_fk ON master_facturaction.billing (status);

CREATE TABLE IF NOT EXISTS master_facturaction.rates (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_consum_intake bigint NOT NULL,
  year int NOT NULL,
  amount decimal(10, 4) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.rates (id);
CREATE INDEX master_facturaction_rates_id_consum_intake_fk ON master_facturaction.rates (id_consum_intake);

CREATE TABLE IF NOT EXISTS master_facturaction.consume_intake (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_intaketype bigint NOT NULL,
  id_consumtype bigint NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.consume_intake (id);
CREATE INDEX master_facturaction_consume_intake_id_consumtype_fk ON master_facturaction.consume_intake (id_consumtype);
CREATE INDEX master_facturaction_consume_intake_id_intaketype_fk ON master_facturaction.consume_intake (id_intaketype);

CREATE TABLE IF NOT EXISTS master_facturaction.status_agreement_payment (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.status_agreement_payment (id);

CREATE TABLE IF NOT EXISTS master_facturaction.status (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  status varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.status (id);

CREATE TABLE IF NOT EXISTS master_facturaction.zone (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.zone (id);

CREATE TABLE IF NOT EXISTS master_facturaction.user_storage (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.user_storage (id);

CREATE TABLE IF NOT EXISTS master_facturaction.consume_type (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.consume_type (id);

CREATE TABLE IF NOT EXISTS master_facturaction.agreenmets (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_user bigint NOT NULL,
  foliate varchar(500) NOT NULL,
  beneficiary varchar(500),
  phone_benef varchar(500) NOT NULL,
  debt decimal(10, 2) NOT NULL,
  period_init date NOT NULL,
  period_end date NOT NULL,
  months mediumint NOT NULL,
  advance_payment decimal(10, 2) NOT NULL,
  comment varchar(500) NOT NULL,
  discharge_date date NOT NULL,
  id_status_agreement bigint NOT NULL,
  id_employment bigint NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.agreenmets (id);
CREATE INDEX master_facturaction_agreenmets_id_user_fk ON master_facturaction.agreenmets (id_user);
CREATE INDEX master_facturaction_agreements_id_status_agreement_fk ON master_facturaction.agreenmets (id_status_agreement);
CREATE INDEX master_facturaction_agreenmets_id_employments_fk ON master_facturaction.agreenmets (id_employment);

CREATE TABLE IF NOT EXISTS master_facturaction.invoice_history (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_user bigint NOT NULL,
  folio varchar(500) NOT NULL,
  date_invoice varchar(500) NOT NULL,
  date_initial varchar(500) NOT NULL,
  date_final varchar(500) NOT NULL,
  amount decimal(10, 4) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.invoice_history (id);
CREATE INDEX master_facturaction_invoice_history_id_users_fk ON master_facturaction.invoice_history (id_user);

CREATE TABLE IF NOT EXISTS master_facturaction.category (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500)
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.category (id);

CREATE TABLE IF NOT EXISTS master_facturaction.service_type (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.service_type (id);

CREATE TABLE IF NOT EXISTS master_facturaction.materials (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name text NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.materials (id);

CREATE TABLE IF NOT EXISTS master_facturaction.unities (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.unities (id);

CREATE TABLE IF NOT EXISTS master_facturaction.locality (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.locality (id);

CREATE TABLE IF NOT EXISTS master_facturaction.service_status (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.service_status (id);

CREATE TABLE IF NOT EXISTS master_facturaction.evidences (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_report varchar(500) NOT NULL,
  image varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.evidences (id);
CREATE INDEX master_facturaction_evid_id_report_fk ON master_facturaction.evidences (id_report);

CREATE TABLE IF NOT EXISTS master_facturaction.employments (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500) NOT NULL,
  lastname varchar(500) NOT NULL,
  mail varchar(500) NOT NULL,
  phone varchar(500),
  password char NOT NULL,
  id_rol bigint NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.employments (id);
CREATE INDEX master_facturaction_employments_id_rol_fk ON master_facturaction.employments (id_rol);

CREATE TABLE IF NOT EXISTS master_facturaction.status_agreements (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.status_agreements (id);

CREATE TABLE IF NOT EXISTS master_facturaction.roles (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500) NOT NULL,
  description varchar(500)
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.roles (id);

CREATE TABLE IF NOT EXISTS master_facturaction.reports (
  id varchar(500) NOT NULL PRIMARY KEY,
  id_user bigint,
  name varchar(500),
  phone varchar(500),
  id_beneficiary bigint,
  address varchar(500),
  id_category int NOT NULL,
  id_incidence int NOT NULL,
  id_priority int NOT NULL,
  employee_id bigint,
  description text,
  id_employee_sup bigint,
  id_status int,
  created datetime
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.reports (id);
CREATE INDEX master_facturaction_reportsSup_id_users_fk ON master_facturaction.reports (id_employee_sup);
CREATE INDEX master_facturaction_report_id_cat_fk ON master_facturaction.reports (id_category);
CREATE INDEX master_facturaction_report_id_priority_fk ON master_facturaction.reports (id_priority);
CREATE INDEX master_facturaction_report_id_statusRep_fk ON master_facturaction.reports (id_status);
CREATE INDEX master_facturaction_reports_id_employee_fk ON master_facturaction.reports (employee_id);
CREATE INDEX master_facturaction_reports_id_users_fk ON master_facturaction.reports (id_user);
CREATE INDEX master_facturaction_report_id_inc_fk ON master_facturaction.reports (id_incidence);

CREATE TABLE IF NOT EXISTS master_facturaction.priority (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500)
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.priority (id);

CREATE TABLE IF NOT EXISTS master_facturaction.payments_agreements (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_agreement bigint NOT NULL,
  payment_number int NOT NULL,
  quantity_months bigint NOT NULL,
  amount decimal(10, 2) NOT NULL,
  date_payment date NOT NULL,
  id_status_agreement_payment bigint NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.payments_agreements (id);
CREATE INDEX master_facturaction_payments_agreements_id_status_agreement_payment_fk ON master_facturaction.payments_agreements (id_status_agreement_payment);
CREATE INDEX master_facturaction_payments_agreements_id_agreement_fk ON master_facturaction.payments_agreements (id_agreement);

CREATE TABLE IF NOT EXISTS master_facturaction.notes_reports (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_report varchar(500) NOT NULL,
  note text,
  image varchar(500),
  employee_id bigint NOT NULL,
  created datetime
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.notes_reports (id);
CREATE INDEX master_facturaction_notes_id_user_fk ON master_facturaction.notes_reports (employee_id);
CREATE INDEX master_facturaction_notes_id_report_fk ON master_facturaction.notes_reports (id_report);

CREATE TABLE IF NOT EXISTS master_facturaction.beneficiaries (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500),
  lastname varchar(500),
  email varchar(500),
  phone varchar(500),
  relationship varchar(500),
  clave_elector varchar(500),
  id_user bigint
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.beneficiaries (id);
CREATE INDEX master_facturaction_beneficiaries_id_user_fk ON master_facturaction.beneficiaries (id_user);

CREATE TABLE IF NOT EXISTS master_facturaction.type_person (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  type varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.type_person (id);

CREATE TABLE IF NOT EXISTS master_facturaction.payment_invoice (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_user bigint NOT NULL,
  folio varchar(500) NOT NULL,
  date varchar(500) NOT NULL,
  date_initial varchar(500) NOT NULL,
  date_final varchar(500) NOT NULL,
  cancelated tinyint NOT NULL,
  current_water decimal(10, 2) NOT NULL,
  current_water_discount decimal(10, 2) NOT NULL,
  water_late decimal(10, 2) NOT NULL,
  water_iva decimal(10, 4) NOT NULL,
  water_surcharge decimal(10, 2) NOT NULL,
  water_surcharge_discount decimal(10, 2) NOT NULL,
  current_drain decimal(10, 2) NOT NULL,
  current_drain_discount decimal(10, 2) NOT NULL,
  drain_late decimal(10, 2) NOT NULL,
  drain_iva decimal(10, 4) NOT NULL,
  drain_surcharge decimal(10, 2) NOT NULL,
  drain_surcharge_discount decimal(10, 2) NOT NULL,
  subtotal decimal(10, 2) NOT NULL,
  iva decimal(10, 4) NOT NULL,
  total decimal(10, 2) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.payment_invoice (id);
CREATE INDEX master_facturaction_payment_invoice_id_users_fk ON master_facturaction.payment_invoice (id_user);

CREATE TABLE IF NOT EXISTS master_facturaction.intake_type (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500) NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.intake_type (id);

CREATE TABLE IF NOT EXISTS master_facturaction.material_reports (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_report varchar(500) NOT NULL,
  quantity int NOT NULL,
  id_unity int NOT NULL,
  id_material int NOT NULL,
  id_employee bigint NOT NULL,
  created datetime
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.material_reports (id);
CREATE INDEX master_facturaction_matRep_id_mat_fk ON master_facturaction.material_reports (id_material);
CREATE INDEX master_facturaction_matRep_id_report_fk ON master_facturaction.material_reports (id_report);
CREATE INDEX master_facturaction_matRep_id_employee_fk ON master_facturaction.material_reports (id_employee);
CREATE INDEX master_facturaction_matRep_id_unit_fk ON master_facturaction.material_reports (id_unity);

CREATE TABLE IF NOT EXISTS master_facturaction.incidence (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(500),
  id_category int NOT NULL
);

CREATE UNIQUE INDEX master_facturaction_PRIMARY ON master_facturaction.incidence (id);
CREATE INDEX master_facturaction_inc_id_cat_fk ON master_facturaction.incidence (id_category);

ALTER TABLE master_facturaction.agreenmets ADD CONSTRAINT agreements_id_status_agreement_fk FOREIGN KEY (id_status_agreement) REFERENCES master_facturaction.status_agreements (id);
ALTER TABLE master_facturaction.agreenmets ADD CONSTRAINT agreenmets_id_employments_fk FOREIGN KEY (id_employment) REFERENCES master_facturaction.employments (id);
ALTER TABLE master_facturaction.agreenmets ADD CONSTRAINT agreenmets_id_user_fk FOREIGN KEY (id_user) REFERENCES master_facturaction.users (id);
ALTER TABLE master_facturaction.beneficiaries ADD CONSTRAINT beneficiaries_id_user_fk FOREIGN KEY (id_user) REFERENCES master_facturaction.users (id);
ALTER TABLE master_facturaction.billing ADD CONSTRAINT billing_id_status_fk FOREIGN KEY (status) REFERENCES master_facturaction.status (id);
ALTER TABLE master_facturaction.billing ADD CONSTRAINT billing_id_user_fk FOREIGN KEY (id_user) REFERENCES master_facturaction.users (id);
ALTER TABLE master_facturaction.consume_intake ADD CONSTRAINT consume_intake_id_consumtype_fk FOREIGN KEY (id_consumtype) REFERENCES master_facturaction.consume_type (id);
ALTER TABLE master_facturaction.consume_intake ADD CONSTRAINT consume_intake_id_intaketype_fk FOREIGN KEY (id_intaketype) REFERENCES master_facturaction.intake_type (id);
ALTER TABLE master_facturaction.employments ADD CONSTRAINT employments_id_rol_fk FOREIGN KEY (id_rol) REFERENCES master_facturaction.roles (id);
ALTER TABLE master_facturaction.evidences ADD CONSTRAINT evid_id_report_fk FOREIGN KEY (id_report) REFERENCES master_facturaction.reports (id);
ALTER TABLE master_facturaction.incidence ADD CONSTRAINT inc_id_cat_fk FOREIGN KEY (id_category) REFERENCES master_facturaction.category (id);
ALTER TABLE master_facturaction.invoice_history ADD CONSTRAINT invoice_history_id_users_fk FOREIGN KEY (id_user) REFERENCES master_facturaction.users (id);
ALTER TABLE master_facturaction.material_reports ADD CONSTRAINT matRep_id_employee_fk FOREIGN KEY (id_employee) REFERENCES master_facturaction.employments (id);
ALTER TABLE master_facturaction.material_reports ADD CONSTRAINT matRep_id_mat_fk FOREIGN KEY (id_material) REFERENCES master_facturaction.materials (id);
ALTER TABLE master_facturaction.material_reports ADD CONSTRAINT matRep_id_report_fk FOREIGN KEY (id_report) REFERENCES master_facturaction.reports (id);
ALTER TABLE master_facturaction.material_reports ADD CONSTRAINT matRep_id_unit_fk FOREIGN KEY (id_unity) REFERENCES master_facturaction.unities (id);
ALTER TABLE master_facturaction.notes_reports ADD CONSTRAINT notes_id_report_fk FOREIGN KEY (id_report) REFERENCES master_facturaction.reports (id);
ALTER TABLE master_facturaction.notes_reports ADD CONSTRAINT notes_id_user_fk FOREIGN KEY (employee_id) REFERENCES master_facturaction.users (id);
ALTER TABLE master_facturaction.payment_invoice ADD CONSTRAINT payment_invoice_id_users_fk FOREIGN KEY (id_user) REFERENCES master_facturaction.users (id);
ALTER TABLE master_facturaction.payments_agreements ADD CONSTRAINT payments_agreements_id_agreement_fk FOREIGN KEY (id_agreement) REFERENCES master_facturaction.agreenmets (id);
ALTER TABLE master_facturaction.payments_agreements ADD CONSTRAINT payments_agreements_id_status_agreement_payment_fk FOREIGN KEY (id_status_agreement_payment) REFERENCES master_facturaction.status_agreement_payment (id);
ALTER TABLE master_facturaction.rates ADD CONSTRAINT rates_id_consum_intake_fk FOREIGN KEY (id_consum_intake) REFERENCES master_facturaction.consume_intake (id);
ALTER TABLE master_facturaction.reports ADD CONSTRAINT report_id_cat_fk FOREIGN KEY (id_category) REFERENCES master_facturaction.category (id);
ALTER TABLE master_facturaction.reports ADD CONSTRAINT report_id_inc_fk FOREIGN KEY (id_incidence) REFERENCES master_facturaction.incidence (id);
ALTER TABLE master_facturaction.reports ADD CONSTRAINT report_id_priority_fk FOREIGN KEY (id_priority) REFERENCES master_facturaction.priority (id);
ALTER TABLE master_facturaction.reports ADD CONSTRAINT report_id_statusRep_fk FOREIGN KEY (id_status) REFERENCES master_facturaction.status_report (id);
ALTER TABLE master_facturaction.reports ADD CONSTRAINT reports_id_employee_fk FOREIGN KEY (employee_id) REFERENCES master_facturaction.employments (id);
ALTER TABLE master_facturaction.reports ADD CONSTRAINT reports_id_users_fk FOREIGN KEY (id_user) REFERENCES master_facturaction.users (id);
ALTER TABLE master_facturaction.reports ADD CONSTRAINT reportsSup_id_users_fk FOREIGN KEY (id_employee_sup) REFERENCES master_facturaction.users (id);
ALTER TABLE master_facturaction.users ADD CONSTRAINT users_ibfk_1 FOREIGN KEY (id_userStorage) REFERENCES master_facturaction.user_storage (id);
ALTER TABLE master_facturaction.users ADD CONSTRAINT users_id_colony_fk FOREIGN KEY (id_colony) REFERENCES master_facturaction.colony (id);
ALTER TABLE master_facturaction.users ADD CONSTRAINT users_id_consumtype_fk FOREIGN KEY (id_consumtype) REFERENCES master_facturaction.consume_type (id);
ALTER TABLE master_facturaction.users ADD CONSTRAINT users_id_intaketype_fk FOREIGN KEY (id_intaketype) REFERENCES master_facturaction.intake_type (id);
ALTER TABLE master_facturaction.users ADD CONSTRAINT users_id_locality_fk FOREIGN KEY (id_locality) REFERENCES master_facturaction.locality (id);
ALTER TABLE master_facturaction.users ADD CONSTRAINT users_id_servicestatus_fk FOREIGN KEY (id_servicestatus) REFERENCES master_facturaction.service_status (id);
ALTER TABLE master_facturaction.users ADD CONSTRAINT users_id_servicetype_fk FOREIGN KEY (id_servicetype) REFERENCES master_facturaction.service_type (id);
ALTER TABLE master_facturaction.users ADD CONSTRAINT users_id_usertype_fk FOREIGN KEY (id_usertype) REFERENCES master_facturaction.user_type (id);
ALTER TABLE master_facturaction.users ADD CONSTRAINT users_id_zone_fk FOREIGN KEY (id_zone) REFERENCES master_facturaction.zone (id);