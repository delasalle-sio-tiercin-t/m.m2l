<?php
// Service web du projet Réservations M2L
// Ecrit le 21/5/2015 par Jim
// Modifié le 2/6/2016 par Jim

// ce service web est appelé par le lecteur de digicode situé à l'entrée d'une salle,
// afin de tester la validité du digicode saisi par l'utilisateur

// Le service web doit recevoir 2 paramètres : numSalle, digicode
// Les paramètres peuvent être passés par la méthode GET (pratique pour les tests, mais à éviter en exploitation) :
//     http://<hébergeur>/AnnulerReservation.php?numSalle=10&digicode=123456

// Les paramètres peuvent être passés par la méthode POST (à privilégier en exploitation pour la confidentialité des données) :
//     http://<hébergeur>/AnnulerReservation.php
http://localhost/reservations/AnnulerReservation.php?nom=zenelsy&amp;mdp=ab&amp;numreservation=1
// inclusion de la classe Outils
include_once ('../modele/Outils.class.php');
// inclusion des paramètres de l'application
include_once ('../modele/parametres.localhost.php');

// Récupération des données transmises
// la fonction $_GET récupère une donnée passée en paramètre dans l'URL par la méthode GET
if ( empty ($_GET ["nom"]) == true)  $nom = "";  else   $nom = $_GET ["nom"];
if ( empty ($_GET ["mdp"]) == true)  $mdp = "";  else   $mdp = $_GET ["mdp"];
if ( empty ($_GET ["numreservation"]) == true)  $idReservation = "";  else   $idReservation = $_GET ["numreservation"];

// si l'URL ne contient pas les données, on regarde si elles ont été envoyées par la méthode POST
// la fonction $_POST récupère une donnée envoyées par la méthode POST
if ( $nom == "" && $mdp == "" && $idReservation == "" ) {
	if ( empty ($_POST ["nom"]) == true)  $nom = "";  else   $nom = $_POST ["nom"];
	if ( empty ($_POST ["mdp"]) == true)  $mdp = "";  else   $mdp = $_POST ["mdp"];
	if ( empty ($_POST ["numreservation"]) == true)  $idReservation = "";  else   $idReservation = $_POST ["numreservation"];
	
}

// Contrôle de la présence des paramètres
if ( $nom == "" || $mdp == "" || $idReservation == ""  ) {
	$msg = "Erreur : données incomplètes ou incorrectes.";
}
else {
	// connexion du serveur web à la base MySQL ("include_once" peut être remplacé par "require_once")
	include_once ('../modele/DAO.class.php');
	$dao = new DAO();

	if ( ! $dao->existeReservation($idReservation) ) {
		$msg = "Erreur : la réservation n'existe pas !";
	}
	else {
		if ( $dao->existeUtilisateur($nom) != "" ) {
			$msg = "Erreur : authentification incorrecte.";
		}
		else {
		$ok = $dao->estLeCreateur($nom,$idReservation);
				if ( ! $ok ) {
					$msg = "Erreur : vous n'êtes pas l'auteur de cette réservation !";
				}
				else {
					// on vérifie si la réservation est déjà passée
					$date = $reservation->getEnd_time();
					$timestamp = strtotime($date);
					if ($timestamp < time()){
						$msg = "Erreur : cette réservation est déjà passée !";
					}
					else
						{
							// envoi d'un mail de confirmation de la suppression de la réservation
							$sujet = "Confirmation de la suppression de la réservation " . $idReservation;
							$contenuMail = "La réservation numéro ." . $idReservation . " a été supprimée. \n\n";
						
							$ok = Outils::envoyerMail($email, $sujet, $contenuMail, $ADR_MAIL_EMETTEUR);
							if ( ! $ok ) {
								// l'envoi de mail a échoué
								$msg = "Suppression effectuée ; l'envoi du mail à l'utilisateur a rencontré un problème.";
							}
							else {
								// tout a bien fonctionné
								$msg = "Suppression effectuée ; un mail va être envoyé à l'utilisateur.";
							}
						}
					}
				}	
			}
			// ferme la connexion à MySQL :
			unset($dao);
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
	$elt_commentaire = $doc->createComment('Service web AnnulerReservation - BTS SIO - Lycée De La Salle - Rennes');
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
						
						
						
						