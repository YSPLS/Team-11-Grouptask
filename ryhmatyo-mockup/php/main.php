<?php
include ("../html/header.html"); //Tuodaan header
?>

<?php
include ("../html/lomake.html"); //Tuodaan lomake
?>

<?php
if (isset ($_POST["nimi"])){
    $nimi=$_POST["nimi"];
}
else{
    exit;
}

if (isset ($_POST["viesti"])){
    $viesti=$_POST["viesti"];
}
else{
    $viesti=""; 
}

?>

<?php
include ("../php/list.php");
?>

<?php
include ("../php/yhteys.php");

?>

<?php
include ("../html/footer.html"); //Tuodaan footer
?>