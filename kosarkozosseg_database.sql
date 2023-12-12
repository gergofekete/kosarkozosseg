-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Dec 12. 11:46
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `kosarkozosseg`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoria`
--

CREATE TABLE `kategoria` (
  `kategoria_id` int(11) NOT NULL,
  `nev` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `kategoria`
--

INSERT INTO `kategoria` (`kategoria_id`, `nev`) VALUES
(1, 'Zöldség'),
(2, 'Gyümölcs'),
(3, 'Lekvárok'),
(4, 'Borok'),
(5, 'Gyümölcslevek'),
(6, 'Pálinka'),
(7, 'Egyéb');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kepek`
--

CREATE TABLE `kepek` (
  `kep_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_size` int(11) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kep_leiras` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `kepek`
--

INSERT INTO `kepek` (`kep_id`, `file_name`, `file_type`, `file_size`, `upload_date`, `kep_leiras`) VALUES
(48, 'banan.jpg', 'jpg', 47418, '2023-11-30 05:03:22', 'Kép a termékhez: Banán'),
(49, 'brokkoli.jpg', 'jpg', 567207, '2023-12-01 09:58:46', 'Kép a termékhez: Brokkoli'),
(50, 'alma.png', 'png', 90549, '2023-12-01 09:59:23', 'Kép a termékhez: Jonatán alma'),
(51, 'lekvár.jpg', 'jpg', 641237, '2023-12-01 10:00:20', 'Kép a termékhez: Eper lekvár'),
(52, 'rozé.webp', 'webp', 7630, '2023-12-01 10:01:08', 'Kép a termékhez: Rozé'),
(53, 'Vörösbor.jpg', 'jpg', 24134, '2023-12-01 10:06:15', 'Kép a termékhez: Vörösbor'),
(54, 'uborka.jpg', 'jpg', 79748, '2023-12-01 10:07:32', 'Kép a termékhez: Csemege uborka'),
(55, 'orange.webp', 'webp', 19472, '2023-12-01 10:09:49', 'Kép a termékhez: Narancs'),
(56, 'gyümölcslé.jpg', 'jpg', 7783, '2023-12-01 10:11:58', 'Kép a termékhez: almalé'),
(57, 'banan.jpg', 'jpg', 47418, '2023-12-01 11:00:38', 'Kép a termékhez: Krumpli');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termekek`
--

CREATE TABLE `termekek` (
  `termek_id` int(11) NOT NULL,
  `kategoria_id` int(11) NOT NULL,
  `hirdeto_id` int(11) NOT NULL,
  `nev` varchar(30) NOT NULL,
  `leiras` text NOT NULL,
  `mennyiseg` int(11) NOT NULL,
  `ar` int(11) NOT NULL,
  `kep_id` int(11) NOT NULL,
  `feltoltes_date` date NOT NULL,
  `jovahagyva` tinyint(1) DEFAULT 0,
  `jelentve` tinyint(1) DEFAULT 0,
  `torolve` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `termekek`
--

INSERT INTO `termekek` (`termek_id`, `kategoria_id`, `hirdeto_id`, `nev`, `leiras`, `mennyiseg`, `ar`, `kep_id`, `feltoltes_date`, `jovahagyva`, `jelentve`, `torolve`) VALUES
(42, 2, 32, 'Banán', '100%-ban bio banán eladó!', 40, 720, 48, '2023-11-30', 0, 0, 1),
(43, 1, 32, 'Brokkoli', 'Friss Brokkoli nagyon jó áron eladó!', 34, 600, 49, '2023-12-01', 1, 0, 0),
(44, 2, 32, 'Jonatán alma', 'Nagyon finom Jonatán alma eladó!', 16, 500, 50, '2023-12-01', 1, 0, 0),
(45, 3, 32, 'Eper lekvár', 'Idén (2023) befőzött eper lekvár eladó! ', 12, 1400, 51, '2023-12-01', 1, 0, 0),
(46, 4, 32, 'Rozé', '2023-as termésből készített Rozé bor eladó!', 13, 2300, 52, '2023-12-01', 0, 0, 0),
(47, 4, 31, 'Vörösbor', 'Eladó palackozott kékfrankos vörösbor!', 23, 3400, 53, '2023-12-01', 1, 0, 0),
(48, 7, 31, 'Csemege uborka', 'Eladó csemege uborka, 1 üveg 350g.', 74, 1200, 54, '2023-12-01', 1, 0, 0),
(49, 2, 31, 'Narancs', 'Eladó a magyar narancs, kicsit sárgább, kicsit savanyúbb, de a miénk!', 25, 400, 55, '2023-12-01', 1, 0, 0),
(50, 5, 31, 'almalé', 'Eladó 100%-os almalé', 200, 430, 56, '2023-12-01', 1, 0, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `fname` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `admine` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`user_id`, `lname`, `fname`, `username`, `email`, `password`, `admine`) VALUES
(9, 'admin', 'admin', 'admin', 'admin@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 1),
(31, 'Teszt', 'Felhasználó', 'teszt', 'teszt@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 0),
(32, 'Fekete', 'Gergő', 'feketegergo', 'fgergo0706@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `uzenetek`
--

CREATE TABLE `uzenetek` (
  `uzenet_id` int(11) NOT NULL,
  `felado_id` int(11) NOT NULL,
  `cimzett_id` int(11) NOT NULL,
  `termek_id` int(11) NOT NULL,
  `targy` varchar(32) NOT NULL,
  `szoveg` text NOT NULL,
  `kuldes_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `uzenetek`
--

INSERT INTO `uzenetek` (`uzenet_id`, `felado_id`, `cimzett_id`, `termek_id`, `targy`, `szoveg`, `kuldes_date`) VALUES
(43, 32, 31, 49, 'Narancs', 'Tájékoztatjuk, hogy rendelése érkezett feketegergo-tól/től.\r\n                            Rendelés tartalma: Narancs, rendelt mennyiség: 5\r\n                            Fizetendő összeg: 2000 Ft', '2023-12-01 11:13:51'),
(44, 32, 31, 49, 'Narancs', 'hogyan juttathatom el önnek  a pénzt?', '2023-12-01 11:14:24'),
(58, 32, 9, 0, 'admin', 'Szia admin', '2023-12-01 15:24:46'),
(59, 9, 32, 0, 'admin', 'szia miben sgeíthetek?', '2023-12-01 15:25:01'),
(60, 31, 9, 0, 'admin', 'szaaaaaa', '2023-12-01 15:25:31'),
(61, 9, 32, 0, 'admin', 'dsfsd', '2023-12-01 16:16:11'),
(62, 9, 31, 0, 'admin', 'swfsdf', '2023-12-01 16:16:16'),
(63, 31, 9, 0, 'admin', 'micsoda?', '2023-12-01 16:17:46'),
(64, 9, 31, 0, 'admin', 'mi micsoda?', '2023-12-01 16:17:58'),
(65, 32, 9, 0, 'admin', 'abban hogy miben nem?', '2023-12-01 16:18:23'),
(66, 9, 32, 0, 'admin', 'konkrétan?', '2023-12-01 16:18:34'),
(67, 31, 32, 49, 'Narancs', 'Revoluteon tökéletes', '2023-12-01 16:22:38'),
(68, 31, 32, 45, 'Eper lekvár', 'Tájékoztatjuk, hogy rendelése érkezett teszt-tól/től.\r\n                            Rendelés tartalma: Eper lekvár, rendelt mennyiség: 3\r\n                            Fizetendő összeg: 4200 Ft', '2023-12-01 17:04:54'),
(69, 31, 32, 43, 'Brokkoli', 'Tájékoztatjuk, hogy rendelése érkezett teszt-tól/től.\r\n                            Rendelés tartalma: Brokkoli, rendelt mennyiség: 3\r\n                            Fizetendő összeg: 1800 Ft', '2023-12-01 17:05:19'),
(70, 32, 31, 48, 'Csemege uborka', 'Tájékoztatjuk, hogy rendelése érkezett feketegergo-tól/től.\r\n                            Rendelés tartalma: Csemege uborka, rendelt mennyiség: 6\r\n                            Fizetendő összeg: 7200 Ft', '2023-12-04 17:02:45'),
(71, 32, 31, 49, 'Narancs', 'küldom', '2023-12-04 17:04:05');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vasarlasok`
--

CREATE TABLE `vasarlasok` (
  `vasarlas_id` int(11) NOT NULL,
  `vevo_id` int(11) NOT NULL,
  `elado_id` int(11) NOT NULL,
  `termek_id` int(11) NOT NULL,
  `mennyiseg` int(11) NOT NULL,
  `osszeg` int(11) NOT NULL,
  `vasarlas_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`kategoria_id`);

--
-- A tábla indexei `kepek`
--
ALTER TABLE `kepek`
  ADD PRIMARY KEY (`kep_id`);

--
-- A tábla indexei `termekek`
--
ALTER TABLE `termekek`
  ADD PRIMARY KEY (`termek_id`),
  ADD KEY `kategoria_id` (`kategoria_id`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- A tábla indexei `uzenetek`
--
ALTER TABLE `uzenetek`
  ADD PRIMARY KEY (`uzenet_id`);

--
-- A tábla indexei `vasarlasok`
--
ALTER TABLE `vasarlasok`
  ADD PRIMARY KEY (`vasarlas_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `kategoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `kepek`
--
ALTER TABLE `kepek`
  MODIFY `kep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT a táblához `termekek`
--
ALTER TABLE `termekek`
  MODIFY `termek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT a táblához `uzenetek`
--
ALTER TABLE `uzenetek`
  MODIFY `uzenet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT a táblához `vasarlasok`
--
ALTER TABLE `vasarlasok`
  MODIFY `vasarlas_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
