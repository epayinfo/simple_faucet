<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=device-width">
	<title>Faucet Installer</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="//cdn.epay.info/css/flipclock.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="templates/style/css/style.css">
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
</head>
<body>
<div class="container" style="padding-top:50px;">



<?php if(!isset($_GET['step'])){ ?>
<div class="panel panel-primary">
  <div class="panel-heading">Faucet Installer</div>
  <div class="panel-body">
   Hi<br>
Thank you for using this installer to begin a your new faucet with <a href="http://epay.info" target="_blank">ePay.info</a> <br>
We aim to improve the quality of this script over time, so remember to check the repository <a href="https://github.com/epayinfo/simple_faucet" target="_blank">here</a> on regular basis to get the last updates.<br>
Begin installing by clicking on the next step.
</div>
<div class="panel-footer">
<a href="?step=2" class="btn btn-success pull-right">Next</a>
<div class="clearfix"></div>
</div>
</div>
<?php }elseif($_GET['step']==2){ 
if(isset($_POST['dbname'])){

class SystemComponent{
	private $settings;
	function getSetting(){
		$settings['dbhost']=$_POST['dbhost'];
		$settings['dbusername']=$_POST['uname'];
		$settings['dbpassword']=$_POST['pwd']; 
		$settings['dbname']=$_POST['dbname'];
		return $settings;
	}
}
require_once "includes/dbconnector.class.php";

$db=new DbConnector;
if($db->check_connection()){
	$dbhost=$_POST['dbhost'];
	$dbusername=$_POST['uname'];
	$dbpassword=$_POST['pwd']; 
	$dbname=$_POST['dbname'];
	function generateRandomString($length = 25) {
		$characters = 'abcdefghijklmnopqrstuvwxyz123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	$_SESSION['info']['admin']=generateRandomString();
	$adminpass=hash('SHA256',$_SESSION['info']['admin']);	
$content = <<<END
<?php
class SystemComponent{
	private \$settings;
	function getSetting(){
		\$settings['dbhost']='$dbhost';
		\$settings['dbusername']='$dbusername';
		\$settings['dbpassword']='$dbpassword'; 
		\$settings['dbname']='$dbname';
		\$settings['adminpass']='$adminpass';
		return \$settings;
	}
}
END;
	chmod( 'templates_c', 0777 );
	chmod( 'configs/dbinfo.php', 0666 );
	$fp = fopen('configs/dbinfo.php',"w");
	fwrite($fp,$content);
	fclose($fp);
	$sql=fopen('install.sql','r');
	$schema=fread($sql,filesize("install.sql"));
	$queries = explode( ';', $schema );
	$queries = array_filter( $queries );
	array_pop($queries);
	foreach($queries as $q)
		$db->query($q);
		
	fclose($sql);
	header('Location: install.php?step=3');
	die();
}else{
	$_SESSION['error']['db']=true;
	header('Location: install.php?step=2');
	die();
}
}else{
?>

<div class="panel panel-primary">
	<div class="panel-heading">Faucet Installer - Database</div>
<form action="" method="post">  
  
  <div class="panel-body">
   
   Below you should enter your database connection details. If you’re not sure about these, contact your host.
   
   
   
   
<?php if(isset($_SESSION['error']['db'])){ ?>

<div class="alert alert-danger">
Unable to connect to database.

</div>
<?php unset($_SESSION['error']); } ?>   
   
   
   
   <div class="form-group">
       <label for="dbname">Database Name</label>
       <input class="form-control" name="dbname" type="text" size="25" value="myfaucet" />
       <small>The name of the database you want to run your faucet in.</small>
   </div>
   
   
   <div class="form-group">
       <label for="uname">Database Username</label>
       <input class="form-control" name="uname" type="text" size="25" placeholder="username" />
       <small>Your MySQL username.</small>
   </div>
   
   
   
   <div class="form-group">
       <label for="pwd">Database Password</label>
       <input class="form-control" name="pwd" type="text" size="25" placeholder="password" />
       <small>Your MySQL password.</small>
   </div>
   
   
   <div class="form-group">
       <label for="dbhost">Database Host</label>
       <input class="form-control" name="dbhost" type="text" size="25" value="localhost" />
       <small>You should be able to get this info from your web host, if <code>localhost</code> does not work.</small>
   </div>
   
   
   

   
   
   
</div>
<div class="panel-footer">
<button type="submit" class="btn btn-success pull-right">Next</button>
<div class="clearfix"></div>
</div>

</form>

</div>
<?php 
} 
}elseif($_GET['step']==3){  

@unlink('install.php');
@unlink('install.sql');

?>


<div class="panel panel-primary">


  <div class="panel-heading">Faucet Installer - Finish</div>
  <div class="panel-body">
   
   Your installation has just been completed.
   
   <br>
   
<center>

  This is your administartion passphare:<br><br>

  <strong><code style="font-size:24px"><?php echo $_SESSION['info']['admin'];?></code></strong>
  <br><br>

  <div class="col-md-4 col-md-push-4">
  <a href="adm/" class="btn btn-success btn-block">Go to Administartion</a>

  
  </div>
  
  
  
  
  
</center>
   <br>

   <div class="clearfix"></div>
  
<strong>Make sure install.php and install.sql are deleted from you host.<br>
Admin passpharse will not be shown again even if you refresh this page. Save it somewhere safe.  
</strong>  
  
  
   
</div>
</div>






<?php session_destroy(); } ?>






</div>
</body>
</html>