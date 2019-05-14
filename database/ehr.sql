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

-- Dumping data for table ehr.aand_erecord: ~6 rows (approximately)
DELETE FROM `aand_erecord`;
/*!40000 ALTER TABLE `aand_erecord` DISABLE KEYS */;
INSERT INTO `aand_erecord` (`id`, `staff_id_id`, `patient_id_id`, `notes`, `date_created`, `arrival_date`, `location_occurred`, `description`, `injury_area`, `type_of_injury`, `xray_required`, `vomitting`, `medication`, `medication_amount`, `surgery`, `medication_name`) VALUES
	(3, 10, 63, NULL, '2019-05-14 10:40:31', '2019-05-14 09:40:00', 'At home address', 'Fell down stairs, possible fracture to left arm', 'Left Arm', 'Fracture', 1, 1, 'None', '', 1, ''),
	(4, 10, 63, NULL, '2019-05-14 10:41:58', '2019-01-12 03:00:00', 'Work in Starbucks, Waterford', 'Bang to head from coffee machine', 'Head', 'Laceration', 1, 1, 'Asprin', '100mg', 1, 'Disprin'),
	(5, 14, 70, NULL, '2019-05-14 11:34:35', '2019-05-14 09:33:00', 'Street outside home', 'Patient slipped when getting into the car', 'Left Ear', 'Laceration', 1, 1, 'Stimulants', '200mg', 1, 'Unknown'),
	(6, 14, 70, NULL, '2019-05-14 11:35:33', '2019-05-12 09:34:00', 'Garden', 'Cut to hand from chainsaw', 'Left Hand', 'Laceration', 1, 1, 'Antibiotics', '20mg', 1, 'Zertek'),
	(7, 10, 67, NULL, '2019-05-14 11:53:30', '2019-05-14 09:52:00', 'House', 'Patient hurt shoulder doing DIY', 'Left Shoulder', 'Dislocation', 1, 1, 'Antibiotics', '20mg', 1, 'Hildokilg'),
	(8, 10, 67, NULL, '2019-05-14 11:54:12', '2019-05-14 09:53:00', 'Hospital', 'Fell out of bed, bumped his head and couldn\'t get up', 'Head', 'Concussion', 1, 1, 'None', '', 1, '');
/*!40000 ALTER TABLE `aand_erecord` ENABLE KEYS */;

-- Dumping data for table ehr.appointment: ~14 rows (approximately)
DELETE FROM `appointment`;
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;
INSERT INTO `appointment` (`id`, `patient_id`, `department_id`, `date`, `status`, `complete`, `staff_id_id`) VALUES
	(13, 63, 3, '2019-05-20 10:00:00', 'New', 0, 10),
	(14, 63, 4, '2019-07-16 09:50:00', 'Reappointment', 0, 10),
	(15, 63, 2, '2019-05-23 10:50:00', 'New', 0, 15),
	(16, 70, 2, '2019-10-16 09:00:00', 'New', 0, 9),
	(17, 70, 3, '2019-10-23 11:00:00', 'Reappointment', 0, 11),
	(18, 70, 4, '2020-09-16 10:00:00', 'New', 0, 12),
	(19, 79, 3, '2019-05-14 10:00:00', 'Reappointment', 1, 10),
	(20, 79, 3, '2019-05-15 10:00:00', 'New', 1, 10),
	(21, 79, 2, '2019-06-19 11:00:00', 'New', 0, 15),
	(22, 79, 2, '2020-09-12 11:50:00', 'New', 0, 16),
	(23, 79, 4, '2020-12-12 09:45:00', 'New', 0, 13),
	(24, 79, 4, '2019-07-16 09:45:00', 'New', 1, 10),
	(25, 79, 3, '2019-05-14 16:00:00', 'New', 0, 12),
	(26, 79, 2, '2019-05-14 16:00:00', 'New', 0, 13);
/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;

