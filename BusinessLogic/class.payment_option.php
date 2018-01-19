<?php
	class payment_option
	{
		public function add_pay($pay_name,$status)
		{
			$sql="insert into payment_method(pay_name,status) values('$pay_name','$status')";
			mysql_query($sql) or mysql_error();
		}
		
		public function update_pay($pay_id,$pay_name,$pay_email,$status)
		{
			$sql="update payment_method set pay_name='$pay_name',pay_email='$pay_email',status='$status' where pay_id='$pay_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function change_status($pay_id,$status)
		{
			$sql="update payment_method set status='$status' where pay_id='$pay_id'";
			mysql_query($sql) or mysql_error();
		}
		
		public function get_payment_method_by_id($pay_id)
		{
			$sql="select * from payment_method where pay_id='$pay_id' && status='1'";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_payment_method_by_status($status="")
		{
			if($status=="")
			{
				$sql="select * from payment_method  where status='1' order by pay_name";
			}
			else
			{
				$sql="select * from payment_method where status='$status' order by pay_name";
			}
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function get_payment_method()
		{
			$sql="select * from payment_method order by pay_id ASC LIMIT 0,20";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		
		public function payment_methods($condition="")
		{
			$sql="select * from payment_method ".$condition."order by pay_id";
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function del_payment_method($pay_id)
		{
			$sql="delete from payment_method where pay_id='$pay_id'";
			mysql_query($sql) or mysql_error();			
			return result;			
		}		
	}
?>