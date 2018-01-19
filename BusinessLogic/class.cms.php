<?php
	class cms
	{
		
		public function update_cms($cms_id,$cms_title,$cms_content)
		{
			$sql="update cms_pages set cms_title='$cms_title',cms_content='$cms_content' where cms_id='$cms_id'";
			mysql_query($sql) or mysql_error();
		}
		
	
		
		public function get_cms_by_id($cms_id)
		{
			$sql="select * from cms_pages where cms_id='$cms_id' && status='APPROVED'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		
		public function get_cms($condition="")
		{
			$sql="select * from cms_pages ".$condition."order by cms_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		
		public function change_status($cms_id,$status)
		{
			$sql="update cms_pages set status='$status' where cms_id='$cms_id'";
			mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_cms($cms_id)
		{
			$sql="delete from cms_pages where cms_id='$cms_id'";
			mysql_query($sql) or mysql_error();	
			return $result;		
		}		
	}
?>