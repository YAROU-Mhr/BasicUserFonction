-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 27 déc. 2023 à 14:07
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zdelph`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `role` int DEFAULT '0',
  `mdp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `telephone`, `adresse`, `role`, `mdp`) VALUES
(2, 'Doe', 'John', 'john@example.com', '123-456-7890', '123 Main St', 1, '$2y$10$D9lfN6L8.UaJ4Dg2v4UQVeWI05CbwrsDzMJNlUPAiaOuX/5Dq/TKq'),
(3, 'Smith', 'Jane', 'jane@example.com', '987-654-3210', '456 Oak St', 2, '$2y$10$D9lfN6L8.UaJ4Dg2v4UQVeWI05CbwrsDzMJNlUPAiaOuX/5Dq/TKq'),
(4, 'Johnson', 'Bob', 'bob@example.com', '555-123-4567', '789 Elm St', 0, '$2y$10$D9lfN6L8.UaJ4Dg2v4UQVeWI05CbwrsDzMJNlUPAiaOuX/5Dq/TKq'),
(5, 'Williams', 'Alice', 'alice@example.com', '111-222-3333', '456 Pine St', 3, '$2y$10$D9lfN6L8.UaJ4Dg2v4UQVeWI05CbwrsDzMJNlUPAiaOuX/5Dq/TKq'),
(6, 'Brown', 'Michael', 'michael@example.com', '999-888-7777', '789 Oak St', 1, '$2y$10$D9lfN6L8.UaJ4Dg2v4UQVeWI05CbwrsDzMJNlUPAiaOuX/5Dq/TKq'),
(7, 'Taylor', 'Emma', 'emma@example.com', '444-555-6666', '101 Maple St', 2, '$2y$10$D9lfN6L8.UaJ4Dg2v4UQVeWI05CbwrsDzMJNlUPAiaOuX/5Dq/TKq'),
(8, 'Anderson', 'Chris', 'chris@example.com', '777-666-5555', '202 Elm St', 0, '$2y$10$D9lfN6L8.UaJ4Dg2v4UQVeWI05CbwrsDzMJNlUPAiaOuX/5Dq/TKq'),
(9, 'Clark', 'Olivia', 'olivia@example.com', '222-333-4444', '303 Oak St', 1, '$2y$10$D9lfN6L8.UaJ4Dg2v4UQVeWI05CbwrsDzMJNlUPAiaOuX/5Dq/TKq'),
(10, 'Garcia', 'Ethan', 'ethan@example.com', '666-777-8888', '404 Pine St', 2, '$2y$10$D9lfN6L8.UaJ4Dg2v4UQVeWI05CbwrsDzMJNlUPAiaOuX/5Dq/TKq'),
(11, 'Harris', 'Sophia', 'sophia@example.com', '333-444-5555', '505 Maple St', 3, '$2y$10$D9lfN6L8.UaJ4Dg2v4UQVeWI05CbwrsDzMJNlUPAiaOuX/5Dq/TKq'),
(14, 'YAROU', 'Mhr', 'yarou@gmail.com', '22953044860', 'Port', 1, '$2y$10$QwE2Bw.sUSd4shpUAwbki.GnYM9gcRF6yX/4My1Lxjp5ExuRuLmQG');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
