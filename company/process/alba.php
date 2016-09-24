<?php
		/*
		* /application/company/process/alba.php
		* @author Harimao
		* @since 2013/07/29
		* @last update 2015/12/17
		* @Module v3.5 ( Alice )
		* @Brief :: Alba process
		* @Comment :: 알바 처리 프로세스
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
		$mb_no = $_POST['mb_no'];

		$no = $_POST['no'];

		$company_info = $_POST['company_info'];


		$form_person = $category_control->get_categoryCode('20130806090028_2197');	// 담당자명
		$form_phone = $category_control->get_categoryCode('20130806090034_2565');	// 전화번호
		$form_hphone = $category_control->get_categoryCode('20140226142807_5748');	// 휴대폰
		$form_fax = $category_control->get_categoryCode('20130806090204_5528');		// 팩스번호
		$form_email = $category_control->get_categoryCode('20130806090030_8891');	// 이메일
		$form_subway = $category_control->get_categoryCode('20130701104449_4419');	// 인근지하철
		$form_college = $category_control->get_categoryCode('20130701104456_9162');	// 인근대학
		$form_welfare = $category_control->get_categoryCode('20130701104158_7370');	// 복리후생
		$form_gender = $category_control->get_categoryCode('20130806090037_4056');	// 성별
		$form_age = $category_control->get_categoryCode('20130806090039_4821');	// 연령
		$form_requisition = $category_control->get_categoryCode('20130806090024_9531');	// 접수방법
		$form_paper = $category_control->get_categoryCode('20130701103906_4873');	// 제출서류
		$form_question = $category_control->get_categoryCode('20130701103916_7908');	// 사전질문

		switch($mode){

			## 알바 공고 등록/수정
			case 'insert':			// 등록
			case 'update':		// 수정
			case 'reinsert':		// 재등록
			case 'load':			// 불러오기

				$get_alba = $alba_company_control->get_alba_no($no);

				/* 담당자 정보 */
				$manager_sel = $_POST['manager_sel'];
				if(!$manager_sel){
					$manager_vals['wr_name'] = $_POST['wr_person'];
					$manager_vals['wr_phone'] = @implode($_POST['wr_phone'],'-');
					$manager_vals['wr_hphone'] = @implode($_POST['wr_hphone'],'-');
					$manager_vals['wr_fax'] = @implode($_POST['wr_fax'],'-');
					$manager_vals['wr_email'] = @implode($_POST['wr_email'],'@');
					$manager_vals['wr_id'] = $mb_id;
					$manager_vals['wr_wdate'] = $now_date;
					$company_manager_control->insert_manager($manager_vals);
				}
				$vals['wr_id'] = $mb_id;
				$vals['wr_open'] = 1;	// 자동으로 공개
				$vals['wr_person'] = $_POST['wr_person'];
				$vals['wr_phone'] = @implode($_POST['wr_phone'],'-');
				$vals['wr_hphone'] = @implode($_POST['wr_hphone'],'-');
				$vals['wr_fax'] = @implode($_POST['wr_fax'],'-');
				$vals['wr_email'] = @implode($_POST['wr_email'],'@');
				$vals['wr_page'] = ($_POST['wr_page']) ? $utility->add_http($_POST['wr_page']) : "";
				/* //담당자 정보 */

				$vals['wr_company'] = $company_info;	// 기업정보


				/* 업무내용 및 근무지정보 */
				$vals['wr_company_name'] = $_POST['wr_company_name'];
				$vals['wr_subject'] = $_POST['wr_subject'];
				
				$wr_job_type0 = $_POST['wr_job_type0'];
				$vals['wr_job_type0'] = $wr_job_type0;	 // 직종
				$vals['wr_job_type1'] = $_POST['wr_job_type1'];
				$vals['wr_job_type2'] = $_POST['wr_job_type2'];

				$wr_job_type3 = $_POST['wr_job_type3'];
				$vals['wr_job_type3'] = $wr_job_type3;	 // 직종
				$vals['wr_job_type4'] = $_POST['wr_job_type4'];
				$vals['wr_job_type5'] = $_POST['wr_job_type5'];

				$wr_job_type6 = $_POST['wr_job_type6'];
				$vals['wr_job_type6'] = $wr_job_type6;	 // 직종
				$vals['wr_job_type7'] = $_POST['wr_job_type7'];
				$vals['wr_job_type8'] = $_POST['wr_job_type8'];

				
				$is_adult_type = false;
				$is_type_0 = $category_control->code_is_adult_type($wr_job_type0);
				$is_adult_type = $is_type_0;
				$is_type_1 = $category_control->code_is_adult_type($wr_job_type3);
				$is_adult_type = ($is_type_1) ? $is_type_1 : $is_adult_type;
				$is_type_2 = $category_control->code_is_adult_type($wr_job_type6);
				$is_adult_type = ($is_type_2) ? $is_type_2 : $is_adult_type;
				$vals['wr_is_adult'] = $is_adult_type;	// 성인 카테고리 유무


				$vals['wr_beginner'] = ($_POST['wr_beginner']) ? $_POST['wr_beginner'] : 0;	 // 초보가능
				
				$vals['wr_area_company'] = $_POST['wr_area_company'];	// 근무지 주소 0 : 직접입력 / 1 : 기업정보 위치
				$vals['wr_area_point'] = $_POST['wr_area_point'];	// 근무지 주소 좌표
				$vals['wr_area'] = $_POST['wr_area'];	 // 근무지 주소

				$wr_area_0 = $_POST['wr_area_0'];
				$wr_area_0[3] = ($wr_area_0[3]=='번지수 입력') ? "" : $wr_area_0[3];
				$vals['wr_area_0'] = ($wr_area_0[0]) ? @implode($wr_area_0,'/') : "";	// 근무지 주소 0

				$wr_area_1 = $_POST['wr_area_1'];
				$wr_area_1[3] = ($wr_area_1[3]=='번지수 입력') ? "" : $wr_area_1[3];
				$vals['wr_area_1'] = ($wr_area_1[0]) ? @implode($wr_area_1,'/') : "";	// 근무지 주소 1

				$wr_area_2 = $_POST['wr_area_2'];
				$wr_area_2[3] = ($wr_area_2[3]=='번지수 입력') ? "" : $wr_area_2[3];
				$vals['wr_area_2'] = ($wr_area_2[0]) ? @implode($wr_area_2,'/') : "";	// 근무지 주소 2

				$vals['wr_subway_area_0'] = $_POST['wr_subway_area_0'];				// 인근 지하철 지역 0
				$vals['wr_subway_line_0'] = $_POST['wr_subway_line_0'];				// 인근 지하철 호선 0
				$vals['wr_subway_station_0'] = $_POST['wr_subway_station_0'];		// 인근 지하철 역 0

				$wr_subway_content_0 = ($_POST['wr_subway_content_0']=='출구, 소요시간을 입력해주세요.') ? "" : $_POST['wr_subway_content_0'];
				$vals['wr_subway_content_0'] = $wr_subway_content_0;					// 인근 지하철 출구,소요시간 0
				$vals['wr_subway_area_1'] = $_POST['wr_subway_area_1'];				// 인근 지하철 지역 1
				$vals['wr_subway_line_1'] = $_POST['wr_subway_line_1'];				// 인근 지하철 호선 1
				$vals['wr_subway_station_1'] = $_POST['wr_subway_station_1'];		// 인근 지하철 역 1

				$wr_subway_content_1 = ($_POST['wr_subway_content_1']=='출구, 소요시간을 입력해주세요.') ? "" : $_POST['wr_subway_content_1'];
				$vals['wr_subway_content_1'] = $wr_subway_content_1;					// 인근 지하철 출구,소요시간 1
				$vals['wr_subway_area_2'] = $_POST['wr_subway_area_2'];				// 인근 지하철 지역 2
				$vals['wr_subway_line_2'] = $_POST['wr_subway_line_2'];				// 인근 지하철 호선 2
				$vals['wr_subway_station_2'] = $_POST['wr_subway_station_2'];		// 인근 지하철 역 2

				$wr_subway_content_2 = ($_POST['wr_subway_content_2']=='출구, 소요시간을 입력해주세요.') ? "" : $_POST['wr_subway_content_2'];
				$vals['wr_subway_content_2'] = $wr_subway_content_2;					// 인근 지하철 출구,소요시간 2

				$vals['wr_college_area'] = $_POST['wr_college_area'];			// 대학 지역
				$vals['wr_college_vicinity'] = $_POST['wr_college_vicinity'];	// 인근대학

				$use_photo = $_POST['wr_use_photo'];	// 회사 이미지 사용 유무
				$vals['wr_use_photo'] = ($use_photo) ? $use_photo : 0;

				$vals['wr_date'] = $_POST['wr_date'];
				$vals['wr_week'] = $_POST['wr_week'];

				$time_conference = $_POST['wr_time_conference'];	 // 시간협의
				if(!$time_conference){	// 시간협의가 아닐때만
					$vals['wr_stime'] = @implode($_POST['wr_stime'],':');	// 근무 시작시간
					$vals['wr_etime'] = @implode($_POST['wr_etime'],':');	// 근무 종료시간
				}
				$vals['wr_time_conference'] = $time_conference;

				$vals['wr_pay_type'] = $_POST['wr_pay_type'];	// 급여조건
				$vals['wr_pay'] = str_replace(",","",$_POST['wr_pay']);				// 급여
				$vals['wr_pay_conference'] = $_POST['wr_pay_conference'];	// 협의가능 유무
				$vals['wr_pay_support'] = @implode($_POST['wr_pay_support'],',');	// 급여 지원 조건

				$vals['wr_work_type'] = @implode($_POST['wr_work_type'],',');	// 근무 형태

				$vals['wr_welfare_read'] = $_POST['welfare_read'];		// 복리후생 텍스트
				$vals['wr_welfare'] = serialize($_POST['wr_welfare']);	// 복리후생 체크 데이터
				/* //업무내용 및 근무지정보 */


				/* 지원 조건 */
				$vals['wr_gender'] = $_POST['wr_gender'];	// 무관 : 0 , 남자 : 1 , 여자 : 2
				$age_limit = $_POST['wr_age_limit'];
				$vals['wr_age_limit'] = $age_limit;
				if($age_limit) {	// 연령제한이 있다면
					$vals['wr_age'] = $_POST['wr_sage'] . "-" . $_POST['wr_eage'];
				}
				$vals['wr_age_etc'] = @implode($_POST['wr_age_etc'],',');	// 연령 기타 정보

				$vals['wr_ability'] = $_POST['wr_ability'];	 // 학력

				$career_type = $_POST['wr_career_type'];
				$vals['wr_career_type'] = $career_type;	// 경력사항
				if($career_type == 2){	// 경력
					$vals['wr_career'] = $_POST['wr_career'];
				}

				$vals['wr_preferential'] = @implode($_POST['wr_preferential'],',');	 // 우대조건
				/* //지원 조건 */

				
				/* 모집내용 */
				$vals['wr_volume'] = ($_POST['wr_volume']) ? $_POST['wr_volume'] : "";	// 모집인원
				$vals['wr_volumes'] = @implode($_POST['wr_volumes'],',');	// 0, 00명
				$vals['wr_target'] = @implode($_POST['wr_target'],',');	// 모집 대상

				$volume_check = $_POST['volume_check'];	 // 모집종료일 종류 선택

				if($volume_check=='wr_volume_dates'){	 // 모집일 선택
					$vals['wr_volume_date'] = $_POST['wr_volume_date'];	 // 모집 종료일
				} else if($volume_check=='wr_volume_always'){	// 상시모집
					$vals['wr_volume_always'] = 1;
				} else if($volume_check=='wr_volume_end'){	// 채용시까지
					$vals['wr_volume_end'] = 1;
				}

				/*
				$volume_always = $_POST['wr_volume_always'];	 // 상시모집
				$volume_end = $_POST['wr_volume_end'];	 // 채용시까지
				$vals['wr_volume_always'] = $volume_always;
				$vals['wr_volume_end'] = $volume_end;

				if($volume_always || $volume_end)	 // 상시모집, 채용시까지 체크
					$vals['wr_volume_date'] = "";
				else
					$vals['wr_volume_date'] = $_POST['wr_volume_date'];	 // 모집 종료일
				*/

				$vals['wr_requisition'] = @implode($_POST['wr_requisition'],',');	// 접수방법
				$vals['wr_homepage'] = ($_POST['wr_homepage']) ? $utility->add_http($_POST['wr_homepage']) : "";	// 홈페이지 주소

				$wr_form = $_POST['wr_form'];	// 자사양식지원
				$vals['wr_form'] = $wr_form;
				if($wr_form){
					$vals['wr_form_required'] = $_POST['wr_form_required'];
				}

					/* 양식 파일 업로드 */
					$attach_path = $alice['data_alba_abs_path'] . '/' . $ym;
					@mkdir($attach_path, 0707);
					@chmod($attach_path, 0707);
					$file = $attach_path . "/index.html";
					if(!file_exists($file)){	// 디렉토리 보안을 위해서
						$f = @fopen($file, "w"); @fwrite($f, ""); @fclose($f); @chmod($file, 0606);
					}
					$tmp_file	= $_FILES['wr_form_attach']['tmp_name'];
					$filename	= $_FILES['wr_form_attach']['name'];
					$filesize		= $_FILES['wr_form_attach']['size'];
					if(is_uploaded_file($tmp_file)){
						$file_extension = $alba_company_control->_file();	// 확장자 체크
						if(preg_match("/\.($file_extension)$/i", $filename)){ // 파일 확장자 체크
							if($mode=='update'){	 // 수정일때 업로드 파일이 있다면 기존 파일 삭제
								$form_attach = explode('/',$get_alba['wr_form_attach']);
								@unlink($attach_path . "/". $form_attach[1]);
							}
							$file_upload = $utility->file_upload($tmp_file, $filename, $attach_path, $_FILES);	// 파일 업로드
							$upload_file = $file_upload['upload_file'];
							$vals['wr_form_attach'] = $ym . "/" . $upload_file;
						}
					}
					/* //양식 파일 업로드 */

				$vals['wr_papers'] = @implode($_POST['wr_papers'],',');	// 제출서류
				$vals['wr_pre_question'] = $_POST['wr_pre_question'];		// 사전질문
				/* //모집내용 */

				$vals['wr_content'] = $_POST['wr_content'];		// 상세모집요강

				

				/* 등록/재등록 일때 등록날짜 업데이트 */
				if($mode=='insert' || $mode=='reinsert' || $mode=='load') {
					$vals['wr_wdate'] = $now_date;
					$vals['wr_jdate'] = $now_date;
				}

				$vals['wr_udate'] = $now_date;
				/* //등록/재등록 일때 등록날짜 업데이트 */

				if($mode=='insert' || $mode=='load'){	// 등록/불러오기

					$type = $_POST['type'];
					$page_rows = $_POST['page_rows'];
					$page = $_POST['page'];

					## 01. 알바공고 등록
					$result = $alba_company_control->alba_insert($vals);

					$last_no = $db->last_id();

					if($result){

						## 02. 회원 alba_count update
						$user_control->user_count_update('mb_alba_count',$mb_id,1);

						/* 03. 회사이미지 등록시 no 값을 추출하여 업데이트 */
						if($mode=='load'){

							$photo_con = " and `data_no` = '".$no."' ";
							$photo_list = $user_control->member_photo_list($mb_id, $photo_con, " order by `photo_no` asc ");

							if($photo_list){	// 사진 데이터가 있다면 alba_photos 를 기준으로 새롭게 등록	
								foreach($photo_list as $photo){
									$photo_vals['mb_type'] = $photo['mb_type'];
									$photo_vals['mb_id'] = $photo['mb_id'];
									$photo_vals['data_no'] = $last_no;
									$photo_vals['photo_table'] = $photo['photo_table'];
									$photo_vals['photo_no'] = $photo['photo_no'];
									if($photo['photo_source']){
										$photo_name = explode('/',$photo['photo_name']);
										$new_file = $utility->file_rename_copy($alice['data_alba_abs_path'].'/'.$photo_name[0], $alice['data_alba_abs_path'].'/'.$ym, $photo_name[1], $last_no);
										$photo_vals['photo_source'] = $new_file;
										$photo_vals['photo_name'] = $ym . '/' . $new_file;
									} else {
										$photo_vals['photo_source'] = "";
										$photo_vals['photo_name'] = "";
									}
									$photo_vals['photo_filesize'] = $photo['photo_filesize'];
									$photo_vals['photo_width'] = $photo['photo_width'];
									$photo_vals['photo_height'] = $photo['photo_height'];
									$photo_vals['photo_type'] = $photo['photo_type'];
									$photo_vals['photo_datetime'] = $now_date;
									// photo insert
									$user_control->user_photo_insert($photo_vals);
								}
							} else {
								if(!$use_photo){	// 회사 이미지를 사용하지 않았다면 별도 저장 테이블에서 가져온다
									for($i=0;$i<=4;$i++){
										$photo_vals['data_no'] = $last_no;
										$photo_vals['photo_datetime'] = $now_date;
										$user_control->user_photo_update($photo_vals, $mb_id, 'alba', $i, " and `data_no` = 0 ");
									}
								} else {
									for($i=0;$i<=4;$i++){
										$photo_vals['data_no'] = $photo_vals['photo_source'] = $photo_vals['photo_name'] = "";
										$photo_vals['photo_filesize'] = $photo_vals['photo_width'] = $photo_vals['photo_height'] = $photo_vals['photo_type'] = 0;
										$photo_vals['photo_datetime'] = $now_date;
										$user_control->user_photo_update($photo_vals, $mb_id, 'alba', $i, " and `data_no` = 0 ");
									}
								}
							}
						} else {
							if(!$use_photo){	// 회사 이미지를 사용하지 않았다면 별도 저장 테이블에서 가져온다
								for($i=0;$i<=4;$i++){
									$photo_vals['data_no'] = $last_no;
									$photo_vals['photo_datetime'] = $now_date;
									$user_control->user_photo_update($photo_vals, $mb_id, 'alba', $i, " and `data_no` = 0 ");
								}
							} else {
								for($i=0;$i<=4;$i++){
									$photo_vals['data_no'] = $photo_vals['photo_source'] = $photo_vals['photo_name'] = "";
									$photo_vals['photo_filesize'] = $photo_vals['photo_width'] = $photo_vals['photo_height'] = $photo_vals['photo_type'] = 0;
									$photo_vals['photo_datetime'] = $now_date;
									$user_control->user_photo_update($photo_vals, $mb_id, 'alba', $i, " and `data_no` = 0 ");
								}
							}
						}
						/* //03. 회사이미지 등록시 no 값을 추출하여 업데이트 */

						## 04. 결제 페이지 사용 유무
						$get_pg_page = $payment_control->get_pg_page(1);
						
						## 05. 공고 등록 SMS 발송
						$get_member = $member_control->get_member($mb_id);
						$get_alba = $alba_user_control->get_alba_no($last_no);
						//$mb_receive = explode(",",$get_member['mb_receive']);	// 수신여부 무관
						//if(@in_array('sms',$mb_receive)){	 // 문자 수신 확인
							$sms_control->send_sms_user('alba_regist', $get_member, "", $get_alba);
						//}

						if($get_pg_page['alba_pay']){	 // 공고 결제페이지 사용시

							## 04. 서비스 결제 페이지로 이동
							$utility->location_href( $alice['company_path']."/alba_service.php?no=".$last_no );

						} else {

							## 04. 결제 페이지 미사용시 서비스기간 부여
							$main_platinum = explode(" ",$get_pg_page['main_platinum']);	 // 메인 플래티넘
							if($main_platinum[0]){
								$alba_company_control->alba_interval('wr_service_platinum',$get_pg_page['main_platinum'],$last_no);
							}
							$main_prime = explode(" ",$get_pg_page['main_prime']);	 // 메인 프라임
							if($main_prime[0]){
								$alba_company_control->alba_interval('wr_service_prime',$get_pg_page['main_prime'],$last_no);
							}
							$main_grand = explode(" ",$get_pg_page['main_grand']);	 // 메인 그랜드
							if($main_grand[0]){
								$alba_company_control->alba_interval('wr_service_grand',$get_pg_page['main_grand'],$last_no);
							}
							$main_banner = explode(" ",$get_pg_page['main_banner']);	 // 메인 배너형
							if($main_banner[0]){
								$alba_company_control->alba_interval('wr_service_banner',$get_pg_page['main_banner'],$last_no);
							}
							$main_list = explode(" ",$get_pg_page['main_list']);	 // 메인 리스트형
							if($main_list[0]){
								$alba_company_control->alba_interval('wr_service_list',$get_pg_page['main_list'],$last_no);
							}
							$main_basic = explode(" ",$get_pg_page['main_basic']);	 // 메인 일반
							if($main_basic[0]){
								$alba_company_control->alba_interval('wr_service_basic',$get_pg_page['main_basic'],$last_no);
							}
							$alba_platinum = explode(" ",$get_pg_page['alba_platinum']);	 // 서브 플래티넘
							if($alba_platinum[0]){
								$alba_company_control->alba_interval('wr_service_platinum_sub',$get_pg_page['alba_platinum'],$last_no);
							}
							$alba_banner = explode(" ",$get_pg_page['alba_banner']);	 // 서브 배너형
							if($alba_banner[0]){
								$alba_company_control->alba_interval('wr_service_banner_sub',$get_pg_page['alba_banner'],$last_no);
							}
							$alba_list = explode(" ",$get_pg_page['alba_list']);	 // 서브 리스트형
							if($alba_list[0]){
								$alba_company_control->alba_interval('wr_service_list_sub',$get_pg_page['alba_list'],$last_no);
							}
							$alba_basic = explode(" ",$get_pg_page['alba_basic']);	 // 서브 일반
							if($alba_basic[0]){
								$alba_company_control->alba_interval('wr_service_basic_sub',$get_pg_page['alba_basic'],$last_no);
							}

							## 06. 공고 등록 포인트 지급

							## 07. 기업회원 페이지로 이동
							$is_type = ($type=='finish') ? "?type=".$type."&" : "?";
							$utility->location_href( $alice['company_path']."/alba_list.php".$is_type."page_rows=".$page_rows."&page=".$page );

						}

					}

				} else if($mode=='update' || $mode=='reinsert') {	// 수정/재등록

					$page_rows = $_POST['page_rows'];
					$page = $_POST['page'];

					## 01. 공고 수정/재등록
					$result = $alba_company_control->alba_update($vals,$no);

					if($result){

						/* 03. 회사이미지 등록시 no 값을 추출하여 업데이트 */
						$photo_con = " and `data_no` = '".$no."' ";
						$photo_list = $user_control->member_photo_list($mb_id, $photo_con, " order by `photo_no` asc ");

						if(!$use_photo){	// 회사 이미지를 사용하지 않았다면 별도 저장 테이블에서 가져온다
							for($i=0;$i<=4;$i++){
								$photo_vals['data_no'] = $no;
								$photo_vals['photo_datetime'] = $now_date;
								$user_control->user_photo_update($photo_vals, $mb_id, 'alba', $i, " and `data_no` = 0 ");
							}
						} else {
							for($i=0;$i<=4;$i++){
								$photo_vals['data_no'] = $photo_vals['photo_source'] = $photo_vals['photo_name'] = "";
								$photo_vals['photo_filesize'] = $photo_vals['photo_width'] = $photo_vals['photo_height'] = $photo_vals['photo_type'] = 0;
								$photo_vals['photo_datetime'] = $now_date;
								$user_control->user_photo_update($photo_vals, $mb_id, 'alba', $i, " and `data_no` = 0 ");
							}
						}
						/* //03. 회사이미지 등록시 no 값을 추출하여 업데이트 */

						## 04. 결제 페이지 사용 유무
						$get_pg_page = $payment_control->get_pg_page(1);

						## 05. 기업회원 페이지로 이동
						$is_type = ($type=='finish') ? "?type=".$type."&" : "?";
						$utility->location_href( $alice['company_path']."/alba_list.php".$is_type."page_rows=".$page_rows."&page=".$page );

					}

				}

			break;

			## 알바 근무회사 이미지 등록
			case 'alba_photo_upload':

				$get_member = $member_control->get_member($mb_id);
				$alba_photos = $_POST['alba_photos'];

				$photo_table = "alba";	// 작업 테이블

				// 디렉토리가 없는 경우 생성
				// 로고 및 회사 사진 저장 디렉토리
				$photos_path = $alice['data_alba_abs_path'] . '/' . $ym;
				@mkdir($photos_path, 0707);
				@chmod($photos_path, 0707);
				$file = $photos_path . "/index.html";
				if(!file_exists($file)){	// 디렉토리 보안을 위해서
					$f = @fopen($file, "w"); @fwrite($f, ""); @fclose($f); @chmod($file, 0606);
				}

				$tmp_file	= $_FILES['alba_photo_files']['tmp_name'];
				$filename	= $_FILES['alba_photo_files']['name'];
				$filesize		= $_FILES['alba_photo_files']['size'];

				$timg = @getimagesize($tmp_file);

				if($type=='load'){
					$no = 0;
				} else {
					$no = ($no) ? $no : 0;
				}
				//$photo_con = ($no) ? " and `data_no` = '".$no."' and `photo_table` = '".$photo_table."' " : " and `data_no` = '0' and `photo_table` = 'alba' ";
				$photo_con = " and `data_no` = '".$no."' and `photo_table` = '".$photo_table."' ";
				$photo_list = $user_control->member_photo_list($mb_id, $photo_con);

				if($photo_list){	// 사진 데이터가 있다면 alba_photos 를 기준으로 수정

					if(is_uploaded_file($tmp_file)){

						// 사이즈 체크

						// 용량 체크 (관리자에서 설정한 용량)

						// 확장자 체크
						$img_extension = $user_control->_img();

						if(preg_match("/\.($img_extension)$/i", $filename)){ // 파일 확장자 체크
							$photo = $user_control->get_member_photo($mb_id,$alba_photos," and `data_no` = '".$no."' ");
							@unlink($photos_path . "/". $photo);	 // 기존 파일 삭제
							$file_upload = $utility->file_upload($tmp_file, $filename, $photos_path, $_FILES);	// 파일 업로드
							$upload_file = $file_upload['upload_file'];
							$vals['photo_source'] = $filename;
							$vals['photo_name'] = $ym . "/" . $upload_file;
							$vals['photo_filesize'] = $filesize;
							$vals['photo_width'] = $timg[0];
							$vals['photo_height'] = $timg[1];
							$vals['photo_type'] = $timg[2];
							$vals['photo_datetime'] = $now_date;

							// update
							$result = $user_control->user_photo_update($vals, $mb_id, $photo_table, $alba_photos, " and `data_no` = '".$no."' ");

						} else {
							echo "extension_error";
							exit;
						}
					}

				} else {	 // 사진 데이터가 없다면 alba_photos 를 기준으로 입력

					$vals['mb_type'] = $get_member['mb_type'];
					$vals['mb_id'] = $mb_id;
					$vals['photo_table'] = $photo_table;

					for($i=0;$i<=4;$i++){
						$vals['photo_no'] = $i;
						if($i==$alba_photos){
							if(is_uploaded_file($tmp_file)){

								// 사이즈 체크

								// 용량 체크 (관리자에서 설정한 용량)

								// 확장자 체크
								$img_extension = $user_control->_img();

								if(preg_match("/\.($img_extension)$/i", $filename)){ // 파일 확장자 체크
									$file_upload = $utility->file_upload($tmp_file, $filename, $photos_path, $_FILES);	// 파일 업로드
									$upload_file = $file_upload['upload_file'];
									$vals['photo_source'] = $filename;
									$vals['photo_name'] = $ym . "/" . $upload_file;
									$vals['photo_filesize'] = $filesize;
									$vals['photo_width'] = $timg[0];
									$vals['photo_height'] = $timg[1];
									$vals['photo_type'] = $timg[2];
									$vals['photo_datetime'] = $now_date;
								} else {
									echo "extension_error";
									exit;
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
						
					}
				}
				
				if($result){
					echo $ym."/".$upload_file;
				} else {
					$utility->popup_msg_ajax($user_control->_errors('0029'));
					exit;
				}

			break;

			## 알바 근무회사 이미지 삭제
			case 'alba_photo_delete':

				echo "<pre>";
				print_R($_POST);

			break;

			## 알바공고 삭제 (단수)
			case 'delete':

				$result = $alba_company_control->alba_delete($no,$mb_id);

				echo $result;

			break;

			## 알바공고 선택 삭제 (복수)
			case 'sel_delete':

				$no_cnt = count($no);
				for($i=0;$i<$no_cnt;$i++){
					$result = $alba_company_control->alba_delete($no[$i],$mb_id);
				}
			
				echo $result;

			break;

			## 지원자 정보 삭제 (alba_receive)
			case 'delete_receive':

				$no_cnt = count($no);
				for($i=0;$i<$no_cnt;$i++){
					//$result = $receive_control->delete_receive($no[$i]);
					$vals['is_delete'] = 1;	 // 삭제 처리
					$result = $receive_control->update_receive($vals,$no[$i]);
				}

				echo $result;
			
			break;

			## 강제마감
			case 'volume_end':
				
				$vals['wr_volume_date'] = "";		// 모집종료일 초기화
				$vals['wr_volume_always'] = 0;	// 상시모집 체크 해제
				$vals['wr_volume_end'] = 0;		// 채용시까지 체크 해제

				$result = $alba_company_control->alba_update($vals,$no);

				echo $result;

			break;
		}
?>