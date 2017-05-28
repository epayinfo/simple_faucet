<?php
require_once "header.php";
require_once "../configs/prizes.php";
require_once "../configs/configs.php";

if( isset($_POST['new_price']) ){
	$prize=$_POST['prize'];
	$prepare=$db->mysqli->prepare("insert into tbl_prize (prize) values (?) ");
	$prepare->bind_param('i',$prize);
	$prepare->execute();
	$prepare->close();
}
if(isset($_GET['a'])){
	if($_GET['a']=='apply' ){
        $db->query("select * from tbl_prize");
        $totalMultiplier = 0;
        while($res=$db->fetchArray()){
            $prize.=$res['prize'].'=>'.$res['chance'].',';
            $totalMultiplier += $res['chance'];
            }
$content = <<<END
<?php
\$rewards=array($prize);
\$totalMultiplier=$totalMultiplier;
?>
END;
        $fp = fopen('../configs/prizes.php',"w");
        fwrite($fp,$content);
        fclose($fp);
    }else{
		$pid=$_GET['pid'];
		if($_GET['a']=='prize_remove'){
			$prepare=$db->mysqli->prepare("delete from  tbl_prize where prize_id=? ");
		}else{
			switch($_GET['a']){
				case 'prize_up': $c='+1'; break;
				case 'prize_down': $c='-1'; break;
				case 'prize_upd': $c='+2'; break;
				case 'prize_upd5': $c='+5'; break;
				case 'prize_upd10': $c='+10'; break;
				case 'prize_upd20': $c='+20'; break;
				case 'prize_upd100': $c='+100'; break;
				case 'prize_upd200': $c='+200'; break;
				case 'prize_upd1000': $c='+1000'; break;
				case 'prize_downd': $c='-2'; break;
				case 'prize_downd5': $c='-5'; break;
				case 'prize_downd10': $c='-10'; break;
				case 'prize_downd20': $c='-20'; break;
				case 'prize_downd100': $c='-100'; break;
				case 'prize_downd200': $c='-200'; break;
				case 'prize_downd1000': $c='-1000'; break;
			}
			$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance".$c." where prize_id=? ");
		}
		$prepare->bind_param('i',$pid);
		$prepare->execute();
	}
	header('Location: prize.php');
}else{ ?>
	<Div class="alert alert-danger"> Remember to apply new prizes after change to take effect. </Div>
	<?php if($currency==6){	?>
	<Div class="alert alert-success">
		<h3 style="padding: 0; margin: 0">Note</h3> Prizes must be in <strong>Gwei</strong> format.<br> <a href="http://ether.fund/tool/converter" target="_blank"> Converter</a><br> For e.g. 100 Gwei is 0.0000001 ETH </Div>
	<?php } ?>
	<?php if($currency==4){	?>
	<Div class="alert alert-success">
		<h3 style="padding: 0; margin: 0">Note</h3> Prizes must be in full coin format.<br> for e.g 1 Doge, 2 Doge, 5 Doge </Div>
	<?php } ?>
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
    $totalMultiplier=0;
    while($res=$db->fetchArray()){
        $prizes[$res['prize']] = $res['chance'];
        $totalMultiplier+=$res['chance'];
    }

    foreach ($prizes as $reward => $multiplier) { //$chancer = get_rewards();
        if ( round($totalMultiplier / $multiplier) > 10000)
            $chancer[$reward] = '<0.01%';
        else
            $chancer[$reward] = rtrim(rtrim(number_format($multiplier / $totalMultiplier * 100, 2), '0'), '.') . '%';
    }
}

