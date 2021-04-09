-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 09 avr. 2021 à 10:43
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdlocalux`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `mail`, `tel`, `adresse`, `cp`, `ville`) VALUES
(1, 'Tony', 'Stark', 'ton.stark@avengers.com', '319', '10880 Malibu Point', '90265', 'Malibu');

-- --------------------------------------------------------

--
-- Structure de la table `formule`
--

CREATE TABLE `formule` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `formule_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formule`
--

INSERT INTO `formule` (`id`, `libelle`, `formule_type`) VALUES
(1, 'Formule 4h', 'FormuleSC'),
(2, 'Formule 24h', 'FormuleSC');

-- --------------------------------------------------------

--
-- Structure de la table `formule_avec_chauffeur`
--

CREATE TABLE `formule_avec_chauffeur` (
  `id` int(11) NOT NULL,
  `lieu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarif` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formule_sans_chauffeur`
--

CREATE TABLE `formule_sans_chauffeur` (
  `id` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `nb_km_inclus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formule_sans_chauffeur`
--

INSERT INTO `formule_sans_chauffeur` (`id`, `duree`, `nb_km_inclus`) VALUES
(1, 4, 150),
(2, 24, 300);

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `le_vehicule_id` int(11) NOT NULL,
  `date_location` date NOT NULL,
  `montant_regle` double NOT NULL,
  `date_hre_depart_prevu` datetime NOT NULL,
  `date_hre_depart_reel` datetime DEFAULT NULL,
  `date_hre_retour_prevu` datetime NOT NULL,
  `date_hre_retour_reel` datetime DEFAULT NULL,
  `location_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `le_client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`id`, `le_vehicule_id`, `date_location`, `montant_regle`, `date_hre_depart_prevu`, `date_hre_depart_reel`, `date_hre_retour_prevu`, `date_hre_retour_reel`, `location_type`, `le_client_id`) VALUES
(1, 1, '2021-04-08', 450, '2021-04-21 12:00:00', NULL, '2021-04-21 16:00:00', NULL, 'locSC', 1),
(2, 1, '2021-04-08', 450, '2021-04-21 12:00:00', NULL, '2021-04-21 16:00:00', NULL, 'locSC', 1),
(3, 1, '2021-04-08', 450, '2021-04-21 12:00:00', NULL, '2021-04-21 16:00:00', NULL, 'locSC', 1),
(4, 1, '2021-04-08', 450, '2021-04-14 12:00:00', NULL, '2021-04-14 16:00:00', NULL, 'locSC', 1),
(5, 1, '2021-04-09', 450, '2021-03-31 12:00:00', NULL, '2021-03-31 16:00:00', NULL, 'locSC', 1),
(6, 1, '2021-04-09', 450, '2021-03-31 12:00:00', NULL, '2021-03-31 16:00:00', NULL, 'locSC', 1),
(7, 1, '2021-04-09', 450, '2021-04-07 12:00:00', NULL, '2021-04-07 16:00:00', NULL, 'locSC', 1),
(10, 1, '2021-04-09', 450, '2021-04-22 10:00:00', NULL, '2021-04-22 14:00:00', NULL, 'locSC', 1);

-- --------------------------------------------------------

--
-- Structure de la table `location_avec_chauffeur`
--

