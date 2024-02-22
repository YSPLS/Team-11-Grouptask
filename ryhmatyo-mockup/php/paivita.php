
<?php
//Luetaan lomakkeelta tulleet tiedot funktiolla $_POST
//jos syötteet ovat olemassa
$nimi=isset($_POST["nimi"]) ? $_POST["nimi"] : "";
$viesti=isset($_POST["viesti"]) ? $_POST["viesti"] : "";

//Jos ei jompaa kumpaa tai kumpaakaan tietoa ole annettu
//ohjataan pyyntö takaisin lomakkeelle
if (empty($nimi) || empty($viesti)){
    header ("Location: poisto.php"){
        exit;
    }
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "root", "password", "trtkp_11"); //Määritetään "yhteys" muuttuja joka käyttää mysqli_connect käytäntöä ja hakee tietokannan DB, Kirjautuu käyttäjällä root salasanalla password  tetokantaan trtkp 11
}
catch(Exception $e){
    exit;
}
$tulos=mysqli_query($yhteys, "select * from viesti");
while ($rivi=mysqli_fetch_object($tulos)){ //Tehdään loop jossa nimetään muuttuja "rivi" joka käyttää mysqli_fetch_object käytäntöä
    print "<p> Nimi: $rivi->nimi, Viesti: $rivi->viesti "; //Etsitään taulukosta osiot nimi ja viesti jotka sitten tulostetaan niin pitkään kunnes kaikki on löydetty taulukosta
}
//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja
$sql="update viesti set nimi=?, viesti=? where id=?";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'ss', $nimi, $viesti);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);

mysqli_close($yhteys); //Suljetaan mysqli yhteys

header ("Location:lomake.html"){
    exit;
}
?>