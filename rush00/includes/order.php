<?php
session_start();

require_once('functions.php');

$idexist;
if (isset($_POST["quantite"])){
	if (!isset($_SESSION["commande"]))
		$_SESSION["commande"] = array();
	if (stockok($_POST['id'],$_POST['quantite']) == FALSE):
		header("Location: ../index.php?view=panier&error=nostock");
	elseif (isset($_POST['id']) && isset($_POST['quantite'])):
		foreach($_SESSION["commande"] as &$item)
		{
			if ($item["id"] == $_POST["id"])
			{
				$item['quantite'] = $_POST["quantite"];
				$idexist = 1;
			}
		}
		if ($idexist == 1):
			header("Location: ../index.php?view=panier&error=quantitemaj");
		else:
			$order = array('id' => $_POST['id'], 'quantite' => $_POST['quantite']);
			array_push($_SESSION["commande"], $order);
			header("Location: ../index.php?view=panier");
		endif;
	else:
		header("Location: ../index.php?view=quantitenulle");
	endif;
} else {
	header("Location: ../index.php?view=panier&error=quantitenulle");
}
?>