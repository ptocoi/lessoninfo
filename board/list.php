<?php
		/*
		* /application/board/list.php
		* @author Harimao
		* @since 2013/10/28
		* @last update 2014/07/08
		* @Module v3.5 ( Alice )
		* @Brief :: Board Listing
		* @Comment :: 게시판 리스팅
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
		# 리스트 권한 확인
		if($member['mb_level'] < $board['bo_list_level']){
			if($member['mb_id'])
				$utility->popup_msg_js($board_control->_errors('0018'));	// 목록을 볼 권한이 없습니다.
			else
				$utility->popup_msg_js($board_control->_errors('0024'), $alice['member_path']."/login.php?wr_no=".$wr_no."&url=".urlencode("../../board/board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$wr_no));	// 목록을 볼 권한이 없습니다.\\n\\n회원이시라면 로그인 후 이용해 보세요.
		}

		##
		# Listing
		if($bo_table){	// 리스트
			/*
			$use_category = false;	// 카테고리 사용유무
			if($board['bo_use_category']) {
				$bo_category = $category_control->category_pcodeList('board',$bo_table);	// 게시판별 분류(카테고리)
				$cate_url = "board_code=" . $board_code . "&code=" . $code . "&bo_table=" . $bo_table;
				$use_category = true;
			}
			*/
			$use_category = false;	// 카테고리 사용유무
			if ($board['bo_use_category']){
				$category_location = "./board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table;
				$category_option = $category_control->getOption_add("board"," and `p_code` = '".$bo_table."' "); // SELECT OPTION 태그로 넘겨받음
				$bo_category = $category_control->category_pcodeList('board',$bo_table);	// 게시판별 분류(카테고리)
				$use_category = true;
			}

			$page = ($page) ? $page : 1;
			$page_rows = ($page_rows) ? $page_rows: $board['bo_page_rows'];
			$sorting = ($board_sort) ? "&board_sort=" . $board_sort . "&board_flag=desc&" : "";
			$con = " where `wr_is_comment` = 0 ";
			$list_row = $board_control->__TableList($bo_table,$page,$page_rows,$con);
			$pages = $utility->user_get_paging($page_rows, $page, $list_row['total_page'],"./board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&".$sorting."page_rows=".$page_rows."&".$list_row['send_url']."&page=");
			$total_page = $list_row['total_page'];

			$list = array();
			$i = 0;

			/* 공지사항 리스트 */
			$arr_notice = explode("\n", trim($board['bo_notice']));
			$notice_cnt = count($arr_notice);
			for($n=0;$n<$notice_cnt;$n++){
				if (trim($arr_notice[$n])=='') continue;
				// 공지사항 리스트
				$notices = $board_control->get_boardArticle( $bo_table, " where `wr_no` = '".$arr_notice[$n]."' order by `wr_no` desc ");
				$list[$i] = $board_control->get_list( $notices, $board, $board_skin, $board['bo_subject_len'] );
				$list[$i]['is_notice'] = true;
			$i++;
			}
			/* //공지사항 리스트 */

			/* 게시물 리스트 */
			$n = 0;
			foreach($list_row['result'] as $val){	// 리스팅
				$list[$i] = $board_control->get_list($val, $board, "./skins/board/" . $board['bo_skin'], $board['bo_subject_len'] );
				$list[$i]['subject'] = $utility->search_font($search_keyword, $list[$i]['subject']);
				$list[$i]['is_notice'] = false;
				$list[$i]['num'] = $list_row['total_count'] - ($page - 1) * $board['bo_page_rows'] - $n;
				$len = strlen($val['wr_reply']);
				if($len < 0):
					$len = 0;
				endif;
				$reply = substr($val['wr_reply'], 0, $len);
				$list[$i]['reply_cnt'] = $db->_queryR(" select count(*) from `".$alice['write_prefix'].$board['bo_table']."` where `wr_reply` like '".$reply."%' and `wr_no` <> '".$val['wr_no']."' and `wr_num` = '".$val['wr_num']."' and `wr_is_comment` = 0 ");

			$i++;
			$n++;
			}
			/* //게시물 리스트 */

		}


		##
		# Variables
		$bo_subject = stripslashes($board['bo_subject']);

		//echo preg_replace("/\//", "\/", trim(urldecode($search_keyword)))." <==<Br/>";	 // 다른 방식
		$search_keyword = urldecode(trim($search_keyword));	// 검색어

		$write_href = "";
		if ($member['mb_level'] >= $board['bo_write_level'])
			$write_href = "./write.php?mode=insert&board_code=".$board_code."&code=".$code."&bo_table=".$bo_table;

		$nobr_begin = $nobr_end = "";
		if (preg_match("/gecko|firefox/i", $_SERVER['HTTP_USER_AGENT'])) {
			$nobr_begin = "<nobr style='display:block; overflow:hidden;'>";
			$nobr_end   = "</nobr>";
		}

		##
		# Include view
		if(is_file($alice['self'] . 'views/list.html'))
			include_once $alice['self'] . 'views/list.html';
		else
			$config->error_info( $alice['self'] . 'views/list.html' );

?>