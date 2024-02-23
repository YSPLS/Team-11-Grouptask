
<?php
//Luetaan lomakkeelta tulleet tiedot funktiolla $_POST
//jos syötteet ovat olemassa
$nimi=isset($_POST["nimi"]) ? $_POST["nimi"] : "";
$viesti=isset($_POST["viesti"]) ? $_POST["viesti"] : "";

//Jos ei jompaa kumpaa tai kumpaakaan tietoa ole annettu
//ohjataan pyyntö takaisin lomakkeelle
if (empty($nimi) || empty($viesti)){
    header ("Location: poisto.php");
        exit;
}

$yhteys = mysqli_connect("db", "root", "password", "trtkp_11");

// Testaa yhteys
if (!$yhteys) {
    die("Yhteyden muodostaminen epäonnistui: " .mysqli_connect_error());
}

$tietokanta=mysqli_select_db($yhteys, "trtkp_11");
if (!$tietokanta) {
    die("Tietokannan valinta epäonnistui: " . mysqli_connect_error());
}
echo "Tietokanta OK"; // debug

//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja
$sql="update viesti set nimi=?, viesti=? where id=?";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'ssi', $nimi, $viesti, $id);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
mysqli_close($yhteys); //Suljetaan mysqli yhteys

header("Location:poisto.php");
exit;

?> 
