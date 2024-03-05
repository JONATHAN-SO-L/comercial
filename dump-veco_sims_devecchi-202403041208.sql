-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.6.16-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `levantamientos`
--

DROP TABLE IF EXISTS `levantamientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `levantamientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(5) NOT NULL,
  `edificio` varchar(5) NOT NULL,
  `ubicacion` varchar(5) NOT NULL,
  `uma` varchar(100) NOT NULL,
  `etapa_etp1` varchar(5) DEFAULT NULL,
  `codigo_etp1` varchar(25) DEFAULT NULL,
  `descripcion_corta_etp1` varchar(90) DEFAULT NULL,
  `familia_etp1` varchar(30) DEFAULT NULL,
  `modelo_etp1` varchar(20) DEFAULT NULL,
  `tipo_etp1` varchar(20) DEFAULT NULL,
  `eficiencia_etp1` varchar(50) DEFAULT NULL,
  `gasto_etp1` varchar(20) DEFAULT NULL,
  `alto_nom_etp1` varchar(10) DEFAULT NULL,
  `frente_nom_etp1` varchar(10) DEFAULT NULL,
  `fondo_nom_etp1` varchar(10) DEFAULT NULL,
  `um_nominal_etp1` varchar(5) DEFAULT NULL,
  `marco_etp1` varchar(30) DEFAULT NULL,
  `espesor_etp1` varchar(10) DEFAULT NULL,
  `um_espesor_etp1` varchar(5) DEFAULT NULL,
  `num_separadores_etp1` varchar(5) DEFAULT NULL,
  `media_fil_etp1` varchar(50) DEFAULT NULL,
  `forma_media_fil_etp1` varchar(40) DEFAULT NULL,
  `color_media_fil_etp1` varchar(20) DEFAULT NULL,
  `bolsas_etp1` varchar(5) DEFAULT NULL,
  `media_ad_etp1` varchar(10) DEFAULT NULL,
  `separador_etp1` varchar(30) DEFAULT NULL,
  `asa_etp1` varchar(10) DEFAULT NULL,
  `sello_etp1` varchar(10) DEFAULT NULL,
  `plenum_etp1` varchar(30) DEFAULT NULL,
  `postes_etp1` varchar(20) DEFAULT NULL,
  `rejilla_etp1` varchar(30) DEFAULT NULL,
  `contramarco_etp1` varchar(30) DEFAULT NULL,
  `construccion_etp1` varchar(10) DEFAULT NULL,
  `perfil_gel_etp1` varchar(20) DEFAULT NULL,
  `ubicacion_gel_etp1` varchar(20) DEFAULT NULL,
  `temperatura_etp1` varchar(40) DEFAULT NULL,
  `alma_acero_etp1` varchar(10) DEFAULT NULL,
  `invertido_etp1` varchar(10) DEFAULT NULL,
  `alto_real_etp1` varchar(10) DEFAULT NULL,
  `frente_real_etp1` varchar(10) DEFAULT NULL,
  `fondo_real_etp1` varchar(10) DEFAULT NULL,
  `um_real_etp1` varchar(5) DEFAULT NULL,
  `um_venta_etp1` varchar(20) DEFAULT NULL,
  `marca_etp1` varchar(15) DEFAULT NULL,
  `capacidad_etp1` varchar(10) DEFAULT NULL,
  `cpi_etp1` varchar(10) DEFAULT NULL,
  `capacidad_instalada_etp1` varchar(10) DEFAULT NULL,
  `foto_1_etp1` text DEFAULT NULL,
  `foto_2_etp1` text DEFAULT NULL,
  `foto_3_etp1` text DEFAULT NULL,
  `foto_4_etp1` text DEFAULT NULL,
  `comentarios_etp1` text DEFAULT NULL,
  `observaciones_etp1` text DEFAULT NULL,
  `etapa_etp2` varchar(5) DEFAULT NULL,
  `codigo_etp2` varchar(25) DEFAULT NULL,
  `descripcion_corta_etp2` varchar(90) DEFAULT NULL,
  `familia_etp2` varchar(30) DEFAULT NULL,
  `modelo_etp2` varchar(30) DEFAULT NULL,
  `tipo_etp2` varchar(20) DEFAULT NULL,
  `eficiencia_etp2` varchar(50) DEFAULT NULL,
  `gasto_etp2` varchar(20) DEFAULT NULL,
  `alto_nom_etp2` varchar(10) DEFAULT NULL,
  `frente_nom_etp2` varchar(10) DEFAULT NULL,
  `fondo_nom_etp2` varchar(10) DEFAULT NULL,
  `um_nominal_etp2` varchar(5) DEFAULT NULL,
  `marco_etp2` varchar(30) DEFAULT NULL,
  `espesor_etp2` varchar(10) DEFAULT NULL,
  `um_espesor_etp2` varchar(5) DEFAULT NULL,
  `num_separadores_etp2` varchar(5) DEFAULT NULL,
  `media_fil_etp2` varchar(50) DEFAULT NULL,
  `forma_media_fil_etp2` varchar(40) DEFAULT NULL,
  `color_media_fil_etp2` varchar(20) DEFAULT NULL,
  `bolsas_etp2` varchar(5) DEFAULT NULL,
  `media_ad_etp2` varchar(10) DEFAULT NULL,
  `separador_etp2` varchar(30) DEFAULT NULL,
  `asa_etp2` varchar(10) DEFAULT NULL,
  `sello_etp2` varchar(10) DEFAULT NULL,
  `plenum_etp2` varchar(30) DEFAULT NULL,
  `postes_etp2` varchar(20) DEFAULT NULL,
  `rejilla_etp2` varchar(30) DEFAULT NULL,
  `contramarco_etp2` varchar(30) DEFAULT NULL,
  `construccion_etp2` varchar(10) DEFAULT NULL,
  `perfil_gel_etp2` varchar(20) DEFAULT NULL,
  `ubicacion_gel_etp2` varchar(20) DEFAULT NULL,
  `temperatura_etp2` varchar(40) DEFAULT NULL,
  `alma_acero_etp2` varchar(10) DEFAULT NULL,
  `invertido_etp2` varchar(10) DEFAULT NULL,
  `alto_real_etp2` varchar(10) DEFAULT NULL,
  `frente_real_etp2` varchar(10) DEFAULT NULL,
  `fondo_real_etp2` varchar(10) DEFAULT NULL,
  `um_real_etp2` varchar(5) DEFAULT NULL,
  `um_venta_etp2` varchar(20) DEFAULT NULL,
  `marca_etp2` varchar(15) DEFAULT NULL,
  `capacidad_etp2` varchar(10) DEFAULT NULL,
  `cpi_etp2` varchar(10) DEFAULT NULL,
  `capacidad_instalada_etp2` varchar(10) DEFAULT NULL,
  `foto_1_etp2` text DEFAULT NULL,
  `foto_2_etp2` text DEFAULT NULL,
  `foto_3_etp2` text DEFAULT NULL,
  `foto_4_etp2` text DEFAULT NULL,
  `comentarios_etp2` text DEFAULT NULL,
  `observaciones_etp2` text DEFAULT NULL,
  `etapa_etp3` varchar(5) DEFAULT NULL,
  `codigo_etp3` varchar(25) DEFAULT NULL,
  `descripcion_corta_etp3` varchar(90) DEFAULT NULL,
  `familia_etp3` varchar(30) DEFAULT NULL,
  `modelo_etp3` varchar(30) DEFAULT NULL,
  `tipo_etp3` varchar(20) DEFAULT NULL,
  `eficiencia_etp3` varchar(50) DEFAULT NULL,
  `gasto_etp3` varchar(20) DEFAULT NULL,
  `alto_nom_etp3` varchar(10) DEFAULT NULL,
  `frente_nom_etp3` varchar(10) DEFAULT NULL,
  `fondo_nom_etp3` varchar(10) DEFAULT NULL,
  `um_nominal_etp3` varchar(5) DEFAULT NULL,
  `marco_etp3` varchar(30) DEFAULT NULL,
  `espesor_etp3` varchar(10) DEFAULT NULL,
  `um_espesor_etp3` varchar(5) DEFAULT NULL,
  `num_separadores_etp3` varchar(5) DEFAULT NULL,
  `media_fil_etp3` varchar(50) DEFAULT NULL,
  `forma_media_fil_etp3` varchar(40) DEFAULT NULL,
  `color_media_fil_etp3` varchar(20) DEFAULT NULL,
  `bolsas_etp3` varchar(5) DEFAULT NULL,
  `media_ad_etp3` varchar(10) DEFAULT NULL,
  `separador_etp3` varchar(30) DEFAULT NULL,
  `asa_etp3` varchar(10) DEFAULT NULL,
  `sello_etp3` varchar(10) DEFAULT NULL,
  `plenum_etp3` varchar(30) DEFAULT NULL,
  `postes_etp3` varchar(20) DEFAULT NULL,
  `rejilla_etp3` varchar(30) DEFAULT NULL,
  `contramarco_etp3` varchar(30) DEFAULT NULL,
  `construccion_etp3` varchar(10) DEFAULT NULL,
  `perfil_gel_etp3` varchar(20) DEFAULT NULL,
  `ubicacion_gel_etp3` varchar(20) DEFAULT NULL,
  `temperatura_etp3` varchar(40) DEFAULT NULL,
  `alma_acero_etp3` varchar(10) DEFAULT NULL,
  `invertido_etp3` varchar(10) DEFAULT NULL,
  `alto_real_etp3` varchar(10) DEFAULT NULL,
  `frente_real_etp3` varchar(10) DEFAULT NULL,
  `fondo_real_etp3` varchar(10) DEFAULT NULL,
  `um_real_etp3` varchar(5) DEFAULT NULL,
  `um_venta_etp3` varchar(20) DEFAULT NULL,
  `marca_etp3` varchar(15) DEFAULT NULL,
  `capacidad_etp3` varchar(10) DEFAULT NULL,
  `cpi_etp3` varchar(10) DEFAULT NULL,
  `capacidad_instalada_etp3` varchar(10) DEFAULT NULL,
  `foto_1_etp3` text DEFAULT NULL,
  `foto_2_etp3` text DEFAULT NULL,
  `foto_3_etp3` text DEFAULT NULL,
  `foto_4_etp3` text DEFAULT NULL,
  `comentarios_etp3` text DEFAULT NULL,
  `observaciones_etp3` text DEFAULT NULL,
  `fecha_hora_inicio` varchar(255) NOT NULL,
  `mod_auth` varchar(2) DEFAULT NULL,
  `fecha_hora_modificacion` varchar(255) DEFAULT NULL,
  `fecha_hora_fin` varchar(255) DEFAULT NULL,
  `vendedor` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario_lev`
--

DROP TABLE IF EXISTS `usuario_lev`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_lev` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `area` varchar(255) NOT NULL,
  `tipo_usuario` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-04 12:08:03
