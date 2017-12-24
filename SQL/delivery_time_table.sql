-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2017 at 05:26 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apfda`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery_time_table`
--

CREATE TABLE `delivery_time_table` (
  `id` int(11) NOT NULL,
  `driver_ctime` timestamp NULL DEFAULT NULL,
  `principal_ctime` timestamp NULL DEFAULT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_time_table`
--

INSERT INTO `delivery_time_table` (`id`, `driver_ctime`, `principal_ctime`, `school_id`) VALUES
(1, NULL, '2017-12-24 04:23:52', 2),
(2, NULL, NULL, 3),
(3, '2017-12-24 04:23:52', '2017-12-24 04:23:52', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_time_table`
--
ALTER TABLE `delivery_time_table`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
