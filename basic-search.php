<?php
		error_reporting(0);
	  	include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();
		include_once("BusinessLogic/class.mothertongue.php");
	
		$mt22=new mothertongue();
		$rescn2=$mt22->get_mtongue();
		
		unset($_SESSION['query']);
	unset($_SESSION['sql']);
	unset($_SESSION['religion123']);
	unset($_SESSION['caste123']);
	unset($_SESSION['m_tongue123']);
	unset($_SESSION['fromheight']);
	unset($_SESSION['toheight']);
	unset($_SESSION['mstatus123']);
	unset($_SESSION['education123']);
	unset($_SESSION['occupation']);
	unset($_SESSION['country123']);
	unset($_SESSION['state123']);
	unset($_SESSION['city123']);
	unset($_SESSION['manglik']);
	unset($_SESSION['keyword']);
	unset($_SESSION['gender786']);	
		
		
		if(isset($_REQUEST['basic_search']))
		{
			$_SESSION['gender786']=$_REQUEST['gender'];
			$_SESSION['fage']=$_POST['fage'];
			$_SESSION['tage']=$_POST['tage'];
			$_SESSION['religion123']=$_POST['religion'];
			$_SESSION['caste123']=implode(',',$_POST['caste']);
			$_SESSION['m_tongue123']=implode(',',$_POST['m_tongue']);		
			echo "<script language='javascript'>window.location='search-result.php'</script>";
		}
	
	
		
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<link href="css/componant-v101.css" rel="stylesheet" type="text/css" />


<?php include "page-part/head.php";?>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>	
<script type="text/javascript" src="js/dropdown-v9.js"></script>
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
function GetCaste(arg)
{
	 var strURL="ajaxGeneral.php?religion_id="+arg;
	var req = getXMLHTTP();
	if (req)
	{
		req.onreadystatechange = function()
		{
			if (req.readyState == 4)
			{
			  // only if "OK"
			  if (req.status == 200)
			  {
				document.getElementById('CasteDiv').innerHTML=req.responseText;
				
				if(req.responseText==0)
				{
				document.getElementById('caste_div').style.display = "none";
				}
				else
				{
					document.getElementById('caste_div').style.display = "block";
					 $("#caste").dropdown({
                change : function(curSelVal){
                            if( curSelVal != undefined ){
                                if( curSelVal == "" ){
                                    $("#caste > option:selected").removeAttr("selected");
                                    $("#caste option:first").attr('selected','selected');
                                }else{
                                    $("#caste option:first").removeAttr('selected');
                                }
                            }
                        }
            });
				}
			  }
 			  else 
			  {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
			  }
			}
		}
		req.open("GET", strURL, true);
		req.send(null);
	}
}	
</script>

</head>
<body>		
<div class="wrapper gradient">  
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
						
						<?php include('page-part/accountsidebar.php'); ?>
						<div class="main-area gradient-rev"> 
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">Basic Search</h3>
            </div>
            <div class="panel-body">
           <div class="col-lg-12"><i class="glyphicon glyphicon-arrow-right"></i> &nbsp;&nbsp; Search based on a simple criteria one would look for in a partner. Results can be viewed as Thumbnail View, Full View. If you like a profile you can Express Interest or Send Mail. </div>
            
              	<form class="form-horizontal" role="form" action="" method="post">
                <?php  if(!isset($_SESSION['gender123']))
			   {
				?>
                        <div class="form-group">
    			<label for="inputEmail3" class="col-lg-2 control-label col-xs-12 text-center">Looking For</label>
    			<div class="col-lg-6  col-lg-offset-0 col-xs-8 col-xs-offset-2">
                            <input type="radio"  name="gender" value="Male" />&nbsp;&nbsp;Male &nbsp;&nbsp;&nbsp;
                            <input type="radio"  name="gender" value="Female" checked="checked" />&nbsp;&nbsp;Female
    			</div>
  			</div>
                <?php
			   }
			   ?>
  				
                
                <div class="form-group">
    			<label for="inputEmail3" class="col-lg-2 control-label col-xs-12 text-center">Age</label>
    			<div class="col-lg-6 col-xs-12 padding-left-zero padding-right-zero">
                        <div class="col-sm-3 col-xs-5">
      			<select name="fage" class="form-control">
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    <option value="32">32</option>
                    <option value="33">33</option>
                    <option value="34">34</option>
                    <option value="35">35</option>
                    <option value="36">36</option>
                    <option value="37">37</option>
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                    <option value="44">44</option>
                    <option value="45">45</option>
                    <option value="46">46</option>
                    <option value="47">47</option>
                    <option value="48">48</option>
                    <option value="49">49</option>
                    <option value="50">50</option>
                    <option value="51">51</option>
                    <option value="52">52</option>
                    <option value="53">53</option>
                    <option value="54">54</option>
                    <option value="55">55</option>
                    <option value="56">56</option>
                    <option value="57">57</option>
                    <option value="58">58</option>
                    <option value="59">59</option>
                    <option value="60">60</option>
                </select>
                </div>
                <div class="col-lg-2 col-xs-2">
                <label>To</label>
                </div>
                
                <div class="col-lg-3 col-xs-5">
                <select name="tage" class="form-control ">
                <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30" selected="selected">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                        <option value="44">44</option>
                        <option value="45">45</option>
                        <option value="46">46</option>
                        <option value="47">47</option>
                        <option value="48">48</option>
                        <option value="49">49</option>
                        <option value="50">50</option>
                        <option value="51">51</option>
                        <option value="52">52</option>
                        <option value="53">53</option>
                        <option value="54">54</option>
                        <option value="55">55</option>
                        <option value="56">56</option>
                        <option value="57">57</option>
                        <option value="58">58</option>
                        <option value="59">59</option>
                        <option value="60">60</option>
                </select>
                </div>
    			</div>
  				</div>
                
  				<div class="form-group">
			<label for="inputPassword3" class="col-lg-2 col-xs-12 control-label text-center">Religion</label>
			<div class="col-lg-4 col-xs-12">
				
