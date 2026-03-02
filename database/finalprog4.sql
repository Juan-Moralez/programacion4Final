-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-03-2026 a las 23:44:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `finalprog4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `id_usuario`, `total`, `fecha`) VALUES
(1, 8, 11000.00, '2026-02-25 23:12:24'),
(2, 8, 6.00, '2026-02-26 21:32:04'),
(3, 8, 9.00, '2026-02-26 23:03:39'),
(4, 8, 9.00, '2026-02-26 23:04:05'),
(5, 8, 9.00, '2026-02-26 23:04:23'),
(6, 8, 6.00, '2026-02-26 23:04:26'),
(7, 8, 6.00, '2026-02-26 23:05:50'),
(8, 8, 6.00, '2026-02-26 23:05:55'),
(9, 8, 6.00, '2026-02-26 23:06:19'),
(10, 8, 6.00, '2026-02-26 23:07:31'),
(11, 8, 6.00, '2026-02-26 23:07:34'),
(12, 8, 6.00, '2026-02-26 23:09:47'),
(13, 8, 6.00, '2026-02-26 23:10:11'),
(14, 8, 3.00, '2026-02-26 23:10:20'),
(15, 8, 3.00, '2026-02-26 23:17:39'),
(16, 8, 3.00, '2026-02-26 23:39:24'),
(17, 8, 3.00, '2026-02-26 23:48:23'),
(18, 8, 9500.00, '2026-02-27 02:08:04'),
(19, 1, 15000.00, '2026-02-28 23:27:12'),
(20, 1, 15000.00, '2026-03-01 03:12:38'),
(21, 1, 15000.00, '2026-03-02 20:32:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id_detalle` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_manga` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `volumen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id_detalle`, `id_compra`, `id_manga`, `nombre`, `precio`, `cantidad`, `volumen`) VALUES
(16, 19, 13, 'Bibliomania', 15000.00, 1, 1),
(17, 20, 13, 'Bibliomania', 15000.00, 1, 1),
(18, 21, 13, 'Bibliomania', 15000.00, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mangas`
--

