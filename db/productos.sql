-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-03-2014 a las 16:35:50
-- Versión del servidor: 5.5.35
-- Versión de PHP: 5.4.4-14+deb7u8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Catproducto`
--

CREATE TABLE IF NOT EXISTS `Catproducto` (
  `idCatproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`idCatproducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Catproducto`
--

INSERT INTO `Catproducto` (`idCatproducto`, `nombre`) VALUES
(1, 'Linea Marron'),
(2, 'Linea Blanca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Detalle`
--

CREATE TABLE IF NOT EXISTS `Detalle` (
  `idProducto` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioUnitario` double NOT NULL,
  `subtotal` double NOT NULL,
  PRIMARY KEY (`idProducto`,`idPedido`),
  KEY `fk_Detalle_1` (`idPedido`),
  KEY `fk_Detalle_2` (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Factura`
--

CREATE TABLE IF NOT EXISTS `Factura` (
  `idFactura` int(11) NOT NULL AUTO_INCREMENT,
  `idPedido` int(11) NOT NULL,
  `total` double NOT NULL,
  `fecha` date NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `nit` varchar(45) NOT NULL,
  PRIMARY KEY (`idFactura`),
  UNIQUE KEY `idPedido_UNIQUE` (`idPedido`),
  KEY `fk_Factura_1` (`idPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Marca`
--

CREATE TABLE IF NOT EXISTS `Marca` (
  `idMarca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `existente` int(11) NOT NULL,
  PRIMARY KEY (`idMarca`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `Marca`
--

INSERT INTO `Marca` (`idMarca`, `nombre`, `existente`) VALUES
(1, 'Mabbe', 1),
(2, 'Sony', 1),
(3, 'Samsung', 1),
(5, 'GeneralElectric', 1),
(6, 'LG', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedido`
--

CREATE TABLE IF NOT EXISTS `Pedido` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `existente` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`idPedido`),
  KEY `fk_Pedido_1` (`idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Producto`
--

CREATE TABLE IF NOT EXISTS `Producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `tipo` int(11) NOT NULL,
  `marca` int(11) NOT NULL,
  `existencias` int(11) NOT NULL,
  `precio` double NOT NULL,
  `existente` int(11) NOT NULL,
  PRIMARY KEY (`idProducto`),
  KEY `fk_Producto_1` (`tipo`),
  KEY `fk_Producto_2` (`marca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `Producto`
--

INSERT INTO `Producto` (`idProducto`, `nombre`, `tipo`, `marca`, `existencias`, `precio`, `existente`) VALUES
(1, 'Refrigeradora', 2, 1, 10, 5500, 1),
(2, 'PlayStation', 1, 2, 5, 4500, 1),
(5, 'Televisor', 1, 6, 20, 3500, 1),
(6, 'Lavadora', 2, 5, 8, 2800, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `passwd` varchar(45) NOT NULL,
  `tipo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`idUsuario`, `username`, `passwd`, `tipo`, `nombre`, `apellido`, `email`) VALUES
(1, 'LexGrajeda', '123456', 1, 'Alexander', 'Grajeda', 'lexgrajeda@gmail.com');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Detalle`
--
ALTER TABLE `Detalle`
  ADD CONSTRAINT `fk_Detalle_1` FOREIGN KEY (`idPedido`) REFERENCES `Pedido` (`idPedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Detalle_2` FOREIGN KEY (`idProducto`) REFERENCES `Producto` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Factura`
--
ALTER TABLE `Factura`
  ADD CONSTRAINT `fk_Factura_1` FOREIGN KEY (`idPedido`) REFERENCES `Pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Pedido`
--
ALTER TABLE `Pedido`
  ADD CONSTRAINT `fk_Pedido_1` FOREIGN KEY (`idCliente`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Producto`
--
ALTER TABLE `Producto`
  ADD CONSTRAINT `fk_Producto_1` FOREIGN KEY (`tipo`) REFERENCES `Catproducto` (`idCatproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Producto_2` FOREIGN KEY (`marca`) REFERENCES `Marca` (`idMarca`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
