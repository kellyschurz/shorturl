function subfor()
{
	document.getElementById("urlresult").style.visibility = "visible";

	var xmlhttp;
	var newURL = document.getElementById("newURL").value;
	var choose = document.getElementsByName("choose");
	var choo;
  for(var i = 0; i < choose.length; i++)
  {
     if(choose[i].checked)
     choo=i;
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
				document.getElementById("urlresult").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("POST","do.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("newURL=" + newURL + "&choose=" + choo);
	}
	function show(){
		document.getElementById("bianqian").style.visibility = "visible";
	}
