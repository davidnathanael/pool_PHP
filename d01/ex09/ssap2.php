#!/usr/bin/php

<?php

function	ft_split($str)
{
	$str = preg_replace('/\s+/', ' ',$str);
	$array = explode(" ", trim($str));
	sort($array, SORT_STRING | SORT_FLAG_CASE);
	return $array;
}

if ($argc > 1)
{
	$args = array_slice($argv, 1);
	$args = ft_split(implode(" ", $args));
	$array = NULL;
	foreach ($args as $arg) {
		if (ctype_alpha($arg))
			$array[] = $arg;
	}
	foreach ($args as $arg) {
		if (ctype_digit($arg))
			$array[] = $arg;
	}
	foreach ($args as $arg) {
		if (!ctype_alpha($arg) && !ctype_digit($arg))
			$array[] = $arg;
	}
	foreach ($array as $arg) {
		echo $arg. "\n";
	}
}


?>