<?php
	class payments
	{
		public function add_payment($pmatri_id,$pname,$pemail,$paddress,$paymode,$pactive_dt,$p_plan,$plan_duration,$profile,$video,$chat,$p_no_contacts,$p_amount,$p_bank_detail,$p_msg,$exp_date)
		{
			$sql="insert into payments(pmatri_id,pname,pemail,paddress, paymode,pactive_dt,p_plan,plan_duration,profile,video,chat,p_no_contacts, p_amount,p_bank_detail,p_msg,exp_date) values('$pmatri_id','$pname','$pemail','$paddress','$paymode','$pactive_dt','$p_plan','$plan_duration','$profile','$video','$chat','$p_no_contacts','$p_amount','$p_bank_detail','$p_msg','$exp_date')";
			$result=mysql_query($sql) or die(mysql_error());
			return $result;
		}
		
		public function update_payment($pay_id,$pmatri_id,$pfirstname,$plastname,$pemail,$paddress,$paymode,$pactive_dt,$p_plan,$plan_duration,$p_no_contacts,$p_amount,$p_bank_detail)
		{
			$sql="update payments set pmatri_id='$pmatri_id',pfirstname='$pfirstname',plastname='$plastname',pemail='$pemail',paddress='$paddress',paymode='$paymode',pactive_dt='$pactive_dt',p_plan='$p_plan',plan_duration='$plan_duration',p_no_contacts='$p_no_contacts',p_amount='$p_amount',p_bank_detail='$p_bank_detail' where payid='$pay_id'";
			mysql_query($sql) or mysql_error();
		}
				
		public function get_payment_by_id($payid)
		{
			$sql="select payments.*,memship_plan.plan_name from payments inner join memship_plan on payments.p_plan=memship_plan.plan_id where payid='$payid'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
				
		public function get_payments($condition)
		{
			$sql="select payments.*,memship_plan.plan_name from payments inner join memship_plan on payments.p_plan=memship_plan.plan_id ".$condition."order by payid";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_payments($payid)
		{
			$sql="delete from payments where payid='$payid'";
			mysql_query($sql) or mysql_error();			
		}		
	}
?>