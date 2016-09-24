<?php
		/*
		* /application/alba/company_info.php
		* @author Harimao
		* @since 2013/08/26
		* @last update 2015/07/07
		* @Module v3.5 ( Alice )
		* @Brief :: Alba company infomation
		* @Comment :: 기업회원 정보
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "alba";

		$banner_atop_position = $page_name . "_top";
		$banner_top_position = $page_name . "_top_banner";
		$banner_left_position = $page_name . "_left";
		$banner_tail_position = $page_name . "_bottom";
		$banner_left_wing_position = $page_name . "_left_scroll";
		$banner_right_wing_position = $page_name . "_right_scroll";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$mb_id = $_GET['mb_id'];
		$no = $_GET['no'];
		if($mb_id){
			$member_info = $user_control->get_member($mb_id);
			$company_info = $user_control->get_member_company($mb_id);
			$photo_list = $user_control->member_photo_list($mb_id," and `data_no` = 0 "," order by `no` asc ");
			$mb_homepage = $member_info['mb_homepage'];
			$mb_address = $member_info['mb_address0']." ".$member_info['mb_address1'];
			$mb_phone = $member_info['mb_phone'];
			$mb_fax = $member_info['mb_fax'];
		} else if($no){
			$company_info = $user_control->get_member_company_no($no);
			$mb_id = $company_info['mb_id'];
			$member_info = $user_control->get_member($mb_id);
			$photo_list = $user_control->member_photo_list($mb_id," and `company_no` = " . $no," order by `no` asc ");
			$mb_homepage = $member_info['mb_homepage'];
			$mb_address = $company_info['mb_biz_address0']." ".$company_info['mb_biz_address1'];
			$mb_phone = $company_info['mb_biz_phone'];
			$mb_fax = $company_info['mb_biz_fax'];
		}

		if($member_info['is_delete']){	 // 삭제된 회원정보
			$utility->popup_msg_js("기업회원 정보를 찾을 수 없습니다.");
			exit;
		}

		$mb_company_name = stripslashes($company_info['mb_company_name']);

		if(!$mb_id && !$no){
			$utility->popup_msg_js("기업정보가 확인되지 않습니다.");
		}

		if(is_file($alice['data_member_path']."/".$mb_id."/logo/".$company_info['mb_logo'])){
			$mb_logo_size = @getimagesize($alice['data_member_path']."/".$mb_id."/logo/".$company_info['mb_logo']);
			$mb_logo_width = ($mb_logo_size[0] < 200) ? $mb_logo_size[0] : 200;
			$mb_logo_height = ($mb_logo_size[1] < 100) ? $mb_logo_size[1] : 100;
		}


		$mb_biz_type = $category_control->get_categoryCodeName($company_info['mb_biz_type']);
		$mb_biz_form = $category_control->get_categoryCodeName($company_info['mb_biz_form']);
		$mb_biz_success = $category_control->get_categoryCodeName($company_info['mb_biz_success']);

		$use_map = $env['use_map'];	// 사용 지도 api

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

		$area_point = $company_info['mb_latlng'];
		
		echo $map_control->detail_map( $area_point );

		// 진행중인 공고
		/*
		$continue_con = " where `wr_id` = '".$mb_id."' and ( `wr_volume_always` = '1' or `wr_volume_end` = '1' or `wr_volume_date` >= curdate() ) ";
		$continue_con .= " and ( ";
		$continue_con .= " `wr_service_platinum` >= curdate() ";
		$continue_con .= " or `wr_service_prime` >= curdate() ";
		$continue_con .= " or `wr_service_grand` >= curdate() ";
		$continue_con .= " or `wr_service_banner` >= curdate() ";
		$continue_con .= " or `wr_service_list` >= curdate() ";
		$continue_con .= " ) ";
		*/

		$continue_con = " where `wr_id` = '".$mb_id."' and ( `wr_volume_always` = '1' or `wr_volume_end` = '1' or `wr_volume_date` >= curdate() ) ";
		$continue_con .= " and `is_delete` = 0 ";

		$continue_list = $alba_company_control->__AlbaList("", "", $continue_con);

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


		$service_check = $service_control->service_check('etc_alba');
		$open_is_pay = $service_check['is_pay'];
		$service_open = $utility->valid_day($member_service['mb_service_alba_open']);	// 공고 열람 서비스 기간 체크


		// 열람권 기간/건수 확인
		$is_open_service = false;
		if( $utility->valid_day($member_service['mb_service_alba_open']) ){
			$is_open_service = $member_service['mb_service_alba_open'];
		}
		$is_open_count = false;
		if( $utility->valid_day($member_service['mb_service_alba_open']) && $member_service['mb_service_alba_count'] ){	// 건수 사용이 가능하다면
			$is_open_count = $member_service['mb_service_alba_count'];
		}

		// 채용공고 열람 정보 저장
		if($is_open_service && !$is_open_count)	// 열람 기간은 있고, 열람 건수는 없는 경우
			$alba_individual_control->open_insert($no,$get_alba['wr_id'],"alba");

		$is_open_alba = $alba_resume_user_control->is_open_resume('alba',$member['mb_id'],$get_alba['wr_id'], $no);	// 열람한 정보가 있는지

		$wr_is_open = false;
		$wr_mb_address = $wr_mb_phone = $wr_mb_fax = "";
		if($open_is_pay){	// 열람서비스를 사용한다면 
			if($is_open_count && !$is_open_alba){	 // 열람 건수가 있다면
				//$wr_mb_phone = $wr_mb_fax = $wr_mb_address = "<a href=\"javascript:void(0);\" onclick=\"open_alba('".$no."','".$get_alba['wr_id']."','alba', '".$is_open_count."');\"><img alt=\"열람권사용\" src=\"../images/icon/icon_used.gif\"></a>";
				$wr_mb_address = $wr_mb_phone = $wr_mb_fax = "<img alt=\"열람권사용\" src=\"../images/icon/icon_used.gif\">";
			} else if( $service_open || $is_open_alba ) {
				$wr_mb_address = $mb_address;
				$wr_mb_phone = $mb_phone;
				$wr_mb_fax = $mb_fax;
			} else {
				$wr_mb_address = $wr_mb_phone = $wr_mb_fax = "<img width=\"41\" height=\"14\" alt=\"비공개\" src=\"../images/icon/icon_closed.gif\">";
			}
		} else {
			$wr_mb_address = $mb_address;
			$wr_mb_phone = $mb_phone;
			$wr_mb_fax = $mb_fax;
		}

		$get_favorite_list = $alba_individual_control->get_favorite_list("",""," where `wr_id` = '".$member['mb_id']."' and `mb_id` = '".$company_info['mb_id']."' and `mb_company_no` = '".$no."' ");

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form','cycle'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/company_info.html'))
			include_once $alice['self'] . 'views/company_info.html';
		else
			$config->error_info( $alice['self'] . 'views/company_info.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close
?>