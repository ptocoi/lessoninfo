<?php
		/*
		* /application/individual/file.php
		* @author Harimao
		* @since 2014/01/12
		* @last update 2014/01/13
		* @Module v3.5 ( Alice )
		* @Brief :: Member individual file
		* @Comment :: 개인회원 파일관리
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
		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows: 15;
		$con = " where `wr_id` = '".$member['mb_id']."' ";
		$list = $alba_file_control->__FileList($page, $page_rows, $con);
		$total_page = $list['total_page'];
		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./file.php?page_rows=".$page_rows."&".$list['send_url']."&page=");

		
		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/file.html'))
			include_once $alice['self'] . 'views/file.html';
		else
			$config->error_info( $alice['self'] . 'views/file.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>