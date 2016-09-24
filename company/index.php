<?php
		/*
		* /application/member/index.php
		* @author Harimao
		* @since 2013/07/16
		* @last update 2015/04/08
		* @Module v3.5 ( Alice )
		* @Brief :: Company member info
		* @Comment :: 기업회원 정보 페이지
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
		# Valid checking (_engine.php 에서도 하지만 보안상 여기서도 한다)
		if(!$is_member){
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?type=company&url=".$urlencode);
			exit;
		}
		if($mb_type=='individual'){	 // 개인회원 접근시
			$utility->popup_msg_js($user_control->_errors('0031'));
			exit;
		}

		##
		# Variables
		$form_list = $category_control->category_codeList('company_form', " `rank` asc ");	// 폼 카테고리 리스트

		$con  = " where `wr_id` = '".$member['mb_id']."' and `is_delete` = 0 ";
		$continue_cnt = $alba_company_control->alba_list_count($con . " and ( `wr_volume_always` = '1' or `wr_volume_end` = '1' or `wr_volume_date` >= curdate() ) ");	// 진행중인 공고 카운팅
		$end_cnt = $alba_company_control->alba_list_count($con . " and ( `wr_volume_always` = '0' and `wr_volume_end` = '0' and `wr_volume_date` < curdate() ) ");	// 마감된 공고 카운팅


		$apply_con = " where `wr_to_id` = '".$member['mb_id']."' and `is_cancel` = 0 and `is_delete` = 0 ";
		$apply_list = $receive_control->__ReceiveList( $receive_page, $receive_page_rows, $apply_con );
		$apply_cnt = $apply_list['total_count'];
		$scrap_list = $alba_user_control->scrap_list($member['mb_id']);
		$scrap_cnt = $scrap_list['total_count'];	// 스크랩 카운팅

		// 진행중인 채용공고 최근 5건
		$continue_page = 1;
		$continue_page_rows = 5;
		$continue_con = " and ( `wr_volume_always` = '1' or `wr_volume_end` = '1' or `wr_volume_date` >= curdate() ) ";
		$continue_list = $alba_company_control->__AlbaList($continue_page, $continue_page_rows, $con . $continue_con);

		// 마감된 채용공고 최근 5건
		$end_page = 1;
		$end_page_rows = 5;
		$end_con = " and ( `wr_volume_always` = '0' and `wr_volume_end` = '0' and `wr_volume_date` < curdate() ) ";
		$end_list = $alba_company_control->__AlbaList($end_page, $end_page_rows, $con . $end_con);

		// 최근 입사지원자
		$receive_page = 1;
		$receive_page_rows = 5;
		$receive_con = " where `wr_to_id` = '".$member['mb_id']."' and `is_cancel` = 0 and `is_delete` = 0 ";
		$receive_list = $receive_control->__ReceiveList( $receive_page, $receive_page_rows, $receive_con );

		// 맞춤 인재정보
		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows: 5;
		$con = " where `is_delete` = 0 ";
		$custom_list = $alba_company_control->custom_list($page, $page_rows, $con);


		$biz_homepage = $category_control->get_categoryCode('20130626171544_9534');	 // 홈페이지주소

		$biz_content = $category_control->get_categoryCode('20130626172514_1792');	 // 주요사업내용
		$biz_foundation = $category_control->get_categoryCode('20130626171611_2769');	// 설립일
		$biz_member_count = $category_control->get_categoryCode('20130626172544_6551');	 // 사원수
		$biz_form_option = $category_control->get_categoryCode('20130626171524_3156');	// 기업형태
		$biz_success = $category_control->get_categoryCode('20130626171534_3599');	// 상장여부
		$biz_stock = $category_control->get_categoryCode('20130626172551_1164');	// 자본금
		$biz_sale = $category_control->get_categoryCode('20130626172556_1808');	 // 매출액
		$biz_vision = $category_control->get_categoryCode('20130626172616_7679');	 // 기업개요 및 비전
		$biz_result = $category_control->get_categoryCode('20130626172621_6326');	 // 기업연혁 및 실적
		$biz_fax = $category_control->get_categoryCode('20130626172051_4894');	 // 팩스번호

		/* 대표 기업 정보
		$get_company = $user_control->get_company($member['mb_id']);
		$company_member = $user_control->get_member_company($get_company['mb_id']);	// 기업회원 정보
		$mb_logo_file = $alice['data_member_path']."/".$company_member['mb_id']."/logo/".$company_member['mb_logo'];
		$mb_logo = (is_file($mb_logo_file)) ? $mb_logo_file : "../images/basic/bg_noPhoto.gif";	 // 기업회원 로고 사진
		//대표 기업 정보 */

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

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