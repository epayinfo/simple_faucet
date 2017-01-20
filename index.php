<?php 
require_once "maincore.php";
if(isset($_POST['with'])){
	global $apicode;
	$antibotlinks = new antibotlinks(true);
	$antibotlinks->check();	
	if( !isset($_SESSION['user']['wallet']) ) check_wallet();
	if($solvemedia_active)$solvemedia_response=solvemedia_check_answer($hashkey,$_SERVER["REMOTE_ADDR"],$_POST['adcopy_challenge'],$_POST['adcopy_response'],$verkey);
	if($recap_active){
		$reCaptcha = new ReCaptcha($recap_secret);
		if ($_POST["g-recaptcha-response"])
			$resp = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);
	}
	if($csrf->check_valid('post')){
		if( ($antibotlinks->is_valid() && $anti_bot) || !$anti_bot ){
			if( 
				( $solvemedia_active && $solvemedia_response->is_valid ) ||          
				( $recap_active && $resp!=null && $resp->success )
			){								
				$prize=$_SESSION['prize'];
				if(!isset($_SESSION['prize']))
					$prize=chance_creator($rewards);
							
				$clinet=new ePay($apicode);	
				$response=$clinet->send( $_SESSION['user']['wallet'],$prize,NULL,$ip );
				if($response['status']>0){
					$wait=$now+($setinterval*60);
					$db->query("update tbl_user set `reset`='$wait',playnum=playnum+1,earn=earn+'$prize',ip='$ip' where user_id='".$_SESSION['user']['uid']."'");				
					$_SESSION['user']['succ']=$prize;
					if($_SESSION['user']['refid']){ 
						$refearn=floor(($prize*$ref_percent)/100);
						$db2->queryres("select wallet from tbl_user where user_id='".$_SESSION['user']['refid']."'");
						$clinet->send( $db2->res['wallet'],$refearn,'Referral earnings.',NULL,2 );						
					}
					unset($_SESSION['error']);
					header('Location:index.php?er=win');															
				}else{
					unset($_SESSION['user']);
					unset($_SESSION['error']);			
					$_SESSION['error']['epay']=true;
					$_SESSION['error']['epay_code']=$response['status'];
					header('Location:index.php?er=epay');
				}					
			}else{
				unset($_SESSION['user']);
				unset($_SESSION['error']);
				$_SESSION['error']['capt']=true;
				header('Location:index.php?er=captcha');
			}				
		}else{
			unset($_SESSION['user']);
			unset($_SESSION['error']);
			$_SESSION['error']['anb']=true;
			header('Location:index.php?er=antiblock');
			die();
		}
	}else{
		unset($_SESSION['user']);
		unset($_SESSION['error']);
		$_SESSION['error']['uknown']=true;
		header('Location:index.php?er=csrf_error');
		die();

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
		if( $_SESSION['error']['epay'] ) $smarty->assign('epay_err',1);				
		switch ($_SESSION['error']['epay_code']){
			case -2:
				$msg='API INVALID';
			break;
				
			case -3:
				$msg='INSUFFICIENT BALANCE, try again later';
			break;			
				
			case -4:
				$msg='NOT ENOUGH PARAMETERS';
			break;
				
			case -5:
				$msg='ERROR IN TIMER, try again later';
			break;
				
			case -6:
				$msg='SERVER IP ADDRESS NOT AUTHORIZED';
			break;
								
			case -7:
				$msg='PROXY DETECTED';
			break;	
				
			case -8:
				$msg='User country is blocked';
			break;	
								
			case -9:
				$msg='Budget reached and transaction has been canceled';
			break;	
								
			case -10:
				$msg='Daily budget reached, try again later';
			break;	
								
			case -11:
				$msg='	time-frame limit reached, try again later';
			break;	
				
			case -13:
				$msg="Per user's daily budget reached";
			break;	
				
			case -100:
				$msg='Faucet owner please contact ePay.info As soon as possible';
			break;	
																				
		}				
		$smarty->assign('epay_err_msg',$msg);
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
$smarty->assign('token_id',$csrf->get_token_id());
$smarty->assign('token',$csrf->get_token());
$smarty->assign('bwait_time',$bwait);
$smarty->assign('faucet_steps',$faucet_steps);
$smarty->assign('setinterval',$setinterval);
$smarty->assign('ads_1',$ads_1);
$smarty->assign('ads_2',$ads_2);
$smarty->assign('ads_3',$ads_3);
$smarty->assign('wll',$_GET['w']);
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
$clinet=new ePay($apicode);
$blc=$clinet->getBalance();
if($blc>=0){	
	if($currency==4)
		$blc=convertToBTCFromSatoshi($blc);
	$smarty->assign('faucet_balance',$blc.' '.currency($currency));		
}else{
	$smarty->assign('faucet_balance','API NOT VALID');		
}

if( $anti_bot && ( ($faucet_steps==2 && isset($_POST['step2']))  || $faucet_steps==1 )){
	$antibotlinks = new antibotlinks(true);
	$antibotlinks->generate($anti_bot, true);	
	$smarty->assign('abinf',$antibotlinks->show_info());	
	switch($anti_bot){		
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