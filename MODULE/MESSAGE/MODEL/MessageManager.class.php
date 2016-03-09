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
		$Id = mysqli_real_escape_string($this->db, $Id);
		$query = "SELECT * FROM message WHERE Id_message='".$Id."'";
		$res = mysqli_query($this->db, $query);
		if ($res)
		{
			$message = mysqli_fetch_object($res, "Message");
			if ($message)
				return $message;
			else
				throw new Exception("Id message incorrect");
		}
		else
			throw new Exception("Erreur interne");
	}

	public function create($IdUser, $content)
	{
		$message = new Message();
		$message->setIdUser($IdUser);
		$message->setContent($content);
		$IdUser = intval($message->getIdUser());
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
 			while ( $message = mysqli_fetch_object($res, "Message") )
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