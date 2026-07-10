-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2026 at 04:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentattendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `time_in` datetime NOT NULL,
  `gate_code` varchar(20) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `sched_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `sched_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `sched_id`) VALUES
(8, 88, 6),
(9, 88, 2),
(10, 88, 1),
(11, 88, 7),
(12, 88, 4),
(13, 88, 3),
(14, 89, 6),
(15, 89, 2),
(16, 89, 1),
(17, 89, 7),
(18, 89, 4),
(19, 89, 3);

-- --------------------------------------------------------

--
-- Table structure for table `gate_codes`
--

CREATE TABLE `gate_codes` (
  `id` int(11) NOT NULL,
  `sched_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `generated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gate_codes`
--

INSERT INTO `gate_codes` (`id`, `sched_id`, `code`, `generated_at`) VALUES
(1, 1, 'MAT402WED26A', '2026-07-08 21:20:49'),
(2, 4, 'MCS401WEDF1A', '2026-07-08 21:22:32'),
(3, 1, 'MAT402WED9BF', '2026-07-08 22:12:00'),
(4, 1, 'MAT402THUCCA', '2026-07-09 19:27:38'),
(5, 1, 'MAT402THUA74', '2026-07-09 20:16:42'),
(6, 1, 'MAT402THUE85', '2026-07-09 20:30:51'),
(7, 1, 'MAT402THUBBC', '2026-07-09 21:04:55'),
(8, 1, 'MAT402THUD44', '2026-07-09 22:25:36'),
(9, 1, 'MAT402FRI77A', '2026-07-10 10:43:37'),
(10, 1, 'MAT402FRI377', '2026-07-10 11:40:18'),
(11, 4, 'MCS401FRIDB9', '2026-07-10 12:51:47'),
(12, 4, 'MCS401FRI563', '2026-07-10 19:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `day_of_week`, `start_time`, `end_time`, `course_code`, `course_name`) VALUES
(1, 'Monday', '14:00:00', '17:00:00', 'MAT 402', 'Thesis 1'),
(2, 'Wednesday', '08:30:00', '11:30:00', 'MAT 401', 'Real Analysis'),
(3, 'Thursday', '11:00:00', '14:00:00', 'MCS 401L', 'Computer Networking Design Lab'),
(4, 'Wednesday', '14:00:00', '17:00:00', 'MCS 401', 'Computer Networking Design'),
(5, 'Wednesday', '07:00:00', '08:30:00', 'SSP 101d', 'The Entrepreneurial Mind'),
(6, 'Monday', '12:00:00', '13:30:00', 'SSP 101d*', 'The Entrepreneurial Mind'),
(7, 'Monday', '17:00:00', '20:00:00', 'RLW 101', 'Life and Works of Rizal');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `student_no` int(11) NOT NULL,
  `student_name` varchar(100) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_no`, `student_name`, `status`) VALUES
(88, 2023102555, 'SWIFT, Taylor B.', 'active'),
(89, 2023102598, 'NIEVA, Lester Loyd P.', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `sched_id` (`sched_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `sched_id` (`sched_id`);

--
-- Indexes for table `gate_codes`
--
ALTER TABLE `gate_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sched_id` (`sched_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_no` (`student_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `gate_codes`
--
ALTER TABLE `gate_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`sched_id`) REFERENCES `schedules` (`id`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`sched_id`) REFERENCES `schedules` (`id`);

--
-- Constraints for table `gate_codes`
--
ALTER TABLE `gate_codes`
  ADD CONSTRAINT `gate_codes_ibfk_1` FOREIGN KEY (`sched_id`) REFERENCES `schedules` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
