-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 05:29 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbbuku`
--

CREATE TABLE `tbbuku` (
  `buku_id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `penulis` varchar(255) DEFAULT NULL,
  `kategori_id` int(11) NOT NULL,
  `sinopsis` text DEFAULT NULL,
  `jumlah_halaman` int(11) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `tahun_terbit` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbbuku`
--

INSERT INTO `tbbuku` (`buku_id`, `judul`, `penulis`, `kategori_id`, `sinopsis`, `jumlah_halaman`, `penerbit`, `tahun_terbit`, `image`) VALUES
(1, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 1, 'A young boy discovers he is a wizard and enrolls in a magical school.', 320, 'Bloomsbury', 1997, 'harry_potter.jpg'),
(2, 'To Kill a Mockingbird', 'Harper Lee', 2, 'A young girl learns about racial injustice in the Deep South during the 1930s.', 281, 'J. B. Lippincott & Co.', 1960, 'to_kill_a_mockingbird.jpg'),
(3, 'The Great Gatsby', 'F. Scott Fitzgerald', 2, 'A man becomes entangled in the decadent world of the wealthy during the Jazz Age.', 180, 'Charles Scribner\'s Sons', 1925, 'the_great_gatsby.jpg'),
(4, 'Pride and Prejudice', 'Jane Austen', 4, 'A spirited young woman navigates the challenges of love and societal expectations.', 432, 'T. Egerton, Whitehall', 1813, 'pride_and_prejudice.jpg'),
(5, '1984', 'George Orwell', 5, 'In a totalitarian society, a man rebels against the oppressive regime.', 328, 'Secker & Warburg', 1949, '1984.jpg'),
(6, 'The Catcher in the Rye', 'J.D. Salinger', 6, 'A teenager struggles with identity, conformity, and the phoniness of the adult world.', 224, 'Little, Brown and Company', 1951, 'catcher_in_the_rye.jpg'),
(7, 'To Kill a Kingdom', 'Alexandra Christo', 7, 'A siren princess must kill a prince to reclaim her siren-hunting abilities.', 352, 'Feiwel & Friends', 2018, 'to_kill_a_kingdom.jpg'),
(8, 'The Hobbit', 'J.R.R. Tolkien', 1, 'A hobbit embarks on an unexpected adventure to help reclaim a treasure from a dragon.', 310, 'Allen & Unwin', 1937, 'the_hobbit.jpg'),
(9, 'The Alchemist', 'Paulo Coelho', 8, 'A shepherd boy follows his dreams and goes on a journey in search of a hidden treasure.', 197, 'HarperCollins', 1988, 'the_alchemist.jpg'),
(10, 'The Hunger Games', 'Suzanne Collins', 5, 'In a dystopian future, a girl volunteers to participate in a brutal televised game to save her sister.', 374, 'Scholastic Corporation', 2008, 'the_hunger_games.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbfavorite`
--

CREATE TABLE `tbfavorite` (
  `favorite_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `buku_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbfavorite`
--

INSERT INTO `tbfavorite` (`favorite_id`, `user_id`, `buku_id`) VALUES
(2, 1, 8),
(4, 1, 9),
(5, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbkategori`
--

CREATE TABLE `tbkategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbkategori`
--

INSERT INTO `tbkategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Classic'),
(6, 'Coming-of-age'),
(5, 'Dystopian'),
(1, 'Fantasy'),
(8, 'Fiction'),
(4, 'Romance'),
(13, 'tes'),
(7, 'Young Adult');

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`user_id`, `username`, `email`, `password`, `role`) VALUES
(0, 'austin', 'austin@gmail.com', 'austin123', 'admin'),
(1, 'hansel123', 'hansel@gmail.com', 'hansel123', 'user'),
(2, 'coba', 'coba2@gmail.com', '123123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbbuku`
--
ALTER TABLE `tbbuku`
  ADD PRIMARY KEY (`buku_id`),
  ADD KEY `book_FK_kategori` (`kategori_id`);

--
-- Indexes for table `tbfavorite`
--
ALTER TABLE `tbfavorite`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indexes for table `tbkategori`
--
ALTER TABLE `tbkategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbbuku`
--
ALTER TABLE `tbbuku`
  MODIFY `buku_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbfavorite`
--
ALTER TABLE `tbfavorite`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbkategori`
--
ALTER TABLE `tbkategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbbuku`
--
ALTER TABLE `tbbuku`
  ADD CONSTRAINT `book_FK_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `tbkategori` (`id_kategori`);

--
-- Constraints for table `tbfavorite`
--
ALTER TABLE `tbfavorite`
  ADD CONSTRAINT `tbfavorite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbuser` (`user_id`),
  ADD CONSTRAINT `tbfavorite_ibfk_2` FOREIGN KEY (`buku_id`) REFERENCES `tbbuku` (`buku_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
