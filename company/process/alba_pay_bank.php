<?php
		/*
		* /application/company/process/alba_pay_bank.php
		* @author Harimao
		* @since 2013/10/04
		* @last update 2015/03/25
		* @Module v3.5 ( Alice )
		* @Brief :: Alba Pay Bank process
		* @Comment :: 알바 결제 무통장입금 처리프로세스
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

		$get_pg = $payment_control->get_use_pg(1);

		$pay_no = $_POST['pay_no'];	// payment table no
		if($_POST['oid'])	 // 아 왜 oid 가 모듈별로 다르냐고~
			$oid = $_POST['oid'];
		else if($_POST['OrdNo'])
			$oid = $_POST['OrdNo'];
		else if($_POST['ordr_idxx'])
			$oid = $_POST['ordr_idxx'];

		$get_bank = $bank_control->get_bank($_POST['bank']);

		$bank_name = $_POST['bank_name'];
		$vals['pay_bank'] = $get_bank['bank_name'] . "/" . $get_bank['bank_num'] . "/" . $get_bank['name'];
		$vals['pay_bank_name'] = $bank_name;

		$tax_use = $_POST['tax_use'];

		if($tax_use){		
			$pay_tax_type = $_POST['pay_tax_type'];
			$pay_tax_num_type = $_POST['pay_tax_num_type'];

			$vals['pay_tax_name'] = $bank_name;
			$vals['pay_tax_type'] = $pay_tax_type;
			$vals['pay_tax_num_type'] = $pay_tax_num_type;

			if($pay_tax_type=='1'){	 // 소득공제용
				$vals['pay_tax_num'] = $_POST['pay_tax_num_person'];
			} else if($pay_tax_type=='2') {	// 지출증빙용
				$vals['pay_tax_num'] = implode($_POST['pay_tax_num_biz'],'/');
			}

			$vals['pay_tax_wdate'] = $now_date;
		}

		$get_payment = $payment_control->get_payment_for_oid($oid);

		$result = $payment_control->update_payment_for_oid($vals,$oid);

		$package_no = $_POST['package_no'];
		if($package_no){

			$package_vals['pay_bank'] = $vals['pay_wdate'];
			$package_vals['pay_bank_name'] = $vals['pay_bank_name'];
			$package_vals['pay_tax_name'] = $vals['pay_tax_name'];
			$package_vals['pay_tax_type'] = $vals['pay_tax_type'];
			$package_vals['pay_tax_num_type'] = $vals['pay_tax_num_type'];
			$package_vals['pay_tax_num'] = $vals['pay_tax_num'];
			$package_vals['pay_tax_wdate'] = $vals['pay_tax_wdate'];

			$payment_control->update_payment_for_oid($vals,$oid," and `pay_package` = ".$package_no." ");

		}

		if($result){
			
			$get_payment = $payment_control->get_payment_for_oid($oid);

			// 무료일때
			if($get_payment['pay_total']==0){
				$payment_control->success_payment( $oid );
			} else {

				## 무통장 입금 문자 전송
				$get_member = $member_control->get_member($get_payment['pay_uid']);
				//$mb_receive = explode(",",$get_member['mb_receive']);	// 수신여부 무관
				//if(@in_array('sms',$mb_receive)){	 // 문자 수신 확인
					$sms_control->send_sms_user('pay_online_request', $get_member, "", $get_payment);
				//}

			}

			$utility->popup_msg_js("",$alice['company_path']."/success.php?oid=".$oid);
		}

		//echo $result;

?>