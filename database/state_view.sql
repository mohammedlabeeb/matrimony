


CREATE OR REPLACE  ALGORITHM = UNDEFINED VIEW `state_view` AS select `st`.`state_id` AS `state_id`,`st`.`country_code` AS `country_code`,`st`.`state_code` AS `state_code`,`st`.`state_name` AS `state_name`,`st`.`status` AS `status`,`cnt`.`country_id` AS `cnt_id`,`cnt`.`country_name` AS `country_name` from (`state` `st` join `country` `cnt`) where (`st`.`country_code` = `cnt`.`country_code`);

