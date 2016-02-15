{include file='header.tpl'}
  
  <font size="3">
    

    
    <div style="margin-top: 12px;"></div>
  <font size="5">Every {$setinterval} minutes you can earn between <span style="color:#428bca">{$prize_min}</span> and <span style="color:#428bca">{$prize_max}</span> satoshi.<br> <strong>Your earnings goes directly to your <a href="http://epay.info/" target="_blank">ePay</a> account</strong><br>
    
    
  </font>
  
    Our service depends on the revenue from displaying adverts.<br>
    Please deactivate your ad blocker to support us.<br><br>
    
   
    <div class="row_field">{$ads_main_top}</div>
   
    
    
    
    
    
    {if $captcha}<div class="rowfield"><div class="col-md-12 "><div class="alert alert-danger">That CAPTCHA was incorrect. Try again!</div></div></div>{/if}
    
    {if $inproccess}<div class="rowfield"><div class="col-md-12"><div class="alert alert-danger">ePay reported that you are trying to play sooner than you are supposed to.That's all we know</div></div></div>{/if}
    
    
    
    {if $nobtc}<div class="rowfield"><div class="col-md-12"><div class="alert alert-danger text-center">No Bitcoin address or ePay username found was entered!</div></div></div>{/if}
    
    
    {if $succ}
    <div class="rowfield">
      <div class="col-md-12">
        <div class="alert alert-success">
          <div class="col-xs-2" style="float:left">
            <img border="0" src="templates/style/images/wallet.png" align="middle" alt="bitcoin wallet">
            </div>
          <div class="col-xs-10" style="float:left; font-size:18px">
            {$succ} satoshi was sent to <strong><a href="http://ePay.info/Login/{$wallet}/" target="_blank" style="color:#464646"> your ePay.info account</a></strong>
            <br>
             </div>
          <div class="clearfix"></div>
          </div>
        </div>
      </div> 
    {/if}
    <Div class="clearfix"></Div> 
    
    
  <form action="" method="post">
    {if !$timer}
    <div class="form-group">
      <input class="form-control input-lg" type="text" value="{$wll}" name="wallet" id="wallet" placeholder="Bitcoin Address or ePay username" style="margin-bottom:10px;padding:20px;">
      </div>
    {/if}  
 
    <div class="row_field"><center>{$ads_1}</center></div>
<Div class="clearfix"></Div> 

     
	{if $timer}
    
    
    
    <div class="col-md-12">
        <strong style="font-size:18px">You can get a reward again in</strong><br>
        <div style="margin-top:10px"></div>
		<div class="col-xs-6 col-xs-push-4 row rowfield text-center">
			<div class="clock"></div>
		</div>
		<script type="text/javascript"> var diff = {$diff}; </script>
		<script type="text/javascript" src="templates/style/javascript/clock.js"></script>
	</div>
	{/if}
      
	<Div class="clearfix"></Div>      
      
	{if !$timer} 
    <Div class="row_field"><center>{$captcha_box}</center></div>
    {/if}
    
    <Div class="clearfix"></Div>      
    <div class="row_field"><center>{$ads_2}</center></div>
    
    
    {if !$timer}
    <div class="row rowfield">
		<div class="col-xs-4 text-center col-xs-push-4">
			<button type="submit" value="0" name="with" class="btn btn-lg btn-block btn-success" formtarget="_self">
    			Claim your prize NOW!!
			</button>
		</div>
	</div>
    {/if}
    
  </form>
    
    
    
    
    
    
    
    
    
    
  <center>
    <div style="margin-top: 15px;"></div>
    
    
    
  <font color="red"><font size="4"><div style="margin-top: 15px;"></div>
    <div class="well well-sm text-center">Earn {$ref_percent}% referral bonus! Share your referral URL:<br>http://www.{$domainname}/?r=ePay username,email or BTC address</div></font></font>
    <div style="margin-top: 12px;"></div>




    </center>
    
    
    
    
    
    <br>
    <font>Bitcoins is a payment system introduced as open-source software in 2009 by developer Satoshi Nakamoto. The payments in the system are recorded in a public ledger using its own unit of account, which is also called Bitcoins. Payments work peer-to-peer without a central repository or single administrator, which has led the US Treasury to call bitcoin a decentralized virtual currency.Although its status as a currency is disputed, media reports often refer to bitcoin as a cryptocurrency or digital currency.
  <br>					
      <br>
      Bitcoins are created as a reward for payment processing work in which users offer their computing power to verify and record payments into the public ledger. Called mining, individuals or companies engage in this activity in exchange for transaction fees and newly created bitcoins. Besides mining, bitcoins can be obtained in exchange for fiat money, products, and services. Users can send and receive bitcoins electronically for an optional transaction fee using wallet software on a personal computer, mobile device, or a web application.
      <br><br>
      Bitcoin as a form of payment for products and services has seen growth, and merchants have an incentive to accept the digital currency because fees are lower than the 2-3% typically imposed by credit card processors.The European Banking Authority has warned that bitcoin lacks consumer protections.Unlike credit cards, any fees are paid by the purchaser not the vendor. Bitcoins can be stolen and chargebacks are impossible. Commercial use of bitcoin is currently small compared to its use by speculators, which has fueled price volatility.
      <br><br>
      A Faucet gaves people free bitcoin. You can win bitcoin at a bitcoin faucet by solving things. To get free bitcoins or win free bitcoins you also can referrel with a multiplier of 0,2 to get free Satoshis for just placing a link. <a href="http://en.wikipedia.org/wiki/Bitcoin">
        <br>
        More Information on Bitcoin Wikipedia article</a>
      <br>
      
      
  </font> 

{$ads_main_bottom}  
  
{include file='footer.tpl'}