<?php
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
$smarty = retornaSmarty();
$smarty->display("expirou.tpl");
?>
