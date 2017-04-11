<%@ page import="java.util.*"%>
var xmlHttp=createXmlHttpRequestObj();

function createXmlHttpRequestObj(){
 var xmlHttp;
 if(window.ActiveXObject)
	{	try{xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}
		catch(e){xmlHttp=false;}
	}
 else
	{	try{xmlHttp=new XMLHttpRequest();}
		catch(e){xmlHttp=false;}
	}
 if(!xmlHttp)
		alert("Something went wrong ....!");
 else
		return xmlHttp;
}

function process()
{
 if(xmlHttp!=null)
	{if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
		 trans=generateTransID();
		 xmlHttp.open("GET","trans_status.php?transstatus="+trans,true);
		 xmlHttp.onreadystatechange=handleServerResponse;
		 xmlHttp.send(null);
	}else{
		setTimeout("p_timeout()",60000);
	}
	}
}

function handleServerResponse()
{if(xmlHttp.readyState==4){
		if(xmlHttp.status==200){
			xmlResponse= xmlHttp.responseXML;
			xmlDocument=xmlResponse.documentElement;
			message = xmlDocument.firstChild.data;
			document.getElementById("message").style="margin-top:50px;color:blue";
			document.getElementById("message").innerHTML=message;
			setTimeout("process()",1000);
		}
	}else{
			//alert("Sorry, something went wrong ...!");
	}
	
}
function generateTransID()
{return int(Math.pow(10,6) * Math.random()) ; }

function p_timeout()
{ alert("Sorry, We didn't receive any response ....");}