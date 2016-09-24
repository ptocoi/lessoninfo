<?php
		/*
		* /application/company/manager_info.php
		* @author Harimao
		* @since 2013/08/14
		* @last update 2015/04/13
		* @Module v3.5 ( Alice )
		* @Brief :: Company manager info
		* @Comment :: 기업회원 담당자 관리
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "company";

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
		$tel_num_option = $config->get_tel_num();	 // 전화번호 국번
		$hp_num_option = $config->get_hp_num();	 // 휴대폰번호 국번
		$fax_num_option = $config->get_tel_num();	 // 전화번호 국번
		$email_option = $config->get_email();	 // 이메일 서비스 제공자

		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows: 15;
		$con = " where `wr_id` = '".$member['mb_id']."' ";
		$list = $company_manager_control->__ManagerList($page,$page_rows,$con);
		$total_page = $list['total_page'];
		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./manager_info.php?page_rows=".$page_rows."&".$list['send_url']."&page=");

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/manager_info.html'))
			include_once $alice['self'] . 'views/manager_info.html';
		else
			$config->error_info( $alice['self'] . 'views/manager_info.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>