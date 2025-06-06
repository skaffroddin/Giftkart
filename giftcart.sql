-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql102.infinityfree.com
-- Generation Time: May 23, 2025 at 07:51 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_38254576_giftcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ad_id` int(20) NOT NULL,
  `ad_email` varchar(100) NOT NULL,
  `ad_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(20) NOT NULL,
  `brand_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(2, 'NONE');

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `buyer_id` int(20) NOT NULL,
  `buyer_name` varchar(100) NOT NULL,
  `buyer_email` varchar(100) NOT NULL,
  `buyer_password` varchar(50) NOT NULL,
  `buyer_country` text NOT NULL,
  `buyer_city` varchar(50) NOT NULL,
  `buyer_address` varchar(100) NOT NULL,
  `buyer_phone` varchar(15) DEFAULT NULL,
  `buyer_image` varchar(255) NOT NULL,
  `social_id` varchar(255) DEFAULT NULL,
  `social_provider` varchar(50) DEFAULT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_token_expire` datetime DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`buyer_id`, `buyer_name`, `buyer_email`, `buyer_password`, `buyer_country`, `buyer_city`, `buyer_address`, `buyer_phone`, `buyer_image`, `social_id`, `social_provider`, `reset_token`, `reset_token_expire`, `google_id`) VALUES
(9, 'affy', 'affy@gmail.com', 'affy', 'India', 'Kolkata', 'batanagar', '8240617824', 'images/dp.jpg', NULL, NULL, NULL, NULL, NULL),
(15, 'Sekh Affroddin', 'skaffroddin4@gmail.com', '', '', '', '', '', 'https://lh3.googleusercontent.com/a/ACg8ocLBLrI_6TfqN5i2LotaUjUwa5Y4spU1OTOOGAWq3BD5WTO0MsFq=s96-c', '104295072585987843083', 'Google', NULL, NULL, '104295072585987843083'),
(16, 'Shayan Apparels', 'shayanapparels@gmail.com', '', '', '', '', '', 'https://lh3.googleusercontent.com/a/ACg8ocKeigQOYn9iAkjRfIj0s0J5WOp_n0qsNmXoUzEMYRPEyy_Faw-S=s96-c', '111496001596271720602', 'Google', NULL, NULL, '111496001596271720602');

-- --------------------------------------------------------

--
-- Table structure for table `buyer_orders`
--

CREATE TABLE `buyer_orders` (
  `id` int(11) NOT NULL,
  `buyer_id` int(20) NOT NULL,
  `pro_price` int(10) NOT NULL,
  `order_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyer_orders`
--

INSERT INTO `buyer_orders` (`id`, `buyer_id`, `pro_price`, `order_date`) VALUES
(3, 8, 4464, '2025-02-06 05:00:05.686932'),
(4, 9, 0, '2025-02-07 05:57:01.355534'),
(5, 9, 490, '2025-02-11 11:10:09.382822'),
(6, 9, 980, '2025-02-13 06:00:43.647341');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `pro_id` int(20) NOT NULL,
  `buyer_email` varchar(100) NOT NULL,
  `qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(3, 'NONE');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `Id` int(11) NOT NULL,
  `order_Id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`Id`, `order_Id`, `pro_id`, `qty`) VALUES
(3, 3, 7, 2),
(4, 4, 2, 0),
(5, 5, 2, 1),
(6, 6, 2, 0),
(7, 6, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pay_id` int(20) NOT NULL,
  `invoice_no` int(20) DEFAULT NULL,
  `amount` int(20) NOT NULL,
  `pay_mode` varchar(255) DEFAULT 'Online',
  `pay_code` varchar(255) DEFAULT NULL,
  `pay_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pay_id`, `invoice_no`, `amount`, `pay_mode`, `pay_code`, `pay_date`) VALUES
(2, NULL, 0, 'Online', NULL, '07 02 20252025'),
(3, NULL, 490, 'Online', NULL, '11 02 20252025'),
(4, NULL, 980, 'Online', NULL, '13 02 20252025');

-- --------------------------------------------------------

--
-- Table structure for table `pending_orders`
--

CREATE TABLE `pending_orders` (
  `order_id` int(20) NOT NULL,
  `buyer_id` int(20) NOT NULL,
  `invoice_no` int(20) NOT NULL,
  `pro_id` int(20) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `pro_name` varchar(150) NOT NULL,
  `pro_image1` varchar(100) NOT NULL,
  `pro_image2` varchar(200) NOT NULL,
  `pro_price` varchar(100) NOT NULL,
  `pro_des` varchar(2500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pro_status` varchar(50) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `cat_id`, `brand_id`, `pro_name`, `pro_image1`, `pro_image2`, `pro_price`, `pro_des`, `pro_status`) VALUES
(2, 3, 2, 'Ajanta Quartz Ajanta Abstract Quartz Analog Wall Clock', '../images/products/61KKxQiKA+L._SX679_.jpg', '', '490', 'Brand	Ajanta Quartz\r\nColour	white\r\nDisplay Type	Analog\r\nStyle	Wall clock\r\nSpecial Feature	Silent Clock\r\nProduct Dimensions	35W x 320H Millimeters', 'active'),
(3, 3, 2, 'boAt Rockerz 425 Bluetooth', '../images/products/61XvYOrqVeL._SX522_.jpg', '', '1230', 'Brand	boAt\r\nColour	Active Black\r\nEar Placement	On Ear\r\nForm Factor	Over Ear\r\nNoise Control	Active Noise Cancellation', 'active'),
(4, 3, 2, 'WildHorn Rfid Protected Leather Wallet', '../images/products/7170Odw4KyL._SX679_.jpg', '', '269', 'Brand	WildHorn\r\nColour	Brown\r\nMaterial	Leather\r\nStyle	Classic\r\nPattern	Solid', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`buyer_id`),
  ADD UNIQUE KEY `google_id` (`google_id`);

--
-- Indexes for table `buyer_orders`
--
ALTER TABLE `buyer_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `pending_orders`
--
ALTER TABLE `pending_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ad_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `buyer_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `buyer_orders`
--
ALTER TABLE `buyer_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `pro_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pay_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pending_orders`
--
ALTER TABLE `pending_orders`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
