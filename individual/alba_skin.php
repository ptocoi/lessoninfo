<?php
		/*
		* /application/individual/alba_resume_onlines.php
		* @author Harimao
		* @since 2013/08/13
		* @last update 2014/07/08
		* @Module v3.5 ( Alice )
		* @Brief :: Individual alba resume online / email list
		* @Comment :: 개인회원 정규직 이력서 리스트
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
		$type = ($_GET['type']) ? $_GET['type'] : "become_online";

		$mode = $_GET['mode'];
		if($mode=='search'){

			if($type=='become_online'){
				
			} else if($type=='become_email'){

			}

			$search_keyword = urldecode( trim($_GET['search_keyword']) );	 // 검색 키워드

		}

		$_con = " and `is_cancel` = 0 and `is_delete` = 0 ";
		$con = " where `type` = '".$type."' and `wr_id` = '".$member['mb_id']."' and `wr_to` != '0' " . $_con;

		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows : 15;

		$list = $receive_control->__ReceiveList( $page, $page_rows, $con );		

		$online_cnt = $receive_control->__ReceiveList( "", "", " where `type` = 'become_online' and `wr_id` = '".$member['mb_id']."' and `wr_to`!= '0' " . $_con );
		$email_cnt = $receive_control->__ReceiveList( "", "", " where `type` = 'become_email' and `wr_id` = '".$member['mb_id']."' and `wr_to`!= '0' " . $_con );

		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_resume_onlines.php?page_rows=".$page_rows."&".$list['send_url']."&page=");

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_resume_onlines.html'))
			include_once $alice['self'] . 'views/alba_resume_onlines.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_resume_onlines.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>