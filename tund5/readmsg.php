<?php
require("functions.php");
 $notice = readallmessages();
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

 <p><?php echo $notice; ?></p>
 
  </body>
</html>