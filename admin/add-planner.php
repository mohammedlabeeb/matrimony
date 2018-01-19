<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
include_once './lib/page.class.php';
$DatabaseCo = new DatabaseConn();
include("../BusinessLogic/class.weddingplanner.php");
include("../BusinessLogic/class.wpcategory.php");
require_once ('../BusinessLogic/class.city.php');
	require_once ('../BusinessLogic/class.country.php');
	require_once ('../BusinessLogic/class.state.php');
	
$pageSetting = new Page("Save","add-planner.php?action=ADD","Add New Planner");
$exp=new wpcategory(); 
$result=$exp->get_wpcat();

	$co=new country();
	$coun1=$co->get_country_by_status();
	
	$st=new state();
	$coun2=$st->get_state_by_status();
	
	$ct=new city();
	$coun3=$ct->get_city_by_status();
	
	
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$wp_id  = isset($_GET['id']) ? $_GET['id'] :"" ;

$wp_cat_name = "";
$wp_name = "";
$wp_desc = "";
$mobile ="";
$email = "";
$ratefrom = "";
$rateto = "";
$status ="";

$roleRealID = "Real-";
$ACTION_MODE = "ADD";

if($ACTION == "UPDATE")
{
	$SQL_STATEMENT2 = "SELECT * FROM wedding_planner where wp_id =".$wp_id ;
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
					
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
	{
		
		$wp_cat_name = $DatabaseCo->dbRow->wp_cat_id;
		$wp_name = $DatabaseCo->dbRow->wp_name;
		$wp_desc = $DatabaseCo->dbRow->wp_desc;
		$mobile =$DatabaseCo->dbRow->wp_mobile;
		$wp_image =$DatabaseCo->dbRow->wp_image;
		$wp_country =$DatabaseCo->dbRow->wp_country;
		$wp_state =$DatabaseCo->dbRow->wp_state;
		$wp_city =$DatabaseCo->dbRow->wp_city;
		$email = $DatabaseCo->dbRow->wp_email;
		$ratefrom = $DatabaseCo->dbRow->wp_rate_from;
		$rateto = $DatabaseCo->dbRow->wp_rate_to;
		$status =$DatabaseCo->dbRow->status;

	}
	$pageSetting->setActionBtnName("Update");
	$pageSetting->setFormTitle("Update Wedding Planner ".$wp_id);
	$pageSetting->setFormAction("add-planner.php?id=".$wp_id."&action=UPDATE");			
	$ACTION_MODE = "UPDATE";
}
	
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	if($isPostBack)
	{
		
		$statusObj = new status();

		$wp_cat_name = $_POST['wp_cat_name'];
		$wp_name = $_POST['wp_name'];
		$wp_desc = $_POST['wp_desc'];
		$mobile = $_POST['mobile'];
		$image = $_FILES['file']['name'];
		$country_id = $_POST['country_id'];
		$state_id = $_POST['state_id'];
		$city_id = $_POST['city_id'];
		$email = $_POST['email'];
		$ratefrom = $_POST['ratefrom'];
		$rateto = $_POST['rateto'];
		$status = $_POST['status'];

	
		$status_MESSAGE="";
		$ACTION_MODE = $_POST['action'];
		$SQL_STATEMENT = "";
		switch($ACTION_MODE)
		{
			case 'ADD':
			move_uploaded_file($_FILES["file"]["tmp_name"], "../wp/" . $_FILES["file"]["name"]);
			
				$SQL_STATEMENT = "INSERT into wedding_planner (wp_cat_id,wp_name,wp_desc,wp_mobile,wp_email,wp_country,wp_state,wp_city,wp_image,wp_rate_from,wp_rate_to,status) values ('".$wp_cat_name."','".$wp_name."','".$wp_desc."','".$mobile."','".$email."','".$country_id."','".$state_id."','".$city_id."','".$image."','".$ratefrom."','".$rateto."','".$status."')";

	
				break;
			case 'UPDATE':
				$wp_id = $_POST['id'];
				
				if(@is_uploaded_file($_FILES["file"]["tmp_name"]))
				{
					move_uploaded_file($_FILES["file"]["tmp_name"], "../wp/" . $_FILES["file"]["name"]);
					$image=$_FILES["file"]["name"];					
				}
				else
				{					
					 $image=$wp_image;					
				} 
				
				$SQL_STATEMENT =  "UPDATE wedding_planner set wp_cat_id='".$wp_cat_name."',wp_name='".$wp_name."',wp_desc='".$wp_desc."',wp_mobile='".$mobile."',wp_email='".$email."',wp_rate_from='".$ratefrom."',wp_rate_to='".$rateto."',status='".$status."',wp_country='".$country_id."',wp_state='".$state_id."',wp_city='".$city_id."',wp_image='".$image."'  WHERE wp_id=".$wp_id;
				break;
				
		}
	
		 $statusObj = handle_post_request($ACTION_MODE,$SQL_STATEMENT,$DatabaseCo);
		 
		 $status_MESSAGE = $statusObj->getstatusMessage();
		
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Wedding Planners</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/jquery.validate.js"></script>
<script type="text/javascript" src="js/util/form-validation.js"></script>

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
	
	function getState(strURL) 
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
						document.getElementById('statediv').innerHTML=req4.responseText;						
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

function getCity(strURL) 
{
		var req5 = getXMLHTTP();		
		if (req5) 
		{
			req5.onreadystatechange = function() 
			{
					if (req5.readyState == 4) 
					{
						if (req5.status == 200) 
						{						
						document.getElementById('citydiv').innerHTML=req5.responseText;						
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


<script type="text/javascript">
	setPageContext("wp","wedding-planners");
	$(document).ready(function()
	 {
	    var formId = "#add_planner";
	    var rules = {
                wp_cat_name: { required: true },
                wp_name: { required: true },
				wp_desc: { required:true},
                mobile:{ required: true, minlength: 5, maxlength: 13 },
				email:{ required: true},
				country_id : { required: true},
				state_id : { required: true},
				city_id : { required: true},
				ratefrom:{ required: true},
				rateto:{ required: true, minlength: 5, maxlength: 500 },
				status:{ required: true },
			
				
            };
	    var messages = {
				wp_cat_name: {required:"Category is required."},
                wp_name: {required:"Planer Name is required."},
				wp_desc: {required:"Description is required."},
				country_id :{ required:"Country is required."},
				state_id :{ required:"State is required."},
				city_id :{ required:"City is required."},
                mobile:{required:"Mobile is required."},
				email:{required:"Email is required."},
				ratefrom:{required:"Rate starting range is required."},
				rateto:{required:"Rate Ending range is required."},
				status:{required:"Status is required."},
				
		};
            validateForm(formId,rules,messages);	
	 });
	
</script>

</head>
<body>
<div id="wrapper">
<?php
	require_once('./page-part/header.php');
?>

<!-- start content -->
<div id="container" class="cf">
<?php
	require_once('./page-part/left-menu.php');
?>
	
<div class="widecolumn alignleft">
      <div class="breadcum-wide"><a href="#" title="Add New Deatail">Wedding Directory</a> / <a href="#" title="Event">Wedding Planners</a></div>
      <div class="listing-section">
        <div class="member-list cf">
	    <a href="javascript:;" title="List All Events" onclick="window.location='wedding-planners.php'" class="button"><img src="img/bgi/list-icon.png" alt=""/>List All Wedding Planners</a>
	  <a href="javascript:;" title="Add New Event" onclick="window.location='add-planner.php?action=ADD'" class="button"><img src="img/bgi/add-icon.png" alt=""/>Add New Wedding Planner</a>			
        </div>
      </div>
      
      <div class="widecolumn-inner">
	
	<h4>Manage Wedding Planner</h4>
		<span class="field_marked">All Fields are required.</span>
        <?php
					if(!empty($status_MESSAGE))
					{	
						if($statusObj->getActionSuccess()){
							echo  "<div class='success-msg cf' id='success_msg'><h4>".$status_MESSAGE."</h4>    
</div>";
						echo "<div class='error-msg' id='validationSummary'></div>";							
						}

						else{
						echo  "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>".$status_MESSAGE."</li></ul></div>";	
						}
							
					}
					else
					{
						echo "<div class='error-msg' id='validationSummary'></div>";						
					}
				?>
	<form action="<?php echo $pageSetting->getFormAction();?>" enctype="multipart/form-data" method="post" class="form-data" id="add_planner">
		
		<p class="cf">
	      <label><font id="star">*</font>&nbsp;Category:</label>
		<select name="wp_cat_name" id="wp_cat_name" class="comboBox">
			<option value="">Choose Category</option>
							<?php
								while($row=mysql_fetch_array($result))
								{
							?>
				<option  <?php if($row['wp_cat_id']==$wp_cat_name){?> selected="selected" <?php } ?> value="<?php echo $row['wp_cat_id']; ?>"><?php echo $row['wp_cat_name']; ?></option>
							<?php
								}
							?>
					      </select>
	    </p>
	    <p class="cf">
	      <label><font id="star">*</font>&nbsp;Planer Name:</label>
	      <input type="text" class="input" size="32"  name="wp_name" value="<?php echo $wp_name;?>" id="wp_name"/>
	    </p>
         <p class="cf">
	      <label><font id="star">*</font>&nbsp;Description:</label>
	      <textarea cols="30" rows="4" class="text-area" name="wp_desc" id="wp_desc"><?php echo $wp_desc;?></textarea>
	</p>
        <p class="cf">
	      <label><font id="star">*</font>&nbsp;Mobile Number:</label>
	      <input type="text" class="input" size="32" name="mobile" value="<?php echo $mobile;?>" id="mobile"/>
	    </p>
        
        <p class="cf">
	      <label><font id="star">*</font>&nbsp;Image:</label>
          <input type="file" name="file" id="file" size="8" />
	     &nbsp;&nbsp;&nbsp;&nbsp;<img src="../wp/<?php echo $wp_image; ?>" style="border:solid 0px #7e0000;" width="80px" height="60px" />
	    </p>
        
	 	 <p class="cf">
            <label><font id="star">*</font>&nbsp;Country:</label>
	    
	     	<select  class="comboBox" name="country_id" id="country_id" onchange="getState('../select_state.php?country_id='+this.value)">
            <option value="">Select Country</option>
           <?php
											   
									while($row4=mysql_fetch_array($coun1))
									{
										$select="";
										if($row4['country_id']==$wp_country)
										{
										$select="selected='selected'";
										}
								?>
								 <option value="<?php echo $row4['country_id']; ?>" <?php echo $select;?>>
								 <?php echo $row4['country_name']; ?>								 </option>
								<?php		
									}
								?>
              
	     	  
            </select>
	    
            
          </p>
          <p class="cf">
            <label><font id="star">*</font>&nbsp;State:</label>
	    
	     	<select  class="comboBox" name="state_id" id="statediv" onchange="getCity('select_city.php?state_id='+this.value)">
            <option value="">Select State</option>
           
               <?php
											   
									while($row5=mysql_fetch_array($coun2))
									{
									
									
								?>
								 <option value="<?php echo $row5['state_id']; ?>" <?php if($row5['state_id']==$wp_state){ ?> selected="selected" <?php } ?>><?php echo $row5['state_name']; ?></option>
								<?php		
									}
								?>		
	     	  
            </select>
	              
          </p>
          <p class="cf">
            <label><font id="star">*</font>&nbsp;City:</label>
	    
	     	<select  class="comboBox" name="city_id" id="citydiv">
             <option value="">Select City</option>
               <?php		   
									while($row6=mysql_fetch_array($coun3))
									{
								?>
                                <option value="<?php echo $row6['city_id']; ?>" <?php if($row6['city_id']==$wp_city){ ?> selected="selected" <?php } ?>><?php echo $row6['city_name']; ?></option>
                                <?php		
									}
								?>        
	     	  
            </select>
	        
          </p>
	    
	    <p class="cf">
	      <label><font id="star">*</font>&nbsp;Email Id:</label>
	      <input type="text" class="input" size="32" name="email" value="<?php echo $email;?>" id="email"/>
	    </p>
        <p class="cf">
	      <label><font id="star">*</font>&nbsp;Rate :</label>
  <input type="text" class="input"  name="ratefrom" id="ratefrom" style="width:90px;" value="<?php echo $ratefrom;?>"/> to
  <input type="text" class="input"  name="rateto" id="rateto" style="width:90px;" value="<?php echo $rateto;?>"/>
     
	</p>
    
	
     <p class="cf"> <label><font id="star">*</font>&nbsp;Status:</label>
            <input type="radio"  value="APPROVED" name="status" id="status"<?php if($status=='APPROVED'){?> checked="checked" <?php } ?>  />
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="status" id="status" <?php if($status=='UNAPPROVED'){?> checked="checked" <?php } ?>  />
            <span class="radio-btn-text">Inactive</span>
	  </p>
	
	
	    <p class="submit-btn cf">
        <?php
		if(!empty($wp_id))
		{
		?>
         <input type="submit"  class="save-btn" value="Update" name="update_planner" title="Update"/>
         <input type="hidden" name="update_planner" value="submit" />
         <?php
		}
		else
		{
		?>
	      <input type="submit"  class="save-btn" value="Add" name="add_planner" title="Add"/>
          <input type="hidden" name="add_planner" value="submit" />
        <?php
		}
		?>
	      <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>
          <input type="hidden" name="action" value="<?php echo $ACTION;?>" />
          <input type="hidden" name="id" value="<?php echo $wp_id;?>" />	
	    </p>
	
	</form>
	
    </div>
   <?php
		require_once('./page-part/footer.php');
	?>
</div>
</div>
<!-- end content -->
</div>
</body>
</html>
