<?php
require_once "header.php";
if(isset($_POST['save'])){
	
	
//  'analytic' => string 'alert('ttest');' (length=15)


$apicode=$_POST['api'];
$privkey=$_POST['spk'];
$verkey=$_POST['svk'];
$hashkey=$_POST['shk'];
$reflimit=$_POST['ref_earn'];
$ref_percent=$_POST['ref_percent'];
$sitetitle=$_POST['title'];
$domainname=$_POST['domain'];
$setinterval=$_POST['interval'];
$keywords=$_POST['keywords'];
$desc=$_POST['desc'];

$content = <<<END
<?php
\$apicode='$apicode';
\$privkey='$privkey';
\$verkey='$verkey';
\$hashkey='$hashkey';
\$reflimit='$reflimit';
\$ref_percent='$ref_percent';
\$sitetitle='$sitetitle';
\$domainname='$domainname';
\$setinterval='$setinterval';
\$keywords='$keywords';
\$desc='$desc';
END;
	
	$fp = fopen('../configs/configs.php',"w");
	fwrite($fp,$content);
	fclose($fp);


	$fp = fopen('../templates/style/javascript/analytic.js',"w");
	fwrite($fp,$_POST['analytic']);
	fclose($fp);

	header('Location: setting.php');
}else{
	require_once "../configs/configs.php";
?>

<form method="post">
<table width="100%" border="0" cellspacing="3" cellpadding="1">
  <tr>
    <th width="50%"><label for="status">ePay API</label></th>
    <td width="50%"><input type="text" name="api" id="api" class="text" value="<?php echo $apicode; ?>"/></td>
  </tr>
  <tr>
    <th>Google Analyitics</th>
    <td>
    <textarea name="analytic" class="text" rows="10"><?php echo file_get_contents('../templates/style/javascript/analytic.js');?></textarea><br>
    Without <code> &lt;script> &lt;/script> </code>
    </td>
  </tr>
  <tr>
    <th>Solvemedia - Private Key</th>
    <td><input type="text" name="spk" id="spk" class="text" value="<?php echo $privkey; ?>"/></td>
  </tr>
  <tr>
    <th>Solvemedia - Hash Key</th>
    <td><input type="text" name="shk" id="shk" class="text" value="<?php echo $hashkey; ?>"/></td>
  </tr>
  <tr>
    <th>Solvemedia - Verification Key</th>
    <td><input type="text" name="svk" id="svk" class="text" value="<?php echo $verkey; ?>"/></td>
  </tr>
  <tr>
    <th>Site Domain</th>
    <td>http://<input type="text" name="domain" id="domain" class="text" value="<?php echo $domainname; ?>"/></td>
  </tr>
  <tr>
    <th>Site Title</th>
    <td><input type="text" name="title" id="title" class="text" value="<?php echo $sitetitle; ?>"/></td>
  </tr>
  <tr>
    <th>Site keywords</th>
    <td>
     <textarea name="keywords" class="text" rows="10"><?php echo $keywords; ?></textarea>
    </td>
  </tr>
  <tr>
    <th>Site description</th>
    <td><textarea name="desc" class="text" rows="10"><?php echo $desc; ?></textarea>
    </td>
  </tr>
  <tr>
    <th>Prize Intervals</th>
    <td><input type="text" name="interval" id="interval" class="text" value="<?php echo $setinterval; ?>"/></td>
  </tr>
  <tr>
    <th>Referral Percent</th>
    <td><input type="text" name="ref_percent" id="ref_percent" class="text" value="<?php echo $ref_percent; ?>"/></td>
  </tr>
  <tr>
    <th><p>Minimum referral earning to send</p></th>
    <td><input type="text" name="ref_earn" id="ref_earn" class="text" value="<?php echo $reflimit; ?>"/>Satoshi</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input class="button" type="submit" name="save" id="button" value="Save" /></td>
  </tr>
</table>
</form>







<?php  }include("footer.php") ?>