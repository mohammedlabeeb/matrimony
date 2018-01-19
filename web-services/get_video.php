<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();	
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 
 
 */
					
$from_id = isset($_GET['frmid'])?$_GET['frmid']:0;
$get=mysql_query("select * from register_view where matri_id='$from_id'");
$d=mysql_fetch_array($get);

	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
?>
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

<style type="text/css">
iframe 
{
	width:620px !important;
	height:320px !important;	
}

.modal.fade .modal-dialog{transform:none !important;}


</style>

<div class="modal-dialog" style="width:710px; height:400px;" onLoad="MM_CheckFlashVersion('7,0,0,0','Content on this page requires a newer version of Macromedia Flash Player. Do you want to download it now?');">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Video of <?php echo $d['username'];?></h4>
              </div>
               
              <div class="modal-body">                 
                      
                     	<div class="col-sm-10">
                     <?php
				
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
                
					<div style="width:560px; height:330px;">
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
              
             
              <div class="modal-footer">
                
               
              </div>
                    
            </div>
          </div>