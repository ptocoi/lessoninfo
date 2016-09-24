<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<div id="leftmenu" class="clearfix">
	<!--  커뮤니티 layout  --> 
	<div class="gi mt20" style="display:block;">
		<h2 class="left_title" style=" overflow:hidden;">
			<a href="<?php echo $alice['board_path'];?>/index.php?board_code=<?php echo $board_code;?>"><img width="59" height="17" alt="커뮤니티" src="../images/main/btn_nav_06.png"><!-- <?php echo $menu_name;?> --></a>
		</h2>
		<div class="gi_nav">
			<ul>
			<?php
			if($left_list){
				$pb = 0;
				foreach($left_list as $menus){
				$pb++;
				$boCode_list = $board_control->boCode_list($menus['code']);
				$boCode_list_cnt = count($boCode_list);
				
					if($boCode_list){	// 소속 게시판이 있다면
						$menus_name = $utility->remove_quoted($menus['name']);
			?>
					<li class="mr8 ml8 pt12 <?php echo ($pb==0)?'pb10':'';?>">
						<h3>
							<?php echo $menus_name;?>
							<em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em>
						</h3>
						<ul class="s_nav pt5 pl5 pr5 pb5 ">
						<?php 
							$i = 0;
							foreach($boCode_list as $boards){ 
							$i++;
								$last_class = ($i == $boCode_list_cnt) ? "class='last'" : "";
								if($boards['bo_board_view']) {
									$left_bo_subject = $utility->remove_quoted($boards['bo_subject']);
							$new_time = date( "Y-m-d H:i:s", $alice['server_time'] - ($boards['bo_new'] * 3600) );
							$get_new = $board_control->get_latest(" where `bo_table` = '".$boards['bo_table']."' and `bn_datetime` >= '".$new_time."' ");
							$icon_new = ($get_new) ? "<img src=\"".$alice['images_path'] . "/ic/new.gif\"/>" : "";
						?>
							<li <?php echo $last_class;?>><a href="<?php echo $alice['board_path'];?>/board.php?board_code=<?php echo $board_code;?>&code=<?php echo $boards['code'];?>&bo_table=<?php echo $boards['bo_table'];?>"><?php echo $left_bo_subject;?></a> <?php echo $icon_new;?></li>
						<?php 
							}	// if end.
						}	// foreach end.
						?>
						</ul>
					</li>
			<?php
					}	// boCode_list if end.
				}	// foreach end.
			} else {
				if($boCode_list){
			?>
				<li class="mr8 ml8 pt12 pb10">
					<ul class="s_nav pt5 pl5 pr5 pb5">
			<?php
				$i = 0;
				foreach($boCode_list as $boards){
					$i++;
					if($boards['bo_board_view']) {
						$last_class = ($i == $boCode_list_cnt) ? "class='last'" : "";
						$left_bo_subject = $utility->remove_quoted($boards['bo_subject']);
			?>
						<li <?php echo $last_class;?>><a href="<?php echo $alice['board_path'];?>/board.php?board_code=<?php echo $board_code;?>&code=<?php echo $boards['code'];?>&bo_table=<?php echo $boards['bo_table'];?>"><?php echo $left_bo_subject;?></a></li>
			<?php
					}	//if end.
				}	// foreach end.
			?>
					</ul>
				</li>
			<?php
				}	// if end.
			}
			?>
			</ul>
		</div>
	</div>
	<div class="mt20 notice positionR">
		<h2 style="border:1px solid #ddd; background-color:#f5f5f5;height:28px;">
			<a href="<?php echo $alice['board_path'];?>/notice_list.php"><img class="pl10 pt5" width="53" height="16" alt="공지사항" src="../images/tit/left_tit_03.gif"></a>
		</h2>
		<ul class="pl4 pr4 pt5 pb5" style="border:1px solid #ddd; margin-top:-1px;">
			<?php 
				foreach($left_notice_list as $val){ 
				$notice_cate = $category_control->get_categoryCodeName($val['wr_type']);
				$wr_type = ($notice_cate) ? "[".$notice_cate."] " : "";
			?>
			<li><a href="<?php echo $alice['board_path'];?>/notice_view.php?no=<?php echo $val['no'];?>"><?php echo $wr_type;?><?php echo stripslashes($val['wr_subject']);?></a></li>
			<?php } ?>
		</ul>
	</div>

	<!--  left banner  --> 
	<?php echo stripslashes($left_banner); ?>
	<!--  left banner  --> 

	<?php if($call_center_use){ /* CS center */ ?>
	<div class="mt20 cscenter">

		<?php if($env['cs_type']){ // 텍스트 ?>
		<h2 style="border:1px solid #ddd; background-color:#f5f5f5;height:28px;"><img class="pl10 pt5" width="53" height="16" alt="고객센터" src="../images/tit/left_tit_01.gif"></h2>
		<dl class="pl4 pr4 pt5 pb5" style="border:1px solid #ddd; margin-top:-1px;">
			<dt class="num text_color1"><?php echo stripslashes($env['call_center']);?></dt>
			<?php if($env['cs_type']){ // 텍스트 ?>
				<dd><?php echo nl2br(stripslashes($env['call_time']));?></dd>
			<?php } ?>
		</dl>
		<?php } else { // 이미지 
			if($env['call_time_image']){
		?>
			<dd><img src="<?php echo $alice['peg_path']."/".$env['call_time_image'];?>"/></dd>
		<?php 
			} 
		}	// 텍스트/이미지 if end.
		?>

	</div>
	<?php } /* //CS center */ ?>

	<?php if($env['pay_view']){ /* Money info */ ?>
	<div class="mt20 Money">
		<h2 style="border:1px solid #ddd; background-color:#f5f5f5;height:28px;"><img class="pl10 pt5" width="62" height="16" alt="최저임금법" src="../images/tit/left_tit_02.gif"></h2>
		<dl class="pl4 pr4 pt5 pb5" style="border:1px solid #ddd; margin-top:-1px;">
			<dt class="text_color1"><em class="bg_color1 mr5">시급</em><span>(<?php echo $env['pay_year'];?>년 기준)</span></dt>
			<dd class="num text_color1"><?php echo number_format($env['time_pay']);?><em><img class="bg_color1" width="17" height="18" alt="\" src="../images/main/img_won_1.png"></em></dd>
			<dd>
				<table cellpadding="0" cellspacing="0">
				<colgroup><col width="30%"><col><col></colgroup>
				<tr class="first">
					<th class="bg_color1"></th>
					<th class="bg_color1">주</th>
					<th class="bg_color1">야</th>
				</tr>
				<tr>
					<th class="text_color1 border_color1">시급</th>
					<td class="border_color1 tc"><?php echo number_format($env['time_pay']);?>원</td>
					<td class="border_color1 tc"><?php echo number_format($env['time_pay']*1.5);?>원</td>
				</tr>
				<tr>
					<th class="text_color1 border_color1">일급</th>
					<td class="border_color1 tc"><?php echo number_format($env['time_pay']*8);?>원</td>
					<td class="border_color1 tc"><?php echo number_format(($env['time_pay']*1.5)*8);?>원</td>
				</tr>
				</table>
				<em class="text_color1">(일급:하루8시간 근무기준)</em>
			</dd>
		</dl>
	</div>
	<?php } /* //Money info */ ?>
</div>
