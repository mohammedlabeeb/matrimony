<?php
	class messages
	{
		public function add_msg($to_id,$from_id,$message,$sent_date,$status)
		{
			$sql="insert into messages(to_id,from_id,message,sent_date,status) values('$to_id','$from_id','$message','$sent_date','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_msg($to_id,$from_id,$message,$sent_date,$status,$mes_id)
		{
			$sql="update messages set to_id='$to_id',from_id='$from_id',message='$message',sent_date='$sent_date',status='$status' where mes_id='$mes_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($mes_id,$status)
		{
			$sql="update messages set status='$status' where mes_id='$mes_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_mes_by_id($mes_id)
		{
			$sql="select * from messages where mes_id='$mes_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
	
		
		public function get_mes_by_status($status)
		{
			$sql="select * from messages where status='$status'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_mes()
		{
			$sql="select * from messages order by mes_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_inbox($to_id,$status)
		{
			$sql="select * from messages where to_id='$to_id' and status='$status' order by mes_id desc";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_outbox($from_id,$status)
		{
			$sql="select * from messages where from_id='$from_id' and status='$status' order by mes_id desc";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_mes($mes_id)
		{
			$sql="delete from messages where mes_id='$mes_id'";
			mysql_query($sql) or mysql_error();			
		}		
	}
?>