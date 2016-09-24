<?php
		/*
		* /application/main/index.php
		* @author Harimao
		* @since 2013/06/14
		* @last update 2015/04/15
		* @Module v3.5 ( Alice )
		* @Brief :: Main Index
		* @Comment :: 기본 header 만 설정하고 나머지는 스킨을 불러드려 사용한다.
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "main";

		$banner_atop_position = $page_name . "_top";

		$banner_logo_position = $page_name . "_logo_banner";
		$banner_left_position = $page_name . "_left";
		$banner_tail_position = $page_name . "_bottom";
		$banner_left_wing_position = $page_name . "_left_scroll";
		$banner_right_wing_position = $page_name . "_right_scroll";

		include_once $cat_path . "_engine.php";


		##
		# Variables
		$main_top_banner = $banner_control->get_banner_for_position('main_top_banner');	// 메인 상단 배너
		$main_notice_list = $notice_control->get_notice_list_count(4);	// 공지사항

		$con = " and (`wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";

		$main_basic_check = $service_control->service_check('main_basic');	// 메인페이지 채용공고 일반 리스트 사용시
		$main_rbasic_check = $service_control->service_check('main_rbasic');	// 메인페이지 이력서 일반 리스트 사용시

		$new_alba_con  = " where `wr_open` = 1 and `wr_is_adult` = 0 " . $con . " and `is_delete` = 0 ";
		$new_alba_con .= " and ( `wr_service_platinum` >= curdate() ) ";
		$new_alba_con .= " and ( `wr_service_prime` >= curdate() ) ";
		$new_alba_con .= " and ( `wr_service_grand` >= curdate() ) ";
		$new_alba_con .= " and ( `wr_service_banner` >= curdate() ) ";
		$new_alba_con .= " and ( `wr_service_list` >= curdate() ) ";
		if( $main_basic_check['is_pay'] ) {
			$new_alba_con .= " and ( `wr_service_basic` >= curdate() ) ";
			$new_alba_con .= " and ( `wr_service_basic_sub` >= curdate() ) ";
		}
		$new_alba_list = $alba_user_control->__AlbaList(1,4,$new_alba_con);	// 신규 채용정보

		$new_resume_con  = " where `wr_open` = 1 and `is_delete` = 0 ";
		$new_resume_con .= " and ( `wr_service_platinum` >= curdate() ) ";
		$new_resume_con .= " and ( `wr_service_prime` >= curdate() ) ";
		$new_resume_con .= " and ( `wr_service_grand` >= curdate() ) ";
		$new_resume_con .= " and ( `wr_service_banner` >= curdate() ) ";
		$new_resume_con .= " and ( `wr_service_list` >= curdate() ) ";
		if( $main_rbasic_check['is_pay'] ) {
			$new_resume_con .= " and ( `wr_service_basic` >= curdate() ) ";
			$new_resume_con .= " and ( `wr_service_basic_sub` >= curdate() ) ";
		}

		$new_resume_list = $alba_resume_user_control->__ResumeList(1,4,$new_resume_con);	// 신규 인재정보
		
		// 플래티넘
		$platinum_rows = ($design['main_platinum_total']) ? $design['main_platinum_total'] : 15;
		$platinum_row = $design['main_platinum_row'];	 // 플래티넘 가로 출력 갯수
		//  and `wr_report` = 0
		$platinum_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_service_platinum` >= curdate() ) " . $con . " and `is_delete` = 0 ";
		$platinum_list = $alba_user_control->__AlbaList( $page, $platinum_rows, $platinum_con );
		$platinum_list_total = $platinum_list['total_count'];
		// 가로출력수 - (총출력수 % 가로출력수) = 나머지
		$platinum_rest = $main_platinum_row - ($platinum_list_total % $main_platinum_row);


		// 프라임
		$prime_rows = ($design['main_prime_total']) ? $design['main_prime_total'] : 15;
		$prime_row = $design['main_prime_row'];	 // 프라임 가로 출력 갯수
		//  and `wr_report` = 0
		$prime_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_service_prime` >= curdate() ) " . $con . " and `is_delete` = 0 ";
		$prime_list = $alba_user_control->__AlbaList( $page, $prime_rows, $prime_con );
		$prime_list_total = $prime_list['total_count'];	
		//echo $prime_list_total." @ ".$main_prime_row." <==<br/>"; 24 @ 4
		$prime_rest = $main_prime_row - ($prime_list_total % $main_prime_row);

		// 그랜드
		$grand_rows = ($design['main_grand_total']) ? $design['main_grand_total'] : 15;
		$grand_row = $design['main_grand_row'];	 // 프라임 가로 출력 갯수
		//  and `wr_report` = 0
		$grand_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_service_grand` >= curdate() ) " . $con . " and `is_delete` = 0 ";
		$grand_list = $alba_user_control->__AlbaList( $page, $grand_rows, $grand_con );
		$grand_list_total = $grand_list['total_count'];
		$grand_rest = $main_grand_row - ($grand_list_total % $main_grand_row);

		// 배너형
		$banner_rows = ($design['main_banner_total']) ? $design['main_banner_total'] : 15;
		$banner_row = $design['main_banner_row'];	 // 프라임 가로 출력 갯수
		//  and `wr_report` = 0
		$banner_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_service_banner` >= curdate() ) " . $con . " and `is_delete` = 0 ";
		$banner_list = $alba_user_control->__AlbaList( $page, $banner_rows, $banner_con );
		$banner_list_total = $banner_list['total_count'];
		$banner_rest = $main_banner_row - ($banner_list_total % $main_banner_row);

		// 리스트형
		$list_rows = ($design['main_list_total']) ? $design['main_list_total'] : 15;
		//  and `wr_report` = 0
		$list_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_service_list` >= curdate() ) " . $con . " and `is_delete` = 0 ";
		$list_list = $alba_user_control->__AlbaList( $page, $list_rows, $list_con );
		$list_list_total = $list_list['total_count'];
		//$list_rest = 2 - ($list_list_total % 2);
		//$list_rest = ($list_list_total % 2);
		$list_row = 2;
		$list_rest = ($list_row) - ($list_list_total % $list_row);

		// 포커스 인재정보
		$focus_rows = ($design['main_focus_total']) ?$design['main_focus_total'] : 15;
		//  and `wr_report` = 0
		$focus_con = " where `wr_open` = 1 and ( `wr_service_main_focus` >= curdate() )  and `is_delete` = 0 ";
		$focus_list = $alba_resume_user_control->__ResumeList($page, $focus_rows, $focus_con);
		$focus_list_total = $focus_list['total_count'];		
		//$focus_rest = $main_focus_row - ($focus_list_total % $main_banner_row);
		$focus_row = 3;
		$focus_rest = ($focus_row) - ($focus_list_total % $focus_row);
		

		// 최근 알바 리스트
		if($design['main_bottom_alba_use']){
			$latest_alba_list_rows = $design['main_bottom_alba_total'];
			$con = ($main_basic_check['is_pay']) ? " and ( `wr_service_basic` >= curdate() ) " : "";
			$latest_alba_list_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_volume_date` >= curdate() or ( `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ) " . $con . " and `is_delete` = 0";
			$latest_alba_list = $alba_user_control->__AlbaList( $page, $latest_alba_list_rows, $latest_alba_list_con );
		}
		// 최근 이력서 리스트
		if($design['main_bottom_resume_use']){
			$latest_resume_list_rows = $design['main_bottom_resume_total'];
			$latest_resume_list_con = " where `wr_open` = 1 and `is_delete` = 0 ";
			if($main_rbasic_check['is_pay']){
				$latest_resume_list_con .= " and ( `wr_service_basic` >= curdate() ) ";
			}
			$latest_resume_list = $alba_resume_user_control->__ResumeList( $page, $latest_resume_list_rows, $latest_resume_list_con );
		}

		// 게시판 메인 출력 리스트
		$board_list = $board_config_control->__BoardList("",""," where `bo_main_view` = 1 "," rand() ");

		// 로고 옵션
		$alba_option_logo = $service_control->service_check('alba_option_logo');	// 알바 로고 옵션
		$alba_option_logo_service = $service_control->__ServiceList($alba_option_logo['service']);	// 알바 로고 서비스 리스트
		$alba_option_logo_effects = explode("/",$alba_option_logo['effect']);	 // 효과

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form','cycle'));

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