#!/usr/bin/php

<?php

if ($argc == 4)
{
	$num1 = trim($argv[1]);
	$op = trim($argv[2]);
	$num2 = trim($argv[3]);

	switch ($op) {
		case '+':
			echo $num1 + $num2;
			break;
		case '-':
			echo $num1 - $num2;
			break;
		case '*':
			echo $num1 * $num2;
			break;
		case '/':
			echo $num1 / $num2;
			break;
		case '%':
			echo $num1 % $num2;
			break;
		default:
			break;
	}
	echo "\n";
}
else
	echo "Incorrect Parameters\n"

?>