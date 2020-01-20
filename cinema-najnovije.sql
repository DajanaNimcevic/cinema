-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2019 at 03:01 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id_movie` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lengthMin` int(11) NOT NULL,
  `trailer_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imdb_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id_movie`, `title`, `description`, `lengthMin`, `trailer_link`, `picture`, `imdb_link`) VALUES
(2, 'da li radi', '123 to je to', 180, 'https://www.youtube.com/watch?v=3oXOu32MM1Q&list=OLAK5uy_mbiRc-WQKXNRCfAeZBsoA-hILP3Oeu2WU&index=15', '250px-Felix_Sotomayor_-_Silmarils.jpg', 'https://www.imdb.com/123'),
(3, 'Proba', 'idemo', 180, 'https://www.youtube.com/7897', 'Book Lamp You Are My Sunshine Android Wallpaper.jpg', 'https://www.imdb.com/123');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_screening` int(11) NOT NULL,
  `res_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `screening`
--

CREATE TABLE `screening` (
  `id_screening` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  `start` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `screening`
--

INSERT INTO `screening` (`id_screening`, `id_movie`, `start`) VALUES
(3, 2, '2020-11-11 11:11:00'),
(5, 3, '2020-12-05 17:52:00'),
(7, 2, '2020-12-03 11:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id_seat` int(11) NOT NULL,
  `row` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seat_reserved`
--

CREATE TABLE `seat_reserved` (
  `id_sres` int(11) NOT NULL,
  `id_seat` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_screening` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `admin`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 1),
(20, 'proba', 'proba', 'proba@gmail.com', 0),
(21, 'radi', 'kompanjon123', 'jessss@gmail.com', 0),
(22, 'hash', '$2y$10$qG6AEOfy1Rk6teREDqyWTuf/u9Ldv1ietRd0fPXdSocauSoVacPda', 'hash@gmail.com', 0),
(23, 'novo', '$2y$10$71l90iCIyt9jwOB8KfN3de9k3r47so4Lc2uH6vAdx4lgsa7SspwTu', 'novo@gmail.com', 0),
(24, 'milos', '$2y$10$1Ia9p/YPms.PvdIl2d.aou5WcCEe31ts5U5oV6S6PIKEvg6.X4KEu', 'milos@gmail.com', 0),
(25, 'probic', '$2y$10$HW22.KOa1oeyuOqR9hQ8BebdLyFx7Q4/YaDEKkT0YC3XKj.dn5nV.', 'probic@gmail.com', 0),
(26, 'najnovije', '$2y$10$mQpCLUZMHNR7tV80TK6yxuW3mxjBvJPtqYbN.CUtQBpHdg7/ZvVbe', 'najnovije@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id_movie`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `FK_id_korisnik` (`id_user`),
  ADD KEY `FK_id_screening` (`id_screening`);

--
-- Indexes for table `screening`
--
ALTER TABLE `screening`
  ADD PRIMARY KEY (`id_screening`),
  ADD KEY `FK_id_movie` (`id_movie`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`id_seat`);

--
-- Indexes for table `seat_reserved`
--
ALTER TABLE `seat_reserved`
  ADD PRIMARY KEY (`id_sres`),
  ADD KEY `FK_id_seat` (`id_seat`),
  ADD KEY `FK_id_screen` (`id_screening`),
  ADD KEY `FK_id_reservation` (`id_reservation`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id_movie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `screening`
--
ALTER TABLE `screening`
  MODIFY `id_screening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `id_seat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seat_reserved`
--
ALTER TABLE `seat_reserved`
  MODIFY `id_sres` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_id_korisnik` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_id_screening` FOREIGN KEY (`id_screening`) REFERENCES `screening` (`id_screening`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `screening`
--
ALTER TABLE `screening`
  ADD CONSTRAINT `FK_id_movie` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `seat_reserved`
--
ALTER TABLE `seat_reserved`
  ADD CONSTRAINT `FK_id_reservation` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id_reservation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_id_screen` FOREIGN KEY (`id_screening`) REFERENCES `screening` (`id_screening`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_id_seat` FOREIGN KEY (`id_seat`) REFERENCES `seat` (`id_seat`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
