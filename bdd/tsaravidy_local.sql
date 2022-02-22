-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 24 jan. 2022 à 12:30
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tsaravidy_local`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dimension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_bc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_livraison` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_paiement` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `user`, `numero_bc`, `date_livraison`, `date_paiement`, `description`, `status`, `created_at`, `updated_at`) VALUES
(14, 'TSARAVIDY STANDARD', '001', '2021-12-30 21:00:00', '2021-12-30 21:00:00', NULL, 0, '2021-11-15 08:28:57', '2022-01-24 07:22:49'),
(15, 'TSARAVIDY P50', '002', '2021-12-31 00:00:00', '2021-12-31 00:00:00', NULL, 0, '2021-11-15 08:37:11', '2021-11-15 08:37:11'),
(16, 'TSARAVIDY RECUPERATION', 'X', '2021-12-31 00:00:00', '2021-12-31 00:00:00', 'UTILISATION DU MORTIER EN CAS DE PANNE DE MACHINE', 0, '2021-11-15 08:46:11', '2021-11-15 08:46:11'),
(17, 'TSARAVIDY PALETTE', '03', '2021-12-31 00:00:00', '2021-12-31 00:00:00', NULL, 0, '2021-11-17 10:45:59', '2021-11-17 10:45:59');

-- --------------------------------------------------------

--
-- Structure de la table `depenses`
--

DROP TABLE IF EXISTS `depenses`;
CREATE TABLE IF NOT EXISTS `depenses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unite` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_bl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fournisseur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantite` double DEFAULT NULL,
  `pu` double DEFAULT NULL,
  `montant` double DEFAULT NULL,
  `frais_livraison` double DEFAULT NULL,
  `mode_paiement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'comptant',
  `montant_credit` double NOT NULL DEFAULT '0',
  `date_credit` timestamp NULL DEFAULT NULL,
  `commentaire` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formules`
--

DROP TABLE IF EXISTS `formules`;
CREATE TABLE IF NOT EXISTS `formules` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dimension` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `cout_essence` double DEFAULT NULL,
  `cout_salarial` double DEFAULT NULL,
  `cout_livraison` double DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formules`
--

INSERT INTO `formules` (`id`, `name`, `dimension`, `quantite`, `cout_essence`, `cout_salarial`, `cout_livraison`, `description`, `created_at`, `updated_at`) VALUES
(6, 'PARPAING DE 15/50 MACHINE', NULL, 28, 15, 200, 140, 'temps de prise 48h', '2021-04-28 20:31:01', '2022-01-24 06:44:23'),
(7, 'PARPAING DE 10 STANDARD', NULL, 50, 15, 200, 140, NULL, '2021-04-28 20:31:41', '2022-01-24 06:44:42'),
(8, 'PARPAING DE 15 STANDARD', NULL, 40, 15, 200, 140, NULL, '2021-04-28 20:32:05', '2022-01-24 06:44:53'),
(9, 'PARPAING DE 20 STANDARD', NULL, 30, 15, 200, 140, NULL, '2021-04-28 20:32:45', '2022-01-24 06:45:03'),
(10, 'PARPAING DE 20/50 MACHINE', NULL, 20, 15, 200, 140, NULL, '2021-07-12 14:54:05', '2022-01-24 06:45:15'),
(11, 'PARPAING 15P40', NULL, 28, 15, 200, 140, NULL, '2021-11-17 10:03:18', '2022-01-24 06:45:23'),
(12, 'PARPAING 20P40', NULL, 24, 15, 200, 140, NULL, '2021-11-17 10:03:37', '2022-01-24 06:45:39');

-- --------------------------------------------------------

--
-- Structure de la table `formule_produits`
--

