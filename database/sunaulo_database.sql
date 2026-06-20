-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2026 at 07:31 AM
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
-- Database: `sunaulo_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `elderly_profile`
--

CREATE TABLE `elderly_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `medical_condition` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elderly_profile`
--

INSERT INTO `elderly_profile` (`id`, `user_id`, `name`, `age`, `gender`, `address`, `medical_condition`, `created_at`) VALUES
(1, 1, 'Pratikshya', 60, 'Female', 'Dhulikel', 'normal', '2026-06-07 18:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `family_elder_link`
--

CREATE TABLE `family_elder_link` (
  `id` int(11) NOT NULL,
  `family_id` int(11) DEFAULT NULL,
  `elder_id` int(11) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `is_primary_contact` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `family_profile`
--

CREATE TABLE `family_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `health_records`
--

CREATE TABLE `health_records` (
  `id` int(11) NOT NULL,
  `elder_id` int(11) DEFAULT NULL,
  `blood_pressure` varchar(20) DEFAULT NULL,
  `sleep_hours` int(11) DEFAULT NULL,
  `water_intake` int(11) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `health_records`
--

INSERT INTO `health_records` (`id`, `elder_id`, `blood_pressure`, `sleep_hours`, `water_intake`, `weight`, `date`, `user_id`) VALUES
(1, NULL, '120/180', 9, 3, 70, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `medical_contacts`
--

CREATE TABLE `medical_contacts` (
  `id` int(11) NOT NULL,
  `elder_id` int(11) DEFAULT NULL,
  `contact_name` varchar(100) DEFAULT NULL,
  `contact_type` enum('doctor','pharmacy','hospital','ambulance') DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_schedule`
--

CREATE TABLE `medicine_schedule` (
  `id` int(11) NOT NULL,
  `elder_id` int(11) DEFAULT NULL,
  `medicine_name` varchar(100) DEFAULT NULL,
  `dosage` varchar(50) DEFAULT NULL,
  `med_interval` varchar(50) DEFAULT NULL,
  `reminder_time` time DEFAULT NULL,
  `status` enum('Pending','Taken','Not Taken','Finished','Missed') DEFAULT 'Pending',
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine_schedule`
--

INSERT INTO `medicine_schedule` (`id`, `elder_id`, `medicine_name`, `dosage`, `med_interval`, `reminder_time`, `status`, `date`) VALUES
(5, 1, 'paracitamol', '1', NULL, '08:45:00', 'Finished', '2025-03-20'),
(6, 1, 'paracitamol', '1', 'Every 4 hours', '08:45:00', 'Pending', '2025-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `memories`
--

CREATE TABLE `memories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `uploaded_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mood_checkins`
--

CREATE TABLE `mood_checkins` (
  `id` int(11) NOT NULL,
  `elder_id` int(11) DEFAULT NULL,
  `mood` varchar(50) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mood_checkins`
--

INSERT INTO `mood_checkins` (`id`, `elder_id`, `mood`, `note`, `created_at`) VALUES
(1, 1, 'Happy 😊', 'i am happy!!!', '2026-06-07 18:46:37'),
(2, 1, 'Sad 😔', '', '2026-06-08 15:11:59'),
(3, 1, 'Angry 😠', '', '2026-06-10 13:35:22'),
(4, 1, 'Weak 😣', '', '2026-06-10 13:35:29'),
(5, 1, 'Weak 😣', '', '2026-06-10 13:38:05'),
(6, 1, 'Weak 😣', '', '2026-06-10 13:40:44'),
(7, 1, 'Weak 😣', '', '2026-06-10 13:40:53'),
(8, 1, 'Weak 😣', '', '2026-06-10 13:40:57'),
(9, 1, 'Happy', '', '2026-06-10 20:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sos_alerts`
--

CREATE TABLE `sos_alerts` (
  `id` int(11) NOT NULL,
  `elder_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,6) DEFAULT NULL,
  `longitude` decimal(10,6) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sos_alerts`
--

INSERT INTO `sos_alerts` (`id`, `elder_id`, `message`, `latitude`, `longitude`, `address`, `status`, `created_at`) VALUES
(1, 1, 'Help Needed', NULL, NULL, NULL, 'active', '2026-06-07 18:47:49'),
(2, 1, 'Help Needed', NULL, NULL, NULL, 'active', '2026-06-07 18:48:00'),
(3, 1, 'Help Needed', NULL, NULL, NULL, 'active', '2026-06-07 18:48:02'),
(4, 1, 'Help Needed', NULL, NULL, NULL, 'active', '2026-06-07 18:48:03'),
(5, 1, 'Help Needed', NULL, NULL, NULL, 'active', '2026-06-07 18:48:04'),
(6, 1, 'Help Needed', NULL, NULL, NULL, 'active', '2026-06-07 18:48:05'),
(7, 1, 'Help Needed', NULL, NULL, NULL, 'active', '2026-06-07 18:48:05'),
(8, 1, 'Help Needed', NULL, NULL, NULL, 'active', '2026-06-07 18:48:06'),
(9, 1, 'Help Needed', NULL, NULL, NULL, 'active', '2026-06-08 12:03:39'),
(10, 1, 'Help Needed', NULL, NULL, NULL, 'active', '2026-06-08 12:24:32'),
(11, 1, 'Help Needed', NULL, NULL, NULL, 'active', '2026-06-08 12:24:35'),
(12, 1, 'Help Needed', NULL, NULL, NULL, 'active', '2026-06-08 15:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('elder','family') NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`, `phone`, `created_at`) VALUES
(1, 'Pratikshya Sapkota', 'pratikshya@gmail.com', '$2y$10$aKQ7EnpUZ3DWEbrDYnFHSOn3Q2vo8Ztr1ubDE3bTNySqpx8paN3/y', 'elder', '9860240334', '2026-06-07 18:43:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `elderly_profile`
--
ALTER TABLE `elderly_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `family_elder_link`
--
ALTER TABLE `family_elder_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `family_id` (`family_id`),
  ADD KEY `elder_id` (`elder_id`);

--
-- Indexes for table `family_profile`
--
ALTER TABLE `family_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `health_records`
--
ALTER TABLE `health_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elder_id` (`elder_id`);

--
-- Indexes for table `medical_contacts`
--
ALTER TABLE `medical_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elder_id` (`elder_id`);

--
-- Indexes for table `medicine_schedule`
--
ALTER TABLE `medicine_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elder_id` (`elder_id`);

--
-- Indexes for table `memories`
--
ALTER TABLE `memories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mood_checkins`
--
ALTER TABLE `mood_checkins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elder_id` (`elder_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sos_alerts`
--
ALTER TABLE `sos_alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elder_id` (`elder_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `elderly_profile`
--
ALTER TABLE `elderly_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `family_elder_link`
--
ALTER TABLE `family_elder_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family_profile`
--
ALTER TABLE `family_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `health_records`
--
ALTER TABLE `health_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medical_contacts`
--
ALTER TABLE `medical_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine_schedule`
--
ALTER TABLE `medicine_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `memories`
--
ALTER TABLE `memories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mood_checkins`
--
ALTER TABLE `mood_checkins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sos_alerts`
--
ALTER TABLE `sos_alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `elderly_profile`
--
ALTER TABLE `elderly_profile`
  ADD CONSTRAINT `elderly_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `family_elder_link`
--
ALTER TABLE `family_elder_link`
  ADD CONSTRAINT `family_elder_link_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family_profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `family_elder_link_ibfk_2` FOREIGN KEY (`elder_id`) REFERENCES `elderly_profile` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `family_profile`
--
ALTER TABLE `family_profile`
  ADD CONSTRAINT `family_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `health_records`
--
ALTER TABLE `health_records`
  ADD CONSTRAINT `health_records_ibfk_1` FOREIGN KEY (`elder_id`) REFERENCES `elderly_profile` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medical_contacts`
--
ALTER TABLE `medical_contacts`
  ADD CONSTRAINT `medical_contacts_ibfk_1` FOREIGN KEY (`elder_id`) REFERENCES `elderly_profile` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medicine_schedule`
--
ALTER TABLE `medicine_schedule`
  ADD CONSTRAINT `medicine_schedule_ibfk_1` FOREIGN KEY (`elder_id`) REFERENCES `elderly_profile` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `memories`
--
ALTER TABLE `memories`
  ADD CONSTRAINT `memories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mood_checkins`
--
ALTER TABLE `mood_checkins`
  ADD CONSTRAINT `mood_checkins_ibfk_1` FOREIGN KEY (`elder_id`) REFERENCES `elderly_profile` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sos_alerts`
--
ALTER TABLE `sos_alerts`
  ADD CONSTRAINT `sos_alerts_ibfk_1` FOREIGN KEY (`elder_id`) REFERENCES `elderly_profile` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
