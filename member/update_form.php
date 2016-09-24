<?php
		/*
		* /application/member/update_form.php
		* @author Harimao
		* @since 2013/07/15
		* @last update 2015/04/10
		* @Module v3.5 ( Alice )
		* @Brief :: Member update form
		* @Comment :: 회원정보 수정 폼
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "member";

		$banner_atop_position = "main_top";
		$banner_logo_position = "main_logo_banner";
		$banner_left_position = "main_left";
		$banner_tail_position = "main_bottom";
		$banner_left_wing_position = "main_left_scroll";
		$banner_right_wing_position = "main_right_scroll";

		$navi_page = "member_update";

		$navi_name = "마이페이지";

		include_once $cat_path . "_engine.php";

		if($mb_type=='individual'){
			$sub_navi_name = "개인정보 수정";
			$mypage_path = $alice['individual_path'];
		} elseif($mb_type=='company') {
			$sub_navi_name = "기업정보 수정";
			$mypage_path = $alice['company_path'];
		}

		if(!$is_member){	// 회원이 아니라면
			$utility->popup_msg_js($user_control->_errors('0015'),"./login.php?url=".$urlencode);
			exit;
		}

		##
		# Variables
		$use_ipin = $env['use_ipin'];
		$use_hphone = $env['use_hphone'];
		$use_map = $env['use_map'];
		$mb_birth = explode('-',$member['mb_birth']);	// 생일
		$mb_gender = $user_control->mb_gender[$member['mb_gender']];	 // 성별
		$mb_zipcode = explode('-',$member['mb_zipcode']);	// 우편번호
		$mb_receive_sms = (@in_array('sms',$mb_receive)) ? 'checked' : '';
		$mb_receive_email = (@in_array('email',$mb_receive)) ? 'checked' : '';
		$mb_receive_memo = (@in_array('memo',$mb_receive)) ? 'checked' : '';
		$mb_photos = unserialize($member['mb_photos']);

		$photo_0 = $user_control->get_member_photo($member['mb_id'], 0, " and `company_no` = '".$company_member['no']."' ");
		$photo_0_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_0;
		$photo_0 = (is_file($photo_0_file)) ? $photo_0_file : "../images/comn/no_profileimg.gif";

		$photo_1 = $user_control->get_member_photo($member['mb_id'], 1, " and `company_no` = '".$company_member['no']."' ");
		$photo_1_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_1;
		$photo_1 = (is_file($photo_1_file)) ? $photo_1_file : "../images/comn/no_profileimg.gif";

		$photo_2 = $user_control->get_member_photo($member['mb_id'], 2, " and `company_no` = '".$company_member['no']."' ");
		$photo_2_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_2;
		$photo_2 = (is_file($photo_2_file)) ? $photo_2_file : "../images/comn/no_profileimg.gif";

		$photo_3 = $user_control->get_member_photo($member['mb_id'], 3, " and `company_no` = '".$company_member['no']."' ");
		$photo_3_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_3;
		$photo_3 = (is_file($photo_3_file)) ? $photo_3_file : "../images/comn/no_profileimg.gif";

		$photo_4 = $user_control->get_member_photo($member['mb_id'], 4, " and `company_no` = '".$company_member['no']."' ");
		$photo_4_file = $alice['data_member_path']."/".$member['mb_id']."/photos/".$photo_4;
		$photo_4 = (is_file($photo_4_file)) ? $photo_4_file : "../images/comn/no_profileimg.gif";

		$mb_biz_vision = $category_control->get_categoryCode('20130626172616_7679');	// 기업개요 및 비전
		$mb_biz_result = $category_control->get_categoryCode('20130626172621_6326');	// 기업연혁 및 실적

		if($mb_type=='company'){	 // 기업회원일때만
			$form_list = $category_control->category_codeList('company_form', " `rank` asc ");	// 카테고리 리스트
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

			##
			# Call Editor
			echo "<script src='".$alice['editor_path']."/cheditor/cheditor.js'></script>";
			echo $utility->call_cheditor('mb_biz_vision', '680px', '300px');
			echo $utility->call_cheditor('mb_biz_result', '680px', '300px');
		}

		$get_company = $user_control->get_company($member['mb_id']);	// 대표 기업정보
		$company_member = $user_control->get_member_company($get_company['mb_id']);	// 기업회원 정보

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/update_form.html'))
			include_once $alice['self'] . 'views/update_form.html';
		else
			$config->error_info( $alice['self'] . 'views/update_form.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>