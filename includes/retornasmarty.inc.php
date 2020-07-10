<?php
define('SMARTY_RESOURCE_CHAR_SET', 'ISO-8859-1');
require_once ('/usr/local/lib/php/smarty/libs/Smarty.class.php');

function retornaSmarty() {
	$smarty = new Smarty();
	$smarty->template_dir = "templates/tpl";
	$smarty->compile_dir = "templates/tplc";
	$smarty->cache_dir = "templates/tplcache";
//	$smarty->config_dir = "templates/configs";
//	$smarty->plugins_dir = "smarty/plugins";
	return $smarty;
}
?>
