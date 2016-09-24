<?php
		/*
		* /application/company/process/company.php
		* @author Harimao
		* @since 2014/08/08
		* @last update 2015/04/20
		* @Module v3.5 ( Alice )
		* @Brief :: Company process
		* @Comment :: 기업정보 관리 프로세스
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

		$get_member = $user_control->get_member_company_no($no);
		$mb_logo = $_POST['mb_logo'];

		// 디렉토리가 없는 경우 생성
		// 로고 및 회사 사진 저장 디렉토리
		$logo_path = $alice['data_member_abs_path'] . '/' . $mb_id . '/logo';
		@mkdir($logo_path, 0707);
		@chmod($logo_path, 0707);
		$file = $logo_path . "/index.html";
		if(!file_exists($file)){	// 디렉토리 보안을 위해서
			$f = @fopen($file, "w"); @fwrite($f, ""); @fclose($f); @chmod($file, 0606);
		}

		switch($mode){

			## 기업정보 입력
			case 'insert':
			case 'update':

				$wr_logo = $_POST['wr_logo'];

				$vals['mb_id'] = $mb_id;
				$vals['mb_ceo_name'] = $_POST['mb_ceo_name'];
				$vals['mb_company_name'] = $_POST['mb_company_name'];
				$vals['mb_biz_type'] = $_POST['mb_biz_type'];
				$vals['mb_biz_no'] = @implode($_POST['mb_biz_no'],'-');
				$vals['mb_biz_phone'] = @implode($_POST['mb_biz_phone'],'-');
				$vals['mb_biz_hphone'] = @implode($_POST['mb_biz_hphone'],'-');

				$vals['mb_biz_zipcode'] = @implode($_POST['mb_zipcode'],'-');
				$vals['mb_biz_address0'] = $_POST['mb_address0'];
				$vals['mb_biz_address1'] = $_POST['mb_address1'];

				$vals['mb_biz_email'] = @implode($_POST['mb_email'],'@');
				$vals['mb_biz_fax'] = @implode($_POST['mb_biz_fax'],'-');
				$vals['mb_biz_success'] = $_POST['mb_biz_success'];
				$vals['mb_biz_form'] = $_POST['mb_biz_form'];
				$vals['mb_biz_content'] = $_POST['mb_biz_content'];
				$vals['mb_biz_foundation'] = $_POST['mb_biz_foundation'];
				$vals['mb_biz_member_count'] = $_POST['mb_biz_member_count'];
				$vals['mb_biz_stock'] = $_POST['mb_biz_stock'];
				$vals['mb_biz_sale'] = $_POST['mb_biz_sale'];
				$vals['mb_biz_vision'] = $_POST['mb_biz_vision'];
				$vals['mb_biz_result'] = $_POST['mb_biz_result'];

				$vals['mb_latlng'] = $_POST['mb_latlng'];
				$vals['mb_homepage'] = $_POST['mb_homepage'];

				$tmp_file	= $_FILES['mb_logo']['tmp_name'];
				$filename	= $_FILES['mb_logo']['name'];
				$filesize  = $_FILES['mb_logo']['size'];

				$timg = @getimagesize($tmp_file);

				if(is_uploaded_file($tmp_file)){
					// 사이즈 체크

					// 용량 체크 (관리자에서 설정한 용량)

					// 확장자 체크
					$img_extension = $user_control->_img();

					if(preg_match("/\.($img_extension)$/i", $filename)){ // 파일 확장자 체크
						@unlink($logo_path . "/" . $get_member['mb_logo']);	// 기존 파일 삭제
						$file_upload = $utility->file_upload($tmp_file, $filename, $logo_path, $_FILES);	// 파일 업로드
						$upload_file = $file_upload['upload_file'];
						$vals['mb_logo'] = $upload_file;	// 변수 할당
					}

				}

				$vals['mb_logo_sel'] = $wr_logo;


				if($mode=='insert'){	// 등록

					$result = $user_control->company_user_regist($vals);
					
					$company_no = $db->last_id();


					$photo_con = " and `company_no` = '".$company_no."' and `photo_table` = 'company' ";
					$photo_list = $user_control->member_photo_list($mb_id, $photo_con);

					if($photo_list){	// 기존에 등록된 기업 이미지가 있다면

						for($i=0;$i<=4;$i++){
							$photos_name = explode("/",$_POST['photos_'.$i]);
							$photos_size = getimagesize("../".$_POST['photos_'.$i]);
							$photo_vals['mb_type'] = "company";
							$photo_vals['mb_id'] = $mb_id;
							$photo_vals['company_no'] = $company_no;
							$photo_vals['photo_name'] = $photos_name[5];
							$photo_vals['photo_filesize'] = filesize("../".$_POST['photos_'.$i]);
							$photo_vals['photo_width'] = $photos_size[0];
							$photo_vals['photo_height'] = $photos_size[1];
							$photo_vals['photo_type'] = $photos_size[2];
							$photo_vals['photo_datetime'] = $now_date;
							$user_control->user_photo_update($photo_vals, $mb_id, 'company', $i, " and `company_no` = '0' ");
						}

					} else {	 // 없다면 입력

						$photo_con = " and `company_no` = '0' and `photo_table` = 'company' ";
						$photo_list = $user_control->member_photo_list($mb_id, $photo_con);

						if($photo_list){	// 기업정보 업데이트

							for($i=0;$i<=4;$i++){
								$photo_vals['company_no'] = $company_no;
								$photo_vals['photo_datetime'] = $now_date;
								$user_control->user_photo_update($photo_vals, $mb_id, 'company', $i, " and `company_no` = '0' ");
							}

						} else {

							for($i=0;$i<=4;$i++){
								$photos_name = explode("/",$_POST['photos_'.$i]);
								$photos_size = getimagesize("../".$_POST['photos_'.$i]);
								$photo_vals['mb_type'] = "company";
								$photo_vals['mb_id'] = $mb_id;
								$photo_vals['company_no'] = $company_no;
								$photo_vals['photo_table'] = "company";
								$photo_vals['photo_no'] = $i;
								$photo_vals['photo_datetime'] = $now_date;
								$user_control->user_photo_insert($photo_vals);
							}

						}

					}

					$error_msg = $user_control->_errors('0048');

				} else if($mode=='update'){	// 수정

					$result = $user_control->company_user_updateNo($vals,$no);

					$error_msg = $user_control->_errors('0049');

				}


				if($result){
					$utility->popup_msg_js("","../company_info.php");
				} else {
					$utility->popup_msg_js($error_msg);
				}

			break;

			## 기업정보 삭제(단수)
			case 'company_delete':
			
				$result = $user_control->company_user_delete($no);

				echo $result;

			break;

			## 기업정보 삭제(복수)
			case 'company_sel_delete':
				
				$no_cnt = count($no);
				for($i=0;$i<$no_cnt;$i++){
					$result = $user_control->company_user_delete($no[$i]);
				}

				echo $result;

			break;


			## 회사이미지 업로드
			case 'photo_upload':

				$no = ($no) ? $no : 0;

				$get_member = $member_control->get_member($mb_id);
				$mb_photos = $_POST['mb_photos'];

				// 디렉토리가 없는 경우 생성
				// 로고 및 회사 사진 저장 디렉토리
				$photos_path = $alice['data_member_abs_path'] . '/' . $mb_id . '/photos';
				@mkdir($photos_path, 0707);
				@chmod($photos_path, 0707);
				$file = $photos_path . "/index.html";
				if(!file_exists($file)){	// 디렉토리 보안을 위해서
					$f = @fopen($file, "w"); @fwrite($f, ""); @fclose($f); @chmod($file, 0606);
				}

				$tmp_file	= $_FILES['photo_files']['tmp_name'];
				$filename	= $_FILES['photo_files']['name'];
				$filesize		= $_FILES['photo_files']['size'];

				$timg = @getimagesize($tmp_file);

				$photo_con = " and `company_no` = '".$no."' and `photo_table` = 'company' ";
				$photo_list = $user_control->member_photo_list($mb_id, $photo_con);

				if($photo_list){	// 사진 데이터가 있다면 mb_photos 를 기준으로 수정

					$vals['company_no'] = $no;

					if(is_uploaded_file($tmp_file)){

						// 사이즈 체크

						// 용량 체크 (관리자에서 설정한 용량)

						// 확장자 체크
						$img_extension = $user_control->_img();

						if(preg_match("/\.($img_extension)$/i", $filename)){ // 파일 확장자 체크
							$photo = $user_control->get_member_photo($mb_id,$mb_photos," and `company_no` = '".$no."' ");
							@unlink($photos_path . "/". $photo);	 // 기존 파일 삭제
							$file_upload = $utility->file_upload($tmp_file, $filename, $photos_path, $_FILES);	// 파일 업로드
							$upload_file = $file_upload['upload_file'];
							$vals['photo_source'] = $filename;
							$vals['photo_name'] = $upload_file;
							$vals['photo_filesize'] = $filesize;
							$vals['photo_width'] = $timg[0];
							$vals['photo_height'] = $timg[1];
							$vals['photo_type'] = $timg[2];
							$vals['photo_datetime'] = $now_date;

							// update
							$result = $user_control->user_photo_update($vals, $mb_id, 'company', $mb_photos, " and `company_no` = '".$no."' ");

						}
					}

				} else {	 // 사진 데이터가 없다면 mb_photos 를 기준으로 입력

					$vals['mb_type'] = $get_member['mb_type'];
					$vals['mb_id'] = $mb_id;
					$vals['company_no'] = $no;
					$vals['photo_table'] = 'company';

					for($i=0;$i<=4;$i++){
						$vals['photo_no'] = $i;
						if($i==$mb_photos){
							if(is_uploaded_file($tmp_file)){

								// 사이즈 체크

								// 용량 체크 (관리자에서 설정한 용량)

								// 확장자 체크
								$img_extension = $user_control->_img();

								if(preg_match("/\.($img_extension)$/i", $filename)){ // 파일 확장자 체크
									$file_upload = $utility->file_upload($tmp_file, $filename, $photos_path, $_FILES);	// 파일 업로드
									$upload_file = $file_upload['upload_file'];
									$vals['photo_source'] = $filename;
									$vals['photo_name'] = $upload_file;
									$vals['photo_filesize'] = $filesize;
									$vals['photo_width'] = $timg[0];
									$vals['photo_height'] = $timg[1];
									$vals['photo_type'] = $timg[2];
									$vals['photo_datetime'] = $now_date;
								}
							}
						} else {
							$vals['photo_source'] = "";
							$vals['photo_name'] = "";
							$vals['photo_filesize'] = "";
							$vals['photo_width'] = "";
							$vals['photo_height'] = "";
							$vals['photo_type'] = "";
							$vals['photo_datetime'] = $now_date;
						}

						// insert
						$result = $user_control->user_photo_insert($vals);

					}	// for end.
					
				}
				
				if($result){
					echo "../data/member/".$mb_id."/photos/".$upload_file;
				} else {
					$utility->popup_msg_ajax($user_control->_errors('0029'));
					exit;
				}

			break;

			## 회사이미지 삭제
			case 'photo_delete':

				$get_member = $member_control->get_member($mb_id);

				$photo_no = $_POST['photo_no'];

				$photos_path = $alice['data_member_abs_path'] . '/' . $mb_id . '/photos';

				$photo = $user_control->get_member_photo($mb_id,$photo_no);
				@unlink($photos_path . "/". $photo);	 // 기존 파일 삭제

				$vals['photo_source'] = "";
				$vals['photo_name'] = "";
				$vals['photo_filesize'] = "";
				$vals['photo_width'] = "";
				$vals['photo_height'] = "";
				$vals['photo_type'] = "";
				$vals['photo_datetime'] = $now_date;

				// update
				$result = $user_control->user_photo_update($vals, $mb_id, 'member', $photo_no);

				if($result){
					echo "../images/comn/no_profileimg.gif";
				} else {
					$utility->popup_msg_ajax($user_control->_errors('0035'));
					exit;
				}

			
			break;

			## 대표기업정보 설정
			case 'sel_company':

				// is_public 초기화
				$vals['is_public'] = 0;
				$user_control->company_user_update($vals, $_POST['mb_id']);

				// is_public 값 할당
				$upd_vals['is_public'] = 1;
				$result = $user_control->company_user_updateNo($upd_vals, $_POST['no']);

				echo $result;		

			break;
		}
?>