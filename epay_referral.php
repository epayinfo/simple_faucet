<?php
require_once "maincore.php";
$wallet=json_decode(urldecode($_GET['wallet']));
$query=implode(',',$wallet);
$lastweek=strtotime('-7 days');
$db->queryres("select count(user_id) as cus from tbl_user where reffer_id
	in (select user_id from tbl_user where FIND_IN_SET(wallet ,('$query') ) ) 
	and reset >='$lastweek' and reset>0");
$db2->queryres("select count(user_id) as cus from tbl_user where reffer_id
	in (select user_id from tbl_user where FIND_IN_SET(wallet ,('$query') ) )
	and reset <'$lastweek' and reset>0");
echo json_encode(array('active'=>(int)$db->res['cus'],'inactive'=>(int)$db2->res['cus'])) ;
?>