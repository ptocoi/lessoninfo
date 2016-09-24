<?php
		/*
		* /application/individual/alba_resume_service.php
		* @author Harimao
		* @since 2013/07/24
		* @last update 2015/04/13
		* @Module v3.5 ( Alice )
		* @Brief :: Member individual alba resume service
		* @Comment :: 개인회원 정규직 이력서 서비스 결제 페이지
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "individual";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$service_check_list = $service_control->service_check_list();	// 서비스 전체 리스트

		$main_focus = $service_control->service_check('main_focus');	 // 메인 - 포커스 인재정보
		$main_focus_service = $service_control->__ServiceList($main_focus['service']);	// 메인 - 포커스 인재정보 리스트
		$main_focus_gold = $service_control->service_check('main_focus_gold');	 // 메인 - 포커스 인재정보 골드

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

		
		$main_rbasic = $service_control->service_check('main_rbasic');	 // 메인 - 일반 리스트
		$main_rbasic_service = $service_control->__ServiceList($main_rbasic['service']);	// 메인 - 일반 리스트


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

		
		$alba_resume_basic = $service_control->service_check('alba_resume_basic');	 // 서브 - 일반리스트
		$alba_resume_basic_service = $service_control->__ServiceList($alba_resume_basic['service']);	// 서브 - 일반리스트


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

		$etc_alba = $service_control->service_check('etc_alba');	// 정규직 열람
		$etc_alba_service = $service_control->__ServiceList($etc_alba['service']);	// 정규직 열람 서비스 리스트

		$etc_sms = $service_control->service_check('etc_sms');	// SMS 충전
		$etc_sms_service = $service_control->__ServiceList($etc_sms['service']);	// SMS 충전 서비스 리스트

		/*
		echo "<pre>";
		print_R($main_focus);
		print_R($main_focus_service);
		print_R($main_focus_gold);
		echo "</pre>";
		*/


		$package_con = " where `wr_type` = 'individual' and `wr_use` = '1' ";
		$package_list = $package_control->__PackageList("","",$package_con);

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_resume_service.html'))
			include_once $alice['self'] . 'views/alba_resume_service.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_resume_service.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>