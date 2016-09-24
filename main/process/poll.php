<?php
		/*
		* /application/main/process/poll.php
		* @author Harimao
		* @since 2013/10/31
		* @last update 2013/10/31
		* @Module v3.5 ( Alice )
		* @Brief :: Poll regist
		* @Comment :: 설문조사 투표하기
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		$no = $_POST['no'];	// 설문조사 no
		$mode = $_POST['mode'];
		$answer = $_POST['answer'];	// 답변 값

		$get_poll = $poll_control->get_poll($no);	 // 설문조사 내용 추출


		switch($mode){
			## 설문조사 응담
			case 'poll_insert':

				if($get_poll['poll_member']){	// 투표자 :: 회원만 가능
					if(!$is_member){	// 회원이 아닌경우
						echo '0085';	// 회원만 투표 가능합니다.
						exit;
					}
				}

				if(!$get_poll['poll_overlap']){	// 중복 투표 불가
					$get_cookie = $utility->get_cookie('pollRegist_'.$no);
					if($get_cookie==$_SERVER['REMOTE_ADDR']){
						echo '0086';	// 이미 투표하셨습니다.
						exit;
					}
				}

				$poll_answer = explode('|&|',$get_poll['poll_answer']);
				$poll_answer_cnt = count($poll_answer);

				$answer_arr = array();
				for($i=0;$i<$poll_answer_cnt;$i++){
					$answer_arr[$i] = ($i==$answer) ? $poll_answer[$i] + 1 : $poll_answer[$i];
				}

				$vals['poll_answer'] = @implode('|&|',$answer_arr);

				$result = $poll_control->update_poll($vals,$no);

				if($result){	 // 투표가 완료 되었다면 쿠키로 투표 내용을 저장한다.
					$utility->set_cookie('pollRegist_'.$no, $_SERVER['REMOTE_ADDR'], 86400);
					echo $result;
				}

			break;

			## 설문조사 코멘트 입력
			case 'poll_insertComment':

				$result['mode'] = $mode;

				$vals['p_no'] = $no;

				if(!$is_member){	// 회원이 아닌경우
					echo '0089';	// 회원만 작성 가능합니다.
					exit;
				}

				$vals['content'] = $_POST['content'];

				$vals['mb_id'] = $_POST['mb_id'];
				$mb = $member_control->get_member($vals['mb_id']);
				$vals['mb_name'] = $mb['mb_name'];
				$vals['mb_nick'] = $mb['mb_nick'];
				$vals['wdate'] = $now_date;

				$result['result'] = $poll_control->insert_pollComment($vals);

				echo @implode('/',$result);

			break;

			## 설문조사 코멘트 삭제
			case 'poll_deleteComment':

				$get_pollComment = $poll_control->get_pollComment($no);

				$result['mode'] = $mode;

				$result['result'] = $poll_control->delete_pollComment($no);

				$result['p_no'] = $get_pollComment['p_no'];

				$result['page'] = $_POST['page'];

				echo @implode('/',$result);

			break;
		}
	

?>