CREATE TABLE `mangas` (
  `idmangas` int(11) NOT NULL,
  `nommangas` varchar(45) NOT NULL,
  `cantcapitulosmangas` varchar(45) NOT NULL,
  `cantvolmangas` varchar(45) NOT NULL,
  `generosmangas` varchar(45) NOT NULL,
  `autormangas` varchar(45) NOT NULL,
  `demomangas` varchar(45) NOT NULL,
  `stockmangas` varchar(45) NOT NULL,
  `preciomangas` varchar(45) NOT NULL,
  `descripcionmangas` text NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mangas`
--

INSERT INTO `mangas` (`idmangas`, `nommangas`, `cantcapitulosmangas`, `cantvolmangas`, `generosmangas`, `autormangas`, `demomangas`, `stockmangas`, `preciomangas`, `descripcionmangas`, `imagen_url`) VALUES
(13, 'Bibliomania', '7', '1', 'Terror', 'Obaru Macchiro', '', '99', '15000', 'Alice se despierta en la habitación 431 de una misteriosa residencia donde todos sus deseos pueden hacerse realidad. «No debes abandonar esa habitación», le advierte la Serpiente.', 'img/portadas/1772151821_bibliomania.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacion_password`
--

CREATE TABLE `recuperacion_password` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `token` varchar(64) DEFAULT NULL,
  `expira` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recuperacion_password`
--

INSERT INTO `recuperacion_password` (`id`, `id_usuario`, `token`, `expira`) VALUES
(1, 1, '3d4eacb114aab9941d1ade1921cddccf420230d72b637e5f35bd30d67be09599', '2026-02-27 23:50:35'),
(2, 1, 'd884a3972ea46e6795378ba38d09216475828ea455c23f438ae1f10888b7be39', '2026-02-27 23:55:29'),
(3, 1, '982ce97aa283968106deb53d270faa32ebd76ac7bc514eadd5fecca192ec5c27', '2026-02-27 23:55:37'),
(4, 1, '64ecb14fc0b189ed39c25529e29f6aa5c6f8c18434090f7efd977cd042c94e0f', '2026-02-27 23:55:42'),
(5, 1, '2c5b2c17def4845ffb7842d6fe349b09f5612cea1260a0175cac75d9b39a3e84', '2026-02-27 23:56:00'),
(6, 1, '0e8e72fb280d4e28c2a8009c39e078c2f416591be82613f6612131c117083a7d', '2026-02-27 23:57:37'),
(7, 1, '79e949ecdfa7cfdce992a534a4821f8b6f08b7ef293de1175fc94943c6c305c9', '2026-02-27 23:57:44'),
(8, 1, 'd2014b6dede0bfb4fe380cc1773ad42b1d8f0a845ed8ef7967c259b8a2375556', '2026-02-27 23:57:49'),
(9, 1, 'e453e6e0792f4ccba2406f9a3d691b6b535fb0b0f6a069f144b66261bfb73789', '2026-02-27 23:58:01'),
(10, 1, 'eb2699fd214ecfb73a58113359f0020147905a2ca9ccbcec07448bbe302098a6', '2026-02-27 23:58:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `nomusuarios` varchar(45) NOT NULL,
  `contrausuarioscol` varchar(255) NOT NULL,
  `emailusuarios` varchar(45) NOT NULL,
  `rolusuarios` varchar(45) NOT NULL,
  `token_recuperacion` varchar(255) DEFAULT NULL,
  `token_expira` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `nomusuarios`, `contrausuarioscol`, `emailusuarios`, `rolusuarios`, `token_recuperacion`, `token_expira`) VALUES
(1, 'carlito', '$2y$10$Yzpfe7Vt/PQMiDPfmLKJ2u7EkVPgK8bPErRdYyD.UOjgtGmu/xuxu', 'carlito@gmail.com', '', NULL, NULL),
(2, 'carlito', '$2y$10$PQW5D/oDdhMOZw/w3SoiO.exp/BVK7gQGTHU82', 'carlito@gmail.com', '', NULL, NULL),
(3, 'carlito', '$2y$10$v9RXe47zRge6pG95CdBfa.8zW5MhFZwKRa51Cc/NQVCwO1MF/XpcS', 'carlito@gmail.com', '', NULL, NULL),
(4, 'juan', '$2y$10$AzGAVcBP9rjekM1nblwwz.yq/f6raDOv2VUS3W40XFNUf7irmkg5O', 'juan@gmail.com', '', NULL, NULL),
(5, 'carlito', '$2y$10$1xItPJCVLH2v8088ZLexteljQfI0aZLYG/Ck45s9tAZSz8YOWY8UG', 'carlito@gmail.com', '', NULL, NULL),
(8, 'admin', '$2y$10$ZhevlZPGBdlYVoXSWm57Ueh4Ths./AZ0NFBN7t/Z57dRyScQIA3AG', 'admin@gmail.com', 'admin', NULL, NULL),
(9, 'carlito', '$2y$10$75oVQx3Z0nthhuFD/ZetXe.whCahrWUzeFKjkrLrWdj9G2lEUTXqS', 'carlito@gmail.com', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `volumenes_manga`
--

CREATE TABLE `volumenes_manga` (
  `id_volumen` int(11) NOT NULL,
  `id_manga` int(11) DEFAULT NULL,
  `nro_volumen` int(11) DEFAULT NULL,
  `portada_url` varchar(255) DEFAULT NULL,
  `stock_volumen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `volumenes_manga`
--

INSERT INTO `volumenes_manga` (`id_volumen`, `id_manga`, `nro_volumen`, `portada_url`, `stock_volumen`) VALUES
(23, 13, 1, 'img/portadas/1772151821_volbibliomania.webp', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wishlist`
--

CREATE TABLE `wishlist` (
  `id_wishlist` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_manga` int(11) NOT NULL,
  `fecha_agregado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_manga` (`id_manga`);

--
-- Indices de la tabla `mangas`
--
ALTER TABLE `mangas`
  ADD PRIMARY KEY (`idmangas`);

--
-- Indices de la tabla `recuperacion_password`
--
ALTER TABLE `recuperacion_password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`);

--
-- Indices de la tabla `volumenes_manga`
--
ALTER TABLE `volumenes_manga`
  ADD PRIMARY KEY (`id_volumen`),
  ADD KEY `id_manga` (`id_manga`);

--
-- Indices de la tabla `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id_wishlist`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`,`id_manga`),
  ADD KEY `id_manga` (`id_manga`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `mangas`
--
ALTER TABLE `mangas`
  MODIFY `idmangas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `recuperacion_password`
--
ALTER TABLE `recuperacion_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `volumenes_manga`
--
ALTER TABLE `volumenes_manga`
  MODIFY `id_volumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id_wishlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`idusuarios`);

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id_compra`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`id_manga`) REFERENCES `mangas` (`idmangas`);

--
-- Filtros para la tabla `recuperacion_password`
--
ALTER TABLE `recuperacion_password`
  ADD CONSTRAINT `recuperacion_password_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`idusuarios`);

--
-- Filtros para la tabla `volumenes_manga`
--
ALTER TABLE `volumenes_manga`
  ADD CONSTRAINT `volumenes_manga_ibfk_1` FOREIGN KEY (`id_manga`) REFERENCES `mangas` (`idmangas`) ON DELETE CASCADE;

--
-- Filtros para la tabla `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`idusuarios`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`id_manga`) REFERENCES `mangas` (`idmangas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
