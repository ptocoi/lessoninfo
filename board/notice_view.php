<?php
		/*
		* /application/board/notice_view.php
		* @author Harimao
		* @since 2013/08/19
		* @last update 2015/07/20
		* @Module v3.5 ( Alice )
		* @Brief :: Notice view
		* @Comment :: 공지사항 보기
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "board";

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
		$left_notice_list = $notice_control->get_notice_list_count(5);	 // 좌측 공지
		$board_categories = $category_control->get_categoryCode($board_code);	// 게시판 그룹 코드에 따른 최상위 그룹

		$menu_name = $utility->remove_quoted($board_categories['name']);	// 최상위 메뉴명

		$left_list = $category_control->pcode_List($board_code);
		$left_list_cnt = count($left_list);
		$boCode_list = $board_control->boCode_list($board_code);
		$boCode_list_cnt = count($boCode_list);

		if($left_list_cnt){	// 2차 메뉴 소속 게시판
			$best_bo_table = array();	// best of best
			$list_bo_table = array();	 // 게시판 메인 리스트
			foreach($left_list as $_code){
				$board_list = $board_control->boCode_list($_code['code']);
				foreach($board_list as $_board){
					array_push($best_bo_table, "'".$_board['bo_table']."'");
					array_push($list_bo_table, $_board['bo_table']);
				}
			}
		} else if($boCode_list_cnt){	// 1차 메뉴 소속 게시판
			$best_bo_table = array();	// best of best
			$list_bo_table = array();	 // 게시판 메인 리스트
			foreach($boCode_list as $_board){
				array_push($best_bo_table, "'".$_board['bo_table']."'");
				array_push($list_bo_table, $_board['bo_table']);
			}
		}

		$notice = $notice_control->get_notice($no);
		$notice_cate = $category_control->get_categoryCodeName($notice['wr_type']);
		$wr_type = ($notice_cate) ? "[".$notice_cate."] " : "";
		$notice_control->hitup_notice($no);

		$wr_file = unserialize($notice['wr_file']);
		$wr_file_cnt = count($wr_file);

		##
		# Include view
		if(is_file($alice['self'] . 'views/notice_view.html'))
			include_once $alice['self'] . 'views/notice_view.html';
		else
			$config->error_info( $alice['self'] . 'views/notice_view.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>