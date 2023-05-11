-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2023 at 09:46 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `booked` tinyint(1) NOT NULL DEFAULT '0',
  `cancelled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `customer_id`, `salon_id`, `date`, `time`, `booked`, `cancelled`) VALUES
(42, 32, 5, '2023-03-25', '9:30 PM', 0, 1),
(43, 32, 5, '2023-03-26', '10:30 PM', 1, 0),
(44, 32, 5, '2023-03-27', '3:30 PM', 0, 1),
(45, 32, 5, '2023-03-27', '3:30 PM', 1, 0),
(46, 32, 29, '2023-03-27', '8:30 AM', 0, 1),
(47, 32, 5, '2023-03-28', '10:30 PM', 0, 1),
(48, 32, 29, '2023-03-27', '9:30 PM', 0, 1),
(49, 41, 31, '2023-03-28', '3:30 PM', 1, 0),
(50, 32, 5, '2023-03-28', '7:30 PM', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `barbers`
--

CREATE TABLE `barbers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `has_salon` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barbers`
--

INSERT INTO `barbers` (`id`, `name`, `email`, `phone`, `cnic`, `password`, `image`, `has_salon`) VALUES
(10, 'Zaini', 'zaininam699@gmail.com', '03056184710', '3410101660995', '25f9e794323b453885f5181f1b624d0b', 'uploads/barber/profile/6413344e81f29.jpg', 1),
(40, 'Mian Touseef', 'drclumppk@gmail.com', '03120796952', '3410158230109', '25f9e794323b453885f5181f1b624d0b', 'uploads/barber/profile/64221d5b5305c.jpg', 1),
(41, 'HAMMAD CHEEMA', 'hammadch@gmail.com', '03041764995', '3410101660897', '25f9e794323b453885f5181f1b624d0b', 'uploads/642193238234e.png', 1),
(42, 'usama', 'usama@gmail.com', '03001234567', '3410101660991', '25d55ad283aa400af464c76d713c07ad', 'uploads/642247e2ba366.png', 1),
(47, 'funny bud', 'funnybud@gmail.com', '03416151133', '3410101660992', '25f9e794323b453885f5181f1b624d0b', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `booked_services`
--

CREATE TABLE `booked_services` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booked_services`
--

