<?php
require_once "header.php";
require_once "../configs/prizes.php";

$db2=new DbConnector;
if( isset($_POST['new_price']) ){
	$prize=$_POST['prize'];
	$prepare=$db->mysqli->prepare("insert into tbl_prize (prize) values (?) ");
	$prepare->bind_param('i',$prize);
	$prepare->execute();
	$prepare->close();
	header('Location: prize.php');
	
	
	
}elseif( isset($_GET['a']) && $_GET['a']=='apply' ){	
	$db->query("select * from tbl_prize");
	while($res=$db->fetchArray())
		$prize.=$res['prize'].'*'.$res['chance'].',';	
$content = <<<END
<?php
\$rewards='$prize';
?>
END;
	$fp = fopen('../configs/prizes.php',"w");
	fwrite($fp,$content);
	fclose($fp);
	header('Location: prize.php');
}elseif( isset($_GET['a']) && $_GET['a']=='prize_up' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance+1 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
}elseif( isset($_GET['a']) && $_GET['a']=='prize_down' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance-1 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
}elseif( isset($_GET['a']) && $_GET['a']=='prize_upd' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance+2 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_upd5' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance+5 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_upd10' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance+10 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_upd20' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance+20 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_upd100' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance+100 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_upd200' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance+200 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_upd1000' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance+1000 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
	
	
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_downd' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance-2 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_downd5' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance-5 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_downd10' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance-10 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_downd20' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance-20 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');

}elseif( isset($_GET['a']) && $_GET['a']=='prize_downd100' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance-100 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');


}elseif( isset($_GET['a']) && $_GET['a']=='prize_downd200' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance-200 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');

}elseif( isset($_GET['a']) && $_GET['a']=='prize_downd1000' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance-1000 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');





	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_remove' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("delete from  tbl_prize where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');






}else{ 


?>
<table width="100%" class="table table-hover personal-task">

    <tr>
      <th width="25%" height="34">Prize</th>
      <th width="17%">Chance</th>
      <th width="58%">&nbsp;</th>
  </tr>

  <tbody>
<?php
$prizes=array();
$db->query("select * from tbl_prize  ");
if($db->rownum()>0){

while($res=$db->fetchArray()){
	array_push($prizes,$res['prize'].'*'.$res['chance']);
}

$chancer=get_rewards( implode(',',$prizes) );
}

$db->query("select * from tbl_prize order by chance desc");
while($res=$db->fetchArray()){
?>
    <tr>
      <td width="25%"><?php echo $res['prize']; ?> Satoshi</td>
      <td width="17%"><?php echo $chancer[$res['prize']]; ?></td>
      <td width="58%">
      
      Chance Up => 
      
      	<a href="?a=prize_up&pid=<?php echo $res['prize_id'];?>" title="Chance up x1">x1</a>
      
      
      	<a href="?a=prize_upd&pid=<?php echo $res['prize_id'];?>" title="Chance up x2">x2</a>
      
      	<a href="?a=prize_upd5&pid=<?php echo $res['prize_id'];?>" title="Chance up x5">x5</a>
      
      
      	<a href="?a=prize_upd10&pid=<?php echo $res['prize_id'];?>" title="Chance up x10">x10</a>
      
      
      	<a href="?a=prize_upd20&pid=<?php echo $res['prize_id'];?>" title="Chance up x20">x20</a>
      
      
      	<a href="?a=prize_upd100&pid=<?php echo $res['prize_id'];?>" title="Chance up x20">x100</a>
      
      	<a href="?a=prize_upd200&pid=<?php echo $res['prize_id'];?>" title="Chance up x20">x200</a>
      
      	<a href="?a=prize_upd1000&pid=<?php echo $res['prize_id'];?>" title="Chance up x20">x1000</a>
      
      
      

      

      
      

      
      <?php if($res['chance']>1){?>
      <br>
      Chance Down => 
      	<a href="?a=prize_down&pid=<?php echo $res['prize_id'];?>" title="Chance down low">x1</a>
      <?php } ?>
      
      
      <?php if($res['chance']>2){?>
      	<a href="?a=prize_downd&pid=<?php echo $res['prize_id'];?>" title="Chance down high">x2</a>
      <?php } ?>
      
      
      
      <?php if($res['chance']>5){?>
      	<a href="?a=prize_downd5&pid=<?php echo $res['prize_id'];?>" title="Chance down high">x5</a>
      <?php } ?>
      
      
      <?php if($res['chance']>10){?>
      	<a href="?a=prize_downd10&pid=<?php echo $res['prize_id'];?>" title="Chance down high">x10</a>
      <?php } ?>
      
      
      <?php if($res['chance']>20){?>
      	<a href="?a=prize_downd20&pid=<?php echo $res['prize_id'];?>" title="Chance down high">x20</a>
      <?php } ?>
      
      
      
      <?php if($res['chance']>100){?>
      	<a href="?a=prize_downd100&pid=<?php echo $res['prize_id'];?>" title="Chance down high">x100</a>
      <?php } ?>
      
      
      <?php if($res['chance']>200){?>
      	<a href="?a=prize_downd200&pid=<?php echo $res['prize_id'];?>" title="Chance down high">x200</a>
      <?php } ?>
      
      
      <?php if($res['chance']>1000){?>
      	<a href="?a=prize_downd1000&pid=<?php echo $res['prize_id'];?>" title="Chance down high">x1000</a>
      <?php } ?>
      
      
      
      <br>

      
      
      
      	<a href="?a=prize_remove&pid=<?php echo $res['prize_id'];?>"title="Remove">Remove</a>
      
      
      
      
      </td>
    </tr>
<?php } ?>
</tbody>
</table>


<form action="" method="post">



<table width="100%" border="0">
                  <tr align="center">
                    <th width="50%" align="center">Prize In satoshi</th>
                    <td width="50%">
                    
                    <input type="text" class="text" name="prize" >
                    
                    </td>
                  </tr>


                  <tr>
                    <td colspan="2" align="center">
                <button type="submit" name="new_price" class="button">Add</button>
                  
                    </td>
                  </tr>
                </table>
</form>

<center>
<a href="?a=apply"  class="button" style="width:200px;">Apply New prizes</a>
</center>


<?php } include("footer.php") ?>