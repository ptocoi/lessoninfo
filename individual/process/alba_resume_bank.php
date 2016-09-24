<?php
		/*
		* /application/company/process/alba_resume_bank.php
		* @author Harimao
		* @since 2013/10/04
		* @last update 2015/04/02
		* @Module v3.5 ( Alice )
		* @Brief :: Alba Resume Bank process
		* @Comment :: 정규직 이력서 결제 무통장입금 처리프로세스
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?type=company&url=".$urlencode);
			exit;
		}
		if($mb_type=='company'){	 // 기업회원 접근시
			$utility->popup_msg_js($user_control->_errors('0030'));
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

		if($result){

			// 무료일때
			if($get_payment['pay_total']==0){
				$payment_control->success_payment( $oid );
			}

			$utility->popup_msg_js("",$alice['individual_path']."/success.php?oid=".$oid);
		}

?>