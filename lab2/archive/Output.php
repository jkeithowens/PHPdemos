<!-- Author: J. Keith Owens
Created Date: 9/4/2018
Purpose: A sample registration page using PHP Post method (lab1 of n242)
Revision History: No revision -->


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Sample Registration Form</title>

    <!-- Bootstrap & Jquery scripts-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Stylesheet link -->
    <link href="style.css" rel="stylesheet">

  </head>

  <body class ="bodybackground">
<?php $msg = $_GET['msg'];?>

          <div class="container containerinput" style="margin-top:75px">
            <!-- Feedback Form Starts Here -->
            <div id="feedback">
            <!-- Heading Of The Form -->
            <div class="head">

              <?php print "<h2>".$msg."</h2>"; ?>


            </div>
            <!-- Feedback Form Ends Here -->

            </div>

        </div>



  </body>
</html>
