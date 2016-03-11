<?php
$MessageManager = new MessageManager($db);
$messages = $MessageManager->getAll(10);
$count = sizeof($messages)-1;
while ( isset($messages[$count]) )
{
	$message = $messages[$count];
	$date = date( "H:i" , strtotime($message->getCreateDate()));
	if( $message->getUser()->getId() == $_SESSION['id'] )
		require('MODULE/MESSAGE/VIEWS/MessageConnect.phtml');		
	else
		require('MODULE/MESSAGE/VIEWS/Message.phtml');
	$count--;
}	
?>