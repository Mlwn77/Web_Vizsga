-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Jún 29. 17:33
-- Kiszolgáló verziója: 10.4.22-MariaDB
-- PHP verzió: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `bejelentkezes`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `fnev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `jog` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `fnev`, `jelszo`, `created_at`, `jog`) VALUES
(2, 'kev', '$2y$10$3634SyES95hM7aK6boKgB.EWkoZze3AIDPO7nd9hi7/A3f6LCOqnq', '2022-06-20 16:38:38', 3),
(3, 'juhika', '$2y$10$bPYyyxNUryU/V1B6kDKKS.DzUcslF.ehAoEbW2GORVKCgPCeViOn6', '2022-06-20 16:38:47', 1),
(5, 'kevin', '$2y$10$2BcrDGfdEj1IHKXWoiGaTOdQ8G84vFZgDLYgFoF9JBm74ZpcQFgLu', '2022-06-20 16:49:30', 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoriak`
--

CREATE TABLE `kategoriak` (
  `id` int(11) NOT NULL,
  `kategoria` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `kategoriak`
--

INSERT INTO `kategoriak` (`id`, `kategoria`) VALUES
(0, 'Telefon'),
(1, 'Kiegészítő');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termekek`
--

CREATE TABLE `termekek` (
  `id` int(11) NOT NULL,
  `nev` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `marka` varchar(200) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `ar` int(12) NOT NULL,
  `kep` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `leiras` varchar(2000) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `kategoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `termekek`
--

INSERT INTO `termekek` (`id`, `nev`, `marka`, `ar`, `kep`, `leiras`, `kategoria_id`) VALUES
(1, 'Iphone 13', 'Apple', 300000, 'iphone-13.png', 'Iphone 13, makulátlan', 0),
(2, 'Kiegésztő1', 'Kiegésztő1', 250, '', 'Kiegésztő1', 1),
(24, 'Huawei p30', 'Huawei', 500000000, '', 'Huawei p30', 0),
(29, 'Huawei p30 tok', 'Huawei', 250, '', 'Huawei p30 tok', 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kategoriak`
--
ALTER TABLE `kategoriak`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `termekek`
--
ALTER TABLE `termekek`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `kategoriak`
--
ALTER TABLE `kategoriak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `termekek`
--
ALTER TABLE `termekek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
