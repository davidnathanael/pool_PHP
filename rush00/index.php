<?php

session_start();
date_default_timezone_set ('Europe/Paris');	
require_once('includes/functions.php');

?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Khajit Wares</title>
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no"> 
	<meta name="description" content="Khajit has wares, if you have coins">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700italic,700,300italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	
</head>
<body>
	<header>
		<div class="title clearfix">
			<h1><a href="index.php">Khajit Wares</a></h1>
			<h2>Khajit has wares, if you have coin</h2>
		</div>
		
		<div class="khajit"></div>
	</header>
	
	<nav id="menu">
		<a href="index.php" title="Accueil" class="home"><i class="fa fa-home"></i><span>Accueil</span></a>
		<div class="parent">
			<div class="articles"><i class="fa fa-bars"></i><span>Articles</span></div>
			<div class="children">
				<a href="index.php?categorie=armes" class="armes">Armes</a>
				<a href="index.php?categorie=armures" class="armures">Armures</a>
				<a href="index.php?categorie=consommables" class="consommables">Consommables</a>
			</div>
		</div>
		
		<?php if (!isset($_SESSION["current_user"])): ?>
		
		<a href="index.php?view=login" title="Se Connecter / Créer un Compte" class="login"><i class="fa fa-user"></i><span>Se Connecter / Créer un Compte</span></a>
		
		<?php else: ?>
		
		<a href="index.php?view=edit" title="Consulter votre compte" class="login"><i class="fa fa-user"></i><span>Votre Compte</span></a>
		
		<?php endif;?>
		
		<a href="index.php?view=panier" class="cart" title="Voir le Panier"><i class="fa fa-shopping-basket"></i><span>Panier</span></a>
	</nav>
	<main>
		<div class="wrapper clearfix">
			<?php include("includes/content.php"); ?>
		</div>
	</main>
	
	<footer>
		<div class="wrapper">
			<small>© <?php echo date("Y");?> Merchants Guild</small>
		</div>
	</footer>
	
</body>
</html>