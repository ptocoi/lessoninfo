<?php
		/*
		* /application/company/company_insert.php
		* @author Harimao
		* @since 2014/08/08
		* @last update 2015/04/20
		* @Module v3.5 ( Alice )
		* @Brief :: Company info insert
		* @Comment :: 기업회원 기업정보 입력/수정
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
		$no = $_GET['no'];

		$form_list = $category_control->category_codeList('company_form', " `rank` asc ");	// 카테고리 리스트

		if($no){

			$mode = "update";
			$get_company = $member_control->get_company_memberNo($no);	 // 기업 정보

			$mb_ceo_name = $get_company['mb_ceo_name'];
			$mb_company_name = $get_company['mb_company_name'];

			$mb_biz_phone = explode('-',$get_company['mb_biz_phone']);
			$mb_biz_hphone = explode('-',$get_company['mb_biz_hphone']);

			$mb_zipcode = explode('-',$get_company['mb_biz_zipcode']);
			$mb_address0 = $get_company['mb_biz_address0'];
			$mb_address1 = $get_company['mb_biz_address1'];

			$photo_con =  ($no) ? " and `company_no` = '".$no."' " : "";
			$photo_0 = $user_control->get_member_photo($member['mb_id'], 0, $photo_con);
			$photo_0_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_0;
			$photo_0_name = $photo_0;
			$photo_0 = (is_file($photo_0_file)) ? $photo_0_file : "../images/comn/no_profileimg.gif";

			$photo_1 = $user_control->get_member_photo($member['mb_id'], 1, $photo_con);
			$photo_1_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_1;
			$photo_1_name = $photo_1;
			$photo_1 = (is_file($photo_1_file)) ? $photo_1_file : "../images/comn/no_profileimg.gif";

			$photo_2 = $user_control->get_member_photo($member['mb_id'], 2, $photo_con);
			$photo_2_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_2;
			$photo_2_name = $photo_2;
			$photo_2 = (is_file($photo_2_file)) ? $photo_2_file : "../images/comn/no_profileimg.gif";

			$photo_3 = $user_control->get_member_photo($member['mb_id'], 3, $photo_con);
			$photo_3_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_3;
			$photo_3_name = $photo_3;
			$photo_3 = (is_file($photo_3_file)) ? $photo_3_file : "../images/comn/no_profileimg.gif";

			$photo_4 = $user_control->get_member_photo($member['mb_id'], 4, $photo_con);
			$photo_4_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_4;
			$photo_4_name = $photo_4;
			$photo_4 = (is_file($photo_4_file)) ? $photo_4_file : "../images/comn/no_profileimg.gif";

		} else {

			$mode = "insert";
			
			$mb_ceo_name = $company_member['mb_ceo_name'];
			$mb_company_name = $company_member['mb_company_name'];

			$mb_zipcode = "";
			$mb_address0 = "";
			$mb_address1 = "";

			$photo_0 = $photo_1 = $photo_2 = $photo_3 = $photo_4 = "../images/comn/no_profileimg.gif";
		}

		$mb_biz_vision = $category_control->get_categoryCode('20130626172616_7679');	// 기업개요 및 비전
		$mb_biz_result = $category_control->get_categoryCode('20130626172621_6326');	// 기업연혁 및 실적

		$phone_num_option = $config->get_tel_num($mb_biz_phone[0]);		// 전화번호
		$hphone_num_option = $config->get_hp_num($mb_biz_hphone[0]);		// 휴대폰 번호
		$biz_type_option = $config->get_biz_type($get_company['mb_biz_type']);	// 업종

		$use_map = $env['use_map'];
		$daum_local_key = $env['daum_local_key'];
		$naver_map_key = $env['naver_map_key'];
		
		$map_control->get_map();	 // 지도

		switch($use_map){
			case 'daum':
				$map_color = "#617BFF";
				$map_script = "<script src=\"//apis.daum.net/maps/maps3.js?apikey=".$env['daum_map_key']."&libraries=services\"></script>";
			break;
			case 'naver':
				$map_color = "#33CC00";
				$map_script = "";
			break;
			case 'google':
				$map_color = "#C0C0C0";
				$map_script = "";
			break;
		}

		$logo_con = "";
		$logo_list = $logo_control->__EmploylogoList("","",$logo_con);

		// 기업정보를 기준으로 로고 추출
		$company_logo = $alba_user_control->get_logo($get_company);

		##
		# Call Editor
		echo "<script src='".$alice['editor_path']."/cheditor/cheditor.js'></script>";
		echo $utility->call_cheditor('mb_biz_vision', '100%', '300px');
		echo $utility->call_cheditor('mb_biz_result', '100%', '300px');

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/company_insert.html'))
			include_once $alice['self'] . 'views/company_insert.html';
		else
			$config->error_info( $alice['self'] . 'views/company_insert.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>