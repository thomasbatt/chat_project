<?php
// require('MODULE/USER/MODEL/User.class.php');
// require('MODULE/USER/MODEL/UserManager.class.php');
$UserManager = new UserManager($bdd);
$users = $UserManager->getAll();
$count = 0;
while ( isset($users[$count]) )
{
	$login = $users[$count]->getlogin();
	require('MODULE/USER/VIEWS/user.phtml');
	$count++;
}	

?>