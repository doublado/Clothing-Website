-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 01. 02 2023 kl. 12:43:39
-- Serverversion: 10.4.20-MariaDB
-- PHP-version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothing`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `clothing`
--

CREATE TABLE `clothing` (
  `id` int(11) NOT NULL,
  `storeid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `clothing`
--

INSERT INTO `clothing` (`id`, `storeid`, `title`, `type`, `price`, `description`, `image`, `created_at`) VALUES
(1, '63da1a8578515', 'test', 'T-Shirt', 100, 'test', '63da23cf44f64.png', '2023-02-01 09:33:19');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `storeid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `ownerid` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `stores`
--

INSERT INTO `stores` (`id`, `storeid`, `name`, `email`, `description`, `image`, `ownerid`, `created_at`) VALUES
(1, '63da1a8578515', 'test', 'test@gmail.com', 'test', '63da1a85786bf.png', '63d910209d91d', '2023-02-01 08:53:41');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `userid`, `username`, `password`, `created_at`) VALUES
(1, '63d910209d91d', 'test', '$2y$10$t.QFT8eRGPgEhKs.nldeCewgEv0ENwBErnbNSTsYG5bl.Azxf7x6O', '2023-01-31 13:57:04'),
(2, '63da1a9665097', 'doublado', '$2y$10$UD/WzLh/AFEMQ0dVX30cN.mrG.478j25w8spV9HW572U992Cx0ESm', '2023-02-01 08:53:58');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `clothing`
--
ALTER TABLE `clothing`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `storeid` (`storeid`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `clothing`
--
ALTER TABLE `clothing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tilføj AUTO_INCREMENT i tabel `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
