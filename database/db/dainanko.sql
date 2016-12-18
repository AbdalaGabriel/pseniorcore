-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2016 a las 03:52:07
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dainanko`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloquepertenecepagina`
--

CREATE TABLE `bloquepertenecepagina` (
  `idBloque` int(5) NOT NULL,
  `idPagina` int(3) NOT NULL,
  `ordenBloque` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bloquepertenecepagina`
--

INSERT INTO `bloquepertenecepagina` (`idBloque`, `idPagina`, `ordenBloque`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 1, 0),
(5, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloques`
--

CREATE TABLE `bloques` (
  `idBloque` int(5) NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `contenido` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bloques`
--

INSERT INTO `bloques` (`idBloque`, `titulo`, `contenido`) VALUES
(1, 'infoSobreMi', 'Hola este es mi curriculum como diseñador'),
(2, 'Caracteristicas', '1m 2 3, esdf'),
(3, 'Formulario', 'Tabla r er'),
(4, 'Galeria', 'asasdasasasdasdasdasasasdasdasdasasasdasdasdasasasdasdasdasasasdasdasdasasasdasdasdasasasdasdasdasasasdasdasdasdasdas'),
(5, 'Nuevo Bloque', 'HOla Hola HOla Mi amo!!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int(10) NOT NULL,
  `comentario` text COLLATE utf8_spanish_ci NOT NULL,
  `fechaComentario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `idTarea` int(20) NOT NULL,
  `idUsuario` int(8) NOT NULL,
  `hora` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`idComentario`, `comentario`, `fechaComentario`, `idTarea`, `idUsuario`, `hora`) VALUES
(1, 'Como va el proyecto?\r\nNecesitariamos tener este cambio para mañana', '27/10/2015', 2, 1, ''),
(2, 'Enseguida te paso los cambios', '27/10/2015', 2, 1, ''),
(3, 'Como va el proyecto?', '22/10/12', 2, 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `idEntrada` int(3) NOT NULL,
  `titulo` text COLLATE utf8_spanish_ci NOT NULL,
  `contenido` mediumtext COLLATE utf8_spanish_ci NOT NULL,
  `autor` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`idEntrada`, `titulo`, `contenido`, `autor`, `fecha`) VALUES
(3, 'Nuevo!!', '<p>Comience a redactar el contenido de su nuevundefined<img src="../../../backend/services/itemsPortfolio/fotosPortfolio/IMG_20130707_151207_838.jpg" alt="" width="100" height="100" /><img src="../../../backend/services/itemsPortfolio/fotosPortfolio/IMG_20130707_151218_297.jpg" alt="" width="100" height="100" />a nota.</p>', 'gabi', '0000-00-00'),
(4, 'La kuki Sandokan!', '<p>Comience a redactar el contenido de su nuevundefined<img src="../../../backend/services/itemsPortfolio/fotosPortfolio/IMG_20130707_151207_838.jpg" alt="" width="100" height="100" /><img src="../../../backend/services/itemsPortfolio/fotosPortfolio/IMG_20130707_151218_297.jpg" alt="" width="100" height="100" />a nota.</p>', 'gabi', '0000-00-00'),
(6, 'Holaaa', '<p>Comience a redactar el contenido de su nueva nota.<img src="../../../backend/services/itemsPortfolio/fotosPortfolio/IMG_20130707_151207_838.jpg" alt="" width="100" height="100" /></p>', 'gabi', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `idEntrega` int(11) NOT NULL,
  `idProyecto` int(10) NOT NULL,
  `inicio` date NOT NULL,
  `fechaEntrega` date NOT NULL,
  `titulo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descr` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`idEntrega`, `idProyecto`, `inicio`, `fechaEntrega`, `titulo`, `descr`) VALUES
(1, 2, '2015-06-08', '2015-06-11', 'Entrega de bocetos', 'entrega de 3 bocetos-'),
(2, 3, '2015-10-07', '2015-10-22', 'Terminar requerimientos', 'asd'),
(3, 2, '2015-10-01', '2015-10-09', 'Frutos al Natural', 'sd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `idImagen` int(5) NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `alt` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenesportfolio`
--

CREATE TABLE `imagenesportfolio` (
  `idImagen` int(4) NOT NULL,
  `urlImagen` varchar(10000) COLLATE utf8_spanish_ci NOT NULL,
  `ordenImagen` int(4) NOT NULL,
  `alt` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `imagenesportfolio`
--

INSERT INTO `imagenesportfolio` (`idImagen`, `urlImagen`, `ordenImagen`, `alt`) VALUES
(126, '/SENIOR/backend/services/itemsPortfolio/IMG_20130629_161018_639.jpg', 0, ''),
(127, '/SENIOR/backend/services/itemsPortfolio/roca.png', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenpertenecebloque`
--

CREATE TABLE `imagenpertenecebloque` (
  `idImagen` int(5) NOT NULL,
  `idBloque` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenperteneceitemportfolio`
--

CREATE TABLE `imagenperteneceitemportfolio` (
  `idImagen` int(4) NOT NULL,
  `idItemPortfolio` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `imagenperteneceitemportfolio`
--

INSERT INTO `imagenperteneceitemportfolio` (`idImagen`, `idItemPortfolio`) VALUES
(126, 86),
(127, 87);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemsportfolio`
--

CREATE TABLE `itemsportfolio` (
  `idItem` int(3) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `imagenPortada` int(5) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `itemsportfolio`
--

INSERT INTO `itemsportfolio` (`idItem`, `titulo`, `imagenPortada`, `descripcion`, `fecha`) VALUES
(86, 'Let the Sunshine!', 0, '<p>Easy! You should check out MoxieManAager!</p>', '0000-00-00 00:00:00'),
(87, 'Samurai', 0, '<p>Easy! You should check out MoxieManager!</p>', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE `media` (
  `idMedia` int(4) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `media`
--

INSERT INTO `media` (`idMedia`, `nombre`, `url`, `fecha`) VALUES
(1, '', '/SENIOR/backend/services/media/uploads/roca.png', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

CREATE TABLE `paginas` (
  `id` int(3) NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `urlFriendly` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paginas`
--

INSERT INTO `paginas` (`id`, `titulo`, `urlFriendly`) VALUES
(1, 'Sobre Mi', 'g'),
(2, 'Contacto', 'contacto'),
(4, 'NuevaPAg', 'nueva-pag'),
(7, 'Empresa', 'empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progreso`
--

CREATE TABLE `progreso` (
  `idProgreso` int(1) NOT NULL,
  `progreso` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `progreso`
--

INSERT INTO `progreso` (`idProgreso`, `progreso`) VALUES
(1, 'No iniciado.'),
(2, 'En desarrollo.'),
(3, 'Completo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `idProyecto` int(10) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `idUsuario` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`idProyecto`, `nombre`, `descripcion`, `idUsuario`) VALUES
(1, 'Diseno de Logotipo', 'armar marca', 2),
(2, 'Pagina web dinamica', 'Armar web dinamica para empresa de cartchos de tinta.', 1),
(3, 'Offset de madera', 'armar disenos cool para empresa de acerrin', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `idTarea` int(20) NOT NULL,
  `inicio` date NOT NULL,
  `entrega` date NOT NULL,
  `progreso` int(1) NOT NULL,
  `idEntrega` int(11) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`idTarea`, `inicio`, `entrega`, `progreso`, `idEntrega`, `titulo`, `descripcion`) VALUES
(2, '2015-09-08', '2015-09-30', 1, 1, 'Muestra de bocetos', 'MOstrar al cliente los bocetos'),
(3, '2015-09-01', '2015-09-29', 1, 1, 'Correción de bocetos, ajustar tipo.', 'Ajustar personaje en base a correciones del cliente.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idTipoUsuario` int(1) NOT NULL,
  `tipo` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idTipoUsuario`, `tipo`) VALUES
(1, 'Diseñador (SuperAdmin)'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariocomentaproyecto`
--

CREATE TABLE `usuariocomentaproyecto` (
  `idComentario` int(20) NOT NULL,
  `idProyecto` int(10) NOT NULL,
  `idUsuario` int(8) NOT NULL,
  `comentario` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(8) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `empresa` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `alta` date NOT NULL,
  `password` int(12) NOT NULL,
  `mail` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL,
  `tipoUsuario` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `foto`, `empresa`, `alta`, `password`, `mail`, `apellido`, `tipoUsuario`) VALUES
(1, 'mr', 'misdocumnetos/foto1.jpg', 'TodoModa', '2015-06-08', 123, 'mr@mr.com', '', 2),
(2, 'Gabriel', 'img/foto.jpg', 'GVR', '0000-00-00', 123, 'g@gabrielabdala.com.ar', 'Abdala', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bloquepertenecepagina`
--
ALTER TABLE `bloquepertenecepagina`
  ADD PRIMARY KEY (`idBloque`,`idPagina`),
  ADD KEY `idPagina` (`idPagina`);

--
-- Indices de la tabla `bloques`
--
ALTER TABLE `bloques`
  ADD PRIMARY KEY (`idBloque`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `FK_idTarea` (`idTarea`),
  ADD KEY `FK_idUsuario` (`idUsuario`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`idEntrada`);

--
-- Indices de la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`idEntrega`,`idProyecto`),
  ADD KEY `idProyecto` (`idProyecto`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`idImagen`);

--
-- Indices de la tabla `imagenesportfolio`
--
ALTER TABLE `imagenesportfolio`
  ADD PRIMARY KEY (`idImagen`);

--
-- Indices de la tabla `imagenpertenecebloque`
--
ALTER TABLE `imagenpertenecebloque`
  ADD PRIMARY KEY (`idImagen`,`idBloque`),
  ADD KEY `idBloque` (`idBloque`);

--
-- Indices de la tabla `imagenperteneceitemportfolio`
--
ALTER TABLE `imagenperteneceitemportfolio`
  ADD PRIMARY KEY (`idImagen`,`idItemPortfolio`),
  ADD KEY `idItemPortfolio` (`idItemPortfolio`);

--
-- Indices de la tabla `itemsportfolio`
--
ALTER TABLE `itemsportfolio`
  ADD PRIMARY KEY (`idItem`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`idMedia`);

--
-- Indices de la tabla `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `progreso`
--
ALTER TABLE `progreso`
  ADD PRIMARY KEY (`idProgreso`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`idProyecto`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`idTarea`,`idEntrega`),
  ADD KEY `idEntrega` (`idEntrega`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idTipoUsuario`);

--
-- Indices de la tabla `usuariocomentaproyecto`
--
ALTER TABLE `usuariocomentaproyecto`
  ADD PRIMARY KEY (`idComentario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bloques`
--
ALTER TABLE `bloques`
  MODIFY `idBloque` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `idEntrada` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `entregas`
--
ALTER TABLE `entregas`
  MODIFY `idEntrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `idImagen` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagenesportfolio`
--
ALTER TABLE `imagenesportfolio`
  MODIFY `idImagen` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT de la tabla `itemsportfolio`
--
ALTER TABLE `itemsportfolio`
  MODIFY `idItem` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `idMedia` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `paginas`
--
ALTER TABLE `paginas`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `progreso`
--
ALTER TABLE `progreso`
  MODIFY `idProgreso` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `idProyecto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `idTarea` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idTipoUsuario` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuariocomentaproyecto`
--
ALTER TABLE `usuariocomentaproyecto`
  MODIFY `idComentario` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bloquepertenecepagina`
--
ALTER TABLE `bloquepertenecepagina`
  ADD CONSTRAINT `bloquepertenecepagina_ibfk_1` FOREIGN KEY (`idBloque`) REFERENCES `bloques` (`idBloque`),
  ADD CONSTRAINT `bloquepertenecepagina_ibfk_2` FOREIGN KEY (`idPagina`) REFERENCES `paginas` (`id`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `FK_idTarea` FOREIGN KEY (`idTarea`) REFERENCES `tareas` (`idTarea`),
  ADD CONSTRAINT `FK_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `entregas_ibfk_1` FOREIGN KEY (`idProyecto`) REFERENCES `proyectos` (`idProyecto`);

--
-- Filtros para la tabla `imagenpertenecebloque`
--
ALTER TABLE `imagenpertenecebloque`
  ADD CONSTRAINT `imagenpertenecebloque_ibfk_1` FOREIGN KEY (`idImagen`) REFERENCES `imagenes` (`idImagen`),
  ADD CONSTRAINT `imagenpertenecebloque_ibfk_2` FOREIGN KEY (`idBloque`) REFERENCES `bloques` (`idBloque`);

--
-- Filtros para la tabla `imagenperteneceitemportfolio`
--
ALTER TABLE `imagenperteneceitemportfolio`
  ADD CONSTRAINT `imagenperteneceitemportfolio_ibfk_1` FOREIGN KEY (`idImagen`) REFERENCES `imagenesportfolio` (`idImagen`),
  ADD CONSTRAINT `imagenperteneceitemportfolio_ibfk_2` FOREIGN KEY (`idItemPortfolio`) REFERENCES `itemsportfolio` (`idItem`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`idEntrega`) REFERENCES `entregas` (`idEntrega`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
