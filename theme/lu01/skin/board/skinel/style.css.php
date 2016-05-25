<?php
include_once "_common.php";
include_once "inc/inc.skinL.php";

header("Content-type: text/css; charset=utf-8"); 

$css = file_get_contents(dirname(__FILE__).'/style.css');
echo gp_do_filter('sl_css_style', $css);

?>
