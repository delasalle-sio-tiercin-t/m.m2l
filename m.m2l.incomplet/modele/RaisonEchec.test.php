<?php
// Projet Réservations M2L - version web mobile
// fichier : modele/RaisonEchec.test.php
// Test de la classe RaisonEchec.class.php
// Création : 17/5/2017 par JM CARTRON
// Mise à jour : 17/5/2017 par JM CARTRON

// inclusion de la classe RaisonEchec
include_once ('RaisonEchec.class.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe RaisonEchec</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
// appel du constructeur et tests des accesseurs (get)
$unId = 1;
$unLibelle = "Login inexistant";
$uneRaison = new RaisonEchec($unId, $unLibelle);

echo ('$id : ' . $uneRaison->getId() . '<br>');
echo ('$libelle : ' . $uneRaison->getLibelle() . '<br>');
echo ('<br>');

// tests des mutateurs (set)
$uneRaison->setId(2);
$uneRaison->setLibelle("Mot de passe incorrect");

echo ('$id : ' . $uneRaison->getId() . '<br>');
echo ('$libelle : ' . $uneRaison->getLibelle() . '<br>');
echo ('<br>');

// test de la méthode toString
echo ($uneRaison->toString());
?>

</body>
</html>