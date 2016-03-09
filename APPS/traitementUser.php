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

/******************************** REGISTER **************************************************
********************************************************************************************/
		if ($action == 'register') 
		{
			if (isset($_POST['login'], $_POST['password1'], $_POST['password2'])) 
			{
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
/******************************** LOGIN *****************************************************
********************************************************************************************/
		elseif ($action == 'login') 
		{
			if (isset($_POST['login'], $_POST['password'])) 
			{
				$userManager = new UserManager($bdd);
				try
				{
					$user = $userManager->getConnect($_POST['login'], $_POST['password']);
					if ($user) {
						$_SESSION['id'] = $user->getId();
						$_SESSION['login'] = $user->getLogin();
						$_SESSION['admin'] = $user->isAdmin();
						header('Location: message');
						exit;
					}
				}
				catch(Exception $e)
				{
					$errors['connect'] = $e->getMessage();
				}
			}
		}
/******************************** LOGOUT ****************************************************
********************************************************************************************/
		elseif ($action == 'logout') 
		{
			session_destroy();
			header('Location: home');
			exit;
		}		
	}
?>