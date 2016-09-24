<?php
		/*
		* /application/individual/alba_resume_regist.php
		* @author Harimao
		* @since 2013/07/16
		* @last update 2014/07/08
		* @Module v3.5 ( Alice )
		* @Brief :: Individual alba resume regist form
		* @Comment :: 개인회원 정규직 이력서 등록/수정 폼
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "individual";

		$banner_atop_position = $page_name . "_top";
		$banner_logo_position = $page_name . "_logo_banner";
		$banner_top_position = $page_name . "_top_banner";
		$banner_left_position = $page_name . "_left";
		$banner_tail_position = $page_name . "_bottom";
		$banner_left_wing_position = $page_name . "_left_scroll";
		$banner_right_wing_position = $page_name . "_right_scroll";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$no = $_GET['no'];
		if($no && !$mode) $mode = "update";	// 없는 경우 수정

		if($mode=='update' || $mode=='load'){	// 수정/불러오기

			if($no){
				$get_resume = $alba_individual_control->get_resume_no($no);
				if(!$get_resume){	// 이력서가 존재하지 않거나, 삭제된 데이터 입니다.
					$utility->popup_msg_js($alba_individual_control->_errors('0010'));
					exit;
				}
				if($get_resume['wr_id'] != $member['mb_id']){	// 자신이 등록한 이력서만 수정 가능합니다.
					$utility->popup_msg_js($alba_individual_control->_errors('0001'));
					exit;
				}
			} else {	 // 이력서 고유 데이터 번호가 잘못 되었습니다.\\n\\n해당 이력서가 삭제되었거나 이력서에 문제가 있을수 있습니다.
				$utility->popup_msg_js($alba_individual_control->_errors('0004'));
				exit;
			}

			/* 지역 */
			$wr_area0 = $get_resume['wr_area0'];
			$wr_area1 = $get_resume['wr_area1'];

			$wr_area2 = $get_resume['wr_area2'];
			$wr_area3 = $get_resume['wr_area3'];

			$wr_area4 = $get_resume['wr_area4'];
			$wr_area5 = $get_resume['wr_area5'];
			/* //지역 */


			/* 직종 */
			$wr_job_type0 = $get_resume['wr_job_type0'];
			$wr_job_type1 = $get_resume['wr_job_type1'];
			$wr_job_type2 = $get_resume['wr_job_type2'];

			$wr_job_type3 = $get_resume['wr_job_type3'];
			$wr_job_type4 = $get_resume['wr_job_type4'];
			$wr_job_type5 = $get_resume['wr_job_type5'];

			$wr_job_type6 = $get_resume['wr_job_type6'];
			$wr_job_type7 = $get_resume['wr_job_type7'];
			$wr_job_type8 = $get_resume['wr_job_type8'];
			/* //직종 */


			$wr_work_type = explode(',',$get_resume['wr_work_type']);		// 근무형태
			

			/* 학력 */
			$wr_school_ability = explode('/',$get_resume['wr_school_ability']);
			$wr_school_type = explode(',',$get_resume['wr_school_type']);

			$schoolSelect_view = false;
			if($get_resume['wr_half_college'] || $get_resume['wr_college'] || $get_resume['wr_graduate'] || $get_resume['wr_success']){
				$schoolSelect_view = true;
			}

			// 고등학교
			$high_school_display = "none";
			if(@in_array('high_school',$wr_school_type)){
				$high_school_display = "";
			}

			// 대학(2,3학년)
			$high_school_disabled = "disabled";	
			$high_school_checked = "";
			$half_college_display = "none";
			
			if(@in_array('half_college',$wr_school_type)){
				$high_school_disabled = "";
				$high_school_checked = "checked";
				$half_college_display = "";
			}
			
			// 대학 (2,3년) 데이터
			$wr_half_college = unserialize($get_resume['wr_half_college']);
			$wr_half_college_cnt = count($wr_half_college['college']);

			// 대학(4학년)
			$half_college_disabled = "disabled";
			$half_college_checked = "";
			$college_display = "none";
			if(@in_array('college',$wr_school_type)){
				$half_college_disabled = "";
				$half_college_checked = "checked";
				$college_display = "";
			}

			// 대학 (4년) 데이터
			$wr_college = unserialize($get_resume['wr_college']);
			$wr_college_cnt = count($wr_college['college']);
			
			// 대학원
			$college_disabled = "disabled";
			$college_checked = (@in_array('college',$wr_school_type)) ? "checked" : "";
			$graduate_checked = "";
			$graduate_display = "none";
			if(@in_array('graduate',$wr_school_type)){
				$college_disabled = "";
				$college_checked = "checked";
				$graduate_checked = "checked";
				$graduate_display = "";
			}
			
			// 대학원 데이터
			$wr_graduate = unserialize($get_resume['wr_graduate']);
			$wr_graduate_cnt = count($wr_graduate['graduate']);

			// 대학원 이상 데이터
			$wr_success = unserialize($get_resume['wr_success']);
			$wr_success_cnt = count($wr_graduate['success']);

			$success_display = "none";
			if(@in_array('success',$wr_school_type)){
				$graduate_display = "";
			}

			if(@in_array('half_college',$wr_school_type)){
				$half_college_checked = "checked";
			}
			if(@in_array('college',$wr_school_type)){
				$college_checked = "checked";
			}
			if(@in_array('graduate',$wr_school_type)){
				$graduate_checked = "checked";
			}
			/* //학력 */


			/* 경력 */
			$wr_career_use = $get_resume['wr_career_use'];
			if($wr_career_use){
				$wr_career = unserialize($get_resume['wr_career']);
			}
			/* //경력 */

			/* 자격증 */
			$wr_license_use = $get_resume['wr_license_use'];
			if($wr_license_use){
				$wr_license = unserialize($get_resume['wr_license']);
			}
			/* //자격증 */

			/* 외국어 */
			$wr_language_use = $get_resume['wr_language_use'];
			if($wr_language_use){
				$wr_language = unserialize($get_resume['wr_language']);
			}
			/* //외국어 */

			if($get_resume['wr_oa']) $wr_oa = unserialize($get_resume['wr_oa']);
			if($get_resume['wr_computer']) $wr_computer = explode(',',$get_resume['wr_computer']);
			if($get_resume['wr_specialty']) $wr_specialty = explode(',',$get_resume['wr_specialty']);

			$wr_specialty_etc = explode('//',$get_resume['wr_specialty_etc']);

			$wr_treatment_service = explode(',',$get_resume['wr_treatment_service']);
			$wr_calltime = explode('-',$get_resume['wr_calltime']);

		} else {

			$mode = "insert";

		}

		$past_list = $alba_individual_control->past_resume_list($no,$member['mb_id']);


		$mb_gender_txt = $user_control->mb_gender_txt[$member['mb_gender']];
		$mb_birth = explode('-',$member['mb_birth']);
		$area_list = $category_control->category_codeList('area', '', 'yes');					// 지역
		$job_type_list = $category_control->category_codeList('job_type', '', 'yes');		// 직종
		$alba_date_list = $category_control->category_codeList('alba_date');	// 정규직근무기간
		$alba_week_list = $category_control->category_codeList('alba_week');	// 정규직근무요일
		$alba_time_list = $category_control->category_codeList('alba_time');	// 정규직근무시간
		$alba_pay_list = $category_control->category_codeList('alba_pay');		// 정규직급여조건
		$work_type_list = $category_control->category_codeList('work_type');	// 근무형태
		$indi_ability_list = $category_control->category_codeList('indi_ability', '', 'yes');	// 학력
		$indi_language_list = $category_control->category_codeList('indi_language', '', 'yes');	// 외국어
		$language_date = $alba_resume_control->language_date;	// 연수기간
		$indi_language_license_list = $category_control->category_codeList('indi_language_license', '', 'yes');	// 외국어공인시험
		$indi_oa_list = $category_control->category_codeList('indi_oa', '', 'yes');	// 컴퓨터능력
		$indi_special_list = $category_control->category_codeList('indi_special', '', 'yes');	// 특기사항
		$indi_introduce_list = $category_control->category_codeList('indi_introduce', '', 'yes');	// 자기소개서항목
		$impediment_list = $category_control->category_codeList('impediment', '', 'yes');	// 장애등급
		$indi_treatment_list = $category_control->category_codeList('indi_treatment', '', 'yes');	// 고용지원금대상자

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

		$form_ability = $category_control->get_categoryCode('20130701141446_6430');	// 학력사항
		$form_career = $category_control->get_categoryCode('20130701141450_4818');	// 경력사항
		$form_license = $category_control->get_categoryCode('20130701141512_4553');	// 보유자격증
		$form_language = $category_control->get_categoryCode('20130701141523_0920');	// 외국어능력
		$form_oa = $category_control->get_categoryCode('20130701141550_6432');	// OA능력
		$form_etc = $category_control->get_categoryCode('20130806101107_1378');	// 부가정보
		$form_welfare = $category_control->get_categoryCode('20130806101116_6157');	// 부가정보

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form','placeholder'));

		##
		# Call Editor
		echo "<script src='".$alice['editor_path']."/cheditor/cheditor.js'></script>";
		echo $utility->call_cheditor("wr_introduce", '100%', '580px');

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_resume_regist.html'))
			include_once $alice['self'] . 'views/alba_resume_regist.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_resume_regist.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>