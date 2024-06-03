-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: leanquattro_v1
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `andon_events`
--

DROP TABLE IF EXISTS `andon_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `andon_events` (
  `id_andon` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `plant_id` int NOT NULL,
  `area_id` int DEFAULT NULL,
  `location_id` int DEFAULT NULL,
  `has_asset` int DEFAULT '0',
  `asset_id` int DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `service_at` datetime DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL,
  `service_user` int DEFAULT NULL,
  `closed_user` int DEFAULT NULL,
  `report_user` int DEFAULT NULL,
  PRIMARY KEY (`id_andon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `andon_events`
--

/*!40000 ALTER TABLE `andon_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `andon_events` ENABLE KEYS */;

--
-- Table structure for table `hour_by_hour`
--

DROP TABLE IF EXISTS `hour_by_hour`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hour_by_hour` (
  `h_id` int NOT NULL AUTO_INCREMENT,
  `h_wo_id` int NOT NULL,
  `00h` int NOT NULL,
  `01h` int NOT NULL,
  `02h` int NOT NULL,
  `03h` int NOT NULL,
  `04h` int NOT NULL,
  `05h` int NOT NULL,
  `06h` int NOT NULL,
  `07h` int NOT NULL,
  `08h` int NOT NULL,
  `09h` int NOT NULL,
  `10h` int NOT NULL,
  `11h` int NOT NULL,
  `12h` int NOT NULL,
  `13h` int NOT NULL,
  `14h` int NOT NULL,
  `15h` int NOT NULL,
  `16h` int NOT NULL,
  `17h` int NOT NULL,
  `18h` int NOT NULL,
  `19h` int NOT NULL,
  `20h` int NOT NULL,
  `21h` int NOT NULL,
  `22h` int NOT NULL,
  `23h` int NOT NULL,
  `00p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `01p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `02p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `03p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `04p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `05p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `06p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `07p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `08p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `09p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `10p` varchar(255) NOT NULL,
  `11p` varchar(255) NOT NULL,
  `12p` varchar(255) NOT NULL,
  `13p` varchar(255) NOT NULL,
  `14p` varchar(255) NOT NULL,
  `15p` varchar(255) NOT NULL,
  `16p` varchar(255) NOT NULL,
  `17p` varchar(255) NOT NULL,
  `18p` varchar(255) NOT NULL,
  `19p` varchar(255) NOT NULL,
  `20p` varchar(255) NOT NULL,
  `21p` varchar(255) NOT NULL,
  `22p` varchar(255) NOT NULL,
  `23p` varchar(255) NOT NULL,
  `00r` int NOT NULL,
  `01r` int NOT NULL,
  `02r` int NOT NULL,
  `03r` int NOT NULL,
  `04r` int NOT NULL,
  `05r` int NOT NULL,
  `06r` int NOT NULL,
  `07r` int NOT NULL,
  `08r` int NOT NULL,
  `09r` int NOT NULL,
  `10r` int NOT NULL,
  `11r` int NOT NULL,
  `12r` int NOT NULL,
  `13r` int NOT NULL,
  `14r` int NOT NULL,
  `15r` int NOT NULL,
  `16r` int NOT NULL,
  `17r` int NOT NULL,
  `18r` int NOT NULL,
  `19r` int NOT NULL,
  `20r` int NOT NULL,
  `21r` int NOT NULL,
  `22r` int NOT NULL,
  `23r` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`h_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hour_by_hour`
--

/*!40000 ALTER TABLE `hour_by_hour` DISABLE KEYS */;
INSERT INTO `hour_by_hour` VALUES (1,4,0,0,0,0,0,0,0,0,0,0,0,0,100,200,0,0,0,0,0,0,0,0,0,0,'','','','','','','','','','','','','AC900-b','AC900-a','','','','','','','','','','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2024-05-28 19:34:01','2024-05-28 19:34:01'),(2,5,0,0,0,0,0,0,0,0,0,0,0,0,100,200,300,0,0,0,0,0,0,0,0,0,'','','','','','','','','','','','','AC900-b','AC900-a','AC900-b','','','','','','','','','',0,0,0,0,0,0,0,0,0,0,0,0,100,205,310,11000,0,0,0,0,0,0,0,0,'2024-05-28 22:58:32','2024-05-31 21:21:33'),(3,6,0,0,0,0,0,0,0,0,0,0,0,0,100,200,350,0,0,0,0,0,0,0,0,0,'','','','','','','','','','','','','AC900-b','AC900-a','AC900-b','','','','','','','','','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2024-05-28 23:03:06','2024-05-28 23:03:06'),(4,7,0,0,0,0,0,0,0,0,0,0,0,0,100,200,1000,0,0,0,0,0,0,0,0,0,'','','','','','','','','','','','','AC900-b','AC900-a','AC900-a','','','','','','','','','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2024-05-31 17:52:07','2024-05-31 17:52:07'),(5,8,0,0,0,0,0,0,0,0,0,0,0,0,100,200,5000,0,0,0,0,0,0,0,0,0,'','','','','','','','','','','','','AC900-b','AC900-a','AC900-a','','','','','','','','','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,1000,500,200,0,0,0,0,0,0,0,'2024-05-31 17:52:36','2024-06-02 22:37:23'),(6,9,0,0,0,0,0,0,0,0,0,0,0,0,100,200,5000,300,0,0,0,0,0,0,0,0,'','','','','','','','','','','','','AC900-b','AC900-a','AC900-a','AC900-b','','','','','','','','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2024-06-02 22:27:44','2024-06-02 22:27:44'),(7,10,0,0,0,0,0,0,0,0,0,0,0,0,100,200,5000,500,0,0,0,0,0,0,0,0,'','','','','','','','','','','','','AC900-b','AC900-a','AC900-a','AC900-b','','','','','','','','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2024-06-02 22:34:34','2024-06-02 22:34:34');
/*!40000 ALTER TABLE `hour_by_hour` ENABLE KEYS */;

--
-- Table structure for table `part_numbers`
--

DROP TABLE IF EXISTS `part_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `part_numbers` (
  `pn_id` int NOT NULL AUTO_INCREMENT,
  `part_number` varchar(255) NOT NULL,
  `part_image` text NOT NULL,
  `part_description` text NOT NULL,
  `last_produced` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `part_numbers`
--

/*!40000 ALTER TABLE `part_numbers` DISABLE KEYS */;
INSERT INTO `part_numbers` VALUES (1,'AC900-b','','descripcion.','0000-00-00 00:00:00','2024-05-20 21:02:59','2024-05-20 21:02:59'),(2,'AC900-a','product_1716320704.jpg','Descripcion de la parte AC900-a con Lorem ipsum','0000-00-00 00:00:00','2024-05-21 19:45:05','2024-05-21 19:45:05');
/*!40000 ALTER TABLE `part_numbers` ENABLE KEYS */;

--
-- Table structure for table `plants`
--

DROP TABLE IF EXISTS `plants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plants` (
  `plant_id` int NOT NULL AUTO_INCREMENT,
  `plant_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`plant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plants`
--

/*!40000 ALTER TABLE `plants` DISABLE KEYS */;
INSERT INTO `plants` VALUES (1,'Avanti Manufacturing Mexicali','2024-05-23 22:26:39','2024-05-23 22:26:39');
/*!40000 ALTER TABLE `plants` ENABLE KEYS */;

--
-- Table structure for table `production_lines`
--

DROP TABLE IF EXISTS `production_lines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `production_lines` (
  `line_id` int NOT NULL AUTO_INCREMENT,
  `line_name` varchar(255) NOT NULL,
  `plant_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`line_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `production_lines`
--

/*!40000 ALTER TABLE `production_lines` DISABLE KEYS */;
INSERT INTO `production_lines` VALUES (1,'Fender',1,'2024-05-24 02:39:13','2024-05-24 02:39:13'),(2,'Pliers',1,'2024-05-24 04:24:39','2024-05-24 04:24:39');
/*!40000 ALTER TABLE `production_lines` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_admin` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `signature` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'joseluis','jose.gomez@avantimanufacturing.com','$2y$10$dXl1UWCbvdHYpbLo8TXbo.yHz5clXixmxfjNe/e1DpVqmrmbdraW.',0,'2024-04-05 11:39:23','2024-04-05 11:39:23',NULL),(2,'administrator','admin@admin.com','$2y$10$07kqsEdai95dj.OZE5deouhrvLNwCnphVpREWoJf.llndHzeHNLaa',1,'2024-04-05 11:39:23','2024-04-05 13:13:54',NULL),(3,'german','german.torres@avantimanufacturing.com','$2y$10$e7bIctHNHhfH5UHEBkQnHOJb71QRfEH1zl/rvPnjQKfInHFkmRdGm',0,'2024-04-05 13:32:04','2024-04-05 13:32:04',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Table structure for table `work_order`
--

DROP TABLE IF EXISTS `work_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_order` (
  `wo_id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `part_number` varchar(255) DEFAULT NULL,
  `wo_workstation` int NOT NULL,
  `wo_quantity` float DEFAULT NULL,
  `wo_todo` float NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` int DEFAULT '1' COMMENT '1 registered, 2 in process, 3 finished, 4 hold, 5 cancelled',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notes` text,
  PRIMARY KEY (`wo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_order`
--

/*!40000 ALTER TABLE `work_order` DISABLE KEYS */;
INSERT INTO `work_order` VALUES (1,NULL,4,NULL,0,'2024-05-28 00:00:00','0000-00-00 00:00:00',1,'2024-05-28 17:45:01','2024-05-28 17:45:01','descrp'),(2,NULL,4,NULL,0,'2024-05-28 00:00:00','0000-00-00 00:00:00',1,'2024-05-28 18:18:15','2024-05-28 18:18:15','descripcion nueva.'),(3,NULL,4,NULL,0,'2024-05-28 00:00:00','0000-00-00 00:00:00',1,'2024-05-28 18:22:45','2024-05-28 18:22:45','descripcion'),(4,NULL,4,NULL,0,'2024-05-28 00:00:00','0000-00-00 00:00:00',1,'2024-05-28 19:34:01','2024-05-28 19:34:01','descripcion'),(5,NULL,4,NULL,0,'2024-05-31 00:00:00','0000-00-00 00:00:00',1,'2024-05-28 22:58:32','2024-05-30 05:26:41','descripcion'),(6,NULL,4,NULL,0,'2024-05-31 00:00:00','0000-00-00 00:00:00',1,'2024-05-28 23:03:05','2024-05-30 22:03:59','descripcion'),(7,NULL,4,NULL,0,'2024-05-31 00:00:00','0000-00-00 00:00:00',1,'2024-06-02 17:52:07','2024-06-02 22:28:07','descripcion'),(8,NULL,4,NULL,0,'2024-06-03 00:00:00','0000-00-00 00:00:00',1,'2024-06-03 17:52:35','2024-06-02 22:28:18','descripcion'),(9,NULL,4,NULL,0,'2024-05-31 00:00:00','0000-00-00 00:00:00',1,'2024-06-02 22:27:43','2024-06-02 22:27:43','descripcion'),(10,NULL,4,NULL,0,'2024-05-31 00:00:00','0000-00-00 00:00:00',1,'2024-06-02 22:34:34','2024-06-02 22:34:34','descripcion');
/*!40000 ALTER TABLE `work_order` ENABLE KEYS */;

--
-- Table structure for table `work_stations`
--

DROP TABLE IF EXISTS `work_stations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_stations` (
  `work_station_id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ws_line_id` int NOT NULL,
  `work_station_name` varchar(255) DEFAULT NULL,
  `work_station_number` varchar(255) DEFAULT NULL,
  `work_station_description` text,
  `work_station_image` varchar(255) DEFAULT 'noimage.jpg',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`work_station_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_stations`
--

/*!40000 ALTER TABLE `work_stations` DISABLE KEYS */;
INSERT INTO `work_stations` VALUES (4,1,'Fender Knob Controls','FA-001','Fender Guitars knob control painting station.','workstation_1716482086_4421.jpg','2024-05-23 16:34:46','2024-05-24 03:09:13'),(5,1,'Fender Knob Controls QA Inspection','FQ-001','Fender guitars knob controls painting station quality inspection.','workstation_1716482401_2556.jpg','2024-05-23 16:40:01','2024-05-24 03:09:18');
/*!40000 ALTER TABLE `work_stations` ENABLE KEYS */;

--
-- Dumping routines for database 'leanquattro_v1'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-03 13:45:30
