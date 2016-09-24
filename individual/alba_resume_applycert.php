<?php
		/*
		* /application/individual/alba_resume_applycert.php
		* @author Harimao
		* @since 2013/07/26
		* @last update 2014/07/08
		* @Module v3.5 ( Alice )
		* @Brief :: Member individual alba applycert
		* @Comment :: 개인회원 정규직 취업활동 증명서
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
		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows : 20;
		$con = " where `wr_id` = '".$member['mb_id']."' and `wr_to` != 0 and `etc_4` != '' and `is_cancel` = 0 and `is_delete` = 0 ";
		$list = $receive_control->__ReceiveList($page, $page_rows, $con);
		$total_page = $list['total_page'];
		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_resume_applycert.php?page_rows=".$page_rows."&".$list['send_url']."&page=");

		$pay_sdate = $_GET['pay_sdate'];
		$pay_sdate_cnt = count($pay_sdate);
		$pay_edate = $_GET['pay_edate'];
		$pay_edate_cnt = count($pay_edate);

		$start_day = $pay_sdate[0] . "-" . $pay_sdate[1] . "-" . $pay_sdate[2];
		$end_day = $pay_edate[0] . "-" . $pay_edate[1] . "-" . $pay_edate[2];

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_resume_applycert.html'))
			include_once $alice['self'] . 'views/alba_resume_applycert.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_resume_applycert.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>