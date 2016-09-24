<?php
		/*
		* /application/individual/index.php
		* @author Harimao
		* @since 2013/07/15
		* @last update 2015/03/10
		* @Module v3.5 ( Alice )
		* @Brief :: Member individual index
		* @Comment :: 개인회원 기본 페이지
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "individual";

		$banner_atop_position = $page_name . "_top";
		$banner_logo_position = $page_name . "_logo_banner";
		$banner_left_position = $page_name . "_left";
		$banner_tail_position = $page_name . "_bottom";
		$banner_left_wing_position = $page_name . "_left_scroll";
		$banner_right_wing_position = $page_name . "_right_scroll";

		include_once $cat_path . "_engine.php";

		##
		# Valid checking (_engine.php 에서도 하지만 보안상 여기서도 한다)
		if(!$is_member){
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?type=individual&url=".$urlencode);
			exit;
		}
		if($mb_type=='company'){	 // 기업회원 접근시
			$utility->popup_msg_js($user_control->_errors('0030'));
			exit;
		}

		##
		# Variables
		$mb_udate = substr($member['mb_udate'],0,11);	// 회원정보 수정일
		$con = " and `wr_use` = 1 ";
		$get_resume = $alba_individual_control->get_resume($member['mb_id'],$con);

		$scrap_count_list = $alba_user_control->scrap_list($member['mb_id']);
		$scrap_cnt = $scrap_count_list['total_count'];	// 스크랩 카운팅

		$con = " where `wr_type` = 'alba' and `wr_id` = '".$member['mb_id']."' ";
		$open_list = $alba_company_control->__OpenList( "", "", $con );		
		$open_cnt = $open_list['total_count'];	// 이력서 열람 카운팅
	
		$favorite_cnt = $alba_individual_control->sel_favorite_cnt( $member['mb_id'] );
		$denied_cnt = $alba_individual_control->sel_denied_cnt( $member['mb_id'] );

		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows : 5;

		$online_con = " where `type` = 'become_online' and `wr_id` = '".$member['mb_id']."' and `wr_to` != '0' and `is_cancel` = 0 and `is_delete` = 0 ";
		$online_list = $receive_control->__ReceiveList( $page, $page_rows, $online_con );

		$email_con = " where `type` = 'become_email' and `wr_id` = '".$member['mb_id']."' and `wr_to` != '0' and `is_cancel` = 0 and `is_delete` = 0 ";
		$email_list = $receive_control->__ReceiveList( $page, $page_rows, $email_con );

		$custom_titles = $alba_individual_control->custom_titles($member['mb_id']);	 // 맞춤채용 타이틀 뽑기
		if($custom_titles){
			$custom_con = " where `is_delete` = 0 ";
			$custom_list = $alba_individual_control->custom_list($page, $page_rows, $custom_con);
			$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_customized.php?page_rows=".$page_rows."&".$custom_list['send_url']."&page=");
		}

		$scrap_list = $alba_user_control->scrap_list($member['mb_id'], $page, $page_rows);

		##
		# Include view
		if(is_file($alice['self'] . 'views/index.html'))
			include_once $alice['self'] . 'views/index.html';
		else
			$config->error_info( $alice['self'] . 'views/index.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>