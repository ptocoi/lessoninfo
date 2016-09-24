<?php
		/*
		* /application/alba/process/comment.php
		* @author Harimao
		* @since 2013/10/18
		* @last update 2015/02/27
		* @Module v3.5 ( Alice )
		* @Brief :: Alba comment
		* @Comment :: 정규직 댓글
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?url=".$urlencode);
			exit;
		}

		$mode = $_POST['mode'];		// mode
		$no = $_POST['no'];	// 공고 no

		$wr_no = $_POST['wr_no'];
		$comment_id = $_POST['comment_id'];
		$wr_category = $_POST['wr_category'];
		$cwin = $_POST['cwin'];
		$wr_name = $_POST['wr_name'];
		$wr_id = $_POST['wr_id'];
		$wr_password = $_POST['wr_password'];
		$wr_email = $_POST['wr_email'];
		$wr_homepage = $_POST['wr_homepage'];
		$wr_content = $_POST['wr_content'];

		$wr_is_admin = $_POST['wr_is_admin'];	// 관리자 작성 유무

		if(!$is_member && !$is_admin){	// 회원/관리자가 아닐 경우 작성 권한이 없다
			echo $utility->popup_msg_js($comment_control->_errors('0001'));	// 댓글은 회원만 작성 가능합니다.
		}

		switch($mode){

			## 댓글 등록
			case 'insert':
			
				if($_SESSION['comment_datetime'] >= ($alice['server_time'] - 30) && !$is_admin){
					echo $utility->popup_msg_js($comment_control->_errors('0002'));	// 너무 빠른 시간내에 게시물을 연속해서 올릴수 없습니다.
				}
				$utility->set_session("comment_datetime", $alice['server_time']);

				$is_dupplicate = $comment_control->is_dupplicate($mode,$comment_id,$wr_subject,$wr_content);
				if($is_dupplicate){
					echo $utility->popup_msg_js($comment_control->_errors('0003'));	// 동일한 내용을 연속해서 등록할 수 없습니다.
				}

				$get_alba = $alba_user_control->get_alba_no($no);
				if(!$get_alba){
					echo $utility->popup_msg_js($comment_control->_errors('0004'));	// 글이 존재하지 않습니다.\\n\\n글이 삭제되었을수 있습니다.
				}
				/*
				$get_comment = $comment_control->get_comment($wr_no);
				if(!$get_comment){
					echo $utility->popup_msg_js($comment_control->_errors('0004'));	// 글이 존재하지 않습니다.\\n\\n글이 삭제되었을수 있습니다.
				}
				*/

				## 01. 코멘트 포인트 차감 (코멘트 쓰기시 회원 포인트 차감)

				## 02. 코멘트 입력/답변
				if($comment_id){	// 코멘트 답변

					$query = " select wr_no, wr_comment, wr_comment_reply from `".$comment_control->comment_table."` where `wr_no` = '".$comment_id."' ";
					$reply_array = $db->query_fetch($query);

					if(!$reply_array['wr_no']){
						echo $utility->popup_msg_js($comment_control->_errors('0005'));	// 답변할 댓글이 없습니다.\\n\\n답변하는 동안 코멘트가 삭제되었을 수 있습니다.
					}
					
					$tmp_comment = $reply_array['wr_comment'];

					if (strlen($reply_array['wr_comment_reply']) == 5) {
						echo $utility->popup_msg_js($comment_control->_errors('0006'));	// 더 이상 답변하실 수 없습니다.\\n\\n답변은 5단계 까지만 가능합니다.
					}

					$reply_len = strlen($reply_array['wr_comment_reply']) + 1;
					$begin_reply_char = "A";
					$end_reply_char = "Z";
					$reply_number = +1;
					$query = " select MAX(SUBSTRING(wr_comment_reply, ".$reply_len.", 1)) as reply from `".$comment_control->comment_table."`  where wr_parent = '".$wr_no."' and wr_comment = '".$tmp_comment."' and SUBSTRING(wr_comment_reply, ".$reply_len.", 1) <> '' ";

					if ($reply_array['wr_comment_reply']) 
						$query .= " and wr_comment_reply like '".$reply_array['wr_comment_reply']."%' ";

					$row = $db->query_fetch($query);

					if (!$row['reply'])
						$reply_char = $begin_reply_char;
					else if ($row['reply'] == $end_reply_char) // A~Z은 26 입니다.
						echo $utility->popup_msg_js($comment_control->_errors('0007'));	// 더 이상 답변하실 수 없습니다.\\n\\n답변은 26개 까지만 가능합니다.
					else
						$reply_char = chr(ord($row['reply']) + $reply_number);

					$tmp_comment_reply = $reply_array['wr_comment_reply'] . $reply_char;

				} else {

					$query = " select max(wr_comment) as max_comment from `".$comment_control->comment_table."`  where `wr_parent` = '".$wr_no."' and `wr_is_comment` = 1 ";
					$row = $db->query_fetch($query);

					$row['max_comment'] += 1;
					$tmp_comment = $row['max_comment'];
					$tmp_comment_reply = "";

				}

				$vals['wr_category'] = $wr_category;
				$vals['wr_num'] = $no;
				$vals['wr_parent'] = $comment_id;
				$vals['wr_is_comment'] = 1;
				$vals['wr_comment'] = $tmp_comment;
				$vals['wr_comment_reply'] = $tmp_comment_reply;
				$vals['wr_subject'] = $wr_subject;
				$vals['wr_content'] = $wr_content;
				$vals['wr_id'] = $wr_id;
				$vals['wr_password'] = $wr_password;
				$vals['wr_name'] = $wr_name;
				$vals['wr_email'] = $wr_email;
				$vals['wr_homepage'] = $wr_homepage;
				$vals['wr_datetime'] = $alice['time_ymdhis'];
				$vals['wr_ip'] = $_SERVER['REMOTE_ADDR'];

				$result = $comment_control->comment_insert($vals);

				$comment_id = $db->last_id();

				## 03. 공고에 코멘트수 증가 

				## 04. 코멘트 작성 포인트 부여


				//echo $result;
				if($result){
					$utility->popup_msg_js("","../alba_detail.php?no=".$no."&cwin=#c_".$comment_id);
				}

			break;

			## 댓글 수정
			case 'update':

				$comment = $reply_array = $comment_control->get_comment($comment_id);
				$tmp_comment = $reply_array['wr_comment'];

				$len = strlen($reply_array['wr_comment_reply']);
				if ($len < 0) $len = 0; 
				$comment_reply = substr($reply_array['wr_comment_reply'], 0, $len);

				if($is_admin){	// 관리자 일때
					;
				} else {
					$get_member = $user_control->get_member($comment['wr_id']);
					if($get_member['mb_id'] != $comment['wr_id']) {
						echo $utility->popup_msg_js($comment_control->_errors('0008'));	// 자신의 글이 아니므로 수정할 수 없습니다.
					}
				}

				$query = " select count(*) as cnt from `".$comment_control->comment_table."` where `wr_comment_reply` like '".$comment_reply."%' and wr_id <> '".$comment_id."' and wr_parent = '".$wr_id."' and wr_comment = '".$tmp_comment."' and wr_is_comment = 1 ";

			    $row = $db->query_fetch($query);

				if ($row['cnt'] && !$is_admin) {
					echo $utility->popup_msg_js($comment_control->_errors('0009'));	// 이 코멘트와 관련된 답변코멘트가 존재하므로 수정 할 수 없습니다.
				}

				$vals['wr_subject'] = $wr_subject;
				$vals['wr_content'] = $wr_content;
				if(!$is_admin) {
					$vals['wr_ip'] = $_SERVER['REMOTE_ADDR'];
				}

				$result = $comment_control->comment_update($vals,$comment_id);

				//echo $result;

				if($result){
					$utility->popup_msg_js("","../alba_detail.php?no=".$no."&cwin=#c_".$comment_id);
				}

			break;

			## 댓글 삭제
			case 'delete':
			
				$result = $comment_control->comment_delete($wr_no);

				echo $result;

			break;

		}	// switch end.

?>