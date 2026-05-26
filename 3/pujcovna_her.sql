-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 27. kvě 2026, 00:15
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `pujcovna her`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `hry`
--

CREATE TABLE `hry` (
  `id` int(11) NOT NULL,
  `nazev` varchar(50) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `rok vydani` varchar(11) NOT NULL,
  `stav` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `hry`
--

INSERT INTO `hry` (`id`, `nazev`, `autor`, `rok vydani`, `stav`) VALUES
(1, 'test 1', 'admin', '10.10.2025', 'nedostupná'),
(4, 'test 4', 'admin', '', 'nedostupná'),
(5, 'Azul', 'Michael Kiesling', '2017', 'dostupná'),
(6, 'Karak', 'Petr Mikša', '2017', 'dostupná'),
(7, 'Pandemic', 'Matt Leacock', '2008', 'dostupná'),
(8, 'Bang!', 'Emiliano Sciarra', '2002', 'dostupná'),
(9, 'Dobble', 'Denis Blanchot', '2009', 'dostupná'),
(10, 'Dixit', 'Jean-Louis Roubira', '2008', 'dostupná'),
(11, 'Splendor', 'Marc André', '2014', 'dostupná'),
(12, '7 Divů světa', 'Antoine Bauza', '2010', 'dostupná'),
(13, 'Mars Teraformace', 'Jacob Fryxelius', '2016', 'dostupná'),
(14, 'Výbušná koťátka', 'Matthew Inman', '2015', 'dostupná'),
(15, 'Krycí jména: Duet', 'Vlaada Chvátil', '2017', 'dostupná'),
(16, 'Duch!', 'Jacques Zeimet', '2010', 'dostupná'),
(17, 'Scrabble', 'Alfred Mosher Butts', '1948', 'dostupná'),
(18, 'Monopoly', 'Lizzie Magie', '1935', 'dostupná'),
(19, 'Dostihy a sázky', 'Ladislav Mareš', '1984', 'dostupná'),
(20, 'Člověče, nezlob se!', 'Josef Friedrich Schmidt', '1907', 'dostupná'),
(21, 'Activity', 'Paul Lamond', '1990', 'dostupná'),
(22, 'Párty Alias', 'Mikko Koivusalo', '2008', 'dostupná'),
(23, 'Zombicide', 'Raphaël Guiton', '2012', 'dostupná'),
(24, 'Doba kamenná', 'Bernd Brunnhofer', '2008', 'dostupná'),
(25, 'Port Royal', 'Alexander Pfister', '2014', 'dostupná'),
(26, 'Sabotér', 'Frederic Moyersoen', '2004', 'dostupná'),
(27, 'Vládce Tokia', 'Richard Garfield', '2011', 'dostupná'),
(28, 'Citadela', 'Bruno Faidutti', '2000', 'dostupná'),
(29, 'Břink!', 'Paul Dennen', '2016', 'vypůjčená'),
(30, 'Na křídlech (Wingspan)', 'Elizabeth Hargrave', '2019', 'dostupná'),
(31, 'Plyšová hlídka', 'Jerry Hawthorne', '2018', 'dostupná'),
(32, 'Nemesis', 'Adam Kwapiński', '2018', 'dostupná'),
(33, 'Gloomhaven', 'Isaac Childres', '2017', 'dostupná'),
(34, 'Labilní jednorožci', 'Ramy Badie', '2017', 'dostupná'),
(35, 'Věž (Jenga)', 'Leslie Scott', '1983', 'dostupná'),
(36, 'Šachy', 'Tradiční', '1475', 'dostupná'),
(37, 'Dáma', 'Tradiční', '1100', 'dostupná'),
(38, 'Backgammon', 'Tradiční', '3000 BC', 'dostupná'),
(39, 'Rummikub', 'Ephraim Hertzano', '1977', 'dostupná'),
(40, 'Sequence', 'Doug Reuter', '1982', 'dostupná'),
(41, 'Ubongo', 'Grzegorz Rejchtman', '2003', 'dostupná'),
(42, 'Labyrint', 'Max J. Kobbert', '1986', 'dostupná'),
(43, 'Kvedlalové z Kvedlinburku', 'Wolfgang Warsch', '2018', 'dostupná'),
(44, 'Alchymisti', 'Matúš Kotry', '2014', 'dostupná'),
(45, 'Tzolkin', 'Simone Luciani', '2012', 'dostupná'),
(46, 'ROOT', 'Cole Wehrle', '2018', 'dostupná'),
(47, 'Everdell', 'James A. Wilson', '2018', 'dostupná'),
(48, 'Duna: Impérium', 'Paul Dennen', '2020', 'dostupná'),
(49, 'Archa Nova', 'Mathias Wigge', '2021', 'dostupná'),
(50, 'Pán prstenů: Putování', 'Nathan Hajek', '2019', 'dostupná'),
(51, 'Talisman', 'Robert Harris', '1983', 'dostupná'),
(52, 'Milostný dopis', 'Seiji Kanai', '2012', 'dostupná'),
(53, 'Munchkin', 'Steve Jackson', '2001', 'dostupná'),
(54, 'Desítka Česko', 'Krakatoa', '2019', 'dostupná');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(50) NOT NULL,
  `prijmeni` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `heslo` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`id`, `jmeno`, `prijmeni`, `email`, `heslo`, `role`) VALUES
