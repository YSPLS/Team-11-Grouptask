<?php
include ("../html/header.html"); //Tuodaan header
?>

<?php
$muokattava=isset($_GET["muokattava"]) ? $_GET["muokattava"] : "";

//Jos tietoa ei ole annettu, palataan listaukseen
if (empty($muokattava)){
    header ("Location:poisto.php");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "root", "password", "trtkp_11");
}
catch(Exception $e){
    exit;
}

$sql="select * from viesti where id=?";
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttuja sql-lauseeseen
mysqli_stmt_bind_param($stmt, 's', $muokattava);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Koska luetaan prepared statementilla, tulos haetaan 
//metodilla mysqli_stmt_get_result($stmt);
$tulos=mysqli_stmt_get_result($stmt);
if (!$rivi=mysqli_fetch_object($tulos)){
    header ("Location:poisto.php");
    exit;
}
?>

<!-- Lomake tavallisena html-koodina php tagien ulkopuolella -->
<!-- Lomake sisältää php-osuuksia, joilla tulostetaan syötekenttiin luetun tietueen tiedot -->
<!-- id-kenttä on readonly, koska sitä ei ole tarkoitus muuttaa -->

<form action="paivita.php" method="post">
    <label for="nimi">nimi</label>
    <input type="text" name="nimi" value=""/>  <br> <!-- Luodaan nimi osio -->
    <label for="viesti">viesti</label>
<input type="text"  name="viesti" value=""/> <br> <!-- Luodaan sukunimi osio -->
<input type="submit" name="button" value="lähetä"/> <!-- Luodaan nappi -->

</form>

<!-- loppuun uusi php-osuus -->
<?php
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
?>
<?php
include ("../html/footer.html"); //Tuodaan footer.html
?>