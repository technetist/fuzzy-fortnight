-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 25, 2016 at 09:18 AM
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
(25, 66, 3, 'Weekend Bag', 3.99);

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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `aftersell` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `aftersell`) VALUES
(54, 2, 85.93, '1', 0),
(55, 2, 85.93, '1', 0),
(56, 2, 96.93, '1', 0),
(57, 2, 120.93, '1', 0),
(58, 2, 96.93, '1', 0),
(59, 2, 96.93, '1', 0),
(60, 2, 96.93, '1', 6),
(61, 2, 102.91, '1', 1),
(62, 2, 64.92, '1', 1),
(63, 2, 86.92, '1', 2),
(64, 2, 124.92, '1', 3),
(65, 2, 123.92, '1', 1),
(66, 2, 155.91, '1', 3);

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
(97, 66, 1, 'Turquoise Dress', 54.99);

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
(1, 'Ripped Jeans', 89.99, 'This is just placeholder text.', 'Women''s ripped jeans', 'img/clothes/womens/pants/jeans1.jpg', 'Women''s', 'Pants', '1'),
(2, 'Turquoise Dress', 54.99, 'This is just placeholder text.', 'Women''s blue dress with fringe pattern', 'img/clothes/womens/dress/dress1.jpg', 'Women''s', 'Dress', '1'),
(3, 'Striped Shirt', 24.00, 'This is placeholder text.', 'Men''s striped dress shirt', 'img/clothes/mens/shirt/shirt_striped.jpg', 'Men''s', 'Shirt', '1');

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
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `user_email`, `user_password`, `user_role`) VALUES
(1, 'AdrienM', 'Adrien', 'Maranville', 'Adrien.Maranville@gmail.com', '$2y$12$iUyzECfu9TO1PKr5IHB6JuEZf6vNvjX7T6qHLVkCrpXXVGhWE48Fy', 'Shopper'),
(2, 'JohnS', 'John', 'Smith', 'John@gmail.com', '$2y$12$V79InxqPnXav7SRkzN6XaejTHp4bFqKB.kij1USSOnqMIfDHCkyPO', 'Shopper');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `aftersell`
--
ALTER TABLE `aftersell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `aftersell_items`
--
ALTER TABLE `aftersell_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `aftersell`
--
ALTER TABLE `aftersell`
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `aftersell_items` (`item_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
