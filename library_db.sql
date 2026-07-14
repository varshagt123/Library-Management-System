-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2026 at 07:25 PM
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
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `total_copies` int(11) DEFAULT NULL,
  `available_copies` int(11) DEFAULT NULL,
  `qr_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `genre`, `total_copies`, `available_copies`, `qr_code`) VALUES
(18, 'power of 100 mens', 'roholan mie', 'action', 20, 21, 'BOOK_6a0c4212b6d2b'),
(20, 'rich dadd poor dad', 'Robert Kiyosaki', 'Finance', 22, 22, 'BOOK_6a0c44b808f7b'),
(21, 'wings of fire', 'A P J Abdul Kalam', 'Biography', 10, 7, 'BOOK_6a0c44ff76834'),
(23, 'Atomic Habits', 'James Clear', 'Self Help', 15, 15, 'BOOK_6a0c45f210b1d'),
(24, 'dbms concepts', 'korth', 'Education', 30, 27, 'BOOK_6a0c463872618'),
(27, 'war100', 'milien', 'action', 35, 35, 'BOOK_6a0c70f99daa0'),
(28, '7 habits', 'Rosh', 'Self Help', 25, 24, 'BOOK_6a0c714810987'),
(29, 'ad100', 'namdu', 'action', 7, 7, 'BOOK_6a0d745f9abba'),
(30, 'the life ', 'miina', 'self help', 6, 5, 'BOOK_6a0d7589cdf7d'),
(31, 'Never Ever', 'Jhon Roy', 'Suspense', 30, 30, 'BOOK_6a18e175d7d3a'),
(32, '1 to 1', 'reena', 'philosophy', 9, 6, 'BOOK_6a18f22228e15'),
(33, 'The Guide', 'R K Narayan', 'non fiction', 15, 12, 'BOOK_6a18f6405dc9e'),
(34, '1984', 'George Orwell', 'science fiction', 10, 10, 'BOOK_6a191b7c36838'),
(35, 'The shining', 'Stephen King', 'Horror', 10, 10, 'BOOK_6a191bb8cfcbc'),
(36, 'To Kill a Mockingbird', 'Harper Lee', 'Fiction', 12, 11, 'BOOK_6a191be19eb6b'),
(37, 'The Hobbit ', 'J tolkien', 'fantasy', 15, 15, 'BOOK_6a191c81262ae'),
(38, 'It Ends with us', 'Coollen Hoover', 'Romance', 15, 15, 'BOOK_6a191ccc1fbde'),
(39, '2 states', 'Chetan Bhagat', 'Romance', 10, 10, 'BOOK_6a191d46aa81e'),
(40, 'The Immortals Of Meluha ', 'Amish Tripathi', 'Mythological', 11, 11, 'BOOK_6a191df2152a9');

-- --------------------------------------------------------

--
-- Table structure for table `fines`
--

CREATE TABLE `fines` (
  `fine_id` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `fine_amount` decimal(10,2) DEFAULT NULL,
  `days_late` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fines`
--

