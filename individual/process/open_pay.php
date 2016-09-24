<?php
		/*
		* /application/individual/process/open_pay.php
		* @author Harimao
		* @since 2014/03/14
		* @last update 2015/03/12
		* @Module v3.5 ( Alice )
		* @Brief :: Individual alba open process
		* @Comment :: 채용공고 열람권 처리프로세스
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?type=individual&url=".$urlencode);
			exit;
		}
		if($mb_type=='company'){	 // 기업회원 접근시
			$utility->popup_msg_js($user_control->_errors('0030'));
			exit;
		}

		$get_pg = $payment_control->get_use_pg(1);

		$vals['pay_no'] = $no;
		$vals['pay_oid'] = $utility->getOrderNumber(10);	 // 주문번호
		$vals['pay_type'] = $_POST['pay_type'];	 // 이력서 열람
		$vals['pay_pg'] = $get_pg['pg_company'];
		$vals['pay_method'] = $_POST['pay_method'];
		$vals['pay_uid'] = $member['mb_id'];
		$vals['pay_name'] = $member['mb_name'];
		$vals['pay_phone'] = ($member['mb_hphone']) ? $member['mb_hphone'] : $member['mb_phone'];
		$vals['pay_email'] = $member['mb_email'];

		$vals['pay_etc_alba'] = $etc_open_price;
		$vals['pay_service'] = $_POST['pay_type'];

		$pay_price = $_POST['pay_price'];					// 본 금액
		$vals['pay_total'] = $pay_price;

		$pay_use_point = $_POST['pay_use_point'];	// 사용 포인트
		
		$use_point = $_POST['use_point'];					// 실제 사용 포인트
		$vals['pay_dc'] = $use_point;

		$total_price = $_POST['total_price'];				// 할인이 적용된 최종 결제 금액
		$vals['pay_price'] = $total_price;	
		$vals['pay_wdate'] = $now_date;	// 결제신청일

		
		$result = $payment_control->insert_payment($vals);

		if(!$result){
			echo "0006";
			exit;
		} else {

			$get_payment = $payment_control->get_payment_for_oid($vals['pay_oid']);

			// 무료일때
			if($get_payment['pay_total']==0){
				$payment_control->success_payment( $vals['pay_oid'] );
				//$utility->popup_msg_js("",$alice['company_path']."/success.php?oid=".$vals['pay_oid']);
			}

			// pay_no / pay_oid / pay_price / pay_method
			echo $no . "/" . $vals['pay_oid'] . "/" . $vals['pay_price'] . "/" . $vals['pay_method'];
		}

?>