DROP TABLE IF EXISTS `formule_produits`;
CREATE TABLE IF NOT EXISTS `formule_produits` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `formule_id` bigint(20) UNSIGNED NOT NULL,
  `matiere_id` bigint(20) UNSIGNED NOT NULL,
  `valeur` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formule_produits`
--

INSERT INTO `formule_produits` (`id`, `formule_id`, `matiere_id`, `valeur`, `created_at`, `updated_at`) VALUES
(19, 6, 9, 0.18, '2021-04-28 20:34:11', '2021-11-17 10:00:57'),
(20, 6, 10, 0.045, '2021-04-28 20:35:06', '2021-11-17 10:01:05'),
(21, 7, 8, 1, '2021-04-28 20:35:25', '2021-04-28 20:35:25'),
(22, 7, 9, 0.21, '2021-04-28 20:35:58', '2021-04-28 20:35:58'),
(23, 7, 10, 0.07, '2021-04-28 20:36:20', '2021-04-28 20:36:20'),
(24, 8, 8, 1, '2021-04-28 20:36:33', '2021-04-28 20:36:33'),
(25, 8, 9, 0.21, '2021-04-28 20:36:51', '2021-04-28 20:36:51'),
(26, 8, 10, 0.07, '2021-04-28 20:37:01', '2021-04-28 20:37:01'),
(27, 9, 8, 1, '2021-04-28 20:37:21', '2021-04-28 20:37:21'),
(28, 9, 9, 0.21, '2021-04-28 20:37:30', '2021-04-28 20:37:30'),
(29, 9, 10, 0.07, '2021-04-28 20:37:48', '2021-04-28 20:37:48'),
(30, 6, 8, 1, '2021-04-28 20:46:10', '2021-04-28 20:46:10'),
(31, 10, 8, 1, '2021-07-12 14:54:23', '2021-07-12 14:54:23'),
(32, 10, 9, 0.18, '2021-07-12 14:54:36', '2021-11-17 10:02:07'),
(33, 10, 10, 0.045, '2021-07-12 14:54:49', '2021-11-17 10:02:13'),
(34, 11, 8, 1, '2021-11-17 10:04:11', '2021-11-17 10:04:11'),
(35, 11, 9, 0.18, '2021-11-17 10:04:21', '2021-11-17 10:04:21'),
(36, 11, 10, 0.045, '2021-11-17 10:04:30', '2021-11-17 10:04:30'),
(37, 12, 8, 1, '2021-11-17 10:04:54', '2021-11-17 10:04:54'),
(38, 12, 9, 0.18, '2021-11-17 10:05:03', '2021-11-17 10:05:03'),
(39, 12, 10, 0.045, '2021-11-17 10:05:11', '2021-11-17 10:05:11');

-- --------------------------------------------------------

--
-- Structure de la table `livraisons`
--

DROP TABLE IF EXISTS `livraisons`;
CREATE TABLE IF NOT EXISTS `livraisons` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `numero_bl` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` double NOT NULL,
  `date_livraison` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `commentaire` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livraisons`
--

INSERT INTO `livraisons` (`id`, `produit_id`, `numero_bl`, `quantite`, `date_livraison`, `commentaire`, `created_at`, `updated_at`) VALUES
(59, 31, 'A15', 240, '2021-08-05 23:00:00', 'SOVACOM', '2021-11-16 15:22:23', '2021-11-16 15:22:23'),
(60, 31, 'A16', 400, '2021-08-08 23:00:00', 'SOVACOM', '2021-11-16 15:22:52', '2021-11-16 15:22:52'),
(61, 31, 'A26', 280, '2021-08-15 23:00:00', 'SOVACOM', '2021-11-16 15:23:20', '2021-11-16 15:23:20'),
(62, 31, 'A26', 320, '2021-08-18 23:00:00', 'SOVACOM', '2021-11-16 15:23:59', '2021-11-16 15:23:59'),
(63, 31, 'A28', 67, '2021-08-19 23:00:00', 'SOVACOM', '2021-11-16 15:25:22', '2021-11-16 15:25:22'),
(64, 31, 'A33', 410, '2021-08-22 23:00:00', 'SOVACOM', '2021-11-16 15:30:55', '2021-11-16 15:30:55'),
(65, 31, 'A38', 400, '2021-08-26 23:00:00', 'SOVACOM', '2021-11-16 15:31:38', '2021-11-16 15:31:38'),
(66, 31, 'A42', 440, '2021-08-31 23:00:00', 'SOVACOM', '2021-11-16 15:32:18', '2021-11-16 15:32:18'),
(67, 31, 'BL0180921', 440, '2021-09-08 23:00:00', 'SOVACOM', '2021-11-16 15:32:51', '2021-11-16 15:32:51'),
(68, 31, 'BL0200921', 400, '2021-09-09 23:00:00', 'SOVACOM', '2021-11-16 15:33:19', '2021-11-16 15:33:19'),
(69, 31, 'BL0280921', 520, '2021-09-13 23:00:00', 'SOVACOM', '2021-11-17 08:59:46', '2021-11-17 09:06:53'),
(70, 31, 'BL0430921', 400, '2021-09-19 23:00:00', 'SOVACOM', '2021-11-17 09:03:13', '2021-11-17 09:03:13'),
(71, 31, 'BL0540921', 440, '2021-09-20 23:00:00', 'SOVACOM', '2021-11-17 09:04:09', '2021-11-17 09:04:09'),
(72, 31, 'BL0610921', 400, '2021-09-21 23:00:00', 'SOVACOM', '2021-11-17 09:07:35', '2021-11-17 09:07:35'),
(73, 31, 'BL0391021', 440, '2021-10-04 23:00:00', 'SOVACOM', '2021-11-17 09:08:15', '2021-11-17 09:08:15'),
(74, 31, 'BL0591021', 500, '2021-10-15 23:00:00', 'MR HOUZEFA', '2021-11-17 09:08:52', '2021-11-17 09:08:52'),
(75, 31, 'BL0721021', 100, '2021-10-19 23:00:00', 'CLT MAG MME LEONIE', '2021-11-17 09:09:30', '2021-11-17 09:09:30'),
(76, 31, 'BL0751021', 500, '2021-10-19 23:00:00', 'MR HOUZEFA', '2021-11-17 09:10:03', '2021-11-17 09:10:03'),
(77, 31, 'BL0011121', 450, '2021-10-28 23:00:00', 'MR HOUZEFA', '2021-11-17 09:10:29', '2021-11-17 09:10:29'),
(78, 30, 'BL0691021', 250, '2021-10-18 23:00:00', 'SMCM', '2021-11-17 09:12:03', '2021-11-17 09:12:03'),
(79, 30, 'BL0801021', 250, '2021-10-20 23:00:00', 'SMCM', '2021-11-17 09:12:32', '2021-11-17 09:12:32'),
(80, 30, 'BL0911021', 250, '2021-10-24 23:00:00', 'SMCM', '2021-11-17 09:13:12', '2021-11-17 09:13:12'),
(81, 30, 'BL1001021', 250, '2021-10-26 23:00:00', 'SMCM', '2021-11-17 09:21:49', '2021-11-17 09:21:49'),
(82, 30, 'BL0141121', 40, '2021-11-05 00:00:00', 'SMCM', '2021-11-17 09:22:17', '2021-11-17 09:22:17'),
(83, 30, 'BL0151121', 209, '2021-11-05 00:00:00', 'SMCM', '2021-11-17 09:22:36', '2021-11-17 09:22:36'),
(84, 31, 'A02', 610, '2021-07-27 23:00:00', 'SOVACOM', '2021-11-17 09:24:20', '2021-11-17 09:24:20'),
(86, 26, 'A30', 56, '2021-08-22 23:00:00', 'NS ENTREPRISE', '2021-11-17 09:45:43', '2021-11-17 09:45:43'),
(87, 26, 'A32', 95, '2021-08-23 23:00:00', 'NS ENTREPRISE', '2021-11-17 09:46:10', '2021-11-17 09:46:10'),
(88, 26, 'A35', 250, '2021-08-25 23:00:00', 'NS ENTREPRISE', '2021-11-17 09:46:35', '2021-11-17 09:46:35'),
(89, 26, 'A41', 10, '2021-08-29 23:00:00', 'NS ENTREPRISE', '2021-11-17 09:47:02', '2021-11-17 09:47:02'),
(90, 26, 'A43', 100, '2021-09-01 23:00:00', 'NS ENTREPRISE', '2021-11-17 09:47:30', '2021-11-17 09:47:30'),
(91, 26, 'BL0160921', 205, '2021-09-08 23:00:00', 'SMCM', '2021-11-17 09:47:58', '2021-11-17 09:47:58'),
(92, 26, 'BL0150921', 200, '2021-09-08 23:00:00', 'NS ENTREPRISE', '2021-11-17 09:48:46', '2021-11-17 09:48:46'),
(93, 26, 'BL0390921', 40, '2021-09-17 23:00:00', 'NS ENTREPRISE', '2021-11-17 09:49:29', '2021-11-17 09:49:29'),
(94, 26, 'BL0480921', 25, '2021-09-21 23:00:00', 'NS ENTREPRISE', '2021-11-17 09:50:31', '2021-11-17 09:50:31'),
(95, 26, 'BL0530921', 50, '2021-09-21 23:00:00', 'MR NAHIM', '2021-11-17 09:51:46', '2021-11-17 09:51:46'),
(96, 26, 'BL0580921', 32, '2021-09-22 23:00:00', 'MR NAHIM', '2021-11-17 09:52:43', '2021-11-17 09:52:43'),
(97, 26, 'BL0431021', 60, '2021-10-10 23:00:00', 'NS ENTREPRISE', '2021-11-17 09:56:56', '2021-11-17 09:56:56'),
(98, 26, 'BL0141121', 102, '2021-11-05 00:00:00', 'SMCM', '2021-11-17 09:57:30', '2021-11-17 09:57:30'),
(99, 26, 'BL0391121', 120, '2021-11-11 00:00:00', 'Q DAVIDE', '2021-11-17 09:58:03', '2021-11-17 09:58:03'),
(100, 27, 'A01', 200, '2021-07-27 23:00:00', 'NS ENTREPRISE', '2021-11-17 09:59:49', '2021-11-17 09:59:49'),
(101, 27, 'A04', 200, '2021-07-29 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:06:40', '2021-11-17 10:06:40'),
(102, 27, 'A07', 200, '2021-08-01 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:07:06', '2021-11-17 10:07:06'),
(103, 27, 'A09', 200, '2021-08-01 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:07:36', '2021-11-17 10:07:36'),
(104, 27, 'A12/A13', 400, '2021-08-04 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:08:09', '2021-11-17 10:08:09'),
(105, 27, 'A17', 200, '2021-08-08 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:08:29', '2021-11-17 10:08:29'),
(106, 27, 'A20', 760, '2021-08-10 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:08:49', '2021-11-17 10:08:49'),
(107, 27, 'A21', 440, '2021-08-15 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:09:11', '2021-11-17 10:09:11'),
(108, 27, 'A22', 480, '2021-08-15 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:09:32', '2021-11-17 10:09:32'),
(109, 27, 'A29', 550, '2021-08-20 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:09:54', '2021-11-17 10:09:54'),
(110, 27, 'A34', 159, '2021-08-24 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:10:16', '2021-11-17 10:10:16'),
(111, 27, 'A37', 150, '2021-08-26 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:10:49', '2021-11-17 10:10:49'),
(112, 27, 'A39', 210, '2021-08-27 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:11:33', '2021-11-17 10:11:33'),
(113, 27, 'A40', 40, '2021-08-29 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:12:03', '2021-11-17 10:12:03'),
(114, 27, 'BL0020921', 390, '2021-09-01 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:12:26', '2021-11-17 10:12:26'),
(115, 27, 'BL0050921', 156, '2021-09-04 23:00:00', 'SMCM', '2021-11-17 10:13:04', '2021-11-17 10:13:04'),
(116, 27, 'BL0050921', 167, '2021-09-03 23:00:00', 'SMCM', '2021-11-17 10:13:31', '2021-11-17 10:13:31'),
(117, 27, 'BL0020921', 90, '2021-09-06 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:14:09', '2021-11-17 10:14:09'),
(118, 27, 'BL0020921', 120, '2021-09-07 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:14:28', '2021-11-17 10:14:28'),
(119, 27, 'BL0020921', 200, '2021-09-08 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:15:00', '2021-11-17 10:15:00'),
(120, 27, 'BL0160921', 170, '2021-09-09 23:00:00', 'SMCM', '2021-11-17 10:15:34', '2021-11-17 10:15:34'),
(121, 27, 'BL0020921', 150, '2021-09-09 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:15:59', '2021-11-17 10:15:59'),
(122, 27, 'BL0270921', 150, '2021-09-13 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:16:24', '2021-11-17 10:16:24'),
(123, 27, 'BL0270921', 290, '2021-09-14 23:00:00', 'NS ENTREPRISE', '2021-11-17 10:16:48', '2021-11-17 10:16:48'),
(124, 27, 'BL0530921', 150, '2021-09-21 23:00:00', 'MR NAHIM', '2021-11-17 10:17:17', '2021-11-17 10:17:17'),
(125, 27, 'BL0530921', 60, '2021-09-24 23:00:00', 'MR NAHIM', '2021-11-17 10:17:45', '2021-11-17 10:17:45'),
(126, 27, 'BL0760921', 26, '2021-09-28 23:00:00', 'SMCM', '2021-11-17 10:18:11', '2021-11-17 10:18:11'),
(127, 27, 'BL0091021', 800, '2021-10-03 23:00:00', 'MR HOUZEFA', '2021-11-17 10:18:39', '2021-11-17 10:18:39'),
(128, 27, 'BL0931021', 200, '2021-10-25 23:00:00', 'MAGASIN VAOVAO', '2021-11-17 10:19:21', '2021-11-17 10:19:21'),
(129, 28, 'A19', 40, '2021-08-10 23:00:00', 'SMCM', '2021-11-17 10:41:51', '2021-11-17 10:41:51'),
(130, 28, 'A23', 130, '2021-08-15 23:00:00', 'SMCM', '2021-11-17 10:42:23', '2021-11-17 10:42:23'),
(131, 28, 'A36', 20, '2021-08-26 23:00:00', 'SMCM', '2021-11-17 10:42:44', '2021-11-17 10:42:44'),
(132, 36, 'BL0421021', 500, '2021-10-10 23:00:00', 'MR HOUZEFA', '2021-11-17 10:54:22', '2021-11-17 10:54:22'),
(133, 35, 'BL0430921', 220, '2021-09-20 23:00:00', 'MR HOUZEFA', '2021-11-17 10:58:15', '2021-11-17 10:58:15'),
(134, 35, 'A001', 120, '2021-09-24 23:00:00', 'AMPASIMAZAVA', '2021-11-17 10:59:57', '2021-11-17 10:59:57'),
(135, 35, 'BL0541121', 450, '2021-11-16 00:00:00', 'AMAZON', '2021-11-17 11:03:50', '2021-11-17 11:03:50'),
(136, 35, '002', 130, '2021-09-21 23:00:00', NULL, '2021-11-17 11:17:51', '2021-11-17 11:17:51'),
(137, 35, '003', 110, '2021-09-22 23:00:00', NULL, '2021-11-17 11:18:09', '2021-11-17 11:18:09'),
(138, 35, '004', 130, '2021-09-23 23:00:00', NULL, '2021-11-17 11:18:34', '2021-11-17 11:18:34'),
(139, 35, '005', 61, '2021-09-24 23:00:00', NULL, '2021-11-17 11:18:57', '2021-11-17 11:18:57'),
(140, 35, '006', 72, '2021-09-28 23:00:00', NULL, '2021-11-17 11:19:22', '2021-11-17 11:19:22'),
(141, 31, 'BL0581121', 920, '2021-11-19 00:00:00', 'PROMOLUX', '2021-11-18 08:38:57', '2021-12-08 08:38:31'),
(142, 31, 'BL0871121', 600, '2021-11-23 00:00:00', 'MR HOUZEFA', '2021-11-23 08:17:28', '2021-11-23 08:17:28'),
(143, 26, 'BL0881121', 145, '2021-11-23 00:00:00', 'SMCM', '2021-11-23 08:23:47', '2021-11-23 08:23:47'),
(144, 26, 'BL1041121', 225, '2021-11-27 00:00:00', 'SMCM', '2021-11-29 12:49:40', '2021-11-29 12:49:40'),
(145, 26, 'BL1051121', 100, '2021-11-27 00:00:00', 'NS ENTREPRISE', '2021-11-29 12:50:12', '2021-11-29 12:50:12'),
(146, 30, 'BL1161121', 400, '2021-11-30 00:00:00', 'MR HOUZEFA', '2021-11-30 08:52:36', '2021-11-30 08:52:36'),
(147, 31, 'BL1161121', 400, '2021-11-30 00:00:00', 'MR HOUZEFA', '2021-11-30 08:53:33', '2021-11-30 08:53:33'),
(148, 31, 'BL1151121', 1000, '2021-11-30 00:00:00', 'MR ELIOTE', '2021-11-30 08:54:02', '2021-11-30 08:54:02'),
(149, 26, 'BL0031221', 30, '2021-12-01 00:00:00', 'NS ENTREPRISE', '2021-12-01 14:37:25', '2021-12-01 14:37:25'),
(150, 26, 'BL0151221', 150, '2021-12-06 00:00:00', 'smcm', '2021-12-06 16:19:21', '2021-12-06 16:19:21'),
(151, 31, 'BL0021221', 400, '2021-12-06 00:00:00', 'mr eliote', '2021-12-06 16:20:35', '2021-12-08 08:38:03'),
(152, 31, 'BL0281221', 300, '2021-12-07 00:00:00', 'SOVACOM', '2021-12-08 08:27:01', '2021-12-08 08:27:01'),
(153, 30, 'BL1101121', 600, '2021-11-29 00:00:00', 'MR HOUZEFA', '2021-12-08 08:28:49', '2021-12-08 08:28:49'),
(154, 30, 'BL0271221', 1000, '2021-12-08 00:00:00', 'PROMOLUX', '2021-12-08 08:29:15', '2021-12-08 08:29:15'),
(155, 31, 'BL0481221', 1000, '2021-12-10 00:00:00', 'MR ELIOTE', '2021-12-10 15:36:18', '2021-12-10 15:36:18'),
(156, 31, 'BL0631221', 600, '2021-12-14 00:00:00', 'MR HOUZEFA', '2021-12-15 08:05:18', '2021-12-15 08:05:18'),
(157, 35, 'BL0641221', 60, '2021-12-14 00:00:00', 'AMAZON', '2021-12-15 08:05:55', '2021-12-15 08:05:55'),
(158, 31, 'BL0661221', 400, '2021-12-15 00:00:00', 'MR HOUZEFA', '2021-12-15 08:53:12', '2021-12-15 08:53:12'),
(159, 31, 'BL0671221', 600, '2021-12-15 00:00:00', 'MR ELIOTE', '2021-12-15 08:53:43', '2021-12-15 08:53:43'),
(160, 31, 'BL0911221', 400, '2021-12-20 00:00:00', 'MR HOUZEFA', '2021-12-20 12:13:13', '2021-12-20 12:13:13'),
(161, 26, 'BL0751221', 800, '2021-12-17 00:00:00', 'SMCM', '2021-12-20 12:13:47', '2021-12-20 12:13:47'),
(162, 28, 'BL0761221', 132, '2021-12-17 00:00:00', 'SMCM', '2021-12-20 12:14:29', '2021-12-20 12:14:29'),
(163, 31, 'BL0921221', 409, '2021-12-18 00:00:00', 'SOVACOM', '2021-12-20 12:17:59', '2021-12-20 12:17:59'),
(164, 31, 'BL0941221', 400, '2021-12-21 00:00:00', 'mr houzefa', '2021-12-21 08:13:41', '2021-12-21 08:13:41'),
(165, 31, 'BL0951221', 240, '2021-12-20 00:00:00', 'SOVACOM', '2021-12-21 09:45:05', '2021-12-21 09:45:05'),
(166, 31, 'BL1011221', 200, '2021-12-22 00:00:00', 'MR HOUZEFA', '2021-12-22 12:24:45', '2021-12-22 12:24:45'),
(167, 30, 'BL1121221', 116, '2021-12-23 00:00:00', 'PROMOLUX', '2021-12-23 13:23:14', '2021-12-23 13:23:14'),
(168, 28, 'BL1121221', 234, '2021-12-23 00:00:00', 'PROMOLUX', '2021-12-23 13:23:41', '2021-12-23 13:23:41'),
(169, 31, 'BL1151221', 200, '2021-12-24 00:00:00', 'MR HOUZEFA', '2022-01-04 10:21:18', '2022-01-04 10:21:18'),
(170, 31, 'BL0030122', 400, '2022-01-04 00:00:00', 'MR HOUZEFA', '2022-01-04 10:21:42', '2022-01-04 10:21:42'),
(171, 31, 'BL0140122', 200, '2022-01-06 00:00:00', 'MR ELIOTE', '2022-01-06 08:08:00', '2022-01-06 08:08:00'),
(172, 31, 'BL0430122', 440, '2022-01-10 00:00:00', 'SOVACOM', '2022-01-12 15:12:15', '2022-01-12 15:12:15'),
(173, 31, 'BL0440122', 400, '2022-01-10 00:00:00', 'MR HOUZEFA', '2022-01-12 15:13:04', '2022-01-12 15:13:04'),
(174, 31, 'BL0450122', 400, '2022-01-11 00:00:00', 'SOVACOM', '2022-01-12 15:13:36', '2022-01-12 15:13:36'),
(175, 31, 'BL0460122', 400, '2022-01-11 00:00:00', 'MR HOUZEFA', '2022-01-12 15:14:04', '2022-01-12 15:14:04'),
(176, 31, 'BL0470122', 80, '2022-01-12 00:00:00', 'SOVACOM', '2022-01-12 15:14:40', '2022-01-12 15:14:40'),
(177, 31, 'BL0480122', 400, '2022-01-12 00:00:00', 'MR ELIOTE', '2022-01-12 15:15:19', '2022-01-12 15:15:19'),
(178, 26, 'BL0660122', 280, '2022-01-17 00:00:00', 'smcm', '2022-01-18 08:31:27', '2022-01-18 08:31:27'),
(179, 31, 'BL0740122', 400, '2022-01-18 00:00:00', 'MR ELIOTE', '2022-01-18 08:35:47', '2022-01-18 08:35:47'),
(180, 31, 'BL0750122', 200, '2022-01-18 00:00:00', 'MR HOUZEFA', '2022-01-18 09:34:10', '2022-01-18 09:34:10'),
(181, 27, 'BL A MAIN', 200, '2022-01-04 00:00:00', 'MR CHRISTOPHE', '2022-01-18 09:55:21', '2022-01-18 09:55:21'),
(182, 27, 'BL0760122', 2000, '2022-01-16 00:00:00', 'MR LALA', '2022-01-18 09:55:56', '2022-01-18 09:55:56'),
(184, 31, 'BL0820122', 200, '2022-01-19 00:00:00', 'mr houzefa', '2022-01-19 08:59:03', '2022-01-19 08:59:03'),
(185, 31, 'BL0870122', 410, '2022-01-18 00:00:00', 'SOVACOM', '2022-01-20 15:05:58', '2022-01-20 15:05:58'),
(186, 31, 'BL0880122', 200, '2022-01-19 00:00:00', 'SOVACOM', '2022-01-20 15:06:32', '2022-01-20 15:06:32');

-- --------------------------------------------------------

--
-- Structure de la table `loyers`
--

DROP TABLE IF EXISTS `loyers`;
CREATE TABLE IF NOT EXISTS `loyers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `montant` double NOT NULL,
  `date_debut` timestamp NULL DEFAULT NULL,
  `date_fin` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `loyers`
