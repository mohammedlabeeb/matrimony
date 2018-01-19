<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
error_reporting(0);


//error_reporting(0);

 if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!='')
 {
	
	$page=$_REQUEST['page'];
	$limit = 10;
	$adjacent = 7;  
   
     
   
  
	 if($_POST['religion']=='')
   {
	  $rel=$_SESSION['religion123']; 
   }
   else if($_POST['religion']=='null')
   {
	  $rel='';  
	 // $_SESSION['religion123']=$rel;
   }
   else
   {
	 $rel=$_POST['religion'];
	// $_SESSION['religion123']=$rel;  
   }
   
   
   if($_POST['occupation']=='')
   {
	 $occ=$_SESSION['occupation']; 
   }
   else if($_POST['occupation']=='null')
   {
	  $occ='';  
	 // $_SESSION['occupation']=$occ;
   }
   else
   {
	 $occ=$_POST['occupation'];
	// $_SESSION['occupation']=$occ;  
   }
   
   
   
   if($_POST['gender']=='')
   {
	 $gender=$_SESSION['gender']; 
   }
   
   else
   {
	 $gender=$_POST['gender'];
	// $_SESSION['gender']=$gender;  
   }
   
   
   
   if($_POST['t3']=='')
   {
	 $t3=$_SESSION['fage']; 
   }
   else
   {
	 $t3=$_POST['t3'];
	// $_SESSION['fage']=$t3;  
   }
   
   
   
   if($_POST['t4']=='')
   {
	 $t4=$_SESSION['tage']; 
   }
   else
   {
	 $t4=$_POST['t4'];
	 //$_SESSION['tage']=$t4;  
   }
   
  
   
   if($_POST['country']=='')
   {
	 $con=$_SESSION['country123']; 
   }
   else if($_POST['country']=='null')
   {
	  $con='';  
	//  $_SESSION['country123']=$con;
   }
   else
   {
	 $con=$_POST['country'];
	// $_SESSION['country123']=$con;  
   }
   
   
   
   if($_POST['m_status']=='')
   {
	 $m_status=$_SESSION['mstatus123']; 
   }
   else if($_POST['m_status']=='null')
   {
	  $m_status='';  
	//  $_SESSION['mstatus123']=$m_status;
   }
   else
   {
	 $m_status=$_POST['m_status'];
	// $_SESSION['mstatus123']=$m_status;  
   }
   
   
   
   if($_POST['m_tongue']=='')
   {
	 $m_tongue=$_SESSION['m_tongue123']; 
   }
   else if($_POST['m_tongue']=='null')
   {
	  $m_tongue='';  
	 // $_SESSION['m_tongue123']=$m_tongue;
   }
   else
   {
	 $m_tongue=$_POST['m_tongue'];
	// $_SESSION['m_tongue123']=$m_tongue;  
   }
   
   
   
   
   if($_POST['education']=='')
   {
	 $education=$_SESSION['education123']; 
   }
   else if($_POST['education']=='null')
   {
	  $education='';  
	 // $_SESSION['education123']=$education;
   }
   else
   {
	 $education=$_POST['education'];
	// $_SESSION['education123']=$education;  
   }
   
   
   
   
   if($_POST['caste']=='')
   {
	 $caste=$_SESSION['caste123']; 
   }   
   else
   {
	 $caste=$_POST['caste'];
	// $_SESSION['caste123']=$caste;  
   }
   
   
   
   
   if($_POST['state']=='')
   {
	 $state=$_SESSION['state123']; 
   }   
   else
   {
	 $state=$_POST['state'];
	// $_SESSION['state123']=$state;  
   }   
   
   
   
   if($_POST['city']=='')
   {
	 $city=$_SESSION['city123']; 
   }
   else
   {
	 $city=$_POST['city'];
	// $_SESSION['city123']=$city;  
   }   
   
   
    if($_POST['fromheight']=='')
   {
	 $fromheight=$_SESSION['fromheight']; 
   }
   else if($_POST['fromheight']=='Below 4ft')
   {
	 $fromheight='0ft';
	// $_SESSION['fromheight']=$fromheight; 
   }
   else
   {
	 $fromheight=$_POST['fromheight'];
	// $_SESSION['fromheight']=$fromheight;  
   }  
   
    
   if($_POST['toheight']=='')
   {
	 $toheight=$_SESSION['toheight']; 
   }
   else if($_POST['toheight']=='Above 7ft')
   {
	 $toheight='8ft';
	// $_SESSION['toheight']=$toheight;  
   }  
   else
   {
	 $toheight=$_POST['toheight'];
	// $_SESSION['toheight']=$toheight;  
   }      
   
   
   if($_POST['photo']=='')
   {
	 $photo=$_SESSION['photo']; 
   }
   else if($_POST['photo']=='null')
   {
	  $photo='';  
	//  $_SESSION['photo']=$photo;
   }
   else
   {
	 $photo=$_POST['photo'];
	// $_SESSION['photo']=$photo;  
   } 
   
   
   if($_POST['keyword']=='')
   {
	 $keyword=$_SESSION['keyword']; 
   }
   else
   {
	 $keyword=$_POST['keyword'];
	// $_SESSION['keyword']=$keyword;  
   }   
   
   
   if($_POST['id_search']=='')
   {
	 $id_search=$_SESSION['id_search_value']; 
   }
   else
   {
	 $id_search=$_POST['id_search'];
	// $_SESSION['id_search_value']=$id_search;  
   } 
   
   
    if($_POST['searchby']=='')
   {
	 $searchby=$_SESSION['from_where']; 
   }
   else
   {
	 $searchby=$_POST['searchby'];
	// $_SESSION['from_where']=$searchby;  
   } 
   
   if($_POST['orderby']=='')
   {
	 $orderby=$_SESSION['orderby']; 
   }
   else if($_POST['orderby']=='null')
   {
	  $orderby=''; 
	//  $_SESSION['orderby']=$orderby;
   }
   else
   {
	 $orderby=$_POST['orderby'];
	// $_SESSION['orderby']=$orderby;  
   }
   
	
  
   
   
		   if($page==1)
		   {
		   $start = 0;  
		   }	
		   else
		   {
		   $start = ($page-1)*$limit;
		   }
		   
if($t3!='' && $t4!='')
{
	$a="AND ((
			(
			date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )
			) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
			)
			BETWEEN '$t3'
			AND '$t4')";	
}		
	
