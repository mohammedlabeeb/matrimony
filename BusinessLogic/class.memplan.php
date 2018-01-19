<?php
	class memplan
	{
		public function add_plan($plan_name,$plan_display,$plan_contacts,$plan_duration,$plan_amount,$plan_offers,$plan_free_msg,$profile,$chat,$video,$status)
		{
			$sql="insert into memship_plan(`plan_name`, `plan_display`, `plan_contacts`, `plan_duration`, `plan_amount`, `plan_offers`, `plan_free_msg`,`profile`, `chat`, `video`, `status`) values('$plan_name','$plan_display','$plan_contacts','$plan_duration','$plan_amount','$plan_offers','$plan_free_msg','$profile','$chat','$video','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_plan($plan_id,$plan_name,$plan_display,$plan_contacts,$plan_duration,$plan_amount,$plan_offers,$plan_free_msg,$profile,$status,$chat,$video)
		{
			$sql="update memship_plan set plan_name='$plan_name',plan_display='$plan_display',plan_contacts='$plan_contacts',plan_duration='$plan_duration',plan_amount='$plan_amount',plan_offers='$plan_offers',plan_free_msg='$plan_free_msg',profile='$profile',status='$status',chat='$chat',video='$video' where plan_id='$plan_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($plan_id,$status)
		{
			$sql="update memship_plan set status='$status' where plan_id='$plan_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_plan_by_id($plan_id)
		{
			$sql="select * from memship_plan where plan_id='$plan_id' && status='1'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_plan_by_status($status="")
		{
			if($status=="")
				$sql="select * from memship_plan where status='1' order by plan_name";
			else
				$sql="select * from memship_plan where status='$status' order by plan_name";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_plans($condition="")
		{
			$sql="select * from memship_plan ".$condition."order by plan_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_plan($plan_id)
		{
			$sql="delete from memship_plan where plan_id='$plan_id'";
			mysql_query($sql) or mysql_error();			
		}		
	}
?>