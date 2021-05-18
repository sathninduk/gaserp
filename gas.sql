-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 18, 2021 at 08:47 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gas`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `fname` text CHARACTER SET utf8 NOT NULL,
  `lname` text CHARACTER SET utf8 NOT NULL,
  `contact_no` varchar(100) CHARACTER SET utf8 NOT NULL,
  `nic` varchar(12) CHARACTER SET utf8 NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 NOT NULL,
  `no` text CHARACTER SET utf8 NOT NULL,
  `street` text CHARACTER SET utf8 NOT NULL,
  `city` text CHARACTER SET utf8 NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_login`
--

CREATE TABLE `customer_login` (
  `username` varchar(60) CHARACTER SET utf8 NOT NULL,
  `password` text CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `no` text CHARACTER SET utf8 NOT NULL,
  `street1` text CHARACTER SET utf8 NOT NULL,
  `street2` text CHARACTER SET utf8 NOT NULL,
  `city` text CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `delivery_charge` double NOT NULL,
  `status` tinyint(1) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(11) NOT NULL,
  `fname` varchar(45) CHARACTER SET utf8 NOT NULL,
  `lname` varchar(45) CHARACTER SET utf8 NOT NULL,
  `contact_no` varchar(45) CHARACTER SET utf8 NOT NULL,
  `nic` varchar(12) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver_payments`
--

CREATE TABLE `driver_payments` (
  `driver_payments_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `debit_balance` int(11) NOT NULL DEFAULT '0',
  `last_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver_payments_history`
--

CREATE TABLE `driver_payments_history` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `type` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(300) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL,
  `customer_id` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `obtaining_method`
--

CREATE TABLE `obtaining_method` (
  `obtaining_method_id` int(11) NOT NULL,
  `method_type` varchar(75) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obtaining_method`
--

INSERT INTO `obtaining_method` (`obtaining_method_id`, `method_type`, `status`) VALUES
(1, 'Delivery', 1),
(2, 'Pickup', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `total_price` double NOT NULL,
  `status` tinyint(1) NOT NULL,
  `obtaining_method_id` int(11) NOT NULL,
  `customer_id` varchar(10) CHARACTER SET utf8 NOT NULL,
  `payment_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_has_products`
--

CREATE TABLE `order_has_products` (
  `number` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `year` year(4) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL COMMENT 'unit_price',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `payment_type_id` int(11) NOT NULL,
  `type_name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`payment_type_id`, `type_name`, `status`) VALUES
(1, 'Credit Card', 1),
(2, 'Cash on delivery', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(75) CHARACTER SET utf8 NOT NULL,
  `price` int(11) NOT NULL,
  `availability` int(11) NOT NULL,
  `type` varchar(150) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `availability`, `type`, `status`) VALUES
(1, '12.5 Kg Cylinders', 1493, 20, 'REFILLING CYLINDERS', 1),
(2, '5.0 Kg Cylinders', 598, 22, 'REFILLING CYLINDERS', 1),
(3, '2.3 Kg Cylinders', 289, 13, 'REFILLING CYLINDERS', 1),
(4, '12.5 Kg Cylinders', 4245, 53, 'NEW CYLINDERS', 1),
(5, '5.0 Kg Cylinders', 3155, 9, 'NEW CYLINDERS', 1),
(6, '2.3 Kg Cylinders', 2765, 14, 'NEW CYLINDERS', 1),
(7, 'Regulator', 880, 17, 'ACCESSORIES', 1),
(8, 'Hose', 470, 10, 'ACCESSORIES', 1),
(9, 'Accessory Pack', 1340, 8, 'ACCESSORIES', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products_has_supply_details`
--

CREATE TABLE `products_has_supply_details` (
  `product_id` int(11) NOT NULL,
  `supdetails_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` double NOT NULL,
  `market_price` double NOT NULL,
  `description` varchar(200) CHARACTER SET utf8 NOT NULL,
  `availability` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `fname` varchar(45) CHARACTER SET utf8 NOT NULL,
  `lname` varchar(45) CHARACTER SET utf8 NOT NULL,
  `contact_no` varchar(45) CHARACTER SET utf8 NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 NOT NULL,
  `company_name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payments`
--

CREATE TABLE `supplier_payments` (
  `sup_payment_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `last_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payments_history`
--

CREATE TABLE `supplier_payments_history` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supply_orders`
--

CREATE TABLE `supply_orders` (
  `supply_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `rec_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `system_users`
--

CREATE TABLE `system_users` (
  `sysusername` varchar(60) CHARACTER SET utf8 NOT NULL,
  `password` text CHARACTER SET utf8,
  `status` tinyint(1) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_users`
--

INSERT INTO `system_users` (`sysusername`, `password`, `status`, `driver_id`, `role`) VALUES
('accounts', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, NULL, 1),
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, NULL, 1),
('delivery', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, NULL, 1),
('sales', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, NULL, 1),
('stock', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_login`
--
ALTER TABLE `customer_login`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `driver_payments`
--
ALTER TABLE `driver_payments`
  ADD PRIMARY KEY (`driver_payments_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `driver_payments_history`
--
ALTER TABLE `driver_payments_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `custom_id` (`customer_id`);

--
-- Indexes for table `obtaining_method`
--
ALTER TABLE `obtaining_method`
  ADD PRIMARY KEY (`obtaining_method_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `payment_type_id` (`payment_type_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `obtaining_method_id` (`obtaining_method_id`),
  ADD KEY `obtaining_method_id_2` (`obtaining_method_id`);

--
-- Indexes for table `order_has_products`
--
ALTER TABLE `order_has_products`
  ADD PRIMARY KEY (`number`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `order_id_2` (`order_id`),
  ADD KEY `order_id_3` (`order_id`),
  ADD KEY `order_id_4` (`order_id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`payment_type_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_id` (`product_id`);

--
-- Indexes for table `products_has_supply_details`
--
ALTER TABLE `products_has_supply_details`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `supdetails_id` (`supdetails_id`),
  ADD KEY `products_id` (`product_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  ADD PRIMARY KEY (`sup_payment_id`);

--
-- Indexes for table `supplier_payments_history`
--
ALTER TABLE `supplier_payments_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supply_orders`
--
ALTER TABLE `supply_orders`
  ADD PRIMARY KEY (`supply_order_id`),
  ADD KEY `suppliers_id` (`supplier_id`);

--
-- Indexes for table `system_users`
--
ALTER TABLE `system_users`
  ADD PRIMARY KEY (`sysusername`),
  ADD KEY `driver_id` (`driver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver_payments`
--
ALTER TABLE `driver_payments`
  MODIFY `driver_payments_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver_payments_history`
--
ALTER TABLE `driver_payments_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_has_products`
--
ALTER TABLE `order_has_products`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  MODIFY `sup_payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_payments_history`
--
ALTER TABLE `supplier_payments_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
