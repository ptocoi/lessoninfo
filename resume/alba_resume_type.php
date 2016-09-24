<?php
		/*
		* /application/resume/alba_resume_type.php
		* @author Harimao
		* @since 2013/08/13
		* @last update 2015/07/02
		* @Module v3.5 ( Alice )
		* @Brief :: Alba Resume list
		* @Comment :: 지역별 알바 이력서 리스팅
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "resume";

		$banner_atop_position = $page_name . "_top";
		$banner_logo_position = $page_name . "_logo_banner";
		$banner_top_position = $page_name . "_top_banner";
		$banner_left_position = $page_name . "_left";
		$banner_tail_position = $page_name . "_bottom";
		$banner_left_wing_position = $page_name . "_left_scroll";
		$banner_right_wing_position = $page_name . "_right_scroll";

		$search_mode = "resume_type";

		include_once $cat_path . "_engine.php";

		##
		# Search
		$mode = $_GET['mode'];
		$type = $_GET['type'];

		if($mode=='search'){	 // 이력서 검색

			/*
			echo "<pre>";
			print_R($_GET);
			echo "</pre>";
			*/

			// 메뉴별 검색 필드
			$category_top_val = explode(",",$_GET['category_top_val']);
			$category_middle_val = explode(",",$_GET['category_middle_val']);
			$category_sub_val = explode(",",$_GET['category_sub_val']);

			// 직종
			$resume_type_1 = $_GET['resume_type_1'];	 // 2차 직종 배열
			$resume_type_2 = $_GET['resume_type_2'];	 // 3차 직종 배열

			$jobtype_sels = $_GET['jobtype_sels'];	// 직종 검색 값

			$job_type_0_exp = explode(',',$wr_jobtype_0);
			$job_type_0_cnt = count($job_type_0_exp);

			// 지역
			$wr_area_0 = $_GET['wr_area_0'];	// 1차 지역 배열
			$wr_area_1 = $_GET['wr_area_1'];	// 2차 지역 배열
			$wr_area_2 = $_GET['wr_area_2'];	// 3차 지역 배열

			$area_sels = $_GET['area_sels'];	// 지역 검색 값

			$wr_date = $_GET['wr_date'];	// 근무기간
			$wr_week = $_GET['wr_week'];	// 근무요일
			$wr_time = $_GET['wr_time'];	// 근무시간

			$wr_work_direct = $_GET['wr_work_direct'];	// 즉시출근가능

			$wr_school_ability = $_GET['wr_school_ability'];	// 학력
			$wr_career_use = $_GET['wr_career_use'];	// 경력 유무 선택
			$wr_career = $_GET['wr_career'];	// 선택 경력

			$wr_age = $_GET['wr_age'];	// 나이
			$wr_age_limit = $_GET['wr_age_limit'];	// 나이 무관 포함

			$wr_gender = $_GET['wr_gender'];	// 성별

			$search_keyword = urldecode(trim($search_keyword));	// 검색어

		} else {

			if($type){
				$mode = "search";
				$code = "";
				$second_code = "";
				$third_code = "";
				$get_code = $category_control->get_categoryCode($type);
				if($get_code['p_code']){	 // 2/3차 분류인 경우
					$get_p_code = $category_control->get_categoryCode($get_code['p_code']);
					if($get_p_code['p_code']){
						$code = $get_p_code['p_code'];
					} else {
						$code = $get_code['p_code'];
					}
					$second_code = $get_p_code['code'];
					$third_code = $get_code['code'];

				} else {	 // 1차 분류인 경우

					$code = $get_code['code'];

				}
				$category_top_val[0] = $code;
				$resume_type_1[$code] = array( 0 => $second_code );
				$category_middle_val[0] = $second_code;
			}
			
			/*
			echo "code :: " . $code."<Br/>";
			echo "second_code :: " . $second_code."<Br/>";
			echo "third_code :: " . $third_code."<Br/>";
			*/

		}
		
		$search_vals = $job_types;						// 공통 :: 업직종 검색
		$category_0_selected = $job_type_0_exp;	// 공통 :: 업직종 1차 값

		$search_mode_sels = $_GET['resume_type_sels'];
		$search_sel_1 = $_GET['resume_type_1'];
		$search_sel_2 = $_GET['resume_type_2'];

		##
		# Variables
		$view_type = $_GET['view_type'];	// 리스팅 타입
		$sort = $_GET['sort'];

		// 일반 리스트
		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows : 20;
		$sorting = ($sort) ? "&sort=" . $sort . "&flag=" . $flag . "&" : "";
		//  and `wr_report` = 0
		$list_con = " where `wr_open` = 1 and `is_delete` = 0 ";
		if($_GET['type']){
			if($code!='') {
				$list_con .= " and ( `wr_job_type0` = '".$code."' ";
				if($second_code=='' && $third_code==''){
					$list_con .= " ) ";
				}
			}
			if($second_code!='') {
				$list_con .= " or `wr_job_type1` = '".$second_code."' ";
				if($third_code==''){
					$list_con .= " ) ";
				}
			}
			if($third_code!='') {
				$list_con .= " or `wr_job_type2` = '".$third_code."' ) ";
			}

		}
		$service_check = $service_control->service_check('alba_resume_basic');	// 이력서 일반 리스트 사용시
		if($service_check['is_pay']){
			$list_con .= " and ( `wr_service_basic` >= curdate() ) ";
		}
		$list_list = $alba_resume_user_control->__ResumeList( $page, $page_rows, $list_con );
		$total_page = $list_list['total_page'];
		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_resume_type.php?page_rows=".$page_rows."&".$list_list['send_url']."&page=");

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_resume_type.html'))
			include_once $alice['self'] . 'views/alba_resume_type.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_resume_type.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>