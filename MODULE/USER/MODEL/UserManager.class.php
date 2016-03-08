<?php
class UserManager
{
	// Déclarer les propriétés
	private $db;

	// Constructeur
	public function __construct($db)
	{
		$this->db = $db;
	}

	public function getByLogin($login)
	{
		$login = mysqli_real_escape_string($this->db, $login);
		$query = "SELECT * FROM user WHERE login_user='".$login."'";
		$res = mysqli_query($this->db, $query);
		if ($res)
		{
			$user = mysqli_fetch_object($res, "User");
			if ($user)
				return $user;
			else
				throw new Exception("Login incorrect");
		}
		else
			throw new Exception("Erreur interne");
	}

	public function create($login, $pass1, $pass2)
	{
		$user = new User();
		$user->setLogin($login);
		$user->initPassword($pass1, $pass2);
		$login = mysqli_real_escape_string($this->db, $user->getLogin());
		$hash = mysqli_real_escape_string($this->db, $user->getHash());
		$query = "INSERT INTO user (login_user, hash_user) VALUES('".$login."', '".$hash."')";
		try
		{
			$res = mysqli_query($this->db, $query);
		}
		catch (Exception $e)
		{
			throw new Exception("Erreur interne");
		}
		return $this->getByLogin($user->getLogin());
	}
}
?>