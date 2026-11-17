-- Base de Datos: sistema_compras_stock
CREATE DATABASE IF NOT EXISTS `sistema_compras_stock` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `sistema_compras_stock`;

-- Tabla: usuarios
CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `name_user` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `foto` varchar(100) DEFAULT 'user-default.png',
  `permisos_acceso` enum('Super Admin','Compras','Almacen') NOT NULL DEFAULT 'Super Admin',
  `status` enum('activo','bloqueado') NOT NULL DEFAULT 'activo',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `usuarios` (`username`, `name_user`, `password`, `email`, `telefono`, `permisos_acceso`, `status`) VALUES
('admin', 'Administrador General', '21232f297a57a5a743894a0e4a801fc3', 'admin@sistema.com', '0981123456', 'Super Admin', 'activo');
-- Nota: password 'admin' en MD5 (según estructura didáctica original del proyecto)

-- Tabla: departamento
CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `depart_descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `departamento` (`depart_descripcion`) VALUES ('Central'), ('Alto Paraná'), ('Itapúa');

-- Tabla: ciudad
CREATE TABLE `ciudad` (
  `cod_ciudad` int(11) NOT NULL AUTO_INCREMENT,
  `descrip_ciudad` varchar(100) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  PRIMARY KEY (`cod_ciudad`),
  FOREIGN KEY (`id_departamento`) REFERENCES `departamento`(`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `ciudad` (`descrip_ciudad`, `id_departamento`) VALUES ('Asunción', 1), ('Fernando de la Mora', 1), ('San Lorenzo', 1);

