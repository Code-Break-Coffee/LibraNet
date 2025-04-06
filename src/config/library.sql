-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Apr 06, 2025 at 11:40 AM
-- Server version: 5.7.44-log
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_master`
--

CREATE TABLE `book_master` (
  `BookNo` int(11) NOT NULL,
  `Title` varchar(40) NOT NULL,
  `Author1` varchar(40) NOT NULL,
  `Author2` varchar(40) DEFAULT NULL,
  `Author3` varchar(40) DEFAULT NULL,
  `Edition` varchar(10) NOT NULL,
  `Publisher` varchar(40) NOT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Pages` int(11) DEFAULT NULL,
  `Remark` varchar(50) DEFAULT NULL,
  `Rating` float DEFAULT NULL,
  `InsertDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_master`
--

INSERT INTO `book_master` (`BookNo`, `Title`, `Author1`, `Author2`, `Author3`, `Edition`, `Publisher`, `Status`, `Pages`, `Remark`, `Rating`, `InsertDate`) VALUES
(1, 'The Lord of the Rings', 'J.R.R. Tolkien', NULL, NULL, 'Extended', 'Allen & Unwin', 'Available', 1216, 'Classic Fantasy', 4.8, NULL),
(2, 'Pride and Prejudice', 'Jane Austen', NULL, NULL, 'Original', 'T. Egerton', 'Available', 432, 'Romantic Novel', 4.5, NULL),
(3, 'Dune', 'Frank Herbert', NULL, NULL, 'First', 'Chilton Books', 'Borrowed', 896, 'Sci-Fi Epic', 4.7, NULL),
(4, 'The Hitchhiker\'s Guide to the Galaxy', 'Douglas Adams', NULL, NULL, 'Revised', 'Pan Books', 'Available', 224, 'Sci-Fi Comedy', 4.6, NULL),
(5, '1984', 'George Orwell', 'hilo', '', 'First', 'Secker & Warburg', 'Available', 328, 'Dystopian', 4.4, NULL),
(9, 'One Hundred Years of Solitude', 'Gabriel García Márquez', NULL, NULL, 'First', 'Editorial Sudamericana', 'Available', 417, 'Magical Realism', 4.7, NULL),
(10, 'Brave New World', 'Aldous Huxley', NULL, NULL, 'First', 'Chatto & Windus', 'Borrowed', 268, 'Dystopian', 4.1, NULL),
(11, 'Foundation', 'Isaac Asimov', NULL, NULL, 'First', 'Gnome Press', 'Available', 255, 'Sci-Fi Series', 4.6, NULL),
(12, 'The Catcher in the Rye', 'J.D. Salinger', NULL, NULL, 'First', 'Little, Brown and Company', 'Available', 277, 'Coming-of-Age', 4, NULL),
(13, 'Crime and Punishment', 'Fyodor Dostoevsky', NULL, NULL, 'First', 'The Russian Messenger', 'Available', 671, 'Psychological Thriller', 4.8, NULL),
(14, 'Jane Eyre', 'Charlotte Brontë', NULL, NULL, 'First', 'Smith, Elder & Co.', 'Borrowed', 532, 'Gothic Romance', 4.5, NULL),
(15, 'The Hobbit', 'J.R.R. Tolkien', NULL, NULL, 'First', 'Allen & Unwin', 'Available', 310, 'Fantasy Adventure', 4.7, NULL),
(16, 'The Color Purple', 'Alice Walker', NULL, NULL, 'First', 'Harcourt Brace Jovanovich', 'Available', 245, 'Epistolary Novel', 4.6, NULL),
(17, 'Wuthering Heights', 'Emily Brontë', NULL, NULL, 'First', 'T. C. Newby', 'Available', 342, 'Gothic Romance', 4.3, NULL),
(18, 'Slaughterhouse-Five', 'Kurt Vonnegut', NULL, NULL, 'First', 'Delacorte Press', 'Borrowed', 275, 'Anti-War Novel', 4.2, NULL),
(19, 'The Handmaid\'s Tale', 'Margaret Atwood', NULL, NULL, 'First', 'McClelland and Stewart', 'Available', 311, 'Dystopian', 4.8, NULL),
(20, 'The Book Thief', 'Markus Zusak', NULL, NULL, 'First', 'Alfred A. Knopf', 'Available', 576, 'Historical Fiction', 4.9, NULL),
(21, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', NULL, NULL, 'First', 'Bloomsbury', 'Available', 309, 'Fantasy', 4.7, NULL),
(22, 'The Da Vinci Code', 'Dan Brown', NULL, NULL, 'First', 'Doubleday', 'Borrowed', 454, 'Mystery Thriller', 4.1, NULL),
(23, 'Life of Pi', 'Yann Martel', NULL, NULL, 'First', 'Knopf Canada', 'Available', 319, 'Adventure Fiction', 4.5, NULL),
(24, 'The Girl with the Dragon Tattoo', 'Stieg Larsson', NULL, NULL, 'First', 'Norstedts Förlag', 'Available', 464, 'Crime Thriller', 4.6, NULL),
(25, 'The Hunger Games', 'Suzanne Collins', NULL, NULL, 'First', 'Scholastic Press', 'Borrowed', 374, 'Dystopian', 4.4, NULL),
(26, 'Little Women', 'Louisa May Alcott', NULL, NULL, 'First', 'Roberts Brothers', 'Available', 541, 'Coming-of-Age', 4.8, NULL),
(27, 'The Road', 'Cormac McCarthy', NULL, NULL, 'First', 'Alfred A. Knopf', 'Available', 241, 'Post-Apocalyptic', 4.3, NULL),
(28, 'Catch-22', 'Joseph Heller', NULL, NULL, 'First', 'Simon & Schuster', 'Available', 453, 'Satirical Novel', 4.2, NULL),
(29, 'A Game of Thrones', 'George R.R. Martin', NULL, NULL, 'First', 'Bantam Books', 'Borrowed', 694, 'Fantasy Epic', 4.9, NULL),
(30, 'The Shadow of the Wind', 'Carlos Ruiz Zafón', NULL, NULL, 'First', 'Planeta', 'Available', 561, 'Historical Mystery', 4.7, NULL),
(31, 'The Alchemist', 'Paulo Coelho', NULL, NULL, 'First', 'HarperCollins', 'Available', 197, 'Philosophical Novel', 4.6, NULL),
(32, 'The Kite Runner', 'Khaled Hosseini', NULL, NULL, 'First', 'Riverhead Books', 'Borrowed', 371, 'Historical Fiction', 4.5, NULL),
(33, 'The Time Traveler\'s Wife', 'Audrey Niffenegger', NULL, NULL, 'First', 'MacAdam/Cage', 'Available', 519, 'Romance', 4.4, NULL),
(34, 'Shantaram', 'Gregory David Roberts', NULL, NULL, 'First', 'Scribe Publications', 'Available', 936, 'Autobiographical Novel', 4.8, NULL),
(35, 'The Pillars of the Earth', 'Ken Follett', NULL, NULL, 'First', 'William Morrow and Company', 'Borrowed', 973, 'Historical Novel', 4.3, NULL),
(36, 'The Name of the Wind', 'Patrick Rothfuss', NULL, NULL, 'First', 'DAW Books', 'Available', 662, 'Fantasy', 4.2, NULL),
(37, 'The Martian', 'Andy Weir', NULL, NULL, 'First', 'Crown Publishing Group', 'Available', 384, 'Sci-Fi', 4.9, NULL),
(38, 'Gone Girl', 'Gillian Flynn', NULL, NULL, 'First', 'Crown Publishing Group', 'Borrowed', 422, 'Psychological Thriller', 4.7, NULL),
(39, 'The Help', 'Kathryn Stockett', NULL, NULL, 'First', 'Amy Einhorn Books', 'Available', 444, 'Historical Fiction', 4.6, NULL),
(40, 'The Night Circus', 'Erin Morgenstern', NULL, NULL, 'First', 'Doubleday', 'Available', 387, 'Fantasy', 4.5, NULL),
(41, 'zak tale', 'zak', '', '', 'First', 'Secker & Warburg', 'Available', 328, 'Dystopian', 0, NULL),
(42, 'a', 'a', 'a', 'a', 'First', 'Secker & Warburg', 'Available', 328, 'Dystopian', 0, NULL),
(43, 'zak tale', 'zak', '', '', 'First', 'Secker & Warburg', 'Available', 328, 'Dystopian', 0, NULL),
(44, 'zak tale', 'zak', 'a', '', 'First', 'Secker & Warburg', 'Available', 328, 'Dystopian', 0, '2025-03-29 13:54:10'),
(45, 'tehytjy', 'rehtj', '', '', '6', 'Secker & Warburg', 'Available', 328, 'Dystopian', 0, '2025-04-06 11:17:04'),
(46, 'tanishq ki bnook', 'zak', '', '', 'First', 'tanishq', 'Available', 34444, 'Dystopian', 0, '2025-04-06 11:30:42'),
(47, 'tanishq ki bnook', 'zak', '', '', 'First', 'tanishq', 'Available', 34444, 'Dystopian', 0, '2025-04-06 11:32:02'),
(48, 'tanishq ki bnook', 'zak', 'hilo', '', 'First', 'tanishq', 'Available', 328, 'Dystopian', 0, '2025-04-06 11:32:18'),
(49, 'tanishq ki bnook', 'zak', '', '', 'First', 'tanishq', 'Available', 328, 'Dystopian', 0, '2025-04-06 11:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `incharge`
--

CREATE TABLE `incharge` (
  `Id` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `MName` varchar(50) DEFAULT NULL,
  `LName` varchar(50) NOT NULL,
  `PhoneNo` varchar(11) NOT NULL,
  `Designation` varchar(20) NOT NULL,
  `Remark` varchar(50) DEFAULT NULL,
  `Tier` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incharge`
--

INSERT INTO `incharge` (`Id`, `FName`, `MName`, `LName`, `PhoneNo`, `Designation`, `Remark`, `Tier`) VALUES
(1, 'Tanishq', NULL, 'Mehrunkar', '7024888951', 'Incharge-Head', NULL, '1'),
(4, 'zakie', NULL, 'khan', '1234567890', 'dceg', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `incharge_auth`
--

CREATE TABLE `incharge_auth` (
  `Id` int(11) NOT NULL,
  `InchargeId` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incharge_auth`
--

INSERT INTO `incharge_auth` (`Id`, `InchargeId`, `Email`, `Password`) VALUES
(1, 1, 'mehrunkart@gmail.com', '$2y$10$iPzJ9t8Vhen3fvYgG9RI8esxpaS9IsLw0DUTZwhMBGWjak/7257ha'),
(4, 4, 'zak2022.khan@gmail.com', '$2y$10$Pd/73bULASxqyUdIZKfmUes./YeVCfrNzE5TrpnUM62nyIf3rnqdm');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `FName` varchar(15) NOT NULL,
  `MName` varchar(15) DEFAULT NULL,
  `LName` varchar(15) DEFAULT NULL,
  `PhoneNo` varchar(11) NOT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `Affiliation` varchar(30) DEFAULT NULL,
  `Remark` varchar(30) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `FName`, `MName`, `LName`, `PhoneNo`, `Address`, `Affiliation`, `Remark`, `CreatedAt`) VALUES
(1, 'Tanishq', NULL, 'Mehrunkar', '7024888951', NULL, NULL, NULL, '2025-04-06 17:05:35'),
(7, 'zakie', 'mohd', 'khan', '1234567890', '72,Ram Nagar', '', '', '2025-04-06 17:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `member_auth`
--

CREATE TABLE `member_auth` (
  `Id` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` varchar(50) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_auth`
--

INSERT INTO `member_auth` (`Id`, `MemberId`, `Email`, `Password`, `Status`) VALUES
(5, 7, 'zk.khan2003@gmail.com', '$2y$10$HicbO.sXDkMNIK6KnRsmPeU5yCJsbdF7bQvNLLNfS32SHQu6vQkEe', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `Id` int(11) NOT NULL,
  `BookNo` int(11) NOT NULL,
  `BorrowerId` int(11) NOT NULL,
  `LibrarianId` int(11) NOT NULL,
  `BorrowDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReturnDate` timestamp NULL DEFAULT NULL,
  `Remark` varchar(40) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `unverified`
--

CREATE TABLE `unverified` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_type` varchar(50) COLLATE utf8_bin NOT NULL,
  `code` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
-- AUTO_INCREMENT for table `book_master`
--
ALTER TABLE `book_master`
  MODIFY `BookNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `incharge`
--
ALTER TABLE `incharge`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `incharge_auth`
--
ALTER TABLE `incharge_auth`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `member_auth`
--
ALTER TABLE `member_auth`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unverified`
--
ALTER TABLE `unverified`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
