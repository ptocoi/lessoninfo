<?php
		/*
		* /application/member/password_form.php
		* @author Harimao
		* @since 2013/08/05
		* @last update 2015/04/06
		* @Module v3.5 ( Alice )
		* @Brief :: Member password update form
		* @Comment :: 회원 비밀번호 변경 폼
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "member";

		$banner_atop_position = "main_top";
		$banner_logo_position = "main_logo_banner";
		$banner_left_position = "main_left";
		$banner_tail_position = "main_bottom";
		$banner_left_wing_position = "main_left_scroll";
		$banner_right_wing_position = "main_right_scroll";

		$navi_page = "member_update";

		$navi_name = "마이페이지";

		include_once $cat_path . "_engine.php";

		if($mb_type=='individual'){
			$mypage_path = $alice['individual_path'];
		} elseif($mb_type=='company') {
			$mypage_path = $alice['company_path'];
		}

		if(!$is_member){	// 회원이 아니라면
			$utility->popup_msg_js($user_control->_errors('0015'),"./register.php");
			exit;
		}

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Variables

		##
		# Include view
		if(is_file($alice['self'] . 'views/password_form.html'))
			include_once $alice['self'] . 'views/password_form.html';
		else
			$config->error_info( $alice['self'] . 'views/password_form.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>