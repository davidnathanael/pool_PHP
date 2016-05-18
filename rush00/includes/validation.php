<?php

session_start();
require_once('functions.php');
date_default_timezone_set("Europe/Paris"); 

function getitem2($itemid)
{
	$file = '../db/items';
	if (!file_exists($file))
		return FALSE;
	$tabitems = unserialize(file_get_contents($file));
	foreach ($tabitems as $item)
	{	
		if ($item['id'] == $itemid)
			return $item;
	}
	return FALSE;
}

$file = '../db/archive';

if (!file_exists($file))
	fopen($file, 'w');

$content = file_get_contents($file);
if ($content == "")
	$archives = array();
else
	$archives = unserialize($content);
$totalcommande;
$achats = array();

foreach($_SESSION['commande'] as $item)
{
	$itemdetails = getitem2($item["id"]);
	$orderprix = $item["quantite"] * $itemdetails["prix"];
	$totalcommande += $orderprix;
	$achat = array(
		'id' => $itemdetails["nom"],
		'quantite' => $item['quantite'],
		'prix' => ($itemdetails["prix"] * $item['quantite'])
	);
	array_push($achats, $achat);
}

$archive = array(
	'date' => time(),
	'login' => $_SESSION["current_user"],
	'achats' => $achats,
	'total' => $totalcommande
);
array_push($archives, $archive);

$list = '../db/items';
$contentlist = file_get_contents($list);
$listtab = unserialize($contentlist);

foreach($_SESSION['commande'] as $item)
{
	foreach($listtab as &$obj)
	{
		if ($obj["id"] == $item["id"])
			$obj["stock"] -= $item["quantite"];
	}
}
file_put_contents($list, serialize($listtab));


file_put_contents($file, serialize($archives));
unset($_SESSION['commande']);
header("Location: ../index.php?msg=success");

?>