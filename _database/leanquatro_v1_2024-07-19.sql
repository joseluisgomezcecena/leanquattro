-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2024 at 12:45 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leanquattro_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `alert_id` int NOT NULL,
  `alert_name` varchar(255) NOT NULL,
  `alert_description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`alert_id`, `alert_name`, `alert_description`, `created_at`, `updated_at`) VALUES
(3, 'Setup', 'Setup de maquinaria', '2024-07-19 22:28:12', '2024-07-19 22:28:12'),
(4, 'Materiales', 'Llamado a almacen', '2024-07-19 22:28:12', '2024-07-19 22:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `alert_child`
--

CREATE TABLE `alert_child` (
  `child_id` int NOT NULL,
  `c_alert_id` int NOT NULL,
  `child_alert_name` varchar(255) NOT NULL,
  `child_alert_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alert_child`
--

INSERT INTO `alert_child` (`child_id`, `c_alert_id`, `child_alert_name`, `child_alert_description`) VALUES
(1, 3, 'angulo incorrecto', ''),
(2, 3, 'dimension incorrecta', ''),
(3, 4, 'Falta de Material', ''),
(4, 4, 'Reemplazo de material', '');

-- --------------------------------------------------------

--
-- Table structure for table `andon_events`
--

CREATE TABLE `andon_events` (
  `id_andon` int NOT NULL COMMENT 'Primary Key',
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
  `report_user` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hour_by_hour`
--

CREATE TABLE `hour_by_hour` (
  `h_id` int NOT NULL,
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
  `00p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `01p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `02p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `03p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `04p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `05p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `06p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `07p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `08p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `09p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hour_by_hour`
--

INSERT INTO `hour_by_hour` (`h_id`, `h_wo_id`, `00h`, `01h`, `02h`, `03h`, `04h`, `05h`, `06h`, `07h`, `08h`, `09h`, `10h`, `11h`, `12h`, `13h`, `14h`, `15h`, `16h`, `17h`, `18h`, `19h`, `20h`, `21h`, `22h`, `23h`, `00p`, `01p`, `02p`, `03p`, `04p`, `05p`, `06p`, `07p`, `08p`, `09p`, `10p`, `11p`, `12p`, `13p`, `14p`, `15p`, `16p`, `17p`, `18p`, `19p`, `20p`, `21p`, `22p`, `23p`, `00r`, `01r`, `02r`, `03r`, `04r`, `05r`, `06r`, `07r`, `08r`, `09r`, `10r`, `11r`, `12r`, `13r`, `14r`, `15r`, `16r`, `17r`, `18r`, `19r`, `20r`, `21r`, `22r`, `23r`, `created_at`, `updated_at`) VALUES
(1, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 200, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 'AC900-b', 'AC900-a', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-05-28 19:34:01', '2024-05-28 19:34:01'),
(2, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 200, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 'AC900-b', 'AC900-a', 'AC900-b', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 205, 310, 11000, 0, 0, 0, 0, 0, 0, 0, 0, '2024-05-28 22:58:32', '2024-05-31 21:21:33'),
(3, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 200, 350, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 'AC900-b', 'AC900-a', 'AC900-b', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-05-28 23:03:06', '2024-05-28 23:03:06'),
(4, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 200, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 'AC900-b', 'AC900-a', 'AC900-a', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-05-31 17:52:07', '2024-05-31 17:52:07'),
(5, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 200, 5000, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 'AC900-b', 'AC900-a', 'AC900-a', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1000, 500, 200, 0, 0, 0, 0, 0, 0, 0, '2024-05-31 17:52:36', '2024-06-02 22:37:23'),
(6, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 200, 5000, 300, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 'AC900-b', 'AC900-a', 'AC900-a', 'AC900-b', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-06-02 22:27:44', '2024-06-02 22:27:44'),
(7, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 200, 5000, 500, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 'AC900-b', 'AC900-a', 'AC900-a', 'AC900-b', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-06-02 22:34:34', '2024-06-02 22:34:34'),
(8, 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 200, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', 'AC900-b', 'AC900-a', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-06-17 18:38:23', '2024-06-17 20:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `part_numbers`
--

CREATE TABLE `part_numbers` (
  `pn_id` int NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `part_image` text NOT NULL,
  `part_description` text NOT NULL,
  `last_produced` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `part_numbers`
--

INSERT INTO `part_numbers` (`pn_id`, `part_number`, `part_image`, `part_description`, `last_produced`, `created_at`, `updated_at`) VALUES
(1, 'AC900-b', '', 'descripcion.', '0000-00-00 00:00:00', '2024-05-20 21:02:59', '2024-05-20 21:02:59'),
(2, 'AC900-a', 'product_1716320704.jpg', 'Descripcion de la parte AC900-a con Lorem ipsum', '0000-00-00 00:00:00', '2024-05-21 19:45:05', '2024-05-21 19:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `plant_id` int NOT NULL,
  `plant_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`plant_id`, `plant_name`, `created_at`, `updated_at`) VALUES
