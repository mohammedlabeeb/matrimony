<?php
		error_reporting(0);
		include_once '../databaseConn.php';
		include_once '../lib/requestHandler.php';
		
		$DatabaseCo = new DatabaseConn();
		include_once '../class/Config.class.php';
		$configObj = new Config();
		
			if(isset($_POST['religion']))
			{
				unset($_SESSION['gender']);
				
				$rel=$_POST['religion'];
				$occ=$_POST['occupation'];
				$con=$_POST['country'];		
				
					if($_SESSION['gender123'])
					{
							if($_SESSION['gender123']=='Male')
							{
							 $gender='Female';
							}
							else
							{
							 $gender='Male';		
							}		
					}
					else
					{
					 $_SESSION['gender']=$_REQUEST['gender'];
					 $gender=$_SESSION['gender'];
					}
				
				
				$m_status=$_POST['m_status'];
				$photo=$_POST['photo'];
				$m_tongue=$_POST['m_tongue'];
				$education=$_POST['education'];
				$order=$_POST['orderby'];
				
				$t3=$_SESSION['fage'];
				$t4=$_SESSION['tage'];
				$mid=$_SESSION['user_id'];
				
				if($rel!='')
				{
					$a= "and religion IN ($rel)";				
				}

				if($occ!='')
				{
					$b= "and occupation IN ($occ)";				
				}
				
				if($con!='')
				{
					$c= "and country_id IN ($con)";				
				}
				if($m_status!='Any' && $m_status!='')
				{
					$d= "and m_status='$m_status'";				
				}
				if($photo=='1')
				{
					$e=" and photo1!=''";	
				}
				if($m_tongue!='')
				{
					$f=" and m_tongue IN ($m_tongue)";	
				}
				if($education!='')
				{
					$g=" and edu_detail IN ($education)";	
				}
				if($mid!='')
				{
					$h="AND matri_id!='$mid'";	
				}
				if($order!='' && $order=='register')
				{
					$i="order by reg_date DESC";	
				}
				if($order!='' && $order=='login')
				{
					$j="order by last_login DESC";	
				}
								
				$targetpage = "search-result.php"; 	//your file name  (the name of this file)
				$limit = 10; 								//how many items to show per page
				$page = $_GET['page'];
				if($page) 
					$start = ($page - 1) * $limit; 			//first item to display on this page
				else
					$start = 0;	
		
				
		$sql2= "SELECT * FROM register_view WHERE gender='$gender' and status!='Inactive' AND ((
					(
					date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )
					) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
					)
					BETWEEN '$t3'
					AND '$t4') $a $b $c $d $e $f $g $h $i $j LIMIT $start, $limit";
					
					$SQL=mysql_query($sql2) or die(mysql_error()); 
					$tcount = mysql_num_rows($SQL);


	$tbl_name="register_view";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 4;

	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE gender='$gender' and status!='Inactive' AND ((
					(
					date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )
					) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
					)
					BETWEEN '$t3'
					AND '$t4') $a $b $c $d $e $f $g $h $i $j";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['num'];
	
	$_SESSION['sql']=$sql2;
	$_SESSION['query']=$query;
	
	/* Setup vars for query. */
	
		
/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	include("pagination.php");	
					
			}
?>
			<div id="loaderID" style="position:absolute;  left:30%; top:20%; z-index:2; opacity:0">
           <img src="images/ajax-loader1.gif" /></div>
           
           <div class="panel-heading" id="Totalresult">
                  <h3 class="panel-title"> Your Search Result : <span style="color:#AA0610;"><b><?php echo $total_pages;?> Found</b></span></h3>
                </div>
                <div class="panel-body" id="daya">
                 <img src="images/fp3.png"> 
                 <?php include "featured-profile.php";?>
                
                     <?php
                    if($tcount>0)
                    {
                     echo $pagination; 
                    
                   ?>
                  
                      <?php
                      while($Row = mysql_fetch_array($SQL))
                        {
                       ?>
                        <div class="row table-responsive">
                        <?php
                        include "result.php";
                        ?>
                        </div>
                        <?php
                        }
                        ?>     
                
                    <?php 
                    echo $pagination; 
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
                </div>
                
                <?php include "../popup.php" ;?>    
