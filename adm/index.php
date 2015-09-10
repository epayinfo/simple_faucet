<?php require_once "header.php"; 
if(isset($_GET['a'])&&$_GET['a']=='logout'){
	unset($_SESSION['admin_loged']);
	header( 'Location: login.php?out=1');
}else{
?>
<ul id="icone">
	<a href="user.php"><li>Users</li></a>
	<a href="ads.php"><li>Ads</li></a></a>
	<a href="setting.php"><li>Settings</li></a>
	<a href="prize.php"><li>Prizes</li></a>
	<a href="?a=logout"><li>Logout</li></a>
</ul>
<div class="clear"></div>
<br />
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th height="32" colspan="2">Summery</th>
    </tr>
  <tr>
    <td width="49%">User Count</td>
    <td width="51%">
	<?php
    $db->queryres("Select count(user_id) as cc from tbl_user");
	echo number_format($db->res['cc']);
	?>
	</td>
  </tr>

  <tr>
    <td width="49%">Total Paid</td>
    <td width="51%">
	<?php
    $db->queryres("Select sum(earn) as cc,sum(playnum) as pc from tbl_user");
	echo convertToBTCFromSatoshi($db->res['cc']),' BTC';
	?>
	</td>
  </tr>
  
  <tr>
    <td width="49%">Total Game played</td>
    <td width="51%">
	<?php
	echo number_format($db->res['pc']);
	?>
	</td>
  </tr>
  
</table>
<?php }require_once "footer.php"; ?>