<?php
// Projet Réservations M2L - version web mobile
// fichier : modele/Echec.test.php
// Test de la classe Echec.class.php
// Création : 31/5/2017 par LEGRAND Mathieu
// Mise à jour : 31/5/2017 par LEGRAND Mathieu

// inclusion de la classe RaisonEchec
include_once ('Echec.class.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Echec</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
// appel du constructeur et tests des accesseurs (get)
$unId = 1;
$uneDate = "2017-05-18 12:46:14";
$unName = "toto";
$unPassword = "titi";
$uneAdresseIP = "111.222.111.222";
$uneRaisonRefus = "2";
$unEchec = new Echec($unId, $uneDate, $unName, $unPassword, $uneAdresseIP, $uneRaisonRefus);

echo ('$id : ' . $unEchec->getId() . '<br>');
echo ('$date : ' . $unEchec->getDate() . '<br>');
echo ('$name : ' . $unEchec->getName() . '<br>');
echo ('$password : ' . $unEchec->getPassword() . '<br>');
echo ('$adresseIP : ' . $unEchec->getAdresseIP() . '<br>');
echo ('$raisonRefus : ' . $unEchec->getRaisonRefus() . '<br>');
echo ('<br>');

// tests des mutateurs (set)
$unEchec->setId(2);
$unEchec->setDate("2017-05-31 15:18:37");
$unEchec->setName("lala");
$unEchec->setPassword("passe");
$unEchec->setAdresseIP("111.222.233.244");
$unEchec->setRaisonRefus("1");

echo ('$id : ' . $unEchec->getId() . '<br>');
echo ('$date : ' . $unEchec->getDate() . '<br>');
echo ('$name : ' . $unEchec->getName() . '<br>');
echo ('$password : ' . $unEchec->getPassword() . '<br>');
echo ('$adresseIP : ' . $unEchec->getAdresseIP() . '<br>');
echo ('$raisonRefus : ' . $unEchec->getRaisonRefus() . '<br>');
echo ('<br>');

// test de la méthode toString
echo ($unEchec->toString());
?>

</body>
</html>