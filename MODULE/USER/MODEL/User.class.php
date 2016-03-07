<?php
// PascalCase pour le nom des classes
// camelCase pour le nom des variables
class User {
// ------------------------ Déclarer les propriétés-----------------------
	private $id;
	private $login;
	private $hash;
	private $createDate;
	private $admin;
	
// ------------------------Déclarer les méthodes--------------------------

	// --------------------Liste des getters------------------------------

	public function getId() {
		return $this->id; // On récupère la propriété id de $this
	}

	public function getLogin() {
		return $this->login;
	}

	public function getCreateDate() {
		return $this->createDate;
	}

	public function isAdmin() { // Un getter d'un booleen transforme le get en is
		return $this->admin;
	}

	// --------------------Liste des setters-------------------------------
	public function setLogin($login) {
		if (strlen($login) > 3 && strlen($login) < 31) {
			$this->login = $login;
		}
	}

	public function setAdmin($admin) {
		// methode 1
		if ($admin === true || $admin === false) {
			$this->admin = $admin;
		}
		// ou methode 2
		$this->admin = (bool)$admin; // (bool) permet de "caster" une variable en un type particulier, transformer n'importe quel type en booleen (ici)
	}

	// --------------------Liste des méthodes "autres"---------------------
	public function verifPassword($password)
	{
		return password_verify($password, $this->hash);
	}

	public function editPassword($oldPassword, $newPassword1, $newPassword2)
	{
		if ($newPassword1 == $newPassword2) 
		{
			if (strlen($newPassword1) > 5) 
			{
				if ($this->verifPassword($newPassword1)) 
				{
					$this->hash = password_hash($newPassword1, PASSWORD_BCRYPT, ["cost"=>12]);
				}
			}
		}
	}

	public function initPassword($newPassword1, $newPassword2)
	{
		if ($this->hash == NULL) {
			if ($newPassword1 == $newPassword2) 
			{
				if (strlen($newPassword1) > 5) 
				{
					$this->hash = password_hash($newPassword1, PASSWORD_BCRYPT, ["cost"=>12]);
				}
			}
		}
	}
}

// Tout ça n'a rien a foutre dans le fichier User.class.php, mais c'est plus pratique pour apprendre

// ------------------------------------------------------------------------
// --------------------On va INSTANCIER notre classe User------------------
// --------------------$user => objet--------------------------------------
// --------------------User => classe--------------------------------------
// --------------------Un objet est une instance d'une classe--------------
// ------------------------------------------------------------------------

$user = new User();
$user->setLogin("toto");
$user->initPassword("password", "password");

var_dump($user);


?>