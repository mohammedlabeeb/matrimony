<?php
	session_start();
	
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
	
		
		if(isset($_REQUEST['home_search']))
		{
			$_SESSION['gender786']=$_REQUEST['gender'];
			$_SESSION['fage']=$_POST['fage'];
			$_SESSION['tage']=$_POST['tage'];
			$_SESSION['religion123']=$_POST['religion_id'];
			$_SESSION['caste123']=$_POST['caste_id_search'];
			$_SESSION['m_tongue123']=$_POST['mtongue'];		
			$_SESSION['country123']=$_POST['txtCountry'];		
			$_SESSION['state123']=$_POST['cbo1State'];		
			echo "<script language='javascript'>window.location='search-result.php'</script>";
		}
?>

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

function GetStatemobile(strURL) 
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
						document.getElementById('StateDivmobile').innerHTML=req4.responseText;						
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

function GetCasteSearchmobile(strURL) 
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
						document.getElementById('searchCasteDivmobile').innerHTML=req4.responseText;						
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

</script>

<form class="form-horizontal" role="form" method="post">
 		<?php  if(!isset($_SESSION['gender123']))
			   {
				?>
 			<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Gender</label>
    <div class="col-sm-9">
        <input type="radio" name="gender" value="Male" class="radio-inline"> Male &nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="Female" class="radio-inline" checked> Female
    </div>
  </div> 
  				<?php
			   }
			   ?>
 
  <div class="form-group">
    <label for="inputPassword3" class="col-lg-3 col-xs-12 control-label">Age</label>
    <div class="col-lg-3 col-xs-5">
        <select class="form-control"  name="fage">
            <option value="" selected>- Age -</option>
                                <option value="18" selected="selected">18</option>
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
        </select>
    </div>
    <span class="col-lg-1 col-xs-2">TO</span>
    <div class="col-lg-3 col-xs-5">
        <select class="form-control" name="tage">            
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
                                <option value="50" >50</option>
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
        </select>
    </div>
  </div>
  
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Religion</label>
    <div class="col-sm-9">
      <select name="religion_id" class="form-control" id="religion_id" onchange="GetCasteSearchmobile('ajax_search2.php?religionId='+this.value)">
                              <option value="">--Please Select Religion--</option>
                                <?php
                                $SQL_STATEMENT =  "SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC";
                                $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                                while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                                {
                                ?>
                                <option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>"><?php echo $DatabaseCo->dbRow->religion_name; ?></option>
                                <?php                                 
                                } 
                                ?>
                              </select>
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Caste</label>
    <div class="col-sm-9" id="searchCasteDivmobile">
     <select  name="caste_id_search" id="caste_id_search" class="form-control"  >
                             <option value="">--Select Religion First--</option>
                              </select>
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Language</label>
    <div class="col-sm-9">
      <select  name="mtongue" id="mtongue"  class="form-control">
                             <option value="">--Please Select Language--</option>
                                <?php
                               $SQL_STATEMENT =  "SELECT * FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC";
                               $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                               while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                               {
                               ?>
                               <option value="<?php echo $DatabaseCo->dbRow->mtongue_id; ?>"><?php echo $DatabaseCo->dbRow->mtongue_name; ?></option>
                               <?php } ?>
                              </select>
    </div>
  </div>
    
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Country</label>
    <div class="col-sm-9">
        <select name="txtCountry" class="form-control" id="txtCountry" onchange="GetStatemobile('ajax_search.php?countryId='+this.value);">
                             
                                    <option value="">--Please Select country--</option>
                                   
                                    <?php
                                    $SQL_STATEMENT =  "SELECT * FROM country WHERE status='APPROVED'";
                                    $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                                    while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                                            {
                                    ?>
                                    <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>"><?php echo $DatabaseCo->dbRow->country_name; ?></option>
                                    <?php } ?>
                                </select>
    </div>
  </div>
    
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">State</label>
    <div class="col-sm-9" id="StateDivmobile">
      <select name="cbo1State" id="cbo1State" class="form-control" onchange="GetCity('ajax_search1.php?stateId='+this.value)"  >
                                  <?php
                                    $select1 =mysql_query("SELECT * FROM state WHERE state_id='$state_id'");
                                    $sta=mysql_fetch_array($select1);
                                    echo $sta['state_name'];?>
                                    </option>
                                    <option value="">--Select Country First--</option>
                                </select> 
    </div>
  </div>
    <div class="form-group" style="padding-top: 8px;">
    <div class="col-sm-offset-3 col-sm-8 col-xs-12 col-xs-offset-0">
      <button type="submit" class="btn btn-success col-xs-12" name="home_search">Search</button>
    </div>
  </div>
    <p align="justify">Find better partner with choosing <a href="advanced-search.php"> advance search area</a>. Using an advanced search brings advantages when you trying to find the information you need
</p>
</form>