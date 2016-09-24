<?php
		/*
		* /application/company/local_info.php
		* @author Harimao
		* @since 2013/08/14
		* @last update 2013/08/14
		* @Module v3.5 ( Alice )
		* @Brief :: Company member local info
		* @Comment :: 기업회원 근무처 관리
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "company";

		include_once $cat_path . "_engine.php";

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Variables

		##
		# Include view
		if(is_file($alice['self'] . 'views/local_info.html'))
			include_once $alice['self'] . 'views/local_info.html';
		else
			$config->error_info( $alice['self'] . 'views/local_info.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>