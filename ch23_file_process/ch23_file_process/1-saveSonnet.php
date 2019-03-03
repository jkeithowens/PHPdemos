<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SaveSonnet</title>
</head>
<body>
<?php 

$sonnet76 = <<<HERE
Writing new ---


Yay N342 is so fun!

N342 is so great because we learn PHP and MySQL!!!


HERE;

//open a file in write mode, if the file doesn't exist, create a new file. The function returns a file pointer (file handler)
//Other modes are "r"(read), "a"(append), "r+", "w+" (read and write, random access. Read or write to the specific part of the file.
$fp = fopen("sonnet76.txt", "w");   //change the file name here and observe the new files created

//user the file handler, write the string into the file. All the old content will be wiped out. Use "a" mode if appending to a file.
fputs($fp, $sonnet76);

print 'Click <a href="http://corsair.cs.iupui.edu:23111/demos/ch23_file_process/ch23_file_process/sonnet76.txt">here</a> to download the csv file';

//close the file handler
fclose($fp);

print "Sonnet written to sonnet76.txt";
?>
</body>
</html>

