-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 09:23 AM
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
-- Database: `school_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `name`, `created_at`) VALUES
(1, 'Math', '2024-06-23 12:33:19'),
(2, 'Science', '2024-06-23 12:33:19'),
(3, 'History', '2024-06-23 12:33:19');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `email`, `address`, `class_id`, `image`, `created_at`) VALUES
(3, 'krishna ', 'krishna1@gmail.com', 'Nepali tola Ramnagar P.O+P.S Ramnagar(Bihar)\r\nNepali tola Ramnagar P.O+P.S Ramnagar(Bihar)', 2, 'Screenshot (6).png', '2024-06-23 12:39:32'),
(4, 'Krishna Kumar', 'krishna@gmail.com', 'Nepali tola Ramnagar P.O+P.S Ramnagar(Bihar)\r\nNepali tola Ramnagar P.O+P.S Ramnagar(Bihar)', 3, 'Screenshot (1).png', '2024-06-23 12:39:42'),
(5, 'Krishna Kumar', 'krishna@gmail.com', 'Nepali tola Ramnagar P.O+P.S Ramnagar(Bihar)\r\nNepali tola Ramnagar P.O+P.S Ramnagar(Bihar)', 1, '6677cc7bbc238_Screenshot 2024-02-18 122925.png', '2024-06-23 12:49:23'),
(6, 'Krishna Kumar', 'krishna@gmail.com', 'Nepali tola Ramnagar P.O+P.S Ramnagar(Bihar)\r\nNepali tola Ramnagar P.O+P.S Ramnagar(Bihar)', 3, '6677cc8bde106_Screenshot 2024-05-16 115603.png', '2024-06-23 12:49:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
