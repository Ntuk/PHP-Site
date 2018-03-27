<?php
require_once "peliPDO.php";

if (isset ( $_POST ["nayta"] )) {
   setcookie ( "valittupeli", $_POST['valittu'],time () + 60 * 60 * 24 * 7, "/");
   header ( "location: nayta.php" );
   exit ();

} elseif (isset($_COOKIE["valittupeli"])) {

   $valittu = $_COOKIE["valittupeli"];

} else {
   $valittu = "";
}

if (isset ( $_POST ["poista"] )) {
    setcookie("poistettavapeli", $_POST['poistettava'], time() + 60 * 60 * 24 * 7, "/");
    header("location: listaa.php");

}elseif (isset($_COOKIE["poistettavapeli"])) {
    $kantakasittely = new PeliPDO ();
    $poistettava = trim($_COOKIE["poistettavapeli"]);
    $kantakasittely->poistaPeli($poistettava);

} else {
    $poistettava = "";
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

	<h2 class="otsikko">Pelikirjasto // Listaa pelit</h2>
	<hr class=listaushr>
<?php 	
	try {
		require_once "peliPDO.php";

		$kantakasittely = new peliPDO ();

		$rivit = $kantakasittely->kaikkiPelit();

		foreach ( $rivit as $peli) {

			print ("	<form action='' method=\"post\">
						<table>
                        	<td class=\"listataulukko\"><b>". $peli->getNimi () . "<br></td> 
                        	<td><input type=\"submit\" id=\"listauspainike\" name=\"nayta\" value=\"Näytä\">
                        		<input type='hidden' name='poistettava' value='" . $peli->getId () . "'>
                        		<input type=\"submit\" id=\"listauspainike\" name=\"poista\" value=\"Poista\"></td>
                        		<input type='hidden' name='valittu' value='" . $peli->getId () . "'>
                        		<tr><td><hr class=\"listaushr\"></td>

                   </tr></table></form>");
	}
		} catch (Exception $error ) {
			header ( "location: virhe.php?sivu=&virhe=" . $error->getMessage());
			exit();
		}
?>
			</div>
		</div>
		
		<div class="footer">
	<p>&copy; Nico Tukiainen 2017 </p>
		</div>
	</div>
		
</body>
</html>