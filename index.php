<?php

// var_dump($_GET);
// var_dump($_POST);
// var_dump($_SESSION);
// exit;

spl_autoload_register(function($class)
{
    $accessClass = [
    	'User' => 'MODULE/USER/MODEL/'.$class.'.class.php',
    	'UserManager' => 'MODULE/USER/MODEL/'.$class.'.class.php', 
    	'Message' => 'MODULE/MESSAGE/MODEL/'.$class.'.class.php',
    	'MessageManager' => 'MODULE/MESSAGE/MODEL/'.$class.'.class.php', 
    ];
    require($accessClass[$class]);
});

session_start();

$page = 'home';

require('APPS/listeErrors.php');
require('config.php');

try
{

    // $bdd = new PDO('mysql:dbname='.$config['bdd'].';host='.$config['host'].'', ''.$config['login'].'', ''.$config['password'].'');
    $bdd = new PDO('mysql:dbname=tchat_object;host=192.168.1.7', 'root', 'troiswa');
}
catch (PDOException $e)
{
    $error = 'Erreur interne';
}

if (isset($_SESSION['id']))
{
	$page = 'home';
	$access = ['home' , 'message', 'profil' ];
	$ajax = [
		'listeMessage'=>'MODULE/MESSAGE/APPS/listeMessage.php',
		'footer'=>'APPS/footer.php'
	];
}
else
{
	$page = 'home';
	$access = ['home'];
	$ajax = [];
}
if (isset($_GET['page']))
{
	if (in_array($_GET['page'], $access ))
		$page = $_GET['page'];
	elseif (isset($ajax[$_GET['page']])) {
		$page = $ajax[$_GET['page']];
	}
	else
	{
		header('Location: '.$page);
		exit;
	}
}

$traitement_action = [
	'register' => 'User',
	'login' => 'User',
	'logout' => 'User',
	'information' => 'User',
	'create_message' => 'Message',
];

if (isset($_POST['action'])) 
{
	$action = $_POST['action'];
	if (isset($traitement_action[$action])) 
	{
		$value = $traitement_action[$action];
		require('APPS/traitement'.$value.'.php');
	}
}

if (!isset($_GET['ajax']))
	require('APPS/skel.php');
else
	require($page);
	// if (in_array($_GET['page'], $ajax ))
	// {
	// 	$page = $_GET['page'];

	// 	$accessAjax = [
 //    		'listeMessage' => 'MODULE/MESSAGE/APPS/'.$page.'.php',
 //    		'footer' => 'APPS/'.$page.'.php',
 //    	];
 //    	require($accessAjax[$page]);
 //    }
?>