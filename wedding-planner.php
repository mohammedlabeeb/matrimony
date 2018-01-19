<?php
error_reporting(0);
include_once 'databaseConn.php';

include_once './lib/pagination.php';
include_once 'lib/requestHandler.php';
include_once './class/Config.class.php';
$DatabaseCo = new DatabaseConn();
$configObj = new Config();
require_once("BusinessLogic/class.cms.php");
require_once("BusinessLogic/class.weddingplanner.php");
require_once("BusinessLogic/class.wpcategory.php");
$w=new wpcategory();
$result=$w->get_wpcat3();
$cm2=new cms();

$cms_id='11';
$resw=$cm2->get_cms_by_id($cms_id);

if(isset($_REQUEST['id']))
{
$wp_cat_id=$_REQUEST['id'];
$ob=new weddingplanner();
$resultwp=$ob->get_wp_by_cat($wp_cat_id);
$tcount = mysql_num_rows($resultwp);
}

if(isset($_REQUEST['search']))
{
	$txtCountry=$_REQUEST['txtCountry'];
	$state123=$_REQUEST['cbo1State'];
	$city123=$_REQUEST['cbo1City'];
	$keyword=$_REQUEST['keyword'];
	
	if($state123!='')
	{
	
	$a="and wp_state='$state123'";
	}
	if($city123!='')
	{	
	$b="and wp_city='$city123'";
	}
	if($keyword!='')
	{
	$c="and ((wp_desc like '%$keyword%') OR (wp_cat_name like '%$keyword%') OR (city_name like '%$keyword%'))";		
	}
	
	$resultwp=mysql_query("select * from  wedd_planner_view where wp_country='$txtCountry' $a $b $c");
	$tcount = mysql_num_rows($resultwp);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
<script language="javascript" type="text/javascript">
function getXMLHTTP()
{ //fuction to return the xml http object
		var xmlhttp=false;	
		try
		{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	
		{		
			try
			{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
				try
				{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1)
				{
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
}
function GetState(strURL) 
{
		var req4 = getXMLHTTP();		
		if (req4) 
		{
			req4.onreadystatechange = function() 
			{
					if (req4.readyState == 4) 
					{
						if(req4.status == 200) 
						{						
						document.getElementById('StateDiv').innerHTML=req4.responseText;						
						} 
						else 
						{
						alert("There was a problem while using XMLHTTP:\n" + req4.statusText);
						}
					}				
			}			
			req4.open("GET", strURL, true);
			req4.send(null);
		}				
}
function GetCity(strURL) 
{
		var req5 = getXMLHTTP();		
		if (req5) 
		{
			req5.onreadystatechange = function() 
			{
					if (req5.readyState == 4) 
					{
						if(req5.status == 200) 
						{						
						document.getElementById('CityDiv').innerHTML=req5.responseText;						
						} 
						else 
						{
						alert("There was a problem while using XMLHTTP:\n" + req5.statusText);
						}
					}				
			}			
			req5.open("GET", strURL, true);
			req5.send(null);
		}				
}


</script>
 
</head>
<body>		

		<?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->
     <ol class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li class="active">Wedding Planners</li>
    </ol>
 <div class="row">	      
        
       	<div class="col-sm-9 col-sm-push-3 padding-left-zero padding-right-zero">
          <div class="col-xs-12 col-sm-12">
          <div class="panel panel-success">
            <div class="panel-heading">
            <?php					   
                               while($row2 = mysql_fetch_array($resw)) 
                               {
                              ?> 
              <h3 class="panel-title"><?php echo $row2['cms_title']; ?></h3>
            </div>
            <div class="panel-body col-xs-12">
            
           <div class="col-xs-12"> <?php echo htmlspecialchars_decode($row2['cms_content']); ?></div>
           
             <?php
                                }
                                ?>
                                <form method="post" action="" class="form-horizontal" name="weddformSearch"    id="weddformSearch">
          
	     
     <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Country&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">                            
                                <select name="txtCountry" class="form-control" id="txtCountry" onchange="GetState('ajax_search.php?countryId='+this.value);" data-validation-engine="validate[required]">
                             
                                    <option value="">--Please Select country--</option>
                                    
                                    <?php
                                    $SQL_STATEMENT =  "SELECT * FROM country WHERE status='APPROVED'";
                                    $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                                    while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                                            {
                                    ?>
                                    <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>"><?php echo $DatabaseCo->dbRow->country_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                          </div>   
                          
                           <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">State&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5" id="StateDiv">
                                <select name="cbo1State" id="cbo1State" class="form-control" onchange="GetCity('ajax_search1.php?stateId='+this.value)" >
                                   
                                    <option value="">--Select Country first--</option>
                                </select> 
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">City&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5" id="CityDiv">
                              <select name="cbo1City" class="form-control" id="cbo1City">
                                <option value="">--Select State first--</option>
                              </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Keyword</label>
                            <div class="col-sm-5" id="CityDiv">
                            <input type="text" class="form-control" name="keyword" id="keyword">
                            </div>
                          </div>
    
  				<div class="text-muted">&nbsp;</div>
                <div class="form-group">
    			<div class="col-sm-offset-2 col-sm-8">
      			<button type="submit" name="search" class="btn btn-success"> Submit </button>
                <button type="reset" name="clear" class="btn btn-success"> Clear </button>
    			</div>
  				</div>
                </form>
     </div>
  </div>
  </div>        
          <div class="col-xs-12 col-sm-12" id="planner-detail">
             
          <div class="panel panel-warning">
                            <div class="panel-heading">
                              <h3 class="panel-title"> Search Result </h3>
                            </div>
                            <div class="panel-body col-xs-12">                                 
               <?php   
               if(isset($_REQUEST['search']) && $tcount!=0)     
				{
				
							while($rowwp=mysql_fetch_array($resultwp))
                			 {
							?>
                        <div class="col-sm-3">
                             <img src="wp/<?php echo $rowwp['wp_image']; ?>" class="img-thumbnail img-responsive col-xs-12" />
                        </div>
                        <div class="col-sm-9">
                               <h3 class="text-warning col-xs-12">WP Name : <?php echo $rowwp['wp_name']; ?></h3>
                               <p><b class="text-success">Planner service :</b> <?php echo $rowwp['wp_cat_name']; ?></p>
				<p><b class="text-success">Planner Email :</b> <?php echo $rowwp['wp_email']; ?></p>
				<p><b class="text-success">Planner Number :</b> <?php echo $rowwp['wp_mobile']; ?></p>
                                <p><b class="text-success">Price Range From :</b> 
				<?php echo $rowwp['wp_rate_from']; ?> to <?php echo $rowwp['wp_rate_to']; ?></p>
				
                <p><b class="text-success">Country :</b> <?php echo $rowwp['country_name']; ?></p>
                <p><b class="text-success">State :</b> <?php echo $rowwp['state_name']; ?></p>
                <p><b class="text-success">City :</b> <?php echo $rowwp['city_name']; ?></p>
                <p><b class="text-success">Planner Description :</b> <?php echo $rowwp['wp_desc']; ?></p>
                        </div>
				 
                           
                            <?php  
				  			 }  
				}
				elseif(isset($_REQUEST['search']) && $tcount==0)   
				{
					?><table class="table table-hover">
                      <tr>
                          <td class="empty_box">&nbsp;</td>
                      </tr>
                    </table>	
                    <?php
				}
				elseif(isset($_REQUEST['id']) && $tcount==0)
				{
					?><table class="table table-hover">
                      <tr>
                          <td class="empty_box">&nbsp;</td>
                      </tr>
                    </table>	
                    <?php
				} 
				elseif(isset($_REQUEST['id']) && $tcount!=0)
				{
					while($rowwp=mysql_fetch_array($resultwp))
                			 {
							?>
                        <div class="col-sm-3" style="margin-top:20px;">
                             <img src="wp/<?php echo $rowwp['wp_image']; ?>" class="img-thumbnail" style="min-height:220px; " />
                        </div>
                        <div class="col-sm-9">
                               <h3 class="text-warning">WP Name : <?php echo $rowwp['wp_name']; ?></h3>
                               <p><b class="text-success">Planner service :</b> <?php echo $rowwp['wp_cat_name']; ?></p>
				<p><b class="text-success">Planner Email :</b> <?php echo $rowwp['wp_email']; ?></p>
				<p><b class="text-success">Planner Number :</b> <?php echo $rowwp['wp_mobile']; ?></p>
                                <p><b class="text-success">Price Range From :</b> 
				<?php echo $rowwp['wp_rate_from']; ?> to <?php echo $rowwp['wp_rate_to']; ?></p>
				
                <p><b class="text-success">Country :</b> <?php echo $rowwp['country_name']; ?></p>
                <p><b class="text-success">State :</b> <?php echo $rowwp['state_name']; ?></p>
                <p><b class="text-success">City :</b> <?php echo $rowwp['city_name']; ?></p>
                <p><b class="text-success">Planner Description :</b> <?php echo $rowwp['wp_desc']; ?></p>
                        </div>
				 
                           
                            <?php  
				  			 }  
				}
				
				
				else
				{
				   ?>  
                    <h4 style="color:green;" class="col-xs-12">Recenlty Added Wedding Planners</h4>  
                                <?php 
                                    $SQL_STATEMENT =  "SELECT * FROM  wedd_planner_view ORDER BY wp_id DESC LIMIT 0,2";
                                    $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                                    while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                                    {
                                ?>
                                 
                                
                                    <div class="col-sm-3">
                                         <img src="wp/<?php echo $DatabaseCo->dbRow->wp_image; ?>" class="img-thumbnail img-responsive"  />
                                    </div>
                                    <div class="col-sm-9">
                                           <h4 class="text-warning">WP Name : <?php echo $DatabaseCo->dbRow->wp_name; ?></h4>
                                           <p><b class="text-success">Planner service :</b> <?php echo $DatabaseCo->dbRow->wp_cat_name; ?></p>
                                            <p><b class="text-success">Planner Email :</b> <?php echo $DatabaseCo->dbRow->wp_email; ?></p>
                                            <p><b class="text-success">Planner Number :</b> <?php echo $DatabaseCo->dbRow->wp_mobile; ?></p>
                                            <p><b class="text-success">Price Range From :</b> 
                                            <?php echo $DatabaseCo->dbRow->wp_rate_from; ?> to <?php echo $DatabaseCo->dbRow->wp_rate_to; ?></p>
                                            <p><b class="text-success">Planner Description :</b> <?php echo $DatabaseCo->dbRow->wp_desc; ?></p>
                                            <p><b class="text-success">Country :</b> <?php echo $DatabaseCo->dbRow->country_name; ?></p>
                <p><b class="text-success">State :</b> <?php echo $DatabaseCo->dbRow->state_name; ?></p>
                <p><b class="text-success">City :</b> <?php echo $DatabaseCo->dbRow->city_name; ?></p>
                                    </div>
                                    <div class="clearfix "></div>
                                           
                                   <?php 
                                   
                                    }   
                                    
                }
                                   ?>                               
                            </div>
          </div>             
         </div>
         </div>
         <div class="clearfix visible-xs"></div>
         <div class="col-xs-12 col-sm-3 col-sm-pull-9">
        <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title"> Wedding category </h3>
            </div>
            <div class="panel-body col-xs-12">
                <ul class="list-unstyled col-xs-12">             
					<?php 
				while($reswp=mysql_fetch_array($result))
				{ 
					?>
				<li>
					<a href="wedding-planner.php?id=<?php echo $reswp['wp_cat_id'];?>"><p><?php  echo $reswp['wp_cat_name'];?></p></a>
				</li>
					<?php 
				}
					?>      
              </ul>
            </div>
          </div>   
         
         
       
            <?php include 'advertise/add_single.php'; ?> 
          
        </div>
        
      </div>
      
<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";
require_once 'chat.php';
?>
</div>
  
   
 </body>
</html>