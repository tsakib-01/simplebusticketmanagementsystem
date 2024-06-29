-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 01:28 PM
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
-- Database: `simnpledemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(100) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `route_id` varchar(255) NOT NULL,
  `customer_route` varchar(200) NOT NULL,
  `booked_amount` int(100) NOT NULL,
  `booked_seat` varchar(100) NOT NULL,
  `booking_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_id`, `customer_id`, `route_id`, `customer_route`, `booked_amount`, `booked_seat`, `booking_created`) VALUES
(84, '5IJAN84', 'CUST-4059946', 'RT-4684962', 'SYLHET &rarr; DHAKA', 12, '20', '2024-06-27 19:33:40'),
(85, 'NPZJW85', 'CUST-4059946', 'RT-6762463', 'SYLHET &rarr; CHITTAGONG', 15, '19', '2024-06-27 19:34:17'),
(86, 'VSIP086', 'CUST-2042547', 'RT-6576366', 'SYLHET &rarr; BARISHAL', 17, '27', '2024-06-27 19:36:42'),
(88, '2IT4F88', 'CUST-9343648', 'RT-6576366', 'SYLHET &rarr; BARISHAL', 17, '36', '2024-06-27 19:39:05'),
(91, 'O6M5091', 'CUST-5334449', 'RT-4684962', 'SYLHET &rarr; DHAKA', 12, '10', '2024-06-27 19:43:22'),
(92, 'C0UI992', 'CUST-57053', 'RT-4684962', 'SYLHET &rarr; DHAKA', 12, '4', '2024-06-27 19:50:24'),
(93, '9CPBJ93', 'CUST-57053', 'RT-6762463', 'SYLHET &rarr; CHITTAGONG', 15, '25', '2024-06-27 19:50:50'),
(94, '3BJMV94', 'CUST-21082', 'RT-6576366', 'SYLHET &rarr; BARISHAL', 17, '8', '2024-06-27 22:07:23'),
(95, 'DMPT995', 'CUST-21082', 'RT-4684962', 'SYLHET &rarr; DHAKA', 12, '27', '2024-06-28 07:41:18'),
(96, 'XO4DD96', 'CUST-52353', 'RT-4008668', 'SYLHET &rarr; MYMENSINGH', 6, '9', '2024-06-28 14:41:50'),
(97, 'TVFWB97', 'CUST-7696353', 'RT-4684962', 'SYLHET &rarr; DHAKA', 12, '38', '2024-06-28 14:46:47');

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `id` int(100) NOT NULL,
  `bus_no` varchar(255) NOT NULL,
  `bus_assigned` tinyint(1) NOT NULL DEFAULT 0,
  `bus_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `bus_no`, `bus_assigned`, `bus_created`) VALUES
