<?php
	class country
	{
		public function add_country($country_name,$status)
		{
			$sql="insert into country(country_name,status) values('$country_name','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_country($country_id,$country_name,$status)
		{
			$sql="update country set country_name='$country_name',status='$status' where country_id='$country_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($country_id,$status)
		{
			$sql="update country set status='$status' where country_id='$country_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_country_by_id($country_id)
		{
			$sql="select * from country where status='APPROVED' && country_id='$country_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_country_by_status($status="")
		{
			if($status=="")
			$sql="select * from country where status='APPROVED' order by country_name";
			else
			$sql="select * from country where status='$status' order by country_name";
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_country()
		{
			$sql="select * from country where status='APPROVED' order by country_name ASC LIMIT 0,20";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		
		public function get_countries($condition)
		{
			$sql="select * from country ".$condition." order by country_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_country($country_id)
		{
			$sql="delete from country where country_id='$country_id' and (not exists(select * from state where state.country_id=country.country_id)) and (not exists(select * from city where city.country_id=country.country_id))";
			mysql_query($sql) or mysql_error();	
			if(mysql_affected_rows()==0)
			{
		?>
			<script>alert('Reference of this record is already exist.\nKindly Remove it first\n or Inactive this record.');</script>
		<?php
			}			
		}		
	}
?>