(1, 'admin', '', 'admin@admin.cz', 'heslo', 'admin'),
(2, 'test', 'test', 'test@test.test', 'test', 'admin'),
(3, 'test', '2 role', 'xxx', 'xxx', 'vyřazen'),
(4, 'admin easy', 'access', 'a', 'a', 'admin'),
(5, 'Tomáš', 'Marný', 'tomas.marny@email.cz', 'heslo123', 'zakaznik'),
(6, 'Anna', 'Veselá', 'anna.vesela@email.cz', 'heslo123', 'zakaznik'),
(7, 'Martin', 'Kříž', 'martin.kriz@email.cz', 'heslo123', 'zakaznik'),
(8, 'Jana', 'Králová', 'jana.kralova@email.cz', 'heslo123', 'zakaznik'),
(9, 'Pavel', 'Procházka', 'pavel.prochazka@email.cz', 'heslo123', 'zakaznik'),
(10, 'Lenka', 'Růžičková', 'lenka.ruzickova@email.cz', 'heslo123', 'zakaznik'),
(11, 'Jiří', 'Beneš', 'jiri.benes@email.cz', 'heslo123', 'zakaznik'),
(12, 'Kateřina', 'Fialová', 'katerina.fialova@email.cz', 'heslo123', 'zakaznik'),
(13, 'Michal', 'Sedláček', 'michal.sedlacek@email.cz', 'heslo123', 'zakaznik'),
(14, 'Veronika', 'Zemanová', 'veronika.zemanova@email.cz', 'heslo123', 'zakaznik'),
(15, 'Jakub', 'Kolář', 'jakub.kolar@email.cz', 'heslo123', 'zakaznik'),
(16, 'Tereza', 'Navrátilová', 'tereza.navratilova@email.cz', 'heslo123', 'zakaznik'),
(17, 'Ondřej', 'Dostál', 'ondrej.dostal@email.cz', 'heslo123', 'zakaznik'),
(18, 'Zuzana', 'Urbanová', 'zuzana.urbanova@email.cz', 'heslo123', 'zakaznik'),
(19, 'David', 'Vaněk', 'david.vanek@email.cz', 'heslo123', 'zakaznik'),
(20, 'Klára', 'Vlčková', 'klara.vlckova@email.cz', 'heslo123', 'zakaznik'),
(21, 'Matěj', 'Blažek', 'matej.blazek@email.cz', 'heslo123', 'zakaznik'),
(22, 'Markéta', 'Ševčíková', 'marketa.sevcikova@email.cz', 'heslo123', 'zakaznik'),
(23, 'Filip', 'Kovář', 'filip.kovar@email.cz', 'heslo123', 'zakaznik'),
(24, 'Barbora', 'Sýkorová', 'barbora.sykorova@email.cz', 'heslo123', 'zakaznik');

-- --------------------------------------------------------

--
-- Struktura tabulky `vypujcky`
--

CREATE TABLE `vypujcky` (
  `id` int(11) NOT NULL,
  `uzivatele_id` int(11) NOT NULL,
  `hry_id` int(11) NOT NULL,
  `stav` varchar(20) NOT NULL,
  `datum_pujceni` varchar(10) NOT NULL,
  `datum_vraceni` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `vypujcky`
--

INSERT INTO `vypujcky` (`id`, `uzivatele_id`, `hry_id`, `stav`, `datum_pujceni`, `datum_vraceni`) VALUES
(1, 1, 1, 'vrácená', '10.10.2025', '2026-05-24'),
(2, 1, 4, 'aktivní', '25.02.2026', 'N/A'),
(7, 4, 4, 'vrácená', 'now', 'after now'),
(9, 1, 21, 'vrácená', '', ''),
(10, 1, 12, 'vrácená', '', ''),
(11, 18, 8, 'vrácená', '26.5.2026', ''),
(12, 22, 29, 'aktivní', '26.6.2025', '');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `hry`
--
ALTER TABLE `hry`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `vypujcky`
--
ALTER TABLE `vypujcky`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzivatel` (`uzivatele_id`),
  ADD KEY `hry` (`hry_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `hry`
--
ALTER TABLE `hry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pro tabulku `vypujcky`
--
ALTER TABLE `vypujcky`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `vypujcky`
--
ALTER TABLE `vypujcky`
  ADD CONSTRAINT `Hry` FOREIGN KEY (`hry_id`) REFERENCES `hry` (`ID`),
  ADD CONSTRAINT `Uzivatele` FOREIGN KEY (`uzivatele_id`) REFERENCES `uzivatele` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
