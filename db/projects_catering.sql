-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2024 at 04:38 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projects_catering`
--

-- --------------------------------------------------------

--
-- Table structure for table `ca_admin`
--

CREATE TABLE `ca_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ca_admin`
--

INSERT INTO `ca_admin` (`id`, `username`, `password`, `mobile`, `email`, `role`, `status`, `created_at`) VALUES
(1, 'Arunkumar R', 'addobyte', '9344694501', 'admin@gmail.com', 'admin', 1, '2024-02-28 05:16:35'),
(2, 'arun', 'addobyte', '9111111111', 'user@gmail.com', 'user', 1, '2024-03-21 18:24:34'),
(3, 'kumar', 'addobyte', '9222222222', 'kumar@test.com', 'user', 1, '2024-03-21 18:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `ca_category`
--

CREATE TABLE `ca_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ca_category`
--

INSERT INTO `ca_category` (`id`, `category_name`, `status`, `create_at`) VALUES
(1, 'breakfast', 1, '2024-03-22 12:52:33'),
(2, 'lunch', 1, '2024-03-22 12:52:38'),
(3, 'dinner', 1, '2024-03-22 12:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `ca_invoice_number`
--

CREATE TABLE `ca_invoice_number` (
  `id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `quote_no` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ca_invoice_number`
--

INSERT INTO `ca_invoice_number` (`id`, `quote_id`, `quote_no`, `invoice_no`, `create_at`) VALUES
(1, 1, '1001', '20240322001', '2024-03-22 14:32:20'),
(3, 2, '1002', '20240322002', '2024-03-22 14:42:14'),
(4, 3, '1003', '20240322003', '2024-03-22 14:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `ca_menu`
--

CREATE TABLE `ca_menu` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ca_menu`
--

