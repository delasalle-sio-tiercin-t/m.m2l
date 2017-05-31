<?php
// Projet Réservations M2L - version web mobile
// fichier : modele/Echec.class.php
// Rôle : la classe Echec représente les échecs ayant eu lieu lors d'une connexion utilisateur
// Création : 31/5/2017 par LEGRAND Mathieu
// Mise à jour : 31/5/2017 par LEGRAND Mathieu

class Echec
{
	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------- Membres privés de la classe ---------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	private $id;				// identifiant de l'échec (numéro automatique dans la BDD)
	private $date;			    // date à laquelle l'échec de connexion à eu lieu
	private $name;				// login utilisé lors de la tentative de connexion
	private $password;			// mot de passe utilisé lors de la tentative de connexion
	private $adresseIP;			// adresse IP de la personne ayant tenté de se connecter
	private $raisonRefus;		// identifiant de la raison de l'échec (classe RaisonEchec)

	// ------------------------------------------------------------------------------------------------------
	// ----------------------------------------- Constructeur -----------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function RaisonEchec($unId, $uneDate, $unName, $unPassword, $uneAdresseIP, $uneRaisonRefus) {
		$this->id = $unId;
		$this->date = $uneDate;
		$this->name = $unName;
		$this->password = $unPassword;
		$this->adresseIP = $uneAdresseIP;
		$this->raisonRefus = $uneRaisonRefus;
	}

	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Getters et Setters ------------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function getId()	{return $this->id;}
	public function setId($unId) {$this->id = $unId;}
	
	public function getDate()	{return $this->date;}
	public function setDate($uneDate) {$this->date = $uneDate;}
	
	public function getName()	{return $this->name;}
	public function setName($unName) {$this->name = $unName;}
	
	public function getPassword()	{return $this->password;}
	public function setPassword($unPassword) {$this->password = $unPassword;}
	
	public function getAdresseIP()	{return $this->adresseIP;}
	public function setAdresseIP($uneAdresseIP) {$this->adresseIP = $uneAdresseIP;}
	
	public function getRaisonRefus()	{return $this->raisonRefus;}
	public function setRaisonRefus($uneRaisonRefus) {$this->raisonRefus = $uneRaisonRefus;}

	// ------------------------------------------------------------------------------------------------------
	// ---------------------------------------- Méthodes d'instances ----------------------------------------
	// ------------------------------------------------------------------------------------------------------
	
	public function toString() {
		$msg = "Echec n° : " . $this->id . "<br>";
		$msg .= "Date : " . $this->date . "<br>";
		$msg .= "Nom : " . $this->name . "<br>";
		$msg .= "Mot de passe : " . $this->password . "<br>";
		$msg .= "Adresse IP : " . $this->adresseIP . "<br>";
		$msg .= "Raison du refus : " . $this->raisonRefus . "<br>";
		return $msg;
	}
	
} // fin de la classe RaisonEchec