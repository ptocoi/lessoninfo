<?php
		/*
		* /application/alba/alba_list_target.php
		* @author Harimao
		* @since 2013/08/12
		* @last update 2015/03/17
		* @Module v3.5 ( Alice )
		* @Brief :: Alba list
		* @Comment :: 대상별 정규직 리스팅
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

		$search_mode = "alba_target";

		##
		# Search
		$mode = $_GET['mode'];
		$type = $_GET['type'];	// list_term type
		if($mode=='search'){	 // 정규직 검색

			/*
			echo "<xmp>";
			print_r($_GET);
			echo "</xmp>";
			*/

			$wr_target = $_GET['wr_target'];	// 대상별 지원조건

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
		$view_type = $_GET['view_type'];	// 리스팅 타입
		$sort = $_GET['sort'];
		$flag = $_GET['flag'];
		$pay_level = $category_control->pay_level;

		$navi_name = $category_control->get_categoryCodeName($type);

		// 일반 리스트
		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows : 20;
		$sorting = ($sort) ? "&sort=" . $sort . "&flag=" . $flag . "&" : "";
		
		//  and `wr_report` = 0
		$list_con .= " where `wr_open` = 1 and `wr_is_adult` = 0 and `is_delete` = 0 ";
		if($type) $list_con .= " and INSTR(`wr_target`, '".$type."') ";
		$service_check = $service_control->service_check('alba_basic');	// 채용공고 일반 리스트 사용시
		if($service_check['is_pay']){
			$list_con .= " and ( `wr_service_basic` >= curdate() ) ";
		}
		$list_list = $alba_user_control->__AlbaList( $page, $page_rows, $list_con );
		$total_page = $list_list['total_page'];
		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_list_target.php?page_rows=".$page_rows."&".$list_list['send_url']."&page=");

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_list_target.html'))
			include_once $alice['self'] . 'views/alba_list_target.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_list_target.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>