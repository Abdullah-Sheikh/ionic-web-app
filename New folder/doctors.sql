-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2020 at 11:21 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covid_19_dbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` varchar(10) NOT NULL,
  `doctor_name` varchar(20) NOT NULL,
  `doctor_age` int(3) NOT NULL,
  `doctor_phone` varchar(14) NOT NULL,
  `doctor_email` varchar(20) NOT NULL,
  `doctor_city` varchar(20) NOT NULL,
  `doctor_province` varchar(20) NOT NULL,
  `doctor_status` varchar(20) NOT NULL,
  `isolation_ward_id` varchar(15) DEFAULT 'NULL',
  `quarantine_ward_id` varchar(15) DEFAULT 'NULL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `doctor_name`, `doctor_age`, `doctor_phone`, `doctor_email`, `doctor_city`, `doctor_province`, `doctor_status`, `isolation_ward_id`, `quarantine_ward_id`) VALUES
('2', 'Nazeer Bloch', 66, '03157141715', 'nazir@bloch.com', 'Quetta', 'Blochistan', 'Isolate', 'PK-I-2322', '0'),
('3', 'Haris Hafeez', 74, '2325465453', 'hulk@marvel.com', 'FSD', 'KPK', 'Qurantine', '0', 'PK-Q-4322');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD UNIQUE KEY `patient_email` (`doctor_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
