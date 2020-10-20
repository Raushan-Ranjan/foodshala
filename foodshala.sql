-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 20, 2020 at 09:29 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodshala`
--

-- --------------------------------------------------------

--
-- Table structure for table `foodItem`
--

CREATE TABLE `foodItem` (
  `company_name` varchar(50) DEFAULT NULL,
  `food_name` varchar(25) DEFAULT NULL,
  `price` varchar(4) DEFAULT NULL,
  `type` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foodItem`
--

INSERT INTO `foodItem` (`company_name`, `food_name`, `price`, `type`) VALUES
('Ashina Grill', 'Chicken Roll', '90', 'Non-Veg'),
('Ashina Grill', 'Panner Masala', '60', 'Veg'),
('Ashina Grill', 'Panner Roll', '45', 'Veg'),
('Ashina Grill', 'Rasgulla', '20', 'Veg'),
('Snack Point', 'Baby Corn Rice', '145', 'Veg'),
('Snack Point', 'Jalebi', '100', 'Veg'),
('Snack Point', 'panner Pakoda', '55', 'Veg'),
('Snack Point', 'chilli Masrum', '195', 'Veg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `customer` varchar(50) DEFAULT NULL,
  `company_name` varchar(50) DEFAULT NULL,
  `food_name` varchar(30) DEFAULT NULL,
  `price` varchar(4) DEFAULT NULL,
  `type` varchar(7) DEFAULT NULL,
  `qty` varchar(3) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`customer`, `company_name`, `food_name`, `price`, `type`, `qty`, `date`) VALUES
('Raushan Ranjan', 'Ashina Grill', 'Panner Roll', '45', 'Veg', '3', '2020-10-07 11:36:12'),
('Raushan Ranjan', 'Ashina Grill', 'Panner Masala', '60', 'Veg', '1', '2020-10-07 11:36:12'),
('Raushan Ranjan', 'Ashina Grill', 'Rasgulla', '20', 'Veg', '1', '2020-10-07 11:36:12'),
('Raushan Ranjan', 'Ashina Grill', 'Chicken Roll', '90', 'Non-Veg', '4', '2020-10-07 11:37:20'),
('Suraj', 'Ashina Grill', 'Chicken Roll', '90', 'Non-Veg', '4', '2020-10-07 13:27:18'),
('Suraj', 'Snack Point', 'Baby Corn Rice', '145', 'Veg', '2', '2020-10-07 13:32:28'),
('Suraj', 'Snack Point', 'panner Pakoda', '55', 'Veg', '1', '2020-10-07 13:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `registerCust`
--

CREATE TABLE `registerCust` (
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registerCust`
--

INSERT INTO `registerCust` (`name`, `email`, `phone`, `password`) VALUES
('Raushan Ranjan', 'jacksparrow14358@gmail.com', '9874563210', 'raushan'),
('Suraj', 'kumarsuraj19111997@gmail.com', '9155789654', '789');

-- --------------------------------------------------------

--
-- Table structure for table `resturant`
--

CREATE TABLE `resturant` (
  `name` varchar(40) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resturant`
--

INSERT INTO `resturant` (`name`, `email`, `phone`, `street`, `zip_code`, `city`, `state`, `password`) VALUES
('Ashina Grill', 'contact@ashina.grill', '9162441708', '1st floor, Mahadev colony, bhootnath road', '800026', 'Patna', 'Bihar', '123456'),
('Snack Point', 'contact@snack.point', '1234567890', 'Dr Colony', '800015', 'Patna', 'Bihar', '4567');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registerCust`
--
ALTER TABLE `registerCust`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `resturant`
--
ALTER TABLE `resturant`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
