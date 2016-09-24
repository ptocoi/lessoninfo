<?php
		/*
		* /application/board/view.php
		* @author Harimao
		* @since 2013/10/28
		* @last update 2014/07/08
		* @Module v3.5 ( Alice )
		* @Brief :: Board view
		* @Comment :: 게시판 글 보기
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "board";

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
		$bo_subject = stripslashes($board['bo_subject']);

		$left_notice_list = $notice_control->get_notice_list_count(5);	 // 좌측 공지
		$board_categories = $category_control->get_categoryCode($board_code);	// 게시판 그룹 코드에 따른 최상위 그룹

		$menu_name = $utility->remove_quoted($board_categories['name']);	// 최상위 메뉴명

		$left_list = $category_control->pcode_List($board_code);
		$left_list_cnt = count($left_list);
		$boCode_list = $board_control->boCode_list($board_code);
		$boCode_list_cnt = count($boCode_list);

		if($is_member)	// 회원일때만
			$utility->set_session('ss_delete_token',$token);	// 삭제 토큰 세션

		$view = $board_control->get_view($bo_table,$wr_no);

		/* 비밀글이라면 */
		if($view['wr_secret']){
			if(!$_SESSION['view_secret_'.$bo_table.'_'.$wr_no]){	// 비밀글 세션이 있다면 내가 작성한 글이다
				$utility->popup_msg_js("","./password.php?mode=view&board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$wr_no);
			}
		}
		/* //비밀글이라면 */


		// 검색이면
		$search_que = "";
		if($sca || $search_keyword){
			$search_href = "./board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&page=".$page;
			$list_href = "./board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table;
		} else {
			$search_href = "";
			$list_href = "./board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table;
		}

		if ($search_que)
			$search_que = " and " . $search_que;

		// 윗글을 얻음
		$query = " select `wr_no`, `wr_subject` from `".$write_table."` where `wr_is_comment` = 0 and `wr_num` = '".$write['wr_num']."' and `wr_reply` < '".$write['wr_reply']."' ".$search_que." order by `wr_num` desc, `wr_reply` desc limit 1 ";
		$prev = $db->query_fetch($query);

		// 위의 쿼리문으로 값을 얻지 못했다면
		if (!$prev['wr_no'])     {
			$query = " select `wr_no`, `wr_subject` from `".$write_table."` where `wr_is_comment` = 0 and `wr_num` < '".$write['wr_num']."' ".$search_que." order by `wr_num` desc, `wr_reply` desc limit 1 ";
			$prev = $db->query_fetch($query);
		}

		// 아래글을 얻음
		$query = " select `wr_no`, `wr_subject` from `".$write_table."` where `wr_is_comment` = 0 and `wr_num` = '".$write['wr_num']."' and `wr_reply` > '".$write['wr_reply']."' ".$sql_search." order by `wr_num`, `wr_reply` limit 1 ";
		$next = $db->query_fetch($query);
		// 위의 쿼리문으로 값을 얻지 못했다면
		if (!$next['wr_no']) {
			$query = " select `wr_no`, `wr_subject` from `".$write_table."` where `wr_is_comment` = 0 and `wr_num` > '".$write['wr_num']."' ".$sql_search." order by `wr_num`, `wr_reply` limit 1 ";
			$next = $db->query_fetch($query);
		}

		// 이전글 링크
		$prev_href = "";
		if ($prev['wr_no']) {
			$prev_wr_subject = $utility->get_text($utility->cut_str($prev['wr_subject'], 255));
			$prev_href = "./board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$prev['wr_no']."&page=".$page;
		}
		// 다음글 링크
		$next_href = "";
		if ($next['wr_no']) {
			$next_wr_subject = $utility->get_text($utility->cut_str($next['wr_subject'], 255));
			$next_href = "./board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$next['wr_no']."&page=".$page;
		}

		// 쓰기 링크
		/*
		$write_href = "";
		if ($member['mb_level'] >= $board['bo_write_level'])
		*/
			$write_href = "./write.php?mode=insert&board_code=".$board_code."&code=".$code."&bo_table=".$bo_table;

		// 답변 링크
		/*
		$reply_href = "";
		if ($member['mb_level'] >= $board['bo_reply_level'])
		*/
			$reply_href = "./write.php?mode=reply&board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$wr_no;


		// 수정, 삭제 링크
		$update_href = $delete_href = "";
		// 로그인중이고 자신의 글이라면 또는 관리자라면 패스워드를 묻지 않고 바로 수정, 삭제 가능
		if (($member['mb_id'] && ($member['mb_id'] == $write['wr_id'])) || $is_admin) {
			$update_href = "./write.php?mode=update&board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$wr_no."&page=".$page;
			$delete_href = "javascript:del('./process/delete.php?token=".$token."&board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$wr_no."&page=".$page."');";
			if ($is_admin) {
				$utility->set_session("ss_delete_token", $token);
				$delete_href = "javascript:del('./process/delete.php?bo_table=".$bo_table."&wr_no=".$wr_no."&token=".$token."&page=".$page."');";
			}
		} else if ($member['mb_id'] != $write['wr_id'] || $write['wr_id']=='guest') { // 회원이 쓴 글이 아니라면
			$update_href = "./password.php?mode=update&board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$wr_no."&page=".$page;
			$delete_href = "./password.php?mode=delete&board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$wr_no."&page=".$page;
		}


		$good_href = "";
		$nogood_href = "";
		if ($member['mb_id']) {
			// 스크랩 링크
			//$scrap_href = "./scrap_popin.php?bo_table=$bo_table&wr_id=$wr_id";

			// 추천 링크
			if ($board['bo_use_good'])
				$good_href = "./good.php?bo_table=".$bo_table."&wr_no=".$wr_no."&good=good";

			// 비추천 링크
			if ($board['bo_use_nogood'])
				$nogood_href = "./good.php?bo_table=$bo_table&wr_id=$wr_id&good=nogood";
		}
		
		$datetime = strtr(substr($view['wr_datetime'],0,16),'-','.');

		##
		# Include view
		if(is_file($alice['self'] . 'views/view.html'))
			include_once $alice['self'] . 'views/view.html';
		else
			$config->error_info( $alice['self'] . 'views/view.html' );

?>