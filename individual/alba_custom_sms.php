<?php
		/*
		* /application/individual/alba_custom_sms.php
		* @author Harimao
		* @since 2013/08/13
		* @last update 2013/08/13
		* @Module v3.5 ( Alice )
		* @Brief :: Member individual alba sms
		* @Comment :: 개인회원 맞춤 정규직 정보
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "individual";

		include_once $cat_path . "_engine.php";

		##
		# Variables

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_custom_sms.html'))
			include_once $alice['self'] . 'views/alba_custom_sms.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_custom_sms.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>