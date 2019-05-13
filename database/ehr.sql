-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.2.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for ehr
DROP DATABASE IF EXISTS `ehr`;
CREATE DATABASE IF NOT EXISTS `ehr` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ehr`;

-- Dumping structure for table ehr.aand_erecord
DROP TABLE IF EXISTS `aand_erecord`;
CREATE TABLE IF NOT EXISTS `aand_erecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id_id` int(11) DEFAULT NULL,
  `patient_id_id` int(11) NOT NULL,
  `notes` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `arrival_date` datetime NOT NULL,
  `location_occurred` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `injury_area` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_injury` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `xray_required` tinyint(1) NOT NULL,
  `vomitting` tinyint(1) NOT NULL,
  `medication` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medication_amount` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surgery` tinyint(1) NOT NULL,
  `medication_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E8A7F7812A13690` (`staff_id_id`),
  KEY `IDX_E8A7F781EA724598` (`patient_id_id`),
  CONSTRAINT `FK_E8A7F7812A13690` FOREIGN KEY (`staff_id_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_E8A7F781EA724598` FOREIGN KEY (`patient_id_id`) REFERENCES `patient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ehr.aand_erecord: ~0 rows (approximately)
DELETE FROM `aand_erecord`;
/*!40000 ALTER TABLE `aand_erecord` DISABLE KEYS */;
INSERT INTO `aand_erecord` (`id`, `staff_id_id`, `patient_id_id`, `notes`, `date_created`, `arrival_date`, `location_occurred`, `description`, `injury_area`, `type_of_injury`, `xray_required`, `vomitting`, `medication`, `medication_amount`, `surgery`, `medication_name`) VALUES
	(2, 6, 3, NULL, '2019-05-09 15:45:01', '2019-05-09 13:44:00', 'Home', 'isdicbhbdscsd', 'Head', 'Dislocation', 1, 1, 'Antihistamines', '20', 1, 'Pene');
/*!40000 ALTER TABLE `aand_erecord` ENABLE KEYS */;

-- Dumping structure for table ehr.appointment
DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complete` tinyint(1) NOT NULL,
  `staff_id_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FE38F8446B899279` (`patient_id`),
  KEY `IDX_FE38F844AE80F5DF` (`department_id`),
  KEY `IDX_FE38F8442A13690` (`staff_id_id`),
  CONSTRAINT `FK_FE38F8442A13690` FOREIGN KEY (`staff_id_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_FE38F8446B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`),
  CONSTRAINT `FK_FE38F844AE80F5DF` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ehr.appointment: ~0 rows (approximately)
DELETE FROM `appointment`;
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;
/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;

-- Dumping structure for table ehr.department
DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ehr.department: ~4 rows (approximately)
DELETE FROM `department`;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` (`id`, `name`) VALUES
	(2, 'A and E'),
	(3, 'Radiology'),
	(4, 'Ophthalmology'),
	(5, 'Unassigned');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;

-- Dumping structure for table ehr.macular_clinic_record
DROP TABLE IF EXISTS `macular_clinic_record`;
CREATE TABLE IF NOT EXISTS `macular_clinic_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id_id` int(11) NOT NULL,
  `staff_id_id` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `lvarange_weeks` int(11) NOT NULL,
  `lvarange_months` int(11) NOT NULL,
  `test_required` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surgery` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A05F0A23EA724598` (`patient_id_id`),
  KEY `IDX_A05F0A232A13690` (`staff_id_id`),
  CONSTRAINT `FK_A05F0A232A13690` FOREIGN KEY (`staff_id_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_A05F0A23EA724598` FOREIGN KEY (`patient_id_id`) REFERENCES `patient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ehr.macular_clinic_record: ~0 rows (approximately)
DELETE FROM `macular_clinic_record`;
/*!40000 ALTER TABLE `macular_clinic_record` DISABLE KEYS */;
INSERT INTO `macular_clinic_record` (`id`, `patient_id_id`, `staff_id_id`, `date_created`, `lvarange_weeks`, `lvarange_months`, `test_required`, `surgery`, `notes`) VALUES
	(2, 3, 3, '2019-05-09 16:11:30', 20, 20, 'Laser', 'Urgent', 'Holy smokes');
/*!40000 ALTER TABLE `macular_clinic_record` ENABLE KEYS */;

-- Dumping structure for table ehr.migration_versions
DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ehr.migration_versions: ~2 rows (approximately)
DELETE FROM `migration_versions`;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
	('20190429082915', '2019-04-29 08:29:24'),
	('20190429083748', '2019-04-29 08:38:01'),
	('20190509081619', '2019-05-09 08:16:30');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;

-- Dumping structure for table ehr.patient
DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_names` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:array)',
  `county` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eircode` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_no` int(11) DEFAULT NULL,
  `mobile_no` int(11) DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1ADAD7EBAE80F5DF` (`department_id`),
  CONSTRAINT `FK_1ADAD7EBAE80F5DF` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ehr.patient: ~57 rows (approximately)
DELETE FROM `patient`;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` (`id`, `department_id`, `email`, `first_name`, `middle_names`, `last_name`, `address`, `county`, `eircode`, `date_created`, `status`, `priority`, `tel_no`, `mobile_no`, `country`, `date_of_birth`) VALUES
	(1, 4, 'ojoesuff@gmail.gigg', 'Willy', 'Homebo Lo', 'JoJog', '', '', '545YHT', '2019-04-05 11:37:05', 'Pending', 'High', 854654, 6565151, 'Hong Kong', '1985-06-05 00:00:00'),
	(3, 5, 'ojoe@go.com', 'Joe', 'Middle', 'Name', 'a:3:{i:0;s:4:"Here";i:1;s:0:"";i:2;s:0:"";}', 'Kilkenny', '', '2019-04-12 12:12:09', 'Outpatient', 'High', NULL, NULL, 'Armenia', '2004-04-19 00:00:00'),
	(4, NULL, 'ojoe@go.com', 'Hilly', 'Middle', 'Name', 'a:3:{i:0;s:4:"Here";i:1;s:0:"";i:2;s:0:"";}', 'Kilkenny', '', '2019-04-12 12:12:53', 'Pending', 'Low', NULL, NULL, 'Armenia', '2015-04-19 00:00:00'),
	(5, NULL, 'ojoe@go.com', 'NoBoy', 'Middle', 'Name', 'a:3:{i:0;s:4:"Here";i:1;s:5:"There";i:2;s:10:"Somehwhere";}', 'Down', 'XDG015', '2019-04-12 12:13:29', 'Pending', 'Low', NULL, NULL, 'Ireland', '1986-05-25 00:00:00'),
	(6, NULL, 'ojoe@go.com', 'NoBoy', 'Middle', 'Name', 'a:3:{i:0;s:4:"Here";i:1;s:5:"There";i:2;s:10:"Somehwhere";}', 'Down', 'XDG015', '2019-04-12 12:13:39', 'Pending', 'Low', NULL, NULL, 'Ireland', '1986-05-25 00:00:00'),
	(7, NULL, 'ojoe@go.com', 'NoBoy', 'Middle', 'Name', 'a:3:{i:0;s:4:"Here";i:1;s:5:"There";i:2;s:10:"Somehwhere";}', 'Down', 'XDG015', '2019-04-12 12:13:48', 'Pending', 'Low', NULL, NULL, 'Ireland', '1986-05-25 00:00:00'),
	(8, NULL, 'ojoe@go.com', 'NoBoy', 'Middle', 'Name', 'a:3:{i:0;s:4:"Here";i:1;s:5:"There";i:2;s:10:"Somehwhere";}', 'Down', 'XDG015', '2019-04-12 12:14:20', 'Pending', 'Low', NULL, NULL, 'Ireland', '1986-05-25 00:00:00'),
	(9, NULL, 'william@gmail.com', 'Diddly', 'John', 'O Connor', 'a:3:{i:0;s:11:"24 the home";i:1;s:8:"Therrace";i:2;s:10:"Somehwhere";}', '', 'XDG015', '2019-04-12 12:15:10', 'Pending', 'Low', 654846, 65165456, 'Ireland', '2001-01-01 00:00:00'),
	(10, NULL, 'soho@gmail.com', 'Go', 'Home', 'Jess', 'a:3:{i:0;s:12:"16 The Place";i:1;s:5:"Ho mo";i:2;s:5:"Slips";}', 'Monaghan', 'FGT 025', '2019-04-12 12:16:03', 'Pending', 'Low', NULL, 875455966, 'Ireland', '2001-01-12 00:00:00'),
	(14, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:39:01', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(15, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:39:08', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(16, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:39:13', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(17, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:39:17', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(18, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:39:22', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(19, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:39:26', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(20, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:39:31', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(21, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:39:35', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(22, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:39:40', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(23, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:39:44', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(24, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:39:49', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(25, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:39:54', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(26, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:39:58', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(27, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:40:02', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(28, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:40:11', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(29, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:40:14', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(30, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:40:19', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(31, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:40:23', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(32, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:40:28', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(33, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:40:32', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(34, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:40:37', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(35, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:40:42', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(36, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:40:46', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(37, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:40:51', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(38, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:40:55', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(39, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:40:59', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(40, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:41:09', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(41, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:41:13', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(42, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:41:18', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(43, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:41:23', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(44, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:41:27', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(45, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:41:31', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(46, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:41:36', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(47, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:41:40', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(48, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:41:45', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(49, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:41:49', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(50, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:41:53', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(51, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:42:02', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(52, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:42:07', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(53, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:42:11', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(54, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:42:15', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(55, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:42:20', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(56, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:42:24', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(57, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:42:27', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(58, NULL, 'ojoesuff@gmail.com', 'Eoin', 'Joe', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', 'IRL', '2019-04-24 14:42:32', 'Pending', 'Low', 857577647, 51, 'Ireland', '1986-05-25 00:00:00'),
	(59, NULL, 'ojoesuff@gmail.co', 'Eoin', '', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', '', '2019-04-25 11:12:29', 'Pending', 'Low', 85, NULL, 'Ireland', '1986-05-25 00:00:00'),
	(60, NULL, 'sdknkjd@cojsdc.com', 'EOin', 'DHhjsd', '\\asjhvd', 'a:3:{i:0;s:4:"sdcd";i:1;s:6:"sdvdsv";i:2;s:6:"sdvsdv";}', 'Leitrim', 'sdsdv', '2019-04-25 16:03:40', 'Pending', 'Low', 5165165, 5154, 'Ireland', '1986-05-25 00:00:00'),
	(61, NULL, 'jmanny@gmail.com', 'Joe', 'Manny', 'Pero', 'a:3:{i:0;s:4:"Hell";i:1;s:8:"And back";i:2;s:0:"";}', 'Kilkenny', 'Hd 251', '2019-04-25 16:05:02', 'Pending', 'Low', 55441, 54154, 'Ireland', '1985-06-05 00:00:00');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;

-- Dumping structure for table ehr.radiology_record
DROP TABLE IF EXISTS `radiology_record`;
CREATE TABLE IF NOT EXISTS `radiology_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id_id` int(11) NOT NULL,
  `staff_id_id` int(11) DEFAULT NULL,
  `area` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `xray_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrast` tinyint(1) NOT NULL,
  `side` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pacemaker` tinyint(1) NOT NULL,
  `sedation` tinyint(1) NOT NULL,
  `claustrophobia` tinyint(1) NOT NULL,
  `metal` tinyint(1) NOT NULL,
  `metal_area` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `notes` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_73DFA61EA724598` (`patient_id_id`),
  KEY `IDX_73DFA612A13690` (`staff_id_id`),
  CONSTRAINT `FK_73DFA612A13690` FOREIGN KEY (`staff_id_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_73DFA61EA724598` FOREIGN KEY (`patient_id_id`) REFERENCES `patient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ehr.radiology_record: ~0 rows (approximately)
DELETE FROM `radiology_record`;
/*!40000 ALTER TABLE `radiology_record` DISABLE KEYS */;
INSERT INTO `radiology_record` (`id`, `patient_id_id`, `staff_id_id`, `area`, `xray_type`, `contrast`, `side`, `pacemaker`, `sedation`, `claustrophobia`, `metal`, `metal_area`, `date_created`, `notes`) VALUES
	(1, 3, 6, 'Head', 'MRA', 1, '', 1, 1, 1, 1, 'Head', '2019-05-09 16:16:41', 'Holy no no');
/*!40000 ALTER TABLE `radiology_record` ENABLE KEYS */;

-- Dumping structure for table ehr.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_locked` tinyint(1) NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_patient_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  KEY `IDX_8D93D64982FDF893` (`last_patient_id`),
  CONSTRAINT `FK_8D93D64982FDF893` FOREIGN KEY (`last_patient_id`) REFERENCES `patient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ehr.user: ~4 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `roles`, `password`, `account_locked`, `first_name`, `last_name`, `last_patient_id`) VALUES
	(2, 'ehearne', '["ROLE_ADMIN"]', '$2y$13$qQ4VgxbbdS9tC5k3/aKwBuzsGnXU06BMmYyAhaaybuQleYgh1cj72', 0, 'Eoin', 'Hearne', NULL),
	(3, 'jhearne', '["ROLE_CLERICAL"]', '$2y$13$VBPvdE.o0.2RpDqfciM6VOyDWj1pd7OSaB59gG/OSWJdbLONQYjOm', 0, 'Joe', 'Hearne', 3),
	(5, 'jboyley', '["ROLE_CLERICAL"]', '$2y$13$uqqLt3/ouzicqa5jdhwPKu2TqH7N/ZWiaWbNhTnkA.MKnxmFtDPWu', 0, 'James', 'Boyle', NULL),
	(6, 'jnone', '["ROLE_DOCTOR"]', '$2y$13$P531jhaAqs/BylKdLkTeFuvXP5dva3gvRieuGi.wEuSd4SrCYqemu', 0, 'Joe', 'None', 3),
	(7, 'jjones', '["ROLE_ADMIN"]', '$2y$13$JPru3H4LFzs9x7znh8e76On8hrSwNNNyI1QoeYnFEyP.YM9Qf9j7.', 0, 'John', 'Jones', NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table ehr.user_staff
DROP TABLE IF EXISTS `user_staff`;
CREATE TABLE IF NOT EXISTS `user_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_locked` tinyint(1) NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ehr.user_staff: ~0 rows (approximately)
DELETE FROM `user_staff`;
/*!40000 ALTER TABLE `user_staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_staff` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
