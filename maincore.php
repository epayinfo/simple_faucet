<?php
session_start();
ob_start();
ini_set('display_errors', 1);

/*** Includes ***/
require_once "configs/dbinfo.php";

if( !class_exists('SystemComponent') )
	header('Location: install.php');

require_once "includes/dbconnector.class.php";
require_once "includes/function.php";
require_once "includes/solvemedialib.php";
require_once "includes/recaptchalib.php";
require_once "includes/antibotlinks.php";
require_once "includes/csrf.class.php";
require_once "includes/webservice.php";

require_once "configs/configs.php";
require_once "configs/prizes.php";
/*** Includes ***/

$db=new DbConnector;
$db2=new DbConnector;
$csrf=new csrf();

$now=time();
$ver='1.3.1';

if(isset($_SERVER['HTTP_CF_CONNECTING_IP'])){
	$ip=sprintf("%u",ip2long($_SERVER['HTTP_CF_CONNECTING_IP'])); // Only if using cloudflare
}else{
	$ipAddress = $_SERVER['REMOTE_ADDR'];
//	if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))
	//	$ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
	$ip=sprintf("%u",ip2long($ipAddress));
}
?>