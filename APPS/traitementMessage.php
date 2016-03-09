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
		if (isset($_POST['IdUser'], $_POST['content'] ))
		{
			$MessageManager = new MessageManager($db);
			try
			{
				$MessageManager->create($_POST['IdUser'],$_POST['content']);
				header('Location: message');
				exit;
			}
			catch (Exception $e)
			{
				$IdMessage = $_POST['IdUser'];
				$error = $e->getMessage();
			}
		}
	}
	else
		$error = "Erreur interne (filou détecté !!!)";

}






?>