(1, 'Avanti Manufacturing Mexicali', '2024-05-23 22:26:39', '2024-05-23 22:26:39'),
(3, 'Lancer Orthodontics S.A. De C.V.', '2024-06-12 21:33:45', '2024-06-12 21:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `production_lines`
--

CREATE TABLE `production_lines` (
  `line_id` int NOT NULL,
  `line_name` varchar(255) NOT NULL,
  `plant_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `production_lines`
--

INSERT INTO `production_lines` (`line_id`, `line_name`, `plant_id`, `created_at`, `updated_at`) VALUES
(1, 'Fender', 1, '2024-05-24 02:39:13', '2024-05-24 02:39:13'),
(2, 'Pliers', 1, '2024-05-24 04:24:39', '2024-05-24 04:24:39');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_description` text NOT NULL,
  `escalation_1` int NOT NULL DEFAULT '0',
  `escalation_2` int NOT NULL DEFAULT '0',
  `escalation_3` int NOT NULL DEFAULT '0',
  `escalation_4` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `team_description`, `escalation_1`, `escalation_2`, `escalation_3`, `escalation_4`, `created_at`, `updated_at`) VALUES
(9, 'Andon General', 'Equipo andon general', 1, 1, 1, 0, '2024-07-12 21:12:51', '2024-07-12 21:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `team_alert`
--

CREATE TABLE `team_alert` (
  `team_alert_id` int NOT NULL,
  `ta_alert_id` int NOT NULL,
  `ta_team_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_location`
--

CREATE TABLE `team_location` (
  `tl_id` int NOT NULL,
  `tl_line_id` int NOT NULL,
  `tl_team_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `team_location`
--

INSERT INTO `team_location` (`tl_id`, `tl_line_id`, `tl_team_id`) VALUES
(1, 1, 9),
(2, 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `team_user_id` int NOT NULL,
  `tu_user_id` int NOT NULL,
  `team_leader` int NOT NULL DEFAULT '0',
  `tu_team_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `team_user`
--

INSERT INTO `team_user` (`team_user_id`, `tu_user_id`, `team_leader`, `tu_team_id`) VALUES
(10, 1, 1, 9),
(11, 1, 0, 9),
(12, 2, 0, 9),
(13, 3, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `is_admin`, `created_at`, `updated_at`, `signature`) VALUES
(1, 'joseluis', 'jose.gomez@avantimanufacturing.com', '$2y$10$dXl1UWCbvdHYpbLo8TXbo.yHz5clXixmxfjNe/e1DpVqmrmbdraW.', 0, '2024-04-05 11:39:23', '2024-04-05 11:39:23', NULL),
(2, 'administrator', 'admin@admin.com', '$2y$10$07kqsEdai95dj.OZE5deouhrvLNwCnphVpREWoJf.llndHzeHNLaa', 1, '2024-04-05 11:39:23', '2024-04-05 13:13:54', NULL),
(3, 'german', 'german.torres@avantimanufacturing.com', '$2y$10$e7bIctHNHhfH5UHEBkQnHOJb71QRfEH1zl/rvPnjQKfInHFkmRdGm', 0, '2024-04-05 13:32:04', '2024-04-05 13:32:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `work_order`
--

CREATE TABLE `work_order` (
  `wo_id` int NOT NULL COMMENT 'Primary Key',
  `part_number` varchar(255) DEFAULT NULL,
  `wo_workstation` int NOT NULL,
  `wo_quantity` float DEFAULT NULL,
  `wo_todo` float NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` int DEFAULT '1' COMMENT '1 registered, 2 in process, 3 finished, 4 hold, 5 cancelled',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notes` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_order`
--

INSERT INTO `work_order` (`wo_id`, `part_number`, `wo_workstation`, `wo_quantity`, `wo_todo`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`, `notes`) VALUES
(1, NULL, 4, NULL, 0, '2024-05-28 00:00:00', '0000-00-00 00:00:00', 1, '2024-05-28 17:45:01', '2024-05-28 17:45:01', 'descrp'),
(2, NULL, 4, NULL, 0, '2024-05-28 00:00:00', '0000-00-00 00:00:00', 1, '2024-05-28 18:18:15', '2024-05-28 18:18:15', 'descripcion nueva.'),
(3, NULL, 4, NULL, 0, '2024-05-28 00:00:00', '0000-00-00 00:00:00', 1, '2024-05-28 18:22:45', '2024-05-28 18:22:45', 'descripcion'),
(4, NULL, 4, NULL, 0, '2024-05-28 00:00:00', '0000-00-00 00:00:00', 1, '2024-05-28 19:34:01', '2024-05-28 19:34:01', 'descripcion'),
(5, NULL, 4, NULL, 0, '2024-05-31 00:00:00', '0000-00-00 00:00:00', 1, '2024-05-28 22:58:32', '2024-05-30 05:26:41', 'descripcion'),
(6, NULL, 4, NULL, 0, '2024-05-31 00:00:00', '0000-00-00 00:00:00', 1, '2024-05-28 23:03:05', '2024-05-30 22:03:59', 'descripcion'),
(7, NULL, 4, NULL, 0, '2024-05-31 00:00:00', '0000-00-00 00:00:00', 1, '2024-06-02 17:52:07', '2024-06-02 22:28:07', 'descripcion'),
(8, NULL, 4, NULL, 0, '2024-06-03 00:00:00', '0000-00-00 00:00:00', 1, '2024-06-03 17:52:35', '2024-06-02 22:28:18', 'descripcion'),
(9, NULL, 4, NULL, 0, '2024-05-31 00:00:00', '0000-00-00 00:00:00', 1, '2024-06-02 22:27:43', '2024-06-02 22:27:43', 'descripcion'),
(10, NULL, 4, NULL, 0, '2024-05-31 00:00:00', '0000-00-00 00:00:00', 1, '2024-06-02 22:34:34', '2024-06-02 22:34:34', 'descripcion'),
(11, NULL, 4, NULL, 0, '2024-06-17 00:00:00', '0000-00-00 00:00:00', 1, '2024-06-17 18:38:22', '2024-06-17 18:38:22', '');

-- --------------------------------------------------------

--
-- Table structure for table `work_stations`
--

CREATE TABLE `work_stations` (
  `work_station_id` int NOT NULL COMMENT 'Primary Key',
  `ws_line_id` int NOT NULL,
  `work_station_name` varchar(255) DEFAULT NULL,
  `work_station_number` varchar(255) DEFAULT NULL,
  `work_station_description` text,
  `work_station_image` varchar(255) DEFAULT 'noimage.jpg',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_stations`
--

INSERT INTO `work_stations` (`work_station_id`, `ws_line_id`, `work_station_name`, `work_station_number`, `work_station_description`, `work_station_image`, `created_at`, `updated_at`) VALUES
(4, 1, 'Fender Knob Controls', 'FA-001', 'Fender Guitars knob control painting station.', 'workstation_1716482086_4421.jpg', '2024-05-23 16:34:46', '2024-05-24 03:09:13'),
(5, 1, 'Fender Knob Controls QA Inspection', 'FQ-001', 'Fender guitars knob controls painting station quality inspection.', 'workstation_1716482401_2556.jpg', '2024-05-23 16:40:01', '2024-05-24 03:09:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`alert_id`);

--
-- Indexes for table `alert_child`
--
ALTER TABLE `alert_child`
  ADD PRIMARY KEY (`child_id`);

--
-- Indexes for table `andon_events`
--
ALTER TABLE `andon_events`
  ADD PRIMARY KEY (`id_andon`);

--
-- Indexes for table `hour_by_hour`
--
ALTER TABLE `hour_by_hour`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `part_numbers`
--
ALTER TABLE `part_numbers`
  ADD PRIMARY KEY (`pn_id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`plant_id`);

--
-- Indexes for table `production_lines`
--
ALTER TABLE `production_lines`
  ADD PRIMARY KEY (`line_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `team_alert`
--
ALTER TABLE `team_alert`
  ADD PRIMARY KEY (`team_alert_id`);

--
-- Indexes for table `team_location`
--
ALTER TABLE `team_location`
  ADD PRIMARY KEY (`tl_id`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`team_user_id`);

--
-- Indexes for table `work_order`
--
ALTER TABLE `work_order`
  ADD PRIMARY KEY (`wo_id`);

--
-- Indexes for table `work_stations`
--
ALTER TABLE `work_stations`
  ADD PRIMARY KEY (`work_station_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `alert_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `alert_child`
--
ALTER TABLE `alert_child`
  MODIFY `child_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `andon_events`
--
ALTER TABLE `andon_events`
  MODIFY `id_andon` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `hour_by_hour`
--
ALTER TABLE `hour_by_hour`
  MODIFY `h_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `part_numbers`
--
ALTER TABLE `part_numbers`
  MODIFY `pn_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `plant_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `production_lines`
--
ALTER TABLE `production_lines`
  MODIFY `line_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `team_alert`
--
ALTER TABLE `team_alert`
  MODIFY `team_alert_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_location`
--
ALTER TABLE `team_location`
  MODIFY `tl_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `team_user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `work_order`
--
ALTER TABLE `work_order`
  MODIFY `wo_id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `work_stations`
--
ALTER TABLE `work_stations`
  MODIFY `work_station_id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
