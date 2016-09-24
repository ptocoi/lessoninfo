<?php
		/*
		* /application/individual/process/open.php
		* @author Harimao
		* @since 2013/10/14
		* @last update 2015/03/12
		* @Module v3.5 ( Alice )
		* @Brief :: Resume open service
		* @Comment :: 열람인재정보 / 스크랩 처리
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

		switch($mode){

			## 입사지원 취소
			case 'sel_become_cancel':
				
				//$vals['wr_to'] = "";
				//$vals['wr_to_id'] = "";
				$vals['is_cancel'] = 1;

				$no_cnt = count($no);
				for($i=0;$i<$no_cnt;$i++){

					$get_receive = $receive_control->get_receive($no[$i]);

					$alba_user_control->desire_down($get_receive['wr_to']);	// 지원자수 감소

					$result = $receive_control->update_receive($vals,$no[$i]);

				}
				
				echo $result;

			break;
			
			## 입사지원 삭제
			case 'sel_become_delete':

				$no_cnt = count($no);
				for($i=0;$i<$no_cnt;$i++){
					
					$result = $receive_control->delete_receive($no[$i]);
					
				}

				echo $result;

			break;

			## 열람제한 기업 설정
			case 'sel_denied':

				$vals['wr_id'] = $_POST['wr_id'];
				$nos = count($no);
				for($i=0;$i<$nos;$i++){
					$get_member_company = $user_control->get_member_company_no($no[$i]);
					$vals['mb_id'] = $get_member_company['mb_id'];
					$vals['mb_company_name'] = $get_member_company['mb_company_name'];
					$vals['mb_ceo_name'] = $get_member_company['mb_ceo_name'];
					$vals['mb_biz_type'] = $get_member_company['mb_biz_type'];
					$vals['wdate'] = $now_date;

					$result = $alba_individual_control->insert_denied($vals);
				}
				
				echo $result;

			break;

			## 열람제한 기업 해제 (삭제)
			case 'sel_access':

				$nos = count($no);
				for($i=0;$i<$nos;$i++){
					$result = $alba_individual_control->delete_denied($no[$i]);
				}

				echo $result;

			break;

			## 스크랩한 채용정보 삭제
			case 'sel_scrap_delete';

				$no_cnt = count($no);
				for($i=0;$i<$no_cnt;$i++){

					$result = $alba_user_control->scrap_delete($no[$i]);

				}

				echo $result;

			break;

			## 관심기업 설정
			case 'sel_favorite';
				
				$vals['wr_id'] = $_POST['wr_id'];
				$nos = count($no);
				for($i=0;$i<$nos;$i++){
					$get_member_company = $user_control->get_member_company_no($no[$i]);
					$vals['mb_id'] = $get_member_company['mb_id'];
					$vals['mb_company_name'] = $get_member_company['mb_company_name'];
					$vals['mb_ceo_name'] = $get_member_company['mb_ceo_name'];
					$vals['mb_biz_type'] = $get_member_company['mb_biz_type'];
					$vals['wdate'] = $now_date;

					$result = $alba_individual_control->insert_favorite($vals);
				}
				
				echo $result;

			break;

			## 관심기업 삭제
			case 'sel_favorite_delete':

				$no_cnt = count($no);
				for($i=0;$i<$no_cnt;$i++){

					$result = $alba_individual_control->delete_favorite($no[$i]);

				}

				echo $result;

			break;

			## 열람기업 정보 삭제
			case 'sel_delete':

				$no_cnt = count($no);
				for($i=0;$i<$no_cnt;$i++){
					$result = $alba_company_control->open_delete($no[$i]);
				}
			
				echo $result;

			break;

		}

?>