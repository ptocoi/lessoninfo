<?php
		/*
		* /application/company/process/tax.php
		* @author Harimao
		* @since 2013/09/30
		* @last update 2015/03/05
		* @Module v3.5 ( Alice )
		* @Brief :: Tax process
		* @Comment :: 세금계산서 신청 프로세스
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?type=company&url=".$urlencode);
			exit;
		}
		/*
		if($mb_type=='individual'){	 // 개인회원 접근시
			$utility->popup_msg_js($user_control->_errors('0030'));
			exit;
		}
		*/

		$mode = $_POST['mode'];
		$wr_id = $_POST['wr_id'];

		switch($mode){

			## 세금계산서 신청
			case 'insert':
				
				$vals['wr_type'] = $_POST['wr_type'];		// 세금계산서/현금영수증 구분
				$vals['wr_id'] = $_POST['wr_id'];
				$vals['wr_name'] = $_POST['wr_name'];
				$vals['wr_biz_no'] = @implode($_POST['wr_biz_no'],'-');
				$vals['wr_company_name'] = $_POST['wr_company_name'];
				$vals['wr_ceo_name'] = $_POST['wr_ceo_name'];
				$vals['wr_zipcode'] = @implode($_POST['wr_zipcode'],'-');
				$vals['wr_address0'] = $_POST['wr_address0'];
				$vals['wr_address1'] = $_POST['wr_address1'];
				$vals['wr_condition'] = $_POST['wr_condition'];
				$vals['wr_item'] = $_POST['wr_item'];
				$vals['wr_email'] = @implode($_POST['wr_email'],'@');
				$vals['wr_manager'] = $_POST['wr_manager'];
				$vals['wr_phone'] = @implode($_POST['wr_phone'],'-');
				$vals['wr_hphone'] = @implode($_POST['wr_hphone'],'-');
				$vals['wr_pay_date'] = @implode($_POST['wr_pay_date'],'-');
				$vals['wr_price'] = $_POST['wr_price'];
				$vals['wr_content'] = $_POST['wr_content'];

				$vals['wdate'] = $now_date;

				$result = $tax_control->insert_tax($vals);

				echo $result;

			break;
		}
?>