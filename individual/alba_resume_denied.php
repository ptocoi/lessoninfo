<?php
		/*
		* /application/individual/alba_resume_denied.php
		* @author Harimao
		* @since 2013/07/26
		* @last update 2014/07/08
		* @Module v3.5 ( Alice )
		* @Brief :: Member individual alba resume open
		* @Comment :: 개인회원 정규직 내 이력서 제한기업
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
		$mode = $_GET['mode'];
		if($mode=='search'){

			$mb_company_name = urldecode( trim($_GET['mb_company_name']) );	 // 회사명

			$mb_biz_type = $_GET['mb_biz_type'];	// 업종

		}

		$biz_type_option = $config->get_biz_type($mb_biz_type);	// 업종

		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows : 15;
		if($type){
			if($mode=='search')
				$con = " and `mb_left` = 0 ";
			else 
				$con = " where `mb_left` = 0 ";
			$list = $alba_individual_control->denied_company_search( $page, $page_rows, $con );
			$total_page = $list['total_page'];
			$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_resume_denied.php?type=".$type."&page_rows=".$page_rows."&".$list['send_url']."&page=");
		} else {
			$con = " where `wr_id` = '".$member['mb_id']."' ";
			$list = $alba_individual_control->get_denied_list( $page, $page_rows, $con );
			$total_page = $list['total_page'];
			$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_resume_denied.php?page_rows=".$page_rows."&".$list['send_url']."&page=");
		}

		$denied_cnt = $alba_individual_control->sel_denied_cnt( $member['mb_id'] );

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_resume_denied.html'))
			include_once $alice['self'] . 'views/alba_resume_denied.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_resume_denied.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>