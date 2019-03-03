<?php $list=""; ?>

<html>
<head>
<script>
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>

<select onchange="showHint(this.value)">
<option value="US">
  USA
</option>
<option value="M">
  Myanmar
</option>
<option value="C">
 Other
</option>
</select>


State of Residence:
<div  name = "state" id="txtHint">
  <?php print $list; ?>
</div>


</body>
</html>
