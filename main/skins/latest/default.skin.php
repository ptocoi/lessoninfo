<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<li class="list mt25">
	<div class="comBoard list1 positionR" style="height:140px;">
		<h3 class=""><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="mr5 vm bg_color4"><?php echo stripslashes($board['bo_subject']);?></h3>
		<em style="top:10px; right:10px;" class="positionA">
			<a href="<?php echo $alice['board_path'];?>/board.php?board_code=<?php echo $board_code;?>&code=<?php echo $code;?>&bo_table=<?php echo $bo_table;?>"><img width="42" height="15" alt="" src="../images/icon/icon_more1.gif" class="vb bg_color4"></a>
		</em>
		<div class="positionR clearfix">
			<ul class="clearfix">
			<?php for($i=0;$i<$rows;$i++){ 
				$new_icon = ($list[$i]['icon_new']) ? "<img src=\"".$alice['images_path'] . "/ic/new.gif\" style=\"vertical-align:inherit;\"/>" : "";				
			?>
				<li><a href="<?php echo $alice['board_path']."/".$list[$i]['href_link'];?>"><?php echo $utility->str_cut($list[$i]['subject'],60);?></a> <?php echo $new_icon;?></li>
			<?php } ?>
			</ul>
		</div>
	</div>
</li>
