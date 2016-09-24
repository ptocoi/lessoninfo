<?php
		/*
		* /application/member/register.php
		* @author Harimao
		* @since 2013/07/02
		* @last update 2015/05/13
		* @Module v3.5 ( Alice )
		* @Brief :: Member register
		* @Comment :: 회원가입 약관동의
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "member";

		$navi_page = "register_agreement";

		$navi_name = "약관동의 및 본인확인";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$virtualno = $_POST['virtualno'];
		if($virtualno){	// 아이핀에서 넘어온 경우
			$realname = $_POST['realname'];	// 아이핀에서 넘어온 이름
			$birthdate = $_POST['birthdate'];
			$birth_year = substr($birthdate,0,4);
			$birth_month = substr($birthdate,4,2);
			$birth_day = substr($birthdate,6,2);
			$sex = $_POST['sex'];
		}

		$site_agreement = stripslashes($env['site_agreement']);
		$site_privacy = stripslashes($env['site_privacy']);
		$use_ipin = $env['use_ipin'];
		$use_hphone = $env['use_hphone'];
		$register_form = $env['register_form'];
		if($is_member){	 // 이미 회원이라면
			$utility->popup_msg_js("",$alice['main_path']);
			exit;
		}

		if($_SESSION['adult_view'] && $_SESSION['certify_info']!=""){	// 성인인증 정보가 있다면 걍 continue
			$use_ipin = false;
			$use_hphone = false;
		}

		##
		# Include view
		if(is_file($alice['self'] . 'views/register.html'))
			include_once $alice['self'] . 'views/register.html';
		else
			$config->error_info( $alice['self'] . 'views/register.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>