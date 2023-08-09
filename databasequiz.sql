-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 09:50 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databasequiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `long_url` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `visit_count` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `long_url`, `slug`, `visit_count`) VALUES
(13, 'jokowi', '$2y$10$g7Tcgr8PbCxAD1BgNIQgeOoJRH9stkUeLouuwDGPCth3Dlzng8iW6', '', '', ''),
(14, 'jokowi', '', 'https://www.google.com/search?rlz=1C5CHFA_enID1013ID1013&sxsrf=AB5stBj2ygrXyu18TKTPZoxsqzxpe5swrw:1688968128721&q=karet&tbm=isch&sa=X&ved=2ahUKEwixqeXKuIOAAxX_3zgGHfq-Bt8Q0pQJegQIDxAB&biw=1440&bih=654&dpr=2', 'link-info-karet2023', '3'),
(15, 'jokowi', '', 'https://www.google.com/search?rlz=1C5CHFA_enID1013ID1013&sxsrf=AB5stBj2ygrXyu18TKTPZoxsqzxpe5swrw:1688968128721&q=karet&tbm=isch&sa=X&ved=2ahUKEwixqeXKuIOAAxX_3zgGHfq-Bt8Q0pQJegQIDxAB&biw=1440&bih=654&dpr=2', 'link-info-karet2023', '2'),
(16, 'mamang', '$2y$10$Pd3NygleirRWM/MZOsbRTu5isqPlhAP95aXEu1C3QMXphC6bMYUFm', '', '', ''),
(17, 'mamang', '', 'https://www.google.com/search?rlz=1C5CHFA_enID1013ID1013&sxsrf=AB5stBj2ygrXyu18TKTPZoxsqzxpe5swrw:1688968128721&q=karet&tbm=isch&sa=X&ved=2ahUKEwixqeXKuIOAAxX_3zgGHfq-Bt8Q0pQJegQIDxAB&biw=1440&bih=654&dpr=2', 'link-info-karet2023', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
