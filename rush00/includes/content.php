<?php

$catab;
if (isset($_GET["categorie"])):
	$catab = getitems($_GET["categorie"]);
endif;

?>

<?php 
/* If there is no view, will show either categories or home
   ======================================================== */
if (!isset($_GET["view"])): 
/* ======================================================== */
?>

	<?php if (isset($_GET["categorie"]) && $_GET["categorie"] == "armes") { ?>

<div class="box cat catarmes">
	<div class="imgcat"></div>
	<p>Les meilleures armes de tout Tamriel sont ici. Khajits et amis ont parcouru les terres les plus sauvages pour vous procurer des objets de cette qualité.</p>
</div>
	<?php showitems($catab); ?>

	<?php } else if (isset($_GET["categorie"]) && $_GET["categorie"] == "armures") { ?>

<div class="box cat catarmures">
	<div class="imgcat"></div>
	<p>Les armures les plus résistantes de Bordeciel. Trolls, géants, crabes de vase, voleurs, vampires, loups-garous, et même dragons auront du mal à vaincre aventurier avec armures proposées par Khajit.</p>
</div>
	<?php showitems($catab); ?>

	<?php }	else if (isset($_GET["categorie"]) && $_GET["categorie"] == "consommables") { ?>

<div class="box cat catconsommables">
	<div class="imgcat"></div>
	<p>Mets raffinés, alcools délicats, potions en tous genre. Aventurier ne peut pas partir dans contrées sauvages sans provisions. Khajit garantit la fraicheur de ses produits.</p>
</div>
	<?php showitems($catab); ?>

	<?php } else { ?> 

<?php if (isset($_GET["msg"]) && $_GET["msg"] == "success"): ?>

<div class="box success">
<p>Commande passée avec succés, votre or a été encaissé et vos bien délivrés, Khajit vous souhaite adieu, et bonnes aventures.</p>
</div>

<?php else: ?>
	
<div class="box home">
<p>Khajit souhaite la bienvenue dans sa boutique. Aventurier trouvera les meilleurs biens de tout Bordeciel. Khajit possède les armes les plus meurtrières, les armures les plus tranchantes, les mets les plus délicieux, et les boissons les plus raffinées. Khajit souhaite une bonne transaction à aventurier.</p>
</div>
	
<?php endif; ?>
<div class="items">
	<a href="index.php?categorie=armes" class="box item armes">
		<div class="catitle">Armes</div>
		<div class="inner"></div>
	</a>
	<a href="index.php?categorie=armures" class="box item armures">
		<div class="catitle">Armures</div>
		<div class="inner"></div>
	</a>
	<a href="index.php?categorie=consommables" class="box item consommables">
		<div class="catitle">Consommables</div>
		<div class="inner"></div>
	</a>
</div>

<?php } 
/* If view is item, will show item details
   ======================================= */
elseif ($_GET["view"] == "item"): 

$itemdetails = getitem($_GET["item"]);
/* ======================================= */
?>


<?php if (!isset($_GET["item"])): ?>

<div class="box warning large">
	<p>Hmmm, aventurier n'a pas précisé a Khajit le bien qu'aventurier souhaitait consulter.</p>
</div>

<?php elseif ($itemdetails == FALSE): ?>

<div class="box warning large">
	<p>Désolé, Khajit ne possède pas l'article demandé par aventurier.</p>
</div>

<?php 

else: 

	showitem($itemdetails); 

endif; ?>

<?php
/* If view is login, will show login/create account form
   ===================================================== */
elseif ($_GET["view"] == "login"): 
/* ===================================================== */
?>

<?php if (isset($_GET["error"]) && $_GET["error"] == "missing_field"): ?>
<div class="box warning large">
	<p>Il semble que aventurier ait oublié des informations. Aventurier doit recommencer et vérifier qu'il a bien tout tapé comme il se doit.</p>
</div>
<?php elseif (isset($_GET["error"]) && $_GET["error"] == "invalid_account"): ?>
<div class="box warning large">
	<p>Il semble que aventurier ait fournit un mot de passe éronné ou que le compte n'existe pas. Aventurier doit recommencer et vérifier l'exactitude de son mot de passe. Si aventurier n'a pas de compte, aventurier peut créer compte dans formulaire suivant.</p>
</div>
<?php elseif (isset($_GET["error"]) && $_GET["error"] == "userexists"): ?>
<div class="box warning large">
	<p>Le nom d'utilisateur est déjà pris, veuillez choisir un autre nom.</p>
</div>
<?php elseif (isset($_GET["msg"]) && $_GET["msg"] == "createok"): ?>
<div class="box ok large">
	<p>Votre compte a été créé avec succès, vous pouvez vous connecter.</p>
</div>
<?php endif; ?>

<div class="box large login">
	<h3>Se connecter</h3>
	<form name="login.php" action="includes/login.php" method="post">
		<input type="text" name="login" placeholder="Identifiant">
		<input type="password" name="passwd" placeholder="Mot de passe">
		<input type="Submit" name="submit" value="Se connecter">
	</form>
</div>

