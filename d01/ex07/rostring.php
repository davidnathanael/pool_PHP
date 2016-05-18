#!/usr/bin/php

<?php

if ($argc > 1)
{
	$str = preg_replace('/\s+/', ' ', $argv[1]);
	$array = explode(" ", $str);
	$array[] = $array[0];
	array_shift($array);
	$str = implode(" ", $array);
	echo $str;
}

?>