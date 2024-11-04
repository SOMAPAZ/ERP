-- Table: consume_type
INSERT INTO consume_type VALUES(1, 'Sin establecer');
INSERT INTO consume_type VALUES(2, 'Popular');
INSERT INTO consume_type VALUES(3, 'Medio');
INSERT INTO consume_type VALUES(4, 'Residencial');
INSERT INTO consume_type VALUES(5, 'Clasificación I');
INSERT INTO consume_type VALUES(6, 'Clasificación II');
INSERT INTO consume_type VALUES(7, 'Clasificación III');
INSERT INTO consume_type VALUES(8, 'Clasificación IV');
INSERT INTO consume_type VALUES(9, 'Clasificación I Bajo');
INSERT INTO consume_type VALUES(10, 'Mayor consumo');
INSERT INTO consume_type VALUES(11, 'Bajo consumo medido');
INSERT INTO consume_type VALUES(12, 'Mayor consumo medido');
INSERT INTO consume_type VALUES(13, 'Eventual');

-- Table: intake_type
INSERT INTO intake_type VALUES(1, 'Sin establecer');
INSERT INTO intake_type VALUES(2, 'Habitacional');
INSERT INTO intake_type VALUES(3, 'Comercial');
INSERT INTO intake_type VALUES(4, 'Industrial');
INSERT INTO intake_type VALUES(5, 'Prestador de Servicios');

-- Table: consume_intake
INSERT INTO consume_intake VALUES(1, 1, 1);
INSERT INTO consume_intake VALUES(2, 2, 2);
INSERT INTO consume_intake VALUES(3, 2, 3);
INSERT INTO consume_intake VALUES(4, 2, 4);
INSERT INTO consume_intake VALUES(5, 1, 5);
INSERT INTO consume_intake VALUES(6, 1, 6);
INSERT INTO consume_intake VALUES(7, 1, 7);
INSERT INTO consume_intake VALUES(8, 1, 8);
INSERT INTO consume_intake VALUES(9, 1, 9);
INSERT INTO consume_intake VALUES(10, 2, 10);
INSERT INTO consume_intake VALUES(11, 2, 11);
INSERT INTO consume_intake VALUES(12, 2, 12);
INSERT INTO consume_intake VALUES(13, 3, 5);
INSERT INTO consume_intake VALUES(14, 3, 6);
INSERT INTO consume_intake VALUES(15, 5, 5);
INSERT INTO consume_intake VALUES(16, 5, 6);
INSERT INTO consume_intake VALUES(17, 5, 7);
INSERT INTO consume_intake VALUES(18, 5, 8);
INSERT INTO consume_intake VALUES(19, 2, 13);

-- Table: service_status
INSERT INTO service_status VALUES(1, 'Activo');
INSERT INTO service_status VALUES(2, 'Suspendido');
INSERT INTO service_status VALUES(3, 'Cancelado');

-- Table: service_type
INSERT INTO service_type VALUES(1, 'Sin establecer');
INSERT INTO service_type VALUES(2, 'Fijo');
INSERT INTO service_type VALUES(3, 'Medido');

-- Table: user_type
INSERT INTO user_type VALUES(1, 'Normal');
INSERT INTO user_type VALUES(2, 'Inapam');
INSERT INTO user_type VALUES(3, 'Jubilado');
INSERT INTO user_type VALUES(4, 'Pensionado');

--Table: roles
INSERT INTO roles VALUES
(1, 'Admin'),
(2, 'Contable'),
(3, 'Dev'),
(4, 'Normal'),
(5, 'Eventual'),
(6, 'Campo');

