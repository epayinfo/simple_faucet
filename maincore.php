<?php
session_start();
ob_start();

/*** Includes ***/
require_once "configs/dbinfo.php";

if( !class_exists('SystemComponent') )
	header('Location: install.php');



require_once "includes/dbconnector.class.php";
require_once "includes/smarty/Smarty.class.php";
require_once "includes/function.php";
require_once "includes/solvemedialib.php";
require_once "configs/configs.php";
require_once "configs/prizes.php";
/*** Includes ***/
$now=time();
$apiurl='http://api.epay.info/?wsdl';
//$apiurl='http://localhost:81/epay/api/?wsdl';

/***** ADS ****/
$ads_left=file_get_contents('ads/left.php');
$ads_main_top=file_get_contents('ads/top.php');
$ads_right=file_get_contents('ads/right.php');
$ads_1=file_get_contents('ads/ad1.php');
$ads_2=file_get_contents('ads/ad2.php');
$ads_main_bottom=file_get_contents('ads/bottom.php');
/***** ADS ****/
$smarty->assign('footer',$footer);
?>