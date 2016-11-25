-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 25, 2016 at 09:49 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `city_marks`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `line1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `line2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `line1`, `line2`, `city`, `state`, `country`, `zip`, `order_id`) VALUES
(1, 1, '123 Main St', '', 'Anytown', 'Free State', 'USA', '00000', 95),
(2, 1, '123 Main St', '', 'Anytown', 'Free State', 'USA', '00000', 115),
(3, 1, '123 Main St', '', 'Anytown', 'Free State', 'USA', '00000', 116),
(4, 1, '123 Main St', '', 'Anytown', 'Free State', 'USA', '00000', 117),
(5, 1, '123 Main St', '', 'Anytown', 'Free State', 'USA', '00000', 118),
(6, 1, '123 Main St', '', 'Anytown', 'Free State', 'USA', '00000', 119),
(7, 1, '123 Main St', '', 'Anytown', 'Free State', 'USA', '00000', 120);

-- --------------------------------------------------------

--
-- Table structure for table `aftersell`
--

CREATE TABLE `aftersell` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_price` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `aftersell`
--

INSERT INTO `aftersell` (`id`, `order_id`, `item_id`, `item_name`, `item_price`) VALUES
(14, 56, 1, 'Expedited Shipping', 2.99),
(15, 60, 1, 'Expedited Shipping', 2.99),
(16, 61, 1, 'Expedited Shipping', 2.99),
(17, 61, 1, 'Expedited Shipping', 2.99),
(18, 61, 1, 'Expedited Shipping', 2.99),
(19, 61, 1, 'Expedited Shipping', 2.99),
(20, 61, 1, 'Expedited Shipping', 2.99),
(21, 62, 1, 'Expedited Shipping', 2.99),
(22, 63, 2, 'Clothes Crate', 24.99),
(23, 64, 3, 'Weekend Bag', 3.99),
(24, 65, 1, 'Expedited Shipping', 2.99),
(25, 66, 3, 'Weekend Bag', 3.99),
(26, 67, 1, 'Expedited Shipping', 2.99),
(27, 74, 1, 'Expedited Shipping', 2.99),
(28, 82, 1, 'Expedited Shipping', 2.99),
(29, 83, 3, 'Weekend Bag', 3.99),
(30, 85, 2, 'Clothes Crate', 24.99),
(31, 86, 3, 'Weekend Bag', 3.99),
(32, 88, 2, 'Clothes Crate', 24.99),
(33, 89, 2, 'Clothes Crate', 24.99),
(34, 115, 3, 'Weekend Bag', 3.99),
(35, 116, 1, 'Expedited Shipping', 2.99),
(36, 118, 2, 'Clothes Crate', 24.99),
(37, 119, 3, 'Weekend Bag', 3.99),
(38, 120, 2, 'Clothes Crate', 24.99);

-- --------------------------------------------------------

--
-- Table structure for table `aftersell_items`
--

CREATE TABLE `aftersell_items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` float(10,2) NOT NULL,
  `item_img` text NOT NULL,
  `item_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aftersell_items`
--

INSERT INTO `aftersell_items` (`item_id`, `item_name`, `item_price`, `item_img`, `item_desc`) VALUES
(1, 'Expedited Shipping', 2.99, 'img/aftersell/shipping.jpg', 'Get your items faster with expedited shipping for a low fee.'),
(2, 'Clothes Crate', 24.99, 'img/aftersell/crate.jpg', 'Join us for a monthly box of the newest clothes shipped to you.'),
(3, 'Weekend Bag', 3.99, 'img/aftersell/weekend.jpg', 'Buy our weekend bag for a discounted price as a thank you.'),
(6, 'null', 0.00, 'null', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Shirt'),
(2, 'Pants'),
(3, 'Dress'),
(4, 'Scarf'),
(5, 'Shoes');

-- --------------------------------------------------------

--
-- Table structure for table `cc_info`
--

CREATE TABLE `cc_info` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `cc_num` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cc_exp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cc_cvc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cc_info`
--

