<?php
	class photoprotect
	{
		public function add_request($ph_requester_id,$ph_receiver_id,$ph_msg,$ph_reqdate,$receiver_response,$status)
		{
			$sql="insert into photoprotect_request(`ph_requester_id`, `ph_receiver_id`, `ph_msg`, `ph_reqdate`, `receiver_response`, `status`) values('$ph_requester_id','$ph_receiver_id','$ph_msg','$ph_reqdate','$receiver_response','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_request($ph_reqid,$ph_requester_id,$ph_receiver_id,$ph_msg,$ph_reqdate,$receiver_response,$status)
		{
			$sql="update photoprotect_request set ph_requester_id='$ph_requester_id',ph_receiver_id='$ph_receiver_id',ph_msg='$ph_msg',ph_reqdate='$ph_reqdate',receiver_response='$receiver_response',status='$status' where ph_reqid='$ph_reqid'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($ph_reqid,$status)
		{
			$sql="update photoprotect_request set status='$status' where ph_reqid='$ph_reqid'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_request_by_id($ph_reqid)
		{
			$sql="select * from photoprotect_request where ph_reqid='$ph_reqid'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_request_by_status($status)
		{
			$sql="select * from photoprotect_request where status='$status'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_requests()
		{
			$sql="select * from photoprotect_request order by ph_reqid desc";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_inbox($ph_receiver_id,$status)
		{
			$sql="select * from photoprotect_request where ph_receiver_id='$ph_receiver_id' and status='$status' order by ph_reqid desc";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_outbox($ph_requester_id,$status)
		{
			$sql="select * from photoprotect_request where ph_requester_id='$ph_requester_id' and status='$status' order by ph_reqid desc";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}		
		
		public function del_request($ph_reqid)
		{
			$sql="delete from photoprotect_request where ph_reqid='$ph_reqid'";
			mysql_query($sql) or mysql_error();			
		}		
	}
?>