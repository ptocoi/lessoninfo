<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 
	$get_board_main = $board_config_control->get_main(1);	 // 1번 정보 추출
	$use_print = $get_board_main['use_print'];

	if($use_print==1){ 
?>

	<div class="mt30 comBoard list2 positionR clearfix">
		<h3><img class="mr5 vm bg_color4" width="13" height="13"  src="../images/icon/icon_arrow_4.png" alt=""><?php echo stripslashes($board['bo_subject']);?></h3>
		<em class="positionA" style="top:10px; right:10px;"><a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $board['code'];?>&bo_table=<?php echo $board['bo_table'];?>"><img width="42" height="15" class="vb bg_color4" src="../images/icon/icon_more1.gif" alt=""></a></em>
		<div class="listType positionR clearfix">
		<ul class="">
		<?php for($i=0;$i<$rows;$i++){ ?>
			<li><a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $list[$i]['code'];?>&bo_table=<?php echo $board['bo_table'];?>&wr_no=<?php echo $list[$i]['wr_no'];?>"><?php echo $list[$i]['subject'];?></a></li>
		<?php } ?>
		</ul>
		</div>
	</div>

<?php } else if($use_print==2){ ?>

	<div class="mt30 comBoard list1 positionR clearfix">
		<h3><img class="mr5 vm bg_color4" width="13" height="13"  src="../images/icon/icon_arrow_4.png" alt=""><?php echo stripslashes($board['bo_subject']);?></h3>
		<em class="positionA" style="top:10px; right:10px;"><a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $board['code'];?>&bo_table=<?php echo $board['bo_table'];?>"><img width="42" height="15" class="vb bg_color4" src="../images/icon/icon_more1.gif" alt=""></a></em>
		<div class="listType positionR clearfix">
		<ul class="">
		<?php for($i=0;$i<$rows;$i++){ ?>
			<li style="font-size:0.95em"><a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $list[$i]['code'];?>&bo_table=<?php echo $board['bo_table'];?>&wr_no=<?php echo $list[$i]['wr_no'];?>"><?php echo $list[$i]['subject'];?>		
			</a></li>
		<?php } ?>
		</ul>
		</div>
	</div>

<?php } ?>
