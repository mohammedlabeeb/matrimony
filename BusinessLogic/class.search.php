<?php
	class search
	{
		public function simple_search($gender,$religion,$caste,$fromyr,$toyr)
		{
			$sql="select r.*,edu.edu_name,ocp.ocp_name,rel.religion_name,rel1.religion_name as 

part_religion,c.caste_name,c1.caste_name as part_caste,mt.mtongue_name as 

m_tongue,mt1.mtongue_name as 

part_mtongue,ct.city_name,st.state_name,cn.country_name,cn1.country_name as 

part_country_living from register r inner join education_detail edu on 

r.edu_detail=edu.edu_id inner join occupation ocp on r.occupation=ocp.ocp_id 

inner join religion rel on r.religion=rel.religion_id inner join religion 

rel1 on r.part_religion=rel1.religion_id inner join caste c on 

r.caste=c.caste_id inner join caste c1 on r.part_caste=c1.caste_id inner join 

mothertongue mt on r.m_tongue=mt.mtongue_id inner join mothertongue mt1 on 

r.part_mtongue=mt1.mtongue_id inner join city ct on r.city=ct.city_id inner 

join state st on ct.state_id=st.state_id inner join country cn on 

ct.country_id=cn.country_id inner join country cn1 on 

r.part_country_living=cn1.country_id WHERE ((
			(
			date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )
			) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
			)
			BETWEEN '$fromyr'
			AND '$toyr') and gender='$gender' and religion='1'";
			
			if($caste!='')
			{
				$sql.=" and caste='$caste'";
			}
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function regular_search($looking_for,$m_status,$fromyr,$toyr,$fromheight,$toheight,$religion,$caste,$m_tongue,$education,$occupation,$country)
		{
			$sql="select r.*,edu.edu_name,ocp.ocp_name,rel.religion_name,rel1.religion_name as 

part_religion,c.caste_name,c1.caste_name as part_caste,mt.mtongue_name as 

m_tongue,mt1.mtongue_name as 

part_mtongue,ct.city_name,st.state_name,cn.country_name,cn1.country_name as 

part_country_living from register r inner join education_detail edu on 

r.edu_detail=edu.edu_id inner join occupation ocp on r.occupation=ocp.ocp_id 

inner join religion rel on r.religion=rel.religion_id inner join religion 

rel1 on r.part_religion=rel1.religion_id inner join caste c on 

r.caste=c.caste_id inner join caste c1 on r.part_caste=c1.caste_id inner join 

mothertongue mt on r.m_tongue=mt.mtongue_id inner join mothertongue mt1 on 

r.part_mtongue=mt1.mtongue_id inner join city ct on r.city=ct.city_id inner 

join state st on ct.state_id=st.state_id inner join country cn on 

ct.country_id=cn.country_id inner join country cn1 on 

r.part_country_living=cn1.country_id
			WHERE ((
			(
			date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )
			) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
			)
			BETWEEN '$fromyr'
			AND '$toyr') and (height between '$fromheight' and '$toheight') and gender='$gender' and m_status='$m_status'";
			
			if($religion!='')
			{
				$sql.=" and religion='$religion'";
			}
			

			if($caste!='')
			{
				$sql.=" and caste='$caste'";
			}
			
			
			if($m_tongue!='')
			{
				$sql.=" and m_tongue='$m_tongue'";				
			}
			
			if($education!='')
			{
				$sql.=" and education='$education'";
			}
			
			if($occupation!='')
			{
				$sql.=" and occupation='$occupation'";			
			}
			
			if($country!='')
			{
				$sql.=" and ";
			}
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function keyword_search($gender,$fromyr,$toyr,$keyword)
		{
			$sql="select r.*,edu.edu_name,ocp.ocp_name,rel.religion_name,rel1.religion_name as 

part_religion,c.caste_name,c1.caste_name as part_caste,mt.mtongue_name as 

m_tongue,mt1.mtongue_name as 

part_mtongue,ct.city_name,st.state_name,cn.country_name,cn1.country_name as 

part_country_living from register r inner join education_detail edu on 

r.edu_detail=edu.edu_id inner join occupation ocp on r.occupation=ocp.ocp_id 

inner join religion rel on r.religion=rel.religion_id inner join religion 

rel1 on r.part_religion=rel1.religion_id inner join caste c on 

r.caste=c.caste_id inner join caste c1 on r.part_caste=c1.caste_id inner join 

mothertongue mt on r.m_tongue=mt.mtongue_id inner join mothertongue mt1 on 

r.part_mtongue=mt1.mtongue_id inner join city ct on r.city=ct.city_id inner 

join state st on ct.state_id=st.state_id inner join country cn on 

ct.country_id=cn.country_id inner join country cn1 on 

r.part_country_living=cn1.country_id
			WHERE ((
			(
			date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )
			) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
			)
			BETWEEN '$fromyr'
			AND '$toyr') and gender='$gender' and education='$keyword' or edu_detail='$keyword'";
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		
		public function education_search($gender,$fromyr,$toyr,$edu_detail)
		{
			$sql="select r.*,edu.edu_name,ocp.ocp_name,rel.religion_name,rel1.religion_name as 

part_religion,c.caste_name,c1.caste_name as part_caste,mt.mtongue_name as 

m_tongue,mt1.mtongue_name as 

part_mtongue,ct.city_name,st.state_name,cn.country_name,cn1.country_name as 

part_country_living from register r inner join education_detail edu on 

r.edu_detail=edu.edu_id inner join occupation ocp on r.occupation=ocp.ocp_id 

inner join religion rel on r.religion=rel.religion_id inner join religion 

rel1 on r.part_religion=rel1.religion_id inner join caste c on 

r.caste=c.caste_id inner join caste c1 on r.part_caste=c1.caste_id inner join 

mothertongue mt on r.m_tongue=mt.mtongue_id inner join mothertongue mt1 on 

r.part_mtongue=mt1.mtongue_id inner join city ct on r.city=ct.city_id inner 

join state st on ct.state_id=st.state_id inner join country cn on 

ct.country_id=cn.country_id inner join country cn1 on 

r.part_country_living=cn1.country_id
			WHERE ((
			(
			date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )
			) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
			)
			BETWEEN '$fromyr'
			AND '$toyr') and gender='$gender' and  edu_detail='$edu_detail'";
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		
		public function occupational_search($gender,$fromyr,$toyr,$occupation)
		{
			$sql="select r.*,edu.edu_name,ocp.ocp_name,rel.religion_name,rel1.religion_name as 

part_religion,c.caste_name,c1.caste_name as part_caste,mt.mtongue_name as 

m_tongue,mt1.mtongue_name as 

part_mtongue,ct.city_name,st.state_name,cn.country_name,cn1.country_name as 

part_country_living from register r inner join education_detail edu on 

r.edu_detail=edu.edu_id inner join occupation ocp on r.occupation=ocp.ocp_id 

inner join religion rel on r.religion=rel.religion_id inner join religion 

rel1 on r.part_religion=rel1.religion_id inner join caste c on 

r.caste=c.caste_id inner join caste c1 on r.part_caste=c1.caste_id inner join 

mothertongue mt on r.m_tongue=mt.mtongue_id inner join mothertongue mt1 on 

r.part_mtongue=mt1.mtongue_id inner join city ct on r.city=ct.city_id inner 

join state st on ct.state_id=st.state_id inner join country cn on 

ct.country_id=cn.country_id inner join country cn1 on 

r.part_country_living=cn1.country_id
			WHERE ((
			(
			date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )
			) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
			)
			BETWEEN '$fromyr'
			AND '$toyr') and gender='$gender' and occupation='$occupation'";
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		public function matrimonyiD_search($matid)
		{
			$sql="select r.*,edu.edu_name,ocp.ocp_name,rel.religion_name,rel1.religion_name as 

part_religion,c.caste_name,c1.caste_name as part_caste,mt.mtongue_name as 

m_tongue,mt1.mtongue_name as 

part_mtongue,ct.city_name,st.state_name,cn.country_name,cn1.country_name as 

part_country_living from register r inner join education_detail edu on 

r.edu_detail=edu.edu_id inner join occupation ocp on r.occupation=ocp.ocp_id 

inner join religion rel on r.religion=rel.religion_id inner join religion 

rel1 on r.part_religion=rel1.religion_id inner join caste c on 

r.caste=c.caste_id inner join caste c1 on r.part_caste=c1.caste_id inner join 

mothertongue mt on r.m_tongue=mt.mtongue_id inner join mothertongue mt1 on 

r.part_mtongue=mt1.mtongue_id inner join city ct on r.city=ct.city_id inner 

join state st on ct.state_id=st.state_id inner join country cn on 

ct.country_id=cn.country_id inner join country cn1 on 

r.part_country_living=cn1.country_id
			WHERE  matri_id='$matid'";
			
			
			
			$result=mysql_query($sql) or mysql_error();
			return $result;
		}
		
		
	}
?>