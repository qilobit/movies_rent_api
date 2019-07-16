-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-07-2019 a las 07:22:54
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `movies_rent_api`
--
CREATE DATABASE IF NOT EXISTS `movies_rent_api` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `movies_rent_api`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `year` year(4) NOT NULL,
  `imbd_rating` varchar(10) NOT NULL,
  `poster` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movies`
--

INSERT INTO `movies` (`id`, `title`, `year`, `imbd_rating`, `poster`, `created_at`, `updated_at`) VALUES
(1, 'Terminator 2', 1982, '8.1', 'C:\\xampp\\htdocs\\movies_rent_api\\public\\images/movies/1563251249.jpg', '2019-07-16 04:03:52', '2019-07-16 04:27:29'),
(2, 'Avatar', 2009, '9.6', 'C:\\xampp\\htdocs\\movies_rent_api\\public\\images/movies/1563251161.jpg', '2019-07-16 04:13:42', '2019-07-16 04:26:01'),
(3, 'Jumanji', 1995, '7', 'C:\\xampp\\htdocs\\movies_rent_api\\public\\images/movies/1563251527.jpg', '2019-07-16 04:32:07', '2019-07-16 04:32:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `age` tinyint(3) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `age`, `role`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'fernandoi', 'jerez', 34, 1, 'asdasd@mail.com', '$2y$10$mpmdVORmO3HirYpjIW7.J.xC9JkVQX.fcKXa8U1uP.GTpv0dOnEkW', '2019-07-16 02:38:16', '2019-07-16 02:38:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_favorite_movies`
--

CREATE TABLE `user_favorite_movies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_favorite_movies`
--

INSERT INTO `user_favorite_movies` (`id`, `user_id`, `movie_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-07-16 05:01:38', '2019-07-16 05:01:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `user_favorite_movies`
--
ALTER TABLE `user_favorite_movies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `user_favorite_movies`
--
ALTER TABLE `user_favorite_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
