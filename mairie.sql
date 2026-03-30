-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 30 mars 2026 à 16:17
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mairie`
--

-- --------------------------------------------------------

--
-- Structure de la table `habitants`
--

DROP TABLE IF EXISTS `habitants`;
CREATE TABLE IF NOT EXISTS `habitants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `num_registre` varchar(20) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `sexe` varchar(20) NOT NULL,
  `date_naissance` date NOT NULL,
  `heure_naissance` time NOT NULL,
  `lieu_naissance` varchar(100) NOT NULL,
  `prenom_pere` varchar(100) DEFAULT NULL,
  `nom_pere` varchar(50) DEFAULT NULL,
  `prenom_mere` varchar(100) NOT NULL,
  `nom_mere` varchar(50) NOT NULL,
  `date_enregistrement` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `habitants`
--

INSERT INTO `habitants` (`id`, `num_registre`, `nom`, `prenom`, `sexe`, `date_naissance`, `heure_naissance`, `lieu_naissance`, `prenom_pere`, `nom_pere`, `prenom_mere`, `nom_mere`, `date_enregistrement`) VALUES
(1, '001/2026', 'NDIAYE', 'Moussa', 'Masculin', '2026-01-05', '08:30:00', 'Maternité Sacré-Cœur', 'Abdoulaye', 'NDIAYE', 'Mariama', 'FALL', '2026-03-30 13:55:31'),
(2, '002/2026', 'DIOP', 'Awa', 'Féminin', '2026-01-12', '14:45:00', 'Clinique de la Paix', 'Modou', 'DIOP', 'Fatou', 'GUEYE', '2026-03-30 13:55:31'),
(3, '003/2026', 'SOW', 'Ousmane', 'Masculin', '2026-01-15', '23:10:00', 'Centre de Santé Keur Massar', 'Ibrahima', 'SOW', 'Aïssatou', 'BA', '2026-03-30 13:55:31'),
(4, '004/2026', 'FALL', 'Aminata', 'Féminin', '2026-01-20', '05:20:00', 'Hôpital Principal', 'Cheikh', 'FALL', 'Khadija', 'DIENG', '2026-03-30 13:55:31'),
(5, '005/2026', 'GUEYE', 'Babacar', 'Masculin', '2026-01-25', '11:05:00', 'Maternité Sacré-Cœur', 'Moustapha', 'GUEYE', 'Penda', 'SY', '2026-03-30 13:55:31'),
(6, '006/2026', 'SY', 'Marième', 'Féminin', '2026-01-28', '19:40:00', 'Clinique des Mamelles', 'Amadou', 'SY', 'Safiétou', 'NIANG', '2026-03-30 13:55:31'),
(7, '007/2026', 'BA', 'Abdou', 'Masculin', '2026-02-02', '02:15:00', 'Centre de Santé Sacré-Cœur', 'Oumar', 'BA', 'Rokhaya', 'SANE', '2026-03-30 13:55:31'),
(8, '008/2026', 'NIANG', 'Fatoumata', 'Féminin', '2026-02-05', '09:55:00', 'Maternité de Dakar', 'Idrissa', 'NIANG', 'Coumba', 'DAFF', '2026-03-30 13:55:31'),
(9, '009/2026', 'DIAGNE', 'Ibrahima', 'Masculin', '2026-02-10', '16:30:00', 'Clinique de la Médina', 'Pathé', 'DIAGNE', 'Seynabou', 'LO', '2026-03-30 13:55:31'),
(10, '010/2026', 'SECK', 'Nafissatou', 'Féminin', '2026-02-14', '21:12:00', 'Hôpital Grand Yoff', 'Mamadou', 'SECK', 'Anta', 'NDOUR', '2026-03-30 13:55:31'),
(11, '011/2026', 'NDOUR', 'Youssou', 'Masculin', '2026-02-18', '07:00:00', 'Maternité Sacré-Cœur', 'Birane', 'NDOUR', 'Viviane', 'CHEDID', '2026-03-30 13:55:31'),
(12, '012/2026', 'CAMARA', 'Kadiatou', 'Féminin', '2026-02-22', '13:25:00', 'Clinique Pasteur', 'Lamine', 'CAMARA', 'Aïcha', 'KONE', '2026-03-30 13:55:31'),
(13, '013/2026', 'SANE', 'Boubacar', 'Masculin', '2026-02-25', '18:50:00', 'Centre Médical Liberté 6', 'Ansoumana', 'SANE', 'Bineta', 'MANE', '2026-03-30 13:55:31'),
(14, '014/2026', 'THIAM', 'Khady', 'Féminin', '2026-03-01', '04:10:00', 'Hôpital Aristide Le Dantec', 'Alioune', 'THIAM', 'Maimouna', 'WANE', '2026-03-30 13:55:31'),
(15, '015/2026', 'MBAYE', 'Codou', 'Féminin', '2026-03-05', '12:00:00', 'Maternité Sacré-Cœur', 'Pape', 'MBAYE', 'Astou', 'FAYE', '2026-03-30 13:55:31'),
(16, '016/2026', 'SECK', 'MOUHA', 'Masculin', '2026-03-06', '13:00:00', 'dakar', 'zoro', 'seck', 'seck', 'sandji', '2026-03-30 13:56:57');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
