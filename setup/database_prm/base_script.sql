-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Dim 11 Décembre 2011 à 16:39
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `private_relationship_manager`
--

-- --------------------------------------------------------

--
-- Structure de la table `prm_attribute`
--

DROP TABLE IF EXISTS `prm_attribute`;
CREATE TABLE IF NOT EXISTS `prm_attribute` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute` varchar(250) NOT NULL,
  `for_company` tinyint(1) NOT NULL,
  `for_contact` tinyint(1) NOT NULL,
  PRIMARY KEY (`attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structure de la table `prm_company`
--

DROP TABLE IF EXISTS `prm_company`;
CREATE TABLE IF NOT EXISTS `prm_company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `postal_name` varchar(255) DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `address_3` varchar(255) DEFAULT NULL,
  `address_4` varchar(255) DEFAULT NULL,
  `zip_country` varchar(5) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `cedex` varchar(20) DEFAULT NULL,
  `country` varchar(255) DEFAULT 'France',
  `phone` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `activities` longtext,
  `recruitment` longtext,
  `opening_hours` longtext,
  `comments` longtext,
  `next_action` longtext,
  `last_update` date DEFAULT NULL,
  `archived` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`company_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=314 ;

-- --------------------------------------------------------

--
-- Structure de la table `prm_company_attribute`
--

DROP TABLE IF EXISTS `prm_company_attribute`;
CREATE TABLE IF NOT EXISTS `prm_company_attribute` (
  `company_attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `creation_date` date DEFAULT NULL,
  PRIMARY KEY (`company_attribute_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `prm_configuration`
--

DROP TABLE IF EXISTS `prm_configuration`;
CREATE TABLE IF NOT EXISTS `prm_configuration` (
  `configuration_id` int(11) NOT NULL AUTO_INCREMENT,
  `view_archived` tinyint(1) NOT NULL DEFAULT '0',
  `version` varchar(10) NOT NULL,
  PRIMARY KEY (`configuration_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `prm_contact`
--

DROP TABLE IF EXISTS `prm_contact`;
CREATE TABLE IF NOT EXISTS `prm_contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `personal_address_1` varchar(50) DEFAULT NULL,
  `personal_address_2` varchar(50) DEFAULT NULL,
  `personal_address_3` varchar(50) DEFAULT NULL,
  `personal_zip` varchar(10) DEFAULT NULL,
  `personal_city` varchar(50) DEFAULT NULL,
  `personal_cedex` varchar(50) DEFAULT NULL,
  `personal_country` varchar(50) DEFAULT 'France',
  `personal_phone` varchar(100) DEFAULT NULL,
  `personal_mobile_phone` varchar(100) DEFAULT NULL,
  `personal_email_1` varchar(100) DEFAULT NULL,
  `personal_email_2` varchar(100) DEFAULT NULL,
  `personal_msn` varchar(50) DEFAULT NULL,
  `personal_icq` varchar(50) DEFAULT NULL,
  `personal_skype` varchar(200) DEFAULT NULL,
  `professional_skype` varchar(200) DEFAULT NULL,
  `personal_website` varchar(50) DEFAULT NULL,
  `personal_website_2` varchar(200) DEFAULT NULL,
  `personal_birthday` date DEFAULT NULL,
  `personal_birthplace` varchar(50) DEFAULT NULL,
  `company_id` int(11) DEFAULT '0',
  `professional_company` varchar(255) DEFAULT NULL,
  `professional_service` varchar(50) DEFAULT NULL,
  `professional_function` varchar(100) DEFAULT NULL,
  `professional_phone` varchar(100) DEFAULT NULL,
  `professional_phone_extension` varchar(50) DEFAULT NULL,
  `professional_mobile_phone` varchar(100) DEFAULT NULL,
  `professional_fax` varchar(100) DEFAULT NULL,
  `professional_email` varchar(100) DEFAULT NULL,
  `professional_email_2` varchar(200) DEFAULT NULL,
  `professional_website_1` varchar(200) DEFAULT NULL,
  `professional_website_2` varchar(200) DEFAULT NULL,
  `professional_viadeo` varchar(200) DEFAULT NULL,
  `professional_linkedin` varchar(200) DEFAULT NULL,
  `professional_twitter` varchar(200) DEFAULT NULL,
  `professional_login` varchar(50) DEFAULT NULL,
  `picture_file_name` varchar(200) DEFAULT NULL,
  `vehicle_license_plate` varchar(100) DEFAULT NULL,
  `vehicle_model` varchar(200) DEFAULT NULL,
  `comment` longtext,
  `last_contact` date DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `next_action` longtext,
  `archived` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`contact_id`),
  KEY `first_name` (`first_name`),
  KEY `last_name` (`last_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=783 ;

-- --------------------------------------------------------

--
-- Structure de la table `prm_contact_attribute`
--

DROP TABLE IF EXISTS `prm_contact_attribute`;
CREATE TABLE IF NOT EXISTS `prm_contact_attribute` (
  `contact_attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `creation_date` date DEFAULT NULL,
  PRIMARY KEY (`contact_attribute_id`),
  KEY `contact_id` (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Structure de la table `prm_note`
--

DROP TABLE IF EXISTS `prm_note`;
CREATE TABLE IF NOT EXISTS `prm_note` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `comment` varchar(2000) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  PRIMARY KEY (`note_id`),
  KEY `contact_id` (`contact_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=421 ;

-- --------------------------------------------------------

--
-- Structure de la table `prm_relation_contact_to_contact`
--

DROP TABLE IF EXISTS `prm_relation_contact_to_contact`;
CREATE TABLE IF NOT EXISTS `prm_relation_contact_to_contact` (
  `relation_contact_to_contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `left_contact_id` int(11) NOT NULL,
  `comment` varchar(2000) DEFAULT NULL,
  `right_contact_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`relation_contact_to_contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

