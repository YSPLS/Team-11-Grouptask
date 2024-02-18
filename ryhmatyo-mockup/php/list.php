<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "root", "password", "trtkp_11"); //Määritetään "yhteys" muuttuja joka käyttää mysqli_connect käytäntöä ja hakee tietokannan DB, Kirjautuu käyttäjällä root salasanalla password  tetokantaan trtkp 11
}
catch(Exception $e){
    exit;
}
$tulos=mysqli_query($yhteys, "select * from viesti"); //Määritetään "tulos" muuttuja, joka käyttää mysqli_query käytäntöä ja etsii tietokannasta kaiken viestit osiosta. Yhteys muuttujaa Viitataan jotta tiedämme mistä tietokannasta ja millä käyttäjällä ja millä salasanalla pääsemme sisään.
while ($rivi=mysqli_fetch_object($tulos)){ //Tehdään loop jossa nimetään muuttuja "rivi" joka käyttää mysqli_fetch_object käytäntöä
    print "<p> Nimi: $rivi->nimi, Viesti: $rivi->viesti "; //Etsitään taulukosta osiot nimi ja viesti jotka sitten tulostetaan niin pitkään kunnes kaikki on löydetty taulukosta
}
mysqli_close($yhteys); //Suljetaan mysqli yhteys
?>

<br>