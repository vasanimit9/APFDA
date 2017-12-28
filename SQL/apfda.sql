-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2017 at 04:33 PM
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
  `deliveryDate` date DEFAULT NULL,
  `driver_dTime` time DEFAULT NULL,
  `principal_dTime` time DEFAULT NULL,
  `principal_clashDate` date DEFAULT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_time_table`
--

INSERT INTO `delivery_time_table` (`id`, `deliveryDate`, `driver_dTime`, `principal_dTime`, `principal_clashDate`, `school_id`) VALUES
(1, '2017-12-27', '21:38:35', NULL, NULL, 2),
(2, '2017-12-26', '21:38:35', NULL, NULL, 3),
(14, '2017-12-27', '21:43:44', NULL, NULL, 1),
(15, '2017-12-28', '18:07:13', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_qty_deliver`
--

CREATE TABLE `food_qty_deliver` (
  `id` int(11) NOT NULL,
  `ris` int(11) NOT NULL,
  `rim` int(11) NOT NULL,
  `ril` int(11) NOT NULL,
  `rkg` int(11) NOT NULL,
  `das` int(11) NOT NULL,
  `dam` int(11) NOT NULL,
  `dal` int(11) NOT NULL,
  `dkg` int(11) NOT NULL,
  `rom` int(11) NOT NULL,
  `rol` int(11) NOT NULL,
  `rnum` int(11) NOT NULL,
  `sideItem` text NOT NULL,
  `school_id` int(11) NOT NULL,
  `deliveryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_qty_deliver`
--

INSERT INTO `food_qty_deliver` (`id`, `ris`, `rim`, `ril`, `rkg`, `das`, `dam`, `dal`, `dkg`, `rom`, `rol`, `rnum`, `sideItem`, `school_id`, `deliveryDate`) VALUES
(1, 1, 0, 0, 15, 1, 0, 0, 18, 1, 0, 2000, 'Sukhdi', 1, '2017-12-28'),
(2, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, '0', 2, '2017-12-27'),
(3, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, '0', 3, '2017-12-27'),
(4, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, '0', 4, '2017-12-27'),
(5, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, '0', 5, '2017-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `taluka_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `context` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `route_no` int(11) NOT NULL,
  `reqRice` text NOT NULL,
  `reqDal` text NOT NULL,
  `reqRoti` int(11) NOT NULL,
  `registeredDate` date DEFAULT NULL,
  `requiredDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `route_no` int(11) NOT NULL,
  `route_name` varchar(40) NOT NULL,
  `school_id` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `route_no`, `route_name`, `school_id`) VALUES
(1, 1, 'First Route', '1,2,3,4,5');

-- --------------------------------------------------------

--
-- Table structure for table `routes_meta`
--

CREATE TABLE `routes_meta` (
  `id` int(11) NOT NULL,
  `route_no` int(11) NOT NULL,
  `property_name` varchar(50) NOT NULL,
  `property_value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `taluka_id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `school_name` longtext NOT NULL,
  `morning` int(11) NOT NULL,
  `noon` int(11) NOT NULL,
  `pri` int(11) NOT NULL,
  `upri` int(11) NOT NULL,
  `principal_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `taluka_id`, `school_id`, `school_name`, `morning`, `noon`, `pri`, `upri`, `principal_user_id`) VALUES
(1, 1, 1, 'school1', 0, 0, 0, 0, 3),
(2, 1, 2, 'school2', 0, 0, 0, 0, 5),
(3, 1, 3, 'school3', 0, 0, 0, 0, 7),
(4, 1, 4, 'school4', 0, 0, 0, 0, 9),
(5, 1, 5, 'school5', 0, 0, 0, 0, 11);

-- --------------------------------------------------------

--
-- Table structure for table `taluka`
--

CREATE TABLE `taluka` (
  `taluka_id` int(11) NOT NULL,
  `taluka_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taluka`
--

INSERT INTO `taluka` (`taluka_id`, `taluka_name`) VALUES
(1, 'Gandhinagar'),
(2, 'Kalol'),
(3, 'Mansa'),
(4, 'Ahmedabad Municipal Corporation'),
(5, 'Ghatodiya'),
(6, 'Daskroi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `password_hash` varchar(50) NOT NULL,
  `user_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_email`, `password_hash`, `user_type`) VALUES
(1, 'MIT', 'vasanimit9@gmail.com', '22d7fe8c185003c98f97e5d6ced420c7', 1),
(2, 'Rohit', 'rohit98chaku@gmail.com', '22d7fe8c185003c98f97e5d6ced420c7', 5),
(3, 'Abhay', 'principal@gmail.com', '22d7fe8c185003c98f97e5d6ced420c7', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users_meta`
--

CREATE TABLE `users_meta` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_name` varchar(50) NOT NULL,
  `property_value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_meta`
--

INSERT INTO `users_meta` (`id`, `user_id`, `property_name`, `property_value`) VALUES
(1, 2, 'routeDriver', '1'),
(4, 3, 'principalAt', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `users_meta_meta`
--

CREATE TABLE `users_meta_meta` (
  `id` int(11) NOT NULL,
  `property` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_meta_meta`
--

INSERT INTO `users_meta_meta` (`id`, `property`) VALUES
(1, 'principalAt'),
(2, 'routeDriver');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(2, 'Admin'),
(5, 'Driver'),
(3, 'Executive'),
(4, 'School Principal'),
(1, 'SuperAdmin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_time_table`
--
ALTER TABLE `delivery_time_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_qty_deliver`
--
ALTER TABLE `food_qty_deliver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `route_no` (`route_no`);

--
-- Indexes for table `routes_meta`
--
ALTER TABLE `routes_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `school_id` (`school_id`,`principal_user_id`),
  ADD UNIQUE KEY `school_id_2` (`school_id`,`principal_user_id`);

--
-- Indexes for table `taluka`
--
ALTER TABLE `taluka`
  ADD PRIMARY KEY (`taluka_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `users_meta`
--
ALTER TABLE `users_meta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`property_name`);

--
-- Indexes for table `users_meta_meta`
--
ALTER TABLE `users_meta_meta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `property` (`property`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_time_table`
--
ALTER TABLE `delivery_time_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `food_qty_deliver`
--
ALTER TABLE `food_qty_deliver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taluka`
--
ALTER TABLE `taluka`
  MODIFY `taluka_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_meta`
--
ALTER TABLE `users_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_meta_meta`
--
ALTER TABLE `users_meta_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