INSERT INTO `cc_info` (`id`, `customer_id`, `cc_num`, `cc_exp`, `cc_cvc`, `order_id`) VALUES
(1, 2, '4444 4444 4444 4444', '01 / 23', '122', 88),
(2, 2, '4444 4444 4444 4444', '', '', 89),
(3, 1, '', '', '', 90),
(4, 1, '', '', '', 91),
(5, 1, '', '', '', 92),
(6, 1, '', '', '', 93),
(7, 1, '', '', '', 94),
(8, 1, '', '', '', 95),
(9, 1, '4444 4444 4444 4444', '11 / 24', '432', 115),
(10, 1, '5555 5555 5555 5555', '12 / 25', '987', 116),
(11, 1, '4111 1111 1111 1111', '12 / 24', '212', 117),
(12, 1, '4111 1111 1111 1111', '11 / 11', '121', 118),
(13, 1, '4111 1111 1111 1111', '11 / 23', '233', 119),
(14, 1, '4111 1111 1111 1111', '11 / 34', '232', 120);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comment_content` float(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `rating` int(11) NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `aftersell` int(11) NOT NULL DEFAULT '6',
  `order_date` datetime NOT NULL,
  `ship_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `aftersell`, `order_date`, `ship_date`) VALUES
(54, 2, 85.93, '1', 6, '2016-11-08 00:00:00', '0000-00-00'),
(55, 2, 85.93, '1', 6, '2016-11-08 00:00:00', '0000-00-00'),
(56, 2, 96.93, '1', 6, '2016-11-09 00:00:00', '0000-00-00'),
(57, 2, 120.93, '1', 6, '2016-11-09 00:00:00', '0000-00-00'),
(58, 2, 96.93, '1', 6, '2016-11-09 00:00:00', '0000-00-00'),
(59, 2, 96.93, '1', 6, '2016-11-09 00:00:00', '0000-00-00'),
(60, 2, 96.93, '1', 6, '2016-11-10 00:00:00', '0000-00-00'),
(61, 2, 102.91, '1', 1, '2016-11-10 00:00:00', '0000-00-00'),
(62, 2, 64.92, '1', 1, '2016-11-10 00:00:00', '0000-00-00'),
(63, 2, 86.92, '1', 2, '2016-11-11 00:00:00', '0000-00-00'),
(64, 2, 124.92, '1', 3, '2016-11-11 00:00:00', '0000-00-00'),
(65, 2, 123.92, '1', 1, '2016-11-11 00:00:00', '0000-00-00'),
(66, 2, 155.91, '1', 3, '2016-11-12 00:00:00', '0000-00-00'),
(67, 2, 99.92, '1', 1, '2016-11-12 00:00:00', '0000-00-00'),
(68, 2, 61.93, '1', 6, '2016-11-12 00:00:00', '0000-00-00'),
(69, 2, 61.93, '1', 6, '2016-11-12 00:00:00', '0000-00-00'),
(70, 2, 61.93, '1', 6, '2016-11-13 00:00:00', '0000-00-00'),
(71, 2, 96.93, '1', 6, '2016-11-13 00:00:00', '0000-00-00'),
(72, 2, 61.93, '1', 6, '2016-11-13 00:00:00', '0000-00-00'),
(73, 2, 71.92, '1', 6, '2016-11-13 00:00:00', '0000-00-00'),
(74, 2, 64.92, '1', 1, '2016-11-13 00:00:00', '0000-00-00'),
(75, 2, 16.93, '1', 6, '2016-11-14 00:00:00', '0000-00-00'),
(76, 2, 96.93, '1', 6, '2016-11-14 00:00:00', '0000-00-00'),
(77, 2, 61.93, '1', 6, '2016-11-15 00:00:00', '0000-00-00'),
(78, 2, 30.94, '1', 6, '2016-11-15 00:00:00', '0000-00-00'),
(79, 2, 61.93, '1', 6, '2016-11-15 00:00:00', '0000-00-00'),
(80, 2, 61.93, '1', 6, '2016-11-15 00:00:00', '0000-00-00'),
(81, 2, 120.93, '1', 6, '2016-11-16 00:00:00', '0000-00-00'),
(82, 2, 64.92, '1', 1, '2016-11-16 00:00:00', '0000-00-00'),
(83, 2, 110.91, '1', 3, '2016-11-16 00:00:00', '0000-00-00'),
(84, 2, 151.92, '1', 6, '2016-11-16 00:00:00', '0000-00-00'),
(85, 2, 86.92, '1', 2, '2016-11-17 20:41:09', '0000-00-00'),
(86, 1, 165.90, '1', 3, '2016-11-20 18:52:35', '0000-00-00'),
(87, 2, 85.93, '1', 6, '2016-11-23 21:55:44', '0000-00-00'),
(88, 2, 41.92, '1', 2, '2016-11-23 21:57:27', '0000-00-00'),
(89, 2, 86.92, '1', 2, '2016-11-23 22:16:55', '0000-00-00'),
(90, 1, 30.94, '1', 6, '2016-11-23 22:22:26', '0000-00-00'),
(91, 1, 16.93, '1', 6, '2016-11-23 22:24:06', '0000-00-00'),
(92, 1, 30.94, '1', 6, '2016-11-23 22:26:03', '0000-00-00'),
(93, 1, 16.93, '1', 6, '2016-11-23 22:29:16', '0000-00-00'),
(94, 1, 30.94, '1', 6, '2016-11-23 22:31:51', '0000-00-00'),
(95, 1, 30.94, '1', 6, '2016-11-23 22:32:16', '0000-00-00'),
(115, 1, 65.92, '1', 3, '2016-11-25 00:35:36', '0000-00-00'),
(116, 1, 36.81, '1', 1, '2016-11-25 00:43:26', '0000-00-00'),
(117, 1, 33.82, '1', 6, '2016-11-25 01:16:48', '0000-00-00'),
(118, 1, 43.12, '1', 2, '2016-11-25 01:29:24', '0000-00-00'),
(119, 1, 122.91, '1', 3, '2016-11-25 13:44:14', '0000-00-00'),
(120, 1, 58.81, '1', 2, '2016-11-25 13:45:02', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_product_id` int(11) NOT NULL,
  `order_product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_product_price` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `order_product_id`, `order_product_name`, `order_product_price`) VALUES
(79, 54, 3, 'Turquoise Dress', 54.99),
(80, 54, 3, 'Striped Shirt', 24.00),
(81, 55, 3, 'Turquoise Dress', 54.99),
(82, 55, 3, 'Striped Shirt', 24.00),
(83, 56, 1, 'Ripped Jeans', 89.99),
(84, 57, 3, 'Ripped Jeans', 89.99),
(85, 57, 3, 'Striped Shirt', 24.00),
(86, 58, 1, 'Ripped Jeans', 89.99),
(87, 59, 1, 'Ripped Jeans', 89.99),
(88, 60, 1, 'Ripped Jeans', 89.99),
(89, 61, 1, 'Ripped Jeans', 89.99),
(90, 62, 2, 'Turquoise Dress', 54.99),
(91, 63, 2, 'Turquoise Dress', 54.99),
(92, 64, 3, 'Ripped Jeans', 89.99),
(93, 64, 3, 'Striped Shirt', 24.00),
(94, 65, 3, 'Ripped Jeans', 89.99),
(95, 65, 3, 'Striped Shirt', 24.00),
(96, 66, 1, 'Ripped Jeans', 89.99),
(97, 66, 1, 'Turquoise Dress', 54.99),
(98, 67, 1, 'Ripped Jeans', 89.99),
(99, 68, 2, 'Turquoise Dress', 54.99),
(100, 69, 2, 'Turquoise Dress', 54.99),
(101, 70, 2, 'Turquoise Dress', 54.99),
(102, 71, 1, 'Ripped Jeans', 89.99),
(103, 72, 2, 'Turquoise Dress', 54.99),
(104, 73, 9, 'Turquoise Dress', 54.99),
(105, 73, 9, 'Converse', 9.99),
(106, 74, 2, 'Turquoise Dress', 54.99),
(107, 75, 9, 'Converse', 9.99),
(108, 76, 1, 'Ripped Jeans', 89.99),
(109, 77, 2, 'Turquoise Dress', 54.99),
(110, 78, 3, 'Striped Shirt', 24.00),
(111, 79, 2, 'Turquoise Dress', 54.99),
(112, 80, 2, 'Turquoise Dress', 54.99),
(113, 81, 3, 'Ripped Jeans', 89.99),
(114, 81, 3, 'Striped Shirt', 24.00),
(115, 82, 2, 'Turquoise Dress', 54.99),
(116, 83, 1, 'Ripped Jeans', 89.99),
(117, 83, 1, 'Converse', 9.99),
(118, 84, 2, 'Ripped Jeans', 89.99),
(119, 84, 2, 'Turquoise Dress', 54.99),
(120, 85, 2, 'Turquoise Dress', 54.99),
(121, 86, 18, 'Ripped Jeans', 89.99),
(122, 86, 18, 'Turquoise Dress', 54.99),
(123, 86, 18, 'Converse', 9.99),
(124, 87, 3, 'Turquoise Dress', 54.99),
(125, 87, 3, 'Striped Shirt', 24.00),
(126, 88, 18, 'Converse', 9.99),
(127, 89, 2, 'Turquoise Dress', 54.99),
(128, 90, 19, 'Striped Shirt', 24.00),
(129, 91, 18, 'Converse', 9.99),
(130, 92, 3, 'Striped Shirt', 24.00),
(131, 93, 18, 'Converse', 9.99),
(132, 94, 19, 'Striped Shirt', 24.00),
(133, 95, 19, 'Striped Shirt', 24.00),
(134, 115, 2, 'Turquoise Dress', 54.99),
(135, 116, 3, 'Striped Shirt', 24.00),
(136, 117, 3, 'Striped Shirt', 24.00),
(137, 118, 18, 'Converse', 9.99),
(138, 119, 1, 'Ripped Jeans', 89.99),
(139, 119, 1, 'Converse', 9.99),
(140, 120, 3, 'Striped Shirt', 24.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `product_desc` text NOT NULL,
  `product_short_desc` varchar(255) NOT NULL,
  `product_img` text NOT NULL,
  `product_gender` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_desc`, `product_short_desc`, `product_img`, `product_gender`, `product_category`, `status`) VALUES
