-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2021 a las 20:43:50
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `keysbank`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keysbank_accounts`
--

CREATE TABLE `keysbank_accounts` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `idPlatform` int(11) NOT NULL,
  `name_account` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pass_account` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pass_date` date NOT NULL,
  `url` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `info` text COLLATE utf8_spanish_ci NOT NULL,
  `notes` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Disparadores `keysbank_accounts`
--
DELIMITER $$
CREATE TRIGGER `updateDatePassword` BEFORE UPDATE ON `keysbank_accounts` FOR EACH ROW BEGIN
IF NEW.pass_account != OLD.pass_account THEN
SET NEW.pass_date = CURDATE();
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keysbank_keys`
--

CREATE TABLE `keysbank_keys` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `keysbank_keys`
--

INSERT INTO `keysbank_keys` (`id`, `idUser`, `idCategory`, `password`) VALUES
(1, 1, 0, '67DE07ED295B217BF7DA1445982ECB26A121853AB7C1694790E2FADECEB27D0DE28D5D348539F55909B6E8A6A814194FB8FF2492AE86B70810090900DDD17CAFFAE130EDA99CB20DD75BF5CBB76F609D9D0EF88FB98E78DE4693B5498EFA5C8F2AE43140FD553F6AB242D5D76CF6E9EFAF147CF3871C3D8D930535CF3105EA9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keysbank_platforms_list`
--

CREATE TABLE `keysbank_platforms_list` (
  `id` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `idSubcategory` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `keysbank_platforms_list`
--

INSERT INTO `keysbank_platforms_list` (`id`, `idCategory`, `idSubcategory`, `name`) VALUES
(1, 1, 1, 'Blogger'),
(2, 1, 1, 'Medium'),
(3, 1, 1, 'Tumblr'),
(4, 1, 1, 'WordPress'),
(5, 1, 2, 'Flipboard'),
(6, 1, 2, 'Pinterest'),
(7, 1, 2, '500px'),
(8, 1, 3, 'Digg'),
(9, 1, 3, 'Quora'),
(10, 1, 3, 'Reddit'),
(11, 1, 3, '4chan'),
(12, 1, 4, 'Instagram'),
(13, 1, 4, 'Snapchat'),
(14, 1, 4, 'TikTok'),
(15, 1, 5, 'GitHub'),
(16, 1, 5, 'GitLab'),
(17, 1, 5, 'LinkedIn'),
(18, 1, 6, 'Facebook'),
(19, 1, 6, 'Twitter'),
(20, 2, 7, 'Moodle'),
(21, 2, 7, 'Platzi'),
(22, 2, 7, 'Udemy'),
(23, 2, 7, 'OpenWebinars'),
(24, 2, 8, 'Steam'),
(25, 2, 8, 'Origin'),
(26, 2, 8, 'GoG'),
(27, 2, 8, 'Epic Games'),
(28, 2, 8, 'PlayStation Network'),
(29, 2, 8, 'Xbox Live'),
(30, 2, 9, 'Netflix'),
(31, 2, 9, 'HBO'),
(32, 2, 9, 'Disney+'),
(33, 2, 9, 'Amazon Prime'),
(34, 2, 10, 'Twitch'),
(35, 2, 10, 'YouTube'),
(36, 3, 11, 'Other'),
(37, 3, 11, 'Wallapop'),
(38, 3, 12, 'Ebay'),
(39, 3, 12, 'Amazon'),
(40, 3, 12, 'Milanuncios'),
(41, 3, 12, 'Casa del libro'),
(42, 3, 12, 'Corte inglés'),
(43, 3, 12, 'Media Markt'),
(44, 3, 12, 'Mercadona'),
(45, 3, 12, 'Eroski'),
(46, 3, 12, 'Verkami'),
(47, 3, 12, 'Roll20'),
(48, 3, 12, 'Other'),
(49, 3, 12, 'Worten'),
(50, 3, 12, 'Decathlon'),
(51, 3, 12, 'Dia'),
(52, 3, 12, 'Zara'),
(53, 3, 12, 'Zalandro'),
(54, 3, 12, 'Ali Express'),
(55, 3, 12, 'Leroy Merlin'),
(56, 3, 12, 'PC Componentes'),
(57, 3, 12, 'Ikea'),
(58, 3, 12, 'Kiabi'),
(59, 3, 12, 'H&M'),
(60, 3, 12, 'C&A'),
(61, 3, 12, 'Springfield'),
(62, 3, 12, 'Zooplus'),
(63, 3, 12, 'Maisons du monde'),
(64, 4, 13, 'Bussiness'),
(65, 4, 13, 'Company'),
(66, 4, 13, 'Other'),
(67, 4, 14, 'Hotmail'),
(68, 4, 14, 'Gmail'),
(69, 4, 14, 'Yahoo'),
(70, 4, 14, 'GMX'),
(71, 4, 14, 'AOL'),
(72, 4, 14, 'Other'),
(73, 5, 15, 'Debian'),
(74, 5, 15, 'Red Hat'),
(75, 5, 15, 'CentOS'),
(76, 5, 15, 'Fedora'),
(77, 5, 15, 'Linux Mint'),
(78, 5, 15, 'Ubuntu'),
(79, 5, 15, 'Kubuntu'),
(80, 5, 15, 'Xubuntu'),
(81, 5, 15, 'Mandriva'),
(82, 5, 15, 'Arch Linux'),
(83, 5, 15, 'KDE Neon'),
(84, 5, 15, 'Free BSD'),
(85, 5, 15, 'Open SUSE'),
(86, 5, 16, 'MAC OS'),
(87, 5, 16, 'iOS'),
(88, 5, 17, 'Windows XP'),
(89, 5, 17, 'Windows Vista'),
(90, 5, 17, 'Windows 7'),
(91, 5, 17, 'Windows 8'),
(92, 5, 17, 'Windows 10'),
(93, 5, 17, 'Windows Server 2003-2019'),
(94, 5, 18, 'Android'),
(95, 5, 18, 'Solaris'),
(96, 5, 18, 'Other'),
(97, 6, 19, 'PayPal'),
(98, 6, 19, 'Stripe'),
(99, 6, 19, 'WePay'),
(100, 6, 20, 'La Caixa'),
(101, 6, 20, 'BBVA'),
(102, 6, 20, 'Santander'),
(103, 6, 20, 'Bankia'),
(104, 6, 20, 'Caja Sur'),
(105, 6, 20, 'Banco Sabadell'),
(106, 6, 20, 'Bankinter'),
(107, 6, 20, 'ING'),
(108, 6, 20, 'OpenBank'),
(109, 5, 15, 'Kali Linux'),
(110, 2, 8, 'BattleNet'),
(111, 1, 1, 'Other'),
(112, 1, 2, 'Other'),
(113, 1, 3, 'Other'),
(114, 1, 4, 'Other'),
(115, 1, 5, 'Other'),
(116, 1, 6, 'Other'),
(117, 2, 7, 'Other'),
(118, 2, 8, 'Other'),
(119, 2, 9, 'Other'),
(120, 2, 10, 'Other'),
(121, 5, 15, 'Other'),
(122, 5, 16, 'Other'),
(123, 5, 17, 'Other'),
(124, 6, 19, 'Other'),
(125, 6, 20, 'Other');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keysbank_platform_categories`
--

CREATE TABLE `keysbank_platform_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `keysbank_platform_categories`
--

INSERT INTO `keysbank_platform_categories` (`id`, `category`) VALUES
(0, 'general'),
(1, 'social_media'),
(2, 'digital_platforms'),
(3, 'webs/apps'),
(4, 'mails'),
(5, 'operating_systems'),
(6, 'payment_systems');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keysbank_platform_subcategories`
--

CREATE TABLE `keysbank_platform_subcategories` (
  `id` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `subcategory` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `keysbank_platform_subcategories`
--

INSERT INTO `keysbank_platform_subcategories` (`id`, `idCategory`, `subcategory`) VALUES
(1, 1, 'Blogs'),
(2, 1, 'Content organizer'),
(3, 1, 'Forums'),
(4, 1, 'Multimedia content'),
(5, 1, 'Professionals'),
(6, 1, 'Social media'),
(7, 2, 'Academic'),
(8, 2, 'Games'),
(9, 2, 'Series/films'),
(10, 2, 'Streaming/videos'),
(11, 3, 'Apps'),
(12, 3, 'Webs'),
(13, 4, 'Privates'),
(14, 4, 'Publics'),
(15, 5, 'GNU/Linux'),
(16, 5, 'MAC OS'),
(17, 5, 'Microsoft Windows'),
(18, 5, 'Others'),
(19, 6, 'Digital payments'),
(20, 6, 'Online banking');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keysbank_users`
--

CREATE TABLE `keysbank_users` (
  `id` int(11) NOT NULL,
  `nick` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `perfil` enum('USER','ADMIN') COLLATE utf8_spanish_ci NOT NULL,
  `current_state` enum('PENDING','ACTIVE','BANNED') COLLATE utf8_spanish_ci NOT NULL,
  `days_old_password` int(11) NOT NULL DEFAULT 90
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `keysbank_users`
--

INSERT INTO `keysbank_users` (`id`, `nick`, `pass`, `name`, `surname`, `email`, `perfil`, `current_state`, `days_old_password`) VALUES
(1, 'admin', 'C66DA34A548C7AD4130B5AFA6287F7B5', NULL, NULL, '', 'ADMIN', 'ACTIVE', 90);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `keysbank_accounts`
--
ALTER TABLE `keysbank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idCategory` (`idCategory`),
  ADD KEY `idPlatform` (`idPlatform`);

--
-- Indices de la tabla `keysbank_keys`
--
ALTER TABLE `keysbank_keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idCategory` (`idCategory`);

--
-- Indices de la tabla `keysbank_platforms_list`
--
ALTER TABLE `keysbank_platforms_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCategory` (`idCategory`),
  ADD KEY `idSubcategory` (`idSubcategory`);

--
-- Indices de la tabla `keysbank_platform_categories`
--
ALTER TABLE `keysbank_platform_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `keysbank_platform_subcategories`
--
ALTER TABLE `keysbank_platform_subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCategory` (`idCategory`);

--
-- Indices de la tabla `keysbank_users`
--
ALTER TABLE `keysbank_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `keysbank_accounts`
--
ALTER TABLE `keysbank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `keysbank_keys`
--
ALTER TABLE `keysbank_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `keysbank_platforms_list`
--
ALTER TABLE `keysbank_platforms_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de la tabla `keysbank_platform_categories`
--
ALTER TABLE `keysbank_platform_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `keysbank_platform_subcategories`
--
ALTER TABLE `keysbank_platform_subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `keysbank_users`
--
ALTER TABLE `keysbank_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `keysbank_accounts`
--
ALTER TABLE `keysbank_accounts`
  ADD CONSTRAINT `keysbank_accounts_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `keysbank_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `keysbank_accounts_ibfk_2` FOREIGN KEY (`idCategory`) REFERENCES `keysbank_platform_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `keysbank_accounts_ibfk_3` FOREIGN KEY (`idPlatform`) REFERENCES `keysbank_platforms_list` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `keysbank_keys`
--
ALTER TABLE `keysbank_keys`
  ADD CONSTRAINT `keysbank_keys_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `keysbank_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `keysbank_keys_ibfk_2` FOREIGN KEY (`idCategory`) REFERENCES `keysbank_platform_categories` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `keysbank_platforms_list`
--
ALTER TABLE `keysbank_platforms_list`
  ADD CONSTRAINT `keysbank_platforms_list_ibfk_1` FOREIGN KEY (`idSubcategory`) REFERENCES `keysbank_platform_subcategories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `keysbank_platforms_list_ibfk_2` FOREIGN KEY (`idCategory`) REFERENCES `keysbank_platform_categories` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `keysbank_platform_subcategories`
--
ALTER TABLE `keysbank_platform_subcategories`
  ADD CONSTRAINT `keysbank_platform_subcategories_ibfk_1` FOREIGN KEY (`idCategory`) REFERENCES `keysbank_platform_categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/* Crate user keysbank */
GRANT SELECT, INSERT, UPDATE, DELETE ON *.* TO 'keysbank'@'%' IDENTIFIED BY PASSWORD '*76C438199377B52C3843A37CF0ADEE44C7342822';