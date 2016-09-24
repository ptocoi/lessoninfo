<?php
		/*
		* /application/individual/tax.php
		* @author Harimao
		* @since 2013/08/14
		* @last update 2014/08/07
		* @Module v3.5 ( Alice )
		* @Brief :: Individual member tax
		* @Comment :: 개인회원 세금계산서
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
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Variables


		##
		# Include view
		if(is_file($alice['self'] . 'views/tax.html'))
			include_once $alice['self'] . 'views/tax.html';
		else
			$config->error_info( $alice['self'] . 'views/tax.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>