-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-07-2025 a las 07:08:39
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
-- Base de datos: `partycolor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rif` varchar(20) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`products`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `invoices`
--

INSERT INTO `invoices` (`id`, `user_id`, `rif`, `business_name`, `date`, `total`, `products`, `created_at`) VALUES
(12, 10, '30091441', 'FORUM', '2025-06-25 16:06:35', 1130.00, '[{\"name\":\"Alcancia extra grande 33cm, 3c\\/u\",\"quantity\":2,\"price\":120},{\"name\":\"Alcancia grande 23cm, 1,5c\\/u\",\"quantity\":5,\"price\":75},{\"name\":\"Alcancia pequena de lata 11,5cm, 1c\\/u\",\"quantity\":4,\"price\":50},{\"name\":\"Block construccion 10H,  0,90 c\\/u\",\"quantity\":3,\"price\":45},{\"name\":\"Block lustrillo, 10H, 0,90 c\\/u\",\"quantity\":2,\"price\":90}]', '2025-06-25 16:06:35'),
(13, 10, '55555', 'market 1', '2025-06-25 16:07:57', 812.00, '[{\"name\":\"Alcancia extra grande 33cm, 3c\\/u\",\"quantity\":2,\"price\":120},{\"name\":\"Alcancia pequena de lata 11,5cm, 1c\\/u\",\"quantity\":2,\"price\":50},{\"name\":\"Ludo de caja, 2.8 c\\/u\",\"quantity\":4,\"price\":33},{\"name\":\"Cartulina Doble Fax, 0,40 c\\/u\",\"quantity\":5,\"price\":20},{\"name\":\"Cartulina fosforescente, 0,60 c\\/u\",\"quantity\":4,\"price\":60}]', '2025-06-25 16:07:57'),
(14, 10, '2222', 'market 2', '2025-06-25 16:09:17', 560.00, '[{\"name\":\"Papel Bond\",\"quantity\":8,\"price\":70}]', '2025-06-25 16:09:17'),
(15, 10, '202022', 'market 3', '2025-06-25 16:10:11', 480.00, '[{\"name\":\"Relleno de pinata, 4 c\\/u\",\"quantity\":10,\"price\":48}]', '2025-06-25 16:10:11'),
(16, 10, '777777', 'market 4', '2025-06-25 16:11:11', 842.00, '[{\"name\":\"Alcancia grande 23cm, 1,5c\\/u\",\"quantity\":2,\"price\":75},{\"name\":\"Alcancia pequena de lata 11,5cm, 1c\\/u\",\"quantity\":2,\"price\":50},{\"name\":\"Ludo de sobre, 1c\\/u\",\"quantity\":2,\"price\":100},{\"name\":\"Bingo de sobre, 1c\\/u\",\"quantity\":2,\"price\":100},{\"name\":\"Rompecabezas grande, 1 c\\/u\",\"quantity\":2,\"price\":96}]', '2025-06-25 16:11:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `img`, `nombre`, `descripcion`, `precio`, `fecha_creacion`) VALUES
(11, 'img_Productos/685bf9cba70ef.jpg', 'Alcancia extra grande 33cm, 3c/u', 'alcancia extra grande, bulto de 40 unidades con diferentes motivos surtidos', 120.00, '2025-06-25'),
(12, 'img_Productos/685bfb341070a.jpg', 'Alcancia grande 23cm, 1,5c/u', 'alcancia grande de lata. bulto de 50 unidades de diferentes motivos surtidos', 75.00, '2025-06-25'),
(13, 'img_Productos/685bfbbc79cce.jpg', 'Alcancia pequena de lata 11,5cm, 1c/u', 'alcancia pequena de lata, bulto de 50 unidades de diferentes motivos surtidos.', 50.00, '2025-06-25'),
(14, 'img_Productos/685bfc349d7e4.jpg', 'Ludo de sobre, 1c/u', 'Ludo de sobre bodeguero, 100 unidades el bulto', 100.00, '2025-06-25'),
(15, 'img_Productos/685bfc8ec2ba6.jpg', 'Bingo de sobre, 1c/u', 'Bingo de sobre bodeguero, 12 cartones, 100 unidades el bulto', 100.00, '2025-06-25'),
(16, 'img_Productos/685bfd083b469.jpg', 'Ludo de caja, 2.8 c/u', 'Ludo de caja, 12 unidades el paquete', 33.60, '2025-06-25'),
(17, 'img_Productos/685bfd736565e.jpg', 'Bingo de caja, 2,8 c/u', 'Bingo de caja, 12 unidades el paquete', 33.00, '2025-06-25'),
(18, 'img_Productos/685bfde4db79d.jpg', 'Rompecabezas grande, 1 c/u', 'rompecabezas de diferentes motivos surtidos el bulto, 96 unidades', 96.00, '2025-06-25'),
(19, 'img_Productos/685bfe4de08fa.jpg', 'Monopolio de caja,  2,8 c/u', 'Monopolio de caja, 12 unidades el paquete', 33.00, '2025-06-25'),
(20, 'img_Productos/685c1a8c3f8d2.jpg', 'Relleno de pinata, 4 c/u', 'relleno de pinata, 12 unidades el bulto', 48.00, '2025-06-25'),
(21, 'img_Productos/685c1b1cee8eb.jpg', 'Block construccion 10H,  0,90 c/u', 'Block construcion de diez hojas de diferentes colores, 50 unidades el bulto', 45.00, '2025-06-25'),
(22, 'img_Productos/685c1b71a85d6.jpg', 'Block lustrillo, 10H, 0,90 c/u', 'Block lustrillo diez hojas de diferentes colores, 100 unidades el bulto', 90.00, '2025-06-25'),
(23, 'img_Productos/685c1be650447.jpg', 'Cartulina Escolar, 0,30 c/u', 'Cartulina escolar de varios colores, 100 pliegos el paquete', 30.00, '2025-06-25'),
(24, 'img_Productos/685c1c755edbc.jpg', 'Cartulina Doble Fax, 0,40 c/u', 'Cartulina doble fax de varios colores, 50 pliegos el paquete', 20.00, '2025-06-25'),
(25, 'img_Productos/685c1cebb6a54.jpg', 'Cartulina fosforescente, 0,60 c/u', 'Cartulina fosforescente de varios colores, 100 pliegos el paquete', 60.00, '2025-06-25'),
(26, 'img_Productos/685c1d1d40577.jpg', 'Papel Bond', 'Papel Bond, Resma de 500', 70.00, '2025-06-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `tipoUsuario` int(11) NOT NULL,
  `fecha_creacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `usuario`, `email`, `clave`, `tipoUsuario`, `fecha_creacion`) VALUES
(2, 'prueba', 'prueba@gmail.com', '$2y$10$GxB9bdGbhrkib1lSxh3t1e8NCzi59/qDL3BDGBGfIZZXhwHXbUpRW', 1, 0),
(3, 'jean pier', 'jeanpiersotomayor@gmail.com', '$2y$10$twJX3LTlDz.Ql/N/51.KEunX4xQ/SpAU4YfZHlijUxRj3yfhGj54a', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp(),
  `token` varchar(255) NOT NULL,
  `password_request` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `fecha_creacion`, `token`, `password_request`) VALUES
(8, 'hector', 'hectorguerra@gmail.com', '$2y$10$8A3qxCosuPNd8ZYi6FuCGeGov/lJcO/4JKVRfiP2ZIon0tAAWkEUC', '2025-06-21', '', 2),
(9, 'hector', 'hectorsantiagoguerra004@gmail.com', '$2y$10$2F5hJS4tJFkI9bou7Fzbve7vKQJGhs.HK.HgChA0LppW3Aqb6BOf6', '2025-06-21', '', 2),
(10, 'jean sotomayor', 'jeanpiersotomayor@gmail.com', '$2y$10$.TQCzIjel3yj8rjCgemNIulLAu8DjH8adJmlhZ.0SlFWuKs2H5yH2', '2025-07-05', '', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
