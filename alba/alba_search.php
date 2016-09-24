<?php
		/*
		* /application/alba/alba_search.php
		* @author Harimao
		* @since 2013/08/12
		* @last update 2015/03/17
		* @Module v3.5 ( Alice )
		* @Brief :: Alba list
		* @Comment :: 정규직 상세검색
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "alba";

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

			// 지역
			$wr_area_0 = $_GET['wr_area_0'];	// 1차 지역 배열
			$wr_area_1 = $_GET['wr_area_1'];	// 2차 지역 배열
			$wr_area_2 = $_GET['wr_area_2'];	// 3차 지역 배열

			$area_sels = $_GET['area_sels'];	// 지역 검색 값

			// 역세권
			$wr_subway_0 = $_GET['wr_subway_0'];	 // 1차 역세권 배열
			$wr_subway_1 = $_GET['wr_subway_1'];	 // 2차 역세권 배열
			$wr_subway_2 = $_GET['wr_subway_2'];	 // 3차 역세권 배열

			$subway_sels = $_GET['subway_sels'];	// 역세권 검색 값

			// 직종
			$wr_jobtype_0 = $_GET['wr_jobtype_0'];	 // 1차 직종 배열
			$wr_jobtype_1 = $_GET['wr_jobtype_1'];	 // 2차 직종 배열
			$wr_jobtype_2 = $_GET['wr_jobtype_2'];	 // 3차 직종 배열

			$jobtype_sels = $_GET['jobtype_sels'];	// 직종 검색 값

			$wr_college_area = $_GET['wr_college_area'];	 // 대학가
			$wr_college_vicinity = $_GET['wr_college_vicinity'];	// 인근대학

			$wr_date = $_GET['wr_date'];		// 근무기간
			$wr_week = $_GET['wr_week'];	// 근무요일

			// 근무시간
			$wr_stime = $_GET['wr_stime'];	// 시작시간
			$wr_etime = $_GET['wr_etime'];	// 종료시간
			$wr_time_conference = $_GET['wr_time_conference'];	// 시간협의

			$wr_pay_type = $_GET['wr_pay_type'];	// 급여 조건
			$wr_pay = $_GET['wr_pay'];	// 급여

			$wr_gender = $_GET['wr_gender'];	// 성별
			$wr_gender_not = $_GET['wr_gender_not'];	 // 성별 무관

			$wr_age = $_GET['wr_age'];	// 연령
			$wr_age_limit = $_GET['wr_age_limit'];	// 연령 무관 포함

			$wr_ability = $_GET['wr_ability'];	// 학력
			$wr_preferential = $_GET['wr_preferential'];	// 우대조건
			$wr_welfare = $_GET['wr_welfare'];	// 복리후생
			$wr_target = $_GET['wr_target'];	// 모집대상
			$wr_work_type = $_GET['wr_work_type'];	// 근무형태

			$wr_requisition = $_GET['wr_requisition'];	// 지원방법

			$wr_wdate = $_GET['wr_wdate'];	// 등록일

			$search_keyword = urldecode(trim($search_keyword));	// 검색어

		}


		##
		# Variables
		$view_type = $_GET['view_type'];	// 리스팅 타입
		$sort = $_GET['sort'];

		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows : 20;
		//  and `wr_report` = 0
		$search_con .= " where `wr_open` = 1 and `wr_is_adult` = 0 and `is_delete` = 0 and (`wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";
		$service_check = $service_control->service_check('alba_basic');	// 채용공고 일반 리스트 사용시
		if($service_check['is_pay']){
			$search_con .= " and ( `wr_service_basic` >= curdate() ) ";
		}
		$search_list = $search_control->__AlbaSearch( $page, $page_rows, $search_con);

		$total_page = $search_list['total_page'];
		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_search.php?page_rows=".$page_rows."&".$search_list['send_url']."&page=");

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_search.html'))
			include_once $alice['self'] . 'views/alba_search.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_search.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>