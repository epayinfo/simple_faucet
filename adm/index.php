<?php require_once "header.php"; 
if(isset($_GET['a'])&&$_GET['a']=='logout'){
	unset($_SESSION['admin_loged']);
	header( 'Location: login.php?out=1');
}else{
	require_once "../configs/configs.php";
?>
<div class="row">
	<Div class="col-md-3">
		<div class="alert alert-info">
		<h4>User Count</h4>
		<div class="text-right">
		<?php
		$db->queryres("Select count(user_id) as cc from tbl_user");
		echo number_format($db->res['cc']);
		?>
		</div>
		</div>
	</Div>
	
	<Div class="col-md-3">
		<div class="alert alert-warning">
		<h4>Total Paid</h4>
		<div class="text-right">
		<?php
		$db->queryres("Select sum(earn) as cc,sum(playnum) as pc from tbl_user");
		echo convertToBTCFromSatoshi($db->res['cc']);
		?>
		</div>
		</div>
	</Div>
	
	<Div class="col-md-3">
		<div class="alert alert-success">
		<h4>Total Game Played</h4>
		<div class="text-right"><?php echo number_format($db->res['pc']);	?></div>
		</div>
	</Div>
	
	<Div class="col-md-3">
		<div class="alert alert-danger">
		<h4>Balance</h4>
		<div class="text-right">
			<?php	
				$clinet=new ePay($apicode);
				echo $clinet->getBalance();
			?>
		</div>
		</div>
	</Div>
</div>

<Div class="row">

	<Div class="col-md-3">
		<div class="alert alert-danger">
		<h4>Your IP address for ACL</h4>
		<div class="text-right">
			<?php
			echo file_get_contents('http://api.epay.info/ip.php');
			?>
		</div>
		</div>
	</Div>

</Div>






<div class="row">
	<Div class="col-md-12">
		<div class="alert alert-info">
		Your version is : <?php echo $ver; ?><br>
		<?php
	$v=json_decode(file_get_contents('http://epay.info/script_edition.php'));
	if($v->ver==$ver)
		echo 'No update available';
	else{
		?>
		There is a new update available (<?php echo $v->ver; ?>). Consider updating.<br>

		
		<a href="https://github.com/epayinfo/simple_faucet/archive/master.zip" target="_blank" class="btn btn-info" download> Download New Update </a>
		
		
	<?php }
		
	?>
		

		</div>
	</Div>	
</div>


<?php }require_once "footer.php"; ?>