<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

	<script type="text/javascript" src="<?php echo $alice['main_path'];?>/skins/05/main.skin.js"></script>

	<?php /* content top */ ?>
	<div class="ct_top">
		<ul>
			<?php echo ($main_top_banner) ? stripslashes($main_top_banner) : ''; // 메인상단 배너?>
			<li class="width1 loginbox mb8 clearfix">
				<?php include_once $alice['member_path'] . "/skins/default/outlogin.skin.php";	// 회원/아웃로그인 ?>
			</li>
			<li class="width1 mr8">
				<h4>지역별 채용정보</h4>
				<ul class="ctArea clearfix">
					<?php 
						foreach($category_area as $key => $val){ 
						$i = $key+1;
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$clases = ($key % 6 == 0) ? "class='BgNo'" : "";
					?>
					<li <?php echo $clases;?>><a href="<?php echo $alice['alba_path'];?>/alba_list_area.php?area=<?php echo $val['code'];?>"><?php echo $name;?></a></li>
					<?php } // foreach end.?>
				</ul>
				<div class="ctArea2"><img class="pl5 pr5 vm" src="../images/icon/icon_arrow_right2.gif" width="14" height="15" alt="arrow"><a href="<?php echo $alice['alba_path'];?>/alba_list_subway.php">역세권채용</a></div>
				<div class="ctArea3"><img class="pl5 pr5 vm" src="../images/icon/icon_arrow_right2.gif" width="14" height="15" alt="arrow"><a href="<?php echo $alice['alba_path'];?>/alba_list_college.php">대학가채용</a></div>
			</li>
			<?php 
			$b = 1;
			foreach($board_list['result'] as $val){ 
			$board = $board_control->__BoardList($val['bo_table']);
			if($b > 1) break;
			?>
			<li class="width1 mr8 positionR">
				<h4><?php echo stripslashes($val['bo_subject']);?></h4>
				<em style="top:8px; right:8px;" class="positionA"><a href="<?php echo $alice['board_path'];?>/board.php?code=<?php echo $val['code'];?>&bo_table=<?php echo $val['bo_table'];?>"><img width="42" height="15" alt="" src="../images/icon/icon_more1.gif" class="vb bg_color14"></a></em>        
				<ul class="ctNotice clearfix">
					<?php 
					$a = 1;
					foreach($board['result'] as $sub){ 
					if($a > 4) break;
					$icon_new = false;
					if($sub['wr_datetime'] >= date("Y-m-d H:i:s", $alice['server_time'] - ($val['bo_new'] * 3600))){
						$icon_new = ($sub['wr_del']) ? false : true;
					}
					$new_icon = ($icon_new) ? "<img src=\"".$alice['images_path'] . "/ic/new.gif\" style=\"vertical-align:inherit;\"/>" : "";
					?>
					<li class=""><a href="<?php echo $alice['board_path'];?>/board.php?code=<?php echo $val['code'];?>&bo_table=<?php echo $val['bo_table'];?>&wr_no=<?php echo $sub['wr_no'];?>"><?php echo $utility->str_cut(stripslashes($sub['wr_subject']),48);?></a> <?php echo $new_icon;?></li>
					<?php 
					$a++;
					} 
					?>
				</ul>
			</li>
			<?php 
			$b++;
			} 
			?>
			<li class="width1 positionR">
				<h4 class="skip">퀵아이콘</h4>
				<ul class="ctQicon clearfix">
				<li class="">
					<a href="<?php echo $alice['alba_path'];?>/alba_list_type.php">
						<p><img width="64" height="42" class="bg_color1" alt="업직종별" src="../images/icon/icon_quick1.png"></p>
						<p class="text">업직종별</p>
					</a>
				</li>
				<li class="">
					<a href="<?php echo $alice['alba_path'];?>/alba_list_area.php">
						<p><img width="64" height="42" class="bg_color1" alt="지역별" src="../images/icon/icon_quick2.png"></p>
						<p class="text">지역별</p>					
					</a>
				</li>
				<li class="">
					<a href="<?php echo $alice['alba_path'];?>/alba_list_subway.php">
						<p><img width="64" height="42" class="bg_color1" alt="역세권" src="../images/icon/icon_quick3.png"></p>
						<p class="text">역세권별</p>
					</a>
				</li>
				<li class="">
					<a href="<?php echo $alice['service_path'];?>/">
						<p><img width="64" height="42" class="bg_color1" alt="유료서비스" src="../images/icon/icon_quick4.png"></p>
						<p class="text">유료서비스</p>
					</a>
				</li>
				<li class="">
					<a href="javascript:company_service(1);">
						<p><img width="64" height="42" class="bg_color1" alt="채용공고등록" src="../images/icon/icon_quick5.png"></p>
						<p class="text">채용공고등록</p>
					</a>
				</li>
				<li class="">
					<a href="javascript:individual_service(1);">
						<p><img width="64" height="42" class="bg_color1" alt="이력서등록" src="../images/icon/icon_quick6.png"></p>
						<p class="text">이력서등록</p>
					</a>
				</li>
				</ul>
			</li>
		</ul>
	</div>
	<?php /* //content top */ ?>
