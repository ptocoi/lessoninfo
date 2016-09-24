<?php
		/*
		* /application/company/open_sms.php
		* @author Harimao
		* @since 2015/04/08
		* @last update 2015/04/09
		* @Module v3.5 ( Alice )
		* @Brief :: Individual sms open service
		* @Comment :: 개인회원 SMS 충전 서비스 (독립)
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "company";

		$banner_atop_position = $page_name . "_top";
		$banner_logo_position = $page_name . "_logo_banner";
		$banner_top_position = $page_name . "_top_banner";
		$banner_left_position = $page_name . "_left";
		$banner_tail_position = $page_name . "_bottom";
		$banner_left_wing_position = $page_name . "_left_scroll";
		$banner_right_wing_position = $page_name . "_right_scroll";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$etc_sms = $service_control->service_check('etc_sms');	// SMS 충전
		$etc_sms_service = $service_control->__ServiceList($etc_sms['service']);	// SMS 서비스 리스트

		/*
		echo "<pre>";
		print_R($etc_sms);
		print_r($etc_sms_service);
		echo "</pre>";
		*/

		##
		# Include view
		if(is_file($alice['self'] . 'views/open_sms.html'))
			include_once $alice['self'] . 'views/open_sms.html';
		else
			$config->error_info( $alice['self'] . 'views/open_sms.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>