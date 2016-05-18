#!/usr/bin/php

<?php

if ($argc != 2)
{
	echo "Incorrect Parameters\n";
	exit;
}

$ops = array("+", "-", "*", "/", "%");
foreach ($ops as $op) {
	if (strchr($argv[1], $op))
		do_op($argv[1], $op);

}
echo "Syntax Error\n";

function do_op($arg, $op)
{
	$array = explode($op, $arg);
	$num1 = trim($array[0]);
	$num2 = trim($array[1]);
	if (!is_numeric($num1) || !is_numeric($num2))
	{
		echo "Syntax Error\n";
		exit;

	}
	if ($op == '+')
		echo $num1 + $num2 . "\n";
	if ($op == '-')
		echo $num1 - $num2 . "\n";
	if ($op == '*')
		echo $num1 * $num2 . "\n";
	if ($op == '/')
		echo $num1 / $num2 . "\n";
	if ($op == '%')
		echo $num1 % $num2 . "\n";
	exit;
}

?>