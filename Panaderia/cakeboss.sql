-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2019 a las 07:21:28
-- Versión del servidor: 10.3.15-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cakeboss`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `documento_cliente` varchar(15) NOT NULL,
  `nombre_cliente` varchar(50) DEFAULT NULL,
  `apellido_cliente` varchar(50) DEFAULT NULL,
  `direccion_cliente` varchar(50) DEFAULT NULL,
  `telefono_cliente` varchar(15) DEFAULT NULL,
  `id_tipo_cliente` varchar(15) DEFAULT NULL,
  `email` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`documento_cliente`, `nombre_cliente`, `apellido_cliente`, `direccion_cliente`, `telefono_cliente`, `id_tipo_cliente`, `email`) VALUES
('10072846', 'andrea', 'prato', 'cll 7b n 5-2 escobal', '30063827', '01', 'andreaprato@gmail.com'),
('1014739725', 'katherin', 'beltran', 'av 4b n 7-56 prados', '3507285673', '02', 'katherinandreag@gmail.com'),
('105489643', 'luis', 'lopez', 'av 5 n 63-73 atalaya', '3129632734', '01', 'luislopez@hotmail.com'),
('1062692346', 'laura', 'acosta', 'cll 7 n 5-2 san luis', '3129637963', '02', 'lauraacosta@gmail.com'),
('1064829643', 'Andres', 'Fernandez', 'cll 7 n 12-45 escobal', '313749683', '01', 'andresfernandezhg@hotmail.com'),
('1064967385', 'carlos', 'perez', 'cll 8 n 7e 24', '3118408385', '01', 'carlosperez@homail.com'),
('1073790639', 'martin', 'lopez', 'cll 5b n 7-14 escobal', '3507947683', '02', 'martinlopez@gmail.com'),
('1075936849', 'vanessa', 'jaimes', 'cll 5 n 5b-76 ', '3119674895', '01', 'vanessaj@gmail.com'),
('1090443611', 'Edinson', 'Ortega', 'calle 9 # 21-50', '3123538436', '01', 'edinsonmantilla@gmail.com'),
('109303', 'negro', 'negrura', 'ufps', '12334', '01', 'geovany@gmail'),
('1093797785', 'chapo', 'guzman', 'cll 45 n 74 prados', '3508936784', '01', 'chapoguzman@gmail.com'),
('1094728895', 'pablo', 'escobar', 'av 4e n 5-5 prados', '3507934965', '01', 'pabloescobar@gmail.com'),
('11', 'gregorio', 'perez', '1111', '1111', '01', 'oio1'),
('1111', 'carlos', 'calceron', 'cll9', '123', '02', 'carloscalderon@gmail.com'),
('121212', 'jhonatan', 'beltran', 'njhj', '121', '01', 'jhonatanandres@hotmail.com'),
('1213', 'rene', 'Angarita', 'ufps', '3213425456', '02', 'fjdjdj@gmail.com'),
('12345', 'Edward', 'Cantillo', 'call1', '54321', '01', 'hahaha@gmail.com'),
('16367278', 'Andres', 'Fernandez', 'cll 7 n 12-45 escobal', '313749683', '01', 'andresfernandezhg@hotmail.com'),
('8', 'geovanny', 'mantilla', 'cmdii', '3213686166', '01', 'geovanymantilla@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` varchar(15) NOT NULL,
  `descripcion_compra` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` varchar(15) NOT NULL,
  `id_compra` varchar(15) DEFAULT NULL,
  `id_proveedor_inv_mat` varchar(15) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` varchar(15) NOT NULL,
  `fecha_inventario` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `fecha_inventario`) VALUES
