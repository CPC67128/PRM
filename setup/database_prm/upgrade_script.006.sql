ALTER TABLE `prm_contact` ADD `picture_file_id` INT NULL AFTER `picture_file_name` ;

UPDATE prm_contact SET picture_file_id = ( SELECT file_id
FROM prm_file
WHERE original_filename = prm_contact.picture_file_name )
WHERE picture_file_name IS NOT NULL ;

ALTER TABLE `prm_contact` DROP `picture_file_name` ;


