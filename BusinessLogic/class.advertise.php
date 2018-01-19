<?php
	class advertisement
	{
		public function add_adv($adv_name,$adv_link,$contact_name,$adv_img,$phone,$datepicker,$status,$adv_level)
		{
			echo $sql="insert into advertisement(adv_date,adv_name,adv_link,adv_img,contact_name,phone,status,adv_level) values('$datepicker','$adv_name','$adv_link','$adv_img','$contact_name','$phone','$status','$adv_level')";
			mysql_query($sql) or die(mysql_error());
		}
		
		public function update_adv($adv_name,$adv_link,$contact_name,$adv_img,$phone,$datepicker,$status,$adv_id,$adv_level)
		{
			$sql="update advertisement set adv_name='$adv_name',adv_link='$adv_link',adv_img='$adv_img',contact_name='$contact_name',phone='$phone',status='$status',adv_date='$datepicker',adv_level='$adv_level' where adv_id='$adv_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($adv_id,$status)
		{
			$sql="update advertisement set status='$status' where adv_id='$adv_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_adv_by_id($adv_id)
		{
			$sql="select * from advertisement where adv_id='$adv_id'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
	    public function get_adv_by_status($status)
		{
			$sql="select * from advertisement where status='$status'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_adv($condition)
		{
			$sql="select * from advertisement ".$condition."order by adv_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function left_adv()
		{
			$sql="select * from advertisement where display='left'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		 
		public function right_adv()
		{
			$sql="select * from advertisement where display='right'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_adv($adv_id)
		{
			$sql="delete from advertisement where adv_id='$adv_id'";
			mysql_query($sql) or mysql_error();			
		}	
		
		
		public function add_adv2($adv_name,$adv_link,$adv_img,$contact,$phone,$status)
		{
			$sql="insert into advertisement(adv_date,adv_name,adv_link,adv_img,contact_name,phone,status) values(NOW(),'$adv_name','$adv_link','$adv_img','$contact','$phone','$status')";
			mysql_query($sql) or die(mysql_error());
		}	
	}
?>