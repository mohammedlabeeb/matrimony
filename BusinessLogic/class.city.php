<?php
	class city
	{
		public function add_city($state_id,$country_id,$city_name,$status)
		{
			$sql="insert into city(state_id,country_id,city_name,status) values('$state_id','$country_id','$city_name','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_city($country_id,$state_id,$city_id,$city_name,$status)
		{
			$sql="update city set state_id='$state_id',country_id='$country_id',city_name='$city_name',status='$status' where city_id='$city_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($city_id,$status)
		{
			$sql="update city set status='$status' where city_id='$city_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_city_by_id($city_id)
		{
			$sql="select * from city where status='APPROVED' && city_id='$city_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_city_country_id($country_id)
		{
			$sql="select * from city where status='APPROVED' && country_id='$country_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_city_state_id($state_id)
		{
			$sql="select * from city where status='APPROVED' && state_id='$state_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_city_by_status($status="")
		{
			if($status=="")
				$sql="select * from city where status='APPROVED' order by city_name";
			else			
				$sql="select * from city where status='$status' order by city_name";
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_city()
		{
			$sql="select * from city where status='APPROVED' order by city_id ASC LIMIT 0,20";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		public function get_cities($condition)
		{
			$sql="select city.*,IFNULL(state.state_name,'') as state_name,country.country_name from city left join state on city.state_id=state.state_id left join country on city.country_id=country.country_id ".$condition."order by city_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_city($city_id)
		{
			$sql="delete from city where city_id='$city_id'";
			mysql_query($sql) or mysql_error();			
		}		
	}
?>