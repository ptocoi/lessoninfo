<?php
		/*
		* /application/company/process/open.php
		* @author Harimao
		* @since 2013/10/11
		* @last update 2015/03/05
		* @Module v3.5 ( Alice )
		* @Brief :: Alba open service
		* @Comment :: 열람인재정보 / 스크랩 처리
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?url=".$urlencode);
			exit;
		}

		$mode = $_POST['mode'];
		$no = $_POST['no'];

		switch($mode){

			## 열람한 알바 이력서 삭제
			case 'sel_resume_delete':

				$no_cnt = count($no);
				for($i=0;$i<$no_cnt;$i++){
					$result = $alba_company_control->open_delete($no[$i]);
				}

				echo $result;

			break;

			## 열람한 알바 이력서 스크랩
			case 'sel_resume_scrap':

				print_r($_POST);

				$no_cnt = count($no);
				for($i=0;$i<$no_cnt;$i++){

					$get_resume = $alba_resume_user_control->get_resume_no($no[$i]);

					$result = $alba_user_control->scrap_insert($mb_id, $get_resume['wr_subject'], "alba_resume", $no[$i], $alice['time_ymd']);

				}

				echo $result;

			break;

			## 스크랩한 인재정보 삭제
			case 'sel_scrap_delete':

				$no_cnt = count($no);
				for($i=0;$i<$no_cnt;$i++){

					$result = $alba_user_control->scrap_delete($no[$i]);

				}

				echo $result;

			break;
		}

?>