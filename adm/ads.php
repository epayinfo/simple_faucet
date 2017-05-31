<?php
require_once "header.php";
if(isset($_POST['save'])){
	$ads_left=explode("\n",$_POST['left']);
	$ads_main_top=explode("\n",$_POST['top']);
	$ads_right=explode("\n",$_POST['right']);
	$ads_1=explode("\n",$_POST['ad1']);
	$ads_2=explode("\n",$_POST['ad2']);
	$ads_3=explode("\n",$_POST['ad3']);
	$ads_main_bottom=explode("\n",$_POST['bottom']);
$content = "<?php
\$ads_left=".var_export($ads_left,true).";
\$ads_left_count=".count($ads_left).";
\$ads_main_top=".var_export($ads_main_top,true).";
\$ads_main_top_count=".count($ads_main_top).";
\$ads_right=".var_export($ads_right,true).";
\$ads_right_count=".count($ads_right).";
\$ads_1=".var_export($ads_1,true).";
\$ads_1_count=".count($ads_1).";
\$ads_2=".var_export($ads_2,true).";
\$ads_2_count=".count($ads_2).";
\$ads_3=".var_export($ads_3,true).";
\$ads_3_count=".count($ads_3).";
\$ads_main_bottom=".var_export($ads_main_bottom,true).";
\$ads_main_bottom_count=".count($ads_main_bottom).";
";
	$fp = fopen('../configs/ads.php',"w");
	fwrite($fp,$content);
	fclose($fp);
}else include "../configs/ads.php";
?>
<form method="post">
	<Div class="row">
		<div class="form-group">
			<label for="exampleInputEmail1">Left</label>
			<textarea name="left" class="form-control" rows="10"><?php echo implode("\n",$ads_left);?></textarea>
		</div>
	
		<div class="form-group">
			<label for="exampleInputEmail1">Top</label>
			<textarea name="top" class="form-control" rows="10"><?php echo implode("\n",$ads_main_top);?></textarea>
		</div>
	
	
		<div class="form-group">
			<label for="exampleInputEmail1">Right</label>
			<textarea name="right" class="form-control" rows="10"><?php echo implode("\n",$ads_right);?></textarea>
		</div>
	
		<div class="form-group">
			<label for="exampleInputEmail1">Ad1</label>
			<textarea name="ad1" class="form-control" rows="10"><?php echo implode("\n",$ads_1);?></textarea>
		</div>
	
		<div class="form-group">
			<label for="exampleInputEmail1">Ad2</label>
			<textarea name="ad2" class="form-control" rows="10"><?php echo implode("\n",$ads_2);?></textarea>
		</div>
	
		<div class="form-group">
			<label for="exampleInputEmail1">Ad3</label>
			<textarea name="ad3" class="form-control" rows="10"><?php echo implode("\n",$ads_3);?></textarea>
		</div>
	
		<div class="form-group">
			<label for="exampleInputEmail1">Bottom</label>
			<textarea name="bottom" class="form-control" rows="10"><?php echo implode("\n",$ads_main_bottom);?></textarea>
		</div>
		<button type="submit" name="save" class="btn btn-success col-md-3 col-md-push-4">Save</button>
	</Div>
</form><br>

<?php include("footer.php") ?>