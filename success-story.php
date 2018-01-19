<?php
	error_reporting(0);
	include_once 'databaseConn.php';
	include_once 'lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	require_once("BusinessLogic/class.story.php");
	
	$sql="select * from success_story where status='APPROVED' ORDER BY RAND() LIMIT 0,4 ";
	$resultst=mysql_query($sql) or die(mysql_error());
	
	if(isset($_REQUEST['submit']))
{
		$brideid=mysql_real_escape_string($_POST['brideid']);
		$bridename=mysql_real_escape_string($_POST['bridename']);
		
		$groomid=mysql_real_escape_string($_POST['groomid']);
		$groomname=mysql_real_escape_string($_POST['groomname']);
		
		$mdate=strtotime($_POST['datepicker']);
		$marriagedate=date("Y-m-d",$mdate);
		$successmessage=mysql_real_escape_string($_POST['description']);
		$status='0';
		
		$sgg="select * from register where matri_id='$brideid'";
		$rrr=mysql_query($sgg);
		$num_row11 = mysql_num_rows($rrr); 
		
		$sgg2="select * from register where matri_id='$groomid'";
		$rrr2=mysql_query($sgg2);
		$num_row22 = mysql_num_rows($rrr2); 
		
		
			if ($num_row11 == 0) 
			{ 
				$msg1="Your Bride MatriId Not Found in Our Database.Please, Enter Valid Bride MatriId.";
			} 

			else if ($num_row22 == 0) 
			{ 
				$msg2="Your Groom MatriId Not Found in Our Database.Please, Enter Valid Groom MatriId.";
			} 
		
			else
			{ 
			         if(isset($_FILES['image']['name']))
					 {
						move_uploaded_file($_FILES['image']['tmp_name'],"SuccessStory/".$_FILES['image']['name']);
						$weddingphoto=$_FILES['image']['name'];
					 }
					  $ob=new story();
					  $ob->add_story($weddingphoto,$bridename,$brideid,$groomname,$groomid,$marriagedate,$successmessage,$status);
					  echo "<script language=\"javascript\">alert('Your success story  has been submited successfully to us.It will be online very soon after admin approval.');window.location=\"success_story.php\";</script>";
					
			}					
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon"/>
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />


<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/jquery-1.7.1.min.js"></script> 


<?php include "page-part/head.php";?>
<script src="js/jquery.validate.js"></script> 
<script>
$(document).ready(function(){


		$('#adformSearch').validate({
	    rules: {
	       brideid: {
	        required: true,
	       minlength: 4
	      },
		  
		 bridename: {
	        minlength: 4,
	        required: true
	      },
		  
            groomid: {
		required: true,
		minlength: 4
            },
            groomname: {
		required: true,
		minlength: 4
		
	},
		  
	    datepicker: {
	        required: true,
	        date: true
	      },
            description: {
	      	minlength: 30,
	        required: true
	      },
		  
		  agree: "required"
		  
	    },
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element
				.text('OK!').addClass('valid')
				.closest('.form-group').removeClass('error').addClass('success');
			}
	  });

}); // end document.ready
</script> 
<script>
		addEventListener('load', prettyPrint, false);
		$(document).ready(function(){
		$('pre').addClass('prettyprint linenums');
			});
		</script> 
<script type="text/javascript">
	function getSuccessDetail(tosid)
{
	$("#myModal1").html("Please wait...");
	$.get("./web-services/success_detail.php?tosid="+tosid,
	function(data){
		$("#myModal1").html(data);
	});
}
</script>

	<script type="text/javascript">
function checkbride(str)
{
if (str=="")
  {
  document.getElementById("bridename").value="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("bridename").value=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","checkbride.php?q="+str,true);
xmlhttp.send();
}
</script>
<script type="text/javascript">
function checkgroom(str)
{
if (str=="")
  {
  document.getElementById("groomname").value="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("groomname").value=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","checkgroom.php?q="+str,true);
xmlhttp.send();
}

</script>

