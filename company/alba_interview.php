<?php
		/*
		* /application/company/alba_interview.php
		* @author Harimao
		* @since 2013/10/14
		* @last update 2014/07/08
		* @Module v3.5 ( Alice )
		* @Brief :: Company alba interview list
		* @Comment :: 기업회원 면접제의 리스트
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
		$type = ($_GET['type']) ? $_GET['type'] : "interview";

		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows : 15;
		if($type=='interview'){	// 면접제의
			$con = " where `wr_type` = 'interview' ";
		} else if($type=='become'){	// 입사지원
			$con = " where `wr_type` = 'become' ";
		}

		$con .= " and `mb_id` = '".$member['mb_id']."' ";

		$list = $alba_company_control->proposal_list( $page, $page_rows, $con );
		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_resume_denied.php?page_rows=".$page_rows."&".$list['send_url']."&page=");

		$interview_count = $alba_company_control->proposal_counts('interview', $member['mb_id']);
		$become_count = $alba_company_control->proposal_counts('become', $member['mb_id']);

		$service_open = $utility->valid_day($member_service['mb_service_open']);	// 열람 서비스

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_interview.html'))
			include_once $alice['self'] . 'views/alba_interview.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_interview.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close


?>