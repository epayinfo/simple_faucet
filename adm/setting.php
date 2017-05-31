<?php
require_once "header.php";
if(isset($_POST['save'])){
	$bwait=$_POST['bwait'];
	$currency=$_POST['currency'];
	$apicode=$_POST['api'];
	$privkey=$_POST['spk'];
	$verkey=$_POST['svk'];
	$hashkey=$_POST['shk'];
	$ref_percent=$_POST['ref_percent'];
	$sitetitle=$_POST['title'];
	$domainname=$_POST['domain'];
	$setinterval=$_POST['interval'];
	$keywords=$_POST['keywords'];
	$desc=$_POST['desc'];
	$captcha_ws_key=$_POST['captcha_ws_key'];
	$recap_site=$_POST['recap_site'];
	$recap_secret=$_POST['recap_secret'];

	$anti_bot=$_POST['anti_bot'];
	if($anti_bot > 5)$anti_bot=5;	
	if($anti_bot < 3)$anti_bot=3;

	$faucet_steps=$_POST['faucet_steps'];

	if(isset($_POST['adb']))$adb=1;else$adb=0;
	if(isset($_POST['captcha_ws_active']))$captcha_ws_active=1;else$captcha_ws_active=0;
	if(isset($_POST['solvemedia_active']))$solvemedia_active=1;else$solvemedia_active=0;
	if(isset($_POST['recap_active']))$recap_active=1;else$recap_active=0;
$content = <<<END
<?php
\$faucet_steps=$faucet_steps;
\$adb=$adb;
\$bwait=$bwait;
\$currency=$currency;
\$apicode='$apicode';
\$privkey='$privkey';
\$verkey='$verkey';
\$hashkey='$hashkey';
\$ref_percent=$ref_percent;
\$sitetitle='$sitetitle';
\$domainname='$domainname';
\$setinterval=$setinterval;
\$keywords='$keywords';
\$desc='$desc';
\$solvemedia_active=$solvemedia_active;
\$recap_active=$recap_active;
\$recap_site='$recap_site';
\$recap_secret='$recap_secret';
\$anti_bot=$anti_bot;

END;
	$fp = fopen('../configs/configs.php',"w");
	fwrite($fp,$content);
	fclose($fp);

	$fp = fopen('../templates/style/javascript/analytic.js',"w");
	fwrite($fp,$_POST['analytic']);
	fclose($fp);
}
?>
<style>
.tab-pane {
	padding-top: 10px;
}
</style>
<form method="post">
	<Div class="row">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#faucet" aria-controls="faucet" role="tab" data-toggle="tab">Faucet</a></li>
			<li role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
			<li role="presentation"><a href="#solvemedia" aria-controls="solvemedia" role="tab" data-toggle="tab">Solvemedia</a></li>
			<li role="presentation"><a href="#recaptcha" aria-controls="recaptcha" role="tab" data-toggle="tab">Recaptcha</a></li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active fade in" id="faucet">
				<Div class="row">
					<div class="col-md-6">
						<div class="form-group"> <label class="control-label">Currency</label>
							<select class="form-control" name="currency">
								<option <?php if($currency==1) echo 'selected'; ?> value="1" >Bitcoin</option>
								<option <?php if($currency==4) echo 'selected'; ?> value="4" >Dogecoin</option>
								<option <?php if($currency==5) echo 'selected'; ?> value="5" >Litecoin</option>
								<option <?php if($currency==6) echo 'selected'; ?> value="6">Ethereum</option>
								<option <?php if($currency==7) echo 'selected'; ?> value="7">Dash</option>					
								<option <?php if($currency==9) echo 'selected'; ?> value="9">Peercoin</option>					
								<option <?php if($currency==10) echo 'selected'; ?> value="10">Primecoin</option>					
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Faucet Type</label>
							<select class="form-control" name="faucet_steps">
								<option <?php if($faucet_steps==1) echo 'selected'; ?> value="1" >One Step (Address, Captcha in one step)</option>
								<option <?php if($faucet_steps==2) echo 'selected'; ?> value="2" >Two Step (Address then captcha in two step) </option>
							</select>
						</div>
					</div>
				</Div>
				<div class="form-group"> <label for="exampleInputEmail1">ePay API</label> <input type="text" name="api" class="form-control" value="<?php echo $apicode; ?>" placeholder="Your ePay.info API key" /> </div>
				<Div class="row">
					<div class="col-md-6">
						<div class="form-group"> <label for="exampleInputEmail1">Claim Button Waiting time (Seconds)</label> <input type="number" name="bwait" id="bwait" class="form-control" value="<?php echo $bwait; ?>" /> <small>Enter 0 to deactivate</small> </div>
					</div>
					<div class="col-md-6">
						<div class="form-group"> <label for="exampleInputEmail1">Faucet Timer (Minutes)</label> <input type="number" name="interval" id="interval" class="form-control" value="<?php echo $setinterval; ?>" /> </div>
					</div>
				</Div>
				<Div class="row">
					<div class="col-md-6">
						<div class="form-group"> <label for="exampleInputEmail1">Referral Percent (%)</label> <input type="number" name="ref_percent" id="ref_percent" class="form-control" value="<?php echo $ref_percent; ?>" /> <small>Enter 0 to deactivate</small> </div>
					</div>
					<div class="col-md-6">
						<div class="form-group"> <label for="exampleInputEmail1">Number of Anti-Bot links</label> <input type="number" name="anti_bot" id="ref_percent" class="form-control" value="<?php echo $anti_bot; ?>" /> <small>Enter 0 to deactivate.<br>Max 5 links</small> </div>
					</div>
				</Div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="adb" <?php if($adb==1) echo 'checked'; ?> value="1"> Prevent Ad blocker from playing
					</label> 
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="general">
				<div class="form-group"> <label for="exampleInputEmail1">Site Domain</label> <input type="text" name="domain" id="domain" class="form-control" value="<?php echo $domainname; ?>" /> </div>
				<div class="form-group"> <label for="exampleInputEmail1">Site Title</label> <input type="text" name="title" id="title" class="form-control" value="<?php echo $sitetitle; ?>" /> </div>
				<div class="form-group"> <label for="exampleInputEmail1">Site keywords</label> <textarea name="keywords" class="form-control" rows="10"><?php echo $keywords; ?></textarea> </div>
				<div class="form-group"> <label for="exampleInputEmail1">Site description</label> <textarea name="desc" class="form-control" rows="10"><?php echo $desc; ?></textarea> </div>
				<div class="form-group"> <label for="exampleInputEmail1">Google Analyitics</label> <textarea name="analytic" class="form-control" rows="10"><?php echo file_get_contents('../templates/style/javascript/analytic.js');?></textarea><br> Without <code> &lt;script> &lt;/script> </code> </div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="solvemedia">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="solvemedia_active" <?php if($solvemedia_active==1) echo 'checked'; ?> value="1"> Activate
					</label>
				</div>
				<div class="form-group"> <label for="exampleInputEmail1">Challenge Key (C-key)</label> <input type="text" name="spk" id="spk" class="form-control" value="<?php echo $privkey; ?>" /> </div>
				<div class="form-group"> <label for="exampleInputEmail1">Verification Key (V-key)</label> <input type="text" name="shk" id="shk" class="form-control" value="<?php echo $hashkey; ?>" /> </div>
				<div class="form-group"> <label for="exampleInputEmail1">Authentication Hash Key (H-key)</label> <input type="text" name="svk" id="svk" class="form-control" value="<?php echo $verkey; ?>" /> </div> Get your keys from <a href="http://solvemedia.com/" target="_blank">Solvemedia.com</a>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="recaptcha">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="recap_active" <?php if($recap_active==1) echo 'checked'; ?> value="1"> Activate
					</label>
				</div>
				<div class="form-group"> <label for="exampleInputEmail1">Site Key</label> <input type="text" name="recap_site" class="form-control" value="<?php echo $recap_site; ?>" /> </div>
				<div class="form-group"> <label for="exampleInputEmail1">Secret Key</label> <input type="text" name="recap_secret" class="form-control" value="<?php echo $recap_secret; ?>" /> </div> Get your keys from <a href="https://www.google.com/recaptcha/intro/index.html" target="_blank">Here</a>
			</div>
		</div>
	</Div>
	<div class="row"> <button type="submit" name="save" class="btn btn-success col-md-3 col-md-push-4">Submit</button> </div>
</form>
<?php  include("footer.php") ?>