<?php
require_once "lisays.php";
setcookie("peli", "", -100);
session_start();

if (isset($_SESSION["peli"])) {
	$lisays = $_SESSION["peli"];
} else {
	$lisays = new lisays();
}

		if (isset ( $_POST ["vahvista"] )) {
		unset($_SESSION["peli"]);
		header ("location: lisatty.php" ); 
		setcookie ( "peli", $lisays->getNimi(), time() + 10, "/");
				
				try {
			require_once "peliPDO.php";
			
			$kantakasittely = new PeliPDO ();
			
			$id = $kantakasittely->lisaaPeli ( $lisays );
			
			$_SESSION ["peli"]->setId ( $id );
		} catch ( Exception $error ) {
			session_write_close ();
			header ( "location: virhe.php?sivu=" . urlencode ( "Lisäys" ) . "&virhe=" . $error->getMessage () );
			exit ();
		}
		
		session_write_close ();
		header ( "location: naytaPeli.php" );
		exit ();

}		elseif (isset ( $_POST ["korjaa"] )) {
		$peli = $_SESSION["peli"];
		header ( "location: lisaa.php" );
		exit ();

}		elseif (isset ( $_POST ["peruuta"] )) {
		unset($_SESSION["peli"]);
		header ( "location: index.php" );
		exit ();
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

	<h2 class="otsikko">Pelikirjasto // Vahvista lisäys</h2>
		<hr class=listaushr>
<br>

 <table style="width: 400px";>
  <tr>
    <th>Nimi: </th>
    <td> <?php print($lisays->getNimi()); ?> </td>
  </tr>
  <tr>
    <th>Julkaisija:</th>
    <td> <?php print($lisays->getJulkaisija()); ?> </td>
  </tr>
  <tr>
    <th>Julkaisuvuosi:</th>
    <td> <?php print($lisays->getJulkaisuVuosi()); ?> </td>
  </tr>
    <tr>
    <th>Kotisivut:</th>
    <td> <?php print($lisays->getKotisivut()); ?> </td>
  </tr>
    </tr>
    <tr>
    <th>Alusta:</th>
    <td><?php print($lisays->getPlatformi()); ?> </td>
  </tr>
      </tr>
    <tr>
    <th>Lisätietoa:</th>
    <td><?php print($lisays->getLisatieto()); ?> </td>
  </tr>
</table> <br><br><br><br><br><br><br>
<form action="naytaPeli.php" method="post">
		<input type="hidden" name="id" value="	<?php print($lisays->getId()); ?>	">
 <p> 	<input type="submit" name="vahvista" 	value="Vahvista">
 		<input type="submit" name="korjaa" 		value="Korjaa">  
		<input type="submit" name="peruuta" 	value="Peruuta">   </p>
</form>
		</div>
		</div>
		
		<div class="footer">
	<p>&copy; Nico Tukiainen 2017 </p>
		</div>
	</div>
		
</body>
</html>