DROP TABLE IF EXISTS `prm_ccb`;

CREATE TABLE IF NOT EXISTS `prm_ccb` (
  `database_version` int(11) NOT NULL,
  `upgrade_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
