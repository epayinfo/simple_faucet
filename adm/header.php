<?php
session_start();
ob_start();
if(!isset($_SESSION['admin_loged']) && basename($_SERVER['PHP_SELF'])!='login.php'){
	header( 'Location: login.php');
	die();
}else if(isset($_SESSION['admin_loged']) && basename($_SERVER['PHP_SELF'])=='login.php'){
	header( 'Location: index.php');
	die();
}

require_once "../configs/dbinfo.php";
require_once "../includes/dbconnector.class.php";
require_once "../includes/function.php";
$db=new DbConnector;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>Adminstration</title>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>





<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

<?php if(isset($_SESSION['admin_loged'])){ ?>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Dashboard</a></li>
		<li><a href="user.php">Users</a></li>
		<li><a href="ads.php">Ads</a></li>
		<li><a href="setting.php">Settings</a></li>
		<li><a href="prize.php">Prizes</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?a=logout">Logout</a></li>
      </ul>
	  
    </div>
	<?php } ?>  
  </div>
</nav>

<div class="container">