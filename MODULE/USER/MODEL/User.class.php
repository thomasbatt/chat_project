<?php
class User {
/********************************************************************************************
********************************* PROPRIETE *************************************************
********************************************************************************************/
	private $id_user;
	private $login_user;
	private $hash_user;
	private $create_user;
	private $isAdmin_user;
	
/********************************************************************************************
********************************* METHODE ***************************************************
********************************************************************************************/

/******************************** GETTER ****************************************************
********************************************************************************************/

	public function getId() {
		return $this->id_user; 
	}

	public function getLogin() {
		return $this->login_user;
	}

	public function getHash() {
		return $this->hash_user;
	}

	public function getCreateDate() {
		return $this->create_user;
	}

	public function isAdmin() {
		return $this->isAdmin_user;
	} 

/******************************** SETTER ****************************************************
********************************************************************************************/

	public function setLogin($login) {
		if (strlen($login) > 3 && strlen($login) < 31) {
			$this->login_user = $login;
		} else {
			throw new Exception("login_user incorrect (doit être compris entre 4 et 30 caractères)");
		}
	}

	public function setAdmin($admin) {
		if ($admin === true || $admin === false) {
			$this->isAdmin_user = $admin;
		} else {
			throw new Exception("Admin incorrect (doit être égal à true ou false)");
		}
	}

/******************************** PASSWORD VERIF ********************************************
********************************************************************************************/
	public function verifPassword($password)
	{
		return password_verify($password, $this->hash_user);
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
					$this->hash_user = password_hash($newPassword1, PASSWORD_BCRYPT, ["cost"=>12]);
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
		if ($this->hash_user == NULL) {
			if ($newPassword1 == $newPassword2) 
			{
				if (strlen($newPassword1) > 5) 
				{
					$this->hash_user = password_hash($newPassword1, PASSWORD_BCRYPT, ["cost"=>12]);
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