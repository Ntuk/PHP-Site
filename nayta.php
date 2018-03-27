<?php
require_once "lisays.php";

if (isset ( $_SESSION ["peli"] )) {
   $peli = $_SESSION ["peli"];

} else {

   $peli = new Lisays ();
}

if (isset ( $_POST ["takaisin"] )) {
   header ( "location: listaa.php" );
   exit ();
}

if (isset($_COOKIE["valittupeli"])) {
   $valittu = trim($_COOKIE["valittupeli"]);
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

	<h2 class="otsikko">Pelikirjasto // Tarkemmat tiedot pelistä</h2>
		<hr class=listaushr>
<?php
               try {
                   require_once "peliPDO.php";

                   $kantakasittely = new peliPDO ();

                   $rivit = $kantakasittely->haePeli($valittu);

                   foreach ( $rivit as $peli ) {
                       print ("Nimi: <b>" . $peli->getNimi ());
                       print ("<br></b>Julkaisija: " . $peli->getJulkaisija()) ;
                       print ("<br>Julkaisuvuosi: " . $peli->getJulkaisuVuosi()) ;
                       print ("<br>Kotisivut: " . $peli->getKotisivut()) ;
                       print ("<br>Alusta: " . $peli->getPlatformi()) ;
                       print ("<br>Lisätietoja: " . $peli->getLisatieto() . "</p>\n") ;
           			   print ("<hr class=\"naytahr\"><br>");
                   }
               } catch ( Exception $error ) {

                   header ( "location: virhe.php?sivu=Listaus&virhe=" . $error->getMessage () );
                   exit ();
               }
                        print ("<form action=\"nayta.php?\" method=\"post\">
                                <input type=\"submit\" class=\"listauspainike\" name=\"takaisin\" value=\"Takaisin\">
                                </form><br>");
                ?>
			</div>
		</div>
		
		<div class="footer">
	<p>&copy; Nico Tukiainen 2017 </p>
		</div>
	</div>
		
</body>
</html>