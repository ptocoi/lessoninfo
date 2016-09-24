<?php
		/*
		* /application/individual/photo.php
		* @author Harimao
		* @since 2013/07/22
		* @last update 2014/07/08
		* @Module v3.5 ( Alice )
		* @Brief :: Member individual photo
		* @Comment :: 개인회원 사진관리
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
		# Variables
		$photo_0 = $user_control->get_member_photo($member['mb_id'], 0);
		$photo_0_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_0;
		$photo_0 = (is_file($photo_0_file)) ? $photo_0_file : "../images/comn/no_profileimg.gif";

		$photo_1 = $user_control->get_member_photo($member['mb_id'], 1);
		$photo_1_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_1;
		$photo_1 = (is_file($photo_1_file)) ? $photo_1_file : "../images/comn/no_profileimg.gif";

		$photo_2 = $user_control->get_member_photo($member['mb_id'], 2);
		$photo_2_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_2;
		$photo_2 = (is_file($photo_2_file)) ? $photo_2_file : "../images/comn/no_profileimg.gif";

		$photo_3 = $user_control->get_member_photo($member['mb_id'], 3);
		$photo_3_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_3;
		$photo_3 = (is_file($photo_3_file)) ? $photo_3_file : "../images/comn/no_profileimg.gif";

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/photo.html'))
			include_once $alice['self'] . 'views/photo.html';
		else
			$config->error_info( $alice['self'] . 'views/photo.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>