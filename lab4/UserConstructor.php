<!-- Author: J. Keith Owens
File Name: UserConstructor.php
Created Date: 10/9/18
Purpose: Creats an object that is intended to hold all of the users data that
they enter into the form.  This data is passed to a session variable.
Revision History:
JKO 10/9/2018 Original Build
 No revision -->

<?php
// UserInfo definition

//define the UserInfo class
class UserInfo{

  public $code;
  public $FirstName;
  public $password;
  public $email;
  public $gender;
  public $department;  //the name of the critter, default visibility is public, accessable from any class
  public $status;

  //constructor of the object instance. Providing some default values if not provided
  function __construct($code1="anonymous", $firstName1="anonymous", $lastName1 = "unknown",  $password1 = "unknown", $email1 = "unknown", $gender1 = "unknown", $department1 = "unknown", $status1="unknown"){
//assigns values to object
    $this->code = $code1;
    $this->FirstName = $firstName1;
    $this->LastName = $lastName1;
    $this->password = $password1;
    $this->email = $email1;
    $this->gender = $gender1;
    $this->department = $department1;
    $this->status = $status1;
  } // end constructor

//////////setters////////////
  public function setFirstName($newFirst){
    $this->FirstName = $newFirst;
  }

  public function setLastName($newLast){
    $this->LastName = $newLast;
  }

  public function setPassword($newPassword){
    $this->password = $newPassword;
  }

  public function setDepartment($newDepartment){
    $this->department = $newDepartment;
  }

  public function setStatus($newStatus){
    $this->status = $newStatus;
  }


//////////getters////////////
public function getCode(){
  return $this->code;
}
  public function getFirstName(){
    return $this->FirstName;
  }

  public function getLastName(){
    return $this->LastName;
  }

  public function getPassword(){
    return $this->password;
  }

  public function getDepartment(){
    return $this->department;
  }

  public function getStatus(){
    return $this->status;
  }

  public function getGender($newGender){
    return $this->gender;
  }

} // end UserInfo class

?>
