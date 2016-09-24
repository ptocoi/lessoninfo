<?php
		/*
		* /application/alba/process/report.php
		* @author Harimao
		* @since 2013/10/18
		* @last update 2015/02/27
		* @Module v3.5 ( Alice )
		* @Brief :: Alba Report
		* @Comment :: 정규직 신고하기
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?url=".$urlencode);
			exit;
		}

		$mode = $_POST['mode'];
		$no = $_POST['no'];

		$wr_report = $_POST['wr_report'];
		$wr_report_content = $_POST['wr_report_content'];

		$vals['wr_report'] = 1;
		$vals['wr_report_date'] = $now_date;

		if($wr_report=='self'){
			
			$vals['wr_report_content'] = $_POST['wr_report_content'];

		} else {
			
			$wr_report_content = $category_control->get_categoryCodeName($wr_report);

			$vals['wr_report_content'] = $wr_report_content;

		}
		
		$result = $alba_company_control->alba_update($vals,$no);

		echo $result;
?>