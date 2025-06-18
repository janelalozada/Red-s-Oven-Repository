-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 10:27 AM
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
-- Database: `red_oven`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `cake`
--

CREATE TABLE `cake` (
  `id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_code` varchar(12) NOT NULL,
  `brand_name` varchar(10) DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cake`
--

INSERT INTO `cake` (`id`, `product_name`, `product_price`, `product_qty`, `product_image`, `product_code`, `brand_name`, `last_updated`) VALUES
(1, 'Sweetheart Delight', 599.00, 13, 'image/Cakes/heart/heart1.png', '1', 'heart', '2025-04-07 20:21:51'),
(2, 'LoveBite Cake', 549.00, 3, 'image/Cakes/heart/heart2.png', '2', 'heart', '2025-04-07 20:21:53'),
(3, 'Blissful Heart', 549.00, 3, 'image/Cakes/heart/heart3.png', '3', 'heart', '2025-04-07 21:40:11'),
(4, 'Lush Love Cake', 599.00, 4, 'image/Cakes/heart/heart4.png', '4', 'heart', '2025-04-07 21:40:13'),
(5, 'Eternal Love Cake', 549.00, 11, 'image/Cakes/heart/heart5.png', '5', 'heart', '2025-04-07 21:40:16'),
(6, 'Dearest Delight', 549.00, 26, 'image/Cakes/heart/heart6.png', '6', 'heart', '2025-04-07 21:40:20'),
(7, 'Knot & Love Cake', 599.00, 1, 'image/Cakes/heart/heart7.png', '7', 'heart', '2025-04-02 07:55:01'),
(8, 'Tangled in Sweetness', 599.00, 1, 'image/Cakes/heart/heart8.png', '8', 'heart', '2025-04-02 07:55:01'),
(9, 'Purl-fect Heart', 599.00, 13, 'image/Cakes/heart/heart9.png', '9', 'heart', '2025-04-07 21:40:25'),
(10, 'Heavenly Heart', 599.00, 1, 'image/Cakes/heart/heart10.png', '10', 'heart', '2025-04-02 07:55:01'),
(11, 'Heartstring Cake', 599.00, 1, 'image/Cakes/heart/heart11.png', '11', 'heart', '2025-04-02 07:55:01'),
(12, 'Red Velvet Romance', 549.00, 1, 'image/Cakes/heart/heart12.png', '12', 'heart', '2025-04-02 07:55:01'),
(13, 'Minty Whispers', 499.00, 1, 'image/Cakes/circle/circle1.png', '13', 'circle', '2025-04-02 07:55:01'),
(14, 'Infinity Round', 499.00, 3, 'image/Cakes/circle/circle2.png', '14', 'circle', '2025-04-07 23:32:09'),
(15, 'Orb of Joy', 499.00, 1, 'image/Cakes/circle/circle3.png', '15', 'circle', '2025-04-02 07:55:01'),
(16, 'Green Serenity', 499.00, 1, 'image/Cakes/circle/circle4.png', '16', 'circle', '2025-04-02 07:55:01'),
(17, 'Sweet Sphere', 499.00, 3, 'image/Cakes/circle/circle5.png', '17', 'circle', '2025-04-07 21:40:31'),
(18, 'Classic Charm Cake', 499.00, 1, 'image/Cakes/circle/circle6.png', '18', 'circle', '2025-04-02 07:55:01'),
(19, 'Berry Bliss', 499.00, 1, 'image/Cakes/circle/circle7.png', '19', 'circle', '2025-04-02 07:55:01'),
(20, 'Soft Glow Cake', 359.00, 1, 'image/Cakes/bento/bento1.png', '20', 'bento', '2025-04-02 07:55:01'),
(21, 'Barbie Dream Cake', 359.00, 1, 'image/Cakes/bento/bento2.png', '21', 'bento', '2025-04-02 07:55:01'),
(22, 'Pinky Swirl', 399.00, 1, 'image/Cakes/bento/bento3.png', '22', 'bento', '2025-04-02 07:55:01'),
(23, 'Tiny Tiers', 399.00, 4, 'image/Cakes/bento/bento4.png', '23', 'bento', '2025-04-07 21:40:29'),
(24, 'Sweet Peony', 399.00, 1, 'image/Cakes/bento/bento5.png', '24', 'bento', '2025-04-02 07:55:01'),
(25, 'Dainty Delight', 359.00, 1, 'image/Cakes/bento/bento6.png', '25', 'bento', '2025-04-02 07:55:01'),
(26, 'Double the Love', 1299.00, 1, 'image/Cakes/bundle/bundle1.png', '26', 'bundle', '2025-04-02 07:55:01'),
(27, 'Blossom Duo', 1499.00, 1, 'image/Cakes/bundle/bundle2.png', '27', 'bundle', '2025-04-02 07:55:01'),
(28, 'Blooming Love Bundle', 499.00, 1, 'image/Cakes/bundle/bundle3.png', '28', 'bundle', '2025-04-02 07:55:01'),
(29, 'Heartfelt Blossom', 499.00, 1, 'image/Cakes/bundle/bundle4.png', '29', 'bundle', '2025-04-02 07:55:01'),
(30, 'Love in Bloom', 499.00, 1, 'image/Cakes/bundle/bundle5.png', '30', 'bundle', '2025-04-02 07:55:01'),
(31, 'Flower Garden Bundle', 1799.00, 1, 'image/Cakes/bundle/bundle6.png', '31', 'bundle', '2025-04-02 07:55:01'),
(32, 'Floral Fantasy', 1699.00, 1, 'image/Cakes/special/special1.png', '32', 'special', '2025-04-02 07:55:01'),
(33, 'Wings of Blue', 1599.00, 1, 'image/Cakes/special/special2.png', '33', 'special', '2025-04-02 07:55:01'),
(34, 'Royal Pink Bliss', 1299.00, 1, 'image/Cakes/special/special3.png', '34', 'special', '2025-04-02 07:55:01'),
(35, 'Kuromi’s Sugar Rush', 1799.00, 1, 'image/Cakes/special/special4.png', '35', 'special', '2025-04-02 07:55:01'),
(36, 'Roar of Sweetness', 999.00, 1, 'image/Cakes/special/special5.png', '36', 'special', '2025-04-02 07:55:01');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `product_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_name`, `product_price`, `product_image`, `qty`, `total_price`, `product_code`) VALUES
(104, NULL, 'LoveBite Cake', '549.00', 'image/Cakes/heart/heart2.png', 1, '549', '2'),
(105, NULL, 'Sweetheart Delight', '599.00', 'image/Cakes/heart/heart1.png', 11, '6589', '1'),
(108, NULL, 'Blissful Heart', '549.00', 'image/Cakes/heart/heart3.png', 1, '549', '3'),
(110, NULL, 'Wings of Blue', '1599.00', 'image/Cakes/special/special2.png', 1, '1599', '33');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pmode` varchar(50) NOT NULL,
  `products` varchar(255) NOT NULL,
  `amount_paid` varchar(100) NOT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `pmode`, `products`, `amount_paid`, `status`, `created_at`) VALUES
