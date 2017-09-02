DROP TABLE user;

RENAME TABLE user_connection TO prm_user_connection;
ALTER TABLE `prm_attribute` DROP `user_id`;
ALTER TABLE `prm_company` DROP `user_id`;
ALTER TABLE `prm_company_attribute` DROP `user_id`;
ALTER TABLE `prm_configuration` DROP `user_id`;
ALTER TABLE `prm_contact` DROP `user_id`;
ALTER TABLE `prm_contact_attribute` DROP `user_id`;
ALTER TABLE `prm_file` DROP `user_id`;
ALTER TABLE `prm_note` DROP `user_id`;
ALTER TABLE `prm_relation_contact_to_contact` DROP `user_id`;
ALTER TABLE `prm_relation_type` DROP `user_id`;
DROP TABLE prm_user_connection;

DROP TABLE prm_relation_contact_to_contact;
DROP TABLE prm_relation_type;