CREATE TABLE `location_avec_chauffeur` (
  `id` int(11) NOT NULL,
  `la_formule_ac_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `location_sans_chauffeur`
--

CREATE TABLE `location_sans_chauffeur` (
  `id` int(11) NOT NULL,
  `la_formule_sc_id` int(11) NOT NULL,
  `nb_kms_depart` int(11) NOT NULL,
  `nb_km_retour` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `location_sans_chauffeur`
--

INSERT INTO `location_sans_chauffeur` (`id`, `la_formule_sc_id`, `nb_kms_depart`, `nb_km_retour`) VALUES
(1, 1, 50465, 39540),
(2, 1, 72062, 103392),
(3, 1, 34121, 54200),
(4, 1, 2067, 10914),
(5, 1, 7719, 15475),
(6, 1, 26342, 31588),
(7, 1, 96575, 100313),
(10, 1, 60895, 87991);

--
-- Déclencheurs `location_sans_chauffeur`
--
DELIMITER $$
CREATE TRIGGER `addKm` BEFORE INSERT ON `location_sans_chauffeur` FOR EACH ROW begin 
	Declare kmDepart int;
    Declare kmRetour int;
    set kmDepart=round(rand()*100000)+1;
    set kmRetour=round(rand()*100000)+1;
    set new.nb_kms_depart=kmDepart;
    set new.nb_km_retour=kmRetour+kmDepart;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `modele`
--

CREATE TABLE `modele` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarif_km_supplementaire` double NOT NULL,
  `nb_places` int(11) NOT NULL,
  `vitesse_max` double DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `modele`
--

INSERT INTO `modele` (`id`, `nom`, `tarif_km_supplementaire`, `nb_places`, `vitesse_max`, `description`) VALUES
(1, 'Lamborgini Hùracàn', 3, 2, 325, 'voiture classe');

-- --------------------------------------------------------

--
-- Structure de la table `tarification`
--

CREATE TABLE `tarification` (
  `id` int(11) NOT NULL,
  `le_modele_id` int(11) NOT NULL,
  `la_formule_sc_id` int(11) NOT NULL,
  `tarif` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tarification`
--

INSERT INTO `tarification` (`id`, `le_modele_id`, `la_formule_sc_id`, `tarif`) VALUES
(1, 1, 1, 450);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `le_modele_id` int(11) NOT NULL,
  `immatriculation` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_achat` date DEFAULT NULL,
  `km_supp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `le_modele_id`, `immatriculation`, `date_achat`, `km_supp`) VALUES
(1, 1, 'LA–038–SP', '2021-04-15', 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `formule`
--
ALTER TABLE `formule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `formule_avec_chauffeur`
--
ALTER TABLE `formule_avec_chauffeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `formule_sans_chauffeur`
--
ALTER TABLE `formule_sans_chauffeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5E9E89CBB6D4F0E` (`le_vehicule_id`),
  ADD KEY `IDX_5E9E89CBC0F37DD6` (`le_client_id`);

--
-- Index pour la table `location_avec_chauffeur`
--
ALTER TABLE `location_avec_chauffeur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C11B874983E2964E` (`la_formule_ac_id`);

--
-- Index pour la table `location_sans_chauffeur`
--
ALTER TABLE `location_sans_chauffeur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_50D7BFCF99C252AC` (`la_formule_sc_id`);

--
-- Index pour la table `modele`
--
ALTER TABLE `modele`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tarification`
--
ALTER TABLE `tarification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modele_tarif_unique` (`le_modele_id`,`la_formule_sc_id`),
  ADD KEY `IDX_6132816750CA3FD` (`le_modele_id`),
  ADD KEY `IDX_613281699C252AC` (`la_formule_sc_id`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_292FFF1D750CA3FD` (`le_modele_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `formule`
--
ALTER TABLE `formule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `modele`
--
ALTER TABLE `modele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tarification`
--
ALTER TABLE `tarification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `formule_avec_chauffeur`
--
ALTER TABLE `formule_avec_chauffeur`
  ADD CONSTRAINT `FK_3C4DBFEEBF396750` FOREIGN KEY (`id`) REFERENCES `formule` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `formule_sans_chauffeur`
--
ALTER TABLE `formule_sans_chauffeur`
  ADD CONSTRAINT `FK_AD818768BF396750` FOREIGN KEY (`id`) REFERENCES `formule` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `FK_5E9E89CBB6D4F0E` FOREIGN KEY (`le_vehicule_id`) REFERENCES `vehicule` (`id`),
  ADD CONSTRAINT `FK_5E9E89CBC0F37DD6` FOREIGN KEY (`le_client_id`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `location_avec_chauffeur`
--
ALTER TABLE `location_avec_chauffeur`
  ADD CONSTRAINT `FK_C11B874983E2964E` FOREIGN KEY (`la_formule_ac_id`) REFERENCES `formule_avec_chauffeur` (`id`),
  ADD CONSTRAINT `FK_C11B8749BF396750` FOREIGN KEY (`id`) REFERENCES `location` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `location_sans_chauffeur`
--
ALTER TABLE `location_sans_chauffeur`
  ADD CONSTRAINT `FK_50D7BFCF99C252AC` FOREIGN KEY (`la_formule_sc_id`) REFERENCES `formule_sans_chauffeur` (`id`),
  ADD CONSTRAINT `FK_50D7BFCFBF396750` FOREIGN KEY (`id`) REFERENCES `location` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tarification`
--
ALTER TABLE `tarification`
  ADD CONSTRAINT `FK_6132816750CA3FD` FOREIGN KEY (`le_modele_id`) REFERENCES `modele` (`id`),
  ADD CONSTRAINT `FK_613281699C252AC` FOREIGN KEY (`la_formule_sc_id`) REFERENCES `formule_sans_chauffeur` (`id`);

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `FK_292FFF1D750CA3FD` FOREIGN KEY (`le_modele_id`) REFERENCES `modele` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
