<?php

function	auth($login, $passwd)
{
	$file = '../private/passwd';
	$hashed = hash('whirlpool', $passwd);

	$accounts = (array)unserialize(file_get_contents($file));
	foreach ($accounts as $account) {
		if ($account['login'] === $login
		&&	$account['passwd'] === $hashed)
			return TRUE;
	}
	return FALSE;
}

?>