--

INSERT INTO `loyers` (`id`, `montant`, `date_debut`, `date_fin`, `created_at`, `updated_at`) VALUES
(3, 2500000, '2021-11-30 21:00:00', NULL, '2022-01-24 11:33:01', '2021-11-24 11:33:01');

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

DROP TABLE IF EXISTS `matieres`;
CREATE TABLE IF NOT EXISTS `matieres` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unite` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `matieres`
--

INSERT INTO `matieres` (`id`, `name`, `unite`, `description`, `created_at`, `updated_at`) VALUES
(8, 'ciment pour parpaing', 'Sac', 'lucky ciment cpa 42,5', '2021-04-28 15:02:58', '2021-04-28 16:01:16'),
(9, 'Sable de rivière', 'm3', 'grosse graine', '2021-04-28 15:03:22', '2021-04-28 15:03:22'),
(10, 'Sable fin', 'm3', 'poudre', '2021-04-28 15:03:45', '2021-04-28 15:03:45');

-- --------------------------------------------------------

--
-- Structure de la table `matiere_premieres`
--

DROP TABLE IF EXISTS `matiere_premieres`;
CREATE TABLE IF NOT EXISTS `matiere_premieres` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `matiere_id` bigint(20) UNSIGNED NOT NULL,
  `numero_bl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fournisseur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantite` double NOT NULL,
  `quantite_dispo` double NOT NULL,
  `pu` double NOT NULL,
  `montant` double NOT NULL,
  `frais_livraison` double NOT NULL DEFAULT '0',
  `mode_paiement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'comptant',
  `montant_credit` double NOT NULL DEFAULT '0',
  `date_credit` timestamp NULL DEFAULT NULL,
  `commentaire` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_facture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `matiere_premieres`
--

