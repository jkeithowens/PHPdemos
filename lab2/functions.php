<!--
File Name: functions.php
Author: J. Keith Owens
Created Date: 9/14/2018
Purpose: A php file that contains all the functions for lab2 of n242 (RegistrationForm.php main file)
Revision History: No revision -->

<?php


/* This function generates a random code with letters and digits.
* The paramter tells the how long the code should be.
*/
function randomCodeGenerator($length){
         $code = "";
         for($i = 0; $i<$length; $i++){
             //generate a random number between 1 and 35
             $digit = mt_rand(1,35);
             //if the number is greater than 26, minus 26 will generate a digit between 0 and 9
             if ($digit > 26) {
                $digit = $digit - 26;
                $code = $code.$digit ;
            }
             else {    //it's between 1 and 26, generate a character
                 $code = $code . assignLetter($digit);
             }
         }
         return $code;
}



// This function sanitizes the email them uses the filter_input function to verity
// That it is a valid format
function emailchecker($input)
  {
  //removes all illegal characters
  $field=filter_var($input, FILTER_SANITIZE_EMAIL);
  //validates the format of the email
  if(filter_input(INPUT_POST, $input,FILTER_VALIDATE_EMAIL))
    {
    return TRUE; //if email format is valid function returns true
    }
  else
    {
    return FALSE;//if email format is not a valid function returns false
    }
  }

function checkBlank($input) {
  if(isset($_POST[$input]))	{
		$input = $_POST[$input];
		if ($input=="")
		{
		}
		else return TRUE;
}
}




/*This function will validate password is Longer than 9 characters and
contains numbers and letters
*/
function passwordValidate($input){
	$input = trim($input);
	if (strlen($input) < 10){
		return false;
	}
	else {
		//go through each character and find if there is a number or letter
		$letter = false;
		$number = false;
		$array = str_split($input);
		for($i = 0; $i<strlen($input); $i++){
			if (preg_match("/[A-Za-z]/",$array[$i])){
        for($i = 0; $i<strlen($input); $i++){
          if (preg_match("/[0-9]/",$array[$i])){
            return TRUE;
          }
			}
		}
		}
	}
}

/*This function will validate if the code that was sent via email is the correct format.
*/
function codeValidate($input){
	$field = trim($input);
	if (strlen($input) < 50){
		return false;
	}
	else {
		//go through each character and find if there is a number or letter
    $array = str_split($input);
		for($i = 0; $i<strlen($input); $i++){
			if (preg_match("/[A-Za-z]/",$array[$i])){
        for($i = 0; $i<strlen($input); $i++){
          if (preg_match("/[0-9]/",$array[$i])){
            return TRUE;
          }
			}
		}
		}
	}
}


/*This function assigns a letter based on the value of the argument
Argument should be 1-26 and function will assign a-z based on argument
*/
function assignLetter($digit){
         $char = "";
         switch ($digit){
                case 1: $char = "A"; break;
                case 2: $char = "B"; break;
                case 3: $char = "C"; break;
                case 4: $char = "D"; break;
                case 5: $char = "E"; break;
                case 6: $char = "F"; break;
                case 7: $char = "G"; break;
                case 8: $char = "H"; break;
                case 9: $char = "I"; break;
                case 10: $char = "J"; break;
                case 11: $char = "K"; break;
                case 12: $char = "L"; break;
                case 13: $char = "M"; break;
                case 14: $char = "N"; break;
                case 15: $char = "O"; break;
                case 16: $char = "P"; break;
                case 17: $char = "Q"; break;
                case 18: $char = "R"; break;
                case 19: $char = "S"; break;
                case 20: $char = "T"; break;
                case 21: $char = "U"; break;
                case 22: $char = "V"; break;
                case 23: $char = "W"; break;
                case 24: $char = "X"; break;
                case 25: $char = "Y"; break;
                case 26: $char = "Z"; break;
                default: "A";
         }
         return $char;
}

?>