</head>
<body>		
		<header>
		<?php
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
		
		include "page-part/top-black.php";
		
		?>
					
	</header>
	<article style="margin-top:-50px;">
					<div class="inner">
						<div class="inner-content">
						<div class="gradient-rev">
        <div class="col-sm-12 success-story">
            <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title"> Success Stories </h3>
            </div>
            <div class="panel-body">              
                <div class="col-lg-7 col-xs-12">              	            	
                       
						<div class="story-slider">
		
								<ul class="bxslider">
                            <?php 
							if(mysql_num_rows($resultst)>0)
							{
                                while($rowst=mysql_fetch_array($resultst)) 
                                 {  
                            ?> 
							
								
									<li>
										<div class="story-image">
											<img src="SuccessStory/<?php echo $rowst['weddingphoto']; ?>" />
										</div>
										<div class="story-content">
											<div class="quote">
												<p><?php echo substr($rowst['successmessage'], 0,100); ?></p>
											</div>
											<div class="couple-details">
												<h4><a href="#"  data-toggle="modal" data-target="#myModal1" onclick="getSuccessDetail(<?php echo $rowst['story_id']; ?>)" value="<?php echo $rowst['story_id']; ?>"><?php echo $rowst['bridename']; ?> & <?php echo $rowst['groomname']; ?></a></h4>
												<p><?php $date1=$rowst['marriagedate'];   echo $date2 = date("l, d M Y", (strtotime($date1)));   ?></p>
											</div>
										</div>
									</li>
								
								
		
							               
                           <?php } ?>
</ul>	</div>					   
	<?php 						}
							else
							{?>
                             <div class="ProfileDisplay1 col-xs-12 col-lg-12">
                             <h3>No Success story added.</h3>
                             </div>
                            
                            <?php
								
							}?>
                        </div>   	
                	               
              
                <div class="clearfix visible-xs"></div>
                <div class="col-lg-5 col-xs-12 text-center success-story margin-top-320">
          
                 <form name="adformSearch" id="adformSearch" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                            <label for="inputEmail3" class="col-lg-5 col-xs-12 control-label">Wedding Photo <font class="text-danger">*&nbsp;</font> :</label>
                            <div class="col-lg-7 col-xs-12">
                            <input type="file" class="form-control" name="image" id="image" />            
                            </div>
                    </div>
                <div class="form-group">
    			<label for="inputEmail3" class="col-lg-5 col-xs-12 control-label text-center">Bride's ID <font class="text-danger">*&nbsp;</font> :</label>
    			<div class="col-lg-7 col-xs-12">
      			<input type="text" class="form-control" name="brideid" id="brideid" onblur="return checkbride(this.value)" /> 
                        </div>
  		</div>
                <div class="form-group">
    			<label for="inputEmail3" class="col-lg-5 col-xs-12 control-label">Bride's Name <font class="text-danger">*&nbsp;</font> :</label>
    			<div class="col-lg-7 col-xs-12">
      			<input type="text" class="form-control" name="bridename" id="bridename" />           
    			</div>
  		</div>
                 <div class="form-group">
    			<label for="inputEmail3" class="col-lg-5 col-xs-12 control-label">Groome's ID <font class="text-danger">*&nbsp;</font> :</label>
    			<div class="col-sm-7 col-xs-12">
      			<input type="text" class="form-control" name="groomid" id="groomid" onblur="return checkgroom(this.value)" /> 
           
    			</div>
  		</div>
                 <div class="form-group">
    			<label for="inputEmail3" class="col-sm-5 control-label">Groome's Name <font class="text-danger">*&nbsp;</font> :</label>
    			<div class="col-lg-7 col-xs-12">
      			<input type="text" class="form-control" name="groomname" id="groomname" /> 
    			</div>
  		</div>
                <div class="form-group">
    			<label for="inputEmail3" class="col-lg-5 col-xs-12 control-label">Wedding Date <font class="text-danger">*&nbsp;</font> :</label>
    			<div class="col-lg-7 col-xs-12">
      			<input type="date" class="form-control" name="datepicker" id="datepicker" /> 
    			</div>
  		</div>
                <div class="form-group">
    			<label for="inputEmail3" class="col-lg-5 col-xs-12 control-label">Your experience <font class="text-danger">*&nbsp;</font> :</label>
    			<div class="col-lg-7 col-xs-12">
      			<textarea type="text" class="form-control" name="description" id="description" /></textarea>            
    			</div>
  		</div>
                        <div class="text-muted">&nbsp;</div>
                        <div class="form-group">
    			<div class="col-sm-offset-5 col-sm-8">
      			<button type="submit" name="submit" class="btn btn-success"> Submit </button>
                        <button type="reset" name="clear" class="btn btn-success"> Clear </button>
    			</div>
                        </div>
		</form>            
          </div>
            </div>
            </div>
            
       </div>         
          
            
      </div>	
      </div>	
      </div>	
      </article>	
     
        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <!-- /.modal-dialog -->
        </div>
        <!-----------------------top part end-------------------------->
        <?php include "page-part/footer.php";?>

</div>
    <script src="js/bootstrap.min.js"></script>   
    <link rel="stylesheet" href="css/jquery.ui.theme.css">
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.ui.datepicker.js"></script>
 <script>
$(function() {
$( "#datepicker" ).datepicker({
changeMonth: true,
changeYear: true
});
});
</script>

    </body>
</html>