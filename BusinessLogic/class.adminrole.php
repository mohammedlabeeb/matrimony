<?php
	class adminrole
	{
		public function add_adminrole($role_name,$profile_add,$profile_edit,$profile_delete,$profile_email,$profile_read_only,$profile_status,$video_status,$chat_status,$matching_status,$wp_status,$adv_status,$cms_status,$payment_status,$mship_status,$member_status,$user_status,$site_status,$approval_status,$status)
		{
			$sql="insert into admin_role(`role_name`, `add_rights`, `edit_rights`,`delete_rights`,`email`,`read_only`, `profile_status`, `video_status`, `chat_status`, `matching_status`, `wp_status`, `adv_status`, `cms_status`,`payment_status`,`mship_status`,`member_status`,`user_status`,`site_status`,`approval_status`,`status`) values('$role_name','$profile_add','$profile_edit','$profile_delete','$profile_email','$profile_read_only','$profile_status','$video_status','$chat_status','$matching_status','$wp_status','$adv_status','$cms_status','$payment_status','$mship_status','$member_status','$user_status','$site_status','$approval_status','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_adminrole($role_id,$role_name,$profile_add,$profile_edit,$profile_delete,$profile_email,$profile_read_only,$profile_status,$video_status,$chat_status,$matching_status,$wp_status,$adv_status,$cms_status,$payment_status,$mship_status,$member_status,$user_status,$site_status,$approval_status,$status)
		{
			$sql="update admin_role set role_name='$role_name',add_rights='$profile_add',edit_rights='$profile_edit',delete_rights='$profile_delete',email='$profile_email',read_only='$profile_read_only',profile_status='$profile_status',video_status='$video_status',chat_status='$chat_status',matching_status='$matching_status',wp_status='$wp_status',adv_status='$adv_status',cms_status='$cms_status',payment_status='$payment_status',mship_status='$mship_status',member_status='$member_status',user_status='$user_status',site_status='$site_status',approval_status='$approval_status',status='$status' where role_id='$role_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($role_id,$status)
		{
			$sql="update admin_role set status='$status' where role_id='$role_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_role_by_id($role_id)
		{
			$sql="select * from admin_role where role_id='$role_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_role_status($status="")
		{
			if($status=="")
			$sql="select * from admin_role order by role_name";
			else
			$sql="select * from admin_role where status='$status' order by role_name";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_roles($condition='')
		{
			$sql="select * from admin_role ".$condition."order by role_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_role($role_id)
		{
			$sql="delete from admin_role where role_id='$role_id'";
			mysql_query($sql) or mysql_error();			
		}		
	}
?>