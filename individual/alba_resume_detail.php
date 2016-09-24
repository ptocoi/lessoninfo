<?php
		/*
		* /application/individual/alba_resume_detail.php
		* @author Harimao
		* @since 2013/07/24
		* @last update 2013/07/25
		* @Module v3.5 ( Alice )
		* @Brief :: Member individual alba resume detail
		* @Comment :: 개인회원 정규직 이력서 상세보기 (개인페이지)
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "individual";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$no = $_GET['no'];
		if(!$no || $no==''){
			$utility->popup_msg_js($alba_individual_control->_errors('0004'));
			exit;
		}
		$get_resume = $alba_individual_control->get_resume_no($no);	// 이력서 정보
		if($get_resume['wr_id'] != $member['mb_id']){
			$utility->popup_msg_js($alba_individual_control->_errors('0006'));
			exit;
		}

		$wr_udate = substr($get_resume['wr_udate'],0,11);	// 수정일
		$wr_subject = stripslashes($get_resume['wr_subject']);
		$wr_calltime = explode('-',$get_resume['wr_calltime']);
		$wr_school_ability = explode('/',$get_resume['wr_school_ability']);
		$wr_school_ability = $category_control->get_categoryCode($wr_school_ability[0]);

		/* 경력 정보 추출 */
		$wr_career = unserialize($get_resume['wr_career']);

		if($wr_career){
			$wr_career_cnt = count($wr_career);
			$career = 0;
			for($i=0;$i<$wr_career_cnt;$i++){
				$career += $utility->date_diff($wr_career[$i]['sdate']."-01",$wr_career[$i]['edate']."-01");
			}				
			$strtime = time() - strtotime("-".$career.' day');
			$year = date("Y", $strtime) - 1970;
			$month = date("m", $strtime);
			$career_periods = "약 " . sprintf('%02d',$year) . "년 " . $month . "개월";
		} else {
			$career_periods = "없음";
		}
		/* //경력 정보 추출 */

		
		/* 희망급여 */
		if($get_resume['wr_pay_conference']){
			$pay_type = "추후협의";
		} else {
			$wr_pay_type = $category_control->get_categoryCode($get_resume['wr_pay_type']);
			$pay_type = $wr_pay_type['name']." ".number_format($get_resume['wr_pay'])."원";
		}
		/* //희망급여 */


		/* 자격증 */
		$license = "";
		if($get_resume['wr_license']){
			$wr_license = unserialize($get_resume['wr_license']);
			$wr_license_cnt = count($wr_license);
			if($wr_license){
				foreach($wr_license as $key => $val){
					if($key==0){
						$license .= $val['name'];
					}
				}
				if($wr_license_cnt >= 2){
					$license .= " 외 " . ($wr_license_cnt-1) . "개";
				}
			} else {
				$license .= "없음";
			}
		} else {
			$license .= "없음";
		}
		/* //자격증 */


		/* 외국어능력 */
		$language = "";
		if($get_resume['wr_language']){
			$wr_language = unserialize($get_resume['wr_language']);
			$wr_language_cnt = count($wr_language);
			if($wr_language){
				foreach($wr_language as $key => $val){
					$language_val = $category_control->get_categoryCode($val['language']);
					if($key==0){
						$language .= $language_val['name'];
						$language_icon = $alba_individual_control->language_level[$val['level']]['icon'];
						$language_name = $alba_individual_control->language_level[$val['level']]['name'];
						$language .= "<em class=\"pl5 vt\"><img src=\"../images/icon/".$language_icon."\" width=\"17\" height=\"14\" alt=\"".$language_name."\" /></em>";
					}
				}
				if($wr_language_cnt >= 2){
					$language .= " 외 " . ($wr_language_cnt-1) . "개국어";
				}
			} else {
				$language .= "없음";
			}
		} else {
			$language .= "없음";
		}
		/* //외국어능력 */


		/* 희망근무지 */
		// 1차 지역
		$wr_area0 = $category_control->get_categoryCodeName($get_resume['wr_area0']);
		$wr_area1 = $category_control->get_categoryCodeName($get_resume['wr_area1']);
		if($wr_area0){
			$wr_area_0 = "<li><a href=\"#\">";
			if($wr_area0) $wr_area_0 .= $wr_area0;
			if($wr_area1) $wr_area_0 .= " " . $wr_area1;
			$wr_area_0 .= "</a></li>";
		}
		// 2차 지역
		$wr_area2 = $category_control->get_categoryCodeName($get_resume['wr_area2']);
		$wr_area3 = $category_control->get_categoryCodeName($get_resume['wr_area3']);
		if($wr_area2){
			$wr_area_1 = ", <li><a href=\"#\">";
			if($wr_area2) $wr_area_1 .= $wr_area2;
			if($wr_area3) $wr_area_1 .= " " . $wr_area3;
			$wr_area_1 .= "</a></li>";
		}
		// 3차 지역
		$wr_area4 = $category_control->get_categoryCodeName($get_resume['wr_area4']);
		$wr_area5 = $category_control->get_categoryCodeName($get_resume['wr_area5']);
		if($wr_area4){
			$wr_area_2 = ", <li><a href=\"#\">";
			if($wr_area4) $wr_area_2 .= $wr_area4;
			if($wr_area5) $wr_area_2 .= " " . $wr_area5;
			$wr_area_2 .= "</a></li>";
		}
		/* //희망근무지 */


		/* 희망 근무직종 */
		// 1차 근무직종
		$wr_job_type0 = $category_control->get_categoryCodeName($get_resume['wr_job_type0']);
		$wr_job_type1 = $category_control->get_categoryCodeName($get_resume['wr_job_type1']);
		$wr_job_type2 = $category_control->get_categoryCodeName($get_resume['wr_job_type2']);
		if($wr_job_type0){
			$wr_job_type_0 = "<li>";
			if($wr_job_type0) $wr_job_type_0 .= $wr_job_type0;
			if($wr_job_type1) $wr_job_type_0 .= "·" . $wr_job_type1;
			if($wr_job_type2) $wr_job_type_0 .= "·" . $wr_job_type2;
			$wr_job_type_0 .= "</li>";
		}
		// 2차 근무직종
		$wr_job_type3 = $category_control->get_categoryCodeName($get_resume['wr_job_type3']);
		$wr_job_type4 = $category_control->get_categoryCodeName($get_resume['wr_job_type4']);
		$wr_job_type5 = $category_control->get_categoryCodeName($get_resume['wr_job_type5']);
		if($wr_job_type3){
			$wr_job_type_1 = " , <li>";
			if($wr_job_type3) $wr_job_type_1 .= $wr_job_type2;
			if($wr_job_type4) $wr_job_type_1 .= "·" . $wr_job_type3;
			if($wr_job_type5) $wr_job_type_1 .= "·" . $wr_job_type4;
			$wr_job_type_1 .= "</li>";
		}
		// 3차 근무직종
		$wr_job_type6 = $category_control->get_categoryCodeName($get_resume['wr_job_type6']);
		$wr_job_type7 = $category_control->get_categoryCodeName($get_resume['wr_job_type7']);
		$wr_job_type8 = $category_control->get_categoryCodeName($get_resume['wr_job_type8']);
		if($wr_job_type6){
			$wr_job_type_2 = " , <li>";
			if($wr_job_type6) $wr_job_type_2 .= $wr_job_type6;
			if($wr_job_type7) $wr_job_type_2 .= "·" . $wr_job_type7;
			if($wr_job_type8) $wr_job_type_2 .= "·" . $wr_job_type8;
			$wr_job_type_2 .= "</li>";
		}
		/* //희망 근무직종 */


		$wr_date = $category_control->get_categoryCodeName($get_resume['wr_date']);		// 근무기간
		$wr_week = $category_control->get_categoryCodeName($get_resume['wr_week']);	// 근무요일
		$wr_time = $category_control->get_categoryCodeName($get_resume['wr_time']);		// 근무시간
		$wr_work_direct = ($get_resume['wr_work_direct']) ? "(즉시출근가능)" : "";


		/* 근무형태 */
		if($get_resume['wr_work_type']){
			$wr_work_type = explode(',',$get_resume['wr_work_type']);	
			$wr_work_type_cnt = count($wr_work_type);
			$work_type = "";
			for($i=0;$i<$wr_work_type_cnt;$i++){
				$work_type_name = $category_control->get_categoryCodeName($wr_work_type[$i]);
				$work_type .= "<li>".$work_type_name."</li> ";
			}
		}
		/* //근무형태 */


		/* 학력사항 */
		$school_ability = explode(' ',$wr_school_ability['name']);
		$wr_school_type = explode(',',$get_resume['wr_school_type']);
		// 대학 (2,3년) 데이터
		$wr_half_college = unserialize($get_resume['wr_half_college']);
		$wr_half_college_cnt = count($wr_half_college['college']);
		// 대학 (4년) 데이터
		$wr_college = unserialize($get_resume['wr_college']);
		$wr_college_cnt = count($wr_college['college']);
		// 대학원 데이터
		$wr_graduate = unserialize($get_resume['wr_graduate']);
		$wr_graduate_cnt = count($wr_graduate['graduate']);
		// 대학원 이상 데이터
		$wr_success = unserialize($get_resume['wr_success']);
		$wr_success_cnt = count($wr_graduate['success']);
		/* //학력사항 */


		/* 경력사항 */
		if($get_resume['wr_career']){
			$wr_career_use = $get_resume['wr_career_use'];
			if($wr_career_use){	// 경력 사항을 체크했다면
				$wr_career = unserialize($get_resume['wr_career']);
			}
		}
		/* //경력사항 */


		/* OA 능력 및 특기사항 */
		if($get_resume['wr_oa']){
			$wr_oa = unserialize($get_resume['wr_oa']);	// oa 능력 및 특기사항
			$oa_word = $alba_individual_control->oa_level['word'][$wr_oa['word']];				// 워드 능력
			$oa_pt = $alba_individual_control->oa_level['pt'][$wr_oa['pt']];								// 파워포인트 능력
			$oa_sheet = $alba_individual_control->oa_level['sheet'][$wr_oa['sheet']];				// 엑셀 능력
			$oa_internet = $alba_individual_control->oa_level['internet'][$wr_oa['internet']];	// 인터넷 능력
		}
		/* //OA 능력 및 특기사항 */


		/* 컴퓨터 능력 */
		if($get_resume['wr_computer']){
			$wr_computer = explode(',',$get_resume['wr_computer']);
			$wr_computer_cnt = count($wr_computer);
			$computers = array();
			for($i=0;$i<$wr_computer_cnt;$i++){
				$computers[$i] = $category_control->get_categoryCodeName($wr_computer[$i]);
			}
		}
		/* //컴퓨터 능력 */

		/* 특기사항 */
		if($get_resume['wr_specialty']){
			$wr_specialty = explode(',',$get_resume['wr_specialty']);
			$wr_specialty_cnt = count($wr_specialty);
			$specialty = array();
			for($i=0;$i<$wr_specialty_cnt;$i++){
				$specialty[$i] = $category_control->get_categoryCodeName($wr_specialty[$i]);
			}
			$wr_specialty_etc = explode('//',$get_resume['wr_specialty_etc']);
			if($wr_specialty_etc[0]){
				array_push($specialty,$wr_specialty_etc[1]);
			}
		}
		/* //특기사항 */

		$wr_prime = nl2br(stripslashes($get_resume['wr_prime']));	// 수상·수료활동내역
		$wr_introduce = $utility->conv_content($get_resume['wr_introduce'],2);


		/* 포토앨범 */
		$photo_0 = $user_control->get_member_photo($member['mb_id'], 0);
		$photo_0_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_0;
		$photo_0 = (is_file($photo_0_file)) ? $photo_0_file : "../images/comn/no_profileimg.gif";

		$photo_1 = $user_control->get_member_photo($member['mb_id'], 1);
		$photo_1_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_1;
		$photo_1 = (is_file($photo_1_file)) ? $photo_1_file : "../images/comn/no_profileimg.gif";

		$photo_2 = $user_control->get_member_photo($member['mb_id'], 2);
		$photo_2_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_2;
		$photo_2 = (is_file($photo_2_file)) ? $photo_2_file : "../images/comn/no_profileimg.gif";

		$photo_3 = $user_control->get_member_photo($member['mb_id'], 3);
		$photo_3_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_3;
		$photo_3 = (is_file($photo_3_file)) ? $photo_3_file : "../images/comn/no_profileimg.gif";
		/* //포토앨범 */


		/* 장애여부 */
		$wr_impediment_use = $get_resume['wr_impediment_use'];
		if($wr_impediment_use){
			$wr_impediment_level = $category_control->get_categoryCodeName($get_resume['wr_impediment_level']);
			$impediment = $get_resume['wr_impediment_name'] . " " . $wr_impediment_level;
		} else {
			$impediment = "해당사항 없음";
		}
		/* //장애여부 */

		$wr_marriage = ($get_resume['wr_marriage']) ? "기혼" : "미혼";
		$wr_military = $alba_individual_control->military[$get_resume['wr_military']];	// 군필 여부

		$wr_preferential_use = $get_resume['wr_preferential_use'];
		$wr_preferential = array();
		($wr_preferential_use) ? array_push($wr_preferential,"국가보훈 대상자") : "";

		$wr_treatment_use = $get_resume['wr_treatment_use'];
		($wr_treatment_use) ?  array_push($wr_preferential,"고용지원금 대상자") : "";

		if($get_resume['wr_treatment_service']){
			$wr_treatment_service = explode(',',$get_resume['wr_treatment_service']);
			$wr_treatment_service_cnt = count($wr_treatment_service);
			$treatment_service = array();
			for($i=0;$i<$wr_treatment_service_cnt;$i++){
				$treatment_service[$i] = $category_control->get_categoryCodeName($wr_treatment_service[$i]);
			}
			$treatment = "<br/>(";
			$treatment .= @implode($treatment_service,', ');
			$treatment .= ")";
		}


		$get_member = $user_control->get_member($get_resume['wr_id']);	 // 등록 회원 정보
		$mb_gender_txt = $user_control->mb_gender_txt[$get_member['mb_gender']];	// 성별
		$mb_birth = explode('-',$get_member['mb_birth']);
		$mb_homepage = $utility->add_http($get_member['mb_homepage']);

		$mb_photo_file = $alice['data_member_path']."/".$get_member['mb_id']."/".$get_member['mb_photo'];
		$mb_photo = (is_file($mb_photo_file)) ? $mb_photo_file : "../images/basic/bg_noPhoto.gif";	 // 개인회원 프로필 사진


		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_resume_detail.html'))
			include_once $alice['self'] . 'views/alba_resume_detail.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_resume_detail.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>