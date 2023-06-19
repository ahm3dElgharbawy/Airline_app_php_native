-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 05, 2023 at 10:59 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airline`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `email`, `subject`, `message`) VALUES
(3, 'a7m2d', 'da7342@gmail.com', 'problem', 'i want to remove my account please'),
(4, 'mohamed', 'm07amed@gmail.com', '', 'thank you very much, this website is realy helpful');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `flight_id` int(11) NOT NULL,
  `departure_date` datetime NOT NULL,
  `arrival_date` datetime NOT NULL,
  `source` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `airport` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `cost` int(10) NOT NULL,
  `seats` int(4) NOT NULL,
  `available_seats` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`flight_id`, `departure_date`, `arrival_date`, `source`, `destination`, `airport`, `status`, `cost`, `seats`, `available_seats`) VALUES
(49, '2022-12-31 17:08:00', '2023-02-01 17:08:00', 'Cairo', 'Riyadh', 'Cairo Airport', 'in the sky', 1500, 500, 500),
(50, '2023-01-04 15:11:00', '2023-01-05 03:09:00', 'Alex', 'Dubai', 'Alex Airport', 'canceled', 2000, 600, 599),
(51, '2023-01-03 15:11:00', '2023-01-04 17:10:00', 'Luxor', 'Amman', 'Luxor Airport', 'arrived insha allah', 1700, 400, 399),
(52, '2023-01-03 18:01:00', '2023-01-03 23:02:00', 'Aswan', 'Riyadh', 'Aswan Airport', 'arrived insha allah', 1400, 200, 200),
(53, '2023-01-03 13:03:00', '2023-01-03 18:03:00', 'Alex', 'Amman', 'Alex Airport', 'arrived insha allah', 1800, 200, 200),
(54, '2023-01-04 09:04:00', '2023-01-04 15:04:00', 'Alex', 'Riyadh', 'Alex Airport', 'arrived insha allah', 1600, 400, 400),
(55, '2023-01-06 04:05:00', '2023-01-07 12:05:00', 'Cairo', 'Riyadh', 'Cairo Airport', 'not departed yet', 1500, 500, 500),
(56, '2023-01-06 04:05:00', '2023-01-07 12:05:00', 'Cairo', 'Riyadh', 'Cairo Airport', 'not departed yet', 1500, 500, 500),
(57, '2023-01-06 10:07:00', '2023-01-06 14:07:00', 'Luxor', 'Riyadh', 'Luxor Airport', 'not departed yet', 2000, 400, 400),
(58, '2023-01-04 12:00:00', '2023-01-05 04:00:00', 'Aswan', 'Dubai', 'Aswan Airport', 'arrived insha allah', 5000, 450, 450),
(60, '2023-01-05 13:27:00', '2023-01-05 17:00:00', 'Aswan', 'Riyadh', 'Aswan Airport', 'not departed yet', 1900, 400, 400),
(61, '2023-01-05 09:33:00', '2023-01-05 15:34:00', 'Aswan', 'Amman', 'Aswan Airport', 'canceled', 3000, 400, 400);

-- --------------------------------------------------------

--
-- Table structure for table `passenger_information`
--

CREATE TABLE `passenger_information` (
  `passenger_id` varchar(14) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `flight_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passenger_information`
--

INSERT INTO `passenger_information` (`passenger_id`, `user_id`, `name`, `phone_no`, `dob`, `flight_id`) VALUES
('30225448826655', 20, 'mahmoud', '01255978978', '2000-10-12', 50),
('30588999522555', 20, 'omar mohamed', '01255867987', '2001-12-05', 51);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `creditcard_no` varchar(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `passenger_id` varchar(14) NOT NULL,
  `flight_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`creditcard_no`, `user_id`, `passenger_id`, `flight_id`) VALUES
('2214581556882258', 20, '30225448826655', 50),
('7894563453465456', 20, '30588999522555', 51);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `passenger_id` varchar(14) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `passenger_id`, `user_id`, `flight_id`) VALUES
(103, '30225448826655', 20, 50),
(104, '30588999522555', 20, 51);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(20, 'ahmed', 'ahmed@gmail.com', '$2y$10$3.A7bGyH/uvUam9qvQkjAeRL3pH5Bfs4SjMVMQQ2qUo.SDcaPZs5a'),
(21, 'Mohamed', 'mhmd@gmail.com', '$2y$10$OUugBHCXfyBa5/mczO0zS.AsqwX9KRP.Sq4..xuBw09e0m2fQ13di');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`flight_id`);

--
-- Indexes for table `passenger_information`
--
ALTER TABLE `passenger_information`
  ADD PRIMARY KEY (`passenger_id`),
  ADD KEY `FK_user_passenger` (`user_id`),
  ADD KEY `FK_flight_passenger` (`flight_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`creditcard_no`),
  ADD KEY `FK_user_payment` (`user_id`),
  ADD KEY `FK_flight_payment` (`flight_id`),
  ADD KEY `FK_passenger_payment` (`passenger_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `FK_flight_ticket` (`flight_id`),
  ADD KEY `FK_user_ticket` (`user_id`),
  ADD KEY `FK_passenger_ticket` (`passenger_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `flight`
--
ALTER TABLE `flight`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `passenger_information`
--
ALTER TABLE `passenger_information`
  ADD CONSTRAINT `FK_flight_passenger` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_passenger` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FK_flight_payment` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_passenger_payment` FOREIGN KEY (`passenger_id`) REFERENCES `passenger_information` (`passenger_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_payment` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `FK_flight_ticket` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_passenger_ticket` FOREIGN KEY (`passenger_id`) REFERENCES `passenger_information` (`passenger_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_ticket` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
