<?php
		/*
		* /application/send/memo_read.php
		* @author Harimao
		* @since 2015/03/16
		* @last update 2015/04/10
		* @Module v3.5 ( Alice )
		* @Brief :: Message read
		* @Comment :: 쪽지
		*/
		
		$alice_path = "./";

		$cat_path = "./";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "memo";

		include_once $cat_path . "_engine.php";

		##
		# Valid checking (_engine.php 에서도 하지만 보안상 여기서도 한다)
		if(!$is_member){
			$utility->popup_msg_close($user_control->_errors('0015'),$alice['member_path']."/login.php");
			exit;
		}

		##
		# Variables
		$kind = $_GET['kind'];
		$page = ($page) ? $page : 1;
		$page_rows = 8;

		// 받은쪽지 
		$receive_memo = $memo_control->__MemoList($page,$page_rows,"receve"," where a.wr_recv_mb_id = '".$member['mb_id']."' and `wr_is_delete` = 0 ");
		
		// 미확인쪽지
		$viewed_memo = $memo_control->__MemoList($page,$page_rows,"viewed"," where `wr_recv_mb_id` = '".$member['mb_id']."' and `wr_read_datetime` = '0000-00-00 00:00:00' and `wr_is_delete` = 0 ");

		// 보낸쪽지
		$send_memo = $memo_control->__MemoList($page,$page_rows,"send"," where a.wr_send_mb_id = '".$member['mb_id']."' and `wr_is_delete` = 0 ");

		// 쪽지 내용
		$data = $memo_control->get_memo_extend(" where `no` = '".$no."' and `wr_".$kind."_mb_id` = '".$member['mb_id']."' and `wr_is_delete` = 0 ");

		// 쪽지 보낸 사람 정보
		$send_member = $member_control->get_member($data['wr_send_mb_id']);	

		// 쪽지 읽음 처리
		$memo_control->read_memo( $no, $member['mb_id'] );

		$type = "";
		if($data['wr_employ_no']){
			$type = "employ";
			$no = $data['wr_employ_no'];
		} else if($data['wr_resume_no']){
			$type = "resume";
			$no = $data['wr_resume_no'];
		}

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/memo_read.html'))
			include_once $alice['self'] . 'views/memo_read.html';
		else
			$config->error_info( $alice['self'] . 'views/memo_read.html' );

		$config_control->_tail(true);	// tail;

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>