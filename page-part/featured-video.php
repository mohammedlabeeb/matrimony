<style type="text/css">
.video iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.video {
  position: relative;
  width: 100%;
  height: 0;
  padding-bottom: 56.25%;
}

</style>

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


 <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><img src="./images/icons/video.png" />&nbsp;&nbsp; Featured Video </h3>
            </div>
 <div class="panel-body video">
       
                     <?php
		$fet=mysql_query("select * from register where fstatus='Featured' and (video!='' or video_url!='') and video_approval='APPROVED' order by rand() limit 0,1");		
		$d=mysql_fetch_array($fet);		
		
			if($d['video']!="")
			{
				$p=$d['video'];
				?>
               
<div id="flvplayer"><img src="images/loader.gif"></div>    

        	<script language="javascript">
	
	
	var so = new SWFObject("mpw_player.swf", "swfplayer", "230", "230", "5", "#000000"); 
	
	so.addVariable("flv", "video-list/<?php echo $p; ?>","swfplayer", "230", "230", "5", "#000000"); // File Name
	
	
	so.addVariable("jpg","images/loader.gif"); // Preview photo
	so.addVariable("autoplay","false"); // Autoplay, make true to autoplay
	so.addParam("allowFullScreen","true"); // Allow fullscreen, disable with false
	so.addVariable("backcolor","000000"); // Background color of controls in html color code
	so.addVariable("frontcolor","ffffff"); // Foreground color of controls in html color code
	so.write("flvplayer"); // This needs to be the name of the div id
</script>
       
                <?php
			}
			
			
				else if($d['video_url']!="")
				{
				?>
                
					<div>
            <?php echo $d['video_url']; ?> 
            		</div>
                
               
                <?php
				}
				
			
			else
			{
				?>
                <h4>No video available</h4>
                <?php
					
			}					  
		?>		 
                     
            </div>
            
   </div>   