--Table: employments
INSERT INTO `employments` VALUES
(1, 'Carlos', 'Cabrera', 'carloscabreracarreon@gmail.com', '$2y$04$FQRbxZbrcK3LYHWuo8LDwOFvMLX3YDeyHWmyNHQs6ZrVQubpBMEg2', '3'),
(2, 'ARNOLDO', 'FELIX XOCOTA', 'fexarnol@gmail.com', '$2y$04$WoCsPjQmUpmjgSkQH7cdee6NUBU31sM6to.FNgp6pQQU0Zqu8sU9.', '2'),
(3, 'Fernando ', 'Sosa Bonilla', 'fernando@somapaz.spz', '$2y$04$BwSv1MvnkWgJ2YU9BYvgduCiLV7eM322H6o4ww/gFbLZnYDq0jv1i', '4'),
(4, 'BEATRIZ', 'RODRIGUEZ', 'beatriz@somapaz.spz', '$2y$04$rvltzjG13pnOhmjVrdztA..kzWuvPAcxzwYAxTzeKQ/AMksgIuqlu', '2'),
(5, 'Araceli ', 'Morales', 'aracelimcas@gmail.com', '$2y$04$HRT8o.PFcMrE3fWcx6vI6elEGjGeMRdygWgIKFrPMQqMbdibQfwBy', '4'),
(6, 'Juan Bernardo ', 'Amador Gonzalez', 'j_b182@hotmail.com', '$2y$04$/khFCFkAZ7bKaaexw5ZqVutZ8517TbwpWNd40q8LJ4VwcNKPLG1Uy', '1'),
(7, 'Emilio', 'Bonilla Palafox ', 'somapaz.operacion@gmail.com', '$2y$04$1xxLlf2KzV51wqAYAorwM.60pIN0Leg9JGA2ltGYFD5inc7hCM60.', '4'),
(8, 'Mario Alexis', 'Vazquez', 'mario@somapaz.spz', '$2y$04$1FTslRCwY7ZdewvBT7OWU.MLM6AmmRmUaNvQ9xf.Fhaf1urI.XaZi', '3'),
(9, 'EMILIO', 'BONILLA', 'somapaz.operacion@gmail.com', '$2y$04$QRV5vzU3vXswbIRO3ZdDbOa1rqayQnHmZKE1gxKeKGOzBNsUQXZCG', '4'),
(10, 'ARACELI', 'CASTILLO', 'aracelimcas@gmail.com', '$2y$04$xJiNlGJgCD0UbNJHM7ufCe.Fu4B44KJtuYQnhRCH4kterceZWVYy2', '4'),
(11, 'Cesar Azari', 'García Vazquez', 'cesafage06@gmail.com', '$2y$04$638m4Nh58k0Vs6zzHF6sseJGRfNtu1ZBlU3jYKxoi3kYnJniSN2za', '2'),
(12, 'Maria Fernanda', 'González Palafox', 'laimafe@hotmail.com', '$2y$04$ZiMCKUxBYRItXKBshZrN6.zU2E697E1cIHnp6ld7/euGPjhpukPJW', '4'),
(13, 'CLEMENTE', 'MARTIN', 'cmartinsantiago7@gmail.com', '$2y$04$pKIhDdBh2bJw5rJbcMcEMuyPo4WTPmAhXkJnO5LOOo6i.GxdszNdS', '5'),
(14, 'miguel angel', 'diaz perez', 'mich80925@gmail.com', '$2y$04$pwZ0w/QtFPyKrY3fyJR4uOIk.gccbvYCeeq4hGZYHgGPGzRGdDjr6', '5'),
(15, 'Miguel', 'Encarnación', 'encarnacionpolvomiguel@gmail.com', '$2y$04$s7cpn.xl3FSafqw8Wwcagu0nnAZ37wjDYFqhZJhYX0xtl2ZUI7CWu', '6'),
(16, 'Raul', 'Portillo', 'portilloraul375@gmail.com', '$2y$04$tgLT.LSB3V1g.BaewnuJjuXimFIulaTx4s8htyYLQ2sDy3aAydUmG', '6'),
(17, 'LIDIA', 'CORDOVA', 'lidia@somapaz.com', '$2y$04$J0P2LxwFMJoChuxa9GAif.gGkUWdvha83P.U5jTuYJf0X0Et.CH.6', '6');

