<?php
	class expressinterest 
	{
		public function add_expint($ei_sender,$ei_receiver,$receiver_response,$ei_message,$ei_sent_date,$ei_status)
		{
			$sql="insert into expressinterest(ei_sender,ei_receiver,receiver_response,ei_message,ei_sent_date,ei_status) values('$ei_sender','$ei_receiver','$receiver_response','$ei_message','$ei_sent_date','$ei_status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_expint($ei_id,$ei_sender,$ei_receiver,$receiver_response,$ei_message,$ei_sent_date,$ei_status)
		{
			$sql="update expressinterest set ei_sender='ei_sender',ei_receiver='$ei_receiver',receiver_response='$receiver_response',ei_message='$ei_message',ei_sent_date='$ei_sent_date',ei_status='$ei_status' where ei_id='$ei_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_ei_status($ei_id,$ei_status)
		{
			$sql="update expressinterest set ei_status='$ei_status' where ei_id='$ei_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_expint_by_id($ei_id)
		{
			$sql="select * from expressinterest";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
	
		
		public function get_expint_by_ei_status($ei_status)
		{
			$sql="select * from expressinterest where ei_status='$ei_status'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_expint($condition)
		{
			//$sql="select * from expressinterest where status='1' order by ei_id";
			$sql="select * from expressinterest".$condition;
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_expint($ei_id)
		{
			$sql="delete from expressinterest where ei_id='$ei_id'";
			mysql_query($sql) or mysql_error();			
		}		
	}
?>