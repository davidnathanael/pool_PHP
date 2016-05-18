<?php

if (!$_SERVER['PHP_AUTH_USER']) {
    header('WWW-Authenticate: Basic realm="Espace membres"');
}
if ($_SERVER['PHP_AUTH_USER'] == 'zaz' && $_SERVER['PHP_AUTH_PW'] == 'jaimelespetitsponeys')
{
	$img = base64_encode(file_get_contents("../img/42.png"));
?>
<html><body>
Bonjour Zaz<br />
<img src='data:image/png;base64,<?php echo $img; ?>'>
</body></html>
<?php
}
else{
    header('HTTP/1.0 401 Unauthorized');
	header('Content-Type: text/html');
    header('X-Powered-By: PHP/5.4.26');
    header('WWW-Authenticate: Basic realm="Espace membres"');
    echo "<html><body>Cette zone est accessible uniquement aux membres du site</body></html>\n";
}
?>
