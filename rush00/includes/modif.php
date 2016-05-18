<?php

session_start();
include('functions.php');



if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['email'] && $_POST['nom'] && $_POST['prenom'] && $_POST['adresse'] && $_POST['cp'] && $_POST['ville'])
{
	if (auth($_POST['login'], $_POST['oldpw']))
	{
		$login = $_POST["login"];
		$file = '../db/users';
		$user = array(
			'login' => htmlspecialchars($_POST["login"]),
			'passwd' => hash('whirlpool',$_POST["newpw"]),
			'email' => htmlspecialchars($_POST["email"]),
			'nom' => htmlspecialchars($_POST["nom"]),
			'prenom' => htmlspecialchars($_POST["prenom"]),
			'adresse' => htmlspecialchars($_POST["adresse"]),
			'postal' => htmlspecialchars($_POST["cp"]),
			'ville' => htmlspecialchars($_POST["ville"]),
			'role' => 'user'
		);

		$ok;
		$content = file_get_contents($file);
		$tabusers = unserialize($content);
		foreach ($tabusers as &$singleuser)
		{
			if ($singleuser["login"] == $_POST["login"])
			{
				$singleuser = $user;
				$ok = 1;
			}
		}
		if ($ok == 1)
		{
			file_put_contents($file, serialize($tabusers));
			header("Location: ../index.php?view=edit&msg=modifok");
		}	
		else
			header("Location: ../index.php?view=edit&err=wrong");
	}
	else
		header("Location: ../index.php?view=edit&error=wrongpass");
}
else
	header("Location: ../index.php?view=edit&error=missing_field");
?>