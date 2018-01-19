<?php
	class occupation
	{
		public function add_ocp($ocp_name,$status)
		{
			$sql="insert into occupation(ocp_name,status) values('$ocp_name','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_ocp($ocp_id,$ocp_name,$status)
		{
			$sql="update occupation set ocp_name='$ocp_name',status='$status' where ocp_id='$ocp_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($ocp_id,$status)
		{
			$sql="update occupation set status='$status' where ocp_id='$ocp_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_ocp_by_id($ocp_id)
		{
			$sql="select * from occupation where ocp_id='$ocp_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_ocp_by_status($status="")
		{
			if($status=="")
				$sql="select * from occupation where status='APPROVED' order by ocp_name";				
			else			
				$sql="select * from occupation where status='$status' order by ocp_name";
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_occupations($condition)
		{
			$sql="select * from occupation ".$condition."order by ocp_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_ocp($ocp_id)
		{
			$sql="delete from occupation where ocp_id='$ocp_id'";
			mysql_query($sql) or mysql_error();			
		}	
		
		public function get_ocp()
		{
			$sql="select * from occupation order by ocp_id ASC LIMIT 0,20";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}		
	}
?>