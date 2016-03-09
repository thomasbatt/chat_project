<?php
$MessageManager = new MessageManager($db);
$messages = $MessageManager->getAll();
$count = 0;
while ( isset($messages[$count]) )
{
	$IdUser = $messages[$count]->getIdUser();
	$content = $messages[$count]->getContent();
	require('MODULE/MESSAGE/VIEWS/listeMessage.phtml');
	$count++;
}	
?>