-- Dumping data for table ehr.department: ~4 rows (approximately)
DELETE FROM `department`;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` (`id`, `name`) VALUES
	(2, 'A and E'),
	(3, 'Radiology'),
	(4, 'Ophthalmology'),
	(5, 'Unassigned');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;

-- Dumping data for table ehr.macular_clinic_record: ~5 rows (approximately)
DELETE FROM `macular_clinic_record`;
/*!40000 ALTER TABLE `macular_clinic_record` DISABLE KEYS */;
INSERT INTO `macular_clinic_record` (`id`, `patient_id_id`, `staff_id_id`, `date_created`, `lvarange_weeks`, `lvarange_months`, `test_required`, `surgery`, `notes`) VALUES
	(3, 63, 10, '2019-05-14 10:44:00', 3, 3, 'Laser', 'Urgent', ''),
	(4, 63, 10, '2019-05-14 10:44:37', 6, 6, 'OCT/FFA/Visual Fields', 'Urgent', ''),
	(5, 70, 14, '2019-05-14 11:37:24', 3, 3, 'Laser', 'Routine', 'Checking for foreign bodies'),
	(6, 85, 10, '2019-05-14 11:55:18', 2, 2, 'OCT/FFA/Visual Fields', 'Routine', 'Guy has a weird address'),
	(7, 85, 10, '2019-05-14 11:55:44', 3, 3, 'Macular Injections', 'Urgent', 'Needs injections urgently');
/*!40000 ALTER TABLE `macular_clinic_record` ENABLE KEYS */;

-- Dumping data for table ehr.migration_versions: ~0 rows (approximately)
DELETE FROM `migration_versions`;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;

-- Dumping data for table ehr.patient: ~30 rows (approximately)
DELETE FROM `patient`;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` (`id`, `department_id`, `email`, `first_name`, `middle_names`, `last_name`, `address`, `county`, `eircode`, `date_created`, `status`, `priority`, `tel_no`, `mobile_no`, `country`, `date_of_birth`) VALUES
	(62, NULL, 'wdmurphy@hotmail.com', 'William', 'David', 'Murphy', 'a:3:{i:0;s:13:"20 The Island";i:1;s:0:"";i:2;s:0:"";}', 'Limerick', '25J HGH', '2019-05-13 15:36:13', 'Pending', 'Low', 1859764, 857461614, 'Ireland', '1985-01-20 00:00:00'),
	(63, NULL, 'ojoesuff@gmail.com', 'Eoin', '', 'Hearne', 'a:3:{i:0;s:9:"Kilgrange";i:1;s:15:"Grange Park Ave";i:2;s:0:"";}', 'Waterford', '', '2019-05-13 15:44:27', 'Pending', 'Low', NULL, NULL, 'Ireland', '1986-05-25 00:00:00'),
	(64, NULL, 'jmurphy@yahoo.com', 'John', 'David', 'Murphy', 'a:3:{i:0;s:16:"17 Alphpgos Road";i:1;s:7:"Belview";i:2;s:0:"";}', 'Leitrim', '25L KI6', '2019-05-13 15:48:29', 'Pending', 'Low', 5645454, 5165151, 'Ireland', '1942-05-16 00:00:00'),
	(65, NULL, 'mgilly@hotmail.com', 'Michael', 'Paul', 'Gilly', 'a:3:{i:0;s:8:"14 Neusa";i:1;s:8:"Port Ave";i:2;s:0:"";}', 'Kilkenny', '254 JHG', '2019-05-14 09:20:14', 'Pending', 'Low', 1651515, 651651561, 'Ireland', '1999-05-16 00:00:00'),
	(66, NULL, 'pkavanagh@gmail.com', 'Paula', '', 'Kavanagh', 'a:3:{i:0;s:13:"The Cloisters";i:1;s:7:"Dunmore";i:2;s:0:"";}', 'Waterford', '', '2019-05-14 09:21:16', 'Pending', 'Low', 65465465, 654654564, 'Ireland', '1955-01-12 00:00:00'),
	(67, NULL, 'dhalleron@yahoo.ie', 'David', '', 'Halleron', 'a:3:{i:0;s:13:"14 House Hill";i:1;s:8:"The Lane";i:2;s:0:"";}', 'Choose option', '', '2019-05-14 09:33:01', 'Pending', 'Medium', 2147483647, 2147483647, 'United States', '2000-01-01 00:00:00'),
	(68, NULL, 'jlyon@gmail.com', 'James', '', 'Lyon', 'a:3:{i:0;s:13:"24 Holy Mount";i:1;s:12:"Gods Kitchen";i:2;s:0:"";}', 'Choose option', '', '2019-05-14 09:34:13', 'Pending', 'Low', 2147483647, 3641885, 'United Kingdom', '2010-05-14 00:00:00'),
	(69, NULL, 'oyeahpurcell@hotmail.com', 'Owen', '', 'Purcell', 'a:3:{i:0;s:13:"255b The Lake";i:1;s:11:"Summerville";i:2;s:0:"";}', 'Galway', '256 JHG', '2019-05-14 09:35:14', 'Pending', 'Low', 16845653, 534684665, 'Ireland', '2001-09-16 00:00:00'),
	(70, NULL, 'toneill@aquafairy.com', 'Tim', '', 'O Neill', 'a:3:{i:0;s:17:"14 The Hill Again";i:1;s:9:"Hollyview";i:2;s:0:"";}', 'Fermanagh', '165 GJG', '2019-05-14 09:38:02', 'Pending', 'High', 2147483647, 2147483647, 'Ireland', '1956-12-25 00:00:00'),
	(71, NULL, 'pjones@hotmail.com', 'Philip', '', 'Jones', 'a:3:{i:0;s:13:"55 Gilly Lane";i:1;s:10:"Hopes View";i:2;s:0:"";}', 'Cavan', 'JHG 654', '2019-05-14 09:39:00', 'Pending', 'Low', 645646911, 254154645, 'Ireland', '2014-10-15 00:00:00'),
	(72, NULL, 'dsmurphy@gmail.com', 'Delilah', 'Sharon', 'Murphy', 'a:3:{i:0;s:15:"25 Grove Street";i:1;s:7:"Compton";i:2;s:0:"";}', 'Choose option', '', '2019-05-14 09:48:11', 'Pending', 'Low', 154549923, 318855469, 'United States', '1986-05-16 00:00:00'),
	(73, NULL, 'jpharroh@yahoo.com', 'Joesph', '', 'Pharroh', 'a:3:{i:0;s:11:"Grove House";i:1;s:12:"The Clickers";i:2;s:0:"";}', 'Kilkenny', '152 JHG', '2019-05-14 09:49:29', 'Pending', 'Low', 2147483647, 568484651, 'Ireland', '1994-01-30 00:00:00'),
	(74, NULL, 'jtidbit@hotmail.com', 'Jimmy', '', 'Tidbit', 'a:3:{i:0;s:9:"House B13";i:1;s:11:"Small Place";i:2;s:0:"";}', 'Sligo', '154KJH', '2019-05-14 09:50:26', 'Pending', 'Low', 2141846546, 2147483647, 'Ireland', '2013-11-24 00:00:00'),
	(75, NULL, 'bgulleon@gamil.com', 'Bill', '', 'Gulleon', 'a:3:{i:0;s:16:"14 Hill Top View";i:1;s:0:"";i:2;s:0:"";}', 'Clare', '156JGH', '2019-05-14 09:51:18', 'Pending', 'Low', 216568468, 516846554, 'Ireland', '1942-01-29 00:00:00'),
	(76, NULL, 'hmeavegot@gmail.com', 'Hilda', '', 'Meavegot', 'a:3:{i:0;s:14:"House Number 9";i:1;s:12:"765 High Top";i:2;s:0:"";}', 'Louth', '154JHJ', '2019-05-14 09:52:23', 'Pending', 'Low', 654654894, 286546556, 'Ireland', '2001-09-29 00:00:00'),
	(77, NULL, 'kmiddleton@buckingham.com', 'Kate', '', 'Middelton', 'a:3:{i:0;s:20:"23 Buckingham Palace";i:1;s:9:"Palace St";i:2;s:0:"";}', 'Choose option', '', '2019-05-14 09:53:22', 'Pending', 'Low', 652165464, 2147483647, 'United Kingdom', '1989-05-16 00:00:00'),
	(78, NULL, 'lgriffindor@hotmail.com', 'Linda', '', 'Griffindor', 'a:3:{i:0;s:11:"20 James St";i:1;s:0:"";i:2;s:0:"";}', 'Choose option', '', '2019-05-14 09:54:13', 'Pending', 'Low', 6565464, 2147483647, 'Andorra', '2005-09-16 00:00:00'),
	(79, NULL, 'jrivers@outlook.com', 'Joan', '', 'Rivers', 'a:3:{i:0;s:16:"45 Gillford Arms";i:1;s:9:"Merrylane";i:2;s:0:"";}', 'Dublin', '561HJ', '2019-05-14 09:57:25', 'Pending', 'Low', 25198846, 56164845, 'Ireland', '2003-09-16 00:00:00'),
	(80, NULL, 'poneill@hotmail.com', 'Paul', '', 'O Neill', 'a:3:{i:0;s:11:"25 Hot Lane";i:1;s:12:"Lane Hottest";i:2;s:0:"";}', 'Dublin', '6468JGJH', '2019-05-14 09:58:36', 'Pending', 'Low', 65665, 2646545, 'Ireland', '1986-05-25 00:00:00'),
	(81, NULL, 'astark@gmail.com', 'Aryia', '', 'Stark', 'a:3:{i:0;s:7:"Apt 34B";i:1;s:10:"Winterfell";i:2;s:0:"";}', 'Kildare', '6545KJHJ', '2019-05-14 09:59:29', 'Pending', 'Low', 2147483647, 6519849, 'Ireland', '1995-09-05 00:00:00'),
	(82, NULL, 'bstarkthetree@hotmail.com', 'Bran', '', 'Stark', 'a:3:{i:0;s:8:"The Tree";i:1;s:10:"Winterfell";i:2;s:0:"";}', 'Derry', '', '2019-05-14 10:00:17', 'Pending', 'Low', 265465464, 2147483647, 'Ireland', '1958-01-31 00:00:00'),
	(83, NULL, 'eohamley@gmail.com', 'Eoin', '', 'Hamley', 'a:3:{i:0;s:11:"76 KilBarra";i:1;s:10:"Holy Holls";i:2;s:0:"";}', 'Waterford', '654JHVHG', '2019-05-14 10:01:27', 'Pending', 'Low', 321848, 321894894, 'Ireland', '1958-07-29 00:00:00'),
	(84, NULL, 'jscout@gmail.com', 'Jacob', '', 'Scout', 'a:3:{i:0;s:13:"45 Scout Lane";i:1;s:10:"The Scouts";i:2;s:0:"";}', 'Laois', '54JHG', '2019-05-14 10:02:21', 'Pending', 'Low', 25646545, 5161645, 'Ireland', '1999-01-26 00:00:00'),
	(85, NULL, 'garmma@hotmail.co.uk', 'Gary', '', 'Armma', 'a:3:{i:0;s:11:"65 Arms Ago";i:1;s:11:"Tilly Gotts";i:2;s:0:"";}', 'Choose option', '', '2019-05-14 10:03:16', 'Pending', 'Low', 2147483647, 2147483647, 'United Kingdom', '1985-09-16 00:00:00'),
	(86, NULL, '', 'Daisy', '', 'Poppy', 'a:3:{i:0;s:13:"56 High World";i:1;s:16:"New Born Heights";i:2;s:0:"";}', 'Longford', '65GH', '2019-05-14 10:04:11', 'Pending', 'Low', 546545654, 26546546, 'Ireland', '2019-05-14 00:00:00'),
	(87, NULL, 'ghindleton@gmail.com', 'Gerry', '', 'Hindleton', 'a:3:{i:0;s:13:"16 House Hill";i:1;s:8:"The Lane";i:2;s:0:"";}', 'Tyrone', '654JHGHJ', '2019-05-14 10:05:53', 'Pending', 'Low', 2147483647, 61659848, 'Ireland', '1959-09-06 00:00:00'),
	(88, NULL, '', 'Karen', '', 'Mc Mahon', 'a:3:{i:0;s:15:"65 Grove Street";i:1;s:11:"Hilltop Ave";i:2;s:0:"";}', 'Fermanagh', '654GUY', '2019-05-14 10:08:55', 'Pending', 'Low', 151515, 2147483647, 'Ireland', '1981-05-19 00:00:00'),
	(89, NULL, '', 'Joey', '', 'Tribiany', 'a:3:{i:0;s:15:"65 Central Perk";i:1;s:7:"5th Ave";i:2;s:0:"";}', 'Choose option', '', '2019-05-14 10:09:47', 'Pending', 'Low', 2147483647, 2147483647, 'United States', '1991-05-16 00:00:00'),
	(90, NULL, '', 'Peter', '', 'Maher', 'a:3:{i:0;s:13:"23 Joust Hill";i:1;s:11:"Hill Estate";i:2;s:0:"";}', 'Tipperary', '654JHGH', '2019-05-14 10:10:53', 'Pending', 'Low', 54654548, 21648948, 'Ireland', '2009-02-05 00:00:00'),
	(91, NULL, '', 'Alan', '', 'Wick', 'a:3:{i:0;s:15:"16 Killmore Ave";i:1;s:16:"Killless Terrace";i:2;s:0:"";}', 'Derry', '6JHG', '2019-05-14 10:11:38', 'Pending', 'Low', 2147483647, 35145489, 'Ireland', '1996-05-30 00:00:00');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;

