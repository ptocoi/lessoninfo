<?php
		/*
		* /application/map/index.php
		* @author Harimao
		* @since 2013/10/23
		* @last update 2015/03/31
		* @Module v3.5 ( Alice )
		* @Brief :: Map Index
		* @Comment :: 기본 header 만 설정하고 나머지는 스킨을 불러드려 사용한다.
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "map";

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
		$area_list = $category_control->category_codeList('area');					// 지역
		$job_type_list = $category_control->category_codeList('job_type');		// 직종

		echo $map_control->search_map( );	// 지도 생성

		/*
		$con .= " where `wr_open` = 1 and `wr_is_adult` = 0 and `wr_report` = 0 and `is_delete` = 0 ";
		$alba_list = $alba_user_control->__AlbaList( $page, $page_rows, $con );
		*/
		
		$con  = " where `wr_open` = 1 and `wr_is_adult` = 0 and `is_delete` = 0 ";
		$con .= " and ( `wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";
		$service_check = $service_control->service_check('alba_basic');	// 채용공고 일반 리스트 사용시
		if($service_check['is_pay']){
			$con .= " and ( `wr_service_basic` >= curdate() ) ";
		}
		$alba_list = $alba_user_control->__AlbaList( $page, 25, $con );
		
		$use_map = $env['use_map'];	// 사용 지도 api
		$daum_local_key = $env['daum_local_key'];	// 다음 지도 local 검색 key
		$naver_map_key = $env['naver_map_key'];	// 네이버 지도 key

		// 좌표 정보 정렬
		$point_data = array();
		$i = 0;
		foreach($alba_list['result'] as $val){
			if($val['wr_area_point']){
				$point_data[$i]['point'] = $val['wr_area_point'];
				$point_data[$i]['data_no'] = $val['no'];
			$i++;
			}
		}

		$point_data_cnt = count($point_data);

		##
		# Include view
		if(is_file($alice['self'] . 'views/index.html'))
			include_once $alice['self'] . 'views/index.html';
		else
			$config->error_info( $alice['self'] . 'views/index.html' );


		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>