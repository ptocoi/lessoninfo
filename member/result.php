<?php
		/*
		* /application/member/register_form.php
		* @author Harimao
		* @since 2013/07/02
		* @last update 2013/10/23
		* @Module v3.5 ( Alice )
		* @Brief :: Member register form
		* @Comment :: 회원가입 폼
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "member";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		/*
		echo "<pre>";
		print_R($_SESSION);
		echo "</pre>";
		 * 
		*/
		
		if($member['mb_type']=='individual'){
			$welcome_msg = $env['site_name']."에 선생님 회원으로 가입하심을 환영합니다. 이제부터 ".$env['site_name']."에 모든 서비스를 이용하실 수 있으며 
			<br>특별히, 이력서를 등록하고 싶은 선생님은 해당되는 버튼을 클릭하여 이력서를 등록 바랍니다.
			<br>(이력서 등록은 전혀 비용이 들지않는 완전무료 입니다.)";
		}elseif($member['mb_type']=='student'){
			$welcome_msg = $env['site_name']."와 함께 행복한 취업 활동 하세요.";
		}else{
			$welcome_msg = $env['site_name']."와 함께 행복한 취업 활동 하세요.";
		}

		##
		# Include view
		if(is_file($alice['self'] . 'views/result.html'))
			include_once $alice['self'] . 'views/result.html';
		else
			$config->error_info( $alice['self'] . 'views/result.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>