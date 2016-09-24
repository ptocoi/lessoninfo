<?php
		/*
		* /application/company/alba_regist.php
		* @author Harimao
		* @since 2013/07/29
		* @last update 2015/04/13
		* @Module v3.5 ( Alice )
		* @Brief :: Alba regist
		* @Comment :: 알바 공고 등록
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "company";

		$banner_atop_position = $page_name . "_top";
		$banner_logo_position = $page_name . "_logo_banner";
		$banner_top_position = $page_name . "_top_banner";
		$banner_left_position = $page_name . "_left";
		$banner_tail_position = $page_name . "_bottom";
		$banner_left_wing_position = $page_name . "_left_scroll";
		$banner_right_wing_position = $page_name . "_right_scroll";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$no = $_GET['no'];

		$get_alba = $alba_company_control->get_alba_no($no);


		if($no){
			$company_member = $member_control->get_company_memberNo($get_alba['wr_company']);	// no 기준
		} else {
			$company_member = $user_control->get_company($member['mb_id']);	// 대표 기업정보
			//$company_member = $user_control->get_member_company($get_company['mb_id']);	// 기업회원 정보
		}

		$company_con = " where `mb_id` = '".$member['mb_id']."' ";
		$company_list = $member_control->__CompanyList(1,"",$company_con);
	
		$mb_logo = (is_file($mb_logo_file)) ? $mb_logo_file : "../images/basic/bg_noLogo.gif";	 // 기업회원 로고 사진

		/*
		$alba_logo_file = $alice['data_member_path']."/".$company_member['mb_id']."/logo/".$company_member['mb_logo'];
		$alba_logo = $alice['data_member_path']."/".$company_member['mb_id']."/logo/".$company_member['mb_logo'];
		*/

		// 기업정보를 기준으로 로고 추출
		$alba_logo = $alba_user_control->get_logo($company_member);

		$photo_0 = $user_control->get_member_photo($member['mb_id'], 0, " and `company_no` = '".$company_member['no']."' ");
		$photo_0_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_0;
		$photo_0 = (is_file($photo_0_file)) ? $photo_0_file : "../images/comn/no_profileimg.gif";

		$photo_1 = $user_control->get_member_photo($member['mb_id'], 1, " and `company_no` = '".$company_member['no']."' ");
		$photo_1_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_1;
		$photo_1 = (is_file($photo_1_file)) ? $photo_1_file : "../images/comn/no_profileimg.gif";

		$photo_2 = $user_control->get_member_photo($member['mb_id'], 2, " and `company_no` = '".$company_member['no']."' ");
		$photo_2_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_2;
		$photo_2 = (is_file($photo_2_file)) ? $photo_2_file : "../images/comn/no_profileimg.gif";

		$photo_3 = $user_control->get_member_photo($member['mb_id'], 3, " and `company_no` = '".$company_member['no']."' ");
		$photo_3_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_3;
		$photo_3 = (is_file($photo_3_file)) ? $photo_3_file : "../images/comn/no_profileimg.gif";

		$photo_4 = $user_control->get_member_photo($member['mb_id'], 4, " and `company_no` = '".$company_member['no']."' ");
		$photo_4_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_4;
		$photo_4 = (is_file($photo_4_file)) ? $photo_4_file : "../images/comn/no_profileimg.gif";

		if($mode=='update' || $mode=='reinsert' || $mode=='load'){	// 수정/재등록/불러오기
			if($no){
				if(!$get_alba){	// 공고가 존재하지 않거나, 삭제된 데이터 입니다.
					$utility->popup_msg_js($alba_company_control->_errors('0003'));
					exit;
				}
				if($get_alba['wr_id'] != $member['mb_id']){	// 자신이 등록한 공고만 수정 가능합니다.
					$utility->popup_msg_js($alba_company_control->_errors('0001'));
					exit;
				}
			} else {	 // 채용공고 고유 데이터 번호가 잘못 되었습니다.\\n\\n해당 공고가 삭제되었거나 공고에 문제가 있을수 있습니다.
				$utility->popup_msg_js($alba_company_control->_errors('0004'));
				exit;
			}

			$wr_subject = $utility->remove_quoted($get_alba['wr_subject']);

			$wr_phone = explode('-',$get_alba['wr_phone']);
			$wr_hphone = explode('-',$get_alba['wr_hphone']);
			$wr_fax = explode('-',$get_alba['wr_fax']);

			$wr_email = explode('@',$get_alba['wr_email']);

			$wr_job_type0 = $get_alba['wr_job_type0'];
			$wr_job_type1 = $get_alba['wr_job_type1'];
			$wr_job_type2 = $get_alba['wr_job_type2'];

			$wr_job_type3 = $get_alba['wr_job_type3'];
			$wr_job_type4 = $get_alba['wr_job_type4'];
			$wr_job_type5 = $get_alba['wr_job_type5'];

			$wr_job_type6 = $get_alba['wr_job_type6'];
			$wr_job_type7 = $get_alba['wr_job_type7'];
			$wr_job_type8 = $get_alba['wr_job_type8'];

			$wr_area_0 = explode('/',$get_alba['wr_area_0']);
			$wr_area_1 = explode('/',$get_alba['wr_area_1']);
			$wr_area_2 = explode('/',$get_alba['wr_area_2']);

			$wr_subway_area_0 = $get_alba['wr_subway_area_0'];
			$wr_subway_line_0 = $get_alba['wr_subway_line_0'];
			$wr_subway_station_0 = $get_alba['wr_subway_station_0'];
			$wr_subway_content_0 = $get_alba['wr_subway_content_0'];
			$wr_subway_area_1 = $get_alba['wr_subway_area_1'];
			$wr_subway_line_1 = $get_alba['wr_subway_line_1'];
			$wr_subway_station_1 = $get_alba['wr_subway_station_1'];
			$wr_subway_content_1 = $get_alba['wr_subway_content_1'];
			$wr_subway_area_2 = $get_alba['wr_subway_area_2'];
			$wr_subway_line_2 = $get_alba['wr_subway_line_2'];
			$wr_subway_station_2 = $get_alba['wr_subway_station_2'];
			$wr_subway_content_2 = $get_alba['wr_subway_content_2'];

			$wr_college_area = $get_alba['wr_college_area'];
			$wr_college_vicinity = $get_alba['wr_college_vicinity'];

			$wr_use_photo = $get_alba['wr_use_photo'];

			if($wr_use_photo){	 // 회사이미지 사용

				$wr_photo_0 = $photo_0;
				$wr_photo_1 = $photo_1;
				$wr_photo_2 = $photo_2;
				$wr_photo_3 = $photo_3;
				$wr_photo_4 = $photo_4;

			} else {

				// 등록 이미지 정보 추출
				$wr_photo = $user_control->member_photo_list($get_alba['wr_id']," and `data_no` = '".$no."' ", " order by `photo_no` asc ");

				$photo_0_file = $alice['data_alba_path'] . "/" . $wr_photo[0]['photo_name'];
				$wr_photo_0 = (is_file($photo_0_file)) ? $photo_0_file : "../images/comn/no_profileimg.gif";
				$photo_1_file = $alice['data_alba_path'] . "/" . $wr_photo[1]['photo_name'];
				$wr_photo_1 = (is_file($photo_1_file)) ? $photo_1_file : "../images/comn/no_profileimg.gif";
				$photo_2_file = $alice['data_alba_path'] . "/" . $wr_photo[2]['photo_name'];
				$wr_photo_2 = (is_file($photo_2_file)) ? $photo_2_file : "../images/comn/no_profileimg.gif";
				$photo_3_file = $alice['data_alba_path'] . "/" . $wr_photo[3]['photo_name'];
				$wr_photo_3 = (is_file($photo_3_file)) ? $photo_3_file : "../images/comn/no_profileimg.gif";
				$photo_4_file = $alice['data_alba_path'] . "/" . $wr_photo[4]['photo_name'];
				$wr_photo_4 = (is_file($photo_4_file)) ? $photo_4_file : "../images/comn/no_profileimg.gif";

			}

			$wr_stime = explode(':',$get_alba['wr_stime']);
			$wr_etime = explode(':',$get_alba['wr_etime']);
			$wr_time_conference = $get_alba['wr_time_conference'];

			$wr_pay_support = explode(',',$get_alba['wr_pay_support']);
			$wr_welfare = unserialize($get_alba['wr_welfare']);
			
			$wr_age_limit = $get_alba['wr_age_limit'];
			$wr_age = explode('-',$get_alba['wr_age']);
			$wr_age_etc = explode(',',$get_alba['wr_age_etc']);

			$wr_career_type = $get_alba['wr_career_type'];
			$wr_preferential = explode(',',$get_alba['wr_preferential']);
			$wr_volumes = explode(',',$get_alba['wr_volumes']);
			$wr_requisition = explode(',',$get_alba['wr_requisition']);
			$wr_form_attach = explode('/',$get_alba['wr_form_attach']);	// 등록된 양식 파일
			$wr_papers = explode(',',$get_alba['wr_papers']);

		} else {	 // 입력

			$mode = "insert";

			$wr_photo_0 = $wr_photo_1 = $wr_photo_2 = $wr_photo_3 = $wr_photo_4 = "../images/comn/no_profileimg.gif";

		}

		$past_list = $alba_company_control->past_alba_list($no,$member['mb_id']);



		/*
		$alba_photo_0 = $user_control->get_member_photo($member['mb_id'], 0);
		$alba_photo_0_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_0;
		$alba_photo_0 = (is_file($photo_0_file)) ? $photo_0_file : "../images/comn/no_profileimg.gif";

		$alba_photo_1 = $user_control->get_member_photo($member['mb_id'], 1);
		$alba_photo_1_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_1;
		$alba_photo_1 = (is_file($photo_1_file)) ? $photo_1_file : "../images/comn/no_profileimg.gif";

		$alba_photo_2 = $user_control->get_member_photo($member['mb_id'], 2);
		$alba_photo_2_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_2;
		$alba_photo_2 = (is_file($photo_2_file)) ? $photo_2_file : "../images/comn/no_profileimg.gif";

		$alba_photo_3 = $user_control->get_member_photo($member['mb_id'], 3);
		$alba_photo_3_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_3;
		$alba_photo_3 = (is_file($photo_3_file)) ? $photo_3_file : "../images/comn/no_profileimg.gif";
		*/

		$tel_num_option = $config->get_tel_num($wr_phone[0]);	 // 전화번호 국번
		$hp_num_option = $config->get_hp_num($wr_hphone[0]);	 // 휴대폰번호 국번
		$fax_num_option = $config->get_tel_num($wr_fax[0]);	 // 전화번호 국번
		$email_option = $config->get_email();	 // 이메일 서비스 제공자

		$job_type_list = $category_control->category_codeList('job_type','','yes');		// 직종
		$area_list = $category_control->category_codeList('area','','yes');					// 지역
		$subway_list = $category_control->category_codeList('subway','','yes');			// 지하철
		$alba_date_list = $category_control->category_codeList('alba_date');	// 알바근무기간
		$alba_week_list = $category_control->category_codeList('alba_week');	// 알바근무요일
		$alba_pay_list = $category_control->category_codeList('alba_pay');		// 알바급여조건
		$alba_pay_type_list = $category_control->category_codeList('alba_pay_type');		// 알바급여지원조건
		$job_welfare = $category_control->category_codeList('job_welfare');		// 복리후생
		$job_welfare_cnt = count($job_welfare);
		$job_age = $category_control->category_codeList('job_age');		// 연령특이사항
		$job_ability_list = $category_control->category_codeList('job_ability', '', 'yes');		// 학력조건
		$job_career_list = $category_control->category_codeList('job_career', '', 'yes');		// 경력조건
		$preferential_list = $category_control->category_codeList('preferential', '', 'yes');	// 우대조건
		$preferential_list_cnt = count($preferential_list);
		$alba_content_list = $category_control->category_codeList('alba_content', '', 'yes');	// 상세모집요강항목

		$job_target = $category_control->category_codeList('job_target','','yes');	 // 모집대상


		$use_map = $env['use_map'];	// 사용 지도 api
		$daum_local_key = $env['daum_local_key'];	// 다음 지도 local 검색 key
		$naver_map_key = $env['naver_map_key'];	// 네이버 지도 key

		$map_control->get_map();	 // 지도
		
		if($use_map=='daum'){
			$map_script = "<script src=\"//apis.daum.net/maps/maps3.js?apikey=".$env['daum_map_key']."&libraries=services\"></script>";
		} else {
			$map_script = "";
		}

		if($get_alba['wr_area_company']){	// 근무지 주소 0 : 직접입력 / 1 : 기업정보 위치
			$area_point = $company_member['mb_latlng'];
			$wr_area = $company_member['mb_biz_address0']." ".$company_member['mb_biz_address1'];
		} else {
			$area_point = $get_alba['wr_area_point'];
			$wr_area = $get_alba['wr_area'];
		}

		$wr_areas = explode(" ",$wr_area);
		$area_point_length = strlen($area_point);	// 네이년은 표준 WGS84 좌표를 사용하지 않기 때문에 길이 체크해서 변환해야 한다.

		if($mode=='insert'){
			$wr_area_03_val = $wr_area_13_val = $wr_area_23_val = "번지수 입력";
			$wr_subway_content_0_val = $wr_subway_content_1_val = $wr_subway_content_2_val = "출구, 소요시간을 입력해주세요.";
			$wr_area_point = "37.537187, 127.005476";
		} else if($mode=='update' || $mode=='reinsert' || $mode=='load'){
			$wr_area_0 = explode('/',$get_alba['wr_area_0']);
			$wr_area_03_val = ($wr_area_0[3]!='') ? $wr_area_0[3] : "번지수 입력";
			$wr_area_1 = explode('/',$get_alba['wr_area_1']);
			$wr_area_13_val = ($wr_area_1[3]!='') ? $wr_area_1[3] : "번지수 입력";
			$wr_area_2 = explode('/',$get_alba['wr_area_2']);
			$wr_area_23_val = ($wr_area_2[3]!='') ? $wr_area_2[3] : "번지수 입력";
			$wr_subway_content_0_val = ($get_alba['wr_subway_content_0']!='') ? stripslashes($get_alba['wr_subway_content_0']) : "출구, 소요시간을 입력해주세요.";
			$wr_subway_content_1_val = ($get_alba['wr_subway_content_1']!='') ? stripslashes($get_alba['wr_subway_content_1']) : "출구, 소요시간을 입력해주세요.";
			$wr_subway_content_2_val = ($get_alba['wr_subway_content_2']!='') ? stripslashes($get_alba['wr_subway_content_2']) : "출구, 소요시간을 입력해주세요.";
			$wr_area_point = $area_point;
		}

		$category_list = $category_control->category_codeList('alba_form', " `rank` asc ", "yes");	// 입력항목 목록

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
		$form_homepage = $category_control->get_categoryCode('20150310111848_8556');	// 홈페이지

		$wr_work_type = explode(",",$get_alba['wr_work_type']);	// 근무형태

		$pt_papers = $category_control->category_codeList('pt_paper','','yes');	 // 제출서류
		$manager_info = $company_manager_control->__ManagerList("",""," where `wr_id` = '".$member['mb_id']."' ");	 // 담당자 정보

		/*
		echo "<pre>";
		print_R($pt_papers);
		echo "</pre>";
		*/

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form','placeholder'));

		##
		# Call Editor
		echo "<script src='".$alice['editor_path']."/cheditor/cheditor.js'></script>";
		echo $utility->call_cheditor("wr_content", '100%', '580px');

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_regist.html'))
			include_once $alice['self'] . 'views/alba_regist.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_regist.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>