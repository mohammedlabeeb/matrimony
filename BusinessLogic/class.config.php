<?php
	class siteconfig
	{
		
		public function get_site_by_id($id)
		{
			$sql="select * from site_config where id='$id'";
			$result=mysql_query($sql) or die(mysql_error());
			return $result;
		}
		
		public function update_site($web_logo_path,$favicon,$web_name,$web_frienly_name,$title,$description,$keywords,$google_analytics_code,$footer,$from_email,$to_email,$feedback_email,$contact_email,$top_line1,$id,$con_number)
		{

		$s="update site_config set web_logo_path='$web_logo_path',favicon='$favicon',web_name='$web_name',web_frienly_name='$web_frienly_name',title='$title',description='$description',keywords='$keywords',google_analytics_code='$google_analytics_code',footer='$footer',from_email='$from_email',to_email='$to_email',feedback_email='$feedback_email',contact_email='$contact_email',top_line1='$top_line1',contact_no='$con_number' where id=1";
		
		$result=mysql_query($s) or die(mysql_error());
		return $result;
			
		}
	}
?>