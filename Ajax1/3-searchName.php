<!DOCTYPE html>
<html>
<head>
<script>

//Ajax tutorial - http://www.w3schools.com/ajax/
function showHint(str)
{
var xmlhttp;
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML="";
  return;
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
    document.getElementById("browsers").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getName.php?q="+str,true);
xmlhttp.send();
}
</script>
</head>
<body>
<h3>Start typing a name in the input field below:</h3>
<form action="3-searchName.php"> 
Search by Last Name: 
<!--
<select name="drop" onchange="showHint(this.value)">
<option value = "">Enter last name here</option>
</select>
-->

<input type="text" list="browsers" name="drop" value="" onkeyup="showHint(this.value)" />
<datalist id="browsers" >
  
</datalist>
<input name="enter" class="btn" type="submit" value="Submit" />
<br/><br/>
User information will show here when the button is clicked.
</form>

</body>
</html>
