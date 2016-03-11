<?php
$MessageManager = new MessageManager($bdd);
$messages = $MessageManager->getAll(10);
$count = sizeof($messages)-1;
while ( isset($messages[$count]) )
{
	$message = $messages[$count];
	require('MODULE/MESSAGE/VIEWS/listeMessage.phtml');
	$count--;
}	
?>