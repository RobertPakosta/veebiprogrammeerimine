<?php
 //echo "see on minu esimene php";
 $firstName = "Robert";
 $lastname = "Pakosta";
 $dateToday = date("d.m.Y");
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
	 echo "<p> Tänane kuupäev on: " .$dateToday .". </p> \n";
	 echo "<p>Lehe avamise hetkel oli kell " .date("H:i:s"). ", käes oli " .$partOfDay.". </p> \n";
	 ?>
	<p> minu sõber teeb ka <a href="../../~jaagala/"target="_blank">veebi</a>
	<img src="../../~rinde/veebiprogrammeerimine2018s/tlu_terra_600x400_2.jpg" alt="TLÜ Terra õppehoone">
  </body>
</html>