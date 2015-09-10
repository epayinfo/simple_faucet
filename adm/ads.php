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

	$fp = fopen('../ads/bottom.php',"w");
	fwrite($fp,$_POST['bottom']);
	fclose($fp);





	header('Location: ads.php');
}else{
?>

<form method="post">
<table width="100%" border="0" cellspacing="3" cellpadding="1">
  <tr>
    <th width="9%">Left</th>
    <td width="91%">
      <textarea name="left" class="text" rows="10"><?php echo file_get_contents('../ads/left.php');?></textarea><br></td>
  </tr>
  <tr>
    <th>Top</th>
    <td>
      <textarea name="top" class="text" rows="10"><?php echo file_get_contents('../ads/top.php');?></textarea>
      </td>
  </tr>
  <tr>
    <th>Right</th>
    <td><textarea name="right" class="text" rows="10"><?php echo file_get_contents('../ads/right.php');?></textarea>
      </td>
  </tr>
  <tr>
    <th>Ad1</th>
    <td><textarea name="ad1" class="text" rows="10"><?php echo file_get_contents('../ads/ad1.php');?></textarea></td>
  </tr>
  <tr>
    <th>Ad2</th>
    <td><textarea name="ad2" class="text" rows="10"><?php echo file_get_contents('../ads/ad2.php');?></textarea></td>
  </tr>
  <tr>
    <th>Bottom</th>
    <td><textarea name="bottom" class="text" rows="10"><?php echo file_get_contents('../ads/bottom.php');?></textarea></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input class="button" type="submit" name="save" id="button" value="Save" /></td>
  </tr>
</table>
</form>
<?php  }include("footer.php") ?>