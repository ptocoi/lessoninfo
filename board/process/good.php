<?php
		/*
		* /application/board/process/good.php
		* @author Harimao
		* @since 2013/10/28
		* @last update 2015/03/09
		* @Module v3.5 ( Alice )
		* @Brief :: Board Good
		* @Comment :: 게시글 추천
		*/
		
		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		$ajax = $_POST['ajax'];

		$board_code = $_POST['board_code'];
		$code = $_POST['code'];
		$bo_table = $_POST['bo_table'];
		$wr_no = $_POST['wr_no'];
		
		$good = $_POST['good'];
		
		if(!$is_member){
			
			$href = $alice['member_path']."/login.php?url=".urlencode("../board/board.php?board_code=".$board_code."&code=".$code."&bo_table=".$bo_table."&wr_no=".$wr_no);

			if($ajax)
				$result = '0046';	 // 회원만 추천 가능합니다.
			else
				$utility->popup_msg_js($board_control->_errors('0046'));

		}

		if (!($bo_table && $wr_no)) {

			if($ajax)
				$result = '0047';	 // 값이 제대로 넘어오지 않았습니다.
			else
				$utility->popup_msg_js($board_control->_errors('0047'));

		}

		$ss_name = "ss_view_".$bo_table."_".$wr_no;
		if (!$_SESSION[$ss_name]) {

			if($ajax)
				$result = '0048';	 // 해당 게시물에서만 추천 또는 비추천 하실 수 있습니다.
			else
				$utility->popup_msg_js($board_control->_errors('0048'));

		}

		$row = $db->query_fetch(" select count(*) as cnt from ".$alice['write_prefix'].$bo_table);
		if (!$row['cnt']) {

			if($ajax)
				$result = '0049';	 // 게시판이 존재하지 않습니다.
			else
				$utility->popup_msg_js($board_control->_errors('0049'));

		}

		if ($good == "good" || $good == "nogood") {

			if($write['wr_id'] == $member['mb_id']) {

				if($ajax)
					$result = '0050';	 // 자신의 글에는 추천 또는 비추천 하실 수 없습니다.
				else
					$utility->popup_msg_js($board_control->_errors('0050'));

			}

			if (!$board['bo_use_good'] && $good == "good") {

				if($ajax)
					$result = '0051';	 // 이 게시판은 추천 기능을 사용하지 않습니다.
				else
					$utility->popup_msg_js($board_control->_errors('0051'));

			}

			if (!$board[bo_use_nogood] && $good == "nogood") {
				
				if($ajax)
					$result = '0052';	 // 이 게시판은 비추천 기능을 사용하지 않습니다.
				else
					$utility->popup_msg_js($board_control->_errors('0052'));

			}

			$sql = " select `bg_flag` from `".$board_control->good_table."` where `bo_table` = '".$bo_table."' and `wr_no` = '".$wr_no."' and `wr_id` = '".$member['mb_id']."' and `bg_flag` in ('good', 'nogood') ";
			$row = $db->query_fetch($sql);
			
			if ($row['bg_flag']){

				if ($row['bg_flag'] == "good")
					$status = "추천";
				else 
					$status = "비추천";
				
				if($ajax)
					$result = "이미 ".$status." 하신 글 입니다.";
				else
					$utility->popup_msg_js("이미 ".$status." 하신 글 입니다.");

			} else {
				
				// 추천(찬성), 비추천(반대) 카운트 증가
				$db->_query(" update ".$alice['write_prefix'].$bo_table." set `wr_".$good."` = `wr_".$good."` + 1 where `wr_no` = '".$wr_no."' ");

				// 내역 생성
				$db->_query(" insert `".$board_control->good_table."` set `bo_table` = '".$bo_table."', `wr_no` = '".$wr_no."', `wr_id` = '".$member['mb_id']."', `bg_flag` = '".$good."', `bg_datetime` = '".$alice['time_ymdhis']."' ");
				
				if ($good == "good") 
					$status = "추천";
				else 
					$status = "비추천";

				if($ajax)
					$result = "이 글을 ".$status." 하셨습니다.";
				else
					$utility->popup_msg_js("이 글을 ".$status." 하셨습니다.");

			}

		}


		echo $result;

?>