<?php

function checkcat($itemid, $categorie)
{
	$file = '../db/items';
	if (!file_exists($file))
		return FALSE;
	$tabitems = unserialize(file_get_contents($file));
	foreach ($tabitems as $item)
	{	
		if ($item['id'] == $itemid):
			foreach ($item['categorie'] as $cat)
			{
				if ($categorie == $cat)
					return TRUE;
			}
		endif;
	}
	return FALSE;
}


/* Check if password match for user
   ================================ */
function auth($login, $passwd)
{
	$ok;
	$file = '../db/users';
	if (!file_exists($file))
		return FALSE;
	$tabusers = unserialize(file_get_contents($file));
	if (!is_array($tabusers))
		return FALSE;
	foreach ($tabusers as $singleuser)
	{
		if ($singleuser["login"] == $login && $singleuser["passwd"] == hash('whirlpool',$passwd))
			$ok = 1;
	}
	if ($ok == 1)
		return TRUE;
	else
		return FALSE;
}

/* Check if user is admin
   ====================== */

function isadmin($login)
{
	$ok;
	$file = '../db/users';
	if (!file_exists($file))
		return FALSE;
	$tabusers = unserialize(file_get_contents($file));
	foreach ($tabusers as &$singleuser)
	{	
		if ($singleuser["login"] == $login && $singleuser["role"] == "admin")
			$ok = 1;
	}
	if ($ok == 1)
		return TRUE;
	else
		return FALSE;
}

/* Get items from category and return in array
   =========================================== */

function getitems($categorie)
{
	$ok;
	$file = 'db/items';
	if (!file_exists($file))
		return FALSE;
	$ret = array();
	$tabitems = unserialize(file_get_contents($file));
	foreach ($tabitems as $item)
	{	
		foreach ($item['categorie'] as $cat)
		{
			if ($cat == $categorie) {
				array_push($ret, $item);
				$ok = 1;
			}
		}
	}
	if ($ok == 1)
		return $ret;
	else
		return FALSE;
}

/* Display items from an array in HTML
   =================================== */

function showitems($list)
{
	foreach($list as $item)
	{ ?>

<a href="index.php?view=item&item=<?php echo $item["id"];?>" class="box item catitem cat<?php echo $item["categorie"] ;?>" id="<?php echo $item["id"];?>">
	<div class="prix"><?php echo $item["prix"]; ?></div>
	<div class="itemimage" style="background-image:url(<?php echo $item["image"]; ?>)"></div>
	<div class="catitle"><?php echo $item["nom"]; ?></div>
	<div class="inner"></div>
</a>

<?php }
}

/* Get Item and store in array
   =========================== */

function getitem($itemid)
{
	$file = 'db/items';
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

/* Get user and store in array
   =========================== */

function getuser($user)
{
	$file = 'db/users';
	if (!file_exists($file))
		return FALSE;
	$tabitems = unserialize(file_get_contents($file));
	foreach ($tabitems as $item)
	{	
		if ($item['login'] == $user)
			return $item;
	}
	return FALSE;
}

/* Displau item details
   ==================== */

function showitem($itemdetails)
{
?>

<div class="box itemdetails large" id="<?php echo $itemdetails['id'] ;?>">
	<h2><?php echo $itemdetails['nom'] ;?></h2>
	<p><?php echo $itemdetails['description'] ;?></p>
	<p class="prix"><strong>Prix unitaire :</strong> <?php echo $itemdetails['prix'] ;?> or</p>
	<?php if ($itemdetails['stock'] == 0): ?>
		<p class="stock warning">Rupture de stock</p>
	<?php else: ?>
		<p class="stock"><strong>Stock :</strong> <?php echo $itemdetails['stock'] ;?></p>
		<form name="order" action="includes/order.php" method="post">
			<label for="quantite">Quantité désirée</label>
			<input id="quantite" type="number" name="quantite" min="1" max="<?php echo $itemdetails['stock'] ;?>" value="1">
			<input type="hidden" name="id" value="<?php echo $itemdetails['id'] ;?>" readonly>
			<input type="submit" name="submit" value="Ajouter au panier">
		</form>
	<?php endif; ?>
</div>

<?php
}

/* Check stock of item
   =================== */

function stockok($itemid , $quantite)
{
	$file = '../db/items';
	if (!file_exists($file))
		return FALSE;
	$tabitems = unserialize(file_get_contents($file));
	foreach ($tabitems as $item)
	{	
		if ($item['id'] == $itemid):
			if ($quantite > $item['stock'])
				return FALSE;
			else
				return TRUE;
		endif;
	}
}



?>