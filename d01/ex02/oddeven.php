#!/usr/bin/php

<?php

$handle = @fopen("php://stdin", "r");
if ($handle) {
    while (ask() && ($line = fgets($handle, 4096)) !== false) {
    	$line = trim($line);
		if($line == null || is_numeric($line) == FALSE)
		    echo "'". $line ."' n'est pas un chiffre\n";
		else if($line % 2 == 0)
		    echo "Le chiffre ". $line ." est Pair\n";
		else if($line % 2 == 1 || $line % 2 == -1)
		    echo "Le chiffre ". $line ." est Impair\n";
		else
		    echo "'". $line ."' n'est pas un chiffre\n";
    }
    fclose($handle);
}

function ask()
{
	echo "Entrez un nombre : ";
	return TRUE;
}
?>

?>