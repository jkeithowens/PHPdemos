<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>imageIndex</title>
</head>
<body>

<?php 
// image index
// generates an index file containing all images in a particular directory

//point to whatever directory you wish to index.
//index will be written to this directory as imageIndex.html
$dirName = "./pics";
$dp = opendir($dirName);
chdir($dirName);  //change the working directory to this directory

//add all files in directory to $theFiles array
$currentFile = "";
while ($currentFile !== false){  //=== is an "identical" operator. The two values are equal and of the same type to mean they are identical.
  $currentFile = readDir($dp); //reads one file name from that directory
  $theFiles[] = $currentFile;  //add the file name into the array
} // end while

//extract gif and jpg images
$imageFiles = preg_grep("/jpg$|gif$/", $theFiles); //grab the values with that extention from the array and store to the image array

$output = <<<HERE
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>imageIndex</title>
</head>
<body>

<div>
HERE;


foreach ($imageFiles as $currentFile){
  $output = $output. <<<HERE
<a href = "$currentFile">
  <img src = "$currentFile"
       height = "50"
       width = "50"
       alt = "$currentFile" />
</a>

HERE;

} // end foreach

$output .= <<<HERE
</div>
</body>
</html>

HERE;


//save the index to the local file system
$fp = fopen("imageIndex.html", "w");
fputs ($fp, $output);
fclose($fp);


print <<<HERE
<p>
<a href = "$dirName/imageIndex.html">
  image index
</a>
</p>

HERE;
 ?>
 
</body>
</html>

