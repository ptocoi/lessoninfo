<?php
		/*
		* /application/board/index.php
		* @author Harimao
		* @since 2013/10/24
		* @last update 2014/07/07
		* @Module v3.5 ( Alice )
		* @Brief :: Board main
		* @Comment :: 게시판 메인
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
		$left_notice_list = $notice_control->get_notice_list_count(5);	 // 좌측 공지
		$board_categories = $category_control->get_categoryCode($board_code);	// 게시판 그룹 코드에 따른 최상위 그룹

		$menu_name = $utility->remove_quoted($board_categories['name']);	// 최상위 메뉴명

		$left_list = $category_control->pcode_List($board_code);
		$left_list_cnt = count($left_list);
		$boCode_list = $board_control->boCode_list($board_code);
		$boCode_list_cnt = count($boCode_list);

		if($left_list_cnt){	// 2차 메뉴 소속 게시판
			$best_bo_table = array();	// best of best
			$list_bo_table = array();	 // 게시판 메인 리스트
			foreach($left_list as $_code){
				$board_list = $board_control->boCode_list($_code['code']);
				foreach($board_list as $_board){
					array_push($best_bo_table, "'".$_board['bo_table']."'");
					array_push($list_bo_table, $_board['bo_table']);
				}
			}
		} else if($boCode_list_cnt){	// 1차 메뉴 소속 게시판
			$best_bo_table = array();	// best of best
			$list_bo_table = array();	 // 게시판 메인 리스트
			foreach($boCode_list as $_board){
				array_push($best_bo_table, "'".$_board['bo_table']."'");
				array_push($list_bo_table, $_board['bo_table']);
			}
		}

		if($best_bo_table){

			// BEST OF BEST (1건만)
			$get_latestList = $board_control->get_latest(" where `bo_table` in (".@implode(',',$best_bo_table).") order by `wr_hit` desc limit 1");
			if($get_latestList){
				$best_of_best = $board_control->get_boardArticle($get_latestList['bo_table']," where `wr_no` = '".$get_latestList['wr_no']."' ");
				$best_board = $board_control->get_boardTable($get_latestList['bo_table']);
				$best_of_best['code'] = $best_board['code'];
				$best_of_best['bo_table'] = $best_board['bo_table'];
			}

			// 금주의베스트
			$week_first = time() - (date('w')*86400);
			$week_last = $week_first + (6*86400);
			$week_hot = $board_control->get_latestList(" where `bo_table` in (".@implode(',',$best_bo_table).") and `bn_datetime` between '".date('Y-m-d H:i:s', $week_first)."' and '".date('Y-m-d H:i:s', $week_last)."' order by `wr_hit` desc limit " . $get_board_main['use_best_count']);	 // 설정 갯수만큼

			$week_hot_list = array();	// 이번주 HOT 클릭
			$i = 0;
			foreach($week_hot as $_hot){
				$hots = $board_control->get_boardArticle($_hot['bo_table']," where `wr_no` = '".$_hot['wr_no']."' ");
				$week_board = $board_control->get_boardTable($_hot['bo_table']);
				$week_hot_list[$i]['code'] = $week_board['code'];
				$week_hot_list[$i]['bo_table'] = $_hot['bo_table'];
				$week_hot_list[$i]['wr_no'] = $_hot['wr_no'];
				$week_hot_list[$i]['subject'] = stripslashes($hots['wr_subject']);
			$i++;
			}
		
		/*
		echo "<pre>";
		//print_R($best_bo_table);
		//print_R($list_bo_table);
		//print_r($board_categories);
		//print_r($board_menu);
		//print_R($left_list);
		//print_R($best_of_best);
		print_R($week_hot_list);
		echo "</pre>";
		*/

			/*

			// 새로 등록된 글
			$get_newList = $board_control->get_latestList(" order by `no` desc limit " . $get_board_main['use_new_count']);
			$new_list = array();	// 새로 등록된 글
			$i = 0;
			foreach($get_newList as $_new){
				$news = $board_control->get_boardArticle($_new['bo_table']," where `wr_no` = '".$_new['wr_no']."' ");
				$new_board = $board_control->get_boardTable($_new['bo_table']);
				$new_list[$i]['code'] = $new_board['code'];
				$new_list[$i]['bo_table'] = $_new['bo_table'];
				$new_list[$i]['wr_no'] = $_new['wr_no'];
				$new_list[$i]['subject'] = stripslashes($news['wr_subject']);
				$new_list[$i]['name'] = stripslashes($news['wr_name']);
				$new_list[$i]['wdate'] = str_replace('-','.',substr($news['wr_datetime'],0,11));
			$i++;
			}

			// 최다 조회 글
			$get_hitList = $board_control->get_latestList(" where `bo_table` in (".@implode(',',$best_bo_table).") order by `wr_hit` desc limit " . $get_board_main['use_new_count']);
			$hit_list = array();	// 최다 조회 글
			$i = 0;
			foreach($get_hitList as $_hit){
				$hits = $board_control->get_boardArticle($_hit['bo_table']," where `wr_no` = '".$_hit['wr_no']."' ");
				$hit_board = $board_control->get_boardTable($_hit['bo_table']);
				$hit_list[$i]['code'] = $hit_board['code'];
				$hit_list[$i]['bo_table'] = $_hit['bo_table'];
				$hit_list[$i]['wr_no'] = $_hit['wr_no'];
				$hit_list[$i]['subject'] = stripslashes($hits['wr_subject']);
				$hit_list[$i]['name'] = stripslashes($hits['wr_name']);
				$hit_list[$i]['wdate'] = str_replace('-','.',substr($hits['wr_datetime'],0,11));
			$i++;
			}

			// 최다 댓글 글
			$get_commentList = $board_control->get_latestList(" where `bo_table` in (".@implode(',',$best_bo_table).") order by `wr_comment` desc limit " . $get_board_main['use_new_count']);
			$comment_list = array();	// 최다 댓글 글
			$i = 0;
			foreach($get_commentList as $_comment){
				$comments = $board_control->get_boardArticle($_comment['bo_table']," where `wr_no` = '".$_comment['wr_no']."' ");
				$comment_board = $board_control->get_boardTable($_comment['bo_table']);
				$comment_list[$i]['code'] = $comment_board['code'];
				$comment_list[$i]['bo_table'] = $_comment['bo_table'];
				$comment_list[$i]['wr_no'] = $_comment['wr_no'];
				$comment_list[$i]['subject'] = stripslashes($comments['wr_subject']);
				$comment_list[$i]['name'] = stripslashes($comments['wr_name']);
				$comment_list[$i]['wdate'] = str_replace('-','.',substr($comments['wr_datetime'],0,11));
			$i++;
			}

			//최신글
			$latest_result = $db->query_fetch_rows(" select `code`, `bo_table`, `bo_subject` from `alice_board` where `bo_table` in (".@implode(',',$best_bo_table).") order by no, bo_table ");
			*/

		}


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