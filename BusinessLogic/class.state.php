<?php
	class state
	{
		public function add_state($country_id,$state_name,$status)
		{
			$sql="insert into state(country_id,state_name,status) values('$country_id','$state_name','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_state($country_id,$state_id,$state_name,$status)
		{
			$sql="update state set country_id='$country_id',state_name='$state_name',status='$status' where state_id='$state_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($state_id,$status)
		{
			$sql="update state set status='$status' where state_id='$state_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_state_by_id($state_id)
		{
			$sql="select * from state where  status='APPROVED' && state_id='$state_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_state_country_id($country_id,$status="")
		{
			if($status=="")
			$sql="select * from state where country_id='$country_id' && status='APPROVED' order by state_name";
			else
			$sql="select * from state where country_id='$country_id' and status='$status' order by state_name";
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_state_by_status($status="")
		{
			if($status=="")
				$sql="select * from state where status='APPROVED' order by state_name";				
			else
				$sql="select * from state where status='$status' order by state_name";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_states($condition)
		{
			$sql="select state.*,country.country_name from state inner join country using(country_id) ".$condition." order by state_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_state($state_id)
		{
			$sql="delete from state where state_id='$state_id' and (not exists(select * from city where city.state_id=state.state_id))";
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