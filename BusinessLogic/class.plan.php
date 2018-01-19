<?php
	class plan
	{
		public function update_plan($pmatri_id,$name,$plan)
		{
			$sql="update payments set pname='$pname',p_plan='$p_plan, where pmatri_id='$pmatri_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($country_id,$status)
		{
			$sql="update country set status='$status' where country_id='$country_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_country_by_id($country_id)
		{
			$sql="select * from payments";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		
		
		public function get_country()
		{
			$sql="select * from country where status='1' order by country_id ASC LIMIT 0,20";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		
		/*public function get_countries($condition)
		{
			$sql="select * from country ".$condition." order by country_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}*/
		
		public function get_countries()
		{
			$sql="select * from payments";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
			
	}
?>