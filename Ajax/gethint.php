<?php
// Array with names

// get the q parameter from URL
$q = $_REQUEST["q"];
$list = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    if ($q == "US") {
      $list = stateOptionList();
    } elseif ($q=="M") {
      $list = ProvOptionList();
    } else {
      $list = noState();
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $list;
?>


<?php


function stateOptionList()
{

$stateList = '
  <select>
  <option name="vState" value="" selected disabled hidden>Select State</option>
  <option name="vState" value="AL">Alabama</option>
  <option name="vState" value="AK">Alaska</option>
  <option name="vState" value="AZ">Arizona</option>
  <option name="vState" value="AR">Arkansas</option>
  <option name="vState" value="CA">California</option>
  <option name="vState" value="CO">Colorado</option>
  <option name="vState" value="CT">Connecticut</option>
  <option name="vState" value="DE">Delaware</option>
  <option name="vState" value="DC">District Of Columbia</option>
  <option name="vState" value="FL">Florida</option>
  <option name="vState" value="GA">Georgia</option>
  <option name="vState" value="HI">Hawaii</option>
  <option name="vState" value="ID">Idaho</option>
  <option name="vState" value="IL">Illinois</option>
  <option name="vState" value="IN">Indiana</option>
  <option name="vState" value="IA">Iowa</option>
  <option name="vState" value="KS">Kansas</option>
  <option name="vState" value="KY">Kentucky</option>
  <option name="vState" value="LA">Louisiana</option>
  <option name="vState" value="ME">Maine</option>
  <option name="vState" value="MD">Maryland</option>
  <option name="vState" value="MA">Massachusetts</option>
  <option name="vState" value="MI">Michigan</option>
  <option name="vState" value="MN">Minnesota</option>
  <option name="vState" value="MS">Mississippi</option>
  <option name="vState" value="MO">Missouri</option>
  <option name="vState" value="MT">Montana</option>
  <option name="vState" value="NE">Nebraska</option>
  <option name="vState" value="NV">Nevada</option>
  <option name="vState" value="NH">New Hampshire</option>
  <option name="vState" value="NJ">New Jersey</option>
  <option name="vState" value="NM">New Mexico</option>
  <option name="vState" value="NY">New York</option>
  <option name="vState" value="NC">North Carolina</option>
  <option name="vState" value="ND">North Dakota</option>
  <option name="vState" value="OH">Ohio</option>
  <option name="vState" value="OK">Oklahoma</option>
  <option name="vState" value="OR">Oregon</option>
  <option name="vState" value="PA">Pennsylvania</option>
  <option name="vState" value="RI">Rhode Island</option>
  <option name="vState" value="SC">South Carolina</option>
  <option name="vState" value="SD">South Dakota</option>
  <option name="vState" value="TN">Tennessee</option>
  <option name="vState" value="TX">Texas</option>
  <option name="vState" value="UT">Utah</option>
  <option name="vState" value="VT">Vermont</option>
  <option name="vState" value="VA">Virginia</option>
  <option name="vState" value="WA">Washington</option>
  <option name="vState" value="WV">West Virginia</option>
  <option name="vState" value="WI">Wisconsin</option>
  <option name="vState" value="WY">Wyoming</option>
  </select>';
  return $stateList;
}




function ProvOptionList()
{

$provList = '
  <select>
  <option name="vState" value="" selected disabled hidden>Select Providence</option>
  <option name="vState" value="Thaninthayi">Thaninthayi</option>
  <option name="vState" value="Mon">Mon</option>
  <option name="vState" value="Yangon">Yangon</option>
  <option name="vState" value="Ayeyarwaddy">Ayeyarwaddy</option>
  <option name="vState" value="Kayin">Kayin</option>
  <option name="vState" value="Bago">Bago</option>
  <option name="vState" value="Rakhine">Rakhine</option>
  <option name="vState" value="Magwe">Magwe</option>
  <option name="vState" value="Mandalay">Mandalay</option>
  <option name="vState" value="Kayah">Kayah</option>
  <option name="vState" value="Shan">Shan</option>
  <option name="vState" value="Sagaing">Sagaing</option>
  <option name="vState" value="Chin">Chin</option>
  <option name="vState" value="Kachin">Kachin</option>
  </select>';

  return $provList;
  }

  function noState()
  {
    $noState='<input name="vState" placeholder="State/Province" type="text" value="">';
    return $noState;
  }

 ?>