(19, NULL, 'Janela Lozada', 'jkathlozada@gmail.com', '09451460611', 'Malate, Manila', 'cod', 'Barbie Dream Cake(1), Sweetheart Delight(3), Royal Pink Bliss(1), Sweet Peony(1)', '3854', 'completed', '2025-04-08 08:27:27'),
(20, NULL, 'Janela Lozada', 'jkathlozada@gmail.com', '09451460611', 'Malate, Manila', 'netbanking', 'Infinity Round(1), Classic Charm Cake(1)', '998', 'completed', '2025-04-08 08:27:27'),
(21, NULL, 'Janela Lozada', 'jrlozada@pwu.edu.ph', '09451460611', 'Malate, Manila', 'cod', 'Infinity Round(1), Orb of Joy(1)', '998', 'completed', '2025-04-08 08:27:27'),
(22, NULL, 'Janela Lozada', 'jrlozada@pwu.edu.ph', '09451460611', 'Malate, Manila', 'netbanking', 'Infinity Round(1), Green Serenity(1)', '998', 'completed', '2025-04-08 08:27:27'),
(23, NULL, 'Bea Binene', 'iya@gmail.com', '09451460611', 'Malate, Manila', 'cod', 'Barbie Dream Cake(1), Infinity Round(1)', '858', 'completed', '2025-04-08 08:27:27'),
(24, NULL, 'Bianca De vera', 'bianca@gmail.com', '09451460611', 'Malate, Manila', 'cards', 'Minty Whispers(1), Sweet Sphere(1)', '998', 'completed', '2025-04-08 08:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(100) DEFAULT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(3, 'JM', 'Gajon', 'asd@gmail.com', '$2y$10$PGHbarc1eYirnKp4O0lSUuWQ6/OvLvjh3zM0Ua9sgCO'),
(5, 'Iya', 'Lozada', 'iya@gmail.com', '$2y$10$9IY0.cE4L8Hh34AIDBhFHOaYGpQiA9HVrlueQLMsT96'),
(7, 'Bea', 'Binene', 'iya@gmail.com', '$2y$10$CrZWpm9vcwEjOfxKoOgB5OXkMULMqFEp1l47JUrBxx473z8vzoW1m'),
(8, 'Bianca', 'De vera', 'bianca@gmail.com', '$2y$10$TTHkfd7S5GiUofOdaEiX6eg5GHC0cY847w5OOF5DaNLtuZWhq43u2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cake`
--
ALTER TABLE `cake`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cake`
--
ALTER TABLE `cake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
