<?php
		/*
		* /application/alba/comment.php
		* @author Harimao
		* @since 2013/10/18
		* @last update 2013/11/06
		* @Module v3.5 ( Alice )
		* @Brief :: Alba detail Comment
		* @Comment :: 정규직 공고 댓글
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "alba";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$no = $_GET['no'];

		$is_comment_write = false;
		if($is_member || $is_admin){	// 일반 사용자나 관리자일 경우
			$is_comment_write = true;
		}

		/*
		if($is_admin){
			$wr_name = $admin_info['nick'];
			$wr_id = $admin_info['uid'];
			$wr_password = $admin_info['passwd'];
			$wr_email = $env['email'];
			$wr_homepage = $alice['url'];
		} else {
			$wr_name = $member['mb_nick'];
			$wr_id = $member['mb_id'];
			$wr_password = $member['mb_password'];
			$wr_email = $member['mb_email'];
			$wr_homepage = $member['mb_homepage'];
		}
		*/

		$wr_name = $member['mb_nick'];
		$wr_id = $member['mb_id'];
		$wr_password = $member['mb_password'];
		$wr_email = $member['mb_email'];
		$wr_homepage = $member['mb_homepage'];

		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows : 15;
		$con = " where  `wr_num` = '".$no."' and `wr_category` = 'alba' and `wr_is_comment` = 1 ";
		$comment_list = $comment_control->__CommentList( $page, $page_rows, $con );
		$total_count = $comment_list['total_count'];
		$total_page = $comment_list['total_page'];
		$list = $comment_list['result'];
		//$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_list.php?page_rows=".$page_rows."&".$comment_list['send_url']."&page=");


		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'skins/default/comment.skin.php'))
			include_once $alice['self'] . 'skins/default/comment.skin.php';
		else
			$config->error_info( $alice['self'] . 'skins/default/comment.skin.php' );

?>