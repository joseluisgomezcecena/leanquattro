-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 13, 2024 at 10:03 PM
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
(6, 'Etiquetado', 'Falla en impresion de etiquetas', '2024-09-05 23:56:05', '2024-09-05 23:56:05'),
(7, 'Setup', 'Falla en setup de maquinaria', '2024-09-05 23:57:02', '2024-09-05 23:57:02');

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
(10, 6, 'Bar Teneder', ''),
(11, 6, 'Impresora Generica', ''),
(12, 6, 'Impresora Circular', ''),
(13, 6, 'Error en PC', ''),
(14, 7, 'Dimensiones incorrectas', ''),
(15, 7, 'Cortes incorrectos ', ''),
(16, 7, 'Configuracion', '');

-- --------------------------------------------------------

--
-- Table structure for table `andon_events`
--

CREATE TABLE `andon_events` (
  `id_andon` int NOT NULL COMMENT 'Primary Key',
  `plant_id` int NOT NULL,
  `line_id` int DEFAULT NULL,
  `work_station_id` int NOT NULL,
  `alert_id` int NOT NULL,
  `subalert_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `service_at` datetime DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL,
  `service_user` int DEFAULT NULL,
  `closed_user` int DEFAULT NULL,
  `report_user` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `day_shift`
--

CREATE TABLE `day_shift` (
  `shift_id` int NOT NULL,
  `shift_name` varchar(255) NOT NULL,
  `start_hour` time NOT NULL,
  `end_hour` time NOT NULL,
  `same_day` int NOT NULL DEFAULT '1'
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
(4, '56147', 'noimage.jpg', 'Fender Black Knob', '0000-00-00 00:00:00', '2024-09-05 23:39:51', '2024-09-05 23:39:51'),
(5, '01011-00-20', 'noimage.jpg', 'TITANAL 020 DIA 35%/45% COLDWORKED', '0000-00-00 00:00:00', '2024-09-05 23:40:52', '2024-09-05 23:41:13');

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
(4, 'Avanti Manufacturing', '2024-09-05 23:32:50', '2024-09-05 23:32:50');

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
(4, 'CNC', 4, '2024-09-05 23:33:27', '2024-09-05 23:33:27'),
(5, 'Pulido', 4, '2024-09-05 23:33:41', '2024-09-05 23:33:41'),
(6, 'Inspeccion', 4, '2024-09-05 23:34:01', '2024-09-05 23:34:01'),
(7, 'Etiquetado', 4, '2024-09-05 23:34:12', '2024-09-05 23:34:12'),
(8, 'Almacen', 4, '2024-09-05 23:34:21', '2024-09-05 23:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `screen_id` int NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `screen_description` varchar(255) NOT NULL,
  `screen_type` int NOT NULL DEFAULT '1',
  `display_production` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`screen_id`, `screen_name`, `screen_description`, `screen_type`, `display_production`, `created_at`, `updated_at`) VALUES
(4, 'Pantalla #1', 'Pantalla con cnc1, cnc2, pol1, lab1', 1, 0, '2024-09-12 20:11:40', '2024-09-12 20:11:40'),
(5, 'Pantalla #2', 'Pantalla con cnc1, cnc2', 1, 0, '2024-09-12 21:23:55', '2024-09-12 21:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `screen_work_station`
--

CREATE TABLE `screen_work_station` (
  `screen_ws_id` int NOT NULL,
  `screen_wss_id` int NOT NULL,
  `screens_sc_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `screen_work_station`
--

INSERT INTO `screen_work_station` (`screen_ws_id`, `screen_wss_id`, `screens_sc_id`) VALUES
(14, 12, 5),
(15, 11, 5),
(16, 11, 4),
(17, 12, 4),
(18, 13, 4),
(19, 14, 4);

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
(23, 'Equipo de etiquetas', 'Primer respuesta Andon', 1, 1, 1, 1, '2024-09-06 00:03:49', '2024-09-06 00:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `team_alert`
--

CREATE TABLE `team_alert` (
  `team_alert_id` int NOT NULL,
  `ta_alert_id` int NOT NULL,
  `ta_team_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `team_alert`
--

INSERT INTO `team_alert` (`team_alert_id`, `ta_alert_id`, `ta_team_id`) VALUES
(24, 6, 23);

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
(29, 7, 23);

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
(84, 2, 1, 23),
(85, 10, 0, 23);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `company_id` int DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_admin` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `signature` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `company_id`, `first_name`, `last_name`, `username`, `email`, `phone`, `password`, `is_admin`, `created_at`, `updated_at`, `signature`) VALUES
(2, NULL, NULL, NULL, 'administrator', 'admin@admin.com', '', '$2y$10$07kqsEdai95dj.OZE5deouhrvLNwCnphVpREWoJf.llndHzeHNLaa', 1, '2024-04-05 11:39:23', '2024-04-05 13:13:54', NULL),
(10, NULL, 'Jose Luis', 'Gomez Cecena', 'jgomez', 'jose.gomez@avantimanufacturing.com', '6862594319', '$2y$10$nIaYOKKbakqfXSj9LokA7uOZU/wknuxl4UyA0WnD2yBEqQkVdnw7q', 1, '2024-09-05 23:25:23', '2024-09-05 23:26:23', NULL);

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
(11, 4, 'CNC 1', 'CNC01', 'Maquinado CNC para pinzas', 'noimage.jpg', '2024-09-05 23:35:07', '2024-09-05 23:35:07'),
(12, 4, 'CNC 2', 'CNC02', 'Maquinado CNC para pinzas', 'noimage.jpg', '2024-09-05 23:35:28', '2024-09-05 23:35:28'),
(13, 5, 'POL 1', 'POL01', 'Estacion de pulido', 'noimage.jpg', '2024-09-05 23:36:00', '2024-09-05 23:36:00'),
(14, 7, 'LAB 1', 'LAB 01', 'Estacion de etiquedato', 'noimage.jpg', '2024-09-05 23:36:41', '2024-09-05 23:36:41'),
(15, 7, 'LAB 2', 'LAB 02', 'Estacion de etiquetado para etiquetas circulares', 'noimage.jpg', '2024-09-05 23:37:07', '2024-09-05 23:37:30');

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
-- Indexes for table `day_shift`
--
ALTER TABLE `day_shift`
  ADD PRIMARY KEY (`shift_id`);

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
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`screen_id`);

--
-- Indexes for table `screen_work_station`
--
ALTER TABLE `screen_work_station`
  ADD PRIMARY KEY (`screen_ws_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

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
  MODIFY `alert_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `alert_child`
--
ALTER TABLE `alert_child`
  MODIFY `child_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `andon_events`
--
ALTER TABLE `andon_events`
  MODIFY `id_andon` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `day_shift`
--
ALTER TABLE `day_shift`
  MODIFY `shift_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hour_by_hour`
--
ALTER TABLE `hour_by_hour`
  MODIFY `h_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `part_numbers`
--
ALTER TABLE `part_numbers`
  MODIFY `pn_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `plant_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `production_lines`
--
ALTER TABLE `production_lines`
  MODIFY `line_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `screen_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `screen_work_station`
--
ALTER TABLE `screen_work_station`
  MODIFY `screen_ws_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `team_alert`
--
ALTER TABLE `team_alert`
  MODIFY `team_alert_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `team_location`
--
ALTER TABLE `team_location`
  MODIFY `tl_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `team_user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `work_order`
--
ALTER TABLE `work_order`
  MODIFY `wo_id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `work_stations`
--
ALTER TABLE `work_stations`
  MODIFY `work_station_id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
