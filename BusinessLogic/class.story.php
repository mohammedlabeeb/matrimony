<?php
	class story
	{
		public function add_story($weddingphoto,$bridename,$brideid,$groomname,$groomid,$marriagedate,$successmessage,$status)
		{
			$sql="insert into success_story(`weddingphoto`, `bridename`, `brideid`, `groomname`, `groomid`, `marriagedate`, `successmessage`, `status`) values('$weddingphoto','$bridename','$brideid','$groomname','$groomid','$marriagedate','$successmessage','$status')";
			$result=mysql_query($sql) or die(mysql_error());
			return $result;
		}
		
		public function update_story($story_id,$weddingphoto,$bridename,$brideid,$groomname,$groomid,$marriagedate,$successmessage,$status)
		{
			$sql="update success_story set weddingphoto='$weddingphoto',bridename='$bridename',brideid='$brideid',groomname='$groomname',groomid='$groomid',marriagedate='$marriagedate',successmessage='$successmessage',status='$status' where story_id='$story_id'";
			$result=mysql_query($sql) or die(mysql_error());
			return $result;
		}
		
		public function change_status($story_id,$status)
		{
			$sql="update success_story set status='$status' where story_id='$story_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_story_by_id($story_id)
		{
			$sql="select * from success_story where story_id='$story_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_story_by_status($status)
		{
			$sql="select * from success_story where status='$status'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_stories($condition='')
		{
			$sql="select * from success_story ".$condition." order by story_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_story($story_id)
		{
			$sql="delete from success_story where story_id='$story_id'";
			mysql_query($sql) or mysql_error();			
		}
		
		public function get_story()
		{
			$sql="select * from success_story where status='1' order by story_id DESC LIMIT 0,1";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		public function get_story2()
		{
			$sql="select * from success_story where status='1' order by story_id DESC LIMIT 0,5 ";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
				
	}
?>