(1, 'Ripped Jeans', 89.99, 'This is just placeholder text.', 'Women''s ripped jeans', 'img/clothes/female/pants/jeans1.jpg', 'Female', 'Pants', '1'),
(2, 'Turquoise Dress', 54.99, 'This is just placeholder text.', 'Women''s blue dress with fringe pattern', 'img/clothes/female/dress/dress1.jpg', 'Female', 'Dress', '1'),
(3, 'Striped Shirt', 24.00, 'This is placeholder text.', 'Men''s striped dress shirt', 'img/clothes/male/shirt/shirt_striped.jpg', 'Male', 'Shirt', '1'),
(10, 'Converse', 9.99, 'This is placeholder text', 'Men''s Black Converse', 'img/clothes/Male/Shoes/converse.jpg', 'Male', 'Shoes', '1'),
(18, 'Converse', 9.99, 'This is placeholder text', 'Men''s Black Converse', 'img/clothes/Male/Shoes/converse.jpg', 'Male', 'Shoes', '1'),
(19, 'Striped Shirt', 24.00, 'This is placeholder text.', 'Men''s striped dress shirt', 'img/clothes/male/shirt/shirt_striped.jpg', 'Male', 'Shirt', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_img` text NOT NULL,
  `user_gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `user_email`, `user_password`, `user_role`, `user_img`, `user_gender`) VALUES
