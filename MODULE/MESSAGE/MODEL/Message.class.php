<?php
// PascalCase pour le nom des classes
// camelCase pour le nom des variables
class Message
{
// ------------------------ Déclarer les propriétés-----------------------
	private $id_message;
	private $idUser_message;
	private $content_message;
	private $create_message;
	
// ------------------------Déclarer les méthodes--------------------------

	// --------------------Liste des getters------------------------------

	public function getId() {
		return $this->id_message; // On récupère la propriété id_message de $this
	}

	public function getIdUser() {
		return $this->idUser_message;
	}

	public function getContent(){
		return $this->content_message;
	}

	public function getCreateDate() {
		return $this->create_message;
	}

	// --------------------Liste des setters-------------------------------
	public function setIdUser($idUser) {
		if ($idUser > 0) {
			$this->idUser_message = $idUser;
		}
	}

	public function setContent($content) {
		if (strlen($content) > 3 && strlen($content) < 1023) {
			$this->content_message = $content;
		}
	}
	// --------------------Liste des méthodes "autres"---------------------

	// --------------------verifier password ?---------------------

}

// Tout ça n'a rien a foutre dans le fichier User.class.php, mais c'est plus pratique pour apprendre

// ------------------------------------------------------------------------
// --------------------On va INSTANCIER notre classe User------------------
// --------------------$user => objet--------------------------------------
// --------------------User => classe--------------------------------------
// --------------------Un objet est une instance d'une classe--------------
// ------------------------------------------------------------------------

// $user = new User();
// $user->setLogin("toto");
// $user->initPassword("password", "password");

// var_dump($user);


?>