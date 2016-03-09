<?php
$MessageManager = new MessageManager($db);
$messages = $MessageManager->getAll();
$count = 0;
while ( isset($messages[$count]) )
{
	$message = $messages[$count];
	require('MODULE/MESSAGE/VIEWS/listeMessage.phtml');
	$count++;
}	
?>