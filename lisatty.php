<?php
require_once "lisays.php";
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<link type="text/css" rel="stylesheet" href="style.css">
<meta charset="UTF-8"> 
<title>Nico Tukiainen, a1602621</title>
</head>

<body>
	<div id="container">
		<div class="header">
		</div>
		
		<div class="nav">
<br>
	<a href="index.php">Etusivu</a> <br>
	<a href="lisaa.php">Lisää peli</a> <br>
	<a href="listaa.php">Listaa pelit</a> <br>
		<a href="haku.php">Hae peliä</a> <br>
	<a href="asetukset.php">Asetukset</a> <br>
		</div>
		
		<div class="content">
		<div id="content_yksi">

	<h2 class="otsikko">Pelikirjasto // Tiedot tallennettu</h2>
		<hr class=listaushr>
<br>
			<b><?php echo $_COOKIE['peli'];?> </b> on lisätty pelikirjastoon.<br><br>
			Siirrytään pelien listaussivulle 5 sekunnin kuluttua.
		</div>
		</div>
		
		<div class="footer">
	<p>&copy; Nico Tukiainen 2017 </p>
		</div>
	</div>
		
</body>
</html>
<?php
header ( "refresh:5; url=listaa.php?" );
exit;
?>