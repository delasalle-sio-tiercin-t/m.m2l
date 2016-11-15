<?php
// Projet Réservations M2L - version web mobile
// fichier : controleurs/CtrlConsulterReservations.php
// Rôle : traiter la demande de consultation des réservations d'un utilisateur
// écrit par Jim le 12/10/2015
// modifié par Jim le 28/6/2016

// on vérifie si le demandeur de cette action est bien authentifié


	// connexion du serveur web à la base MySQL
	include_once ('modele/DAO.class.php');
	$dao = new DAO();
	
	// récupération des réservations à venir créées par l'utilisateur à l'aide de la méthode getLesReservations de la classe DAO
	$lesReservations = $dao->getLesReservations($nom);
	// mémorisation du nombre de réservations
	$nbReponses = sizeof($lesReservations);

	// préparation d'un message précédent la liste
	if ($nbReponses == 0) {
		$message = "Vous n'avez aucune réservation !";
	}
	else {
		$message = "Vous avez " . $nbReponses . " réservation(s) !";
	}
	if ( empty ($_POST ["idRes"]) == true)  $idReservation = "";  
	else   $idReservation = $_POST ["idRes"];
	$dao->annulerReservation($idReservation);
	// affichage de la vue
	include_once ('vues/VueAnnulerReservation.php');
	
	unset($dao);		// fermeture de la connexion à MySQL
