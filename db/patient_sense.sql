-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2020 at 07:04 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patient_sense`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `username` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`username`, `pass`) VALUES
('admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `doctor_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appoinment_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`doctor_id`, `username`, `appointment_date`, `appoinment_time`) VALUES
(16, 'rock', '2020-09-26', '20:38:00'),
(16, 'alex', '2020-09-28', '20:18:00'),
(9, 'neo', '2020-09-28', '09:23:00'),
(10, 'neo', '2020-09-28', '04:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `approval_id` int(255) NOT NULL,
  `doc_id` int(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `approval`
--

INSERT INTO `approval` (`approval_id`, `doc_id`, `status`) VALUES
(3, 6, 'approved'),
(4, 7, 'approved'),
(5, 8, 'rejected'),
(6, 14, 'approved'),
(7, 16, 'approved'),
(8, 17, 'approved'),
(9, 18, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `schedule_start` time DEFAULT NULL,
  `schedule_end` time DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `username`, `f_name`, `l_name`, `department`, `schedule_start`, `schedule_end`, `location`, `price`, `description`, `email`, `pass`) VALUES
(6, 'doc1', 'Doc', 'First', 'Orthopedics', '04:37:00', '16:34:00', 'bashundhara', 1500, 'bla', 'doc1@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(7, 'doc2', 'Second', 'Doctor', 'Nuro Surgeon', '04:55:00', '07:55:00', 'Panthapath', 500, 'MBBS, FRCS', 'second@doctor.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(8, 'doc3', 'third', 'doctor', 'Immunologists', '09:03:00', '10:04:00', 'Rajshahi', 6500, 'MBBS', 'third@doctor.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(9, 'doc3', 'Steven', 'Charles', 'Orthopedics', '09:03:00', '10:04:00', 'Bashundhara', 1500, 'MBBS', 'third@doctor.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(10, 'doc1', 'Alex', 'Roth', 'Orthopedics', '04:37:00', '16:34:00', 'bashundhara', 1500, 'bla', 'doc1@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(11, 'doc2', 'Chris ', 'Lynn', 'Orthopedics', '04:55:00', '07:55:00', 'bashundhara', 500, 'MBBS, FRCS,FCPS', 'second@doctor.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(12, 'doc2', 'Stewart', 'Lynn', 'Orthopedics', '04:55:00', '07:55:00', 'bashundhara', 500, 'MBBS, FRCS,FCPS', 'second@doctor.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(13, 'doc2', 'Ivanka', 'Lynn', 'Orthopedics', '04:55:00', '07:55:00', 'bashundhara', 500, 'MBBS, FRCS,FCPS', 'second@doctor.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(14, 'kkdep', 'KK', 'Depp', 'Orthopedics', '17:47:00', '19:47:00', 'bashundhara', 800, '5yrs', 'koiri@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(15, 'tymp2', 'Typhoon ', 'R.', NULL, NULL, NULL, NULL, NULL, NULL, 'tyr@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(16, 'asdf', 'Salim', 'S.', 'Orthopedics', '19:58:00', '21:58:00', 'bashundhara', 1000, 'Green Life Medical\r\nMBBS\r\n2years', 'aaaa@gmail.com', '3da541559918a808c2402bba5012f6c60b27661c'),
(17, 'Adam', 'Adam', 'p', 'Orthopedics', '19:03:00', '21:03:00', 'bashundhara', 1000, 'mbbs', 'adam@gmail.com', '3da541559918a808c2402bba5012f6c60b27661c'),
(18, 'brad', 'brad', 'p', 'cardiologist', '18:22:00', '22:22:00', 'bashundhara', 600, 'MBBS,FCPS', 'p@p.com', '3da541559918a808c2402bba5012f6c60b27661c');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `f_name`, `l_name`, `email`, `pass`) VALUES
('alex', 'alex', 'steve', 'alex@steve.com', '3da541559918a808c2402bba5012f6c60b27661c'),
('mk2', 'Mike', 'T.', 'aaa@gmail.com', '3da541559918a808c2402bba5012f6c60b27661c'),
('neo', 'neon', 'might', 'neo.might@gmail.com', '3da541559918a808c2402bba5012f6c60b27661c'),
('rock', 'rock', 'afeller', 'wwww@gmail.com', '3da541559918a808c2402bba5012f6c60b27661c'),
('sayam56', 'Ali', 'Iktider', 'aisayam.sayam@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`approval_id`),
  ADD KEY `doc_id` (`doc_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `approval_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `approval`
--
ALTER TABLE `approval`
  ADD CONSTRAINT `approval_ibfk_1` FOREIGN KEY (`doc_id`) REFERENCES `doctors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;