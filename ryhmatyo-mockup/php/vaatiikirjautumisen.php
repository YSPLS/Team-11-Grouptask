<!--Käyttäjähallintavideoilla lienee virhe. Tiedostossa 'vaatiikirjautumisen.php' on html-koodia
ennen php-kielen header-funktion käyttöä. Siis ohjelman ei saa tulostaa mitään ennen eikä 
jälkeen header-funktiota. Se on toiminut aikaisemmalla php-versiolla, mutta ei
nyt käytössä olevalla. Tiedoston oikea muoto on: -->

<!-- EI OLE VIELÄ KÄYTÖSSÄ-->
<?php
session_start();

if (!isset($_SESSION["user_ok"])){
	$_SESSION["paluuosoite"]="vaatiikirjautumisen.php";
	header("Location:kirjaudu.php");
	exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Vaatii kirjautumisen</title></head>
<body>
<?php 
print "Tiedosto vaatiikirjautumisen.php";
?>
<p>Kirjautuminen OK!</p>
</body>
</html>