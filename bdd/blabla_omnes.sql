-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 11:29 PM
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
-- Database: `blabla_omnes`
--

-- --------------------------------------------------------

--
-- Table structure for table `argent`
--

CREATE TABLE `argent` (
  `id` int(11) NOT NULL,
  `id_profil` int(11) NOT NULL,
  `gains` float NOT NULL,
  `depenses` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `argent`
--

INSERT INTO `argent` (`id`, `id_profil`, `gains`, `depenses`) VALUES
(7, 18, 0, 0),
(8, 21, 0, 0),
(9, 22, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coordonnees_bancaires`
--

CREATE TABLE `coordonnees_bancaires` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `expiration` date NOT NULL,
  `iban` varchar(255) NOT NULL,
  `id_profil` int(11) NOT NULL,
  `titulaire` varchar(255) NOT NULL,
  `cryptogramme` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordonnees_bancaires`
--

INSERT INTO `coordonnees_bancaires` (`id`, `numero`, `expiration`, `iban`, `id_profil`, `titulaire`, `cryptogramme`) VALUES
(1, 2147483647, '2029-10-01', '', 18, 'VAUTRIN DENIS', 987),
(4, 2147483647, '2029-10-01', '', 18, 'VAUTRIN DENIS', 726),
(5, 28136287, '2202-01-01', '', 18, 'KJFDZHKJDZ', 288),
(6, 2, '2222-01-01', '', 18, 'DKZJAH', 928);

-- --------------------------------------------------------

--
-- Table structure for table `est_associe_a`
--

CREATE TABLE `est_associe_a` (
  `id_trajet` int(11) NOT NULL,
  `id_profil` int(11) NOT NULL,
  `fonction` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `est_associe_a`
--

INSERT INTO `est_associe_a` (`id_trajet`, `id_profil`, `fonction`) VALUES
(21, 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lieu`
--

CREATE TABLE `lieu` (
  `id` int(11) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `nom_adresse` varchar(50) NOT NULL,
  `nom_campus` varchar(50) NOT NULL,
  `campus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lieu`
--

INSERT INTO `lieu` (`id`, `pays`, `ville`, `code_postal`, `num`, `type`, `nom_adresse`, `nom_campus`, `campus`) VALUES
(24, 'France', 'Lyon', 69003, 15, 'Boulevard', 'Marius Vivier Merle', '', 0),
(25, 'France', 'Maisons-Laffitte', 78600, 13, 'rue', 'de solférino', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `passe_par`
--

CREATE TABLE `passe_par` (
  `id_lieu` int(11) NOT NULL,
  `id_trajet` int(11) NOT NULL,
  `ordre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passe_par`
--

INSERT INTO `passe_par` (`id_lieu`, `id_trajet`, `ordre`) VALUES
(24, 21, 1),
(25, 21, 2);

-- --------------------------------------------------------

--
-- Table structure for table `permis`
--

CREATE TABLE `permis` (
  `id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `date` date NOT NULL,
  `valide` tinyint(1) NOT NULL,
  `photo_id` varchar(255) NOT NULL,
  `id_profil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plainte`
--

CREATE TABLE `plainte` (
  `id` int(11) NOT NULL,
  `statut` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plainte`
--

INSERT INTO `plainte` (`id`, `statut`, `description`) VALUES
(1, 2, ''),
(2, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `id` int(11) NOT NULL,
  `id_profil` int(11) NOT NULL,
  `fumer` int(11) NOT NULL,
  `discussion` int(11) NOT NULL,
  `musique` int(11) NOT NULL,
  `animaux` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`id`, `id_profil`, `fumer`, `discussion`, `musique`, `animaux`) VALUES
(7, 18, 2, 1, 0, 0),
(8, 21, 2, 1, 2, 0),
(9, 22, 2, 1, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `id_statistique` int(11) DEFAULT NULL,
  `id_preferences` int(11) DEFAULT NULL,
  `id_argent` int(11) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `num_tel` varchar(50) NOT NULL,
  `pdp` varchar(255) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `date_inscription` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id`, `id_statistique`, `id_preferences`, `id_argent`, `nom`, `prenom`, `email`, `password`, `num_tel`, `pdp`, `type`, `date_naissance`, `date_inscription`) VALUES
(18, 1, 7, 7, 'Vautrin', 'Denis', 'vtndenis@gmail.com', 'Denis', '0624018317', '../img/profils/18.jpg', '', '2004-03-05', '2024-05-24'),
(21, 2, 8, 8, 'Antunes', 'Nino', 'nino@gmail.com', 'Nino', '0606060606', '', '', '2004-09-02', '2024-05-24'),
(22, 3, 9, 9, 'PedroPe', 'Pedro', 'pedropedropedrope@gmail.com', 'Pedro', '0601010101', NULL, '', '1997-07-12', '2024-05-26');

-- --------------------------------------------------------

--
-- Table structure for table `signale`
--

CREATE TABLE `signale` (
  `id_profil` int(11) NOT NULL,
  `id_plainte` int(11) NOT NULL,
  `commentaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signale`
--

INSERT INTO `signale` (`id_profil`, `id_plainte`, `commentaire`) VALUES
(18, 1, 'Il a fait caca dans ma voiture'),
(21, 1, 'Et lui il a fait pipi'),
(18, 2, 'Il a pété'),
(22, 2, 'Il a roté');

-- --------------------------------------------------------

--
-- Table structure for table `statistique`
--

CREATE TABLE `statistique` (
  `id` int(11) NOT NULL,
  `id_profil` int(11) NOT NULL,
  `nb_trajet_effectue` int(11) NOT NULL,
  `nb_trajet_publie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statistique`
--

INSERT INTO `statistique` (`id`, `id_profil`, `nb_trajet_effectue`, `nb_trajet_publie`) VALUES
(1, 18, 0, 0),
(2, 21, 0, 0),
(3, 22, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `trajet`
--

CREATE TABLE `trajet` (
  `id` int(11) NOT NULL,
  `id_voiture` int(11) DEFAULT NULL,
  `statut` int(11) NOT NULL,
  `nb_passagers` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `prix` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trajet`
--

INSERT INTO `trajet` (`id`, `id_voiture`, `statut`, `nb_passagers`, `date`, `heure`, `prix`) VALUES
(21, 23, 0, 3, '2024-05-28', '15:00:00', 35);

-- --------------------------------------------------------

--
-- Table structure for table `voiture`
--

CREATE TABLE `voiture` (
  `id` int(11) NOT NULL,
  `num_plaque` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `modele` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `id_profil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voiture`
--

INSERT INTO `voiture` (`id`, `num_plaque`, `marque`, `modele`, `photo`, `id_profil`) VALUES
(23, 'AZBC729KQ', 'Renault', 'Scenic', '../img/voitures/Renault_Scenic_AZBC729KQ_18.jpg', 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `argent`
--
ALTER TABLE `argent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coordonnees_bancaires`
--
ALTER TABLE `coordonnees_bancaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coordonnees_bancaires_profil_FK` (`id_profil`);

--
-- Indexes for table `est_associe_a`
--
ALTER TABLE `est_associe_a`
  ADD PRIMARY KEY (`id_trajet`,`id_profil`),
  ADD KEY `est_associe_a_profil_FK` (`id_profil`);

--
-- Indexes for table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passe_par`
--
ALTER TABLE `passe_par`
  ADD PRIMARY KEY (`id_lieu`,`id_trajet`),
  ADD KEY `passe_par_trajet0_FK` (`id_trajet`);

--
-- Indexes for table `permis`
--
ALTER TABLE `permis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permis_profil_AK` (`id_profil`);

--
-- Indexes for table `plainte`
--
ALTER TABLE `plainte`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preferences_profil_FK` (`id_profil`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profil_email_UK` (`email`),
  ADD KEY `profil_statistique_FK` (`id_statistique`),
  ADD KEY `profil_preferences_FK` (`id_preferences`),
  ADD KEY `profil_argent_FK` (`id_argent`);

--
-- Indexes for table `signale`
--
ALTER TABLE `signale`
  ADD PRIMARY KEY (`id_plainte`,`id_profil`),
  ADD KEY `signale_profil_FK` (`id_profil`);

--
-- Indexes for table `statistique`
--
ALTER TABLE `statistique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statistique_FK` (`id_profil`);

--
-- Indexes for table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trajet_voiture_FK` (`id_voiture`);

--
-- Indexes for table `voiture`
--
ALTER TABLE `voiture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voiture_profil_FK` (`id_profil`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `argent`
--
ALTER TABLE `argent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coordonnees_bancaires`
--
ALTER TABLE `coordonnees_bancaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `permis`
--
ALTER TABLE `permis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plainte`
--
ALTER TABLE `plainte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `statistique`
--
ALTER TABLE `statistique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `voiture`
--
ALTER TABLE `voiture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coordonnees_bancaires`
--
ALTER TABLE `coordonnees_bancaires`
  ADD CONSTRAINT `coordonnees_bancaires_profil_FK` FOREIGN KEY (`id_profil`) REFERENCES `profil` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `est_associe_a`
--
ALTER TABLE `est_associe_a`
  ADD CONSTRAINT `est_associe_a_profil_FK` FOREIGN KEY (`id_profil`) REFERENCES `profil` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `est_associe_a_trajet_FK` FOREIGN KEY (`id_trajet`) REFERENCES `trajet` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `passe_par`
--
ALTER TABLE `passe_par`
  ADD CONSTRAINT `passe_par_lieu_FK` FOREIGN KEY (`id_lieu`) REFERENCES `lieu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `passe_par_trajet0_FK` FOREIGN KEY (`id_trajet`) REFERENCES `trajet` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permis`
--
ALTER TABLE `permis`
  ADD CONSTRAINT `permis_profil_FK` FOREIGN KEY (`id_profil`) REFERENCES `profil` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `preferences_profil_FK` FOREIGN KEY (`id_profil`) REFERENCES `profil` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profil`
--
ALTER TABLE `profil`
  ADD CONSTRAINT `profil_argent_FK` FOREIGN KEY (`id_argent`) REFERENCES `argent` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `profil_preferences_FK` FOREIGN KEY (`id_preferences`) REFERENCES `preferences` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `profil_statistique_FK` FOREIGN KEY (`id_statistique`) REFERENCES `statistique` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `signale`
--
ALTER TABLE `signale`
  ADD CONSTRAINT `signale_plainte_FK` FOREIGN KEY (`id_plainte`) REFERENCES `plainte` (`id`),
  ADD CONSTRAINT `signale_profil_FK` FOREIGN KEY (`id_profil`) REFERENCES `profil` (`id`);

--
-- Constraints for table `statistique`
--
ALTER TABLE `statistique`
  ADD CONSTRAINT `statistique_FK` FOREIGN KEY (`id_profil`) REFERENCES `profil` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `trajet_voiture_FK` FOREIGN KEY (`id_voiture`) REFERENCES `voiture` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `voiture`
--
ALTER TABLE `voiture`
  ADD CONSTRAINT `voiture_profil_FK` FOREIGN KEY (`id_profil`) REFERENCES `profil` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
