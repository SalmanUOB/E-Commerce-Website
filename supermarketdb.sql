-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 10:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supermarketdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(20) NOT NULL,
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_status`) VALUES
(664331, 'order confirmed'),
(664332, 'Pending'),
(664333, 'Pending'),
(664334, 'Pending'),
(664335, 'Pending'),
(664336, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_quantity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`product_id`, `order_id`, `product_name`, `product_price`, `product_quantity`) VALUES
(73, 664331, 'Chili', 1, 4),
(74, 664331, 'Almarai Milk', 1, 1),
(76, 664332, 'cookies', 8, 1),
(77, 664332, 'fruits', 20, 1),
(78, 664332, 'chocolate', 8, 4),
(79, 664333, 'water', 2, 1),
(80, 664334, 'water', 2, 1),
(81, 664335, 'cookies', 8, 1),
(82, 664336, 'water', 2, 1),
(83, 664336, 'cookies', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `quantity`, `image`, `category`, `details`) VALUES
(1, 'chocolate', '8', 15, '28F752BA-9013-4D95-9E6D-5A22F5C232E3.png', 'Sweets', '5 pieces of dark chocloate,expiry date is may 8'),
(2, 'cookies', '8', 10, 'FDEEF024-C864-457A-A610-82C46FE3A8C3.png', 'Sweets', '5 pieces of small cookies,expiry date is may 8'),
(3, 'water', '2', 0, '1A7BB3B4-2E5E-46BB-8FFE-434692B3F22F.png', 'Drinks', '20 pieces of aqua water'),
(4, 'strawberry', '1', 0, '882FED82-F89C-4C40-936D-E6B80536EDB0.png', 'Fruits', 'fresh strawberries expiry date at 9 may'),
(5, 'fruits', '20', 0, '376239B7-CA68-4F36-9E0A-111EE660B8C5.png', 'Fruits', 'full set of fruits,expiry dtae 20 may'),
(6, 'vegatables', '20', 0, 'B55B83F2-8253-4F95-9454-08911F5DF7E9.png', 'Vegetables', '20 set of vegtables ,expiry date at 20 may'),
(7, 'bread', '5', 0, 'D64950B5-706E-4831-B7C9-E2351A2317D4.png', 'Breads', '5 rolls of bread ,expirt date 9 may'),
(8, 'candy', '10', 0, '49E06680-E791-42A3-B5B9-471CD3A233F4.png', 'Sweets', 'set of candies ,expiry date 12 august'),
(9, 'tomato', '2', 0, '42CD9540-9807-4A2D-9248-7AB706F16231.png', 'Vegetables', '10 pieces,expiry date 6 may'),
(25, 'Apple', '1', 0, 'apple.png', 'Fruits', '9 pieces of apples,expiry date 8 may'),
(26, 'Chili', '1', 0, 'chili.png', 'Vegetables', 'red spicy chili one box contain 20 pieces'),
(27, 'Onion', '3', 0, 'onion.png', 'Vegetables', 'purple onions 8 pieces,expiry date 6 may'),
(28, 'Potato', '7', 0, 'patato.png', 'Vegetables', '8 potatoes ,expiry date 9 may'),
(29, 'Garlic', '2', 0, 'garlic.png', 'Vegetables', '2 pieces of white garlic'),
(30, 'Fish', '6', 0, 'Fish meat.png', 'Meats', 'fresh fish'),
(31, 'Almarai Milk', '1', 0, 'Milk.png', 'Dairy', 'white milk one piece ,expiry date 12 may'),
(34, 'lemon', '5', 0, 'lemon.jpg', 'Fruits', '7 pieces of lemon expiry date i 8 august');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `user`, `pass`, `category`) VALUES
(1, 'admin@admin.com', 'admin', 'abc123', 'admin'),
(24, 'email123@gmail.com', 'staff1', 'Abc123@@', 'staff'),
(25, '51616816azer@gmail.com', 'user1', 'Abc123@@', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=664338;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
