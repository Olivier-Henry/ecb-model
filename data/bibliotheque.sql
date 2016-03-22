/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50624
 Source Host           : localhost
 Source Database       : bibliotheque

 Target Server Type    : MySQL
 Target Server Version : 50624
 File Encoding         : utf-8

 Date: 03/22/2016 13:50:26 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `auteurs`
-- ----------------------------
DROP TABLE IF EXISTS `auteurs`;
CREATE TABLE `auteurs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `auteurs`
-- ----------------------------
BEGIN;
INSERT INTO `auteurs` VALUES ('1', 'Adams', 'Douglas'), ('2', 'Herbert', 'Frank'), ('3', 'Sartre', 'J.P.'), ('4', 'Lordon', 'F.'), ('5', 'Brin', 'David'), ('6', 'Kant', 'Emmanuel'), ('7', 'Alain', ''), ('8', 'Asimov', 'Isaac'), ('9', 'Heinlein', 'Robert'), ('10', 'Platon', ''), ('11', 'Pascal', 'Blaise'), ('12', 'Martin', 'Robert'), ('13', 'Celko', 'Joe'), ('14', 'Soutou', 'Christian'), ('15', 'Highsmith', 'Patricia'), ('16', 'Karwin', 'Bill'), ('17', 'Hunt', 'Andrew');
COMMIT;

-- ----------------------------
--  Table structure for `editeurs`
-- ----------------------------
DROP TABLE IF EXISTS `editeurs`;
CREATE TABLE `editeurs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `editeurs`
-- ----------------------------
BEGIN;
INSERT INTO `editeurs` VALUES ('1', 'Grasset'), ('2', 'Hachette'), ('3', 'PUF'), ('4', 'Robert Laffont'), ('5', 'Dunod'), ('6', 'Eyrolles'), ('7', 'La Fabrique'), ('8', 'Morgan Kauffmann'), ('9', 'O\'Reilly'), ('10', 'Addison Wesley');
COMMIT;

-- ----------------------------
--  Table structure for `genres`
-- ----------------------------
DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `genre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `genres`
-- ----------------------------
BEGIN;
INSERT INTO `genres` VALUES ('1', 'Science fiction'), ('2', 'Essai'), ('3', 'Philosophie'), ('4', 'Informatique'), ('5', 'Roman policier'), ('6', 'Théâtre');
COMMIT;

-- ----------------------------
--  Table structure for `livres`
-- ----------------------------
DROP TABLE IF EXISTS `livres`;
CREATE TABLE `livres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `prix` float(5,2) NOT NULL,
  `date_achat` date NOT NULL,
  `editeur_id` int(10) unsigned NOT NULL,
  `auteur_id` int(10) unsigned NOT NULL,
  `genre_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `livres_to_editeur` (`editeur_id`),
  KEY `livres_to_auteur` (`auteur_id`),
  KEY `livres_to_genre` (`genre_id`),
  CONSTRAINT `livres_to_auteur` FOREIGN KEY (`auteur_id`) REFERENCES `auteurs` (`id`),
  CONSTRAINT `livres_to_editeur` FOREIGN KEY (`editeur_id`) REFERENCES `editeurs` (`id`),
  CONSTRAINT `livres_to_genre` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `livres`
-- ----------------------------
BEGIN;
INSERT INTO `livres` VALUES ('1', 'Le guide du routard intergallactique', '13.00', '2000-04-12', '1', '1', '1'), ('2', 'Dune', '18.00', '1990-08-06', '2', '2', '1'), ('3', 'La nausée', '12.50', '1990-05-12', '3', '3', '2'), ('4', 'Désir et servitude', '9.00', '2000-12-06', '3', '4', '2'), ('5', 'Elévation', '11.00', '2000-05-09', '1', '5', '1'), ('6', 'Critique de la raison pure', '12.00', '1980-08-13', '3', '6', '3'), ('7', 'Propos sur le bonheur', '9.00', '1980-05-12', '3', '7', '3'), ('8', 'Fondation', '14.00', '1990-08-21', '4', '8', '1'), ('9', 'En terre étrangère', '10.00', '1980-10-06', '4', '9', '1'), ('10', 'La République', '8.00', '1990-04-17', '3', '10', '3'), ('11', 'Pensées', '11.00', '2000-12-22', '2', '11', '3'), ('12', 'Discours de la méthode', '9.00', '2000-02-17', '2', '11', '3'), ('13', 'Coder proprement', '18.00', '2005-08-12', '5', '12', '4'), ('14', 'SQL Avancé', '45.00', '2005-05-18', '5', '13', '4'), ('15', 'Programmer avec MySQL', '35.00', '2005-09-16', '6', '14', '4'), ('16', 'Crimes presque parfaits', '28.00', '2008-08-16', '2', '15', '5'), ('17', 'Carol', '22.00', '2012-02-21', '2', '15', '5'), ('18', 'Des chats et des hommes', '22.00', '2012-04-21', '2', '15', '5'), ('19', 'Sur les pas de Ripley', '22.00', '2012-08-15', '2', '15', '5'), ('20', 'L\'inconnu du Nord Express', '22.00', '2012-09-24', '2', '15', '5'), ('21', 'Ripley et les ombres', '22.00', '2012-07-11', '2', '15', '5'), ('26', 'D\'un retournement l\'autre', '9.00', '2012-04-21', '7', '4', '6'), ('27', 'Imperium', '15.00', '2012-04-21', '7', '4', '2'), ('28', 'Et la vertu sauvera le monde', '6.00', '2012-04-21', '7', '4', '2'), ('29', 'Economistes à gages', '7.50', '2012-04-21', '7', '4', '2'), ('30', 'SQL for smarties', '55.86', '2009-03-25', '8', '13', '4'), ('31', 'Data and Databases : Concepts in Practice', '67.47', '2000-10-28', '8', '13', '4'), ('32', 'Thinking in Sets : Auxiliary, Temporal, and Virtual Tables in SQL', '28.43', '2010-01-08', '8', '13', '4'), ('33', 'SQL Antipatterns', '33.44', '2013-09-23', '9', '16', '4'), ('34', 'The pragmatic programmer : Form journeyman to master', '33.85', '2000-07-10', '10', '17', '4');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
