-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 01:43 PM
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
-- Database: `vaccination_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$kACH0IFtdl7O/nARe1phYujdyu63l1geza8JV0Y4ay6/bg9hqIN9G', '2025-01-16 14:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `status` enum('Pending','Approved','Rejected','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `parent_id`, `child_id`, `hospital_id`, `vaccine_id`, `appointment_date`, `status`) VALUES
(14, 12, 13, 1, 1, '2027-02-02', 'Approved'),
(15, 12, 14, 2, 1, '2026-02-03', 'Pending'),
(16, 11, 15, 6, 1, '2004-02-04', 'Pending'),
(17, 11, 16, 3, 1, '2008-02-03', 'Pending'),
(18, 11, 15, 6, 8, '2004-02-02', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `child_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `vaccination_status` varchar(255) DEFAULT 'Up-to-date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`child_id`, `parent_id`, `name`, `dob`, `gender`, `vaccination_status`) VALUES
(13, 12, 'P2 child', '2003-02-03', 'Male', 'Up-to-date'),
(14, 12, 'P2 Child2', '2006-02-03', 'Female', 'Up-to-date'),
(15, 11, 'P1 child1', '2006-02-03', 'Male', 'Up-to-date'),
(16, 11, 'P1 Child2', '2004-02-03', 'Male', 'Up-to-date');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `hospital_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hospital_id`, `name`, `email`, `password`, `address`, `contact_number`, `city`, `state`, `country`, `created_at`) VALUES
(1, 'Kevalti Larkana', 'kevalti@gmail.com', '$2y$10$yeaSjNiAoCCchenrqkS2GuMi9PyNRZB8Nzbvn7g8uRqMEwOQMhtBi', 'Pakistan 123 street, larkana 123', '1122', 'larkana', 'sindh', 'pakistan', '2025-01-13 21:33:35'),
(2, 'Gareeba', 'gareeba@gmail.com', '$2y$10$i7QuKtvl7KLBvGdGYt9tS.sWneEoXflJeJ1pO5a.lEh5Aj.L7577W', 'Gareeba badh near larkana kfc', '323239232', 'Larkana', 'Sindh', 'Pakistan', '2025-01-16 14:21:40'),
(3, 'Edhi', 'edhi@gmail.com', '$2y$10$rsz7OsE/HIkQEjQeotoGWe.5as0jFhRfxcNrQiDBcnn0RxFcuHzc2', 'House 1', '032832322', 'Karachi', 'Sindh', 'Pakistan', '2025-01-16 16:22:35'),
(4, 'Dr Kouro Mal Clinic, Larkana', 'kouro@gmail.com', '$2y$10$xPyADd/4vZVxhvY1BtRfS.XQ2e.eaG0Msjw4iV6MXLk07x8la4I4i', 'Dr Kouro Mal Clinic, Larkana', '3323923232', 'Larkana', 'Sindh', 'Pakistan', '2025-01-16 17:34:34'),
(5, 'Indus hospital, Larkana.', 'indus@gmail.com', '$2y$10$UanRPB5phYpXAkXiUjXdXOUlgXQwcsD2V64BQxS4zHe1llbTKaHsO', 'Indus hospital, Larkana.', '3223232332', 'Larkana', 'Sindh', 'Pakistan', '2025-01-16 17:35:04'),
(6, 'Hamza Dental Implants And Orthodontics Clinic, Larkana', 'hamza@gmail.com', '$2y$10$eFV2RuYvUUFCp1LrUuDB3ugqSq9jG4I.XpOj/2jEq237qB87Qit1C', 'Hamza Dental Implants And Orthodontics Clinic, Larkana', '2323232323', 'Larkana', 'Sindh', 'Pakistan', '2025-01-16 17:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_vaccines`
--

CREATE TABLE `hospital_vaccines` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `stock_available` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital_vaccines`
--

INSERT INTO `hospital_vaccines` (`id`, `hospital_id`, `vaccine_id`, `stock_available`) VALUES
(1, 1, 1, 106),
(2, 2, 1, 24),
(3, 3, 1, 23),
(4, 5, 5, 24),
(5, 5, 9, 25),
(6, 5, 6, 23),
(7, 5, 7, 2),
(8, 5, 1, 23),
(9, 5, 8, 5),
(10, 6, 1, 25),
(11, 6, 8, 345),
(12, 6, 9, 323),
(13, 6, 5, 80),
(14, 6, 6, 35);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `parent_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `type` enum('Father','Mother') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`parent_id`, `first_name`, `last_name`, `email`, `password`, `country`, `city`, `address`, `phone_number`, `type`, `created_at`) VALUES
(11, 'Parent', 'PLast', 'parent1@gmail.com', '$2y$10$a3F5Oexi/Gs5LegvSPEsKOG5gsZiRYJ1kiuIHeBnb7iZCVUT79ftC', 'Pakistan', 'Larkana', '123 street larkana', '33375454594', 'Father', '2025-01-16 17:27:26'),
(12, 'Parent', 'PLast', 'parent2@gmail.com', '$2y$10$j0/RQY8XTkW6azAig8hkkOcf0e37ifRyJOSqe1KaUC6BlMKr4ZHvy', 'Pakistan', 'Karachi', '123 street karachi', '33375454232', 'Father', '2025-01-16 17:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_schedule`
--

CREATE TABLE `vaccination_schedule` (
  `schedule_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `dose_number` int(11) NOT NULL,
  `scheduled_date` date NOT NULL,
  `status` enum('Scheduled','Completed','Missed') DEFAULT 'Scheduled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `vaccine_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `doses_required` int(11) NOT NULL,
  `recommended_age` varchar(50) DEFAULT NULL,
  `status` enum('Available','Unavailable') DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`vaccine_id`, `name`, `description`, `doses_required`, `recommended_age`, `status`, `created_at`) VALUES
(1, 'Polio', 'testttt', 1, 'Birth', 'Available', '2025-01-14 16:08:47'),
(5, 'Hepatitis B', 'Hepatitis B is an infectious disease caused by the hepatitis B virus that affects the liver; it is a type of viral hepatitis. It can cause both acute and chronic infection. Many people have no symptoms during an initial infection.', 3, '14', 'Available', '2025-01-16 12:31:32'),
(6, 'Influenza', 'Hepatitis B\r\nInfluenza\r\nInfluenza\r\nInfluenza, commonly known as the flu, is an infectious disease caused by influenza viruses. Symptoms range from mild to severe and often include fever, runny nose, sore throat, muscle pain, headache, coughing, and fatigue.', 3, '14', 'Available', '2025-01-16 12:31:53'),
(7, 'MMR vaccine', 'Hepatitis B\r\nInfluenza\r\nMMR vaccine\r\nMMR vaccine\r\nThe MMR vaccine is a vaccine against measles, mumps, and rubella, abbreviated as MMR. The first dose is generally given to children around 9 months to 15 months of age, with a second dose at 15 months to 6 years of age, with at least four weeks between the doses.', 3, '13', 'Available', '2025-01-16 12:32:17'),
(8, 'Meningococcal', 'Meningococcal disease describes infections caused by the bacterium Neisseria meningitidis. It has a high mortality rate if untreated but is vaccine-preventable. While best known as a cause of meningitis, it can also result in sepsis, which is an even more damaging and dangerous condition.', 2, '16', 'Available', '2025-01-16 12:32:38'),
(9, 'Hib vaccine', 'The Haemophilus influenzae type B vaccine, also known as Hib vaccine, is a vaccine used to prevent Haemophilus influenzae type b infection. In countries that include it as a routine vaccine, rates of severe Hib infections have decreased more than 90%.', 2, '15', 'Available', '2025-01-16 12:33:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `child_id` (`child_id`),
  ADD KEY `hospital_id` (`hospital_id`),
  ADD KEY `vaccine_id` (`vaccine_id`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`child_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`hospital_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `hospital_vaccines`
--
ALTER TABLE `hospital_vaccines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_id` (`hospital_id`),
  ADD KEY `vaccine_id` (`vaccine_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`parent_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vaccination_schedule`
--
ALTER TABLE `vaccination_schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `child_id` (`child_id`),
  ADD KEY `vaccine_id` (`vaccine_id`);

--
-- Indexes for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`vaccine_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hospital_vaccines`
--
ALTER TABLE `hospital_vaccines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vaccination_schedule`
--
ALTER TABLE `vaccination_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `vaccine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`parent_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`child_id`) REFERENCES `children` (`child_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_4` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`vaccine_id`) ON DELETE CASCADE;

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `children_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`parent_id`) ON DELETE CASCADE;

--
-- Constraints for table `hospital_vaccines`
--
ALTER TABLE `hospital_vaccines`
  ADD CONSTRAINT `hospital_vaccines_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hospital_vaccines_ibfk_2` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`vaccine_id`) ON DELETE CASCADE;

--
-- Constraints for table `vaccination_schedule`
--
ALTER TABLE `vaccination_schedule`
  ADD CONSTRAINT `vaccination_schedule_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`child_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vaccination_schedule_ibfk_2` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`vaccine_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
