<?php
		/*
		* /application/company/alba_customized.php
		* @author Harimao
		* @since 2013/08/14
		* @last update 2014/07/08
		* @Module v3.5 ( Alice )
		* @Brief :: Company member alba resume customized
		* @Comment :: 기업회원 알바 맞춤 인재정보
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
		$job_type_list = $category_control->category_codeList('job_type');		// 직종
		$area_list = $category_control->category_codeList('area');					// 지역
		$alba_date_list = $category_control->category_codeList('alba_date');	// 알바근무기간
		$alba_week_list = $category_control->category_codeList('alba_week');	// 알바근무요일
		$alba_time_list = $category_control->category_codeList('alba_time');	// 알바근무시간
		$work_type_list = $category_control->category_codeList('work_type');	// 근무형태

		$custom_titles = $alba_company_control->custom_titles($member['mb_id']);	 // 타이틀 뽑기

		$mode = $_GET['mode'];
		if($mode=='search'){	 // 검색일때

			$tab1_on = "on";
			$tab2_on = "";
			$tab1_display = "block";
			$tab2_display = "none";
			
			$search_no = $_GET['no'];

		} else {

			$tab1_on = "on";
			$tab2_on = "";
			$tab1_display = "block";
			$tab2_display = "none";

			if($no){	 // 맞춤인재 정보를 선택했다면

				$tab1_on = "";
				$tab2_on = "on";
				$tab1_display = "none";
				$tab2_display = "block";

				$get_custom = $alba_company_control->get_custom($no);

				/* 직종 */
				$wr_job_type0 = $get_custom['wr_job_type0'];
				$wr_job_type1 = $get_custom['wr_job_type1'];
				$wr_job_type2 = $get_custom['wr_job_type2'];

				$wr_job_type3 = $get_custom['wr_job_type3'];
				$wr_job_type4 = $get_custom['wr_job_type4'];
				$wr_job_type5 = $get_custom['wr_job_type5'];

				$wr_job_type6 = $get_custom['wr_job_type6'];
				$wr_job_type7 = $get_custom['wr_job_type7'];
				$wr_job_type8 = $get_custom['wr_job_type8'];
				/* //직종 */

				/* 지역 */
				$wr_area0 = $get_custom['wr_area0'];
				$wr_area1 = $get_custom['wr_area1'];

				$wr_area2 = $get_custom['wr_area2'];
				$wr_area3 = $get_custom['wr_area3'];

				$wr_area4 = $get_custom['wr_area4'];
				$wr_area5 = $get_custom['wr_area5'];
				/* //지역 */

				$wr_age_limit = $get_custom['wr_age_limit'];
				$wr_age = explode('-',$get_custom['wr_age']);
				$wr_age_etc = explode(',',$get_custom['wr_age_etc']);

				$wr_work_type = explode(',',$get_custom['wr_work_type']);		// 근무형태

			} else {
				if(isset($no)){	// no GET 파라미터는 있으나 값은 없을때
					$tab1_on = "";
					$tab2_on = "on";
					$tab1_display = "none";
					$tab2_display = "block";					
				}
			}

		}

		if($custom_titles){
			$page = ($page) ? $page : 1;
			$page_rows = ($page_rows) ? $page_rows: 15;
			$con = " where `is_delete` = 0 ";
			$custom_list = $alba_company_control->custom_list($page, $page_rows, $con);
			$total_page = $custom_list['total_page'];
			$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_customized.php?page_rows=".$page_rows."&".$custom_list['send_url']."&page=");
		}

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_customized.html'))
			include_once $alice['self'] . 'views/alba_customized.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_customized.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>