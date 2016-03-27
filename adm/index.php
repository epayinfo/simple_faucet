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
			$res=json_decode( file_get_contents('https://api.epay.info/balance.php?api_key='.$apicode.'&currency='.$currency) );
			echo $res->balance_bitcoin;
			?>
		</div>
		</div>
	</Div>
</div>
<?php }require_once "footer.php"; ?>