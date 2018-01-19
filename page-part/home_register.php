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

function GetCaste(strURL) 
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
						document.getElementById('CasteDiv').innerHTML=req4.responseText;						
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

	<script>
		function regvalid()
		{
			
			var MatriForm = this.document.regform;
			
			if ( MatriForm.fullname.value == "" )
			{
				alert( "Please enter your fullname." );
				MatriForm.fullname.focus( );
				return false;
			}
			if ( MatriForm.email.value == "" )
			{
				alert( "Please enter a valid E-mail ID. (Eg:- abc@gmail.com)" );
				MatriForm.email.focus( );
				return false;
			}
			
			
			if ( MatriForm.password.value == "" )
			{
				alert( "Please enter a password." );
				MatriForm.password.focus( );
				return false;
			}
			if ( MatriForm.password.value.length < 4 )
			{
				alert( "Password must be atleast 4 characters." );	
				MatriForm.password.focus( );
				return false;
			}
			 if (MatriForm.religion_id.selectedIndex == 0)
			{
				alert( "Please select your religion." );	
				MatriForm.religion_id.focus( );
				return false;
			}
			 if (MatriForm.caste_id.value == 0)
			{
				alert( "Please select your caste." );	
				MatriForm.caste_id.focus( );
				return false;
			}
			if (MatriForm.mobile.value == "")
			{
				alert("Please enter your contact number.");
				MatriForm.mobile.focus( );
				return false; 
			}
			if(isNaN(MatriForm.mobile.value)) 
			{
				alert('Please enter only numbers');
				MatriForm.mobile.focus( );
				return false;
			}
			if (MatriForm.mobile.value.length < 10 )
			{
				alert( "Please enter a valid mobile number." );	
				MatriForm.mobile.focus( );
				return false;
			}
		return true;
	
		}
	</script>
    
 <form name="regform" id="regform" class="form-horizontal" action="register.php" method="post"  onSubmit="return regvalid();">

    <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Full Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="fullname" data-validation-engine="validate[required]">
    </div>
    </div>
    
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="email" placeholder="Email" name="email" data-validation-engine="validate[required,custom[email]]">
    </div>
    </div>
    
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Password</label>
    <div class="col-sm-8">
        <input type="password" class="form-control" id="password" placeholder="Password" name="password" data-validation-engine="validate[required]">
    </div>
    </div>
    
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Gender</label>
    <div class="col-sm-8">
        <select class="form-control"  name="gender" id="gender" data-validation-engine="validate[required]" >
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>
    </div>
    
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Religion</label>
    <div class="col-sm-8">
        <select name="religion_id" class="form-control" id="religion_id" onchange="GetCaste('ajax_search2.php?religionId='+this.value)" data-validation-engine="validate[required]">
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
    <label for="inputEmail3" class="col-sm-4 control-label">Caste</label>
    <div class="col-sm-8" id="CasteDiv">
       <select  name="caste_id" id="caste_id" class="form-control"  data-validation-engine="validate[required]">
                             <option value="">--Select Religion first--</option>
                              </select>
    </div>
    </div>
    
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Mobile No</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="mobile" placeholder="Mobile No" name="mobile" data-validation-engine="validate[required,custom[number]]">
    </div>
    </div>
    
    <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8 col-xs-12 col-xs-offset-0">
      <button type="submit" class="btn btn-success col-xs-5 col-xs-offset-0 col-lg-5 " name="register">Register</button>
      <button type="reset" class="btn btn-success col-xs-6  col-xs-offset-1 col-lg-6 col-lg-offset-1">Clear</button>
    </div>
  </div> 
<div class="form-group">
   <div class="col-sm-12 col-xs-12 col-xs-offset-0">
      <button  onClick="keyword-search.php" class="btn btn-warning col-xs-5">Keyword Search</button>
      <button onClick="search.php" class="btn btn-warning col-xs-6 col-xs-push-1">More Search Option</button>
    </div>
</div>
<p class="text-info">Regitster With us to get excellent profiles in to your partner base.</p>
</form>
