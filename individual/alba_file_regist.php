<?php
		/*
		* /application/individual/alba_file_regist.php
		* @author Harimao
		* @since 2015/01/13
		* @last update 2015/01/13
		* @Module v3.5 ( Alice )
		* @Brief :: Individual alba resume file form
		* @Comment :: 개인회원 정규직 이력서 파일 등록/수정 폼
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

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Call Editor
		//echo "<script src='".$alice['editor_path']."/cheditor/cheditor.js'></script>";
		//echo $utility->call_cheditor("wr_introduce", '100%', '580px');

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_file_regist.html'))
			include_once $alice['self'] . 'views/alba_file_regist.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_file_regist.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>