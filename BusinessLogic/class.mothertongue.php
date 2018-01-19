<?php
	class mothertongue
	{
		public function add_mtongue($mtongue_name,$status)
		{
			$sql="insert into mothertongue(mtongue_name,status) values('$mtongue_name','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_mtongue($mtongue_id,$mtongue_name,$status)
		{
			$sql="update mothertongue set mtongue_name='$mtongue_name',status='$status' where mtongue_id='$mtongue_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($mtongue_id,$status)
		{
			$sql="update mothertongue set status='$status' where mtongue_id='$mtongue_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_mtongue_by_id($mtongue_id)
		{
			$sql="select * from mothertongue where mtongue_id='$mtongue_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_mtongue_by_status($status="")
		{
			if($status=="")
				$sql="select * from mothertongue where status='APPROVED' order by mtongue_name";
			else			
				 $sql="select * from mothertongue where status='$status' order by mtongue_name";
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_mothertongues($condition)
		{
			$sql="select * from mothertongue ".$condition."order by mtongue_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_mtongue($mtongue_id)
		{
			$sql="delete from mothertongue where mtongue_id='$mtongue_id'";
			mysql_query($sql) or mysql_error();			
		}	
		
			public function get_mtongue()
		{
			$sql="select * from mothertongue order by mtongue_name ASC";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}	
	}
?>