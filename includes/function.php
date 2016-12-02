<?php
function chance_creator($entrance){
	$rewards = explode(',', $entrance);
	$full_reward_list = array();
    foreach ($rewards as $reward) {
        list($reward, $multiplier) = explode('*', $reward);
        if (!$reward) continue;
        $rewardList[$reward] += $multiplier;
        $totalMultiplier += $multiplier;
    }
    foreach ($rewardList as $reward => $multiplier)
        $full_reward_list = array_merge($full_reward_list, array_fill(0, $multiplier, $reward));
    $result = $full_reward_list[mt_rand(0, count($full_reward_list) - 1)];
	return $result;
}

function get_rewards($rewards = null){
	$rewards = explode(',', $rewards);
	$full_reward_list = array();
    foreach ($rewards as $reward) {
        list($reward, $multiplier) = explode('*', $reward);
        if (!$reward) continue;
        $rewardList[$reward] += $multiplier;
        $totalMultiplier += $multiplier;
    }
    foreach ($rewardList as $reward => $multiplier)
        $full_reward_list = array_merge($full_reward_list, array_fill(0, $multiplier, $reward));
	
	foreach ($rewardList as $reward => $multiplier) {
		if ( round($totalMultiplier / $multiplier) > 10000)
			$percentage = '<0.01%';
		else
			$percentage = rtrim(rtrim(number_format($multiplier / $totalMultiplier * 100, 2), '0'), '.') . '%';
		$result[$reward] =$percentage;
	}
	return $result;
}

if (isset($_GET['r']) || isset($_GET['w']) ){
	if (isset($_GET['r']) && $_GET['r']!='')
		setcookie('r', trim($_GET['r']), time() + 60 * 60 * 24 * 30);
		
	if (isset($_GET['w']) && $_GET['w']!='')
		setcookie('w', trim($_GET['w']), time() + 60 * 60 * 24 * 30);
}

function convertToBTCFromSatoshi($value){
	return (float)bcdiv( ($value), 100000000, 8 );
}
function create_user($wallet,$reffer_id=NULL){ 
	global $db;
	if($reffer_id){
		$prepare=$db->mysqli->prepare("insert into tbl_user (wallet,reffer_id,playnum,reset) values (?,?,0,0) ");
		$prepare->bind_param('si',$wallet,$reffer_id);
		$prepare->execute();
		$uid=$prepare->insert_id;
		$prepare->close();
	}else{
		$prepare=$db->mysqli->prepare("insert into tbl_user (wallet,playnum,reset) values (?,0,0) ");
		$prepare->bind_param('s',$wallet);
		$prepare->execute();
		$uid=$prepare->insert_id;
		$prepare->close();
	}
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
	if($_POST['wallet']==''){ 
		unset($_SESSION['wallet']);
		$_SESSION['error']['nowallet']=true;
		header('Location:index.php?er=noadd');
		die();
	}else{
		$_SESSION['user']['wallet']=trim($_POST['wallet']);
		$user=User_id($_SESSION['user']['wallet']);
		$_SESSION['user']['uid']=$user['uid'];
		$_SESSION['user']['refid']=$user['refid'];
	}						
}

function currency($currency){
	switch ($currency){
		case 1:
		return 'Satoshi (Bitcoin)';
		break;
			
		case 4:
		return 'Dogecoin';
		break;
			
		case 5:
		return 'Satoshi (Litecoin)';
		break;
			
		case 7:
		return 'Satoshi (Dashcoin)';
		break;	
			
			
		case 9:
		return 'Satoshi (Peercoin)';
		break;	
			
		case 10:
		return 'Satoshi (Primecoin)';
		break;	
			
			
			
			
			
	}								
}
?>