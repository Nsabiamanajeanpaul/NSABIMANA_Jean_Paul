-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 03:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carsurvey`
--

-- --------------------------------------------------------

--
-- Table structure for table `carmanufacturers`
--

CREATE TABLE `carmanufacturers` (
  `manufacturer_id` int(11) NOT NULL,
  `manufacturer_name` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carmanufacturers`
--

INSERT INTO `carmanufacturers` (`manufacturer_id`, `manufacturer_name`, `country`) VALUES
(1, 'benzi', 'burundi'),
(2, 'Ford', 'United States'),
(3, 'Honda', 'Japan'),
(4, 'tesla', 'uganda'),
(6, 'landcruzer', 'Rwanda');

-- --------------------------------------------------------

--
-- Table structure for table `carmodels`
--

CREATE TABLE `carmodels` (
  `model_id` int(11) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `fuel_type` varchar(50) DEFAULT NULL,
  `engine_size` decimal(5,2) DEFAULT NULL,
  `transmission_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carmodels`
--

INSERT INTO `carmodels` (`model_id`, `model_name`, `manufacturer_id`, `year`, `fuel_type`, `engine_size`, `transmission_type`) VALUES
(2, 'F-150', 2, 2024, '0', 2.50, '0'),
(3, 'Civic', 3, 2022, 'Gasoline', 2.00, 'Automatic'),
(4, 'tesla', 6, 19700, 'gasoline', 2.00, 'Automatic'),
(5, 'honda', 2, 1800, 'diesel', 3.00, 'Automatic');

-- --------------------------------------------------------

--
-- Table structure for table `platformfeedback`
--

CREATE TABLE `platformfeedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `feedback_comments` text DEFAULT NULL,
  `feedback_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `platformfeedback`
--

INSERT INTO `platformfeedback` (`feedback_id`, `user_id`, `feedback_comments`, `feedback_date`) VALUES
(1, 2, 'the website is friendly user', '2024-04-12'),
(2, 4, 'not bad', '2024-04-26'),
(3, NULL, NULL, NULL),
(4, 2, 'platform is moderate', '2024-04-05'),
(6, 3, 'badly', '2024-04-04'),
(8, 2, 'nice', '2024-04-05'),
(15, 3, 'ok', '2024-04-13');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `survey_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `survey_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`survey_id`, `user_id`, `model_id`, `rating`, `comments`, `survey_date`) VALUES
(2, 1, 3, 200, 'go low', '2024-04-07'),
(5, 1, 3, 30, 'this platform is great', '2024-04-05'),
(6, 1, 3, 100, 'moderate', '2024-04-05'),
(10, 3, 2, 1, 'great', '2024-04-19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `telephone`, `activation_code`) VALUES
(1, 'uwimana', 'oscar', 'uwimana@gmail.com', 'uwimana', '$2y$10$8Chy1lRyfqfas6oXxgM.QOMq9L58xwjdYXSN5PH4GkTJYDN2KirLW', '3456677', '6765'),
(2, 'ntama', 'oli', 'ntamaol@gmail.com', 'olg', '$2y$10$x5lIs0MSdEBT68wCK7BMcerrlF/JjIK7pVXnSn246t26al6xVd5.C', '345678', '4'),
(3, 'kay', 'eric', 'eric@gmail.com', 'gg', '$2y$10$pegYJrQ2Ux2XzX3jSMwCDuqn3pFplxOBeaOdaKy5ZeKYRylO2kQvK', '8767', '54'),
(4, 'NSABIMANA', 'Paul', 'jea2@gmail.com', 'G', '$2y$10$kOl4.eDAwlO9f3MsCkQoguWpOK/DQowc7AYyGdgWfkvY1hzVppDcS', '50133', '80'),
(5, 'ukwi', 'norbert', 'ukwi2@gmiil.com', 'darassa', '$2y$10$V9Q5WWoUbTs9UDVJkNNtO.2Gv0EmM54jqVhL9TbKy1TG7SvVSRv3i', '0000034', '009'),
(6, 'sam', 'rura', 'sam@gmail.com', 'rura', '$2y$10$8d4fhItVfJ77IYIazH01EO45Jg9jjwP3cm9SMQkqH5XFYbiWsAp8e', '09765', '34'),
(7, 'sam', 'rura', 'sam@gmail.com', 'rura', '$2y$10$BKCUcIh/UYJ4XroNsuWkxu0sIkCeC4EhHhU/Zw1rhosrH6hg.JMLa', '09765', '34'),
(8, 'sam', 'rura', 'sam@gmail.com', 'rura', '$2y$10$4woM6TitpQQNmV2bgLwz9.98Wp6/o49KfB/xocHC3Te4xxuYILJK2', '09765', '34'),
(9, 'dukundimana', 'francine', 'duk@gmail.com', 'fanny', '$2y$10$GlSnchV9u1rO/2semiAR1Ok4.8wg/2dREO57XNr6ASo83qCiWUBpy', '878787', '43'),
(10, 'dukundimana', 'francine', 'duk@gmail.com', 'fanny', '$2y$10$fEB6NavqfFzmFJLXJeNHXeLixBzIWOxeyZxiBJM12HENW7GWdd2CC', '878787', '43'),
(11, 'niyomuhoza', 'olivier', 'niyo1@gmail.com', 'niyo oli', '$2y$10$ajRBlt5eKFLSxghqnVxGXOiP5VDL6gSu0m.CAAigAQ83jXsi3keh.', '457328', '980');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'adminpassword', 'admin'),
(2, 'user1', 'user1password', 'user'),
(3, 'user2', 'user2password', 'user'),
(4, 'user', '123', 'user2'),
(5, 'paul', 'poku', 'admin'),
(6, 'piyo', 'papy', 'admin2'),
(7, 'nema', '1234', 'dean');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carmanufacturers`
--
ALTER TABLE `carmanufacturers`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Indexes for table `carmodels`
--
ALTER TABLE `carmodels`
  ADD PRIMARY KEY (`model_id`),
  ADD KEY `manufacturer_id` (`manufacturer_id`);

--
-- Indexes for table `platformfeedback`
--
ALTER TABLE `platformfeedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`survey_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `model_id` (`model_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carmanufacturers`
--
ALTER TABLE `carmanufacturers`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `carmodels`
--
ALTER TABLE `carmodels`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `platformfeedback`
--
ALTER TABLE `platformfeedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carmodels`
--
ALTER TABLE `carmodels`
  ADD CONSTRAINT `fk_manufacturer_id` FOREIGN KEY (`manufacturer_id`) REFERENCES `carmanufacturers` (`manufacturer_id`) ON DELETE CASCADE;

--
-- Constraints for table `platformfeedback`
--
ALTER TABLE `platformfeedback`
  ADD CONSTRAINT `platformfeedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `surveys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `surveys_ibfk_2` FOREIGN KEY (`model_id`) REFERENCES `carmodels` (`model_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
