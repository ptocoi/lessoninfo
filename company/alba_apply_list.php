<?php
		/*
		* /application/company/alba_apply_list.php
		* @author Harimao
		* @since 2013/08/01
		* @last update 2014/07/08
		* @Module v3.5 ( Alice )
		* @Brief :: Company alba apply list
		* @Comment :: 기업회원 알바 지원자 리스트
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
		$page_rows = ($page_rows) ? $page_rows: 15;
		$sel_alba = $_GET['sel_alba'];

		/*
		$list = $alba_user_control->__AlbaList( $page, $page_rows, $con );
		$total_page = $list['total_page'];
		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_apply_list.php?page_rows=".$page_rows."&".$list['send_url']."&page=");
		*/
		
		$_con = " and `is_delete` = 0 ";

		if($type=='finish'){
			$con = " where `wr_id` = '".$member['mb_id']."' and ( `wr_volume_always` = '0' and `wr_volume_end` = '0' and `wr_volume_date` < curdate() ) order by `no` desc ";
		} else {
			$con = " where `wr_id` = '".$member['mb_id']."' and ( `wr_volume_always` = '1' or `wr_volume_end` = '1' or `wr_volume_date` >= curdate() ) order by `no` desc ";
		}
		$select_list = $alba_company_control->alba_list($con);
		
		$con  = " where `wr_to_id` = '".$member['mb_id']."' ";
		if($sel_alba) $con .= " and `wr_to` = '".$sel_alba."' ";
		$con .= " and `is_delete` = 0 ";
		$list = $receive_control->__ReceiveList( $page, $page_rows, $con );

		$where_que = " where `wr_id` = '".$member['mb_id']."' ";
		$continue_cnt = 0;
		$end_cnt = 0;
		foreach($list['result'] as $val){
			$continue_cnt += $alba_company_control->alba_list_count($where_que . " and `no` = '".$val['wr_to']."' and ( `wr_volume_always` = '1' or `wr_volume_end` = '1' or `wr_volume_date` >= curdate() ) ");	// 진행중인 공고 카운팅
			$end_cnt += $alba_company_control->alba_list_count($where_que . " and `no` = '".$val['wr_to']."' and ( `wr_volume_always` = '0' and `wr_volume_end` = '0' and `wr_volume_date` < curdate() ) ");	 // 종료된 공고 카운팅
		}

		$type_msg = ($type=='finish') ? "마감된" : "진행중인";

		if($sel_alba) 
			$receive_con = " where `wr_to` = '".$sel_alba."' " . $_con;
		else 
			$receive_con = " where `is_delete` = 0 ";

		$receive_list = $receive_control->__ReceiveList( $page, $page_rows, $receive_con );

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_apply_list.html'))
			include_once $alice['self'] . 'views/alba_apply_list.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_apply_list.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>