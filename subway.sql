-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2019 at 02:02 PM
-- Server version: 5.7.16-log
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `subway`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `code`, `name`, `telephone`, `email`) VALUES
(1, '25256', 'Adekunle Adekoya', '08056160618', 'crystoline@gmail.com'),
(2, '19056059', 'Jide Solanke', '08056160618', 'jidedorcas@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) UNSIGNED NOT NULL DEFAULT '1',
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`id`, `date`, `status`, `location`) VALUES
(1, '2019-05-17 12:02:00', 0, NULL),
(2, '2019-05-17 05:30:00', 0, NULL),
(3, '2019-05-17 12:30:00', 1, '6.6185239000000005,3.3561012999999997');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1558046866),
('m190516_230856_create_user_table', 1558048262);

-- --------------------------------------------------------

--
-- Table structure for table `option`
--

CREATE TABLE `option` (
  `id` int(10) UNSIGNED NOT NULL,
  `option_type_id` int(10) UNSIGNED DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `option`
--

INSERT INTO `option` (`id`, `option_type_id`, `value`) VALUES
(1, 2, 'White Bread'),
(2, 2, 'Brown Bread'),
(3, 3, '15 cm'),
(4, 3, '30 cm'),
(5, 4, 'Yes'),
(6, 4, 'No'),
(7, 5, 'chicken fajita'),
(8, 6, 'extra bacon'),
(9, 6, 'double meat'),
(10, 6, 'extra cheese'),
(11, 7, 'spinach'),
(12, 8, 'Avocado'),
(13, 8, 'Pesto'),
(14, 2, 'Hummus'),
(15, 8, 'Butter'),
(16, 7, 'uwuuw');

-- --------------------------------------------------------

--
-- Table structure for table `option_type`
--

CREATE TABLE `option_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `sort` int(1) UNSIGNED DEFAULT '0',
  `is_multiple` int(1) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `option_type`
--

INSERT INTO `option_type` (`id`, `name`, `type`, `sort`, `is_multiple`) VALUES
(2, 'Bread', 'Drop down list', 1, 0),
(3, 'Bread Size', 'Check box', 2, 0),
(4, 'Baked', 'Check box', 3, 0),
(5, 'Taste', 'Drop down list', 4, 0),
(6, 'Extras', 'Drop down list', 5, 0),
(7, 'Vegetable', 'Drop down list', 6, 1),
(8, 'Sauce', 'Drop down list', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `meal_id` int(10) UNSIGNED DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(100) DEFAULT NULL,
  `rating` int(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `customer_id`, `meal_id`, `date`, `location`, `rating`) VALUES
(1, NULL, NULL, '2019-05-17 22:49:42', NULL, NULL),
(2, NULL, NULL, '2019-05-17 22:53:54', NULL, NULL),
(3, NULL, NULL, '2019-05-17 23:00:03', NULL, NULL),
(4, NULL, NULL, '2019-05-17 23:01:11', NULL, NULL),
(5, NULL, NULL, '2019-05-18 07:11:00', NULL, NULL),
(6, 2, 3, '2019-05-18 07:16:55', '6.5404928,3.3644544', NULL),
(7, 1, 3, '2019-05-18 08:53:39', '6.5404928,3.3644544', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `option_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `option_id`, `order_id`) VALUES
(1, NULL, NULL),
(2, NULL, NULL),
(3, NULL, NULL),
(4, NULL, NULL),
(5, NULL, NULL),
(6, NULL, NULL),
(7, NULL, NULL),
(8, NULL, NULL),
(94, 1, 6),
(95, 3, 6),
(96, 5, 6),
(97, 7, 6),
(98, 8, 6),
(99, NULL, 6),
(100, 11, 6),
(101, 16, 6),
(102, 13, 6),
(103, 1, 7),
(104, 4, 7),
(105, 5, 7),
(106, 7, 7),
(107, 9, 7),
(108, 16, 7),
(109, 13, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'crystoline', 'cNO28YiSOJCh9oPhrcieyGwXkomolOkY', '$2y$13$qHAfzmiJgJqSFJTKWhnCcOtuGco5FrsMOLtnbBl/aPby7gpgOqg2K', NULL, 'crystoline@gmail.com', 10, 1558049287, 1558049287),
(2, 'admin', 'Vuxi7sUXCqI8etKfK5GHaLfPq5JRwuTQ', '$2y$13$oHlh9Z1.1DWwWMrsGwjqjeYlXdH4nO/AFHoYFSUX9WnISM6bgz0ny', NULL, 'admin@admin.com', 10, 1558180854, 1558180854);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`);

--
-- Indexes for table `meal`
--
ALTER TABLE `meal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `opion_type_fk_idx` (`option_type_id`);

--
-- Indexes for table `option_type`
--
ALTER TABLE `option_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_fk_idx` (`customer_id`),
  ADD KEY `meal_fk_idx` (`meal_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_fk_idx` (`order_id`),
  ADD KEY `option_fk_idx` (`option_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `meal`
--
ALTER TABLE `meal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `option`
--
ALTER TABLE `option`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `option_type`
--
ALTER TABLE `option_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `option`
--
ALTER TABLE `option`
  ADD CONSTRAINT `opion_type_fk` FOREIGN KEY (`option_type_id`) REFERENCES `option_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `customer_fk` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `meal_fk` FOREIGN KEY (`meal_id`) REFERENCES `meal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `option_fk` FOREIGN KEY (`option_id`) REFERENCES `option` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_fk` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