INSERT INTO `booked_services` (`id`, `appointment_id`, `service_id`) VALUES
(28, 42, 16),
(29, 42, 14),
(30, 43, 16),
(31, 44, 16),
(32, 44, 13),
(33, 45, 16),
(34, 45, 14),
(35, 46, 18),
(36, 47, 17),
(37, 47, 13),
(38, 48, 18),
(39, 49, 22),
(40, 50, 16);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `message` text,
  `image` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sender`, `receiver`, `message`, `image`, `date`, `seen`) VALUES
(12, 32, 5, 'Hello', '', '2023-03-19 14:44:50', 0),
(13, 5, 32, 'Hi', NULL, '2023-03-19 14:45:28', 0),
(14, 32, 5, 'How r u?', '', '2023-03-19 14:52:22', 0),
(15, 32, 5, NULL, 'uploads/chat/64173d5645eb1.png', '2023-03-19 16:50:30', 0),
(16, 5, 32, 'Hello', '', '2023-03-27 11:36:48', 0),
(17, 32, 5, 'Ki haa eee', '', '2023-03-27 12:03:57', 0),
(18, 32, 5, NULL, 'uploads/chat/64218636b7e1a.png', '2023-03-27 12:04:06', 0),
(19, 32, 29, 'Hello', '', '2023-03-27 15:30:51', 0),
(20, 32, 29, NULL, 'uploads/chat/6421b6b76c976.png', '2023-03-27 15:31:03', 0),
(21, 32, 5, 'Fghcgjh', '', '2023-03-27 15:39:42', 0),
(22, 32, 29, 'Ggh', '', '2023-03-27 15:40:05', 0),
(23, 32, 30, 'Hello', '', '2023-03-27 16:28:12', 0),
(24, 32, 30, 'Ki hal ay', '', '2023-03-27 16:28:16', 0),
(25, 38, 5, 'Hn g', '', '2023-03-27 16:31:19', 0),
(26, 38, 5, 'Ok', '', '2023-03-27 16:31:21', 0),
(27, 38, 29, 'Dguruu', '', '2023-03-27 19:29:17', 0),
(28, 38, 29, 'Fjthjf', '', '2023-03-27 19:30:28', 0),
(29, 38, 5, 'Fjyfjyfgg', '', '2023-03-27 19:33:14', 0),
(30, 38, 5, 'Tuigfti', '', '2023-03-27 19:34:32', 0),
(31, 38, 5, 'Fhgrgg', '', '2023-03-27 19:36:39', 0),
(32, 38, 5, 'Fyhgtg', '', '2023-03-27 19:38:06', 0),
(33, 38, 5, 'Hn fty5', '', '2023-03-27 19:38:58', 0),
(34, 38, 5, '6yryfd', '', '2023-03-27 19:40:42', 0),
(35, 38, 5, 'Hftgg', '', '2023-03-27 19:42:06', 0),
(36, 38, 29, 'Hlo', '', '2023-03-27 20:23:34', 0),
(37, 38, 5, 'Bhai g', '', '2023-03-27 20:33:21', 0),
(38, 38, 30, 'Ali bhai', '', '2023-03-27 20:34:39', 0),
(39, 38, 30, 'Heloooooo', '', '2023-03-27 20:39:10', 0),
(40, 38, 29, 'Jnb', '', '2023-03-27 20:39:27', 0),
(41, 38, 29, 'Kiiiiiiii hal', '', '2023-03-27 20:39:34', 0),
(42, 38, 29, NULL, 'uploads/chat/6421ff159492a.png', '2023-03-27 20:39:49', 0),
(43, 38, 29, 'Its shazam', '', '2023-03-27 20:40:31', 0),
(44, 38, 30, 'Bhai g', '', '2023-03-27 20:41:14', 0),
(45, 5, 38, 'Hn g bolo v', '', '2023-03-27 20:54:29', 0),
(46, 32, 5, 'Jnb', '', '2023-03-27 21:03:14', 0),
(47, 32, 29, 'Bhsiiiiigxdg', '', '2023-03-27 21:03:37', 0),
(48, 32, 36, 'Hello', '', '2023-03-28 06:59:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat_heads`
--

