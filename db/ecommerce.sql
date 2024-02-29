-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 08:41 PM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `totalAmount` float NOT NULL,
  `createdOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `cid`, `pid`, `title`, `quantity`, `totalAmount`, `createdOn`) VALUES
(30, 1, 2, 'MySQL', 1, 8000, '2024-02-29');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `createdOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `mobile`, `address`, `createdOn`) VALUES
(1, 'Sasanka', 'sasankaprem@gmail.com', 94723123123, 'Maharagama, Sri Lanka', '2024-02-28 05:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `orderStatus` tinyint(4) NOT NULL,
  `createdOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `cid`, `quantity`, `amount`, `orderStatus`, `createdOn`) VALUES
(16, 1, 2, 16020.00, 1, '2024-02-28 17:19:24'),
(17, 1, 2, 16020.00, 1, '2024-02-28 18:28:50'),
(18, 1, 2, 16020.00, 1, '2024-02-28 19:20:25'),
(19, 1, 2, 16020.00, 2, '2024-02-28 22:05:43'),
(20, 1, 2, 18020.00, 2, '2024-02-28 22:14:46'),
(21, 1, 1, 8010.00, 2, '2024-02-28 22:34:55'),
(22, 1, 4, 38040.00, 2, '2024-02-28 23:51:15'),
(23, 1, 2, 18020.00, 2, '2024-02-29 06:05:47'),
(24, 1, 2, 28030.00, 2, '2024-02-29 06:23:27'),
(25, 1, 1, 10010.00, 2, '2024-02-29 17:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE `workshops` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(200) NOT NULL,
  `createdOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`id`, `title`, `price`, `description`, `image`, `createdOn`) VALUES
(1, 'PHP', 12000, 'PHP: Hypertext Preprocessor is a server-side scripting language designed for web development but also used as a general-purpose programming language.', 'php.png', '2018-05-28 07:35:26'),
(2, 'MySQL', 8000, 'MySQL is an open-source relational database management system.', 'mysql.png', '2018-05-28 07:39:53'),
(3, 'JavaScript', 10000, 'JavaScript, often abbreviated as JS, is a high-level, interpreted programming language.', 'js.png', '2018-05-28 07:39:53'),
(4, 'HTML & CSS', 8000, 'HTML Hypertext Markup Language) and CSS Cascading Style Sheets are two of the core technologies for building Web pages.', 'html_css.png', '2018-05-29 02:11:20');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_seats`
--

CREATE TABLE `workshop_seats` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `wid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `createdOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `workshop_seats`
--

INSERT INTO `workshop_seats` (`id`, `tid`, `wid`, `quantity`, `createdOn`) VALUES
(18, 16, 2, 1, '2024-02-28 17:19:24'),
(19, 16, 4, 1, '2024-02-28 17:19:24'),
(20, 17, 2, 1, '2024-02-28 18:28:50'),
(21, 17, 4, 1, '2024-02-28 18:28:50'),
(22, 18, 2, 1, '2024-02-28 19:20:25'),
(23, 18, 4, 1, '2024-02-28 19:20:25'),
(24, 19, 2, 1, '2024-02-28 22:05:43'),
(25, 19, 4, 1, '2024-02-28 22:05:43'),
(26, 20, 2, 1, '2024-02-28 22:14:46'),
(27, 20, 3, 1, '2024-02-28 22:14:46'),
(28, 21, 2, 1, '2024-02-28 22:34:55'),
(29, 22, 1, 1, '2024-02-28 23:51:15'),
(30, 22, 2, 1, '2024-02-28 23:51:15'),
(31, 22, 3, 1, '2024-02-28 23:51:15'),
(32, 22, 4, 1, '2024-02-28 23:51:15'),
(33, 23, 3, 1, '2024-02-29 06:05:48'),
(34, 23, 2, 1, '2024-02-29 06:05:49'),
(35, 24, 2, 1, '2024-02-29 06:23:27'),
(36, 24, 3, 2, '2024-02-29 06:23:28'),
(37, 25, 3, 1, '2024-02-29 17:36:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workshop_seats`
--
ALTER TABLE `workshop_seats`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `workshop_seats`
--
ALTER TABLE `workshop_seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
