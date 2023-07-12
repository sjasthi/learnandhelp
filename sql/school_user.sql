-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2023 at 12:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
  `SchoolUser_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `School_id` int(11) NOT NULL,
  `Created_Time` datetime NOT NULL,
  `Modified_Time` datetime NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_user`
--

INSERT INTO `school_user` (`SchoolUser_Id`, `User_Id`, `School_id`, `Created_Time`, `Modified_Time`, `Status`) VALUES
(2, 1, 17, '2023-07-12 16:56:21', '2023-07-12 17:20:03', 0),
(5, 6, 13, '2023-07-12 23:43:12', '2023-07-12 23:43:12', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `school_user`
--
ALTER TABLE `school_user`
  ADD PRIMARY KEY (`SchoolUser_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `school_user`
--
ALTER TABLE `school_user`
  MODIFY `SchoolUser_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
