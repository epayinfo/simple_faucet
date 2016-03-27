{include file='header.tpl'}
  
  
  
  
  
  
  

<Div class="row text-center" style="font-size:20px;">
	Every {$setinterval} minutes you can earn between <span style="color:#428bca">{$prize_min}</span> and <span style="color:#428bca">{$prize_max}</span> satoshi.<br>
	<strong>Your earnings goes directly to your <a href="http://epay.info/" target="_blank">ePay</a> account</strong>
</Div>  


<Div class="row text-center">
    Our service depends on the revenue from displaying adverts.<br>
    Please deactivate your ad blocker to support us.<br><br>
 </Div>
 
    
   
<div class="row"><center>{$ads_main_top}</center></div>
   
    
{if $captcha}
<div class="row" style="margin-top:5px;">
	<div class="col-md-10 col-md-push-1">
		<div class="alert alert-danger">That CAPTCHA was incorrect. Try again!</div>
	</div>
</div>
{/if}
    
    
    
{if $nobtc}
<div class="row" style="margin-top:5px;">
	<div class="col-md-10 col-md-push-1">
		<div class="alert alert-danger text-center">No Bitcoin address or ePay username found was entered!</div>
	</div>
</div>
{/if}
    
    
{if $succ}
<div class="row" style="margin-top:5px;">
	<div class="col-md-10 col-md-push-1">
		<div class="alert alert-success text-center">
			<strong>{$succ}</strong> satoshi was sent to <strong><a href="http://ePay.info/Login/{$wallet}/" target="_blank" style="color:#464646"> your ePay.info account</a></strong>
		</div>
	</div>
</div>
{/if}

<Div class="clearfix"></Div> 
  
  
{if $adb}  
<div class="row" style="margin-top:5px; display:none;" id="frm_adblocker_detect">
	<div class="col-md-10 col-md-push-1">
		<div class="alert alert-danger text-center">
			Please deactivate your adblocker.			
		</div>
	</div>
</div>
<script>
fuckAdBlock.onDetected(function adBlockDetected(){
	$('#frm_contain').remove();
	$('#frm_adblocker_detect').show();
});
</script> 
{/if}  
  
  
  
  
    
    
<form action="" method="post" id="frm_contain">

{if !$timer}
<div class="row">
	<div class="col-md-10 col-md-push-1">
		<div class="form-group" style="margin-top:5px;margin-bottom:5px;">
			<input class="form-control input-lg" type="text" value="{$wll}" name="wallet" id="wallet" placeholder="Bitcoin Address or ePay username" style="padding:20px;">
		</div>
	</div>
</div>
{/if}  
 
<div class="row"><center>{$ads_1}</center></div>

<Div class="clearfix"></Div> 

     
{if $timer}
<div class="col-md-6 text-center col-md-push-3">
	<strong style="font-size:18px">You can get a reward again in</strong><br>
	<div style="margin-top:10px"></div>
	<div class="clock"></div>
	<script type="text/javascript"> var diff = {$diff}; </script>
	<script src="templates/style/javascript/clock.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js"></script>
</div>
{/if}
      
<Div class="clearfix"></Div>      
      
{if !$timer} 
<Div class="row" style="margin-top:5px;">
	<center>
		{if $solvemedia_box}{$solvemedia_box}{/if}
		{if $captcha_ws_box}{$captcha_ws_box}{/if}
		{if $recaptcha_box}{$recaptcha_box}{/if}
	</center>
</div>

<Div class="row" style="margin-top:5px;">
	<Div class="col-md-6 col-md-push-3">
		<div class="btn-group btn-group-justified" role="group">
			{if $captcha_ws_active}
			<div class="btn-group" role="group">
				<a href="?captcha=1" class="btn {if $captcha_ws_box} btn-info {else} btn-default {/if} ">Captcha.ws</a>
			</div>
			{/if}
			
			{if $solvemedia_active}
			<div class="btn-group" role="group">
				<a href="?captcha=2" class="btn {if $solvemedia_box} btn-info {else} btn-default {/if}">Solvemedia</a>
			</div>
			{/if}
			
			{if $recap_active}
			<div class="btn-group" role="group">
				<a href="?captcha=3" class="btn {if $recaptcha_box} btn-info {else} btn-default {/if}">Recaptcha</a>
			</div>
			{/if}
		</div>
	</Div>
