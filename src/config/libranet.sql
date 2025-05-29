-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 29, 2025 at 04:49 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libranet`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_master`
--

CREATE TABLE `book_master` (
  `BookNo` int NOT NULL,
  `Title` varchar(40) NOT NULL,
  `Author1` varchar(40) NOT NULL,
  `Author2` varchar(40) DEFAULT NULL,
  `Author3` varchar(40) DEFAULT NULL,
  `Edition` varchar(10) NOT NULL,
  `Publisher` varchar(40) NOT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Pages` int DEFAULT NULL,
  `Remark` varchar(50) DEFAULT NULL,
  `Rating` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_master`
--

INSERT INTO `book_master` (`BookNo`, `Title`, `Author1`, `Author2`, `Author3`, `Edition`, `Publisher`, `Status`, `Pages`, `Remark`, `Rating`) VALUES
(1, 'The Lord of the Rings', 'J.R.R. Tolkien', NULL, NULL, 'Extended', 'Allen & Unwin', 'Issued', 1216, 'Classic Fantasy', 4.8),
(2, 'Pride and Prejudice', 'Jane Austen', NULL, NULL, 'Original', 'T. Egerton', 'Available', 432, 'Romantic Novel', 4.5),
(3, 'Dune', 'Frank Herbert', NULL, NULL, 'First', 'Chilton Books', 'Available', 896, 'Sci-Fi Epic', 4.7),
(4, 'The Hitchhiker\'s Guide to the Galaxy', 'Douglas Adams', NULL, NULL, 'Revised', 'Pan Books', 'Available', 224, 'Sci-Fi Comedy', 4.6),
(5, '1984', 'George Orwell', NULL, NULL, 'First', 'Secker & Warburg', 'Available', 328, 'Dystopian', 4.4),
(6, 'To Kill a Mockingbird', 'Harper Lee', NULL, NULL, 'First', 'J. B. Lippincott & Co.', 'Available', 324, 'Classic Literature', 4.9),
(7, 'The Great Gatsby', 'F. Scott Fitzgerald', NULL, NULL, 'First', 'Charles Scribner\'s Sons', 'Available', 180, 'American Classic', 4.3),
(8, 'Moby-Dick', 'Herman Melville', NULL, NULL, 'First', 'Richard Bentley', 'Available', 625, 'American Epic', 4.2),
(9, 'One Hundred Years of Solitude', 'Gabriel García Márquez', NULL, NULL, 'First', 'Editorial Sudamericana', 'Available', 417, 'Magical Realism', 4.7),
(10, 'Brave New World', 'Aldous Huxley', NULL, NULL, 'First', 'Chatto & Windus', 'Available', 268, 'Dystopian', 4.1),
(11, 'Foundation', 'Isaac Asimov', NULL, NULL, 'First', 'Gnome Press', 'Available', 255, 'Sci-Fi Series', 4.6),
(12, 'The Catcher in the Rye', 'J.D. Salinger', NULL, NULL, 'First', 'Little, Brown and Company', 'Available', 277, 'Coming-of-Age', 4),
(13, 'Crime and Punishment', 'Fyodor Dostoevsky', NULL, NULL, 'First', 'The Russian Messenger', 'Available', 671, 'Psychological Thriller', 4.8),
(14, 'Jane Eyre', 'Charlotte Brontë', NULL, NULL, 'First', 'Smith, Elder & Co.', 'Available', 532, 'Gothic Romance', 4.5),
(15, 'The Hobbit', 'J.R.R. Tolkien', NULL, NULL, 'First', 'Allen & Unwin', 'Available', 310, 'Fantasy Adventure', 4.7),
(16, 'The Color Purple', 'Alice Walker', NULL, NULL, 'First', 'Harcourt Brace Jovanovich', 'Available', 245, 'Epistolary Novel', 4.6),
(17, 'Wuthering Heights', 'Emily Brontë', NULL, NULL, 'First', 'T. C. Newby', 'Available', 342, 'Gothic Romance', 4.3),
(18, 'Slaughterhouse-Five', 'Kurt Vonnegut', NULL, NULL, 'First', 'Delacorte Press', 'Available', 275, 'Anti-War Novel', 4.2),
(19, 'The Handmaid\'s Tale', 'Margaret Atwood', NULL, NULL, 'First', 'McClelland and Stewart', 'Available', 311, 'Dystopian', 4.8),
(20, 'The Book Thief', 'Markus Zusak', NULL, NULL, 'First', 'Alfred A. Knopf', 'Available', 576, 'Historical Fiction', 4.9),
(21, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', NULL, NULL, 'First', 'Bloomsbury', 'Available', 309, 'Fantasy', 4.7),
(22, 'The Da Vinci Code', 'Dan Brown', NULL, NULL, 'First', 'Doubleday', 'Available', 454, 'Mystery Thriller', 4.1),
(23, 'Life of Pi', 'Yann Martel', NULL, NULL, 'First', 'Knopf Canada', 'Available', 319, 'Adventure Fiction', 4.5),
(24, 'The Girl with the Dragon Tattoo', 'Stieg Larsson', NULL, NULL, 'First', 'Norstedts Förlag', 'Available', 464, 'Crime Thriller', 4.6),
(25, 'The Hunger Games', 'Suzanne Collins', NULL, NULL, 'First', 'Scholastic Press', 'Available', 374, 'Dystopian', 4.4),
(26, 'Little Women', 'Louisa May Alcott', NULL, NULL, 'First', 'Roberts Brothers', 'Available', 541, 'Coming-of-Age', 4.8),
(27, 'The Road', 'Cormac McCarthy', NULL, NULL, 'First', 'Alfred A. Knopf', 'Available', 241, 'Post-Apocalyptic', 4.3),
(28, 'Catch-22', 'Joseph Heller', NULL, NULL, 'First', 'Simon & Schuster', 'Available', 453, 'Satirical Novel', 4.2),
(29, 'A Game of Thrones', 'George R.R. Martin', NULL, NULL, 'First', 'Bantam Books', 'Available', 694, 'Fantasy Epic', 4.9),
(30, 'The Shadow of the Wind', 'Carlos Ruiz Zafón', NULL, NULL, 'First', 'Planeta', 'Available', 561, 'Historical Mystery', 4.7),
(31, 'The Alchemist', 'Paulo Coelho', NULL, NULL, 'First', 'HarperCollins', 'Available', 197, 'Philosophical Novel', 4.6),
(32, 'The Kite Runner', 'Khaled Hosseini', NULL, NULL, 'First', 'Riverhead Books', 'Available', 371, 'Historical Fiction', 4.5),
(33, 'The Time Traveler\'s Wife', 'Audrey Niffenegger', NULL, NULL, 'First', 'MacAdam/Cage', 'Available', 519, 'Romance', 4.4),
(34, 'Shantaram', 'Gregory David Roberts', NULL, NULL, 'First', 'Scribe Publications', 'Available', 936, 'Autobiographical Novel', 4.8),
(35, 'The Pillars of the Earth', 'Ken Follett', NULL, NULL, 'First', 'William Morrow and Company', 'Available', 973, 'Historical Novel', 4.3),
(36, 'The Name of the Wind', 'Patrick Rothfuss', NULL, NULL, 'First', 'DAW Books', 'Available', 662, 'Fantasy', 4.2),
(37, 'The Martian', 'Andy Weir', NULL, NULL, 'First', 'Crown Publishing Group', 'Available', 384, 'Sci-Fi', 4.9),
(38, 'Gone Girl', 'Gillian Flynn', NULL, NULL, 'First', 'Crown Publishing Group', 'Available', 422, 'Psychological Thriller', 4.7),
(39, 'The Help', 'Kathryn Stockett', NULL, NULL, 'First', 'Amy Einhorn Books', 'Available', 444, 'Historical Fiction', 4.6),
(40, 'The Night Circus', 'Erin Morgenstern', NULL, NULL, 'First', 'Doubleday', 'Available', 387, 'Fantasy', 4.5);

-- --------------------------------------------------------

--
-- Table structure for table `incharge`
--

CREATE TABLE `incharge` (
  `Id` int NOT NULL,
  `FName` varchar(50) NOT NULL,
  `MName` varchar(50) DEFAULT NULL,
  `LName` varchar(50) NOT NULL,
  `PhoneNo` varchar(11) NOT NULL,
  `Designation` varchar(20) NOT NULL,
  `Remark` varchar(50) DEFAULT NULL,
  `Tier` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `incharge`
--

INSERT INTO `incharge` (`Id`, `FName`, `MName`, `LName`, `PhoneNo`, `Designation`, `Remark`, `Tier`) VALUES
(1, 'Tanishq', NULL, 'Mehrunkar', '7024888951', 'Incharge-Head', NULL, '3');

-- --------------------------------------------------------

--
-- Table structure for table `incharge_auth`
--

CREATE TABLE `incharge_auth` (
  `Id` int NOT NULL,
  `InchargeId` int NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `incharge_auth`
--

INSERT INTO `incharge_auth` (`Id`, `InchargeId`, `Email`, `Password`) VALUES
(1, 1, 'mehrunkart@gmail.com', '$2y$10$QK6JCIz8fWO4AlqFpDvRAeWhSfJyEJ4t2ZzTHCStp1yjO4Wo0SNpq');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int NOT NULL,
  `FName` varchar(15) NOT NULL,
  `MName` varchar(15) DEFAULT NULL,
  `LName` varchar(15) DEFAULT NULL,
  `PhoneNo` varchar(11) NOT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `Affiliation` varchar(30) DEFAULT NULL,
  `Remark` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `FName`, `MName`, `LName`, `PhoneNo`, `Address`, `Affiliation`, `Remark`) VALUES
(1, 'Tanishq', NULL, 'Mehrunkar', '7024888951', NULL, NULL, NULL),
(7, 'zakie', 'mohd', 'khan', '1234567890', '72,Ram Nagar', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `member_auth`
--

CREATE TABLE `member_auth` (
  `Id` int NOT NULL,
  `MemberId` int NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` varchar(50) DEFAULT 'Active',
  `BanReason` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `member_auth`
--

INSERT INTO `member_auth` (`Id`, `MemberId`, `Email`, `Password`, `Status`, `BanReason`) VALUES
(5, 7, 'zk.khan2003@gmail.com', '$2y$10$HicbO.sXDkMNIK6KnRsmPeU5yCJsbdF7bQvNLLNfS32SHQu6vQkEe', 'Active', NULL),
(6, 1, 'servera931@gmail.com', '$2y$10$iPzJ9t8Vhen3fvYgG9RI8esxpaS9IsLw0DUTZwhMBGWjak/7257ha', 'Active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int NOT NULL,
  `member_email` varchar(255) COLLATE utf8mb3_bin NOT NULL,
  `BookNo` int NOT NULL,
  `Status` varchar(50) COLLATE utf8mb3_bin NOT NULL,
  `Created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `member_email`, `BookNo`, `Status`, `Created_date`) VALUES
(1, 'servera931@gmail.com', 3, 'Pending', '2025-05-29 16:33:44');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `Id` int NOT NULL,
  `BookNo` int NOT NULL,
  `BorrowerId` int NOT NULL,
  `LibrarianId` int NOT NULL,
  `BorrowDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReturnDate` timestamp NULL DEFAULT NULL,
  `Remark` varchar(40) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`Id`, `BookNo`, `BorrowerId`, `LibrarianId`, `BorrowDate`, `ReturnDate`, `Remark`, `Status`) VALUES
(1, 3, 1, 1, '2025-03-23 06:51:22', '2025-03-23 06:51:22', NULL, NULL),
(2, 3, 1, 1, '2025-03-23 06:52:33', '2025-03-23 06:52:33', NULL, NULL),
(3, 2, 1, 1, '2025-03-28 11:55:21', '2025-03-28 11:55:21', NULL, NULL),
(4, 1, 1, 1, '2025-03-28 12:03:44', '2025-03-28 13:03:44', NULL, NULL),
(5, 2, 1, 1, '2025-03-28 12:03:44', '2025-03-28 14:03:44', NULL, NULL),
(6, 3, 1, 1, '2025-03-28 12:03:44', '2025-03-28 15:03:44', NULL, NULL),
(7, 4, 1, 1, '2025-03-28 12:03:44', '2025-03-28 16:03:44', NULL, NULL),
(8, 5, 1, 1, '2025-03-28 12:03:44', '2025-03-28 17:03:44', NULL, NULL),
(9, 6, 1, 1, '2025-03-28 12:03:44', '2025-03-28 18:03:44', NULL, NULL),
(10, 7, 1, 1, '2025-03-28 12:03:44', '2025-03-28 19:03:44', NULL, NULL),
(11, 8, 1, 1, '2025-03-28 12:03:44', '2025-03-28 20:03:44', NULL, NULL),
(12, 9, 1, 1, '2025-03-28 12:03:44', '2025-03-28 21:03:44', NULL, NULL),
(13, 10, 1, 1, '2025-03-28 12:03:44', '2025-03-28 22:03:44', NULL, NULL),
(14, 11, 1, 1, '2025-03-28 12:03:44', '2025-03-28 23:03:44', NULL, NULL),
(15, 12, 1, 1, '2025-03-28 12:03:44', '2025-03-29 00:03:44', NULL, NULL),
(16, 13, 1, 1, '2025-03-28 12:03:44', '2025-03-29 01:03:44', NULL, NULL),
(17, 14, 1, 1, '2025-03-28 12:03:44', '2025-03-29 02:03:44', NULL, NULL),
(18, 15, 1, 1, '2025-03-28 12:03:44', '2025-03-29 03:03:44', NULL, NULL),
(19, 16, 1, 1, '2025-03-28 12:03:44', '2025-03-29 04:03:44', NULL, NULL),
(20, 17, 1, 1, '2025-03-28 12:03:44', '2025-03-29 05:03:44', NULL, NULL),
(21, 18, 1, 1, '2025-03-28 12:03:44', '2025-03-29 06:03:44', NULL, NULL),
(22, 19, 1, 1, '2025-03-28 12:03:44', '2025-03-29 07:03:44', NULL, NULL),
(23, 20, 1, 1, '2025-03-28 12:03:44', '2025-03-29 08:03:44', NULL, NULL),
(24, 21, 1, 1, '2025-03-28 12:03:44', '2025-03-29 09:03:44', NULL, NULL),
(25, 22, 1, 1, '2025-03-28 12:03:44', '2025-03-29 10:03:44', NULL, NULL),
(26, 23, 1, 1, '2025-03-28 12:03:44', '2025-03-29 11:03:44', NULL, NULL),
(27, 24, 1, 1, '2025-03-28 12:03:44', '2025-03-29 12:03:44', NULL, NULL),
(28, 25, 1, 1, '2025-03-28 12:03:44', '2025-03-29 13:03:44', NULL, NULL),
(29, 26, 1, 1, '2025-03-28 12:03:44', '2025-03-29 14:03:44', NULL, NULL),
(30, 27, 1, 1, '2025-03-28 12:03:44', '2025-03-29 15:03:44', NULL, NULL),
(31, 28, 1, 1, '2025-03-28 12:03:44', '2025-03-29 16:03:44', NULL, NULL),
(32, 29, 1, 1, '2025-03-28 12:03:44', '2025-03-29 17:03:44', NULL, NULL),
(33, 30, 1, 1, '2025-03-28 12:03:44', '2025-03-29 18:03:44', NULL, NULL),
(34, 31, 1, 1, '2025-03-28 12:03:44', '2025-03-29 19:03:44', NULL, NULL),
(35, 32, 1, 1, '2025-03-28 12:03:44', '2025-03-29 20:03:44', NULL, NULL),
(36, 33, 1, 1, '2025-03-28 12:03:44', '2025-03-29 21:03:44', NULL, NULL),
(37, 34, 1, 1, '2025-03-28 12:03:44', '2025-03-29 22:03:44', NULL, NULL),
(38, 35, 1, 1, '2025-03-28 12:03:44', '2025-03-29 23:03:44', NULL, NULL),
(39, 36, 1, 1, '2025-03-28 12:03:44', '2025-03-30 00:03:44', NULL, NULL),
(40, 37, 1, 1, '2025-03-28 12:03:44', '2025-03-30 01:03:44', NULL, NULL),
(41, 38, 1, 1, '2025-03-28 12:03:44', '2025-03-30 02:03:44', NULL, NULL),
(42, 39, 1, 1, '2025-03-28 12:03:44', '2025-03-30 03:03:44', NULL, NULL),
(43, 40, 1, 1, '2025-03-28 12:03:44', '2025-03-30 04:03:44', NULL, NULL),
(44, 1, 1, 1, '2025-03-28 12:13:33', '2025-03-28 12:13:33', NULL, NULL),
(45, 1, 1, 1, '2025-03-28 12:13:57', '2025-03-28 12:13:57', NULL, NULL),
(46, 1, 1, 1, '2025-05-25 11:41:24', '2025-05-25 11:41:24', NULL, NULL),
(47, 1, 1, 1, '2025-05-25 11:41:32', NULL, NULL, NULL),
(48, 5, 1, 1, '2025-05-25 12:15:19', '2025-05-25 12:15:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unverified`
--

CREATE TABLE `unverified` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `user_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_master`
--
ALTER TABLE `book_master`
  ADD PRIMARY KEY (`BookNo`);

--
-- Indexes for table `incharge`
--
ALTER TABLE `incharge`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `incharge_auth`
--
ALTER TABLE `incharge_auth`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `InchargeId` (`InchargeId`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_auth`
--
ALTER TABLE `member_auth`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `MemberId` (`MemberId`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `BookNo` (`BookNo`),
  ADD KEY `BorrowerId` (`BorrowerId`),
  ADD KEY `LibrarianId` (`LibrarianId`);

--
-- Indexes for table `unverified`
--
ALTER TABLE `unverified`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incharge`
--
ALTER TABLE `incharge`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `incharge_auth`
--
ALTER TABLE `incharge_auth`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `member_auth`
--
ALTER TABLE `member_auth`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `unverified`
--
ALTER TABLE `unverified`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incharge_auth`
--
ALTER TABLE `incharge_auth`
  ADD CONSTRAINT `incharge_auth_ibfk_1` FOREIGN KEY (`InchargeId`) REFERENCES `incharge` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `member_auth`
--
ALTER TABLE `member_auth`
  ADD CONSTRAINT `member_auth_ibfk_1` FOREIGN KEY (`MemberId`) REFERENCES `member` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`BookNo`) REFERENCES `book_master` (`BookNo`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`LibrarianId`) REFERENCES `incharge` (`Id`),
  ADD CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`BorrowerId`) REFERENCES `member` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
