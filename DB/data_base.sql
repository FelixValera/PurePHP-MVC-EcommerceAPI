-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-03-2025 a las 00:56:38
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `phpavanzado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `url_imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`, `url_imagen`) VALUES
(1, 'Anteojos', 'Anteojos', '/img/Anteojos/98c28ec9289273a85e9d7b9f7095b130d2901232'),
(2, 'Calzado', 'Calzado', '/img/Calzado/Calzado.jpg'),
(3, 'Jeans', 'Jeans', '/img/Jeans/jeans.jpg.webp'),
(4, 'Remeras', 'Remeras', '/img/Remeras/Remeras.jpg.webp'),
(16, 'Consolas', 'Las mejores consolas', '/img/Consolas/7ffa1686e18f91e5560ea584d1298bd60f367c1f'),
(18, 'Informatica', 'Best computers on the market', '/img/Informatica/5c0fe0fc3e356414b721776661ce8b321ab609e6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `precio` decimal(60,2) NOT NULL,
  `contenido` text NOT NULL,
  `url_img_principal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `id_categoria`, `precio`, `contenido`, `url_img_principal`) VALUES
(2, 'Apostolos', 1, 299.99, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Anteojos/apostolos-vamvouras-mKi4QEJXRCs-unsplash.jpg.webp'),
(3, 'Charles Deluvio', 1, 80.55, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Anteojos/charles-deluvio-1-nx1QR5dTE-unsplash.jpg.webp'),
(4, 'Chase Fade', 1, 68.20, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Anteojos/chase-fade-WgjmiOxYKRQ-unsplash.jpg.webp'),
(5, 'Ethan Roberston', 1, 25.50, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Anteojos/ethan-robertson-SYx3UCHZJlo-unsplash.jpg.webp'),
(6, 'Giorgio Trovato', 1, 36.45, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Anteojos/giorgio-trovato-K62u25Jk6vo-unsplash.jpg.webp'),
(7, 'Karsten', 1, 45.20, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Anteojos/karsten-winegeart-zgLydtnQmS4-unsplash.jpg.webp'),
(8, 'Noah Black', 1, 59.24, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Anteojos/noah-black-1p3N5SHz0Hk-unsplash.jpg.webp'),
(9, 'Sebastian Coman', 1, 86.58, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Anteojos/sebastian-coman-travel-dtOTQYmTEs0-unsplash.jpg.webp'),
(10, 'Stephanie Hau', 1, 75.14, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Anteojos/stephanie-hau-P4TPjOXKqY8-unsplash.jpg.webp'),
(11, 'Alexandra Gorn', 2, 150.25, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Calzado/alexandra-gorn-CJ6SJO_yR5w-unsplash.jpg.webp'),
(12, 'Andres Jasso', 2, 250.64, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Calzado/andres-jasso-PqbL_mxmaUE-unsplash.jpg.webp'),
(13, 'Camila Damasio', 2, 350.99, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Calzado/camila-damasio-mWYhrOiAgmA-unsplash.jpg.webp'),
(14, 'Imani', 2, 319.40, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Calzado/imani-bahati-LxVxPA1LOVM-unsplash.jpg.webp'),
(15, 'Irene', 2, 260.41, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Calzado/irene-kredenets-dwKiHoqqxk8-unsplash.jpg.webp'),
(16, 'Jaclyn Moy', 2, 170.64, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Calzado/jaclyn-moy-ugZxwLQuZec-unsplash.jpg.webp'),
(17, 'Jakob Owens', 2, 60.64, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Calzado/jakob-owens-JzJSybPFb3s-unsplash.jpg.webp'),
(18, 'Mohammad Metri', 2, 220.41, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Calzado/mohammad-metri-E-0ON3VGrBc-unsplash.jpg.webp'),
(19, 'Paul Gaudriault', 2, 350.21, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Calzado/paul-gaudriault-a-QH9MAAVNI-unsplash.jpg.webp'),
(20, 'Wengang Shai', 2, 450.99, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Calzado/wengang-zhai-_fOL6ebfECQ-unsplash.jpg.webp'),
(21, 'Ali Pazani', 3, 400.45, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Jeans/ali-pazani-Pdds9XsWyoM-unsplash.jpg.webp'),
(22, 'Alicia Petresc', 3, 350.65, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Jeans/alicia-petresc-BciCcl8tjVU-unsplash.jpg.webp'),
(23, 'Christopher Ivanov', 3, 565.75, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Jeans/christopher-ivanov-h6jgQaBNIyA-unsplash.jpg.webp'),
(24, 'Dave', 3, 650.55, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Jeans/dave-goudreau-UfYPR2UIOW4-unsplash.jpg.webp'),
(25, 'Jimmy Jimenez', 3, 199.99, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Jeans/jimmy-jimenez-hGxReQwL5jE-unsplash.jpg.webp'),
(26, 'Martinez', 3, 235.89, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Jeans/jose-martinez-59wAqtRDSj0-unsplash.jpg.webp'),
(27, 'Marlon Silva', 3, 345.25, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Jeans/marlon-silva-EbyfUtxtEbc-unsplash.jpg.webp'),
(28, 'Silviu', 3, 550.25, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Jeans/silviu-beniamin-tofan-spqwdZXzduU-unsplash.jpg.webp'),
(29, 'Tamara', 3, 740.79, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Jeans/tamara-bellis-zDyJOj8ZXG0-unsplash.jpg.webp'),
(30, 'Fedotov', 3, 357.78, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Jeans/vladimir-fedotov-MPfyh3xJ1iE-unsplash.jpg.webp'),
(31, 'Amir Babaei', 4, 164.74, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Remeras/amir-babaei-0NK0FtJnIWE-unsplash.jpg.webp'),
(32, 'Chelsea', 4, 278.26, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Remeras/chelsea-ferenando-r_-M00daj2Y-unsplash.jpg.webp'),
(33, 'Bolt', 4, 379.41, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Remeras/christian-bolt-VW5VjskNXZ8-unsplash.jpg.webp'),
(34, 'Sounds', 4, 836.12, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Remeras/free-to-use-sounds-HXaCARJwKUQ-unsplash.jpg.webp'),
(35, 'Jason Yoder', 4, 634.75, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Remeras/jason-yoder-CzZGxHUrOlI-unsplash.jpg.webp'),
(36, 'Marcel', 4, 389.74, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Remeras/marcel-j-uWrCdB5sM-unsplash.jpg.webp'),
(37, 'Marcus', 4, 145.89, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Remeras/marcus-ganahl-EQIrev_NGH8-unsplash.jpg.webp'),
(38, 'Nandkishore', 4, 736.65, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Remeras/nandkishore-sahu-6M14IWufRLw-unsplash.jpg.webp'),
(39, 'Reazkhani', 4, 486.23, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Remeras/sina-rezakhani-PMdtwPKWt5Q-unsplash.jpg.webp'),
(40, 'Tom Cocherau', 4, 364.85, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Placeat ut autem dolorum saepe eos sit ipsum quo eaque. Doloribus officiis aspernatur maiores sunt perferendis blanditiis accusantium, ipsum voluptate non eaque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, hic necessitatibus. Sed dolore facere laudantium modi sit tenetur voluptate officiis sunt recusandae, nesciunt amet. Corporis dignissimos tempore omnis ratione cumque?Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab, officiis, delectus debitis necessitatibus expedita quo autem vitae accusantium consequatur blanditiis ullam molestias repellendus explicabo totam tempore dicta ex fuga.', '/img/Remeras/tom-cochereau-bf_CMgK8Pj0-unsplash.jpg.webp'),
(44, 'Playstation 5', 16, 499.00, 'Almacenamiento de 1TB y video en 4K con un procesador que harán que tus juegos se ejecuten a la velocidad de la luz. Si quieres excelencia y potencia graficas es la consola indicada !!!', '/img/Consolas/4059b9d1dc7b9352c69004cb35e3e99278f4ace1'),
(45, 'Nintendo Switch', 16, 365.00, 'Prueba tus juegos favoritos continuamos con los clasicos de super mario, mario kart y Pokemon siempre pokemon', '/img/Consolas/d89dd013fc3753a3eebaebe507659fb2ad03dcb5'),
(46, 'Xbox Series X', 16, 450.00, 'La mejor consola de Microsoft viene con una suscripción a game pass con el que podrás disfrutar de todos nuestro catalogo de juegos Nota: el control no incluye baterias :(', '/img/Consolas/0741d492dbddcbe08c834dfaa597b8f209d09b65'),
(51, 'Alienware', 18, 1500.00, 'Somos lo mejor en rendimiento y calidad. Si quieres trabajar y que la lentitud no sea un problema, o si prefieres jugar con los gráficos mas altos y una máxima velocidad somo el producto que te mereces !!! &#129302', '/img/Informatica/7f4b43aaf52280eb0298e196c2da6df2a47e0163'),
(52, 'MSI', 18, 950.00, 'Somos la PC ideal para los gamers. Para jugadores exigentes se requieren de equipos de alto nivel y rendimiento como lo es la MSI Victorius !!!   &#127918', '/img/Informatica/cb4ef8705202c0662cdc73d0e27061be8d290431'),
(53, 'Apple', 18, 3500.00, '¿tienes dinero? y ¿quieres demostrarlo?. La mejor forma es adquirir uno de nuestros productos cuando la gente vea el logo en tu laptop sabrán que nunca llegaran a tu nivel.  &#129297', '/img/Informatica/2e220150ead3cefab0ccefcde49b3fc2ebec19f5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `api_key` text NOT NULL,
  `rol` varchar(30) NOT NULL DEFAULT 'read'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `api_key`, `rol`) VALUES
(8, 'Admin@example.com', '$2y$10$SkJJctKrjqur/uJl9A9gred/QTeciGGRk8OqfPPiwj0MkgF5a6Tgu', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MCwiZW1haWwiOiJBZG1pbkBleGFtcGxlLmNvbSIsInJvbCI6InN1cGVyQWRtaW4ifQ==./n/fzZmwbNkQaoZxCyFol/PABiyl59nVBaqXy1f2zc4=', 'superAdmin'),
(10, 'Pedro@example.com', '$2y$10$50HdvFqC1GO4dF5YUXo/0ON9jaSbBqnSADNpzHr2W1hJWMresTRHG', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MCwiZW1haWwiOiJQZWRyb0BleGFtcGxlLmNvbSIsInJvbCI6InJlYWQifQ==.N/a3rPVUJ857XdPT4Y06yXwKrO/9RXEWfcTK+maAIXA=', 'read'),
(11, 'juanito@example.com', '$2y$10$lctd1wSCY0dTv7ub66extOmbf.twtCtyfx3Yr8SAjbdpwJzZepqyy', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MCwiZW1haWwiOiJqdWFuaXRvQGV4YW1wbGUuY29tIiwicm9sIjoicmVhZCJ9.j4cxc61/BpCLyYxVqf8WrbaECBbwgNsvScGbt7kFTyw=', 'read');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
