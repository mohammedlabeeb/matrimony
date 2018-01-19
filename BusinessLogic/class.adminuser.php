<?php
	class adminuser
	{
		public function add_admin($uname,$pswd,$roleid,$email,$status)
		{
			$sql="insert into admin_users(uname,pswd,role_id,email,status) values('$uname','$pswd','$roleid','$email','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_admin($id,$uname,$pswd,$roleid,$email,$status)
		{
			$sql="update admin_users set uname='$uname',pswd='$pswd',role_id='$roleid',email='$email',status='$status' where id='$id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($id,$status)
		{
			$sql="update admin_users set status='$status' where id='$id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_role($id,$roleid)
		{
			$sql="update admin_users set role_id='$roleid' where id='$id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_admin_by_id($id)
		{
			$sql="select * from admin_users where id='$id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_admin_by_status($status="")
		{
			if($status=="")			
			$sql="select * from admin_users order by uname";
			else
			$sql="select * from admin_users where status='$status' order by uname";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_adminusers($condition)
		{
			$sql="select admin_users.*,admin_role.role_name from admin_users inner join admin_role using(role_id) ".$condition."order by id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_adminuser($id)
		{
			$sql="delete from admin_users where id='$id'";
			mysql_query($sql) or mysql_error();			
		}
		
		public function login($uname,$pswd)
		{
			$sql="select * from admin_users u inner join admin_role r using(role_id) where u.uname='$uname' and u.pswd='$pswd' and u.status='1' and r.status='1'";
			$result=mysql_query($sql) or mysql_error();
			
			if(mysql_num_rows($result)==1)
			{
				$role_id=mysql_result($result,0,"role_id");	
				return $role_id;
			}
			else
			{
				return 0;
			}
		}
		
		public function change_password($uname,$pswd,$newpswd)
		{
			$mes="";
			$sql="select * from admin_users where uname='$uname' and pswd='$pswd'";
			$result=mysql_query($sql) or mysql_error();
			
			if(mysql_num_rows($result)==1)
			{
				$sql="update admin_users set pswd='$newpswd' where uname='$uname' and pswd='$pswd'";
				mysql_query($sql) or mysql_error();
				$mes="Your Password Has Been Changed.";
			}
			else
			{
				$mes="Old password is not Correct.";
			}
			
			return $mes;
		}		
	}
?>