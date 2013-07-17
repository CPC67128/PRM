--
-- Structure de la table `prm_file`
--

CREATE TABLE IF NOT EXISTS `prm_file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `record_type` smallint(6) NOT NULL,
  `record_id` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `original_filename` varchar(200) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


insert into prm_file
(  `record_type`,
  `record_id`,
  `filename`,
  `original_filename`)
SELECT 1,  contact_id,picture_file_name,picture_file_name
FROM prm_contact
WHERE picture_file_name is not null ;

ALTER TABLE `prm_file` ADD `creation_date` DATE NULL ;

update `prm_file`
set creation_date=now();
