-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 11:04 PM
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
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `ID` int(11) NOT NULL,
  `auth_name` varchar(255) NOT NULL,
  `rec_name` varchar(255) NOT NULL,
  `rec_desc` varchar(500) NOT NULL,
  `dt_recipe` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`ID`, `auth_name`, `rec_name`, `rec_desc`, `dt_recipe`) VALUES
(33, 'naejacinto@gmail.com', 'Loaded Boursin Mashed Potatoes', 'Ingredients\r\n2 pounds unpeeled baby potatoes, halved\r\n\r\n1 teaspoon salt\r\n\r\n2 strips bacon\r\n\r\n1 (5.2 ounce) package gournay cheese, such as Boursin® Garlic and Fine Herbs Cheese, cut into chunks\r\n\r\n1/4 cup melted unsalted butter\r\n\r\n2 tablespoons freshly grated Parmesan cheese\r\n\r\n1/4 cup half-and-half\r\n\r\nsalt and freshly ground black pepper to taste\r\n\r\n1 tablespoon chopped parsley\r\n\r\nLocal Offers\r\n00000 Change\r\nOops! We cannot find any ingredients on sale near you. Do we have the correct zip code?', '2023-12-10 04:39:27'),
(34, 'andreasaez@gmail.com', 'Adobong Manok', 'Chicken, cut into serving pieces -- 2 1/2 to 3 pound\r\nWhite vinegar -- 3/4 cup\r\nSoy sauce -- 1/4 cup\r\nOnion, thinly sliced -- 1/2\r\nGarlic, crushed -- 4 to 6 cloves\r\nBay leaf -- 1-2\r\nPeppercorns -- 6 to 8\r\nSalt -- 1 teaspoon\r\nWater -- 1 cup\r\nOil -- 1/4 cup', '2023-12-10 04:48:05'),
(35, 'apgarcega0525@iskwela.psau.edu.ph', 'Tinolang Nokma', 'Ingredients:\r\n1 tablespoon canola oil\r\n1 small onion, peeled and sliced thinly\r\n3 cloves garlic, peeled and minced\r\n2 thumb-sized fresh ginger\r\n1 (3 to 4 pounds) whole chicken, cut into serving pieces\r\n2 tablespoons fish sauce\r\n5 cups water\r\n1 small green papaya, pared, seeded and cut into 2-inch wedges\r\n1 bunch fresh spinach leaves, stems trimmed\r\nsalt and pepper to taste', '2023-12-10 04:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userName`, `userPassword`, `security_question`, `security_answer`) VALUES
(14, 'xniert@gmail.com', '$2y$10$bcz0BMqFsyjKbur4s2fsPOYgK9GpB/iO5ZpGMChCaLmQLRUCkjFlK', 'What is your mother\'s maiden name?', 'Juanita Arcega'),
(15, 'naejacinto@gmail.com', '$2y$10$q.dgmnpGZ9r7I.HsHO3cW.U8Q1UtBc/.ijSSFf/RBKCeWnlEQGnVa', 'What is your mother\'s maiden name?', 'jovit'),
(16, 'andreasaez@gmail.com', '$2y$10$GrzF63S6mHRXuDrvkHbcteCvWH0qtKRLJdRd.jTUAa.Bb.C5nxaRm', 'What is your mother\'s maiden name?', 'eya'),
(17, 'apgarcega0525@iskwela.psau.edu.ph', '$2y$10$X16pimkKLi1SC0UVBUTMWODtzkcSeP/poVU.crpSpeANiBOPEBz9O', 'What is your mother\'s maiden name?', 'ban');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
