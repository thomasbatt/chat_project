<?php

// var_dump($_GET);
// var_dump($_POST);
// var_dump($_SESSION);
// exit;

$errrors = [
	'IdMessage' => '',
	'password' => '',
	'IdMessage_exist' => ''
];

if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'create_message')
	{
		if (isset( $_POST['content'] ))
		{
			$MessageManager = new MessageManager($db);
			try
			{
				$manager = new UserManager($db);
				$author = $manager->getById($_SESSION['id']);
				$MessageManager->create($author, $_POST['content']);
				header('Location: messages');
				exit;
			}
			catch (Exception $e)
			{
				$IdMessage = $_POST['content'];
				$error = $e->getMessage();
			}
		}
	}
	else
		$error = "Erreur interne (filou détecté !!!)";

}






?>