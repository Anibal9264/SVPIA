-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-03-2021 a las 19:46:24
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-06:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `SVPIA`
--
CREATE DATABASE IF NOT EXISTS `SVPIA` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `SVPIA`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL DEFAULT 'NoNe',
  `img` varchar(255) NOT NULL DEFAULT 'imgCat/default.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `descripcion`, `img`) VALUES
(1, 'Ninguna', 'imgCat/2021-03-08 21-06-20.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

DROP TABLE IF EXISTS `ingresos`;
CREATE TABLE IF NOT EXISTS `ingresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facturaNumero` varchar(255) DEFAULT NULL,
  `proveedor` varchar(255) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `monto` decimal(8,2) NOT NULL,
  `fecha` date NOT NULL,
  `archivo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `local`
--

DROP TABLE IF EXISTS `local`;
CREATE TABLE IF NOT EXISTS `local` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `subNombre` varchar(255) NOT NULL,
  `propietario` varchar(255) DEFAULT NULL,
  `cedula` varchar(255) DEFAULT NULL,
  `direccionExacta` varchar(255) NOT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `canton` varchar(255) DEFAULT NULL,
  `distrito` varchar(255) DEFAULT NULL,
  `telefono` varchar(10) NOT NULL,
  `impuesto` decimal(10,2) DEFAULT NULL,
  `tipoDeCambio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `correo` varchar(255) DEFAULT NULL,
  `logotipo` varchar(255) DEFAULT NULL,
  `user` varchar(255) NOT NULL DEFAULT 'admin',
  `password` varchar(255) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `local`
--

INSERT INTO `local` (`id`, `nombre`, `subNombre`, `propietario`, `cedula`, `direccionExacta`, `provincia`, `canton`, `distrito`, `telefono`, `impuesto`, `tipoDeCambio`, `correo`, `logotipo`, `user`, `password`) VALUES
(1, 'Nombre', 'Sub Nombre', 'Propietario', '000-0000', 'Direción exacta', 'Província', 'Cantón', 'distrito', '88888888', '13.00', '605.00', 'correo@gmail.com', 'logo/image.png', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precioVenta` decimal(10,2) DEFAULT NULL,
  `categoria` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_producto_categoria` (`categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoPago`
--

DROP TABLE IF EXISTS `tipoPago`;
CREATE TABLE IF NOT EXISTS `tipoPago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoPago`
--

INSERT INTO `tipoPago` (`id`, `descripcion`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta'),
(3, 'SINPE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `cliente` varchar(255) DEFAULT NULL,
  `cantidadPersonas` int(11) DEFAULT NULL,
  `local` int(11) NOT NULL DEFAULT 1,
  `tipoPago` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_ventas_local1_idx` (`local`),
  KEY `fk_ventas_tipoPago` (`tipoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_ventas_local1` FOREIGN KEY (`local`) REFERENCES `local` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas_tipoPago` FOREIGN KEY (`tipoPago`) REFERENCES `tipoPago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;



--
-- Estructura de tabla para la tabla `productos_vendidos`
--

DROP TABLE IF EXISTS `productos_vendidos`;
CREATE TABLE IF NOT EXISTS `productos_vendidos` (
  `producto` int(11) NOT NULL,
  `factura` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`producto`,`factura`),
  KEY `fk_productos_has_factura_factura1_idx` (`factura`),
  KEY `fk_productos_has_factura_productos_idx` (`producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `productos_vendidos`
  ADD CONSTRAINT `fk_productos_has_factura_factura1` FOREIGN KEY (`factura`) REFERENCES `ventas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_has_factura_productos` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
-- --------------------------------------------------------


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
