<?php
		/*
		* /application/alba/process/sms.php
		* @author Harimao
		* @since 2013/10/18
		* @last update 2015/04/08
		* @Module v3.5 ( Alice )
		* @Brief :: Alba SMS
		* @Comment :: 정규직 문자 보내기
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?url=".$urlencode);
			exit;
		}

		$wr_person = $_POST['wr_person'];
		$wr_receive = $_POST['wr_receive'];

		$msg = $_POST['send_msg'];
		$rphone = $_POST['rphone'];
		$sphone = $_POST['sphone'];
		$destination = $rphone . "|" . $wr_person;

		//$result = $sms_control->netfu_sms_Send( $msg, $rphone, $sphone, $destination );
		$data = array( "wr_id" => $member['mb_id'], "wr_receive" => $wr_receive, "msg" => $msg, "rphone" => $rphone, "sphone" => $sphone, "destination" => $destination, "wr_person" => $wr_person );

		$result = $sms_control->sms_seding($data);

		if($result['result']=='success'){
			$result['msg'] = $sms_control->_success($result['msg']);	// 성공적으로 SMS 문자를 발송하였습니다.
		} else {
			$result['msg'] = $sms_control->_errors($result['msg']);	// SMS 발송중 오류가 발생하였습니다.
		}

		echo $result['result'] . "/" . $result['msg'];
?>