<?php
include ("../html/header.html"); //Tuodaan header.html
?>
<?php
include ("../html/lomake.html"); //Tuodaan lomake.html
?>

<?php
//Poistettava parametrin käsittelyä
if (isset($_GET["poistettava"])) {
    $poistettava=$_GET["poistettava"];
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
echo "Tietokantayhteys OK"; // debug

// Jos sivu ladataan niin että on annettu parametri 'poistettava', silloin
// poistetaan kyseisellä id:llä oleva viesti tietokannasta
if (isset($poistettava)) {
    $sql="delete from viesti where id=?";
    $stmt=mysqli_prepare($yhteys, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $poistettava);
    mysqli_stmt_execute($stmt);
}

// Muodostetaan lista tietokannassa olevista viesteistä (mahdollisen poiston jälkeen)
$tulos=mysqli_query($yhteys, "SELECT * FROM viesti");

// Tulostetaan muodostettu lista sivulle
print "<ol>";
while ($rivi=mysqli_fetch_object($tulos)) {
    print "<li>id=$rivi->id nimi=$rivi->nimi viesti=$rivi->viesti ".
    "<a href='poisto.php?poistettava=".$rivi->id."'>Poista</a> 
     <a href='muokkaus.php?muokattava=".$rivi->id."'>Muokkaa</a></li>";
}
print "</ol>";
mysqli_close($yhteys);
?>
<?php
include ("../html/footer_poisto.html"); //Tuodaan footer.html
?>