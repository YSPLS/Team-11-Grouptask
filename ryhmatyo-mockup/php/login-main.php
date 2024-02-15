<?php
include("../html/portal.html")
?>


<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
$yhteys=mysqli_connect("db", "root", "password", "trtkp_11");
$tulos=mysqli_query($yhteys, "select * from viesti");
while ($rivi=mysqli_fetch_object($tulos)){
    print "<p> Nimi: $rivi->nimi, Viesti: $rivi->viesti ";
}
mysqli_close($yhteys);
?>

<br>

<?php
include("../html/portal-end.html")
?>