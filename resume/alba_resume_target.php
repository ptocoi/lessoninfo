<?php
		/*
		* /application/resume/alba_resume_target.php
		* @author Harimao
		* @since 2013/08/13
		* @last update 2013/08/13
		* @Module v3.5 ( Alice )
		* @Brief :: Alba Resume list
		* @Comment :: 알바 이력서 리스팅
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "resume";

		include_once $cat_path . "_engine.php";

		##
		# Variables

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_resume_target.html'))
			include_once $alice['self'] . 'views/alba_resume_target.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_resume_target.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>