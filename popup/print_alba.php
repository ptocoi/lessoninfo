<?php
		/*
		* /application/popup/print_alba.php
		* @author Harimao
		* @since 2014/03/10
		* @last update 2014/03/10
		* @Module v3.5 ( Alice )
		* @Brief :: Alba print popup
		* @Comment :: 채용공고 프린트 팝업창
		*/
		
		$alice_path = "../";

		$cat_path = "../";

		include_once $alice_path . "_core.php";

		##
		# Variables
		$get_alba = $alba_user_control->get_alba_no($no);	// 알바 정보

		if($get_alba['is_delete']){	// 삭제된 채용공고 입니다.
			$utility->popup_msg_close($alba_user_control->_errors('0004'));
			exit;
		}

		/* 홈페이지 주소 */
		if($get_alba['wr_homepage']){
			$wr_homepage = "<a href='".$utility->add_http($get_alba['wr_homepage'])."' target='_blank'>".$utility->add_http($get_alba['wr_homepage'])."</a>";
		}
		/* // 홈페이지 주소 */

		$wr_id = $get_alba['wr_id'];	// 작성자 id
		$wdate = substr($get_alba['wr_wdate'],0,10);	// 등록일

		$company_info = $user_control->get_member_company($wr_id);	 // 작성 기업 회원 정보
		$company_name = stripslashes($get_alba['wr_company_name']);

		$wr_company_name = stripslashes($get_alba['wr_company_name']);	 // 회사명


		/* 회사 로고 */
		if($is_self){
			$logo_path = $alice['data_alba_path'] . '/' . $ym;
			if(file_exists($logo_path."/".$get_alba['wr_id'])){
				$wr_logo = "<img class=\"vb\" alt=\"".$wr_company_name."\" src=\"".$logo_path . "/". $get_alba['wr_id']."\" title=\"".$wr_company_name."\"/>";	// width=\"200\" height=\"100\"
			} else {
				$wr_logo = "<img class=\"vb\" src=\"".$alice['images_path']."/basic/bg_noLogo.gif\"/>";
			}
		} else {
			$wr_logo = $company_info['mb_logo'];
			if($wr_logo){
				$logo_path = $alice['data_member_path'] . '/' . $wr_id . '/logo';
				$wr_logo = "<img class=\"vb\" alt=\"".$company_name."\" src=\"".$logo_path . "/". $company_info['mb_logo']."\" title=\"".$company_name."\"/>";	// width=\"200\" height=\"100\"
			} else {
				$wr_logo = "<img class=\"vb\" src=\"".$alice['images_path']."/basic/bg_noLogo.gif\"/>";
			}
		}
		/* // 회사 로고 */


		$time_pay = number_format($env['time_pay']);	// 최저시급

		$wr_subject = stripslashes($get_alba['wr_subject']);	 // 공고 제목

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
				array_push($wr_area_arr,$wr_area_0[$i]."번지");
			}
		}
		$wr_area = implode($wr_area_arr,' ');
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

		if($get_alba['wr_requisition']){
			$requisition_arr = array( "online" => "온라인", "email" => "이메일", "phone" => "전화연락", "meet" => "방문접수", "post" => "우편", "fax" => "팩스", "homepage" => "홈페이지" );
			$wr_requisition = explode(',',$get_alba['wr_requisition']);	// 지원방법
			$wr_requisition_cnt = count($wr_requisition);
			$wr_requisition_arr = array();
			foreach($requisition_arr as $key => $val){
				$requisition_val = $requisition_arr[$key];
				array_push($wr_requisition_arr, $requisition_val);
			}
			$wr_requisitions = implode($wr_requisition_arr,', ');
		}
		
		/* // 우측 정보 */


		// 상세요강
		$wr_content = $utility->conv_content(stripslashes($get_alba['wr_content']),1);


		/* 지원정보/방법 */
		if($volume_date['date']){	// 마감일이 있는 경우
			$volume_dates = explode('-',$volume_date['date']);
			$volume_end_date = $volume_dates[0] . "년 " . $volume_dates[1] . "월 " . $volume_dates[2]."일 ";
			$week_korean = $utility->week_korean($volume_dates[0].$volume_dates[1].$volume_dates[2]);
			$volume_end_date .= "(".$week_korean.")";
		} else {
			$volume_end_date = $volume_date['text'];
		};
		// 제출서류
		$wr_papers = explode(',',$get_alba['wr_papers']);
		$wr_papers_cnt = count($wr_papers);

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

		$is_map = false;
		$wr_area_point = array();
		if($get_alba['wr_area_0_point']){
			$is_map = true;
			$wr_area_0_points = explode(',',$get_alba['wr_area_0_point']);
			$wr_area_0_points_cnt = count($wr_area_0_points);
			$area_0_point = "";
			for($i=0;$i<$wr_area_0_points_cnt;$i++){
				$comma = ($i != ($wr_area_0_points_cnt - 1)) ? ", " : "";
				$area_0_point .= "'".$wr_area_0_points[$i]."'".$comma;
			}
			array_push($wr_area_point,$area_0_point);
		}
		if($get_alba['wr_area_1_point']){
			$is_map = true;
			$wr_area_1_points = explode(',',$get_alba['wr_area_1_point']);
			$wr_area_1_points_cnt = count($wr_area_1_points);
			$area_1_point = "";
			for($i=0;$i<$wr_area_1_points_cnt;$i++){
				$comma = ($i != ($wr_area_1_points_cnt - 1)) ? ", " : "";
				$area_1_point .= "'".$wr_area_1_points[$i]."'".$comma;
			}
			array_push($wr_area_point,$area_1_point);
		}
		if($get_alba['wr_area_2_point']){
			$is_map = true;
			$wr_area_2_points = explode(',',$get_alba['wr_area_2_point']);
			$wr_area_2_points_cnt = count($wr_area_2_points);
			$area_2_point = "";
			for($i=0;$i<$wr_area_2_points_cnt;$i++){
				$comma = ($i != ($wr_area_2_points_cnt - 1)) ? ", " : "";
				$area_2_point .= "'".$wr_area_2_points[$i]."'".$comma;
			}
			array_push($wr_area_point,$area_2_point);
		}
		$wr_area_point_count = count($wr_area_point);
		echo $map_control->detail_map( $wr_area_point );
		/* 지도 생성 */


		/* Photo */
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
		/* // Photo */

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/print_alba.html'))
			include_once $alice['self'] . 'views/print_alba.html';
		else
			$config->error_info( $alice['self'] . 'views/print_alba.html' );

		$config_control->_tail(true);	// tail;

		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>