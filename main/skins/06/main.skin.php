<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

	<script type="text/javascript" src="<?php echo $alice['main_path'];?>/skins/02/main.skin.js"></script>

	<?php /* content top */ ?>
	<div class="ct_top">
		<ul>
			<li class="width1 loginbox mr8 mb8 clearfix">
				<?php include_once $alice['member_path'] . "/skins/default/outlogin.skin.php";	// 회원/아웃로그인 ?>
			</li>
			<?php echo ($main_top_banner) ? stripslashes($main_top_banner) : ''; // 메인상단 배너?>
			<li class="width1 mr8 positionR">
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
			
			<!-- <?php 
			if($board_list['result']){
			$b = 1;
				foreach($board_list['result'] as $val){ 
				$board = $board_control->__BoardList($val['bo_table']);
				if($b > 2) break;
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
			}
			?> -->
			<!-- 1스타입 게시판으로 변경 -->
			<li class="width2 mr8">
				<ul class="ctTab clearfix">
					<li class="on tab1 positionR tabs" tabs="tab1" style="margin-right:-1px;margin-left:-1px;">
						<em class="positionA" style="top:8px; right:8px;"><a href="<?php echo $alice['alba_path'];?>/"><img width="42" height="15" class="vb bg_color14" src="../images/icon/icon_more1.gif" alt="채용공고 더보기"></a></em>
						<a style="cursor:pointer;"><h4>신규 채용정보</h4></a>
					</li>
					<li class="tab2 positionR tabs" tabs="tab2" style="margin-right:-1px; margin-left:-1px;">
						<em class="positionA" style="top:8px; right:8px;"><a href="<?php echo $alice['resume_path'];?>/"><img width="42" height="15" class="vb bg_color14" src="../images/icon/icon_more1.gif" alt="인재정보 더보기"></a></em>
						<a style="cursor:pointer;"><h4>신규 인재정보</h4></a>
					</li>
				</ul>         
				<!--   신규채용정보   --> 
				<ul class="ctBoard tab1 clearfix" style="display:block;" id="tab1">
				<?php 
					foreach($new_alba_list['result'] as $val){ 
					$wr_area_0 = explode('/',$val['wr_area_0']);
					$wr_area_name = $category_control->get_categoryCodeName($wr_area_0[0]);
					$wr_area_name .= ($wr_area_0[1]) ? " " . $category_control->get_categoryCodeName($wr_area_0[1]) : "";
					$company_name = stripslashes($val['wr_company_name']);
					$wr_pay_type = $category_control->get_categoryCodeName($val['wr_pay_type']);	// 급여조건
					$wr_pay = number_format($val['wr_pay']);
					$wr_subject = stripslashes($val['wr_subject']);
				?>
					<li class="boardList">
						<span class="BgNo b add">[<?php echo $wr_area_name;?></span>
						<span class="b logo_tit"><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $val['no'];?>"><?php echo $company_name;?></a></span>
						<span class="b number pay">
						<?php 
						if($val['wr_pay_conference']){
							echo $alba_user_control->pay_conference[$val['wr_pay_conference']] . " ]</span>";
						} else {
						?>
						<em class="icon"><?php echo $wr_pay_type;?></em> <?php echo $wr_pay;?>원 ]</span>
						<?php } ?>
						<span class="BgNo text1"><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $val['no'];?>"><?php echo $wr_subject;?> </a></span>
					</li>
				<?php } ?>
				</ul>
				<!--  // 신규채용정보 --> 

				<!--  신규인재정보  -->
				<ul class="ctBoard tab2 clearfix" style="display:none;" id="tab2">
				<?php
					foreach($new_resume_list['result'] as $val){
					$resume_member = $user_control->get_member($val['wr_id']);	// 작성 회원 정보
					$wr_photo = $resume_member['mb_photo'];
					if($wr_photo){
						$photo_path = $alice['data_member_path']."/".$val['wr_id'];
						$is_photo = true;
					} else {
						$is_photo = false;
					}
					if($is_member){		// 회원일때
						if($member['mb_type']=='company'){	 // 기업회원의 경우 열람권 체크
							$get_service = $member_control->get_service_member($member['mb_id']);
							$open_service_valid = $utility->valid_day($get_service['mb_service_open']);
							if($open_service_valid){	 // 열람권이 있다면 보여주고
								$name = stripslashes($resume_member['mb_name']);
							} else {	 // 없음 감추기
								$name = trim( $utility->make_pass_○○( stripslashes($resume_member['mb_name']) ) );
							}
						} else if($member['mb_type']=='individual'){	 // 개인회원의 경우 자신의 이력서 인지 체크
							if($wr_id==$member['mb_id']){	// 내 이력서 라면
								$name = stripslashes($resume_member['mb_name']);
							} else {	 // 내 이력서가 아니라면
								$wr_name = trim( $utility->make_pass_00( stripslashes($resume_member['mb_name']) ) );
								$name = trim( $utility->make_pass_○○( stripslashes($resume_member['mb_name']) ) );
							}
						}
					} else {	 // 회원이 아닐때 (무조건 감춤)
						$name = trim( $utility->make_pass_○○( stripslashes($resume_member['mb_name']) ) );
					}
					$wr_gender = $alba_resume_user_control->gender_text[$resume_member['mb_gender']];
					$wr_age = $member_control->get_age($resume_member['mb_birth']);
					if($val['wr_pay_conference']){	 // 추후협의
						$wr_pay_type = "";
						$wr_pay = "추후협의";
					} else {
						$wr_pay_type = $category_control->get_categoryCodeName($val['wr_pay_type']);	// 급여조건
						$wr_pay = number_format($val['wr_pay']) . "원";
					}
					$wr_career = unserialize($val['wr_career']);
					if($wr_career){
						$wr_career_cnt = count($wr_career);
						$career = 0;
						for($i=0;$i<$wr_career_cnt;$i++){
							$career += $utility->date_diff($wr_career[$i]['sdate'],$wr_career[$i]['edate']);
						}							
						$strtime = time() - strtotime("-".$career.' day');
						$year = date("Y", $strtime) - 1970;
						$month = date("m", $strtime);
						$wr_career = "약 " . $year . "년 " . $month . "개월";
					} else {
						$wr_career = "신입";
					}
					$wr_subject = stripslashes($val['wr_subject']);
				?>
					<li class="boardList">
					<a href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $val['no'];?>">
						<span class="BgNo b name">[<?php echo $name;?><?php if($is_photo){ ?><em class="pl5 photo"><img width="16" height="16" src="../images/icon/icon_photo1.gif" class="vm"></em><?php } ?></span>
						<span class="b logo_tit"><?php echo $wr_gender;?> <?php echo $wr_age;?>세</span>
						<span class="b number pay"><em class="icon"><?php echo $wr_pay_type;?></em> <?php echo $wr_pay;?></span>                
						<span class="b career"><img width="23" height="14" class="vm" alt="경력" src="../images/icon/icon_career.gif"> <?php echo $wr_career;?> ]</span>                
						<span class="BgNo text1"><?php echo $wr_subject;?></span></a>
					</li>
				<?php } ?>
				</ul>
				<!--  // 신규인재정보  -->
			</li>
			<li class="width1">
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
		</ul>
	</div>
	<?php /* //content top */ ?>
