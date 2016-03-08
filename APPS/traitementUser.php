<?php

$errrors = [
	'login' => '',
	'password' => '',
	'login_exist' => ''
];

if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'register')
	{
		if (isset($_POST['login'], $_POST['password1'] , $_POST['password2']))
		{
			require('MODULE/USER/MODEL/User.class.php');
			require('MODULE/USER/MODEL/UserManager.class.php');
			$usermanager = new UserManager($db);
			try
			{
				$user = $usermanager->create($_POST['login'],$_POST['password1'],$_POST['password2']);
				$_SESSION['id'] = $user->getId();
				$_SESSION['login'] = $user->getLogin();
				header('Location: message');
				exit;
			}
			catch (Exception $e)
			{
				$login = $_POST['login'];
				$error = $e->getMessage();
			}
		}
	}
	else if ($action == 'login')
	{
		if (isset($_POST['login'], $_POST['password']))
		{
			require('MODULE/USER/MODEL/User.class.php');
			require('MODULE/USER/MODEL/UserManager.class.php');
			$usermanager = new UserManager($db);
			try
			{
				$manager = new UserManager($db);
				$user = $manager->getByLogin($_POST['login']);
				$user->verifPassword($_POST['password']);
				$_SESSION['id'] = $user->getId();
				$_SESSION['login'] = $user->getLogin();
				header('Location: tchat');
				exit;
			}
			catch (Exception $e)
			{
				$login = $_POST['login'];
				$error = $e->getMessage();
			}
		}
	}
	else if ($action == 'message')
	{
		session_destroy();
		$_SESSION = array();
		header('Location: home');
		exit;
	}
	else
		$error = "Erreur interne (filou détecté !!!)";

}






?>