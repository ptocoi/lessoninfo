<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>
<div id="community" class="style<?php echo $main_left;?> clearfix">
	<ul class="clearfix">  
	<?php 
	$board_count = count($print_main);
	if($board_count > 0) {
	foreach($print_main as $key => $val){
		if($val['view']){
			$bo_table = $key;
			$bo_skin = $val['print_type'];	 // 게시판 기본 스킨
			$options['img_width'] = $val['img_width'];
			$options['img_height'] = $val['img_height'];
			$options['is_main'] = 1;

			$board = $board_control->__BoardList($bo_table);

			echo $board_control->latest($bo_table, $val['print_cnt'], $val['bo_subject_len'], $bo_skin, $options);

		} else {
			continue;
		}
	}
	}
	?>
	</ul>
</div>