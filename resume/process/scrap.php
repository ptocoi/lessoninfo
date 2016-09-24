<?php
		/*
		* /application/resume/process/scrap.php
		* @author Harimao
		* @since 2013/10/08
		* @last update 2015/06/18
		* @Module v3.5 ( Alice )
		* @Brief :: Alba Resume scrap
		* @Comment :: 알바 이력서 스크랩
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?url=".$urlencode);
			exit;
		}

		$mb_id = $_POST['mb_id'];	// 스크랩 하는 사람 mb_id
		$no = $_POST['no'];				// 공고 no (고유값)

		$get_resume = $alba_resume_user_control->get_resume_no($no);

		$result = $alba_user_control->scrap_insert($mb_id, $get_resume['wr_subject'], "alba_resume", $no, $alice['time_ymd']);

		echo $result;

?>