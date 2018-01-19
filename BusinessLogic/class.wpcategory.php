<?php
	class wpcategory
	{
		public function add_wpcat($wp_cat_name,$status)
		{
			$sql="insert into wp_category(wp_cat_name,status)values('$wp_cat_name','$status')";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function update_wpcat($wp_cat_id,$wp_cat_name,$status)
		{
			$sql="update wp_category set wp_cat_name='$wp_cat_name',status='$status' where wp_cat_id='$wp_cat_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function change_status($wp_cat_id,$status)
		{
			$sql="update wp_category set status='$status' where wp_cat_id='$wp_cat_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_wpcat_by_id($wp_cat_id)
		{
			$sql="select * from wp_category where wp_cat_id='$wp_cat_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
	   public function get_wpcat_by_status($status)
		{
			$sql="select * from wp_category where status='$status'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_wpcat($condition="")
		{
			$sql="select * from wp_category ".$condition."  order by wp_cat_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_wpcat3()
		{
			$sql="select * from wp_category  where status='APPROVED'  order by wp_cat_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_wpcat2()
		{
			$sql="select * from wp_category ";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_wpcat_by_cat($wp_cat_id)
		{
			$sql="select * from wp_category where wp_cat_id='$wp_cat_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_wpcat($wp_cat_id)
		{
			$sql="delete from wp_category where wp_cat_id='$wp_cat_id'";
			mysql_query($sql) or mysql_error();			
		}		
	}
?>