-- Dumping data for table ehr.radiology_record: ~6 rows (approximately)
DELETE FROM `radiology_record`;
/*!40000 ALTER TABLE `radiology_record` DISABLE KEYS */;
INSERT INTO `radiology_record` (`id`, `patient_id_id`, `staff_id_id`, `area`, `xray_type`, `contrast`, `side`, `pacemaker`, `sedation`, `claustrophobia`, `metal`, `metal_area`, `date_created`, `notes`) VALUES
	(2, 63, 10, 'Elbow', 'MRA', 1, 'Left', 1, 1, 1, 1, 'Left Foot', '2019-05-14 10:42:46', 'Patient is claustrophobic. Care to be taken'),
	(3, 63, 10, 'Cervical Spine', 'MRI', 1, '', 1, 1, 1, 1, 'Left Foot', '2019-05-14 10:43:14', ''),
	(4, 70, 14, 'Humerus', 'MRA', 1, 'Right', 1, 1, 1, 1, '', '2019-05-14 11:36:31', 'Patient needs surgery urgently'),
	(5, 70, 14, 'Shoulder', 'MRV', 1, 'Bi', 1, 1, 1, 1, '', '2019-05-14 11:37:01', 'Nice guy'),
	(6, 68, 10, 'Head', 'MRA', 1, '', 1, 1, 1, 1, '', '2019-05-14 11:51:38', ''),
	(7, 68, 10, 'Finger', 'MRA', 1, 'Bi', 1, 1, 1, 1, 'Head', '2019-05-14 11:52:03', 'Great kids');
