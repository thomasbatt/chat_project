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
	public function __construct(PDO $bdd)
	{
		$this->db = $bdd;
	}

/******************************** ALL INFO USER BY LOGIN ************************************
********************************************************************************************/
	public function getUserByLogin($login)
	{
		$login = $this->db->quote($login);
		$query = "SELECT * FROM user WHERE login_user=".$login;
		$res = $this->db->query($query);
		if ($res)
		{
			$user = $this->res->fetchObject("User");
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
		$login = $this->db->quote($login);
		$query = "SELECT id_user FROM user WHERE login_user=".$loginVerif;
		$res = $this->bd->query($query);
		if ($res)
		{
			$count = $res->rowCount();
			if ($count == 0) 
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

/******************************** CONNECT USER **********************************************
********************************************************************************************/
	public function getConnect($login, $password)
	{
		$loginVerif = $this->db->quote($login);
		$query = "SELECT * FROM user WHERE login_user=".$loginVerif;
		$res = $this->db->query($query);
		if ($res)
		{
			$user = $res->fetchObject("User");
			if ($user->verifPassword($password)) 
			{
				return $user;
			}
			else
			{
				throw new Exception("le mot de pass ou le login est faux");
			}
		}
		else
		{
			throw new Exception("le mot de pass ou le login est faux");
		}
	}


/******************************** CREATE USER ***********************************************
********************************************************************************************/

	public function getById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM user WHERE id_user='".$id."'";
		$res = $this->db->query($query);
		if ($res)
		{
			$user = $res->fetchObject('User');
			if ($user)
			{
				return $user;
			}
			else
			{
				throw new Exception("id incorrect");
			}
		}
		else
		{
			throw new Exception("Erreur interne");
		}
	}

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

		if ($nombreErrors == 0) 
		{
			if ($this->getLoginExiste($login)) 
			{
				$loginVerif = $this->db->quote($user->getLogin());
				$hashVerif = $this->db->quote($user->getHash());
				$query = "INSERT INTO `user`(`login_user`, `hash_user`) VALUES (".$loginVerif.",".$hashVerif.")";
				
				$res = mysqli_query($this->db, $query);
				$res = $this->db->exec($query);
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

/******************************** ALL USER ***********************************************
********************************************************************************************/
	public function getAll()
 	{
 		$query = "SELECT * FROM user ORDER BY update_user DESC, login_user ASC";
 		$res = $this->db->query($query);
 		try
		{
 			while ( $user = $res->fetchObject("User") )
				$users [] = $user;
			return $users;
		}
		catch (Exception $e)
		{
			throw new Exception("Erreur interne");
		}
 	}

 	public function isConnected($id)
 	{
 		$idVerif = intval($id);
 		$query = "SELECT login_user FROM user WHERE update_user > CURRENT_TIMESTAMP - 10 AND id_user = '".$idVerif."'";
 		$res = $this->db->query($query);
 		$count = $res->rowCount();
 		if ($count == 0) 
 			return FALSE;
 		else
 			return TRUE;
 	}

 	public function editDateConnected($id)
 	{
 		$query = "UPDATE user SET update_user=CURRENT_TIMESTAMP WHERE id_user = '".$id."'";
 		$res = $this->db->exec($query);
 	}
}
?>