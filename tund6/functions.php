<?php
	require("../../../config.php");
	$database ="if18_robert_pa_1";
	//echo $ServerHost;
	
	//kasutan sessiooni
	session_start();
	
	//SQL käsk andmete uuendamiseks
	//UPDATE vpamsg SET acceptedby=?, accepted=?, accepttime=now(), WHERE id=?
	
	 //valitud sõnumi lugemine valideerimiseks
  function readmsgforvalidation($editId){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT message FROM vpamsg WHERE id = ?");
	$stmt->bind_param("i", $editId);
	$stmt->bind_result($msg);
	$stmt->execute();
	if($stmt->fetch()){
		$notice = $msg;
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
  }
	//valitud sõnumi lugemise valideerimiseks
	
	//valideerimata sõnumite nimekiri
	function readallunvalidatedmessages($editId){
	 $notice = "<ul> \n";
	 $mysqli = new mysqli($GLOBALS["ServerHost"], $GLOBALS["ServerUsername"], $GLOBALS["ServerPassword"], $GLOBALS["database"] );
	 $stmt = $mysqli->prepare("SELECT id, message FROM vpamsg WHERE accepted IS NULL");
	 echo $mysqli->error;
	 $stmt->bind_result($msgid, $msg);
	 if($stmt->execute()){
	   while($stmt->fetch()){
		$notice .= "<li>" .$msg .'<br><a href="validatemessage.php?id=' .$msgid .'">Valideeri</a></li>' ."\n";
       }
	 } else {
		$notice .= "<li>Sõnumite lugemisel tekkis viga" .$stmt->error . "</li>\n"; 
	 }
	 $notice .= "</ul> \n";
	 $stmt->close();
	 $mysqli->close();
	 return $notice;
	}
	
	//sisselogimine
	function signin($email, $password){
	$notice = "";
	 $mysqli = new mysqli($GLOBALS["ServerHost"], $GLOBALS["ServerUsername"], $GLOBALS["ServerPassword"], $GLOBALS["database"] );
	 $stmt = $mysqli->prepare("SELECT id, firstname, lastname, password FROM vpusers WHERE email=?");
	 echo $mysqli->error;
	 $stmt->bind_param("s", $email);
	 $stmt->bind_result($idFromDb, $firstnameFromDb, $lastnameFromDb, $passwordFromDb);
	 if($stmt->execute()){
		#andmebaasi päring õnnestus
		if($stmt->fetch()){
		//kasutaja on olemas
		  if(password_verify($password, $passwordFromDb)){
			//salasõna õige
			$notice = "Olete edukalt sisse loginud";
			//määrame sessiooni muutujad
			$_SESSION["userId"] = $idFromDb;
			$_SESSION["firstName"] = $firstnameFromDb;
			$_SESSION["lasttName"] = $lastnameFromDb;
			
			$stmt->close();
	        $mysqli->close();
			header ("Location: main.php");
			exit();
			
		  } else {
			$notice = "kahjuks vale salasõna";
		 }
		  
	 } else {
		$notice = "kahjuks sellise kasjutajatunnusega ( ".$email .") kasutajat ei leitud";
		}
	 } else {
		$notice = "Sisselogimisel tekkis tehniline viga!" .$stmt->error; 
	 }
	
	
	
	 $stmt->close();
	 $mysqli->close();
	 return $notice;
	}

	 

	
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
		$notice = "";
		//loome andmebaasi ühenduse
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//valmistan ette andmebaasikäsu
		$stmt = $mysqli->prepare("INSERT INTO vpamsg (message) VALUES(?)");
		echo $mysqli->error;
		//asendan ettevalmistatud käsus küsimärgid päris andmetega
		//esimesena kirja andmetüübid, siis andmed ise
		//s - string; i - integer; d - decimal
		$stmt->bind_param("s", $msg);
		//täidame ettevalmistatud käsu
		if ($stmt->execute()){
			$notice ='sõnum: "' .$msg .'"on edukalt salvestatud';
		} else {
			$notice = "Sõnumi salvestamisel tekkis tõrge: " .$stmt->error;
		}
		//sulgeme ettevalmistatud käsu
		$stmt->close();
		//sulgeme ühenduse
		$mysqli->close();
	    return $notice;
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