<?php
 //echo "see on minu esimene php";
 $firstName = "Robert";
 $lastname = "Pakosta";
 $dateToday = date("d.m.Y");
 $weekdayToday = date("N");
 $weekdayNamesET = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
 //var_dump ($weekdayNamesET);
 //echo $weekdayNamesET[1];
 //echo $weekdayNamesET;
 //echo $weekdayToday;
 $hourNow = date("G");
 $partOfDay = "";
 if($hourNow < 8) {
	 $partOfDay = "varajane hommik";
 }
 if($hourNow >= 8 and $hourNow < 16) {
	 $partOfDay = "koolipäev";
 }
 if($hourNow > 16) {
	 $partOfDay = "loodetavasti vaba aeg";
 }
 
 //juhuskilu pildi valimine
 $picURL = "http://www.cs.tlu.ee/~rinde/media/fotod/TLU_600x400/tlu_";
 $picEXT = ".jpg";
 $picNUM = mt_rand(2,43);
 //echo $picNUM;
 $picFILE = $picURL .$picNUM .$picEXT;
 
 
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
	
	<p>Teised lehed: <a href="photo.php">photo.php</a>, <a href="page.php">page.php</a>.</p>
	
	 <?php
	 //echo "<p> Tänane kuupäev on: " .$dateToday .". </p> \n";
	 echo "<p> Täna on " .$weekdayNamesET[$weekdayToday - 1] .", " .$dateToday .". </p> \n";
	 echo "<p>Lehe avamise hetkel oli kell " .date("H:i:s"). ", käes oli " .$partOfDay.". </p> \n";
	 ?>
	<p> minu sõber teeb ka <a href="../../../~jaagala/"target="_blank">veebi</a>
	<img src="<?php echo $picFILE; ?>" alt="TLÜ Terra õppehoone">
  </body>
</html>