<?php
		/*
		* /application/nad/alba/resume.php
		* @author Harimao
		* @since 2013/06/26
		* @last update 2015/04/15
		* @Module v3.5 ( Alice )
		* @Brief :: Arbeit resume list
		* @Comment :: 이력서 관리
		*/
		
		$cat_path = "../../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		##
		# Menu Navigation
		$top_menu = "서비스관리";
		$top_menu_code = "100000";

		##
		# Include Top
		include_once "../include/top.php";

		$result = $_GET['result'];	// 입력했나?

		$middle_menu = $menu[$tmp_menu]['menus'][1]['name'];
		$middle_menu_code = $menu[$tmp_menu]['menus'][1]['code'];
		if($mode=='insert'){
			$sub_menu_name = $menu[$tmp_menu]['menus'][1]['sub_menu'][1]['name'];
			$sub_menu = "<dd class='col'>".$sub_menu_name."</dd>";
			$sub_menu_code = $menu[$tmp_menu]['menus'][1]['sub_menu'][1]['code'];
		} else {
			$sub_menu_name = $menu[$tmp_menu]['menus'][1]['sub_menu'][0]['name'];
			$sub_menu = "<dd class='col'>".$sub_menu_name."</dd>";
			$sub_menu_code = $menu[$tmp_menu]['menus'][1]['sub_menu'][0]['code'];
		}

		if($mode=='insert'){
			$sub_menu_url = "/" . $alice['admin_alba'] . "/resume.php?mode=insert";
		} else {
			$sub_menu_url = "/" . $alice['admin_alba'] . "/resume.php";
		}

		##
		# 부관리자 메뉴 접근 권한 체크
		if(!$is_super_admin)	// 최고관리자가 아닐때만
			$admin_control->admin_auth_checking($admin_info['uid'],$top_menu_code,$middle_menu_code,$sub_menu_code);

		##
		# Variables
		$wr_job_type_0 = $_GET['wr_job_type_0'];
		$wr_job_type_1 = $_GET['wr_job_type_1'];
		$wr_job_type_2 = $_GET['wr_job_type_2'];

		$job_type_list = $category_control->category_codeList('job_type');		// 직종
		$area_list = $category_control->category_codeList('area');					// 지역
		$job_career_list = $category_control->category_codeList('job_career', '', 'yes');		// 경력조건
		$job_ability_list = $category_control->category_codeList('job_ability', '', 'yes');		// 학력조건
		$indi_ability_list = $category_control->category_codeList('indi_ability', '', 'yes');		// 최종학력

		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows : 15;
		if($mode == 'search'){	// 삭제된 이력서 체크
			$con = " and `is_delete` = 0 ";
		} else {
			$con = " where `is_delete` = 0 ";
		}
		$list = $alba_resume_control->__ResumeList($page, $page_rows, $con);
		$pages = $utility->get_paging($page_rows, $page, $list['total_page'],"./resume.php?".$sorting."page_rows=".$page_rows."&".$alba_list['send_url']."&page=");

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form','autoNumeric'));

		##
		# Call Editor
		echo "<script src='".$alice['editor_path']."/cheditor/cheditor.js'></script>";
		echo $utility->call_cheditor("wr_introduce", '100%', '580px');

		##
		# Include view
		if(is_file($alice['self'] . 'views/resume.html'))
			include_once $alice['self'] . 'views/resume.html';
		else
			$config->error_info( $alice['self'] . 'views/resume.html' );


		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close
?>