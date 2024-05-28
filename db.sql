-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Maj 28, 2024 at 03:11 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

drop database if exists recipe_blog;
create database recipe_blog;
use recipe_blog;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe_blog`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recipe`
--

CREATE TABLE `recipe` (
  `recipeID` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `instructions` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`recipeID`, `title`, `instructions`, `userID`) VALUES
(1, 'Pancakes', 'Mix all ingrediens inside a bowl and pour on heated pan', 1),
(2, 'Cooked eggs', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam non tempus risus. Duis lacinia dignissim massa, ac accumsan metus auctor malesuada. Praesent faucibus venenatis feugiat. Duis feugiat lacus vitae massa dictum congue. Mauris diam felis, fermentum ac pharetra quis, euismod vel erat. Phasellus vehicula et risus eget pharetra. Donec iaculis semper neque, ut rhoncus sem vehicula ac.Nullam hendrerit nec justo scelerisque iaculis. Proin ultrices elit justo, a malesuada urna vulputate id. Proin vulputate rhoncus ipsum sit amet hendrerit. Suspendisse potenti. In ut pretium lectus. Donec dui odio, porttitor quis interdum quis, eleifend imperdiet lorem. Ut feugiat nec urna sit.', 2),
(4, 'beetroot sandwich', 'Blitz the whole beetroot, ¾ of the chickpeas, 2 tbsp pesto and 1 tbsp oil in a food processor with some seasoning until you have a thick, smooth hummus. Heat the ciabatta following the pack instructions.&#13;&#10;Fry the remaining chickpeas in a little oil until crisp, then set aside. Toss the salad leaves with the remaining pesto and a splash of vinegar. Slice the rolls, then assemble the sandwiches with the hummus, beetroot slices, salad leaves and fried chickpeas.', 1),
(5, 'Cacio e pepe', 'Cook the pasta for 2 mins less than pack instructions state, in salted boiling water. Meanwhile, melt the butter in a medium frying pan over a low heat, then add the ground black pepper and toast for a few minutes.&#13;&#10;Drain the pasta, keeping 200ml of the pasta water. Tip the pasta and 100ml of the pasta water into the pan with the butter and pepper. Toss briefly, then scatter over the parmesan evenly, but don’t stir – wait for the cheese to melt for 30 seconds, then once melted, toss everything well, and stir together. This prevents the cheese from clumping or going stringy and makes a smooth, shiny sauce. Add a splash more pasta water if you need to, to loosen the sauce and coat the pasta. Serve immediately with a good grating of black pepper.', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recipeIngredients`
--

CREATE TABLE `recipeIngredients` (
  `recipeID` int(11) NOT NULL,
  `ingredient` varchar(255) NOT NULL,
  `quantity` float NOT NULL,
  `unit` varchar(45) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipeIngredients`
--

INSERT INTO `recipeIngredients` (`recipeID`, `ingredient`, `quantity`, `unit`) VALUES
(1, 'egg', 2, ''),
(1, 'flour', 60, 'grams'),
(1, 'milk', 200, 'ml'),
(2, 'egg', 2, ''),
(4, 'chickpeas', 100, 'g'),
(4, 'ciabatta rolls', 2, ''),
(4, 'cooked beetroot', 300, 'g'),
(4, 'olive oil', 1, 'tsp'),
(4, 'pesto', 3, 'tbsp'),
(5, 'black peppercorns, ground', 2, 'tbsp'),
(5, 'butter', 25, 'g'),
(5, 'pecorino', 50, 'g'),
(5, 'spaghetti', 200, 'g');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`) VALUES
(1, 'user0', '$2y$10$SX5p4H3lx1.9QKwmxj9aqe8xgtU9DnGzAdphf2YC2AIDWdw0Kj/IK'),
(2, 'user1', '$2y$10$EsifJ.PV7oDbuRtfOxXT6O2j9/TuI0vrm6I5R/jBz.NDw4r.Lx/ke');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipeID`),
  ADD KEY `userID` (`userID`);

--
-- Indeksy dla tabeli `recipeIngredients`
--
ALTER TABLE `recipeIngredients`
  ADD PRIMARY KEY (`recipeID`,`ingredient`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `recipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `recipeIngredients`
--
ALTER TABLE `recipeIngredients`
  MODIFY `recipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `recipe_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `recipeIngredients`
--
ALTER TABLE `recipeIngredients`
  ADD CONSTRAINT `recipeingredients_ibfk_2` FOREIGN KEY (`recipeID`) REFERENCES `recipe` (`recipeID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
