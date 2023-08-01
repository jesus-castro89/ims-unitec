-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-08-2023 a las 23:37:06
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `my_store`
--
CREATE DATABASE IF NOT EXISTS `my_store` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `my_store`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` varchar(36) NOT NULL COMMENT 'Identificador único de la categoría de Produictos',
  `name` varchar(140) DEFAULT NULL COMMENT 'Nombre de la Categoría de Producto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla para las categorias de productos';

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
('83bf8bda-2e69-11ee-9ce9-309c239d41f8', 'Nullam'),
('83c10505-2e69-11ee-9ce9-309c239d41f8', 'Magnis'),
('83c1e2ba-2e69-11ee-9ce9-309c239d41f8', 'Ligula'),
('83c29b79-2e69-11ee-9ce9-309c239d41f8', 'Lorem'),
('83c3b540-2e69-11ee-9ce9-309c239d41f8', 'Ipsum'),
('83c46fa7-2e69-11ee-9ce9-309c239d41f8', 'Creatio'),
('83c52961-2e69-11ee-9ce9-309c239d41f8', 'Dolors');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id` varchar(36) NOT NULL COMMENT 'Identificador único de nuestro cliente',
  `name` varchar(140) NOT NULL COMMENT 'Nombre del Cliente',
  `last_name` varchar(140) NOT NULL COMMENT 'Apellido(s) de nuestro cliente',
  `address` text NOT NULL,
  `zip_code` int(5) UNSIGNED NOT NULL COMMENT 'Codigo postal de nuestro cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tablas para nuestros Clientes';

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id`, `name`, `last_name`, `address`, `zip_code`) VALUES
('b5eb4c11-2e6a-11ee-9ce9-309c239d41f8', 'Rhodax', 'Zamora', '281-8355 Praesent Avenue', 49040),
('b5ec8320-2e6a-11ee-9ce9-309c239d41f8', 'Hasad', 'Dillon', '700-5503 Aliquet Av.', 62372),
('b5ede08b-2e6a-11ee-9ce9-309c239d41f8', 'Rosalyn', 'Simmons', '499-8672 Neque. St.', 24643),
('b5eecda8-2e6a-11ee-9ce9-309c239d41f8', 'Allen', 'Watts', '330-5089 Cum Rd.', 62751),
('b5efbd5a-2e6a-11ee-9ce9-309c239d41f8', 'Rylee', 'Chandler', 'Ap #232-2698 Dictum Av.', 65246),
('b5f0e127-2e6a-11ee-9ce9-309c239d41f8', 'Warren', 'Kline', '4833 Lorem, St.', 21229),
('b5f1dead-2e6a-11ee-9ce9-309c239d41f8', 'Tamara', 'Beasley', '8637 Pellentesque. Road', 76351),
('b5f2c200-2e6a-11ee-9ce9-309c239d41f8', 'Barry', 'Orr', 'Ap #825-8182 Magnis Avenue', 9896),
('b5f3e367-2e6a-11ee-9ce9-309c239d41f8', 'Simon', 'Campbell', '810-234 Sed St.', 37263),
('b5f4c2a4-2e6a-11ee-9ce9-309c239d41f8', 'Piper', 'Cannon', '8687 Nulla Road', 56477),
('b5f5a3f9-2e6a-11ee-9ce9-309c239d41f8', 'Ocean', 'Christensen', 'P.O. Box 547, 7599 Magna Road', 83157),
('b5f6985d-2e6a-11ee-9ce9-309c239d41f8', 'Zahir', 'Cannon', '944-6190 Arcu Av.', 67642),
('b5f767e2-2e6a-11ee-9ce9-309c239d41f8', 'Katelyn', 'Howard', 'P.O. Box 289, 5244 Sem Rd.', 72659),
('b5f84f8f-2e6a-11ee-9ce9-309c239d41f8', 'Morgan', 'Bird', 'P.O. Box 203, 4002 Ut, Rd.', 4122),
('b5f93e08-2e6a-11ee-9ce9-309c239d41f8', 'Levi', 'Finley', '7242 Purus St.', 63808),
('b5fa1f46-2e6a-11ee-9ce9-309c239d41f8', 'Wynter', 'Holcomb', '8142 Mi Ave', 31347),
('b5fb092c-2e6a-11ee-9ce9-309c239d41f8', 'Remedios', 'Bruce', '5924 Tincidunt Ave', 77592),
('b5fbe331-2e6a-11ee-9ce9-309c239d41f8', 'Catherine', 'Ball', '806-9951 At, Av.', 51583),
('b5fcc742-2e6a-11ee-9ce9-309c239d41f8', 'Sharon', 'Clayton', 'Ap #794-4851 Semper St.', 80133),
('b5fda710-2e6a-11ee-9ce9-309c239d41f8', 'Honorato', 'Bolton', '5029 Blandit Avenue', 72365),
('b5fe7e65-2e6a-11ee-9ce9-309c239d41f8', 'Lucius', 'Meadows', '204-3112 Auctor Rd.', 84842),
('b5ff4705-2e6a-11ee-9ce9-309c239d41f8', 'Yetta', 'Kline', '651-8308 Urna. St.', 84738),
('b6003535-2e6a-11ee-9ce9-309c239d41f8', 'Mohammad', 'Fitzgerald', 'P.O. Box 361, 9527 Est, Road', 55559),
('b6010c22-2e6a-11ee-9ce9-309c239d41f8', 'Gareth', 'Larson', 'Ap #759-4641 Nec, Av.', 89151),
('b601e319-2e6a-11ee-9ce9-309c239d41f8', 'Imani', 'Jacobson', '207-6088 Erat. Road', 13061),
('b602b668-2e6a-11ee-9ce9-309c239d41f8', 'Shad', 'Mercado', 'P.O. Box 714, 5245 Metus Street', 13094),
('b60390a5-2e6a-11ee-9ce9-309c239d41f8', 'Candice', 'Mooney', '3556 Eget, St.', 68875),
('b6045aaa-2e6a-11ee-9ce9-309c239d41f8', 'Zia', 'Montoya', 'Ap #703-1715 Semper. St.', 18431),
('b60586ef-2e6a-11ee-9ce9-309c239d41f8', 'Abraham', 'Gibbs', '5649 Tincidunt Rd.', 36792),
('b6067a35-2e6a-11ee-9ce9-309c239d41f8', 'Lacy', 'Mcconnell', 'Ap #485-6743 Egestas St.', 20240),
('b607abc1-2e6a-11ee-9ce9-309c239d41f8', 'Willow', 'Knight', 'P.O. Box 802, 5248 Quisque St.', 8651),
('b6088f27-2e6a-11ee-9ce9-309c239d41f8', 'Plato', 'Sims', 'Ap #770-1235 Erat, Rd.', 32776),
('b6099fa2-2e6a-11ee-9ce9-309c239d41f8', 'Rashad', 'Gilmore', '5929 Donec Avenue', 57551),
('b60a9a5b-2e6a-11ee-9ce9-309c239d41f8', 'Mia', 'Luna', '191-6155 Eu Ave', 88136),
('b60b8008-2e6a-11ee-9ce9-309c239d41f8', 'Randall', 'Franks', 'P.O. Box 715, 395 Scelerisque Ave', 42714),
('b60cde21-2e6a-11ee-9ce9-309c239d41f8', 'Willa', 'Wolf', '676-8843 At Avenue', 27818),
('b60de664-2e6a-11ee-9ce9-309c239d41f8', 'Colby', 'Vinson', '475-9256 Quam St.', 77882),
('b60f4157-2e6a-11ee-9ce9-309c239d41f8', 'Zelda', 'Aguilar', '3738 Curae Rd.', 55400),
('b61073a8-2e6a-11ee-9ce9-309c239d41f8', 'Walter', 'Garcia', '9743 Eleifend Rd.', 90303),
('b6121bb3-2e6a-11ee-9ce9-309c239d41f8', 'Samuel', 'Waters', '419-2912 Scelerisque St.', 31464),
('b6131935-2e6a-11ee-9ce9-309c239d41f8', 'Ariana', 'Barlow', '765-6542 Suspendisse Ave', 57524),
('b6141612-2e6a-11ee-9ce9-309c239d41f8', 'Shafira', 'Yang', 'Ap #838-9244 Auctor Rd.', 21201),
('b61528ab-2e6a-11ee-9ce9-309c239d41f8', 'Reece', 'Smith', '1899 Fusce Av.', 53704),
('b6163a1d-2e6a-11ee-9ce9-309c239d41f8', 'Daniel', 'Daniels', 'P.O. Box 733, 7138 Tortor. Av.', 45159),
('b6174bf4-2e6a-11ee-9ce9-309c239d41f8', 'Aimee', 'Lott', 'Ap #894-6460 Ultrices Av.', 15012),
('b6189cb4-2e6a-11ee-9ce9-309c239d41f8', 'Laith', 'Roy', 'Ap #571-8071 Tempor Street', 12303),
('b6197a02-2e6a-11ee-9ce9-309c239d41f8', 'Rhoda', 'Knox', 'Ap #433-5969 Dui. St.', 68741),
('b61a6509-2e6a-11ee-9ce9-309c239d41f8', 'Jarrod', 'Hunt', 'P.O. Box 798, 6718 Aenean Road', 22118),
('b61b3d40-2e6a-11ee-9ce9-309c239d41f8', 'Fallon', 'Moses', 'P.O. Box 440, 8117 Fermentum Av.', 14430),
('b61c9aff-2e6a-11ee-9ce9-309c239d41f8', 'Quinn', 'Dalton', '207-9900 Aenean Rd.', 57472);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oder_detail`
--

