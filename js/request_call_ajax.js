var xmlHttp
function showRequestCallForm(){var url="";var domain_name=document.domain;if(document.domain=='192.168.1.172'){url="http://192.168.1.172/request_call_form_ajax.php?value=get_form";}
else{url="http://www.matrimonialsindia.com/request_call_form_ajax.php?value=get_form";}
xmlHttp=GetXmlHttpObject();if(xmlHttp==null){alert("Browser does not support HTTP Request");return;}
url=url+"&sid="+Math.random();xmlHttp.onreadystatechange=stateChangedShowRequestCallForm;xmlHttp.open("GET",url,true);xmlHttp.send(null)}
function stateChangedShowRequestCallForm(){if(xmlHttp.readyState==4||xmlHttp.readyState=="complete"){document.getElementById("requestCall").innerHTML=xmlHttp.responseText;}}
function GetXmlHttpObject(){var objXMLHttp=null;if(window.XMLHttpRequest){objXMLHttp=new XMLHttpRequest();}
else if(window.ActiveXObject){objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP");}
return(objXMLHttp);}