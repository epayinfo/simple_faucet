<?php
require_once "maincore.php";
$client = new SoapClient($apiurl);
$db->query("select user_id,wallet,ref_pending from tbl_user where ref_pending>='$reflimit' order by ref_pending desc");
while($res=$db->fetchArray()){
	$response = $client->send($apicode,$res['wallet'],$res['ref_pending'],2,'Referral earnings.');
	if($response['status']>0)
		$db2->query("update tbl_user set ref_pending=0 where user_id='".$res['user_id']."'");
}
?>