$db->query("select * from tbl_prize order by chance desc");
while($res=$db->fetchArray()){
?>
				<tr>
					<td width="25%">
						<?php echo $res['prize']; ?>
					</td>
					<td width="17%">
						<?php echo $chancer[$res['prize']]; ?>
					</td>
					<td width="58%">
						<Div class="row text-left" style="margin-bottom:5px;">
							<Div class="col-md-3">Chance Up => </Div> <a href="?a=prize_up&pid=<?php echo $res['prize_id'];?>" title="Chance up x1" class="btn btn-success btn-xs">x1</a> <a href="?a=prize_upd&pid=<?php echo $res['prize_id'];?>" title="Chance up x2" class="btn btn-success btn-xs">x2</a> <a href="?a=prize_upd5&pid=<?php echo $res['prize_id'];?>" title="Chance up x5" class="btn btn-success btn-xs">x5</a> <a href="?a=prize_upd10&pid=<?php echo $res['prize_id'];?>" title="Chance up x10" class="btn btn-success btn-xs">x10</a> <a href="?a=prize_upd20&pid=<?php echo $res['prize_id'];?>" title="Chance up x20" class="btn btn-success btn-xs">x20</a> <a href="?a=prize_upd100&pid=<?php echo $res['prize_id'];?>" title="Chance up x20" class="btn btn-success btn-xs">x100</a> <a href="?a=prize_upd200&pid=<?php echo $res['prize_id'];?>" title="Chance up x20" class="btn btn-success btn-xs">x200</a> <a href="?a=prize_upd1000&pid=<?php echo $res['prize_id'];?>" title="Chance up x20" class="btn btn-success btn-xs">x1000</a> </Div>
						<Div class="row">
							<?php if($res['chance']>1){?>
							<Div class="col-md-3"> Chance Down => </Div> <a href="?a=prize_down&pid=<?php echo $res['prize_id'];?>" title="Chance down low" class="btn btn-warning btn-xs">x1</a>
							<?php } ?>
							<?php if($res['chance']>2){?> <a href="?a=prize_downd&pid=<?php echo $res['prize_id'];?>" title="Chance down high" class="btn btn-warning btn-xs">x2</a>
							<?php } ?>
							<?php if($res['chance']>5){?> <a href="?a=prize_downd5&pid=<?php echo $res['prize_id'];?>" title="Chance down high" class="btn btn-warning btn-xs">x5</a>
							<?php } ?>
							<?php if($res['chance']>10){?> <a href="?a=prize_downd10&pid=<?php echo $res['prize_id'];?>" title="Chance down high" class="btn btn-warning btn-xs">x10</a>
							<?php } ?>
							<?php if($res['chance']>20){?> <a href="?a=prize_downd20&pid=<?php echo $res['prize_id'];?>" title="Chance down high" class="btn btn-warning btn-xs">x20</a>
							<?php } ?>
							<?php if($res['chance']>100){?> <a href="?a=prize_downd100&pid=<?php echo $res['prize_id'];?>" title="Chance down high" class="btn btn-warning btn-xs">x100</a>
							<?php } ?>
							<?php if($res['chance']>200){?> <a href="?a=prize_downd200&pid=<?php echo $res['prize_id'];?>" title="Chance down high" class="btn btn-warning btn-xs">x200</a>
							<?php } ?>
							<?php if($res['chance']>1000){?> <a href="?a=prize_downd1000&pid=<?php echo $res['prize_id'];?>" title="Chance down high" class="btn btn-warning btn-xs">x1000</a>
							<?php } ?> </Div>
						<Div class="row">
							<Div class="col-md-3"> <a href="?a=prize_remove&pid=<?php echo $res['prize_id'];?>" title="Remove" class="btn btn-danger btn-xs">Remove</a> </Div>
						</Div>
					</td>
				</tr>
				<?php } ?> </tbody>
	</table>
	<Div class="well">
		<form action="" method="post">
			<div class="form-group"> <label for="exampleInputEmail1">Prize In <?php echo currency($currency);?></label> <input type="number" class="form-control" name="prize"> </div> <button type="submit" name="new_price" class="btn btn-success col-md-3 col-md-push-4">Add</button>
			<div class="clearfix"></div>
		</form>
	</Div>
	<Div class="well"> <a href="?a=apply" class="btn btn-primary col-md-3 col-md-push-4 btn-lg">Apply New prizes</a>
		<div class="clearfix" style="margin-top:20px;"></div> <br>
		<Div class="alert alert-danger"> Remember to apply new prizes after change to take effect. </Div>
	</Div>
	<?php } include("footer.php") ?>