CREATE TABLE `oder_detail` (
  `id` varchar(36) NOT NULL,
  `client_id` varchar(36) NOT NULL COMMENT 'Cliente al que pertecene o quien realizo el pedido',
  `order_date` datetime NOT NULL COMMENT 'Fecha en la que fue realizado el pedido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Detalles de las Ordenes (Pedidos), de nuestros clientes';

--
-- Volcado de datos para la tabla `oder_detail`
--

INSERT INTO `oder_detail` (`id`, `client_id`, `order_date`) VALUES
('ab833cec-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2022-08-18 06:17:47'),
('ab843f5c-2e6b-11ee-9ce9-309c239d41f8', 'b5fcc742-2e6a-11ee-9ce9-309c239d41f8', '2023-07-02 14:04:00'),
('ab854704-2e6b-11ee-9ce9-309c239d41f8', 'b5eecda8-2e6a-11ee-9ce9-309c239d41f8', '2023-10-30 10:17:25'),
('ab8613fb-2e6b-11ee-9ce9-309c239d41f8', 'b60f4157-2e6a-11ee-9ce9-309c239d41f8', '2022-10-13 19:21:44'),
('ab8726f6-2e6b-11ee-9ce9-309c239d41f8', 'b6189cb4-2e6a-11ee-9ce9-309c239d41f8', '2023-03-30 19:08:25'),
('ab87fcd0-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2023-04-16 06:42:47'),
('ab89329a-2e6b-11ee-9ce9-309c239d41f8', 'b60f4157-2e6a-11ee-9ce9-309c239d41f8', '2022-12-22 10:23:18'),
('ab89fe1c-2e6b-11ee-9ce9-309c239d41f8', 'b5ec8320-2e6a-11ee-9ce9-309c239d41f8', '2024-01-03 07:19:17'),
('ab8ab77e-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2023-12-28 02:20:11'),
('ab8b893e-2e6b-11ee-9ce9-309c239d41f8', 'b6189cb4-2e6a-11ee-9ce9-309c239d41f8', '2024-05-18 10:38:17'),
('ab8c579f-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2022-10-26 13:49:42'),
('ab8d16da-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2022-11-24 21:59:54'),
('ab8de326-2e6b-11ee-9ce9-309c239d41f8', 'b5ec8320-2e6a-11ee-9ce9-309c239d41f8', '2023-02-02 06:41:01'),
('ab8eaf1b-2e6b-11ee-9ce9-309c239d41f8', 'b5ec8320-2e6a-11ee-9ce9-309c239d41f8', '2023-07-22 18:17:50'),
('ab8f6c0f-2e6b-11ee-9ce9-309c239d41f8', 'b60f4157-2e6a-11ee-9ce9-309c239d41f8', '2023-10-17 04:40:37'),
('ab90614f-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2023-05-02 06:09:13'),
('ab911d32-2e6b-11ee-9ce9-309c239d41f8', 'b5fcc742-2e6a-11ee-9ce9-309c239d41f8', '2022-10-25 14:38:35'),
('ab91f5ea-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2023-04-01 23:04:16'),
('ab92ca9e-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2024-06-19 09:06:03'),
('ab9398dd-2e6b-11ee-9ce9-309c239d41f8', 'b6189cb4-2e6a-11ee-9ce9-309c239d41f8', '2024-06-30 07:07:28'),
('ab946ab0-2e6b-11ee-9ce9-309c239d41f8', 'b5fcc742-2e6a-11ee-9ce9-309c239d41f8', '2023-10-11 04:56:05'),
('ab9528e7-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2024-03-09 02:23:55'),
('ab95f88b-2e6b-11ee-9ce9-309c239d41f8', 'b5fcc742-2e6a-11ee-9ce9-309c239d41f8', '2023-06-02 11:47:31'),
('ab96b14d-2e6b-11ee-9ce9-309c239d41f8', 'b60f4157-2e6a-11ee-9ce9-309c239d41f8', '2023-11-22 16:01:56'),
('ab979968-2e6b-11ee-9ce9-309c239d41f8', 'b6189cb4-2e6a-11ee-9ce9-309c239d41f8', '2022-09-19 02:17:20'),
('ab9867d8-2e6b-11ee-9ce9-309c239d41f8', 'b60f4157-2e6a-11ee-9ce9-309c239d41f8', '2024-01-15 03:54:57'),
('ab994029-2e6b-11ee-9ce9-309c239d41f8', 'b60f4157-2e6a-11ee-9ce9-309c239d41f8', '2022-07-30 09:35:04'),
('ab9a146d-2e6b-11ee-9ce9-309c239d41f8', 'b5eecda8-2e6a-11ee-9ce9-309c239d41f8', '2023-09-27 06:02:03'),
('ab9af00a-2e6b-11ee-9ce9-309c239d41f8', 'b5fcc742-2e6a-11ee-9ce9-309c239d41f8', '2023-10-18 12:40:11'),
('ab9bcbb8-2e6b-11ee-9ce9-309c239d41f8', 'b6189cb4-2e6a-11ee-9ce9-309c239d41f8', '2023-06-23 12:58:40'),
('ab9d3aab-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2022-08-23 12:49:30'),
('ab9e2922-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2024-01-26 08:27:25'),
('ab9f1023-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2023-10-07 09:00:02'),
('aba000e3-2e6b-11ee-9ce9-309c239d41f8', 'b60f4157-2e6a-11ee-9ce9-309c239d41f8', '2024-01-06 00:49:09'),
('aba12067-2e6b-11ee-9ce9-309c239d41f8', 'b5ec8320-2e6a-11ee-9ce9-309c239d41f8', '2022-09-13 02:15:16'),
('aba229e1-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2024-02-12 03:14:18'),
('aba3059b-2e6b-11ee-9ce9-309c239d41f8', 'b5ec8320-2e6a-11ee-9ce9-309c239d41f8', '2023-10-04 20:30:43'),
('aba416af-2e6b-11ee-9ce9-309c239d41f8', 'b5fcc742-2e6a-11ee-9ce9-309c239d41f8', '2023-09-19 17:20:47'),
('aba533d0-2e6b-11ee-9ce9-309c239d41f8', 'b6189cb4-2e6a-11ee-9ce9-309c239d41f8', '2024-03-20 18:32:10'),
('aba6225f-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2023-06-12 08:29:31'),
('aba72bca-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2024-05-15 19:48:12'),
('aba8268e-2e6b-11ee-9ce9-309c239d41f8', 'b5ec8320-2e6a-11ee-9ce9-309c239d41f8', '2022-12-19 00:49:56'),
('aba9608e-2e6b-11ee-9ce9-309c239d41f8', 'b5eecda8-2e6a-11ee-9ce9-309c239d41f8', '2022-12-23 21:51:58'),
('abaa649d-2e6b-11ee-9ce9-309c239d41f8', 'b60f4157-2e6a-11ee-9ce9-309c239d41f8', '2023-10-11 07:46:45'),
('abab1177-2e6b-11ee-9ce9-309c239d41f8', 'b6189cb4-2e6a-11ee-9ce9-309c239d41f8', '2023-08-16 04:37:17'),
('ababa8c8-2e6b-11ee-9ce9-309c239d41f8', 'b607abc1-2e6a-11ee-9ce9-309c239d41f8', '2024-03-16 19:17:54'),
('abac65dc-2e6b-11ee-9ce9-309c239d41f8', 'b60f4157-2e6a-11ee-9ce9-309c239d41f8', '2022-11-20 20:48:00'),
('abad35bd-2e6b-11ee-9ce9-309c239d41f8', 'b5fcc742-2e6a-11ee-9ce9-309c239d41f8', '2023-06-18 07:08:35'),
('abae0450-2e6b-11ee-9ce9-309c239d41f8', 'b5fcc742-2e6a-11ee-9ce9-309c239d41f8', '2024-06-21 17:47:14'),
('abaec885-2e6b-11ee-9ce9-309c239d41f8', 'b5ec8320-2e6a-11ee-9ce9-309c239d41f8', '2022-08-07 19:48:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_product`
--

CREATE TABLE `order_product` (
  `id` varchar(36) NOT NULL COMMENT 'Identificador único de la relación',
  `order_id` varchar(36) NOT NULL COMMENT 'Orden de la cual es parte la relación',
  `product_id` varchar(36) NOT NULL COMMENT 'Producto del cual es parte la relación',
  `quantity` int(10) UNSIGNED NOT NULL COMMENT 'Cantidad de productos agregados a la orden',
  `discount` double(3,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT 'Porcentaje de descuento entendiendo que 0.1 es equivalente a 10% de decuento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla de relación entre una orden y los productos que incluye';

--
-- Volcado de datos para la tabla `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `quantity`, `discount`) VALUES
('8443cb35-2e6e-11ee-9ce9-309c239d41f8', 'ab9af00a-2e6b-11ee-9ce9-309c239d41f8', 'eb59de41-2e6c-11ee-9ce9-309c239d41f8', 19, 0.27),
('84450852-2e6e-11ee-9ce9-309c239d41f8', 'ab91f5ea-2e6b-11ee-9ce9-309c239d41f8', 'eb5eedc5-2e6c-11ee-9ce9-309c239d41f8', 15, 0.40),
('8445cb80-2e6e-11ee-9ce9-309c239d41f8', 'ab8de326-2e6b-11ee-9ce9-309c239d41f8', 'eb59de41-2e6c-11ee-9ce9-309c239d41f8', 20, 0.22),
('8446d82c-2e6e-11ee-9ce9-309c239d41f8', 'aba8268e-2e6b-11ee-9ce9-309c239d41f8', 'eb43a016-2e6c-11ee-9ce9-309c239d41f8', 19, 0.30),
('8447be69-2e6e-11ee-9ce9-309c239d41f8', 'ab843f5c-2e6b-11ee-9ce9-309c239d41f8', 'eb460ada-2e6c-11ee-9ce9-309c239d41f8', 13, 0.42),
('844883ea-2e6e-11ee-9ce9-309c239d41f8', 'abab1177-2e6b-11ee-9ce9-309c239d41f8', 'eb46e91d-2e6c-11ee-9ce9-309c239d41f8', 12, 0.16),
('84497085-2e6e-11ee-9ce9-309c239d41f8', 'ab8ab77e-2e6b-11ee-9ce9-309c239d41f8', 'eb492937-2e6c-11ee-9ce9-309c239d41f8', 16, 0.20),
('844a31db-2e6e-11ee-9ce9-309c239d41f8', 'ab90614f-2e6b-11ee-9ce9-309c239d41f8', 'eb43a016-2e6c-11ee-9ce9-309c239d41f8', 15, 0.79),
('844b0777-2e6e-11ee-9ce9-309c239d41f8', 'ababa8c8-2e6b-11ee-9ce9-309c239d41f8', 'eb4063cd-2e6c-11ee-9ce9-309c239d41f8', 20, 0.59),
('844bcf72-2e6e-11ee-9ce9-309c239d41f8', 'ab9af00a-2e6b-11ee-9ce9-309c239d41f8', 'eb539929-2e6c-11ee-9ce9-309c239d41f8', 13, 0.66),
('844c9c03-2e6e-11ee-9ce9-309c239d41f8', 'abac65dc-2e6b-11ee-9ce9-309c239d41f8', 'eb386a9f-2e6c-11ee-9ce9-309c239d41f8', 16, 0.81),
('844d50d8-2e6e-11ee-9ce9-309c239d41f8', 'ab9bcbb8-2e6b-11ee-9ce9-309c239d41f8', 'eb5d5cf9-2e6c-11ee-9ce9-309c239d41f8', 19, 0.93),
('844e06da-2e6e-11ee-9ce9-309c239d41f8', 'ababa8c8-2e6b-11ee-9ce9-309c239d41f8', 'eb5c8223-2e6c-11ee-9ce9-309c239d41f8', 19, 0.51),
('844ec75d-2e6e-11ee-9ce9-309c239d41f8', 'ab8613fb-2e6b-11ee-9ce9-309c239d41f8', 'eb4c61f2-2e6c-11ee-9ce9-309c239d41f8', 7, 0.19),
('844f79da-2e6e-11ee-9ce9-309c239d41f8', 'ab9af00a-2e6b-11ee-9ce9-309c239d41f8', 'eb546b7e-2e6c-11ee-9ce9-309c239d41f8', 2, 0.20),
('84507226-2e6e-11ee-9ce9-309c239d41f8', 'aba9608e-2e6b-11ee-9ce9-309c239d41f8', 'eb3d4dc5-2e6c-11ee-9ce9-309c239d41f8', 5, 0.47),
('84514d08-2e6e-11ee-9ce9-309c239d41f8', 'ab9d3aab-2e6b-11ee-9ce9-309c239d41f8', 'eb52d95f-2e6c-11ee-9ce9-309c239d41f8', 22, 0.40),
('84520819-2e6e-11ee-9ce9-309c239d41f8', 'aba3059b-2e6b-11ee-9ce9-309c239d41f8', 'eb3e4adb-2e6c-11ee-9ce9-309c239d41f8', 25, 0.51),
('8452b200-2e6e-11ee-9ce9-309c239d41f8', 'aba9608e-2e6b-11ee-9ce9-309c239d41f8', 'eb43a016-2e6c-11ee-9ce9-309c239d41f8', 12, 0.89),
('84536822-2e6e-11ee-9ce9-309c239d41f8', 'ab9af00a-2e6b-11ee-9ce9-309c239d41f8', 'eb4d3ab9-2e6c-11ee-9ce9-309c239d41f8', 1, 0.77),
('84540367-2e6e-11ee-9ce9-309c239d41f8', 'ab90614f-2e6b-11ee-9ce9-309c239d41f8', 'eb55527f-2e6c-11ee-9ce9-309c239d41f8', 16, 0.71),
('84549c6e-2e6e-11ee-9ce9-309c239d41f8', 'ab854704-2e6b-11ee-9ce9-309c239d41f8', 'eb49f653-2e6c-11ee-9ce9-309c239d41f8', 12, 0.66),
('8455481a-2e6e-11ee-9ce9-309c239d41f8', 'ab8b893e-2e6b-11ee-9ce9-309c239d41f8', 'eb5214b0-2e6c-11ee-9ce9-309c239d41f8', 24, 0.02),
('8455ef7d-2e6e-11ee-9ce9-309c239d41f8', 'ab994029-2e6b-11ee-9ce9-309c239d41f8', 'eb56d507-2e6c-11ee-9ce9-309c239d41f8', 9, 0.78),
('8456a99c-2e6e-11ee-9ce9-309c239d41f8', 'ab8de326-2e6b-11ee-9ce9-309c239d41f8', 'eb386a9f-2e6c-11ee-9ce9-309c239d41f8', 4, 0.89),
('845746d0-2e6e-11ee-9ce9-309c239d41f8', 'aba72bca-2e6b-11ee-9ce9-309c239d41f8', 'eb49f653-2e6c-11ee-9ce9-309c239d41f8', 4, 0.78),
('84581537-2e6e-11ee-9ce9-309c239d41f8', 'aba12067-2e6b-11ee-9ce9-309c239d41f8', 'eb4b979c-2e6c-11ee-9ce9-309c239d41f8', 2, 0.08),
('8458cdaa-2e6e-11ee-9ce9-309c239d41f8', 'abaa649d-2e6b-11ee-9ce9-309c239d41f8', 'eb5eedc5-2e6c-11ee-9ce9-309c239d41f8', 18, 0.04),
('8459731b-2e6e-11ee-9ce9-309c239d41f8', 'ab9528e7-2e6b-11ee-9ce9-309c239d41f8', 'eb4b979c-2e6c-11ee-9ce9-309c239d41f8', 14, 0.25),
('845a376b-2e6e-11ee-9ce9-309c239d41f8', 'aba416af-2e6b-11ee-9ce9-309c239d41f8', 'eb42bf23-2e6c-11ee-9ce9-309c239d41f8', 1, 0.24),
('845b29a6-2e6e-11ee-9ce9-309c239d41f8', 'ab96b14d-2e6b-11ee-9ce9-309c239d41f8', 'eb486bf3-2e6c-11ee-9ce9-309c239d41f8', 14, 0.76),
('845bf92a-2e6e-11ee-9ce9-309c239d41f8', 'ab8ab77e-2e6b-11ee-9ce9-309c239d41f8', 'eb59de41-2e6c-11ee-9ce9-309c239d41f8', 3, 0.12),
('845cdb5d-2e6e-11ee-9ce9-309c239d41f8', 'ab946ab0-2e6b-11ee-9ce9-309c239d41f8', 'eb3d4dc5-2e6c-11ee-9ce9-309c239d41f8', 9, 0.28),
('845dae46-2e6e-11ee-9ce9-309c239d41f8', 'abaec885-2e6b-11ee-9ce9-309c239d41f8', 'eb446628-2e6c-11ee-9ce9-309c239d41f8', 2, 0.15),
('845e721a-2e6e-11ee-9ce9-309c239d41f8', 'aba9608e-2e6b-11ee-9ce9-309c239d41f8', 'eb59de41-2e6c-11ee-9ce9-309c239d41f8', 4, 0.74),
('845f1fdf-2e6e-11ee-9ce9-309c239d41f8', 'aba6225f-2e6b-11ee-9ce9-309c239d41f8', 'eb5214b0-2e6c-11ee-9ce9-309c239d41f8', 24, 0.24),
('8460230d-2e6e-11ee-9ce9-309c239d41f8', 'ab95f88b-2e6b-11ee-9ce9-309c239d41f8', 'eb52d95f-2e6c-11ee-9ce9-309c239d41f8', 1, 0.82),
('846114be-2e6e-11ee-9ce9-309c239d41f8', 'ab8de326-2e6b-11ee-9ce9-309c239d41f8', 'eb5214b0-2e6c-11ee-9ce9-309c239d41f8', 9, 0.29),
('84621be3-2e6e-11ee-9ce9-309c239d41f8', 'aba72bca-2e6b-11ee-9ce9-309c239d41f8', 'eb5214b0-2e6c-11ee-9ce9-309c239d41f8', 23, 0.06),
('8462fd29-2e6e-11ee-9ce9-309c239d41f8', 'aba229e1-2e6b-11ee-9ce9-309c239d41f8', 'eb4534f0-2e6c-11ee-9ce9-309c239d41f8', 16, 0.28),
('8463cb83-2e6e-11ee-9ce9-309c239d41f8', 'ab911d32-2e6b-11ee-9ce9-309c239d41f8', 'eb507d3a-2e6c-11ee-9ce9-309c239d41f8', 4, 0.35),
('8464dafb-2e6e-11ee-9ce9-309c239d41f8', 'ab9e2922-2e6b-11ee-9ce9-309c239d41f8', 'eb46e91d-2e6c-11ee-9ce9-309c239d41f8', 2, 0.20),
('84669eaf-2e6e-11ee-9ce9-309c239d41f8', 'aba6225f-2e6b-11ee-9ce9-309c239d41f8', 'eb47ab6d-2e6c-11ee-9ce9-309c239d41f8', 7, 0.85),
('8467b153-2e6e-11ee-9ce9-309c239d41f8', 'ababa8c8-2e6b-11ee-9ce9-309c239d41f8', 'eb43a016-2e6c-11ee-9ce9-309c239d41f8', 5, 0.05),
('8468e7f1-2e6e-11ee-9ce9-309c239d41f8', 'ab8de326-2e6b-11ee-9ce9-309c239d41f8', 'eb59de41-2e6c-11ee-9ce9-309c239d41f8', 1, 0.76),
('8469bb2b-2e6e-11ee-9ce9-309c239d41f8', 'abac65dc-2e6b-11ee-9ce9-309c239d41f8', 'eb592695-2e6c-11ee-9ce9-309c239d41f8', 15, 0.66),
('846ab5a9-2e6e-11ee-9ce9-309c239d41f8', 'aba72bca-2e6b-11ee-9ce9-309c239d41f8', 'eb52d95f-2e6c-11ee-9ce9-309c239d41f8', 15, 0.50),
('846ba270-2e6e-11ee-9ce9-309c239d41f8', 'aba3059b-2e6b-11ee-9ce9-309c239d41f8', 'eb3c6e04-2e6c-11ee-9ce9-309c239d41f8', 6, 0.76),
('846c6ed0-2e6e-11ee-9ce9-309c239d41f8', 'ab9bcbb8-2e6b-11ee-9ce9-309c239d41f8', 'eb592695-2e6c-11ee-9ce9-309c239d41f8', 7, 0.83),
('846d8713-2e6e-11ee-9ce9-309c239d41f8', 'aba9608e-2e6b-11ee-9ce9-309c239d41f8', 'eb4ef2be-2e6c-11ee-9ce9-309c239d41f8', 21, 0.10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` varchar(36) NOT NULL COMMENT 'Identificador único del producto',
  `name` varchar(140) NOT NULL COMMENT 'Nombre del Producto',
  `price` double(5,2) NOT NULL COMMENT 'Precio del producto',
  `category_id` varchar(36) NOT NULL COMMENT 'Categoría del Producto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla de Productos';

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `category_id`) VALUES
('eb386a9f-2e6c-11ee-9ce9-309c239d41f8', 'Juice - Orange', 26.76, '83c1e2ba-2e69-11ee-9ce9-309c239d41f8'),
('eb395e0c-2e6c-11ee-9ce9-309c239d41f8', 'General Purpose Trigger', 79.48, '83c52961-2e69-11ee-9ce9-309c239d41f8'),
('eb3ad5b9-2e6c-11ee-9ce9-309c239d41f8', 'Cookie Trail Mix', 2.44, '83bf8bda-2e69-11ee-9ce9-309c239d41f8'),
('eb3b8bd4-2e6c-11ee-9ce9-309c239d41f8', 'Beef - Cooked, Corned', 11.57, '83c1e2ba-2e69-11ee-9ce9-309c239d41f8'),
('eb3c6e04-2e6c-11ee-9ce9-309c239d41f8', 'Parsley Italian - Fresh', 73.67, '83c10505-2e69-11ee-9ce9-309c239d41f8'),
('eb3d4dc5-2e6c-11ee-9ce9-309c239d41f8', 'Shrimp - Black Tiger 6 - 8', 74.37, '83c52961-2e69-11ee-9ce9-309c239d41f8'),
('eb3e4adb-2e6c-11ee-9ce9-309c239d41f8', 'Cleaner - Pine Sol', 91.10, '83c29b79-2e69-11ee-9ce9-309c239d41f8'),
('eb3f5a50-2e6c-11ee-9ce9-309c239d41f8', 'Ice Cream Bar - Oreo Sandwich', 51.12, '83c10505-2e69-11ee-9ce9-309c239d41f8'),
('eb4063cd-2e6c-11ee-9ce9-309c239d41f8', 'Nut - Hazelnut, Whole', 51.97, '83c1e2ba-2e69-11ee-9ce9-309c239d41f8'),
('eb41a951-2e6c-11ee-9ce9-309c239d41f8', 'Cheese - Victor Et Berthold', 25.95, '83c1e2ba-2e69-11ee-9ce9-309c239d41f8'),
('eb42bf23-2e6c-11ee-9ce9-309c239d41f8', 'Walkers Special Old Whiskey', 81.14, '83c52961-2e69-11ee-9ce9-309c239d41f8'),
('eb43a016-2e6c-11ee-9ce9-309c239d41f8', 'Sesame Seed Black', 29.99, '83c52961-2e69-11ee-9ce9-309c239d41f8'),
('eb446628-2e6c-11ee-9ce9-309c239d41f8', 'Tea - Grapefruit Green Tea', 41.42, '83c3b540-2e69-11ee-9ce9-309c239d41f8'),
('eb4534f0-2e6c-11ee-9ce9-309c239d41f8', 'Kiwi', 44.98, '83c10505-2e69-11ee-9ce9-309c239d41f8'),
('eb460ada-2e6c-11ee-9ce9-309c239d41f8', 'Bread Cranberry Foccacia', 53.29, '83c29b79-2e69-11ee-9ce9-309c239d41f8'),
('eb46e91d-2e6c-11ee-9ce9-309c239d41f8', 'Cucumber - English', 79.22, '83c3b540-2e69-11ee-9ce9-309c239d41f8'),
('eb47ab6d-2e6c-11ee-9ce9-309c239d41f8', 'Bagels Poppyseed', 37.39, '83c52961-2e69-11ee-9ce9-309c239d41f8'),
('eb486bf3-2e6c-11ee-9ce9-309c239d41f8', 'Wine - Baron De Rothschild', 29.37, '83c52961-2e69-11ee-9ce9-309c239d41f8'),
('eb492937-2e6c-11ee-9ce9-309c239d41f8', 'Lettuce - Curly Endive', 95.55, '83c1e2ba-2e69-11ee-9ce9-309c239d41f8'),
('eb49f653-2e6c-11ee-9ce9-309c239d41f8', 'Tea - Herbal - 6 Asst', 18.02, '83c1e2ba-2e69-11ee-9ce9-309c239d41f8'),
('eb4abf5f-2e6c-11ee-9ce9-309c239d41f8', 'Curry Paste - Green Masala', 33.30, '83bf8bda-2e69-11ee-9ce9-309c239d41f8'),
('eb4b979c-2e6c-11ee-9ce9-309c239d41f8', 'Campari', 78.05, '83c3b540-2e69-11ee-9ce9-309c239d41f8'),
('eb4c61f2-2e6c-11ee-9ce9-309c239d41f8', 'Beef - Flank Steak', 66.43, '83bf8bda-2e69-11ee-9ce9-309c239d41f8'),
('eb4d3ab9-2e6c-11ee-9ce9-309c239d41f8', 'Juice - Orange, Concentrate', 89.08, '83c29b79-2e69-11ee-9ce9-309c239d41f8'),
('eb4e11e7-2e6c-11ee-9ce9-309c239d41f8', 'Wine - Valpolicella Masi', 24.66, '83c46fa7-2e69-11ee-9ce9-309c239d41f8'),
('eb4ef2be-2e6c-11ee-9ce9-309c239d41f8', 'Pears - Anjou', 5.56, '83c52961-2e69-11ee-9ce9-309c239d41f8'),
('eb4fc179-2e6c-11ee-9ce9-309c239d41f8', 'Pear - Asian', 42.13, '83c1e2ba-2e69-11ee-9ce9-309c239d41f8'),
('eb507d3a-2e6c-11ee-9ce9-309c239d41f8', 'Gatorade - Lemon Lime', 59.03, '83c29b79-2e69-11ee-9ce9-309c239d41f8'),
('eb51460b-2e6c-11ee-9ce9-309c239d41f8', 'Vinegar - Cider', 80.70, '83c52961-2e69-11ee-9ce9-309c239d41f8'),
('eb5214b0-2e6c-11ee-9ce9-309c239d41f8', 'Pork - Bacon Cooked Slcd', 35.01, '83c52961-2e69-11ee-9ce9-309c239d41f8'),
('eb52d95f-2e6c-11ee-9ce9-309c239d41f8', 'Bread - Rolls, Rye', 24.33, '83c3b540-2e69-11ee-9ce9-309c239d41f8'),
('eb539929-2e6c-11ee-9ce9-309c239d41f8', 'Wood Chips - Regular', 50.89, '83c3b540-2e69-11ee-9ce9-309c239d41f8'),
('eb546b7e-2e6c-11ee-9ce9-309c239d41f8', 'Compound - Strawberry', 96.75, '83c46fa7-2e69-11ee-9ce9-309c239d41f8'),
('eb55527f-2e6c-11ee-9ce9-309c239d41f8', 'Muffin - Mix - Bran And Maple 15l', 68.55, '83c46fa7-2e69-11ee-9ce9-309c239d41f8'),
('eb561cf9-2e6c-11ee-9ce9-309c239d41f8', 'Carrots - Mini, Stem On', 62.57, '83c46fa7-2e69-11ee-9ce9-309c239d41f8'),
('eb56d507-2e6c-11ee-9ce9-309c239d41f8', 'Wine - Charddonnay Errazuriz', 22.44, '83c29b79-2e69-11ee-9ce9-309c239d41f8'),
('eb57876e-2e6c-11ee-9ce9-309c239d41f8', 'Sauce - Thousand Island', 32.75, '83c46fa7-2e69-11ee-9ce9-309c239d41f8'),
('eb584aa1-2e6c-11ee-9ce9-309c239d41f8', 'Container Clear 8 Oz', 46.18, '83bf8bda-2e69-11ee-9ce9-309c239d41f8'),
('eb592695-2e6c-11ee-9ce9-309c239d41f8', 'Mayonnaise - Individual Pkg', 46.75, '83bf8bda-2e69-11ee-9ce9-309c239d41f8'),
('eb59de41-2e6c-11ee-9ce9-309c239d41f8', 'Lamb - Loin Chops', 80.35, '83c46fa7-2e69-11ee-9ce9-309c239d41f8'),
('eb5ad066-2e6c-11ee-9ce9-309c239d41f8', 'Soup - Campbells Beef Noodle', 21.09, '83c1e2ba-2e69-11ee-9ce9-309c239d41f8'),
('eb5b9e33-2e6c-11ee-9ce9-309c239d41f8', 'Dried Apple', 80.57, '83c52961-2e69-11ee-9ce9-309c239d41f8'),
('eb5c8223-2e6c-11ee-9ce9-309c239d41f8', 'Syrup - Monin - Granny Smith', 86.57, '83c1e2ba-2e69-11ee-9ce9-309c239d41f8'),
('eb5d5cf9-2e6c-11ee-9ce9-309c239d41f8', 'Cumin - Ground', 71.43, '83c1e2ba-2e69-11ee-9ce9-309c239d41f8'),
('eb5e320d-2e6c-11ee-9ce9-309c239d41f8', 'Cheese - Sheep Milk', 77.74, '83c1e2ba-2e69-11ee-9ce9-309c239d41f8'),
('eb5eedc5-2e6c-11ee-9ce9-309c239d41f8', 'Peas - Frozen', 22.08, '83c10505-2e69-11ee-9ce9-309c239d41f8'),
('eb5fb199-2e6c-11ee-9ce9-309c239d41f8', 'Cheese - Le Cru Du Clocher', 96.80, '83bf8bda-2e69-11ee-9ce9-309c239d41f8'),
('eb606c5d-2e6c-11ee-9ce9-309c239d41f8', 'Nantucket Orange Juice', 22.49, '83c3b540-2e69-11ee-9ce9-309c239d41f8'),
('eb612913-2e6c-11ee-9ce9-309c239d41f8', 'Hog / Sausage Casing - Pork', 75.04, '83bf8bda-2e69-11ee-9ce9-309c239d41f8'),
('eb62050c-2e6c-11ee-9ce9-309c239d41f8', 'Wood Chips - Regular', 88.12, '83bf8bda-2e69-11ee-9ce9-309c239d41f8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `system_role`
--

CREATE TABLE `system_role` (
  `id` varchar(36) NOT NULL COMMENT 'Identificador único del rol de usuario',
  `access` text DEFAULT NULL COMMENT 'Lista de permisos otorgados para el rol'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Roles de usuario para el Back Office';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `system_user`
--

CREATE TABLE `system_user` (
  `id` varchar(36) NOT NULL COMMENT 'Identificador único del usuario',
  `user_name` varchar(140) NOT NULL COMMENT 'Nombre de usuario para acceso',
  `password` text NOT NULL,
  `role` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla de usuarios registrados a tener acceso al Back Office';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oder_detail`
--
ALTER TABLE `oder_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oder_details_client_client_id_fk` (`client_id`);

--
-- Indices de la tabla `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_oder_details_order_details_id_fk` (`order_id`),
  ADD KEY `order_products_product_product_id_fk` (`product_id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_category_id_fk2` (`category_id`);

--
-- Indices de la tabla `system_role`
--
ALTER TABLE `system_role`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `system_user`
--
ALTER TABLE `system_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `system_user_system_role_role_id_fk` (`role`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `oder_detail`
--
ALTER TABLE `oder_detail`
  ADD CONSTRAINT `oder_details_client_client_id_fk` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);

--
-- Filtros para la tabla `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_products_oder_details_order_details_id_fk` FOREIGN KEY (`order_id`) REFERENCES `oder_detail` (`id`),
  ADD CONSTRAINT `order_products_product_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_category_category_id_fk2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Filtros para la tabla `system_user`
--
ALTER TABLE `system_user`
  ADD CONSTRAINT `system_user_system_role_role_id_fk` FOREIGN KEY (`role`) REFERENCES `system_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
