
<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "root", "password", "trtkp_11");
}
catch(Exception $e){
    exit;
}
$tulos=mysqli_query($yhteys, "select * from kala");
while ($rivi=mysqli_fetch_object($tulos)){
    print "<p>$rivi->laji $rivi->paino ".
        "<a href='./poisto.php?poistettava=$rivi->id'>Poista</a>".
        "<a href='./muokkaus.php?muokattava=$rivi->id'>Muokkaa</a></p>";
}
mysqli_close($yhteys);
?>