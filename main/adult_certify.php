<?php
		/*
		* /application/main/adult_certify.php
		* @author Harimao
		* @since 2013/10/23
		* @last update 2015/04/08
		* @Module v3.5 ( Alice )
		* @Brief :: Adult certify
		* @Comment :: 성인인증 페이지
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "adult";

		include_once $alice_path . "_core.php";

		if($is_member){	// 회원일때
			if($member['is_adult']){	// 성인이라면
				header("Location: /");
			}
		} else {	 // 비회원
			if($_SESSION['adult_view']){	// 성인인증 세션이 있다면
				header("Location: /");
			}
		}

		##
		# Header
		# 필요에 의한 style, jQuery plugin 추가가 가능합니다.
		# 아래는 예시 입니다.
		$style_arr = array( 'index' );
		$plugin_arr = array( 'scrollfollow' );
		echo $config->_user_header( '', $style_arr, '', $plugin_arr);		// body, css style, css media, jQuery plugin

		##
		# Variables
		$use_ipin = $env['use_ipin'];
		$use_hphone = $env['use_hphone'];


		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('placeholder'));


		##
		# Include view
		if(is_file($alice['self'] . 'views/adult_certify.html'))
			include_once $alice['self'] . 'views/adult_certify.html';
		else
			$config->error_info( $alice['self'] . 'views/adult_certify.html' );

		$config_control->alice_visit_page($page_name);	 // 페이지별 방문자
		echo $config_control->_tail(true); 

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>