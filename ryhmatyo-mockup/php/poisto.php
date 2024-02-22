<?php
include "header.html";
?>

<?php

if (isset($_GET("poistettava"))) {
    $poistettava=$_GET("poistettava");
}


$yhteys = mysqli_connect("db", "root", "password", "trtkp_11");

// Testaa yhteys
if (!$yhteys) {
    die("Yhteyden muodostaminen epäonnistui: " .mysqli_connect_error());
}

$tietokanta=mysqli_select_db($yhteys, "asiakaskanta");
if (!$tietokanta) {
    die("Tietokannan valinta epäonnistui: " . mysqli_connect_error());
}
echo "Tietokanta OK"; // debug

if (isset($poistettava)) {
    $sql="delete from viesti where id=?";
    $stmt=mysqli_prepare($yhteys, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $poistettava);
    mysqli_stmt_execute($stmt);
}


$tulos=mysqli_query($yhteys, "select * from viesti");

print "<ol>";
while ($rivi=mysqli_fetch_object($tulos)) {
    print "<li>id=$rivi->id nimi=$rivi->nimi viesti=$rivi->viesti a href='poisto.php?poistettava=".$rivi->id."'Poista</a></li>'";
}
print "</ol>";
mysqli_close($yhteys);


//mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
// try{
//     $yhteys=mysqli_connect("db", "pena", "kukkuu", "kalakanta");
// }
// catch(Exception $e){
//     header("Location:../html/yhteysvirhe.html");
//     exit;
// }

// $poistettava=isset($_GET["poistettava"]) ? $_GET["poistettava"] : "";

// //Jos tieto on annettu, poistetaan kala tietokannasta
// if (!empty($poistettava)){
//     $sql="delete from kala where id=?";
//     $stmt=mysqli_prepare($yhteys, $sql);
//     //Sijoitetaan muuttuja sql-lauseeseen
//     mysqli_stmt_bind_param($stmt, 'i', $poistettava);
//     //Suoritetaan sql-lause
//     mysqli_stmt_execute($stmt);
// }
// //Suljetaan tietokantayhteys
// mysqli_close($yhteys);
// //ja ohjataan pyyntö takaisin listaukseen
// header("Location:./listaakala.php");
// exit;
?>