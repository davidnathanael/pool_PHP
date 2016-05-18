#!/usr/bin/php

<?php

if ($argc > 1)
{
	$array = array_slice($argv, 1);
	$str = implode(" ", $array);
	$array = ft_split($str);
	foreach ($array as $arg)
	{
		echo $arg ."\n";
	}	
}

function	ft_split($str)
{
	$str = preg_replace('/\s+/', ' ',$str);
	$array = explode(" ", trim($str));
	sort($array);
	return $array;
}

?>