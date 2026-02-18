-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2026 at 06:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor-appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `pwd` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `pwd`) VALUES
(1, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` varchar(55) NOT NULL,
  `time` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL DEFAULT 'pending',
  `created` timestamp NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `doctor_id`, `patient_id`, `date`, `time`, `status`, `created`) VALUES
(26, 8, 36, '2026-03-02', '18:40', 'aproved', '2026-02-16 13:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `pwd` varchar(55) NOT NULL,
  `Specialization` varchar(55) NOT NULL,
  `status` varchar(55) DEFAULT 'Activate',
  `created_at` timestamp NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `email`, `pwd`, `Specialization`, `status`, `created_at`) VALUES
(8, 'Abdul Samad', 'samad@gmail.com', '1234', 'Dermatologist', 'Activate', '2026-02-15 19:00:00'),
(9, 'Temor Khan', 'temor@gmail.com', '1122', 'Endocrinologists', 'Activate', '2026-02-15 19:00:00'),
(10, 'john doe', 'john.smith@email.com', '112233', 'Craniofacial Surgery', 'Activate', '2026-02-15 19:00:00'),
(11, 'Dr Rafay', 'rafay@gmail.com', '2233', 'Gynecologist', 'Activate', '2026-02-15 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `slot` varchar(20) NOT NULL,
  `patient_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `email`, `phone`, `doctor_id`, `slot`, `patient_date`) VALUES
(26, 'amir iqbal', 'amir@gmail.com', '12345678987', 8, '18:40', '2026-02-02'),
(27, 'khurram ali', 'khurram@gmail.com', '1122334455', 8, '18:36', '2026-02-09'),
(28, 'moin', 'moin@gmail.com', '12345678987', 8, '18:34', '2026-02-02'),
(29, 'sameer', 'sameer@gmail.com', '1122332211', 8, '18:40', '2026-02-02'),
(30, 'salman', 'salman@gmail.com', '12345678987', 8, '18:36', '2026-02-02'),
(31, 'tahir', 'tahir@gmail.com', '12345678987', 8, '18:38', '2026-02-09'),
(32, 'hasan abid', 'hasan@gmail.com', '12345678987', 8, '18:36', '2026-02-23'),
(33, 'Ali Raza', 'ali.raza@email.com', '12345678987', 8, '18:38', '2026-02-23'),
(34, 'dani krossing', 'dani@gmail.com', '1122334455', 8, '18:36', '2026-03-02'),
(35, 'abdullah', 'abdullah@gmail.com', '111111111111', 8, '18:42', '2026-03-09'),
(36, 'Ali Raza', 'ali.raza@email.com', '12345678987', 8, '18:40', '2026-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `day` varchar(55) NOT NULL,
  `start_time` varchar(55) NOT NULL,
  `end_time` varchar(55) NOT NULL,
  `slot` int(55) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `doctor_id`, `day`, `start_time`, `end_time`, `slot`, `created_at`) VALUES
(11, 8, 'Monday', '18:30', '19:00', 2, '2026-02-16 12:52:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
