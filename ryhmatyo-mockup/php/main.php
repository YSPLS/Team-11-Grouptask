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

?>

<?php
include ("../php/list.php"); //Tuodaan list.php
?>

<?php
include ("../php/yhteys.php"); //Tuodaan yhteys.php

?>

<?php
include ("../html/footer.html"); //Tuodaan footer.html
?>