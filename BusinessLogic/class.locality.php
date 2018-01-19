<?php
	class locality
	{
		public function add_locality($city_id,$loc_name,$status)
		{
			$sql="insert into locality(city_id,loc_name,status) values('$city_id','$loc_name','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_locality($loc_id,$city_id,$loc_name,$status)
		{
			$sql="update locality set city_id='$city_id',loc_name='$loc_name',status='$status' where loc_id='$loc_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($loc_id,$status)
		{
			$sql="update locality set status='$status' where loc_id='$loc_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_locality_by_id($loc_id)
		{
			$sql="select * from locality where status='1' && loc_id='$loc_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_locality_city_id($city_id)
		{
			$sql="select * from locality where status='1' && city_id='$city_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		
		
		public function get_locality_by_status($status="")
		{
			if($status=="")
				$sql="select * from locality where status='1'  order by loc_name";
			else			
				$sql="select * from locality where status='$status' order by loc_name";
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_locality()
		{
			$sql="select * from locality where status='1' order by loc_id ASC LIMIT 0,20";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		public function get_locality2($condition)
		{
		    $sql="select locality.*,city.city_name from locality inner join city using(city_id) ".$condition."order by loc_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_locality($loc_id)
		{
			$sql="delete from locality where loc_id='$loc_id'";
			mysql_query($sql) or mysql_error();			
		}		
	}
?>