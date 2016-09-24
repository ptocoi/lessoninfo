<?php
		/*
		* /application/individual/service.php
		* @author Harimao
		* @since 2013/08/14
		* @last update 2015/04/15
		* @Module v3.5 ( Alice )
		* @Brief :: Member individual service
		* @Comment :: 개인회원 서비스 정보
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "individual";

		$banner_atop_position = $page_name . "_top";
		$banner_top_position = $page_name . "_top_banner";
		$banner_left_position = $page_name . "_left";
		$banner_tail_position = $page_name . "_bottom";
		$banner_left_wing_position = $page_name . "_left_scroll";
		$banner_right_wing_position = $page_name . "_right_scroll";

		include_once $cat_path . "_engine.php";

		if(!$is_member){	// 회원이 아니라면
			$utility->popup_msg_js($user_control->_errors('0015'),"./register.php");
			exit;
		}

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Variables
		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows : 25;
		
		$con = " where `pay_uid` = '".$member['mb_id']."' and `pay_status` = '1' and `pay_pg` != 'admin' and `pay_method` != 'service' and `is_delete` = 0 ";
		$con .= " and `pay_package` = 0 ";
		$list = $payment_control->__PayList($page, $page_rows, $con);

		$total_page = $list['total_page'];
		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./service.php?page_rows=".$page_rows."&".$list['send_url']."&page=");

		$pay_sdate = $_GET['pay_sdate'];
		$pay_sdate_cnt = count($pay_sdate);
		$pay_edate = $_GET['pay_edate'];
		$pay_edate_cnt = count($pay_edate);

		$start_day = $pay_sdate[0] . "-" . $pay_sdate[1] . "-" . $pay_sdate[2];
		$end_day = $pay_edate[0] . "-" . $pay_edate[1] . "-" . $pay_edate[2];

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