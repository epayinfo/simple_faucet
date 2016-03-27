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
	<script  src="templates/style/javascript/analytic.js" type="text/javascript"></script>
	<script src="//www.google.com/recaptcha/api.js" type="text/javascript"></script>
	{if $adb}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fuckadblock/3.2.1/fuckadblock.min.js" type="text/javascript"></script>
	{/if}
</head>
<body>
<div class="container-fluid">
	<div class="col-md-3 hidden-xs text-center ad_left" style="padding-top:35px;">{$ads_left}</div>
	<div class="col-md-7 main_area">
        <a href="index.php" ><div class="text-center"><h1>{$title}</h1></div></a>