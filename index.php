<?php 
require_once "maincore.php";
if(isset($_POST['with'])){
	global $apiurl,$apicode;
	$antibotlinks = new antibotlinks(true);
	$antibotlinks->check();
	if( !$antibotlinks->is_valid() && $anti_bot ){
		unset($_SESSION['user']);
		unset($_SESSION['error']);
		$_SESSION['error']['anb']=true;
		header('Location:index.php?er=antiblock');
		die();
	}
	if( !isset($_SESSION['user']['wallet']) ) check_wallet();
	if($solvemedia_active)$solvemedia_response=solvemedia_check_answer($hashkey,$_SERVER["REMOTE_ADDR"],$_POST['adcopy_challenge'],$_POST['adcopy_response'],$verkey);
	if($recap_active){
		$reCaptcha = new ReCaptcha($recap_secret);
		if ($_POST["g-recaptcha-response"])
			$resp = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);
	}

	if( 
		( $solvemedia_active && $solvemedia_response->is_valid ) ||          
		( $recap_active && $resp!=null && $resp->success )
	){
		$client = new SoapClient($apiurl);
		$prize=$_SESSION['prize'];
		if(!isset($_SESSION['prize']))
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
			}
			unset($_SESSION['error']);
			header('Location:index.php?er=win');
		}else{
			unset($_SESSION['user']);
			unset($_SESSION['error']);
			$_SESSION['error']['epay']=true;
			header('Location:index.php?er=epay');
		}
	}else{
		unset($_SESSION['user']);
		unset($_SESSION['error']);
		$_SESSION['error']['capt']=true;
		header('Location:index.php?er=captcha');
	}	
	die();
}else{
	$wallet=$_SESSION['user']['wallet'];
	$db->queryres("select reset from tbl_user where (ip='$ip' or wallet='$wallet') and reset>$now order by reset desc");
	if($db->rownum()){
		$smarty->assign('diff',$db->res['reset']-$now);
		$smarty->assign('timer',true);
		$smarty->assign('succ',$_SESSION['user']['succ']);
		$smarty->assign('amount',$_SESSION['user']['amount']);
		$smarty->assign('wallet',$_SESSION['user']['wallet']);		
	}
	
	if(isset($_SESSION['error'])){
		if($_SESSION['error']['inproccess'])$smarty->assign('inproccess',1);
		if($_SESSION['error']['nowallet'])$smarty->assign('nobtc',1);
		if($_SESSION['error']['capt']) $smarty->assign('captcha',1);
		if($_SESSION['error']['anb'] ) $smarty->assign('anb',1);
		
		unset($_SESSION['error']);
	}
	
	if($solvemedia_active ) $smarty->assign('solvemedia_box',solvemedia_get_html($privkey));
	if($recap_active ) $smarty->assign('recaptcha_box', '<div class="g-recaptcha" data-sitekey="'.$recap_site.'"></div>' );
	
	if($solvemedia_active){
		$smarty->assign('solvemedia_active',true);
	}else{
		$smarty->assign('recap_active',true);
	}
	
	if($faucet_steps==2 && isset($_POST['step2'])){
		check_wallet();
		$prize=$_SESSION['prize'];
		if(!isset($_SESSION['prize'])) $prize=$_SESSION['prize']=chance_creator($rewards);		
		$smarty->assign('step',2);
	}
}

if($adb)$smarty->assign('adb',true);	
if($bwait)$smarty->assign('bwait',true);
$smarty->assign('bwait_time',$bwait);
$smarty->assign('faucet_steps',$faucet_steps);
$smarty->assign('setinterval',$setinterval);
$smarty->assign('ads_1',$ads_1);
$smarty->assign('ads_2',$ads_2);
$smarty->assign('ads_3',$ads_3);
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
$smarty->assign('year',date('Y',$now));
$smarty->assign('anti_bot',$anti_bot);




$smarty->assign('currency',currency($currency));




if( $anti_bot && ( ($faucet_steps==2 && isset($_POST['step2']))  || $faucet_steps==1 )){
	$antibotlinks = new antibotlinks(true);
	$antibotlinks->generate($anti_bot, true);	
	$smarty->assign('abinf',$antibotlinks->show_info());	
	switch($anti_bot){
		case 1:
			$smarty->assign('ab1',$antibotlinks->show_link());
		break;
		case 2:
			$smarty->assign('ab1',$antibotlinks->show_link());
			$smarty->assign('ab2',$antibotlinks->show_link());
		break;
		case 3:
			$smarty->assign('ab1',$antibotlinks->show_link());
			$smarty->assign('ab2',$antibotlinks->show_link());
			$smarty->assign('ab3',$antibotlinks->show_link());	
		break;
		case 4:
			$smarty->assign('ab1',$antibotlinks->show_link());
			$smarty->assign('ab2',$antibotlinks->show_link());
			$smarty->assign('ab3',$antibotlinks->show_link());	
			$smarty->assign('ab4',$antibotlinks->show_link());	
			
		break;
		case 5:
			$smarty->assign('ab1',$antibotlinks->show_link());
			$smarty->assign('ab2',$antibotlinks->show_link());
			$smarty->assign('ab3',$antibotlinks->show_link());
			$smarty->assign('ab4',$antibotlinks->show_link());
			$smarty->assign('ab5',$antibotlinks->show_link());
		break;
	}
}
$smarty->display('index.tpl');
?>