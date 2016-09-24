<?php
		/*
		* /application/resume/process/proposal.php
		* @author Harimao
		* @since 2013/10/15
		* @last update 2015/06/18
		* @Module v3.5 ( Alice )
		* @Brief :: Alba Resume proposal
		* @Comment :: 면접/지원 제안
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?url=".$urlencode);
			exit;
		}

		$mode = $_POST['mode'];

		$wr_type = $_POST['wr_type'];	// become(입사지원요청) / interview(면접제의)
		$mb_id = $_POST['mb_id'];	// 스크랩 하는 사람 mb_id
		$no = $_POST['no'];				// 이력서 no (고유값)


		switch($mode){

			## 알바 정보 추출
			case 'get_alba':
				
				$get_alba = $alba_user_control->get_alba_no($no);

				echo json_encode($get_alba);

			break;

			## 입사지원/면접제의 입력
			case 'proposal_insert':

				$get_member = $member_control->get_member($_POST['wr_id']);
				$get_alba = $alba_user_control->get_alba_no($_POST['wr_employ']);

				$vals['mb_id'] = $mb_id;
				$vals['wr_type'] = $wr_type;
				$vals['wr_id'] = $_POST['wr_id'];
				$vals['wr_resume'] = $_POST['resume_no'];
				$vals['wr_employ'] = $_POST['wr_employ'];
				$vals['wr_person'] = $_POST['wr_person'];
				$vals['wr_phone'] = $_POST['wr_phone'];
				$vals['wr_hphone'] = $_POST['wr_hphone'];
				$vals['wr_fax'] = $_POST['wr_fax'];
				$vals['wr_email'] = $_POST['wr_email'];
				$vals['wr_content'] = $_POST['wr_content'];

				$vals['wdate'] = $now_date;

				$result = $alba_company_control->insert_proposal($vals);

				//$mb_receive = explode(",",$get_member['mb_receive']);	// 수신여부 무관
				//if(@in_array('sms',$mb_receive)){	 // 문자 수신 확인
				if($wr_type=='become'){	// 면접요청
					$mail_control->mail_seding('proposal_become',$get_member['mb_email'],"[".stripslashes($env['site_name'])."] 입사지원 요청 메일 입니다.","","","",$vals['wr_employ'],$vals['wr_resume'],$mb_id,$db->last_id());
					$sms_control->send_sms_user('alba_invitation', $get_member, "", $get_alba);
				} else if($wr_type=='interview'){	 // 입사지원
					$mail_control->mail_seding('proposal_meet',$get_member['mb_email'],"[".stripslashes($env['site_name'])."] 면접요청 메일 입니다.","","","",$vals['wr_employ'],$vals['wr_resume'],$mb_id,$db->last_id());
					$sms_control->send_sms_user('alba_interview', $get_member, "", $get_alba);
				}
				//}

				echo $result . "/" . $wr_type;
				
			break;

		}

		/*
		$get_resume = $alba_resume_user_control->get_resume_no($no);

		$result = $alba_user_control->scrap_insert($mb_id, $get_resume['wr_subject'], "alba_resume", $no, $alice['time_ymd']);

		echo $result;
		*/
?>