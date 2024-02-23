<?php
include ("../html/header.html"); //Tuodaan header
?>

<?php
$muokattava=isset($_GET["muokattava"]) ? $_GET["muokattava"] : "";

//Jos tietoa ei ole annettu, palataan listaukseen
if (!isset($muokattava)){
    header ("Location:poisto.php");
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


$sql="select * from viesti where id=?";
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttuja sql-lauseeseen
mysqli_stmt_bind_param($stmt, 'i', $muokattava);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Koska luetaan prepared statementilla, tulos haetaan 
//metodilla mysqli_stmt_get_result($stmt);
$tulos=mysqli_stmt_get_result($stmt);
if (!$rivi=mysqli_fetch_object($tulos)){
?>

<!-- Lomake tavallisena html-koodina php tagien ulkopuolella -->
<!-- Lomake sisältää php-osuuksia, joilla tulostetaan syötekenttiin luetun tietueen tiedot -->
<!-- id-kenttä on readonly, koska sitä ei ole tarkoitus muuttaa -->

<form action="paivita.php" method="post">
    <input  type='hidden' name='id' value='<?php print $rivi->id;?>'><br>
    <label for="nimi">nimi</label>
    <input type="text" name="nimi" value='<?php print $rivi->nimi;?>'><br> <!-- Luodaan nimi osio -->
    <label for="viesti">viesti</label>
    <input type="text"  name="viesti" value='<?php print $rivi->viesti;?>'><br> <!-- Luodaan sukunimi osio -->
    <input type="submit" name="button" value="lähetä"/> <!-- Luodaan nappi -->
</form>
<?php
}
?>
<?php
include ("../html/footer.html"); //Tuodaan footer.html
?>