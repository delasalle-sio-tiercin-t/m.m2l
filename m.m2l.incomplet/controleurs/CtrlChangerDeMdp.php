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
	
	
	require_once 'Mobile_Detect.php';
	$detect = new Mobile_Detect;
	
	if ( $detect->isAndroidOS() ) $OS = "Android"; else $OS = "autre";
	
	$divConnecterDepliee = true;		// indique si la division doit être dépliée à l'affichage de la vue
	$divDemanderMdpDepliee = false;		// indique si la division doit être dépliée à l'affichage de la vue
	
	if ( ! isset ($_POST ["btnValiderMdp"]) == true) {
		// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
		$Amdp = '';
		$Nmdp = '';
		$NCmdp = '';
		include_once ('vues/VueChangerDeMdp.php');
	}
	else {
		// récupération des données postées
		if ( empty ($_POST ["txtAncienMdp"]) == true)  $Amdp = "";  else   $Amdp = $_POST ["txtAncienMdp"];
		if ( empty ($_SESSION ["nom"]) == true)  $nom = "";  else   $nom = $_SESSION ["nom"];
		if ( empty ($_POST ["txtNewMotDePasse"]) == true)  $nouveauMdp = "";  else   $nouveauMdp = $_POST ["txtNewMotDePasse"];
		if ( empty ($_POST ["caseAfficherMdp"]) == true)  $afficherMdp = "off";  else   $afficherMdp = $_POST ["caseAfficherMdp"];
	
		if ($Amdp == '' || $Nmdp == '') {
			// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
			$message = 'Données incomplètes ou incorrectes !';
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			$changerMdp = '';
			include_once ('vues/VueConnecter.php');
		}
	else {
		// connexion du serveur web à la base MySQL
		include_once ('modele/DAO.class.php');
		$dao = new DAO();
		
		// test de l'authentification de l'utilisateur
		// la méthode getNiveauUtilisateur de la classe DAO retourne les valeurs 'inconnu' ou 'utilisateur' ou 'administrateur'
		$changerMdp = $dao->modifierMdpUser($nom, $nouveauMdp);

		
	
	// affichage de la vue
	include_once ('vues/VueChangerDeMdp.php');
	
	unset($dao);		// fermeture de la connexion à MySQL
}
}


?>