<?php
include ("../html/header.html"); //Tuodaan header
?>

<?php
include ("../html/lomake.html"); //Tuodaan lomake
?>

<?php
if (isset ($_POST["nimi"])){ //Jos nimi ruutuun on annettu tietoa se tallennetaan "nimi" muuttujaan
    $nimi=$_POST["nimi"];
}
else{
    exit;
}

if (isset ($_POST["viesti"])){  //Jos viesti ruutuun on annettu tietoa se tallennetaan "viesti" muuttujaan
    $viesti=$_POST["viesti"];
}
else{
   exit;
}
include ("../php/yhteys.php"); //Tuodaan yhteys.php

$tulos=mysqli_query($yhteys, "select * from viesti"); //Määritetään "tulos" muuttuja, joka käyttää mysqli_query käytäntöä ja etsii tietokannasta kaiken viestit osiosta. Yhteys muuttujaa Viitataan jotta tiedämme mistä tietokannasta ja millä käyttäjällä ja millä salasanalla pääsemme sisään.
while ($rivi=mysqli_fetch_object($tulos)){ //Tehdään loop jossa nimetään muuttuja "rivi" joka käyttää mysqli_fetch_object käytäntöä
    print "<p> Nimi: $rivi->nimi, Viesti: $rivi->viesti "; //Etsitään taulukosta osiot nimi ja viesti jotka sitten tulostetaan niin pitkään kunnes kaikki on löydetty taulukosta
}
mysqli_close($yhteys); //Suljetaan mysqli yhteys
?>


<?php
include ("../html/footer.html"); //Tuodaan footer.html
?>