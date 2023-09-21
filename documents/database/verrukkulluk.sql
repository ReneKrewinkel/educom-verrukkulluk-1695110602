-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 21 sep 2023 om 11:58
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verrukkulluk`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `naam` varchar(20) NOT NULL,
  `omschrijving` text NOT NULL,
  `prijs` float NOT NULL,
  `eenheid` varchar(10) NOT NULL,
  `verpakking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `artikel`
--

INSERT INTO `artikel` (`id`, `naam`, `omschrijving`, `prijs`, `eenheid`, `verpakking`) VALUES
(1, 'brood', 'brood van bakker', 2, 'gram', 300),
(2, 'tomaat', 'tomaat van tomaatboer', 4.99, 'gram', 1000),
(3, 'knoflook', 'knoflook van boer', 2.99, 'stuks', 1),
(4, 'basilicum', 'basilicum van boer', 1.5, 'gram', 100),
(5, 'olijfolie', 'olijfolie van boer', 4.99, 'ml', 1000),
(6, 'Vegan burger bun', 'broodje van de bakker', 1.99, 'stuks', 10),
(7, 'Vegan burger', 'vegan burger uit fabriek', 4.99, 'gram', 500),
(8, 'Vegan burger sauce', 'super speciale saus', 2.99, 'ml', 250),
(9, 'Avocado', 'avocado van de boer', 1.3, 'stuks', 1),
(10, 'Pizza bodem', 'Kant en klare pizzabodem', 3, 'stuks', 2),
(11, 'Pizza tomatensaus', 'tomatensaus voor pizza', 1.3, 'stuks', 1),
(12, 'Blik Tonijn', 'blik tonijn van de visboer', 1.99, 'gram', 150),
(13, 'geraspte Kaas', 'kaas van de kaasboer', 4, 'gram', 350),
(14, 'uien', 'uien van de boer', 2, 'gram', 250),
(15, 'garnalen', 'garnalen van visboer', 4.99, 'stuks', 24),
(16, 'japanse mayo', 'mayo van de jap', 0.99, 'ml', 100),
(17, 'maizena', 'maizena van echte mais', 1.99, 'gram', 200),
(18, 'honing', 'honing van de imker', 6, 'ml', 250),
(19, 'melk', 'melk van de melkboer', 1.1, 'ml', 1000);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerecht`
--

CREATE TABLE `gerecht` (
  `id` int(11) NOT NULL,
  `keuken_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datum_toegevoegd` date NOT NULL,
  `titel` varchar(25) NOT NULL,
  `korte_omschrijving` varchar(100) NOT NULL,
  `lange_omschrijving` text NOT NULL,
  `afbeelding` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `gerecht`
--

INSERT INTO `gerecht` (`id`, `keuken_id`, `type_id`, `user_id`, `datum_toegevoegd`, `titel`, `korte_omschrijving`, `lange_omschrijving`, `afbeelding`) VALUES
(1, 3, 4, 1, '2023-09-20', 'Bruschetta', 'lorem ipsum...', 'lorem ipsum...', 'https://'),
(2, 1, 2, 3, '2023-09-16', 'Vegan Burger', 'Vegan burger amerikaanse stijl ', 'lorem ipsum...', 'https://'),
(3, 5, 4, 2, '2023-09-04', 'Ebi Mayo', 'Voorgerecht garnalen met mayo', 'lorem ipsum...', 'https://'),
(4, 3, 6, 4, '2023-09-04', 'Pizza tonno', 'Pizza met tonijn ', 'lorem ipsum...', 'https://');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerechtinfo`
--

