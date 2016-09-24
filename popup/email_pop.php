<?php
		/*
		* /application/popup/find_id.php
		* @author Harimao
		* @since 2015/07/28
		* @last update 2015/07/28
		* @Module v3.5 ( Alice )
		* @Brief :: 
		* @Comment :: 이메일 수신거부 팝업창
		*/
		
		$alice_path = "./";

		$cat_path = "./";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "popup";

		include_once $cat_path . "_engine.php";

		
		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('placeholder'));

		$sending_email = $_GET['email'];		

		##
		# Include view
		if(is_file($alice['self'] . 'views/email_pop.html'))
			include_once $alice['self'] . 'views/email_pop.html';
		else
			$config->error_info( $alice['self'] . 'views/email_pop.html' );

		$config_control->_tail(true);	// tail;

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>