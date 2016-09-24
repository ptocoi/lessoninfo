<?php
		/*
		* /application/service/index.php
		* @author Harimao
		* @since 2013/07/24
		* @last update 2015/04/13
		* @Module v3.5 ( Alice )
		* @Brief :: Service info
		* @Comment :: 서비스 안내
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "service";

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
		$site_name = stripslashes($env['site_name']);

		$service_check_list = $service_control->service_check_list();	// 서비스 전체 리스트

		$main_platinum = $service_control->service_check('main_platinum');	 // 메인 - 플래티넘
		$main_platinum_service = $service_control->__ServiceList($main_platinum['service']);	// 메인 - 플래티넘 서비스 리스트
		$main_platinum_gold = $service_control->service_check('main_platinum_gold');	 // 메인 - 플래티넘 골드

		$main_prime = $service_control->service_check('main_prime');	 // 메인 - 프라임
		$main_prime_service = $service_control->__ServiceList($main_prime['service']);	// 메인 - 프라임 서비스 리스트
		$main_prime_gold = $service_control->service_check('main_prime_gold');	 // 메인 - 프라임 골드

		$main_grand = $service_control->service_check('main_grand');	 // 메인 - 그랜드
		$main_grand_service = $service_control->__ServiceList($main_grand['service']);	// 메인 - 그랜드 서비스 리스트
		$main_grand_gold = $service_control->service_check('main_grand_gold');	 // 메인 - 그랜드 골드

		$main_banner = $service_control->service_check('main_banner');	 // 메인 - 배너형
		$main_banner_service = $service_control->__ServiceList($main_banner['service']);	// 메인 - 배너형 서비스 리스트
		$main_banner_gold = $service_control->service_check('main_banner_gold');	 // 메인 - 배너형 골드

		$main_list = $service_control->service_check('main_list');	 // 메인 - 리스트형
		$main_list_service = $service_control->__ServiceList($main_list['service']);	// 메인 - 리스트형 서비스 리스트
		$main_list_gold = $service_control->service_check('main_list_gold');	 // 메인 - 리스트형 골드
		$main_etc_0 = explode(" ",$main_list['etc_0']);

		
		$alba_platinum = $service_control->service_check('alba_platinum');	 // 서브 - 플래티넘
		$alba_platinum_service = $service_control->__ServiceList($alba_platinum['service']);	// 서브 - 플래티넘 서비스 리스트
		$alba_platinum_gold = $service_control->service_check('alba_platinum_gold');	 // 서브 - 플래티넘 골드

		$alba_banner = $service_control->service_check('alba_banner');	 // 서브 - 배너형
		$alba_banner_service = $service_control->__ServiceList($alba_banner['service']);	// 서브 - 배너형 서비스 리스트
		$alba_banner_gold = $service_control->service_check('alba_banner_gold');	 // 서브 - 배너형 골드

		$alba_list = $service_control->service_check('alba_list');	 // 서브 - 리스트형
		$alba_list_service = $service_control->__ServiceList($alba_list['service']);	// 서브 - 리스트형 서비스 리스트
		$alba_list_gold = $service_control->service_check('alba_list_gold');	 // 서브 - 리스트형 골드
		$alba_etc_0 = explode(" ",$alba_list['etc_0']);

		$alba_option_busy = $service_control->service_check('alba_option_busy');	// 알바 급구 옵션
		$alba_option_busy_service = $service_control->__ServiceList($alba_option_busy['service']);	// 알바 급구 서비스 리스트
		$alba_option_busy_icon = $alice['data_icon_path'] . "/" . $alba_option_busy['busy_icon'];

		$alba_option_logo = $service_control->service_check('alba_option_logo');	// 알바 로고 옵션
		$alba_option_logo_service = $service_control->__ServiceList($alba_option_logo['service']);	// 알바 로고 서비스 리스트
		$alba_option_logo_effects = explode("/",$alba_option_logo['effect']);	 // 효과

		$alba_option_neon = $service_control->service_check('alba_option_neon');	// 알바 형광펜 옵션
		$alba_option_neon_service = $service_control->__ServiceList($alba_option_neon['service']);	// 알바 형광펜 서비스 리스트
		$alba_option_neon_color = explode("/",$alba_option_neon['neon_color']);	 // 색상
		$alba_option_neon_color_cnt = count($alba_option_neon_color);

		$alba_option_bold = $service_control->service_check('alba_option_bold');	// 알바 굵은글자 옵션
		$alba_option_bold_service = $service_control->__ServiceList($alba_option_bold['service']);	// 알바 굵은글자 서비스 리스트

		$alba_option_icon = $service_control->service_check('alba_option_icon');	// 알바 아이콘 옵션
		$alba_option_icon_service = $service_control->__ServiceList($alba_option_icon['service']);	// 알바 아이콘 서비스 리스트
		$alba_option_icon_list = $category_control->category_codeList($alba_option_icon['service']);

		$alba_option_color = $service_control->service_check('alba_option_color');	// 알바 글자색 옵션
		$alba_option_color_service = $service_control->__ServiceList($alba_option_color['service']);	// 알바 글자색 서비스 리스트
		$alba_option_colors = explode("/",$alba_option_color['font_color']);	// 색상
		$alba_option_colors_cnt = count($alba_option_colors);

		$alba_option_blink = $service_control->service_check('alba_option_blink');	// 알바 반짝칼라 옵션
		$alba_option_blink_service = $service_control->__ServiceList($alba_option_blink['service']);	// 알바 반짝칼라 서비스 리스트

		$alba_option_jump = $service_control->service_check('alba_option_jump');	// 알바 점프 옵션
		$alba_option_jump_service = $service_control->__ServiceList($alba_option_jump['service']);	// 알바 점프 서비스 리스트

		$etc_open = $service_control->service_check('etc_open');	// 이력서 열람
		$etc_open_service = $service_control->__ServiceList($etc_open['service']);	// 이력서 열람 서비스 리스트

		$main_focus = $service_control->service_check('main_focus');	 // 메인 - 포커스 인재정보
		$main_focus_service = $service_control->__ServiceList($main_focus['service']);	// 메인 - 포커스 인재정보 리스트
		$main_focus_gold = $service_control->service_check('main_focus_gold');	 // 메인 - 포커스 인재정보 골드
		$main_focus_gold_service = $service_control->__ServiceList($main_focus_gold['service']);	// 메인 - 포커스 골드 서비스 리스트



		$main_focus = $service_control->service_check('main_focus');	 // 메인 - 포커스 인재정보
		$main_focus_service = $service_control->__ServiceList($main_focus['service']);	// 메인 - 포커스 인재정보 리스트
		$main_focus_gold = $service_control->service_check('main_focus_gold');	 // 메인 - 포커스 인재정보 골드

		$alba_resume_focus = $service_control->service_check('alba_resume_focus');	 // 서브 - 포커스 인재정보
		$alba_resume_focus_service = $service_control->__ServiceList($alba_resume_focus['service']);	// 서브 - 포커스 인재정보 리스트
		$alba_resume_focus_gold = $service_control->service_check('alba_resume_focus_gold');	 // 서브 - 포커스 인재정보 골드

		$resume_option_busy = $service_control->service_check('resume_option_busy');	// 인재정보 급구 옵션
		$resume_option_busy_service = $service_control->__ServiceList($resume_option_busy['service']);	// 인재정보 급구 서비스 리스트
		$resume_option_busy_icon = $alice['data_icon_path'] . "/" . $resume_option_busy['busy_icon'];

		$resume_option_neon = $service_control->service_check('resume_option_neon');	// 인재정보 형광펜 옵션
		$resume_option_neon_service = $service_control->__ServiceList($resume_option_neon['service']);	// 인재정보 형광펜 서비스 리스트
		$resume_option_neon_color = explode("/",$resume_option_neon['neon_color']);	 // 색상
		$resume_option_neon_color_cnt = count($resume_option_neon_color);

		$resume_option_bold = $service_control->service_check('resume_option_bold');	// 인재정보 굵은글자 옵션
		$resume_option_bold_service = $service_control->__ServiceList($resume_option_bold['service']);	// 인재정보 굵은글자 서비스 리스트

		$resume_option_icon = $service_control->service_check('resume_option_icon');	// 인재정보 아이콘 옵션
		$resume_option_icon_service = $service_control->__ServiceList($resume_option_icon['service']);	// 인재정보 아이콘 서비스 리스트
		$resume_option_icon_list = $category_control->category_codeList($resume_option_icon['service']);

		$resume_option_color = $service_control->service_check('resume_option_color');	// 인재정보 글자색 옵션
		$resume_option_color_service = $service_control->__ServiceList($resume_option_color['service']);	// 인재정보 글자색 서비스 리스트
		$resume_option_colors = explode("/",$resume_option_color['font_color']);	// 색상
		$resume_option_colors_cnt = count($resume_option_colors);

		$resume_option_blink = $service_control->service_check('resume_option_blink');	// 인재정보 반짝칼라 옵션
		$resume_option_blink_service = $service_control->__ServiceList($resume_option_blink['service']);	// 인재정보 반짝칼라 서비스 리스트

		$resume_option_jump = $service_control->service_check('resume_option_jump');	// 인재정보 점프 옵션
		$resume_option_jump_service = $service_control->__ServiceList($resume_option_jump['service']);	// 인재정보 점프 서비스 리스트

		$etc_alba = $service_control->service_check('etc_alba');	// 알바 열람
		$etc_alba_service = $service_control->__ServiceList($etc_alba['service']);	// 알바 열람 서비스 리스트

		$etc_sms = $service_control->service_check('etc_sms');	// SMS 충전
		$etc_sms_service = $service_control->__ServiceList($etc_sms['service']);	// SMS 충전 서비스 리스트

		// 메인 플래티넘 등록 가능 유무 체크
		$main_platinum_limit = false;
		if($design['main_platinum_limit']){	// 등록제한을 설정했다면
			$main_platinum_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_service_platinum` >= curdate() ) and `is_delete` = 0 ";
			$main_platinum_list = $alba_user_control->__AlbaList( $page, "", $main_platinum_con );
			$main_platinum_list_total = $main_platinum_list['total_count'];
			if($main_platinum_list_total >= $design['main_platinum_total']){
				$main_platinum_limit = true;
			}
		}

		$main_prime = $service_control->service_check('main_prime');	 // 메인 - 프라임
		$main_prime_service = $service_control->__ServiceList($main_prime['service']);	// 메인 - 프라임 서비스 리스트
		$main_prime_gold = $service_control->service_check('main_prime_gold');	 // 메인 - 프라임 골드

		// 메인 프라임 등록 가능 유무 체크
		$main_prime_limit = false;
		if($design['main_prime_limit']){	// 등록제한을 설정했다면
			$main_prime_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_service_prime` >= curdate() ) and `is_delete` = 0 ";
			$main_prime_list = $alba_user_control->__AlbaList( $page, "", $main_prime_con );
			$main_prime_list_total = $main_prime_list['total_count'];
			if($main_prime_list_total >= $design['main_prime_total']){
				$main_prime_limit = true;
			}
		}

		$main_grand = $service_control->service_check('main_grand');	 // 메인 - 그랜드
		$main_grand_service = $service_control->__ServiceList($main_grand['service']);	// 메인 - 그랜드 서비스 리스트
		$main_grand_gold = $service_control->service_check('main_grand_gold');	 // 메인 - 그랜드 골드

		// 메인 그랜드 등록 가능 유무 체크
		$main_grand_limit = false;
		if($design['main_grand_limit']){
			$main_grand_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_service_grand` >= curdate() ) and `is_delete` = 0 ";
			$main_grand_list = $alba_user_control->__AlbaList( $page, "", $main_grand_con );
			$main_grand_list_total = $main_grand_list['total_count'];
			if($main_grand_list_total >= $design['main_grand_total']){
				$main_grand_limit = true;
			}
		}

		$main_banner = $service_control->service_check('main_banner');	 // 메인 - 배너형
		$main_banner_service = $service_control->__ServiceList($main_banner['service']);	// 메인 - 배너형 서비스 리스트
		$main_banner_gold = $service_control->service_check('main_banner_gold');	 // 메인 - 배너형 골드

		// 메인 배너형 등록 가능 유무 체크
		$main_banner_limit = false;
		if($design['main_banner_limit']){
			$main_banner_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_service_banner` >= curdate() ) and `is_delete` = 0 ";
			$main_banner_list = $alba_user_control->__AlbaList( $page, "", $main_banner_con );
			$main_banner_list_total = $main_banner_list['total_count'];
			if($main_banner_list_total >= $design['main_banner_total']){
				$main_banner_limit = true;
			}
		}

		$main_list = $service_control->service_check('main_list');	 // 메인 - 리스트형
		$main_list_service = $service_control->__ServiceList($main_list['service']);	// 메인 - 리스트형 서비스 리스트
		$main_list_gold = $service_control->service_check('main_list_gold');	 // 메인 - 리스트형 골드
		$main_etc_0 = explode(" ",$main_list['etc_0']);

		// 메인 리스트형 등록 가능 유무 체크
		$main_list_limit = false;
		if($design['main_list_limit']){
			$main_list_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_service_list` >= curdate() ) and `is_delete` = 0 ";
			$main_list_list = $alba_user_control->__AlbaList( $page, "", $main_list_con );
			$main_list_list_total = $main_list_list['total_count'];
			if($main_list_list_total >= $design['main_list_total']){
				$main_list_limit = true;
			}
		}
		
		$alba_platinum = $service_control->service_check('alba_platinum');	 // 서브 - 플래티넘
		$alba_platinum_service = $service_control->__ServiceList($alba_platinum['service']);	// 서브 - 플래티넘 서비스 리스트
		$alba_platinum_gold = $service_control->service_check('alba_platinum_gold');	 // 서브 - 플래티넘 골드

		// 서브 플래티넘 등록 가능 유무 체크
		$alba_platinum_limit = false;
		if($design['sub_platinum_limit']){
			$alba_platinum_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and `wr_service_platinum_sub` >= curdate() and `is_delete` = 0 ";
			$alba_platinum_list = $alba_user_control->__AlbaList( $page, "", $alba_platinum_con );
			$alba_platinum_list_total = $alba_platinum_list['total_count'];
			if($alba_platinum_list_total >= $design['sub_platinum_total']){
				$alba_platinum_limit = true;
			}
		}

		$alba_banner = $service_control->service_check('alba_banner');	 // 서브 - 배너형
		$alba_banner_service = $service_control->__ServiceList($alba_banner['service']);	// 서브 - 배너형 서비스 리스트
		$alba_banner_gold = $service_control->service_check('alba_banner_gold');	 // 서브 - 배너형 골드

		// 서브 배너형 등록 가능 유무 체크
		$alba_banner_limit = false;
		if($design['sub_platinum_limit']){
			$alba_banner_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_service_banner_sub` >= curdate() ) and `is_delete` = 0 ";
			$alba_banner_list = $alba_user_control->__AlbaList( $page, "", $alba_banner_con );
			$alba_banner_list_total = $alba_banner_list['total_count'];
			if($alba_banner_list_total >= $design['sub_banner_total']){
				$alba_banner_limit = true;
			}
		}

		$alba_list = $service_control->service_check('alba_list');	 // 서브 - 리스트형
		$alba_list_service = $service_control->__ServiceList($alba_list['service']);	// 서브 - 리스트형 서비스 리스트
		$alba_list_gold = $service_control->service_check('alba_list_gold');	 // 서브 - 리스트형 골드
		$alba_etc_0 = explode(" ",$alba_list['etc_0']);

		// 서브 리스트형 등록 가능 유무 체크
		$alba_list_limit = false;
		if($design['sub_list_limit']){
			$alba_list_con = " where `wr_open` = 1 and `wr_is_adult` = 0 and ( `wr_service_list_sub` >= curdate() ) and `is_delete` = 0 ";
			$alba_list_list = $alba_user_control->__AlbaList( $page, "", $alba_list_con );
			$alba_list_list_total = $list_list['total_count'];
			if($alba_list_list_total >= $design['sub_list_total']){
				$alba_list_limit = true;
			}
		}


		// 메인 포커스 등록 가능 유무 체크
		$main_focus_limit = false;
		if($design['main_focus_limit']){
			$main_focus_con = " where `wr_open` = 1 and ( `wr_service_main_focus` >= curdate() ) and `is_delete` = 0 ";
			$main_focus_list = $alba_resume_user_control->__ResumeList($page, "", $main_focus_con);
			$main_focus_list_total = $main_focus_list['total_count'];
			if($main_focus_list_total >= $design['main_focus_total']){
				$main_focus_limit = true;
			}
		}

		$alba_resume_focus = $service_control->service_check('alba_resume_focus');	 // 서브 - 포커스 인재정보
		$alba_resume_focus_service = $service_control->__ServiceList($alba_resume_focus['service']);	// 서브 - 포커스 인재정보 리스트
		$alba_resume_focus_gold = $service_control->service_check('alba_resume_focus_gold');	 // 서브 - 포커스 인재정보 골드

		// 인재 포커스 등록 가능 유무 체크
		$alba_resume_focus_limit = false;
		if($design['main_focus_limit']){
			$alba_resume_focus_con = " where `wr_open` = 1 and `wr_service_sub_focus` >= now() and `is_delete` = 0 ";
			$alba_resume_focus_list = $alba_resume_user_control->__ResumeList( $page, "", $alba_resume_focus_con );
			$alba_resume_focus_list_total = $alba_resume_focus_list['total_count'];
			if($alba_resume_focus_list_total >= $design['sub_focus_total']){
				$alba_resume_focus_limit = true;
			}
		}


		$main_basic = $service_control->service_check('main_basic');	 // 메인 - 일반리스트
		$main_basic_service = $service_control->__ServiceList($main_basic['service']);	// 메인 - 리스트형 서비스 리스트
		$main_basic_gold = $service_control->service_check('main_basic_gold');	 // 메인 - 리스트형 골드
		$main_basic_0 = explode(" ",$main_basic['etc_0']);

		$alba_basic = $service_control->service_check('alba_basic');	 // 서브 - 일반리스트
		$alba_basic_service = $service_control->__ServiceList($alba_basic['service']);	// 서브 - 일반리스트 서비스 리스트
		$alba_basic_gold = $service_control->service_check('alba_basic_gold');	 // 서브 - 일반리스트 골드
		$alba_etc_0 = explode(" ",$alba_basic['etc_0']);

		$alba_resume_basic = $service_control->service_check('alba_resume_basic');	 // 서브 - 일반리스트
		$alba_resume_basic_service = $service_control->__ServiceList($alba_resume_basic['service']);	// 서브 - 일반리스트

		$main_rbasic = $service_control->service_check('main_rbasic');	 // 메인 - 일반 리스트
		$main_rbasic_service = $service_control->__ServiceList($main_rbasic['service']);	// 메인 - 일반 리스트

		$employ_package_con = " where `wr_type` = 'employ' and `wr_use` = '1' ";
		$employ_package_list = $package_control->__PackageList("","",$employ_package_con);

		$resume_package_con = " where `wr_type` = 'individual' and `wr_use` = '1' ";
		$resume_package_list = $package_control->__PackageList("","",$resume_package_con);

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form','cycle','easing'));

		##
		# Call Editor

		##
		# Check referer
		if( $_GET['type'] != 'resume' && (strrpos($_SERVER['HTTP_REFERER'],'individual') || strrpos($_SERVER['HTTP_REFERER'],'resume'))) {
			$type = 'resume';
		}

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