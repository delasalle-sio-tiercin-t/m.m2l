<?php
// Projet Réservations M2L - version web mobile
// fichier : modele/RaisonEchec.class.php
// Rôle : la classe RaisonEchec représente les raisons possibles d'échec lors d'une connexion utilisateur
// Création : 17/5/2017 par JM CARTRON
// Mise à jour : 17/5/2017 par JM CARTRON

class RaisonEchec
{
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Membres privés de la classe ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	private $id;				// identifiant de la raison (numéro automatique dans la BDD)
	private $libelle;			// libellé de la raison

	// ------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Constructeur -----------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function RaisonEchec($unId, $unLibelle) {
		$this->id = $unId;
		$this->libelle = $unLibelle;
	}

	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Getters et Setters ------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function getId()	{return $this->id;}
	public function setId($unId) {$this->id = $unId;}
	
	public function getLibelle()	{return $this->libelle;}
	public function setLibelle($unLibelle) {$this->libelle = $unLibelle;}

	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Méthodes d'instances ----------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function toString() {
		$msg = "Raison échec : <br>";
		$msg .= "id : " . $this->id . "<br>";
		$msg .= "libelle : " . $this->libelle . "<br>";
		return $msg;
	}
	
} // fin de la classe RaisonEchec

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!