/*!40000 ALTER TABLE `radiology_record` ENABLE KEYS */;

-- Dumping data for table ehr.user: ~14 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `roles`, `password`, `account_locked`, `first_name`, `last_name`, `last_patient_id`) VALUES
	(8, 'ehearne', '["ROLE_ADMIN"]', '$2y$13$4G7tesmL/nW16hQyIh9Sb.9UIFCbmNQ3xbwjudD/rWm5ZVHq.Bb/i', 0, 'Eoin', 'Hearne', NULL),
	(9, 'jaustine', '["ROLE_DOCTOR"]', '$2y$13$tevacW.XOk7YgC2Y8p/UjuM94iv4kWPM0j9HHFksFoHnKVPkbjoxq', 0, 'Jane', 'Austine', NULL),
	(10, 'dmurphy', '["ROLE_DOCTOR"]', '$2y$13$2QR/3cUJCcvkRi/BgrhpKuCYmTpgTDphZipSIZ4llWI38kZVPhn8e', 0, 'David', 'Murphy', 85),
	(11, 'jdolan', '["ROLE_DOCTOR"]', '$2y$13$ph021bl3QR3SqPNl1kH73uit5gAtLbm8lYDas0xh78/Xa.3jGmWGW', 0, 'Joe', 'Dolan', NULL),
	(12, 'mreeves', '["ROLE_DOCTOR"]', '$2y$13$PxgA7R01Sr6sdLXCbe7zI.1qFR5WmfN5uQekhg3hAGGFUVa/HTFWi', 0, 'Morpheus', 'Reeves', NULL),
	(13, 'hoconnor', '["ROLE_DOCTOR"]', '$2y$13$k50MvXii5x5nZ/JPzow1ZeivItZdQWu32l1kMjeYzR2FRdNFXlWCa', 0, 'Hilda', 'O Connor', NULL),
	(14, 'rplant', '["ROLE_NURSE"]', '$2y$13$IG19bFVdvmJ74uzx7qW6genrC0nRqP8kwYCkW5c1UUf32x7nt0HGS', 0, 'Robert', 'Plant', 79),
	(15, 'bgeldof', '["ROLE_NURSE"]', '$2y$13$mAUdhbinHi3x7jkFUbqETe5JS3939WwjjrYKMiT818GOjgVjzSIQO', 0, 'Bob', 'Geldof', NULL),
	(16, 'roneill', '["ROLE_NURSE"]', '$2y$13$srbRU0Jv0UlwuAMmsW9HAegoWKtItr418eJ9P2oPE7KubpceaJ7..', 0, 'Richard', 'O Neill', NULL),
	(17, 'melliott', '["ROLE_CLERICAL"]', '$2y$13$wBH6v1SPvYl6aZ.bpjF9c.QjAcjsOQYVz1XgtKA3AD.7e3smvgfbe', 0, 'Marion', 'Elliott', NULL),
	(18, 'smahon', '["ROLE_CLERICAL"]', '$2y$13$6LmNmdOGl/Izi41OLmHLh.NOgm8TxVQQLrWDcnXYZUMkUBbJ9Nlt6', 0, 'Siobhan', 'Mahon', NULL),
	(19, 'nmcmahon', '["ROLE_CLERICAL"]', '$2y$13$WWo1ID/p9dy1MAM0Hg.Fourt0ZynisYhAYSQwwG6tHFMPZXKdhwzq', 0, 'Nathan', 'Mc Mahon', NULL),
	(20, 'jmurphy', '["ROLE_ADMIN"]', '$2y$13$R2uxaKaq1NxP7Pak4Of9c.zCf/aRU/0xnfnTlfYMmA10yWrpPZ2xC', 0, 'Joe', 'Murphy', NULL),
	(21, 'gjones', '["ROLE_ADMIN"]', '$2y$13$7vUTb4QuJHObLbZkGEjniulEQl0y69e9xO2dToVAj7BOwl/nQiboi', 0, 'Godfrey', 'Jones', NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
