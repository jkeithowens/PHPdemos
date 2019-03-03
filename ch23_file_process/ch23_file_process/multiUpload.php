
<?php

       /* Make sure your program has "write" permission to the tmp directory in the root directory (the default temporary upload directory defined in php.ini file) 
	 * as well as the final upload directory */
	$allowedExts = array("gif", "jpeg", "jpg", "png");

	for ($i =0; $i <=2; $i++){

	$temp = explode(".", $_FILES['ufile']['name'][$i]); //get the uploaded file name, use . to seperate the name and the extension into the temp array
	$extension = end($temp); //get the last element of the array, which will be the file extension
	if ((($_FILES['ufile']['type'][$i] == "image/gif")
		|| ($_FILES['ufile']['type'][$i]== "image/jpeg")
		|| ($_FILES['ufile']['type'][$i] == "image/jpg")
		|| ($_FILES['ufile']['type'][$i] == "image/pjpeg")
		|| ($_FILES['ufile']['type'][$i]== "image/x-png")
		|| ($_FILES['ufile']['type'][$i] == "image/png"))
		&& ($_FILES['ufile']['size'][$i] < 20000)
		&& in_array($extension, $allowedExts))
  	{
  		if ($_FILES['ufile']['error'][$i] > 0)
    		{
    			echo "Return Code: " . $_FILES['ufile']['error'][$i] . "<br>";
    		}
  		else
    		{
    			echo "Upload: " . $_FILES['ufile']['name'][$i] . "<br>";
    			echo "Type: " . $_FILES['ufile']['type'][$i] . "<br>";
    			echo "Size: " . ($_FILES['ufile']['size'][$i] / 1024) . " kB<br>";
    			echo "Temp file: " . $_FILES['ufile']['tmp_name'][$i] . "<br>";

			if (is_uploaded_file($_FILES['ufile']['tmp_name'][$i])) 
			{
   					echo "File ". $_FILES['ufile']['name'][$i] ." uploaded successfully.\n";
   
			} else {
   				echo "unable to upload file ";
  
			}




    			if (file_exists("pics/" . $_FILES['ufile']['name'][$i]))
      			{
      					echo $_FILES['ufile']['name'][$i]. " already exists. ";
      			}
    			else
      			{
      				move_uploaded_file($_FILES['ufile']['tmp_name'][$i],
      				"pics/" . $_FILES['ufile']['name'][$i]);
     			 	print 'File uploaded: <img src="pics/'. $_FILES['ufile']['name'][$i].'"/>';
      			}
    		}
  	}
	else
  	{
  		echo "<br/><br/>Invalid file ".$_FILES['ufile']['name'][$i]."<br/><br/>";
  	}

}


?>