<?php
	  	include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './lib/pagination.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();
		$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
		
	if(isset($_REQUEST['upload']))
	{
		$video_name=isset($_POST['video_name'])?$_POST['video_name']:'';		
		$file=isset($_FILES['file']['name'])?$_FILES['file']['name']:'';	
		$youtube_link=isset($_POST['youtube_link'])?$_POST['youtube_link']:'';	
		$status=isset($_POST['status'])?$_POST['status']:'';		
		$file_size=isset($_FILES['file']['size'])?$_FILES['file']['size']:'';	
		
	  if($_POST['v_type']=='Computer')
	  {	
			$file=$_FILES["file"]["name"];
			
			
		$d=explode(".",$file);
		$p=count($d);
		$chk_ext=$d[$p-1];		
		if(($chk_ext=="flv") && ($file_size<25480000))
		{
			$file=$_FILES['file']['name'];
			copy($_FILES["file"]["tmp_name"],"video-list/".$_FILES["file"]["name"]);
		  $ins="update register set video='$file',video_url='',video_approval='UNAPPROVED' where matri_id='$mid'";
			$j=mysql_query($ins) or die(mysql_error());
    echo "<script language=\"javascript\">alert('Your video is uploaded successfully');window.location=\"video.php\";</script>";
		}
		else
		{
	echo "<script laguage=\"javascript\">alert(\"Only .flv Extention Video File AND Maximum 25 MB Size Allow \");window.location=\"video.php\";</script>";
		}
			
		}			
	  
	  if($_POST['v_type']=='Youtube')
	  {
	     $ins2="update register set video_url='$youtube_link',video='',video_approval='UNAPPROVED' where matri_id='$mid'";	
		 $j2=mysql_query($ins2) or mysql_error();
	echo "<script language=\"javascript\">alert('Your video is uploaded successfully');window.location=\"video.php\";</script>";
	  }
          $result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$mid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                     $name = $rowcc['username'];
                    $subject = "You Just Uploded Video";	
                    
                    $message = "
                    <html>
                    
                    <body>
                    <table style='margin:auto;border:5px solid #43609c;min-height:auto;font-family:Arial,Helvetica,sans-serif;font-size:12px;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
                      <tbody>
                      <tr>
                        <td style='float:left;min-height:auto;border-bottom:5px solid #43609c'>	
                              <table style='margin:0;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
                                    <tbody>
                                            <tr style='background:#f9f9f9'>
                                            <td style='float:right;font-size:13px;padding:10px 15px 0 0;color:#494949'>
                                                            <span tabindex='0' class='aBn' data-term='goog_849968294'>

                        <td style='float:left;margin-top:5px;color:#048c2e;font-size:26px;padding-left:15px'>$website</td>

                      </tr>

                    </tbody></table>
                        </td>
                      </tr>
                      <tr>
                        <td style='float:left;width:710px;min-height:auto'>

                        <h6 style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px'>Hello,</h6>
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                            You have updated your $webfriendlyname site profile, Below is your details.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, $name <br/>
                                    Matri-id : $mid <br/>
                                    Email-ID : $to <br/>                                    
                                    </b></p>
                           <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>If you did not update your profile then go to your account and change password immediately,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'></p>
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thank you for helping us reach you better,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'>Thanks & Regards ,<br>Team $webfriendlyname</p>

                        </td>
                      </tr>
                    </tbody></table>
                    </body>
                    </html>
                    ";

                                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                                    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                                    $headers .= 'From:'.$from."\r\n";


                    mail($to,$subject,$message,$headers);
	 }
	
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" 
rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<script language="JavaScript">
function setVisibility(id, visibility)
 {
document.getElementById(id).style.display = visibility;
}
</script>
<script src="js/swfobject.js" type="text/javascript"></script>
<script language="javascript">
function MM_CheckFlashVersion(reqVerStr,msg)
{
  with(navigator){
    var isIE  = (appVersion.indexOf("MSIE") != -1 && userAgent.indexOf("Opera") == -1);
    var isWin = (appVersion.toLowerCase().indexOf("win") != -1);
    if (!isIE || !isWin){  
      var flashVer = -1;
      if (plugins && plugins.length > 0){
        var desc = plugins["Shockwave Flash"] ? plugins["Shockwave Flash"].description : "";
        desc = plugins["Shockwave Flash 2.0"] ? plugins["Shockwave Flash 2.0"].description : desc;
        if (desc == "") flashVer = -1;
        else{
          var descArr = desc.split(" ");
          var tempArrMajor = descArr[2].split(".");
          var verMajor = tempArrMajor[0];
          var tempArrMinor = (descArr[3] != "") ? descArr[3].split("r") : descArr[4].split("r");
          var verMinor = (tempArrMinor[1] > 0) ? tempArrMinor[1] : 0;
          flashVer =  parseFloat(verMajor + "." + verMinor);
        }
      }
      // WebTV has Flash Player 4 or lower -- too low for video
      else if (userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 4.0;

      var verArr = reqVerStr.split(",");
      var reqVer = parseFloat(verArr[0] + "." + verArr[2]);
  
      if (flashVer < reqVer){
        if (confirm(msg))
          window.location = "http://www.macromedia.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash";
      }
    }
  } 
}
</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<style type="text/css">
.video {
  position: relative;
  width: 100%;
  height: 0;
  padding-bottom: 56.25%;
}
.video iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
</style>
</head>

<body onLoad="MM_CheckFlashVersion('7,0,0,0','Content on this page requires a newer version of Macromedia Flash Player. Do you want to download it now?');">		
		
		<?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->

 	<ol class="breadcrumb">
  		<li><a href="index.php">Home</a></li>
  		<li class="active">Manage Video</li>
	</ol>
 	<div class="row">   
      	
           <div class="col-xs-12 col-sm-9 col-sm-push-3 col-xs-push-0">

          <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title">Upload Video</h3>             
            </div>
            <div class="panel-body">                   	
                <div class="col-sm-12 padding-left-right-zero-small">
               <form name="MatriForm" id="MatriForm" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
               <div class="form-group">
              <div class="col-sm-7 col-xs-12">
                <b> Add Video / Change your video here.</b>  
                </div>
             </div>      
             <div class="form-group">
              <div class="col-sm-7 col-xs-12">
                <b  style="color:#c20;"> Only .Flv File Extenstion And Maximum 25 MB Allow </b>  
                </div>
             </div>
             
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label col-xs-12 text-center"> Upload Video from : </label>
                  <div class="col-sm-4 col-xs-12">
     <input type="radio"  name="v_type" id="v_type"  value="Computer" onclick="setVisibility('comp', 'inline');setVisibility('youtube', 'none');";/>&nbsp;&nbsp;Computer&nbsp;&nbsp;
   <input type="radio"  name="v_type" id="youtube_type" value="Youtube" onclick="setVisibility('comp', 'none');setVisibility('youtube', 'inline');"; />&nbsp;&nbsp;Youtube
                  </div>
           </div>
                          
           <div class="form-group" id="comp" style="display:none;">
               <label for="inputEmail3" class="col-sm-4 control-label col-xs-12 text-center">Computer Video:</label>
                  <div class="col-sm-4 col-xs-12 text-center">
         <input type="file" name="file" id="file" data-validation-engine="validate[required]">
                  </div>
           </div>           
           
           <div class="form-group" id="youtube" style="display:none;">
               <label for="inputEmail3" class="col-sm-4 control-label col-xs-12 text-center">Video Embed code:</label>
                  <div class="col-sm-6">
         <textarea name="youtube_link" id="youtube_link"  data-validation-engine="validate[required]" class="col-xs-12 form-control" rows="5"/></textarea>
     <p>( Insert Youtube video's Embed code Here, which you will find it in share button...)</p>
                  </div>
           </div>          
                                   
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-7">
                    <input type="submit" name="upload" value="Upload" class="btn btn-success col-sm-3 col-xs-12">
                            </div>
                          </div>
                        </form>
                   <div class="clearfix visible-xs"></div>
                    
                    <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-7">
                  			&nbsp;
                            </div>
                          </div>
                          <div class="clearfix visible-xs"></div>
                     <div class="form-group">
                     	<div class="col-sm-9">
                        <div class="col-sm-6 col-sm-offset-2 video col-xs-12 col-xs-offset-0">
                     <?php
		$fet=mysql_query("select * from register where matri_id='$mid'");		
		$d=mysql_fetch_array($fet);		
		
			if($d['video']!="" && $d['video_approval']=='APPROVED')
			{
				$p=$d['video'];
				?>
               
<div id="flvplayer"><img src="images/loader.gif"></div>    

        	<script language="javascript">
	
	
	var so = new SWFObject("mpw_player.swf", "swfplayer", "620", "330", "5", "#000000"); 
	
	so.addVariable("flv", "video-list/<?php echo $p; ?>","swfplayer", "620", "330", "5", "#000000"); // File Name
	
	
	so.addVariable("jpg","images/loader.gif"); // Preview photo
	so.addVariable("autoplay","false"); // Autoplay, make true to autoplay
	so.addParam("allowFullScreen","true"); // Allow fullscreen, disable with false
	so.addVariable("backcolor","000000"); // Background color of controls in html color code
	so.addVariable("frontcolor","ffffff"); // Foreground color of controls in html color code
	so.write("flvplayer"); // This needs to be the name of the div id
</script>
       
                <?php
			}
			else if($d['video']!="" && $d['video_approval']=='UNAPPROVED')
			{
				?>
                 <h4>Your Video is in waiting for Admin Approval. It will be online after approval...</h4>
                 <?php
			}
			else if($d['video']=="")
			{
				if($d['video_url']!="" && $d['video_approval']=='APPROVED')
				{
				?>
                
					<div>
                     <?php echo $d['video_url']; ?> 
            		</div>
               
                <?php
				}
				elseif($d['video_url']!="" && $d['video_approval']=='UNAPPROVED')
				{
				?>
                 <h4>Your Video is in waiting for Admin Approval. It will be online after approval...</h4>
                 <?php
				}
				
			}
			else
			{
				?>
                <h4>No video avalibale</h4>
                <?php
					
			}					  
		?>		 
                     </div>
                     </div>
                     </div>
                      
                    
                </div> 
                         
            </div>
              
          </div>
          
           <div class="">
             <?php include "page-part/featured-profile.php";?>
           </div>
        	<div class="clearfix visible-xs"></div>
          </div>
          <div class="col-sm-3 col-sm-pull-9 col-xs-12 col-xs-pull-0">
            <?php require_once 'page-part/left_colum.php';	?>
          </div>
      
	</div>
<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";?>

</div>
     <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>  
    <link rel="stylesheet" href="css/validation/validationEngine.jquery.css" type="text/css"/>
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/validation/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="js/validation/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>

	<script>
		jQuery(document).ready(function()
		{
			//alert("hi");
			jQuery("#MatriForm").validationEngine();
		});
	</script>  
</body>
</html>


