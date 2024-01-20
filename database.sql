-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 20 jan. 2024 à 14:00
-- Version du serveur : 5.7.43-log
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rental project`
--

-- --------------------------------------------------------

--
-- Structure de la table `agency_entreprise`
--

DROP TABLE IF EXISTS `agency_entreprise`;
CREATE TABLE IF NOT EXISTS `agency_entreprise` (
  `agency_entreprise_id` int(11) NOT NULL AUTO_INCREMENT,
  `agency_entreprise_name` varchar(255) DEFAULT NULL,
  `business_registration_number` varchar(255) DEFAULT NULL,
  `articles_of_incorporation` varchar(255) DEFAULT NULL,
  `registration_certifcate` varchar(255) DEFAULT NULL,
  `business_liability_inssurance` varchar(255) DEFAULT NULL,
  `credit_application` varchar(255) DEFAULT NULL,
  `billing_information` varchar(255) DEFAULT NULL,
  `status_agency_entreprise` varchar(255) DEFAULT NULL,
  `leader` int(11) DEFAULT NULL,
  PRIMARY KEY (`agency_entreprise_id`),
  KEY `user_id` (`leader`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `agency_entreprise`
--

INSERT INTO `agency_entreprise` (`agency_entreprise_id`, `agency_entreprise_name`, `business_registration_number`, `articles_of_incorporation`, `registration_certifcate`, `business_liability_inssurance`, `credit_application`, `billing_information`, `status_agency_entreprise`, `leader`) VALUES
(1, 'agency1', '982384', 'alpharomeocompetizionnze3_3_11zon.jpg', 'alpharomeocompetizionnze3_3_11zon.jpg', 'alpharomeocompetizionnze3_3_11zon.jpg', 'alpharomeocompetizionnze3_3_11zon.jpg', 'alpharomeocompetizionnze3_3_11zon.jpg', 'pending', 1),
(2, 'agency2', '8923734', 'admin2_2_11zon.jpg', 'admin2_2_11zon.jpg', 'admin2_2_11zon.jpg', 'admin2_2_11zon.jpg', 'admin2_2_11zon.jpg', 'pending', 2);

-- --------------------------------------------------------

--
-- Structure de la table `agency_location`
--

DROP TABLE IF EXISTS `agency_location`;
CREATE TABLE IF NOT EXISTS `agency_location` (
  `agence_location_id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) DEFAULT NULL,
  `agency_entreprise_id` int(11) DEFAULT NULL,
  `adress` varchar(100) NOT NULL,
  PRIMARY KEY (`agence_location_id`),
  KEY `agency_entreprise_id` (`agency_entreprise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `agency_location`
--

INSERT INTO `agency_location` (`agence_location_id`, `location`, `agency_entreprise_id`, `adress`) VALUES
(1, 'Casablanca', 1, 'HAY maarif RUE 76'),
(2, 'Rabat', 1, 'HAY RIAD Rue 77'),
(3, 'Casablanca', 2, 'Hay california RUE 33'),
(4, 'Agadir', 2, 'Hay TILILA RUE 12');

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(100) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL,
  `car_registration_number` varchar(100) DEFAULT NULL,
  `fuel_type` varchar(100) DEFAULT NULL,
  `seating_seat` int(11) DEFAULT NULL,
  `mileage` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `number_of_horses` int(11) DEFAULT NULL,
  `kind_of_vehicle` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `agence_location_id` int(11) DEFAULT NULL,
  `is_deleted` varchar(100) NOT NULL,
  PRIMARY KEY (`car_id`),
  KEY `agence_location_id` (`agence_location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cars`
--

INSERT INTO `cars` (`car_id`, `model`, `brand`, `year`, `car_registration_number`, `fuel_type`, `seating_seat`, `mileage`, `price`, `number_of_horses`, `kind_of_vehicle`, `status`, `agence_location_id`, `is_deleted`) VALUES
(1, 'M5', 'Bmw', '2020', '287784654', 'Gasoline', 4, 30000, 50, 400, 'Car', 'inactive', 1, 'false'),
(2, 'Q8', 'Audi', '2022', '287264', 'Gasoline', 5, 400000, 60, 900, 'Car', 'inactive', 1, 'false'),
(3, 'wrangmer', 'Jeep', '2023', '983836578', 'Gasoline', 6, 600000, 40, 500, 'Car', 'inactive', 1, 'false'),
(4, 'amg', 'Mercedes-Benz', '2023', '8378346', 'Gasoline', 5, 20000, 80, 800, 'Car', 'inactive', 2, 'false'),
(5, 'Competizionnze', 'Alfa Romeo', '2019', '278678457', 'Gasoline', 5, 30000, 40, 600, 'Car', 'inactive', 2, 'false'),
(6, 'Phantom', 'Rolls-Royce', '2022', '82783467', 'Gasoline', 5, 8900, 100, 1200, 'Car', 'inactive', 2, 'true'),
(7, 'Tiguan', 'Volkswagen', '2020', '8278636', 'Gasoline', 5, 10000, 35, 8278346, 'Car', 'inactive', 3, 'false'),
(8, 'x5', 'Bmw', '2022', '837784', 'Gasoline', 5, 700000, 45, 1000, 'Car', 'inactive', 3, 'false'),
(9, 'C-class', 'Mercedes-Benz', '2023', '87378637', 'Gasoline', 5, 70000, 55, 37867834, 'Car', 'inactive', 3, 'false'),
(10, 'quashqai', 'Nissan', '2017', '7347834', 'Gasoline', 3, 2786735, 35, 400, 'Truck', 'inactive', 4, 'false'),
(11, '500', 'Fiat', '2018', '8237846', 'Gasoline', 4, 30000, 20, 200, 'Car', 'inactive', 3, 'false'),
(12, 'Tacoma', 'Toyota', '2012', '737346', 'Gasoline', 3, 500000, 15, 60, 'Truck', 'inactive', 3, 'true'),
(13, 'Van', 'Volkswagen', '2010', '8378376', 'Gasoline', 4, 80000, 15, 73783, 'Car', 'inactive', 3, 'true'),
(14, 'Transporter (VW T6.1)', 'Volkswagen', '2005', '83778365', 'Gasoline', 7, 90000000, 30, 83478346, 'Van', 'inactive', 3, 'false'),
(15, 'Fiest', 'Ford', '2020', '876347', 'Gasoline', 6, 6000, 30, 39, 'Car', 'inactive', 3, 'true'),
(16, 'Fiesta', 'Ford', '2022', '7278376', 'Gasoline', 5, 70000, 30, 87386346, 'Car', 'inactive', 4, 'false'),
(17, 'evoque', 'Land Rover', '2020', '6372523765', 'Gasoline', 5, 800000, 40, 600, 'Car', 'inactive', 1, 'true'),
(18, 'xr', 'Ferrari', '2023', '896376345', 'Gasoline', 4, 734678, 60, 3786435, 'Car', 'inactive', 1, 'false');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(100) NOT NULL,
  `car_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`image_id`, `image_name`, `car_id`) VALUES
