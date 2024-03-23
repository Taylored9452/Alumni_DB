-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2024 at 03:27 PM
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
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(10) NOT NULL,
  `address_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `orderstatus_ID` int(1) NOT NULL,
  `shipping_status` int(1) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `net_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders details`
--

CREATE TABLE `orders details` (
  `order_detail_ID` int(10) NOT NULL,
  `order_ID` int(10) NOT NULL,
  `product_ID` int(5) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `total_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_status`
--

CREATE TABLE `orders_status` (
  `orderstatus_ID` int(1) NOT NULL,
  `order_status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_ID` int(11) NOT NULL,
  `order_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `net_price` float NOT NULL,
  `transfer slip` varchar(150) NOT NULL,
  `paid_date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products phone`
--

CREATE TABLE `products phone` (
  `product_ID` int(5) NOT NULL,
  `product_type_ID` int(2) NOT NULL,
  `product_brand_ID` int(2) NOT NULL,
  `product_color` varchar(150) NOT NULL,
  `Phone_capacity` varchar(150) NOT NULL,
  `product_stock` int(5) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_detail` text NOT NULL,
  `product_cover_image` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `product_Image1` varchar(255) DEFAULT NULL,
  `product_Image2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products types`
--

CREATE TABLE `products types` (
  `product_type_ID` int(2) NOT NULL,
  `type_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE `product_brand` (
  `product_brand_ID` int(2) NOT NULL,
  `brand_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `user_ID` int(10) NOT NULL,
  `address_ID` int(10) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type_ID` int(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`user_ID`, `address_ID`, `email`, `fname`, `lname`, `username`, `password`, `user_type_ID`) VALUES
(19, NULL, 'asdadh@w', NULL, NULL, '123', '$2y$10$FIkHJqi2knPtGHryug8eX.Rz7KBOR49/ePAVnKirn18WBOVBXtNse', 2),
(20, NULL, 'anuwat.triwest@gmail.com', NULL, NULL, '1234', '$2y$10$kD9B2Hpt8ZqEDCusFfWlT.j1R7LBDbK6Yc7HxncOYCYLxv4iLPaOy', 2),
(21, NULL, '12345@g', NULL, NULL, '12345', '$2y$10$F88agjK4TN7lut7AhLAmzerT0mPrQxzRiq0td4X4gNpAX5NPyRiS.', 1),
(22, NULL, '123456@g', NULL, NULL, '123456', '$2y$10$VCUA1icuUSbw6tAu7LHCBuSyJOMIk5weOxre1NyXl.BnzJ9iiPeGW', 2),
(23, NULL, '12@g', NULL, NULL, 'aaa', '$2y$10$ZKhgyk8dlN7uP9IEUda1oeRcns8it7OSMEB.8VD//8kA5dcqnZVhS', 2),
(24, NULL, 'yedhod@g', NULL, NULL, 'ควยใหญ่', '$2y$10$UfOOq2fhnCTNS2az7Nvq4e21ewF.2EpJSovIkzyAXuqpdQ71lbE/G', 2),
(25, NULL, 'eeee@g', NULL, NULL, 'ฟหกฟกฟกฟไ', '$2y$10$9EQjFtT603A4xxNLue/yueLWMBLCBnuD/bMBNM1UrYfviJXoj0AeS', 2),
(26, NULL, 'aaaaa@g', NULL, NULL, 'asdawasdwasdw', '$2y$10$sLocxrzGFGBdzo7WigY4D.yaV34rNCigA/YAUJQnX4krUoV1Zdyay', 2),
(27, NULL, 'wwwwwwwwwww@g', NULL, NULL, 'wwwwww', '$2y$10$ZUy9nLQhVytUUY0yPp15oeZvsR1nNri44fiuDdqP2pa8j62YfBoU.', 2),
(28, NULL, 'anuwat.triwest@gmail.com111', NULL, NULL, 'wwwwwwwwww', '$2y$10$9dy4VjZAuolNitG5gxBye.WTFdoJARTZ8A4e4BQU7v3DGDD4nAegq', 2),
(29, NULL, 'anuwat.t@g', NULL, NULL, '22222222', '$2y$10$og.qGB6qvVMfpPCY07zACO1ceVOcyzlZbvhbNCSazjyq/J0mDQEGW', 2),
(30, NULL, 'www@g', NULL, NULL, 'หำ', '$2y$10$zpLjG4E5hQzqualb2Z3LHOixZb//LNDIEpHsbtue.nJts4xqYgSRK', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_ID` int(1) NOT NULL,
  `user_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_ID`, `user_type_name`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`);

--
-- Indexes for table `orders details`
--
ALTER TABLE `orders details`
  ADD PRIMARY KEY (`order_detail_ID`);

--
-- Indexes for table `orders_status`
--
ALTER TABLE `orders_status`
  ADD PRIMARY KEY (`orderstatus_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_ID`);

--
-- Indexes for table `products phone`
--
ALTER TABLE `products phone`
  ADD PRIMARY KEY (`product_ID`);

--
-- Indexes for table `products types`
--
ALTER TABLE `products types`
  ADD PRIMARY KEY (`product_type_ID`);

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD PRIMARY KEY (`product_brand_ID`);

--
-- Indexes for table `user_information`
--
ALTER TABLE `user_information`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `FK_user_type_ID` (`user_type_ID`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders details`
--
ALTER TABLE `orders details`
  MODIFY `order_detail_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_status`
--
ALTER TABLE `orders_status`
  MODIFY `orderstatus_ID` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products phone`
--
ALTER TABLE `products phone`
  MODIFY `product_ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products types`
--
ALTER TABLE `products types`
  MODIFY `product_type_ID` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `product_brand_ID` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
  MODIFY `user_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_ID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_information`
--
ALTER TABLE `user_information`
  ADD CONSTRAINT `FK_user_type_ID` FOREIGN KEY (`user_type_ID`) REFERENCES `user_type` (`user_type_ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
