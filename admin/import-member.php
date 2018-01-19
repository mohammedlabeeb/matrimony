<?php
error_reporting(0);
	session_start();
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	include_once './lib/page.class.php';
	$DatabaseCo = new DatabaseConn();
	$pageSetting = new Page("Save","import-member.php","Add Members");	
	
	
	
		$pageSetting->setActionBtnName("Import");
		$pageSetting->setFormTitle("Import Member by CSV file");
		$ACTION_MODE = "Import";	
	
	
	if(isset($_REQUEST['import']))
	{
		 $fname = $_FILES['pro_file']['name'];
     $chk_ext = explode(".",$fname);
      
	if(strtolower($chk_ext[1]) == "csv")
    {

      $filename = $_FILES['pro_file']['tmp_name'];

         $handle = fopen($filename, "r");

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)

         {
			 			
            $sql = "insert into register(index_id,matri_id,prefix,terms,email,password,cpassword,cpass_status,
			m_status,profileby,pre_cnt_type,time_to_call,
reference,username,firstname,lastname,gender,birthdate,birthtime,birthplace,tot_children,status_children,edu_detail,income,occupation,emp_in,religion,caste,subcaste,gothra,star,moonsign,horoscope,manglik,m_tongue,height,weight,b_group,complexion,bodytype,diet,smoke,drink,address,country_id,state_id,city,locality,phone,mobile,contact_view_security,
residence,father_name,mother_name,father_living_status,mother_living_status,father_occupation,mother_occupation,profile_text,looking_for,family_details,family_value,family_type,family_status,family_origin,no_of_brothers,no_of_sisters,no_marri_brother,no_marri_sister,part_frm_age,part_to_age,part_have_child,part_income,part_expect,part_height,part_height_to,part_complexation,part_mtongue,part_religion,part_caste,part_edu,part_country_living,part_resi_status,hobby,hor_check,hor_photo,photo_protect,photo_pswd,video,video_approval,video_url,photo1,photo1_approve,photo2,photo2_approve,photo3,photo3_approve,photo4,photo4_approve,
photo5,photo5_approve,photo6,photo6_approve,reg_date,ip,agent,last_login,status,fstatus,logged_in,adminrole_id,adminrole_view_status)
			
			values
('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]','$data[21]','$data[22]','$data[23]','$data[24]','$data[25]','$data[26]','$data[27]','$data[28]','$data[29]','$data[30]','$data[31]','$data[32]','$data[33]','$data[34]','$data[35]','$data[36]','$data[37]','$data[38]','$data[39]','$data[40]','$data[41]','$data[42]','$data[43]','$data[44]','$data[45]','$data[46]','$data[47]','$data[48]','$data[49]','$data[50]','$data[51]','$data[52]','$data[53]','$data[54]','$data[55]','$data[56]','$data[57]','$data[58]','$data[59]','$data[60]','$data[61]','$data[62]','$data[63]','$data[64]','$data[65]','$data[66]','$data[67]','$data[68]','$data[69]','$data[70]','$data[71]','$data[72]','$data[73]','$data[74]','$data[75]','$data[76]','$data[77]','$data[78]','$data[79]','$data[80]','$data[81]','$data[82]','$data[83]','$data[84]','$data[85]','$data[86]','$data[87]','$data[88]','$data[89]','$data[90]','$data[91]','$data[92]','$data[93]','$data[94]','$data[95]','$data[96]','$data[97]','$data[98]','$data[99]','$data[100]','$data[101]','$data[102]','$data[103]','$data[104]','$data[105]','$data[106]','$data[107]','$data[108]','$data[109]','$data[110]','$data[111]')";
            mysql_query($sql) or die(mysql_error());
         }

    echo "<script>alert('upload successfull.');</script>";
     }

     else

     {

         echo "<script>alert('Invalid File Only Csv file allow');</script>";

     }    			
		$statusObj = handle_post_request($ACTION_MODE,$SQL_STATEMENT,$DatabaseCo);
		$status_MESSAGE = $statusObj->getstatusMessage();
	}
			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Import Member</title>
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
<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->
<script type="text/javascript">
	setPageContext("member_report","import_member");
	$(document).ready(function()
	 {
	    var formId = "#import-member";
	    var rules = {
                pro_file: { required: true, extension: "csv" },
               

            };
	    var messages = {
		pro_file:{required:"Please upload CSV file",accept:"Invalid File, Only CSV file allowed"},
		
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
      <div class="breadcum-wide"><a title="Member Report">Member Report </a>/ <a title="Import Member">Import Member</a></div>
      <div class="widecolumn-inner">
        <h4><?php echo $pageSetting->getFormTitle();?></h4>
		<span class="field_marked">All Fields are required.</span>
        <?php
	if(!empty($status_MESSAGE))
	{	
		if($statusObj->getActionSuccess()){
			echo  "<div class='success-msg cf' id='success_msg'><h4>".$status_MESSAGE."</h4>    
</div>";
			echo "<div class='error-msg' id='validationSummary'></div>";							
		}else{
			echo  "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>".$status_MESSAGE."</li></ul></div>";	
		}
							
	}else{
		echo "<div class='error-msg' id='validationSummary'></div>";						
	}
?>
        <form action="" method="post" class="form-data" id="import-member" enctype="multipart/form-data">
         
          <p class="cf">
            <label><font id="star">*</font> 1. Import File:</label>
            <input type="file" class="input-textbox" name="pro_file" id="pro_file" size="40"/>
            <div style="margin-left:240px"><font id="star">(Only csv file allowed)</font></div>
          </p>
          
          <p class="submit-btn cf">
            <input type="submit"  class="save-btn" value="<?php echo $pageSetting->getActionBtnName(); ?>" title="<?php echo $pageSetting->getActionBtnName(); ?>" />
             <input type="hidden" name="import" value="submit" />
            <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>
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
