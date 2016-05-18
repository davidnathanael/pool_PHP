#!/usr/bin/php

<?php
if ($argc < 3)
	exit;

$array = array_slice($argv, 2);
$to_find = $argv[1];
foreach ($array as $pair) {
	$key = explode(":", $pair)[0];
	$value = explode(":", $pair)[1];
	if ($to_find == $key)
		$found = $value;
}
if (isset($found))
	echo "$found\n";
?>