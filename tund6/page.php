<?php
 //lisan teise php faili
 require("functions.php");
 $firstName = "Tundmatu";
 $lastname = "Kodanik";
 $fullname = "";
 // <label> sünnikuu </label>
	//	echo '<select name="$sünnikuu">' ."\n";
	//	for ($i = 1 ; $i < 13; $i++){
	//			echo '<option value="' .$i . '"';
 //Püüan POST andmed kinni
 var_dump($_POST);
 if (isset($_POST["firstName"])){
	 $firstName = test_input($_POST["firstName"]);
 }
 if (isset($_POST["lastname"])){
	 $lastname = test_input($_POST["lastname"]);
 }
 
  //väga mõttetu funktsioon
  function stupidfunction(){
	$GLOBALS["fullname"] = $GLOBALS["firstName"] ." " .$GLOBALS["lastname"];  
  }
  
  stupidfunction();
  
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
	
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
	echo "<h2>" .$fullname ."</h2>";
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