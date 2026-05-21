-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2026 at 08:35 AM
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
-- Database: `livreor`
--

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int NOT NULL,
  `commentaire` text NOT NULL,
  `id_utilisateur` int NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_utilisateur`, `date`) VALUES
(5, 'Merci pour ce magnifique livre d\'or ;)', 5, '2025-11-05 15:42:03'),
(6, 'Ce livre d\'or est vraiment magnifique !', 4, '2025-11-06 10:08:07'),
(7, 'Ce vert Lacoste est une réussite !', 3, '2025-11-06 10:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'Emma', '$2y$10$Xwc2q.kvwr1RNKHLsDG6uuDy.84rbD/uWoBCcQYol3hZxGmmgGsv.'),
(2, 'Emmanuelle', '$2y$10$Qiyz4dYZBP1Wk0VN4FXds.ttPLv2xX7.JcV5j790F0JXzRDcvyIz2'),
(3, 'Mathilde', '$2y$10$J5i2xnNzqcVwGFfyBVQa1.IH6EY5g47.Ltb/AMkd8zC7y8XOd/TUO'),
(4, 'Patoche', '$2y$10$LyO6AM0WxpzLCCobyiD0oeSKvzyPWqAM2NJG43b2Zgn63TcS1JMae'),
(5, 'Pascal', '$2y$10$PMdoTuvjFfJ1VCe7XcPSgem9u1b8KN6IKhNiTIElNZsJbbbmQumwW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
