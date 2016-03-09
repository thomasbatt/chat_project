<?php
class MessageManager
{
	// Déclarer les propriétés
	private $db;

	// Constructeur
	public function __construct($db)
	{
		$this->db = $db;
	}

	public function getById($Id)
	{
		$Id = intval($Id);
		$query = "SELECT * FROM message WHERE Id_message='".$Id."'";
		$res = mysqli_query($this->db, $query);
		if ($res)
		{
			$message = mysqli_fetch_object($res, "Message", [$this->db]);
			if ($message)
				return $message;
			else
				throw new Exception("Id message incorrect");
		}
		else
			throw new Exception("Erreur interne");
	}

	public function create(User $user, $content)
	{
		$message = new Message($this->db);
		$message->setUser($user);
		$message->setContent($content);
		$IdUser = intval($message->getUser()->getId());
		$content = mysqli_real_escape_string($this->db, $message->getContent());
		// var_dump($message);
		// exit;
		$query = "INSERT INTO message (idUser_message, content_message) VALUES('".$IdUser."', '".$content."')";
		try
		{
			$res = mysqli_query($this->db, $query);
		}
		catch (Exception $e)
		{
			throw new Exception("Erreur interne");
		}
	}

 	public function getAll()
 	{
 		$query = "SELECT * FROM message";
 		$res = mysqli_query($this->db, $query);
 		try
		{
 			while ( $message = mysqli_fetch_object($res, "Message", [$this->db]) )
				$messages [] = $message;
			return $messages;
		}
		catch (Exception $e)
		{
			throw new Exception("Erreur interne");
		}
 	}

}
?>