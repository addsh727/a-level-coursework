-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2023 at 04:42 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s2106630`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(10) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `CategoryDescription` text NOT NULL,
  `CategoryVisibility` tinyint(1) NOT NULL,
  `CategoryPopular` tinyint(1) NOT NULL,
  `CategoryImage` varchar(255) NOT NULL,
  `MetaTitle` varchar(255) NOT NULL,
  `MetaDescription` text NOT NULL,
  `MetaKeywords` text NOT NULL,
  `DateOfCreation` datetime DEFAULT NULL,
  `DateOfUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`, `CategoryDescription`, `CategoryVisibility`, `CategoryPopular`, `CategoryImage`, `MetaTitle`, `MetaDescription`, `MetaKeywords`, `DateOfCreation`, `DateOfUpdate`) VALUES
(1, 'Phones', 'Variety of phones from a plethora of brands', 1, 1, '1675372437.webp', 'Phones', 'Variety of phones from a plethora of brands', 'Phone, Phones, Mobile, Mobiles, SIM, Camera, Smartphone, Smartphones, Touchscreen, Android, iOS, Fingerprint Scanner', '2023-02-02 21:13:57', '2023-02-04 14:34:49'),
(2, 'Laptops', 'Variety of laptops from a plethora of brands', 1, 0, '1675372600.webp', 'Laptops', 'Variety of laptops from a plethora of brands', 'Laptop, Laptops, Camera, Touchscreen, Windows, Macbook, Macbooks, Foldable, SSD', '2023-02-02 21:16:09', '2023-02-02 21:16:40'),
(3, 'TVs', 'Variety of TVs from a plethora of brands', 1, 0, '1675372754.webp', 'TVs', 'Variety of TVs from a plethora of brands', 'TV, Television, Satellite, Home, News, YouTube, Smart, Smart TV, Smart Television, HD, High Definition, 4K, High Resolution, Bluetooth', '2023-02-02 21:19:14', '2023-02-02 21:19:14'),
(4, 'PCs', 'Variety of PCs from a plethora of brands', 0, 1, '1675372813.webp', 'PCs', 'Variety of PCs from a plethora of brands', 'Gaming, PC, Windows 10, AMD, Intel, Ryzen, NVIDIA, CPU, Graphics Card, NVMe, RAM, SSD, HDD, Water Cooling, Air Cooling', '2023-02-02 21:20:13', '2023-03-19 07:21:18'),
(5, 'Tablets', 'Variety of tablets from a plethora of brands', 1, 1, '1675959741.webp', 'Tablets', 'Variety of tablets from a plethora of brands', 'ipads', '2023-02-09 16:22:21', '2023-02-09 22:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(10) NOT NULL,
  `DateOfCreation` datetime NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Verified` tinyint(1) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `HashedPassword` text NOT NULL,
  `Verification` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `DateOfCreation`, `FirstName`, `Surname`, `Email`, `Verified`, `Password`, `HashedPassword`, `Verification`) VALUES
(1, '2023-01-23 11:44:57', 'Adib', 'Shehab', 's2106630@leyton.ac.uk', 1, 'password', '$2y$10$QMXiozdzzyWHHlYXfhHyXeT4JJP7t0u.MWHuNZefxEkfWTZF9WSqC', ''),
(3, '2023-03-22 09:10:58', 'M', 'Rashid', 'mohammed.rashid@leyton.ac.uk', 0, '12345678', '$2y$10$ICSXgxSVY97dCB4HLTe6ZOcQ.F9CJjBdt59dQttrK8/xMVElyHfqS', 'ec17d5e89fb456474641b8896f799cbb'),
(4, '2023-04-04 02:30:13', 'test', 'test', 'addsh727@gmail.com', 1, '12345678', '$2y$10$xq0WRPRtjsj6Ee9xPx/uoeFKNSb7A37EifMxhRvHIqXkaeMAeEtNe', '');

-- --------------------------------------------------------

--
-- Table structure for table `orderline`
--

