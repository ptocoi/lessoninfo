<?php
		/*
		* /application/board/process/delete_comment.php
		* @author Harimao
		* @since 2013/10/29
		* @last update 2015/03/09
		* @Module v3.5 ( Alice )
		* @Brief :: Board comment delete
		* @Comment :: 게시글 댓글 삭제
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		$ajax = $_POST['ajax'];
		$token = $_POST['token'];

		$result = "";

		if ($is_admin){

			if (!($token && $_SESSION['ss_delete_token'] == $token)) {

				if($ajax==true) {	// 토큰 에러로 삭제 불가합니다.
					echo $board_control->_errors('0039');
					exit;
				} else
					$utility->popup_msg_js($board_control->_errors('0039'));

			}

		}

		$write = $db->query_fetch(" select * from `".$write_table."` where `wr_no` = '".$comment_id."' ");

		if (!$write['wr_no'] || !$write['wr_is_comment']){

			if($ajax==true) {	// 등록된 코멘트가 없거나 코멘트 글이 아닙니다.
				echo $board_control->_errors('0060');
				exit;
			} else
				$utility->popup_msg_js($board_control->_errors('0060'));

		}

		if($is_member){
			
			if($member['mb_id'] != $write['wr_id']){

				if($ajax==true){	// 자신의 글이 아니므로 수정할수 없습니다.
					echo $board_control->_errors('0036');
					exit;
				} else
					$utility->popup_msg_js($board_control->_errors('0036'));

			}

		} else {

			if(md5($wr_password) != $write['wr_password']){

				if($ajax==true){	// 패스워드가 틀립니다.
					echo $board_control->_errors('0061');
					exit;
				} else
					$utility->popup_msg_js($board_control->_errors('0061'));

			}

		}

		$len = strlen($write['wr_comment_reply']);
		if ($len < 0) $len = 0; 
		$comment_reply = substr($write['wr_comment_reply'], 0, $len);

		$sql = " select count(*) as cnt from `".$write_table."` where `wr_comment_reply` like '".$comment_reply."%' and wr_id <> '".$comment_id."' and `wr_parent` = '".$write['wr_parent']."' and `wr_comment` = '".$write['wr_comment']."' and `wr_is_comment` = 1 ";
		$row = $db->query_fetch($sql);
		if ($row['cnt'] && !$is_admin)
			$utility->popup_msg_js($board_control->_errors('0058'));	// 이 코멘트와 관련된 답변코멘트가 존재하므로 삭제 할 수 없습니다.

		// 코멘트 삭제
		if (!$point_control->point_delete($write['wr_id'], $bo_table, $comment_id, '코멘트'))
			$point_control->point_insert($write['wr_id'], $board['bo_comment_point'] * (-1), $board['bo_subject']." ". $write['wr_parent']."-".$comment_id." 코멘트삭제");

		// 코멘트 삭제
		$db->_query(" delete from `".$write_table."` where `wr_no` = '".$comment_id."' ");

		// 코멘트가 삭제되므로 해당 게시물에 대한 최근 시간을 다시 얻는다.
		$sql = " select max(wr_datetime) as wr_last from `".$write_table."` where `wr_parent` = '".$write['wr_parent']."' ";
		$row = $db->query_fetch($sql);
											  
		// 원글의 코멘트 숫자를 감소
		$db->_query(" update `".$write_table."` set `wr_comment` = `wr_comment` - 1, `wr_last` = '".$row['wr_last']."' where `wr_no` = '".$write['wr_parent']."' ");

		// 코멘트 숫자 감소
		$db->_query(" update `".$alice['table_prefix']."board` set `bo_comment_count` = `bo_comment_count` - 1 where `bo_table` = '".$bo_table."' ");

		// 새글 삭제
		$db->_query(" delete from `".$alice['table_prefix']."board_new` where `bo_table` = '".$bo_table."' and `wr_no` = '".$comment_id."' ");


		echo $result;

?>