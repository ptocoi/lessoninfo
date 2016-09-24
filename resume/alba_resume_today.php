<?php
		/*
		* /application/resume/alba_resume_today.php
		* @author Harimao
		* @since 2013/10/07
		* @last update 2013/10/07
		* @Module v3.5 ( Alice )
		* @Brief :: Alba Resume today list
		* @Comment :: 오늘 등록 인재 정보 리스트
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "resume";

		include_once $cat_path . "_engine.php";

		##
		# Variables

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_resume_today.html'))
			include_once $alice['self'] . 'views/alba_resume_today.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_resume_today.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>