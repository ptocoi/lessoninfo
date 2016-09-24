<?php
		/*
		* /application/member/find_id.php
		* @author Harimao
		* @since 2013/07/10
		* @last update 2013/12/04
		* @Module v3.5 ( Alice )
		* @Brief :: Member find id
		* @Comment :: 회원 아이디 찾기
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "member";

		include_once $cat_path . "_engine.php";


		##
		# Variables
		$use_ipin = $env['use_ipin'];	// ipin 사용 유무
		$ipin_id = $env['ipin_id'];
		$ipin_pw = $env['ipin_pw'];

		$use_hphone = $env['use_hphone'];	// 문자인증 사용 유무
		$hphone_id = $env['hphone_id'];

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('placeholder'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/find_id.html'))
			include_once $alice['self'] . 'views/find_id.html';
		else
			$config->error_info( $alice['self'] . 'views/find_id.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>