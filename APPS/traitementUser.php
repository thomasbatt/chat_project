<?php
	$errors = array(
		'login' => '',
		'password' => '',
		'loginExiste' => '',
		'Create' => '',
		'connectionLogin' => '',
		'connectionPassword' => '',
		'connection' => ''
	);
	
	if (isset($_POST['action'])) 
	{
		$action = $_POST['action'];
		if ($action == 'register') 
		{
			if (isset($_POST['login'], $_POST['password1'], $_POST['password2'])) 
			{
				require('MODULE/USER/MODEL/User.class.php');
				require('MODULE/USER_MANAGER/MODEL/UserManager.class.php');
				$userManager = new UserManager($bdd);
				try
				{
					$userManager->create($_POST['login'], $_POST['password1'], $_POST['password2']);
				}
				catch(Exception $e)
				{
					$errors['loginExiste'] = $e->getMessage();
				}
			}
		}
		elseif ($action == 'login') 
		{
			if (isset($_POST['login'], $_POST['password'])) 
			{
				require('MODULE/USER/MODEL/User.class.php');
				require('MODULE/USER_MANAGER/MODEL/UserManager.class.php');
				$userManager = new UserManager($bdd);
				try
				{
					$user = $userManager->getByLogin($_POST['login']);
				}
				catch(Exception $e)
				{
					$errors['connect'] = $e->getMessage();
				}
				var_dump($user);
				$testreturn = $user->verifPassword($_POST['password']);
				$testget = $user->getHash();
				var_dump($testget);
				var_dump($testreturn);
			}
		}		
	}


	// require('MODULE/USER/MODEL/User.class.php');
	// require('MODULE/USER_MANAGER/MODEL/UserManager.class.php');
	// $userManager = new UserManager($bdd);
	// if (isset($_POST['login'], $_POST['password']))
	// {
	// 	try
	// 	{
	// 		$user = $userManager->getByLogin($_POST['login']);
	// 		if ($user->verifPassword($_POST['password']))
	// 		{
	// 			$_SESSION['id'] = $user->getId();
	// 			$_SESSION['login'] = $user->getLogin();
	// 			header('Location: message');
	// 			exit;
	// 		}
	// 	}
	// 	catch (Exception $e)
	// 	{
	// 		$error = $e->getMessage();
	// 	}
	// }
?>