CREATE TABLE `chat_heads` (
  `salon` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `last_msg` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat_heads`
--

INSERT INTO `chat_heads` (`salon`, `customer`, `last_msg`) VALUES
(5, 32, 'Jnb'),
(5, 38, 'Hn g bolo v'),
(29, 32, 'Bhsiiiiigxdg'),
(29, 38, 'Its shazam'),
(30, 32, 'Ok'),
(30, 38, 'Bhai g'),
(36, 32, 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `city`, `password`, `image`) VALUES
(32, 'Zain Inam', 'zaininam699@gmail.com', '03099303699', 'people colony', 'lahore', '25d55ad283aa400af464c76d713c07ad', 'uploads/customer/63d516cbd1983.jpg'),
(38, 'Touseef ahmed ', 'touseefcid9@gmail.com', '03056184710', 'people colony', 'Gujranwala ', '25d55ad283aa400af464c76d713c07ad', NULL),
(39, 'mian g', 'sahilcid3@gmail.com', '03101234567', 'people colony', 'Gujranwala ', '25d55ad283aa400af464c76d713c07ad', NULL),
(40, 'faraz', 'faraz@gmail.com', '03123456789', 'Jinnah road ', 'Gujranwala ', '25d55ad283aa400af464c76d713c07ad', NULL),
(41, 'farukh', 'farukh@gmail.com', '03009876543', 'alam chowk', 'Gujranwala ', '25f9e794323b453885f5181f1b624d0b', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `salon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `salon_id`) VALUES
(15, 'uploads/barber/gallery/63b967dead025.png', 5),
(20, 'uploads/barber/gallery/63b96b8b98b93.png', 5),
(22, 'uploads/barber/gallery/63b96bbb349cd.png', 5),
(29, 'uploads/barber/gallery/642190e324243.png', 29),
(30, 'uploads/barber/gallery/6421918243fe0.png', 29),
(31, 'uploads/barber/gallery/642192eb914b5.png', 30),
(33, 'uploads/barber/gallery/64224773d3396.png', 31),
(34, 'uploads/barber/gallery/642247f163989.png', 31);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmed` tinyint(4) NOT NULL DEFAULT '0',
  `reject` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `salon_id`, `address`, `phone`, `datetime`, `confirmed`, `reject`) VALUES
(1, 32, 5, 'peoples colony', '03099303699', '2023-04-08 08:28:39', 0, 1),
(2, 32, 5, 'peoples colony', '03099303699', '2023-04-08 08:29:16', 0, 1),
(3, 40, 5, 'DC road', '03099303699', '2023-04-08 11:56:37', 1, 0),
(4, 32, 5, 'jinnah road', '03099303699', '2023-04-08 12:07:04', 0, 1),
(5, 40, 5, 'uiuytrd', '03099303699', '2023-04-08 12:13:27', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 7, 2),
(2, 1, 8, 3),
(3, 2, 8, 1),
(4, 3, 8, 3),
(5, 4, 8, 4),
(6, 5, 8, 2),
(7, 2, 8, 2),
(8, 2, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `p_desc` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `salon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `p_desc`, `price`, `quantity`, `image`, `salon_id`) VALUES
(7, 'Beard Oil', 'Good for growth of Beard', 500, 10, 'uploads/1110941843225.png', 5),
(8, 'Face Wash', 'OIl Control ', 490, 20, 'uploads/1240825660523.png', 5),
(9, 'Hair Color', 'Olivia Hair Color 42 Number', 1500, 19, 'uploads/622123314398.png', 5),
(10, 'Wax', 'jkjhgfds', 500, 20, 'uploads/1194773845873.png', 5),
(11, 'Hair Oil', 'Good for Hair Growth.', 200, 2, 'uploads/1168742192463.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `salons`
--

CREATE TABLE `salons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `certificate` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `about` longtext,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `cancelled` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `barber_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salons`
--

INSERT INTO `salons` (`id`, `name`, `address`, `city`, `certificate`, `image`, `about`, `open_time`, `close_time`, `verified`, `cancelled`, `status`, `barber_id`) VALUES
(5, 'good look', 'People Colony ', 'Gujranwala', '486594826.jpg', 'uploads/barber/salon/800763633759.png', 'Smart Salon is good salon                     ', '08:00:00', '22:00:00', 1, 0, 1, 10),
(29, 'smart cut', 'people colony', 'Gujranwala', '750841423.png', 'uploads/barber/salon/631082694375.png', '  ', '22:38:00', '23:35:00', 1, 0, 1, 40),
(30, 'Ali SALON', 'people colony', 'Gujranwala', '553507818.png', 'uploads/barber/salon/1284271623929.png', '    ', '21:00:00', '23:00:00', 1, 0, 1, 41),
(31, 'paragon salon', 'sattelatown market', 'gujranwala', '680978608.png', 'uploads/barber/salon/150282380992.png', '   ', '08:00:00', '23:00:00', 1, 0, 1, 42),
(36, 'Best salon', 'sattelatown', 'gujranwala', '875409337.png', NULL, NULL, NULL, NULL, 1, 0, 1, 47);

-- --------------------------------------------------------

--
-- Table structure for table `salon_ratings`
--

CREATE TABLE `salon_ratings` (
  `id` int(11) NOT NULL,
  `rating` tinyint(4) DEFAULT NULL,
  `review` varchar(255) DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `salon_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_ratings`
--

INSERT INTO `salon_ratings` (`id`, `rating`, `review`, `datetime`, `salon_id`, `customer_id`) VALUES
(1, 3, 'Good Salon', '2023-03-04 16:02:53', 5, 32),
(32, 4, '', '2023-03-27 17:35:49', 29, 32),
(33, 0, 'Fghrer', '2023-03-27 21:41:21', 29, 38),
(34, 3, 'Good experience ', '2023-03-28 09:18:32', 5, 40),
(35, 4, 'Nice', '2023-03-28 09:19:01', 29, 40),
(36, 4, '', '2023-03-28 09:19:14', 29, 40);

-- --------------------------------------------------------

--
-- Table structure for table `salon_workers`
--

CREATE TABLE `salon_workers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `salon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon_workers`
--

INSERT INTO `salon_workers` (`id`, `firstname`, `lastname`, `image`, `phone`, `salon_id`) VALUES
(7, 'zain', 'zain', 'uploads/1568733499877.png', '03124251073', 5),
(8, 'ali', 'ali', 'uploads/811913652189.png', '03075313442', 5),
(9, 'TALHA', 'IMRAN', 'uploads/279457384919.png', '03120796952', 29),
(13, 'TALHA', 'IMRAN', 'uploads/1551127800839.png', '03001234567', 30),
(14, 'ali', 'umer', 'uploads/223883756181.png', '03416151326', 31);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `duration` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `salon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `duration`, `category`, `salon_id`) VALUES
(13, 'fade haircut', '300', 30, 'Hair Cut', 5),
(14, 'buzz cut', '350', 35, 'Hair Cut', 5),
(15, 'crew cut', '300', 30, 'Hair Cut', 5),
(16, 'royale beard', '200', 30, 'Beard Style', 5),
(17, 'petite goatee', '350', 30, 'Beard Style', 5),
(18, 'NAILING', '1000', 15, 'MENI CURE', 29),
(19, 'face mask', '4250', 40, 'Face Massage', 30),
(21, 'crew cut', '200', 25, 'Hair Cut', 30),
(22, 'under cut', '250', 40, 'hair style', 31);

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `salon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `category`, `salon_id`) VALUES
(1, 'Beard Style', 5),
(2, 'Hair Cut', 5),
(5, 'MENI CURE', 29),
(33, 'Hair Cut', 30),
(34, 'Face Massage', 30),
(35, 'hair style', 31);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rank` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `password`, `rank`, `image`, `status`) VALUES
(33, 'zaini', 'Inam', 'zaininam699@gmail.com', '03217766974', '25f9e794323b453885f5181f1b624d0b', 'admin', '285772401.jpg', 'active'),
(49, 'ali', 'ahmad', 'ali@gmail.com', '03099303699', '25f9e794323b453885f5181f1b624d0b', 'admin', NULL, 'active'),
(50, 'bilal', 'ahmad', 'bilal@gmail.com', '03124251073', '25f9e794323b453885f5181f1b624d0b', 'employee', NULL, 'active'),
(51, 'TALHA', 'saab', '1234452@GMAIL.COM', '09876543210', '25d55ad283aa400af464c76d713c07ad', 'employee', NULL, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booked_services`
--
ALTER TABLE `booked_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_heads`
--
ALTER TABLE `chat_heads`
  ADD PRIMARY KEY (`salon`,`customer`),
  ADD KEY `customer` (`customer`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`phone`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salons`
--
ALTER TABLE `salons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barber_id` (`barber_id`);

--
-- Indexes for table `salon_ratings`
--
ALTER TABLE `salon_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_workers`
--
ALTER TABLE `salon_workers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `booked_services`
--
ALTER TABLE `booked_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