(1, '../images/bmwm1_11_11zon.jpg', 1),
(2, '../images/bmwm2_12_11zon.jpg', 1),
(3, '../images/bmwm3_13_11zon.jpg', 1),
(4, '../images/bmwm4_14_11zon.jpg', 1),
(5, '../images/bmwm5_15_11zon.jpg', 1),
(6, '../images/audiQ81_6_11zon.jpg', 2),
(7, '../images/audiQ82_7_11zon.jpg', 2),
(8, '../images/audiQ83_8_11zon.jpg', 2),
(9, '../images/audiQ84_9_11zon.jpg', 2),
(10, '../images/audiQ85_10_11zon.jpg', 2),
(11, '../images/jeep1_11_11zon.jpg', 3),
(12, '../images/jeep2_12_11zon.jpg', 3),
(13, '../images/jeep3_13_11zon.jpg', 3),
(14, '../images/jeep4_14_11zon.jpg', 3),
(15, '../images/jeep5_15_11zon.jpg', 3),
(16, '../images/MERCEDESAMG1_21_11zon.jpg', 4),
(17, '../images/MERCEDESAMG2_22_11zon.jpg', 4),
(18, '../images/MERCEDESAMG3_23_11zon.jpg', 4),
(19, '../images/MERCEDESAMG4_24_11zon.jpg', 4),
(20, '../images/MERCEDESAMG5_25_11zon.jpg', 4),
(21, '../images/alpharomeocompetizionnze1_1_11zon.jpg', 5),
(22, '../images/alpharomeocompetizionnze2_2_11zon.jpg', 5),
(23, '../images/alpharomeocompetizionnze3_3_11zon.jpg', 5),
(24, '../images/alpharomeocompetizionnze4_4_11zon.jpg', 5),
(25, '../images/alpharomeocompetizionnze5_5_11zon.jpg', 5),
(26, '../images/rollsroyce1_36_11zon.jpg', 6),
(27, '../images/rollsroyce2_37_11zon.jpg', 6),
(28, '../images/rollsroyce3_38_11zon.jpg', 6),
(29, '../images/rollsroyce4_39_11zon.jpg', 6),
(30, '../images/rollsroyce5_40_11zon.jpg', 6),
(31, '../images/wolswaken1_46_11zon.jpg', 7),
(32, '../images/wolswaken2_47_11zon.jpg', 7),
(33, '../images/wolswaken3_48_11zon.jpg', 7),
(34, '../images/wolswaken4_49_11zon.jpg', 7),
(35, '../images/wolswaken5_50_11zon.jpg', 7),
(36, '../images/bmwx1_16_11zon.jpg', 8),
(37, '../images/bmwx2_17_11zon.jpg', 8),
(38, '../images/bmwx3_18_11zon.jpg', 8),
(39, '../images/bmwx4_19_11zon.jpg', 8),
(40, '../images/bmwx5_20_11zon.jpg', 8),
(41, '../images/mercedes1_16_11zon.jpg', 9),
(42, '../images/mercedes2_17_11zon.jpg', 9),
(43, '../images/mercedes3_18_11zon.jpg', 9),
(44, '../images/mercedes4_19_11zon.jpg', 9),
(45, '../images/mercedes5_20_11zon.jpg', 9),
(46, '../images/nissan1_26_11zon.jpg', 10),
(47, '../images/nissan2_27_11zon.jpg', 10),
(48, '../images/nissan3_28_11zon.jpg', 10),
(49, '../images/nissan4_29_11zon.jpg', 10),
(50, '../images/nissan5_30_11zon.jpg', 10),
(51, '../images/fiattwo_10_11zon.jpg', 11),
(52, '../images/fiatfive_6_11zon.jpg', 11),
(53, '../images/fiatfour_7_11zon.jpg', 11),
(54, '../images/fiatthree_9_11zon.jpg', 11),
(55, '../images/fiattwo_10_11zon.jpg', 11),
(56, '../images/truck3_7_11zon.jpeg', 12),
(57, '../images/truck1_5_11zon.jpeg', 12),
(58, '../images/truck2_6_11zon.jpeg', 12),
(59, '../images/truck4_8_11zon.jpeg', 12),
(60, '../images/truck1_5_11zon.jpeg', 12),
(61, '../images/van1 _10_11zon.jpg', 13),
(62, '../images/van2_11_11zon.jpg', 13),
(63, '../images/van3_12_11zon.jpg', 13),
(64, '../images/van4_13_11zon.jpg', 13),
(65, '../images/van5_14_11zon.jpg', 13),
(66, '../images/van1 _10_11zon.jpg', 14),
(67, '../images/van2_11_11zon.jpg', 14),
(68, '../images/van3_12_11zon.jpg', 14),
(69, '../images/van4_13_11zon.jpg', 14),
(70, '../images/van5_14_11zon.jpg', 14),
(71, '../images/fordfiesta1_21_11zon.jpg', 15),
(72, '../images/fordfiesta2_22_11zon.jpg', 15),
(73, '../images/fiesta3_1_11zon.jpg', 15),
(74, '../images/fiesta4_2_11zon.jpg', 15),
(75, '../images/fiesta5_3_11zon.jpg', 15),
(76, '../images/fordfiesta1_21_11zon.jpg', 16),
(77, '../images/fordfiesta2_22_11zon.jpg', 16),
(78, '../images/fiesta5_3_11zon.jpg', 16),
(79, '../images/fiesta4_2_11zon.jpg', 16),
(80, '../images/fiesta5_3_11zon.jpg', 16),
(81, '../images/rangerover1_31_11zon.jpg', 17),
(82, '../images/rangerover2_32_11zon.jpg', 17),
(83, '../images/rangerover3_33_11zon.jpg', 17),
(84, '../images/rangerover4_34_11zon.jpg', 17),
(85, '../images/rangerover5_35_11zon.jpg', 17),
(86, '../images/ferrari1.jpg', 18),
(87, '../images/ferrari2.jpg', 18),
(88, '../images/ferrari3.jpg', 18),
(89, '../images/ferrari4.jpg', 18),
(90, '../images/ferrari5.jpg', 18);