<select name="religion" id="religion"  class="form-control" onChange="GetCaste(this.value)" style="height:30px; padding:5px 0 2px 3px;">
							<option value="" label="Doesn't Matter" selected="selected">Doesn't Matter</option>
							<?php
								$d=mysql_query("select * from religion where status='APPROVED'");
								while($resrel=mysql_fetch_array($d))
								{
							?>
							<option value="<?php echo $resrel['religion_id']; ?>"><?php echo ucfirst($resrel['religion_name']); ?></option>
							<?php
								}
							?>
						</select>			
                        </div>
			<br clear="all" />
		</div>      
                            <div class="form-group" id="caste_div" style="display:none;">			
                            <label for="inputPassword3" class="col-lg-2 col-xs-12 control-label multiple-select">Caste</label>
                            <div class="src_field_box col-xs-12 col-lg-4" id="CasteDiv"> 
			</div>
            <br clear="all" />
		</div>
                <div class="form-group">
			<label for="inputPassword3" class="col-lg-2 col-xs-12 control-label multiple-select">Mother Tongue</label>
			<div class="src_field_box col-xs-12 col-lg-4">				
                        <select name="m_tongue[]" id="m_tongue" multiple="multiple" class="src_field_select">
                        <option value="" label="Doesn't Matter" selected="selected">Doesn't Matter</option>
                            <?php
								while($rowcc=mysql_fetch_array($rescn2))
								{
							?>
                <option value="<?php echo $rowcc['mtongue_id']; ?>"><?php echo ucfirst($rowcc['mtongue_name']); ?></option>
							<?php
								}
							?>
                        </select>			
                        </div>
			<br clear="all" />
		</div> 	
  				<div class="form-group">
    			<div class="col-sm-offset-2 col-sm-2 col-xs-12 col-xs-offset-0">
      			<button type="submit" name="basic_search" class="btn btn-success col-xs-12"> Search </button>
    			</div>
  				</div>
				</form>
              <div class="clearfix"></div>
             
                 
            </div>
          </div>
          </div>
          </div>
          
         
          </div>
		  
		  </article>
         
            <div class="clearfix visible-xs"></div>
      	
	
    <script language="javascript">
        $(document).ready(function(){			
			 $("#caste").dropdown({
                change : function(curSelVal){
                            if( curSelVal != undefined ){
                                if( curSelVal == "" ){
                                    $("#caste > optgroup > option:selected").removeAttr("selected");
                                    $("#caste option:first").attr('selected','selected');
                                }else{
                                    $("#caste option:first").removeAttr('selected');
                                }
                            }
                        }
            });           
                     
            $("#m_tongue").dropdown({
                change : function(curSelVal){
                            if( curSelVal != undefined ){
                                if( curSelVal == "" ){
                                    $("#m_tongue > option:selected").removeAttr("selected");
                                    $("#m_tongue option:first").attr('selected','selected');
                                }else{
                                    $("#m_tongue option:first").removeAttr('selected');
                                }
                            }   
                            
                        }
                    });
            
        });
        
</script>
<!-----------------------top part end-------------------------->

    <?php include "page-part/footer.php";?>
 </div>
 </body>
</html>

