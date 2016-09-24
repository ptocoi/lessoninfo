<?php
		/*
		* /application/resume/index.php
		* @author Harimao
		* @since 2013/07/29
		* @last update 2015/03/30
		* @Module v3.5 ( Alice )
		* @Brief :: Alba list
		* @Comment :: 알바 이력서 리스팅
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
		# Pre - Variables
		if($is_employ && $is_alba){	// 채용공고 와 알바 모두 사용시엔 채용공고를 읽어온다
			$search_mode = "resume_index";
			$include_file = "index.html";
		} else {	 // 채용공고를 사용하지 않고 알바만 사용하는 경우엔 알바를 읽어온다
			if($is_alba){
				$search_mode = "alba_resume_index";
				$include_file = "alba.html";
			} else {	 // 이도저도 아닐땐 채용공고를 읽어온다
				$search_mode = "resume_index";
				$include_file = "index.html";
			}
		}

		##
		# Search
		$mode = $_GET['mode'];
		if($mode=='search'){	 // 이력서 검색

			// 지역
			$wr_area_0 = $_GET['wr_area_0'];	// 1차 지역 배열
			$wr_area_1 = $_GET['wr_area_1'];	// 2차 지역 배열		
			$wr_area_2 = $_GET['wr_area_2'];	// 3차 지역 배열

			$area_sels = $_GET['area_sels'];	// 지역 검색 값

			// 직종
			$wr_jobtype_0 = $_GET['wr_jobtype_0'];	 // 1차 직종 배열
			$wr_jobtype_1 = $_GET['wr_jobtype_1'];	 // 2차 직종 배열
			$wr_jobtype_2 = $_GET['wr_jobtype_2'];	 // 3차 직종 배열

			$jobtype_sels = $_GET['jobtype_sels'];	// 직종 검색 값

			$wr_date = $_GET['wr_date'];	// 근무기간
			$wr_week = $_GET['wr_week'];	// 근무요일
			$wr_time = $_GET['wr_time'];	// 근무시간

			$wr_school_ability = $_GET['wr_school_ability'];	// 학력
			$wr_career_use = $_GET['wr_career_use'];	// 경력 유무 선택
			$wr_career = $_GET['wr_career'];	// 선택 경력

			$wr_age = $_GET['wr_age'];	// 나이
			$wr_age_limit = $_GET['wr_age_limit'];	// 나이 무관 포함

			$wr_gender = $_GET['wr_gender'];	// 성별

		}

		##
		# Variables
		$all_count = $alba_resume_user_control->resume_count_image('all');
		$today_count = $alba_resume_user_control->resume_count_image('today');

		$page = ($page) ? $page : 1;

		// 포커스 이력서
		$focus_rows = ($design['sub_focus_total']) ? $design['sub_focus_total'] : 15;
		//  and `wr_report` = 0
		$focus_con = " where `wr_open` = 1 and `wr_service_sub_focus` >= now() and `is_delete` = 0 ";
		$focus_list = $alba_resume_user_control->__ResumeList( $page, $focus_rows, $focus_con );
		$focus_list_total = $focus_list['total_count'];		
		$focus_row = 3;
		$focus_rest = ($focus_row) - ($focus_list_total % $focus_row);

		$service_check = $service_control->service_check('alba_resume_basic');	// 이력서 일반 리스트 사용시

		// 오늘의 인재
		$today_rows = ($design['today_resume_total']) ? $design['today_resume_total'] : 20;
		//  and `wr_report` = 0
		$today_con = " where `wr_open` = 1 and `wr_wdate` > curdate() and `is_delete` = 0 ";
		if($service_check['is_pay']){
			$today_con .= " and ( `wr_service_basic_sub` >= curdate() ) ";
		}
		$today_list = $alba_resume_user_control->__ResumeList( $page, $today_rows, $today_con );
		$pages = $utility->user_get_paging($today_rows, $page, $total_page,"./index.php?page_rows=".$today_rows."&".$today_list['send_url']."&page=");

		// 서브 일반 리스트
		//  and `wr_report` = 0
		$sub_list_con = " where `wr_open` = 1 and `is_delete` = 0 ";
		if($service_check['is_pay']){
			$sub_list_con .= " and ( `wr_service_basic_sub` >= curdate() ) ";
		}
		$sub_list = $alba_resume_user_control->__ResumeList( $page, 25, $sub_list_con );


		$sresume_focus_banner = $banner_control->get_banner_for_position("sresume_focus_top");	// 서브 포커스 인재정보 위 배너
		$sresume_today_banner = $banner_control->get_banner_for_position("sresume_today_top");	// 서브 오늘의 인재정보 위 배너
		$sresume_basic_banner = $banner_control->get_banner_for_position("sresume_basic_top");	// 서브 일반 인재정보 위 배너


		##
		# Include view
		if(is_file($alice['self'] . 'views/' . $include_file))
			include_once $alice['self'] . 'views/' . $include_file;
		else
			$config->error_info( $alice['self'] . 'views/' . $include_file );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>