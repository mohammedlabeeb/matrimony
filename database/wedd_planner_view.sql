CREATE OR REPLACE ALGORITHM = UNDEFINED VIEW wedd_planner_view as 

select wd.*,sta.state_name,cnt.country_name,ct.city_name,wp.wp_cat_name

from  wedding_planner wd,state sta,country cnt,city ct,wp_category wp

where wd.wp_state=sta.state_id AND wd.wp_country = cnt.country_id AND wd.wp_city = ct.city_id AND wd.wp_cat_id=wp.wp_cat_id 