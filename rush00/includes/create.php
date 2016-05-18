<?php

session_start();
include('functions.php');

if ($_POST['login'] && $_POST['passwd'] && $_POST['email'] && $_POST['nom'] && $_POST['prenom'] && $_POST['adresse'] && $_POST['cp'] && $_POST['ville'])
{
	$login = $_POST["login"];
	$file = '../db/users';
	$users = array();
	$user = array(
		'login' => htmlspecialchars($_POST["login"]),
		'passwd' => hash('whirlpool',$_POST["passwd"]),
		'email' => htmlspecialchars($_POST["email"]),
		'nom' => htmlspecialchars($_POST["nom"]),
		'prenom' => htmlspecialchars($_POST["prenom"]),
		'adresse' => htmlspecialchars($_POST["adresse"]),
		'postal' => htmlspecialchars($_POST["cp"]),
		'ville' => htmlspecialchars($_POST["ville"]),
		'role' => 'user'
	);
	array_push($users, $user);
	
	err;
	if (!file_exists($file))
	{
		file_put_contents($file, serialize($users));
		header("Location: ../index.php?view=login&msg=createok");
	}
	else
	{
		$content = file_get_contents($file);
		if (empty($content))
		{
			file_put_contents($file, serialize($users));
			header("Location: ../index.php?view=login&msg=createok");
		}
		else
		{
			$tabusers = unserialize($content);
			foreach ($tabusers as $singleuser)
			{
				if ($singleuser["login"] == $login)
					$err = 1;
			}
			if ($err == 1)
				header("Location: ../index.php?view=login&error=userexists");
			else
			{
				header("Location: ../index.php?view=login&msg=createok");
				array_push($tabusers, $user);
				file_put_contents($file, serialize($tabusers));
			}
		}
	}
}
else
	header("Location: ../index.php?view=login&error=missing_field");
?>