(1, 'AdrienM', 'Adrien', 'Maranville', 'Adrien@gmail.com', '$2y$10$GTlR9Lbz0cRUrpNiP4S.h.t8Q6NN4ivPTZiN/dJYKIh9h7jf1LB8y', 'Shopper', '', 'Male'),
(2, 'JohnS', 'John', 'Smith', 'John@gmail.com', '$2y$10$69YptedMo5ZmcTLK8nzGiOHghxEqAT1i7uXjSDByFt9Ll/q7T/oEy', 'Admin', '', 'Male'),
(3, 'Jack1', 'Jack', 'Robson', 'Jack@gmail.com', '$2y$10$UgF7zBt1x/nuHTbJJFkJUufhJKuXMVXniZO10t16vAh2V9vYY5iRG', 'Shopper', '', 'Male'),
(4, 'Pammit', 'Pam', 'Mit', 'Pam@gmail.com', '$2y$10$ASGBrkTSSdSsCDTn1o1GSudYtbifQpSp7gD1b1ttxMveuR/MkN84u', 'Shopper', '', 'Female'),
(5, 'JSon', 'Jason', 'Evers', 'Jason@gmail.com', '$2y$12$aDiaZStSH7zEpJYItYMLj.ZXwhZHaac3fpwzCpUFPYgRkNwOqpWNa', 'Shopper', '', 'Male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `aftersell`
--
ALTER TABLE `aftersell`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `aftersell_items`
--
ALTER TABLE `aftersell_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `cc_info`
--
ALTER TABLE `cc_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `cc_info_ibfk_2` (`order_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comments_ibfk_2` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `aftersell`
--
ALTER TABLE `aftersell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `aftersell_items`
--
ALTER TABLE `aftersell_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cc_info`
--
ALTER TABLE `cc_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `addresses_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `aftersell`
--
ALTER TABLE `aftersell`
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `aftersell_items` (`item_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cc_info`
--
ALTER TABLE `cc_info`
  ADD CONSTRAINT `cc_info_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cc_info_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
