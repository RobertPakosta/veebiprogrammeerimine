<?php
 $firstName = "Tundmatu";
 $lastname = "Kodanik";
 
 //Püüan POST andmed kinni
 var_dump($_POST);
 if (isset($_POST["firstName"])){
	 $firstName = $_POST["firstName"];
 }
 if (isset($_POST["lastname"])){
	 $lastname = $_POST["lastname"];
 }
 
 $monthNames = ['Jaanuar','Veebruar','Märts','Aprill','Mail','Juuni','Juuli','August','September','Oktoober','November','Detsember'];
 
 $currentMonth = date('n') - 1;
	$monthOptions = ''; 
	for($i = 0; $i < count($monthNames); $i++) {
		$selected = '';
		if (isset($birthmonth)) {
			if ($birthmonth == $i) {
			$selected = 'selected';
			}
		} elseif ($currentMonth == $i) {
			$selected = 'selected';
		}
		$monthOptions .= '<option value="' . $i . '" ' . $selected . ' >' . $monthNames[$i] . '</option>';
	}
 
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<title>
	 <?php
	  echo $firstName;
	  echo " ";
	  echo $lastname;
	 ?>
   , õppetöö</title>
  </head>
  <body>
    <h1>
	 <?php
	 echo $firstName;
	 echo " ";
	 echo $lastname;
	 ?>
	</h1>
	<p> <a href="http://www.tlu.ee">TLÜ</a> Õppetöö raames, pole mõtestatud ega väärtuslikku sisu.</p>
    <hr>
	
 <form method="POST">
  <label>Eesnimi: </label>
  <input type="text" name="firstName">
  <label>Perekonnanimi: </label>
  <input type="text" name="lastname">
  <label>Sünniaasta:</label>
  <input type="number" min="1914" max="2000" value="1999" name="birthyear">
  <input type="submit" name="submitUserData" value="Saada andmed">
 </form> 
 <hr>
 <?php
 if (isset($_POST["birthyear"])){
	 echo "<p>Olete elanud järgnevatel aastatel:</p> \n";
	 echo "<ul> \n";
	  for ($i = $_POST["birthyear"]; $i <= date("Y"); $i++){
		  echo "<li>" .$i ."</li> \n";
	  }
	 echo "</ul> \n";
 }
 ?>
  </body>
</html>