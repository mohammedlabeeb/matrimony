<?php
	class chat
	{
		public function change_status($id,$status)
		{
			$sql="update chat set status='$status' where id='$id'";
			mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_chat_by_id($id)
		{
			$sql="select * from chat where id='$id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_chat_status($status="")
		{
			$sql="select * from chat order by id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_chat($condition='')
		{
			$sql="select * from chat ".$condition."order by id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_chat($id)
		{
			$sql="delete from chat where id='$id'";
			mysql_query($sql) or mysql_error();			
		}		
	}
?>