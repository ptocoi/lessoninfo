<?php
		/*
		* /application/board/board.php
		* @author Harimao
		* @since 2013/10/28
		* @last update 2014/07/07
		* @Module v3.5 ( Alice )
		* @Brief :: Board default
		* @Comment :: 게시판 기본 정보 및 데이터 추출
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

		if (!$board['bo_table']) {
			if ($cwin) // 코멘트 보기
			   $utility->popup_msg_close($board_control->_errors('0019'));	 // 존재하지 않는 게시판 입니다.
			else
			   $utility->popup_msg_js($board_control->_errors('0019'));	 // 존재하지 않는 게시판 입니다.
		}

		if ($write['wr_is_comment'])	{
			$utility->popup_msg_js("",$alice['board_path']."/board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$write['wr_parent']."#c_".$wr_no);
		}

		if (!$bo_table){
			if($cwin) // 코멘트 보기
				// bo_table 값이 넘어오지 않았습니다.\\n\\nboard.php?bo_table=code 와 같은 방식으로 넘겨 주세요.
				$utility->popup_msg_close($board_control->_errors('0020'));	
			else
				$utility->popup_msg_js($board_control->_errors('0020'));
		}

		// wr_no 값이 있으면 글읽기
		if ($wr_no){
			// 글이 없을 경우 해당 게시판 목록으로 이동
			if (!$write['wr_no']){
				// 글이 존재하지 않습니다.\\n\\n글이 삭제되었거나 이동된 경우입니다.
				if ($cwin)
					$utility->popup_msg_close($board_control->_errors('0021'));	
				else
					$utility->popup_msg_js($board_control->_errors('0021'),"./board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table);
			}

			// 로그인된 회원의 권한이 설정된 읽기 권한보다 작다면
			if ($member['mb_level'] < $board['bo_read_level']){
				if ($member['mb_id'])
					$utility->popup_msg_js($board_control->_errors('0022'));	// 글을 읽을 권한이 없습니다.
				else
					$utility->popup_msg_js($board_control->_errors('0023'),$alice['member_path']."/login.php?wr_no=".$wr_no."&url=".urlencode("../../board/board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$wr_no));	// 글을 읽을 권한이 없습니다.\\n\\n회원이시라면 로그인 후 이용해 보십시오.
			}

			// 자신의 글이거나 관리자라면 통과
			if (($write['wr_id'] && $write['wr_id'] == $member['mb_id']) || $is_admin)
				;
			else {
				// 비밀글이라면
				if ($write['wr_secret']){
					// 회원이 비밀글을 올리고 관리자가 답변글을 올렸을 경우
					// 회원이 관리자가 올린 답변글을 바로 볼 수 없던 오류를 수정
					$is_owner = false;
					if ($write['wr_reply'] && $member['mb_id']) {
						$query = " select wr_id from $write_table where wr_num = '$write[wr_num]' and wr_reply = '' and wr_is_comment = '0' ";
						$row = $db->query_fetch($query);
						if ($row['wr_id'] == $member['mb_id'])
							$is_owner = true;
					}

					$ss_name = "ss_secret_".$bo_table."_".$write['wr_num'];

					if (!$is_owner){
						//$ss_name = "ss_secret_{$bo_table}_{$wr_id}";
						// 한번 읽은 게시물의 번호는 세션에 저장되어 있고 같은 게시물을 읽을 경우는 다시 패스워드를 묻지 않습니다.
						// 이 게시물이 저장된 게시물이 아니면서 관리자가 아니라면
						if (!$_SESSION[$ss_name])
							$utility->popup_msg_js("",$alice['board_path']."/password.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$wr_no);
					}
					$utility->set_session($ss_name, TRUE);
				}
			}

			// 한번 읽은글은 브라우저를 닫기전까지는 카운트를 증가시키지 않음
			$hit_up = $board_control->hit_up($bo_table, $wr_no);
			if($hit_up){
				// 자신의 글이면 통과
				if ($write['wr_id'] && $write['wr_id'] == $member['mb_id']) {
					;
				} else if ($is_guest && $board['bo_read_level'] == 1 && $write['wr_ip'] == $_SERVER['REMOTE_ADDR']) {
					// 비회원이면서 읽기레벨이 1이고 등록된 아이피가 같다면 자신의 글이므로 통과
					;
				} else {

					// 글읽기 포인트가 설정되어 있다면
					if ($board['bo_read_point'] && $member['mb_point'] + $board['bo_read_point'] < 0)
						$utility->popup_msg_js("보유하신 포인트(".number_format($member['mb_point']).")가 없거나 모자라서 글읽기(".number_format($board['bo_read_point']).")가 불가합니다.\\n\\n포인트를 모으신 후 다시 글읽기 해 주십시오.");

					$point_control->point_insert($member['mb_id'], $board['bo_read_point'], $board['bo_subject']." ".$wr_no." 글읽기", $bo_table, $wr_no, "읽기");
				}

			}

		} else {

			if ($member['mb_level'] < $board['bo_list_level']){
				if ($member['mb_id'])
					$utility->popup_msg_js($board_control->_errors('0018'));	// 목록을 볼 권한이 없습니다.
				else
					$utility->popup_msg_js($board_control->_errors('0024'),$alice['member_path']."/login.php?wr_no=".$wr_no."&url=".urlencode("../../board/board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$wr_no));	// 목록을 볼 권한이 없습니다.
			}

			if (!$page) $page = 1;

		}

		$width = $board['bo_table_width'];
		if ($width <= 100) $width .= '%';

		// IP보이기 사용 여부
		$ip = "";
		$is_ip_view = false;
		if ($is_admin) {
			$is_ip_view = true;
			$ip = $write['wr_ip'];
		} else {// 관리자가 아니라면 IP 주소를 감춘후 보여줍니다.
			$is_ip_view = false;
			$ip = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", "\\1.♡.\\3.\\4", $write['wr_ip']);
		}

		// 분류 사용
		$is_category = false;
		$category_name = "";
		if ($board['bo_use_category']) {
			$is_category = true;
			$category_name = $category_control->get_categoryCodeName($write['wr_category']); // 분류명
		}

		// 추천 사용
		$is_good = false;
		if ($board['bo_use_good'])
			$is_good = true;

		// 비추천 사용
		$is_nogood = false;
		if ($board['bo_use_nogood'])
			$is_nogood = true;

		$admin_href = "";
		// 최고관리자 또는 그룹관리자라면
		if ($member['mb_id'] && $is_admin)
			$admin_href = $alice['admin_board_path']."/";


		/* BEST OF BEST */
		$get_latestList = $board_control->get_latest(" where `bo_table` = '".$bo_table."' and `wr_hit` >= ".$board['bo_best_count']." order by `wr_hit` desc ");
		if($get_latestList){
			$best_of_best = $board_control->get_boardArticle($get_latestList['bo_table']," where `wr_no` = '".$get_latestList['wr_no']."' ");
			$best_board = $board_control->get_boardTable($get_latestList['bo_table']);
			$best_of_best['code'] = $best_board['code'];
			$best_of_best['bo_table'] = $best_board['bo_table'];
		}
		/* //BEST OF BEST */

		/* 이번주 HOT 클릭 */
		$week_first = time() - (date('w')*86400);
		$week_last = $week_first + (6*86400);
		$week_hot = $board_control->get_latestList(" where `bo_table` = '".$bo_table."' and `bn_datetime` between '".date('Y-m-d H:i:s', $week_first)."' and '".date('Y-m-d H:i:s', $week_last)."' order by `wr_hit` desc limit " . $get_board_main['sub_best_count']);

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
		/* //이번주 HOT 클릭 */


		/*
		##
		# 리스트 권한 확인
		if($board['bo_list_level']){	// 값이 있다면 비회원은 못 보고 회원만 볼 수 있다.
			if(!$is_member){	 // 비회원이면
				$utility->popup_msg_js($board_control->_errors('0017'), $urlencode);	// 회원만 접근 가능합니다.
			} else {	 // 회원이라면 리스트 접근 권한 체크
				$list_level = $board_control->denied_check($board,"bo_list_level",$member['mb_level']);	// 목록보기 권한
				if(!$list_level){
					$utility->popup_msg_js($board_control->_errors('0018'));	// 목록을 볼 권한이 없습니다.
				}
			}
		}
		*/

		/* SNS 기능 */
		$is_sns = false;
		if($board['bo_use_sns']){
			$sns_subject = urlencode(stripslashes($view['subject'])." ");
			$sns_url = urlencode("http://".$host_name.'/board/view.php?board_code='.$board_code.'&code='.$code.'&bo_table='.$bo_table.'&wr_no='.$wr_no);
			$sns_twitter = "http://twitter.com/home/?status=" . $sns_subject . $sns_url;
			$sns_facebook = "http://www.facebook.com/sharer.php?u=".urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
			$sns_me2day = "http://me2day.net/posts/new?new_post[body]=".$sns_subject.":".$sns_url."&new_post[tags]=".urlencode($site_name);
			$yozm = "http://yozm.daum.net/api/popup/prePost?link=".$sns_url.'&prefix='.$sns_subject;
			$clog = "http://csp.cyworld.com/bi/bi_recommend_pop.php?url=".$sns_url."&thumbnail=http://".$host_name."/".$alice['data_logo_path']."/".$logo['top']."&summary=".$sns_subject."&writer=".urlencode($site_name);

			$is_sns = true;
		}
		/* //SNS 기능 */


		$mod = 4;	 // 사진 출력 갯수
		$data_path = $alice['data_board_path'] . "/" . $bo_table;
		$thumb_path = $data_path.'/thumb';

		@mkdir($thumb_path, 0707);
		@chmod($thumb_path, 0707);

		##
		# Include view
		if( !($board['bo_use_comment'] && $cwin) ){

			// 게시물 번호가 있다면 게시물 보기를 INCLUDE
			if($wr_no) {
				if(is_file($alice['self'] . 'view.php'))
					include_once $alice['self'] . 'view.php';
				else
					$config->error_info( $alice['self'] . 'view.php' );
			}

			// 전체목록보이기 사용이 "예" 또는 wr_no 값이 없다면 목록을 보임
			//if ($list_level && $board['bo_use_list_view'] || empty($wr_no)){
			//if($member['mb_level'] >= $board['bo_list_level'] && $board['bo_use_list_view'] || empty($wr_no)) {
			if($member['mb_level'] >= $board['bo_list_level'] && empty($wr_no)) {
				if(is_file($alice['self'] . 'list.php'))
					include_once $alice['self'] . 'list.php';
				else
					$config->error_info( $alice['self'] . 'list.php' );
			}

		} else {

			if(is_file($alice['self'] . 'view_comment.php'))
				include_once $alice['self'] . 'view_comment.php';
			else
				$config->error_info( $alice['self'] . 'view_comment.php' );

		}

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>