-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 07 déc. 2020 à 08:37
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lbl`
--
CREATE DATABASE lbl;
USE lbl;
-- --------------------------------------------------------

--
-- Structure de la table `table_article`
--

DROP TABLE IF EXISTS `table_article`;
CREATE TABLE IF NOT EXISTS `table_article` (
  `idArticle` int(11) NOT NULL AUTO_INCREMENT,
  `refArticle` varchar(15) NOT NULL,
  `libArticle` text NOT NULL,
  `idUnivers` int(11) NOT NULL,
  `idCateg` int(11) NOT NULL,
  `idFournisseur` int(11) NOT NULL,
  `idCouleur` int(11) NOT NULL,
  `idTaille` int(11) NOT NULL,
  `idIncrementale` int(11) NOT NULL,
  `idLot` int(11) NOT NULL,
  `quantiteStock` double NOT NULL,
  `prixAchat` double NOT NULL,
  `prixVente` double NOT NULL,
  `seuil` int(11) DEFAULT '10',
  PRIMARY KEY (`idArticle`),
  UNIQUE KEY `refArticle` (`refArticle`),
  KEY `table_article_ibfk_1` (`idUnivers`),
  KEY `table_article_ibfk_2` (`idCateg`),
  KEY `table_article_ibfk_3` (`idFournisseur`),
  KEY `table_article_ibfk_4` (`idTaille`),
  KEY `table_article_ibfk_5` (`idCouleur`),
  KEY `table_article_ibfk_6` (`idIncrementale`),
  KEY `table_article_ibfk_7` (`idLot`)
) ENGINE=InnoDB AUTO_INCREMENT=6199 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `table_categ`
--

DROP TABLE IF EXISTS `table_categ`;
CREATE TABLE IF NOT EXISTS `table_categ` (
  `idCateg` int(11) NOT NULL AUTO_INCREMENT,
  `refCateg` varchar(2) NOT NULL,
  `libCateg` text NOT NULL,
  `idUnivers` int(11) NOT NULL,
  PRIMARY KEY (`idCateg`),
  UNIQUE KEY `refCateg` (`refCateg`),
  KEY `table_categ_ibfk_1` (`idUnivers`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `table_client`
--

DROP TABLE IF EXISTS `table_client`;
CREATE TABLE IF NOT EXISTS `table_client` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `nomClient` text NOT NULL,
  `adresseMail` text NOT NULL,
  `adressePostale` text NOT NULL,
  UNIQUE KEY `idClient` (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `table_couleur`
--

DROP TABLE IF EXISTS `table_couleur`;
CREATE TABLE IF NOT EXISTS `table_couleur` (
  `idCouleur` int(11) NOT NULL AUTO_INCREMENT,
  `libCouleur` text NOT NULL,
  `refCouleur` varchar(2) NOT NULL,
  UNIQUE KEY `idCouleur` (`idCouleur`),
  UNIQUE KEY `refCouleur` (`refCouleur`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `table_detail_vente`
--

DROP TABLE IF EXISTS `table_detail_vente`;
CREATE TABLE IF NOT EXISTS `table_detail_vente` (
  `idDetailVente` int(11) NOT NULL AUTO_INCREMENT,
  `idVente` int(11) NOT NULL,
  `quantite` double NOT NULL,
  `idArticle` int(11) NOT NULL,
  `prixUnitaire` double NOT NULL,
  `detailDivers` text NOT NULL,
  PRIMARY KEY (`idDetailVente`),
  KEY `idVente` (`idVente`),
  KEY `idArticle` (`idArticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `table_fournisseur`
--