--Table: status_agreements
INSERT INTO status_agreements VALUES
(1, 'Activo'),
(2, 'Cancelado'),
(3, 'Archivado');

--Table: status_agreement_payment
INSERT INTO `status_agreement_payment` VALUES
(1, 'Pagado'),
(2, 'Pendiente'),
(3, 'Vencido');

--Table: colony
INSERT INTO `colony` VALUES(1, 'Sin definir'),
(2, '12 de octubre'),
(3, 'Atehuetzian'),
(4, 'Ayoco'),
(5, 'Calcahualco'),
(6, 'Centro'),
(7, 'Comaltepec'),
(8, 'Independencia'),
(9, 'Insurgentes'),
(10, 'Ixticpac'),
(11, 'La Cañada'),
(12, 'La Cortadura'),
(13, 'Los Alcatraces'),
(14, 'Los Arcos'),
(15, 'San Francisco'),
(16, 'Tatoxcac'),
(17, 'Teacalco'),
(18, 'Tlalconteno'),
(19, 'Xaltetela'),
(20, 'Xalticpac'),
(21, 'Xoxpan'),
(22, 'Zacapexpan');

--Table: locality
INSERT INTO `locality` VALUES(1, 'Sin definir');

--Table: zone
INSERT INTO `zone` VALUES(1, 'Sin definir'),
(2, '4 de Octubre'),
(3, 'Alonso Luque'),
(4, 'Andador el Centro Escolar'),
(5, 'Atehuetzian'),
(6, 'Av. 16 de septiembre Norte'),
(7, 'Av. 16 de septiembre Sur'),
(8, 'Av. 2 de Abril Norte'),
(9, 'Av. 2 de Abril Sur'),
(10, 'Av. 5 de Mayo Norte'),
(11, 'Av. 5 de Mayo Sur'),
(12, 'Avenida 12 de octubre'),
(13, 'Ayoco'),
(14, 'Brigadier Lobato'),
(15, 'Calcahualco'),
(16, 'Calle Abraham Sosa'),
(17, 'Carlos I Betancourt'),
(18, 'Carretera a Cuetzalan'),
(19, 'Carretera a Zaragoza'),
(20, 'Carril Jose Maria Sosa'),
(21, 'Colonia Independencia'),
(22, 'Comaltepec'),
(23, 'Concordia'),
(24, 'Constantino Molina'),
(25, 'Constitución'),
(26, 'Corregidora'),
(27, 'Cuauhtemoc'),
(28, 'Direcciones Varias'),
(29, 'El Fortin'),
(30, 'El Fresno'),
(31, 'El Pensador Mexicano'),
(32, 'El Porvenir'),
(33, 'F.J Arriaga'),
(34, 'Fray Bartolome de las Casas'),
(35, 'Galeana'),
(36, 'Guillermo Prieto'),
(37, 'Ignacio Alatorre'),
(38, 'Ignacio Coeto'),
(39, 'Independencia'),
(40, 'Ixticpac'),
(41, 'J.M.  Alcantara'),
(42, 'J.S Verduzco'),
(43, 'Juan de Dios Peza'),
(44, 'La Calzada 25 de Abril'),
(45, 'La Cañada'),
(46, 'Lavaderos'),
(47, 'Leona Vicario'),
(48, 'Los Arcos'),
(49, 'Los Pinos'),
(50, 'Los Reyes'),
(51, 'Matamoros'),
(52, 'Mercado 25 de Abril'),
(53, 'Miguel Negrete'),
(54, 'Mina'),
(55, 'Ocotitan'),
(56, 'Pattoni'),
(57, 'Puente Colorado'),
(58, 'Rivapalacio'),
(59, 'Tatoxcac'),
(60, 'Teacalco'),
(61, 'Texpilco'),
(62, 'Tlalconteno'),
(63, 'Xaltetela'),
(64, 'Xalticpac'),
(65, 'Xoxpan'),
(66, 'Centro');