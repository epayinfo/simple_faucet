<?php
require_once "header.php";
if(isset($_POST['save'])){
	$fp = fopen('../ads/left.php',"w");
	fwrite($fp,$_POST['left']);
	fclose($fp);

	$fp = fopen('../ads/top.php',"w");
	fwrite($fp,$_POST['top']);
	fclose($fp);

	$fp = fopen('../ads/right.php',"w");
	fwrite($fp,$_POST['right']);
	fclose($fp);

	$fp = fopen('../ads/ad1.php',"w");
	fwrite($fp,$_POST['ad1']);
	fclose($fp);

	$fp = fopen('../ads/ad2.php',"w");
	fwrite($fp,$_POST['ad2']);
	fclose($fp);

	$fp = fopen('../ads/ad3.php',"w");
	fwrite($fp,$_POST['ad3']);
	fclose($fp);

	$fp = fopen('../ads/bottom.php',"w");
	fwrite($fp,$_POST['bottom']);
	fclose($fp);
	header('Location: ads.php');
}else{
?>
<form method="post">
	<Div class="row">
		<div class="form-group">
			<label for="exampleInputEmail1">Left</label>
			<textarea name="left" class="form-control" rows="10"><?php echo file_get_contents('../ads/left.php');?></textarea>
		</div>
	
		<div class="form-group">
			<label for="exampleInputEmail1">Top</label>
			<textarea name="top" class="form-control" rows="10"><?php echo file_get_contents('../ads/top.php');?></textarea>
		</div>
	
	
		<div class="form-group">
			<label for="exampleInputEmail1">Right</label>
			<textarea name="right" class="form-control" rows="10"><?php echo file_get_contents('../ads/right.php');?></textarea>
		</div>
	
		<div class="form-group">
			<label for="exampleInputEmail1">Ad1</label>
			<textarea name="ad1" class="form-control" rows="10"><?php echo file_get_contents('../ads/ad1.php');?></textarea>
		</div>
	
		<div class="form-group">
			<label for="exampleInputEmail1">Ad2</label>
			<textarea name="ad2" class="form-control" rows="10"><?php echo file_get_contents('../ads/ad2.php');?></textarea>
		</div>
	
		<div class="form-group">
			<label for="exampleInputEmail1">Ad3</label>
			<textarea name="ad3" class="form-control" rows="10"><?php echo file_get_contents('../ads/ad3.php');?></textarea>
		</div>
	
		<div class="form-group">
			<label for="exampleInputEmail1">Bottom</label>
			<textarea name="bottom" class="form-control" rows="10"><?php echo file_get_contents('../ads/bottom.php');?></textarea>
		</div>
		<button type="submit" name="save" class="btn btn-success col-md-3 col-md-push-4">Save</button>
	</Div>
</form><br>

<?php  }include("footer.php") ?>