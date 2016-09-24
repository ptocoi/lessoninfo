<?php
		/*
		* /application/popup/print_alba_resume.php
		* @author Harimao
		* @since 2013/07/26
		* @last update 2013/07/26
		* @Module v3.5 ( Alice )
		* @Brief :: Alba resume print popup
		* @Comment :: 정규직 이력서 팝업창
		*/
		
		$alice_path = "./";

		$cat_path = "./";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "popup";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$no = $_GET['no'];
		if(!$no || $no==''){
			$utility->popup_msg_close($alba_individual_control->_errors('0004'));
			exit;
		}
		$get_resume = $alba_individual_control->get_resume_no($no);	// 이력서 정보
		if(!$get_resume){
			$utility->popup_msg_close($alba_individual_control->_errors('0008'));
			exit;
		}

		##
		# Include view
		if(is_file($alice['self'] . 'views/email_alba_resume.html'))
			include_once $alice['self'] . 'views/email_alba_resume.html';
		else
			$config->error_info( $alice['self'] . 'views/email_alba_resume.html' );

		$config_control->_tail(true);	// tail;

		// Debugging check
		/*
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}
		*/

		$db->close();		// DB Close

?>