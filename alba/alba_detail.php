<?php
		/*
		* /application/alba/alba_detail.php
		* @author Harimao
		* @since 2013/08/01
		* @last update 2015/09/03
		* @Module v3.5 ( Alice )
		* @Brief :: Alba detail infomation
		* @Comment :: 정규직 공고 상세보기
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "alba";

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
		$sns_feed = explode(',',$env['sns_feed']);
		$no = $_GET['no'];
		if(!$no || $no==''){	// 채용공고 고유 데이터 번호가 잘못 되었습니다.\\n\\n해당 공고가 삭제되었거나 공고에 문제가 있을수 있습니다.
			$utility->popup_msg_js($alba_user_control->_errors('0003'));
			exit;
		}

		unset($view);
		$get_alba = $alba_user_control->get_alba_no($no);	// 정규직 정보

		if($get_alba['is_delete']){	// 삭제된 채용공고 입니다.
			$utility->popup_msg_js($alba_user_control->_errors('0004'));
			exit;
		}

		// 관리자 등록 유무
		$wr_is_admin = false;
		if($get_alba['wr_is_admin']){
			$wr_is_admin = true;
		}
		// 관리자 직접 등록 유무
		$is_self = false;
		if($get_alba['input_type']=='self'){
			$is_self = true;
		}
		

		// 공고 스크랩 여부
		$get_scrap_cnt = $alba_user_control->get_scrap_cnt($member['mb_id'],'alba',$no);
		$is_scrap = $get_scrap_cnt['cnt'];


		// 신고 여부
		/*
		if($get_alba['wr_report']){
			$utility->popup_msg_js($alba_user_control->_errors('0002'));
			exit;
		}
		*/

		/* 홈페이지 주소 */
		if($get_alba['wr_page']){
			$wr_homepage = "<a href='".$utility->add_http($get_alba['wr_page'])."' target='_blank'>".$utility->add_http($get_alba['wr_page'])."</a>";
		}
		/*
		if($get_alba['wr_homepage']){
			$wr_homepage = "<a href='".$utility->add_http($get_alba['wr_homepage'])."' target='_blank'>".$utility->add_http($get_alba['wr_homepage'])."</a>";
		}
		*/
		/* // 홈페이지 주소 */

		$wr_id = $get_alba['wr_id'];	// 작성자 id
		$wdate = substr($get_alba['wr_wdate'],0,10);	// 등록일

		$company_info = $user_control->get_member_company_no($get_alba['wr_company']);	 // 공고 등록회사 정보
		$company_info_url = "company_info.php?no=" . $get_alba['wr_company'];
		if( !$company_info){
			$company_info = $user_control->get_member_company($get_alba['wr_id']);
			$company_info_url = "company_info.php?mb_id=" . $company_info['mb_id'];
		}

		$use_photo = $get_alba['wr_use_photo'];	// 근무회사 이미지 / 회사이미지 사용유무

		$photo_0 = $user_control->get_member_photo($wr_id, 0, " and `company_no` = '".$company_member['no']."' ");
		$photo_0_file = $alice['data_member_path']."/".$wr_id."/photos/".$photo_0;
		$photo_0 = (is_file($photo_0_file)) ? $photo_0_file : "../images/comn/no_profileimg.gif";

		$photo_1 = $user_control->get_member_photo($wr_id, 1, " and `company_no` = '".$company_member['no']."' ");
		$photo_1_file = $alice['data_member_path']."/".$wr_id."/photos/".$photo_1;
		$photo_1 = (is_file($photo_1_file)) ? $photo_1_file : "../images/comn/no_profileimg.gif";

		$photo_2 = $user_control->get_member_photo($wr_id, 2, " and `company_no` = '".$company_member['no']."' ");
		$photo_2_file = $alice['data_member_path']."/".$wr_id."/photos/".$photo_2;
		$photo_2 = (is_file($photo_2_file)) ? $photo_2_file : "../images/comn/no_profileimg.gif";

		$photo_3 = $user_control->get_member_photo($wr_id, 3, " and `company_no` = '".$company_member['no']."' ");
		$photo_3_file = $alice['data_member_path']."/".$wr_id."/photos/".$photo_3;
		$photo_3 = (is_file($photo_3_file)) ? $photo_3_file : "../images/comn/no_profileimg.gif";

		$photo_4 = $user_control->get_member_photo($wr_id, 4, " and `company_no` = '".$company_member['no']."' ");
		$photo_4_file = $alice['data_member_path']."/".$wr_id."/photos/".$photo_4;
		$photo_4 = (is_file($photo_4_file)) ? $photo_4_file : "../images/comn/no_profileimg.gif";

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

		$info_link = "./company_info.php?no=" . $get_alba['wr_company'];

		$company_name = stripslashes($get_alba['wr_company_name']);
		$wr_company_name = stripslashes($get_alba['wr_company_name']);	 // 회사명

		/* 회사 로고 */
		if($is_self){
			if(file_exists($alice['data_alba_path']."/".$get_alba['etc_0']) && is_file($alice['data_alba_path']."/".$get_alba['etc_0']) ){
				$wr_logo = "<img class=\"vb\" alt=\"".$wr_company_name."\" src=\"".$alice['data_alba_path'] . "/". $get_alba['etc_0']."\" title=\"".$wr_company_name."\" style=\"max-width:200px;max-height:100px;\"/>";	// width=\"200\" height=\"100\"
			} else {
				$wr_logo = "<img class=\"vb\" src=\"".$alice['images_path']."/basic/bg_noLogo.gif\"/>";
			}
		} else {
			if(file_exists($alice['data_alba_path']."/".$get_alba['etc_0']) && is_file($alice['data_alba_path']."/".$get_alba['etc_0']) ){
				$wr_logo = "<img class=\"vb\" alt=\"".$wr_company_name."\" src=\"".$alice['data_alba_path'] . "/". $get_alba['etc_0']."\" title=\"".$wr_company_name."\" style=\"max-width:200px;max-height:100px;\"/>";	// width=\"200\" height=\"100\"
			} else {
				if( $get_logo != "../images/basic/bg_noLogo.gif" ){
					// 업소정보를 기준으로 로고 추출
					$get_logo = $alba_user_control->get_logo($company_info);
					$wr_logo = "<img class=\"vb\" src=\"".$get_logo."\" style=\"max-width:200px;max-height:100px;\"/>";
				} else {
					if(file_exists($alice['data_alba_path']."/".$get_alba['etc_0']) && is_file($alice['data_alba_path']."/".$get_alba['etc_0'])){
						$wr_logo = "<img class=\"vb\" alt=\"".$wr_company_name."\" src=\"".$alice['data_alba_path'] . "/". $get_alba['etc_0']."\" title=\"".$wr_company_name."\" style=\"max-width:200px;max-height:100px;\"/>";	// width=\"200\" height=\"100\"
					} else {
						$get_logo = $alba_user_control->get_logo($company_info);
						$wr_logo = "<img class=\"vb\" src=\"".$get_logo."\" style=\"max-width:200px;max-height:100px;\"/>";
					}
				}
			}
		}
		/* // 회사 로고 */


		$time_pay = number_format($env['time_pay']);	// 최저시급

		$wr_subject = stripslashes($get_alba['wr_subject']);	 // 공고 제목


		/* SNS share */
		$sns_subject = urlencode($wr_subject);	
		$sns_url = urlencode($alice['url']."/alba_detail.php?no=".$no);
		$site_title = urlencode($env['site_title']);

		$twitter = "http://twitter.com/home/?status=" . $sns_subject . $sns_url;
		//$facebook = "http://www.facebook.com/sharer.php?u=".$sns_url;
		//$facebook = "http://www.facebook.com/sharer.php?s=100&p[url]=http://".$host_name."alba/alba_detail.php?no=".$no."&p[images][0]="."http://" . $host_name . "data/logo/" . $logo['top']."&p[title]=".$wr_subject;
		$facebook = "http://www.facebook.com/sharer.php?u=http://".$host_name."alba/alba_detail.php?no=".$no."&t=".$wr_subject;
		$me2day = "http://me2day.net/posts/new?new_post[body]=".$sns_subject.":".$sns_url."&new_post[tags]=".$site_title;
		$google = "https://www.google.co.kr/url?sa=t&rct=j&q=&esrc=s&source=web&cd=1&ved=&url=https://plus.google.com/share?url=".$sns_url;
		$clog = "http://csp.cyworld.com/bi/bi_recommend_pop.php?url=".$sns_url."&thumbnail=&summary=".$sns_subject."&writer=".$site_title;
		/* // SNS share */


		/* 좌측 로고 하단 정보 */
		// 급여조건
		$pay_type = $category_control->get_categoryCodeName($get_alba['wr_pay_type']);
		$wr_pay = number_format($get_alba['wr_pay'])."원";
		$pay_conference = $get_alba['wr_pay_conference'];	// 협의가능
		// 모집인원
		$volume_arr = array( "volume" => $get_alba['wr_volume'], "volumes" => $get_alba['wr_volumes'] );
		$volmue = $alba_user_control->list_volume($volume_arr);
		$wr_career = ($get_alba['wr_career_type']) ? $category_control->get_categoryCodeName($get_alba['wr_career']) : "경력무관";	// 경력
		$wr_gender = $alba_user_control->gender_val[$get_alba['wr_gender']];	 // 성별
		// 연령
		$age_arr = array( "age_limit" => $get_alba['wr_age_limit'], "age" => $get_alba['wr_age'], "age_etc" => $get_alba['wr_age_etc'] );
		$wr_age = $alba_user_control->list_age($age_arr);
		$age = $wr_age['result'];
		$wr_ability = $category_control->get_categoryCodeName($get_alba['wr_ability']);	// 학력
		/* // 좌측 로고 하단 정보 */


		/* 우측 정보 */
		// 모집일
		$volume_arr = array( "volume_date" => $get_alba['wr_volume_date'], "volume_always" => $get_alba['wr_volume_always'], "volume_end" => $get_alba['wr_volume_end'] );
		$volume_date = $alba_user_control->volume_date($volume_arr);
		// 주소
		$wr_area_0 = explode('/',$get_alba['wr_area_0']);
		$wr_area_0_cnt = count($wr_area_0);
		$wr_area_arr = array();
		for($i=0;$i<$wr_area_0_cnt;$i++){
			$wr_area_name = $category_control->get_categoryCodeName($wr_area_0[$i]);
			if($wr_area_name) {
				array_push($wr_area_arr,$wr_area_name);
			} else {
				array_push($wr_area_arr,$wr_area_0[$i]);
			}
		}
		$wr_area_info = implode($wr_area_arr,' ');

		$wr_date = $category_control->get_categoryCodeName($get_alba['wr_date']);	// 근무기간
		$wr_week = $category_control->get_categoryCodeName($get_alba['wr_week']);	// 근무요일
		if($get_alba['wr_time_conference']){	// 시간 협의
			$wr_time = "시간협의";
		} else {
			$wr_time = $get_alba['wr_stime'] . " ~ " . $get_alba['wr_etime'];	// 근무시간
		}
		// 우대조건
		$preferential = explode(',',$get_alba['wr_preferential']);
		$preferential_cnt = count($preferential);
		$is_preferential = false;
		if($preferential[0]!=''){
			$is_preferential = true;
			$wr_preferential_arr = array();
			for($i=0;$i<$preferential_cnt;$i++){
				$wr_preferential_name = $category_control->get_categoryCodeName($preferential[$i]);	
				array_push($wr_preferential_arr,$wr_preferential_name);
			}
			$wr_preferential = implode($wr_preferential_arr,", ");
		}
		// 복리후생
		$is_welfare = false;
		if($get_alba['wr_welfare_read']){
			$is_welfare = true;
			$wr_welfare_read = strtr($get_alba['wr_welfare_read'],",",", ");
		}
		// 모집직종
		$wr_job_type0 = $category_control->get_categoryCodeName($get_alba['wr_job_type0']);
		if($get_alba['wr_job_type1']){
			$wr_job_type1 = " > " . $category_control->get_categoryCodeName($get_alba['wr_job_type1']);
		}
		if($get_alba['wr_job_type2']){
			$wr_job_type2 = " > " . $category_control->get_categoryCodeName($get_alba['wr_job_type2']);
		}

		$wr_job_type3 = $category_control->get_categoryCodeName($get_alba['wr_job_type3']);
		if($get_alba['wr_job_type4']){
			$wr_job_type4 = " > " . $category_control->get_categoryCodeName($get_alba['wr_job_type4']);
		}
		if($get_alba['wr_job_type5']){
			$wr_job_type5 = " > " . $category_control->get_categoryCodeName($get_alba['wr_job_type5']);
		}

		$wr_job_type6 = $category_control->get_categoryCodeName($get_alba['wr_job_type6']);
		if($get_alba['wr_job_type7']){
			$wr_job_type7 = " > " . $category_control->get_categoryCodeName($get_alba['wr_job_type7']);
		}
		if($get_alba['wr_job_type8']){
			$wr_job_type8 = " > " . $category_control->get_categoryCodeName($get_alba['wr_job_type8']);
		}

		$wr_requisition = explode(',',$get_alba['wr_requisition']);	// 지원방법
		/* // 우측 정보 */


		// 상세요강
		$wr_content = $utility->conv_content(stripslashes($get_alba['wr_content']),1);

		// 근무형태
		$work_type = explode(',',$get_alba['wr_work_type']);
		$work_type_cnt = count($work_type);
		$is_work_type = false;
		if($work_type[0]!=''){
			$is_work_type = true;
			$wr_work_type_arr = array();
			for($i=0;$i<$work_type_cnt;$i++){
				$wr_work_type_name = $category_control->get_categoryCodeName($work_type[$i]);	
				array_push($wr_work_type_arr,$wr_work_type_name);
			}
			$wr_work_type = implode($wr_work_type_arr,", ");
		}


		/* 지원정보/방법 */
		if($volume_date['date']){	// 마감일이 있는 경우
			$volume_dates = explode('-',$volume_date['date']);
			$volume_end_date = $volume_dates[0] . "년 " . $volume_dates[1] . "월 " . $volume_dates[2]."일 ";
			$week_korean = $utility->week_korean($volume_dates[0].$volume_dates[1].$volume_dates[2]);
			$volume_end_date .= "(".$week_korean.")";
		} else {
			$volume_end_date = $volume_date['text'];
		}

		// 제출서류
		$wr_papers = explode(',',$get_alba['wr_papers']);
		$wr_papers_cnt = count($wr_papers);

		$is_papers = false;
		if($get_alba['wr_papers']){
			$is_papers = true;
			$papers = implode($wr_papers,", ");
		}

		/*
		$is_papers = false;
		if($wr_papers[0]!=''){
			$is_papers = true;
			$wr_papers_arr = array();
			for($i=0;$i<$wr_papers_cnt;$i++){
				$paper_val = $alba_user_control->paper_val[$wr_papers[$i]];
				array_push($wr_papers_arr,$paper_val);
			}
			$papers = implode($wr_papers_arr,", ");
		}
		*/
		/* // 지원정보/방법 */

		/* 근무환경 */
		$wr_welfare = unserialize($get_alba['wr_welfare']);
		// 역세권
		$subway_arr = array( 
			"subway_area_0" => array( "subway_area" => $get_alba['wr_subway_area_0'], "subway_line" => $get_alba['wr_subway_line_0'], "subway_station" => $get_alba['wr_subway_station_0'], "subway_content" => $get_alba['wr_subway_content_0'] ),
			/*
			"subway_area_1" => array( "subway_area" => $get_alba['wr_subway_area_1'], "subway_line" => $get_alba['wr_subway_line_1'], "subway_station" => $get_alba['wr_subway_station_1'], "subway_content" => $get_alba['wr_subway_content_1'] ),
			"subway_area_2" => array( "subway_area" => $get_alba['wr_subway_area_2'], "subway_line" => $get_alba['wr_subway_line_2'], "subway_station" => $get_alba['wr_subway_station_2'], "subway_content" => $get_alba['wr_subway_content_2'] )
			*/
		);
		$job_subway = $alba_user_control->view_subway($subway_arr,0);
		
		// 근무지역
		$area_arr = array( "area_0" => $get_alba['wr_area_0'], "area_1" => $get_alba['wr_area_1'], "area_2" => $get_alba['wr_area_2'] );
		$job_area = $alba_user_control->list_area_info($area_arr);
		/* // 근무환경 */

		/* 지도 생성 */
		$use_map = $env['use_map'];	// 사용 지도 api

		switch($use_map){
			case 'daum':
				$map_color = "#617BFF";
				$map_script = "<script src=\"//apis.daum.net/maps/maps3.js?apikey=".$env['daum_map_key']."&libraries=services\"></script>";
			break;
			case 'naver':
				$map_color = "#33CC00";
				$map_script = "";
			break;
			case 'google':
				$map_color = "#C0C0C0";
				$map_script = "";
			break;
		}

		$is_map = false;
		// 근무지역
		if($get_alba['wr_area_company']){	// 근무지 주소 0 : 직접입력 / 1 : 기업정보 위치
			$area_point = $company_info['mb_latlng'];
			$wr_area = $company_info['mb_biz_address0']." ".$company_info['mb_biz_address1'];
		} else {
			$area_point = $get_alba['wr_area_point'];
			$wr_area = $get_alba['wr_area'];
		}
		
		if($area_point){
			$is_map = true;
		}

		echo $map_control->detail_map( $area_point );
		/* 지도 생성 */


		$alba_report_reason = $category_control->category_codeList('alba_report_reason','','yes');	 // 신고사유

		$service_check = $service_control->service_check('etc_alba');
		$open_is_pay = $service_check['is_pay'];
		$service_open = $utility->valid_day($member_service['mb_service_alba_open']);	// 공고 열람 서비스 기간 체크

		// 열람권 기간/건수 확인
		$is_open_service = false;
		if( $utility->valid_day($member_service['mb_service_alba_open']) ){
			$is_open_service = $member_service['mb_service_alba_open'];
		}
		$is_open_count = false;
		if( $utility->valid_day($member_service['mb_service_alba_open']) && $member_service['mb_service_alba_count'] ){	// 건수 사용이 가능하다면
			$is_open_count = $member_service['mb_service_alba_count'];
		}

		// 채용공고 열람 정보 저장
		if($is_open_service && !$is_open_count)	// 열람 기간은 있고, 열람 건수는 없는 경우
			$alba_individual_control->open_insert($no,$get_alba['wr_id'],"alba");

		$is_open_alba = $alba_resume_user_control->is_open_resume('alba',$member['mb_id'],$get_alba['wr_id'], $no);	// 열람한 정보가 있는지


		// 담당자 열람권 확인
		$wr_person = $wr_email = $wr_phone = $wr_hphone = $wr_fax = $company_infos = "";
		if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 
			if( $service_open || $is_open_alba ) {
				$wr_person = $get_alba['wr_person'];
				$wr_email = "<a href=\"mailto://".$get_alba['wr_email']."\">".$get_alba['wr_email']."</a>";
				$wr_phone = $get_alba['wr_phone'];
				$wr_hphone = $get_alba['wr_hphone'];
				$wr_fax = $get_alba['wr_fax'];
			} else if( $is_open_count && !$is_open_alba ){	 // 열람 건수가 있다면
				$wr_person = $wr_email = $wr_phone = $wr_hphone = $wr_fax = "<a href=\"javascript:void(0);\" onclick=\"open_alba('".$no."','".$get_alba['wr_id']."','alba', '".$is_open_count."');\"><img alt=\"열람권사용\" src=\"../images/icon/icon_used.gif\"></a>";
			} else {
				$wr_person = $wr_email = $wr_phone = $wr_hphone = $wr_fax = "<img width=\"41\" height=\"14\" alt=\"비공개\" src=\"../images/icon/icon_closed.gif\">";
			}
		} else {
			//if($member['mb_id']==$get_alba['wr_id']){
				$wr_person = $get_alba['wr_person'];
				$wr_email = $get_alba['wr_email'];
				$wr_phone = $get_alba['wr_phone'];
				$wr_hphone = $get_alba['wr_hphone'];
				$wr_fax = $get_alba['wr_fax'];
				//$company_infos = "<em class=\"companyDetail positionA\" style=\"bottom:-1px; right:-1px;\"><a href=\"".$alice['alba_path']."/company_info.php?no=".$get_alba['wr_company']."\" target=\"_blank\">회사정보상세보기</a></em>";
			//}
		}

		$form_question = $category_control->get_categoryCode('20130701103916_7908');	// 사전질문

		// 조회수 증가
		$alba_user_control->hit_up($no);

		$sms_use = ($member['mb_sms'] > 0) ? true : false;

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('cookie','form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_detail.html'))
			include_once $alice['self'] . 'views/alba_detail.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_detail.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>