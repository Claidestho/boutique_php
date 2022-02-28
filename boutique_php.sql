-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 28 fév. 2022 à 08:59
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `carriers`
--

CREATE TABLE `carriers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `price_500` float NOT NULL,
  `price_1000` float NOT NULL,
  `price_over` float DEFAULT NULL,
  `order_follow` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `carriers`
--

INSERT INTO `carriers` (`id`, `name`, `price_500`, `price_1000`, `price_over`, `order_follow`) VALUES
(1, 'DHL', 499, 750, 1270, 1),
(2, 'La Poste', 299, 850, 2030, 1),
(3, 'DPD', 350, 550, NULL, 0),
(4, 'UPS', 1050, 353, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `description`, `name`) VALUES
(1, '', 'cat 1'),
(2, '', 'cat 2'),
(3, '', 'cat 3');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `email` varchar(126) COLLATE utf8_bin NOT NULL,
  `phone_number` int(11) NOT NULL,
  `adress` varchar(255) COLLATE utf8_bin NOT NULL,
  `city` varchar(255) COLLATE utf8_bin NOT NULL,
  `zip_code` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `adress`, `city`, `zip_code`) VALUES
(1, 'Chuck', 'Norris', 'chuckyboi@gmail.com', 658423659, '1 rue bonjour', 'grenoble', 38000),
(2, 'Charlize ', 'Theron', 'chacha@gmail.com', 745123698, '5 allé bateau', 'grenoble', 38000),
(3, 'Ryan', 'Gosling', 'ryan@gmail.com', 512365632, '45 allé des hortensias', 'voreppe', 38340);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_11_24_145812_init_playground', 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `number` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `date`, `customer_id`, `number`) VALUES
(1, '2022-02-11', 1, '0000000001'),
(2, '2022-02-06', 1, '0000000002'),
(3, '2022-02-08', 2, '0000000003'),
(4, '2022-02-09', 2, '0000000004'),
(5, '2022-02-11', 2, '0000000005'),
(7, '2022-02-24', 1, '0000000006'),
(16, '0000-00-00', 1, '0000000007'),
(17, '0000-00-00', 1, '0000000007'),
(18, '0000-00-00', 1, '0000000007');

-- --------------------------------------------------------

--
-- Structure de la table `order_product`
--

CREATE TABLE `order_product` (
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `order_product`
--

INSERT INTO `order_product` (`product_id`, `quantity`, `order_id`) VALUES
(1, 1, 1),
(4, 2, 1),
(12, 1, 2),
(11, 2, 2),
(1, 1, 3),
(11, 1, 3),
(4, 2, 4),
(13, 1, 4),
(1, 1, 5),
(1, 12, 5),
(1, 1, 16),
(1, 1, 17),
(7, 14, 18);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `avalaible` tinyint(1) NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `weight` int(11) NOT NULL,
  `image_url` varchar(255) COLLATE utf8_bin NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount_rate` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `productscol` varchar(45) COLLATE utf8_bin NOT NULL,
  `rodent_family` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `price`, `name`, `avalaible`, `description`, `weight`, `image_url`, `quantity`, `discount_rate`, `category_id`, `productscol`, `rodent_family`) VALUES
(1, 100000, 'autruche', 1, 'Bonjour c une autruche lol', 1000, 'https://teteamodeler.ouest-france.fr/media/cache/thumb_800/babouin-explication-tete-a-modeler-du-mot-babouin.jpeg', 10, 10, 1, '', 0),
(2, 100000, 'chien', 1, 'c 1 beau chien', 1000, 'https://img.passeportsante.net/1000x526/2021-05-06/i106625-signes-bonne-sante-chien.jpg', 10, 25, 1, '', 0),
(4, 10000, 'rat', 1, 'le joli rat', 500, 'https://www.novomeuble.com/7959/table-salle-a-manger-bois-massif.jpg', 1, 10, 1, '', 0),
(5, 10000, 'pigeon', 1, 'les grand pijn', 500, 'https://www.consoglobe.com/wp-content/uploads/2021/03/anti-pigeon_shutterstock_1277215624_ban-645x338.jpg', 1, 35, 1, '', 0),
(6, 10000, 'licorne', 0, 'la belle corne', 500, 'https://centre-equestre-digne.com/wp-content/uploads/2020/04/baby-poney-sentir-et-reconnaitre.jpg', 1, 0, 1, '', 0),
(7, 10000, 'musaraigne', 0, 'lé ronjeurs', 500, 'https://teteamodeler.ouest-france.fr/media/cache/thumb_800/babouin-explication-tete-a-modeler-du-mot-babouin.jpeg', 1, 0, 1, '', 0),
(8, 13000, 'castor', 1, 'la queu plate', 500, 'https://teteamodeler.ouest-france.fr/media/cache/thumb_800/babouin-explication-tete-a-modeler-du-mot-babouin.jpeg', 0, 0, 2, '', 0),
(9, 13000, 'cheval', 1, 'cataclop cataclop', 500, 'https://teteamodeler.ouest-france.fr/media/cache/thumb_800/babouin-explication-tete-a-modeler-du-mot-babouin.jpeg', 0, 0, 2, '', 0),
(10, 50000, 'giraffe', 1, 'c 1 trè long cou', 1200, 'https://teteamodeler.ouest-france.fr/media/cache/thumb_800/babouin-explication-tete-a-modeler-du-mot-babouin.jpeg', 2, 0, 2, '', 0),
(11, 50000, 'chat', 1, 'miaou miaou', 1200, 'https://teteamodeler.ouest-france.fr/media/cache/thumb_800/babouin-explication-tete-a-modeler-du-mot-babouin.jpeg', 2, 0, 2, '', 0),
(12, 500000, 'ortolan', 1, 'les préférés de maité', 1200, 'https://teteamodeler.ouest-france.fr/media/cache/thumb_800/babouin-explication-tete-a-modeler-du-mot-babouin.jpeg', 5, 0, 3, '', 0),
(13, 500000, 'Babouin', 1, 'quel animal', 1200, 'https://teteamodeler.ouest-france.fr/media/cache/thumb_800/babouin-explication-tete-a-modeler-du-mot-babouin.jpeg', 5, 0, 3, '', 0),
(14, 500000, 'Macaque', 1, 'le singe la hihi', 1200, 'https://teteamodeler.ouest-france.fr/media/cache/thumb_800/babouin-explication-tete-a-modeler-du-mot-babouin.jpeg', 5, 0, 3, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `sql_playground_test`
--

CREATE TABLE `sql_playground_test` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sql_playground_test`
--

INSERT INTO `sql_playground_test` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Campus Numérique In The Alps', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `carriers`
--
ALTER TABLE `carriers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relation client` (`customer_id`);

--
-- Index pour la table `order_product`
--
ALTER TABLE `order_product`
  ADD KEY `relation order` (`order_id`),
  ADD KEY `relation product` (`product_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product -> cat` (`category_id`);

--
-- Index pour la table `sql_playground_test`
--
ALTER TABLE `sql_playground_test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `carriers`
--
ALTER TABLE `carriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `sql_playground_test`
--
ALTER TABLE `sql_playground_test`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `relation client` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Contraintes pour la table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `relation order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `relation product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product -> cat` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
