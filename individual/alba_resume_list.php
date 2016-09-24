<?php
		/*
		* /application/individual/alba_resume_list.php
		* @author Harimao
		* @since 2013/07/16
		* @last update 2015/04/09
		* @Module v3.5 ( Alice )
		* @Brief :: Individual alba resume list
		* @Comment :: 개인회원 정규직 이력서 리스트
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

		$page_name = "individual";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows: 15;
		$con = " where `wr_id` = '".$member['mb_id']."' and `is_delete` = 0 ";
		$resume_list = $alba_individual_control->__ResumeList($page, $page_rows, $con);
		$total_page = $resume_list['total_page'];
		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_resume_list.php?page_rows=".$page_rows."&".$resume_list['send_url']."&page=");

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_resume_list.html'))
			include_once $alice['self'] . 'views/alba_resume_list.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_resume_list.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>