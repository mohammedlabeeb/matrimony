<?php
	class edu_detail
	{
		public function add_edu($edu_name,$status)
		{
			$sql="insert into education_detail(edu_name,status) values('$edu_name','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_edu($edu_id,$edu_name,$status)
		{
			$sql="update education_detail set edu_name='$edu_name',status='$status' where edu_id='$edu_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($edu_id,$status)
		{
			$sql="update education_detail set status='$status' where edu_id='$edu_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_edu_by_id($edu_id)
		{
			$sql="select * from education_detail where edu_id='$edu_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_edu_by_status($status="")
		{
			if($status=="")
				$sql="select * from education_detail where status='APPROVED' order by edu_name";
			else	
				$sql="select * from education_detail where status='$status' order by edu_name";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_edu_details($condition)
		{
			$sql="select * from education_detail ".$condition."order by edu_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_edu($edu_id)
		{
			$sql="delete from education_detail where edu_id='$edu_id'";
			mysql_query($sql) or mysql_error();			
		}		
	}
?>