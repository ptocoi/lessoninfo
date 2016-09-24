<?php
		/*
		* /application/company/alba_pay.php
		* @author Harimao
		* @since 2013/08/27
		* @last update 2015/04/14
		* @Module v3.5 ( Alice )
		* @Brief :: Member company alba service paying
		* @Comment :: 기업회원 알바 서비스 결제 페이지
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "company";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$mode = $_POST['mode'];
		$sel_service = $_POST['sel_service'];
		$no = $_POST['no'];

		if(!$no){	// no 가 없는 경우 튕겨냄
			$utility->popup_msg_js($service_control->_errors('0009'));
			exit;
		}

		/* 서비스 정보 */
		$main_platinum = $service_control->service_check('main_platinum');	 // 메인 - 플래티넘
		$main_platinum_service = $service_control->__ServiceList($main_platinum['service']);	// 메인 - 플래티넘 서비스 리스트
		$main_platinum_gold = $service_control->service_check('main_platinum_gold');	 // 메인 - 플래티넘 골드
		$main_platinum_gold_service = $service_control->__ServiceList($main_platinum_gold['service']);	// 메인 - 플래티넘 골드 서비스 리스트
		$main_platinum_logo = $service_control->service_check('main_platinum_logo');	 // 메인 - 플래티넘 로고강조
		$main_platinum_logo_service = $service_control->__ServiceList($main_platinum_logo['service']);	// 메인 - 플래티넘 로고강조 리스트

		$main_prime = $service_control->service_check('main_prime');	 // 메인 - 프라임
		$main_prime_service = $service_control->__ServiceList($main_prime['service']);	// 메인 - 프라임 서비스 리스트
		$main_prime_gold = $service_control->service_check('main_prime_gold');	 // 메인 - 프라임 골드
		$main_prime_gold_service = $service_control->__ServiceList($main_prime_gold['service']);	// 메인 - 프라임 골드 서비스 리스트
		$main_prime_logo = $service_control->service_check('main_prime_logo');	 // 메인 - 프라임 로고강조
		$main_prime_logo_service = $service_control->__ServiceList($main_prime_logo['service']);	// 메인 - 프라임 로고강조 리스트

		$main_grand = $service_control->service_check('main_grand');	 // 메인 - 그랜드
		$main_grand_service = $service_control->__ServiceList($main_grand['service']);	// 메인 - 그랜드 서비스 리스트
		$main_grand_gold = $service_control->service_check('main_grand_gold');	 // 메인 - 그랜드 골드
		$main_grand_gold_service = $service_control->__ServiceList($main_grand_gold['service']);	// 메인 - 그랜드 골드 서비스 리스트
		$main_grand_logo = $service_control->service_check('main_grand_logo');	 // 메인 - 그랜드 로고강조
		$main_grand_logo_service = $service_control->__ServiceList($main_grand_logo['service']);	// 메인 - 그랜드 로고강조 리스트

		$main_banner = $service_control->service_check('main_banner');	 // 메인 - 배너형
		$main_banner_service = $service_control->__ServiceList($main_banner['service']);	// 메인 - 배너형 서비스 리스트
		$main_banner_gold = $service_control->service_check('main_banner_gold');	 // 메인 - 배너형 골드
		$main_banner_gold_service = $service_control->__ServiceList($main_banner_gold['service']);	// 메인 - 배너형 골드 서비스 리스트

		$main_list = $service_control->service_check('main_list');	 // 메인 - 리스트형
		$main_list_service = $service_control->__ServiceList($main_list['service']);	// 메인 - 리스트형 서비스 리스트
		$main_list_gold = $service_control->service_check('main_list_gold');	// 메인 - 리스트형 골드 서비스 리스트
		$main_list_gold_service = $service_control->__ServiceList($main_list_gold['service']);	// 메인 - 리스트형 골드 서비스 리스트

		$main_etc_0 = explode(" ",$main_list['etc_0']);

		$main_basic = $service_control->service_check('main_basic');	 // 메인 - 일반리스트
		$main_basic_service = $service_control->__ServiceList($main_basic['service']);	// 메인 - 일반리스트

		$main_basic_etc_0 = explode(" ",$main_basic['etc_0']);

		$alba_platinum = $service_control->service_check('alba_platinum');	 // 서브 - 플래티넘
		$alba_platinum_service = $service_control->__ServiceList($alba_platinum['service']);	// 서브 - 플래티넘 서비스 리스트
		$alba_platinum_gold = $service_control->service_check('alba_platinum_gold');	 // 서브 - 플래티넘 골드
		$alba_platinum_gold_service = $service_control->__ServiceList($alba_platinum_gold['service']);	// 서브 - 플래티넘 골드 서비스 리스트
		$alba_platinum_logo = $service_control->service_check('alba_platinum_logo');	 // 서브 - 플래티넘 로고강조
		$alba_platinum_logo_service = $service_control->__ServiceList($alba_platinum_logo['service']);	// 서브 - 플래티넘 로고강조 리스트

		$alba_banner = $service_control->service_check('alba_banner');	 // 서브 - 배너형
		$alba_banner_service = $service_control->__ServiceList($alba_banner['service']);	// 서브 - 배너형 서비스 리스트
		$alba_banner_gold = $service_control->service_check('alba_banner_gold');	 // 서브 - 배너형 골드
		$alba_banner_gold_service = $service_control->__ServiceList($alba_banner_gold['service']);	// 서브 - 배너형 골드 서비스 리스트

		$alba_list = $service_control->service_check('alba_list');	 // 서브 - 리스트형
		$alba_list_service = $service_control->__ServiceList($alba_list['service']);	// 서브 - 리스트형 서비스 리스트
		$alba_list_gold = $service_control->service_check('alba_list_gold');	// 서브 - 리스트형 골드 서비스 리스트
		$alba_list_gold_service = $service_control->__ServiceList($alba_list_gold['service']);	// 서브 - 리스트형 골드 서비스 리스트
		$alba_etc_0 = explode(" ",$alba_list['etc_0']);
		
		$alba_basic = $service_control->service_check('alba_basic');	 // 서브 - 리스트형
		$alba_basic_service = $service_control->__ServiceList($alba_basic['service']);	// 서브 - 리스트형 서비스 리스트
		/* //서비스 정보 */


		/* 옵션 정보 */
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

		$alba_option_busy = $service_control->service_check('alba_option_busy');	// 알바 - 급구 옵션
		$alba_option_busy_service = $service_control->__ServiceList($alba_option_busy['service']);	// 알바 급구 서비스 리스트
		$alba_option_busy_icon = $alice['data_icon_path'] . "/" . $alba_option_busy['busy_icon'];

		$alba_option_jump = $service_control->service_check('alba_option_jump');	// 알바 점프 옵션
		$alba_option_jump_service = $service_control->__ServiceList($alba_option_jump['service']);	// 알바 점프 서비스 리스트

		$etc_open = $service_control->service_check('etc_open');	// 이력서 열람
		$etc_open_service = $service_control->__ServiceList($etc_open['service']);	// 이력서 열람 서비스 리스트

		$etc_sms = $service_control->service_check('etc_sms');	// SMS 충전
		$etc_sms_service = $service_control->__ServiceList($etc_sms['service']);	// SMS 충전 서비스 리스트

		/* //옵션 정보 */

		$get_alba = $alba_user_control->get_alba_no($no);	 // 공고 정보


		if($sel_service){	 // 단일 서비스
			
			$service_date = $_POST[$sel_service.'_date'];
			$service_info = explode('/',$service_date);
			$service_info_cnt = count($service_info);

			switch($sel_service){
				case 'main_platinum': 
					$box_id = "platinum"; 
					$title_icon = "메인 플래티넘";
					$title_position = "메인 최상단";
					$is_gold_service = $main_platinum_gold['is_pay'];	// 골드 서비스 사용유무
					$is_logo_service = $main_platinum_logo['is_pay'];	// 로고강조 사용유무
					$border = $design['main_platinum_border'];
					$margin = ($design['main_platinum_margin']) ? " margin" : "";
					$num_row = $main_platinum_row;
					$service_rows = $main_platinum_service;
					$gold_service_rows = $main_platinum_gold_service;
					$logo_service_rows = $main_platinum_logo_service;
					$service_date = explode("/",$_POST['main_platinum_date']);
				break;
				case 'alba_platinum': 
					$box_id = "platinum"; 
					$title_icon = "채용정보 플래티넘";
					$title_position = "채용정보 최상단";
					$is_gold_service = $alba_platinum_gold['is_pay'];
					$is_logo_service = $alba_platinum_logo['is_pay'];
					$border = $design['sub_platinum_border'];
					$margin = ($design['sub_platinum_margin']) ? " margin" : "";
					$num_row = $sub_platinum_row;
					$service_rows = $alba_platinum_service;
					$gold_service_rows = $alba_platinum_gold_service;
					$logo_service_rows = $alba_platinum_logo_service;
					$service_date = explode("/",$_POST['alba_platinum_date']);
				break;
				case 'main_prime': 
					$box_id = "prime"; 
					$title_icon = "메인 프라임";
					$title_position = "메인 상단 두번째";
					$is_gold_service = $main_prime_gold['is_pay'];
					$is_logo_service = $main_prime_logo['is_pay'];
					$border = $design['main_prime_border'];
					$margin = ($design['main_prime_margin']) ? " margin" : "";
					$num_row = $main_prime_row;
					$service_rows = $main_prime_service;
					$gold_service_rows = $main_prime_gold_service;
					$logo_service_rows = $main_prime_logo_service;
					$service_date = explode("/",$_POST['main_prime_date']);
				break;
				case 'main_grand': 
					$box_id = "grand"; 
					$title_icon = "메인 그랜드";
					$title_position = "메인 상단 세번째";
					$is_gold_service = $main_grand_gold['is_pay'];
					$is_logo_service = $main_grand_logo['is_pay'];
					$border = $design['main_grand_border'];
					$margin = ($design['main_grand_margin']) ? " margin" : "";
					$num_row = $main_grand_row;
					$service_rows = $main_grand_service;
					$gold_service_rows = $main_grand_gold_service;
					$logo_service_rows = $main_grand_logo_service;
					$service_date = explode("/",$_POST['main_grand_date']);
				break;
				case 'main_banner':
					$box_id = "box"; 
					$title_icon = "메인 배너형";
					$title_position = "메인 배너형태";
					$is_gold_service = $main_banner_gold['is_pay'];
					$is_logo_service = 0;
					$border = $design['main_banner_border'];
					$margin = ($design['main_banner_margin']) ? " margin" : "";
					$num_row = $main_banner_row;
					$service_rows = $main_banner_service;
					$gold_service_rows = $main_banner_gold_service;
					$logo_service_rows = 0;
					$service_date = explode("/",$_POST['main_banner_date']);
				break;
				case 'alba_banner': 
					$box_id = "box"; 
					$title_icon = "채용정보 배너형";
					$title_position = "채용정보 배너형태";
					$is_gold_service = $alba_banner_gold['is_pay'];
					$is_logo_service = 0;
					$border = $design['sub_banner_border'];
					$margin = ($design['sub_banner_margin']) ? " margin" : "";
					$num_row = $sub_banner_row;
					$service_rows = $alba_banner_service;
					$gold_service_rows = $alba_banner_gold_service;
					$logo_service_rows = 0;
					$service_date = explode("/",$_POST['alba_banner_date']);
				break;
				case 'main_list':
					$box_id = "list"; 
					$title_icon = "메인 리스트형";
					$title_position = "메인 줄광고";
					$is_gold_service = $main_list_gold['is_pay'];
					$is_logo_service = 0;
					//$is_busy_option = $alba_option_busy['is_pay'];
					$service_rows = $main_list_service;
					$gold_service_rows = $main_list_gold_service;
					$logo_service_rows = 0;
					$service_date = explode("/",$_POST['main_list_date']);
				break;
				case 'alba_list':
					$box_id = "list"; 
					$title_icon = "채용정보 리스트형";
					$title_position = "채용정보 줄광고";
					$is_gold_service = $alba_list_gold['is_pay'];
					$is_logo_service = 0;
					//$is_busy_option = $alba_option_busy['is_pay'];
					$service_rows = $alba_list_service;
					$gold_service_rows = $alba_list_gold_service;
					$logo_service_rows = 0;
					$service_date = explode("/",$_POST['alba_list_date']);
				break;
				case 'main_basic':
					$box_id = "list"; 
					$title_icon = "메인 일반리스트";
					$title_position = "메인 최근채용정보";
					$is_gold_service = false;
					$is_logo_service = 0;
					$is_busy_option = $alba_option_busy['is_pay'];
					$service_rows = $main_basic_service;
					$gold_service_rows = 0;
					$logo_service_rows = 0;
					$service_date = explode("/",$_POST['main_basic_date']);
				break;
				case 'alba_basic':
					$box_id = "list"; 
					$title_icon = "채용정보 일반리스트";
					$title_position = "서브 채용정보 일반리스트";
					$is_gold_service = false;
					$is_logo_service = 0;
					$is_busy_option = $alba_option_busy['is_pay'];
					$service_rows = $alba_basic_service;
					$gold_service_rows = 0;
					$logo_service_rows = 0;
					$service_date = explode("/",$_POST['alba_basic_date']);
				break;

				## 강조옵션 단일 선택시
				case 'alba_option_busy':	
					$title_icon = "일반 리스트 급구 아이콘";
					$busy_service_rows = $alba_option_busy_service;
					$service_date = explode("/",$_POST['alba_option_busy_date']);
				break;
				case 'alba_option_neon':
					$title_icon = "일반 리스트 제목 강조";
					$neon_service_rows = $alba_option_neon_service;
					$service_date = explode("/",$_POST['alba_option_neon_date']);
				break;
				case 'alba_option_bold':
					$title_icon = "일반 리스트 제목 굵게";
					$bold_service_rows = $alba_option_bold_service;
					$service_date = explode("/",$_POST['alba_option_bold_date']);
				break;
				case 'alba_option_icon':
					$title_icon = "일반 리스트 아이콘 강조";
					$icon_service_rows = $alba_option_icon_service;
					$service_date = explode("/",$_POST['alba_option_icon_date']);
				break;
				case 'alba_option_color':
					$title_icon = "일반 리스트 제목 글자색";
					$color_service_rows = $alba_option_color_service;
					$service_date = explode("/",$_POST['alba_option_color_date']);
				break;
				case 'alba_option_blink':
					$title_icon = "일반 리스트 제목 반짝칼라";
					$blink_service_rows = $alba_option_blink_service;
					$service_date = explode("/",$_POST['alba_option_blink_date']);
				break;
				case 'alba_option_jump':
					$title_icon = "채용정보 점프 서비스";
					$jump_service_rows = $alba_option_jump_service;
					$service_date = explode("/",$_POST['alba_option_jump_date']);
				break;
				case 'etc_open':
					$title_icon = "이력서 열람 서비스";
					$open_service_rows = $etc_open_service;
					$service_date = explode("/",$_POST['etc_open_date']);
				break;
				case 'etc_sms':
					$title_icon = "SMS 충전 서비스";
					$sms_service_rows = $etc_sms_service;
					$service_date = explode("/",$_POST['etc_sms_date']);
				break;
			}

			$style_options = "style='";
			if($_POST['alba_option_neon_date']) $style_options .= "background-color:#".$_POST['alba_option_neon'].";";
			if($_POST['alba_option_bold_date']) $style_options .= "font-weight:bold;";

			$icon_options = "";
			if($_POST['alba_option_icon_date']){
				$icon_option = $category_control->get_category($_POST['alba_option_icon']);
				$icon_options .= "<img src='".$alice['data_icon_path']."/".$icon_option['name']."'/>";
			}

			if($_POST['alba_option_color_date']) $style_options .= "color:#".$_POST['alba_option_color'].";";

			$style_options .= "' ";

			$blink_options = "";
			if($_POST['alba_option_blink_date']) $blink_options .= "class='blink'";

			$post_total_price = $service_date[4];

			$good_name = $title_icon;
			$pay_service = $sel_service;

			// 열람권 기간/건수 확인		
			$is_open_service = false;
			if( $utility->valid_day($member_service['mb_service_open']) ){
				$is_open_service = $member_service['mb_service_open'];
			}
			$is_open_count = false;
			if( $utility->valid_day($member_service['mb_service_open']) && $member_service['mb_service_open_count'] ){
				$is_open_count = $member_service['mb_service_open_count'];
			}

		} else {	 // 개별 선택 서비스

			$total_price = 0;

			$pay_service = array();

			$post_main_platinum_date = $_POST['main_platinum_date'];
			$post_main_platinum = explode("/",$post_main_platinum_date);
			if($post_main_platinum_date) array_push($pay_service,'main_platinum');
			$main_platinum_date = explode("/",$post_main_platinum_date);
			$total_price += $main_platinum_date[4];

			$post_main_prime_date = $_POST['main_prime_date'];
			$post_main_prime = explode("/",$post_main_prime_date);
			if($post_main_prime_date) array_push($pay_service,'main_prime');
			$main_prime_date = explode("/",$post_main_prime_date);
			$total_price += $main_prime_date[4];

			$post_main_grand_date = $_POST['main_grand_date'];
			$post_main_grand = explode("/",$post_main_grand_date);
			if($post_main_grand_date) array_push($pay_service,'main_grand');
			$main_grand_date = explode("/",$post_main_grand_date);
			$total_price += $main_grand_date[4];

			$post_main_banner_date = $_POST['main_banner_date'];
			$post_main_banner = explode("/",$post_main_banner_date);
			if($post_main_banner_date) array_push($pay_service,'main_banner');
			$main_banner_date = explode("/",$post_main_banner_date);
			$total_price += $main_banner_date[4];

			$post_main_list_date = $_POST['main_list_date'];
			$post_main_list = explode("/",$post_main_list_date);
			if($post_main_list_date) array_push($pay_service,'main_list');
			$main_list_date = explode("/",$post_main_list_date);
			$total_price += $main_list_date[4];

			$post_alba_platinum_date = $_POST['alba_platinum_date'];
			$post_alba_platinum = explode("/",$post_alba_platinum_date);
			if($post_alba_platinum_date) array_push($pay_service,'alba_platinum');
			$alba_platinum_date = explode("/",$post_alba_platinum_date);
			$total_price += $alba_platinum_date[4];

			$post_alba_banner_date = $_POST['alba_banner_date'];
			$post_alba_banner = explode("/",$post_alba_banner_date);
			if($post_alba_banner_date) array_push($pay_service,'alba_banner');
			$alba_banner_date = explode("/",$post_alba_banner_date);
			$total_price += $alba_banner_date[4];

			$post_alba_list_date = $_POST['alba_list_date'];
			$post_alba_list = explode("/",$post_alba_list_date);
			if($post_alba_list_date) array_push($pay_service,'alba_list');
			$alba_list_date = explode("/",$post_alba_list_date);
			$total_price += $alba_list_date[4];


			$post_busy_option_date = $_POST['alba_option_busy_date'];
			$post_busy_option = explode("/",$post_busy_option_date);
			if($post_busy_option_date) array_push($pay_service,'alba_option_busy');
			$busy_option_date = explode("/",$post_busy_option_date);
			$total_price += $busy_option_date[4];

			$post_neon_option = $_POST['alba_option_neon'];
			$post_neon_option_date = $_POST['alba_option_neon_date'];
			$post_neon_option_dates = explode("/",$post_neon_option_date);
			if($post_neon_option_date) array_push($pay_service,'alba_option_neon');
			$neon_option_date = explode("/",$post_neon_option_date);
			$total_price += $neon_option_date[4];
			
			$post_bold_option = $_POST['alba_option_bold'];
			$post_bold_option_date = $_POST['alba_option_bold_date'];
			$post_bold_option_dates = explode("/",$post_bold_option_date);
			if($post_bold_option_date) array_push($pay_service,'alba_option_bold');
			$bold_option_date = explode("/",$post_bold_option_date);
			$total_price += $bold_option_date[4];

			$post_icon_option = $_POST['alba_option_icon'];
			$post_icon_option_date = $_POST['alba_option_icon_date'];
			$post_icon_option_dates = explode("/",$post_icon_option_date);
			if($post_icon_option_date) array_push($pay_service,'alba_option_icon');
			$icon_option_date = explode("/",$post_icon_option_date);
			$total_price += $icon_option_date[4];

			$post_color_option = $_POST['alba_option_color'];
			$post_color_option_date = $_POST['alba_option_color_date'];
			$post_color_option_dates = explode("/",$post_color_option_date);
			if($post_color_option_date) array_push($pay_service,'alba_option_color');
			$color_option_date = explode("/",$post_color_option_date);
			$total_price += $color_option_date[4];

			$post_blink_option_date = $_POST['alba_option_blink_date'];
			$post_blink_option_dates = explode("/",$post_blink_option_date);
			if($post_blink_option_date) array_push($pay_service,'alba_option_blink');
			$blink_option_date = explode("/",$post_blink_option_date);
			$total_price += $blink_option_date[4];

			$post_jump_option_date = $_POST['alba_option_jump_date'];
			if($post_jump_option_date) array_push($pay_service,'alba_option_jump');
			$jump_option_date = explode("/",$post_jump_option_date);
			$total_price += $jump_option_date[4];

			$post_etc_open_date = $_POST['etc_open_date'];
			if($post_etc_open_date) array_push($pay_service,'etc_open');
			$etc_option_date = explode("/",$post_etc_open_date);
			$total_price += $etc_option_date[4];

			$post_etc_sms_date = $_POST['etc_sms_date'];
			if($post_etc_sms_date) array_push($pay_service,'etc_sms');
			$etc_sms_date = explode("/",$post_etc_sms_date);
			$total_price += $etc_sms_date[4];

			$post_main_basic_date = $_POST['main_basic_date'];
			$post_main_basic = explode("/",$post_main_basic_date);
			if($post_main_basic_date) array_push($pay_service,'main_basic');
			$main_basic_date = explode("/",$post_main_basic_date);
			$total_price += $main_basic_date[4];

			$post_alba_basic_date = $_POST['alba_basic_date'];
			$post_alba_basic = explode("/",$post_alba_basic_date);
			if($post_alba_basic_date) array_push($pay_service,'alba_basic');
			$alba_basic_date = explode("/",$post_alba_basic_date);
			$total_price += $alba_basic_date[4];


			$style_options = "style='";
			if($post_neon_option_date) $style_options .= "background-color:#".$post_neon_option.";";
			if($post_bold_option_date) $style_options .= "font-weight:bold;";

			$icon_options = "";
			if($post_icon_option_date){
				$icon_option = $category_control->get_category($post_icon_option);
				$icon_options .= "<img src='".$alice['data_icon_path']."/".$icon_option['name']."'/>";
			}

			if($post_color_option_date) $style_options .= "color:#".$post_color_option.";";

			$style_options .= "' ";

			$blink_options = "";
			if($post_blink_option_date) $blink_options .= "class='blink'";

			$alba_option_jump_date = $_POST['alba_option_jump_date'];
			$alba_option_jump_dates = explode("/",$alba_option_jump_date);

			$etc_open_date = $_POST['etc_open_date'];
			$etc_open_dates = explode("/",$etc_open_date);

			$etc_sms_date = $_POST['etc_sms_date'];
			$etc_sms_dates = explode("/",$etc_sms_date);

			$post_total_price = ($_POST['total_price']) ? $_POST['total_price'] : $total_price;

			$good_name = "채용정보 서비스 복합 선택";


			// 열람권 기간/건수 확인
			$is_open_service = false;
			if( $utility->valid_day($member_service['mb_service_open']) ){
				$is_open_service = $member_service['mb_service_open'];
			}
			$is_open_count = false;
			if( $utility->valid_day($member_service['mb_service_open']) && $member_service['mb_service_open_count'] ){
				$is_open_count = $member_service['mb_service_open_count'];
			}

		}

		$package_no = $_POST['package_no'];	// 패키지 선택 상품 no
		$package = $package_control->get_package($package_no);
		$package_content = unserialize($package['wr_content']);
		if($package_no){
			$post_total_price += $package['wr_price'];
		}


		if($type=='service_extend'){	// 옵션 연장 결제
			$pay_service_val = 'option_extend';
		} else {
			if(is_array($pay_service)){
				$pay_service_val = implode('/',$pay_service);
			} else {
				$pay_service_val = $pay_service;
			}
		}

		// 결제 정보
		$get_pg = $payment_control->get_use_pg(1);
		$pg_company = $get_pg['pg_company'];
		
		$pg_method = $payment_control->pg_method[$pg_company];

		$pg_sel_method = explode('/',$get_pg['pg_method']);

		$test_price = 1000;

		switch($pg_company){

			## 이니시스
			case 'inicis':

				$inicis_logo = $alice['data_logo_path'] . '/' . $get_pg['pg_logo'];

				require $alice['paygate_path'] . "/INIpay50/libs/INILib.php";

				$inipay = new INIpay50;

				$inipay->SetField("inipayhome", $realpath . "modules/paygate/INIpay50");	// 이니페이 홈디렉터리(상점수정 필요)
				$inipay->SetField("type", "chkfake");	// 고정 (절대 수정 불가)
				$inipay->SetField("debug", "true");		// 로그모드("true"로 설정하면 상세로그가 생성됨.)
				$inipay->SetField("enctype","asym");	//asym:비대칭, symm:대칭(현재 asym으로 고정)

				$inipay->SetField("admin", $get_pg['pg_passwd']); 	// 키패스워드(키발급시 생성, 상점관리자 패스워드와 상관없음)
				$inipay->SetField("checkopt", "false"); //base64함:false, base64안함:true(현재 false로 고정)

				$inipay->SetField("mid", $get_pg['pg_id']);	// 상점아이디
				//$inipay->SetField("price", $test_price);				// 가격 $post_total_price
				$inipay->SetField("nointerest", "no");			//무이자여부(no:일반, yes:무이자)
				$inipay->SetField("quotabase", "lumpsum:00:02:03:04:05:06:07:08:09:10:11:12");//할부기간

				$inipay->startAction();

				if( $inipay->GetResult("ResultCode") != "00" ) {
					echo $inipay->GetResult("ResultMsg");
					exit(0);
				}

				$_SESSION['INI_MID'] = $get_pg['pg_id'];								//상점ID
				$_SESSION['INI_ADMIN'] = $get_pg['pg_passwd'];					// 키패스워드(키발급시 생성, 상점관리자 패스워드와 상관없음)
				//$_SESSION['INI_PRICE'] = $test_price;	//$post_total_price;							//가격 
				$_SESSION['INI_RN'] = $inipay->GetResult("rn");					//고정 (절대 수정 불가)
				$_SESSION['INI_ENCTYPE'] = $inipay->GetResult("enctype");	//고정 (절대 수정 불가)

				$mid = $get_pg['pg_id'];		// 상점 아이디

			break;

			## 올더게잇
			case 'allthegate':

				$pg_set_info = $payment_control->get_pgInfoCompany('allthegate');	// 올더게잇 설정 정보
				$all_logo = $alice['data_logo_path'] . '/' . $pg_set_info['pg_logo'];
				$pg_sel_method = explode('/',$pg_set_info['pg_method']);

			break;

			## KCP
			case 'kcp':

				$pg_set_info = $payment_control->get_pgInfoCompany('kcp');	// KCP 설정 정보
				$kcp_logo = $alice['data_logo_path'] . '/' . $pg_set_info['pg_logo'];
				$pg_sel_method = explode('/',$pg_set_info['pg_method']);
				include $alice['paygate_path'] . "/kcp/cfg/site_conf_inc.php";

			break;

		}

		$bank_list = $bank_control->__BankList();

		echo $config->_plugin( array('cycle','easing','form') );

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_pay.html'))
			include_once $alice['self'] . 'views/alba_pay.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_pay.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>