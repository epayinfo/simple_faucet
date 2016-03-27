<?php
require_once "header.php";
$db2=new DbConnector;
if(isset($_GET['a'])&&$_GET['a']=='delete'){
	$id=$_GET['id'];
	$db->query("delete from tbl_user where user_id='$id'");
	header( 'Location: user.php');
}else{ ?>



<table class="table table-hover table-striped">
	<tr align="center">
		<td width="2%">#</td>
		<td width="44%">wallet</td>
		<td width="51%">Referred</td>
		<td width="3%"></td> 
	</tr>
<tbody>
<?php
$perpage=50;
if (!isset($_GET['p']))
	$screen = 0;
else
	$screen=$_GET['p']-1;
$start = $screen * $perpage;
$db->query("select * from tbl_user");
$i=($db->rownum())-$start;
	$db->query("select * from tbl_user order by reset desc limit ".$start.",".$perpage);
	while($res=$db->fetchArray()){
?>
	<tr align="center" >
		<td width="2%"><?php echo $i; $i--;?></td>
		<td width="44%"><?php echo $res['wallet']; ?></td>     
		<td width="51%">
		<?php
			$db2->Queryres("select count(user_id) as ucount from tbl_user where reffer_id='".$db->res['user_id']."' ");
			echo number_format($db2->res['ucount']);
		?>
		</td>
		<td width="3%"><a href="user.php?a=delete&id=<?php echo $res['user_id']?>">Delete</a></td>         
	</tr>
<?php  } ?>
</tbody>
</table>



<div class="row" style="margin-top:10px">
  <?php
$db->query("select * from tbl_user");
$n=$db->rownum();
$page=$screen+1;
$last_page=ceil($n/$perpage)+1;
$part='?p=';

if ($page != 1){
	$paging.='<a href="'.$part.($page - 1).'" class="pageNum">';
	$paging.= "Prev";
	$paging.='</a>';
}

if ($page > 4){
	$paging.='<a href="'.$part.($page-$page+1).'" class="pageNum">';
	$paging.= "First";
	$paging.='</a>';
}
	for($i=4;$i>0;$i--) {
		if($page-$i>0) {
			$paging.='<a href="'.$part.($page-$i).'" class="pageNum">';
					$paging.=(($page-$i));
				$paging.='</a>';
			}
		}
		if(!isset($paging))$paging=NULL;
		$paging.='<span class="pageNum pactive">';
		if ($page == 0)
			$paging.="First";
		else if($page == $last_page)
			$paging.="Last";
		else
			$paging.=($page);
		$paging.='</span>';

		for($i=1 ; $i<5 ; $i++) {
			if($last_page-($page+$i)>0) {

				$paging.='<a href="'.$part.($page+$i).'" class="pageNum">';
		if ($page+$i == $last_page-1)
		$paging.="Last";
		else
				$paging.=(($page+$i));
				$paging.='</a>';
			}
		}
if ($page < $last_page - 5){
	$paging.='<a href="'.$part.($last_page - 1).'" class="pageNum">';
	$paging.= "Last";
	$paging.='</a>';
}

if ($page != $last_page-1){
	$paging.='<a href="'.$part.($page + 1).'" class="pageNum">';
	$paging.= "Next";
	$paging.='</a>';
}

	echo $paging; ?>
    </div>
<?php } include("footer.php") ?>