{include file='header.tpl'}
  
<form action="" method="post" id="frm_contain">
{if $anti_bot}<center>{$ab4}</center>{/if}
{if !$timer and ($faucet_steps==1 or !$step) }
	<div class="row">
		<div class="col-md-10 col-md-push-1">
			<div class="form-group" style="margin-top:5px;margin-bottom:5px;">
				<input class="form-control input-lg" type="text" value="{$wll}" name="wallet" id="wallet" placeholder="Bitcoin Address or ePay username" style="padding:20px;">
			</div>
		</div>
	</div>
{/if}  
 
<div  style="margin-top:5px;"></div> 
<div class="row"><center>{$ads_1}</center></div>
{if $anti_bot}<center>{$ab1}</center>{/if}
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

{if ($faucet_steps==1 or $step==2) and !$timer  }
	<Div class="row" style="margin-top:5px;">
		<Div class="col-md-6 col-md-push-3">
		
			<ul class="nav nav-tabs" role="tablist">
				{if $solvemedia_box}<li role="presentation" class="{if $solvemedia_active}active{/if}"><a href="#solvmedia" aria-controls="solvmedia" role="tab" data-toggle="tab">Solvemedia</a></li>{/if}
				{if $recaptcha_box}<li role="presentation" class="{if $recap_active}active{/if}"><a href="#recaptcha" aria-controls="recaptcha" role="tab" data-toggle="tab">Recaptcha</a></li>{/if}
			</ul>
	
			<div class="tab-content">
				{if $solvemedia_box}<div role="tabpanel" class="tab-pane {if $solvemedia_active}active{/if}" id="solvmedia"><center>{$solvemedia_box}</center></div>{/if}
				{if $recaptcha_box}<div role="tabpanel" class="tab-pane {if $recap_active}active{/if}" id="recaptcha"><center>{$recaptcha_box}</center></div>{/if}
			</div>
			
		</Div>
	</Div>
	<input type="hidden" name="{$token_id}" value="{$token}" />

{/if}


{if $anti_bot}<center>{$ab2}</center>{/if}
  
  
<Div class="clearfix"></Div>      
<div class="row" style="margin-top:5px;"><center>{$ads_2}</center></div>
    
    
{if !$timer}
 <div class="row" style="margin-top:5px;">
	<div class="col-xs-4 text-center col-xs-push-4">
		{if $faucet_steps==1 or $step==2 }
		
			
		
		
			{if $anti_bot}<center>{$ab3}</center>{/if}
		
		
			{if $anti_bot}
			<input type="hidden" name="antibotlinks" id="antibotlinks" value="" data-click="{$anti_bot}" /> 
			{/if}
		
		
			{if !$anti_bot}<button type="submit" name="with" class="btn btn-lg btn-block btn-success" id="claim" {if $bwait}disabled data-time="{$bwait_time}"{/if}>Claim your prize NOW!!</button>{/if}
			
			
			
		{else}
			<button type="submit" name="step2" class="btn btn-lg btn-block btn-success" id="claim" {if $bwait} disabled data-time="{$bwait_time}"{/if}>Next Step</button>
		{/if}
	</div>
</div>
{/if}
  
 {if $anti_bot}<center>{$ab5}</center>{/if} 
  
   
</form>



{include file='footer.tpl'}