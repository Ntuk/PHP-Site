<!DOCTYPE HTML>
<html>
<head>
<link type="text/css" rel="stylesheet" href="style.css">
<meta charset="UTF-8"> 
<title>Nico Tukiainen, a1602621</title>
        <script src="http://code.jquery.com/jquery-2.2.3.min.js"
        integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous">
        </script>
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

	<h2 class="otsikko">Pelikirjasto // Hae peliä</h2>
		<hr class=listaushr>
<br>
    	<form action=""  method="post">
        	<label>Haettavan pelin nimi:</label><br><hr class="naytahr"><br>
            <input type="text" size="15" id="nimi" name="nimi">
 <br><br>
            <input type="button" class=\"listauspainike\" size="15" id="hae" name="hae" value="Hae">
        </form>
        <div id="vastaus"></div>
        </div>
        </div>
		
		<div class="footer">
	<p>&copy; Nico Tukiainen 2017 </p>
		</div>
	</div>

	<script type="text/javascript">
    $(document).on("ready", function() {
        $("#hae").on("click", function() {
            $.ajax({
                url: "pelitJSON.php",
                method: "get",
                data: {nimi: $("#nimi").val()},
                dataType: "json",
                timeout: 5000
            })
                .done(function (data) {
                   
                    $("#vastaus").html("");

                    for (var i = 0; i < data.length; i++) {

                        $("#vastaus").append("<p>Nimi: " + data[i].nimi +
                            "<br>Julkaisija: " + data[i].julkaisija +
                            "<br>Julkaisuvuosi: " + data[i].julkaisuvuosi +
                            "<br>Kotisivut: " + data[i].kotisivut +
                            "<br>Alusta: " + data[i].platformi +
                            "<br>Lisätietoja: " + data[i].lisatieto + "</p>");
                    }

                    if (data.length===0) {
                        $("#vastaus").append("<p>Haku ei tuottanut yhtään tulosta</p>")
                    }
                })
                .fail(function () {
                    $("#vastaus").html("<p>Listausta ei voida tehdä</p>");
                });
        });
    });
</script>
</body>
</html>