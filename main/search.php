<?php
		/*
		* /application/main/search.php
		* @author Harimao
		* @since 2013/07/02
		* @last update 2014/07/07
		* @Module v3.5 ( Alice )
		* @Brief :: Main search
		* @Comment :: 검색 결과를 보여준다.
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "search";

		$banner_atop_position = $page_name . "_top";
		$banner_logo_position = $page_name . "_logo_banner";
		$banner_top_position = $page_name . "_top_banner";
		$banner_middle_position = $page_name . "_middle_banner";
		$banner_left_position = $page_name . "_left";
		$banner_tail_position = $page_name . "_bottom";
		$banner_left_wing_position = $page_name . "_left_scroll";
		$banner_right_wing_position = $page_name . "_right_scroll";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$search_middle_banner = $banner_control->get_banner_for_position($banner_middle_position);	// 검색 중간 배너

		$search_keyword = $_GET['search_keyword'];
		$search_keyword = preg_replace("/\//", "\/", trim(urldecode($search_keyword)));	 // 다른 방식
		$search_keyword = urldecode(trim($search_keyword));	// 검색어

		$page = ($page) ? $page : 1;
		$page_rows = ($type) ? 15 : 5;

		if($mode=='search'){

			// 지역
			$wr_area_0 = $_GET['wr_area_0'];	// 1차 지역 배열
			$wr_area_1 = $_GET['wr_area_1'];	// 2차 지역 배열		
			$wr_area_2 = $_GET['wr_area_2'];	// 3차 지역 배열

			$area_sels = $_GET['area_sels'];	// 지역 검색 값

			$search = $search_control->__Searching( $page, $page_rows );

			$alba_search = $search['alba_search'];
			$alba_total_count = $search_control->total_counting('alba');

			$alba_resume_search = $search['alba_resume_search'];
			$alba_resume_total_count = $search_control->total_counting('alba_resume');

			$board_search = $search['board_search'];
			$board_total_count = $search_control->total_counting('board');

			/*
			echo "<pre>";
			//print_R($_GET);
			print_R($board_search);
			echo "</pre>";
			*/

			$stx = preg_replace("/\//", "\/", trim($search_keyword));
			$text_stx = $utility->get_text(stripslashes($stx));
			$search_control->search_result($text_stx, "realtime");	// 검색 결과 저장
		}

		##
		# Include view
		if(is_file($alice['self'] . 'views/search.html'))
			include_once $alice['self'] . 'views/search.html';
		else
			$config->error_info( $alice['self'] . 'views/search.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>