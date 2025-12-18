-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Base de datos: `login-php`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `coduser` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `admitido` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`coduser`),
  UNIQUE KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Registros
INSERT INTO `usuarios` (`idusuario`, `password`, `nombre`, `apellidos`, `admitido`) VALUES
('Alvaro_MG64', 'Uruguasho3*', 'ALVARO', 'MOZO GASPAR', 1),
('Zazza_I5', 'Abduzcan7#', 'FEDERICO', 'ZOMPICCHIATTI', 1);

ALTER TABLE `usuarios`
  MODIFY `coduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;