(55, 'NEW101', 0, '2024-06-27 16:54:37'),
(56, 'GREENLINE-999', 0, '2024-06-27 16:57:09'),
(57, 'DESH-212', 1, '2024-06-27 19:11:09'),
(58, 'HANIF-313', 1, '2024-06-27 19:11:33'),
(60, 'ENA-525', 1, '2024-06-27 19:12:18'),
(61, 'EAGLE-435', 1, '2024-06-27 19:12:49'),
(62, 'NATIONAL-666', 1, '2024-06-27 19:13:06'),
(63, 'SAUDIA-737', 0, '2024-06-27 19:13:20'),
(64, 'SHYMOLI-878', 1, '2024-06-27 19:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(99) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `message` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `message`) VALUES
(1, 'zain', 'zain@gmail.com', 'Hello! I\'m zain a tester of Bus Ticket Management System...'),
(2, 'user_2', 'user@gmail.com', 'This is a test'),
(23, 'form', 'form@gmail.com', 'ok'),
(24, 'messageOne', 'messageone@gmail.com', 'messageOne messaging now!'),
(25, 'badar', 'badar@gmail.com', 'Im a user of this website.');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(100) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `customer_name` varchar(30) NOT NULL,
  `customer_phone` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL,
  `customer_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `customer_name`, `customer_phone`, `password`, `customer_created`) VALUES
(42, 'CUST-28783', 'person two', '0144546662', '555', '2024-06-27 12:14:55'),
(46, 'CUST-4059946', 'person four', '0189448657', '', '2024-06-27 19:32:14'),
(47, 'CUST-2042547', 'person one', '0148657856', '', '2024-06-27 19:35:58'),
(48, 'CUST-9343648', 'person five', '0178649461', '', '2024-06-27 19:37:07'),
(49, 'CUST-5334449', 'person three', '0179854656', '', '2024-06-27 19:40:12'),
(50, 'CUST-57053', 'Barry Allen', '0196654666', '000', '2024-06-27 19:49:36'),
(51, 'CUST-21082', 'person six', '0198789764', '666', '2024-06-27 22:05:14'),
(52, 'CUST-52353', 'Badar Hossan', '0159765956', '888', '2024-06-28 14:39:45'),
(53, 'CUST-7696353', 'Sayeed Ahmed', '0189454646', '', '2024-06-28 14:45:39');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(100) NOT NULL,
  `route_id` varchar(255) NOT NULL,
  `bus_no` varchar(155) NOT NULL,
  `route_cities` varchar(255) NOT NULL,
  `route_dep_date` date NOT NULL,
  `route_dep_time` time NOT NULL,
  `route_step_cost` int(100) NOT NULL,
  `route_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `route_id`, `bus_no`, `route_cities`, `route_dep_date`, `route_dep_time`, `route_step_cost`, `route_created`) VALUES
(62, 'RT-4684962', 'GREENLINE-999', 'SYLHET,DHAKA', '2024-06-30', '16:58:00', 12, '2024-06-27 16:57:59'),
(63, 'RT-6762463', 'DESH-212', 'SYLHET,CHITTAGONG', '2024-06-30', '08:15:00', 15, '2024-06-27 19:14:31'),
(64, 'RT-5641064', 'HANIF-313', 'SYLHET,RAJSHAHI', '2024-06-30', '09:15:00', 20, '2024-06-27 19:15:45'),
(65, 'RT-2034265', 'ENA-525', 'SYLHET,KHULNA', '2024-06-30', '22:00:00', 14, '2024-06-27 19:16:22'),
(66, 'RT-6576366', 'EAGLE-435', 'SYLHET,BARISHAL', '2024-06-30', '10:30:00', 17, '2024-06-27 19:26:06'),
(67, 'RT-8087767', 'NATIONAL-666', 'SYLHET,RANGPUR', '2024-06-30', '00:30:00', 8, '2024-06-27 19:28:20'),
(68, 'RT-4008668', 'SHYMOLI-878', 'SYLHET,MYMENSINGH', '2024-06-30', '19:30:00', 6, '2024-06-27 19:29:57'),
(69, 'RT-2198169', 'SAUDIA-468', 'SYLHET,KANAIGHAT', '2024-07-02', '10:00:00', 5, '2024-06-28 14:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `bus_no` varchar(155) NOT NULL,
  `seat_booked` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`bus_no`, `seat_booked`) VALUES
('ABC0010', NULL),
('BCC9999', NULL),
('CAS3300', '16,24'),
('DESH-212', '19,25'),
('EAGLE-435', '27,36,8'),
('ENA-525', NULL),
('GREENLINE-999', '20,10,4,27,38'),
('HANIF-313', NULL),
('LLL7699', NULL),
('MMM9969', '2,15,6,18,12'),
('MVL1000', '3'),
('NATIONAL-666', NULL),
('NBS4455', NULL),
('NEW101', '1,14'),
('RDH4255', '15'),
('SAUDIA-737', NULL),
('SHYMOLI-878', '9'),
('SSX6633', NULL),
('TTH8888', ''),
('XYZ7890', '22,22,22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_fullname` varchar(100) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fullname`, `user_name`, `user_password`, `user_created`) VALUES
(1, 'Tasnim Sakib', 'admin', '$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6', '2024-06-29 13:55:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`bus_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
