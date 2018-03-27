<?php
try {
    require_once "peliPDO.php";

    $kantakasittely = new peliPDO ();

    if (isset ( $_GET ["nimi"] )) {

        $tulos = $kantakasittely->haePeliNimella( $_GET ["nimi"] );

        print (json_encode ( $tulos )) ;
    }

    else {
      $tulos = $kantakasittely->kaikkiPelit ();

     print json_encode ( $tulos );
    }
} catch ( Exception $error ) {
}

