ALTER TABLE `prm_company` CHANGE `comments` `comment` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;

INSERT INTO `prm_relation_type` (
`relation_type_id` ,
`description_left_to_right` ,
`description_right_to_left`
)
VALUES (
NULL , 'est marié(e) avec', 'est marié(e) avec'
);


ALTER TABLE `prm_relation_contact_to_contact` DROP `comment` ;

ALTER TABLE `prm_relation_contact_to_contact` ADD `relation_type_id` INT NOT NULL AFTER `left_contact_id` ;

INSERT INTO `prm_relation_type` (
`relation_type_id` ,
`description_left_to_right` ,
`description_right_to_left`
)
VALUES (
NULL , 'vit en union libre avec', 'vit en union libre avec'
);

INSERT INTO `prm_relation_type` (
`relation_type_id` ,
`description_left_to_right` ,
`description_right_to_left`
)
VALUES (
NULL , 'a été en contact professionnellement avec', 'a été en contact professionnellement avec'
);

