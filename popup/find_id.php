<?php
		/*
		* /application/popup/find_id.php
		* @author Harimao
		* @since 2014/04/07
		* @last update 2013/04/07
		* @Module v3.5 ( Alice )
		* @Brief :: Find id pop
		* @Comment :: 아이디찾기 팝업창
		*/
		
		$alice_path = "./";

		$cat_path = "./";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "popup";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$member_info = $db->query_fetch(" select * from `alice_member` where `mb_id` = '".$mb_id."' ");

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('placeholder'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/find_id.html'))
			include_once $alice['self'] . 'views/find_id.html';
		else
			$config->error_info( $alice['self'] . 'views/find_id.html' );

		$config_control->_tail(true);	// tail;

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>