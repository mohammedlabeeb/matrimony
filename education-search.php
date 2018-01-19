<?php
error_reporting(0);
	  	include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();
		
		
	
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
	
		if(isset($_REQUEST['education_search']))
		{
			$_SESSION['gender786']=$_REQUEST['gender'];
			$_SESSION['fage']=$_POST['fage'];
			$_SESSION['tage']=$_POST['tage'];
			$_SESSION['fromheight']=$_POST['fheight'];
			$_SESSION['toheight']=$_POST['theight'];
			$_SESSION['m123']=$_POST['m_status'];
			
			$_SESSION['education123']=implode(',',$_POST['edu_detail']);
			
			$mid=$_SESSION['mid'];

			echo "<script language='javascript'>window.location='search-result.php'</script>";
		}
		
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<?php include "page-part/head.php";?>
<link href="css/componant-v101.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
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
              <h3 class="panel-title">Educational Search</h3>
            </div>
            <div class="panel-body">
            <p class="col-xs-12"><i class="glyphicon glyphicon-arrow-right"></i> Search based on a education criteria one would look for in a partner. If you like a profile you can Express Interest or Send Mail. </p>
            <p class="clearfix"></p>
              	<form class="form-horizontal" role="form" action="" method="post">
                
                 <?php  if(!isset($_SESSION['gender123']))
			   {
				?>
                <div class="form-group">
    			<label for="inputEmail3" class="col-sm-2 col-xs-12 text-center control-label">Looking For</label>
    			<div class="col-sm-6 col-sm-push-0 col-xs-8 col-xs-push-2">
      			<input type="radio"  name="gender" value="Male">&nbsp;&nbsp;Male &nbsp;&nbsp;&nbsp;
                <input type="radio"  name="gender" value="Female" checked="checked">&nbsp;&nbsp;Female
    			</div>
  				</div>
                <?php
			   }
			   ?>
                
                <div class="form-group">
    			<label for="inputEmail3" class="col-sm-2 control-label col-xs-12 text-center">Age</label>
    			<div class="col-sm-6 col-xs-12">
                <div class="col-sm-4 col-xs-5 padding-left-zero padding-right-zero">
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
                               <div class="col-xs-2 col-sm-2">
                                <label>To</label>
                                </div>
                                
                                <div class="col-sm-4 col-xs-5 padding-left-zero padding-right-zero">
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
    			<label for="inputEmail3" class="col-sm-2 control-label col-xs-12 text-center">Marital Status</label>
    			<div class="col-sm-8 col-xs-12">
				<select name="m_status" class="form-control">
					<option value="Any">Any</option>
					<option value="Unmarried">Unmarried</option>
					<option value="Widow/Widower">Widow/Widower</option>
					<option value="Divorcee">Divorcee</option>
				</select>
      			
    			</div>
  				</div>
         
        
        <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label multiple-select col-xs-12 text-center">Education</label>
			<div class="src_field_box col-xs-12 col-sm-6">
				
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
</select>			</div>
			<br clear="all" />
		</div>
        
       
  				<div class="form-group">
    			<div class="col-sm-offset-2 col-sm-3 col-xs-12 col-xs-offset-0">
      			<button type="submit" name="education_search" class="btn btn-success col-xs-12"> Search </button>
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
           
      
            
        });
        
</script>