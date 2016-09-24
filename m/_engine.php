<?php
	$alice_path = "../../";

	$cat_path = "../../";

	include_once $alice_path . "_core.php";

	$sms_config = $sms_control->sms_config(1);
	$sms_use = $sms_config['sms_use'];	// sms 사용 유무

	$mb_phone = explode('-',$member['mb_phone']);
	$mb_hpone = explode('-',$member['mb_hphone']);
	$mb_email = explode('@',$member['mb_email']);

	$mb_udate = substr($member['mb_udate'],0,11);	// 회원정보 수정일

	$mb_photo_file = $alice['data_member_path']."/".$member['mb_id']."/".$member['mb_photo'];
	$mb_photo = (is_file($mb_photo_file)) ? $mb_photo_file : "../images/basic/bg_noPhoto.gif";	 // 개인회원 프로필 사진

	$mb_logo_file = $alice['data_member_path']."/".$company_member['mb_id']."/logo/".$company_member['mb_logo'];
	$mb_logo = (is_file($mb_logo_file)) ? $mb_logo_file : "../images/basic/bg_noPhoto.gif";	 // 기업회원 로고 사진

	$tel_num_option = $config->get_tel_num($mb_phone[0]);		// 전화번호
	$hp_num_option = $config->get_hp_num($mb_hpone[0]);		// 휴대폰 번호
	$email_option = $config->get_email();										// 이메일

	$save_id = $utility->get_cookie("ack_mb_id");	 // 로그인 아이디 저장 쿠키

	$category_area = $category_control->category_codeList('area','','yes');	 // 지역
	$category_subway = $category_control->category_codeList('subway','','yes');	 // 역세권 카테고리
	$job_types = $category_control->category_codeLists('job_type'," and `p_code` = '' and `view` = 'yes' and `etc_0` != '1'  ");	// 일반 직종
	$job_career_list = $category_control->category_codeList('job_career', '', 'yes');		// 경력조건
	$job_ability_list = $category_control->category_codeList('job_ability', '', 'yes');		// 학력조건
	$alba_date_list = $category_control->category_codeList('alba_date', '', 'yes');	// 알바근무기간
	$alba_pay_list = $category_control->category_codeList('alba_pay', '', 'yes');	// 알바급여조건

	$is_adult_type = $category_control->is_adult_type('job_type');	// 성인 직종 사용 유무
	$is_adult = $is_adult_type['is_adult'];
	$adult_cate = $is_adult_type['adult'];
	$adult_job_types = $category_control->category_codeLists('job_type'," and `p_code` = '' and `view` = 'yes' and `etc_0` = '1'  ");	 // 성인직종 카테고리

	$indi_ability_list = $category_control->category_codeList('indi_ability', '', 'yes');	// 인재정보 학력
	$indi_special_list = $category_control->category_codeList('indi_special', '', 'yes');	// 특기사항
	$indi_language_list = $category_control->category_codeList('indi_language', '', 'yes');	// 외국어

	$job_target = $category_control->category_codeList('job_target','','yes');	 // 채용대상

	$page = ($page) ? $page : 1;

	## 01. 메인 리스트 ############################################################################

	// 메인 박스형 채용공고 리스트
	$main_box_use = $mobile_info['wr_main_box_use'];
	$main_box_total = $mobile_info['wr_main_box_total'];
	$main_box_page = $mobile_info['wr_main_box_page'];
	
	if($main_box_use){


		$main_box_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 ";
		$main_box_con .= " and (`wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";
		$main_box_con .= " and ( `wr_service_platinum` >= now() ";
		$main_box_con .= " or `wr_service_prime` >= now() ";
		$main_box_con .= " or `wr_service_grand` >= now() ";
		$main_box_con .= " or `wr_service_banner` >= now() ) ";

		$main_box_list = $mobile_control->alba_listing( $page, $main_box_page, $main_box_con, $main_box_total );
		$main_box_list_count = count($main_box_list['result']);

		$main_box_total_page = $main_box_list['total_page'];
		//$main_box_pages = $mobile_control->get_paging($main_box_page, $page, $main_box_total_page, "./index.html?page_rows=".$main_box_page."&page=");
		$main_box_pages = $mobile_control->get_ajax_paging($main_box_page, $page, $main_box_total_page, "main_box");

	}

	// 메인 리스트형 채용공고 리스트
	$main_list_use = $mobile_info['wr_main_list_use'];
	$main_list_total = $mobile_info['wr_main_list_total'];
	$main_list_page = $mobile_info['wr_main_list_page'];
	
	if($main_list_use){

		$main_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 and `wr_service_list` >= now() ";
		$main_list_con .= " and (`wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";

		$main_list = $mobile_control->alba_listing( $page, $main_list_page, $main_list_con, $main_list_total );
		$main_list_count = count($main_list['result']);

		$main_list_total_page = $main_list['total_page'];
		$main_list_pages = $mobile_control->get_ajax_paging($main_list_page, $page, $main_list_total_page, "main_list");

	}

	// 메인 포커스 인재정보 리스트
	$main_focus_use = $mobile_info['wr_main_focus_use'];
	$main_focus_total = $mobile_info['wr_main_focus_total'];
	$main_focus_page = $mobile_info['wr_main_focus_page'];

	if($main_focus_use){
		
		$main_focus_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 and `wr_service_main_focus` >= now() ";

		$main_focus = $mobile_control->resume_listing( $page, $main_focus_page, $main_focus_con, $main_focus_total );
		$main_focus_count = count($main_focus['result']);

		$main_focus_total_page = $main_focus['total_page'];
		$main_focus_pages = $mobile_control->get_ajax_paging($main_focus_page, $page, $main_focus_total_page, "main_focus");

	}


	// 메인 게시판 리스트
	$main_board_use = $mobile_info['wr_main_board_use'];
	$main_board = unserialize($mobile_info['wr_main_board']);

	// 메인 공지사항 출력
	$main_notice_use = $mobile_info['wr_main_notice_use'];
	$main_notice_list = $notice_control->get_notice_list_count(5);	// 공지사항

	## //01. 메인 리스트 ###########################################################################

	
	## 02. 서브 채용정보 리스트 #######################################################################

	// 서브 박스형 채용공고 리스트
	$sub_box_use = $mobile_info['wr_sub_box_use'];
	$sub_box_total = $mobile_info['wr_sub_box_total'];
	$sub_box_page = $mobile_info['wr_sub_box_page'];

	if($sub_box_use){

		$sub_box_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 ";
		$sub_box_con .= " and (`wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";
		$sub_box_con .= " and (`wr_service_platinum_sub` >= now() or `wr_service_banner_sub` >= now() ) ";

		$sub_box_list = $mobile_control->alba_listing( $page, $sub_box_page, $sub_box_con, $sub_box_total );
		$sub_box_list_count = count($sub_box_list['result']);

		$sub_box_total_page = $sub_box_list['total_page'];
		$sub_box_pages = $mobile_control->get_ajax_paging($sub_box_page, $page, $sub_box_total_page, "sub_box");

	}

	// 서브 리스트형 채용공고 리스트
	$sub_list_use = $mobile_info['wr_sub_list_use'];
	$sub_list_total = $mobile_info['wr_sub_list_total'];
	$sub_list_page = $mobile_info['wr_sub_list_page'];

	if($sub_list_use){

		$sub_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 and `wr_service_list_sub` >= now() ";
		$sub_list_con .= " and (`wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";

		$sub_list = $mobile_control->alba_listing( $page, $sub_list_page, $sub_list_con, $sub_list_total );
		$sub_list_count = count($sub_list['result']);

		$sub_list_total_page = $sub_list['total_page'];
		$sub_list_pages = $mobile_control->get_ajax_paging($sub_list_page, $page, $sub_list_total_page, "sub_list");

	}

	// 서브 일반 채용공고 리스트
	$sub_use = $mobile_info['wr_sub_use'];
	$sub_total = $mobile_info['wr_sub_total'];
	$sub_page = $mobile_info['wr_sub_page'];

	if($sub_use){

		$sub_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 ";	 //  and `wr_service_list_sub` >= now()
		$sub_con .= " and (`wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";

		$sub = $mobile_control->alba_listing( $page, $sub_page, $sub_con, $sub_total );
		$sub_count = count($sub['result']);

		$sub_total_page = $sub['total_page'];
		$sub_pages = $mobile_control->get_ajax_paging($sub_page, $page, $sub_total_page, "sub");

	}

	// 급구 채용공고 리스트
	$busy_page_rows = ($page_rows) ? $page_rows : 25;
	$busy_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 and `wr_service_busy` >= now() ";
	$busy_list_con .= " and (`wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";
	$busy_list = $mobile_control->__AlbaList($page, $busy_page_rows, $busy_list_con);
	$pages = $mobile_control->get_paging($busy_page_rows, $page, $busy_list['total_page'], "./list_busy.html?page_rows=".$busy_page_rows."&page=");

	## //02. 서브 채용정보 리스트 ######################################################################


	## 03. 서브 인재정보 리스트 #######################################################################

	// 서브 포커스 인재정보 리스트
	$sub_focus_use = $mobile_info['wr_sub_focus'];
	$sub_focus_total = $mobile_info['wr_sub_focus_total'];
	$sub_focus_page = $mobile_info['wr_sub_focus_page'];

	if($sub_focus_use){

		$sub_focus_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 and `wr_service_sub_focus` >= now() ";
		//$sub_focus_con .= " and `wr_service_platinum_sub` >= now() ";
		//$sub_focus_con .= " or `wr_service_banner_sub` >= now() ";

		$sub_focus_list = $mobile_control->alba_resume_listing( $page, $sub_focus_page, $sub_focus_con, $sub_focus_total );
		$sub_focus_list_count = count($sub_focus_list['result']);

		$sub_focus_total_page = $sub_focus_list['total_page'];
		$sub_focus_pages = $mobile_control->get_ajax_paging($sub_focus_page, $page, $sub_focus_total_page, "sub_focus");

	}

	// 서브 일반 인재정보 리스트
	$sub_individual_use = $mobile_info['wr_sub_individual'];
	$sub_individual_total = $mobile_info['wr_sub_individual_total'];
	$sub_individual_page = $mobile_info['wr_sub_individual_page'];
	
	if($sub_individual_use){

		$sub_individual_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 ";

		$sub_individual_list = $mobile_control->alba_resume_listing( $page, $sub_individual_page, $sub_individual_con, $sub_individual_total );
		$sub_individual_list_count = count($sub_individual_list['result']);

		$sub_individual_total_page = $sub_individual_list['total_page'];
		$sub_individual_pages = $mobile_control->get_ajax_paging($sub_individual_page, $page, $sub_individual_total_page, "sub_individual");
	}

	// 급구 인재정보 리스트
	$resume_busy_page_rows = ($page_rows) ? $page_rows : 25;
	$resume_busy_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 and `wr_service_busy` >= now() ";
	$resume_busy_list = $mobile_control->__AlbaResumeList($page, $resume_busy_page_rows, $resume_busy_list_con);
	$pages = $mobile_control->get_paging($resume_busy_page_rows, $page, $resume_busy_list['total_page'], "./list_busy.html?page_rows=".$resume_busy_page_rows."&page=");

	## //03. 서브 인재정보 리스트 ######################################################################

	
	## 알바 검색 ################################################################################
	$mode = $_GET['mode'];
	if($mode=='search'){	 // 검색
		
		$search_mode = $_GET['search_mode'];

		/*
		echo "<pre>";
		print_R($_GET);
		echo "</pre>";
		*/
		
		switch($search_mode){

			case 'alba_busy':	## 급구 알바
			case 'alba_local':	## 지역별 알바
			case 'alba_part':		## 직종별 알바
			case 'alba_subway':	## 역세권별 알바
			case 'alba_college':	## 대학가 알바
			case 'alba_term':	## 기간별 알바
			case 'alba_pay':	## 급여별 알바
			case 'alba_target':	## 급여별 알바
				
				$wr_area_0 = $_GET['wr_area_0'];

				// 직종
				$wr_job_type0 = $_GET['wr_job_type0'];	 // 1차 직종
				$wr_job_type1 = $_GET['wr_job_type1'];	 // 2차 직종
				$wr_job_type2 = $_GET['wr_job_type2'];	 // 3차 직종

				// 지하철
				$wr_subway_0 = $_GET['wr_subway_0'];
				$wr_subway_1 = $_GET['wr_subway_1'];
				$wr_subway_2 = $_GET['wr_subway_2'];

				// 인근대학
				$wr_college_area = $_GET['wr_college_area'];
				$wr_college_vicinity = $_GET['wr_college_vicinity'];

				// 선택 기간
				$wr_date = ($code) ? $code : $_GET['wr_date'];

				// 급여 조건
				$wr_pay_type = $_GET['wr_pay_type'];
				$wr_pay = $_GET['wr_pay'];

				// 선택 대상
				$wr_target = ($code) ? $code : $_GET['wr_target'];
				
				$wr_career = $_GET['wr_career'];
				$wr_career_type = $_GET['wr_career_type'];

				$wr_ability = $_GET['wr_ability'];
				$wr_age = $_GET['wr_age'];

				$wr_age_low = $_GET['wr_age_low'];
				$wr_age_limit = $_GET['wr_age_limit'];

				$wr_gender = $_GET['wr_gender'];

				$code = $_GET['code'];
				$code1 = $_GET['code1'];


				if(empty($code) && $code1) {

					$second_area = $category_control->get_categoryCode($code1);
					$first_area = $category_control->get_categoryCode($second_area['p_code']);

					$first_code = ($first_area['code']) ? $first_area['code'] : $wr_area_0[0];
					$second_code = ($code1) ? $code1 : $wr_area_0[1];
					$third_code = $wr_area_0[2];

					$second_type = $category_control->get_categoryCode($code1);
					$first_type = $category_control->get_categoryCode($second_type['p_code']);

					$first_type_code = ($first_type['code']) ? $first_type['code'] : $wr_job_type0;
					$second_type_code = ($code1) ? $code1 : $wr_job_type1;
					$third_type_code = $wr_job_type2;

					$second_subway = $category_control->get_categoryCode($code1);
					$first_subway = $category_control->get_categoryCode($second_subway['p_code']);

					$first_subway_code = ($first_subway['code']) ? $first_subway['code'] : $wr_subway_0;
					$second_subway_code = ($code1) ? $code1 : $wr_subway_1;
					$third_subway_code = $wr_subway_2;

					$first_college = $category_control->get_categoryCode($code1);

					$first_college_code = ($first_college['code']) ? $first_college['code'] : $wr_college_area;
					$second_college_code = ($second_college['code']) ? $second_college['code'] : $wr_college_vicinity;

					$first_pay = $category_control->get_categoryCode($code1);

					$first_pay_code = ($first_pay['code']) ? $first_pay['code'] : $wr_pay_type;
					$second_pay_code = ($second_pay['code']) ? $second_pay['code'] : $wr_pay;

					$code1 = ($wr_date) ? $wr_date : $code1;
					$code1 = ($wr_target) ? $wr_target : $code1;

				}else{

					$third_area = $category_control->get_categoryCode($code);
					$second_area = $category_control->get_categoryCode($third_area['p_code']);
					$first_area = $category_control->get_categoryCode($second_area['p_code']);

					/*
					$first_code = ($wr_area_0[0]) ? $wr_area_0[0] : $first_code;
					$second_code = ($wr_area_0[1]) ? $wr_area_0[1] : $second_code;
					$third_code = ($wr_area_0[2]) ? $wr_area_0[2] : $third_code;
					*/

					$first_code = ($first_area['code']) ? $first_area['code'] : $wr_area_0[0];
					$second_code = ($second_area['code']) ? $second_area['code'] : $wr_area_0[1];
					$third_code = ($code) ? $code : $wr_area_0[2];


					$third_type = $category_control->get_categoryCode($code);
					$second_type = $category_control->get_categoryCode($third_type['p_code']);
					$first_type = $category_control->get_categoryCode($second_type['p_code']);

					/*
					$first_type_code = ($wr_job_type0) ? $wr_job_type0 : $first_type_code;
					$second_type_code = ($wr_job_type1) ? $wr_job_type1 : $second_type_code;
					$third_type_code = ($wr_job_type2) ? $wr_job_type2 : $third_type_code;
					*/

					$first_type_code = ($first_type['code']) ? $first_type['code'] : $wr_job_type0;
					$second_type_code = ($second_type['code']) ? $second_type['code'] : $wr_job_type1;
					$third_type_code = ($code) ? $code : $wr_job_type2;


					$third_subway = $category_control->get_categoryCode($code);
					$second_subway = $category_control->get_categoryCode($third_subway['p_code']);
					$first_subway = $category_control->get_categoryCode($second_subway['p_code']);

					/*
					$first_subway_code = ($wr_subway_0) ? $wr_subway_0 : $first_subway_code;
					$second_subway_code = ($wr_subway_1) ? $wr_subway_1 : $second_subway_code;
					$third_subway_code = ($wr_subway_2) ? $wr_subway_2 : $third_subway_code;
					*/

					$first_subway_code = ($first_subway['code']) ? $first_subway['code'] : $wr_subway_0;
					$second_subway_code = ($second_subway['code']) ? $second_type['code'] : $wr_subway_1;
					$third_subway_code = ($code) ? $code : $wr_subway_2;

					$second_college = $category_control->get_categoryCode($code);
					$first_college = $category_control->get_categoryCode($second_college['p_code']);

					/*
					$first_college_code = ($wr_college_area) ? $wr_college_area : $first_college_code;
					$second_college_code = ($wr_college_vicinity) ? $wr_college_vicinity : $second_college_code;
					*/

					$first_college_code = ($first_college['code']) ? $first_college['code'] : $wr_college_area;
					$second_college_code = ($second_college['code']) ? $second_college['code'] : $wr_college_vicinity;


					$second_pay = $category_control->get_categoryCode($code);
					$first_pay = $category_control->get_categoryCode($second_pay['p_code']);

					/*
					$first_pay_code = ($wr_pay_type) ? $wr_pay_type : $first_pay_code;
					$second_pay_code = ($wr_pay) ? $wr_pay : $second_pay_code;
					*/

					$first_pay_code = ($first_pay['code']) ? $first_pay['code'] : $wr_pay_type;
					$second_pay_code = ($second_pay['code']) ? $second_pay['code'] : $wr_pay;

					$code = ($wr_date) ? $wr_date : $code;
					$code = ($wr_target) ? $wr_target : $code;

				}

			break;

			case 'alba_resume_busy':	## 급구 이력서
			case 'alba_resume_local':	## 지역별 이력서
			case 'alba_resume_part':	## 직종별 이력서
			case 'alba_resume_term':	## 기간별 이력서
			case 'alba_resume_search':	## 이력서 상세검색

				// 지역
				$wr_area0 = $_GET['wr_area0'];
				$wr_area1 = $_GET['wr_area1'];

				// 직종
				$wr_job_type0 = $_GET['wr_job_type0'];
				$wr_job_type1 = $_GET['wr_job_type1'];
				$wr_job_type2 = $_GET['wr_job_type2'];
				
				$wr_gender = $_GET['wr_gender'];

				$code = $_GET['code'];
				$code1 = $_GET['code1'];


				if(empty($code) && $code1) {
					// 선택 기간
					$wr_date = ($code1) ? $code1 : $_GET['wr_date'];

					$first_area = $category_control->get_categoryCode($code1);

					$first_code = ($first_area['code']) ? $first_area['code'] : $wr_area0;

					$second_type = $category_control->get_categoryCode($code1);
					$first_type = $category_control->get_categoryCode($second_type['p_code']);
					
					$first_type_code = ($first_type['code']) ? $first_type['code'] : $wr_job_type0;
					$second_type_code = ($code1) ? $code1 : $wr_job_type1;
					$third_type_code = $wr_job_type2;
				} else {
					// 선택 기간
					$wr_date = ($code) ? $code : $_GET['wr_date'];

					$second_area = $category_control->get_categoryCode($code);
					$first_area = $category_control->get_categoryCode($second_area['p_code']);

					$first_code = ($first_area['code']) ? $first_area['code'] : $wr_area0;
					$second_code = ($second_area['code']) ? $second_area['code'] : $wr_area1;

					$third_type = $category_control->get_categoryCode($code);
					$second_type = $category_control->get_categoryCode($third_type['p_code']);
					$first_type = $category_control->get_categoryCode($second_type['p_code']);

					$first_type_code = ($first_type['code']) ? $first_type['code'] : $wr_job_type0;
					$second_type_code = ($second_type['code']) ? $second_type['code'] : $wr_job_type1;
					$third_type_code = ($code) ? $code : $wr_job_type2;
				}

			break;

		}

	} else {

		$code = $_GET['code'];
		$code1 = $_GET['code1'];

		if(empty($code) && $code1) {
			$second_area = $category_control->get_categoryCode($code1);
			$first_area = $category_control->get_categoryCode($second_area['p_code']);

			$first_code = ($first_area['code']) ? $first_area['code'] : $wr_area_0[0];
			$second_code = ($code1) ? $code1 : $wr_area_0[1];
			$third_code = $wr_area_0[2];

			$second_type = $category_control->get_categoryCode($code1);
			$first_type = $category_control->get_categoryCode($second_type['p_code']);

			$first_type_code = ($first_type['code']) ? $first_type['code'] : $wr_job_type0;
			$second_type_code = ($code1) ? $code1 : $wr_job_type1;
			$third_type_code = $wr_job_type2;
		} else {
			$third_area = $category_control->get_categoryCode($code);
			$second_area = $category_control->get_categoryCode($third_area['p_code']);
			$first_area = $category_control->get_categoryCode($second_area['p_code']);

			$first_code = ($first_area['code']) ? $first_area['code'] : $wr_area_0[0];
			$second_code = ($second_area['code']) ? $second_area['code'] : $wr_area_0[1];
			$third_code = ($code) ? $code : $wr_area_0[2];

			$third_type = $category_control->get_categoryCode($code);
			$second_type = $category_control->get_categoryCode($third_type['p_code']);
			$first_type = $category_control->get_categoryCode($second_type['p_code']);

			$first_type_code = ($first_type['code']) ? $first_type['code'] : $wr_job_type0;
			$second_type_code = ($second_type['code']) ? $second_type['code'] : $wr_job_type1;
			$third_type_code = ($code) ? $code : $wr_job_type2;
		}

		$third_subway = $category_control->get_categoryCode($code);
		$second_subway = $category_control->get_categoryCode($third_subway['p_code']);
		$first_subway = $category_control->get_categoryCode($second_subway['p_code']);

		$first_subway_code = ($first_subway['code']) ? $first_subway['code'] : $wr_subway_0;
		$second_subway_code = ($second_subway['code']) ? $second_type['code'] : $wr_subway_1;
		$third_subway_code = ($code) ? $code : $wr_subway_2;

		$second_college = $category_control->get_categoryCode($code);
		$first_college = $category_control->get_categoryCode($second_college['p_code']);

		$first_college_code = ($first_college['code']) ? $first_college['code'] : $wr_college_area;
		$second_college_code = ($second_college['code']) ? $second_college['code'] : $wr_college_vicinity;

		$second_pay = $category_control->get_categoryCode($code);
		$first_pay = $category_control->get_categoryCode($second_pay['p_code']);

		$first_pay_code = ($first_pay['code']) ? $first_pay['code'] : $wr_pay_type;
		$second_pay_code = ($second_pay['code']) ? $second_pay['code'] : $wr_pay;

		$wr_pay = ($wr_pay) ? $wr_pay : $code;

		$wr_date = ($wr_date) ? $wr_date : $code;

		$wr_target = ($wr_target) ? $wr_target : $code;

	}


	// 지역별 채용공고 리스트
	if($page_name == 'alba_list_local'){
		$local_alba_page_rows = ($page_rows) ? $page_rows : 15;
		$local_alba_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `wr_is_adult` = 0 and `is_delete` = 0 ";
		$local_alba_list = $mobile_control->__AlbaList($page, $local_alba_page_rows, $local_alba_list_con);
		$pages = $mobile_control->get_paging($local_alba_page_rows, $page, $local_alba_list['total_page'], "./list_local_detail.html?".$local_alba_list['send_url']."&page_rows=".$local_alba_page_rows."&page=");
	}

	// 직종별 채용공고 리스트
	if($page_name == 'alba_list_part'){
		$type_alba_page_rows = ($page_rows) ? $page_rows : 15;
		$type_alba_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `wr_is_adult` = 0 and `is_delete` = 0 ";
		$type_alba_list = $mobile_control->__AlbaList($page, $type_alba_page_rows, $type_alba_list_con);
		$pages = $mobile_control->get_paging($type_alba_page_rows, $page, $type_alba_list['total_page'], "./list_part_detail.html?".$type_alba_list['send_url']."&page_rows=".$type_alba_page_rows."&page=");
	}

	// 성인직종 2차 카테고리
	$adult_pcode_list = $category_control->category_codeLists('job_type'," and `p_code` = '".$type."' and `etc_0` = '1' ");
	
	// 성인직종 채용공고 리스트
	if($page_name == 'alba_list_part_adult'){
		$adult_alba_page_rows = ($page_rows) ? $page_rows : 15;
		$adult_alba_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `wr_is_adult` = 1 and `is_delete` = 0 ";
		$adult_alba_list = $mobile_control->__AlbaList($page, $adult_alba_page_rows, $adult_alba_list_con);
		$pages = $mobile_control->get_paging($adult_alba_page_rows, $page, $adult_alba_list['total_page'], "./list_part_adult_detail.html?".$adult_alba_list['send_url']."&page_rows=".$adult_alba_page_rows."&page=");
	}	

	// 역세권 채용공고 리스트
	if($page_name == 'alba_list_subway'){
		$subway_alba_page_rows = ($page_rows) ? $page_rows : 15;
		$subway_alba_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `wr_is_adult` = 0 and `is_delete` = 0 ";
		$subway_alba_list = $mobile_control->__AlbaList($page, $subway_alba_page_rows, $subway_alba_list_con);
		$pages = $mobile_control->get_paging($subway_alba_page_rows, $page, $subway_alba_list['total_page'], "./list_subway_detail.html?".$subway_alba_list['send_url']."&page_rows=".$subway_alba_page_rows."&page=");
	}

	// 대학가 채용공고 리스트
	if($page_name == 'alba_list_college'){
		$college_alba_page_rows = ($page_rows) ? $page_rows : 15;
		$college_alba_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `wr_is_adult` = 0 and `is_delete` = 0 ";
		$college_alba_list = $mobile_control->__AlbaList($page, $college_alba_page_rows, $college_alba_list_con);
		$pages = $mobile_control->get_paging($college_alba_page_rows, $page, $college_alba_list['total_page'], "./list_college_detail.html?".$college_alba_list['send_url']."&page_rows=".$college_alba_page_rows."&page=");
	}

	// 기간별 채용공고 리스트
	if($page_name == 'alba_list_term'){
		$term_alba_page_rows = ($page_rows) ? $page_rows : 15;
		$term_alba_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `wr_is_adult` = 0 and `is_delete` = 0 ";
		$term_alba_list = $mobile_control->__AlbaList($page, $term_alba_page_rows, $term_alba_list_con);
		$pages = $mobile_control->get_paging($term_alba_page_rows, $page, $term_alba_list['total_page'], "./list_term_detail.html?".$term_alba_list['send_url']."&page_rows=".$term_alba_page_rows."&page=");
	}

	// 급여별 채용공고 리스트
	if($page_name == 'alba_list_pay'){
		$pay_alba_page_rows = ($page_rows) ? $page_rows : 15;
		$pay_alba_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `wr_is_adult` = 0 and `is_delete` = 0 ";
		$pay_alba_list = $mobile_control->__AlbaList($page, $pay_alba_page_rows, $pay_alba_list_con);
		$pages = $mobile_control->get_paging($pay_alba_page_rows, $page, $pay_alba_list['total_page'], "./list_pay_detail.html?".$pay_alba_list['send_url']."&page_rows=".$pay_alba_page_rows."&page=");
	}

	// 대상별 채용공고 리스트
	if($page_name == 'alba_list_target'){
		$target_alba_page_rows = ($page_rows) ? $page_rows : 15;
		$target_alba_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `wr_is_adult` = 0 and `is_delete` = 0 ";
		$target_alba_list = $mobile_control->__AlbaList($page, $target_alba_page_rows, $target_alba_list_con);
		$pages = $mobile_control->get_paging($target_alba_page_rows, $page, $target_alba_list['total_page'], "./list_target_detail.html?".$target_alba_list['send_url']."&page_rows=".$target_alba_page_rows."&page=");
	}

	// 상세검색 채용공고 리스트
	if($page_name == 'alba_list_search'){
		$search_alba_page_rows = ($page_rows) ? $page_rows : 15;
		$search_alba_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `wr_is_adult` = 0 and `is_delete` = 0 ";
		$search_alba_list = $mobile_control->__AlbaList($page, $search_alba_page_rows, $search_alba_list_con);
		$pages = $mobile_control->get_paging($search_alba_page_rows, $page, $search_alba_list['total_page'], "./list_search.html?".$search_alba_list['send_url']."&page_rows=".$search_alba_page_rows."&page=");
	}

	## //알바 검색 ###############################################################################


	// 지역별 이력서 리스트
	if($page_name == 'alba_resume_list_local'){
		$local_alba_resume_page_rows = ($page_rows) ? $page_rows : 15;
		$local_alba_resume_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 ";
		$local_alba_resume = $mobile_control->__AlbaResumeList($page, $local_alba_resume_page_rows, $local_alba_resume_con);
		$pages = $mobile_control->get_paging($local_alba_resume_page_rows, $page, $local_alba_resume['total_page'], "./list_local_detail.html?".$local_alba_resume['send_url']."&page_rows=".$local_alba_resume_page_rows."&page=");
	}

	// 직종별 이력서 리스트
	if($page_name == 'alba_resume_list_part'){
		$part_alba_resume_page_rows = ($page_rows) ? $page_rows : 15;
		$part_alba_resume_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 ";
		$part_alba_resume = $mobile_control->__AlbaResumeList($page, $part_alba_resume_page_rows, $part_alba_resume_con);
		$pages = $mobile_control->get_paging($part_alba_resume_page_rows, $page, $part_alba_resume['total_page'], "./list_part_detail.html?".$part_alba_resume['send_url']."&page_rows=".$part_alba_resume_page_rows."&page=");
	}

	// 기간별 이력서 리스트
	if($page_name == 'alba_resume_list_term'){
		$term_alba_resume_page_rows = ($page_rows) ? $page_rows : 15;
		$term_alba_resume_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 ";
		$term_alba_resume = $mobile_control->__AlbaResumeList($page, $term_alba_resume_page_rows, $term_alba_resume_con);
		$pages = $mobile_control->get_paging($term_alba_resume_page_rows, $page, $term_alba_resume['total_page'], "./list_part_detail.html?".$term_alba_resume['send_url']."&page_rows=".$term_alba_resume_page_rows."&page=");
	}

	// 이력서 상세검색 리스트
	if($page_name == 'alba_resume_list_search'){
		$search_alba_resume_page_rows = ($page_rows) ? $page_rows : 15;
		$search_alba_resume_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 ";
		$search_alba_resume = $mobile_control->__AlbaResumeList($page, $search_alba_resume_page_rows, $search_alba_resume_con);
		$pages = $mobile_control->get_paging($search_alba_resume_page_rows, $page, $search_alba_resume['total_page'], "./list_search.html?".$search_alba_resume['send_url']."&page_rows=".$search_alba_resume_page_rows."&page=");
	}


	// 서브 게시판 리스트
	$sub_board_use = $mobile_info['wr_board_use'];
	$sub_board = unserialize($mobile_info['wr_board']);


	$sns_feed = explode(',',$env['sns_feed']);

?>