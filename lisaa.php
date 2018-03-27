<?php
require_once "lisays.php";
session_start();


	if (isset ( $_POST ["talleta"] )) {

	$lisays = new lisays($_POST["nimi"], $_POST["julkaisija"], $_POST["julkaisuvuosi"], $_POST["kotisivut"], $_POST["platformi"], $_POST["lisatieto"]);	

	$_SESSION["peli"] = $lisays;

	$nimiVirhe = $lisays->checkNimi();
	$julkaisijaVirhe = $lisays->checkJulkaisija();
	$vuosiVirhe = $lisays->checkJulkaisuVuosi();
	$sivuVirhe = $lisays->checkKotisivut();
	$platformVirhe = $lisays->checkPlatformi();
	
	
	if ($nimiVirhe == 0 && $julkaisijaVirhe == 0 && $vuosiVirhe == 0 && $sivuVirhe == 0 && $platformVirhe == 0) {

	session_write_close();
	header ("location: naytaPeli.php");
	exit;

	}
}

elseif (isset ( $_POST ["tyhjenna"] )) {
		unset($_SESSION["peli"]);
		header ( "location: lisaa.php" );
		exit ();
		
} 

else {

	if (isset($_SESSION["peli"])) {
		$lisays = $_SESSION["peli"];

	$nimiVirhe = $lisays->checkNimi();
	$julkaisijaVirhe = $lisays->checkJulkaisija();
	$vuosiVirhe = $lisays->checkJulkaisuVuosi();
	$sivuVirhe = $lisays->checkKotisivut();
	$platformVirhe = $lisays->checkPlatformi();

	} else {

		$lisays = new Lisays();
	
	
	$nimiVirhe = 0;
	$julkaisijaVirhe = 0;
	$vuosiVirhe = 0;
	$sivuVirhe = 0;
	$platformVirhe = 0;
	}
}
?>

<!DOCTYPE HTML>
<html>
<head>
<link type="text/css" rel="stylesheet" href="style.css">
<meta charset="UTF-8"> 
<title>Nico Tukiainen, a1602621</title>
<style type="text/css">
.error {
	color: #68111A;
}
</style>
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

	<h2 class="otsikko">Pelikirjasto // Lisää peli</h2>
		<hr class=listaushr>
	<form action="lisaa.php" method="post">
	<input type="hidden" name="id" value="<?php print ($lisays->getId()); ?>">
<br>	
	<label>Pelin nimi:</label>
<br>
	<input type="text" name="nimi" value="<?php print(htmlentities($lisays->getNimi(), ENT_QUOTES, "UTF-8"));?> " >
		<span class="error"><?php print($lisays->getError($nimiVirhe));?></span>
<br>
<br>
	<label>Julkaisija:</label>
<br>
	<input type="text" name="julkaisija" value="<?php print(htmlentities($lisays->getJulkaisija(), ENT_QUOTES, "UTF-8"));?>">
		<span class="error"><?php print($lisays->getError($julkaisijaVirhe));?></span>
<br>
<br>  
	<label>Julkaisuvuosi:</label>
<br>
	<input type="text" name="julkaisuvuosi" value="<?php print(htmlentities($lisays->getJulkaisuVuosi(), ENT_QUOTES, "UTF-8"));?>">
		<span class="error"><?php print($lisays->getError($vuosiVirhe));?></span>
<br>
<br>	
	<label>Pelin kotisivut:</label>
<br>
	<input type="text" name="kotisivut" value="<?php print(htmlentities($lisays->getKotisivut(), ENT_QUOTES, "UTF-8"));?>">
		<span class="error"><?php print($lisays->getError($sivuVirhe));?></span>
<br>
<br>
	<label>Alusta: PC, Konsoli tai Mobiili</label>
<br>						                
	<input type="text" name="platformi" value="<?php print(htmlentities($lisays->getPlatformi(), ENT_QUOTES, "UTF-8"));?>">
		<span class="error"><?php print($lisays->getError($platformVirhe));?></span>
<br>
<br>
	<label>Lisätietoja pelistä:</label>
<br>
	<textarea name="lisatieto" rows="5" cols="40"><?php print(htmlentities($lisays->getLisatieto(), ENT_QUOTES, "UTF-8"));?></textarea>
<br>
<br>	
<br>
<br>
	<input type="submit" name="talleta" value="Tallenna">  
	<input type="submit" name="tyhjenna" value="Tyhjennä">  
</form>
			</div>
		</div>
		
		<div class="footer">
	<p>&copy; Nico Tukiainen 2017 </p>
		</div>
	</div>
		
</body>
</html>