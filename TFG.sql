-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql-db
-- Tiempo de generación: 27-05-2025 a las 15:22:23
-- Versión del servidor: 8.0.40
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `TFG`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Like`
--

CREATE TABLE `Like` (
  `id` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_vinilo` int NOT NULL,
  `me_gusta` tinyint(1) DEFAULT '1',
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Like`
--

INSERT INTO `Like` (`id`, `id_usuario`, `id_vinilo`, `me_gusta`, `fecha_creacion`) VALUES
(4, 3, 1, 1, '2025-04-26 10:22:09'),
(5, 4, 5, 1, '2025-04-26 10:22:09'),
(6, 5, 6, 0, '2025-04-26 10:22:09'),
(7, 6, 2, 1, '2025-04-26 10:22:09'),
(8, 7, 4, 1, '2025-04-26 10:22:09'),
(9, 8, 9, 1, '2025-04-26 10:22:09'),
(10, 9, 10, 0, '2025-04-26 10:22:09'),
(11, 12, 1, 1, '2025-04-29 12:18:49'),
(13, 13, 11, 1, '2025-04-29 14:25:16'),
(29, 11, 15, 1, '2025-05-27 14:10:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedido`
--

CREATE TABLE `Pedido` (
  `id` int NOT NULL,
  `id_usuario` int NOT NULL,
  `precio_total` decimal(10,2) DEFAULT '0.00',
  `estado` enum('carrito','pendiente','pagado','cancelado') DEFAULT 'carrito',
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Pedido`
--

INSERT INTO `Pedido` (`id`, `id_usuario`, `precio_total`, `estado`, `fecha_creacion`) VALUES
(3, 3, 27.90, 'pagado', '2025-04-26 10:22:09'),
(4, 4, 50.00, 'cancelado', '2025-04-26 10:22:09'),
(5, 5, 28.99, 'carrito', '2025-04-26 10:22:09'),
(6, 6, 30.00, 'pendiente', '2025-04-26 10:22:09'),
(7, 7, 95.25, 'pagado', '2025-04-26 10:22:09'),
(8, 8, 44.00, 'cancelado', '2025-04-26 10:22:09'),
(9, 9, 35.00, 'carrito', '2025-04-26 10:22:09'),
(10, 10, 0.00, 'pendiente', '2025-04-26 10:22:09'),
(11, 12, 0.00, 'carrito', '2025-04-29 12:19:14'),
(12, 11, 22.00, 'cancelado', '2025-04-29 14:10:54'),
(13, 13, 22.00, 'pendiente', '2025-04-29 16:30:32'),
(14, 13, 22.00, 'cancelado', '2025-04-29 17:00:01'),
(15, 13, 22.00, 'cancelado', '2025-04-29 17:00:27'),
(16, 13, 35.00, 'carrito', '2025-04-29 17:04:24'),
(17, 11, 22.00, 'pendiente', '2025-05-09 16:43:50'),
(18, 11, 30.00, 'cancelado', '2025-05-09 16:44:36'),
(19, 11, 22.00, 'pagado', '2025-05-09 16:52:56'),
(20, 11, 22.00, 'pagado', '2025-05-12 17:17:59'),
(22, 11, 30.00, 'cancelado', '2025-05-26 14:53:07'),
(23, 11, 90.00, 'pagado', '2025-05-26 15:42:35'),
(24, 11, 0.00, 'carrito', '2025-05-27 14:46:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PedidoItem`
--

CREATE TABLE `PedidoItem` (
  `id` int NOT NULL,
  `id_pedido` int NOT NULL,
  `id_vinilo` int NOT NULL,
  `cantidad` int NOT NULL DEFAULT '1',
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `PedidoItem`
--

INSERT INTO `PedidoItem` (`id`, `id_pedido`, `id_vinilo`, `cantidad`, `precio_unitario`) VALUES
(4, 3, 4, 1, 27.90),
(5, 4, 5, 2, 25.00),
(6, 5, 6, 1, 28.99),
(7, 6, 7, 1, 30.00),
(8, 7, 8, 3, 31.75),
(9, 8, 9, 2, 22.00),
(10, 9, 10, 1, 35.00),
(11, 13, 11, 1, 22.00),
(12, 14, 11, 1, 22.00),
(13, 15, 11, 1, 22.00),
(15, 16, 10, 1, 35.00),
(16, 12, 11, 1, 22.00),
(17, 17, 11, 1, 22.00),
(18, 18, 1, 1, 30.00),
(19, 19, 11, 1, 22.00),
(20, 20, 13, 1, 22.00),
(22, 22, 15, 1, 30.00),
(23, 23, 15, 3, 30.00);

--
-- Disparadores `PedidoItem`
--
DELIMITER $$
CREATE TRIGGER `actualizar_precio_total_after_delete` AFTER DELETE ON `PedidoItem` FOR EACH ROW BEGIN
    UPDATE Pedido
    SET precio_total = (
        SELECT IFNULL(SUM(cantidad * precio_unitario), 0)
        FROM PedidoItem
        WHERE id_pedido = OLD.id_pedido
    )
    WHERE id = OLD.id_pedido;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `actualizar_precio_total_after_insert` AFTER INSERT ON `PedidoItem` FOR EACH ROW BEGIN
    UPDATE Pedido
    SET precio_total = (
        SELECT IFNULL(SUM(cantidad * precio_unitario), 0)
        FROM PedidoItem
        WHERE id_pedido = NEW.id_pedido
    )
    WHERE id = NEW.id_pedido;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `actualizar_precio_total_after_update` AFTER UPDATE ON `PedidoItem` FOR EACH ROW BEGIN
    UPDATE Pedido
    SET precio_total = (
        SELECT IFNULL(SUM(cantidad * precio_unitario), 0)
        FROM PedidoItem
        WHERE id_pedido = NEW.id_pedido
    )
    WHERE id = NEW.id_pedido;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('o3QCZhcMCzT5XEZQg1zkpAxZ1o7mdri5F6kxTZrb', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQTRZbjJzSFpCUWpxV0hsZ3ZacDJveDM5RGhyU3h3T2hkN25oMGluWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly92aW5pbG9zdGZnLnRlc3QiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMTt9', 1748357464);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` enum('usuario_registrado','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'usuario_registrado',
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/default.png',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`id`, `username`, `password`, `nombre`, `apellido`, `email`, `rol`, `profile_image`, `created_at`, `updated_at`) VALUES
(3, 'marta_diaz', 'pass789', 'Marta', 'Díaz', 'marta@example.com', 'admin', 'foto3.jpg', '2025-04-29 11:50:04', '2025-05-27 13:51:54'),
(4, 'carlos_ruiz', 'pass111', 'Carlos', 'Ruiz', 'carlos@example.com', 'admin', 'foto4.jpg', '2025-04-29 11:50:04', '2025-04-29 11:50:04'),
(5, 'sofia_lopez', 'pass222', 'Sofía', 'López', 'sofia@example.com', 'usuario_registrado', 'foto5.jpg', '2025-04-29 11:50:04', '2025-04-29 11:50:04'),
(6, 'david_torres', 'pass333', 'David', 'Torres', 'david@example.com', 'usuario_registrado', 'foto6.jpg', '2025-04-29 11:50:04', '2025-04-29 11:50:04'),
(7, 'lucia_martin', 'pass444', 'Lucía', 'Martín', 'lucia@example.com', 'usuario_registrado', 'foto7.jpg', '2025-04-29 11:50:04', '2025-04-29 11:50:04'),
(8, 'javier_gomez', 'pass555', 'Javier', 'Gómez', 'javier@example.com', 'usuario_registrado', 'foto8.jpg', '2025-04-29 11:50:04', '2025-04-29 11:50:04'),
(9, 'elena_navarro', 'pass666', 'Elena', 'Navarro', 'elena@example.com', 'admin', 'foto9.jpg', '2025-04-29 11:50:04', '2025-04-29 11:50:04'),
(10, 'pablo_fernandez', 'pass777', 'Pablo', 'Fernández', 'pablo@example.com', 'usuario_registrado', 'foto10.jpg', '2025-04-29 11:50:04', '2025-04-29 11:50:04'),
(11, 'admin', '$2y$12$238N6xEC9iVlIFA/0HsFOeivePA5GQqfoSReLXQIPUuaiwBgEp.xy', 'admin', 'admin', 'admin@admin.com', 'admin', 'profile_images/XQA6j1Dy7XXMKhU99T6wMzmrSpwhSL9kagL9IiHe.png', '2025-04-29 11:50:04', '2025-05-12 16:41:03'),
(12, 'prueba', '$2y$12$6yFFRzXUJKIlX2YEdAbuEup8j5lixkQaWaXdrURZVcpxUKT91VglK', 'Prueba', 'Prueba', 'prueba@prueba.com', 'usuario_registrado', 'images/perfil-default.png', '2025-04-29 11:50:04', '2025-04-29 11:50:04'),
(13, 'prueba22', '$2y$12$qBr7AGFmzuWnsIi82AXyYegSCi9HisisTPJG6.R.YTVzm37Uxb.Lu', 'Prueba22', 'Prueba22', 'prueba22@prueba.com', 'usuario_registrado', 'profile_images/1q3tHshKdQC1nD77md7NHYrVa5POSxARgsqfYeyU.jpg', '2025-04-29 11:50:04', '2025-04-29 16:30:22'),
(15, 'Prueba4', '$2y$12$pPsnmquS.UtFRyyVtEn1/.n2DuSZiVzacsy5hvW5q4ZooAA1oaMZS', 'Prueba4', 'Prueba4', 'Prueba4@Prueba4.com', 'admin', 'images/perfil-default.png', '2025-04-29 12:19:49', '2025-05-12 13:30:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Vinilo`
--

CREATE TABLE `Vinilo` (
  `id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `artista` varchar(255) NOT NULL,
  `genero` varchar(100) DEFAULT NULL,
  `anio` year DEFAULT NULL,
  `imagen` varchar(500) DEFAULT NULL,
  `preview_audio` varchar(500) DEFAULT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Vinilo`
--

INSERT INTO `Vinilo` (`id`, `titulo`, `artista`, `genero`, `anio`, `imagen`, `preview_audio`, `precio_unitario`, `fecha_creacion`) VALUES
(1, 'Abbey Road', 'The Beatles', 'Rock', '1968', 'abbey.jpg', 'abbey.mp3', 30.00, '2025-04-26 10:22:09'),
(2, 'Thriller', 'Michael Jackson', 'Pop', '1982', 'thriller.jpg', 'thriller.mp3', 34.99, '2025-04-26 10:22:09'),
(3, 'The Dark Side of the Moon', 'Pink Floyd', 'Rock', '1973', 'darkside.jpg', 'darkside.mp3', 32.50, '2025-04-26 10:22:09'),
(4, 'Back in Black', 'AC/DC', 'Rock', '1980', 'backinblack.jpg', 'backinblack.mp3', 27.90, '2025-04-26 10:22:09'),
(5, 'Rumours', 'Fleetwood Mac', 'Rock', '1977', 'rumours.jpg', 'rumours.mp3', 25.00, '2025-04-26 10:22:09'),
(6, 'Born to Run', 'Bruce Springsteen', 'Rock', '1975', 'borntorun.jpg', 'borntorun.mp3', 28.99, '2025-04-26 10:22:09'),
(7, 'Hotel California', 'Eagles', 'Rock', '1976', 'hotelcalifornia.jpg', 'hotelcalifornia.mp3', 30.00, '2025-04-26 10:22:09'),
(8, 'Led Zeppelin IV', 'Led Zeppelin', 'Rock', '1971', 'ledzep4.jpg', 'ledzep4.mp3', 31.75, '2025-04-26 10:22:09'),
(9, '21', 'Adele', 'Pop', '2011', '21.jpg', '21.mp3', 22.00, '2025-04-26 10:22:09'),
(10, 'Random Access Memories', 'Daft Punk', 'Electronic', '2013', 'ram.jpg', 'ram.mp3', 35.00, '2025-04-26 10:22:09'),
(11, 'Prueba2', 'Prueba', 'prueba', '1999', 'vinilos/krMujc6Rskw9RWhF4tdRIcDrfXLAdL1wkhrvVM07.png', 'previews/1747064981_1 Minute Timer with Music [ELECTRIC].mp3', 22.00, '2025-04-29 13:55:45'),
(12, 'PruebaAudio', 'Pruebaa', 'Pop', '2022', 'vinilos/pwL8lOBjmAMQ7KIDa4o3ee7S4Znuc26UuXe6peI9.jpg', NULL, 32.00, '2025-05-12 14:51:50'),
(13, 'AudioPrueba2', 'das', 'da', '2025', 'vinilos/1747070264_khalifa.png', 'previews/1747070242_1_Minute_Timer_with_Music__ELECTRIC_.mp3', 22.00, '2025-05-12 17:17:44'),
(14, 'Grandes Exitos y Fracasos', 'Extremoduro', 'Rock', '2004', 'vinilos/1748269771_extremoduro-grandes-exitos-y-fracasos-vol2.jpg', 'previews/1748270135_La vereda de la puerta de atras extremoduro.mp3', 28.00, '2025-05-26 14:29:31'),
(15, 'Estopa Legacy', 'Estopa', 'Rock / Pop', '1999', 'vinilos/1748271086_images.jpeg', 'previews/1748271082_Estopa_-_La_Raja_de_Tu_Falda__Videoclip___En_Directo_.mp3', 30.00, '2025-05-26 14:51:26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Like`
--
ALTER TABLE `Like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vinilo` (`id_vinilo`),
  ADD KEY `Like_ibfk_1` (`id_usuario`);

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
-- Indices de la tabla `Pedido`
--
ALTER TABLE `Pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Pedido_ibfk_1` (`id_usuario`);

--
-- Indices de la tabla `PedidoItem`
--
ALTER TABLE `PedidoItem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_vinilo` (`id_vinilo`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nombreUsuario` (`username`);

--
-- Indices de la tabla `Vinilo`
--
ALTER TABLE `Vinilo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Like`
--
ALTER TABLE `Like`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Pedido`
--
ALTER TABLE `Pedido`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `PedidoItem`
--
ALTER TABLE `PedidoItem`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `Vinilo`
--
ALTER TABLE `Vinilo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Like`
--
ALTER TABLE `Like`
  ADD CONSTRAINT `Like_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Like_ibfk_2` FOREIGN KEY (`id_vinilo`) REFERENCES `Vinilo` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `Pedido`
--
ALTER TABLE `Pedido`
  ADD CONSTRAINT `Pedido_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `PedidoItem`
--
ALTER TABLE `PedidoItem`
  ADD CONSTRAINT `PedidoItem_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `Pedido` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `PedidoItem_ibfk_2` FOREIGN KEY (`id_vinilo`) REFERENCES `Vinilo` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
