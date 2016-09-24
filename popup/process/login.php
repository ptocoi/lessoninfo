<?php
		/*
		* /application/popup/process/login.php
		* @author Harimao
		* @since 2013/08/27
		* @last update 2015/03/12
		* @Module v3.5 ( Alice )
		* @Brief :: Pop Member login
		* @Comment :: 팝업 회원 로그인
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		$url = urldecode($_POST['url']);
		$mb_type = $_POST['mb_type'];
		$login_id = trim(strip_tags(mysql_escape_string($_POST['login_id'])));
		$login_passwd = trim(strip_tags(mysql_escape_string($_POST['login_passwd'])));

		$member = $user_control->get_member($login_id);	// 회원 정보 추출

		// 이미 로그인한 회원이 접근했다면
		if($is_member){
			$utility->popup_msg_js($user_control->_errors('0016'));
			exit;
		}

		// 아이디 입력 검사
		if(!$login_id){
			$utility->popup_msg_js($user_control->_errors('0005'));
			exit;
		}
		// 패스워드 입력 검사
		if(!$login_passwd){
			$utility->popup_msg_js($user_control->_errors('0008'));
			exit;
		}

		// 불량회원 검사
		if($member['mb_badness']){	// 불량 회원일 경우
			$utility->popup_msg_js($user_control->_errors('0020'));
			exit;
		}
		// 차단회원 검사
		if($member['mb_denied']){	// 차단 회원일 경우
			$utility->popup_msg_js($user_control->_errors('0025'));
			exit;
		}
		// 탈퇴요청 회원 검사
		if($member['mb_left_request']){
			$utility->popup_msg_js($user_control->_errors('0021'));
			exit;
		}
		// 탈퇴회원 검사
		if($member['mb_left']){
			$utility->popup_msg_js($user_control->_errors('0022'));
			exit;
		}
		
		// 회원 로그인
		$user_login = $user_control->user_login($mb_type, $login_id, $login_passwd);

		if($user_login){

			// 세션 발급
			$key = $user_control->user_session( $member['mb_id'], $member['mb_type'] );

			if($key && $member['mb_id'] ){	// 로그인 성공
				
				$utility->popup_close_replace();

			} else {	// 로그인 실패
				$utility->popup_msg_js($user_control->_errors('0023'));
				exit;
			}

		} else {	 // user_login 함수 작동 실패시

			$utility->popup_msg_js($user_control->_errors('0024'));
			exit;

		}

?>