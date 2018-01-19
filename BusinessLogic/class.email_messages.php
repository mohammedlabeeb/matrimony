<?php
	class emailmessages 
	{
		public function add_emailmsg($sender_id,$receiver_id,$sent_time,$email_sub,$email_content,$status)
		{
			$sql="insert into email_details(sender_id ,receiver_id,sent_time,email_sub,email_content,status) values('$sender_id ','$receiver_id','$sent_time','$email_sub','$email_content','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_emailmsg($sender_id ,$receiver_id,$sent_time,$email_sub,$email_content,$status)
		{
			$sql="update email_details set sender_id ='sender_id ',receiver_id='$receiver_id',sent_time='$sent_time',email_sub='$email_sub',email_content='$email_content',status='$status' where email_id='$email_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($email_id,$status)
		{
			$sql="update email_details set status='$status' where email_id='$email_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_expint_by_id($email_id)
		{
			$sql="select * from email_details";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
	
		
		public function get_expint_by_status($status)
		{
			$sql="select * from email_details where status='$status'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_expint($condition)
		{
			//$sql="select * from expressinterest where status='1' order by ei_id";
			$sql="select * from email_details".$condition;
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_expint($email_id)
		{
			$sql="delete from email_details where email_id='$email_id'";
			mysql_query($sql) or mysql_error();			
		}		
	}
?>