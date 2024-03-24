-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 05:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medlabs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_appointment`
--

CREATE TABLE `tb_appointment` (
  `ID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `test` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `NIC` varchar(20) NOT NULL,
  `Report` varchar(255) DEFAULT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_appointment`
--

INSERT INTO `tb_appointment` (`ID`, `userID`, `name`, `email`, `phone`, `test`, `date`, `time`, `NIC`, `Report`, `Status`) VALUES
(17, 1, 'Mohamed', 'mizzath2003@gmail.com', '(072)083-4354', 'Lipid Profile', '2024-03-23', '10:00:00', '200412501749', NULL, '1'),
(18, 1, 'Mohamed', 'mizzath2003@gmail.com', '(072)083-4354', 'Lipid Profile', '2024-03-24', '12:00:00', '200412501749', NULL, '1'),
(19, 4, 'Izzath', 'user1@gmail.com', '(072)083-4354', 'Lipid Profile', '2024-03-25', '12:00:00', '200412501749', NULL, '1'),
(20, 4, 'Izzath', 'user1@gmail.com', '(072)083-4354', 'Blood Glucose Test', '2024-03-28', '12:00:00', '200412501749', NULL, '1'),
(21, 4, 'Izzath', 'user1@gmail.com', '(072)083-4354', 'Complete Blood Count', '2024-03-30', '14:00:00', '200412501749', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_test`
--

CREATE TABLE `tb_test` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_test`
--

INSERT INTO `tb_test` (`ID`, `name`, `description`, `price`) VALUES
(2, 'Lipid Profile', 'A lipid profile measures cholesterol and triglyceride levels in the blood. It helps assess the risk of heart disease and stroke.', 3000.00),
(3, 'Blood Glucose Test', 'This test measures the level of glucose (sugar) in the blood. It is commonly used to diagnose and monitor diabetes.', 2700.00),
(4, 'Complete Blood Count', 'A CBC measures various components of blood including red blood cells, white blood cells, and platelets.', 4000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `userID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `user_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`userID`, `name`, `email`, `phone`, `password`, `status`, `user_type`) VALUES
(1, 'Mohamed', 'mizzath2003@gmail.com', '(072)083-4354', '8cb2237d0679ca88db6464eac60da96345513964', 'active', 'user'),
(2, 'mizzath', 'mizzath4444@gmail.com', '(072)083-4354', '8cb2237d0679ca88db6464eac60da96345513964', 'active', 'admin'),
(4, 'Izzath', 'user1@gmail.com', '(072)083-4354', '8cb2237d0679ca88db6464eac60da96345513964', 'active', 'user'),
(5, 'mizzath', 'user2@gmail.com', '(072)083-4354', '8cb2237d0679ca88db6464eac60da96345513964', 'active', 'user'),
(6, 'Mohamed Izzath', 'admin1@gmail.com', '(072)083-4354', '8cb2237d0679ca88db6464eac60da96345513964', 'active', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_appointment`
--
ALTER TABLE `tb_appointment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_test`
--
ALTER TABLE `tb_test`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_appointment`
--
ALTER TABLE `tb_appointment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_test`
--
ALTER TABLE `tb_test`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
