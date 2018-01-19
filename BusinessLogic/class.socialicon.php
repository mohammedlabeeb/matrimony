<?php
	class socialicon
	{
		public function add_icon($name,$slink,$status)
		{
			$sql="insert into social_networking_icon(sname,slink,status) values('$name','$slink','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_icon($name,$slink,$status,$sid)
		{
			$sql="update social_networking_icon set sname='$name',slink='$slink',status='$status' where sid='$sid'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($sid,$status)
		{
			$sql="update social_networking_icon set status='$status' where sid='$sid'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_icon_by_id($sid)
		{
		  $sql="select * from social_networking_icon where sid='$sid' and status='APPROVED'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
	    public function get_icon_by_status($status)
		{
			$sql="select * from social_networking_icon where status='$status'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_icon($condition)
		{
			$sql="select * from social_networking_icon ".$condition."order by sid";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		

		
		public function del_icon($sid)
		{
			$sql="delete from social_networking_icon where sid='$sid'";
			mysql_query($sql) or mysql_error();			
		}		
	}
?>