-- --------------------------------------------------------

--
-- Structure de la table `rental_operations`
--

DROP TABLE IF EXISTS `rental_operations`;
CREATE TABLE IF NOT EXISTS `rental_operations` (
  `rental_operations_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `start_date` varchar(100) DEFAULT NULL,
  `end_date` varchar(100) DEFAULT NULL,
  `global_price` varchar(100) DEFAULT NULL,
  `reservation_date` varchar(100) NOT NULL,
  `status_operation_rental` varchar(100) NOT NULL,
  `agency_entreprise_id` int(11) DEFAULT NULL,
  `confirmation_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rental_operations_id`),
  KEY `user_id` (`user_id`),
  KEY `car_id` (`car_id`),
  KEY `fk_agency_entreprise_id` (`agency_entreprise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rental_operations`
--

INSERT INTO `rental_operations` (`rental_operations_id`, `user_id`, `car_id`, `start_date`, `end_date`, `global_price`, `reservation_date`, `status_operation_rental`, `agency_entreprise_id`, `confirmation_date`) VALUES
(1, 3, 1, '2024-1-12 8:30', '2024-1-14 11:30', '100', '2024-01-10 00:14:24', 'confirm', 1, '2024-01-10 00:14:52'),
(2, 3, 3, '2024-1-11 10:30', '2024-1-20 3:00', '320', '2024-01-10 12:09:02', 'confirm', 1, '2024-01-10 12:20:05'),
(3, 3, 2, '2024-1-20 9:30', '2024-1-21 11:30', '60', '2024-01-10 12:22:24', 'expired', 1, NULL),
(4, 3, 2, '2024-2-10 9:00', '2024-2-19 11:00', '540', '2024-01-10 13:20:58', 'pending', 1, NULL),
(5, 3, 1, '2024-2-2 9:00', '2024-2-4 11:00', '100', '2024-01-10 13:21:22', 'pending', 1, NULL),
(6, 4, 3, '2024-2-11 8:30', '2024-2-12 11:30', '40', '2024-01-10 13:26:49', 'pending', 1, NULL),
(7, 3, 2, '2024-1-19 8:30', '2024-1-20 12:00', '60', '2024-01-10 15:56:40', 'pending', 1, NULL),
(8, 3, 18, '2024-1-11 9:30', '2024-1-13 10:00', '120', '2024-01-10 16:24:27', 'confirm', 1, '2024-01-10 16:26:19');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `responsable_id` (`responsable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `phone_number`, `role`, `email`, `profile_image`, `username`, `user_password`, `responsable_id`) VALUES
(1, 'entreprise', '1', '063-510-3092', 'rental agency', 'entreprise1@gmail.com', '../images_profile/admin1_1_11zon.jpg', 'entreprise1', '$2y$10$cgyr05qrqp9/fePCl5wLSub/02GZqc53qREqfayhk1G0B7toyqKVq', NULL),
(2, 'entreprise', '2', '064-110-3392', 'rental agency', 'entreprise2@gmail.com', '../images_profile/admin2_2_11zon.jpg', 'entreprise2', '$2y$10$GRQHvrI3ZDmT9BDH0Kccwe7KxoP41pnB7szyYG3RpnsTchPTtK4l.', NULL),
(3, 'customer', '1', '063-510-3092', 'customer', 'customer1@gmail.com', '../images_profile/user1_3_11zon.jpg', 'customer1', '$2y$10$wEvPNfVlPXoGBl6W2fi0yuacbS4myJSQoUfdl2LTqG7tWle/jHDW2', NULL),
(4, 'customer', '2', '063-510-3092', 'customer', 'customer@gmail.com', '../images_profile/user2_4_11zon.jpg', 'customer2', '$2y$10$L7Y9rKpLZycz9bQAuHuAtu0THQJt7C2Nk1CH/2fUfMYfAQV1g7Ude', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agency_entreprise`
--
ALTER TABLE `agency_entreprise`
  ADD CONSTRAINT `agency_entreprise_ibfk_1` FOREIGN KEY (`leader`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `agency_location`
--
ALTER TABLE `agency_location`
  ADD CONSTRAINT `agency_location_ibfk_1` FOREIGN KEY (`agency_entreprise_id`) REFERENCES `agency_entreprise` (`agency_entreprise_id`);

--
-- Contraintes pour la table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`agence_location_id`) REFERENCES `agency_location` (`agence_location_id`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);

--
-- Contraintes pour la table `rental_operations`
--
ALTER TABLE `rental_operations`
  ADD CONSTRAINT `fk_agency_entreprise_id` FOREIGN KEY (`agency_entreprise_id`) REFERENCES `agency_entreprise` (`agency_entreprise_id`),
  ADD CONSTRAINT `rental_operations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `rental_operations_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`responsable_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
