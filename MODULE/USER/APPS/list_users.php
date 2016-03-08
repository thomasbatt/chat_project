<?php
require('MODULE/USER/MODEL/User.class.php');
require('MODULE/USER/MODEL/UserManager.class.php');
$UserManager = new UserManager($db);
$id = '1';
while( $UserManager->getById($id) )
{
	$user = $UserManager->getById($id);
	$login = $user->getLogin();
	require('MODULE/USER/VIEWS/user.phtml');
	$id++;
}
?>