CREATE TABLE `orderline` (
  `OrderLineID` int(10) NOT NULL,
  `OrderID` int(10) NOT NULL,
  `ProductID` int(10) NOT NULL,
  `SellingPrice` decimal(6,2) NOT NULL,
  `ProductQuantity` int(4) NOT NULL,
  `DateOfCreation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderline`
--

INSERT INTO `orderline` (`OrderLineID`, `OrderID`, `ProductID`, `SellingPrice`, `ProductQuantity`, `DateOfCreation`) VALUES
(1, 1, 20, '699.00', 3, '2023-02-19 09:23:49'),
(2, 2, 20, '699.00', 4, '2023-02-19 09:27:00'),
(3, 3, 4, '129.00', 1, '2023-02-20 19:50:26'),
(4, 3, 13, '449.00', 2, '2023-02-20 19:50:26'),
(5, 3, 11, '550.00', 1, '2023-02-20 19:50:26'),
(6, 3, 23, '300.00', 1, '2023-02-20 19:50:26'),
(7, 4, 22, '1429.00', 2, '2023-02-21 09:21:03'),
(8, 5, 23, '300.00', 1, '2023-02-22 21:53:14'),
(9, 6, 6, '219.00', 1, '2023-02-22 21:56:42'),
(10, 7, 16, '170.00', 1, '2023-02-24 18:57:03'),
(11, 8, 7, '349.00', 1, '2023-02-24 19:02:02'),
(12, 9, 17, '1309.00', 1, '2023-02-24 19:07:09'),
(13, 10, 6, '219.00', 1, '2023-02-24 19:20:19'),
(14, 11, 18, '279.00', 1, '2023-02-24 20:00:17'),
(15, 12, 5, '429.00', 1, '2023-02-24 20:05:59'),
(16, 13, 5, '429.00', 1, '2023-02-24 20:12:15'),
(17, 14, 4, '129.00', 1, '2023-03-04 21:56:00'),
(18, 17, 17, '1309.00', 1, '2023-03-04 22:00:02'),
(19, 18, 18, '279.00', 1, '2023-03-06 11:29:33'),
(20, 19, 23, '300.00', 1, '2023-03-06 11:46:40'),
(21, 20, 4, '129.00', 1, '2023-03-06 11:51:47'),
(22, 21, 4, '129.00', 1, '2023-03-06 11:57:56'),
(23, 22, 3, '890.00', 1, '2023-03-06 12:00:49'),
(24, 23, 16, '170.00', 1, '2023-03-22 09:14:18'),
(25, 24, 12, '249.00', 1, '2023-03-22 10:49:37'),
(26, 25, 24, '1349.00', 1, '2023-03-30 15:17:51'),
(27, 26, 24, '1349.00', 1, '2023-03-31 15:07:43'),
(28, 27, 24, '1349.00', 1, '2023-04-03 09:03:18'),
(29, 27, 21, '499.00', 2, '2023-04-03 09:03:18'),
(30, 28, 24, '1349.00', 1, '2023-04-03 09:07:41'),
(31, 28, 21, '499.00', 2, '2023-04-03 09:07:41'),
(32, 29, 24, '1349.00', 1, '2023-04-03 09:15:32'),
(33, 29, 21, '499.00', 2, '2023-04-03 09:15:32'),
(34, 30, 24, '1349.00', 1, '2023-04-03 09:26:07'),
(35, 30, 21, '499.00', 2, '2023-04-03 09:26:07'),
(36, 31, 33, '1440.00', 2, '2023-04-16 17:18:50'),
(37, 31, 36, '2999.00', 1, '2023-04-16 17:18:50'),
(38, 32, 36, '2999.00', 1, '2023-04-16 17:25:24'),
(39, 32, 33, '1440.00', 2, '2023-04-16 17:25:24'),
(40, 33, 32, '600.00', 1, '2023-05-25 16:38:46'),
(41, 33, 36, '2999.00', 1, '2023-05-25 16:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(10) NOT NULL,
  `TrackingID` varchar(255) NOT NULL,
  `CustomerID` int(10) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `PhoneNumber` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Postcode` varchar(255) NOT NULL,
  `TotalPrice` decimal(6,2) NOT NULL,
  `PaymentMethod` varchar(255) NOT NULL,
  `PaymentID` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) NOT NULL,
  `Collection` tinyint(1) NOT NULL,
  `Instructions` varchar(255) DEFAULT NULL,
  `DateOfCreation` datetime NOT NULL DEFAULT current_timestamp(),
  `DateOfUpdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `TrackingID`, `CustomerID`, `FirstName`, `Surname`, `PhoneNumber`, `Address`, `City`, `Postcode`, `TotalPrice`, `PaymentMethod`, `PaymentID`, `Status`, `Collection`, `Instructions`, `DateOfCreation`, `DateOfUpdate`) VALUES
(1, 'ZD3843504don', 1, 'Adib', 'Shehab', '070000000', 'Somewhere', 'London', 'E10 6EQ', '2097.00', 'Admin Test Pay', '', 1, 1, 'Stolen by employee', '2023-01-19 09:23:49', '2023-02-19 09:23:49'),
(2, 'ZD1125142don', 1, 'Adib', 'Shehab', '070000000', 'Somewhere', 'London', 'E10 6EQ', '2796.00', 'Admin Test Pay', '', 1, 0, 'Stolen by employee', '2023-01-19 09:27:00', '2023-02-19 09:27:00'),
(3, 'ZD328154Lon', 1, 'Adib', 'Shehab', '070000000', 'Somewhere', 'London', 'E10 6EQ', '1877.00', 'Admin Test Pay', '', 1, 1, 'N/A', '2023-02-20 19:50:26', '2023-02-20 19:50:26'),
(4, 'ZD2503345Lon', 1, 'Adib', 'Shehab', '070000000', 'Somehwere', 'London', 'E10 6EQ', '2858.00', 'Admin Test Pay', '', 1, 1, 'N/A', '2023-02-21 09:21:03', '2023-02-21 09:21:03'),
(5, 'ZD5999440Lon', 1, 'Adib', 'Shehab', '070000000', 'Somewhere', 'London', 'E10 6EQ', '300.00', 'Admin Test Pay', '', 2, 0, 'N/A', '2023-02-22 21:53:14', '2023-02-22 21:53:14'),
(6, 'ZD2117479Lon', 1, 'Adib', 'Shehab', '070000000', 'Somewhere', 'London', 'E10 6EQ', '219.00', 'Admin Test Pay', '', 2, 0, 'N/A', '2023-02-22 21:56:42', '2023-02-22 21:56:42'),
(7, 'ZD858453Lon', 1, 'Adib', 'Shehab', '070000000', 'Somewhere', 'London', 'E10 6EQ', '170.00', 'Paypal', '17213886XY862333V', 1, 0, 'N/A', '2023-02-24 18:57:03', '2023-02-24 18:57:03'),
(8, 'ZD9551373Lon', 1, 'Adib', 'Shehab', '070000000', 'LSC', 'London', 'E10 6EQ', '349.00', 'Paypal', '53A91242EH5855132', 1, 0, 'Front Gates', '2023-02-24 19:02:02', '2023-02-24 19:02:02'),
(9, 'ZD1086530', 1, 'Adib', 'Shehab', '07000000', 'lksad', 'ljd', 'ldj', '1309.00', 'Paypal', '3SR73405Y91634255', 1, 0, 'ld', '2023-02-24 19:07:09', '2023-02-24 19:07:09'),
(10, 'ZD7894646alk', 1, 'Adib', 'Shehab', '070000000', 'alsdl', 'alkdsj', 'alksdj', '219.00', 'Paypal', '78J089485L930480X', 1, 0, 'szlasd', '2023-02-24 19:20:19', '2023-03-04 11:55:51'),
(11, 'ZD4049332l', 1, 'Adib', 'Shehab', '070000000', 'lkjlk', 'lkjl', 'lkjl', '279.00', 'Paypal', '6N292396RG6372105', 1, 0, 'lkjlj', '2023-02-24 20:00:17', '2023-02-24 20:00:17'),
(12, 'ZD3619608', 1, 'Adib', 'Shehab', '8098', '9808080', '808', '9808', '429.00', 'Paypal', '6RT89993RG694162E', 1, 0, '080', '2023-02-24 20:05:59', '2023-03-03 23:30:22'),
(13, 'ZD9663141hkdk', 1, 'Adib', 'Shehab', '070000000', 'lasjdkj', 'hkdkjdh', 'kjhdkj', '429.00', 'Paypal', '50R255008A157923R', 1, 0, 'hkj', '2023-02-24 20:12:15', '2023-03-04 11:53:16'),
(14, 'ZD7817923', 1, 'Adib', 'Shehab', '070000000', 'asdkjh', 'dkh', 'dkjh', '129.00', 'Admin Test Pay', '', 1, 1, 'kdwef', '2023-03-04 21:56:00', '2023-03-04 22:03:41'),
(15, 'ZD6940179', 1, 'Adib', 'Shehab', '070000000', 'asdkjh', 'dkh', 'dkjh', '129.00', 'Admin Test Pay', '', 2, 1, 'kdwef', '2023-03-04 21:57:28', '2023-03-04 22:03:31'),
(16, 'ZD8516380', 1, 'Adib', 'Shehab', '070000000', 'asdkjh', 'dkh', 'dkjh', '129.00', 'Admin Test Pay', '', 2, 1, 'kdwef', '2023-03-04 21:57:37', '2023-03-04 22:03:21'),
(17, 'ZD9215811ida', 1, 'Adib', 'Shehab', '070000000', 'asadoaisd', 'idaksd', 'oid', '1309.00', 'Admin Test Pay', '', 1, 0, 'od', '2023-03-04 22:00:02', '2023-03-04 22:03:53'),
(18, 'ZD1839638', 1, 'Adib', 'Shehab', '070000000', 'asdkjsakd', 'dh', 'khdkh', '279.00', 'Paypal', '1UF450300Y526364E', 1, 0, 'dkh', '2023-03-06 11:29:33', '2023-03-06 11:45:24'),
(19, 'ZDErrorHappenedHere', 1, 'Adib', 'Shehab', '070000000', 'ajsjdhaskdh', 'djkshkdjh', 'kjdhk', '300.00', 'Paypal', '9H512082WB772182T', 1, 0, 'dhasdjk', '2023-03-06 11:46:40', '2023-03-22 14:03:48'),
(20, 'ZD8606791j', 1, 'Adib', 'Shehab', '070000000', 'haafj', 'jhkh', 'khjkjh', '129.00', 'Paypal', '4H440585N6310143E', 1, 0, 'khkhk', '2023-03-06 11:51:47', '2023-03-23 11:41:58'),
(21, 'ZD3482681dhkjhs', 1, 'Adib', 'Shehab', '070000000', 'kasjdhkash', 'dhkjhsakd', 'dkjkahsd', '129.00', 'Paypal', '12A35422BT3682029', 1, 1, 'kdhkjhaskd', '2023-03-06 11:57:56', '2023-03-06 11:58:22'),
(22, 'ZD5585712amer', 1, 'Adib', 'Shehab', '07712752125613', 'college', 'america', 'bangladesh', '890.00', 'Paypal', '4B842615PP807862S', 0, 1, 'be aware of people', '2023-03-06 12:00:49', '2023-04-15 03:42:55'),
(23, 'ZD6171404Lon', 3, 'M', 'Rashid', '78888888998', '234 ha', 'London', 'e20 9aa', '170.00', 'Admin Test Pay', '', 1, 0, '2nd fl', '2023-03-22 09:14:18', '2023-03-23 11:22:46'),
(24, 'ZD5096105', 3, 'M', 'Rashid', '7878', '8987', '987', '98798', '249.00', 'Paypal', '2GY32473JH945873G', 1, 0, '798798798', '2023-03-22 10:49:37', '2023-03-23 11:22:59'),
(25, 'ZD8034032Lon', 1, 'Adib', 'Shehab', '07444506707', '4 Wise Rd Stratford London', 'London', 'E15 2TG', '1349.00', 'Paypal', '529345472D108162E', 1, 0, 'drop by my door', '2023-03-30 15:17:51', '2023-04-03 08:59:55'),
(26, 'ZD2453129kjh', 1, 'Adib', 'Shehab', 'asjdhak', 'akjjsdhakdh', 'kjhdak', 'kdjhkshd', '1349.00', 'Paypal', '8MY26968CD226952S', 1, 0, 'aksjdhs', '2023-03-31 15:07:43', '2023-04-03 09:18:02'),
(27, 'ZD2142753Lon', 1, 'Adib', 'Shehab', '070000000', 'Middle of the road', 'London', 'E10 6EQ', '2347.00', 'Admin Test Pay', '', 1, 0, 'Front Gates', '2023-04-03 09:03:18', '2023-04-03 09:18:50'),
(28, 'ZD4387163Lon', 1, 'Adib', 'Shehab', '070000000', 'Middle of the road', 'London', 'E10 6EQ', '2347.00', 'Admin Test Pay', '', 1, 0, 'Front Gates', '2023-04-03 09:07:41', '2023-04-14 02:17:16'),
(29, 'ZD6223495Lon', 1, 'Adib', 'Shehab', '070000000', 'adasdsadsad', 'London', 'E10 6EQ', '2347.00', 'Admin Test Pay', '', 2, 0, 'uzfdhgijpzfdg', '2023-04-03 09:15:32', '2023-04-13 10:58:51'),
(30, 'ZD4890077NYC', 1, 'Adib', 'Shehab', '070000000', 'adijhasudh', 'NYCity', 'idk', '2347.00', 'Admin Test Pay', '', 0, 0, 'liberty statue', '2023-04-03 09:26:07', '2023-04-15 03:42:44'),
(31, 'ZDG5581331C', 1, 'Adib', 'Shehab', '07777777', 'Address', 'City', 'Postcode', '5879.00', 'Admin Test Pay', '', 2, 0, 'N/A', '2023-04-16 17:18:50', '2023-04-16 17:20:21'),
(32, 'ZDG7794273Lon', 1, 'Adib', 'Shehab', '07777777', 'LSC', 'London', 'E10 6EQ', '5879.00', 'Paypal', '0S0712394A4074249', 0, 0, 'Leave at front gates.', '2023-04-16 17:25:24', '2023-04-16 17:25:24'),
(33, 'ZDG5331273t', 3, 'M', 'Rashid', '070000000', 'test', 'test', 'test', '3599.00', 'Paypal', '84D81438BT140084P', 0, 0, 'test', '2023-05-25 16:38:46', '2023-05-25 16:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(10) NOT NULL,
  `CategoryID` int(10) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `ProductDescription` text NOT NULL,
  `ProductQuantity` int(4) NOT NULL,
  `RetailPrice` decimal(6,2) NOT NULL,
  `SellingPrice` decimal(6,2) NOT NULL,
  `ProductVisibility` tinyint(1) NOT NULL,
  `ProductPopular` tinyint(1) NOT NULL,
  `ProductImage` varchar(255) NOT NULL,
  `MetaTitle` varchar(255) NOT NULL,
  `MetaKeywords` text NOT NULL,
  `MetaDescription` text NOT NULL,
  `DateOfCreation` datetime NOT NULL,
  `DateOfUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `CategoryID`, `ProductName`, `ProductDescription`, `ProductQuantity`, `RetailPrice`, `SellingPrice`, `ProductVisibility`, `ProductPopular`, `ProductImage`, `MetaTitle`, `MetaKeywords`, `MetaDescription`, `DateOfCreation`, `DateOfUpdate`) VALUES
(3, 2, 'Microsoft Surface 4 13\" Ryzen 5 4680U 16GB 256GB SSD Platinum', 'Style and speed. Stand out on HD video calls backed by Studio Mics. Capture ideas on the vibrant touchscreen.\r\nDo it all with a perfect balance of sleek design, speed, immersive audio, and significantly longer battery life.', 8, '900.00', '890.00', 1, 1, '1675764010.webp', 'Microsoft Surface 4 13\" Ryzen 5 4680U 16GB 256GB SSD Platinum', 'Laptop, Laptops, Camera, Touchscreen, Windows, Macbook, Macbooks, Foldable, SSD', 'Style and speed. Stand out on HD video calls backed by Studio Mics. Capture ideas on the vibrant touchscreen.\r\nDo it all with a perfect balance of sleek design, speed, immersive audio, and significantly longer battery life.', '2023-02-07 10:00:10', '2023-04-15 02:20:00'),
(4, 1, 'Samsung Galaxy A13 64GB White', 'Whether you are scrolling social media, bossing your studies, or working on your latest side-hustle, you need a phone that will go the distance. That\'s where Samsung Galaxy A13 comes in. An awesome device packed with impressive graphics, powerful batteries, epic screens and amazing cameras with built-in smart features. With Samsung Galaxy A13 in your corner, nothing\'s going to hold you back. \r\nCapture it all in high quality - Thanks to the rear quad cameras, with a max of 50MP, every snap is awesome. Plus, with special features like Portrait Mode and Dual Camera Shot perfecting every picture, you\'ll want to post them all. \r\nCrystal clear view - Get ready for a sharp picture on the huge FHD screen. Stream and video chat in super high quality, whenever you want. \r\nSuper smart battery - Enjoy a long-lasting battery, plus super smart AI energy management to preserve power. Game, play, or scroll for hours, knowing your phone will keep you going. \r\nModel number: SM-A135FZWVEUB.', 6, '140.00', '129.00', 1, 1, '1675764151.webp', 'Samsung Galaxy A13 64GB White', 'Samung, Samung Galaxy, Samsung Phone, Samsung Galaxy Phone, Samsung A53, 5G, Phone, Phones, Mobile, Mobiles, SIM, Camera, Smartphone, Smartphones, Touchscreen, Android, iOS, Fingerprint Scanner', 'Whether you are scrolling social media, bossing your studies, or working on your latest side-hustle, you need a phone that will go the distance. That\'s where Samsung Galaxy A13 comes in. An awesome device packed with impressive graphics, powerful batteries, epic screens and amazing cameras with built-in smart features. With Samsung Galaxy A13 in your corner, nothing\'s going to hold you back. \r\nCapture it all in high quality - Thanks to the rear quad cameras, with a max of 50MP, every snap is awesome. Plus, with special features like Portrait Mode and Dual Camera Shot perfecting every picture, you\'ll want to post them all. \r\nCrystal clear view - Get ready for a sharp picture on the huge FHD screen. Stream and video chat in super high quality, whenever you want. \r\nSuper smart battery - Enjoy a long-lasting battery, plus super smart AI energy management to preserve power. Game, play, or scroll for hours, knowing your phone will keep you going. \r\nModel number: SM-A135FZWVEUB.', '2023-02-07 10:02:31', '2023-04-15 02:03:37'),
(5, 2, 'HP 15.6\" i5 8GB 256GB Laptop Silver', 'Do your thing, anywhere, with the help of the compact HP Pavilion 15.6-inch Laptop. Effectively tackle any assignment with the powerful Intel processor and precision touchpad. \r\nCrank up the entertainment with Audio by B&O and a flicker-free screen. Stay on top of work, school, and everything in between with a powerful Intel processor. \r\nThis laptop\'s compact size, long battery life, and HP Fast Charge feature allow you to do more on the go. \r\nModel number: 15-eg2014na.', 4, '450.00', '429.00', 1, 1, '1675764242.webp', 'HP 15.6\" i5 8GB 256GB Laptop Silver', 'Laptop, Laptops, Camera, Touchscreen, Windows, Macbook, Macbooks, Foldable, SSD', 'Do your thing, anywhere, with the help of the compact HP Pavilion 15.6-inch Laptop. Effectively tackle any assignment with the powerful Intel processor and precision touchpad. \r\nCrank up the entertainment with Audio by B&O and a flicker-free screen. Stay on top of work, school, and everything in between with a powerful Intel processor. \r\nThis laptop\'s compact size, long battery life, and HP Fast Charge feature allow you to do more on the go. \r\nModel number: 15-eg2014na.', '2023-02-07 10:04:02', '2023-04-15 02:19:52'),
(6, 3, 'LG 32LM637BPLA Smart LED 32\" TV', 'The LG LQ630B brings you sharp HD pictures, immersive sound, and a wealth of content from the webOS smart platform. The smart 5 Gen5 processor ensures picture and sound quality are optimised for a brilliant TV experience. \r\nLG\'s AI Sound feature puts you right at the centre of the action, creating an immersive atmosphere. \r\nAccess all of your must-have apps like Freeview Play, NOW, Netflix, Prime Video, Disney+, Twitch and more on LG\'s easy-to-use webOS smart platform. \r\nExperience the movies like the director intended with HDR. \r\nModel number: 32LM637BPLA.', 1, '225.00', '219.00', 1, 1, '1675764386.webp', 'LG 32LM637BPLA Smart LED 32\" TV', 'TV, Television, Satellite, Home, News, YouTube, Smart, Smart TV, Smart Television, HD, High Definition, 4K, High Resolution, Bluetooth', 'The LG LQ630B brings you sharp HD pictures, immersive sound, and a wealth of content from the webOS smart platform. The smart 5 Gen5 processor ensures picture and sound quality are optimised for a brilliant TV experience. \r\nLG\'s AI Sound feature puts you right at the centre of the action, creating an immersive atmosphere. \r\nAccess all of your must-have apps like Freeview Play, NOW, Netflix, Prime Video, Disney+, Twitch and more on LG\'s easy-to-use webOS smart platform. \r\nExperience the movies like the director intended with HDR. \r\nModel number: 32LM637BPLA.', '2023-02-07 10:06:26', '2023-04-15 02:20:08'),
(7, 2, 'Acer Aspire 3 15.6\" Ryzen 3 8GB 256GB Laptop Silver', 'Acer\'s Aspire 3 is a great all-round laptop, easily capable of meeting your day-to-day needs. Equipped with a powerful AMD Ryzen 5 processor and 8GB of RAM, the Aspire 3 can handle a variety of tasks such as web browsing or editing documents as well as multi-taking without slowing down. You also get 256GB of high-speed SSD storage for your apps & files.\r\nWindows 11 offers great performance, a refreshed design and seamless integration of services such as Microsoft 365 and Microsoft Teams.\r\nAcer VisionCare – a suite of technologies such as BlueLightShield & ComfyView, which help to reduce eye strain and fatigue.\r\nModel number: A315-43.', 7, '360.00', '349.00', 1, 1, '1675764856.webp', 'Acer Aspire 3 15.6\" Ryzen 3 8GB 256GB Laptop Silver', 'Laptop, Laptops, Camera, Touchscreen, Windows, Macbook, Macbooks, Foldable, SSD', 'Acer\'s Aspire 3 is a great all-round laptop, easily capable of meeting your day-to-day needs. Equipped with a powerful AMD Ryzen 5 processor and 8GB of RAM, the Aspire 3 can handle a variety of tasks such as web browsing or editing documents as well as multi-taking without slowing down. You also get 256GB of high-speed SSD storage for your apps & files.\r\nWindows 11 offers great performance, a refreshed design and seamless integration of services such as Microsoft 365 and Microsoft Teams.\r\nAcer VisionCare – a suite of technologies such as BlueLightShield & ComfyView, which help to reduce eye strain and fatigue.\r\nModel number: A315-43.', '2023-02-07 10:14:16', '2023-04-15 02:19:45'),
(8, 1, 'iPhone 11 64GB Black', 'Just the right amount of everything. Shoot 4K videos, beautiful portraits and sweeping landscapes with the all-new dual-camera system. Capture your best low-light photos with Night mode. See true-to-life colour in your photos, videos and games on the 6.1-inch Liquid Retina display. Experience unprecedented performance with A13. Bionic for gaming, augmented reality (AR) and photography. Do more and charge less with all-day battery life. \r\nWater and dust resistant (2 metres for up to 30 minutes, IP68). Face ID for secure authentication and Apple Pay. \r\nDual-camera system with 12MP Ultra Wide and Wide cameras, Night mode, Portrait mode, and 4K video up to 60 fps. 12MP TrueDepth front camera with Portrait mode, 4K video and slo-mo. \r\niOS 13 with Dark Mode, new tools for editing photos and video, and brand-new privacy features.', 4, '450.00', '429.00', 1, 1, '1675764981.webp', 'iPhone 11 64GB Black', 'iPhone, iPhone Device, Apple Phone, Apple Device, 5G, Phone, Phones, Mobile, Mobiles, SIM, Camera, Smartphone, Smartphones, Touchscreen, iOS, Fingerprint Scanner', 'Just the right amount of everything. Shoot 4K videos, beautiful portraits and sweeping landscapes with the all-new dual-camera system. Capture your best low-light photos with Night mode. See true-to-life colour in your photos, videos and games on the 6.1-inch Liquid Retina display. Experience unprecedented performance with A13. Bionic for gaming, augmented reality (AR) and photography. Do more and charge less with all-day battery life. \r\nWater and dust resistant (2 metres for up to 30 minutes, IP68). Face ID for secure authentication and Apple Pay. \r\nDual-camera system with 12MP Ultra Wide and Wide cameras, Night mode, Portrait mode, and 4K video up to 60 fps. 12MP TrueDepth front camera with Portrait mode, 4K video and slo-mo. \r\niOS 13 with Dark Mode, new tools for editing photos and video, and brand-new privacy features.', '2023-02-07 10:16:21', '2023-02-07 10:17:35'),
(11, 2, 'ASUS VivoBook 15 K513 15.6\" i5 16GB 512GB Laptop Silver', 'Stamp your style on the world with ASUS Vivobook 15, the feature-packed laptop that makes it easy to get things done, anywhere. Everything about Vivobook 15 is bold and improved, from its powerful i5 12th Gen Intel Core processor to its crisp and clear display, 180-degree lay-flat hinge and sleek geometric design. Make a fresh start today with Vivobook 15! \r\nGive your eyes a treat with Vivobook 15\'s clear, slim-bezel NanoEdge display (also available as an optional touchscreen). It has wide viewing angles, and is TUV Rheinland-certified for low blue-light levels, reducing the risk of eye strain during marathon viewing sessions.\r\nEach model in the new Vivobook series provides exceptional heat dissipation via two upgraded heat pipes and a new IceBlades fan that efficiently accelerates heat transfer. The 87-blade IceBlades fan and impeller are made of a liquid-crystal polymer that allows them to be lighter and thinner than ordinary fans. Each IceBlades fan blade has a 3D-curved aerodynamic design, allowing the fan to achieve better flow rate and lower noise. \r\nModel number: X1502ZA-BQ556W.', 1, '580.00', '550.00', 1, 1, '1675765480.webp', 'ASUS VivoBook 15 K513 15.6\" i5 16GB 512GB Laptop Silver', 'Laptop, Laptops, Camera, Touchscreen, Windows, Macbook, Macbooks, Foldable, SSD', 'Stamp your style on the world with ASUS Vivobook 15, the feature-packed laptop that makes it easy to get things done, anywhere. Everything about Vivobook 15 is bold and improved, from its powerful i5 12th Gen Intel Core processor to its crisp and clear display, 180-degree lay-flat hinge and sleek geometric design. Make a fresh start today with Vivobook 15! \r\nGive your eyes a treat with Vivobook 15\'s clear, slim-bezel NanoEdge display (also available as an optional touchscreen). It has wide viewing angles, and is TUV Rheinland-certified for low blue-light levels, reducing the risk of eye strain during marathon viewing sessions.\r\nEach model in the new Vivobook series provides exceptional heat dissipation via two upgraded heat pipes and a new IceBlades fan that efficiently accelerates heat transfer. The 87-blade IceBlades fan and impeller are made of a liquid-crystal polymer that allows them to be lighter and thinner than ordinary fans. Each IceBlades fan blade has a 3D-curved aerodynamic design, allowing the fan to achieve better flow rate and lower noise. \r\nModel number: X1502ZA-BQ556W.', '2023-02-07 10:24:40', '2023-04-15 02:03:29'),
(12, 3, 'LG 43LM6300 Smart HD LED Freeview 43\" TV', 'See a new level of Full-HD with Active HDR technology utilising Dynamic Colour and Virtual Surround Plus, experience film like never before. The state-of-the-art Quad Core Processor supports advanced picture processing for bright, sharp images. And with the ability to control your TV with Alexa and Google Assistant speakers*, you can truly set the scene at home for your favourite show with a single command. *Purchase required separately. \r\nEnjoy entertainment in stunning detail. Generating fives times the resolution of standard definition, Full HD 1080p delivers incredible clarity and vibrant colours. \r\nLG smart TV with webOS allows you to easily enjoy your favorite Netflix movies, YouTube videos, and much more. The new design and various features deliver smarter yet simpler viewing experiences. \r\nModel number: 43LM6300PLA.', 0, '270.00', '249.00', 1, 1, '1675765569.webp', 'LG 43LM6300 Smart HD LED Freeview 43\" TV', 'TV, Television, Satellite, Home, News, YouTube, Smart, Smart TV, Smart Television, HD, High Definition, 4K, High Resolution, Bluetooth', 'See a new level of Full-HD with Active HDR technology utilising Dynamic Colour and Virtual Surround Plus, experience film like never before. The state-of-the-art Quad Core Processor supports advanced picture processing for bright, sharp images. And with the ability to control your TV with Alexa and Google Assistant speakers*, you can truly set the scene at home for your favourite show with a single command. *Purchase required separately. \r\nEnjoy entertainment in stunning detail. Generating fives times the resolution of standard definition, Full HD 1080p delivers incredible clarity and vibrant colours. \r\nLG smart TV with webOS allows you to easily enjoy your favorite Netflix movies, YouTube videos, and much more. The new design and various features deliver smarter yet simpler viewing experiences. \r\nModel number: 43LM6300PLA.', '2023-02-07 10:26:09', '2023-04-15 02:03:19'),
(13, 3, 'Samsung 55\" UE55TU7020KXXU Smart 4K HDR LED TV', 'Experience dynamic crystal colour with this stunningly minimalist AirSlim TV from Samsung. There is 4K upscaling from any source, and HDR powered by HDR10+ which allows the picture to adapt to the brightness of your room. There is adaptive sound too, and Q-Symphony with selected Samsung soundbars (sold separately) which allows the TV and soundbar to work in harmony for a truly immersive experience. This smart TV is powered by Tizen so you can discover a huge collection of 4K films, TV shows, and all your catch-up TV apps. \r\nSamsung Crystal Processor 4K delivers dynamic crystal colour in over 1 billion shades that\'s 64 times more than a conventional 4K TV. More shades means more lifelike colour, and all in crystal clear 4K Ultra HD detail. \r\nMultiple voice assistants (Bixby, Alexa, and Google Assistant they\'re all built-in) allow you to change the volume, find that new series, bring up the photos from your holiday, or check on your connected devices in your smart home. The possibilities are endless all you have to do is ask. \r\nSamsung smart TV powered by Tizen provides easy access to the widest range of catch-up services and VoD services, including Netflix, Disney+, Apple TV, Now TV, and BT sport apps (subscriptions may be required). \r\nSamsung TV Plus provides instant access to loads of extra free TV channels, straight out of the box (all you need is an internet connection). There are movies, entertainment, sports, news and children\'s channels. No need for sign-ups, subscriptions or credit cards it\'s 100% free. \r\nModel number: UE55BU8000KXXU.', 1, '480.00', '449.00', 1, 1, '1675765698.webp', 'Samsung 55\" UE55TU7020KXXU Smart 4K HDR LED TV', 'TV, Television, Satellite, Home, News, YouTube, Smart, Smart TV, Smart Television, HD, High Definition, 4K, High Resolution, Bluetooth', 'Experience dynamic crystal colour with this stunningly minimalist AirSlim TV from Samsung. There is 4K upscaling from any source, and HDR powered by HDR10+ which allows the picture to adapt to the brightness of your room. There is adaptive sound too, and Q-Symphony with selected Samsung soundbars (sold separately) which allows the TV and soundbar to work in harmony for a truly immersive experience. This smart TV is powered by Tizen so you can discover a huge collection of 4K films, TV shows, and all your catch-up TV apps. \r\nSamsung Crystal Processor 4K delivers dynamic crystal colour in over 1 billion shades that\'s 64 times more than a conventional 4K TV. More shades means more lifelike colour, and all in crystal clear 4K Ultra HD detail. \r\nMultiple voice assistants (Bixby, Alexa, and Google Assistant they\'re all built-in) allow you to change the volume, find that new series, bring up the photos from your holiday, or check on your connected devices in your smart home. The possibilities are endless all you have to do is ask. \r\nSamsung smart TV powered by Tizen provides easy access to the widest range of catch-up services and VoD services, including Netflix, Disney+, Apple TV, Now TV, and BT sport apps (subscriptions may be required). \r\nSamsung TV Plus provides instant access to loads of extra free TV channels, straight out of the box (all you need is an internet connection). There are movies, entertainment, sports, news and children\'s channels. No need for sign-ups, subscriptions or credit cards it\'s 100% free. \r\nModel number: UE55BU8000KXXU.', '2023-02-07 10:28:18', '2023-04-15 02:20:17'),
(14, 1, 'Samsung S7 Edge 32GB 4GB Black', 'Equipped with impressive features and decent specifications, the Samsung Galaxy S7 Edge is a perfect choice. The phone offers a slip-free grip as it is light in weight and is easy to carry.\r\nThis stylish handset from Samsung comes with a 5.5 inches (13.97 cm) display that has a resolution of 1440 x 2560 pixels offering immersive and comfortable viewing.\r\nThe camera specifications of the mobile are really impressive and remarkable that let you capture high-resolution images and videos. Features on the rear camera setup include Digital Zoom, Auto Flash, Digital image stabilization, Face detection, Smile detection, Touch to focus. On the front, the mobile features a 5 MP camera for clicking beautiful selfies and making video calls.\r\nYou can enjoy speed and lots of storage space as the phone comes with 4 GB of RAM and 32 GB of internal storage so that you can store all your songs, videos, games, and other stuff with the utmost convenience. In addition to this, you can play games, listen to music, multitask, and stream content smoothly as the phone is powered with Octa core (2.3 GHz, Quad core, M1 Mongoose + 1.6 GHz, Quad core, Cortex A53) Samsung Exynos 8 Octa 8890 processor.\r\nVarious connectivity options on the Samsung Galaxy S7 Edge include WiFi, Mobile Hotspot, Bluetooth, 3G, 2G. Sensors on the phone include Light sensor, Proximity sensor, Accelerometer, Barometer, Compass, Gyroscope. It houses a 3600 mAh Li-ion battery that offers you a long-lasting entertainment without worrying about battery drainage.\r\nModel number: SM-G935FZKABTU.', 1, '300.00', '279.00', 1, 1, '1675766926.webp', 'Samsung S7 Edge 32GB 4GB Black', 'Samung, Samung Galaxy, Samsung Phone, Samsung Galaxy Phone, 5G, Phone, Phones, Mobile, Mobiles, SIM, Camera, Smartphone, Smartphones, Touchscreen, Android, iOS, Fingerprint Scanner', 'Equipped with impressive features and decent specifications, the Samsung Galaxy S7 Edge is a perfect choice. The phone offers a slip-free grip as it is light in weight and is easy to carry.\r\nThis stylish handset from Samsung comes with a 5.5 inches (13.97 cm) display that has a resolution of 1440 x 2560 pixels offering immersive and comfortable viewing.\r\nThe camera specifications of the mobile are really impressive and remarkable that let you capture high-resolution images and videos. Features on the rear camera setup include Digital Zoom, Auto Flash, Digital image stabilization, Face detection, Smile detection, Touch to focus. On the front, the mobile features a 5 MP camera for clicking beautiful selfies and making video calls.\r\nYou can enjoy speed and lots of storage space as the phone comes with 4 GB of RAM and 32 GB of internal storage so that you can store all your songs, videos, games, and other stuff with the utmost convenience. In addition to this, you can play games, listen to music, multitask, and stream content smoothly as the phone is powered with Octa core (2.3 GHz, Quad core, M1 Mongoose + 1.6 GHz, Quad core, Cortex A53) Samsung Exynos 8 Octa 8890 processor.\r\nVarious connectivity options on the Samsung Galaxy S7 Edge include WiFi, Mobile Hotspot, Bluetooth, 3G, 2G. Sensors on the phone include Light sensor, Proximity sensor, Accelerometer, Barometer, Compass, Gyroscope. It houses a 3600 mAh Li-ion battery that offers you a long-lasting entertainment without worrying about battery drainage.\r\nModel number: SM-G935FZKABTU.', '2023-02-07 10:48:46', '2023-04-15 02:03:09'),
(16, 1, 'Motorola G22 64GB Cosmic Black', 'See your vision come to life with Moto G22. Go capture every moment brilliantly with a 50MP quad camera system. View everything on a fluid, ultra-wide 6.5-inch 90 Hz Max Vision display. Go for style and substance with a sleek, stylish design. Get more done with Android 12 and go further with a long-lasting 5000 mAh battery. So go see what\'s possible. Go Moto G. \r\nCapture sharper low-light images, ultra-wide angle shots, professional-looking portraits, and incredibly detailed close-ups. The 50 MP sensor combines 4 pixels into 1, for an effective photo resolution of 12.5 MP. \r\nBring games, films, and video chats to life on a fluid, ultra-wide screen. \r\nEnjoy a slim design with a premium finish, crafted from durable materials. \r\nIn control with Android 12. Get more done with more control and a totally reimagined UI. Android is a trademark of Google LLC. \r\nModel number: PATW0012GB.', 0, '180.00', '170.00', 1, 1, '1675767435.webp', 'Motorola G22 64GB Cosmic Black', 'Motorola, Motorola Phone, 5G, Phone, Phones, Mobile, Mobiles, SIM, Camera, Smartphone, Smartphones, Touchscreen, Android, iOS, Fingerprint Scanner', 'See your vision come to life with Moto G22. Go capture every moment brilliantly with a 50MP quad camera system. View everything on a fluid, ultra-wide 6.5-inch 90 Hz Max Vision display. Go for style and substance with a sleek, stylish design. Get more done with Android 12 and go further with a long-lasting 5000 mAh battery. So go see what\'s possible. Go Moto G. \r\nCapture sharper low-light images, ultra-wide angle shots, professional-looking portraits, and incredibly detailed close-ups. The 50 MP sensor combines 4 pixels into 1, for an effective photo resolution of 12.5 MP. \r\nBring games, films, and video chats to life on a fluid, ultra-wide screen. \r\nEnjoy a slim design with a premium finish, crafted from durable materials. \r\nIn control with Android 12. Get more done with more control and a totally reimagined UI. Android is a trademark of Google LLC. \r\nModel number: PATW0012GB.', '2023-02-07 10:57:15', '2023-04-15 02:20:28'),
(17, 1, 'iPhone 14 Pro Max 5G 256GB Space Black', 'iPhone 14 Pro Max. Pro. Beyond. All Systems Pro. Capture incredible detail with a 48MP main camera. Experience iPhone in a whole new way with Dynamic Island and Always-On display. Introducing Dynamic Island, a truly Apple innovation that\'s hardware and software and something in between. It bubbles up music, FaceTime and so much more - all without taking you away from what you\'re doing. A16 Bionic, the ultimate smartphone chip. Superfast 5G cellular. \r\n6.7-inch Super Retina XDR display featuring Always-On and ProMotion. 48MP main camera for up to 4x greater resolution. Use Cinematic mode now in 4K Dolby Vision up to 30 fps and Action mode for smooth, steady handheld videos. \r\nVital safety technology - Crash Detection calls for help when you can\'t. iPhone 14 Pro Max can detect a serious car crash, then call 999 and notify your emergency contacts. \r\niOS 16 offers even more ways to personalise, communicate and share. Customise your Lock Screen in fun new ways. Layer a photo to make it pop. Track your Activity rings. And see live updates from your favourite apps. \r\nWhat\'s in the box - iPhone with iOS 16, USB-C to Lightning Cable & Documentation. \r\nModel number: MQ9P3ZD/A.', 8, '1350.00', '1309.00', 1, 1, '1675767544.webp', 'iPhone 14 Pro Max 5G 256GB Space Black', 'iPhone, iPhone Device, Apple Phone, Apple Device, 5G, Phone, Phones, Mobile, Mobiles, SIM, Camera, Smartphone, Smartphones, Touchscreen, iOS, Fingerprint Scanner', 'iPhone 14 Pro Max. Pro. Beyond. All Systems Pro. Capture incredible detail with a 48MP main camera. Experience iPhone in a whole new way with Dynamic Island and Always-On display. Introducing Dynamic Island, a truly Apple innovation that\'s hardware and software and something in between. It bubbles up music, FaceTime and so much more - all without taking you away from what you\'re doing. A16 Bionic, the ultimate smartphone chip. Superfast 5G cellular. \r\n6.7-inch Super Retina XDR display featuring Always-On and ProMotion. 48MP main camera for up to 4x greater resolution. Use Cinematic mode now in 4K Dolby Vision up to 30 fps and Action mode for smooth, steady handheld videos. \r\nVital safety technology - Crash Detection calls for help when you can\'t. iPhone 14 Pro Max can detect a serious car crash, then call 999 and notify your emergency contacts. \r\niOS 16 offers even more ways to personalise, communicate and share. Customise your Lock Screen in fun new ways. Layer a photo to make it pop. Track your Activity rings. And see live updates from your favourite apps. \r\nWhat\'s in the box - iPhone with iOS 16, USB-C to Lightning Cable & Documentation. \r\nModel number: MQ9P3ZD/A.', '2023-02-07 10:59:04', '2023-02-24 20:04:32'),
(18, 3, 'Samsung 40\" UE40T5300 Smart HD TV', 'Enjoy crisp and clear Full HD picture quality with HDR. Samsung Hyper Real Engine ensures vibrant images that bring every moment to life. \r\nA slim TV with a very narrow bezel designed to look elegant from any angle, giving you less TV and more picture. \r\nSamsung TV Plus provides instant access to loads of extra free TV channels, straight out of the box (all you need is an internet connection). There are movies, entertainment, sports, news and children\'s channels. No need for sign-ups, subscriptions or credit cards – it\'s 100% free. \r\nModel number: UE40T5300AKXXU.', 1, '290.00', '279.00', 1, 1, '1675772037.webp', 'Samsung 40\" UE40T5300 Smart HD TV', 'TV, Television, Satellite, Home, News, YouTube, Smart, Smart TV, Smart Television, HD, High Definition, 4K, High Resolution, Bluetooth', 'Enjoy crisp and clear Full HD picture quality with HDR. Samsung Hyper Real Engine ensures vibrant images that bring every moment to life. \r\nA slim TV with a very narrow bezel designed to look elegant from any angle, giving you less TV and more picture. \r\nSamsung TV Plus provides instant access to loads of extra free TV channels, straight out of the box (all you need is an internet connection). There are movies, entertainment, sports, news and children\'s channels. No need for sign-ups, subscriptions or credit cards – it\'s 100% free. \r\nModel number: UE40T5300AKXXU.', '2023-02-07 12:13:57', '2023-02-07 12:13:57'),
(19, 1, 'Samsung Galaxy A53 5G 128GB Blue', 'With a buzzing social and school life, you need a phone that can tackle whatever life throws at you. From finishing coursework, to snapping the perfect social media pictures, Samsung Galaxy A53 5G have got everything you need. Smooth scrolling on large, immersive FHD+ screens. Amazing cameras and editing features, made for those who never want to miss a thing. Wherever you go with Galaxy A53 5G, its immersive sound takes everything you stream to another level. \r\nThe phone has super smooth screen - one smooth operator, one big screen. Watching movies, gaming, scrolling social media, everything is just so smooth. \r\nIt comes with four ultimate cameras which gives you the power to express yourself in every moment. Have a play, capture photos and videos beautifully and share your world like never before. \r\nA powerful and long-lasting battery that keeps you streaming, chatting and playing. And Galaxy A53 5G automatically saves power on your down-time. \r\nWith IP67 grade water and dust resistance, this phone can handle spills and those caught-in-the-rain moments with ease. With Galaxy A53 5G by your side, you have the freedom to vlog and game on the go, even in a pool. Create awesome content, capture it all safely. \r\nModel number: SM-A536BLBNEUB.', 5, '420.00', '399.00', 1, 1, '1675772111.webp', 'Samsung Galaxy A53 5G 128GB Blue', 'Samung, Samung Galaxy, Samsung Phone, Samsung Galaxy Phone, 5G, Phone, Phones, Mobile, Mobiles, SIM, Camera, Smartphone, Smartphones, Touchscreen, Android, iOS, Fingerprint Scanner', 'With a buzzing social and school life, you need a phone that can tackle whatever life throws at you. From finishing coursework, to snapping the perfect social media pictures, Samsung Galaxy A53 5G have got everything you need. Smooth scrolling on large, immersive FHD+ screens. Amazing cameras and editing features, made for those who never want to miss a thing. Wherever you go with Galaxy A53 5G, its immersive sound takes everything you stream to another level. \r\nThe phone has super smooth screen - one smooth operator, one big screen. Watching movies, gaming, scrolling social media, everything is just so smooth. \r\nIt comes with four ultimate cameras which gives you the power to express yourself in every moment. Have a play, capture photos and videos beautifully and share your world like never before. \r\nA powerful and long-lasting battery that keeps you streaming, chatting and playing. And Galaxy A53 5G automatically saves power on your down-time. \r\nWith IP67 grade water and dust resistance, this phone can handle spills and those caught-in-the-rain moments with ease. With Galaxy A53 5G by your side, you have the freedom to vlog and game on the go, even in a pool. Create awesome content, capture it all safely. \r\nModel number: SM-A536BLBNEUB.', '2023-02-07 12:15:11', '2023-02-19 09:26:00'),
(20, 1, 'iPhone 13 5G 128GB Pink', 'Your new superpower. All-out standout. The iPhone 13 features the most advanced dual-camera system ever on an iPhone. The colourful, sharper and brighter 6.1-inch Super Retina XDR display and durable flat-edge design with Ceramic Shield. A15 Bionic chip, the world\'s fastest smartphone chip for lightning-fast performance. A big leap in battery life. \r\nThe iOS 15 packs new features to do more with iPhone than ever before. 5G for superfast downloads and high-quality streaming for up to 19 hours of video playback. Supports MagSafe accessories for easy attach and faster wireless charging. \r\nIncredible advanced dual-camera system with 12MP Wide and Ultra Wide cameras. Photographic Styles, Smart HDR 4, Night mode & 4K Dolby Vision HDR recording. \r\nThe new Cinematic mode adds shallow depth of field and shifts focus automatically in your videos. 12MP TrueDepth front camera with Night mode and 4K Dolby Vision HDR recording for sharper, more detailed photos and videos. \r\nWhat\'s in the box - iPhone with iOS 15, USB-C to Lightning Cable & Documentation. \r\nModel number: MLPF3B/A.', 14, '720.00', '699.00', 1, 1, '1675772273.webp', 'iPhone 13 5G 128GB Pink', 'iPhone, iPhone Device, Apple Phone, Apple Device, 5G, Phone, Phones, Mobile, Mobiles, SIM, Camera, Smartphone, Smartphones, Touchscreen, iOS, Fingerprint Scanner', 'Your new superpower. All-out standout. The iPhone 13 features the most advanced dual-camera system ever on an iPhone. The colourful, sharper and brighter 6.1-inch Super Retina XDR display and durable flat-edge design with Ceramic Shield. A15 Bionic chip, the world\'s fastest smartphone chip for lightning-fast performance. A big leap in battery life. \r\nThe iOS 15 packs new features to do more with iPhone than ever before. 5G for superfast downloads and high-quality streaming for up to 19 hours of video playback. Supports MagSafe accessories for easy attach and faster wireless charging. \r\nIncredible advanced dual-camera system with 12MP Wide and Ultra Wide cameras. Photographic Styles, Smart HDR 4, Night mode & 4K Dolby Vision HDR recording. \r\nThe new Cinematic mode adds shallow depth of field and shifts focus automatically in your videos. 12MP TrueDepth front camera with Night mode and 4K Dolby Vision HDR recording for sharper, more detailed photos and videos. \r\nWhat\'s in the box - iPhone with iOS 15, USB-C to Lightning Cable & Documentation. \r\nModel number: MLPF3B/A.', '2023-02-07 12:17:53', '2023-02-24 20:04:46'),
(21, 2, 'ASUS ZenBook 14 UX4252 i5 8GB 256GB 14\" Laptop', 'With the beautiful new ZenBook 14 in a sleek grey colour you can be even more portable than ever before. It\'s thinner, lighter and incredibly compact, yet includes HDMI, Thunderbolt 3 USB-C, USB Type-A and a microSD card reader for unrivalled versatility. Built to deliver powerful performance, ZenBook 14 is your perfect choice for an effortless on-the-go lifestyle. Includes Windows 11 Home. \r\nWith ZenBook 14\'s amazing 22-hour battery life traveling without a charger isn\'t a big deal. When you do need to top up its fast-charge feature can restore the battery to a 60 percent charge level in just 49 minutes, so you\'ll be ready to go in no time. \r\nWe have introduced the new edge to edge keyboard design. It makes space for a whole row of extra function keys on the right side of the layout which helps to improve productivity. We have also included the intelligent touchpad which switches between Numberpad and a traditional touchpad. NumberPad is best for helping boost productivity and for those who need to crunch numbers on a daily basis. \r\nModel number: UX425EA-KI691W.', 6, '550.00', '499.00', 1, 1, '1675772347.webp', 'ASUS ZenBook 14 UX4252 i5 8GB 256GB 14\" Laptop', 'Laptop, Laptops, Camera, Touchscreen, Windows, Macbook, Macbooks, Foldable, SSD', 'With the beautiful new ZenBook 14 in a sleek grey colour you can be even more portable than ever before. It\'s thinner, lighter and incredibly compact, yet includes HDMI, Thunderbolt 3 USB-C, USB Type-A and a microSD card reader for unrivalled versatility. Built to deliver powerful performance, ZenBook 14 is your perfect choice for an effortless on-the-go lifestyle. Includes Windows 11 Home. \r\nWith ZenBook 14\'s amazing 22-hour battery life traveling without a charger isn\'t a big deal. When you do need to top up its fast-charge feature can restore the battery to a 60 percent charge level in just 49 minutes, so you\'ll be ready to go in no time. \r\nWe have introduced the new edge to edge keyboard design. It makes space for a whole row of extra function keys on the right side of the layout which helps to improve productivity. We have also included the intelligent touchpad which switches between Numberpad and a traditional touchpad. NumberPad is best for helping boost productivity and for those who need to crunch numbers on a daily basis. \r\nModel number: UX425EA-KI691W.', '2023-02-07 12:19:07', '2023-04-03 09:25:12'),
(22, 2, 'Apple MacBook Pro 2022 13in M2 8GB 512GB - Space Grey', 'MacBook Pro. Ready. Set. Pro. The MacBook Pro is more capable than ever. Supercharged by the next-generation M2 chip, it\'s Apple\'s most portable pro laptop. The M2 chip begins the next generation of Apple silicon, with even more of the speed and power efficiency introduced by M1. Rip through intense workflows with faster 8-core CPU and 10-core GPU. Superfast SSD storage launches apps and opens files in an instant.\r\nPro anywhere. With the brilliant 13-inch Retina display with 500 nits of brightness, images take on an incredible level of detail and realism. MacBook Pro features True Tone technology, so the white balance automatically adjusts to match the colour temperature of the light around you — for a more natural viewing experience. FaceTime HD camera with advanced image signal processor so you\'ll look great in video calls. Studio-quality three-microphone array captures your voice more clearly.\r\nMacOS Monterey lets you connect, share, and create like never before across all your Apple. Go all day with up to 20 hours of battery life and an active cooling system to sustain enhanced performance. Backlit Magic Keyboard and Touch ID for secure unlock and payments. Two Thunderbolt ports for charging and accessories. ', 6, '1450.00', '1429.00', 1, 1, '1675777224.webp', 'Apple MacBook Pro 2022 13\" M2 8GB 512GB Space Grey', 'Laptop, Laptops, Camera, Touchscreen, Windows, Macbook, Macbooks, Foldable, SSD', 'MacBook Pro. Ready. Set. Pro. The MacBook Pro is more capable than ever. Supercharged by the next-generation M2 chip, it\'s Apple\'s most portable pro laptop. The M2 chip begins the next generation of Apple silicon, with even more of the speed and power efficiency introduced by M1. Rip through intense workflows with faster 8-core CPU and 10-core GPU. Superfast SSD storage launches apps and opens files in an instant.\r\nPro anywhere. With the brilliant 13-inch Retina display with 500 nits of brightness, images take on an incredible level of detail and realism. MacBook Pro features True Tone technology, so the white balance automatically adjusts to match the colour temperature of the light around you — for a more natural viewing experience. FaceTime HD camera with advanced image signal processor so you\'ll look great in video calls. Studio-quality three-microphone array captures your voice more clearly.\r\nMacOS Monterey lets you connect, share, and create like never before across all your Apple. Go all day with up to 20 hours of battery life and an active cooling system to sustain enhanced performance. Backlit Magic Keyboard and Touch ID for secure unlock and payments. Two Thunderbolt ports for charging and accessories. ', '2023-02-07 13:40:24', '2023-02-24 20:04:59'),
(23, 5, 'Apple iPad 2021 10.2 Inch Wi-Fi 64GB - Space Grey', 'Powerful. Easy to use. Versatile. The new iPad has a beautiful 10.2-inch Retina display with True Tone, powerful A13 Bionic chip with Neural Engine, an Ultra Wide front camera with Centre Stage, and works with Apple Pencil (1st generation) and the Smart Keyboard. iPad lets you do more, more easily. All for an incredible price.\r\nDelightfully capable. Surprisingly affordable. Unbelievably capable. Unmistakably iPad. More function and more fun. Yes, iPad does that. And more. The iPadOS 15 is uniquely powerful, easy to use, and designed for the versatility of iPad. It comes with 8MP Wide back camera and up to 256GB storage. Amazing stereo speakers and Touch ID for secure authentication and Apple Pay. Also includes lightning connector for charging and accessories. ', 1, '319.00', '300.00', 1, 1, '1675959809.webp', 'Apple iPad 2021 10.2 Inch Wi-Fi 64GB - Space Grey', 'apple', 'Powerful. Easy to use. Versatile. The new iPad has a beautiful 10.2-inch Retina display with True Tone, powerful A13 Bionic chip with Neural Engine, an Ultra Wide front camera with Centre Stage, and works with Apple Pencil (1st generation) and the Smart Keyboard. iPad lets you do more, more easily. All for an incredible price.\r\nDelightfully capable. Surprisingly affordable. Unbelievably capable. Unmistakably iPad. More function and more fun. Yes, iPad does that. And more. The iPadOS 15 is uniquely powerful, easy to use, and designed for the versatility of iPad. It comes with 8MP Wide back camera and up to 256GB storage. Amazing stereo speakers and Touch ID for secure authentication and Apple Pay. Also includes lightning connector for charging and accessories. ', '2023-02-09 16:23:29', '2023-02-10 00:19:18'),
(24, 1, 'Samsung Galaxy S23 Ultra 5G 512GB - Black', 'Your Galaxy, your way. The Samsung Galaxy S23 Series boasts a fresh look, both outside and in. The new and improved One UI 5.1 lets you customise your whole experience. From lock screen and wallpaper designs to how the clock and notification bar appear. You can even manage how notifications appear and assign full-screen GIFs to your favourite contacts, so they begin looping with incoming calls. All the core Samsung apps have had a facelife too, for a fresh look throughout. More personalised options to suit every taste, now built in as standard.\r\n\r\nDo you love capturing photos and videos after dark? With the Galaxy S23 Ultra, you\'ll love it so much more. The quad-lens setup boasts a head-spinning 200MP Ultra High-Resolution Rear Camera, for unprecedented detail in every picture. When it comes to shooting in low-light conditions, the latest version of Nightography boosts colours and sharpens details – and now it\'s even built into the 12MP Dual Pixel Front-Facing Selfie Camera.\r\n\r\nGalaxy S23 Ultra is the ultimate smartphone, with a 6.8-inch display with standout brightness and adaptive Vision Booster technology that automatically adjusts to suit your environment. So, whether you\'re in the bright morning sun, a low-lit cafe, or travelling in and out of tunnels on the train, you\'ll always have a quality, distraction-free viewing experience.\r\n\r\nWhether it\'s work, play or somewhere in between, your always-on world should run smoothly. Enter Qualcomm Snapdragon 8 Gen 2 Processor. The latest iteration promises dynamic gaming, with an improved CPU, GPU and cooling system (compared against the Galaxy S22 Series). So even the most demanding online multiplayer marathons will feel like a breeze. Galaxy S23 Ultra puts the power of an editing suite in the palm of your hand. And S Pen lets you edit the smallest details with absolute precision.\r\n\r\nProfessional creators don\'t retouch their photos and videos with their fingers, and nor should you. Leave the world of pinching and prodding behind, and go pro, with our latest S Pen. The fine nib lets you create complex selections in your photos and trim videos with extreme accuracy. And when you need to get in the frame too, control the camera shutter and timer remotely, using S Pen\'s button, connected to the handset via Bluetooth.\r\n\r\nModel number: SM-S918B. ', 7, '1399.00', '1349.00', 1, 1, '1679828893.webp', 'Samsung Galaxy S23 Ultra 5G 512GB Phone - Black', 'Samung, Samung Galaxy, Samsung Phone, Samsung Galaxy Phone, Samsung A53, 5G, Phone, Phones, Mobile, Mobiles, SIM, Camera, Smartphone, Smartphones, Touchscreen, Android, iOS, Fingerprint Scanner', 'Your Galaxy, your way. The Samsung Galaxy S23 Series boasts a fresh look, both outside and in. The new and improved One UI 5.1 lets you customise your whole experience. From lock screen and wallpaper designs to how the clock and notification bar appear. You can even manage how notifications appear and assign full-screen GIFs to your favourite contacts, so they begin looping with incoming calls. All the core Samsung apps have had a facelife too, for a fresh look throughout. More personalised options to suit every taste, now built in as standard.\r\n\r\nDo you love capturing photos and videos after dark? With the Galaxy S23 Ultra, you\'ll love it so much more. The quad-lens setup boasts a head-spinning 200MP Ultra High-Resolution Rear Camera, for unprecedented detail in every picture. When it comes to shooting in low-light conditions, the latest version of Nightography boosts colours and sharpens details – and now it\'s even built into the 12MP Dual Pixel Front-Facing Selfie Camera.\r\n\r\nGalaxy S23 Ultra is the ultimate smartphone, with a 6.8-inch display with standout brightness and adaptive Vision Booster technology that automatically adjusts to suit your environment. So, whether you\'re in the bright morning sun, a low-lit cafe, or travelling in and out of tunnels on the train, you\'ll always have a quality, distraction-free viewing experience.\r\n\r\nWhether it\'s work, play or somewhere in between, your always-on world should run smoothly. Enter Qualcomm Snapdragon 8 Gen 2 Processor. The latest iteration promises dynamic gaming, with an improved CPU, GPU and cooling system (compared against the Galaxy S22 Series). So even the most demanding online multiplayer marathons will feel like a breeze. Galaxy S23 Ultra puts the power of an editing suite in the palm of your hand. And S Pen lets you edit the smallest details with absolute precision.\r\n\r\nProfessional creators don\'t retouch their photos and videos with their fingers, and nor should you. Leave the world of pinching and prodding behind, and go pro, with our latest S Pen. The fine nib lets you create complex selections in your photos and trim videos with extreme accuracy. And when you need to get in the frame too, control the camera shutter and timer remotely, using S Pen\'s button, connected to the handset via Bluetooth.\r\n\r\nModel number: SM-S918B. ', '2023-03-26 12:08:13', '2023-04-15 02:24:53'),
(25, 5, 'Samsung Galaxy Tab S8 11in 128GB Wi-Fi Tablet - Graphite', 'Introducing Samsung Galaxy Tab S8 Series. The ultimate tablet, with the fastest processor ever put in a Galaxy Tab, giving users the power to do more.\r\n\r\nMulti-taskers take note - Whatever you want to do, do even more of it with Galaxy Tab S8. Open up to three apps side-by-side with Multi Window then make notes or get creative with S Pen. It\'s the ultimate in productivity.\r\nModel number: S8. ', 6, '749.00', '720.00', 1, 1, '1681521277.webp', 'Samsung Galaxy Tab S8 11in 128GB Wi-Fi Tablet - Graphite', 'Tablets', 'Introducing Samsung Galaxy Tab S8 Series. The ultimate tablet, with the fastest processor ever put in a Galaxy Tab, giving users the power to do more.\r\n\r\nMulti-taskers take note - Whatever you want to do, do even more of it with Galaxy Tab S8. Open up to three apps side-by-side with Multi Window then make notes or get creative with S Pen. It\'s the ultimate in productivity.\r\nModel number: S8. ', '2023-04-15 02:14:37', '2023-04-15 15:51:26'),
(26, 5, 'Lenovo Tab P11 11.5 Inch 128GB Wi-Fi Tablet - Grey', 'Whether you\'re Netflix binge-watching, surfing, or taking notes, the new Lenovo Tab P11 elevates your experiences with first-class perks. Watch your favourite shows all day on an expansive 11.5-inch 2K cinematic display, surrounded with flowing, moving audio.\r\n\r\nCinematic moving audio: Smart stereo with a quad-speaker system and Dolby Atmos. All-day battery life: Up to 10 hours of video playback with 7700mAh battery capacity.\r\nDo more things at once. Work on two apps simultaneously with the split-screen mode on Android 12L. Keep your multi-tasking fluid with up to 120Hz refresh rate. Model number: ZABF0032GB. ', 4, '239.99', '220.00', 1, 1, '1681521518.webp', 'Lenovo Tab P11 11.5 Inch 128GB Wi-Fi Tablet - Grey', 'Tablets', 'Whether you\'re Netflix binge-watching, surfing, or taking notes, the new Lenovo Tab P11 elevates your experiences with first-class perks. Watch your favourite shows all day on an expansive 11.5-inch 2K cinematic display, surrounded with flowing, moving audio.\r\n\r\nCinematic moving audio: Smart stereo with a quad-speaker system and Dolby Atmos. All-day battery life: Up to 10 hours of video playback with 7700mAh battery capacity.\r\nDo more things at once. Work on two apps simultaneously with the split-screen mode on Android 12L. Keep your multi-tasking fluid with up to 120Hz refresh rate. Model number: ZABF0032GB. ', '2023-04-15 02:18:38', '2023-04-15 15:53:32'),
(27, 5, 'Samsung Galaxy Tab S7 FE 12.4 Inch 128GB Wi-Fi Tablet Black', 'Powered for fast Wi-Fi connectivity, Samsung\'s Galaxy Tab S7 FE has cinematic mode, Dolby Atmos sound, long-lasting battery, and includes S Pen. Fast Wi-Fi connectivity wherever you base your work or play, and an improved S Pen for real-time handwriting or drawing, Galaxy Tab S7 FE changes the game. Great download times and low latency keeps your connection always strong, eliminating lags. Not forgetting, the Snapdragon 750G chipset is ideal for gaming, providing smooth speeds. Model number: SM-T733N.', 5, '619.00', '600.00', 1, 0, '1681521569.webp', 'Samsung Galaxy Tab S7 FE 12.4 Inch 128GB Wi-Fi Tablet Black', 'Tablets', 'Powered for fast Wi-Fi connectivity, Samsung\'s Galaxy Tab S7 FE has cinematic mode, Dolby Atmos sound, long-lasting battery, and includes S Pen. Fast Wi-Fi connectivity wherever you base your work or play, and an improved S Pen for real-time handwriting or drawing, Galaxy Tab S7 FE changes the game. Great download times and low latency keeps your connection always strong, eliminating lags. Not forgetting, the Snapdragon 750G chipset is ideal for gaming, providing smooth speeds. Model number: SM-T733N.', '2023-04-15 02:19:29', '2023-04-15 15:54:25');
INSERT INTO `products` (`ProductID`, `CategoryID`, `ProductName`, `ProductDescription`, `ProductQuantity`, `RetailPrice`, `SellingPrice`, `ProductVisibility`, `ProductPopular`, `ProductImage`, `MetaTitle`, `MetaKeywords`, `MetaDescription`, `DateOfCreation`, `DateOfUpdate`) VALUES
(28, 1, 'iPhone 14 Pro Max 5G 128GB Mobile Phone Deep Purple', 'Phone 14 Pro Max. Pro. Beyond. All Systems Pro. Capture incredible detail with a 48MP main camera. Experience iPhone in a whole new way with Dynamic Island and Always-On display. Introducing Dynamic Island, a truly Apple innovation that\'s hardware and software and something in between. It bubbles up music, FaceTime and so much more - all without taking you away from what you\'re doing. A16 Bionic, the ultimate smartphone chip. Superfast 5G cellular.\r\n\r\n6.7-inch Super Retina XDR display featuring Always-On and ProMotion. 48MP main camera for up to 4x greater resolution. Use Cinematic mode now in 4K Dolby Vision up to 30 fps and Action mode for smooth, steady handheld videos.\r\n\r\nVital safety technology - Crash Detection calls for help when you can\'t. iPhone 14 Pro Max can detect a serious car crash, then call 999 and notify your emergency contacts.\r\n\r\niOS 16 offers even more ways to personalise, communicate and share. Customise your Lock Screen in fun new ways. Layer a photo to make it pop. Track your Activity rings. And see live updates from your favourite apps.\r\n\r\nWhat\'s in the box - iPhone with iOS 16, USB-C to Lightning Cable and Documentation.\r\n\r\nModel number: MQ9T3ZD/A.', 4, '1139.00', '1120.00', 1, 1, '1681569607.webp', 'iPhone 14 Pro Max 5G 128GB Mobile Phone Deep Purple', 'phones', 'Phone 14 Pro Max. Pro. Beyond. All Systems Pro. Capture incredible detail with a 48MP main camera. Experience iPhone in a whole new way with Dynamic Island and Always-On display. Introducing Dynamic Island, a truly Apple innovation that\'s hardware and software and something in between. It bubbles up music, FaceTime and so much more - all without taking you away from what you\'re doing. A16 Bionic, the ultimate smartphone chip. Superfast 5G cellular.\r\n\r\n6.7-inch Super Retina XDR display featuring Always-On and ProMotion. 48MP main camera for up to 4x greater resolution. Use Cinematic mode now in 4K Dolby Vision up to 30 fps and Action mode for smooth, steady handheld videos.\r\n\r\nVital safety technology - Crash Detection calls for help when you can\'t. iPhone 14 Pro Max can detect a serious car crash, then call 999 and notify your emergency contacts.\r\n\r\niOS 16 offers even more ways to personalise, communicate and share. Customise your Lock Screen in fun new ways. Layer a photo to make it pop. Track your Activity rings. And see live updates from your favourite apps.\r\n\r\nWhat\'s in the box - iPhone with iOS 16, USB-C to Lightning Cable and Documentation.\r\n\r\nModel number: MQ9T3ZD/A.', '2023-04-15 15:40:07', '2023-04-15 15:53:49'),
(30, 1, 'Google Pixel 7 5G 128GB Mobile Phone - Obsidian', 'Meet the all-new Google Pixel 7 smart phone. Powered by Google Tensor G2, it\'s fast and secure, with a 72-hour battery life and the advanced Pixel Camera. Take beautifully authentic, accurate photos with Real Tone and stunning videos with Cinematic Blur. And with the certified Titan M2 security chip and a built-in VPN, Pixel helps protect your personal data.\r\n\r\nPowered by Google Tensor: Designed by Google just for Pixel, the Google Tensor chip makes Pixel fast, smart and secure.\r\n\r\nMakes every photo your best photo: Pixel\'s advanced camera can deblur faces with Face Unblur and make distractions disappear with Magic Eraser.\r\n\r\nSafe and Secure: The Google Tensor security core and the Titan M2 chip help make Pixel more resilient to attacks.\r\n\r\nSwitching is simple: Move messages, contacts and photos in a few quick steps.\r\n\r\nModel number: GVU6C.', 4, '599.00', '560.00', 1, 0, '1681569771.webp', 'Google Pixel 7 5G 128GB Mobile Phone - Obsidian', 'Phones', 'Meet the all-new Google Pixel 7 smart phone. Powered by Google Tensor G2, it\'s fast and secure, with a 72-hour battery life and the advanced Pixel Camera. Take beautifully authentic, accurate photos with Real Tone and stunning videos with Cinematic Blur. And with the certified Titan M2 security chip and a built-in VPN, Pixel helps protect your personal data.\r\n\r\nPowered by Google Tensor: Designed by Google just for Pixel, the Google Tensor chip makes Pixel fast, smart and secure.\r\n\r\nMakes every photo your best photo: Pixel\'s advanced camera can deblur faces with Face Unblur and make distractions disappear with Magic Eraser.\r\n\r\nSafe and Secure: The Google Tensor security core and the Titan M2 chip help make Pixel more resilient to attacks.\r\n\r\nSwitching is simple: Move messages, contacts and photos in a few quick steps.\r\n\r\nModel number: GVU6C.', '2023-04-15 15:42:51', '2023-04-15 15:54:55'),
(31, 1, 'Samsung Galaxy S21 FE 5G 128GB Phone - Graphite', 'When it comes to making every single day count, you need the right kit. Meet Samsung Galaxy S21 FE - built for the bold. With a 32MP front-facing camera, Portrait Mode, Night Mode, and Director\'s View, supercharging your socials with selfies and stories has never been easier - or looked so good. A powerful processor means you can enjoy super smooth scrolling, all day long. And with a massive AI-powered battery, Galaxy S21 FE will keep going hour after hour on just one charge. Get ready to do even more.\r\n\r\nWith a 6.4-inch Dynamic AMOLED 2X display, Full HD+ Resolution, smooth 120Hz scrolling and a punch-hole selfie camera, Galaxy S21 FE has the smarts to match the looks. Featuring a tough Gorilla Glass Victus Front and a glastic Rear encased in a perfectly finished Aluminium Frame, it\'s designed for protection and peace of mind.\r\nModel number: SM-G990BZAFEUA.', 2, '699.00', '680.00', 1, 0, '1681569893.webp', 'Samsung Galaxy S21 FE 5G 128GB Phone - Graphite', 'Phones', 'When it comes to making every single day count, you need the right kit. Meet Samsung Galaxy S21 FE - built for the bold. With a 32MP front-facing camera, Portrait Mode, Night Mode, and Director\'s View, supercharging your socials with selfies and stories has never been easier - or looked so good. A powerful processor means you can enjoy super smooth scrolling, all day long. And with a massive AI-powered battery, Galaxy S21 FE will keep going hour after hour on just one charge. Get ready to do even more.\r\n\r\nWith a 6.4-inch Dynamic AMOLED 2X display, Full HD+ Resolution, smooth 120Hz scrolling and a punch-hole selfie camera, Galaxy S21 FE has the smarts to match the looks. Featuring a tough Gorilla Glass Victus Front and a glastic Rear encased in a perfectly finished Aluminium Frame, it\'s designed for protection and peace of mind.\r\nModel number: SM-G990BZAFEUA.', '2023-04-15 15:44:53', '2023-04-15 15:55:36'),
(32, 1, 'REDMAGIC 8 Pro Smartphone 5G, 120Hz Gaming Phone, 6.8\" Full Screen', '【6.8\" FHD Full Screen】Gaming Phone with a 120Hz refresh rate, this 6.8\" FHD Full AMOLED screen delivers beautiful HD+ visuals at up to 120 frames per second. With a 960Hz touch sampling rate for multi fingers, the Cell Phone delivers ultra-fast touch and precise response, giving you a serious competitive edge while gaming. The 5G Smartphone have also Under-display Fingerprint Sensor and 16MP Under Display Camera.', 4, '619.00', '600.00', 0, 1, '1681570113.webp', 'REDMAGIC 8 Pro Smartphone 5G, 120Hz Gaming Phone, 6.8\" Full Screen', 'Phones, Gaming', '【6.8\" FHD Full Screen】Gaming Phone with a 120Hz refresh rate, this 6.8\" FHD Full AMOLED screen delivers beautiful HD+ visuals at up to 120 frames per second. With a 960Hz touch sampling rate for multi fingers, the Cell Phone delivers ultra-fast touch and precise response, giving you a serious competitive edge while gaming. The 5G Smartphone have also Under-display Fingerprint Sensor and 16MP Under Display Camera.', '2023-04-15 15:48:33', '2023-04-24 12:10:22'),
(33, 2, 'ASUS ROG Strix G17 (2023) Gaming Laptop, 17.3” QHD 240Hz', 'ESPORT DOMINATION – Power up with Windows 11, an AMD Ryzen 9 7945HX processor, and an NVIDIA GeForce RTX 4060 Laptop GPU at 140W Max TGP.\r\nBLAZING FAST MEMORY AND STORAGE – Multitask swiftly with 16GB of DDR5-4800MHz memory and speed up loading times with 1TB of PCIe 4x4.\r\nROG INTELLIGENT COOLING – To put this amount of power in a gaming laptop, you need an even better cooling solution. The Strix features Thermal Grizzly’s Conductonaut Extreme liquid metal on the CPU among other premium features, to allow for better sustained performance over long gaming sessions.\r\nCOMPETITION HERTZ – As a purpose-built gaming machine, The Strix G17 has a fast QHD 240Hz/3ms panel to help you stay locked to your target. It also covers 100% of the DCI-P3 color space and feature Dolby Vision and Adaptive-Sync support for a stellar viewing experience.\r\nMUX SWITCH WITH ADVANCED OPTIMUS - A MUX Switch increases laptop gaming performance by 5-10% by routing frames directly from the dGPU to the display bypassing the iGPU. With Advanced Optimus the switch between iGPU and dGPU becomes automatic based on the task optimizing battery life.\r\nXBOX GAME PASS ULTIMATE – Get a free 90-day pass and gain access to over 100 high-quality games. With games added all the time, there’s always something new to play.', 6, '1460.00', '1440.00', 1, 1, '1681570259.webp', 'ASUS ROG Strix G17 (2023) Gaming Laptop, 17.3” QHD 240Hz', 'Laptops, Gaming', 'ESPORT DOMINATION – Power up with Windows 11, an AMD Ryzen 9 7945HX processor, and an NVIDIA GeForce RTX 4060 Laptop GPU at 140W Max TGP.\r\nBLAZING FAST MEMORY AND STORAGE – Multitask swiftly with 16GB of DDR5-4800MHz memory and speed up loading times with 1TB of PCIe 4x4.\r\nROG INTELLIGENT COOLING – To put this amount of power in a gaming laptop, you need an even better cooling solution. The Strix features Thermal Grizzly’s Conductonaut Extreme liquid metal on the CPU among other premium features, to allow for better sustained performance over long gaming sessions.\r\nCOMPETITION HERTZ – As a purpose-built gaming machine, The Strix G17 has a fast QHD 240Hz/3ms panel to help you stay locked to your target. It also covers 100% of the DCI-P3 color space and feature Dolby Vision and Adaptive-Sync support for a stellar viewing experience.\r\nMUX SWITCH WITH ADVANCED OPTIMUS - A MUX Switch increases laptop gaming performance by 5-10% by routing frames directly from the dGPU to the display bypassing the iGPU. With Advanced Optimus the switch between iGPU and dGPU becomes automatic based on the task optimizing battery life.\r\nXBOX GAME PASS ULTIMATE – Get a free 90-day pass and gain access to over 100 high-quality games. With games added all the time, there’s always something new to play.', '2023-04-15 15:50:59', '2023-04-16 17:24:05'),
(34, 2, 'Lenovo ThinkBook 15 Premium Business Laptop, AMD Ryzen 5 5500U Processor (6 Cores, 4.0GHz), 15.6\" FHD', '【Over-achieving Performance】With AMD Ryzen 5 5500U (11MB Cache, up to 4.00GHz), the ThinkBook 15 laptop lets you work on demanding applications with ease. Up to six mobile cores enable unparalleled responsiveness and multitasking experience.\r\n【Superior Visuals】See every detail of your work on the Lenovo ThinkBook 15 brilliant and bright display, which offers to 15.6\" FHD (1920x1080) resolution and 100% sRGB color gamut. And eye-fatigue won’t be an issue with TÜV Rheinland, which cuts down harmful blue light.\r\n【Optimized Workflow】Experience improved multitasking with higher bandwidth thanks to 20GB RAM (Model#: 7EH99AA#ABB), and enjoy up to 15x faster performance than a traditional hard drive with 1TB PCIe NVMe M.2 SSD storage. Thus, working with large files will never be a problem.\r\n【Dressed for success】Make a good first impression with the sleek and modern design of the Lenovo ThinkBook 15. Its dual-tone Mineral Gray top cover adds a level of style that you’ll want to be seen with, and at only 1.7kg / 3.75lbs with a thickness of 18.9mm, you can bring it anywhere. And when you need to power up on the fly, the Touch Fingerprint Reader boots up and logs in instantly.\r\n【Ahead of the curve】Enjoy stable connections even on the most crowded networks with WiFi 6. And you’ll be able to get a little alone time with a webcam privacy shutter that lets you physically block the camera when you’re not using it.', 4, '525.00', '500.00', 1, 1, '1681570771.webp', 'Lenovo ThinkBook 15 Premium Business Laptop, AMD Ryzen 5 5500U Processor (6 Cores, 4.0GHz), 15.6\" FHD', 'Laptop, Business', '【Over-achieving Performance】With AMD Ryzen 5 5500U (11MB Cache, up to 4.00GHz), the ThinkBook 15 laptop lets you work on demanding applications with ease. Up to six mobile cores enable unparalleled responsiveness and multitasking experience.\r\n【Superior Visuals】See every detail of your work on the Lenovo ThinkBook 15 brilliant and bright display, which offers to 15.6\" FHD (1920x1080) resolution and 100% sRGB color gamut. And eye-fatigue won’t be an issue with TÜV Rheinland, which cuts down harmful blue light.\r\n【Optimized Workflow】Experience improved multitasking with higher bandwidth thanks to 20GB RAM (Model#: 7EH99AA#ABB), and enjoy up to 15x faster performance than a traditional hard drive with 1TB PCIe NVMe M.2 SSD storage. Thus, working with large files will never be a problem.\r\n【Dressed for success】Make a good first impression with the sleek and modern design of the Lenovo ThinkBook 15. Its dual-tone Mineral Gray top cover adds a level of style that you’ll want to be seen with, and at only 1.7kg / 3.75lbs with a thickness of 18.9mm, you can bring it anywhere. And when you need to power up on the fly, the Touch Fingerprint Reader boots up and logs in instantly.\r\n【Ahead of the curve】Enjoy stable connections even on the most crowded networks with WiFi 6. And you’ll be able to get a little alone time with a webcam privacy shutter that lets you physically block the camera when you’re not using it.', '2023-04-15 15:59:31', '2023-04-15 15:59:31'),
(35, 3, 'Samsung 75\" QN95B Neo QLED 4K Smart TV (2022) - Neural Quantum 4K Processor', '\r\n    Experience Epic Contrast And Breath-Taking Picture - Quantum Matrix Technology works in tandem with the brilliant AI-powered processor to deliver epic contrast and stunning images on your samsung tv.\r\n    AI-Powered 4K Picture For A Stunning TV Experience - 20 neural networks enhance every detail of each frame you watch, creating a 4K experience like never before with 100% colour volume for true vibrancy that delivers a dazzling picture.\r\n    Never Miss A Moment With Adaptive Sound - No matter where your TV is placed, you\'ll receive sound that is tailored to your space. So, you\'ll never miss another line with volume that adapts to you.\r\n    Access Your PC Remotely From Your Samsung TV & Enjoy Limitless Streaming - Get more done by easily accessing your work PC from home, perfect for working or finishing off a presentation. And get all the content you need on the Samsung Smart Hub.\r\n    Start Experiencing Samsung TVs - We believe a TV is more than something you watch. It should inspire, amaze, envelop and immerse you. From quality picture, to elegant design, our TVs push the boundaries of what is possible and what a TV can be.\r\n', 3, '2599.00', '2500.00', 1, 0, '1681572339.webp', 'Samsung 75\" QN95B Neo QLED 4K Smart TV (2022) - Neural Quantum 4K Processor', 'TVs', '\r\n    Experience Epic Contrast And Breath-Taking Picture - Quantum Matrix Technology works in tandem with the brilliant AI-powered processor to deliver epic contrast and stunning images on your samsung tv.\r\n    AI-Powered 4K Picture For A Stunning TV Experience - 20 neural networks enhance every detail of each frame you watch, creating a 4K experience like never before with 100% colour volume for true vibrancy that delivers a dazzling picture.\r\n    Never Miss A Moment With Adaptive Sound - No matter where your TV is placed, you\'ll receive sound that is tailored to your space. So, you\'ll never miss another line with volume that adapts to you.\r\n    Access Your PC Remotely From Your Samsung TV & Enjoy Limitless Streaming - Get more done by easily accessing your work PC from home, perfect for working or finishing off a presentation. And get all the content you need on the Samsung Smart Hub.\r\n    Start Experiencing Samsung TVs - We believe a TV is more than something you watch. It should inspire, amaze, envelop and immerse you. From quality picture, to elegant design, our TVs push the boundaries of what is possible and what a TV can be.\r\n', '2023-04-15 16:25:39', '2023-04-15 16:25:39'),
(36, 3, 'Sony BRAVIA XR 65\" A95K Master Series QD-OLED 4K Ultra HD HDR', 'The Sony BRAVIA 65\" A95KU OLED 4K Ultra HD HDR Smart TV (XR65A95KU) breathes new life into OLED technology with enriched brightness and sharpness potential, which is made all the more impressive when paired with XR OLED Contrast Pro technology. Delivering up to 200% more colour brightness than standard OLEDs, this smart TV is truly the pinnacle of modern viewing cinematics. Incredible picture is made all the more captivating with Acoustic Surface Audio+ for full sensory immersion and all-round screen time improvements. Completing this modern TV marvel is access to Smart TV functions and a near-limitless assortment of streaming platforms and titles, to help you get to the content you love faster', 0, '3499.00', '2999.00', 1, 0, '1681572408.webp', 'Sony BRAVIA XR 65\" A95K Master Series QD-OLED 4K Ultra HD HDR', 'TVs', 'The Sony BRAVIA 65\" A95KU OLED 4K Ultra HD HDR Smart TV (XR65A95KU) breathes new life into OLED technology with enriched brightness and sharpness potential, which is made all the more impressive when paired with XR OLED Contrast Pro technology. Delivering up to 200% more colour brightness than standard OLEDs, this smart TV is truly the pinnacle of modern viewing cinematics. Incredible picture is made all the more captivating with Acoustic Surface Audio+ for full sensory immersion and all-round screen time improvements. Completing this modern TV marvel is access to Smart TV functions and a near-limitless assortment of streaming platforms and titles, to help you get to the content you love faster', '2023-04-15 16:26:48', '2023-04-16 17:21:49'),
(37, 3, 'Samsung 75\" Q80B QLED 4K Smart TV (2022) Super Ultrawide Gameview & Multi View ', '    Experience Stunning Contrast With Direct Full Array - with precision controlled LEDs within your Samsung TV screen, you\'ll see ultra-deep blacks and pure whites. Giving you an amazing viewing experience, whatever you\'re watching, all in stunning 4K.\r\n    A Game-changing 4K Processor With 100% Colour Volume - Samsung\'s powerful Quantum Processor 4K delivers glorious picture & sound for a truly breath-taking viewing experience. Our Smart TV also delivers 100% Colour Volume for a dazzling picture.\r\n    Next-level Audio Performance On Your Samsung TV - Dolby Atmos offers top channel speakers that create a truly immersive and powerful audio experience, for that cinematic feeling at home. With 3D surround sound built-in too.\r\n    Multiple Voice Assistants & Smart TV Streaming - Choose your favourite voice assistant and control the Samsung TV Smart Hub without moving a muscle. Turn up the volume, pause or play with only your voice, for a simple TV experience.\r\n    Start Experiencing Samsung TVs - We believe a TV is more than something you watch. It should inspire, amaze, envelop and immerse you. From quality picture, to elegant design, our TVs push the boundaries of what is possible and what a TV can be.', 4, '2499.00', '1269.00', 1, 0, '1681572479.webp', 'Samsung 75\" Q80B QLED 4K Smart TV (2022) Super Ultrawide Gameview & Multi View ', 'TVs', '    Experience Stunning Contrast With Direct Full Array - with precision controlled LEDs within your Samsung TV screen, you\'ll see ultra-deep blacks and pure whites. Giving you an amazing viewing experience, whatever you\'re watching, all in stunning 4K.\r\n    A Game-changing 4K Processor With 100% Colour Volume - Samsung\'s powerful Quantum Processor 4K delivers glorious picture & sound for a truly breath-taking viewing experience. Our Smart TV also delivers 100% Colour Volume for a dazzling picture.\r\n    Next-level Audio Performance On Your Samsung TV - Dolby Atmos offers top channel speakers that create a truly immersive and powerful audio experience, for that cinematic feeling at home. With 3D surround sound built-in too.\r\n    Multiple Voice Assistants & Smart TV Streaming - Choose your favourite voice assistant and control the Samsung TV Smart Hub without moving a muscle. Turn up the volume, pause or play with only your voice, for a simple TV experience.\r\n    Start Experiencing Samsung TVs - We believe a TV is more than something you watch. It should inspire, amaze, envelop and immerse you. From quality picture, to elegant design, our TVs push the boundaries of what is possible and what a TV can be.', '2023-04-15 16:27:59', '2023-04-15 16:28:19'),
(40, 3, 'LG OLED55C14LB 55\" 4K UHD HDR Smart OLED TV (2021 Model) with Advanced α9 Gen4 AI processor, SELF-LIT OLED, Black', '    LG 4K SELF-LIT OLED for infinite contrast & 100 percent colour fidelity\r\n    Advanced α9 Gen4 AI processor 4K for ultimate picture & sound\r\n    Exceptional cinema & sport with Dolby Vision IQ and Dolby Atmos\r\n    Powerful gaming with HDMI 2.1, VRR, HFR, Game Optimiser\r\n    Low blue light & flicker free for less eye fatigue and safer viewing\r\n    Power Source Type: Corded Electric\r\n    Power source type: Corded Electric Display size: 55.0 inches Connectivity technology: Wi-Fi Surround sound channel configuration: 2.2 ch', 3, '879.00', '850.00', 1, 0, '1681576132.webp', 'LG OLED55C14LB 55\" 4K UHD HDR Smart OLED TV (2021 Model) with Advanced α9 Gen4 AI processor, SELF-LIT OLED,\r\nBlack', 'TVs', '    LG 4K SELF-LIT OLED for infinite contrast & 100 percent colour fidelity\r\n    Advanced α9 Gen4 AI processor 4K for ultimate picture & sound\r\n    Exceptional cinema & sport with Dolby Vision IQ and Dolby Atmos\r\n    Powerful gaming with HDMI 2.1, VRR, HFR, Game Optimiser\r\n    Low blue light & flicker free for less eye fatigue and safer viewing\r\n    Power Source Type: Corded Electric\r\n    Power source type: Corded Electric Display size: 55.0 inches Connectivity technology: Wi-Fi Surround sound channel configuration: 2.2 ch', '2023-04-15 17:28:52', '2023-04-15 17:29:55'),
(41, 3, 'LG 75\" Class QNED85 UQA Series MiniLED 4K UHD Smart webOS 22 w/ ThinQ AI TV', '     a7 Gen5 AI Processor 4K Quantum Dot NanoCell Color Technology Mini-LED Backlighting Precision Dimming FILMMAKER MODE™, Dolby Vision™ IQ and Dolby AtmosⓇ AI Sound Pro (a7 Gen5 AI Processor) ', 3, '1609.00', '1550.00', 1, 0, '1681576274.webp', 'LG 75\" Class QNED85 UQA Series MiniLED 4K UHD Smart webOS 22 w/ ThinQ AI TV', 'TVs', '     a7 Gen5 AI Processor 4K Quantum Dot NanoCell Color Technology Mini-LED Backlighting Precision Dimming FILMMAKER MODE™, Dolby Vision™ IQ and Dolby AtmosⓇ AI Sound Pro (a7 Gen5 AI Processor) ', '2023-04-15 17:31:14', '2023-04-15 17:31:14'),
(42, 3, 'Samsung 43\" BU8500 UHD Crystal 4K Smart TV (2022)', '\r\n    Immerse Yourself In Exceptional Colour All In 4K - Dynamic Crystal Colour delivers a new level of UHD, allowing you to experience a billion shades of colour for a lifelike, vivid picture no matter what you watch.\r\n    Super Slim And Elegant Design - The Saumsung BU8500 smart TV offers an incredibly powerful processor within a beautiful, slim design. For a TV that looks great wherever you place it, and easily fits into any space.\r\n    Incredible Adaptive Audio that follows the action - Experience epic sound AI Adaptive sound on your 4K Ultra HD Smart TV that changes to match the content you are watching or game you are playing for a truly immersive audio experience.\r\n    Enjoy Your Favourite Streaming Services In One Place With The Smart Hub - Samsung TV Plus offers all your favourite content in one, easy to use place so you can watch a huge variety of content right from your Samsung TV.\r\n    Start Experiencing Samsung TVs - We believe a TV is more than something you watch. It should inspire, amaze, envelop and immerse you. From quality picture, to elegant design, our TVs push the boundaries of what is possible and what a TV can be.', 2, '599.00', '369.00', 1, 0, '1681576369.webp', 'Samsung 43\" BU8500 UHD Crystal 4K Smart TV (2022)', 'TVs', '\r\n    Immerse Yourself In Exceptional Colour All In 4K - Dynamic Crystal Colour delivers a new level of UHD, allowing you to experience a billion shades of colour for a lifelike, vivid picture no matter what you watch.\r\n    Super Slim And Elegant Design - The Saumsung BU8500 smart TV offers an incredibly powerful processor within a beautiful, slim design. For a TV that looks great wherever you place it, and easily fits into any space.\r\n    Incredible Adaptive Audio that follows the action - Experience epic sound AI Adaptive sound on your 4K Ultra HD Smart TV that changes to match the content you are watching or game you are playing for a truly immersive audio experience.\r\n    Enjoy Your Favourite Streaming Services In One Place With The Smart Hub - Samsung TV Plus offers all your favourite content in one, easy to use place so you can watch a huge variety of content right from your Samsung TV.\r\n    Start Experiencing Samsung TVs - We believe a TV is more than something you watch. It should inspire, amaze, envelop and immerse you. From quality picture, to elegant design, our TVs push the boundaries of what is possible and what a TV can be.', '2023-04-15 17:32:49', '2023-04-15 17:32:49'),
(43, 3, 'Samsung 75\" BU8000 UHD Crystal 4K Smart TV (2022)', '\r\n    Immerse Yourself In Exceptional Colour All In 4K - Dynamic Crystal Colour delivers a new level of UHD, allowing you to experience a billion shades of colour for a lifelike, vivid picture no matter what you watch.\r\n    Super Slim And Elegant Design - The Saumsung BU8000 smart TV offers an incredibly powerful processor within a beautiful, slim design. For a TV that looks great wherever you place it, and easily fits into any space.\r\n    Incredible Adaptive Audio that follows the action - Experience epic sound AI Adaptive sound on your 4K Ultra HD Smart TV that changes to match the content you are watching or game you are playing for a truly immersive audio experience.\r\n    Enjoy Your Favourite Streaming Services In One Place With The Smart Hub - Samsung TV Plus offers all your favourite content in one, easy to use place so you can watch a huge variety of content right from your Samsung TV.\r\n    Start Experiencing Samsung TVs - We believe a TV is more than something you watch. It should inspire, amaze, envelop and immerse you. From quality picture, to elegant design, our TVs push the boundaries of what is possible and what a TV can be.', 4, '1399.00', '869.00', 1, 0, '1681576446.webp', 'Samsung 75\" BU8000 UHD Crystal 4K Smart TV (2022)', 'TVs', '\r\n    Immerse Yourself In Exceptional Colour All In 4K - Dynamic Crystal Colour delivers a new level of UHD, allowing you to experience a billion shades of colour for a lifelike, vivid picture no matter what you watch.\r\n    Super Slim And Elegant Design - The Saumsung BU8000 smart TV offers an incredibly powerful processor within a beautiful, slim design. For a TV that looks great wherever you place it, and easily fits into any space.\r\n    Incredible Adaptive Audio that follows the action - Experience epic sound AI Adaptive sound on your 4K Ultra HD Smart TV that changes to match the content you are watching or game you are playing for a truly immersive audio experience.\r\n    Enjoy Your Favourite Streaming Services In One Place With The Smart Hub - Samsung TV Plus offers all your favourite content in one, easy to use place so you can watch a huge variety of content right from your Samsung TV.\r\n    Start Experiencing Samsung TVs - We believe a TV is more than something you watch. It should inspire, amaze, envelop and immerse you. From quality picture, to elegant design, our TVs push the boundaries of what is possible and what a TV can be.', '2023-04-15 17:34:06', '2023-04-15 17:34:06'),
(44, 5, 'Lenovo Tab M10 Plus 10.3\" FHD Tablet with Charging Station – (Octa-Core 2.3 GHz, 2 GB RAM, 32 GB eMMC, Android Pie) – Iron Grey ', '\r\n    A new tab generation: The Tab M10 Plus offers a premium design, equipped for your family’s needs with dedicated user profiles, parental controls and a Kids Mode for your peace of mind\r\n    Crystal clear audio and vision: A 10.3 Inch full high-definition display (1920x1200) and Dolby Atmos dual front speakers giving you immersive entertainment with surround sound\r\n    Premium look and feel: Just 8.15 mm thin and weighing just 460 g, the M10 Plus is beautifully crafted with a premium metal back cover and a 4.6 mm narrow bezel\r\n    On-the-go-fun: Dock in the charging station for hands-free entertainment or take your tablet anywhere you go with a battery life of up to 9 hours\r\n    Safe and secure: Unlock your device in a flash with face recognition technology, preloaded with the latest Android Pie software so as you can stay up to date', 5, '179.99', '154.99', 1, 0, '1681577070.webp', 'Lenovo Tab M10 Plus 10.3\" FHD Tablet with Charging Station – (Octa-Core 2.3 GHz, 2 GB RAM, 32 GB eMMC, Android Pie) – Iron Grey ', 'Tablets', '\r\n    A new tab generation: The Tab M10 Plus offers a premium design, equipped for your family’s needs with dedicated user profiles, parental controls and a Kids Mode for your peace of mind\r\n    Crystal clear audio and vision: A 10.3 Inch full high-definition display (1920x1200) and Dolby Atmos dual front speakers giving you immersive entertainment with surround sound\r\n    Premium look and feel: Just 8.15 mm thin and weighing just 460 g, the M10 Plus is beautifully crafted with a premium metal back cover and a 4.6 mm narrow bezel\r\n    On-the-go-fun: Dock in the charging station for hands-free entertainment or take your tablet anywhere you go with a battery life of up to 9 hours\r\n    Safe and secure: Unlock your device in a flash with face recognition technology, preloaded with the latest Android Pie software so as you can stay up to date', '2023-04-15 17:44:30', '2023-04-15 17:44:30'),
(45, 5, 'Apple 2022 10.9\" iPad Air (Wi-Fi, 64GB) - Space Grey (5th Generation)', '\r\n    10.9-inch Liquid Retina display with True Tone, P3 wide color, and an antireflective coating\r\n    Apple M1 chip with Neural Engine\r\n    12MP Wide camera\r\n    12MP Ultra Wide front camera with Center Stage\r\n    Up to 256GB of storage\r\n    Available in blue, purple, pink, starlight, and space gray\r\n    Stereo landscape speakers', 3, '669.00', '649.00', 1, 0, '1681577127.webp', 'Apple 2022 10.9\" iPad Air (Wi-Fi, 64GB) - Space Grey (5th Generation)', 'Tablets', '\r\n    10.9-inch Liquid Retina display with True Tone, P3 wide color, and an antireflective coating\r\n    Apple M1 chip with Neural Engine\r\n    12MP Wide camera\r\n    12MP Ultra Wide front camera with Center Stage\r\n    Up to 256GB of storage\r\n    Available in blue, purple, pink, starlight, and space gray\r\n    Stereo landscape speakers', '2023-04-15 17:45:27', '2023-04-15 17:45:27'),
(46, 5, 'Apple 2022 12.9\" iPad Pro (Wi-Fi, 128GB) - Space Grey (6th generation) ', '\r\n    Brilliant 12.9-inch Liquid Retina XDR display with ProMotion, True Tone, and P3 wide color\r\n    M2 chip with 8-core CPU and 10-core GPU\r\n    12MP Wide camera, 10MP Ultra Wide back camera, and LiDAR Scanner for immersive AR\r\n    12MP Ultra Wide front camera with Center Stage\r\n    Stay connected with ultrafast Wi-Fi 6E\r\n    USB-C connector with support for Thunderbolt / USB 4\r\n    Face ID for secure authentication and Apple Pay\r\n', 2, '1249.00', '1200.00', 1, 0, '1681577277.webp', 'Apple 2022 12.9\" iPad Pro (Wi-Fi, 128GB) - Space Grey (6th generation) ', 'Tablets', '\r\n    Brilliant 12.9-inch Liquid Retina XDR display with ProMotion, True Tone, and P3 wide color\r\n    M2 chip with 8-core CPU and 10-core GPU\r\n    12MP Wide camera, 10MP Ultra Wide back camera, and LiDAR Scanner for immersive AR\r\n    12MP Ultra Wide front camera with Center Stage\r\n    Stay connected with ultrafast Wi-Fi 6E\r\n    USB-C connector with support for Thunderbolt / USB 4\r\n    Face ID for secure authentication and Apple Pay\r\n', '2023-04-15 17:47:57', '2023-04-15 17:47:57'),
(47, 5, 'Samsung Galaxy Tab S8 Ultra 14.6\" 512GB 5G Graphite', '\r\n    More than just space. The largest Samsung Galaxy Tab S is designed so you can create like a pro. Shoot with our first ultra wide front camera in a tablet and edit on the largest screen in the Samsung Galaxy Tab S.\r\n    Write, sketch, doodle or draw all your wildest ideas into reality with S Pen with ultra-low latency. A thousand tools in one, the new S Pen gives you impressive levels of control.\r\n    Love to draw or paint? Clip Studio Paint5 was created just for creative people like you. With a natural brush feel you can bring life to your most imaginative creations.\r\n    Auto Framing gives the spotlight the speaker deserves. So, you can record a dance lesson and the camera will automatically zoom in to keep focus on you and your moves as you give instruction.\r\n    Ring up your bestie or up to 31 of your closest friends with the high-quality video calling app available. The three Mic noise reduction technology makes sure you focus just on the call.\r\n', 4, '1599.00', '1400.00', 1, 0, '1681577322.webp', 'Samsung Galaxy Tab S8 Ultra 14.6\" 512GB 5G Graphite', 'Tablets', '\r\n    More than just space. The largest Samsung Galaxy Tab S is designed so you can create like a pro. Shoot with our first ultra wide front camera in a tablet and edit on the largest screen in the Samsung Galaxy Tab S.\r\n    Write, sketch, doodle or draw all your wildest ideas into reality with S Pen with ultra-low latency. A thousand tools in one, the new S Pen gives you impressive levels of control.\r\n    Love to draw or paint? Clip Studio Paint5 was created just for creative people like you. With a natural brush feel you can bring life to your most imaginative creations.\r\n    Auto Framing gives the spotlight the speaker deserves. So, you can record a dance lesson and the camera will automatically zoom in to keep focus on you and your moves as you give instruction.\r\n    Ring up your bestie or up to 31 of your closest friends with the high-quality video calling app available. The three Mic noise reduction technology makes sure you focus just on the call.\r\n', '2023-04-15 17:48:42', '2023-04-15 17:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `SessionID` int(10) NOT NULL,
  `VisitTimestamp` datetime NOT NULL,
  `IP` varchar(255) NOT NULL,
  `Organisation` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Region` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `Continent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`SessionID`, `VisitTimestamp`, `IP`, `Organisation`, `City`, `Region`, `Country`, `Continent`) VALUES
(1, '2020-07-01 07:25:23', 'redacted', 'redacted', 'London', 'England', 'United Kingdom', 'EU'),
(2, '2023-01-26 20:12:05', '169.150.196.139', 'Datacamp Limited', 'Amsterdam', 'North Holland', 'Netherlands', 'EU'),
(3, '2023-01-26 22:56:54', '138.199.21.196', 'Datacamp Limited', 'Tokyo', 'Tokyo', 'Japan', 'AS'),
(4, '2023-01-26 23:54:01', '89.38.99.28', 'WorldStream B.V.', 'Naaldwijk', 'South Holland', 'Netherlands', 'EU'),
(5, '2023-06-03 15:22:45', '212.219.94.2', 'Jisc Services Limited', 'London', 'England', 'United Kingdom', 'EU'),
(6, '2023-03-23 12:18:31', '185.177.124.199', 'WorldStream B.V.', 'Naaldwijk', 'South Holland', 'Netherlands', 'EU'),
(7, '2023-03-24 15:13:05', '190.2.132.214', 'WorldStream B.V.', 'Naaldwijk', 'South Holland', 'Netherlands', 'EU');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcarts`
--

CREATE TABLE `shoppingcarts` (
  `CartID` int(10) NOT NULL,
  `CustomerID` int(10) NOT NULL,
  `ProductID` int(10) NOT NULL,
  `ProductQuantity` int(4) NOT NULL,
  `DateOfCreation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoppingcarts`
--

INSERT INTO `shoppingcarts` (`CartID`, `CustomerID`, `ProductID`, `ProductQuantity`, `DateOfCreation`) VALUES
(78, 4, 13, 1, '2023-03-26 16:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(10) NOT NULL,
  `DateOfCreation` datetime NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `HashedPassword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `DateOfCreation`, `FirstName`, `Surname`, `Email`, `Password`, `HashedPassword`) VALUES
(1, '2023-01-21 22:35:23', 'Zed', 'Ai', 's2106630@leyton.ac.uk', 'password', '$2y$10$Ao3Tlr3TkAOQqS3N3pdOLufWbunMSDiYrFEujQxlP1CD4Uqa1wVuq'),
(4, '2023-01-23 12:20:47', 'test', 'test', 'test@gmail.com', '12345678', '$2y$10$6CeoSd3kfz3JZU03Pn5Ct.pwy0N2dQPRI.H0oAYJHxHqVwIQnrd9K'),
(8, '2023-04-16 00:38:30', 'Adib', 'Shehab', 'addsh727@gmail.com', 'password123', '$2y$10$NHA/6wLqmptbf5Ogrm7Wz.jxz0mfLh0NJ5WC6ZR9Dkxb4jLMmgL3q');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `TestimonialID` int(10) NOT NULL,
  `Rating` int(10) NOT NULL,
  `Testifier` varchar(255) NOT NULL,
  `Testimonial` varchar(255) NOT NULL,
  `DateOfCreation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`TestimonialID`, `Rating`, `Testifier`, `Testimonial`, `DateOfCreation`) VALUES
(1, 3, 'Adib Shehab', 'This is a testimonial.', '2023-04-13 16:23:28'),
(2, 5, 'Khalid Yasin', 'Great tech shop!', '2023-04-13 16:23:48'),
(3, 4, 'Anas Hussain', 'Would recommend online and in-person.', '2023-04-13 16:24:42'),
(4, 4, 'Test', 'Testimonial', '2023-04-13 16:24:53'),
(5, 3, 'Zed', 'This is a testimonial.', '2023-04-13 16:25:02'),
(6, 5, 'Test', '5 stars.', '2023-04-13 17:47:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `orderline`
--
ALTER TABLE `orderline`
  ADD PRIMARY KEY (`OrderLineID`),
  ADD KEY `OrderID` (`OrderID`,`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`SessionID`);

--
-- Indexes for table `shoppingcarts`
--
ALTER TABLE `shoppingcarts`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `CustomerID` (`CustomerID`,`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`TestimonialID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orderline`
--
ALTER TABLE `orderline`
  MODIFY `OrderLineID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `SessionID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shoppingcarts`
--
ALTER TABLE `shoppingcarts`
  MODIFY `CartID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `TestimonialID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderline`
--
ALTER TABLE `orderline`
  ADD CONSTRAINT `orderline_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderline_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);

--
-- Constraints for table `shoppingcarts`
--
ALTER TABLE `shoppingcarts`
  ADD CONSTRAINT `shoppingcarts_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shoppingcarts_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