('001', '2019-01-01'),
('15', '2015-05-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_producto`
--

CREATE TABLE `inventario_producto` (
  `id_producto` varchar(15) NOT NULL,
  `id_inventario` varchar(15) NOT NULL,
  `fecha_inventario` date NOT NULL,
  `cantidad_inv_producto` int(11) DEFAULT NULL,
  `descripcion` varchar(32) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `precio` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inventario_producto`
--

INSERT INTO `inventario_producto` (`id_producto`, `id_inventario`, `fecha_inventario`, `cantidad_inv_producto`, `descripcion`, `estado`, `precio`) VALUES
('001', '001', '2019-01-01', 100, 'pan de leche', 1, 200),
('002', '001', '2019-01-01', 200, 'pan de cascarita', 1, 200),
('003', '001', '2019-01-01', 100, 'pan de queso', 1, 200),
('004', '001', '2019-01-01', 200, 'pan de coco', 1, 200),
('005', '001', '2019-01-01', 100, 'pan de bocadillo', 1, 200),
('006', '001', '2019-01-01', 50, 'pan de jamon y queso', 1, 2000),
('007', '001', '2019-01-01', 4, 'torta de pastillaje estandar', 1, 30000),
('008', '001', '2019-01-01', 7, 'torta tres leches de fresa', 1, 45000),
('009', '001', '2019-01-01', 1, 'torta de quesillo', 1, 35000),
('010', '001', '2019-01-01', 4, 'torta de chocolte', 1, 20000),
('011', '001', '2019-01-01', 8, 'torta de brawny', 1, 30000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_temp`
--

CREATE TABLE `inventario_temp` (
  `id_inventario_tmp` varchar(15) NOT NULL,
  `id_item_orden` varchar(15) DEFAULT NULL,
  `id_producto` varchar(15) DEFAULT NULL,
  `id_proceso` varchar(15) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `tiempo` time DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_orden`
--

CREATE TABLE `item_orden` (
  `id_item_orden` varchar(15) NOT NULL,
  `id_pedido_orden` varchar(15) DEFAULT NULL,
  `id_producto` varchar(15) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_prima`
--

CREATE TABLE `materia_prima` (
  `id_materia_prima` varchar(15) NOT NULL,
  `nombre_materia_prima` varchar(30) DEFAULT NULL,
  `estado_materia_prima` varchar(30) DEFAULT NULL,
  `descripcion_materia_prima` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `materia_prima`
--

INSERT INTO `materia_prima` (`id_materia_prima`, `nombre_materia_prima`, `estado_materia_prima`, `descripcion_materia_prima`) VALUES
('00', 'arina', 'disponible', 'xxxxxx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` varchar(15) NOT NULL,
  `documento_cliente` varchar(15) DEFAULT NULL,
  `id_producto` varchar(15) DEFAULT NULL,
  `id_inventario` varchar(15) DEFAULT NULL,
  `fecha_inventario` date DEFAULT NULL,
  `cantidad_pedido` int(11) DEFAULT NULL,
  `precio_pedido` int(11) DEFAULT NULL,
  `tiempo_pedido` time DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `total_pedido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `documento_cliente`, `id_producto`, `id_inventario`, `fecha_inventario`, `cantidad_pedido`, `precio_pedido`, `tiempo_pedido`, `estado`, `total_pedido`) VALUES
('2019-11-28 17:1', '1213', '007', '001', '2019-11-28', 1, 30000, '00:00:17', 1, 30000),
('2019-11-29 00:4', '109303', '009', '001', '2019-11-29', 4, 35000, '00:00:00', 1, 140000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_orden`
--

CREATE TABLE `pedido_orden` (
  `id_pedido_orden` varchar(15) NOT NULL,
  `documento_cliente` varchar(15) DEFAULT NULL,
  `descripcion_pedido_orden` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedido_orden`
--

INSERT INTO `pedido_orden` (`id_pedido_orden`, `documento_cliente`, `descripcion_pedido_orden`) VALUES
('1', '11', '21212');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `id_proceso` varchar(15) NOT NULL,
  `nombre_proceso` varchar(30) DEFAULT NULL,
  `tiempo_proceso` time DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`id_proceso`, `nombre_proceso`, `tiempo_proceso`, `descripcion`) VALUES
('1', '11', '10:00:00', '22323');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` varchar(15) NOT NULL,
  `id_tipo_producto` varchar(15) DEFAULT NULL,
  `nombre_producto` varchar(30) DEFAULT NULL,
  `estado_producto` tinyint(1) DEFAULT NULL,
  `peso_producto` float DEFAULT NULL,
  `descripcion_producto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `id_tipo_producto`, `nombre_producto`, `estado_producto`, `peso_producto`, `descripcion_producto`) VALUES
('001', '01', 'Pan de leche', 1, 13.5, 'Pan a base de leche'),
('002', '01', 'Pan de cascarita', 1, 0, 'Pan de sal '),
('003', '01', 'Pan de queso', 1, 1.5, 'Pan relleno de queso'),
('004', '01', 'Pan de coco', 1, 1.5, 'Pan con trositos de coco rallado'),
('005', '01', 'Pan de bocadillo', 1, 1.5, 'pan relleno de bocadillo'),
('006', '01', 'Pan jamon y queso', 1, 1.5, 'Pan con jamon y queso'),
('007', '02', 'Torta de pastillaje', 1, 3, 'torta de pastillaje a base de zanahoria'),
('008', '02', 'Torta tres leches', 1, 3, 'torta tres leches con salsa de maracuya'),
('009', '02', 'Torta quesillo', 1, 3, 'torta tres leches con quesillo'),
('010', '02', 'Torta de chocolate', 1, 3, 'torta con pasta sabor a chocolate'),
('011', '02', 'Torta de brawny', 1, 3, 'torta de brawny'),
('012', '01', 'Pan de chocolate', 1, 1, 'pan de chocolate'),
('013', '01', 'Pan sema', 1, 1, 'Pan de sema'),
('014', '01', 'Pan integral', 1, 1, 'pan integral'),
('015', '01', 'Pan de linojo', 1, 1, 'Pan de linojo'),
('016', '01', 'hojaldre de pollo', 1, 1.5, 'hojaldre relleno de pollo'),
('017', '01', 'pan de oregano', 1, 1.5, 'pan salteado con oreñano molido'),
('018', '01', 'pan de maíz', 1, 1.5, 'pan hecho con harina de maiz'),
('019', '02', 'torta de leche se soya', 1, 3, 'torta de 2 capas con leche de soya'),
('020', '01', 'pan navideño', 1, 2, 'pan relleno con frutas,vegetales y embutidos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_materia`
--

CREATE TABLE `producto_materia` (
  `id_materia_prima` varchar(15) NOT NULL,
  `id_producto` varchar(15) NOT NULL,
  `id_inventario` varchar(15) DEFAULT NULL,
  `fecha_inventario` date DEFAULT NULL,
  `peso_producto_materia` float DEFAULT NULL,
  `cantidad_producto_materia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_proceso`
--

CREATE TABLE `producto_proceso` (
  `id_producto` varchar(15) NOT NULL,
  `id_proceso` varchar(15) NOT NULL,
  `tiempo` time NOT NULL,
  `decripcion` varchar(32) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `proceso_or` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` varchar(15) NOT NULL,
  `nombre_proveedor` varchar(50) DEFAULT NULL,
  `direccion_proveedor` varchar(50) DEFAULT NULL,
  `telefono_proveedor` varchar(15) DEFAULT NULL,
  `descripcion_proveedor` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre_proveedor`, `direccion_proveedor`, `telefono_proveedor`, `descripcion_proveedor`) VALUES
('001', 'La casa del panadero', 'av 5 #41', '5719878', 'proveedor de arina'),
('002', 'leche alqueria', 'Cl. 39 Sur, centro', '35085395', 'proveedor de leche'),
('003', 'levaduras mis enanos', 'Cll. 3  centro', '3127489063', 'proveedor de levadura'),
('004', 'colorantes´s house', 'av 5 N#13-4 centro', '3507934099', 'proveedor de colorante'),
('005', 'distribuidora sa', ' N#13-4 antonia santos', '314495386', 'proveedor de bolsas plasticas'),
('006', 'distribuidora dulces&dulces', 'cll 5 N#13-4 centro', '3159067836', 'proveedor de azúcar'),
('007', ' hk proveedor', 'av 5e N#13-4 libertad', '3137895478', 'proveedor de sal'),
('008', 'huevos kikes', ' Anillo Vial 7 N - 51', '312 526 2626', 'proveedor de huevos'),
('009', 'chocolate mi abuela', ' CLL 18A esmeralda', '316904658', 'proveedor de chocolate'),
('010', 'fruits fresh', ' Calle 10 Av22 N 22-40 centro', '315937854', 'proveedor de frutas'),
('011', 'la casa del queso', 'Calle 14 A  Av5 y 5C san luis', '311758936', 'proveedor de queso'),
('012', 'postobon', 'calle 28a av 23', '3145829578', 'proveedor de bebidas postobon'),
('013', 'cocacola', 'CLL 24 # 24 -16 centro', '3115863906', 'proveedor de bebidas cocacola'),
('014', 'distribuidora la costeña', 'AV 0A # 9 - 09', '3157890478', 'proveedor de polvo de hornear'),
('015', 'aromas de mi tierra', 'CLL 27 AV 23 PARQUE', '3112895388', 'proveedor de esencias'),
('016', 'distribuidora pan! pan!', 'CALLE 0 #3-96 san mateo', '316793785', 'proveedor de mejorantes panarios'),
('017', 'distribuidora walter white', 'CLL 28 CON AV 26 barrio nuevo', '3115023344', 'proveedor de ácidos orgánicos'),
('018', 'distribuidora chana', 'CLL 21 ENTRE AV 5 Y 6 san mateo', '3148905478', 'proveedor de aromáticas y especias'),
('019', 'distribuidora sequitos', 'AV 25A CON CLL 28 centro', '314895783', 'distribuidor de frutos secos'),
('020', 'distribuidora polvos&polvos', 'Calle 31 Av 29-30-31 belen', '3127854794', 'proveeedor de bicarbonato de sodio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_inv_mat`
--

CREATE TABLE `proveedor_inv_mat` (
  `id_proveedor_inv_mat` varchar(15) NOT NULL,
  `id_proveedor` varchar(15) DEFAULT NULL,
  `id_materia_prima` varchar(15) DEFAULT NULL,
  `id_inventario` varchar(15) DEFAULT NULL,
  `fecha_inventario` varchar(15) DEFAULT NULL,
  `cantidad_proveedor_inv_mat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cliente`
--

CREATE TABLE `tipo_cliente` (
  `id_tipo_cliente` varchar(15) NOT NULL,
  `nombre_tipo_cliente` varchar(15) DEFAULT NULL,
  `descripcion_tipo_cliente` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_cliente`
--

INSERT INTO `tipo_cliente` (`id_tipo_cliente`, `nombre_tipo_cliente`, `descripcion_tipo_cliente`) VALUES
('01', 'Singular', 'Persona que adquiere un solo producto'),
('02', 'Mayorista', 'Persona que adquiere más de 5 productos del mismo tipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tipo_producto` varchar(15) NOT NULL,
  `nombre_tipo_producto` varchar(30) DEFAULT NULL,
  `descripcion_tipo_producto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tipo_producto`, `nombre_tipo_producto`, `descripcion_tipo_producto`) VALUES
('01', 'Pan', 'Alimento básico que se elabora con una mezcla de harina, generalmente de trigo, agua, sal y levadura'),
('02', 'Torta', 'Postre tradicionalmente redondo compuesto de capas de masa dulce cocida al horno, decoradas con diversos ingredientes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Identificador` varchar(20) NOT NULL,
  `Contrasena` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Identificador`, `Contrasena`) VALUES
('2', 'hola'),
('3', 'qwe');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`documento_cliente`),
  ADD KEY `id_tipo_cliente` (`id_tipo_cliente`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_proveedor_inv_mat` (`id_proveedor_inv_mat`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`,`fecha_inventario`);

--
-- Indices de la tabla `inventario_producto`
--
ALTER TABLE `inventario_producto`
  ADD PRIMARY KEY (`id_producto`,`id_inventario`,`fecha_inventario`),
  ADD KEY `id_inventario` (`id_inventario`),
  ADD KEY `fecha_inventario` (`fecha_inventario`);

--
-- Indices de la tabla `inventario_temp`
--
ALTER TABLE `inventario_temp`
  ADD PRIMARY KEY (`id_inventario_tmp`),
  ADD KEY `id_item_orden` (`id_item_orden`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proceso` (`id_proceso`);

--
-- Indices de la tabla `item_orden`
--
ALTER TABLE `item_orden`
  ADD PRIMARY KEY (`id_item_orden`),
  ADD KEY `id_pedido_orden` (`id_pedido_orden`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD PRIMARY KEY (`id_materia_prima`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `documento_cliente` (`documento_cliente`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_inventario` (`id_inventario`);

--
-- Indices de la tabla `pedido_orden`
--
ALTER TABLE `pedido_orden`
  ADD PRIMARY KEY (`id_pedido_orden`),
  ADD KEY `documento_cliente` (`documento_cliente`);

--
-- Indices de la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD PRIMARY KEY (`id_proceso`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_tipo_producto` (`id_tipo_producto`);

--
-- Indices de la tabla `producto_materia`
--
ALTER TABLE `producto_materia`
  ADD PRIMARY KEY (`id_materia_prima`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_inventario` (`id_inventario`),
  ADD KEY `fecha_inventario` (`fecha_inventario`);

--
-- Indices de la tabla `producto_proceso`
--
ALTER TABLE `producto_proceso`
  ADD PRIMARY KEY (`id_producto`,`id_proceso`),
  ADD KEY `id_proceso` (`id_proceso`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `proveedor_inv_mat`
--
ALTER TABLE `proveedor_inv_mat`
  ADD PRIMARY KEY (`id_proveedor_inv_mat`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_materia_prima` (`id_materia_prima`),
  ADD KEY `id_inventario` (`id_inventario`);

--
-- Indices de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  ADD PRIMARY KEY (`id_tipo_cliente`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tipo_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Identificador`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_tipo_cliente`) REFERENCES `tipo_cliente` (`id_tipo_cliente`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`id_proveedor_inv_mat`) REFERENCES `proveedor_inv_mat` (`id_proveedor_inv_mat`);

--
-- Filtros para la tabla `inventario_producto`
--
ALTER TABLE `inventario_producto`
  ADD CONSTRAINT `inventario_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `inventario_producto_ibfk_2` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`);

--
-- Filtros para la tabla `inventario_temp`
--
ALTER TABLE `inventario_temp`
  ADD CONSTRAINT `inventario_temp_ibfk_1` FOREIGN KEY (`id_item_orden`) REFERENCES `item_orden` (`id_item_orden`),
  ADD CONSTRAINT `inventario_temp_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto_proceso` (`id_producto`),
  ADD CONSTRAINT `inventario_temp_ibfk_3` FOREIGN KEY (`id_proceso`) REFERENCES `producto_proceso` (`id_proceso`);

--
-- Filtros para la tabla `item_orden`
--
ALTER TABLE `item_orden`
  ADD CONSTRAINT `item_orden_ibfk_1` FOREIGN KEY (`id_pedido_orden`) REFERENCES `pedido_orden` (`id_pedido_orden`),
  ADD CONSTRAINT `item_orden_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`documento_cliente`) REFERENCES `cliente` (`documento_cliente`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`);

--
-- Filtros para la tabla `pedido_orden`
--
ALTER TABLE `pedido_orden`
  ADD CONSTRAINT `pedido_orden_ibfk_1` FOREIGN KEY (`documento_cliente`) REFERENCES `cliente` (`documento_cliente`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_tipo_producto`) REFERENCES `tipo_producto` (`id_tipo_producto`);

--
-- Filtros para la tabla `producto_materia`
--
ALTER TABLE `producto_materia`
  ADD CONSTRAINT `producto_materia_ibfk_1` FOREIGN KEY (`id_materia_prima`) REFERENCES `materia_prima` (`id_materia_prima`),
  ADD CONSTRAINT `producto_materia_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `producto_materia_ibfk_3` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`);

--
-- Filtros para la tabla `producto_proceso`
--
ALTER TABLE `producto_proceso`
  ADD CONSTRAINT `producto_proceso_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `producto_proceso_ibfk_2` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`),
  ADD CONSTRAINT `producto_proceso_ibfk_3` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `proveedor_inv_mat`
--
ALTER TABLE `proveedor_inv_mat`
  ADD CONSTRAINT `proveedor_inv_mat_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`),
  ADD CONSTRAINT `proveedor_inv_mat_ibfk_2` FOREIGN KEY (`id_materia_prima`) REFERENCES `materia_prima` (`id_materia_prima`),
  ADD CONSTRAINT `proveedor_inv_mat_ibfk_3` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
