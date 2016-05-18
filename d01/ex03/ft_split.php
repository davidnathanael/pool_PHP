#!/usr/bin/php

<?php

function	ft_split($str)
{
	$str = preg_replace('/\s+/', ' ',$str);
	$array = explode(" ", trim($str));
	sort($array);
	return $array;
}

?>