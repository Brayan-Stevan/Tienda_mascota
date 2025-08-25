-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2025 a las 06:04:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_mascota`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `id_articulo` int(12) NOT NULL,
  `nombre_art` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `id_tipo_articulo` int(12) NOT NULL,
  `id_documento` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id_articulo`, `nombre_art`, `precio`, `descripcion`, `imagen`, `id_tipo_articulo`, `id_documento`) VALUES
(7, 'Comida Para Perros', 20000.00, 'Alimento premium para perros adultos de la mas alta calidad para tu mascota', 'img/producto-perro.jpeg', 1, 1006212832),
(8, 'Juguete Para Gatos', 60000.00, 'Ratón interactivo ideal para entrenar a tu gato, para que no se aburre en casa.', 'img/producto-gato.jpeg', 2, 1115943678),
(9, 'Collar Ajustable', 40000.00, 'Collar resistente y cómodo para perros de todos los tamaños.', 'img/producto-perro3.jpeg', 3, 1006212832),
(10, 'Cama Acolchada Para Perros', 180000.00, 'Cama Cómoda y suave para un descanso ideal para tu mascota.', 'img/producto-perro4.jpeg', 3, 1115943678),
(11, 'Rascador Para Gatos', 120000.00, 'Rascador resistente con base estable para tu gato se divierta sin dañar los muebles.', 'img/producto-gato1.jpeg', 3, 1006212832),
(12, 'Arnés Ajustable', 90000.00, 'Arnés ergonómico y seguro, diseñado para paseos cómodos y sin tirones.', 'img/producto-gato2.jpeg', 3, 1115943678);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta_art`
--

CREATE TABLE `detalle_venta_art` (
  `id_detalle` int(12) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `id_venta` int(12) NOT NULL,
  `id_articulo` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_venta_art`
--

INSERT INTO `detalle_venta_art` (`id_detalle`, `cantidad`, `sub_total`, `id_venta`, `id_articulo`) VALUES
(1, 2, 120000.00, 1, 8),
(2, 2, 360000.00, 2, 10),
(3, 3, 120000.00, 3, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id_mascota` int(12) NOT NULL,
  `nombre_mas` text NOT NULL,
  `fecha_naci` date NOT NULL,
  `sexo` enum('Macho','Hembra','','') NOT NULL,
  `id_documento` int(12) NOT NULL,
  `id_raza` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id_mascota`, `nombre_mas`, `fecha_naci`, `sexo`, `id_documento`, `id_raza`) VALUES
