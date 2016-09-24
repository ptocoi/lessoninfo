<?php
		/*
		* /application/company/process/manager.php
		* @author Harimao
		* @since 2013/09/26
		* @last update 2015/04/13
		* @Module v3.5 ( Alice )
		* @Brief :: Manager process
		* @Comment :: 담당자 관리 프로세스
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?type=company&url=".$urlencode);
			exit;
		}
		if($mb_type=='individual'){	 // 개인회원 접근시
			$utility->popup_msg_js($user_control->_errors('0030'));
			exit;
		}

		$mode = $_POST['mode'];
		$mb_id = $_POST['mb_id'];

		$no = $_POST['no'];

		switch($mode){

			## 담당자 관리			
			case 'manager_insert':
			case 'manager_update':
				
				$vals['wr_name'] = $_POST['wr_name'];
				$vals['wr_phone'] = @implode($_POST['wr_phone'],'-');
				$vals['wr_hphone'] = @implode($_POST['wr_hphone'],'-');
				$vals['wr_fax'] = @implode($_POST['wr_fax'],'-');
				$vals['wr_email'] = @implode($_POST['wr_email'],'@');

				if($mode=='manager_insert'){

					$vals['wr_id'] = $mb_id;
					$vals['wr_wdate'] = $now_date;

					$result = $company_manager_control->insert_manager($vals);

				} else if($mode=='manager_update') {
					
					$result = $company_manager_control->update_manager($vals, $no);

				}

				echo $result;

			break;

			## 담당자 삭제 (단수)
			case 'manager_delete':

				$result = $company_manager_control->delete_manager($no);

				echo $result;
				
			break;

			## 담당자 선택 삭제 (복수)
			case 'manager_sel_delete':

				$no_cnt = count($no);
				for($i=0;$i<$no_cnt;$i++){
					$result = $company_manager_control->delete_manager($no[$i]);
				}

				echo $result;

			break;

		}

?>