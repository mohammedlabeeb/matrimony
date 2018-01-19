

CREATE OR REPLACE ALGORITHM = UNDEFINED VIEW `city_view` AS select `ct`.`city_id` AS `city_id`,`ct`.`country_code` AS `country_code`,`ct`.`state_code` AS `state_code`,`ct`.`city_name` AS `city_name`,`ct`.`status` AS `status`,`st`.`state_name` AS `state_name`,`cnt`.`country_name` AS `country_name`,`st`.`state_id` AS `state_id`,`cnt`.`country_id` AS `cnt_id` from ((`city` `ct` join `state` `st`) join `country` `cnt`) where ((`ct`.`state_code` = `st`.`state_code`) and (`ct`.`country_code` = `cnt`.`country_code`));