(4, 'firulais', '2024-09-09', 'Macho', 1004334346, 4),
(5, 'Afrodita', '2025-09-09', 'Hembra', 1005635876, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

CREATE TABLE `raza` (
  `id_raza` int(12) NOT NULL,
  `razas` text NOT NULL,
  `id_tipo_mascota` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`id_raza`, `razas`, `id_tipo_mascota`) VALUES
(1, 'Labrador Retriever', 1),
(2, 'Pastor Alemán', 1),
(3, 'Husky Siberiano', 1),
(4, 'Bulldog Francés', 1),
(5, 'Chihuahua', 1),
(6, 'Pomerania', 1),
(7, 'Perro Salchicha', 1),
(8, 'Rottweiler', 1),
(9, 'American Pitbull', 1),
(10, 'Belgian Malinois', 1),
(11, 'Ragdoll', 2),
(12, 'Exótico', 2),
(13, 'British Shorthair', 2),
(14, 'Persa', 2),
(15, 'Maine Coon', 2),
(16, 'Siamés', 2),
(17, 'Bengalí', 2),
(18, 'Sphynx', 2),
(19, 'Abisinio', 2),
(20, 'Scottish Fold', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tip_art`
--

CREATE TABLE `tip_art` (
  `id_tipo_articulo` int(12) NOT NULL,
  `tipo_articulo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tip_art`
--

INSERT INTO `tip_art` (`id_tipo_articulo`, `tipo_articulo`) VALUES
(1, 'Alimento'),
(2, 'Juguete'),
(3, 'Accesorio'),
(4, 'Higiene');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tip_mas`
--

CREATE TABLE `tip_mas` (
  `id_tipo_mascota` int(12) NOT NULL,
  `tipo_mascota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tip_mas`
--

INSERT INTO `tip_mas` (`id_tipo_mascota`, `tipo_mascota`) VALUES
(1, 'Perro'),
(2, 'Gato'),
(3, 'Conejo'),
(4, 'Hámster'),
(5, 'Pez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tip_use`
--

CREATE TABLE `tip_use` (
  `id_tipo_user` int(12) NOT NULL,
  `tipo_user` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tip_use`
--

INSERT INTO `tip_use` (`id_tipo_user`, `tipo_user`) VALUES
(1, 'Propietario'),
(2, 'Administrador'),
(3, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_documento` int(12) NOT NULL,
  `nombre` text NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(500) NOT NULL,
  `user` varchar(50) NOT NULL,
  `id_tipo_user` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_documento`, `nombre`, `telefono`, `email`, `contrasena`, `user`, `id_tipo_user`) VALUES
(1004334346, 'darlinson', '3205671283', 'didier123@gmail.com', '$2y$10$nRnUwc7AYHBAlKnHoTZpwObdCRNsJK6oXf3KPFxR6jEgmLfuzowsy', 'daga', 1),
(1005635876, 'kevin', '3204528872', 'kevin123@gmail.com', '$2y$10$f.sOVKYSeRvIZ5RYHMuSeOjBSftrhOvNeWANEczyF42ThpUucsXTu', 'kalvin1', 1),
(1006212832, 'Anderson', '3210341231', 'ander1234@gmail.com', '$2y$10$4b..Y1Gv7E25OYtWFfRmS.v8ISIRZoEwGWBhW3IA1OQxr6HBekuOK', 'Ander', 3),
(1006511657, 'Brayan', '3204526846', 'bastobrayan246@gmail.com', '$2y$10$HMHEPnaBhRUgh0x69HFZ8O/QS.zachKILbxgmWsrXF6imKkc0yvc6', 'Stevan', 2),
(1115943678, 'Darlinson', '3213798403', 'darlinson123@gmail.com', '$2y$10$AZR/gratrLZVprZzgqehu.q9WjJN3EiSMdi5pACiYBq2PYx7Hm7BG', 'Tata', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(12) NOT NULL,
  `fecha_venta` datetime NOT NULL,
  `id_documento` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `fecha_venta`, `id_documento`) VALUES
(1, '2025-08-24 19:20:55', 1004334346),
(2, '2025-08-24 21:59:14', 1005635876),
(3, '2025-08-24 23:36:26', 1005635876);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`id_articulo`),
  ADD KEY `id_tipo_articulo` (`id_tipo_articulo`),
  ADD KEY `id_documento` (`id_documento`);

--
-- Indices de la tabla `detalle_venta_art`
--
ALTER TABLE `detalle_venta_art`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_articulo` (`id_articulo`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id_mascota`),
  ADD KEY `documento` (`id_documento`),
  ADD KEY `id_raza` (`id_raza`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
  ADD PRIMARY KEY (`id_raza`),
  ADD KEY `id_tipo_mascota` (`id_tipo_mascota`);

--
-- Indices de la tabla `tip_art`
--
ALTER TABLE `tip_art`
  ADD PRIMARY KEY (`id_tipo_articulo`);

--
-- Indices de la tabla `tip_mas`
--
ALTER TABLE `tip_mas`
  ADD PRIMARY KEY (`id_tipo_mascota`);

--
-- Indices de la tabla `tip_use`
--
ALTER TABLE `tip_use`
  ADD PRIMARY KEY (`id_tipo_user`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_tipo_user` (`id_tipo_user`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `documento` (`id_documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `id_articulo` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `detalle_venta_art`
--
ALTER TABLE `detalle_venta_art`
  MODIFY `id_detalle` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id_mascota` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
  MODIFY `id_raza` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tip_art`
--
ALTER TABLE `tip_art`
  MODIFY `id_tipo_articulo` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tip_mas`
--
ALTER TABLE `tip_mas`
  MODIFY `id_tipo_mascota` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tip_use`
--
ALTER TABLE `tip_use`
  MODIFY `id_tipo_user` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `articulo_ibfk_1` FOREIGN KEY (`id_tipo_articulo`) REFERENCES `tip_art` (`id_tipo_articulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articulo_ibfk_2` FOREIGN KEY (`id_documento`) REFERENCES `user` (`id_documento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_venta_art`
--
ALTER TABLE `detalle_venta_art`
  ADD CONSTRAINT `detalle_venta_art_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_art_ibfk_2` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id_articulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_ibfk_2` FOREIGN KEY (`id_documento`) REFERENCES `user` (`id_documento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mascota_ibfk_3` FOREIGN KEY (`id_raza`) REFERENCES `raza` (`id_raza`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `raza`
--
ALTER TABLE `raza`
  ADD CONSTRAINT `raza_ibfk_1` FOREIGN KEY (`id_tipo_mascota`) REFERENCES `tip_mas` (`id_tipo_mascota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_tipo_user`) REFERENCES `tip_use` (`id_tipo_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_documento`) REFERENCES `user` (`id_documento`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