DROP TABLE IF EXISTS `table_fournisseur`;
CREATE TABLE IF NOT EXISTS `table_fournisseur` (
  `idFournisseur` int(11) NOT NULL AUTO_INCREMENT,
  `refFournisseur` varchar(2) NOT NULL,
  `libFournisseur` text NOT NULL,
  `adresseFournisseur` text,
  `telephoneFournisseur` text,
  PRIMARY KEY (`idFournisseur`),
  UNIQUE KEY `refFournisseur` (`refFournisseur`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `table_incrementale`
--

DROP TABLE IF EXISTS `table_incrementale`;
CREATE TABLE IF NOT EXISTS `table_incrementale` (
  `idIncrementale` int(11) NOT NULL AUTO_INCREMENT,
  `refIncrementale` varchar(2) NOT NULL,
  PRIMARY KEY (`idIncrementale`),
  UNIQUE KEY `refIncrementale` (`refIncrementale`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COMMENT='differencie 2 articles quasiment identique';

-- --------------------------------------------------------

--
-- Structure de la table `table_lot`
--

DROP TABLE IF EXISTS `table_lot`;
CREATE TABLE IF NOT EXISTS `table_lot` (
  `idLot` int(11) NOT NULL AUTO_INCREMENT,
  `reflot` varchar(1) NOT NULL,
  PRIMARY KEY (`idLot`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `table_modepaiement`
--

DROP TABLE IF EXISTS `table_modepaiement`;
CREATE TABLE IF NOT EXISTS `table_modepaiement` (
  `idModePaiement` varchar(2) NOT NULL,
  `libModePaiement` text NOT NULL,
  PRIMARY KEY (`idModePaiement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `table_paiement`
--

DROP TABLE IF EXISTS `table_paiement`;
CREATE TABLE IF NOT EXISTS `table_paiement` (
  `idpaiement` int(11) NOT NULL AUTO_INCREMENT,
  `idVente` int(11) NOT NULL,
  `idmodePaiement` varchar(2) NOT NULL,
  `montant` double NOT NULL,
  `idClient` int(11) NOT NULL,
  `banque` text NOT NULL,
  PRIMARY KEY (`idpaiement`),
  KEY `idVente` (`idVente`),
  KEY `idModePaiement` (`idmodePaiement`),
  KEY `fkPaiement_client` (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `table_promotion`
--

DROP TABLE IF EXISTS `table_promotion`;
CREATE TABLE IF NOT EXISTS `table_promotion` (
  `idPromotion` int(11) NOT NULL AUTO_INCREMENT,
  `idCateg` int(11) NOT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `taux` double NOT NULL,
  PRIMARY KEY (`idPromotion`),
  KEY `FKPromotionCateg` (`idCateg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `table_taille`
--

DROP TABLE IF EXISTS `table_taille`;
CREATE TABLE IF NOT EXISTS `table_taille` (
  `idTaille` int(11) NOT NULL AUTO_INCREMENT,
  `libTaille` text NOT NULL,
  `refTaille` varchar(2) NOT NULL,
  UNIQUE KEY `refTaille` (`refTaille`),
  KEY `idTaille` (`idTaille`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `table_univers`
--

DROP TABLE IF EXISTS `table_univers`;
CREATE TABLE IF NOT EXISTS `table_univers` (
  `idUnivers` int(11) NOT NULL AUTO_INCREMENT,
  `refUnivers` varchar(1) NOT NULL,
  `libUnivers` text NOT NULL,
  PRIMARY KEY (`idUnivers`),
  UNIQUE KEY `refUnivers` (`refUnivers`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `table_user`
--

DROP TABLE IF EXISTS `table_user`;
CREATE TABLE IF NOT EXISTS `table_user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `table_vente`
--

DROP TABLE IF EXISTS `table_vente`;
CREATE TABLE IF NOT EXISTS `table_vente` (
  `idVente` int(11) NOT NULL AUTO_INCREMENT,
  `date_vente` date NOT NULL,
  `idClient` int(11) NOT NULL,
  PRIMARY KEY (`idVente`),
  KEY `IdClient` (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `table_article`
--
ALTER TABLE `table_article`
  ADD CONSTRAINT `table_article_ibfk_1` FOREIGN KEY (`idUnivers`) REFERENCES `table_univers` (`idUnivers`),
  ADD CONSTRAINT `table_article_ibfk_2` FOREIGN KEY (`idCateg`) REFERENCES `table_categ` (`idCateg`),
  ADD CONSTRAINT `table_article_ibfk_3` FOREIGN KEY (`idFournisseur`) REFERENCES `table_fournisseur` (`idFournisseur`),
  ADD CONSTRAINT `table_article_ibfk_4` FOREIGN KEY (`idTaille`) REFERENCES `table_taille` (`idTaille`),
  ADD CONSTRAINT `table_article_ibfk_5` FOREIGN KEY (`idCouleur`) REFERENCES `table_couleur` (`idCouleur`),
  ADD CONSTRAINT `table_article_ibfk_6` FOREIGN KEY (`idIncrementale`) REFERENCES `table_incrementale` (`idIncrementale`),
  ADD CONSTRAINT `table_article_ibfk_7` FOREIGN KEY (`idLot`) REFERENCES `table_lot` (`idLot`);

--
-- Contraintes pour la table `table_categ`
--
ALTER TABLE `table_categ`
  ADD CONSTRAINT `table_categ_ibfk_1` FOREIGN KEY (`idUnivers`) REFERENCES `table_univers` (`idUnivers`);

--
-- Contraintes pour la table `table_detail_vente`
--
ALTER TABLE `table_detail_vente`
  ADD CONSTRAINT `table_detail_vente_ibfk_2` FOREIGN KEY (`idArticle`) REFERENCES `table_article` (`idArticle`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `table_detail_vente_ibfk_3` FOREIGN KEY (`idVente`) REFERENCES `table_vente` (`idVente`);

--
-- Contraintes pour la table `table_paiement`
--
ALTER TABLE `table_paiement`
  ADD CONSTRAINT `fkPaiement_client` FOREIGN KEY (`idClient`) REFERENCES `table_client` (`idClient`),
  ADD CONSTRAINT `fk_paiement_mode` FOREIGN KEY (`idmodePaiement`) REFERENCES `table_modepaiement` (`idModePaiement`),
  ADD CONSTRAINT `fkpaiement_vente` FOREIGN KEY (`idVente`) REFERENCES `table_vente` (`idVente`);

--
-- Contraintes pour la table `table_promotion`
--
ALTER TABLE `table_promotion`
  ADD CONSTRAINT `FKPromotionCateg` FOREIGN KEY (`idCateg`) REFERENCES `table_categ` (`idCateg`);

--
-- Contraintes pour la table `table_vente`
--
ALTER TABLE `table_vente`
  ADD CONSTRAINT `fk_vente_client` FOREIGN KEY (`idClient`) REFERENCES `table_client` (`idClient`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
