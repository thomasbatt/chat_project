<?php
if (isset($_SESSION['id'], $_SESSION['login'])) 
	require('VIEWS/headerConnect.phtml');	
else 
	require('VIEWS/header.phtml');
?>