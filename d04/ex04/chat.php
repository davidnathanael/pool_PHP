<?php

function	print_line($msg)
{
	date_default_timezone_set('Europe/Paris');
	$time = date("H:i", $msg['time']);

	echo "[" . $time . "] ";
	echo "<b>".$msg['login'] . "</b>:";
	echo $msg['msg'] . "<br />\n";
}

function	show_messages()
{
	$file = '../private/chat';

	if (!file_exists($file))
		exit;
	$messages = (array)unserialize(file_get_contents($file));
	if ($messages[0] !== NULL)
	{
		foreach ($messages as $msg)
			print_line($msg);
		
	}
}

show_messages();

?>
