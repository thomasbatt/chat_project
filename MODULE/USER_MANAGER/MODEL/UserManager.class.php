<?php
class UserManager
{
/********************************************************************************************
********************************* PROPRIETE *************************************************
********************************************************************************************/
	private $db;

/********************************************************************************************
********************************* METHODE ***************************************************
********************************************************************************************/

/******************************** CONSTRUCTOR ***********************************************
********************************************************************************************/
	public function __construct($db)
	{
		$this->db = $db;
	}

/******************************** ALL INFO USER BY LOGIN ************************************
********************************************************************************************/
	public function getByLogin($login)
	{
		$login = mysqli_real_escape_string($this->db, $login);
		$query = "SELECT * FROM user WHERE login_user='".$login."'";
		$res = mysqli_query($this->db, $query);
		if ($res)
		{
			$user = mysqli_fetch_object($res, "User");
			if ($user)
			{
				return $user;
			}
			else
			{
				throw new Exception("Utilisateur non existant");
			}
		}
		else
		{
			throw new Exception("Erreur interne");
		}
	}

/******************************** TEST EXISTE LOGIN *****************************************
********************************************************************************************/
	public function getLoginExiste($login)
	{
		$login = mysqli_real_escape_string($this->db, $login);
		$query = "SELECT id_user FROM user WHERE login_user='".$login."'";
		$res = mysqli_query($this->db, $query);
		if ($res)
		{
			$idUser = mysqli_fetch_row($res);
			if ($idUser != NULL) 
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			throw new Exception("Erreur login test");
		}
	}

/******************************** CREATE USER ***********************************************
********************************************************************************************/
	public function create($login, $password1, $password2)
	{
		$nombreErrors = 0;
		$errors = [];
		$user = new User();
		try
		{
			$user->setLogin($login);
		}
		catch(Exception $e)
		{
			$errors['login'] = $e->getMessage();
			$nombreErrors++;
		}
		try
		{
			$user->initPassword($password1, $password2);
		}
		catch(Exception $e)
		{
			$errors['password'] = $e->getMessage();
			$nombreErrors++;
		}

		if ($nombreErrors == 0) {
			try
			{
				$testLogin = $this->getLoginExiste($login);
			}
			catch(Exception $e)
			{
				$errors['loginExiste'] = $e->getMessage();
			}
			if ($testLogin == FALSE) 
			{
				$loginVerif = mysqli_real_escape_string($this->db, $user->getLogin());
				$hashVerif = mysqli_real_escape_string($this->db, $user->getHash());
				$query = "INSERT INTO `user`(`login_user`, `hash_user`) VALUES ('".$loginVerif."','".$hashVerif."')";
				
				$res = mysqli_query($this->db, $query);
				if ($res)
				{
					header('Location: message');
					exit();
				}
				else
				{
					throw new Exception("Erreur interne");
				}
			}
		}
	}



}
?>