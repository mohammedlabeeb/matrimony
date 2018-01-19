CREATE OR REPLACE VIEW caste_view as 
select cast.*,rel.religion_id AS rel_id,rel.religion_name 
from caste cast,religion rel 
where rel.religion_id= cast.religion_id