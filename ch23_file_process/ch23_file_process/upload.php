
<?php

       /* Make sure your program has "write" permission to the tmp directory in the root directory (the default temporary upload directory defined in php.ini file) 
	 * as well as the final upload directory */

	$allowedExts = array("gif", "jpeg", "jpg", "png");
	
	//The global $_FILES will contain all the uploaded file information. In the following examples, "file" is the user defined name of the file input object in the html page.   
	//$_FILES['file']['name']: name of the file on the client machine
	//$_FILES['file']['type']: mime type of the file
	//$_FILES['file']['size']: size of the file in bytes
	//$_FILES['file']['tmp_name']: The temporary filename of the file in which the uploaded file was stored on the server.
	//$_FILES['file']['error']: The error code associated with this file upload.
	
	$temp = explode(".", $_FILES["file"]["name"]); //get the uploaded file name, use . to seperate the name and the extension into the temp array
	$extension = end($temp); //get the last element of the array, which will be the file extension
	if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 20000)
		&& in_array($extension, $allowedExts))
  	{
  		if ($_FILES["file"]["error"] > 0)
    		{
    			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    		}
  		else
    		{
    			echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    			echo "Type: " . $_FILES["file"]["type"] . "<br>";
    			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

			if (is_uploaded_file($_FILES['file']['tmp_name'])) 
			{
   					echo "File ". $_FILES['file']['name'] ." uploaded successfully.\n";
   
			} else {
   				echo "unable to upload file ";
  
			}




    			if (file_exists("pics/" . $_FILES["file"]["name"]))
      			{
      					echo $_FILES["file"]["name"] . " already exists. ";
      			}
    			else
      			{
      				move_uploaded_file($_FILES["file"]["tmp_name"],
      				"pics/" . $_FILES["file"]["name"]);
     			 	print 'File uploaded: <img src="pics/'. $_FILES["file"]["name"].'"/>';
      			}
    		}
  	}
	else
  	{
  		echo "Invalid file";
  	}
?>