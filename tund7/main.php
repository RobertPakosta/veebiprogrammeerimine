<?php
  require("functions.php");
  
  //kui pole sisse loginud
  if(!isset($_SESSION["userId"])){
	  header("Location: idex2.php");
	  exit();
  }
  
  //välja logimine
  if(isset($_GET["logout"])){
	 session_destroy(); 
	 header("Location: index2.php");
	 exit();
  }
  
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<title>Pealeht</title>
  </head>
  <body>
    <h1>Pealeht</h1>
	<p>See leht on valminud <a href="http://www.tlu.ee" target="_blank">TLÜ</a> õppetöö raames ja ei oma mingisugust, mõtestatud või muul moel väärtuslikku sisu.</p>
	<hr>
	<p>olete sisse loginud nimega: 
	<?php
	echo $_SESSION["firstName"] ." " .$_SESSION["lastName"];
	?>.
	</p>
	<ul>
	  <li><a href="?logout=1">Logi välja</a></li>
	  <li><a href="validatemsg.php">valideeri anonüümseid sõnumeid</a></li>
	  <li>Vaata valideeritud <a href="validatedmessages.php">sõnumeid</a> valideerijate kaupa.</li>
	</ul>
	
  </body>
</html>