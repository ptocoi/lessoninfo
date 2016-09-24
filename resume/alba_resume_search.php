<?php
		/*
		* /application/resume/alba_resume_search.php
		* @author Harimao
		* @since 2013/08/13
		* @last update 2015/03/17
		* @Module v3.5 ( Alice )
		* @Brief :: Alba Resume list
		* @Comment :: 급구 알바 이력서 리스팅
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "resume";

		$banner_atop_position = $page_name . "_top";
		$banner_logo_position = $page_name . "_logo_banner";
		$banner_top_position = $page_name . "_top_banner";
		$banner_left_position = $page_name . "_left";
		$banner_tail_position = $page_name . "_bottom";
		$banner_left_wing_position = $page_name . "_left_scroll";
		$banner_right_wing_position = $page_name . "_right_scroll";

		include_once $cat_path . "_engine.php";

		##
		# Search
		$mode = $_GET['mode'];
		if($mode=='search'){	 // 검색일때
			
			/*
			echo "<pre>";
			print_R($_GET);
			echo "</pre>";
			*/

			// 희망 지역
			$wr_area_0 = $_GET['wr_area_0'];	// 1차 지역 배열
			$wr_area_1 = $_GET['wr_area_1'];	// 2차 지역 배열

			$area_sels = $_GET['area_sels'];	// 지역 검색 값

			// 희망 직종
			$wr_jobtype_0 = $_GET['wr_jobtype_0'];	 // 1차 직종 배열
			$wr_jobtype_1 = $_GET['wr_jobtype_1'];	 // 2차 직종 배열
			$wr_jobtype_2 = $_GET['wr_jobtype_2'];	 // 3차 직종 배열

			$jobtype_sels = $_GET['jobtype_sels'];	// 직종 검색 값


			$wr_gender = $_GET['wr_gender'];	// 성별
			$wr_gender_all = $_GET['wr_gender_all'];	// 성별 무관포함

			$wr_age = $_GET['wr_age'];	// 연령
			$wr_age_limit = $_GET['wr_age_limit'];	// 무관포함

			$wr_date = $_GET['wr_date'];		// 근무기간
			$wr_week = $_GET['wr_week'];	// 근무요일
			$wr_time = $_GET['wr_time'];		// 근무시간
			$wr_work_type = $_GET['wr_work_type'];	// 근무형태

			$wr_school_ability = $_GET['wr_school_ability'];	// 학력
			$wr_license = $_GET['wr_license'];	// 보유자격증

			$wr_language_name = $_GET['wr_language_name'];	// 외국어
			$wr_language_level = $_GET['wr_language_level'];		// 외국어 정도
			$wr_language_study = $_GET['wr_language_study'];	// 어학연수 경험

			$wr_oa = $_GET['wr_oa'];					// OA능력
			$wr_oa_level = $_GET['wr_oa_level'];	// OA능력 정도

			$wr_computer = $_GET['wr_computer'];	// 컴퓨터 능력
			$wr_specialty = $_GET['wr_specialty'];	// 특기 사항

			$wr_treatment = $_GET['wr_treatment'];	// 기타
			$wr_treatment_service = $_GET['wr_treatment_service'];


			$search_keyword = urldecode(trim($search_keyword));	// 검색어

		}


		##
		# Variables
		$indi_oa_list = $category_control->category_codeList('indi_oa', '', 'yes');	// 컴퓨터능력
		$indi_special_list = $category_control->category_codeList('indi_special', '', 'yes');	// 특기사항
		$indi_treatment_list = $category_control->category_codeList('indi_treatment', '', 'yes');	// 고용지원금대상자

		$view_type = $_GET['view_type'];	// 리스팅 타입
		$sort = $_GET['sort'];

		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows : 20;
		//  and `wr_report` = 0
		$search_con = " where `wr_open` = 1 and `is_delete` = 0 ";
		$service_check = $service_control->service_check('alba_resume_basic');	// 이력서 일반 리스트 사용시
		if($service_check['is_pay']){
			$search_con .= " and ( `wr_service_basic` >= curdate() ) ";
		}
		$search_list = $search_control->__AlbaResumeSearch( $page, $page_rows, $search_con);

		$total_page = $search_list['total_page'];
		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_resume_search.php?page_rows=".$page_rows."&".$search_list['send_url']."&page=");

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_resume_search.html'))
			include_once $alice['self'] . 'views/alba_resume_search.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_resume_search.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>