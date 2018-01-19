<?php

	class register
	{
		public function register_user($index_id,$matri_id,$prefix,$terms,$email,$password,$m_status,$profileby,$reference,$username,$firstname,$lastname,$gender,$birthdate,$birthtime,$birthplace,$tot_children,$status_children,
$edu_detail,$income,$occupation,$emp_in, $religion,$caste,$subcaste,$gothra,$star,$moonsign,$horoscope,$manglik,$m_tongue,$height,$weight,$b_group,$complexion,$bodytype,$diet,$smoke,$drink,$address,$country,$state,$city,$phone,$mobile,$residence,$father_name,$mother_name,$father_living_status,$mother_living_status,$father_occupation,$mother_occupation,$profile_text,$looking_status,$family_details,$family_value,$family_type,$family_status,$family_origin,$no_of_brothers,$no_of_sisters,$no_marri_brother,$no_marri_sister,$part_frm_age,$part_to_age,$part_income,$part_expect,$part_height,$part_height_to,$part_complexation,$part_mtongue,$part_religion,$part_caste,$part_edu,$part_country_living,$part_resi_status,$hobby,$interest,$photo_protect,$reg_date,$ip,$agent,$status,$adminrole_id,$adminrole_view_status)
		{
		
			 $sql="insert into register(index_id,matri_id,prefix, terms,email,password,m_status,profileby,reference,username,firstname,lastname,gender,birthdate,birthtime,birthplace,tot_children,status_children,edu_detail,income,occupation,emp_in,religion,caste,subcaste,gothra,star,moonsign,horoscope,manglik,m_tongue,height,weight,b_group,complexion,bodytype,diet,smoke,drink,address,country_id,state_id,city,phone,mobile,residence,father_name,mother_name,father_living_status,mother_living_status,father_occupation,mother_occupation,profile_text,looking_for,family_details,family_value,family_type,family_status,family_origin,no_of_brothers,no_of_sisters,no_marri_brother,no_marri_sister,part_frm_age,part_to_age,part_income,part_expect,part_height,part_height_to,part_complexation,part_mtongue,part_religion,part_caste,part_edu,part_country_living,part_resi_status,hobby,photo_protect,reg_date,ip,agent,status,adminrole_id,adminrole_view_status)values('NULL','$matri_id','$prefix','Yes','$email','$password','$m_status','$profileby','$reference','$firstname $lastname','$firstname','$lastname','$gender','$birthdate','$birthtime','$birthplace','$tot_children','$status_children','$edu_detail','$income','$occupation','$emp_in','$religion','$caste','$subcaste','$gothra','$star','$moonsign','$horoscope','$manglik','$m_tongue','$height','$weight','$b_group','$complexion','$bodytype','$diet','$smoke','$drink','$address','$country','$state','$city','$phone','$mobile','$residence','$father_name','$mother_name','$father_living_status','$mother_living_status','$father_occupation','$mother_occupation','$profile_text','$looking_status','$family_details','$family_value','$family_type','$family_status','$family_origin','$no_of_brothers','$no_of_sisters','$no_marri_brother','$no_marri_sister','$part_frm_age','$part_to_age','$part_income','$part_expect','$part_height','$part_height_to','$part_complexation','$part_mtongue','$part_religion','$part_caste','$part_edu','$part_country_living','$part_resi_status','$hobby','$photo_protect','$reg_date','$ip','$agent','$status','$adminrole_id','$adminrole_view_status')"; 
			$result=mysql_query($sql) or die(mysql_error());
			return $result;
		}
		
		public function temp_register($matri_id,$prefix,$email,$password,$cpassword,$profileby,$firstname,$lastname,$gender,$birthdate,$mobile) {
				
			 $sql="insert into `register` (`index_id`, `matri_id`, `prefix`, `terms`, `email`, `password`, `cpassword`, `cpass_status`, `m_status`, `profileby`, `pre_cnt_type`, `time_to_call`, `reference`, `username`, `firstname`, `lastname`, `gender`, `birthdate`, `birthtime`, `birthplace`, `tot_children`, `status_children`, `edu_detail`, `income`, `occupation`, `emp_in`, `religion`, `caste`, `subcaste`, `gothra`, `star`, `moonsign`, `horoscope`, `manglik`, `m_tongue`, `height`, `weight`, `b_group`, `complexion`, `bodytype`, `diet`, `smoke`, `drink`, `address`, `country_id`, `state_id`, `city`, `phone`, `mobile`, `contact_view_security`, `residence`, `father_name`, `mother_name`, `father_living_status`, `mother_living_status`, `father_occupation`, `mother_occupation`, `profile_text`, `looking_for`, `family_details`, `family_value`, `family_type`, `family_status`, `family_origin`, `no_of_brothers`, `no_of_sisters`, `no_marri_brother`, `no_marri_sister`, `part_frm_age`, `part_to_age`, `part_have_child`, `part_income`, `part_expect`, `part_height`, `part_height_to`, `part_complexation`, `part_mtongue`, `part_religion`, `part_caste`, `part_edu`, `part_country_living`, `part_resi_status`, `hobby`, `hor_check`, `hor_photo`, `photo_protect`, `photo_pswd`, `video`, `video_approval`, `video_url`, `photo1`, `photo1_approve`, `photo2`, `photo2_approve`, `photo3`, `photo3_approve`, `photo4`, `photo4_approve`, `photo5`, `photo5_approve`, `photo6`, `photo6_approve`, `reg_date`, `ip`, `agent`, `last_login`, `status`, `fstatus`, `logged_in`, `adminrole_id`, `adminrole_view_status`, `profile_for`) VALUES ('NULL', '$matri_id', '$prefix', 'Yes', '$email', '$password', '$cpassword', 'Yes', '', '$profileby', 'Mobile', 'Not Available', '', '$firstname $lastname', '$firstname', '$lastname', '$gender', '$birthdate', 'Not Available', '', NULL, '', '', 'Not Available', '', 'Not Available', '', '', 'Not Available', 'Not Available', 'Not Available', 'Not Available', NULL, '', '', '', NULL, 'Not Available', 'Not Available', 'Not Available', 'Not Available', '', '', '', '', '', NULL, 'Not Available', '', '$mobile', 'Not Available', 'Not Available', 'Not Available', 'Not Available', 'Not Available', 'Not Available', 'Not Available', '', '', 'Not Available', 'Not Available', 'Not Available', 'Not Available', 'Not Available', '0', '0', 'Not Available', 'Not Available', '18', '30', 'No', 'Not Available', 'Not Available', '4ft', '5ft', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')"; 
			
			$result=mysql_query($sql) or die(mysql_error());
			
		}
		
		public function delete_user($index_id)
		{
			//$sql="delete from register where index_id='$index_id'";
			$sql="delete from register where index_id='$index_id'";
			mysql_query($sql) or mysql_error();
			return result;
		}
	
		
		public function change_status($index_id,$status)
		{
			$sql="update register set status='$status' where index_id='$index_id'";
			mysql_query($sql) or mysql_error();	
			return result;		
		}
		public function change_status_featured($index_id,$status)
		{
			$sql="update register set fstatus='$status' where index_id='$index_id'"; 
			mysql_query($sql) or mysql_error();	
			return result;		
		}
		public function change_hor($index_id,$status)
		{
			$sql="update register set hor_approve='$status' where index_id='$index_id'";			
			mysql_query($sql) or mysql_error();	
			return result;		
		}
		
		
		public function login($uname,$pswd)
		{
			$sql="select * from register where email='$uname' and password='$pswd' and (not status='Inactive')";
			$result=mysql_query($sql) or mysql_error();
			
			if(mysql_num_rows($result)==1)
			{
				$status=mysql_result($result,0,"status");	
				return $status;
			}
			else
			{
				return "wrong";
			}
		}
		
		public function change_password($uname,$pswd,$newpswd)
		{
			$mes="";
			$sql="select * from register where email='$uname' and password='$pswd'";
			$result=mysql_query($sql) or mysql_error();
			
			if(mysql_num_rows($result)==1)
			{
				$sql="update register set password='$newpswd' where email='$uname' and password='$pswd'";
				mysql_query($sql) or mysql_error();
				$mes="Your Password Has Been Changed.";
			}
			else
			{
				$mes="Given Current Password is not Correct.";
			}
			
			return $mes;
		}
		
		public function update_basic_info($matri_id,$firstname,$lastname,$m_tongue,$religion,$caste,$subcaste)
		{
			$sql="update register set firstname='$firstname',lastname='$lastname',m_tongue='$m_tongue',religion='$religion',caste='$caste',subcaste='$subcaste' where (matri_id='$matri_id') or (email='$matri_id')";
			mysql_query($sql) or mysql_error();	
		}	
		
		
		public function update_edu_occ_info($matri_id,$physical_status,$edu_detail,$income,$occupation,$emp_in)
		{
			$sql="update register set physical_status='$physical_status',edu_detail='$edu_detail',income='$income',occupation='$occupation',emp_in='$emp_in' where (matri_id='$matri_id') or (email='$matri_id')";
			mysql_query($sql) or mysql_error();	
		}
		
		
		
		public function update_physical_info($matri_id,$height,$weight,$b_group,$complexion,$bodytype,$diet,$smoke,$drink)
		{
			$sql="update register set height='$height',weight='$weight',b_group='$b_group',complexion='$complexion',bodytype='$bodytype',diet='$diet',smoke='$smoke',drink='$drink' where (matri_id='$matri_id') or (email='$matri_id')";
			mysql_query($sql) or mysql_error();	
		}
		
		
		public function update_contact_info($matri_id,$address,$city,$country,$state,$phone,$mobile,$residence)
		{
			$sql="update register set address='$address',city='$city',country='country',state='$state',phone='$phone',mobile='$mobile',residence='$residence' where (matri_id='$matri_id') or (email='$matri_id')";
			mysql_query($sql) or mysql_error();	
		}
		
		public function update_horscope_info($matri_id,$gothra,$star,$moonsign,$horoscope,$manglik,$birthplace,$birthtime)
		{
			$sql="update register set gothra='$gothra',star='$star',moonsign='$moonsign',horoscope='$horoscope',manglik='$manglik',birthplace='$birthplace',birthtime='$birthtime' where (matri_id='$matri_id') or (email='$matri_id')";
			mysql_query($sql) or mysql_error();	
		}
		
		public function update_profile_info($matri_id,$profile_text)
		{
			$sql="update register set profile_text='$profile_text' where matri_id='$matri_id'";
			mysql_query($sql) or mysql_error();	
		}
		
	   public function update_family_info($matri_id,$family_details,$family_value,$family_type,$family_status,$family_origin,$no_of_brothers,$no_of_sisters,$no_marri_brother,$no_marri_sister,$father_occupation,$mother_occupation,$father_name,$mother_name,$father_living_status,$mother_living_status)
		{
			$sql="update register set family_details='$family_details',family_value='$family_value',family_type='$family_type',family_status='$family_status',family_origin='$family_origin',no_of_brothers='$no_of_brothers',no_of_sisters='$no_of_sisters',no_marri_brother='$no_marri_brother',no_marri_sister='$no_marri_sister',father_occupation='$father_occupation',mother_occupation='$mother_occupation',father_name='$father_name',mother_name='$mother_name',father_living_status='$father_living_status',mother_living_status='$mother_living_status' where (matri_id='$matri_id') or (email='$matri_id')";
			mysql_query($sql) or mysql_error();	
		}
		
		public function update_father_info($matri_id,$father_name,$father_living_status,$father_occupation)
		{
			$sql="update register set father_name='$father_name',father_living_status='$father_living_status',father_occupation='$father_occupation' where (matri_id='$matri_id') or (email='$matri_id')";
			mysql_query($sql) or mysql_error();	
		}
		
		public function update_mother_info($matri_id,$mother_name,$mother_living_status,$mother_occupation)
		{
			$sql="update register set mother_name='$mother_name',mother_living_status='$mother_living_status',mother_occupation='$mother_occupation' where (matri_id='$matri_id') or (email='$matri_id')";
			mysql_query($sql) or mysql_error();	
		}
		
		public function update_partner_info($matri_id,$looking_for,$part_frm_age,$part_to_age,$part_have_child,$part_expect,$part_country_living,$part_height,$part_complexation,$part_edu,$part_religion,$part_caste,$part_resi_status)
		{
			$sql="update register set looking_for='$looking_for',part_frm_age='$part_frm_age',part_to_age='$part_to_age',part_have_child='$part_have_child',part_expect='$part_expect',part_country_living='$part_country_living',part_height='$part_height',part_complexation='$part_complexation',part_edu='$part_edu',part_religion='$part_religion',part_caste='$part_caste',part_resi_status='$part_resi_status' where (matri_id='$matri_id') or (email='$matri_id')";
			mysql_query($sql) or mysql_error();	
		}
		
		
		public function update_hobby_interest_info($matri_id,$hobby,$other_hobby,$interest,$other_interest)
		{
			$sql="update register set hobby='$hobby',other_hobby='$other_hobby',interest='$interest',other_interest='$other_interest' where (matri_id='$matri_id') or (email='$matri_id')";
			mysql_query($sql) or mysql_error();	
		}
		
		public function get_basic_info($userid)
		{
			$sql="select reg.*,m.mtongue_name,rel.religion_name,c.caste_name from register reg left join mothertongue m on reg.m_tongue=m.mtongue_id inner join religion rel on  reg.religion=rel.religion_id inner join caste c on reg.caste=c.caste_id where (matri_id='$userid') or (email='$userid')";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		public function get_social_info($userid)
		{
			$sql="select gothra,star,moonsign,horoscope,manglik,birthplace,birthtime from register where (matri_id='$userid') or (email='$userid')";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		public function get_educational_info($userid)
		{
			$sql="select reg.physical_status,reg.edu_detail,reg.income,reg.occupation,reg.emp_in,edu.edu_name,ocp.ocp_name from register reg inner join physical_status_detail edu on reg.edu_detail=edu.edu_id inner join occupation ocp on reg.occupation=ocp.ocp_id where (matri_id='$userid') or (email='$userid')";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		public function get_physical_attributes($userid)
		{
			$sql="select height,weight,b_group,complexion,bodytype,diet,smoke,drink from register where (matri_id='$userid') or (email='$userid')";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		public function get_contact_details($userid)
		{
			$sql="select reg.*,st.state_name,ct.city_name,cn.country_name from city ct left join state st on ct.state_id=st.state_id inner join country cn on ct.country_id=cn.country_id,register reg where reg.city=ct.city_id and (matri_id='$userid') or (reg.email='$userid')";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		public function get_family_details($userid)
		{
			$sql="select family_details,family_value,family_type,family_status,family_origin,no_of_brothers,no_of_sisters,no_marri_brother,no_marri_sister,father_name,mother_name,father_living_status,mother_living_status,father_occupation,mother_occupation from register where (matri_id='$userid') or (email='$userid')";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		public function get_partner_details($userid)
		{
			$sql="select reg.looking_for,reg.part_frm_age,reg.part_to_age,reg.part_expect,cn.country_name,reg.part_height,reg.part_complexation,reg.part_edu,rel.religion_name,cast.caste_name,reg.part_resi_status from register reg inner join country cn on reg.part_country_living=cn.country_id inner join religion rel on reg.part_religion=rel.religion_id inner join caste cast on reg.part_caste=cast.caste_id where (matri_id='$userid') or (reg.email='$userid')";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		public function get_hobby_details($userid)
		{
			
			$sql="select hobby,other_hobby,interest,other_interest from register where email='$userid'";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		public function get_user()
		{
			$sql="select * from register order by index_id DESC LIMIT 0,20";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
			public function get_video()
		{
			$sql="select * from register order by index_id ASC LIMIT 0,1";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		public function get_user_detail($r,$condition="")
		{
			$sql="select * from register where adminrole_id='$r' && adminrole_view_status='Yes' ".$condition."order by index_id";
			$result=mysql_query($sql) or mysql_error();	
			return $result;
		}
		
		
		public function change_status_photo1($index_id,$photo1_approve)
		{
			$sql="update register set photo1_approve='$photo1_approve' where index_id='$index_id'";
			mysql_query($sql) or mysql_error();	
			return $result;		
		}
		
			public function del_photo1($index_id)
		{
			$sql="update register set photo1='nophoto.jpg' where index_id='$index_id'";
			mysql_query($sql) or mysql_error();	
			return $result;		
		}
		
		public function change_status_photo2($index_id,$photo2_approve)
		{
			$sql="update register set photo2_approve='$photo2_approve' where index_id='$index_id'";
			mysql_query($sql) or mysql_error();	
			return $result;		
		}
		
			public function del_photo2($index_id)
		{
			$sql="update register set photo2='nophoto.jpg' where index_id='$index_id'";
			mysql_query($sql) or mysql_error();	
			return $result;		
		}
		
		public function change_status_photo3($index_id,$photo3_approve)
		{
			$sql="update register set photo3_approve='$photo3_approve' where index_id='$index_id'";
			mysql_query($sql) or mysql_error();	
			return $result;		
		}
		
			public function del_photo3($index_id)
		{
			$sql="update register set photo3='nophoto.jpg' where index_id='$index_id'";
			mysql_query($sql) or mysql_error();	
			return $result;		
		}
		
		public function change_status_photo4($index_id,$photo4_approve)
		{
			$sql="update register set photo4_approve='$photo4_approve' where index_id='$index_id'";
			mysql_query($sql) or mysql_error();	
			return $result;		
		}
		
			public function del_photo4($index_id)
		{
			$sql="update register set photo4='nophoto.jpg' where index_id='$index_id'";
			mysql_query($sql) or mysql_error();	
			return $result;		
		}
}	

?>