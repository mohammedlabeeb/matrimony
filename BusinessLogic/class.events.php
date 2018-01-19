<?php
	class event
	{
			
		public function update_event($id,$name,$date,$time,$venue,$image,$limit,$ticket,$description,$status)
		{
			$sql="update events set name='$name',event_date='$date',event_time='$time', venue='$venue',image='$image',limited='$limit',ticket='$ticket',description='$description',status='$status' where id='$id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($id,$status)
		{
			$sql="update events set status='$status' where id='$id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_event_by_id($id)
		{
			$sql="select * from events where id='$id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_event_by_status($status="")
		{
			if($status=="")
				 $sql="select * from events where status='APPROVED' order by name";
			else			
				 $sql="select * from events where status='$status' order by name";
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_event()
		{
			$sql="select * from events where status='APPROVED' order by id DESC";
			$result=mysql_query($sql) or die(mysql_error());
			return $result;
		}
		
		public function del_event($id)
		{
			$sql="delete from events where id='$id'";
			mysql_query($sql) or mysql_error();			
		}	
		
			public function get_events()
		{
			$sql="select * from events order by id ASC LIMIT 0,20";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}	
	}
?>