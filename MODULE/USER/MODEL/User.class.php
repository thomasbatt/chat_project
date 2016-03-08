<?php
class User {
/********************************************************************************************
********************************* PROPRIETE *************************************************
********************************************************************************************/
	private $id;
	private $login;
	private $hash;
	private $createDate;
	private $admin;
	
/********************************************************************************************
********************************* METHODE ***************************************************
********************************************************************************************/

/******************************** GETTER ****************************************************
********************************************************************************************/

	public function getId() {
		return $this->id; 
	}

	public function getLogin() {
		return $this->login;
	}

	public function getHash() {
		return $this->hash;
	}

	public function getCreateDate() {
		return $this->createDate;
	}

	public function isAdmin() {
		return $this->admin;
	} 

/******************************** SETTER ****************************************************
********************************************************************************************/

	public function setLogin($login) {
		if (strlen($login) > 3 && strlen($login) < 31) {
			$this->login = $login;
		} else {
			throw new Exception("Login incorrect (doit être compris entre 4 et 30 caractères)");
		}
	}

	public function setAdmin($admin) {
		if ($admin === true || $admin === false) {
			$this->admin = $admin;
		} else {
			throw new Exception("Admin incorrect (doit être égal à true ou false)");
		}
	}

/******************************** PASSWORD VERIF ********************************************
********************************************************************************************/
	public function verifPassword($password)
	{
		return password_verify($password, $this->hash);
	}

/******************************** PASSWORD EDIT *********************************************
********************************************************************************************/
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
				else
				{
					throw new Exception("Ancien mot de passe incorrect");
				}
			}
			else
			{
				throw new Exception("Mot de passe est trop court (< 6 caractères)");
			}
		}
		else
		{
			throw new Exception("Les deux mots de passes ne correspondent");
		}
	}

/******************************** PASSWORD INIT *********************************************
********************************************************************************************/
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
			else
			{
				throw new Exception("Mot de passe est trop court (< 6 caractères)");
			}
		}
		else
		{
			throw new Exception("Les deux mots de passes ne correspondent");
		}
	}
}
?>