<div class="box large login">
	<h3>Créer un compte</h3>
	<small>Tous les champs sont requis</small>
	<form name="create.php" action="includes/create.php" method="post">
		<input type="text" name="login" placeholder="Identifiant">
		<input type="password" name="passwd" placeholder="Mot de passe">
		<input type="text" name="email" placeholder="Adresse email">
		<input type="text" name="nom" placeholder="Nom">
		<input type="text" name="prenom" placeholder="Prémom">
		<input type="text" name="adresse" placeholder="Adresse">
		<input type="text" name="cp" placeholder="Code Postal">
		<input type="text" name="ville" placeholder="Ville">
		<input type="Submit" name="submit" value="Valider">
	</form>
</div>

<?php
/* If view is login, will show login/create account form
   ===================================================== */
elseif ($_GET["view"] == "edit"): 
/* ===================================================== */
?>

	<?php if (!isset($_SESSION["current_user"])): ?>
	<div class="box warning large">
		<p>Il semble que aventurier ne se soit pas identifié.</p>
	</div>
	<?php else:?>
	<div class="box large login">
		<h3>Se déconnecter</h3>
		<form name="logout.php" action="includes/logout.php" method="post">
			<input type="Submit" name="submit" value="Se déconnecter">
		</form>
	</div>

<?php if (isset($_GET["msg"]) && $_GET["msg"] == "modifok"): ?>

<div class="box success">
<p>Informations du compte changées avec succès.</p>
</div>

<?php elseif (isset($_GET["error"]) && $_GET["error"] == "missing_field"): ?>
<div class="box warning large">
	<p>Il semble que aventurier ait oublié des informations. Aventurier doit recommencer et vérifier qu'il a bien tout tapé comme il se doit.</p>
</div>
<?php elseif (isset($_GET["error"]) && $_GET["error"] == "wrongpass"): ?>
<div class="box warning large">
	<p>Il semble que aventurier ait fournit un mot de passe éronné.</p>
</div>

<?php endif; ?>

<?php 

$modifuser = getuser($_SESSION["current_user"]);

?>
	<div class="box large login">
		<h3>Modifier un compte</h3>
		<small>Tous les champs sont requis</small>
		<form name="modif.php" action="includes/modif.php" method="post">
			<input type="text" name="login" placeholder="Identifiant" value="<?php echo $modifuser["login"] ?>" readonly>
			<input type="password" name="oldpw" placeholder="Ancien mot de passe">
			<input type="password" name="newpw" placeholder="Nouveau mot de passe">
			<input type="text" name="email" placeholder="Adresse email" value="<?php echo $modifuser["email"] ?>">
			<input type="text" name="nom" placeholder="Nom" value="<?php echo $modifuser["nom"] ?>">
			<input type="text" name="prenom" placeholder="Prémom" value="<?php echo $modifuser["prenom"] ?>">
			<input type="text" name="adresse" placeholder="Adresse" value="<?php echo $modifuser["adresse"] ?>">
			<input type="text" name="cp" placeholder="Code Postal" value="<?php echo $modifuser["postal"] ?>">
			<input type="text" name="ville" placeholder="Ville" value="<?php echo $modifuser["ville"] ?>">
			<input type="Submit" name="submit" value="Valider">
		</form>
	</div>
	<?php endif;?>

<?php
/* If view is cart, will show cart content
   ======================================= */
elseif ($_GET["view"] == "panier"): 
/* ======================================= */
?>

<?php if(!isset($_SESSION["commande"])): ;
?>

<div class="box warning large">
	<p>Votre panier est vide</p>
</div>

<?php else: ?>

	<?php if(isset($_GET["error"]) && $_GET["error"] == "quantitenulle"): ?>

<div class="box warning large">
	<p>Vous n'avez pas choisi de quantité pour votre sélection</p>
</div>

	<?php endif; ?>

	<?php if(isset($_GET["error"]) && $_GET["error"] == "quantitemaj"): ?>

<div class="box ok large">
	<p>Quantité mise a jour.</p>
</div>

	<?php endif; ?>

	<?php if(isset($_GET["error"]) && $_GET["error"] == "nostock"): ?>

<div class="box warning large">
	<p>La quantité souhaitée est plus grande que le stock de l'objet.</p>
</div>

	<?php endif; ?>
	
	<div class="box large">
		<h2>Votre panier</h2>
	<?php 
	
	$totalcommande;
	foreach($_SESSION["commande"] as $item) {
		
	$itemdetails = getitem($item["id"]);
	$orderprix = $item["quantite"] * $itemdetails["prix"];
	$totalcommande += $orderprix;
		
	?>
		<div class="orderitem clearfix">
			<div class="orderquantite"><?php echo $item["quantite"] ;?></div>
			<div class="ordername"><?php echo $itemdetails["nom"] ;?></div>
			<div class="orderprix"><?php echo $orderprix ;?> or</div>
		</div>
	<?php } ?>
		<div class="total">Total : <strong><?php echo $totalcommande ;?> or</strong></div>
		
	</div>

<?php if(isset($_SESSION["current_user"])): ?>

	<div class="box login large">
		<p>Si aventurier valide la commande, aventurier s'engage a donner le montant demandé à Khajit, et Khajit livrera les biens à aventurier.</p>
		<form action="includes/validation.php" method="post">
			<input type="submit" name="submit" value="Valider la commande">
		</form>
	</div>

<?php endif; ?>

	<?php if (!isset($_SESSION["current_user"])): ?>
	<div class="box warning large">
		<p>Vous devez <a href="index.php?view=login">créer un compte</a> pour valider votre commande.</p>
	</div>
	<?php endif; ?>

<?php endif; ?>

	


<?php endif; ?>