INSERT INTO `ca_menu` (`id`, `item_name`, `price`, `quantity`, `status`, `created_at`) VALUES
(1, 'idly', '10', '2', 1, '2024-03-22 12:48:49'),
(2, 'pongal', '20', '1', 1, '2024-03-22 12:49:02'),
(3, 'dosa', '30', '1', 1, '2024-03-22 12:49:12'),
(4, 'vadai', '6', '1', 1, '2024-03-22 12:49:24'),
(5, 'poori', '40', '2', 1, '2024-03-22 12:49:34'),
(6, 'chapati', '40', '2', 1, '2024-03-22 12:49:51'),
(7, 'tea', '10', '1', 1, '2024-03-22 12:50:03'),
(8, 'coffee', '15', '1', 1, '2024-03-22 12:50:12'),
(9, 'kitchadi', '20', '1', 1, '2024-03-22 12:50:37'),
(10, 'lunch', '50', '1', 1, '2024-03-22 12:51:17'),
(11, 'ice cream', '10', '1', 1, '2024-03-22 12:51:26'),
(12, 'veg biriyani', '50', '1', 1, '2024-03-22 12:51:36'),
(13, 'tomoto rice', '40', '1', 1, '2024-03-22 12:51:49'),
(14, 'mushroom biriyani', '60', '1', 1, '2024-03-22 12:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `ca_package`
--

CREATE TABLE `ca_package` (
  `id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `package_category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `package_item_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `package_price` int(11) NOT NULL,
  `package_status` int(11) NOT NULL DEFAULT 1,
  `package_create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ca_package`
--

INSERT INTO `ca_package` (`id`, `package_name`, `package_category_id`, `package_item_id`, `package_price`, `package_status`, `package_create_at`) VALUES
(1, 'Package - 1', '1', '7,4,3,2,1', 500, 1, '2024-03-22 12:53:30'),
(2, 'Package - 2', '2', '13,12,10', 700, 1, '2024-03-22 12:54:03'),
(3, 'Package - 3', '3', '8,6,1', 400, 1, '2024-03-22 12:54:37');

-- --------------------------------------------------------

--
-- Table structure for table `ca_package_category`
--

CREATE TABLE `ca_package_category` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ca_package_menu`
--

CREATE TABLE `ca_package_menu` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `menu_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ca_salesinvoice_payment`
--

CREATE TABLE `ca_salesinvoice_payment` (
  `id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `quote_no` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `package_total_price` int(11) NOT NULL,
  `paid_amount` int(11) DEFAULT NULL,
  `discount_amount` int(11) NOT NULL,
  `advance_amount` int(11) NOT NULL,
  `balance_amount` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ca_salesinvoice_payment`
--

INSERT INTO `ca_salesinvoice_payment` (`id`, `quote_id`, `quote_no`, `invoice_no`, `package_total_price`, `paid_amount`, `discount_amount`, `advance_amount`, `balance_amount`, `create_at`) VALUES
(1, 1, '1001', '', 37000, 5000, 2000, 5000, 30000, '2024-03-22 14:32:20'),
(2, 1, '1001', '', 37000, 25000, 0, 20000, 10000, '2024-03-22 14:32:47'),
(4, 2, '1002', '', 106000, 11000, 5000, 11000, 90000, '2024-03-22 14:42:14'),
(5, 2, '1002', '', 106000, 29000, 0, 18000, 72000, '2024-03-22 14:42:25'),
(6, 2, '1002', '', 106000, 89000, 0, 60000, 12000, '2024-03-22 14:42:38'),
(7, 2, '1002', '', 106000, 99000, 2000, 10000, 0, '2024-03-22 14:42:58'),
(8, 3, '1003', '', 56000, 30000, 6000, 30000, 20000, '2024-03-22 14:43:25'),
(9, 3, '1003', '', 56000, 40000, 0, 10000, 10000, '2024-03-22 14:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `ca_salesquote`
--

CREATE TABLE `ca_salesquote` (
  `id` int(11) NOT NULL,
  `quote_no` varchar(100) NOT NULL,
  `booking_datetime` date NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `mobile_no` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ca_salesquote`
--

INSERT INTO `ca_salesquote` (`id`, `quote_no`, `booking_datetime`, `customer_name`, `mobile_no`, `address`, `status`, `create_at`) VALUES
(1, '1001', '2024-03-22', 'Balakumar', '9111122221', '25, 4th Cross,\r\nKovil street,\r\nChennai - 01', 1, '2024-03-22 12:56:31'),
(2, '1002', '2024-03-22', 'Gopi', '9111122222', 'West street,\r\nRam nagar,\r\nChennai - 02', 1, '2024-03-22 12:58:15'),
(3, '1003', '2024-03-22', 'Selvaganesh', '9111122223', '25, 4th Cross,\r\nKovil street,\r\nErode - 21', 1, '2024-03-22 13:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `ca_salesquote_details`
--

CREATE TABLE `ca_salesquote_details` (
  `id` int(11) NOT NULL,
  `salesquote_id` int(11) DEFAULT NULL,
  `quote_no` varchar(100) NOT NULL,
  `quote_package_id` varchar(255) NOT NULL,
  `custom_menu_items` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `final_price` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ca_salesquote_details`
--

INSERT INTO `ca_salesquote_details` (`id`, `salesquote_id`, `quote_no`, `quote_package_id`, `custom_menu_items`, `order_date`, `quantity`, `final_price`, `status`, `create_at`) VALUES
(1, 1, '1001', '1', '7,3,2,1', '2024-03-25', '50', '25000', 1, '2024-03-22 12:56:08'),
(2, 2, '1002', '1', '4,3,2,1', '2024-03-26', '100', '50000', 1, '2024-03-22 12:57:49'),
(3, 2, '1002', '2', '13,12,10', '2024-03-26', '80', '56000', 1, '2024-03-22 12:58:06'),
(4, 3, '1003', '1', '3,2,1', '2024-03-27', '30', '15000', 1, '2024-03-22 12:59:30'),
(5, 3, '1003', '2', '12,10', '2024-03-27', '30', '21000', 1, '2024-03-22 12:59:53'),
(6, 3, '1003', '3', '9,8,6,1', '2024-03-27', '50', '20000', 1, '2024-03-22 13:00:09'),
(7, 1, '1001', '3', '8,6,3,1', '2024-03-26', '30', '12000', 1, '2024-03-22 13:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `ca_user`
--

CREATE TABLE `ca_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ca_user`
--

INSERT INTO `ca_user` (`id`, `username`, `password`, `mobile`, `email`, `status`, `created_at`) VALUES
(1, 'Arun', 'addobyte', '9344694501', 'user@gmail.com', 1, '2024-02-28 05:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `ca_vessels`
--

CREATE TABLE `ca_vessels` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `cost_of_vessels` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ca_vessels`
--

INSERT INTO `ca_vessels` (`id`, `product_name`, `quantity`, `cost_of_vessels`, `status`, `create_at`) VALUES
(1, 'plate', '30', '150', 1, '2024-03-22 13:01:56'),
(2, 'bucket', '10', '100', 1, '2024-03-22 13:03:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ca_admin`
--
ALTER TABLE `ca_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ca_category`
--
ALTER TABLE `ca_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ca_invoice_number`
--
ALTER TABLE `ca_invoice_number`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ca_menu`
--
ALTER TABLE `ca_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ca_package`
--
ALTER TABLE `ca_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ca_package_category`
--
ALTER TABLE `ca_package_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ca_package_menu`
--
ALTER TABLE `ca_package_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ca_salesinvoice_payment`
--
ALTER TABLE `ca_salesinvoice_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ca_salesquote`
--
ALTER TABLE `ca_salesquote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ca_salesquote_details`
--
ALTER TABLE `ca_salesquote_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ca_user`
--
ALTER TABLE `ca_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ca_vessels`
--
ALTER TABLE `ca_vessels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ca_admin`
--
ALTER TABLE `ca_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ca_category`
--
ALTER TABLE `ca_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ca_invoice_number`
--
ALTER TABLE `ca_invoice_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ca_menu`
--
ALTER TABLE `ca_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ca_package`
--
ALTER TABLE `ca_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ca_package_category`
--
ALTER TABLE `ca_package_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ca_package_menu`
--
ALTER TABLE `ca_package_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ca_salesinvoice_payment`
--
ALTER TABLE `ca_salesinvoice_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ca_salesquote`
--
ALTER TABLE `ca_salesquote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ca_salesquote_details`
--
ALTER TABLE `ca_salesquote_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ca_user`
--
ALTER TABLE `ca_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ca_vessels`
--
ALTER TABLE `ca_vessels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
