<?php

function	init_users()
{
	$file = 'db/users';
	if (!file_exists($file))
		fopen($file, 'w');
	$user1 = [
		'login' => 'admin',
		'passwd' => hash('whirlpool', 'admin'),
		'nom' => 'Dupont',
		'prenom' => 'Jean',
		'adresse' => '96 Bd Bessieres',
		'postal' => '75017',
		'ville' => 'Paris',
		'email' => 'xxxxxx@42.fr',
		'role' => 'admin'
	];

	$users = array($user1, $user2, $user3);

	file_put_contents($file, serialize($users));
}


function	init_items()
{
	$file = 'db/items';
	if (!file_exists($file))
		fopen($file, 'w');
	$arme1 = [
		'id' => 'fleche-fer',
		'nom' => 'Flèches en fer',
		'stock' => 100,
		'image' => 'img/armes/fleches_en_fer.png',
		'categorie' => array('armes'),
		'description' => "Avec ces flèches en fer de qualité, attaquez vos ennemis depuis de grandes distances avant qu'il ne réalisent ce qu'il se passe.",
		'prix' => 20,
	];
	$arme2 = [
		'id' => 'grande-epee',
		'nom' => 'Grande épee en verre',
		'stock' => 4,
		'image' => 'img/armes/grande-epee-verre-2mains.png',
		'categorie' => array('armes'),
		'description' => 'Une grande épée en verre pour combattre avec délicatesse',
		'prix' => 950,
	];
	$armorset = [
		'id' => 'set-dwemer',
		'nom' => 'Set Dwemer complet',
		'stock' => 1,
		'image' => 'img/setdwemer.png',
		'categorie' => array('armes','armures'),
		'description' => 'Ce set contient une armures complète, une épée et un bouclier',
		'prix' => 10000,
	];
	$armure1 = [
		'id' => 'cuirasse-verre',
		'nom' => 'Cuirasse en verre',
		'stock' => 10,
		'image' => 'img/armures/cuirasse_verre.png',
		'categorie' => array('armures'),
		'description' => 'Une cuirasse en verre pour se protéger tout en ayant un certain prestige',
		'prix' => 1450,
	];
	$armure2 = [
		'id' => 'heaume-dwemer',
		'nom' => 'Heaume Dwemer',
		'stock' => 10,
		'image' => 'img/armures/heaume_dwemer.png',
		'categorie' => array('armures'),
		'description' => 'Une jolie boite de conserve pour protéger la tête',
		'prix' => 1120,
	];
	$cons1 = [
		'id' => 'chou',
		'nom' => 'Chou',
		'stock' => 10,
		'image' => 'img/consommables/chou.png',
		'categorie' => array('consommables'),
		'description' => 'Heals',
		'prix' => 30,
	];
	$cons2 = [
		'id' => 'hydromel',
		'nom' => 'Hydromel',
		'stock' => 10,
		'image' => 'img/consommables/hydromel.png',
		'categorie' => array('consommables'),
		'description' => 'Heals',
		'prix' => 30,
	];


	$items = array($arme1, $arme2, $armure1, $armure2, $cons1, $cons2, $armorset);
	file_put_contents($file, serialize($items));
}

init_users();
init_items();

?>