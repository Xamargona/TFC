-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2023 a las 03:42:24
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tfc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `session` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `session`, `date`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2023-06-11 22:00:00', '2023-06-01 22:41:07', '2023-06-01 22:41:07'),
(4, 4, 0, '2023-06-13 22:00:00', '2023-06-01 22:41:37', '2023-06-01 22:41:37'),
(5, 5, 0, '2023-06-18 22:00:00', '2023-06-01 23:12:08', '2023-06-01 23:12:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `text` text NOT NULL,
  `readed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `username`, `email`, `subject`, `text`, `readed`, `created_at`, `updated_at`) VALUES
(1, 'ann._ttoo', 'anndreattoo@gmail.com', 'Problemas publicaciones', 'No se publican algunas imágenes', 1, '2023-06-01 23:13:10', '2023-06-01 23:16:13'),
(3, 'admin', 'admin@gmail.com', 'Problemas publicaciones', 'Incidencia de prueba 2', 0, '2023-06-01 23:16:40', '2023-06-01 23:16:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(2, 'VALENCIA TATTOO EXPO', 'Fería del tatuaje del 2 al 4 de Junio en el pabellon 8 en la feria de Valencia', '20230602013011.png', '2023-06-01 23:30:11', '2023-06-01 23:30:11'),
(4, 'Anime Tatto Expo', 'En Baercelona, Avinguda de la Reina Maria Cristina y del 16 al 18 de Junio', '20230602013822.jpg', '2023-06-01 23:38:22', '2023-06-01 23:38:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `recipient_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `recipient_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 12, 5, 'Buenas tardes, me gustaría hacerme un tatuaje', '2023-06-01 22:50:59', '2023-06-01 22:50:59'),
(2, 12, 2, 'Holaa, estoy interesado en hacerme un piercinfg industrial ¿Cuál sería el precio?', '2023-06-01 22:51:33', '2023-06-01 22:51:33'),
(3, 2, 12, 'Hola, serían 35 euros', '2023-06-01 23:00:36', '2023-06-01 23:00:36'),
(4, 2, 12, 'Pásate por el estudio la semana que viene y sacamos las medidas necesarias para la perforación', '2023-06-01 23:01:12', '2023-06-01 23:01:12'),
(5, 2, 5, '¿Qué tal tu primera semana en el estudio?', '2023-06-01 23:01:45', '2023-06-01 23:01:45'),
(6, 2, 5, '¿Vas haciéndote al material y a la gente?', '2023-06-01 23:02:01', '2023-06-01 23:02:01'),
(7, 5, 12, 'Claro! ¿Qué querrías tatuarte?', '2023-06-01 23:13:33', '2023-06-01 23:13:33'),
(8, 5, 12, 'Tengo diseños publicados por si te gusta alguno', '2023-06-01 23:13:45', '2023-06-01 23:13:45'),
(9, 5, 2, 'Muy bien!!', '2023-06-01 23:13:55', '2023-06-01 23:13:55'),
(10, 5, 2, 'Ha sido una gran acogida', '2023-06-01 23:14:04', '2023-06-01 23:14:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_04_191353_create_bookings_table', 1),
(6, '2023_05_04_191411_create_publications_table', 1),
(7, '2023_05_04_191422_create_events_table', 1),
(8, '2023_05_04_191526_create_messages_table', 1),
(9, '2023_05_04_191604_create_contact_messages_table', 1),
(10, '2023_05_04_193819_create_user_user_table', 1),
(11, '2023_05_16_170838_create_tags_table', 1),
(12, '2023_05_16_170944_create_publication_tag_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publications`
--

CREATE TABLE `publications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `publications`
--

INSERT INTO `publications` (`id`, `title`, `image`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 'Perforación doble nostril de titaneo', '20230602000754.jpg', 2, '2023-06-01 21:54:36', '2023-06-01 22:07:54'),
(5, 'Perforación doble helix para barra industrial', '20230602000637.png', 2, '2023-06-01 21:54:51', '2023-06-01 22:06:37'),
(6, 'Perforación nostril con aro de titaneo', '20230602001044.png', 2, '2023-06-01 22:10:44', '2023-06-01 22:10:44'),
(7, 'Piercing septum con aro grueso', '20230602001138.png', 2, '2023-06-01 22:11:38', '2023-06-01 22:11:38'),
(8, 'Perforación daith con aro de titaneo', '20230602001248.png', 2, '2023-06-01 22:12:48', '2023-06-01 22:12:48'),
(9, 'Recreación de Zeus en brazo en negro', '20230602002510.png', 3, '2023-06-01 22:25:10', '2023-06-01 22:25:10'),
(10, '¡¡Hulk aplasta!! Venom lo intenta', '20230602002630.png', 3, '2023-06-01 22:26:14', '2023-06-01 22:26:30'),
(11, 'Pieza realista de ojo en antebrazo', '20230602002740.png', 3, '2023-06-01 22:27:25', '2023-06-01 22:27:40'),
(12, 'Retrato especial de representación de vida', '20230602003005.png', 3, '2023-06-01 22:30:05', '2023-06-01 22:30:05'),
(13, '¡¡La rana brujita ataca de nuevo!!', '20230602003646.png', 4, '2023-06-01 22:35:47', '2023-06-01 22:36:46'),
(14, '¿Quién dijo que no aprendería a hacer skate?', '20230602003618.png', 4, '2023-06-01 22:36:18', '2023-06-01 22:36:18'),
(15, 'Descubriendo las burbujas por primera vez', '20230602003717.png', 4, '2023-06-01 22:37:17', '2023-06-01 22:37:17'),
(16, 'AYUDA LAS BURBUJAS LA SECUESTRAN', '20230602003801.png', 4, '2023-06-01 22:38:01', '2023-06-01 22:38:01'),
(17, 'Hay que aprender de todo y 2 ruedas era demasiado', '20230602003855.png', 4, '2023-06-01 22:38:55', '2023-06-01 22:38:55'),
(18, '¿Podrá alguien convertir este agua en vino?', '20230602003948.png', 4, '2023-06-01 22:39:48', '2023-06-01 22:39:48'),
(19, 'Primeros bocetos!! Se aceptan sugerencias', '20230602010741.jpg', 5, '2023-06-01 23:07:41', '2023-06-01 23:07:41'),
(20, 'Tatuaje mini con medio mes de curación', '20230602010821.png', 5, '2023-06-01 23:08:21', '2023-06-01 23:08:21'),
(21, 'Tres diseños ya tatuados, muchas gracias por todo!!', '20230602010859.png', 5, '2023-06-01 23:08:59', '2023-06-01 23:08:59'),
(22, 'Seguimos con más mini tatuajes!!', '20230602011100.png', 5, '2023-06-01 23:10:05', '2023-06-01 23:11:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication_tag`
--

CREATE TABLE `publication_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publication_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `publication_tag`
--

INSERT INTO `publication_tag` (`id`, `publication_id`, `tag_id`) VALUES
(7, 4, 33),
(8, 4, 30),
(9, 5, 44),
(10, 5, 35),
(11, 6, 33),
(12, 6, 30),
(13, 7, 30),
(14, 7, 38),
(15, 8, 39),
(16, 8, 30),
(17, 9, 4),
(18, 9, 23),
(19, 10, 29),
(20, 10, 22),
(21, 11, 4),
(22, 11, 1),
(23, 12, 4),
(24, 12, 1),
(25, 12, 22),
(26, 13, 16),
(27, 13, 11),
(28, 14, 12),
(29, 14, 16),
(30, 15, 12),
(31, 15, 16),
(32, 16, 12),
(33, 16, 16),
(34, 17, 12),
(35, 17, 16),
(36, 18, 12),
(37, 18, 16),
(38, 19, 10),
(39, 19, 11),
(40, 19, 15),
(41, 20, 12),
(42, 20, 4),
(43, 20, 45),
(44, 21, 12),
(45, 21, 45),
(46, 21, 16),
(47, 22, 45),
(48, 22, 11),
(49, 22, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Realismo', NULL, NULL),
(2, 'Acuarela', NULL, NULL),
(3, 'Geométrico', NULL, NULL),
(4, 'Blackwork', NULL, NULL),
(5, 'Old School', NULL, NULL),
(6, 'New School', NULL, NULL),
(7, 'Tribal', NULL, NULL),
(8, 'Maorí', NULL, NULL),
(9, 'Japonés', NULL, NULL),
(10, 'Lettering', NULL, NULL),
(11, 'Minimalista', NULL, NULL),
(12, 'Animales', NULL, NULL),
(13, 'Flores', NULL, NULL),
(14, 'Frases', NULL, NULL),
(15, 'Símbolos', NULL, NULL),
(16, 'Fantasía', NULL, NULL),
(17, 'Celta', NULL, NULL),
(18, 'Egipcio', NULL, NULL),
(19, 'Gótico', NULL, NULL),
(20, 'Mandala', NULL, NULL),
(21, 'Puntillismo', NULL, NULL),
(22, 'Realismo en 3D', NULL, NULL),
(23, 'Retratos', NULL, NULL),
(24, 'Skull', NULL, NULL),
(25, 'Trash Polka', NULL, NULL),
(26, 'Vikingo', NULL, NULL),
(27, 'Anime', NULL, NULL),
(28, 'Sombreado', NULL, NULL),
(29, 'Manga', NULL, NULL),
(30, 'Piercing', NULL, NULL),
(31, 'Labial', NULL, NULL),
(32, 'Ceja', NULL, NULL),
(33, 'Nostril', NULL, NULL),
(34, 'Neon', NULL, NULL),
(35, 'Industrial', NULL, NULL),
(36, 'Helix', NULL, NULL),
(37, 'Tragus', NULL, NULL),
(38, 'Septum', NULL, NULL),
(39, 'Daith', NULL, NULL),
(40, 'Conch', NULL, NULL),
(41, 'Rook', NULL, NULL),
(42, 'Snug', NULL, NULL),
(43, 'Lóbulo', NULL, NULL),
(44, 'Cartílago', NULL, NULL),
(45, 'Dot work', NULL, NULL),
(46, 'Lengua', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('admin','user','artist') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `bio`, `avatar`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$QMwJsV6co6OSYhYO4lMu/uF9RGvF84XMaozSiK2p7p/wZrfH.yF7u', NULL, NULL, 'admin', NULL, NULL),
(2, 'SamarucPiercing', 'SamarucPiercing@gmail.com', '$2y$10$NXe0TgeUPYKftaMSPTVqPuKw51C5HskZy//leQ4jk1G2AhVdXOGtK', 'Realizando perforaciones con la mejor calidad y material desde hace 15 años', '20230601232830.jpg', 'artist', NULL, '2023-06-01 21:46:14'),
(3, 'SamarucTattoo', 'SamarucTattoo@gmail.com', '$2y$10$St5/ZZ8k4TvcRzWLmnNCROg4HcCFVjKEvddL0mHkLMM3qD6.wu8bC', 'Realizando de tatuajes con los mejores materiales y técnicas del sector ¡Contáctanos para cualquier duda!', '20230602002332.jpg', 'artist', NULL, '2023-06-01 22:23:32'),
(4, 'TheFrogMaster', 'TheFrogMaster@gmail.com', '$2y$10$e5kV44Wpv5EoiCdBN.v/kuOUSMrZHmqY1VbxUbZ4VaHsdITAn78FC', 'Amante y apasionado de estas criaturas, las intento plasmar de formas divertidas :D', '20230602003326.jpg', 'artist', NULL, '2023-06-01 22:34:06'),
(5, 'ann._ttoo', 'anndreattoo@gmail.com', '$2y$10$Idc/dLP9cpcWixTBB7RlTurTGwEkLLa2.MjErMHURQPFtw3Jk9Su6', 'Aprendiendo a tatuar con los mejores!! Si quieres un tatuaje no dudes en escribirme', '20230602010250.jpg', 'artist', NULL, '2023-06-01 23:03:30'),
(6, 'user', 'user@gmail.com', '$2y$10$Vvj65lFXH59EyVykWkuarO7LBG15KnMOwrUvhQy3jukYJSXSUiUii', NULL, NULL, 'user', NULL, NULL),
(7, 'artist', 'artist@gmail.com', '$2y$10$IxunBxjdp2cToCJ8tXriLOtOPaO7qXyWlqoMjlcKyTterZbebOxWi', NULL, NULL, 'artist', NULL, NULL),
(8, 'artist2', 'artist2@gmail.com', '$2y$10$IxunBxjdp2cToCJ8tXriLOtOPaO7qXyWlqoMjlcKyTterZbebOxWi', NULL, NULL, 'artist', NULL, NULL),
(9, 'artist3', 'artist3@gmail.com', '$2y$10$IxunBxjdp2cToCJ8tXriLOtOPaO7qXyWlqoMjlcKyTterZbebOxWi', NULL, NULL, 'artist', NULL, NULL),
(10, 'artist4', 'artist4@gmail.com', '$2y$10$IxunBxjdp2cToCJ8tXriLOtOPaO7qXyWlqoMjlcKyTterZbebOxWi', NULL, NULL, 'artist', NULL, NULL),
(11, 'artist5', 'artist5@gmail.com', '$2y$10$IxunBxjdp2cToCJ8tXriLOtOPaO7qXyWlqoMjlcKyTterZbebOxWi', NULL, NULL, 'artist', NULL, NULL),
(12, 'xamargona', 'jamargon14@gmail.com', '$2y$10$IrgzRm0vsOpEednIVSQ0Pe828GC2fyYLUJ6/fO7Vq0Fcr.BwkGcye', NULL, '20230602004942.png', 'user', '2023-06-01 22:46:19', '2023-06-01 22:50:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_user`
--

CREATE TABLE `user_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_user`
--

INSERT INTO `user_user` (`user_id`, `artist_id`) VALUES
(2, 3),
(2, 4),
(3, 2),
(3, 4),
(3, 5),
(4, 2),
(4, 3),
(4, 5),
(12, 2),
(12, 3),
(12, 4),
(12, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_recipient_id_foreign` (`recipient_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publications_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `publication_tag`
--
ALTER TABLE `publication_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publication_tag_publication_id_foreign` (`publication_id`),
  ADD KEY `publication_tag_tag_id_foreign` (`tag_id`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `user_user`
--
ALTER TABLE `user_user`
  ADD KEY `user_user_user_id_foreign` (`user_id`),
  ADD KEY `user_user_artist_id_foreign` (`artist_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publications`
--
ALTER TABLE `publications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `publication_tag`
--
ALTER TABLE `publication_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_recipient_id_foreign` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `publications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `publication_tag`
--
ALTER TABLE `publication_tag`
  ADD CONSTRAINT `publication_tag_publication_id_foreign` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`),
  ADD CONSTRAINT `publication_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Filtros para la tabla `user_user`
--
ALTER TABLE `user_user`
  ADD CONSTRAINT `user_user_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
