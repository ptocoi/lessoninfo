<?php
		/*
		* /application/company/process/alba_pay_open.php
		* @author Harimao
		* @since 2013/11/01
		* @last update 2015/03/05
		* @Module v3.5 ( Alice )
		* @Brief :: Company resume open process
		* @Comment :: 이력서 열람권 처리프로세스
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?type=company&url=".$urlencode);
			exit;
		}
		if($mb_type=='individual'){	 // 개인회원 접근시
			$utility->popup_msg_js($user_control->_errors('0031'));
			exit;
		}

		print_R($_POST);
?>