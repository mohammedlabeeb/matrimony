<?php
		error_reporting(0);
	  	include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();		
	
		require_once("BusinessLogic/class.occupation.php");
		
    	
		$o=new occupation();
		$oc=$o->get_ocp_by_status();
		
		
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
		
		if(isset($_REQUEST['occ_search']))
		{
			$_SESSION['gender786']=$_REQUEST['gender'];
			$_SESSION['fage']=$_POST['fage'];
			$_SESSION['tage']=$_POST['tage'];
			$_SESSION['fromheight']=$_POST['fheight'];
			$_SESSION['toheight']=$_POST['theight'];
			$_SESSION['m123']=$_POST['m_status'];			
			$_SESSION['occupation']=implode(',',$_POST['occupation']);			
			$mid=$_SESSION['mid'];
	echo "<script language='javascript'>window.location='search-result.php'</script>";
		}
		
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />

<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<?php include "page-part/head.php";?>
<link href="css/componant-v101.css" rel="stylesheet" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/dropdown-v9.js"></script>

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
           <h3 class="panel-title">Occupational Search</h3>
       </div>
       <div class="panel-body">
           <p><i class="glyphicon glyphicon-arrow-right"></i>Search based on a occupational criteria one would look for in a partner. If you like a profile you can Express Interest or Send Mail.</p>
            <p class="clearfix"></p>
              	<form class="form-horizontal" role="form" action="" method="post">
                 <?php  if(!isset($_SESSION['gender123']))
			   {
				?>
                
				<div class="form-row">
													<div class="form-label"><label>Looking for</label></div>
													<div class="form-fields">
														<table cellpadding="0" cellspacing="0">
															<tr>
																<td>
																	<input id="male" value="Male" type="radio" name="gender">
																	<label class="css-label-radio clr" for="male">Male</label>
																</td>
																<td>
																	<input id="female" value="Female" type="radio" name="gender">
																	<label class="css-label-radio clr" for="female">Female</label>
																</td>
															</tr>
														</table>
													</div>
												</div>
				
                <?php
			   }
			   ?>
                
  			   <div class="form-row">
													<div class="form-label"><label>Age</label></div>
    			<div class="form-fields">
                <div class="col-sm-4 col-xs-5">
      			<select name="fage" class="form-control custom-select" >
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
               <div class="col-sm-2 col-xs-2">
                <label>To</label>
               </div>
                
                <div class="col-sm-4 col-xs-5">
                <select name="tage" class="form-control" >
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
				
          
		   <div class="form-row">
													<div class="form-label"><label>Marital Status</label></div>
													<div class="form-fields">
														<table cellpadding="0" cellspacing="0">
															<tr>
																<td>
																	 <input type="radio"  name="m_status" id="Any" value="Any" checked="checked"><label class="css-label-radio clr" for="Any">Any</label>
																</td>
																<td>
																	<input type="radio"  name="m_status" id="Unmarried" value="Unmarried"><label class="css-label-radio clr" for="Unmarried">Unmarried</label>
																</td>
															</tr>
															<tr>
																<td>
																	 <input type="radio"  name="m_status" id="Widow" value="Widow/Widower"><label class="css-label-radio clr" for="Widow">Widow/Widower</label>
																</td>
																<td>
																	 <input type="radio"  name="m_status" id="Divorcee" value="Divorcee"><label class="css-label-radio clr" for="Divorcee">Divorcee</label
																</td>
															</tr>
														</table>
													</div>
												</div>
												
												
												
  				
          
        
       <div class="form-row">
													<div class="form-label"><label>Occupation</label></div>
    			<div class="form-fields">
				
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
</select>			</div>
			<br clear="all" />
		</div>
         
  				
  				<div class="form-group">
    			<div class="col-sm-offset-2 col-sm-10">
      			<button type="submit" name="occ_search" class="btn btn-success col-sm-3 col-xs-12"> Search </button>
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
		
            
        });
        
</script>