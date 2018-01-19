<?php
	class sms{
		public function send_sms_msg($field)
		{
		/*	$fieldname; 
			switch ($field)
			{
			case "allsms_msg"
				$fieldname = "enable_sms_msg";
			case "regsms_msg"
					$fieldname = "reg_sms_msg";
			case "regemail"
					$fieldname = "email_sms_msg";
			}
			$sql="SELECT " . $fieldname . " FROM sms_msg_settings";*/
			$sql="SELECT " . $field . " FROM sms_msg_settings";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
	
	
	   public function change_status($id,$status)
		{
			$sql="update messages set status='$status' where id='$id'";
			mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_sms__by_id($id)
		{
			$sql="select * from messages where id='$id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_sms_status($status="")
		{
			$sql="select * from messages order by id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_sms($condition='')
		{
			$sql="select * from messages ".$condition."order by id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_sms($id)
		{
			$sql="delete from messages where id='$id'";
			mysql_query($sql) or mysql_error();			
		}	
				
	}
?>