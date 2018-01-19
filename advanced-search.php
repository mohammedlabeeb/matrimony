<?php
		error_reporting(0);
	  	include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './lib/pagination.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();
		
		include_once("BusinessLogic/class.mothertongue.php");
		require_once("BusinessLogic/class.occupation.php");
		require_once("BusinessLogic/class.country.php");
	
	
    	$mt22=new mothertongue();
	$rescn2=$mt22->get_mtongue_by_status();
	$o=new occupation();
	$oc=$o->get_ocp_by_status();
	$c2=new country();
	$cc2=$c2->get_country_by_status();
	
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
		
		if(isset($_REQUEST['advanced_search']))
		{
			$_SESSION['gender786']=$_REQUEST['gender'];
			$_SESSION['fage']=$_POST['fage'];
			$_SESSION['tage']=$_POST['tage'];
			$_SESSION['fromheight']=$_POST['fheight'];
			$_SESSION['toheight']=$_POST['theight'];
			$_SESSION['mstatus123']=$_POST['m_status'];			
			
			$_SESSION['religion123']=$_POST['religion'];
			$_SESSION['caste123']=implode(',',$_POST['caste']);
			$_SESSION['m_tongue123']=implode(',',$_POST['m_tongue']);
			$_SESSION['education123']=implode(',',$_POST['edu_detail']);
			$_SESSION['occupation']=implode(',',$_POST['occupation']);
			$_SESSION['country123']=$_POST['country'];
			$_SESSION['state123']=$_POST['state'];
			$_SESSION['city123']=implode(',',$_POST['city']);		
			
			$mid=$_SESSION['mid'];

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
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
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

function GetState(arg)
{
	 var strURL="ajaxGeneral.php?country_id="+arg;
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
				document.getElementById('StateDiv').innerHTML=req.responseText;
				
				if(req.responseText==0)
				{
				document.getElementById('state_div').style.display = "none";
				}
				else
				{
					document.getElementById('state_div').style.display = "block";
					
					
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


function GetCity(arg)
{
	 var strURL="ajaxGeneral.php?state_id="+arg;
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
				document.getElementById('CityDiv').innerHTML=req.responseText;
				
				if(req.responseText==0)
				{
				document.getElementById('city_div').style.display = "none";
				}
				else
				{
					document.getElementById('city_div').style.display = "block";
					$("#city").dropdown({
                change : function(curSelVal){
                            if( curSelVal != undefined ){
                                if( curSelVal == "" ){
                                    $("#city > option:selected").removeAttr("selected");
                                    $("#city option:first").attr('selected','selected');
                                }else{
                                    $("#city option:first").removeAttr('selected');
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
              <h3 class="panel-title">Advanced Search</h3>
            </div>
            <div class="panel-body advanced-search">
            <p class="col-xs-12"><i class="glyphicon glyphicon-arrow-right"></i> Search based on a advanced criteria one would look for in a partner. If you like a profile you can Express Interest or Send Mail. </p>
            <p class="clearfix"></p>
              	<form class="form-horizontal" role="form" action="" method="post">
                
                <?php  if(!isset($_SESSION['gender123']))
			   {
				?>
                <div class="form-group">
    			<label for="inputEmail3" class="col-sm-2 col-xs-12 control-label text-center">Looking For</label>
    			<div class="col-sm-6 col-xs-12">
      			<div class="col-lg-12 col-xs-6">
                	<input type="radio"  name="gender" value="Male">
                    &nbsp;&nbsp;Male &nbsp;&nbsp;&nbsp;                
                </div>
                <div class="col-lg-12 col-xs-6">
                     <input type="radio"  name="gender" value="Female" checked="checked">&nbsp;&nbsp;Female
                </div>
    			</div>
  				</div>
                <?php
			   }
			   ?>
                
  				
                
                <div class="form-group">
    			<label for="inputEmail3" class="col-sm-2 col-xs-12 control-label text-center">Age</label>
    			<div class="col-sm-6 col-xs-12">
                            <div class="col-sm-4 col-xs-5">
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
                            <div class="col-xs-2">
                             <label>To</label>
                            </div>
                
                        <div class="col-sm-4 col-xs-5">
                            <select name="tage" class="form-control">
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
    			<label for="inputEmail3" class="col-sm-2 control-label col-xs-12 text-center">Height</label>
    			<div class="col-sm-6 col-xs-12">
                            <div class="col-sm-4 col-xs-5">
      			<select name="fheight" class="form-control" >
                                <option value="Below 4ft">Below 4ft</option>
                                <option value="4ft 6in" selected>4ft 6in</option>
                                <option value="4ft 7in">4ft 7in</option>
                                <option value="4ft 8in">4ft 8in</option>
                                <option value="4ft 9in">4ft 9in</option>
                                <option value="4ft 10in">4ft 10in</option>
                                <option value="4ft 11in">4ft 11in</option>
                                <option value="5ft">5ft</option>
                                <option value="5ft 1in">5ft 1in</option>
                                <option value="5ft 2in">5ft 2in</option>
                                <option value="5ft 3in">5ft 3in</option>
                                <option value="5ft 4in">5ft 4in</option>
                                <option value="5ft 5in">5ft 5in</option>
                                <option value="5ft 6in">5ft 6in</option>
                                <option value="5ft 7in">5ft 7in</option>
                                <option value="5ft 8in">5ft 8in</option>
                                <option value="5ft 9in">5ft 9in</option>
                                <option value="5ft 10in">5ft 10in</option>
                                <option value="5ft 11in">5ft 11in</option>
                                <option value="6ft">6ft</option>
                                <option value="6ft 1in">6ft 1in</option>
                                <option value="6ft 2in">6ft 2in</option>
                                <option value="6ft 3in">6ft 3in</option>
                                <option value="6ft 4in">6ft 4in</option>
                                <option value="6ft 5in">6ft 5in</option>
                                <option value="6ft 6in">6ft 6in</option>
                                <option value="6ft 7in">6ft 7in</option>
                                <option value="6ft 8in">6ft 8in</option>
                                <option value="6ft 9in">6ft 9in</option>
                                <option value="6ft 10in">6ft 10in</option>
                                <option value="6ft 11in">6ft 11in</option>
                                <option value="7ft">7ft</option>
                                <option value="Above 7ft">Above 7ft</option>
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <label>To</label>
                        </div>                
                        <div class="col-sm-4 col-xs-5">
                            <select name="theight" class="form-control" >
                                <option value="Below 4ft">Below 4ft</option>
                                <option value="4ft 6in" selected>4ft 6in</option>
                                <option value="4ft 7in">4ft 7in</option>
                                <option value="4ft 8in">4ft 8in</option>
                                <option value="4ft 9in">4ft 9in</option>
                                <option value="4ft 10in">4ft 10in</option>
                                <option value="4ft 11in">4ft 11in</option>
                                <option value="5ft">5ft</option>
                                <option value="5ft 1in">5ft 1in</option>
                                <option value="5ft 2in">5ft 2in</option>
                                <option value="5ft 3in">5ft 3in</option>
                                <option value="5ft 4in">5ft 4in</option>
                                <option value="5ft 5in" selected="selected">5ft 5in</option>
                                <option value="5ft 6in">5ft 6in</option>
                                <option value="5ft 7in">5ft 7in</option>
                                <option value="5ft 8in">5ft 8in</option>
                                <option value="5ft 9in">5ft 9in</option>
                                <option value="5ft 10in">5ft 10in</option>
                                <option value="5ft 11in">5ft 11in</option>
                                <option value="6ft">6ft</option>
                                <option value="6ft 1in">6ft 1in</option>
                                <option value="6ft 2in">6ft 2in</option>
                                <option value="6ft 3in">6ft 3in</option>
                                <option value="6ft 4in">6ft 4in</option>
                                <option value="6ft 5in">6ft 5in</option>
                                <option value="6ft 6in">6ft 6in</option>
                                <option value="6ft 7in">6ft 7in</option>
                                <option value="6ft 8in">6ft 8in</option>
                                <option value="6ft 9in">6ft 9in</option>
                                <option value="6ft 10in">6ft 10in</option>
                                <option value="6ft 11in">6ft 11in</option>
                                <option value="7ft">7ft</option>
                                <option value="Above 7ft">Above 7ft</option>
                            </select>
                            </div>
    			</div>
  		</div>
                
                <div class="form-group">
    			<label for="inputEmail3" class="col-sm-2 control-label col-xs-12 text-center">Marital Status</label>
    			<div class="col-sm-8 col-xs-12">
      			
                  <div class="col-xs-12"><input type="radio"  name="m_status" value="Any" checked="checked">
                  &nbsp;&nbsp;Any &nbsp;&nbsp;&nbsp;</div>
                  <div class="col-xs-12"><input type="radio"  name="m_status" value="Unmarried">
                  &nbsp;&nbsp;Unmarried&nbsp;&nbsp;&nbsp;</div>
                  <div class="col-xs-12"><input type="radio"  name="m_status" value="Widow/Widower">
                  &nbsp;&nbsp;Widow/Widower&nbsp;&nbsp;&nbsp;</div>
                  <div class="col-xs-12"><input type="radio"  name="m_status" value="Divorcee">
                  &nbsp;&nbsp;Divorcee</div>
                </div>
  				</div>
                
  				<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label col-xs-12 text-center">Religion</label>
			<div class="col-sm-4 col-xs-12">
				
<select name="religion" id="religion"  class="form-control " onChange="GetCaste(this.value)" >
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
										</select>			</div>
			<br clear="all" />
		</div>
               
               
               <div class="form-group" id="caste_div" style="display:none;">
			
                            <label for="inputPassword3" class="col-sm-2 col-xs-12 text-center control-label multiple-select">Caste</label>
                            <div class="src_field_box col-xs-12 col-sm-8" id="CasteDiv">
    
    
                           
			</div>
            <br clear="all" />
		</div>
               
                
                
        <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 col-xs-12 control-label multiple-select text-center">Mother Tongue</label>
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
</select>			</div>
			<br clear="all" />
		</div>
        
        
                        <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label multiple-select col-xs-12 text-center">Education</label>
                                <div class="src_field_box col-xs-12 col-lg-4">

                                <select name="edu_detail[]" id="edu_detail" multiple="multiple" class="src_field_select">
                                <option value="" label="Doesn't Matter" selected="selected">Doesn't Matter</option>
                                <?php
                                                                $sql2=mysql_query("select * from education_detail");
                                                                        while($occ=mysql_fetch_array($sql2))
                                                                        {
                                                                ?>
                                                                <option value="<?php echo $occ['edu_id']; ?>"><?php echo ucfirst($occ['edu_name']); ?></option>
                                                                <?php
                                                                        }
                                                                ?>
                                </select>			
                                </div>
                                <br clear="all" />
                        </div>        
        
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label multiple-select col-xs-12 text-center">Occupation</label>
                            <div class="src_field_box col-xs-12 col-lg-4">
				
                            <select name="occupation[]" id="occupation" multiple="multiple" class="src_field_select">
                            <option value="" label="Doesn't Matter" selected="selected">Doesn't Matter</option>
                                    <?php
                                    while($occ=mysql_fetch_array($oc))
                                    {
                                    ?>
                                    <option value="<?php echo $occ['ocp_id']; ?>"><?php echo ucfirst($occ['ocp_name']); ?></option>
                                    <?php
					}
                                    ?>
                                </select>			
                            </div>
                            <br clear="all" />
                        </div> 
        
                        <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label col-xs-12 text-center">Country</label>
                                <div class="col-sm-4 col-xs-12">				
                                <select name="country" id="country"  class="form-control" onChange="GetState(this.value)" style="height:30px; padding:5px 0 2px 3px;">
                                <option value="" label="Doesn't Matter" selected="selected">Doesn't Matter</option>
                                        <?php
                                                while($row=mysql_fetch_array($cc2))
                                                {
                                                ?>
                                                    <option value="<?php echo $row['country_id']; ?>">
                                                    <?php echo ucfirst($row['country_name']); ?></option>
                                                <?php
                                                }
                                                ?>
                                </select>			
                                </div>
                                <br clear="all" />
                        </div>
        
                        <div class="form-group" id="state_div" style="display:none;">
                            <label for="inputPassword3" class="col-sm-2 col-xs-12 control-label">State</label>
                            <div class="col-sm-4 col-xs-12" id="StateDiv"></div>
                            <br clear="all" />
                        </div>        
                        <div class="form-group" id="city_div" style="display:none;">
                            <label for="inputPassword3" class="col-sm-2 col-xs-12 control-label multiple-select">City</label>
                            <div class="src_field_box" id="CityDiv"></div>
                            <br clear="all" />
                        </div>
                               
  				
  			<div class="form-group">
                            <div class="col-sm-9 col-xs-12 col-sm-offset-1 col-xs-offset-0">
                            <button type="submit" name="advanced_search" class="btn btn-success col-lg-3 col-xs-5"> Search </button>
                            <button type="reset" name="clear" class="btn btn-success col-lg-3 col-xs-5 col-lg-offset-1 col-xs-offset-2"> Clear </button>
                            </div>
  			</div>
		</form>
            </div>
          </div>
          </div>
          
          
      </div>	
      </div>	
</article>
<!-----------------------top part end-------------------------->

 <?php include "page-part/footer.php";?>
</div> 
 </body>
</html>
<script language="javascript">
        $(document).ready(function(){         
            
            $("#occupation").dropdown({
                change : function(curSelVal){
                            if( curSelVal != undefined ){
                                if( curSelVal == "" ){
                                    $("#occupation > option:selected").attr('selected', false);
                                    $("#occupation option:first").attr('selected','selected');
                                }else{
                                    $("#occupation option:first").attr('selected',false);
                                }
                            }
                            
                        }
            });			
			
            $("#edu_detail").dropdown({
                change : function(curSelVal){
                            if( curSelVal != undefined ){
                                if( curSelVal == "" ){
                                    $("#edu_detail > option:selected").removeAttr("selected");
                                    $("#edu_detail option:first").attr('selected','selected');
                                }else{
                                    $("#edu_detail option:first").removeAttr('selected');
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