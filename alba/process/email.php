<?php
		/*
		* /application/alba/process/email.php
		* @author Harimao
		* @since 2013/10/16
		* @last update 2015/02/27
		* @Module v3.5 ( Alice )
		* @Brief :: Alba email
		* @Comment :: 정규직 이메일 전달
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?url=".$urlencode);
			exit;
		}

		$mb_id = $_POST['mb_id'];
		$no = $_POST['no'];				// 공고 no (고유값)
		$send_mail = $_POST['send_mail'];
		$receive_mail = $_POST['receive_mail'];
		$content = $_POST['content'];
		
		$mail_control->mail_sedings('email_alba_employ', $send_mail, $receive_mail, "[".stripslashes($env['site_name'])."] ".$member['mb_name']."님이 보내신 정규직 공고 입니다.", $content, "", "", "", $no, $mb_id);

?>