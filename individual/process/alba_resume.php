<?php
		/*
		* /application/individual/process/alba_resume.php
		* @author Harimao
		* @since 2013/07/16
		* @last update 2015/04/13
		* @Module v3.5 ( Alice )
		* @Brief :: Alba resume process
		* @Comment :: 정규직 이력서 처리 프로세스
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
		$mb_no = $_POST['mb_no'];

		$get_member = $member_control->get_member($mb_id);

		switch($mode){

			## 이력서 등록/수정/읽어오기
			case 'insert':
			case 'update':
			case 'load':

				if($mode=='insert' || $mode=='load') $vals['wr_id'] = $mb_id;

				/*
				$wr_use = $_POST['wr_use'];
				$vals['wr_use'] = $wr_use;		// 기본 이력서 유무
				if($wr_use){	// 기본 이력서로 설정했다면, 기존 이력서들은 모두 기본 이력서 초기화
					$alba_individual_control->initial_use($mb_id);
				}
				*/

				$vals['wr_open'] = $_POST['wr_open'];	// 공개 유무

				$wr_subject = $_POST['wr_subject'];
				$vals['wr_subject'] = $wr_subject;

				/* 근무지 */
				$vals['wr_area0'] = $_POST['wr_area0'];
				$vals['wr_area1'] = $_POST['wr_area1'];

				$vals['wr_area2'] = $_POST['wr_area2'];
				$vals['wr_area3'] = $_POST['wr_area3'];

				$vals['wr_area4'] = $_POST['wr_area4'];
				$vals['wr_area5'] = $_POST['wr_area5'];
				/* //근무지 */

				$vals['wr_home_work'] = $_POST['wr_home_work'];	// 재택가능

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

				$vals['wr_age'] = $member_control->get_age($get_member['mb_birth'], $get_member['mb_foreigner']);	// 나이
				$vals['wr_gender'] = $get_member['mb_gender'];	// 성별

				/* 근무일시 */
				$vals['wr_date'] = $_POST['wr_date'];			// 근무기간
				$vals['wr_week'] = $_POST['wr_week'];		// 근무요일
				$vals['wr_time'] = $_POST['wr_time'];			// 근무시간
				$vals['wr_work_direct'] = $_POST['wr_work_direct'];	// 즉시출근가능
				/* //근무일시 */

				/* 급여 */
				$vals['wr_pay_type'] = $_POST['wr_pay_type'];	// 급여조건
				$vals['wr_pay'] = str_replace(",","",$_POST['wr_pay']);					// 급여금액
				$vals['wr_pay_conference'] = $_POST['wr_pay_conference'];	// 추후협의
				/* //급여 */

				$vals['wr_work_type'] = ($_POST['wr_work_type']) ? @implode($_POST['wr_work_type'],',') : "";	// 근무형태

				/* 학력사항 */
				$vals['wr_school_ability'] = $_POST['wr_school_ability'];			// 최종학력
				$vals['wr_school_absence'] = $_POST['wr_school_absence'];		// 휴학중
				$wr_school_type = $_POST['wr_school_type'];
				$wr_school_type_cnt = count($wr_school_type);
				$vals['wr_school_type'] = ($wr_school_type) ? @implode($wr_school_type,',') : "";	// 입력한 학력

				$vals['wr_high_school_name'] = ($_POST['wr_high_school_name']=='출신학교 선택') ? "" : $_POST['wr_high_school_name'];		// 출신 고등학교
				$vals['wr_high_school_syear'] = $_POST['wr_high_school_syear'];		// 고등학교 입학년도
				$vals['wr_high_school_eyear'] = $_POST['wr_high_school_eyear'];	// 고등학교 졸업년도
				$vals['wr_high_school_graduation'] = $_POST['wr_high_school_graduation'];	// 고등학교 졸업여부

					/* 대학(2,3년) 정보 */
					$wr_half = array();
					$wr_half['college'] = $_POST['wr_half_college'];
					$wr_half['college_specialize'] = $_POST['wr_half_college_specialize'];
					$wr_half['college_syear'] = $_POST['wr_half_college_syear'];
					$wr_half['college_eyear'] = $_POST['wr_half_college_eyear'];
					$wr_half['college_graduation'] = $_POST['wr_half_college_graduation'];

					$vals['wr_half_college'] = ($wr_half['college'][0] != '') ? serialize($wr_half) : "";	// 변수 할당
					/* //대학(2,3년) 정보 */
					
					/* 대학(4년) 정보 */
					$wr_college = array();
					$wr_college['college'] = $_POST['wr_college'];
					$wr_college['college_specialize'] = $_POST['wr_college_specialize'];
					$wr_college['college_syear'] = $_POST['wr_college_syear'];
					$wr_college['college_eyear'] = $_POST['wr_college_eyear'];
					$wr_college['college_graduation'] = $_POST['wr_college_graduation'];

					$vals['wr_college'] = ($wr_college['college'][0] != '') ? serialize($wr_college) : "";	// 변수 할당
					/* //대학(4년) 정보 */

					/* 대학원 정보 */
					$wr_graduate = array();
					$wr_graduate['graduate'] = $_POST['wr_graduate'];
					$wr_graduate['graduate_specialize'] = $_POST['wr_graduate_specialize'];
					$wr_graduate['graduate_grade'] = $_POST['wr_graduate_grade'];
					$wr_graduate['graduate_syear'] = $_POST['wr_graduate_syear'];
					$wr_graduate['graduate_eyear'] = $_POST['wr_graduate_eyear'];
					$wr_graduate['graduate_graduation'] = $_POST['wr_graduate_graduation'];

					$vals['wr_graduate'] = ($wr_graduate['graduate'][0] != '') ? serialize($wr_graduate) : "";	// 변수 할당
					/* //대학원 정보 */

					/* 대학원 이상 정보 */
					$wr_success = array();
					$wr_success['success'] = $_POST['wr_success'];
					$wr_success['success_specialize'] = $_POST['wr_success_specialize'];
					$wr_success['success_grade'] = $_POST['wr_success_grade'];
					$wr_success['success_syear'] = $_POST['wr_success_syear'];
					$wr_success['success_eyear'] = $_POST['wr_success_eyear'];
					$wr_success['success_graduation'] = $_POST['wr_success_graduation'];

					$vals['wr_success'] = ($wr_success['success'][0] !='' ) ? serialize($wr_success) : "";	// 변수 할당
					/* //대학원 이상 정보 */

				/* //학력사항 */

				/* 경력사항 */
				$wr_career_use = $_POST['wr_career_use'];
				$vals['wr_career_use'] = $wr_career_use;
				if($wr_career_use){	// 경력이 있다면
					$wr_career = array();
					$wr_career_company = $_POST['wr_career_company'];
					$wr_career_company_cnt = count($wr_career_company);
					for($i=0;$i<$wr_career_company_cnt;$i++){
						$wr_career[$i]['company'] = $wr_career_company[$i];		// 회사명
						$wr_career[$i]['type'] = $_POST['wr_career_type_'.$i];	// 직종
						$wr_career[$i]['sdate'] = $_POST['wr_career_syear'][$i] . '-' . sprintf('%02d',$_POST['wr_career_smonth'][$i]);
						$wr_career[$i]['edate'] = $_POST['wr_career_eyear'][$i] . '-' . sprintf('%02d',$_POST['wr_career_emonth'][$i]);
						$wr_career[$i]['job'] = $_POST['wr_career_job'][$i];
						$wr_career[$i]['content'] = $_POST['wr_career_content'][$i];
					}

					$vals['wr_career'] = serialize($wr_career);	// 변수 할당
				}
				/* //경력사항 */

				/* 자격증 */
				$wr_license_use = $_POST['wr_license_use'];
				$vals['wr_license_use'] = $wr_license_use;
				if($wr_license_use){
					$wr_license = array();
					$wr_license_name = $_POST['wr_license_name'];
					$wr_license_name_cnt = count($wr_license_name);
					for($i=0;$i<$wr_license_name_cnt;$i++){
						$wr_license[$i]['name'] = $wr_license_name[$i];					// 자격증명
						$wr_license[$i]['public'] = $_POST['wr_license_public'][$i];	// 자격증 발행처
						$wr_license[$i]['year'] = $_POST['wr_license_year'][$i];		// 취득연도
					}

					$vals['wr_license'] = serialize($wr_license);	//  변수 할당
				}
				/* //자격증 */

				/* 외국어 */
				$wr_language_use = $_POST['wr_language_use'];
				$vals['wr_language_use'] = $wr_language_use;
				if($wr_language_use){
					$wr_language = array();
					$wr_language_name = $_POST['wr_language_name'];
					$wr_language_name_cnt = count($wr_language_name);	// 가능한 외국어 건수
					for($i=0;$i<$wr_language_name_cnt;$i++){
						$wr_language[$i]['language'] = $wr_language_name[$i];			// 가능한 외국어
						$wr_language[$i]['level'] = $_POST['wr_language_level_'.$i];	// 외국어 수준

						$wr_language[$i]['license']['license'] = $_POST['language_license_'.$i];			// 공인시험
						$wr_language[$i]['license']['level'] = $_POST['language_license_level_'.$i];	// 공인시험 점수
						$wr_language[$i]['license']['year'] = $_POST['language_license_year_'.$i];	// 공인시험 취득연도

						if( $_POST['wr_language_study_'.$i] ){
							$wr_language[$i]['study'] = $_POST['wr_language_study_'.$i];					// 어학연수 경험
							$wr_language[$i]['study_date'] = $_POST['wr_language_study_date_'.$i];	// 어학연수 기간
						}
					}

					$vals['wr_language'] = serialize($wr_language);	// 변수 할당
				}
				/* //외국어 */

				$vals['wr_oa'] = ($_POST['wr_oa']) ? serialize($_POST['wr_oa']) : "";		// OA 능력
				$vals['wr_computer'] = ($_POST['wr_computer']) ? @implode($_POST['wr_computer'],',') : "";	// 컴퓨터능력

				$vals['wr_specialty'] = ($_POST['wr_specialty']) ? @implode($_POST['wr_specialty'],',') : "";		// 특기사항
				$wr_specialty_etc = ($_POST['wr_specialty_etc']) ? 1 : 0;
				$vals['wr_specialty_etc'] = $wr_specialty_etc ."//" . $_POST['wr_specialty_etc_val'];		// 기타 특기사항 내용 (직접 입력)

				$vals['wr_prime'] = $_POST['wr_prime'];				// 수상/수료 활동내역
				$vals['wr_introduce'] = $_POST['wr_introduce'];	// 자기소개서

				$wr_impediment_use = $_POST['wr_impediment_use'];			// 장애여부
				$vals['wr_impediment_use'] = $wr_impediment_use;
				if($wr_impediment_use){
					$vals['wr_impediment_level'] = $_POST['wr_impediment_level'];		// 장애 등급
					$vals['wr_impediment_name'] = $_POST['wr_impediment_name'];		// 장애 내용
				}

				$vals['wr_marriage'] = $_POST['wr_marriage'];	// 결혼여부

				$wr_military = $_POST['wr_military'];	// 병역여부
				$vals['wr_military'] = $wr_military;
				if($wr_military == 1){	// 군필
					$vals['wr_military_type'] = $_POST['wr_military_type'];
				}
				
				$vals['wr_preferential_use'] = $_POST['wr_preferential_use'];	// 국가보훈 대상자
				$vals['wr_treatment_use'] = $_POST['wr_treatment_use'];		// 고용지원금 대상자
				$vals['wr_treatment_service'] = ($_POST['wr_treatment_service']) ? @implode($_POST['wr_treatment_service'],',') : "";	// 고용지원금 대상자 분류

				$vals['wr_calltime'] = ($_POST['wr_calltime']) ? @implode($_POST['wr_calltime'],'-') : "";		// 통화가능시간
				$vals['wr_calltime_always'] = $_POST['wr_calltime_always'];		// 통화가능시간 (언제나 가능)

				//$vals['wr_hit'] = 1;
				$vals['wr_udate'] = $now_date;

				// 이력서 등록/불러오기 시
				if($mode=='insert' || $mode=='load'){

					$vals['wr_wdate'] = $now_date;	 // 등록 시 등록날짜 업데이트

					## 01. 이력서 등록
					$result = $alba_individual_control->insert_resume($vals);

					$last_no = $db->last_id();

					if($result){

						## 02. 회원 resume_count update
						$user_control->user_count_update('mb_alba_resume_count',$mb_id,1);

						## 03. 결제 페이지 사용 유무
						$get_pg_page = $payment_control->get_pg_page(1);

						## 04. 이력서 등록 SMS 발송
						$get_resume = $alba_resume_user_control->get_resume_no($last_no);
						//$mb_receive = explode(",",$get_member['mb_receive']);	// 수신여부 무관
						//if(@in_array('sms',$mb_receive)){	 // 문자 수신 확인
							$sms_control->send_sms_user('alba_resume_regist', $get_member, "", $get_resume);
						//}

						if($get_pg_page['alba_resume_pay']){	 // 이력서 결제페이지 사용시

							## 05. 서비스 결제 페이지로 이동
							$utility->location_href( $alice['individual_path']."/alba_resume_service.php?no=".$last_no );

						} else {

							## 05. 결제 페이지 미사용시 서비스기간 부여
							/*
							$alba_resume_list = explode(' ',$get_pg_page['alba_resume_list']);			// 일반 리스트
							if($alba_resume_list[0]){
								$alba_individual_control->individual_interval('wr_service',$get_pg_page['alba_resume_list'],$last_no);
							}
							*/
							$main_resume_focus = explode(' ',$get_pg_page['main_resume_focus']);		// 메인 포커스 인재
							if($main_resume_focus[0]){
								$alba_individual_control->individual_interval('wr_service_main_focus',$get_pg_page['main_resume_focus'],$last_no);
							}
							$main_resume_basic = explode(' ',$get_pg_page['main_resume_basic']);		// 메인 일반 인재
							if($main_resume_basic[0]){
								$alba_individual_control->individual_interval('wr_service_basic',$get_pg_page['main_resume_basic'],$last_no);
							}
							$alba_resume_focus = explode(' ',$get_pg_page['alba_resume_focus']);	// 인재포커스
							if($alba_resume_focus[0]){
								$alba_individual_control->individual_interval('wr_service_focus',$get_pg_page['alba_resume_focus'],$last_no);
							}
							$alba_resume_basic = explode(' ',$get_pg_page['alba_resume_basic']);		// 인재 일반
							if($alba_resume_basic[0]){
								$alba_individual_control->individual_interval('wr_service_basic_sub',$get_pg_page['alba_resume_basic'],$last_no);
							}
							$alba_resume_busy = explode(' ',$get_pg_page['alba_resume_busy']);		// 급구인재
							if($alba_resume_busy[0]){
								$alba_individual_control->individual_interval('wr_service_busy',$get_pg_page['alba_resume_busy'],$last_no);
							}

							## 06. 이력서 등록 포인트 지급
							/*
								$point_control->point_insert($mb_id, $env['individual_point'], $alice['time_ymd']." 정규직 이력서 [".$wr_subject."] 등록", "@alba_resume", $mb_id, $alice['time_ymd']);	// 일반 포인트 지급
								$point_control->point_insert_percent($mb_id,10000,$alice['time_ymd']." 정규직 이력서 [".$wr_subject."] 등록 (결제금액 ".number_format(10000)."의 ".$env['alba_resume_point_percent']."%)","@alba_resume", $last_no, $alice['time_ymd']);	 // 백분율 포인트 지급
							*/


							## 07. 개인회원 페이지로 이동
							$utility->location_href( $alice['individual_path']."/alba_resume_list.php" );

						}

					} else {

						$utility->popup_msg_js($alba_individual_control->_errors('0000'));

					}

				// 이력서 수정시
				} else if($mode=='update'){	

					$no = $_POST['no'];
					$page_rows = $_POST['page_rows'];
					$page = $_POST['page'];

					## 01. 이력서 수정
					$result = $alba_individual_control->update_resume($vals, $no);

					if($result){

						## 02. 결제 페이지 사용 유무
						$get_pg_page = $payment_control->get_pg_page(1);

						/*
						if($get_pg_page['alba_resume_pay']){	 // 이력서 결제페이지 사용시

							## 03. 서비스 결제 페이지로 이동
							$utility->location_href( $alice['individual_path']."/alba_resume_service.php?no=".$no );

						} else {

							## 03. 개인회원 페이지로 이동
							$utility->location_href( $alice['individual_path']."/alba_resume_list.php?page_rows=".$page_rows."&page=".$page );

						}
						*/

						## 03. 개인회원 페이지로 이동
						$utility->location_href( $alice['individual_path']."/alba_resume_list.php?page_rows=".$page_rows."&page=".$page );

					} else {

						$utility->popup_msg_js($alba_individual_control->_errors('0007'));

					}

				}

			break;

			## 학교명 입력
			case 'insert_school':

				$type = $_POST['type'];
				$name = $_POST['name'];

				$vals['type'] = $type;
				$vals['code'] = $utility->get_unique_code();
				$vals['name'] = $name;

				$get_LastRank = $category_control->get_MaxRank($type);	// rank 최대값 구함

				$vals['rank'] = $get_LastRank + 1;

				$result = $category_control->insert_category($vals);

				echo $result;

			break;

			## 이력서 선택 삭제
			case 'sel_delete':

				$no = $_POST['no'];
				$no_count = count($no);

				for($i=0;$i<$no_count;$i++){
					$result = $alba_individual_control->delete_resume($no[$i],$mb_id);
				}

				echo $result;
			
			break;

			## 이력서 복사
			case 'sel_copy':

				$no = $_POST['no'];

				$result = $alba_individual_control->copy_resume($no,$mb_id);

				if($result){
					$user_control->user_count_update('mb_alba_resume_count',$mb_id,1);	// 회원 resume_count update
				}

				echo $result;

			break;

			## 이력서 공개/비공개 설정(단수)
			case 'is_oepn':

				$no = $_POST['no'];
				$is_open = $_POST['is_open'];

				$result = $alba_individual_control->resume_is_open($no,$mb_id,$is_open);

				echo $result;

			break;

			## 선택 이력서 공개/비공개 설정 (복수)
			case 'sel_open':

				$is_open = $_POST['is_open'];

				$no = $_POST['no'];
				$nos_cnt = count($no);

				for($i=0;$i<$nos_cnt;$i++){
					$result = $alba_individual_control->resume_is_open($no[$i],$mb_id,$is_open);
				}

				echo $result;
			
			break;
		}

?>