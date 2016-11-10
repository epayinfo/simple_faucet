<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="{$desc}">
	<meta name="keywords" content="{$keywords}">
	<title>{$title}</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" >
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="//cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="templates/style/css/style.css">
	<script src="//code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>
	<script src="//www.google.com/recaptcha/api.js" type="text/javascript"></script>
	<script  src="templates/style/javascript/analytic.js" type="text/javascript"></script>
	{if $adb}
	<script src="//cdnjs.cloudflare.com/ajax/libs/fuckadblock/3.2.1/fuckadblock.min.js" type="text/javascript"></script>
	<script>
		fuckAdBlock.onDetected(function adBlockDetected(){
			$('#frm_contain').remove();
			$('#frm_adblocker_detect').show();
		});
	</script> 
	{/if}
</head>
<body>
<div class="container-fluid">
	<div class="col-md-3 hidden-xs text-center ad_left" style="padding-top:35px;">{$ads_left}</div>
	<div class="col-md-7 main_area">
        <a href="index.php" ><div class="text-center"><h1>{$title}</h1></div></a>
		
		
		
<Div class="row text-center" style="font-size:20px;">
	Every {$setinterval} minutes you can earn between <span style="color:#428bca">{$prize_min}</span> and <span style="color:#428bca">{$prize_max}</span> {$currency}<br>
	<strong>Your earnings goes directly to your <a href="http://epay.info/" target="_blank">ePay</a> account</strong>
</Div>  


<Div class="row text-center">
    Our service depends on the revenue from displaying adverts.<br>
    Please deactivate your ad blocker to support us.<br><br>
 </Div>
 
    
   
<div class="row"><center>{$ads_main_top}</center></div>
		

{include file='msg.tpl'}		