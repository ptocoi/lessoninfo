<?php
		/*
		* /application/individual/success.php
		* @author Harimao
		* @since 2013/11/01
		* @last update 2014/04/02
		* @Module v3.5 ( Alice )
		* @Brief :: Member individual alba service pay success
		* @Comment :: 개인회원 이력서 서비스 결제 완료 페이지
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "individual";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		if(!$oid){	// oid 가 없는 경우 튕겨냄
			$utility->popup_msg_js($service_control->_errors('0009'));
			exit;
		}

		$get_payment = $payment_control->get_payment_for_oid($oid);
		
		$pay_bank = explode("/",$get_payment['pay_bank']);

		$pay_method = $payment_control->pay_method[$get_payment['pay_method']];


		##
		# Include view
		if(is_file($alice['self'] . 'views/success.html'))
			include_once $alice['self'] . 'views/success.html';
		else
			$config->error_info( $alice['self'] . 'views/success.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>