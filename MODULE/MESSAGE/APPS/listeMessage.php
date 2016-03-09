<?php
$MessageManager = new MessageManager($bdd);
$messages = $MessageManager->getAll();
$count = 0;
while ( isset($messages[$count]) )
{
	$message = $messages[$count];
	require('MODULE/MESSAGE/VIEWS/listeMessage.phtml');
	$count++;
}	
?>