</Div>
{/if}
  
  
<Div class="clearfix"></Div>      
<div class="row" style="margin-top:5px;"><center>{$ads_2}</center></div>
    
    
{if !$timer}
 <div class="row" style="margin-top:5px;">
	<div class="col-xs-4 text-center col-xs-push-4">
	
	
	
	
		{if $bwait}
		<button type="submit" value="0" name="with" class="btn btn-lg btn-block btn-success" formtarget="_self" id="claim" disabled>Claim your prize NOW!!</button>
		<script>
		var timer={$bwait_time};
		var refreshId = setInterval(function(){
			$('#claim').html('Wait '+timer);
			if(timer<=0){
				$('#claim').removeAttr('disabled');
				$('#claim').html('Claim your prize NOW!!');
				clearInterval(refreshId);
			}
			timer--;
		},1000);
		
		
		
		
		
		
		</script>
		
		
		{else}
		
		
		<button type="submit" value="0" name="with" class="btn btn-lg btn-block btn-success" formtarget="_self">Claim your prize NOW!!</button>
		
		
		{/if}		
	
	
	
	
		
		
		
		
		
		
		
		
	</div>
</div>
{/if}
    
</form>




<div class="row" style="margin-top:5px;"><center>{$ads_3}</center></div>
 
<Div class="row" style="margin-top:5px; font-size:18px;">
	<Div class="col-md-10 col-md-push-1">
		<div class="well well-sm text-center">Earn {$ref_percent}% referral bonus! Share your referral URL<br>http://www.{$domainname}/?r=ePay username,email or BTC address</div>
	</Div>
</Div>
    
    
    
<div class="clearfix"></div> 

    

<font style="text-align:justify !important;">
	Bitcoins is a payment system introduced as open-source software in 2009 by developer Satoshi Nakamoto. The payments in the system are recorded in a public ledger using its own unit of account, which is also called Bitcoins. Payments work peer-to-peer without a central repository or single administrator, which has led the US Treasury to call bitcoin a decentralized virtual currency.Although its status as a currency is disputed, media reports often refer to bitcoin as a cryptocurrency or digital currency.				
	<br><br>
	
	Bitcoins are created as a reward for payment processing work in which users offer their computing power to verify and record payments into the public ledger. Called mining, individuals or companies engage in this activity in exchange for transaction fees and newly created bitcoins. Besides mining, bitcoins can be obtained in exchange for fiat money, products, and services. Users can send and receive bitcoins electronically for an optional transaction fee using wallet software on a personal computer, mobile device, or a web application.
	<br><br>
	Bitcoin as a form of payment for products and services has seen growth, and merchants have an incentive to accept the digital currency because fees are lower than the 2-3% typically imposed by credit card processors.The European Banking Authority has warned that bitcoin lacks consumer protections.Unlike credit cards, any fees are paid by the purchaser not the vendor. Bitcoins can be stolen and chargebacks are impossible. Commercial use of bitcoin is currently small compared to its use by speculators, which has fueled price volatility.
	<br><br>
	A Faucet gaves people free bitcoin. You can win bitcoin at a bitcoin faucet by solving things. To get free bitcoins or win free bitcoins you also can referrel with a multiplier of 0,2 to get free Satoshis for just placing a link. <a href="http://en.wikipedia.org/wiki/Bitcoin">
	<br><br>
	More Information on Bitcoin Wikipedia article</a><br><br>


</font> 
  
<div class="row"><center>{$ads_main_bottom}</center></div> 
{include file='footer.tpl'}