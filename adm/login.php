<?php require_once('header.php');
if(isset($_POST['login']) ){
	$ss=new SystemComponent;
	$info=$ss->getSetting();
	if($info['adminpass']==hash('SHA256',trim($_POST['pass']))){
		$_SESSION['admin_loged']=true;
		header('Location: index.php');
		die();
	}else $error = true;
}
 ?>
<form action="" method="post"> 
	<Div class="col-md-6 col-md-push-3">  
		<?php if(isset($_GET ['out'])){ ?>
			<div class="row"><div class="alert alert-success">Logout was successful</div></div>
		<?php }else if(isset($error)){ ?><br><br>
			<div class="row"><div class="alert alert-danger">Login failed</div></div>
		<?php } ?> 
	
		<div class="row">   
			<div class="form-group">
				<label for="exampleInputEmail1">Administartion Passphare</label>
				<input name="pass" type="password" class="form-control"/>
			</div>
		</div>
		
		<div class="row">  
			<button type="submit" name="login" class="btn btn-success col-md-3 col-md-push-4">Login</button>
		</div>
	</Div>
</form>               
<?php require_once('footer.php'); ?>