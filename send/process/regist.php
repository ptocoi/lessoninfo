<?php
		/*
		* /application/send/process/regist.php
		* @author Harimao
		* @since 2015/03/16
		* @last update 2015/03/16
		* @Module v3.5 ( Alice )
		* @Brief :: Memo regist
		* @Comment :: 쪽지 처리 프로세스
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$type = $_POST['type'];

		$wr_recv_mb_id = $_POST['wr_recv_mb_id'];
		$wr_send_mb_id = $_POST['wr_send_mb_id'];
		$wr_employ_no = $_POST['wr_employ_no'];
		$wr_resume_no = $_POST['wr_resume_no'];
		$wr_memo = $_POST['wr_memo'];

		switch($mode){

			## 쪽지 발송
			case 'send':

				$vals['wr_recv_mb_id'] = $wr_recv_mb_id;
				$vals['wr_send_mb_id'] = $wr_send_mb_id;
				$vals['wr_employ_no'] = $wr_employ_no;
				$vals['wr_resume_no'] = $wr_resume_no;
				$vals['wr_send_datetime'] = $alice['time_ymdhis'];
				$vals['wr_memo'] = $wr_memo;

				$vals['wr_wdate'] = $alice['time_ymdhis'];

				$result = $memo_control->insert_memo($vals);

				if($result){
					echo "0002";	// 쪽지가 발송되었습니다.
				} else {
					echo "0003";	// 쪽지 발송중 오류가 발생하였습니다.\\n\\n사이트 운영자에게 문의하세요.
				}

			break;

			## 쪽지 삭제
			case 'delete':

				// 삭제 처리
				$vals['wr_is_delete'] = 1;
				$vals['wr_wdate'] = $alice['time_ymdhis'];

				$result = $memo_control->update_memo($vals,$no);

				if($result){
					echo "0003";	// 쪽지 삭제가 완료 되었습니다.
				} else {
					echo "0004";	// 쪽지 삭제중 오류가 발생하였습니다.\\n\\n사이트 운영자에게 문의하세요.
				}

			break;

			## 쪽지 답장
			case 'reply':
				
				$vals['wr_recv_mb_id'] = $wr_recv_mb_id;
				$vals['wr_send_mb_id'] = $wr_send_mb_id;
				$vals['wr_employ_no'] = $wr_employ_no;
				$vals['wr_resume_no'] = $wr_resume_no;
				$vals['wr_send_datetime'] = $alice['time_ymdhis'];
				$vals['wr_memo'] = $wr_memo;

				$vals['wr_wdate'] = $alice['time_ymdhis'];

				$result = $memo_control->insert_memo($vals);

				if($result){
					echo "0002";	// 쪽지가 발송되었습니다.
				} else {
					echo "0003";	// 쪽지 발송중 오류가 발생하였습니다.\\n\\n사이트 운영자에게 문의하세요.
				}

			break;
		}


?>