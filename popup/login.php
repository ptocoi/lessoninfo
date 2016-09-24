<?php
		/*
		* /application/popup/login.php
		* @author Harimao
		* @since 2013/08/27
		* @last update 2013/10/21
		* @Module v3.5 ( Alice )
		* @Brief :: Login pop
		* @Comment :: 로그인 팝업창
		*/
		
		$alice_path = "./";

		$cat_path = "./";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "popup";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$type = $_GET['type'];
		$etc_pop_login_banner = $banner_control->get_banner_for_position('etc_pop_login');	// 로그인 배너

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('placeholder'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/login.html'))
			include_once $alice['self'] . 'views/login.html';
		else
			$config->error_info( $alice['self'] . 'views/login.html' );

		$config_control->_tail(true);	// tail;

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>