delimiter $$

CREATE DATABASE `tienda` /*!40100 DEFAULT CHARACTER SET utf8 */$$

use tienda $$

CREATE TABLE `Catproducto` (
  `idCatproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`idCatproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$


CREATE TABLE `Marca` (
  `idMarca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `existente` int(11) NOT NULL,
  PRIMARY KEY (`idMarca`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$

CREATE TABLE `Usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `passwd` varchar(45) NOT NULL,
  `tipo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$


CREATE TABLE `Producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `tipo` int(11) NOT NULL,
  `marca` int(11) NOT NULL,
  `existencias` int(11) NOT NULL,
  `precio` double NOT NULL,
  `existente` int(11) NOT NULL,
  PRIMARY KEY (`idProducto`),
  KEY `fk_Producto_1` (`tipo`),
  KEY `fk_Producto_2` (`marca`),
  CONSTRAINT `fk_Producto_1` FOREIGN KEY (`tipo`) REFERENCES `Catproducto` (`idCatproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Producto_2` FOREIGN KEY (`marca`) REFERENCES `Marca` (`idMarca`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$

CREATE TABLE `Pedido` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `existente` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`idPedido`),
  KEY `fk_Pedido_1` (`idCliente`),
  CONSTRAINT `fk_Pedido_1` FOREIGN KEY (`idCliente`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$


CREATE TABLE `Detalle` (
  `idProducto` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioUnitario` double NOT NULL,
  `subtotal` double NOT NULL,
  PRIMARY KEY (`idProducto`,`idPedido`),
  KEY `fk_Detalle_1` (`idPedido`),
  KEY `fk_Detalle_2` (`idProducto`),
  CONSTRAINT `fk_Detalle_1` FOREIGN KEY (`idPedido`) REFERENCES `Pedido` (`idPedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Detalle_2` FOREIGN KEY (`idProducto`) REFERENCES `Producto` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$


CREATE TABLE `Factura` (
  `idFactura` int(11) NOT NULL AUTO_INCREMENT,
  `idPedido` int(11) NOT NULL,
  `total` double NOT NULL,
  `fecha` date NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `nit` varchar(45) NOT NULL,
  PRIMARY KEY (`idFactura`),
  UNIQUE KEY `idPedido_UNIQUE` (`idPedido`),
  KEY `fk_Factura_1` (`idPedido`),
  CONSTRAINT `fk_Factura_1` FOREIGN KEY (`idPedido`) REFERENCES `Pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$

