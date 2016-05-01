-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 01 Mai 2016 à 21:05
-- Version du serveur :  5.5.47-MariaDB
-- Version de PHP :  5.6.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `prm`
--

-- --------------------------------------------------------

--
-- Structure de la table `prm_attribute`
--

CREATE TABLE `prm_attribute` (
  `user_id` varchar(40) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute` varchar(250) NOT NULL,
  `for_company` tinyint(1) NOT NULL,
  `for_contact` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prm_ccb`
--

CREATE TABLE `prm_ccb` (
  `application_name` varchar(30) NOT NULL,
  `database_version` int(11) NOT NULL,
  `upgrade_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prm_company`
--

CREATE TABLE `prm_company` (
  `user_id` varchar(40) NOT NULL,
  `company_id` int(11) NOT NULL,
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
  `comment` longtext,
  `picture_file_id` int(11) DEFAULT NULL,
  `next_action` longtext,
  `last_update` date DEFAULT NULL,
  `archived` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prm_company_attribute`
--

CREATE TABLE `prm_company_attribute` (
  `user_id` varchar(40) NOT NULL,
  `company_attribute_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `creation_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prm_configuration`
--

CREATE TABLE `prm_configuration` (
  `user_id` varchar(40) COLLATE latin1_german2_ci NOT NULL,
  `configuration_id` int(11) NOT NULL,
  `view_archived` tinyint(1) NOT NULL DEFAULT '0',
  `version` varchar(10) COLLATE latin1_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prm_contact`
--

CREATE TABLE `prm_contact` (
  `user_id` varchar(40) NOT NULL,
  `contact_id` int(11) NOT NULL,
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
  `picture_file_id` int(11) DEFAULT NULL,
  `vehicle_license_plate` varchar(100) DEFAULT NULL,
  `vehicle_model` varchar(200) DEFAULT NULL,
  `comment` longtext,
  `last_contact` date DEFAULT NULL,
  `regular_contact` tinyint(1) NOT NULL DEFAULT '0',
  `last_view` date DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `next_action` longtext,
  `archived` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prm_contact_attribute`
--

CREATE TABLE `prm_contact_attribute` (
  `user_id` varchar(40) NOT NULL,
  `contact_attribute_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `creation_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prm_file`
--

CREATE TABLE `prm_file` (
  `user_id` varchar(40) NOT NULL,
  `file_id` int(11) NOT NULL,
  `record_type` smallint(6) NOT NULL,
  `record_id` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `original_filename` varchar(200) NOT NULL,
  `creation_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prm_note`
--

CREATE TABLE `prm_note` (
  `user_id` varchar(40) NOT NULL,
  `note_id` int(11) NOT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `comment` varchar(2000) DEFAULT NULL,
  `creation_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prm_relation_contact_to_contact`
--

CREATE TABLE `prm_relation_contact_to_contact` (
  `user_id` varchar(40) NOT NULL,
  `relation_contact_to_contact_id` int(11) NOT NULL,
  `left_contact_id` int(11) NOT NULL,
  `relation_type_id` int(11) NOT NULL,
  `right_contact_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prm_relation_type`
--

CREATE TABLE `prm_relation_type` (
  `user_id` varchar(40) NOT NULL,
  `relation_type_id` int(11) NOT NULL,
  `description_left_to_right` varchar(2000) DEFAULT NULL,
  `description_right_to_left` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(40) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `subscription_date` date NOT NULL,
  `full_name` varchar(200) DEFAULT '',
  `read_only` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user_connection`
--

CREATE TABLE `user_connection` (
  `user_id` varchar(40) NOT NULL,
  `connection_date_time` datetime NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `browser` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `prm_attribute`
--
ALTER TABLE `prm_attribute`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Index pour la table `prm_company`
--
ALTER TABLE `prm_company`
  ADD PRIMARY KEY (`company_id`),
  ADD KEY `name` (`name`);

--
-- Index pour la table `prm_company_attribute`
--
ALTER TABLE `prm_company_attribute`
  ADD PRIMARY KEY (`company_attribute_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Index pour la table `prm_configuration`
--
ALTER TABLE `prm_configuration`
  ADD PRIMARY KEY (`configuration_id`);

--
-- Index pour la table `prm_contact`
--
ALTER TABLE `prm_contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`);

--
-- Index pour la table `prm_contact_attribute`
--
ALTER TABLE `prm_contact_attribute`
  ADD PRIMARY KEY (`contact_attribute_id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Index pour la table `prm_file`
--
ALTER TABLE `prm_file`
  ADD PRIMARY KEY (`file_id`);

--
-- Index pour la table `prm_note`
--
ALTER TABLE `prm_note`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `contact_id` (`contact_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Index pour la table `prm_relation_contact_to_contact`
--
ALTER TABLE `prm_relation_contact_to_contact`
  ADD PRIMARY KEY (`relation_contact_to_contact_id`);

--
-- Index pour la table `prm_relation_type`
--
ALTER TABLE `prm_relation_type`
  ADD PRIMARY KEY (`relation_type_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `prm_attribute`
--
ALTER TABLE `prm_attribute`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `prm_company`
--
ALTER TABLE `prm_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `prm_company_attribute`
--
ALTER TABLE `prm_company_attribute`
  MODIFY `company_attribute_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `prm_configuration`
--
ALTER TABLE `prm_configuration`
  MODIFY `configuration_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `prm_contact`
--
ALTER TABLE `prm_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `prm_contact_attribute`
--
ALTER TABLE `prm_contact_attribute`
  MODIFY `contact_attribute_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `prm_file`
--
ALTER TABLE `prm_file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `prm_note`
--
ALTER TABLE `prm_note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `prm_relation_contact_to_contact`
--
ALTER TABLE `prm_relation_contact_to_contact`
  MODIFY `relation_contact_to_contact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `prm_relation_type`
--
ALTER TABLE `prm_relation_type`
  MODIFY `relation_type_id` int(11) NOT NULL AUTO_INCREMENT;