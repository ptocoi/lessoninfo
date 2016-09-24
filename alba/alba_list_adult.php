<?php
		/*
		* /application/alba/alba_list_adult.php
		* @author Harimao
		* @since 2013/08/12
		* @last update 2015/03/17
		* @Module v3.5 ( Alice )
		* @Brief :: Alba adult list
		* @Comment :: 19 정규직 리스팅
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "adult";

		$banner_atop_position = $page_name . "_top";
		$banner_logo_position = $page_name . "_logo_banner";
		$banner_top_position = $page_name . "_top_banner";
		$banner_left_position = $page_name . "_left";
		$banner_tail_position = $page_name . "_bottom";
		$banner_left_wing_position = $page_name . "_left_scroll";
		$banner_right_wing_position = $page_name . "_right_scroll";

		$search_mode = "alba_list_adult";
		
		include_once $cat_path . "_engine.php";

		//if($env['use_adult'] && !$is_admin){	// 성인인증 기능을 사용할때 (관리자 아닐때)
		if(!$is_admin) {	// 관리자가 아닐때

			if($is_member){	// 회원일때
				if(!$member['is_adult']){	// 성인이 아니라면
					header("Location: ./alba_adult.php?url=".$urlencode);
				}
			} else {	 // 비회원
				if(!$_SESSION['adult_view']){	// 성인인증 세션이 없다면
					header("Location: ./alba_adult.php?url=".$urlencode);
				}
			}

		}

		##
		# Search
		$mode = $_GET['mode'];
		$type = $_GET['type'];
		if($mode=='search'){	 // 정규직 검색

			/*
			echo "<pre>";
			print_r($_GET);
			echo "</pre>";
			*/
			
			// 메뉴별 검색 필드
			$category_top_val = explode(",",$_GET['category_top_val']);
			$category_middle_val = explode(",",$_GET['category_middle_val']);
			$category_sub_val = explode(",",$_GET['category_sub_val']);

			// 지역
			$wr_area_0 = $_GET['wr_area_0'];	// 1차 지역 배열
			$wr_area_1 = $_GET['wr_area_1'];	// 2차 지역 배열
			$wr_area_2 = $_GET['wr_area_2'];	// 3차 지역 배열

			$area_sels = $_GET['area_sels'];	// 지역 검색 값

			// 역세권
			$wr_subway_0 = $_GET['wr_subway_0'];	 // 1차 역세권 배열
			$wr_subway_1 = $_GET['wr_subway_1'];	 // 2차 역세권 배열
			$wr_subway_2 = $_GET['wr_subway_2'];	 // 3차 역세권 배열

			$subway_sels = $_GET['subway_sels'];	// 역세권 검색 값

			// 근무조건
			$wr_date = $_GET['wr_date'];		// 근무기간
			$wr_week = $_GET['wr_week'];	// 근무요일

			// 근무시간
			$wr_stime = $_GET['wr_stime'];	// 시작시간
			$wr_etime = $_GET['wr_etime'];	// 종료시간
			$wr_time_conference = $_GET['wr_time_conference'];	// 시간협의

			$wr_ability = $_GET['wr_ability'];	// 학력

			$wr_career_type = $_GET['wr_career_type'];	// 경력
			$wr_career = $_GET['wr_career'];	// 경력 조건 ( ~ 이하 )

			$wr_age = $_GET['wr_age'];	// 입력 나이
			$wr_age_limit = $_GET['wr_age_limit'];	// 나이 무관포함

			$wr_gender = $_GET['wr_gender'];	// 성별

			//echo preg_replace("/\//", "\/", trim(urldecode($search_keyword)))." <==<Br/>";	 // 다른 방식
			$search_keyword = urldecode(trim($search_keyword));	// 검색어

		}

		$search_mode_sels = $_GET['alba_list_adult_sels'];
		$search_sel_1 = $_GET['alba_list_adult_1'];

		##
		# Variables
		$view_type = $_GET['view_type'];	// 리스팅 타입
		$sort = $_GET['sort'];

		// 성인직종 2차 카테고리
		$adult_pcode_list = $category_control->category_codeLists('job_type'," and `p_code` = '".$type."' and `etc_0` = '1' ");


		$_is_adult = " and `wr_is_adult` = 1 ";	// 성인 카테고리 구분

		// 플래티넘
		$platinum_rows = ($design['adult_platinum_total']) ? $design['adult_platinum_total'] : 15;
		$platinum_row = $design['adult_platinum_row'];	 // 플래티넘 가로 출력 갯수
		//  and `wr_report` = 0
		$platinum_con = " where `wr_open` = 1 ".$_is_adult." and ( `wr_service_platinum` >= curdate() or `wr_service_platinum_sub` >= curdate() ) and `is_delete` = 0 ";
		$platinum_list = $alba_user_control->__AlbaList( $page, $platinum_rows, $platinum_con );
		$platinum_list_total = $platinum_list['total_count'];
		// 가로출력수 - (총출력수 % 가로출력수) = 나머지
		$platinum_rest = $adult_platinum_row - ($platinum_list_total % $adult_platinum_row) -1;

		//echo $platinum_rest."@".$platinum_row." <==<br/>";

		// 프라임
		$prime_rows = ($design['adult_prime_total']) ? $design['adult_prime_total'] : 15;
		$prime_row = $design['adult_prime_row']+1;	 // 프라임 가로 출력 갯수
		//  and `wr_report` = 0
		$prime_con = " where `wr_open` = 1 ".$_is_adult." and ( `wr_service_prime` >= curdate() ) and `is_delete` = 0 ";
		$prime_list = $alba_user_control->__AlbaList( $page, $prime_rows, $prime_con );
		$prime_list_total = $prime_list['total_count'];	
		//echo $prime_list_total." @ ".$main_prime_row." <==<br/>"; 24 @ 4
		$prime_rest = $adult_prime_row - ($prime_list_total % $adult_prime_row) - 1;

		//echo $prime_rest."@".$prime_row;

		// 그랜드
		$grand_rows = ($design['adult_grand_total']) ? $design['adult_grand_total'] : 15;
		$grand_row = $design['adult_grand_row'];	 // 프라임 가로 출력 갯수
		//  and `wr_report` = 0
		$grand_con = " where `wr_open` = 1 ".$_is_adult." and ( `wr_service_grand` >= curdate() ) and `is_delete` = 0 ";
		$grand_list = $alba_user_control->__AlbaList( $page, $grand_rows, $grand_con );
		$grand_list_total = $grand_list['total_count'];
		$grand_rest = ( $adult_grand_row - ($grand_list_total % $adult_grand_row) ) + 1;

		// 배너형
		$banner_rows = ($design['adult_banner_total']) ? $design['adult_banner_total'] : 15;
		$banner_row = $design['adult_banner_row']-1;	 // 배너형 가로 출력 갯수
		//  and `wr_report` = 0
		$banner_con = " where `wr_open` = 1 ".$_is_adult." and ( `wr_service_banner` >= curdate() or `wr_service_banner_sub` >= curdate() ) and `is_delete` = 0 ";
		$banner_list = $alba_user_control->__AlbaList( $page, $banner_rows, $banner_con );
		$banner_list_total = $banner_list['total_count'];
		$banner_rest = $adult_banner_row - ($banner_list_total % $adult_banner_row) - 1;

		// 리스트형
		$lists_rows = ($design['adult_list_total']) ? $design['adult_list_total'] : 15;
		//  and `wr_report` = 0
		$lists_con = " where `wr_open` = 1 ".$_is_adult." and ( `wr_service_list` >= curdate() or `wr_service_list_sub` >= curdate() ) and `is_delete` = 0 ";
		$lists_list = $alba_user_control->__AlbaList( $page, $lists_rows, $lists_con );
		$lists_list_total = $lists_list['total_count'];


		// 일반 리스트
		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows : 20;
		//  and `wr_report` = 0
		$list_con .= " where `wr_open` = 1 ".$_is_adult." and `is_delete` = 0 ";
		$service_check = $service_control->service_check('alba_basic');	// 채용공고 일반 리스트 사용시
		if($service_check['is_pay']){
			$list_con .= " and ( `wr_service_basic` >= curdate() ) ";
		}
		$list_list = $alba_user_control->__AlbaList( $page, $page_rows, $list_con );
		$total_page = $list_list['total_page'];
		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_list_adult.php?page_rows=".$page_rows."&".$list_list['send_url']."&page=");


		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_list_adult.html'))
			include_once $alice['self'] . 'views/alba_list_adult.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_list_adult.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>