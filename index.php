<?php 
require_once "maincore.php";

if (isset($_GET['r']) || isset($_GET['w']) ){
	if (isset($_GET['r']) && $_GET['r']!='')
		setcookie('r', trim($_GET['r']), time() + 60 * 60 * 24 * 30);
		
	if (isset($_GET['w']) && $_GET['w']!='')
		setcookie('w', trim($_GET['w']), time() + 60 * 60 * 24 * 30);
}

include 'configs/ads.php';

$step=1;
$timer=false;

function create_user($wallet,$reffer_id=NULL){ 
	global $db;
	if($reffer_id){
		$prepare=$db->mysqli->prepare("insert into tbl_user (wallet,reffer_id,playnum,reset) values (?,?,0,0) ");
		$prepare->bind_param('si',$wallet,$reffer_id);
	}else{
		$prepare=$db->mysqli->prepare("insert into tbl_user (wallet,playnum,reset) values (?,0,0) ");
		$prepare->bind_param('s',$wallet);
	}
	$prepare->execute();
	$uid=$prepare->insert_id;
	$prepare->close();
	return $uid;
}

function User_id($wallet){
	global $db;	
	$plnum=0;
	$prepare=$db->mysqli->prepare("select count(user_id),user_id,reffer_id,playnum from tbl_user where wallet=?");
	$prepare->bind_param('s',$wallet);
	$prepare->execute();
	$prepare->bind_result($count,$uid,$rid,$plnum);
	$prepare->fetch();
	$prepare->close();
	if(!$count){
		if(isset($_COOKIE['r']) ){
			$ref=$_COOKIE['r'];
			$prepare2=$db->mysqli->prepare("select count(user_id),user_id from tbl_user where wallet=? and wallet!=?");
			$prepare2->bind_param('ss',$ref,$wallet);
			$prepare2->execute();
			$prepare2->bind_result($count2,$rid);
			$prepare2->fetch();
			$prepare2->close();
			if($count2==0 && $ref!=$wallet)
				$rid=create_user($ref);
			$uid=create_user($wallet,$rid);
		}else{
			$uid=create_user($wallet);
		}
	}
	return array('uid'=>$uid,'refid'=>$rid);
}

function check_wallet(){
	global $error;			
	if($_POST['wallet']==''){ 
		$error="No Bitcoin address or ePay username found was entered!";
		return false;
	}else{
		$_SESSION['user']['wallet']=trim($_POST['wallet']);
		$user=User_id($_SESSION['user']['wallet']);
		$_SESSION['user']['uid']=$user['uid'];
		$_SESSION['user']['refid']=$user['refid'];
		return true;
	}
}

if(isset($_POST['with'])){
	global $apicode;
	if( isset($_SESSION['user']['wallet']) || check_wallet()){
		if($csrf->check_valid('post')){
			$antibotlinks = new antibotlinks(true);
			$antibotlinks->check();	
			if( ($antibotlinks->is_valid() && $anti_bot) || !$anti_bot ){
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
					if(isset($_SESSION['prize']))
						$prize=$_SESSION['prize'];
					else{//$prize = chance_creator();
		                global $rewards,$totalMultiplier;
		                $full_reward_list = array();
		                foreach ($rewards as $reward => $multiplier)
		                $full_reward_list = array_merge($full_reward_list, array_fill(0, $multiplier, $reward));
		                $prize = $full_reward_list[mt_rand(0, count($full_reward_list) - 1)];
		            }
							
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
					}else switch ($response['status']) {
							case -2: $error = 'API INVALID'; break;
							case -3: $error = 'INSUFFICIENT BALANCE, try again later'; break;
							case -4: $error = 'NOT ENOUGH PARAMETERS'; break;
							case -5: $error = 'ERROR IN TIMER, try again later'; break;
							case -6: $error = 'SERVER IP ADDRESS NOT AUTHORIZED'; break;
							case -7: $error = 'PROXY DETECTED'; break;
							case -8: $error = 'User country is blocked'; break;
							case -9: $error = 'Budget reached and transaction has been canceled'; break;
							case -10: $error = 'Daily budget reached, try again later'; break;
							case -11: $error = '	time-frame limit reached, try again later'; break;
							case -13: $error = "Per user's daily budget reached"; break;
							case -100: $error = 'Faucet owner please contact ePay.info As soon as possible'; break;
					}					
				}else $error="That CAPTCHA was incorrect. Try again!";
			}else $error="The AntiBot was incorrect. Try again!";
		}
	}
}elseif($faucet_steps==2 && isset($_POST['step2']) && check_wallet())$step = 2;


$wallet=isset($_SESSION['user'])?$_SESSION['user']['wallet']:'';//TODO: fix
$db->queryres("select reset from tbl_user where (ip='$ip' or wallet='$wallet') and reset>$now order by reset desc");
if($db->rownum()){
	$diff = $db->res['reset']-$now;
	$timer = true;
	$succ = $_SESSION['user']['succ'];
	$amount = $_SESSION['user']['amount'];
	$wallet = $_SESSION['user']['wallet'];		
}

$token_id = $csrf->get_token_id();
$token = $csrf->get_token();

if(isset($_SESSION['user']['wallet']))$wll=$_SESSION['user']['wallet'];
elseif(isset($_GET['w']))$wll=$_GET['w'];
elseif(isset($_COOKIE['w']))$wll=$_COOKIE['w'];
else $wll='';

$title = $sitetitle;
$db->queryres("select prize from tbl_prize order by prize asc limit 1 ");
$prize_min = $db->res['prize'];
$db->queryres("select prize from tbl_prize order by prize desc limit 1 ");
$prize_max = $db->res['prize'];
$year = date('Y',$now);
$currency_name = $currencies[$currency];
$clinet=new ePay($apicode);
$blc=$clinet->getBalance();
if($blc>=0){	
	if($currency==4)
		$blc=convertToBTCFromSatoshi($blc);
	$faucet_balance = $blc.' '.$currency_name;		
}else{
	$faucet_balance = 'API NOT VALID';		
}

if(( ($faucet_steps==2 && $step == 2)  || $faucet_steps==1 )){
	if($solvemedia_active ) $solvemedia_box = solvemedia_get_html($privkey);
	if($recap_active ) $recaptcha_box =  '<div class="g-recaptcha" data-sitekey="'.$recap_site.'"></div>' ;
	if($anti_bot){
		$antibotlinks = new antibotlinks(true);
		$antibotlinks->generate($anti_bot, true);	
		$abinf = $antibotlinks->show_info();		
		if($anti_bot > 2)
			$ab1 = $antibotlinks->show_link();
			$ab2 = $antibotlinks->show_link();
			$ab3 = $antibotlinks->show_link();
		if($anti_bot > 3)
			$ab4 = $antibotlinks->show_link();
		if($anti_bot > 4)
			$ab5 = $antibotlinks->show_link();
	}
}else $anti_bot = 0;

if(isset($_SESSION['adi']))$_SESSION['adi']++;
else $_SESSION['adi'] = 0; //ad index
$adi = $_SESSION['adi'];

include 'templates/index.php';
?>