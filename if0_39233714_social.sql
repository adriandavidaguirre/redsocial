-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql210.infinityfree.com
-- Tiempo de generación: 16-06-2025 a las 12:23:16
-- Versión del servidor: 10.6.19-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `if0_39233714_social`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(9, 'Que bueno', 'adrian_aguirre', 'adrian_aguirre', '2025-05-30 02:09:53', 'no', 74),
(10, 'Perritos de todos tipos', 'adrian_aguirre', 'adrian_aguirre', '2025-06-01 22:35:01', 'no', 95),
(11, 'que buenosigueasi', 'dani_aguirre', 'adrian_aguirre', '2025-06-14 21:01:28', 'no', 100),
(12, 'gracias\r\n', 'adrian_aguirre', 'adrian_aguirre', '2025-06-15 01:01:44', 'no', 100),
(13, 'como te salio la ceramica? esta lista?', 'dani_aguirre', 'adrian_aguirre', '2025-06-15 20:51:54', 'no', 100),
(14, 'Hermosa MaÃ±ana', 'adrian_aguirre', 'josede_prueba', '2025-06-16 16:32:43', 'no', 102);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(26, 'adrian_aguirre', 74),
(27, 'adrian_aguirre', 94),
(28, 'adrian_aguirre', 95),
(29, 'adrian_aguirre', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `user_to`, `user_from`, `message`, `link`, `datetime`, `opened`, `viewed`) VALUES
(19, 'adrian_aguirre', 'dani_aguirre', 'Dani Aguirre commented on your post', 'post.php?id=100', '2025-06-14 21:01:28', 'yes', 'yes'),
(20, 'dani_aguirre', 'adrian_aguirre', 'Adrian Aguirre commented on a post you commented on', 'post.php?id=100', '2025-06-15 01:01:44', 'yes', 'yes'),
(21, 'adrian_aguirre', 'dani_aguirre', 'Dani Aguirre comentó en tu publicación', 'post.php?id=100', '2025-06-15 20:51:54', 'yes', 'yes'),
(22, 'josede_prueba', 'adrian_aguirre', 'Adrian Aguirre commented on your post', 'post.php?id=102', '2025-06-16 16:32:43', 'no', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `user_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`, `image`) VALUES
(66, 'Soy yo', 'adrian_aguirre', 'none', '2025-05-29 02:25:47', 'no', 'yes', 0, NULL),
(67, 'Soy yo', 'adrian_aguirre', 'none', '2025-05-29 02:25:55', 'no', 'yes', 0, NULL),
(68, 'Soy yo', 'adrian_aguirre', 'none', '2025-05-29 02:26:01', 'no', 'yes', 0, NULL),
(69, 'DOOM', 'adrian_aguirre', 'none', '2025-05-29 02:27:37', 'no', 'yes', 0, NULL),
(70, 'DOOM', 'adrian_aguirre', 'none', '2025-05-29 02:27:48', 'no', 'yes', 0, NULL),
(71, 'DOOM', 'adrian_aguirre', 'none', '2025-05-29 02:27:51', 'no', 'yes', 0, NULL),
(72, 'DOOM', 'adrian_aguirre', 'none', '2025-05-29 02:27:55', 'no', 'yes', 0, NULL),
(73, 'DOOM', '', 'none', '2025-05-30 01:52:33', 'no', 'no', 0, NULL),
(74, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:09:42', 'no', 'yes', 1, 'assets/images/posts/68390556002c7images.jpg'),
(75, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:10:17', 'no', 'yes', 0, 'assets/images/posts/68390579e0663images.jpg'),
(76, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:10:21', 'no', 'yes', 0, 'assets/images/posts/6839057d169ebimages.jpg'),
(77, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:10:26', 'no', 'yes', 0, 'assets/images/posts/68390582bce3fimages.jpg'),
(78, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:10:44', 'no', 'yes', 0, 'assets/images/posts/683905948ce7dimages.jpg'),
(79, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:10:47', 'no', 'yes', 0, 'assets/images/posts/683905978bfadimages.jpg'),
(80, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:10:49', 'no', 'yes', 0, 'assets/images/posts/68390599eed28images.jpg'),
(81, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:10:52', 'no', 'yes', 0, 'assets/images/posts/6839059c5e548images.jpg'),
(82, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:10:55', 'no', 'yes', 0, 'assets/images/posts/6839059f3dd69images.jpg'),
(83, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:10:57', 'no', 'yes', 0, 'assets/images/posts/683905a1a7584images.jpg'),
(84, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:11:03', 'no', 'yes', 0, 'assets/images/posts/683905a78a231images.jpg'),
(85, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:11:14', 'no', 'yes', 0, 'assets/images/posts/683905b21a5d5images.jpg'),
(86, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:11:22', 'no', 'yes', 0, 'assets/images/posts/683905bac21b4images.jpg'),
(87, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:11:31', 'no', 'yes', 0, 'assets/images/posts/683905c3b6fd8images.jpg'),
(88, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:11:36', 'no', 'yes', 0, 'assets/images/posts/683905c8acdceimages.jpg'),
(89, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:11:44', 'no', 'yes', 0, 'assets/images/posts/683905d027eb9images.jpg'),
(90, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:12:01', 'no', 'yes', 0, 'assets/images/posts/683905e154b10images.jpg'),
(91, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:13:09', 'no', 'yes', 0, 'assets/images/posts/6839062569941images.jpg'),
(92, 'doom', 'adrian_aguirre', 'none', '2025-05-30 02:16:19', 'no', 'yes', 0, 'assets/images/posts/683906e34a57cimages.jpg'),
(93, 'lalalalaa', 'adrian_aguirre', 'none', '2025-05-30 02:17:23', 'no', 'yes', 0, 'assets/images/posts/6839072333b28images.jpg'),
(94, '213123', 'adrian_aguirre', 'none', '2025-05-30 02:45:53', 'no', 'yes', 1, 'assets/images/posts/68390dd1c6623cnne-1102116-mickey-mouse.jpeg'),
(95, 'Perritos', 'adrian_aguirre', 'none', '2025-06-01 22:34:40', 'no', 'yes', 1, 'assets/images/posts/683cc770c5500124600147-los-perros-jóvenes-están-posando-lindos-perritos-o-mascotas-se-ven-felices-aislados-en-un-fondo-colo.jpg'),
(96, 'Perritos', 'adrian_aguirre', 'none', '2025-06-01 22:50:50', 'no', 'yes', 0, 'assets/images/posts/683ccb3a5663e124600147-los-perros-jóvenes-están-posando-lindos-perritos-o-mascotas-se-ven-felices-aislados-en-un-fondo-colo.jpg'),
(97, 'Foto de mi perfil', 'adrian_aguirre', 'none', '2025-06-01 22:51:03', 'no', 'yes', 0, 'assets/images/posts/683ccb47d64aecnne-1102116-mickey-mouse.jpeg'),
(98, 'Jugando a Doom', 'adrian_aguirre', 'none', '2025-06-01 22:51:21', 'no', 'yes', 0, 'assets/images/posts/683ccb59efe5bimages.jpg'),
(99, 'Hoy comere asado', 'adrian_aguirre', 'none', '2025-06-01 22:51:36', 'no', 'no', 0, ''),
(100, 'Estoyhaciendoceramica', 'adrian_aguirre', 'none', '2025-06-14 21:00:25', 'no', 'no', 1, 'assets/images/posts/684dd4d9788e8images (1).jpg'),
(101, 'Mis perros', 'adrian_aguirre', 'none', '2025-06-15 17:53:46', 'no', 'yes', 0, 'assets/images/posts/684efa9aeedd2124600147-los-perros-jóvenes-están-posando-lindos-perritos-o-mascotas-se-ven-felices-aislados-en-un-fondo-colo.jpg'),
(102, 'Hoy viendo el Amanecer', 'josede_prueba', 'none', '2025-06-16 16:31:40', 'no', 'no', 0, 'assets/images/posts/685038dc668ddAmanecer.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trends`
--

CREATE TABLE `trends` (
  `title` varchar(50) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `trends`
--

INSERT INTO `trends` (`title`, `hits`) VALUES
('Soy', 3),
('Yo', 3),
('DOOM', 25),
('Lalalalaa', 1),
('213123', 1),
('Perritos', 2),
('Foto', 1),
('De', 1),
('Mi', 1),
('Perfil', 1),
('Jugando', 1),
('Hoy', 2),
('Comere', 1),
('Asado', 1),
('$term', 1),
('Estoyhaciendoceramica', 1),
('Mis', 1),
('Perros', 1),
('Viendo', 1),
('El', 1),
('Amanecer', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trends_posts`
--

CREATE TABLE `trends_posts` (
  `id` int(11) NOT NULL,
  `trend_title` varchar(255) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trends_posts`
--

INSERT INTO `trends_posts` (`id`, `trend_title`, `post_id`) VALUES
(4, 'asado', 91),
(5, 'Estoyhaciendoceramica', 100),
(8, 'Hoy', 102),
(9, 'Viendo', 102),
(10, 'El', 102),
(11, 'Amanecer', 102);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(11, 'Adrian', 'Aguirre', 'adrian_aguirre', 'Adriandavid.sanluis@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2025-05-21', 'assets/images/profile_pics/adrian_aguirreb5c7813218ca431bf9a9a1938a6c3794n.jpeg', 6, 4, 'no', ',urgencio_gibs,dani_aguirre,josede_prueba,'),
(13, 'Urgencio', 'Gibs', 'urgencio_gibs', 'Email@gmail.com', 'e416e6258ad7e032e5af1694d92497b5', '2025-06-01', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ',adrian_aguirre,'),
(14, 'Dani', 'Aguirre', 'dani_aguirre', '1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2025-06-12', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ',adrian_aguirre,'),
(15, 'Josede', 'Prueba', 'josede_prueba', 'prueba@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2025-06-15', 'assets/images/profile_pics/defaults/head_deep_blue.png', 2, 0, 'no', ',adrian_aguirre,');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trends_posts`
--
ALTER TABLE `trends_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `trends_posts`
--
ALTER TABLE `trends_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `trends_posts`
--
ALTER TABLE `trends_posts`
  ADD CONSTRAINT `trends_posts_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
