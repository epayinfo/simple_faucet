<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="<?php echo $desc; ?>">
	<meta name="keywords" content="<?php echo $keywords; ?>">
	<title>
		<?php echo $title; ?>
	</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<?php if($timer){ ?>
	<link href="//cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.css" rel="stylesheet">
	<?php } ?>
	<link rel="stylesheet" type="text/css" href="templates/style/css/style.css">
	<script src="//code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>
	<?php if($recap_active){ ?>
	<script src="//www.google.com/recaptcha/api.js" type="text/javascript"></script>
	<?php } ?>
	<script src="templates/style/javascript/analytic.js" type="text/javascript"></script>
</head>

<body>
	<div class="container-fluid">
		<div class="col-md-3 hidden-xs text-center ad_left" style="padding-top:35px;">
			<?php echo $ads_left[$adi%$ads_left_count]; ?>
		</div>
		<div class="col-md-7 main_area">
			<a href="index.php">
				<div class="text-center">
					<h1>
						<?php echo $title; ?>
					</h1>
				</div>
			</a>
			<Div class="row text-center" style="font-size:20px;"> Every
				<?php echo $setinterval; ?> minutes you can earn between <span style="color:#428bca"><?php echo $prize_min; ?></span> and <span style="color:#428bca"><?php echo $prize_max; ?></span>
				<?php echo $currency_name; ?><br> <strong>Your earnings goes directly to your <a href="http://epay.info/" target="_blank">ePay</a> account</strong> </Div>
			<Div class="row text-center"> Our service depends on the revenue from displaying adverts.<br> Please deactivate your ad blocker to support us.<br><br> </Div>
			<div class="row">
				<center>
					<?php echo $ads_main_top[$adi%$ads_main_top_count]; ?>
				</center>
			</div>
			<div class="row" style="margin-top:5px;">
				<div class="col-md-10 col-md-push-1">
					<div class="alert alert-success text-center">We have
						<?php echo $faucet_balance; ?>
					</div>
				</div>
			</div>
			<?php if(isset($error)){ ?>
			<div class="row" style="margin-top:5px;">
				<div class="col-md-10 col-md-push-1">
					<div class="alert alert-danger text-center">
						<?php echo $error; ?>
					</div>
				</div>
			</div>
			<?php } elseif(isset($succ)){ ?>
			<div class="row" style="margin-top:5px;">
				<div class="col-md-10 col-md-push-1">
					<div class="alert alert-success text-center"> <strong><?php echo $succ; ?></strong>
						<?php echo $currency_name; ?> was sent to <strong><a href="https://epay.info/check/<?php echo $wallet; ?>" target="_blank" style="color:#464646"> your ePay.info account</a></strong> </div>
				</div>
			</div>
			<?php } ?>
			<Div class="clearfix"></Div>
			<?php if($adb){ ?>
			<div class="row" style="margin-top:5px; display:none;" id="frm_adblocker_detect">
				<div class="col-md-10 col-md-push-1">
					<div class="alert alert-danger text-center"> Please deactivate your adblocker. </div>
				</div>
			</div>
			<noscript>
				<div class="row" style="margin-top:5px; display:none;" id="frm_adblocker_detect">
					<div class="col-md-10 col-md-push-1">
						<div class="alert alert-danger text-center"> Please activate javascript in your browser. </div>
					</div>
				</div>
			</noscript>
			<?php } ?>
				<?php if($anti_bot){?>
				<div class="row" style="margin-top:5px;">
					<div class="col-md-10 col-md-push-1 text-center">
						<?php echo $abinf; ?>
					</div>
				</div>
				<?php } ?>
				<form action="" method="post" id="frm_contain">
					<?php if($anti_bot > 3){ ?>
					<center>
						<?php echo $ab4; ?>
					</center>
					<?php } ?>
					<?php if(!$timer and ($faucet_steps==1 or $step==1) ){ ?>
					<div class="row">
						<div class="col-md-10 col-md-push-1">
							<div class="form-group" style="margin-top:5px;margin-bottom:5px;"> <input class="form-control input-lg" type="text" value="<?php echo $wll; ?>" name="wallet" id="wallet" placeholder="Bitcoin Address or ePay username" style="padding:20px;"> </div>
						</div>
					</div>
					<?php } ?>
					<div style="margin-top:5px;"></div>
					<div class="row">
						<center>
							<?php echo $ads_1[$adi%$ads_1_count]; ?>
						</center>
					</div>
					<?php if($anti_bot){ ?>
					<center>
						<?php echo $ab1; ?>
					</center>
					<?php } ?>
					<Div class="clearfix"></Div>
					<?php if($timer){ ?>
					<div class="col-md-6 text-center col-md-push-3"> <strong style="font-size:18px">You can get a reward again in</strong><br>
						<div style="margin-top:10px"></div>
						<div class="clock"></div>
						<script type="text/javascript">
						var diff = <?php echo $diff; ?>;
						</script>
						<script src="templates/style/javascript/clock.js"></script>
						<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js"></script>
					</div>
					<?php } ?>
					<Div class="clearfix"></Div>
					<?php if(($faucet_steps==1 or $step==2) and !$timer  ){ ?>
					<Div class="row" style="margin-top:5px;">
						<Div class="col-md-6 col-md-push-3">
							<?php if($solvemedia_active && $recap_active){ ?>
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#solvmedia" aria-controls="solvmedia" role="tab" data-toggle="tab">Solvemedia</a></li>
								<li role="presentation"><a href="#recaptcha" aria-controls="recaptcha" role="tab" data-toggle="tab">Recaptcha</a></li>
							</ul>
							<?php } ?>
							<div class="tab-content">
								<?php if($solvemedia_active){ ?>
								<div role="tabpanel" class="tab-pane active" id="solvmedia">
									<center>
										<?php echo $solvemedia_box; ?>
									</center>
								</div>
								<?php } ?>
								<?php if($recap_active){ ?>
								<div role="tabpanel" class="tab-pane <?php if(!$solvemedia_active){ ?>active<?php } ?>" id="recaptcha">
									<center>
										<?php echo $recaptcha_box; ?>
									</center>
								</div>
								<?php } ?> </div>
						</Div>
					</Div> <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token; ?>" />
					<?php } ?>
					<?php if($anti_bot > 1){ ?>
					<center>
						<?php echo $ab2; ?>
					</center>
					<?php } ?>
					<Div class="clearfix"></Div>
					<div class="row" style="margin-top:5px;">
						<center>
							<?php echo $ads_2[$adi%$ads_2_count]; ?>
						</center>
					</div>
					<?php if(!$timer){ ?>
					<div class="row" style="margin-top:5px;">
						<div class="col-xs-4 text-center col-xs-push-4">
							<?php if($faucet_steps==1 or $step==2 ){ ?>
							<?php if($anti_bot > 2){ ?>
							<center>
								<?php echo $ab3; ?>
							</center>
							<?php } ?>
							<?php if($anti_bot){ ?> <input type="hidden" name="antibotlinks" id="antibotlinks" value="" data-click="<?php echo $anti_bot; ?>" />
							<?php } else { ?><button type="submit" name="with" class="btn btn-lg btn-block btn-success" id="claim" <?php if($bwait){ ?>disabled data-time="<?php echo $bwait; ?>"<?php } ?> >Claim your prize NOW!!</button>
							<?php } ?>
							<?php }else{ ?> <button type="submit" name="step2" class="btn btn-lg btn-block btn-success" id="claim" <?php if($bwait){ ?> disabled data-time="<?php echo $bwait; ?>"<?php } ?> >Next Step</button>
							<?php } ?> </div>
					</div>
					<?php } ?>
					<?php if($anti_bot > 4){ ?>
					<center>
						<?php echo $ab5; ?>
					</center>
					<?php } ?> </form>
				<Div class="row" style="margin-top:5px; font-size:18px;">
					<Div class="col-md-10 col-md-push-1">
						<div class="well well-sm text-center">Earn
							<?php echo $ref_percent; ?>% referral bonus! Share your referral URL<br>
							<?php echo $domainname; ?>/?r=ePay username,email or BTC address</div>
					</Div>
				</Div>
				<div class="row" style="margin-bottom:5px;">
					<center>
						<?php echo $ads_3[$adi%$ads_3_count]; ?>
					</center>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<center>
						<?php echo $ads_main_bottom[$adi%$ads_main_bottom_count]; ?>
					</center>
				</div>
				<footer class="text-center"> © Copyright
					<?php echo $year; ?>
					<a href="<?php echo $domainname; ?>">
						<?php echo $title; ?>
					</a><br> Generated by <a href="http://epay.info" target="_blank">ePay.info</a> - 2014-
					<?php echo $year; ?> </footer> <br> </div>
			<div class="col-md-2 hidden-xs text-center" style="padding-top:35px;">
				<?php echo $ads_right[$adi%$ads_right_count]; ?>
			</div>
		</div>
		<?php if($adb){ ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fuckadblock/3.2.1/fuckadblock.js" integrity="sha256-4/8cdZfUJoNm8DLRzuKwvhusQbdUqVov+6bVj9ewL7U=" crossorigin="anonymous"></script>
		<script>
		function adBlockDetected() {
			$('#frm_contain').remove();
			$('#frm_adblocker_detect').show();
		}
		if(typeof fuckAdBlock === 'undefined')adBlockDetected();
		else fuckAdBlock.onDetected(adBlockDetected);
		</script>
		<?php } ?>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="templates/style/javascript/common.js" type="text/javascript"></script>
</body>

</html>