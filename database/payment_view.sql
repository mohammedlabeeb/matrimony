CREATE OR REPLACE ALGORITHM = UNDEFINED VIEW payment_view as 
select pay.*,reg.index_id,reg.username,reg.gender 
from payments pay,register reg 
where reg.matri_id= pay.pmatri_id