<?php
		/*
		* /application/alba/process/become.php
		* @author Harimao
		* @since 2013/09/25
		* @last update 2015/02/27
		* @Module v3.5 ( Alice )
		* @Brief :: Alba become
		* @Table :: alice_receive
		* @Comment :: 정규직 입사지원
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?url=".$urlencode);
			exit;
		}

		$mode = $_POST['mode'];		// receive mode
		$mb_id = $_POST['mb_id'];	// 입사지원 회원 mb_id
		$no = $_POST['no'];				// 공고 no (고유값)


		switch($mode){

			## 온라인 입사지원
			case 'become_online':

				$alba_resume = $_POST['alba_resume'];	 // 지원 이력서

				$get_alba = $alba_user_control->get_alba_no($no);	 // 정규직 공고
				$get_resume = $alba_individual_control->get_resume_no($alba_resume);

				$wr_subject = $_POST['wr_subject'];	// 지원 제목

				$is_receive = 0;
				$is_receive += $receive_control->is_receive('become_online',$mb_id,$no);
				$is_receive += $receive_control->is_receive('become_email',$mb_id,$no);
				if($is_receive){	// 중복된 데이터가 있다면
					echo "0000";
					exit;
				}

				$vals['type'] = $mode;
				$vals['wr_id'] = $mb_id;	// 작성 회원 id
				$vals['wr_from'] = $alba_resume;	// 이력서 no

				$vals['wr_to'] = $no;			// 공고 no
				$vals['wr_to_id'] = $get_alba['wr_id'];

				$vals['wr_content'] = $_POST['wr_content'];	 // 사전 질문 답변

				$vals['etc_0'] = $wr_subject;	// 지원 제목
				$vals['etc_1'] = @implode($_POST['mb_info'],",");
				$vals['etc_5'] = @implode($_POST['sel_file'],",");

				$vals['wr_log'] = $mb_id . " 회원이 이력서 " . $alba_resume . " [" . $get_resume['wr_subject'] . "] 로 정규직 공고 " . $no . " [" . $get_alba['wr_subject'] . "] 에 온라인 입사지원";


				$attach_path = $alice['data_email_abs_path'] . '/' . $ym;
				@mkdir($attach_path, 0707);
				@chmod($attach_path, 0707);
				$file = $attach_path . "/index.html";
				if(!file_exists($file)){	// 디렉토리 보안을 위해서
					$f = @fopen($file, "w"); @fwrite($f, ""); @fclose($f); @chmod($file, 0606);
				}

				/* 첨부파일 */
				$tmp_file	= $_FILES['up_file']['tmp_name'];
				$filename	= $_FILES['up_file']['name'];
				$filesize		= $_FILES['up_file']['size'];
				if(is_uploaded_file($tmp_file)){
					$file_extension = $config->_upload();	// 확장자 체크
					if(preg_match("/\.($file_extension)$/i", $filename)){ // 파일 확장자 체크
						$file_upload = $utility->file_upload($tmp_file, $filename, $attach_path, $_FILES);	// 파일 업로드
						$upload_file = $file_upload['upload_file'];
						$vals['etc_3'] = $ym . "/" . $upload_file;
					}
				}
				/* // 첨부파일 */

				$vals['wdate'] = $now_date;


				## 01. Receive Data 입력
				$result = $receive_control->insert_receive($vals);

				// 공고 지원 카운트 증가
				$alba_user_control->desire_update($no, $mb_id);

				if($result){

					## 02. 알림 메일 발송
					$mail_control->mail_seding('online_become',$get_alba['wr_email'],"[".stripslashes($env['site_name'])."] ".$wr_subject,"","","",$no,$alba_resume,$mb_id);

					## 03. 알림 SMS 발송
					$get_member = $member_control->get_member($mb_id);
					//$mb_receive = explode(",",$get_member['mb_receive']);	// 수신여부 무관
					//if(@in_array('sms',$mb_receive)){	 // 문자 수신 확인
						$sms_control->send_sms_user('alba_online', $get_member, "", $get_alba);
					//}

					echo $mode;
				}


			break;

			## 이메일 입사지원
			case 'become_email':

			
				$wr_form = $_POST['wr_form'];	// 회원 이력서 / 회사 자사양식 중 선택된 값

				$alba_resume = $_POST['alba_resume'];	 // 지원 이력서

				$wr_subject = $_POST['wr_subject'];	// 지원 제목

				$get_alba = $alba_user_control->get_alba_no($no);	 // 정규직 공고
				$get_resume = $alba_individual_control->get_resume_no($alba_resume);

				$is_receive = 0;
				$is_receive += $receive_control->is_receive('become_online',$mb_id,$no);
				$is_receive += $receive_control->is_receive('become_email',$mb_id,$no);
				if($is_receive){	// 중복된 데이터가 있다면
					echo "0000";
					exit;
				}

				$vals['type'] = $mode;
				$vals['wr_id'] = $mb_id;	// 작성 회원 id
				//$vals['wr_from'] = $alba_resume;	// 이력서 no

				$vals['wr_to'] = $no;			// 공고 no
				$vals['wr_to_id'] = $get_alba['wr_id'];

				if($wr_form=='user'){	// 회원 이력서
					
					$vals['wr_from'] = $alba_resume;	// 이력서 no
					$vals['wr_content'] = $_POST['wr_content'];	 // 사전질문 답변
					$vals['etc_0'] = $wr_subject;	// 지원 제목
					$vals['etc_1'] = @implode($_POST['mb_info'],",");

					$vals['wr_log'] = $mb_id . " 회원이 이력서 " . $alba_resume . " [" . $get_resume['wr_subject'] . "] 로 정규직 공고 " . $no . " [" . $get_alba['wr_subject'] . "] 에 이메일 입사지원";

				} else if($wr_form=='company'){	// 회사 양식

					$vals['wr_content'] = $_POST['wr_content'];	 // 사전질문 답변
					$vals['etc_0'] = $wr_subject;	// 지원 제목
					$vals['etc_1'] = @implode($_POST['mb_info'],",");
					
					$vals['wr_log'] = $mb_id . " 회원이 자사양식 으로 정규직 공고 " . $no . " [" . $get_alba['wr_subject'] . "] 에 이메일 입사지원";

				}

				$vals['etc_5'] = @implode($_POST['sel_file'],",");

				$attach_path = $alice['data_email_abs_path'] . '/' . $ym;
				@mkdir($attach_path, 0707);
				@chmod($attach_path, 0707);
				$file = $attach_path . "/index.html";
				if(!file_exists($file)){	// 디렉토리 보안을 위해서
					$f = @fopen($file, "w"); @fwrite($f, ""); @fclose($f); @chmod($file, 0606);
				}

				/* 회사 자사양식 */
				$tmp_file	= $_FILES['etc_2']['tmp_name'];
				$filename	= $_FILES['etc_2']['name'];
				$filesize		= $_FILES['etc_2']['size'];
				if(is_uploaded_file($tmp_file)){
					$file_extension = $config->_upload();	// 확장자 체크
					if(preg_match("/\.($file_extension)$/i", $filename)){ // 파일 확장자 체크
						$file_upload = $utility->file_upload($tmp_file, $filename, $attach_path, $_FILES);	// 파일 업로드
						$upload_file = $file_upload['upload_file'];
						$vals['etc_2'] = $ym . "/" . $upload_file;
					}
				}
				/* // 회사 자사양식 */

				/* 첨부파일 */
				$tmp_file	= $_FILES['up_file']['tmp_name'];
				$filename	= $_FILES['up_file']['name'];
				$filesize		= $_FILES['up_file']['size'];
				if(is_uploaded_file($tmp_file)){
					$file_extension = $config->_upload();	// 확장자 체크
					if(preg_match("/\.($file_extension)$/i", $filename)){ // 파일 확장자 체크
						$file_upload = $utility->file_upload($tmp_file, $filename, $attach_path, $_FILES);	// 파일 업로드
						$upload_file = $file_upload['upload_file'];
						$vals['etc_3'] = $ym . "/" . $upload_file;
					}
				}
				/* // 첨부파일 */

				$vals['wdate'] = $now_date;

				## 01. Receive Data 입력
				$result = $receive_control->insert_receive($vals);

				// 공고 지원 카운트 증가
				$alba_user_control->desire_update($no,$mb_id);

				if($result){

					## 02. 메일 발송
					$mail_control->mail_seding('email_become',$get_alba['wr_email'],"[".stripslashes($env['site_name'])."] ".$wr_subject,"","","",$no,$alba_resume,$mb_id);

					## 03. 알림 SMS 발송
					$get_member = $member_control->get_member($mb_id);
					//$mb_receive = explode(",",$get_member['mb_receive']);	// 수신여부 무관
					//if(@in_array('sms',$mb_receive)){	 // 문자 수신 확인
						$sms_control->send_sms_user('alba_email', $get_member, "", $get_alba);
					//}

					echo $mode;
				}


			break;

		}

		/*

		$get_alba = $alba_user_control->get_alba_no($no);

		$result = $alba_user_control->scrap_insert($mb_id, $get_alba['wr_subject'], "alba", $no, $alice['time_ymd']);

		echo $result;
		*/

?>