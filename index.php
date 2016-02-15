<?php 
require_once "maincore.php";
if(isset($_POST['with'])){
	if($_POST['wallet']==''){
		unset($_SESSION['wallet']);
		$_SESSION['error']['nowallet']=true;
		header('Location:index.php');
		die();
	}else{
		$_SESSION['user']['wallet']=trim($_POST['wallet']);
		$user=User_id($_SESSION['user']['wallet']);
		$_SESSION['user']['uid']=$user['uid'];
		$_SESSION['user']['refid']=$user['refid'];
		$_SESSION['user']['plnum']=$user['plnum'];
	}
	
	$solvemedia_response=solvemedia_check_answer($verkey,$_SERVER["REMOTE_ADDR"],$_POST['adcopy_challenge'],$_POST['adcopy_response'],$hashkey);
	if( $solvemedia_response->is_valid){
		global $apiurl,$apicode;
		$client = new SoapClient($apiurl);
		$prize=chance_creator($rewards);
		$response = $client->send($apicode,$_SESSION['user']['wallet'],$prize,1);
		if($response['status']>0){
			$wait=$now+($setinterval*60);
			$db->query("update tbl_user set `reset`='$wait',playnum=playnum+1,earn=earn+'$prize',ip='$ip' where user_id='".$_SESSION['user']['uid']."'");				
			$_SESSION['user']['succ']=$prize;
			if($_SESSION['user']['refid']){ 
				$refearn=floor(($prize*$ref_percent)/100);
				$db2->queryres("select wallet from tbl_user where user_id='".$_SESSION['user']['refid']."'");
				$response = $client->send($apicode,$db2->res['wallet'],$refearn,2,'Referral earnings.');
				var_dump($response);
			}
			unset($_SESSION['error']);
		}else
			$_SESSION['error']['epay']=true;
			$amount_bb=$client->balance($apicode,$_SESSION['user']['wallet']);
			$_SESSION['user']['amount']=$amount_bb;
	}else{
		unset($_SESSION['user']);
		unset($_SESSION['error']);
		$_SESSION['error']['capt']=true;
	}
	header('Location:index.php');
}else{
	$wallet=$_SESSION['user']['wallet'];
	$db->queryres("select reset from tbl_user where (ip='$ip' or wallet='$wallet') and reset>$now order by reset desc");
	if($db->rownum()){
		$timer=true;
		$smarty->assign('diff',$db->res['reset']-$now);
		$smarty->assign('timer',true);
		
	}
		
	if($_SESSION['error']['inproccess'])
		$smarty->assign('inproccess',1);
		
	if($_SESSION['error']['nowallet'])
		$smarty->assign('nobtc',1);
		
	if($timer){
		$smarty->assign('succ',$_SESSION['user']['succ']);
		$smarty->assign('amount',$_SESSION['user']['amount']);
		$smarty->assign('wallet',$_SESSION['user']['wallet']);
		
	}
		
	if($_SESSION['error']['capt'])
		$smarty->assign('captcha',1);
		
	unset($_SESSION['error']);


	$smarty->assign('setinterval',$setinterval);
	$smarty->assign('ads_1',$ads_1);
	$smarty->assign('captcha_box',solvemedia_get_html($privkey));
	$smarty->assign('ads_2',$ads_2);
	$smarty->assign('wll',$_COOKIE['w']);
	$smarty->assign('title',$sitetitle);
	$smarty->assign('favicon',$favicon);
	$smarty->assign('domainname',$domainname);
	$smarty->assign('ads_left',$ads_left);
	$smarty->assign('ads_right',$ads_right);
	$smarty->assign('ads_main_top',$ads_main_top);
	$smarty->assign('ads_main_bottom',$ads_main_bottom);
	$smarty->assign('ref_percent',$ref_percent);
	$db->queryres("select prize from tbl_prize order by prize asc limit 1 ");
	$smarty->assign('prize_min',$db->res['prize']);
	$db->queryres("select prize from tbl_prize order by prize desc limit 1 ");
	$smarty->assign('prize_max',$db->res['prize']);
	$smarty->assign('globalboxalert',$globalboxalert);
	
	
	$smarty->assign('keywords',$keywords);
	$smarty->assign('desc',$desc);
	
	
	
	$smarty->display('index.tpl');
}
?>