if($gender!='')
{
	$b="and gender='$gender'";	
}
if($rel!='')
{
	$c= "and religion IN ($rel)";				
}
if($caste!='')
{
	
	$d="and caste IN ($caste)";
	
	
}
if($m_tongue!='')
{	
	$search_array1 = explode(',',$m_tongue);
	foreach ($search_array1 as $value1)
	{
	$e1.="(find_in_set($value1, m_tongue) > 0) or ";
	}
	$e2=rtrim($e1, "or ");
	$e="and ($e2)";
}	

if($education!='')
{	
	$search_array2 = explode(',',$education);
	foreach ($search_array2 as $value2)
	{
	$d1.="(find_in_set($value2, edu_detail) > 0) or ";
	}
	$d2=rtrim($d1, "or ");
	$f="and ($d2)";
	
}
if($occ!='')
{
	
	$g="and occupation IN ($occ)";
}
if($m_status!='Any' && $m_status!='')
{
	$h= "and m_status='$m_status'";				
}
if($con!='')
{
	
	$i="and country_id IN ($con)";
}
if($state!='')
{
	
	$j="and state_id='$state'";
}
if($city!='')
{
	
	$k="and city IN ($city)";
}
if($fromheight!='')
{
	$l="and height between '$fromheight' and '$toheight'";	
}

if($keyword!='')
{
	$m="and ((email like '%$keyword%') OR (firstname like '%$keyword%') OR (lastname like '%$keyword%') OR (matri_id like '%$keyword%'))";
}

if($photo=='1')
{
	$n=" and photo1!=''";	
}
if($id_search!='')
{
	$o ="and matri_id LIKE '$id_search%'";	
}


if($orderby!='' && $orderby=='register')
{
	$p="order by reg_date DESC";	
}
if($orderby!='' && $orderby=='login')
{
	$q ="order by last_login DESC";	
}


    $rows = mysql_num_rows(mysql_query("select index_id from register_view where  status!='Inactive' and status!='Suspended'  $a $b $c $d $e $f $g $h $i $j $k $l $m $n $o $p $q"));
		 
		$sql = "select username,photo1,photo_protect,matri_id,photo_pswd,gender,email,m_status,status,hor_photo,hor_check,video,video_url,video_approval,birthdate,height,religion_name,caste_name,city_name,country_name,state_name,logged_in,index_id
		
		 from register_view where  status!='Inactive' and status!='Suspended'  $a $b $c $d $e $f $g $h $i $j $k $l $m $n $o $p $q limit $start,$limit";  
		  $data = mysql_query($sql);
		
			?>
            
            
            <?php
		
		  if($rows >0)
		   {
			   
			// pagination($limit,$adjacent,$rows,$page);  
			   
				   while( $Row = mysql_fetch_array($data))
				   {
					  include "page-part/result.php";
				   }
				   
		     pagination($limit,$adjacent,$rows,$page);  
			 		   
		   }
		   else
		   {
			?>
                    <table class="table table-hover">
                      <tr>
                          <td class="empty_box">&nbsp;</td>
                      </tr>
                    </table>
                        <?php	
		   }   
 
	?>
    <script src="js/function.js" type="text/javascript"></script>
    <?php
}


function pagination($limit,$adjacents,$rows,$page)
{	
	$pagination='';
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$prev_='';
	$first='';
	$lastpage = ceil($rows/$limit);	
	$next_='';
	$last='';
	if($lastpage > 1)
	{	
		
		if ($page > 1) 
			$prev_.= "<a class='page-numbers' href=\"?page=$prev\">Previous</a>";
		else{
			$pagination.= "<span class=\"disabled\">Previous</span>";	
			}
		
		//pages	
		if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
		$first='';
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
			}
			$last='';
		}
		elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			$first='';
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
			$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
		       $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			//close to end; only hide early pages
			else
			{
			    $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last='';
			}
            
			}
		if ($page < $counter - 1) 
			$next_.= "<a class='page-numbers' href=\"?page=$next\">Next</a>";
		else{
			$pagination.= "<span class=\"disabled\">Next</span>";
			}
		$pagination = "<div class='col-xs-12 col-md-12 col-lg-12 col-sm-12 ne-result-pagination'><div class='row'><nav class='pull-right'>
		<ul class=\"pagination\"><li>"
		.$first."</li><li>".$prev_.$pagination."</li><li>".$next_.$last."</li>";
		//next button
		
		$pagination.= "</ul></nav></div></div>\n";	
	}

	echo $pagination;  
}
?>
