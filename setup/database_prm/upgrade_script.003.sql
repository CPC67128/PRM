ALTER TABLE `prm_contact` ADD `last_view` DATE NULL AFTER `last_contact`;

ALTER TABLE `prm_contact` ADD `regular_contact` BOOLEAN NOT NULL DEFAULT '0' AFTER `last_contact` ;
