<?php
		/*
		* /application/nad/design/index.php
		* @author Harimao
		* @since 2013/08/05
		* @last update 2015/04/14
		* @Module v3.5 ( Alice )
		* @Brief :: Design Control
		* @Comment :: 기본 디자인관리 관리
		*/
		
		$cat_path = "../../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		##
		# Menu Navigation
		$top_menu = "디자인관리";
		$top_menu_code = "400000";

		##
		# Include Top
		include_once "../include/top.php";

		$middle_menu = $menu[$tmp_menu]['menus'][0]['name'];
		$middle_menu_code = $menu[$tmp_menu]['menus'][0]['code'];
		if($mode=='insert'){
			$sub_menu_name = $menu[$tmp_menu]['menus'][0]['sub_menu'][1]['name'];
			$sub_menu = "<dd class='col'>".$sub_menu_name."</dd>";
			$sub_menu_code = $menu[$tmp_menu]['menus'][0]['sub_menu'][1]['code'];
		} else {
			$sub_menu_name = $menu[$tmp_menu]['menus'][0]['sub_menu'][0]['name'];
			$sub_menu = "<dd class='col'>".$sub_menu_name."</dd>";
			$sub_menu_code = $menu[$tmp_menu]['menus'][0]['sub_menu'][0]['code'];
		}

		if($mode=='insert'){
			$sub_menu_url = "/" . $alice['admin_design'] . "/index.php?mode=insert";
		} else {
			$sub_menu_url = "/" . $alice['admin_design'] . "/index.php";
		}

		##
		# 부관리자 메뉴 접근 권한 체크
		if(!$is_super_admin)	// 최고관리자가 아닐때만
			$admin_control->admin_auth_checking($admin_info['uid'],$top_menu_code,$middle_menu_code,$sub_menu_code);

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form','colourPicker'));

		##
		# Variables
		$member_skin_dir = $utility->get_skin_dir($alice['member_path'] . "/skins/");
		$member_skin_cnt = count($member_skin_dir);
		/*
		$employ_skin_dir = $utility->get_skin_dir($alice['employ_path'] . "/skins/");
		$employ_skin_cnt = count($employ_skin_dir);
		*/
		$alba_skin_dir = $utility->get_skin_dir($alice['alba_path'] . "/skins/");
		$alba_skin_cnt = count($alba_skin_dir);
		/*
		$resume_skin_dir = $utility->get_skin_dir($alice['resume_path'] . "/skins/");
		$resume_skin_cnt = count($resume_skin_dir);
		*/
		$alba_resume_skin_dir = $utility->get_skin_dir($alice['resume_path'] . "/skins/");
		$alba_resume_skin_cnt = count($alba_resume_skin_dir);
		$board_skin_dir = $utility->get_skin_dir($alice['board_path'] . "/skins/");
		$board_skin_cnt = count($board_skin_dir);
		/*
		$map_skin_dir = $utility->get_skin_dir($alice['map_path'] . "/skins/");
		$map_skin_cnt = count($map_skin_dir);
		*/

		$category_list = $category_control->category_codeList('job_type');
		$professional_indi = explode(',',$design['professional_indi']);	 // 전문인재정보
		$professional_indi_cnt = count($professional_indi);

		if($professional_indi[0]!=''){
			$professional_vals = "";
			for($i=0;$i<$professional_indi_cnt;$i++){ 
				$professional_vals[$i] = $utility->remove_quoted( $category_control->get_categoryCodeName($professional_indi[$i]) );
			}
			$professional_text = implode($professional_vals,', ');
		} else {
			$professional_text = "전문인재정보 직종을 선택해 주세요.";
		}


		##
		# Call Editor
		echo "<script src='".$alice['editor_path']."/cheditor/cheditor.js'></script>";
		echo $utility->call_cheditor('main_platinum_content', '790px', '100px');
		echo $utility->call_cheditor('main_prime_content', '790px', '100px');
		echo $utility->call_cheditor('main_grand_content', '790px', '100px');
		echo $utility->call_cheditor('main_banner_content', '790px', '100px');
		echo $utility->call_cheditor('main_list_content', '790px', '100px');
		echo $utility->call_cheditor('main_busy_content', '790px', '100px');
		echo $utility->call_cheditor('main_focus_content', '790px', '100px');
		echo $utility->call_cheditor('main_basic_content', '790px', '100px');	// 메인 채용공고
		echo $utility->call_cheditor('main_rbasic_content', '790px', '100px');	// 메인 이력서

		echo $utility->call_cheditor('sub_platinum_content', '790px', '100px');
		echo $utility->call_cheditor('sub_banner_content', '790px', '100px');
		echo $utility->call_cheditor('sub_list_content', '790px', '100px');
		echo $utility->call_cheditor('sub_busy_content', '790px', '100px');
		echo $utility->call_cheditor('sub_focus_content', '790px', '100px');
		echo $utility->call_cheditor('sub_basic_content', '790px', '100px');	// 서브 채용공고
		echo $utility->call_cheditor('sub_rbasic_content', '790px', '100px');	// 서브 인재정보

		echo $utility->call_cheditor('alba_jump_content', '790px', '100px');	 // 채용공고 점프 서비스
		echo $utility->call_cheditor('resume_jump_content', '790px', '100px');	// 이력서 점프 서비스

		echo $utility->call_cheditor('alba_open_content', '790px', '100px');	// 채용공고 열람 서비스
		echo $utility->call_cheditor('resume_open_content', '790px', '100px');	// 이력서 열람 서비스

		echo $utility->call_cheditor('etc_alba_sms_content', '790px', '150px');	// 기업회원 SMS 충전 서비스안내
		echo $utility->call_cheditor('etc_resume_sms_content', '790px', '150px');	// 개인회원 SMS 충전 서비스안내


		##
		# Include view
		if(is_file($alice['self'] . 'views/index.html'))
			include_once $alice['self'] . 'views/index.html';
		else
			$config->error_info( $alice['self'] . 'views/index.html' );

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close
	
?>