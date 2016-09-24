<?php
		/*
		* /application/popup/process/email.php
		* @author Harimao
		* @since 2013/07/26
		* @last update 2015/03/12
		* @Module v3.5 ( Alice )
		* @Brief :: Email process
		* @Comment :: 이메일 처리 프로세스
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			echo $user_control->_errors('0015');
			exit;
		}

		$mode = $_POST['mode'];
		$mb_id = ($_POST['mb_id']) ? $_POST['mb_id'] : "guest";

		$no = $_POST['no'];

		$get_member = $member_control->get_member($mb_id);	// 회원 정보

		switch($mode){

			## 이력서 이메일 전달
			case 'alba_resume':

				$mb_email = $get_member['mb_email'];
				$send_name = $get_member['mb_name'];
				$receive_email = $_POST['receive_email'];
				$email_subject = $_POST['email_subject'];
				$email_content = $_POST['email_content'];

				$mail_control->Send_Mail($mb_id, 'email_alba_resume', $mb_email, $receive_email, $send_name, $email_subject, $email_content, $no);

			break;

		}
?>