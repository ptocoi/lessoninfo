<?php
		/*
		* /application/service/process/direct.php
		* @author Harimao
		* @since 2015/03/12
		* @last update 2015/03/24
		* @Module v3.5 ( Alice )
		* @Brief :: Service process
		* @Comment :: 서비스별 처리 프로세스
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$ajax = $_POST['ajax'];

		$wr_id = $_POST['wr_id'];


		$get_pg = $payment_control->get_use_pg(1);

		$pay_service = array();

		$oid = $utility->getOrderNumber(10);	 // 주문번호
		$vals['pay_no'] = 0;
		$vals['pay_oid'] = $oid;
		$vals['pay_type'] = $_POST['pay_type'];
		$vals['pay_pg'] = $get_pg['pg_company'];
		$vals['pay_method'] = $_POST['pay_method'];
		$vals['pay_uid'] = $member['mb_id'];
		$vals['pay_name'] = $_POST['pay_name'];
		$vals['pay_phone'] = @implode($_POST['pay_phone'],'-');
		$vals['pay_email'] = @implode($_POST['pay_email'],'@');

		$pay_total = str_replace(",","",$_POST['pay_total']);
		$vals['pay_total'] = $pay_total;
		$vals['pay_price'] = $vals['pay_total'];

		$vals['pay_wdate'] = $now_date;	// 결제신청일

		$vals['pay_service'] = "direct";	// 다이렉트 결제

		$vals['etc_0'] = $_POST['etc_0'];

		$result = $payment_control->insert_payment($vals);


		if(!$result){
			echo "0006";	// 결제 데이터 입력중 오류가 발생하였습니다.\\n\\n솔루션 개발사 :: `넷퓨(Netfu)` 1:1 게시판에 문의하세요.
			exit;
		} else {

			$no = $db->last_id();
			
			$get_payment = $payment_control->get_payment_for_oid($oid);

			echo $no . "/" . $vals['pay_oid'] . "/" . $vals['pay_price'] . "/" . $vals['pay_method'];

		}
?>