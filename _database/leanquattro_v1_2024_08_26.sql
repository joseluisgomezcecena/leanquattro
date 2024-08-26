-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 26, 2024 at 10:37 PM
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
(4, 'Materiales', 'Llamado a almacen', '2024-07-19 22:28:12', '2024-07-19 22:28:12'),
(5, 'Alerta de prueba uno editada 2', 'una alerta de prueba editada el 8/26 a las 12:51', '2024-08-20 19:06:51', '2024-08-26 19:51:06');

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
(4, 4, 'Reemplazo de material', ''),
(5, 5, 'subprueba 1', ''),
(6, 5, 'subprueba2', ''),
(7, 5, 'subprueba3', ''),
(8, 5, 'Sub prueba 4', '');

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

--
-- Dumping data for table `andon_events`
--

INSERT INTO `andon_events` (`id_andon`, `plant_id`, `line_id`, `work_station_id`, `alert_id`, `subalert_id`, `created_at`, `service_at`, `closed_at`, `service_user`, `closed_user`, `report_user`) VALUES
(1, 1, 1, 4, 3, 1, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL),
(2, 1, 1, 4, 3, 2, '2024-07-25 23:05:46', NULL, NULL, NULL, NULL, NULL),
(3, 1, 1, 4, 4, 3, '2024-07-25 23:10:38', NULL, NULL, NULL, NULL, NULL),
(4, 1, 1, 4, 4, 3, '2024-07-25 23:19:18', NULL, NULL, NULL, NULL, NULL),
(5, 1, 1, 4, 4, 3, '2024-07-25 23:24:57', NULL, NULL, NULL, NULL, NULL),
(6, 1, 1, 4, 4, 3, '2024-07-26 18:55:05', NULL, NULL, NULL, NULL, NULL),
(7, 1, 1, 4, 4, 3, '2024-07-26 19:44:50', NULL, NULL, NULL, NULL, NULL),
(8, 1, 1, 4, 4, 3, '2024-07-26 19:45:23', NULL, NULL, NULL, NULL, NULL),
(9, 1, 1, 4, 4, 3, '2024-07-26 19:46:48', NULL, NULL, NULL, NULL, NULL),
(10, 1, 1, 4, 4, 3, '2024-07-26 19:47:52', NULL, NULL, NULL, NULL, NULL),
(11, 1, 1, 4, 4, 3, '2024-07-26 22:34:45', NULL, NULL, NULL, NULL, NULL),
(12, 1, 1, 4, 3, 2, '2024-07-30 22:27:49', NULL, NULL, NULL, NULL, NULL),
(13, 1, 1, 4, 3, 1, '2024-07-30 22:40:13', NULL, NULL, NULL, NULL, NULL),
(14, 1, 1, 4, 3, 1, '2024-07-30 22:57:11', NULL, NULL, NULL, NULL, NULL),
(15, 1, 1, 4, 3, 1, '2024-07-30 23:17:03', NULL, NULL, NULL, NULL, NULL),
(16, 1, 1, 4, 3, 1, '2024-07-30 23:18:59', NULL, NULL, NULL, NULL, NULL),
(17, 1, 1, 4, 3, 1, '2024-07-30 23:20:28', NULL, NULL, NULL, NULL, NULL),
(18, 1, 1, 4, 3, 1, '2024-07-30 23:21:16', NULL, NULL, NULL, NULL, NULL);

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
(8, 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 200, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', 'AC900-b', 'AC900-a', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-06-17 18:38:23', '2024-06-17 20:55:34'),
(9, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 200, 500, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'AC900-b', 'AC900-b', 'AC900-a', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 200, 600, 1, 0, 0, 0, 0, 0, 0, 0, '2024-07-22 21:58:12', '2024-07-22 22:18:15'),
(10, 13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'AC900-b1', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-08-16 20:20:11', '2024-08-16 20:29:30');

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
(1, 'AC900-b1', '', 'descripcion.', '0000-00-00 00:00:00', '2024-05-20 21:02:59', '2024-08-05 21:51:21'),
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
(1, 'Fender Guitars', 1, '2024-05-24 02:39:13', '2024-08-03 02:50:36'),
(2, 'Pliers', 1, '2024-05-24 04:24:39', '2024-05-24 04:24:39');

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `screen_id` int NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `screen_description` varchar(255) NOT NULL,
  `screen_type` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `screen_work_station`
--

CREATE TABLE `screen_work_station` (
  `screen_ws_id` int NOT NULL,
  `screen_wss_id` int NOT NULL,
  `screens_sc_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(20, 'Andon General', 'Equipo andon general', 1, 1, 0, 0, '2024-08-17 00:36:00', '2024-08-17 00:36:00'),
(22, 'team2', 'team 1 descr', 1, 0, 0, 0, '2024-08-20 18:03:38', '2024-08-20 18:03:38');

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
(19, 3, 20),
(23, 3, 22);

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
(23, 1, 20),
(24, 2, 20),
(28, 1, 22);

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
(67, 3, 0, 20),
(68, 4, 0, 20),
(69, 8, 0, 20),
(70, 9, 0, 20),
(80, 1, 0, 22),
(81, 2, 0, 22),
(82, 3, 0, 22),
(83, 4, 1, 22);

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
(1, NULL, NULL, NULL, 'joseluis', 'jose.gomez@avantimanufacturing.com', '', '$2y$10$dXl1UWCbvdHYpbLo8TXbo.yHz5clXixmxfjNe/e1DpVqmrmbdraW.', 0, '2024-04-05 11:39:23', '2024-04-05 11:39:23', NULL),
(2, NULL, NULL, NULL, 'administrator', 'admin@admin.com', '', '$2y$10$07kqsEdai95dj.OZE5deouhrvLNwCnphVpREWoJf.llndHzeHNLaa', 1, '2024-04-05 11:39:23', '2024-04-05 13:13:54', NULL),
(3, NULL, NULL, NULL, 'german', 'german.torres@avantimanufacturing.com', '', '$2y$10$e7bIctHNHhfH5UHEBkQnHOJb71QRfEH1zl/rvPnjQKfInHFkmRdGm', 0, '2024-04-05 13:32:04', '2024-07-23 21:26:38', 'uploads/signatures/31284422710.png'),
(4, NULL, 'Alejandro', 'Gomez Cesena', 'Alex', 'agc961014@gmail.com', '6862594318', '$2y$10$55sGBMCZyr32lULA9LjNG.sxNX0/ajBS.AJCuH86qCkR5z1ccVlVa', 0, '2024-07-25 04:05:25', '2024-07-25 05:00:24', NULL),
(8, NULL, 'Javier', 'Vargas', 'javier', 'javier.vargas@avantimanufacturing.com', '6861700039', '$2y$10$vEuAbJmCwtyaH6bYVFcDpuBdknlGfEKmWa9qQvdFavsjE8gc5SSlK', 0, '2024-07-25 21:22:42', '2024-07-25 21:22:42', NULL),
(9, NULL, 'Roxana Patricia', 'Gomez Cecena', 'roxana', 'roxana@gmail.com', '6862594319', '$2y$10$E5d.ImJedaWOQqHZjr4lbeNhJov9a4vv6TOkQZLu4fKJtghrRo1iC', 0, '2024-07-30 21:27:25', '2024-07-30 21:27:25', NULL);

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
(11, NULL, 4, NULL, 0, '2024-06-17 00:00:00', '0000-00-00 00:00:00', 1, '2024-06-17 18:38:22', '2024-06-17 18:38:22', ''),
(12, NULL, 4, NULL, 0, '2024-07-22 00:00:00', '0000-00-00 00:00:00', 1, '2024-07-22 21:58:11', '2024-07-22 21:58:11', 'notas'),
(13, NULL, 4, NULL, 0, '2024-08-16 00:00:00', '0000-00-00 00:00:00', 1, '2024-08-16 20:20:11', '2024-08-16 20:20:11', 'cidociew');

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
(5, 1, 'Fender Knob Controls QA Inspection', 'FQ-001', 'Fender guitars knob controls painting station quality inspection.', 'workstation_1716482401_2556.jpg', '2024-05-23 16:40:01', '2024-05-24 03:09:18'),
(6, 1, 'pliers 01', 'p001', 'Una descripcion', 'workstation_1722653836_5398.jpg', '2024-08-03 02:57:16', '2024-08-03 03:00:08'),
(9, 2, '55rr', '55itr', 'fresde 55', 'workstation_1722887612_6235.png', '2024-08-05 19:53:32', '2024-08-05 21:04:03');

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
  MODIFY `alert_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `alert_child`
--
ALTER TABLE `alert_child`
  MODIFY `child_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `andon_events`
--
ALTER TABLE `andon_events`
  MODIFY `id_andon` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `hour_by_hour`
--
ALTER TABLE `hour_by_hour`
  MODIFY `h_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `part_numbers`
--
ALTER TABLE `part_numbers`
  MODIFY `pn_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `plant_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `production_lines`
--
ALTER TABLE `production_lines`
  MODIFY `line_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `screen_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `screen_work_station`
--
ALTER TABLE `screen_work_station`
  MODIFY `screen_ws_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `team_alert`
--
ALTER TABLE `team_alert`
  MODIFY `team_alert_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `team_location`
--
ALTER TABLE `team_location`
  MODIFY `tl_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `team_user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `work_order`
--
ALTER TABLE `work_order`
  MODIFY `wo_id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `work_stations`
--
ALTER TABLE `work_stations`
  MODIFY `work_station_id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
