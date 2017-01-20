

<div class="row" style="margin-top:5px;">
	<div class="col-md-10 col-md-push-1">
		<div class="alert alert-success text-center">We have {$faucet_balance}</div>
	</div>
</div>







{if $epay_err}
<div class="row" style="margin-top:5px;">
	<div class="col-md-10 col-md-push-1">
		<div class="alert alert-danger">{$epay_err_msg}</div>
	</div>
</div>
{/if}






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
			<strong>{$succ}</strong> {$currency} was sent to <strong><a href="https://epay.info/check/{$wallet}" target="_blank" style="color:#464646"> your ePay.info account</a></strong>
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
{/if}  


{if $anb}  
<div class="row" style="margin-top:5px;">
	<div class="col-md-10 col-md-push-1">
		<div class="alert alert-danger">The AntiBot was incorrect. Try again!
	</div>
</div>
{/if}  




<div class="row"  style="margin-top:5px;"><div class="col-md-10 col-md-push-1 text-center">{$abinf}</div></div>