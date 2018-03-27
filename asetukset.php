<?php

	if (isset ( $_POST ["muuta"] )) {
	setcookie("nimi", $_POST['kayttajanimi'], time() + 60*60*24*7, "/");
	header ( "location: index.php" );
	exit ();

} 	elseif (isset($_COOKIE["nimi"])) {
    $kayttajanimi = $_COOKIE["nimi"];

} 	else {
    $kayttajanimi = "";
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

	<h2 class="otsikko">Pelikirjasto // Asetukset</h2>
		<hr class=listaushr>
<br>	
		<form action="" method="post">
		<label>Oma nimesi: <label><br><hr class="naytahr"><br>
		<input name="kayttajanimi" type="text" size="15" value="<?php echo $kayttajanimi ?>">
 <br><br>
   		<input name="muuta" type="submit"  value="Muuta nimeä">
		</form>
			</div>
		</div>
		
		<div class="footer">
	<p>&copy; Nico Tukiainen 2017 </p>
		</div>
	</div>
		
</body>
</html>