<?php
 $firstName = "Robert";
 $lastname = "Pakosta";

 //loeme kataloogi sisu
 $dirToRead = "../../pics/";
 $allfiles = scandir($dirToRead);
 $picFiles = array_slice($allfiles, 2);
 //var_dump($picFiles);
 
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
  
  <?php
  //<img scr="pilt.jpg" alt="Pilt">
  
  for($i = 0; $i < count($picFiles);$i ++){
  echo '<img src="' .$dirToRead .$picFiles[$i] .'" alt="pilt">';
  }
  ?>
  
  </body>
</html>