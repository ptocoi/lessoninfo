<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<div id="leftmenu" class="clearfix">

	<?php /* 개인서비스 */ 
		if($mb_type == 'individual' && $page_name == 'individual'){	 // 개인 && 마이페이지
	?>
	<div class="person mt20" style="display:block;">
		<h2 class="left_title  clearfix"><a href="<?php echo $alice['individual_path'];?>/"><img width="74" height="17" alt="개인서비스" src="../images/main/btn_nav_04.png"></a></h2>
		<div class="person_nav">
			<ul>
				<li class="mr8 ml8 pt12">
					<h3><img width="65" height="16" alt="이력서관리" src="../images/tit/left_nav_tit_12.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<ul class="s_nav pt5 pl5 pr5 pb5">
						<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_regist.php">새 이력서 작성</a></li>
						<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_list.php">이력서 관리·수정</a></li>
						<li><a href="<?php echo $alice['individual_path'];?>/photo.php">내 사진 관리</a></li>
						<li class="last"><a href="<?php echo $alice['individual_path'];?>/file.php">파일 관리</a></li>
					</ul>
				</li>
				<li class="mr8 ml8 pt12">
					<h3><img width="82" height="16" alt="입사지원관리" src="../images/tit/left_nav_tit_13.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<ul class="s_nav pt5 pl5 pr5 pb5">
						<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_onlines.php">온라인 지원 현황</a></li>
						<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_onlines.php?type=become_email">이메일 지원 현황</a></li>
						<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_open.php">내 이력서 열람기업</a></li>
						<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_denied.php">이력서 열람제한 설정</a></li>
						<li><a href="<?php echo $alice['individual_path'];?>/alba_resume_interview.php">면접제의·입사요청 기업</a></li>
						<li class="last"><a href="<?php echo $alice['individual_path'];?>/alba_resume_applycert.php">취업활동 증명서</a></li>
					</ul>
				</li>
				<li class="mr8 ml8 pt12">
					<h3><img width="94" height="16" alt="맞춤서비스관리" src="../images/tit/left_nav_tit_14.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<ul class="s_nav pt5 pl5 pr5 pb5">
						<li><a href="<?php echo $alice['individual_path'];?>/alba_scrap.php">스크랩한 채용정보</a></li>
						<li><a href="<?php echo $alice['individual_path'];?>/favorite_company.php">관심기업 정보</a></li>
						<li class="last"><a href="<?php echo $alice['individual_path'];?>/alba_customized.php">맞춤 채용정보</a></li>
					</ul>
				</li>
				<?php if($sms_use && $etc_sms_check['is_pay']){ ?>
				<li class="mr8 ml8 pt12">
					<h3><img width="60" height="16" alt="서비스관리" src="../images/tit/left_nav_tit_25.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<table  width="100%" class="tc s_nav pt5 pl5 pr5 pb5">
					<tr class="font11">
						<td class="pt10">SMS <span class="text_blue3 b"><?php echo number_format($member['mb_sms']);?></span>건</td>
					</tr>
					<tr><td class="pt5 pb10"><a href="<?php echo $alice['individual_path'];?>/open_sms.php"><img src="/images/tit/btnservcsms.gif"></a></td></tr>
					</table>
					<ul class="mt5 s_nav pt5 pl5 pr5 pb5">
						<li><a href="<?php echo $alice['individual_path'];?>/alba_sms.php">SMS 문자발송 현황</a></li>
						<li class="last"><a href="<?php echo $alice['individual_path'];?>/alba_sms.php?type=receive">SMS 문자수신 현황</a></li>
					</ul>
				</li>
				<?php } ?>

				<?php if($etc_alba_check['is_pay']){ ?>
				<li class="mr8 ml8 pt12">
					<h3><img width="94" height="16" alt="열람권관리" src="../images/tit/left_nav_tit_24.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<table class="tc s_nav" width="100%">
					<tr class="font11">
						<td class="pt10">
							<?php 
							if( $utility->valid_day($member_service['mb_service_alba_open']) || $member_service['mb_service_alba_count'] ){
								if( $utility->valid_day($member_service['mb_service_alba_open']) ) echo " ~ <span class=\"text_blue3 b\">".$member_service['mb_service_alba_open']."</span>";
								if( $member_service['mb_service_alba_count'] ) echo " (".number_format($member_service['mb_service_alba_count'])."건)";
							} else {
								echo "열람권 없음";
							}
							?>
						</td>
					</tr>
					<tr class="font11">
						<td class="pt5 pb10"><a href="<?php echo $alice['individual_path'];?>/open_service.php"><img src="/images/tit/<?php echo ($member_service['mb_service_open'])?'btnservcday':'btnservc';?>.gif"></a></td>
					</tr>
					</table>
					<ul class="mt5 s_nav pt5 pl5 pr5 pb5">
						<li class="last"><a href="<?php echo $alice['individual_path'];?>/open_service.php">채용공고열람 신청</a></li>
					</ul>
				</li>
				<?php } ?>
				<li class="mr8 ml8 pt12 pb10">
					<h3><img width="82" height="16" alt="개인정보관리" src="../images/tit/left_nav_tit_15.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<ul class="s_nav pt5 pl5 pr5 pb5">
						<li><a href="<?php echo $alice['member_path'];?>/update_form.php">개인정보 수정</a></li>
						<li><a href="<?php echo $alice['member_path'];?>/password_form.php">비밀번호 변경</a></li>
						<li><a href="<?php echo $alice['individual_path'];?>/tax.php">현금영수증 발행신청</a></li>
						<li class="last"><a href="<?php echo $alice['individual_path'];?>/service.php">유료 이용내역</a></li>
					</ul>
				</li>
			</ul>    
		</div>
	</div>
	<?php } /* //개인서비스 */ ?>

	<?php /* 기업서비스 */ 
		if($mb_type == 'company' && $page_name == 'company'){	// 기업 && 마이페이지
	?>
	<div class="company mt20" style="display:block;">
		<h2 class="left_title  clearfix"><a href="<?php echo $alice['company_path'];?>/"><img width="74" height="17" alt="기업서비스" src="../images/main/btn_nav_05.png"></a></h2>
		<div class="company_nav">
			<ul>
				<li class="mr8 ml8 pt12">
					<h3><img width="82" height="16" alt="채용공고관리" src="../images/tit/left_nav_tit_16.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<ul class="s_nav pt5 pl5 pr5 pb5">
						<li><a href="<?php echo $alice['company_path'];?>/alba_regist.php">채용공고 등록</a></li>
						<li><a href="<?php echo $alice['company_path'];?>/alba_list.php">진행중인 공고</a></li>
						<li><a href="<?php echo $alice['company_path'];?>/alba_list.php?type=finish">마감된 공고</a></li>
						<li><a href="<?php echo $alice['company_path'];?>/alba_apply_list.php">지원자 관리</a></li> 
						<?php /* ?><li><a href="<?php echo $alice['company_path'];?>/local_info.php">근무처 관리</a></li><?php */ ?>
						<li><a href="<?php echo $alice['company_path'];?>/company_info.php">기업정보 관리</a></li>
						<li class="last"><a href="<?php echo $alice['company_path'];?>/manager_info.php">담당자 관리</a></li>
					</ul>
				</li>
				<li class="mr8 ml8 pt12">
					<h3><img width="71" height="16" alt="서비스관리" src="../images/tit/left_nav_tit_17.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<ul class="s_nav pt5 pl5 pr5 pb5">
						<li><a href="<?php echo $alice['company_path'];?>/alba_scrap.php">스크랩한 인재정보</a></li>
						<li><a href="<?php echo $alice['company_path'];?>/alba_resume_info.php">열람한 인재정보</a></li>
						<li><a href="<?php echo $alice['company_path'];?>/alba_customized.php">맞춤 인재정보</a></li>         
						<li><a href="<?php echo $alice['company_path'];?>/alba_interview.php">면접제의.입사요청</a></li>       
						<li><a href="<?php echo $alice['company_path'];?>/open_service.php">이력서열람신청</a></li>
						
					</ul>
				</li>
				<?php if($sms_use && $etc_sms_check['is_pay']){ ?>
				<li class="mr8 ml8 pt12">
					<h3><img width="60" height="16" alt="서비스관리" src="../images/tit/left_nav_tit_25.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<table  width="100%" class="tc s_nav pt5 pl5 pr5 pb5">
					<tr class="font11">
						<td class="pt10">SMS <span class="text_blue3 b"><?php echo number_format($member['mb_sms']);?></span>건</td>
					</tr>
					<tr><td class="pt5 pb10"><a href="<?php echo $alice['company_path'];?>/open_sms.php"><img src="/images/tit/btnservcsms.gif"></a></td></tr>
					</table>
					<ul class="mt5 s_nav pt5 pl5 pr5 pb5">
						<li><a href="<?php echo $alice['company_path'];?>/alba_sms.php">SMS 문자발송 현황</a></li>
						<li class="last"><a href="<?php echo $alice['company_path'];?>/alba_sms.php?type=receive">SMS 문자수신 현황</a></li>
					</ul>
				</li>
				<?php } ?>
				<?php if($etc_open_check['is_pay']) { ?>
				<li class="mr8 ml8 pt12">
					<h3><img width="92" height="16" alt="열람권관리" src="../images/tit/left_nav_tit_23.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>

					<table width="100%" class="s_nav tc font11">
					<tr>
						<td class="pt10">
							<?php 
							if( $utility->valid_day($member_service['mb_service_open']) || $member_service['mb_service_open_count'] ){
								if( $utility->valid_day($member_service['mb_service_open']) ) echo " ~ <span class=\"text_blue3 b\">".$member_service['mb_service_open']."</span>";
								if( $member_service['mb_service_open_count'] ) echo " (".number_format($member_service['mb_service_open_count'])."건)";
							} else {
								echo "열람권 없음";
							}
							?>
						</td>
					</tr>
					<tr>
						<td class="pt5 pb10 b"><a href="<?php echo $alice['company_path'];?>/open_service.php"><img src="/images/tit/<?php echo ($member_service['mb_service_open'])?'btnservcday':'btnservc';?>.gif"></a></td>
					</tr>
					</table>
					<ul class="mt5 s_nav pt5 pl5 pr5 pb5">
						<li class="last"><a href="<?php echo $alice['company_path'];?>/open_service.php">이력서열람신청</a></li>
					</ul>
				</li>
				<?php } ?>
				<li class="mr8 ml8 pt12 pb10">
					<h3><img width="80" height="16" alt="기업정보관리" src="../images/tit/left_nav_tit_18.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<ul class="s_nav pt5 pl5 pr5 pb5">
						<li><a href="<?php echo $alice['member_path'];?>/update_form.php">기업정보 수정</a></li>
						<li><a href="<?php echo $alice['member_path'];?>/password_form.php">비밀번호 변경</a></li>
						<li><a href="<?php echo $alice['company_path'];?>/service.php">유료 이용내역</a></li>
						<li class="last"><a href="<?php echo $alice['company_path'];?>/tax.php">세금계산서 발행신청</a></li>
					</ul>
				</li>
			</ul>    
		</div>
	</div>
	<?php } /* //기업서비스 */ ?>

	<?php /* 채용정보 */ 
		if($page_name == 'alba' || $page_name == 'adult' || $page_name == 'main' || $page_name == 'map'){	
	?>
	<div class="gi mt20" style="display:block;">
		<h2 class="left_title" style=" overflow:hidden;"><a href="<?php echo $alice['alba_path'];?>/"><img width="59" height="17" alt="채용정보" src="../images/main/btn_nav_01.png"></a></h2>
		<div class="gi_nav">
			<ul>
			<li class="mr8 ml8 pt12">
				<h3><img  width="82" height="16" alt="일반 채용정보" src="../images/tit/left_nav_tit_01.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
				<ul class="s_nav pt5 pl5 pr5 pb5">
					<li><a href="<?php echo $alice['alba_path'];?>/alba_list.php">전체 채용정보</a></li>
					<li><a href="<?php echo $alice['alba_path'];?>/alba_list_busy.php">급구 채용정보</a></li>
					<li class="last"><a href="<?php echo $alice['alba_path'];?>/alba_search.php">상세검색</a></li>
				</ul>
			</li>
			<li class="mr8 ml8 pt12">
				<h3><img width="107" height="16" alt="업직종별 채용정보" src="../images/tit/left_nav_tit_02.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>    
				<ul class="s_nav pt5 pl5 pr5 pb5">
					<li><a href="<?php echo $alice['alba_path'];?>/alba_list_type.php">업직종별 채용정보</a></li>
					<?php 
					if($is_adult){
						$i = 0;
						foreach($adult_job_types as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$last_class = ($i == $adult_job_types_cnt-1) ? "class='last'" : "";
					?>
					<li <?php echo $last_class;?>><a href="<?php echo $alice['alba_path'];?>/alba_list_adult.php?type=<?php echo $val['code'];?>"><img src="../images/icon/icon_19.gif"/> <?php echo $name;?></a></li>
					<?php 
						$i++;
						} // adult_job_type foreach end. 
					}	// is adult if end.
					?>
				</ul>
			</li>
			<li class="mr8 ml8 pt12">
				<h3><img width="95" height="16" alt="지역별 채용정보" src="../images/tit/left_nav_tit_03.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
				<ul class="s_nav pt5 pl5 pr5 pb5">
					<li><a href="<?php echo $alice['alba_path'];?>/alba_list_area.php">지역별 채용정보</a></li>
					<li><a href="<?php echo $alice['alba_path'];?>/alba_list_subway.php">역세권 채용정보</a></li>
					<li class="last"><a href="<?php echo $alice['alba_path'];?>/alba_list_college.php">대학가 채용정보</a></li>
				</ul>
			</li>
			<li class="mr8 ml8 pt12">
				<h3><img width="95" height="16" alt="기간별 채용정보" src="../images/tit/left_nav_tit_04.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
				<ul class="s_nav pt5 pl5 pr5 pb5">
					<li><a href="<?php echo $alice['alba_path'];?>/alba_list_term.php">근무기간·요일·시간별</a></li>
					<li><a href="<?php echo $alice['alba_path'];?>/alba_list_term.php?type=short">단기 채용정보</a></li>
					<li class="last"><a href="<?php echo $alice['alba_path'];?>/alba_list_term.php?type=long">장기 채용정보</a></li>
				</ul>    
			</li>
			<li class="mr8 ml8 pt12">
				<h3><img width="95" height="16" alt="급여별 채용정보" src="../images/tit/left_nav_tit_05.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
				<ul class="s_nav pt5 pl5 pr5 pb5">
					<li><a href="<?php echo $alice['alba_path'];?>/alba_list_pay.php">급여별 채용정보</a></li>
					<li class="last"><a href="<?php echo $alice['alba_path'];?>/alba_list_pay.php?type=day">지원별 채용정보</a></li>          
				</ul>
			</li>
			<li class="mr8 ml8 pt12">
				<h3><img width="95" height="16" alt="대상별 채용정보" src="../images/tit/left_nav_tit_06.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
				<ul class="f_left clearfix s_nav pt5 pl5 pr5 pb5">
					<?php 
						foreach($job_targets as $key => $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					?>
					<li class="<?php echo (($job_targets_cnt-1)!=$key)?'bg ':'';?>pr5"><a href="<?php echo $alice['alba_path'];?>/alba_list_target.php?type=<?php echo $val['code'];?>"><?php echo $name;?></a></li>
					<?php } ?>
				</ul>
			</li>
			<li class="mr8 ml8 pt12 pb10">
				<h3><img width="82" height="16" alt="전문 채용정보" src="../images/tit/left_nav_tit_21.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
				<ul class="s_nav pt5 pl5 pr5 pb5">
					<?php 
					if($professional_alba[0]!=''){
						for($i=0;$i<$professional_alba_cnt;$i++){ 
						$professional_vals = $utility->remove_quoted( $category_control->get_categoryCodeName($professional_alba[$i]) );
						$classes = (($professional_alba_cnt-1) == $i) ? "class='last'" : "";
					?>
					<li <?php echo $classes;?>><a href="<?php echo $alice['alba_path'];?>/alba_list_type.php?type=<?php echo $professional_alba[$i];?>"><?php echo $professional_vals;?></a></li>
					<?php 
						} // for end.
					}	// if end.
					?>
				</ul>
			</li>
			</ul>
		</div>
	</div>
	<?php }	/* //채용정보 */ ?>

	<?php /* 인재정보 */ 
		if($page_name == 'resume' || $page_name == 'main'){	
	?>
	<div class="gg mt20" style="display:block;">
		<h2 class="left_title  clearfix"><a href="<?php echo $alice['resume_path'];?>/"><img width="59" height="17" alt="인재정보" src="../images/main/btn_nav_02.png"></a></h2>
		<div class="gg_nav">
			<ul>
				<li class="mr8 ml8 pt12">
					<h3><img width="82" height="16" alt="일반 인재정보" src="../images/tit/left_nav_tit_07.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<ul class="s_nav pt5 pl5 pr5 pb5">
						<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_list.php">전체 인재정보</a></li>
						<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_area.php">지역별 인재정보</a></li>
						<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_type.php">업직종별 인재정보</a></li>
						<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_busy.php">급구 인재정보</a></li>
						<li class="last"><a href="<?php echo $alice['resume_path'];?>/alba_resume_search.php">상세검색</a></li>
					</ul>
				</li>
				<li class="mr8 ml8 pt12">
					<h3><img width="95" height="16" alt="기간별 인재정보" src="../images/tit/left_nav_tit_08.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<ul class="s_nav pt5 pl5 pr5 pb5">
						<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_term.php">근무기간·요일·시간별</a></li>
						<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_term.php?type=short">단기 인재정보</a></li>
						<li class="last"><a href="<?php echo $alice['resume_path'];?>/alba_resume_term.php?type=long">장기 인재정보</a></li>         
					</ul>
				</li>

				<li class="mr8 ml8 pt12">
					<h3><img width="95" height="16" alt="능력별 인재정보" src="../images/tit/left_nav_tit_09.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<ul class="s_nav pt5 pl5 pr5 pb5">
						<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_specialty.php">특기별 인재정보</a></li>
						<li><a href="<?php echo $alice['resume_path'];?>/alba_resume_license.php">자격증별 인재정보</a></li>
						<li class="last"><a href="<?php echo $alice['resume_path'];?>/alba_resume_language.php">외국어가능 인재정보</a></li>
					</ul>
				</li>
				<!-- <li class="mr8 ml8 pt12">
					<h3><img width="95" height="16" alt="대상별 인재정보" src="../images/tit/left_nav_tit_10.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<ul class="f_left clearfix s_nav pt5 pl5 pr5 pb5">
						<li class="pr5 bg"><a href="#">청소년</a></li>
						<li class="pr5 pl5 bg"><a href="#">대학생</a></li>
						<li class="pl5"><a href="#">재택</a></li>
						<li class="last"><a href="#">프리랜서</a></li>
					</ul>    
				</li>     -->
				<li class="mr8 ml8 pt12 pb10">
					<h3><img width="82" height="16" alt="전문 인재정보" src="../images/tit/left_nav_tit_11.gif"><em><img width="13" height="13" alt="up" src="../images/icon/icon_btn_up.gif"></em></h3>
					<ul class="s_nav pt5 pl5 pr5 pb5">
						<?php 
						if($professional_indi[0]!=''){
							for($i=0;$i<$professional_indi_cnt;$i++){ 
							$professional_vals = $utility->remove_quoted( $category_control->get_categoryCodeName($professional_indi[$i]) );
							$classes = (($professional_indi_cnt-1) == $i) ? "class='last'" : "";
						?>
						<li <?php echo $classes;?>><a href="<?php echo $alice['resume_path'];?>/alba_resume_type.php?type=<?php echo $professional_indi[$i];?>"><?php echo $professional_vals;?></a></li>
						<?php 
							} // for end.
						}	// if end.
						?>
					</ul>
				</li>
			</ul>    
		</div>
	</div>
	<?php }	/* //인재정보 */ ?>

	<?php include_once $alice['include_path']."/left_banner.php";	// 서브 좌측 배너 ?>

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

	<?php if($pay_view){ /* Money info */ ?>
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
