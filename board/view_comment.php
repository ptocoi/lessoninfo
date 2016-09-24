<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 
	/*
	* /application/board/view_comment.php
	* @author Harimao
	* @since 2013/10/29
	* @last update 2013/10/29
	* @Module v3.5 ( Alice )
	* @Brief :: Board comment
	* @Comment :: 코멘트(댓글)
	*/

	// 자동등록방지
	include_once ("./norobot.inc.php");


	// 코멘트를 새창으로 여는 경우 세션값이 없으므로 생성한다.
	if ($is_admin && !$token) {
		$utility->set_session("ss_delete_token", $token);
	}

	/* 댓글 권한 확인 */
	$is_comment_write = false;
	if($member['mb_level'] >= $board['bo_comment_level']){
		$is_comment_write = true;
	}
	$is_comment_write = ($board['bo_use_comment']) ? true : false; // 댓글 기능 사용 유무 확인
	/* //댓글 권한 확인 */

	$list = array();


	// 코멘트 출력
	$query = " select * from `".$write_table."` where `wr_parent` = '".$wr_no."' and `wr_is_comment` = 1 order by `wr_comment`, `wr_comment_reply` ";
	$result = $db->query_fetch_rows($query);
	$i = 0;
	foreach($result as $row) {

		$list[$i] = $row;

		$tmp_name = $utility->get_text($utility->cut_str($row['wr_name'], $board['bo_cut_name'] * 2)); // 설정된 자리수 만큼만 이름 출력 (UTF-8로 계산하기 때문에 X 2)
		/* 이 기능은 현재 버전에선 없다.
		if ($board['bo_use_sideview'])	 // 사이드뷰
			$list[$i]['name'] = $board_control->get_sideview($row['wr_id'], $tmp_name, $row['wr_email'], $row['wr_homepage']);
		else*/
			$list[$i]['name'] = "<span class='".(($row['wr_id']=='guest')?'guest':'member')."'>".$tmp_name."</span>";
		
		$list[$i]['wr_id'] = $row['wr_id'];

		// 공백없이 연속 입력한 문자 자르기 (way 보드 참고. way.co.kr)
		$list[$i]['content'] = $list[$i]['content1']= "비밀글 입니다.";
		if (!$row['wr_secret'] || $is_admin || ($write['wr_id']==$member['mb_id'] && $member['mb_id']) || ($row['wr_id']==$member['mb_id'] && $member['mb_id']) ) {
			$list[$i]['content1'] = $row['wr_content'];
			$list[$i]['content'] = $utility->conv_content($row['wr_content'], 0, 'wr_content');
			$list[$i]['content'] = $utility->search_font($search_keyword, $list[$i]['content']);
		}

		//$list[$i]['trackback'] = $utility->url_auto_link($row['wr_trackback']);
		//$list[$i]['datetime'] = substr($row['wr_datetime'],2,14);

		// 당일인 경우 시간으로 표시함
		$list[$i]['datetime'] = substr($row['wr_datetime'],2,14);
		$list[$i]['datetime2'] = $row['wr_datetime'];
		
		if($list[$i]['datetime'] == date("Y-m-d", $alice['server_time'])) {
			$list[$i]['datetime2'] = substr($row['datetime2'],11,5);
		} else {
			$list[$i]['datetime2'] = substr($row['wr_datetime'],0,10);
		}

		$list[$i]['ip'] = $row['wr_ip'];
		/*
		if (!$is_admin)	// 관리자가 아니라면 중간 IP 주소를 감춘후 보여줍니다.
			$list[$i][ip] = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", "\\1.♡.\\3.\\4", $row[wr_ip]);
		*/

		$list[$i]['is_reply'] = false;
		$list[$i]['is_edit'] = false;
		$list[$i]['is_del']  = false;
		
		if ($is_comment_write || $is_admin) {
			if ($member['mb_id']) {	// 회원
				if($row['wr_id'] == $member['mb_id'] || $is_admin){
					$del_links = "./delete_comment.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$wr_no."&comment_id=".$row['wr_no']."&token=".$token."&cwin=".$cwin."&page=".$page;
					if ($row['wr_id'] == $member['mb_id']) {
						$list[$i]['del_link']  = $del_links;
						$list[$i]['is_edit']   = true;
						$list[$i]['is_del']    = true;
					}
				}
			} else {	 // 비회원
				if(!$row['mb_id']){
					$del_links = "./password.php?mode=comment_delete&board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$wr_no."&comment_id=".$row['wr_no']."&cwin=".$cwin."&page=".$page;
					$list[$i]['del_link'] = $del_links;
					$list[$i]['is_del']   = true;
				}
			}

			if (strlen($row['wr_comment_reply']) < 5)
				$list[$i]['is_reply'] = true;
		}

		// 05.05.22
		// 답변있는 코멘트는 수정, 삭제 불가
		if ($i > 0 && !$is_admin){
			if ($row['wr_comment_reply']) {
				$tmp_comment_reply = substr($row['wr_comment_reply'], 0, strlen($row['wr_comment_reply']) - 1);
				if ($tmp_comment_reply == $list[$i-1]['wr_comment_reply']){
					$list[$i-1]['is_edit'] = false;
					$list[$i-1]['is_del'] = false;
				}
			}
		}

	$i++;
	}	// foreach end.


	//  코멘트수 제한 설정값
	if ($is_admin){
		$comment_min = $comment_max = 0;
	} else {
		$comment_min = 0;	// (int)$board['bo_comment_min'];
		$comment_max = 0;	// (int)$board['bo_comment_max'];
	}

	$list_cnt = count($list);


	##
	# Include view
	if(is_file($alice['self'] . 'skins/'.$board['bo_skin'].'/view_comment.skin.php'))
		include_once $alice['self'] . 'skins/'.$board['bo_skin'].'/view_comment.skin.php';
	else
		$config->error_info( $alice['self'] . 'skins/'.$board['bo_skin'].'/view_comment.skin.php' );

?>
