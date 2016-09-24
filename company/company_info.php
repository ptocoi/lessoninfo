<?php
		/*
		* /application/company/company_info.php
		* @author Harimao
		* @since 2014/08/08
		* @last update 2015/04/20
		* @Module v3.5 ( Alice )
		* @Brief :: Company info
		* @Comment :: 기업회원 기업 관리
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
		$page = ($page) ? $page : 1;
		$page_rows = 15;
		$con = " where `mb_id` = '".$member['mb_id']."' ";
		$list = $member_control->__CompanyList($page,$page_rows,$con);
		$total_page = $list['total_page'];
		$pages = $utility->get_paging($page_rows, $page, $list['total_page'],"./company_info.php?page_rows=".$page_rows."&page=");

		##
		# Plugin, UI, CSS include
		//echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/company_info.html'))
			include_once $alice['self'] . 'views/company_info.html';
		else
			$config->error_info( $alice['self'] . 'views/company_info.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>