INSERT INTO `matiere_premieres` (`id`, `matiere_id`, `numero_bl`, `fournisseur`, `quantite`, `quantite_dispo`, `pu`, `montant`, `frais_livraison`, `mode_paiement`, `montant_credit`, `date_credit`, `commentaire`, `numero_facture`, `status`, `created_at`, `updated_at`) VALUES
(42, 8, '27/07/21', 'NS ENTREPRISE', 129, 0, 29000, 3741000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:05:12', '2021-11-15 14:47:00'),
(43, 8, '09/08/21', 'NS ENTREPRISE', 12, 0, 29000, 348000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:05:48', '2021-11-15 14:48:05'),
(44, 8, '17/08/21', 'NS ENTREPRISE', 22, 0, 29000, 638000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:06:36', '2021-11-15 14:50:07'),
(45, 8, '21/08/21', 'NS ENTREPRISE', 25, 0, 29000, 725000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:07:07', '2021-11-15 14:51:28'),
(46, 8, '25/08/21', 'NS ENTREPRISE', 25, 0, 29000, 725000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:07:33', '2021-11-15 14:53:20'),
(47, 8, '27/08/21', 'NS ENTREPRISE', 25, 0, 29000, 725000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:08:28', '2021-11-15 14:57:44'),
(48, 8, '1852 DU 1/9/21', 'NS ENTREPRISE', 640, 0, 29000, 18560000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:09:58', '2021-11-29 12:51:14'),
(49, 8, '2028 DU 4/9/21', 'NS ENTREPRISE', 640, 84, 29000, 18560000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:10:21', '2022-01-18 09:54:06'),
(50, 9, '26/04/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:19:40', '2021-11-30 12:06:27'),
(51, 10, '26/04/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:20:32', '2021-11-30 12:24:41'),
(52, 9, '22/06/2021', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:29:30', '2021-11-30 12:16:54'),
(53, 10, '29/07/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:30:09', '2021-11-30 12:24:49'),
(54, 10, '22/06/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:30:45', '2021-11-30 12:24:56'),
(55, 9, '30/06/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:32:47', '2021-11-30 12:17:50'),
(56, 9, '14/07/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:33:30', '2021-11-30 12:18:01'),
(57, 9, '15/07/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:34:00', '2021-11-30 12:18:12'),
(58, 9, '16/06/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:35:16', '2021-11-30 12:18:23'),
(59, 10, '21/07/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:35:54', '2021-11-30 12:25:04'),
(60, 10, '03/04/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:38:16', '2021-11-30 12:25:14'),
(61, 10, '3/4/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:38:42', '2021-12-01 11:01:51'),
(62, 10, '30/3/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:39:15', '2021-12-13 11:10:03'),
(63, 9, '30/3/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:40:49', '2021-11-30 12:18:33'),
(64, 9, '30/3/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:41:20', '2021-11-30 12:18:44'),
(65, 9, '9/4/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:41:48', '2021-11-30 12:18:54'),
(66, 9, '24/4/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:42:16', '2021-11-30 12:19:06'),
(67, 9, '24/4/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:42:38', '2021-11-30 12:19:19'),
(68, 9, '24/4/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:43:03', '2021-11-30 12:19:31'),
(69, 9, '10/08/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:48:16', '2021-11-30 12:19:42'),
(70, 9, '10/08/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:48:48', '2021-11-30 12:19:53'),
(71, 10, '21/8/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:49:19', '2022-01-12 14:47:44'),
(72, 10, '31/8/21', 'DADOU', 10, 2.7550000000000043, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:50:31', '2022-01-18 09:54:06'),
(73, 9, '25/8/21', 'DADOU', 20, 0, 18000, 360000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:51:00', '2021-11-30 12:20:05'),
(74, 9, '06/09/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:57:05', '2021-11-30 12:20:17'),
(75, 9, '07/09/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:57:25', '2021-11-30 12:20:28'),
(76, 10, '08/09/21', 'DADOU', 10, 10, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:57:53', '2021-11-30 12:26:35'),
(77, 9, '16/09/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:58:21', '2021-12-01 11:01:51'),
(78, 9, '17/09/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 10:58:47', '2021-12-06 16:17:57'),
(79, 10, '17/09/21', 'DADOU', 10, 10, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 11:01:45', '2021-11-30 12:26:48'),
(80, 9, '25/09/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 11:03:43', '2021-12-08 08:34:19'),
(81, 9, '27/09/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 11:04:26', '2021-12-10 15:33:25'),
(82, 10, '27/09/21', 'DADOU', 10, 10, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 11:04:53', '2021-11-30 12:26:59'),
(83, 10, '07/10/21', 'DADOU', 10, 10, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 11:06:00', '2021-11-30 12:27:53'),
(84, 9, '06/10/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 11:06:32', '2021-12-15 08:11:44'),
(85, 9, '06/10/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 11:06:57', '2021-12-20 09:56:11'),
(86, 9, '16/10/21', 'DADOU', 20, 0, 18000, 360000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 11:09:10', '2022-01-12 14:46:16'),
(87, 10, '16/10/21', 'DADOU', 10, 10, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 11:09:39', '2021-11-30 12:28:05'),
(88, 10, '29/10/21', 'DADOU', 10, 0.299999999999999, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 11:10:55', '2021-11-30 12:28:33'),
(89, 9, '30/10/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 11:11:22', '2022-01-18 09:20:23'),
(90, 9, '28/10/21', 'DADOU', 10, 0, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-15 11:11:44', '2022-01-18 09:32:32'),
(91, 9, '37', 'DADOU', 10, 1.2400000000000249, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-17 08:45:10', '2022-01-18 09:54:06'),
(92, 9, '38', 'DADOU', 10, 11.47, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-17 08:45:32', '2021-12-08 11:03:36'),
(93, 10, '38', 'DADOU', 10, 10.49, 18000, 180000, 0, 'comptant', 0, NULL, NULL, NULL, 0, '2021-11-17 08:45:54', '2021-12-08 11:03:36'),
(94, 9, 'BLN°47', 'DADOU', 20, 20, 18000, 360001, 1, 'comptant', 0, NULL, NULL, NULL, 0, '2022-01-18 10:08:22', '2022-01-18 10:10:17'),
(95, 10, 'BLN°47', 'DADOU', 20, 20, 18000, 360001, 1, 'comptant', 0, NULL, NULL, NULL, 0, '2022-01-18 10:09:17', '2022-01-18 10:09:51');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_02_17_113231_create_productions_table', 1),
(4, '2021_02_17_113306_create_matiere_premieres_table', 1),
(5, '2021_02_17_113327_create_commandes_table', 1),
(6, '2021_02_17_113347_create_depenses_table', 1),
(7, '2021_02_17_113402_create_ventes_table', 1),
(8, '2021_02_17_113510_create_produits_table', 1),
(9, '2021_02_17_113545_create_formules_table', 1),
(10, '2021_02_18_111356_create_categories_table', 1),
(11, '2021_02_18_112757_create_formule_produits_table', 1),
(12, '2021_03_02_160505_create_matieres_table', 1),
(13, '2021_04_22_174845_create_livraisons_table', 2),
(14, '2021_04_23_082029_add_revient_to_productions', 2);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `productions`
--

DROP TABLE IF EXISTS `productions`;
CREATE TABLE IF NOT EXISTS `productions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `nombre_cycle` double NOT NULL,
  `quantite` double NOT NULL,
  `nombre_casse` int(11) NOT NULL DEFAULT '0',
  `date_available` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_production` timestamp NULL DEFAULT NULL,
  `revient` double DEFAULT NULL,
  `commentaire` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=379 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `productions`
--

INSERT INTO `productions` (`id`, `produit_id`, `nombre_cycle`, `quantite`, `nombre_casse`, `date_available`, `date_production`, `revient`, `commentaire`, `created_at`, `updated_at`) VALUES
(141, 27, 4, 161, 0, '2021-01-24 07:32:54', '2021-07-27 21:00:00', 1060.71, NULL, '2021-11-15 14:32:09', '2022-01-24 07:32:54'),
(142, 27, 5, 205, 0, '2021-01-24 07:33:00', '2021-07-29 21:00:00', 1045.24, NULL, '2021-11-15 14:32:35', '2022-01-24 07:33:00'),
(143, 27, 10, 405, 0, '2021-01-24 07:33:07', '2021-08-01 21:00:00', 1055.49, NULL, '2021-11-15 14:34:05', '2022-01-24 07:33:07'),
(144, 27, 6, 241, 0, '2021-01-24 07:33:13', '2021-08-04 21:00:00', 1062.47, NULL, '2021-11-15 14:34:36', '2022-01-24 07:33:13'),
(145, 27, 2, 78, 0, '2021-01-24 07:33:22', '2021-08-05 21:00:00', 1087.82, NULL, '2021-11-15 14:35:14', '2022-01-24 07:33:22'),
(146, 27, 6, 240, 0, '2021-01-24 07:33:28', '2021-08-06 21:00:00', 1066, NULL, '2021-11-15 14:35:45', '2022-01-24 07:33:28'),
(147, 27, 6, 243, 0, '2021-01-24 07:33:33', '2021-08-09 21:00:00', 1055.49, NULL, '2021-11-15 14:36:14', '2022-01-24 07:33:33'),
(148, 27, 5, 209, 0, '2021-01-24 07:33:43', '2021-08-11 21:00:00', 1029.35, NULL, '2021-11-15 14:36:45', '2022-01-24 07:33:43'),
(149, 27, 5, 200, 0, '2021-01-24 07:33:51', '2021-08-12 21:00:00', 1066, NULL, '2021-11-15 14:37:10', '2022-01-24 07:33:51'),
(150, 27, 6, 165, 0, '2021-01-24 07:00:00', '2021-08-13 21:00:00', 1452.82, NULL, '2021-11-15 14:37:40', '2022-01-24 07:34:04'),
(151, 27, 9, 246, 0, '2021-01-24 07:34:09', '2021-08-15 21:00:00', 1460.37, NULL, '2021-11-15 14:38:08', '2022-01-24 07:34:09'),
(152, 27, 8, 209, 0, '2021-01-24 07:34:17', '2021-08-16 21:00:00', 1517.97, NULL, '2021-11-15 14:39:40', '2022-01-24 07:34:17'),
(153, 27, 6, 246, 0, '2021-01-24 07:34:25', '2021-08-24 21:00:00', 1045.24, NULL, '2021-11-15 14:41:19', '2022-01-24 07:34:25'),
(154, 27, 4, 162, 0, '2021-01-24 07:34:33', '2021-08-25 21:00:00', 1055.49, NULL, '2021-11-15 14:41:47', '2022-01-24 07:34:33'),
(155, 27, 5, 170, 0, '2021-01-24 07:34:40', '2021-08-26 21:00:00', 1216.18, NULL, '2021-11-15 14:42:12', '2022-01-24 07:34:40'),
(156, 27, 2, 86, 0, '2021-01-24 07:34:45', '2021-08-27 21:00:00', 1006.63, NULL, '2021-11-15 14:42:32', '2022-01-24 07:34:45'),
(157, 27, 5, 206, 0, '2021-01-24 07:34:53', '2021-08-29 21:00:00', 1041.21, NULL, '2021-11-15 14:42:54', '2022-01-24 07:34:53'),
(158, 27, 4, 167, 0, '2021-01-24 07:35:01', '2021-08-31 21:00:00', 1030.33, NULL, '2021-11-15 14:43:25', '2022-01-24 07:35:01'),
(159, 27, 6, 243, 0, '2021-01-24 07:35:07', '2021-09-02 21:00:00', 1055.49, NULL, '2021-11-15 14:43:48', '2022-01-24 07:35:07'),
(160, 27, 6, 212, 0, '2021-01-24 07:35:14', '2021-09-05 21:00:00', 1178.4, NULL, '2021-11-15 14:44:10', '2022-01-24 07:35:14'),
(161, 27, 4, 160, 0, '2021-01-24 07:35:21', '2021-09-06 21:00:00', 1066, NULL, '2021-11-15 14:45:05', '2022-01-24 07:35:21'),
(162, 27, 6, 240, 0, '2021-01-24 07:35:26', '2021-09-07 21:00:00', 1066, NULL, '2021-11-15 14:46:14', '2022-01-24 07:35:26'),
(163, 27, 6, 250, 0, '2021-01-24 07:35:38', '2021-09-08 21:00:00', 1031.96, NULL, '2021-11-15 14:46:37', '2022-01-24 07:35:38'),
(164, 27, 4, 167, 0, '2021-01-24 07:35:44', '2021-09-09 21:00:00', 1030.33, NULL, '2021-11-15 14:47:00', '2022-01-24 07:35:44'),
(165, 27, 2, 82, 0, '2021-01-24 07:35:49', '2021-09-10 21:00:00', 1045.24, NULL, '2021-11-15 14:47:21', '2022-01-24 07:35:49'),
(166, 27, 6, 246, 0, '2021-01-24 07:00:00', '2021-09-13 21:00:00', 1045.24, NULL, '2021-11-15 14:47:42', '2022-01-24 07:36:11'),
(167, 27, 6, 257, 0, '2021-01-24 07:36:15', '2021-09-14 21:00:00', 1009.71, NULL, '2021-11-15 14:48:05', '2022-01-24 07:36:15'),
(168, 27, 6, 317, 0, '2021-01-24 07:00:00', '2021-09-30 21:00:00', 859.29, NULL, '2021-11-15 14:49:29', '2022-01-24 07:36:27'),
(169, 27, 8, 323, 0, '2021-01-24 07:36:32', '2021-10-01 21:00:00', 1058.1, NULL, '2021-11-15 14:49:50', '2022-01-24 07:36:32'),
(170, 27, 8, 339, 0, '2021-01-24 07:36:43', '2021-10-03 21:00:00', 1018.3, NULL, '2021-11-15 14:50:07', '2022-01-24 07:36:43'),
(171, 27, 5, 206, 0, '2021-01-24 07:36:50', '2021-10-04 21:00:00', 1041.21, NULL, '2021-11-15 14:50:27', '2022-01-24 07:36:50'),
(172, 27, 8, 320, 0, '2021-01-24 07:00:00', '2021-10-05 21:00:00', 1066, NULL, '2021-11-15 14:50:43', '2022-01-24 07:37:08'),
(173, 27, 4, 216, 0, '2021-01-24 07:00:00', '2021-10-06 21:00:00', 845.37, NULL, '2021-11-15 14:51:08', '2022-01-24 07:37:28'),
(174, 27, 8, 326, 0, '2021-01-24 07:37:38', '2021-10-07 21:00:00', 1050.34, NULL, '2021-11-15 14:51:28', '2022-01-24 07:37:38'),
(175, 27, 4, 225, 0, '2021-01-24 07:00:00', '2021-10-08 21:00:00', 820.16, NULL, '2021-11-15 14:51:43', '2022-01-24 07:37:53'),
(176, 27, 5, 202, 0, '2021-01-24 07:38:00', '2021-10-10 21:00:00', 1057.57, NULL, '2021-11-15 14:52:10', '2022-01-24 07:38:00'),
(177, 27, 4, 154, 0, '2021-01-24 07:00:00', '2021-10-12 21:00:00', 1099.16, NULL, '2021-11-15 14:52:40', '2022-01-24 07:38:31'),
(178, 27, 5, 200, 0, '2021-01-24 07:38:16', '2021-10-13 21:00:00', 1066, NULL, '2021-11-15 14:53:00', '2022-01-24 07:38:16'),
(179, 27, 6, 253, 0, '2021-01-24 07:00:00', '2021-10-14 21:00:00', 1022.27, NULL, '2021-11-15 14:53:20', '2022-01-24 07:38:42'),
(180, 27, 3, 115, 0, '2021-01-24 07:00:00', '2021-10-15 21:00:00', 1103, NULL, '2021-11-15 14:53:39', '2022-01-24 07:39:09'),
(181, 27, 3, 150, 0, '2021-01-24 07:00:00', '2021-10-17 21:00:00', 895.8, NULL, '2021-11-15 14:53:56', '2022-01-24 07:39:23'),
(182, 26, 5, 253, 0, '2021-01-24 07:00:00', '2021-08-22 21:00:00', 887.73, NULL, '2021-11-15 14:56:51', '2022-01-24 07:30:27'),
(183, 26, 8, 373, 0, '2021-01-24 07:00:00', '2021-08-23 21:00:00', 945.08, NULL, '2021-11-15 14:57:13', '2022-01-24 07:30:14'),
(184, 26, 4, 205, 0, '2021-01-24 07:30:43', '2021-08-27 21:00:00', 879.2, NULL, '2021-11-15 14:57:44', '2022-01-24 07:30:43'),
(185, 26, 4, 203, 0, '2021-01-24 07:30:57', '2021-08-29 21:00:00', 885.74, NULL, '2021-11-15 14:58:11', '2022-01-24 07:30:57'),
(186, 26, 2, 103, 0, '2021-01-24 07:31:05', '2021-09-24 21:00:00', 875.97, NULL, '2021-11-15 15:00:59', '2022-01-24 07:31:05'),
(187, 26, 5, 263, 0, '2021-01-24 07:31:17', '2021-09-26 21:00:00', 862.15, NULL, '2021-11-15 15:01:43', '2022-01-24 07:31:17'),
(188, 26, 7, 344, 0, '2021-01-24 07:31:23', '2021-09-27 21:00:00', 907.67, NULL, '2021-11-15 15:02:09', '2022-01-24 07:31:23'),
(189, 26, 6, 294, 0, '2021-01-24 07:31:30', '2021-09-28 21:00:00', 909.69, NULL, '2021-11-15 15:02:32', '2022-01-24 07:31:30'),
(190, 26, 6, 293, 0, '2021-01-24 07:31:36', '2021-10-18 21:00:00', 912.06, NULL, '2021-11-15 15:03:17', '2022-01-24 07:31:36'),
(191, 26, 6, 302, 0, '2021-01-24 07:31:42', '2021-10-19 21:00:00', 891.29, NULL, '2021-11-15 15:03:40', '2022-01-24 07:31:42'),
(192, 26, 5, 255, 0, '2021-01-24 07:31:52', '2021-10-20 21:00:00', 882.45, NULL, '2021-11-15 15:03:59', '2022-01-24 07:31:52'),
(193, 28, 2, 57, 0, '2021-01-24 07:40:36', '2021-08-05 21:00:00', 1409.39, NULL, '2021-11-15 15:06:26', '2022-01-24 07:40:36'),
(194, 28, 1, 32, 0, '2021-01-24 07:40:39', '2021-08-08 21:00:00', 1278.75, NULL, '2021-11-15 15:06:53', '2022-01-24 07:40:39'),
(195, 28, 2, 58, 0, '2021-01-24 07:40:44', '2021-08-12 21:00:00', 1388.79, NULL, '2021-11-15 15:07:13', '2022-01-24 07:40:44'),
(196, 28, 3, 95, 0, '2021-01-24 07:00:00', '2021-09-01 21:00:00', 1289.95, NULL, '2021-11-15 15:07:47', '2022-01-24 07:41:03'),
(198, 31, 6, 172, 0, '2021-01-24 07:00:00', '2021-08-01 21:00:00', 1367.91, NULL, '2021-11-15 15:10:33', '2022-01-24 08:33:55'),
(199, 31, 6, 185, 0, '2021-01-24 07:46:51', '2021-08-02 21:00:00', 1286.89, NULL, '2021-11-15 15:11:04', '2022-01-24 07:46:51'),
(200, 31, 6, 185, 0, '2021-01-24 07:46:56', '2021-08-03 21:00:00', 1286.89, NULL, '2021-11-15 15:11:26', '2022-01-24 07:46:56'),
(201, 31, 6, 104, 0, '2021-01-24 07:47:08', '2021-08-04 21:00:00', 2121.73, NULL, '2021-11-15 15:11:47', '2022-01-24 07:47:08'),
(202, 31, 5, 210, 0, '2021-01-24 07:47:16', '2021-08-08 21:00:00', 1001.9, NULL, '2021-11-15 15:12:08', '2022-01-24 07:47:16'),
(203, 31, 4, 111, 0, '2021-01-24 07:00:00', '2021-08-10 21:00:00', 1405.99, NULL, '2021-11-15 15:12:26', '2022-01-24 08:35:25'),
(204, 31, 6, 177, 0, '2021-01-24 07:47:30', '2021-08-11 21:00:00', 1335.34, NULL, '2021-11-15 15:12:48', '2022-01-24 07:47:30'),
(205, 31, 4, 120, 0, '2021-01-24 07:47:37', '2021-08-12 21:00:00', 1316.67, NULL, '2021-11-15 15:13:03', '2022-01-24 07:47:37'),
(206, 31, 9, 276, 0, '2021-01-24 07:47:42', '2021-08-13 21:00:00', 1292.72, NULL, '2021-11-15 15:14:42', '2022-01-24 07:47:42'),
(207, 31, 8, 182, 0, '2021-01-24 07:47:48', '2021-08-16 21:00:00', 1667.75, NULL, '2021-11-15 15:15:12', '2022-01-24 07:47:48'),
(208, 31, 10, 178, 0, '2021-01-24 07:47:55', '2021-08-18 21:00:00', 2071.74, NULL, '2021-11-15 15:16:26', '2022-01-24 07:47:55'),
(209, 31, 4, 122, 0, '2021-01-24 07:48:01', '2021-08-19 21:00:00', 1298.61, NULL, '2021-11-15 15:16:47', '2022-01-24 07:48:01'),
(210, 31, 8, 242, 0, '2021-01-24 07:00:00', '2021-08-22 21:00:00', 1307.56, NULL, '2021-11-15 15:17:06', '2022-01-24 07:48:20'),
(211, 31, 5, 185, 0, '2021-01-24 07:48:26', '2021-08-23 21:00:00', 1108.24, NULL, '2021-11-15 15:17:22', '2022-01-24 07:48:26'),
(212, 31, 8, 247, 0, '2021-01-24 07:48:36', '2021-08-24 21:00:00', 1285.45, NULL, '2021-11-15 15:17:45', '2022-01-24 07:48:36'),
(213, 31, 6, 185, 0, '2021-01-24 07:48:43', '2021-08-25 21:00:00', 1286.89, NULL, '2021-11-15 15:18:08', '2022-01-24 07:48:43'),
(214, 31, 4, 124, 0, '2021-01-24 07:48:49', '2021-08-30 21:00:00', 1281.13, NULL, '2021-11-15 15:18:27', '2022-01-24 07:48:49'),
(215, 31, 10, 300, 0, '2021-01-24 07:00:00', '2021-08-31 21:00:00', 1316.67, NULL, '2021-11-15 15:18:48', '2022-01-24 07:54:51'),
(216, 31, 10, 291, 0, '2021-01-24 07:00:00', '2021-09-01 21:00:00', 1350.74, NULL, '2021-11-15 15:19:11', '2022-01-24 07:55:03'),
(217, 31, 10, 330, 0, '2021-01-24 07:55:20', '2021-09-02 21:00:00', 1216.52, NULL, '2021-11-15 15:19:31', '2022-01-24 07:55:20'),
(218, 31, 2, 60, 0, '2021-01-24 07:55:30', '2021-09-05 21:00:00', 1316.67, NULL, '2021-11-15 15:19:52', '2022-01-24 07:55:30'),
(219, 31, 8, 250, 0, '2021-01-24 07:00:00', '2021-09-06 21:00:00', 1272.6, NULL, '2021-11-15 15:20:13', '2022-01-24 07:55:57'),
(220, 31, 6, 190, 0, '2021-01-24 07:56:08', '2021-09-07 21:00:00', 1258.68, NULL, '2021-11-15 15:21:53', '2022-01-24 07:56:08'),
(221, 31, 10, 280, 0, '2021-01-24 07:56:15', '2021-09-09 21:00:00', 1395.36, NULL, '2021-11-15 15:22:16', '2022-01-24 07:56:15'),
(223, 31, 8, 220, 0, '2021-01-24 07:56:21', '2021-09-12 21:00:00', 1416.82, NULL, '2021-11-15 15:24:37', '2022-01-24 07:56:21'),
(224, 31, 10, 289, 0, '2021-01-24 07:00:00', '2021-09-13 21:00:00', 1358.6, NULL, '2021-11-15 15:25:19', '2022-01-24 07:57:51'),
(225, 31, 10, 240, 0, '2021-01-24 07:56:38', '2021-09-14 21:00:00', 1592.08, NULL, '2021-11-15 15:25:37', '2022-01-24 07:56:38'),
(226, 31, 4, 120, 0, '2021-01-24 07:56:44', '2021-09-15 21:00:00', 1316.67, NULL, '2021-11-15 15:25:58', '2022-01-24 07:56:44'),
(227, 31, 10, 280, 0, '2021-01-24 07:56:53', '2021-09-16 21:00:00', 1395.36, NULL, '2021-11-15 15:26:23', '2022-01-24 07:56:53'),
(228, 31, 5, 135, 0, '2021-01-24 07:57:00', '2021-09-17 21:00:00', 1439.07, NULL, '2021-11-15 15:26:46', '2022-01-24 07:57:00'),
(229, 31, 10, 310, 0, '2021-01-24 07:57:06', '2021-09-19 21:00:00', 1281.13, NULL, '2021-11-15 15:31:27', '2022-01-24 07:57:06'),
(230, 31, 5, 140, 0, '2021-01-24 07:57:13', '2021-09-20 21:00:00', 1395.36, NULL, '2021-11-15 15:31:46', '2022-01-24 07:57:13'),
(231, 31, 8, 250, 0, '2020-09-23 21:00:00', '2021-09-22 21:00:00', 1272.6, NULL, '2021-11-15 15:32:09', '2022-01-24 07:57:19'),
(232, 31, 5, 150, 0, '2020-09-24 21:00:00', '2021-09-23 21:00:00', 1316.67, NULL, '2021-11-15 15:32:24', '2022-01-24 07:58:14'),
(233, 31, 8, 242, 0, '2020-10-13 21:00:00', '2021-10-12 21:00:00', 1307.56, NULL, '2021-11-15 15:33:05', '2022-01-24 07:58:23'),
(234, 31, 6, 184, 0, '2020-11-17 04:00:00', '2021-10-13 21:00:00', 1292.72, NULL, '2021-11-15 15:34:04', '2022-01-24 07:58:32'),
(235, 31, 7, 226, 0, '2020-10-15 21:00:00', '2021-10-14 21:00:00', 1238.67, NULL, '2021-11-15 15:34:27', '2022-01-24 07:58:44'),
(236, 31, 7, 231, 0, '2020-10-16 21:00:00', '2021-10-15 21:00:00', 1216.52, NULL, '2021-11-15 15:34:46', '2022-01-24 07:58:51'),
(237, 31, 7, 226, 0, '2020-10-18 21:00:00', '2021-10-17 21:00:00', 1238.67, NULL, '2021-11-15 15:35:03', '2022-01-24 07:59:01'),
(238, 31, 4, 123, 0, '2020-11-08 21:00:00', '2021-11-07 21:00:00', 1289.8, NULL, '2021-11-15 15:35:38', '2022-01-24 07:59:06'),
(239, 31, 10, 294, 0, '2020-11-09 21:00:00', '2021-11-08 21:00:00', 1339.15, NULL, '2021-11-15 15:35:56', '2022-01-24 07:59:13'),
(240, 31, 4, 126, 0, '2020-11-10 21:00:00', '2021-11-09 21:00:00', 1264.21, NULL, '2021-11-15 15:36:16', '2022-01-24 07:59:23'),
(241, 31, 6, 184, 0, '2020-11-17 03:00:00', '2021-11-10 21:00:00', 1292.72, NULL, '2021-11-15 15:36:34', '2022-01-24 07:59:30'),
(242, 31, 9, 281, 0, '2020-11-12 21:00:00', '2021-11-11 21:00:00', 1273.54, NULL, '2021-11-15 15:36:52', '2022-01-24 07:59:39'),
(243, 30, 8, 193, 0, '2021-01-24 07:44:27', '2021-10-18 21:00:00', 1584.95, NULL, '2021-11-16 09:13:52', '2022-01-24 07:44:27'),
(244, 30, 3, 67, 0, '2021-01-24 07:44:31', '2021-10-19 21:00:00', 1694.85, NULL, '2021-11-16 09:14:13', '2022-01-24 07:44:31'),
(245, 30, 4, 95, 0, '2021-01-24 07:44:35', '2021-10-20 21:00:00', 1606.58, NULL, '2021-11-16 09:14:31', '2022-01-24 07:44:35'),
(246, 30, 8, 195, 0, '2021-01-24 07:44:41', '2021-10-21 21:00:00', 1570.9, NULL, '2021-11-16 09:14:50', '2022-01-24 07:44:41'),
(247, 30, 6, 126, 0, '2021-01-24 07:44:49', '2021-10-22 21:00:00', 1788.81, NULL, '2021-11-16 09:15:07', '2022-01-24 07:44:49'),
(248, 30, 5, 117, 0, '2021-01-24 07:44:54', '2021-10-24 21:00:00', 1627.39, NULL, '2021-11-16 09:15:26', '2022-01-24 07:44:54'),
(249, 30, 5, 117, 0, '2021-01-24 07:45:01', '2021-10-25 21:00:00', 1627.39, NULL, '2021-11-16 09:15:47', '2022-01-24 07:45:01'),
(250, 30, 7, 158, 0, '2021-01-24 11:22:57', '2021-10-28 21:00:00', 1679.24, NULL, '2021-11-16 09:16:10', '2022-01-24 11:22:57'),
(251, 30, 5, 110, 0, '2021-01-24 07:45:07', '2021-10-29 21:00:00', 1717.27, NULL, '2021-11-16 09:16:26', '2022-01-24 07:45:07'),
(252, 30, 10, 225, 0, '2021-01-24 07:45:15', '2021-11-01 21:00:00', 1683.89, NULL, '2021-11-16 09:16:44', '2022-01-24 07:45:15'),
(253, 30, 12, 275, 0, '2021-01-24 07:45:23', '2021-11-02 21:00:00', 1657.18, NULL, '2021-11-16 09:17:04', '2022-01-24 07:45:23'),
(254, 30, 8, 190, 0, '2021-01-24 07:45:31', '2021-11-03 21:00:00', 1606.58, NULL, '2021-11-16 09:17:31', '2022-01-24 07:45:31'),
(255, 30, 12, 275, 0, '2021-01-24 07:45:39', '2021-11-04 21:00:00', 1657.18, NULL, '2021-11-16 09:17:53', '2022-01-24 07:45:39'),
(256, 30, 8, 190, 0, '2021-01-24 07:45:50', '2021-11-05 21:00:00', 1606.58, NULL, '2021-11-16 09:18:10', '2022-01-24 07:45:50'),
(257, 33, 1, 80, 0, '2020-09-22 21:00:00', '2021-09-21 21:00:00', 640.5, NULL, '2021-11-16 15:00:27', '2022-01-24 11:10:34'),
(258, 32, 1, 8, 0, '2020-09-22 21:00:00', '2021-09-21 21:00:00', 4470, NULL, '2021-11-16 15:02:00', '2022-01-24 11:10:13'),
(259, 34, 1, 30, 0, '2020-09-22 21:00:00', '2021-09-21 21:00:00', 1349.67, NULL, '2021-11-16 15:02:27', '2022-01-24 11:11:46'),
(260, 33, 1, 56, 0, '2020-10-07 21:00:00', '2021-10-06 21:00:00', 822.86, NULL, '2021-11-16 15:03:15', '2022-01-24 11:10:28'),
(261, 32, 1, 8, 0, '2020-10-07 21:00:00', '2021-10-06 21:00:00', 4470, NULL, '2021-11-16 15:03:39', '2022-01-24 11:10:11'),
(262, 26, 2, 56, 0, '2021-01-24 07:32:05', '2021-08-19 21:00:00', 1430.71, NULL, '2021-11-17 09:44:54', '2022-01-24 07:32:05'),
(263, 36, 2, 39, 0, '2020-09-28 21:00:00', '2021-09-27 21:00:00', 1909.87, NULL, '2021-11-17 10:50:15', '2022-01-24 11:17:13'),
(264, 36, 2, 48, 0, '2020-09-29 21:00:00', '2021-09-28 21:00:00', 1592.08, NULL, '2021-11-17 10:50:34', '2022-01-24 11:17:16'),
(265, 36, 4, 100, 0, '2020-09-30 21:00:00', '2021-09-29 21:00:00', 1537, NULL, '2021-11-17 10:50:51', '2022-01-24 11:17:20'),
(266, 36, 4, 115, 0, '2020-10-01 21:00:00', '2021-09-30 21:00:00', 1364.57, NULL, '2021-11-17 10:51:07', '2022-01-24 11:17:24'),
(267, 36, 2, 43, 0, '2020-10-02 21:00:00', '2021-10-01 21:00:00', 1752.21, NULL, '2021-11-17 10:51:24', '2022-01-24 11:17:32'),
(268, 36, 5, 130, 0, '2020-10-04 21:00:00', '2021-10-03 21:00:00', 1486.15, NULL, '2021-11-17 10:51:40', '2022-01-24 11:17:37'),
(269, 36, 9, 245, 0, '2020-10-05 21:00:00', '2021-10-04 21:00:00', 1429.08, NULL, '2021-11-17 10:51:56', '2022-01-24 11:17:53'),
(270, 36, 3, 49, 0, '2020-10-06 21:00:00', '2021-10-05 21:00:00', 2238.47, NULL, '2021-11-17 10:52:14', '2022-01-24 11:17:57'),
(271, 36, 4, 29, 0, '2020-10-07 21:00:00', '2021-10-06 21:00:00', 4773.62, NULL, '2021-11-17 10:52:38', '2022-01-24 11:18:03'),
(272, 36, 5, 106, 0, '2020-10-08 21:00:00', '2021-10-07 21:00:00', 1773.96, NULL, '2021-11-17 10:52:54', '2022-01-24 11:18:08'),
(273, 35, 2, 56, 0, '2020-09-13 21:00:00', '2021-09-12 21:00:00', 1395.36, NULL, '2021-11-17 10:55:54', '2022-01-24 11:13:32'),
(274, 35, 2, 54, 0, '2020-09-16 21:00:00', '2021-09-15 21:00:00', 1439.07, NULL, '2021-11-17 10:56:09', '2022-01-24 11:13:36'),
(275, 35, 4, 122, 0, '2020-09-17 21:00:00', '2021-09-16 21:00:00', 1298.61, NULL, '2021-11-17 10:56:25', '2022-01-24 11:13:40'),
(276, 35, 2, 56, 0, '2020-09-18 21:00:00', '2021-09-17 21:00:00', 1395.36, NULL, '2021-11-17 10:56:42', '2022-01-24 11:13:44'),
(277, 35, 4, 112, 0, '2020-09-20 21:00:00', '2021-09-19 21:00:00', 1395.36, NULL, '2021-11-17 10:57:27', '2022-01-24 11:13:50'),
(278, 35, 6, 146, 0, '2020-09-21 21:00:00', '2021-09-20 21:00:00', 1573.22, NULL, '2021-11-17 10:57:45', '2022-01-24 11:13:55'),
(279, 35, 6, 153, 0, '2020-09-22 21:00:00', '2021-09-21 21:00:00', 1511.08, NULL, '2021-11-17 10:58:34', '2022-01-24 11:14:01'),
(280, 35, 6, 153, 0, '2020-09-23 21:00:00', '2021-09-22 21:00:00', 1511.08, NULL, '2021-11-17 10:58:53', '2022-01-24 11:14:06'),
(281, 35, 2, 55, 0, '2020-09-24 21:00:00', '2021-09-23 21:00:00', 1416.82, NULL, '2021-11-17 10:59:05', '2022-01-24 11:14:12'),
(282, 35, 3, 80, 0, '2020-09-27 21:00:00', '2021-09-26 21:00:00', 1454.38, NULL, '2021-11-17 11:00:18', '2022-01-24 11:16:44'),
(283, 35, 3, 78, 0, '2020-10-25 21:00:00', '2021-10-24 21:00:00', 1486.15, NULL, '2021-11-17 11:00:38', '2022-01-24 11:16:51'),
(284, 35, 4, 100, 0, '2020-10-26 21:00:00', '2021-10-25 21:00:00', 1537, NULL, '2021-11-17 11:00:55', '2022-01-24 11:13:28'),
(285, 35, 4, 86, 0, '2020-10-27 21:00:00', '2021-10-26 21:00:00', 1752.21, NULL, '2021-11-17 11:01:14', '2022-01-24 11:13:20'),
(286, 35, 7, 161, 0, '2020-10-28 21:00:00', '2021-10-27 21:00:00', 1651.96, NULL, '2021-11-17 11:01:32', '2022-01-24 11:13:14'),
(287, 35, 4, 96, 0, '2020-10-29 21:00:00', '2021-10-28 21:00:00', 1592.08, NULL, '2021-11-17 11:01:49', '2022-01-24 11:13:08'),
(288, 35, 4, 90, 0, '2020-11-02 21:00:00', '2021-11-01 21:00:00', 1683.89, NULL, '2021-11-17 11:02:13', '2022-01-24 11:13:02'),
(289, 35, 6, 156, 0, '2020-11-08 21:00:00', '2021-11-07 21:00:00', 1486.15, NULL, '2021-11-17 11:02:28', '2022-01-24 11:12:56'),
(290, 35, 6, 128, 0, '2020-11-09 21:00:00', '2021-11-08 21:00:00', 1764.22, NULL, '2021-11-17 11:02:44', '2022-01-24 11:12:50'),
(291, 35, 2, 35, 0, '2020-11-10 21:00:00', '2021-11-09 21:00:00', 2103.57, NULL, '2021-11-17 11:03:02', '2022-01-24 11:12:46'),
(292, 35, 3, 71, 0, '2020-11-11 21:00:00', '2021-11-10 21:00:00', 1611.48, NULL, '2021-11-17 11:03:22', '2022-01-24 11:12:41'),
(293, 31, 2, 60, 0, '2020-11-13 21:00:00', '2021-11-12 21:00:00', 1316.67, NULL, '2021-11-19 08:17:25', '2022-01-24 07:59:51'),
(294, 31, 8, 228, 0, '2020-11-16 21:00:00', '2021-11-15 21:00:00', 1374.65, NULL, '2021-11-19 08:17:50', '2022-01-24 07:59:56'),
(295, 36, 1, 30, 0, '2020-11-16 21:00:00', '2021-11-15 21:00:00', 1316.67, NULL, '2021-11-19 08:19:08', '2022-01-24 11:18:14'),
(296, 28, 4, 117, 0, '2021-01-24 07:41:20', '2021-11-16 21:00:00', 1378.76, NULL, '2021-11-19 08:19:42', '2022-01-24 07:41:20'),
(297, 28, 3, 82, 0, '2021-01-24 07:41:28', '2021-11-17 21:00:00', 1460.37, NULL, '2021-11-19 08:24:56', '2022-01-24 07:41:28'),
(298, 31, 10, 305, 0, '2020-11-18 21:00:00', '2021-11-17 21:00:00', 1298.61, NULL, '2021-11-19 08:25:32', '2022-01-24 08:00:04'),
(299, 31, 2, 67, 0, '2020-11-20 21:00:00', '2021-11-19 21:00:00', 1201.57, NULL, '2021-11-23 14:15:40', '2022-01-24 08:00:11'),
(300, 31, 10, 319, 0, '2020-11-22 21:00:00', '2021-11-21 21:00:00', 1251.05, NULL, '2021-11-23 14:16:07', '2022-01-24 08:00:18'),
(301, 31, 10, 304, 0, '2020-11-24 03:00:00', '2021-11-22 21:00:00', 1302.17, NULL, '2021-11-24 09:26:32', '2022-01-24 08:00:27'),
(302, 31, 8, 243, 0, '2020-11-24 21:00:00', '2021-11-23 21:00:00', 1303.07, NULL, '2021-11-29 12:51:14', '2022-01-24 08:00:41'),
(303, 31, 2, 61, 0, '2020-11-25 21:00:00', '2021-11-24 21:00:00', 1298.61, NULL, '2021-11-29 12:51:29', '2022-01-24 08:00:49'),
(304, 31, 7, 213, 0, '2020-11-26 21:00:00', '2021-11-25 21:00:00', 1301.15, NULL, '2021-11-29 12:51:48', '2022-01-24 08:00:59'),
(305, 28, 3, 89, 0, '2021-01-24 07:41:37', '2021-11-23 21:00:00', 1362.42, NULL, '2021-11-29 12:52:51', '2022-01-24 07:41:37'),
(306, 28, 3, 61, 0, '2021-01-24 07:41:46', '2021-11-24 21:00:00', 1889.1, NULL, '2021-11-29 12:53:08', '2022-01-24 07:41:46'),
(307, 28, 2, 60, 0, '2021-01-24 07:42:02', '2021-11-25 21:00:00', 1349.67, NULL, '2021-11-29 12:53:26', '2022-01-24 07:42:02'),
(308, 28, 3, 97, 0, '2021-01-24 07:42:12', '2021-11-26 21:00:00', 1267.78, NULL, '2021-11-29 12:53:43', '2022-01-24 07:42:12'),
(309, 31, 4, 120, 0, '2020-11-29 21:00:00', '2021-11-28 21:00:00', 1316.67, NULL, '2021-11-30 08:55:07', '2022-01-24 08:01:07'),
(310, 28, 4, 129, 0, '2021-01-24 07:42:22', '2021-11-28 21:00:00', 1270.5, NULL, '2021-11-30 08:55:36', '2022-01-24 07:42:22'),
(311, 31, 10, 300, 0, '2020-11-30 21:00:00', '2021-11-29 21:00:00', 1316.67, NULL, '2021-12-01 11:01:51', '2022-01-24 08:01:17'),
(312, 28, 5, 165, 0, '2021-01-24 07:00:00', '2021-11-29 21:00:00', 1246.52, NULL, '2021-12-01 11:02:17', '2022-01-24 07:42:42'),
(313, 31, 14, 414, 0, '2020-12-01 21:00:00', '2021-11-30 21:00:00', 1332.63, NULL, '2021-12-06 16:17:00', '2022-01-24 08:48:11'),
(314, 30, 14, 300, 0, '2021-01-24 07:00:00', '2021-12-01 21:00:00', 1757.33, NULL, '2021-12-06 16:17:38', '2022-01-24 07:46:09'),
(315, 30, 18, 418, 0, '2021-01-24 07:46:13', '2021-12-02 21:00:00', 1638.21, NULL, '2021-12-06 16:17:57', '2022-01-24 07:46:13'),
(316, 30, 14, 333, 0, '2021-01-24 07:46:16', '2021-12-03 21:00:00', 1604.49, NULL, '2021-12-06 16:18:16', '2022-01-24 07:46:16'),
(317, 31, 10, 313, 0, '2020-12-06 21:00:00', '2021-12-05 21:00:00', 1270.91, NULL, '2021-12-08 08:25:36', '2022-01-24 08:01:23'),
(318, 34, 4, 117, 0, '2020-11-17 21:00:00', '2021-11-16 21:00:00', 1378.76, NULL, '2021-12-08 08:32:40', '2022-01-24 11:11:40'),
(319, 34, 3, 82, 0, '2020-11-18 21:00:00', '2021-11-17 21:00:00', 1460.37, NULL, '2021-12-08 08:32:57', '2022-01-24 11:11:33'),
(320, 34, 3, 89, 0, '2020-11-24 21:00:00', '2021-11-23 21:00:00', 1362.42, NULL, '2021-12-08 08:33:11', '2022-01-24 11:11:29'),
(321, 34, 3, 94, 0, '2020-11-25 21:00:00', '2021-11-24 21:00:00', 1301.38, NULL, '2021-12-08 08:33:26', '2022-01-24 11:11:24'),
(322, 34, 2, 60, 0, '2020-11-26 21:00:00', '2021-11-25 21:00:00', 1349.67, NULL, '2021-12-08 08:33:39', '2022-01-24 11:11:19'),
(323, 34, 3, 97, 0, '2020-11-27 21:00:00', '2021-11-26 21:00:00', 1267.78, NULL, '2021-12-08 08:33:53', '2022-01-24 11:11:12'),
(324, 34, 4, 129, 0, '2020-11-29 21:00:00', '2021-11-28 21:00:00', 1270.5, NULL, '2021-12-08 08:34:07', '2022-01-24 11:11:08'),
(325, 34, 5, 164, 0, '2020-11-30 21:00:00', '2021-11-29 21:00:00', 1252.8, NULL, '2021-12-08 08:34:19', '2022-01-24 11:11:03'),
(326, 34, 4, 115, 0, '2020-12-01 21:00:00', '2021-11-30 21:00:00', 1399, NULL, '2021-12-08 08:34:31', '2022-01-24 11:11:00'),
(327, 34, 2, 58, 0, '2020-12-02 21:00:00', '2021-12-01 21:00:00', 1388.79, NULL, '2021-12-08 08:34:41', '2022-01-24 11:10:56'),
(329, 31, 15, 459, 0, '2020-12-07 21:00:00', '2021-12-06 21:00:00', 1295.07, NULL, '2021-12-08 11:03:08', '2022-01-24 08:03:48'),
(330, 35, 7, 158, 0, '2020-12-06 21:00:00', '2021-12-05 21:00:00', 1679.24, NULL, '2021-12-08 11:04:41', '2022-01-24 11:12:37'),
(331, 35, 5, 125, 0, '2020-12-07 21:00:00', '2021-12-06 21:00:00', 1537, NULL, '2021-12-08 11:04:59', '2022-01-24 11:12:32'),
(332, 35, 6, 145, 0, '2020-12-08 21:00:00', '2021-12-07 21:00:00', 1582.59, NULL, '2021-12-10 15:33:13', '2022-01-24 11:12:28'),
(333, 35, 4, 107, 0, '2020-12-09 21:00:00', '2021-12-08 21:00:00', 1450.51, NULL, '2021-12-10 15:33:25', '2022-01-24 11:12:24'),
(334, 31, 16, 496, 0, '2020-12-09 21:00:00', '2021-12-08 21:00:00', 1281.13, NULL, '2021-12-10 15:33:58', '2022-01-24 08:03:57'),
(335, 31, 11, 330, 0, '2020-12-10 21:00:00', '2021-12-09 21:00:00', 1316.67, NULL, '2021-12-11 08:48:21', '2022-01-24 08:04:35'),
(336, 35, 6, 146, 0, '2020-12-10 21:00:00', '2021-12-09 21:00:00', 1573.22, NULL, '2021-12-11 08:48:53', '2022-01-24 11:12:21'),
(337, 31, 16, 505, 0, '2020-12-11 21:00:00', '2021-12-10 21:00:00', 1262.13, NULL, '2021-12-13 11:10:03', '2022-01-24 08:05:05'),
(338, 35, 4, 100, 0, '2020-12-11 21:00:00', '2021-12-10 21:00:00', 1537, NULL, '2021-12-13 11:10:29', '2022-01-24 11:12:18'),
(339, 35, 6, 161, 0, '2020-12-13 21:00:00', '2021-12-12 21:00:00', 1446.68, NULL, '2021-12-15 08:11:44', '2022-01-24 11:12:15'),
(340, 31, 16, 473, 0, '2020-12-13 21:00:00', '2021-12-12 21:00:00', 1332.97, NULL, '2021-12-15 08:16:45', '2022-01-24 08:06:08'),
(341, 31, 10, 310, 0, '2020-12-14 21:00:00', '2021-12-13 21:00:00', 1281.13, NULL, '2021-12-15 11:34:18', '2022-01-24 08:06:24'),
(342, 31, 10, 305, 0, '2020-12-15 21:00:00', '2021-12-14 21:00:00', 1298.61, NULL, '2021-12-16 10:52:57', '2022-01-24 08:06:55'),
(343, 31, 4, 120, 0, '2021-01-24 08:00:00', '2021-12-15 21:00:00', 1316.67, NULL, '2021-12-20 09:50:08', '2022-01-24 08:25:33'),
(344, 35, 2, 58, 0, '2020-12-16 21:00:00', '2021-12-15 21:00:00', 1354.66, NULL, '2021-12-20 09:54:16', '2022-01-24 11:12:13'),
(345, 36, 4, 127, 0, '2020-12-17 21:00:00', '2021-12-16 21:00:00', 1255.94, NULL, '2021-12-20 09:55:01', '2022-01-24 11:18:17'),
(346, 36, 4, 138, 0, '2020-12-18 21:00:00', '2021-12-17 21:00:00', 1172.97, NULL, '2021-12-20 09:55:56', '2022-01-24 11:18:21'),
(347, 36, 4, 137, 0, '2020-12-19 21:00:00', '2021-12-18 21:00:00', 1179.96, NULL, '2021-12-20 09:56:11', '2022-01-24 11:18:24'),
(348, 31, 14, 378, 0, '2021-01-24 08:00:00', '2021-12-16 21:00:00', 1439.07, NULL, '2021-12-20 10:04:12', '2022-01-24 08:25:52'),
(349, 31, 8, 239, 0, '2021-01-24 08:00:00', '2021-12-17 21:00:00', 1321.28, NULL, '2021-12-20 10:04:27', '2022-01-24 08:36:14'),
(350, 31, 10, 317, 0, '2021-01-24 08:26:26', '2021-12-18 21:00:00', 1257.59, NULL, '2021-12-20 10:04:40', '2022-01-24 08:26:26'),
(351, 31, 16, 516, 0, '2021-01-24 08:00:00', '2021-12-19 21:00:00', 1239.81, NULL, '2021-12-21 09:13:12', '2022-01-24 08:27:32'),
(352, 36, 5, 169, 0, '2020-12-20 21:00:00', '2021-12-19 21:00:00', 1192.81, NULL, '2021-12-21 09:13:41', '2022-01-24 11:18:28'),
(353, 31, 16, 480, 0, '2021-01-24 08:00:00', '2021-12-20 21:00:00', 1316.67, NULL, '2021-12-23 13:04:40', '2022-01-24 08:27:51'),
(354, 31, 16, 510, 0, '2021-01-24 08:00:00', '2021-12-21 21:00:00', 1251.86, NULL, '2021-12-23 13:05:26', '2022-01-24 08:28:24'),
(355, 31, 16, 501, 0, '2021-01-24 08:00:00', '2022-01-05 21:00:00', 1270.49, NULL, '2022-01-12 14:45:52', '2022-01-24 08:32:02'),
(356, 31, 13, 410, 0, '2021-01-24 08:00:00', '2022-01-06 21:00:00', 1262.93, NULL, '2022-01-12 14:46:16', '2022-01-24 08:32:43'),
(357, 31, 12, 396, 0, '2021-01-24 08:00:00', '2022-01-07 21:00:00', 1216.52, NULL, '2022-01-12 14:46:33', '2022-01-24 08:33:00'),
(358, 31, 11, 356, 0, '2021-01-24 08:00:00', '2022-01-09 21:00:00', 1236.21, NULL, '2022-01-12 14:46:53', '2022-01-24 08:33:16'),
(359, 26, 3, 140, 0, '2021-01-05 21:00:00', '2022-01-04 21:00:00', 944.43, NULL, '2022-01-12 14:47:30', '2022-01-24 07:32:11'),
(360, 26, 6, 301, 0, '2021-01-06 21:00:00', '2022-01-05 21:00:00', 893.54, NULL, '2022-01-12 14:47:44', '2022-01-24 07:32:18'),
(361, 26, 5, 255, 0, '2021-01-08 21:00:00', '2022-01-07 21:00:00', 882.45, NULL, '2022-01-12 14:47:59', '2022-01-24 07:32:23'),
(362, 33, 8, 326, 0, '2020-10-08 21:00:00', '2021-10-07 21:00:00', 1050.34, NULL, '2022-01-18 09:19:56', '2022-01-24 11:27:39'),
(363, 33, 2, 80, 0, '2020-10-09 21:00:00', '2021-10-08 21:00:00', 1066, NULL, '2022-01-18 09:20:23', '2022-01-24 11:27:35'),
(364, 33, 5, 202, 0, '2020-10-11 21:00:00', '2021-10-10 21:00:00', 1057.57, NULL, '2022-01-18 09:20:55', '2022-01-24 11:27:28'),
(365, 33, 4, 154, 0, '2020-10-13 21:00:00', '2021-10-12 21:00:00', 1099.16, NULL, '2022-01-18 09:21:18', '2022-01-24 11:27:24'),
(366, 33, 5, 200, 0, '2020-10-14 21:00:00', '2021-10-13 21:00:00', 1066, NULL, '2022-01-18 09:21:43', '2022-01-24 11:27:16'),
(367, 33, 6, 253, 0, '2020-10-15 21:00:00', '2021-10-14 21:00:00', 1022.27, NULL, '2022-01-18 09:22:12', '2022-01-24 11:27:05'),
(368, 33, 3, 115, 0, '2020-10-16 21:00:00', '2021-10-15 21:00:00', 1103, NULL, '2022-01-18 09:22:30', '2022-01-24 11:27:01'),
(369, 33, 3, 150, 0, '2020-10-18 21:00:00', '2021-10-17 21:00:00', 895.8, NULL, '2022-01-18 09:22:47', '2022-01-24 11:26:58'),
(370, 33, 1, 38, 0, '2020-11-11 21:00:00', '2021-11-10 21:00:00', 1110.79, NULL, '2022-01-18 09:23:08', '2022-01-24 11:26:51'),
(371, 33, 8, 317, 0, '2020-10-01 21:00:00', '2021-09-30 21:00:00', 1074.05, NULL, '2022-01-18 09:27:01', '2022-01-24 11:26:48'),
(372, 31, 22, 704, 0, '2021-01-13 21:00:00', '2022-01-12 21:00:00', 1247.81, NULL, '2022-01-18 09:32:32', '2022-01-24 08:33:27'),
(373, 31, 22, 700, 0, '2021-01-15 21:00:00', '2022-01-14 21:00:00', 1253.71, NULL, '2022-01-18 09:33:19', '2022-01-24 08:33:50'),
(374, 27, 1, 38, 0, '2021-01-24 07:39:29', '2021-11-10 21:00:00', 1110.79, NULL, '2022-01-18 09:44:31', '2022-01-24 07:39:29'),
(375, 27, 5, 159, 0, '2021-01-24 07:39:37', '2021-08-20 21:00:00', 1285.44, NULL, '2022-01-18 09:50:25', '2022-01-24 07:39:37'),
(376, 27, 9, 246, 0, '2021-01-24 07:00:00', '2021-08-14 21:00:00', 1460.37, NULL, '2022-01-18 09:51:23', '2022-01-24 07:39:59'),
(377, 27, 5, 210, 0, '2020-08-09 21:00:00', '2021-08-08 21:00:00', 1025.48, NULL, '2022-01-18 09:52:53', '2022-01-24 07:39:52'),
(378, 27, 1, 38, 0, '2021-01-24 07:00:00', '2021-08-02 21:00:00', 1110.79, NULL, '2022-01-18 09:54:06', '2022-01-24 07:40:23');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commande_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `formule_id` bigint(20) UNSIGNED NOT NULL,
  `quantite` int(11) NOT NULL,
  `pu_vente` double NOT NULL,
  `montant` double NOT NULL,
  `cout_essence` double DEFAULT NULL,
  `cout_salarial` double DEFAULT NULL,
  `cout_livraison` double DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `name`, `commande_id`, `category_id`, `formule_id`, `quantite`, `pu_vente`, `montant`, `cout_essence`, `cout_salarial`, `cout_livraison`, `description`, `created_at`, `updated_at`) VALUES
(26, 'PARPAING DE 10 STANDARD', 14, NULL, 7, 10000, 1500, 15000000, 15, 200, 140, NULL, '2021-11-15 08:30:01', '2022-01-24 07:27:38'),
(27, 'PARPAING DE 15 STANDARD', 14, NULL, 8, 10000, 1700, 17000000, 15, 200, 140, NULL, '2021-11-15 08:30:34', '2022-01-24 07:27:41'),
(28, 'PARPAING DE 20 STANDARD', 14, NULL, 9, 10000, 2000, 20000000, 15, 200, 140, NULL, '2021-11-15 08:31:10', '2022-01-24 07:27:44'),
(30, 'PARPAING MACHINE 20/50', 15, NULL, 10, 10000, 2700, 27000000, 15, 200, 140, NULL, '2021-11-15 08:37:54', '2022-01-24 07:28:05'),
(31, 'PARPAING MACHINE 15/50', 15, NULL, 6, 30000, 2000, 60000000, 15, 200, 140, NULL, '2021-11-15 08:38:34', '2022-01-24 07:28:07'),
(32, 'PARPAING DE 10 STANDARD', 16, NULL, 7, 2000, 1500, 3000000, 15, 200, 140, NULL, '2021-11-15 08:46:30', '2022-01-24 07:28:14'),
(33, 'PARPAING DE 15 STANDARD', 16, NULL, 8, 2000, 1700, 3400000, 15, 200, 140, NULL, '2021-11-15 08:47:00', '2022-01-24 07:28:19'),
(34, 'PARPAING DE 20 STANDARD', 16, NULL, 9, 2000, 2000, 4000000, 15, 200, 140, NULL, '2021-11-15 08:47:25', '2022-01-24 07:28:22'),
(35, 'PARPAING 20P40', 17, NULL, 12, 10000, 2500, 25000000, 15, 200, 140, NULL, '2021-11-17 10:46:44', '2022-01-24 07:28:54'),
(36, 'PARPAING 15P40', 17, NULL, 11, 10000, 1900, 19000000, 15, 200, 140, NULL, '2021-11-17 10:47:34', '2022-01-24 07:28:59');

-- --------------------------------------------------------

--
-- Structure de la table `salaries`
--

DROP TABLE IF EXISTS `salaries`;
CREATE TABLE IF NOT EXISTS `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `depense_id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `societe` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `role`, `societe`, `adresse`, `ville`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'randriamahazosoa alex editho', 'alex.editho512@gmail.com', NULL, '$2y$10$V8k7rbLBYI7pdsdoJn6WZuxrdlOUuMs2l/WbkWruNUxiTPyf2sD5i', 'default', 'a:1:{i:0;s:5:\"Admin\";}', NULL, 'Toamasina', 'Toamasina', NULL, '2021-12-11 06:13:30', '2021-12-11 06:13:30'),
(3, 'Ismaljee Hatim', 'hismaljee@gmail.com', NULL, '$2y$10$CQ/IxXocUeE.QGX2xcYjaO.pbCocfm0rXaTCcx5G1PzYvpfXXCTy.', 'default', 'a:1:{i:0;s:5:\"Admin\";}', NULL, NULL, NULL, NULL, '2021-03-24 16:09:54', '2021-12-11 09:12:44');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

DROP TABLE IF EXISTS `ventes`;
CREATE TABLE IF NOT EXISTS `ventes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `commande_id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `quantite` double NOT NULL,
  `commentaire` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_paiement` tinyint(4) NOT NULL,
  `status_livraison` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
