-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2023 at 10:14 PM
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
-- Database: `learn_and_help_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `school_user`
--

CREATE TABLE `school_user` (
  `admin_Id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `contact_email` varchar(50) DEFAULT NULL,
  `school_name` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `passwd` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_user`
--

INSERT INTO `school_user` (`admin_Id`, `school_id`, `contact_email`, `school_name`, `category`, `username`, `passwd`) VALUES
(1, 1, 'A@SchoolA.org', 'School Alp[ha', 'public', 'A@SchoolA.org', '1234'),
(2, 1, 'A@SchoolA.org', 'School Alp[ha', 'public', 'A@SchoolA.org', '1234'),
(3, 2, 'Bm@SchoolB.org', 'School B', 'public', 'Bm@SchoolB.org', '1234'),
(4, 2, 'Bm@SchoolB.org', 'School B', 'public', 'Bm@SchoolB.org', '1234'),
(5, 6, 'F@SchoolF.org', 'School F', 'private', 'F@SchoolF.org', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `school_user`
--
ALTER TABLE `school_user`
  ADD PRIMARY KEY (`admin_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `school_user`
--
ALTER TABLE `school_user`
  MODIFY `admin_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
