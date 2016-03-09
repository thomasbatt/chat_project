<?php
// PascalCase pour le nom des classes
// camelCase pour le nom des variables
class User 
{
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

	public function getDate()
	{
		return $this->date;
	}

	public function getHash()
	{
		return $this->hash;
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

	// --------------------verifier password ?---------------------
	public function verifPassword($password)
	{
		if (!password_verify($password, $this->hash))
			throw new Exception("Mot de passe incorrect");
	}

	// --------------------modifier password ?---------------------
	public function editPassword($oldPassword, $newPassword1, $newPassword2)
	{
		if ($newPassword1 === $newPassword2)
		{
			$newPassword = $newPassword1;
			if (strlen($newPassword) > 5)
			{
				if ($this->verifPassword($oldPassword))
				{
					$this->hash = password_hash($newPassword, PASSWORD_BCRYPT, ["cost"=>12]);
				}
				else
					throw new Exception("Ancien mot de passe incorrect");
			}
			else
				throw new Exception("Mot de passe est trop court (< 6 caractères)");
		}
		else
			throw new Exception("Les deux mots de passes ne correspondent");
	}

	public function initPassword($newPassword1, $newPassword2)
	{
		if ($this->hash == null)
		{
			if ($newPassword1 === $newPassword2)
			{
				$newPassword = $newPassword1;
				if (strlen($newPassword) > 5)
				{
					$this->hash = password_hash($newPassword, PASSWORD_BCRYPT, ["cost"=>12]);
				}
				else
					throw new Exception("Mot de passe est trop court (< 6 caractères)");
			}
			else
				throw new Exception("Les deux mots de passes ne correspondent");
		}
		else
			throw new Exception("Impossible d'initialiser un mot de passe une seconde fois");
	}
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