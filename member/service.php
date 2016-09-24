<?php
		/*
		* /application/member/service.php
		* @author Harimao
		* @since 2013/08/14
		* @last update 2013/08/14
		* @Module v3.5 ( Alice )
		* @Brief :: Member individual service
		* @Comment :: 개인회원 서비스 정보
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "individual";

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
		if(is_file($alice['self'] . 'views/service.html'))
			include_once $alice['self'] . 'views/service.html';
		else
			$config->error_info( $alice['self'] . 'views/service.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>