DROP TABLE IF EXISTS `prm_relation_type`;

CREATE TABLE IF NOT EXISTS `prm_relation_type` (
  `relation_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `description_left_to_right` varchar(2000) DEFAULT NULL,
  `description_right_to_left` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`relation_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
