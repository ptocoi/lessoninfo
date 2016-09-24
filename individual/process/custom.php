<?php
		/*
		* /application/individual/process/custom.php
		* @author Harimao
		* @since 2013/10/16
		* @last update 2015/03/12
		* @Module v3.5 ( Alice )
		* @Brief :: Customized process
		* @Comment :: 맞춤 채용정보 프로세스
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

		$mode = $_POST['mode'];
		$mb_id = $_POST['mb_id'];
		$type = $_POST['type'];

		switch($mode){

			## 맞춤 채용정보 조건 설정.수정
			case 'custom_update':

				$vals['wr_id'] = $member['mb_id'];

				/* 업직종 */
				$vals['wr_job_type0'] = $_POST['wr_job_type0'];
				$vals['wr_job_type1'] = $_POST['wr_job_type1'];
				$vals['wr_job_type2'] = $_POST['wr_job_type2'];

				$vals['wr_job_type3'] = $_POST['wr_job_type3'];
				$vals['wr_job_type4'] = $_POST['wr_job_type4'];
				$vals['wr_job_type5'] = $_POST['wr_job_type5'];

				$vals['wr_job_type6'] = $_POST['wr_job_type6'];
				$vals['wr_job_type7'] = $_POST['wr_job_type7'];
				$vals['wr_job_type8'] = $_POST['wr_job_type8'];
				/* //업직종 */

				/* 근무지 */
				$vals['wr_area0'] = $_POST['wr_area0'];
				$vals['wr_area1'] = $_POST['wr_area1'];

				$vals['wr_area2'] = $_POST['wr_area2'];
				$vals['wr_area3'] = $_POST['wr_area3'];

				$vals['wr_area4'] = $_POST['wr_area4'];
				$vals['wr_area5'] = $_POST['wr_area5'];
				/* //근무지 */

				
				/* 근무일시 */
				$vals['wr_date'] = $_POST['wr_date'];			// 근무기간
				$vals['wr_week'] = $_POST['wr_week'];		// 근무요일
				$vals['wr_stime'] = @implode($_POST['wr_stime'],":");
				$vals['wr_etime'] = @implode($_POST['wr_etime'],":");
				$vals['wr_time_conference'] = $_POST['wr_time_conference'];
				/* //근무일시 */

				$vals['wr_gender'] = $_POST['wr_gender'];
				$age_limit = $_POST['wr_age_limit'];
				$vals['wr_age_limit'] = $age_limit;
				if($age_limit) {	// 연령제한이 있다면
					$vals['wr_age'] = $_POST['wr_sage'] . "-" . $_POST['wr_eage'];
				}
				$vals['wr_age_etc'] = @implode($_POST['wr_age_etc'],',');	// 연령 기타 정보

				$vals['wr_work_type'] = ($_POST['wr_work_type']) ? @implode($_POST['wr_work_type'],',') : "";		// 근무형태

				$vals['wr_email'] = $_POST['wr_email'];
				$vals['wr_sms'] = $_POST['wr_sms'];

				$vals['wdate'] = $now_date;

				$sel_custom = $_POST['sel_custom'];	// 맞춤 인재정보 선택

				$result = $alba_individual_control->custom_updates($vals,$sel_custom);

				if($result){
					$utility->popup_msg_js("","../alba_customized.php");
				} else {
					$utility->popup_msg_js($alba_individual_control->_errors('0011'));
				}

			break;

			## 맞춤 채용정보 조건 삭제
			case 'custom_delete':
			
				$no = $_POST['no'];

				$result = $alba_individual_control->custom_delete($no);

				echo $result;

			break;
		}	// switch end.
?>