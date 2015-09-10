<?php
session_start();
ob_start();
if(!isset($_SESSION['admin_loged']) && basename($_SERVER['PHP_SELF'])!='login.php'){
	header( 'Location: login.php');
}else if(isset($_SESSION['admin_loged']) && basename($_SERVER['PHP_SELF'])=='login.php'){
	header( 'Location: index.php');
}

require_once "../configs/dbinfo.php";
require_once "../includes/dbconnector.class.php";
require_once "../includes/function.php";
$db=new DbConnector;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>Adminstration</title>
<link rel="stylesheet" type="text/css" href="../templates/style/css/admin.css"/>




</head>
<body>
 <header>                      
            <div class="wrap">
                <nav>
                    <div id="nav">
                <?php     
                 if(isset($_SESSION['admin_loged'])){
					 ?>
                        <ul>
                     		<li><a href="index.php">Dashboard</a></li>
                          <li><a href="index.php?a=logout">Logout</a></li>
                        </ul> 
                      <?php } ?>  
                    </div>         
                </nav>
            </div>
        </header>
        <div id="content">                
            <div class="wrap clearFix">