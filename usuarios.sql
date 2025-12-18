-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2025
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
-- Base de datos: `login-php`
--

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `coduser` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `idusuario` varchar(20) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `admitido` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `password`, `nombre`, `apellidos`, `admitido`) VALUES
('admin', '$2y$10$Kk4Yc.3b5W7pRvn0bRswEOGd05y9Zx9hQYFZptnZ2v6R.HGZzGZSO', 'Administrador', 'Principal', 1),
('Alvaro_MG64', '$2y$10$Q8Ue8iQwC3vbtN1m8bWJ9e2n.8f0KpJHf6wT2mN8dR5JkL7fTQWfa', 'ALVARO', 'MOZO GASPAR', 1),
('Zazza_I5', '$2y$10$N3pF8bW8Qv1kL2rXh6sZ7eP9y8R5jT2v6xF9hL7cY1kM4qVbTz3O', 'FEDERICO', 'ZOMPICCHIATTI', 1);

--
-- AUTO_INCREMENT de las tablas volcadas
--

ALTER TABLE `usuarios`
  MODIFY `coduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;