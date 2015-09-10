<?php require_once('header.php');
if(isset($_POST['login']) ){
	$ss=new SystemComponent;
	$info=$ss->getSetting();
	if($info['adminpass']==hash('SHA256',$_POST['pass']) ){
		$_SESSION['admin_loged']=true;
		header('Location: index.php');
		die();
	}else{
		header('Location: login.php?error=1');
		die();
	}
}else{
 ?>
<center>
                        <form action="" method="post">
                <table width="60%" border="0">
                  <tr>
                    <td width="52%" align="center">Pass Phrase</td>
                    <th width="48%"><input style="direction:ltr" name="pass" type="password" class="text" id="pass" /></th>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><input type="submit" name="login" id="button" value="Login" class="button"/>
                <?php if(isset($_GET ['out'])){ ?> <br><br>
<div class="successful">Logout was successful</div>
<?php }else if(isset($_GET['error'])){ ?><br><br>
<div class="error">Login failed</div>
<?php } ?>
                  
                    </td>
                  </tr>
                </table>

                </form>
                
                </center>
<?php }require_once('footer.php'); ?>