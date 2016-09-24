<?php
		/**
		* /application/index.php
		* @author Harimao
		* @since 2013/05/23
		* @last update 2015/04/06
		* @Module v3.5 ( Alice )
		* @Brief :: Application Index
		*/

		$alice_path = "./";

		$cat_path = "./";

		$page_name = "main";

		$banner_atop_position = $page_name . "_top";

		$banner_logo_position = $page_name . "_logo_banner";
		$banner_left_position = $page_name . "_left";
		$banner_tail_position = $page_name . "_bottom";
		$banner_left_wing_position = $page_name . "_left_scroll";
		$banner_right_wing_position = $page_name . "_right_scroll";

		include_once $cat_path . "_engine.php";


		/*
		 *
		 * Application 내 Index 는 app_config 에서 설정한 main 으로 이동한다.
		 * main 디렉토리명이 바뀔수 있기 때문에 app_config 에서 설정하도록 한다.
		 *
		 */
	   
		// go mobile.
		if($is_mobile){
			$utility->popup_msg_js("",$alice['mobile_path']);
		}

		##
		# Variables
		$main_top_banner = $banner_control->get_banner_for_position('main_top_banner');	// 메인 상단 배너
		$main_notice_list = $notice_control->get_notice_list_count(4);	// 공지사항

		$con = " and (`wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";

		$new_alba_con = " where `wr_open` = 1 and `wr_is_adult` = 0 " . $con . " and `is_delete` = 0 ";
		$new_alba_list = $alba_user_control->__AlbaList(1,4,$new_alba_con);	// 신규 채용정보
		$new_resume_con = " where `wr_open` = 1 and `is_delete` = 0 ";
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
			$service_check = $service_control->service_check('main_basic');	// 메인페이지 채용공고 일반 리스트 사용시
			$con = ($service_check['is_pay']) ? " and ( `wr_service_basic` >= curdate() ) " : "";
			$latest_alba_list_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_volume_date` >= curdate() or ( `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ) " . $con . " and `is_delete` = 0";
			$latest_alba_list = $alba_user_control->__AlbaList( $page, $latest_alba_list_rows, $latest_alba_list_con );
		}
		// 최근 이력서 리스트
		if($design['main_bottom_resume_use']){
			$latest_resume_list_rows = $design['main_bottom_resume_total'];
			$service_check = $service_control->service_check('main_rbasic');	// 메인페이지 이력서 일반 리스트 사용시
			$latest_resume_list_con = " where `wr_open` = 1 and `is_delete` = 0 ";
			if($service_check['is_pay']){
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


		$mside_platinum_banner = $banner_control->get_banner_for_position("mside_platinum_top");	// 메인 플래티넘 채용정보 위 배너
		$mside_prime_banner = $banner_control->get_banner_for_position("mside_prime_top");			// 메인 프라임 채용정보 위 배너
		$mside_grand_banner = $banner_control->get_banner_for_position("mside_grand_top");			// 메인 그랜드 채용정보 위 배너
		$mside_banner_banner = $banner_control->get_banner_for_position("mside_banner_top");		// 메인 배너형 채용정보 위 배너
		$mside_list_banner = $banner_control->get_banner_for_position("mside_list_top");					// 메인 리스트형 채용정보 위 배너
		$mside_focus_banner = $banner_control->get_banner_for_position("mside_focus_top");				// 메인 포커스 인재정보 위 배너
		$mside_elatest_banner = $banner_control->get_banner_for_position("mside_elatest_top");			// 최근 채용정보 위 배너
		$mside_rlatest_banner = $banner_control->get_banner_for_position("mside_rlatest_top");			// 최근 인재정보 위 배너
		$mside_board_banner = $banner_control->get_banner_for_position("mside_board_top");			// 최근 게시글 위 배너


		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form','cycle'));

		##
		# Include view
		if(is_file($alice['main_path'] . '/views/index.html'))
			include_once $alice['main_path'] . '/views/index.html';
		else
			$config->error_info( $alice['main_path'] . '/views/index.html' );


		include_once $alice['include_path'] . "/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close


/*
		if(is_dir($alice['self'] . $alice['main']))

			header("Location: " . $alice['self'] . $alice['main']);

		else

			die("/engine/config/app_config.php 파일 에서 설정하신 메인 디렉토리명 '" . $alice['main'] . "' 이(가) /" . $application . "/ 하위에 존재하지 않습니다.<br/>메인 디렉토리명을 확인해 주세요. ");
*/

	
?>