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









<table class="table table-hover table-striped">

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
      <td width="25%"><?php echo $res['prize']; ?></td>
      <td width="17%"><?php echo $chancer[$res['prize']]; ?></td>
      <td width="58%">
      
<Div class="row text-left" style="margin-bottom:5px;">
	  
      <Div class="col-md-3">Chance Up =>  </Div>
      
      	<a href="?a=prize_up&pid=<?php echo $res['prize_id'];?>" title="Chance up x1" class="btn btn-success btn-xs">x1</a>
      
      
      	<a href="?a=prize_upd&pid=<?php echo $res['prize_id'];?>" title="Chance up x2" class="btn btn-success btn-xs">x2</a>
      
      	<a href="?a=prize_upd5&pid=<?php echo $res['prize_id'];?>" title="Chance up x5" class="btn btn-success btn-xs">x5</a>
      
      
      	<a href="?a=prize_upd10&pid=<?php echo $res['prize_id'];?>" title="Chance up x10" class="btn btn-success btn-xs">x10</a>
      
      
      	<a href="?a=prize_upd20&pid=<?php echo $res['prize_id'];?>" title="Chance up x20" class="btn btn-success btn-xs">x20</a>
      
      
      	<a href="?a=prize_upd100&pid=<?php echo $res['prize_id'];?>" title="Chance up x20" class="btn btn-success btn-xs">x100</a>
      
      	<a href="?a=prize_upd200&pid=<?php echo $res['prize_id'];?>" title="Chance up x20" class="btn btn-success btn-xs">x200</a>
      
      	<a href="?a=prize_upd1000&pid=<?php echo $res['prize_id'];?>" title="Chance up x20" class="btn btn-success btn-xs">x1000</a>
      
      
      
</Div>
      

      
      

      <Div class="row">
      <?php if($res['chance']>1){?>
       
      <Div class="col-md-3"> Chance Down =>  </Div>
      	<a href="?a=prize_down&pid=<?php echo $res['prize_id'];?>" title="Chance down low" class="btn btn-warning btn-xs">x1</a>
      <?php } ?>
      
      
      <?php if($res['chance']>2){?>
      	<a href="?a=prize_downd&pid=<?php echo $res['prize_id'];?>" title="Chance down high" class="btn btn-warning btn-xs">x2</a>
      <?php } ?>
      
      
      
      <?php if($res['chance']>5){?>
      	<a href="?a=prize_downd5&pid=<?php echo $res['prize_id'];?>" title="Chance down high" class="btn btn-warning btn-xs">x5</a>
      <?php } ?>
      
      
      <?php if($res['chance']>10){?>
      	<a href="?a=prize_downd10&pid=<?php echo $res['prize_id'];?>" title="Chance down high" class="btn btn-warning btn-xs">x10</a>
      <?php } ?>
      
      
      <?php if($res['chance']>20){?>
      	<a href="?a=prize_downd20&pid=<?php echo $res['prize_id'];?>" title="Chance down high" class="btn btn-warning btn-xs">x20</a>
      <?php } ?>
      
      
      
      <?php if($res['chance']>100){?>
      	<a href="?a=prize_downd100&pid=<?php echo $res['prize_id'];?>" title="Chance down high" class="btn btn-warning btn-xs">x100</a>
      <?php } ?>
      
      
      <?php if($res['chance']>200){?>
      	<a href="?a=prize_downd200&pid=<?php echo $res['prize_id'];?>" title="Chance down high" class="btn btn-warning btn-xs">x200</a>
      <?php } ?>
      
      
      <?php if($res['chance']>1000){?>
      	<a href="?a=prize_downd1000&pid=<?php echo $res['prize_id'];?>" title="Chance down high" class="btn btn-warning btn-xs">x1000</a>
      <?php } ?>
      
      
      
      </Div>

      
       <Div class="row">
      
      	<Div class="col-md-3"> <a href="?a=prize_remove&pid=<?php echo $res['prize_id'];?>"title="Remove" class="btn btn-danger btn-xs">Remove</a> </Div>
      
      </Div>
      
      
      </td>
    </tr>
<?php } ?>
</tbody>
</table>







<Div class="well">

	<form action="" method="post">
		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Prize In satoshi</label>
			<input type="number" class="form-control" name="prize" >
		</div>
		
		<button type="submit" name="new_price" class="btn btn-success col-md-3 col-md-push-4">Add</button>

		<div class="clearfix"></div>
		
	
	</form>


</Div>


<Div class="well">

	<a href="?a=apply"  class="btn btn-primary col-md-3 col-md-push-4 btn-lg">Apply New prizes</a>


	<div class="clearfix" style="margin-top:20px;"></div>
<br>

	<Div class="alert alert-info">
		Remember to apply new prizes after change to take effect.
	
	</Div>



</Div>



<?php } include("footer.php") ?>