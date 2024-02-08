<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "asiakas", "password", "trtkp_11");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

//Luetaan lomakkeelta tulleet tiedot funktiolla $_POST
//jos syötteet ovat olemassa
$nimi=isset($_POST["nimi"]) ? $_POST["nimi"] : "";
$viesti=isset($_POST["viesti"]) ? $_POST["viesti"] : "";

//Jos ei jompaa kumpaa tai kumpaakaan tietoa ole annettu
//ohjataan pyyntö takaisin lomakkeelle
if (empty($nimi) || empty($viesti)){
    exit;
}

//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja
$sql="insert into viesti (nimi, viesti) values(?, ?)";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'ss', $nimi, $viesti);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
?>