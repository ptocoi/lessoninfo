<?php
		/*
		* /application/member/login.php
		* @author Harimao
		* @since 2013/07/02
		* @last update 2014/07/08
		* @Module v3.5 ( Alice )
		* @Brief :: Member login
		* @Comment :: 회원 로그인 페이지
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "member";

		$banner_atop_position = "main_top";
		$banner_logo_position = "main_logo_banner";
		$banner_left_position = "main_left";
		$banner_tail_position = "main_bottom";
		$banner_left_wing_position = "main_left_scroll";
		$banner_right_wing_position = "main_right_scroll";

		$navi_page = "login";

		$navi_name = "회원로그인";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$etc_login_banner = $banner_control->get_banner_for_position('etc_login');	// 로그인 배너
		if($is_demo){
			if($type=='individual' || !$type){
				$login_id = $login_password = "test_individual";
			} else if($type=='company'){
				$login_id = $login_password = "test_company";
			}
		} else {
			$login_id = $login_password = "";
		}

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('placeholder'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/login.html'))
			include_once $alice['self'] . 'views/login.html';
		else
			$config->error_info( $alice['self'] . 'views/login.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>