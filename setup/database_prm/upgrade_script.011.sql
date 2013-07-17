ALTER TABLE `sf_prm_attribute` ADD `user_id` BIGINT NOT NULL FIRST ;
ALTER TABLE `sf_prm_company` ADD `user_id` BIGINT NOT NULL FIRST ;
ALTER TABLE `sf_prm_company_attribute` ADD `user_id` BIGINT NOT NULL FIRST ;
ALTER TABLE `sf_prm_configuration` ADD `user_id` BIGINT NOT NULL FIRST ;
ALTER TABLE `sf_prm_contact` ADD `user_id` BIGINT NOT NULL FIRST ;
ALTER TABLE `sf_prm_contact_attribute` ADD `user_id` BIGINT NOT NULL FIRST ;
ALTER TABLE `sf_prm_file` ADD `user_id` BIGINT NOT NULL FIRST ;
ALTER TABLE `sf_prm_note` ADD `user_id` BIGINT NOT NULL FIRST ;
ALTER TABLE `sf_prm_relation_contact_to_contact` ADD `user_id` BIGINT NOT NULL FIRST ;
ALTER TABLE `sf_prm_relation_type` ADD `user_id` BIGINT NOT NULL FIRST ;

ALTER TABLE `sf_prm_configuration`
  DROP `version`;