INSERT INTO `fines` (`fine_id`, `transaction_id`, `fine_amount`, `days_late`) VALUES
(16, 15, 15.00, 3),
(17, 16, 25.00, 5),
(18, 20, 15.00, 3),
(19, 22, 5.00, 1),
(20, 21, 35.00, 7),
(21, 24, 15.00, 3),
(22, 31, 40.00, 8),
(23, 35, 15.00, 3),
(24, 43, 5.00, 1),
(26, 50, 40.00, 8),
(27, 51, 65.00, 13),
(28, 69, 15.00, 3),
(29, 70, 15.00, 3),
(30, 71, 10.00, 2),
(31, 73, 20.00, 4),
(32, 74, 40.00, 8),
(33, 75, 35.00, 7),
(34, 77, 5.00, 1),
(35, 83, 30.00, 6),
(36, 49, 5.00, 1),
(37, 64, 35.00, 7),
(38, 80, 35.00, 7),
(39, 82, 30.00, 6);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `join_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `name`, `email`, `phone`, `join_date`) VALUES
(1, 'maina', '124rf@gmail.com', '9876678954', '2026-05-09'),
(2, 'Manu', 'manu123@gmail.com', '8464728372', '2026-05-07'),
(5, 'Rohit Das', 'rohit@gmail.com', '3678109918', '2024-06-02'),
(6, 'Meera Patil', 'patil@gmail.com', '3675189764', '2020-02-02'),
(7, 'Adithya Rao', 'adithya@gmail.com', '6578938901', '2022-01-09'),
(8, 'vismiths', 'abc@gmail.com', '1234567899', '2026-05-16'),
(12, 'Varsha G T', 'varshagt13@gmail.com', '8123718667', '2026-05-15'),
(13, 'sdfghjk', 'dfgh@gmail.com', '1234567899', '2026-04-29'),
(15, 'mounika', 'mouni@gmail.com', '1234567890', '2026-05-03'),
(20, 'anusha', 'anu@gmail.com', '7687656789', '2026-04-28'),
(21, 'vguj', '1@gmail.com', '3456789087', '2026-05-02'),
(22, 'vismitha R K', 'vismithark6@gmail.com', '7483356078', '2026-05-14'),
(23, 'payal', 'pa123yal@gmail.com', '9876543210', '2016-06-23'),
(24, 'veena', 'vee@gmail.com', '1122334455', '2026-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `fine` decimal(10,2) DEFAULT NULL,
  `actual_return_date` date DEFAULT NULL,
  `reminder_sent` tinyint(1) DEFAULT 0,
  `overdue_sent` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `book_id`, `member_id`, `issue_date`, `return_date`, `fine`, `actual_return_date`, `reminder_sent`, `overdue_sent`) VALUES
(1, 1, 1, '2026-05-09', '2026-05-30', NULL, NULL, 0, 0),
(2, 3, 2, '2026-05-13', '2026-05-14', NULL, NULL, 0, 0),
(6, 1, 4, '2026-05-10', '2026-05-18', NULL, NULL, 0, 0),
(15, 8, 2, '2026-05-10', '2026-05-25', NULL, '2026-05-19', 0, 0),
(16, 6, 6, '2026-05-17', '2026-06-01', NULL, '2026-05-19', 0, 0),
(20, 4, 6, '2026-05-09', '2026-05-16', NULL, '2026-05-19', 0, 0),
(21, 7, 2, '2026-05-09', '2026-05-24', NULL, '2026-05-31', 0, 0),
(22, 6, 4, '2026-05-03', '2026-05-18', NULL, '2026-05-19', 0, 0),
(23, 8, 6, '2026-05-04', '2026-05-19', NULL, NULL, 0, 0),
(24, 8, 3, '2026-05-01', '2026-05-16', NULL, '2026-05-19', 0, 0),
(26, 8, 1, '2026-02-07', '2026-02-22', NULL, NULL, 0, 0),
(27, 6, 8, '2026-05-03', '2026-05-18', NULL, NULL, 0, 0),
(28, 6, 7, '2026-05-14', '2026-05-29', NULL, '2026-05-19', 0, 0),
(29, 27, 8, '2026-05-01', '2026-05-16', NULL, '2026-05-02', 0, 0),
(31, 20, 10, '2026-05-07', '2026-05-22', NULL, '2026-05-30', 0, 0),
(34, 26, 6, '2026-05-09', '2026-05-24', NULL, NULL, 0, 0),
(35, 24, 3, '2026-05-01', '2026-05-16', NULL, '2026-05-19', 0, 0),
(41, 18, 6, '2026-05-16', '2026-05-31', NULL, '2026-05-20', 0, 0),
(43, 21, 4, '2026-05-06', '2026-05-21', NULL, '2026-05-22', 0, 0),
(44, 18, 10, '2026-05-11', '2026-05-26', NULL, '2026-05-20', 0, 0),
(45, 18, 10, '2026-05-19', '2026-06-03', NULL, '2026-05-19', 0, 0),
(48, 18, 1, '2026-05-20', '2026-06-04', NULL, '2026-05-29', 0, 0),
(49, 18, 15, '2026-05-20', '2026-06-04', NULL, NULL, 0, 0),
(50, 28, 20, '2026-05-06', '2026-05-21', NULL, NULL, 0, 0),
(51, 18, 2, '2026-05-01', '2026-05-16', NULL, '2026-05-01', 0, 0),
(52, 27, 10, '2026-05-14', '2026-05-29', NULL, NULL, 0, 0),
(54, 21, 10, '2026-05-14', '2026-05-29', NULL, NULL, 0, 0),
(64, 28, 12, '2026-05-14', '2026-05-29', NULL, NULL, 0, 0),
(65, 31, 1, '2026-05-15', '2026-05-30', NULL, '2026-05-29', 0, 0),
(69, 20, 12, '2026-05-11', '2026-05-26', NULL, NULL, 0, 0),
(70, 24, 22, '2026-05-11', '2026-05-26', NULL, NULL, 0, 0),
(71, 31, 23, '2026-05-12', '2026-05-27', NULL, '2026-05-29', 0, 0),
(73, 24, 21, '2026-05-06', '2026-05-21', NULL, '2026-05-25', 0, 0),
(74, 18, 20, '2026-05-06', '2026-05-21', NULL, NULL, 0, 0),
(75, 18, 23, '2026-05-07', '2026-05-22', NULL, NULL, 0, 0),
(77, 32, 7, '2026-05-13', '2026-05-28', NULL, NULL, 0, 0),
(80, 33, 23, '2026-05-14', '2026-05-29', NULL, NULL, 0, 0),
(82, 32, 20, '2026-05-15', '2026-05-30', NULL, NULL, 0, 0),
(83, 28, 22, '2026-05-08', '2026-05-23', NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'Adm@1234', 'librarian'),
(2, 'student', 'Stu@1234', 'student'),
(3, 'admin', 'Adm@1234', 'librarian'),
(4, 'student', 'Stu@1234', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `fines`
--
ALTER TABLE `fines`
  ADD PRIMARY KEY (`fine_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `fines`
--
ALTER TABLE `fines`
  MODIFY `fine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fines`
--
ALTER TABLE `fines`
  ADD CONSTRAINT `fines_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
