<?php
		/*
		* /application/board/wriite.php
		* @author Harimao
		* @since 2013/10/28
		* @last update 2014/01/06
		* @Module v3.5 ( Alice )
		* @Brief :: Board Writing
		* @Comment :: 게시판 글작성
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "board";

		$banner_atop_position = $page_name . "_top";
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


		if (!$board['bo_table']){
			$utility->popup_msg_js($board_control->_errors('0019'));	// 존재하지 않는 게시판입니다.
			exit;
		}

		if (!$bo_table) {
			$utility->popup_msg_js($board_control->_errors('0020'));	// bo_table 값이 넘어오지 않았습니다.\\n\\nwrite.php?bo_table=code 와 같은 방식으로 넘겨 주세요.
			exit;
		}

		$notice_array = explode("\n", trim($board['bo_notice']));

		$subject = preg_replace("/\"/", "&#034;", $utility->get_text($utility->cut_str($write['wr_subject'], 255), 0));

		if ($mode=="insert" || $mode=="") {	// 글 작성시

			$content = $board['bo_insert_content'];

			if (isset($wr_no)){
				$utility->popup_msg_js($board_control->_errors('0025'));	// 글쓰기에는 wr_no 값을 사용하지 않습니다.
				exit;
			}

			// 글작성 레벨 체크
			if($member['mb_level'] < $board['bo_write_level']){
				if($member['mb_id'])
					$utility->popup_msg_js($board_control->_errors('0026'));	// 글을 쓸 권한이 없습니다.
				else
					$utility->popup_msg_js($board_control->_errors('0027'), $alice['member_path']."/login.php?url=".urlencode($_SERVER['PHP_SELF']."?mode=insert&board_code=".$board_code."&code=".$code."&bo_table=".$bo_table));	// 글을 쓸 권한이 없습니다.\\n\\n회원이시라면 로그인 후 이용해 보세요.
			}

			// 포인트 체크
			/*
			$tmp_point = ($member['mb_point'] > 0) ? $member['mb_point'] : 0;
			if ($tmp_point + $board['bo_write_point'] < 0 && !$is_admin)
				$utility->popup_msg_js("보유하신 포인트(".number_format($member['mb_point']).")가 없거나 모자라서 글쓰기(".number_format($board['bo_write_point']).")가 불가합니다.\\n\\n포인트를 적립하신 후 다시 글쓰기 해 주십시오.");
			*/
			
			$password_required = "required";

		} else if($mode=='update') {

			if($member['mb_id'] && $write['mb_id'] == $member['mb_id'])
				;
			else if ($member['mb_level'] < $board['bo_write_level']) {
				if ($member['mb_id'])
					$utility->popup_msg_js($board_control->_errors('0044'));	// 글을 수정할 권한이 없습니다.
				else
					$utility->popup_msg_js($board_control->_errors('0045'), $alice['member_path']."/login.php?url=".urlencode("../board/board.php?mode=update&board_code=".$board_code."&code=".$code."&bo_table=".$bo_table));	 // 글을 수정할 권한이 없습니다.\\n\\n회원이시라면 로그인 후 이용해 보세요.
			}

			if(!$is_admin){
				if(!($member['mb_id'] && $member['mb_id'] == $write['wr_id'])){
					if(md5($wr_password) != $write['wr_password']){
						$utility->popup_msg_js($board_control->_errors('0037'));
					}
				}
			}

			$len = strlen($write['wr_reply']);
			if ($len < 0) $len = 0;
			$reply = substr($write['wr_reply'], 0, $len);

			// 원글만 구한다.
			$query = " select count(*) as cnt from `".$write_table."` where `wr_reply` like '".$reply."%' and `wr_no` <> '".$write['wr_no']."' and `wr_num` = '".$write['wr_num']."' and `wr_is_comment` = 0 ";
			$row = $db->query_fetch($query);
			if ($row['cnt'] && !$is_admin) {
				$utility->popup_msg_js($board_control->_errors('0043'));	// 이 글과 관련된 답변글이 존재하므로 수정 할 수 없습니다.\\n\\n우선 답변글부터 삭제하여 주십시오.
				exit;
			}

			$password_required = "";

			$name = $utility->get_text($utility->cut_str($write['wr_name'],20));
			$email = $write['wr_email'];
			$homepage = $utility->get_text($write['wr_homepage']);

			if (strstr($write['wr_option'], "html1")) {
				$html_checked = "checked";
				$html_value = "html1";
			} else if (strstr($write['wr_option'], "html2")) {
				$html_checked = "checked";
				$html_value = "html2";
			} else
				$html_value = "";

			$file = $utility->get_file($bo_table, $wr_no);

			$content = $utility->get_text($write['wr_content'], 0);

		} else if($mode=='reply') {

			$subject = "[답변] " . preg_replace("/\"/", "&#034;", $utility->get_text($utility->cut_str($write['wr_subject'], 255), 0));

			if($board['bo_reply_level']){	// 작성 레벨 확인
				if(!$is_member){	// 회원이 아니라면
					$utility->popup_msg_js($board_control->_errors('0028'), $alice['member_path']."/login.php?url=".urlencode("../board/board.php?mode=reply&board_code=".$board_code."&code=".$code."&bo_table=".$bo_table));	// 글을 답변할 권한이 없습니다.
					exit;
				}
			}

			if (in_array((int)$wr_no, $notice_array)) {
				$utility->popup_msg_js($board_control->_errors('0011'));	// 공지에는 답변 할 수 없습니다.
				exit;
			}

			// 코멘트에는 원글의 답변이 불가하므로
			if ($write['wr_is_comment']){
				$utility->popup_msg_js($board_control->_errors('0029'));	// 정상적인 접근이 아닌것 같습니다.
				exit;
			}

			// 비밀글인지를 검사
			if ($write['wr_secret']) {
				if ($write['mb_id']) {
					// 회원의 경우는 해당 글쓴 회원 및 관리자
					if (!($write['mb_id'] == $mb_id)) {
						$utility->popup_msg_js($board_control->_errors('0030'));	// 비밀글에는 자신 또는 관리자만 답변이 가능합니다.
						exit;
					}
				} else {
					// 비회원의 경우는 비밀글에 답변이 불가함
					$utility->popup_msg_js($board_control->_errors('0031'));	// 비회원의 비밀글에는 답변이 불가합니다.
					exit;
				}
			}

			// 게시글 배열 참조
			$reply_array = &$write;

			// 최대 답변은 테이블에 잡아놓은 wr_reply 사이즈만큼만 가능합니다.
			if (strlen($reply_array['wr_reply']) == 10){
				$utility->popup_msg_js($board_control->_errors('0012'));	// 더 이상 답변하실 수 없습니다.\\n\\n답변은 10단계 까지만 가능합니다.
				exit;
			}

			$reply_len = strlen($reply_array['wr_reply']) + 1;
			if ($board['bo_reply_order']) {
				$begin_reply_char = 'A';
				$end_reply_char = 'Z';
				$reply_number = +1;
				$query = " select MAX(SUBSTRING(wr_reply, ".$reply_len.", 1)) as reply from `".$write_table."` where `wr_num` = '".$reply_array['wr_num']."' and SUBSTRING(wr_reply, ".$reply_len.", 1) <> '' ";
			} else {
				$begin_reply_char = 'Z';
				$end_reply_char = 'A';
				$reply_number = -1;
				$query = " select MIN(SUBSTRING(wr_reply, ".$reply_len.", 1)) as reply from `".$write_table."` where `wr_num` = '".$reply_array['wr_num']."' and SUBSTRING(wr_reply, ".$reply_len.", 1) <> '' ";
			}

			if ($reply_array['wr_reply']) $query .= " and wr_reply like '".$reply_array['wr_reply']."%' ";
			$row = $db->query_fetch($query);

			if (!$row['reply']){
				$reply_char = $begin_reply_char;
			} else if ($row['reply'] == $end_reply_char) { // A~Z은 26 입니다.
				echo '0120';	// 더 이상 답변하실 수 없습니다.\\n\\n답변은 26개 까지만 가능합니다.
				exit;
			} else {
				$reply_char = chr(ord($row['reply']) + $reply_number);
			}

			$reply = $reply_array['wr_reply'] . $reply_char;

			$password_required = "required";

			/* 링크 기능 (지금 버전에선 없음)
			for ($i=1; $i<=$g4[link_count]; $i++) {
				$write["wr_link".$i] = get_text($write["wr_link".$i]);
			}
			*/

			if (!strstr($write['wr_option'], "html")) {
				$content = "\n\n\n>"
						 . "\n>"
						 . "\n> " . preg_replace("/\n/", "\n> ", $utility->get_text($write[wr_content], 0))
						 . "\n>"
						 . "\n";
			}

		}

		if (($mode == "update" || $mode == "reply") && !$write['wr_id']){
			$utility->popup_msg_js($board_control->_errors('0008'));	 // 글이 존재하지 않습니다.\\n\\n글이 삭제되었거나 이동하였을 수 있습니다.
			exit;
		}

		$is_notice = false;
		if ($is_admin && $mode != "reply"){
			$is_notice = true;

			if ($w == "update"){
				// 답변 수정시 공지 체크 없음
				if ($write['wr_reply'])
					$is_notice = false;
				else {
					$notice_checked = "";
					if (in_array((int)$wr_no, $notice_array))
						$notice_checked = "checked";
				}
			}
		}

		$is_html = true;	 // 다이나믹 태그(HTML) 사용
		$is_secret = $board['bo_use_secret'];	// 비밀글 사용 유무
		$is_dhtml_editor = true;	// 에디터 사용

		$is_name = false;
		$is_password = false;
		$is_email = false;
		if (!$member['mb_id'] || ($mode == 'update' && $member['mb_id'] != $write['wr_id'])) {	// 비회원의 경우 작성 항목이 늘어난다.
			$is_name = true;
			$is_password = true;
			$is_email = true;
			$is_homepage = true;
			$wr_name = stripslashes($write['wr_name']);
			$wr_password = $_GET['password'];
		}

		$is_category = false;
		if ($board['bo_use_category']) {	// 분류 사용 유무
			$ca_name = $write['wr_category'];
			$category_option = $category_control->getOption_add('board'," and `p_code` = '".$bo_table."' ", $write['wr_category']);
			$is_category = true;
		}

		// 1:1 비밀글 게시판 이라면 기본적으로 비밀글에 체크
		if($is_secret){
			$secret_checked = "checked";
		} else {
			if ($write['wr_secret'])
				$secret_checked = "checked";
		}

		/*
		$is_link = false;	// 링크 입력 (지금 버전에선 사용안함)
		if ($member['mb_level'] > $board['bo_link_level'])
			$is_link = true;
		*/

		$is_file = false;	// 파일 첨부
		//if($board['bo_use_upload'] && $is_member)	 // 파일 첨부 기능을 사용하고, 회원일때만 (보안상 비회원은 파일첨부 안됨)
		if($board['bo_use_upload'])	
			$is_file = true;

		$is_file_content = false;	// 업로드 이미지 파일에 해당 하는 내용 (지금 버전에선 없다)

		/*
		$is_trackback = false;	// 트랙백 기능 (지금 버전에선 사용안함)
		if ($board[bo_use_trackback] && $member[mb_level] >= $board[bo_trackback_level])
			$is_trackback = true;
		*/

		$is_kcaptcha = false;	// 자동등록방지
		if($is_guest && $env['article_denied']==1 && $mode!='update'){	// 비회원 이고, 관리자가 사용체크 했고, 수정이 아닐때
			$is_kcaptcha = true;
		}

		$is_number = false;	// 임의의 난수
		if($is_guest && $env['article_denied']==2 && $mode!='update'){	// 비회원 이고, 관리자가 사용체크 했고, 수정이 아닐때
			$is_number = true;
			$rand_num = rand(0,9).' '.rand(0,9).' '.rand(0,9).' '.rand(0,9);
			$sess_num = explode(' ',$rand_num);
			$_SESSION['rand_nums'] = $sess_num[0].$sess_num[1].$sess_num[2].$sess_num[3];
		}

		if ($mode == "" || $mode == "insert" || $mode == "reply") {
			if ($mb_id) {	// 회원일땐 정보 추출
				$name = $utility->get_text($utility->cut_str($write['wr_name'],20));
				$email = $mb_email;
				//$homepage = $utility->get_text($member['mb_homepage']);	// 회원별 홈페이지 주소 (확장 업데이트시)
			}
		}

		$upload_max_filesize = number_format($board['bo_upload_size']) . " 바이트";

		$width = $board['bo_table_width'];	// 게시판 가로 사이즈 :: 100 을 기준으로 % 를 구분
		if ($width <= 100) $width .= '%';

		/* 글자수 제한 설정값 (현재버전에선 사용하지 않음) */
		if ($is_admin) {
			$write_min = $write_max = 0;
		} else {
			$write_min = 0;	//(int)$board[bo_write_min];
			$write_max = 0; //(int)$board[bo_write_max];
		}
		/* //글자수 제한 설정값 (현재버전에선 사용하지 않음) */


		/* 가변 파일 ============================================================================= */
		$file_script = "";
		$file_length = -1;
		// 수정의 경우 파일업로드 필드가 가변적으로 늘어나야 하고 삭제 표시도 해주어야 합니다.
		if ($mode == "update"){
			for ($i=0; $i<$file['count']; $i++) {
				$row = $db->query_fetch(" select file_name, file_content from `alice_board_file` where `bo_table` = '".$bo_table."' and `wr_no` = '".$wr_no."' and `file_no` = '".$i."' ");
				if ($row['file_name']) {
					$file_script .= "add_file(\"&nbsp;<input type='checkbox' name='file_no_del[".$i."]' value='1'><a href='".$file[$i]['href']."'>".$file[$i]['source']."(".$file[$i]['size'].")</a> 파일 삭제";
					if ($is_file_content)
						$file_script .= "<br><input type='text' class=ed size=50 name='file_content[".$i."]' value='".addslashes($utility->get_text($row['file_content']))."' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
					$file_script .= "\");\n";
				} else
					$file_script .= "add_file('');\n";
			}
			$file_length = $file['count'] - 1;
		}

		if ($file_length < 0) {
			$file_script .= "add_file('');\n";
			$file_length = 0;
		}
		/* //가변 파일 ============================================================================ */

		$list_href = "./board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table;

		##
		# Call Editor
		echo "<script src='".$alice['editor_path']."/cheditor/cheditor.js'></script>";
		echo $utility->call_cheditor('wr_content', '100%', '300px');

		##
		# Include view
		if(is_file($alice['self'] . 'views/write.html'))
			include_once $alice['self'] . 'views/write.html';
		else
			$config->error_info( $alice['self'] . 'views/write.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>