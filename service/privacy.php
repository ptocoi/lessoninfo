<?php
		/*
		* /application/service/privacy.php
		* @author Harimao
		* @since 2013/10/01
		* @last update 2014/07/08
		* @Module v3.5 ( Alice )
		* @Brief :: Privacy info
		* @Comment :: 개인정보취급방침을 출력한다.
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "service";

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
		/*
		$wr_type = "on2on";
		$cs_category = $category_control->__CategoryList($wr_type);	// 고객센터 분류

		$hphone_num = explode('-',$member['mb_hphone']);
		$hp_num_option = $config->get_hp_num($hphone_num[0]);	 // 휴대폰번호 국번
		
		$phone_num = explode('-',$member['mb_phone']);
		$tel_num_option = $config->get_tel_num($phone_num[0]);	 // 전화번호 국번

		$mb_email = explode('@',$member['mb_email']);
		$email_option = $config->get_email();	 // 이메일 서비스 제공자
		*/

		##
		# Include view
		if(is_file($alice['self'] . 'views/privacy.html'))
			include_once $alice['self'] . 'views/privacy.html';
		else
			$config->error_info( $alice['self'] . 'views/privacy.html' );


		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>