-- Tabla: cliente
CREATE TABLE `cliente` (
  `cod_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `ci_ruc` varchar(20) NOT NULL,
  `cli_nombre` varchar(100) NOT NULL,
  `cli_apellido` varchar(100) NOT NULL,
  `cli_direccion` varchar(150) DEFAULT NULL,
  `cli_telefono` varchar(30) DEFAULT NULL,
  `cod_ciudad` int(11) NOT NULL,
  PRIMARY KEY (`cod_cliente`),
  FOREIGN KEY (`cod_ciudad`) REFERENCES `ciudad`(`cod_ciudad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cliente` (`ci_ruc`, `cli_nombre`, `cli_apellido`, `cli_direccion`, `cli_telefono`, `cod_ciudad`) VALUES
('4567890', 'Juan', 'Pérez', 'Avda. Mariscal López 123', '0981111222', 1);

-- Tabla: proveedor
CREATE TABLE `proveedor` (
  `cod_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(100) NOT NULL,
  `ruc` varchar(20) NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cod_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `proveedor` (`razon_social`, `ruc`, `direccion`, `telefono`) VALUES
('Distribuidora Central S.A.', '80012345-6', 'Ruta Mcal. Estigarribia Km 9', '021500600');

-- Tabla: deposito
CREATE TABLE `deposito` (
  `cod_deposito` int(11) NOT NULL AUTO_INCREMENT,
  `descrip` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_deposito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `deposito` (`descrip`) VALUES ('Depósito Central'), ('Depósito Sucursal 1');

-- Tabla: tipo_producto
CREATE TABLE `tipo_producto` (
  `cod_tipo_prod` int(11) NOT NULL AUTO_INCREMENT,
  `t_p_descrip` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_tipo_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tipo_producto` (`t_p_descrip`) VALUES ('Insumos Informáticos'), ('Equipos de Oficina');

-- Tabla: u_medida
CREATE TABLE `u_medida` (
  `id_u_medida` int(11) NOT NULL AUTO_INCREMENT,
  `u_descrip` varchar(50) NOT NULL,
  PRIMARY KEY (`id_u_medida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `u_medida` (`u_descrip`) VALUES ('Unidad'), ('Caja'), ('Paquete');

-- Tabla: producto
CREATE TABLE `producto` (
  `cod_producto` int(11) NOT NULL AUTO_INCREMENT,
  `cod_tipo_prod` int(11) NOT NULL,
  `id_u_medida` int(11) NOT NULL,
  `p_descrip` varchar(150) NOT NULL,
  `precio` int(11) NOT NULL,
  PRIMARY KEY (`cod_producto`),
  FOREIGN KEY (`cod_tipo_prod`) REFERENCES `tipo_producto`(`cod_tipo_prod`),
  FOREIGN KEY (`id_u_medida`) REFERENCES `u_medida`(`id_u_medida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `producto` (`cod_tipo_prod`, `id_u_medida`, `p_descrip`, `precio`) VALUES
(1, 1, 'Teclado Mecánico USB', 180000),
(1, 1, 'Mouse Óptico Inalámbrico', 85000),
(2, 1, 'Monitor LED 24 Pulgadas', 950000);

-- Tabla: stock
CREATE TABLE `stock` (
  `cod_deposito` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`cod_deposito`, `cod_producto`),
  FOREIGN KEY (`cod_deposito`) REFERENCES `deposito`(`cod_deposito`),
  FOREIGN KEY (`cod_producto`) REFERENCES `producto`(`cod_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `stock` (`cod_deposito`, `cod_producto`, `cantidad`) VALUES (1, 1, 15), (1, 2, 30), (1, 3, 8);

-- Tabla: compra
CREATE TABLE `compra` (
  `cod_compra` int(11) NOT NULL AUTO_INCREMENT,
  `cod_proveedor` int(11) NOT NULL,
  `cod_deposito` int(11) NOT NULL,
  `nro_factura` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` enum('activo','anulado') NOT NULL DEFAULT 'activo',
  `total_compra` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`cod_compra`),
  FOREIGN KEY (`cod_proveedor`) REFERENCES `proveedor`(`cod_proveedor`),
  FOREIGN KEY (`cod_deposito`) REFERENCES `deposito`(`cod_deposito`),
  FOREIGN KEY (`id_user`) REFERENCES `usuarios`(`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla: detalle_compra
CREATE TABLE `detalle_compra` (
  `cod_compra` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`cod_compra`, `cod_producto`),
  FOREIGN KEY (`cod_compra`) REFERENCES `compra`(`cod_compra`),
  FOREIGN KEY (`cod_producto`) REFERENCES `producto`(`cod_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla temporal para carga dinámica de productos en compra
CREATE TABLE `tmp` (
  `id_tmp` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL,
  `precio_tmp` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tmp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Vistas solicitadas en Proyecto 10
CREATE OR REPLACE VIEW v_compras AS
SELECT comp.cod_compra,
       prov.cod_proveedor, prov.razon_social,
       dep.cod_deposito, dep.descrip,
       comp.nro_factura, comp.fecha, comp.hora, comp.estado, comp.total_compra,
       usu.id_user, usu.name_user
FROM compra comp
JOIN proveedor prov ON comp.cod_proveedor = prov.cod_proveedor
JOIN deposito dep ON comp.cod_deposito = dep.cod_deposito
JOIN usuarios usu ON comp.id_user = usu.id_user;

CREATE OR REPLACE VIEW v_det_compra AS
SELECT comp.cod_compra,
       pro.cod_producto, tpro.t_p_descrip, um.u_descrip, pro.p_descrip,
       det.precio, det.cantidad
FROM detalle_compra det
JOIN compra comp ON det.cod_compra = comp.cod_compra
JOIN producto pro ON det.cod_producto = pro.cod_producto
JOIN tipo_producto tpro ON pro.cod_tipo_prod = tpro.cod_tipo_prod
JOIN u_medida um ON pro.id_u_medida = um.id_u_medida;

-- Trigger solicitado en Proyecto 13
DELIMITER $$
CREATE TRIGGER borrar_temp AFTER INSERT ON compra
FOR EACH ROW BEGIN
    DELETE FROM tmp;
END$$
DELIMITER ;
