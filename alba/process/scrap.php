<?php
		/*
		* /application/alba/process/scrap.php
		* @author Harimao
		* @since 2013/08/26
		* @last update 2015/03/30
		* @Module v3.5 ( Alice )
		* @Brief :: Alba scrap
		* @Comment :: 정규직 스크랩
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?url=".$urlencode);
			exit;
		}

	
		$mode = $_POST['mode'];

		if($mode && $mode=='sel_favorite'){
			
			$mb_id = $_POST['mb_id'];
			$vals['wr_id'] = $mb_id;

			$get_member_company = $user_control->get_member_company_no($no);
			
			$get_favorite_list = $alba_individual_control->get_favorite_list("",""," where `wr_id` = '".$mb_id."' and `mb_id` = '".$get_member_company['mb_id']."' and `mb_company_no` = '".$no."' ");

			$vals['mb_id'] = $get_member_company['mb_id'];
			$vals['mb_company_no'] = $no;
			$vals['mb_company_name'] = $get_member_company['mb_company_name'];
			$vals['mb_ceo_name'] = $get_member_company['mb_ceo_name'];
			$vals['mb_biz_type'] = $get_member_company['mb_biz_type'];
			$vals['wdate'] = $alice['time_ymdhis'];

			if($get_favorite_list['total_count']){
				$result = $alba_individual_control->_errors('0015');	// 이미 관심기업으로 등록하셨습니다.
			} else {
				$result = $alba_individual_control->insert_favorite($vals);
			}

			echo $result;

		} else {

			$mb_id = $_POST['mb_id'];	// 스크랩 하는 사람 mb_id
			$no = $_POST['no'];				// 공고 no (고유값)

			$get_alba = $alba_user_control->get_alba_no($no);

			$result = $alba_user_control->scrap_insert($mb_id, $get_alba['wr_subject'], "alba", $no, $alice['time_ymd']);

			echo $result;

		}

?>