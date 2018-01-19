<?php
	class religion
	{
		public function add_religion($religion_name,$status)
		{
			$sql="insert into religion(religion_name,status) values('$religion_name','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_religion($religion_id,$religion_name,$status)
		{
			$sql="update religion set religion_name='$religion_name',status='$status' where religion_id='$religion_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($religion_id,$status)
		{
			$sql="update religion set status='$status' where religion_id='$religion_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_religion_by_id($religion_id)
		{
			$sql="select * from religion where religion_id='$religion_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_religion_by_status($status="")
		{
			if($status=="")
			{
				$sql="select * from religion where status='APPROVED' order by religion_name";
			}
			else
			{
				$sql="select * from religion where status='$status' order by religion_name";
			}
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_religion()
		{
			$sql="select * from religion where status='APPROVED' order by religion_id ASC LIMIT 0,20";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		
		public function religions($condition="")
		{
			$sql="select * from religion ".$condition."order by religion_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_religion($religion_id)
		{
			$sql="delete from religion where religion_id='$religion_id' and (not exists(select * from caste where caste.religion_id=religion.religion_id))";
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