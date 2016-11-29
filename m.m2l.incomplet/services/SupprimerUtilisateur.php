<?php
// Service web du projet Réservations M2L
// Ecrit le 22/11/2016 par LEGRAND Mathieu
// Modifié le 22/11/2016 par LEGRAND Mathieu

// Ce service web permet à un administrateur authentifié d'enregistrer un nouvel utilisateur
// et fournit un compte-rendu d'exécution

// Le service web doit être appelé avec 5 paramètres : nomAdmin, mdpAdmin, name, level, email
// Les paramètres peuvent être passés par la méthode GET (pratique pour les tests, mais à éviter en exploitation) :
//     http://<hébergeur>/CreerUtilisateur.php?nomAdmin=admin&mdpAdmin=admin&name=jim&level=1&email=jean.michel.cartron@gmail.com

// Les paramètres peuvent être passés par la méthode POST (à privilégier en exploitation pour la confidentialité des données) :
//     http://<hébergeur>/CreerUtilisateur.php

// inclusion de la classe Outils
include_once ('../modele/Outils.class.php');
// inclusion des paramètres de l'application
include_once ('../modele/parametres.localhost.php');

// Récupération des données transmises
// la fonction $_GET récupère une donnée passée en paramètre dans l'URL par la méthode GET
if ( empty ($_GET ["nomAdmin"]) == true)  $nomAdmin = "";  else   $nomAdmin = $_GET ["nomAdmin"];
if ( empty ($_GET ["mdpAdmin"]) == true)  $mdpAdmin = "";  else   $mdpAdmin = $_GET ["mdpAdmin"];
if ( empty ($_GET ["name"]) == true)  $name = "";  else   $name = $_GET ["name"];
if ( empty ($_GET ["level"]) == true)  $level = "";  else   $level = $_GET ["level"];
if ( empty ($_GET ["email"]) == true)  $email = "";  else   $email = $_GET ["email"];

// si l'URL ne contient pas les données, on regarde si elles ont été envoyées par la méthode POST
// la fonction $_POST récupère une donnée envoyées par la méthode POST
if ( $nomAdmin == "" && $mdpAdmin == "" && $name == "" && $level == "" && $email == "" ) {
	if ( empty ($_POST ["nomAdmin"]) == true)  $nomAdmin = "";  else   $nomAdmin = $_POST ["nomAdmin"];
	if ( empty ($_POST ["mdpAdmin"]) == true)  $mdpAdmin = "";  else   $mdpAdmin = $_POST ["mdpAdmin"];
	if ( empty ($_POST ["name"]) == true)  $name = "";  else   $name = $_POST ["name"];
	if ( empty ($_POST ["level"]) == true)  $level = "";  else   $level = $_POST ["level"];
	if ( empty ($_POST ["email"]) == true)  $email = "";  else   $email = $_POST ["email"];
}

// Contrôle de la présence des paramètres
if ( $nomAdmin == "" || $mdpAdmin == "" || $name == "" ) {
	$msg = "Erreur : données incomplètes ou incorrectes.";
}
	else {
		// connexion du serveur web à la base MySQL ("include_once" peut être remplacé par "require_once")
		include_once ('../modele/DAO.class.php');
		$dao = new DAO();

		if ( $dao->getNiveauUtilisateur($nomAdmin, $mdpAdmin) != "administrateur" ) {
			$msg = "Erreur : authentification incorrecte.";
		}
		else
		{
			if (! $dao->existeUtilisateur($name) ) {
				$msg = "Erreur : nom d'utilisateur inexistant.";
			}
			else {
				if ( $dao->aPasseDesReservations($name))
				{
					$msg = "Erreur : cet utilisateur à passé des réservations";
				}
				else 
				{
				$unUtilisateur = $dao->getUtilisateur($name);
				$adrMail = $unUtilisateur->getEmail();
				// supprime l'utilisateur dans la bdd
				$ok = $dao->supprimerUtilisateur($name);
				if ($ok) {
					$msg = "Erreur : problème lors de la suppression de l'utilisateur.";
				}
				else {
					// envoi d'un mail de confirmation de l'enregistrement
					$sujet = "Suppression de votre compte dans le système de réservation de M2L";
					$contenuMail = "L'administrateur du système de réservations de la M2L vient de supprimer votre compte utilisateur.\n\n";
						
					$ok = Outils::envoyerMail($adrMail, $sujet, $contenuMail, $ADR_MAIL_EMETTEUR);
					if ( ! $ok ) {
						// l'envoi de mail a échoué
						$msg = "Enregistrement effectué ; l'envoi du mail à l'utilisateur a rencontré un problème.";
					}
					else {
						// tout a bien fonctionné
						$msg = "Enregistrement effectué ; un mail va être envoyé à l'utilisateur.";
					}
				}
			}
		}
		// ferme la connexion à MySQL :
		unset($dao);
	}
}
// création du flux XML en sortie
creerFluxXML ($msg);

// fin du programme (pour ne pas enchainer sur la fonction qui suit)
exit;


// création du flux XML en sortie
function creerFluxXML($msg)
{	// crée une instance de DOMdocument (DOM : Document Object Model)
$doc = new DOMDocument();

// specifie la version et le type d'encodage
$doc->version = '1.0';
$doc->encoding = 'ISO-8859-1';

// crée un commentaire et l'encode en ISO
$elt_commentaire = $doc->createComment('Service web CreerUtilisateur - BTS SIO - Lycée De La Salle - Rennes');
// place ce commentaire à la racine du document XML
$doc->appendChild($elt_commentaire);

// crée l'élément 'data' à la racine du document XML
$elt_data = $doc->createElement('data');
$doc->appendChild($elt_data);

// place l'élément 'reponse' juste après l'élément 'data'
$elt_reponse = $doc->createElement('reponse', $msg);
$elt_data->appendChild($elt_reponse);

// Mise en forme finale
$doc->formatOutput = true;

// renvoie le contenu XML
echo $doc->saveXML();
return;
}
?>