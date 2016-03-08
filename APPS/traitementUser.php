<?php
	$errors = array(
		'login' => '',
		'password' => '',
		'loginExiste' => ''
	);
	
	if (isset($_POST['action'])) 
	{
		$action = $_POST['action'];
		if ($action == 'create') 
		{
			if (isset($_POST['login'], $_POST['password1'], $_POST['password2'])) 
			{
				require('models/User.class.php');
				require('models/UserManager.class.php');
				$userManager = new UserManager($bdd);
				try
				{
					$userManager->create($_POST['login'], $_POST['password1'], $_POST['password2']);
				}
				catch(Exception $e)
				{

				}
			}

		}		
	}
	require('models/User.class.php');
	require('models/UserManager.class.php');
	$userManager = new UserManager($bdd);
	if (isset($_POST['login'], $_POST['password']))
	{
		try
		{
			$user = $userManager->getByLogin($_POST['login']);
			if ($user->verifPassword($_POST['password']))
			{
				$_SESSION['id'] = $user->getId();
				$_SESSION['login'] = $user->getLogin();
				header('Location: message');
				exit;
			}
		}
		catch (Exception $e)
		{
			$error = $e->getMessage();
		}
	}
?>