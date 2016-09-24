<?php
		/*
		* /application/company/alba_list.php
		* @author Harimao
		* @since 2013/07/31
		* @last update 2015/04/09
		* @Module v3.5 ( Alice )
		* @Brief :: Company alba list
		* @Comment :: 기업회원 알바 리스트
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "company";

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
		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows: 15;
		$where_que = " where `wr_id` = '".$member['mb_id']."' and `is_delete` = 0 ";
		$con  = $where_que;
		if($type=='finish'){
			$con .= "and ( `wr_volume_always` = '0' and `wr_volume_end` = '0' and `wr_volume_date` < curdate() ) ";
		} else {
			$con .= "and ( `wr_volume_always` = '1' or `wr_volume_end` = '1' or `wr_volume_date` >= curdate() ) ";
		}
		// listing
		$alba_list = $alba_company_control->__AlbaList($page, $page_rows, $con);
		$total_page = $alba_list['total_page'];
		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_list.php?page_rows=".$page_rows."&".$resume_list['send_url']."&page=");

		$continue_cnt = $alba_company_control->alba_list_count($where_que . " and ( `wr_volume_always` = '1' or `wr_volume_end` = '1' or `wr_volume_date` >= curdate() ) ");	// 진행중인 공고 카운팅
		$end_cnt = $alba_company_control->alba_list_count($where_que . " and ( `wr_volume_always` = '0' and `wr_volume_end` = '0' and `wr_volume_date` < curdate() ) ");	 // 종료된 공고 카운팅

		// query string
		$qstr = "";
		$is_get = ($type=='finish') ? "?" : "&";


		if(isset($mode)){
			$qstr .= $is_get . "mode=" . urlencode($mode);
		}
		if(isset($search_field)){
			$qstr .= "&search_field=" . urlencode($search_field);
		}
		if(isset($search_keyword)){
			$qstr .= "&search_keyword=" . urlencode($search_keyword);
		}

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_list.html'))
			include_once $alice['self'] . 'views/alba_list.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_list.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>