<?php
		/*
		* /application/member/process/login.php
		* @author Harimao
		* @since 2013/07/10
		* @last update 2015/03/30
		* @Module v3.5 ( Alice )
		* @Brief :: Member login
		* @Comment :: 회원 로그인
		* @Comment :: [2014/01/21] 기업회원 로그인시 대표 기업정보 자동선택 업데이트
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		$url = urldecode($_POST['url']);
		$mb_type = $_POST['mb_type'];
		$login_id = trim(strip_tags(mysql_escape_string($_POST['login_id'])));
		$login_passwd = trim(strip_tags(mysql_escape_string($_POST['login_passwd'])));
		$save_id = $_POST['save_id'];

		$adult_certify = $_POST['adult_certify'];	// 성인인증에서 넘어왔다면

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

		// 삭제회원 검사
		if($member['is_delete']){
			$utility->popup_msg_js($user_control->_errors('0045'));
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

			// 아이디 저장
			if($save_id)
				$utility->set_cookie('ack_mb_id', $member['mb_id'], 86400 * 31);
			else
				$utility->set_cookie('ack_mb_id', "", 86400 * 31);

			if($key && $member['mb_id'] ){	// 로그인 성공

				if($member['mb_type']=='company'){	 // 기업 회원일때만
					$company_member = $member_control->get_company_member($member['mb_id']," and `etc_0` = 1 ");
					if(!$company_member){	 // 대표 기업정보가 없는 경우
						$company_list = $member_control->__CompanyList("",""," where `mb_id` = '".$member['mb_id']."' ");
						$mb_vals['etc_0'] = 1;
						$member_control->update_company_memberNo($mb_vals,$company_list['result'][0]['no']);
					}
				}
				
				if($env['login_return']==1){	// 메인페이지

					//$utility->location_href($alice['url']);
					$utility->location_href('/');

				} else if($env['login_return']==2){	// 지정페이지

					$utility->location_href($env['login_return_page']);

				} else {	// 로그인전 페이지

					if($url)	// url 로 이동
						$utility->location_href($url);
					else	// 메인으로 이동
						$utility->location_href($alice['url']);

				}

			} else {	// 로그인 실패
				$utility->popup_msg_js($user_control->_errors('0023'));
				exit;
			}

		} else {	 // user_login 함수 작동 실패시

			$utility->popup_msg_js($user_control->_errors('0024'));
			exit;

		}

?>