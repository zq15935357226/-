<?php
/*
 * 用途：
 * 作者：feb1234@163.com
 * 时间：2015-11-19
 * */
$base_dir = dirname(__FILE__).'/../../';
require_once($base_dir.'inc/init.php');
require_once($base_dir.'inc/func.php');
require_once($base_dir.'config/config.php');


$_SESSION['auid'] = 0;

GotoUrl('/index.php');
?>
