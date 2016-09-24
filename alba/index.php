<?php
		/*
		* /application/alba/index.php
		* @author Harimao
		* @since 2013/07/29
		* @last update 2015/11/02
		* @Module v3.5 ( Alice )
		* @Brief :: Alba list
		* @Comment :: 정규직 메인
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

		$search_mode = "alba_index";

		include_once $cat_path . "_engine.php";

		##
		# Search
		$mode = $_GET['mode'];
		if($mode=='search'){	 // 알바 검색
			
			/*
			echo "<xmp>";
			print_R($_GET);
			echo "</xmp>";
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

			// 근무조건
			$wr_date = $_GET['wr_date'];		// 근무기간
			$wr_week = $_GET['wr_week'];	// 근무요일

			// 근무시간
			$wr_stime = $_GET['wr_stime'];	// 시작시간
			$wr_etime = $_GET['wr_etime'];	// 종료시간
			$wr_time_conference = $_GET['wr_time_conference'];	// 시간협의

			$wr_ability = $_GET['wr_ability'];	// 학력

			$wr_career_type = $_GET['wr_career_type'];	// 경력
			$wr_career = $_GET['wr_career'];	// 경력 조건 ( ~ 이하 )

			$wr_age = $_GET['wr_age'];	// 입력 나이
			$wr_age_limit = $_GET['wr_age_limit'];	// 나이 무관포함

			$wr_gender = $_GET['wr_gender'];	// 성별

			//echo preg_replace("/\//", "\/", trim(urldecode($search_keyword)))." <==<Br/>";	 // 다른 방식
			$search_keyword = urldecode(trim($search_keyword));	// 검색어

		}

		##
		# Variables
		// 옵션 정보
		$alba_option_logo = $service_control->service_check('alba_option_logo');	// 알바 로고 옵션
		$alba_option_logo_service = $service_control->__ServiceList($alba_option_logo['service']);	// 알바 로고 서비스 리스트
		$alba_option_logo_effects = explode("/",$alba_option_logo['effect']);	 // 효과

		$all_count = $alba_user_control->alba_count_image('all');
		$today_count = $alba_user_control->alba_count_image('today');

		/* default query
		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows: 15;
		$sorting = ($sort) ? "&sort=" . $sort . "&flag=" . $flag . "&" : "";
		$con = "";
		$alba_list = $alba_control->__AlbaList( $page, $page_rows, $con );
		$pages = $utility->get_paging($page_rows, $page, $alba_list['total_page'],"./?".$sorting."page_rows=".$page_rows."&".$alba_list['send_url']."&page=");
		*/

		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows: 15;

		$con = " and (`wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";


		// 플래티넘
		$platinum_rows = ($design['sub_platinum_total']) ? $design['sub_platinum_total'] : 15;
		$platinum_row = $design['sub_platinum_row'];	 // 플래티넘 가로 출력 갯수
		//  and `wr_report` = 0
		$platinum_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and `wr_service_platinum_sub` >= curdate() " . $con . " and `is_delete` = 0 ";
		$platinum_list = $alba_user_control->__AlbaList( 1, $platinum_rows, $platinum_con );
		//$platinum_top_arr = array( 3 => "105", 4 => "143");
		$platinum_list_total = $platinum_list['total_count'];
		// 가로출력수 - (총출력수 % 가로출력수) = 나머지
		$platinum_rest = ($sub_platinum_row - 1) - ($platinum_list_total % ($sub_platinum_row - 1));

		// 배너형
		$banner_rows = ($design['sub_banner_total']) ? $design['sub_banner_total'] : 15;
		//  and `wr_report` = 0
		$banner_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_service_banner_sub` >= curdate() ) " . $con . " and `is_delete` = 0 ";
		$banner_list = $alba_user_control->__AlbaList( 1, $banner_rows, $banner_con );
		$banner_list_total = $banner_list['total_count'];
		$banner_rest = ($sub_banner_row -1) - ($banner_list_total % ($sub_banner_row -1));

		// 리스트형
		$list_rows = ($design['sub_list_total']) ? $design['sub_list_total'] : 15;
		//  and `wr_report` = 0
		$list_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_service_list_sub` >= curdate() ) " . $con . " and `is_delete` = 0 ";
		$list_list = $alba_user_control->__AlbaList( 1, $list_rows, $list_con );
		$list_list_total = $list_list['total_count'];
		$list_row = 2;
		$list_rest = ($list_row-1) - ($list_list_total % $list_row);

		// 서브 일반 리스트
		//  and `wr_report` = 0
		$sub_list_con  = " where `wr_open` = 1 and `wr_is_adult` = 0 and `is_delete` = 0 ";
		$sub_list_con .= " and ( `wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";
		$service_check = $service_control->service_check('alba_basic');	// 채용공고 일반 리스트 사용시
		if($service_check['is_pay']){
			$sub_list_con .= " and ( `wr_service_basic_sub` >= curdate() ) ";
		}
		//$sub_list_con .= " and `wr_volume_date` <= curdate() and (  `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";
		$sub_list = $alba_user_control->__AlbaList( $page, 25, $sub_list_con );
		$total_page = $sub_list['total_page'];

		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./index.php?page_rows=".$page_rows."&".$list_list['send_url']."&page=");


		$employ_platinum_banner = $banner_control->get_banner_for_position("employ_platinum_top");	// 서브 플래티넘 채용정보 위 배너
		$employ_banner_banner = $banner_control->get_banner_for_position("employ_banner_top");	// 서브 배너형 채용정보 위 배너
		$employ_list_banner = $banner_control->get_banner_for_position("employ_list_top");	// 서브 리스트형 채용정보 위 배너
		$employ_basic_banner = $banner_control->get_banner_for_position("employ_basic_top");	// 서브 기본 채용정보 위 배너


		echo $config->_plugin( array('cycle','easing') );

		##
		# Include view
		if(is_file($alice['self'] . 'views/index.html'))
			include_once $alice['self'] . 'views/index.html';
		else
			$config->error_info( $alice['self'] . 'views/index.html' );


		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>