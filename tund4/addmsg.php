<?php
require("functions.php");
 $notice = null;
 
 if (isset($_POST["submitmessage"])){
	 if ($_POST["message"] !="Kirjuta sõnum siia..." and !empty($_POST["message"])){
		$message = test_input($_POST["message"]);
		$notice = saveamsg($message);
	 }else {
		$notice = "palun kirjuta sõnum";
	 }
 }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
   <title>õppetöö</title>
  </head>
  <body>
    <h1>sõnumi lisamine</h1>
	<p> <a href="http://www.tlu.ee">TLÜ</a> Õppetöö raames, pole mõtestatud ega väärtuslikku sisu.</p>
    <hr>
	
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label>Sõnum (max 256 märki):</label>
  <br>
  <textarea name="message" rows="4" cols="64">Kirjuta sõnum siia...</textarea>
  <br>
  <input type="submit" name="submitmessage" value="Salvesta sõnum">
 </form> 
 <hr>
 <p><?php echo $notice; ?></p>
 
  </body>
</html>