<?php
	require("../../../config.php");
	$database ="if18_robert_pa_1";
	//echo $ServerHost;
	//6-26 = 5. tunnitöö mysqli kajastamine
	function singup($firstName, $lastName, $birthDate, $gender, $email, $password){
	 $notice = "";
	 $mysqli = new mysqli($GLOBALS["ServerHost"], $GLOBALS["ServerUsername"], $GLOBALS["ServerPassword"], $GLOBALS["database"] );
	 $stmt = $mysqli->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?,?,?,?,?,?)");
	 echo $mysqli->error;
	 //krüpterime parooli
	 $options = ["cost"=>12, "salt"=>substr(sha1(mt_rand()), 0, 22)];
	 $pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
	 $stmt->bind_param("sssiss", $firstName, $lastName, $birthDate, $gender, $email, $pwdhash);
	 if($stmt->execute()){
		$notice = "Kasutaja loomine õnnestus!";
	 } else {
		$notice = "Kasutaja loomisel tekkis viga: " .$stmt->error;
	 }
	    $stmt->close();
		$mysqli->close();
		return $notice;
	}
	
	function saveamsg($msg){
		
		//loome andmebaasi ühenduse
		
		//valmistan ette andmebaasikäsu
		$stmt = $mysqli->prepare("INSERT INTO vpamsg (message) VALUES(?)");
		echo $mysqli->error;
		//asendan ettevalmistatud käsus küsimärgid päris andmetega
		//esimesena kirja andmetüübid, siis andmed ise
		//s - string; i - integer; d - decimal
		
		//täidame ettevalmistatud käsu
		if ($stmt->execute()){
			$notice ='sõnum: "' .$msg .'"on edukalt salvestatud';
		} else {
			$notice = "Sõnumi salvestamisel tekkis tõrge: " .$stmt->error;
		}
		//sulgeme ettevalmistatud käsu
		
	}
	
	function readallmessages(){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["ServerHost"], $GLOBALS["ServerUsername"], $GLOBALS["ServerPassword"], $GLOBALS["database"] );
		$stmt = $mysqli->prepare("SELECT message FROM vpamsg");
		echo $mysqli->error;
		$stmt->bind_result($msg);
		$stmt->execute();
		while($stmt->fetch()){
			$notice .= "<p>" .$msg ."</p> \n";
		}
		$stmt->close();
		$mysqli->close();
		return $notice;
	}
	
	//teksti sisendi kontrollimine
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>