CREATE TABLE `gerechtinfo` (
  `id` int(11) NOT NULL,
  `record_type` varchar(1) NOT NULL,
  `gerecht_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `nummeriekveld` int(11) NOT NULL,
  `tekstveld` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `gerechtinfo`
--

INSERT INTO `gerechtinfo` (`id`, `record_type`, `gerecht_id`, `user_id`, `datum`, `nummeriekveld`, `tekstveld`) VALUES
(1, 'B', 3, 1, '0000-00-00', 1, 'doe olie in pan'),
(3, 'B', 3, 1, '2023-09-05', 1, 'doe olie in pan'),
(4, 'B', 3, 1, '2023-09-05', 2, 'lorem ips'),
(5, 'B', 3, 1, '2023-09-05', 3, 'lorem ips'),
(6, 'B', 3, 1, '2023-09-05', 4, 'lorem ips'),
(7, 'B', 3, 1, '2023-09-05', 5, 'lorem ips'),
(8, 'B', 1, 2, '2023-09-05', 1, 'doe olie in pan'),
(9, 'B', 1, 2, '2023-09-05', 2, 'lorem ips'),
(10, 'B', 1, 2, '2023-09-05', 3, 'lorem ips'),
(11, 'B', 1, 2, '2023-09-05', 4, 'lorem ips'),
(12, 'B', 1, 2, '2023-09-05', 5, 'lorem ips'),
(13, 'B', 2, 3, '2023-09-05', 1, 'doe olie in pan'),
(14, 'B', 2, 3, '2023-09-05', 2, 'lorem ips'),
(15, 'B', 2, 3, '2023-09-05', 3, 'lorem ips'),
(16, 'B', 2, 3, '2023-09-05', 4, 'lorem ips'),
(17, 'B', 2, 3, '2023-09-05', 5, 'lorem ips'),
(18, 'B', 4, 2, '2023-09-05', 1, 'doe olie in pan'),
(19, 'B', 4, 2, '2023-09-05', 2, 'lorem ips'),
(20, 'B', 4, 2, '2023-09-05', 3, 'lorem ips'),
(21, 'B', 4, 2, '2023-09-05', 4, 'lorem ips'),
(22, 'B', 4, 2, '2023-09-05', 5, 'lorem ips'),
(23, 'O', 1, 1, '2023-09-05', 0, 'lekker'),
(24, 'O', 1, 2, '2023-09-05', 0, 'mooi'),
(25, 'O', 1, 3, '2023-09-05', 0, 'vies'),
(26, 'O', 2, 1, '2023-09-05', 0, 'lekker'),
(27, 'O', 2, 2, '2023-09-05', 0, 'mooi'),
(28, 'O', 2, 3, '2023-09-05', 0, 'vies'),
(29, 'O', 3, 1, '2023-09-05', 0, 'lekker'),
(30, 'O', 3, 2, '2023-09-05', 0, 'mooi'),
(31, 'O', 3, 3, '2023-09-05', 0, 'vies'),
(32, 'O', 4, 1, '2023-09-05', 0, 'lekker'),
(33, 'O', 4, 2, '2023-09-05', 0, 'mooi'),
(34, 'O', 4, 3, '2023-09-05', 0, 'vies'),
(35, 'W', 1, 1, '2023-09-05', 4, ''),
(36, 'W', 1, 2, '2023-09-05', 1, ''),
(37, 'W', 1, 3, '2023-09-05', 3, ''),
(38, 'W', 2, 1, '2023-09-05', 4, ''),
(39, 'W', 2, 2, '2023-09-05', 1, ''),
(40, 'W', 2, 3, '2023-09-05', 3, ''),
(41, 'W', 3, 1, '2023-09-05', 4, ''),
(42, 'W', 3, 2, '2023-09-05', 1, ''),
(43, 'W', 3, 3, '2023-09-05', 3, ''),
(44, 'W', 4, 1, '2023-09-05', 4, ''),
(45, 'W', 4, 2, '2023-09-05', 1, ''),
(46, 'W', 4, 3, '2023-09-05', 3, ''),
(47, 'F', 1, 1, '2023-09-05', 4, ''),
(48, 'F', 2, 1, '2023-09-05', 4, ''),
(49, 'F', 3, 2, '2023-09-05', 4, ''),
(50, 'F', 3, 3, '2023-09-05', 4, ''),
(51, 'F', 4, 3, '2023-09-05', 4, ''),
(52, 'F', 1, 4, '2023-09-05', 4, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `gerecht_id` int(11) NOT NULL,
  `artikel_id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `ingredient`
--

INSERT INTO `ingredient` (`id`, `gerecht_id`, `artikel_id`, `aantal`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 200),
(3, 1, 3, 1),
(4, 1, 4, 20),
(5, 1, 5, 10),
(6, 3, 15, 12),
(7, 3, 16, 15),
(8, 3, 17, 100),
(9, 3, 18, 30),
(10, 3, 19, 50),
(11, 4, 10, 4),
(12, 4, 11, 500),
(13, 4, 12, 500),
(14, 4, 13, 600),
(15, 4, 14, 200),
(16, 2, 6, 1),
(17, 2, 7, 200),
(18, 2, 8, 15),
(19, 2, 9, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `keukentype`
--

CREATE TABLE `keukentype` (
  `id` int(11) NOT NULL,
  `record_type` varchar(1) NOT NULL,
  `omschrijving` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `keukentype`
--

INSERT INTO `keukentype` (`id`, `record_type`, `omschrijving`) VALUES
(1, 'K', 'Amerikaans'),
(2, 'T', 'Vegan'),
(3, 'K', 'Italiaans'),
(4, 'T', 'Voorgerecht'),
(5, 'K', 'Japans'),
(6, 'T', 'visgerecht');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `afbeelding` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `afbeelding`) VALUES
(1, 'George', 'xxx', 'george@test.com', 'https//:....'),
(2, 'Donald', 'xxx', 'donald@test.com', 'https//:...'),
(3, 'Barrack', 'xxx', 'barrack@test.com', 'https//:....'),
(4, 'Abraham', 'xxx', 'abraham@test.com', 'https//:...');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gerecht`
--
ALTER TABLE `gerecht`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keuken_id` (`keuken_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `gerechtinfo`
--
ALTER TABLE `gerechtinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `gerecht_id` (`gerecht_id`);

--
-- Indexen voor tabel `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artikel_id` (`artikel_id`),
  ADD KEY `gerecht_id` (`gerecht_id`);

--
-- Indexen voor tabel `keukentype`
--
ALTER TABLE `keukentype`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT voor een tabel `gerecht`
--
ALTER TABLE `gerecht`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `gerechtinfo`
--
ALTER TABLE `gerechtinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT voor een tabel `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT voor een tabel `keukentype`
--
ALTER TABLE `keukentype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `gerecht`
--
ALTER TABLE `gerecht`
  ADD CONSTRAINT `gerecht_ibfk_1` FOREIGN KEY (`keuken_id`) REFERENCES `keukentype` (`id`),
  ADD CONSTRAINT `gerecht_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `keukentype` (`id`),
  ADD CONSTRAINT `gerecht_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `gerechtinfo`
--
ALTER TABLE `gerechtinfo`
  ADD CONSTRAINT `gerechtinfo_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `gerechtinfo_ibfk_3` FOREIGN KEY (`gerecht_id`) REFERENCES `gerecht` (`ID`);

--
-- Beperkingen voor tabel `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `ingredient_ibfk_2` FOREIGN KEY (`artikel_id`) REFERENCES `artikel` (`id`),
  ADD CONSTRAINT `ingredient_ibfk_3` FOREIGN KEY (`gerecht_id`) REFERENCES `gerecht` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
