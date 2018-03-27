<?php
session_start();
if (isset($_COOKIE["nimi"])) {
    $kayttajanimi = $_COOKIE["nimi"] . ".";
}
else {
    $kayttajanimi = "";
}
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

	<h2 class="otsikko">Pelikirjasto // Etusivu</h2>
		<hr class=listaushr>
<br>
		Hei <b><?php echo $kayttajanimi;?></b>
<br><hr>
<br>	Tervetuloa pelikirjastooni. Tehtävänä oli toteuttaa pieni web-sovellus opiskelijan omasta aiheesta.<br>
		Valitsin aiheekseni pelikirjaston, jonne voit lisätä vaikka omistamiasi pelejä.
		</div>
		</div>
		
		<div class="footer">
	<p>&copy; Nico Tukiainen 2017 </p>
		</div>
	</div>
		
</body>
</html>