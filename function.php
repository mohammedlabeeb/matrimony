<script type="text/javascript">
function getXMLHTTP()
{
	var xmlhttp=false;
	try{
		xmlhttp=new XMLHttpRequest();
		}
	catch(e){
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

function GetState(strURL) 
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
						document.getElementById('StateDiv').innerHTML=req4.responseText;						
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
 
function GetCity(strURL) 
{
		var req5 = getXMLHTTP();		
		if (req5) 
		{
			req5.onreadystatechange = function() 
			{
					if (req5.readyState == 4) 
					{
						if(req5.status == 200) 
						{						
						document.getElementById('CityDiv').innerHTML=req5.responseText;						
						} 
						else 
						{
						alert("There was a problem while using XMLHTTP:\n" + req5.statusText);
						}
					}				
			}			
			req5.open("GET", strURL, true);
			req5.send(null);
		}				
}
function GetCode(arg)
{
	var strURL="ajax_reg.php?country_id="+arg;//"findcounty.php?country="+countryId;
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
				document.getElementById('CodeDiv').innerHTML=req.responseText;
				document.getElementById('CodeLandDiv').innerHTML=req.responseText;
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
function GetCaste1(strURL) 
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
						document.getElementById('partCasteDiv').innerHTML=req4.responseText;						
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



function checkAll(field)
{ //alert(field.length);
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}

function uncheckAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
}
function clear_Looking_any(){document.getElementById("LookingAll").checked =false;}
function clear_Complexion_any(){document.getElementById("PComplexionAll").checked =false;}
function clear_edu_any(){document.getElementById("txtEduAll").checked = false;}
function clear_cast_any(){document.getElementById("PE_CasteAll").checked=false;}



function checkemail(arg)
{ 
	var strURL="ajax_editprofile.php?cnfmEmail="+arg;
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
				  if(req.responseText==1)
				  {
					  alert('Duplicate entry of mail id');
					  
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