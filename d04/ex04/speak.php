<?php

session_start();

function	insert_message($messages, $login, $message, $file)
{
	date_default_timezone_set('Europe/Paris');
	$new_message = array('login' => $login, 'time' => time(), 'msg' => $message);
	if ($messages[0] === FALSE)
		$messages[0] = $new_message;
	else
		$messages[] = $new_message;

	// $fp  = fopen($file, "w+");
	// if (flock($fp, LOCK_EX))
	// {
		file_put_contents($file, serialize((array)$messages));
		// flock($fp, LOCK_UN);
	// }
}

function	create_file($file)
{
	$dir = '../private';
	if (!file_exists($dir))
		mkdir($dir);
	if (!file_exists($file))
		file_put_contents($file, "");
}

function store_message($login, $message)
{
	$file = '../private/chat';
	create_file($file);

	// $fp  = fopen($file, "r+");
	// if (flock($fp, LOCK_EX))
	// {
		$messages = (array)unserialize(file_get_contents($file));
	// 	flock($fp, LOCK_UN);
	// }
	insert_message($messages, $login, $message, $file);
}

if ($_SESSION['loggued_on_user'] && $_SESSION['loggued_on_user'] !== "")
{
	if ($_POST['msg'])
		store_message($_SESSION['loggued_on_user'], $_POST['msg']);
?>
<html>
<head>
	<meta charset="utf-8">
	<script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
</head>

<body>
	<form action="" method="post">
		<input type="text" name="msg"/>
		<input type="submit" value="Envoyer"/>
	</form>
</body>
</html>
<?php
}
else
	echo "ERROR\n";
?>
