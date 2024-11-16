-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 06:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog2`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`) VALUES
(1, 1, 2, 'Que bueno', '2024-11-16 17:55:16'),
(2, 3, 2, 'Muy interesante', '2024-11-16 17:55:35'),
(3, 2, 2, 'Increíble', '2024-11-16 17:55:54'),
(4, 5, 1, 'Felicidades a todos', '2024-11-16 17:58:30'),
(5, 4, 1, 'Perfecto', '2024-11-16 17:58:42'),
(6, 5, 2, 'Enhorabuena!', '2024-11-16 17:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `image_path`, `author_id`, `created_at`) VALUES
(1, 'El lobi de la polémica tecnología de captura y almacenamiento de CO2 aterriza en la COP29 del clima', 'Hasta 480 defensores de esa tecnología, representando a empresas o grupos de presión, están acreditados en la cumbre climática de Naciones Unidas.', 'uploads/md.webp', 1, '2024-11-16 17:52:13'),
(2, 'UTH: Tecnología de punta al servicio de la educación', 'La institución impulsa el uso de nuevas tecnologías para generar mejoras en la satisfacción del cliente y promover la gestión del cambio.', 'uploads/foto-para-notas-nuevo-36_8973031_20241105235633[1].jpg', 1, '2024-11-16 17:53:02'),
(3, 'Panamá fortalece lazos con Corea del Sur en tecnología avanzada en el Primer Foro Empresarial K-CAFTA', 'La Secretaría Nacional de Ciencia, Tecnología e Innovación (Senacyt) contó con la representación del Lic. Franklin Morales, jefe de Cooperación Técnica Internacional, en el Primer Foro Empresarial en el marco del Tratado de Libre Comercio entre Corea y Centroamérica (K-CAFTA), celebrado el 11 y 12 de noviembre en San José, Costa Rica.\r\n\r\nLa participación de la Senacyt en este foro refleja el interés de Panamá en estrechar relaciones con Corea del Sur en el ámbito de las tecnologías avanzadas y promover el intercambio de conocimientos y capacidades tecnológicas.', 'uploads/dplnews_5g-coreadelsur_mc50721[1].png', 1, '2024-11-16 17:53:53'),
(4, 'La Asociación de Tecnología de Consumo premia las innovaciones de Samsung basadas en la IA', 'Los premios, entre los que se incluyen cuatro “Best of Innovation”, sirven como reconocimiento a la creatividad de Samsung en las áreas de IA, diseño y experiencia de usuario', 'uploads/CES-2025-Innovation-Awards_Samsung-938x563[1].png', 2, '2024-11-16 17:56:39'),
(5, 'La Conferencia de Tecnología de la OMA 2024 concluye con éxito en Río de Janeiro', 'La Conferencia y Exposición de Tecnología de la Organización Mundial de Aduanas (OMA) concluyó este jueves 14 de octubre de 2024, tras tres días de intensas actividades.Más de 1.350 participantes de 117 países se dieron cita en este destacado evento, que incluyó paneles de discusión, conferencias magistrales, entrevistas y charlas técnicas. Este espacio proporcionó un enfoque integral sobre el futuro de las aduanas en la era digital, impulsando la colaboración entre los actores clave del sector.', 'uploads/Aduana-News-editada-1068x580[1].png', 2, '2024-11-16 17:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'jorge manuel', 'jorgemanuel@gmail.com', '$2y$10$G2IZVjzqrY84x8qq38IidOB9GIvXwM79R8tf8fKZqU/HoRdA6YCe2'),
(2, 'gerardo martinez', 'gerardomartinez@gmail.com', '$2y$10$B1NSWUcVNG1Tl1m2EFNKbOiEKCb4f3wNPJ7NBgz/edQ3U3KPtcHmu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
