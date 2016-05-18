<?php

session_start();
include('functions.php');

if ($_POST['login'] && $_POST['passwd'])
{
	if (auth($_POST['login'], $_POST['passwd']))
	{
		$_SESSION['current_user'] = $_POST['login'];
		header("Location: ../index.php");
	}
	else
		header("Location: ../index.php?view=login&error=invalid_account");
}
else
	header("Location: ../index.php?view=login&error=missing_field");
?>