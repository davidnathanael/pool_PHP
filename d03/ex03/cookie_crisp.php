<?php

if (($_GET['action']) && ($_GET['name']))
{
	$action = $_GET['action'];
	$name = $_GET['name'];

	if ($action == 'set' && ($_GET['value']))
		setcookie($name, $_GET['value']);
	else if ($action == 'get')
	{
		if (($_COOKIE[$name]))
			echo $_COOKIE[$name] . "\n";
	}
	else if ($action == 'del')
		setcookie ($name, $_COOKIE[$name], time() - 3600);
}

?>