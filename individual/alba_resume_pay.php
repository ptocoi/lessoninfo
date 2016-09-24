<?php
		/*
		* /application/company/alba_resume_pay.php
		* @author Harimao
		* @since 2013/10/01
		* @last update 2015/04/14
		* @Module v3.5 ( Alice )
		* @Brief :: Member resume alba service paying
		* @Comment :: 개인회원 정규직 이력서 서비스 결제 페이지
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "individual";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$mode = $_POST['mode'];
		$sel_service = $_POST['sel_service'];
		$no = $_POST['no'];

		if(!$no){	// no 가 없는 경우 튕겨냄
			$utility->popup_msg_js($service_control->_errors('0010'));
			exit;
		}


		/* 서비스 정보 */
		$main_focus = $service_control->service_check('main_focus');	 // 메인 - 포커스 인재정보
		$main_focus_service = $service_control->__ServiceList($main_focus['service']);	// 메인 - 포커스 인재정보 리스트
		$main_focus_gold = $service_control->service_check('main_focus_gold');	 // 메인 - 포커스 인재정보 골드
		$main_focus_gold_service = $service_control->__ServiceList($main_focus_gold['service']);	// 메인 - 포커스 골드 서비스 리스트

		$main_rbasic = $service_control->service_check('main_rbasic');	 // 메인 - 인재정보 일반리스트
		$main_rbasic_service = $service_control->__ServiceList($main_rbasic['service']);	// 메인 - 인재정보 일반리스트

		$alba_resume_focus = $service_control->service_check('alba_resume_focus');	 // 서브 - 포커스 인재정보
		$alba_resume_focus_service = $service_control->__ServiceList($alba_resume_focus['service']);	// 서브 - 포커스 인재정보 리스트
		$alba_resume_focus_gold = $service_control->service_check('alba_resume_focus_gold');	 // 서브 - 포커스 인재정보 골드
		$alba_resume_focus_gold_service = $service_control->__ServiceList($alba_resume_focus_gold['service']);	// 서브 - 포커스 골드 서비스 리스트

		$alba_resume_basic = $service_control->service_check('alba_resume_basic');	 // 서브 - 인재정보 일반리스트
		$alba_resume_basic_service = $service_control->__ServiceList($alba_resume_basic['service']);	// 서브 - 인재정보 일반리스트
		/* // 서비스 정보 */

		/* 옵션 정보 */
		$resume_option_busy = $service_control->service_check('resume_option_busy');	// 이력서 - 급구 옵션
		$resume_option_busy_service = $service_control->__ServiceList($resume_option_busy['service']);	// 이력서 급구 서비스 리스트
		$resume_option_busy_icon = $alice['data_icon_path'] . "/" . $resume_option_busy['busy_icon'];

		$resume_option_neon = $service_control->service_check('resume_option_neon');	// 이력서 형광펜 옵션
		$resume_option_neon_service = $service_control->__ServiceList($resume_option_neon['service']);	// 이력서 형광펜 서비스 리스트
		$resume_option_neon_color = explode("/",$resume_option_neon['neon_color']);	 // 색상
		$resume_option_neon_color_cnt = count($resume_option_neon_color);

		$resume_option_bold = $service_control->service_check('resume_option_bold');	// 이력서 굵은글자 옵션
		$resume_option_bold_service = $service_control->__ServiceList($resume_option_bold['service']);	// 이력서 굵은글자 서비스 리스트

		$resume_option_icon = $service_control->service_check('resume_option_icon');	// 이력서 아이콘 옵션
		$resume_option_icon_service = $service_control->__ServiceList($resume_option_icon['service']);	// 이력서 아이콘 서비스 리스트
		$resume_option_icon_list = $category_control->category_codeList($resume_option_icon['service']);

		$resume_option_color = $service_control->service_check('resume_option_color');	// 이력서 글자색 옵션
		$resume_option_color_service = $service_control->__ServiceList($resume_option_color['service']);	// 이력서 글자색 서비스 리스트
		$resume_option_colors = explode("/",$resume_option_color['font_color']);	// 색상
		$resume_option_colors_cnt = count($resume_option_colors);

		$resume_option_blink = $service_control->service_check('resume_option_blink');	// 이력서 반짝칼라 옵션
		$resume_option_blink_service = $service_control->__ServiceList($resume_option_blink['service']);	// 이력서 반짝칼라 서비스 리스트

		$resume_option_jump = $service_control->service_check('resume_option_jump');	// 이력서 점프 옵션
		$resume_option_jump_service = $service_control->__ServiceList($resume_option_jump['service']);	// 이력서 점프 서비스 리스트

		$etc_alba = $service_control->service_check('etc_alba');	// 정규직 열람
		$etc_alba_service = $service_control->__ServiceList($etc_alba['service']);	// 정규직 열람 서비스 리스트
		/* // 옵션 정보 */

		$get_resume = $alba_resume_user_control->get_resume_no($no);	 // 이력서 정보

		/*
		echo "<pre>";
		print_R($_POST);
		//print_r($resume_option_busy_service);
		echo "</pre>";
		*/


		if($sel_service){	 // 단일 서비스

			$service_date = $_POST[$sel_service.'_date'];
			$service_info = explode('/',$service_date);
			$service_info_cnt = count($service_info);

			switch($sel_service){
				case 'main_focus':
					$title_icon = "메인 포커스";
					$title_position = "메인 하단";
					$is_gold_service = $main_focus_gold['is_pay'];	// 골드 서비스 사용유무
					$num_row = $main_focus_total;
					$service_rows = $main_focus_service;
					$gold_service_rows = $main_focus_gold_service;
					$service_date = explode("/",$_POST['main_focus_date']);
				break;
				case 'alba_resume_focus':
					$title_icon = "인재정보 포커스";
					$title_position = "인재정보 상단";
					$is_gold_service = $alba_resume_focus_gold['is_pay'];	// 골드 서비스 사용유무
					$num_row = $sub_focus_total;
					$service_rows = $alba_resume_focus_service;
					$gold_service_rows = $alba_resume_focus_gold_service;
					$service_date = explode("/",$_POST['alba_resume_focus_date']);
				break;
				case 'main_rbasic':
					$title_icon = "메인 최근인재정보";
					$title_position = "메인 하단";
					$is_gold_service = false;
					$num_row = 0;
					$service_rows = $main_rbasic_service;
					$gold_service_rows = 0;
					$service_date = explode("/",$_POST['main_rbasic_date']);
				break;
				case 'alba_resume_basic':
					$title_icon = "인재정보 일반리스트";
					$title_position = "인재정보 하단";
					$is_gold_service = false;
					$num_row = 0;
					$service_rows = $alba_resume_basic_service;
					$gold_service_rows = 0;
					$service_date = explode("/",$_POST['alba_resume_basic_date']);
				break;

				## 강조옵션 단일 선택시
				case 'resume_option_busy':	
					$title_icon = "인재정보 급구 아이콘";
					//$busy_service_rows = $resume_option_busy_service;
					$service_date = explode("/",$_POST['resume_option_busy_date']);
				break;
				case 'resume_option_jump':
					$title_icon = "인재정보 점프 서비스";
					$jump_service_rows = $resume_option_jump_service;
					$service_date = explode("/",$_POST['resume_option_jump_date']);
				break;

				## 채용공고 열람 서비스
				case 'etc_alba':
					$title_icon = "채용공고 열람 서비스";
					$service_date = explode("/",$_POST['etc_alba_date']);
				break;

				## SMS 충전 서비스
				case 'etc_sms':
					$title_icon = "SMS 충전 서비스";
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

		} else {

			$pay_service = array();

			$post_main_focus_date = $_POST['main_focus_date'];
			$post_main_focus = explode("/",$post_main_focus_date);
			if($post_main_focus_date) array_push($pay_service,'main_focus');

			$post_main_rbasic_date = $_POST['main_rbasic_date'];
			$post_main_rbasic = explode("/",$post_main_rbasic_date);
			if($post_main_rbasic_date) array_push($pay_service,'main_rbasic');

			$post_alba_resume_focus_date = $_POST['alba_resume_focus_date'];
			$post_alba_resume_focus = explode("/",$post_alba_resume_focus_date);
			if($post_alba_resume_focus_date) array_push($pay_service,'alba_resume_focus');

			$post_alba_resume_basic_date = $_POST['alba_resume_basic_date'];
			$post_alba_resume_basic = explode("/",$post_alba_resume_basic_date);
			if($post_alba_resume_basic_date) array_push($pay_service,'alba_resume_basic');

			$post_busy_option_date = $_POST['resume_option_busy_date'];
			$post_busy_option_dates = explode("/",$post_busy_option_date);
			if($post_busy_option_date) array_push($pay_service,'resume_option_busy');

			$post_neon_option = $_POST['resume_option_neon'];
			$post_neon_option_date = $_POST['resume_option_neon_date'];
			$post_neon_option_dates = explode("/",$post_neon_option_date);
			if($post_neon_option_date) array_push($pay_service,'resume_option_neon');

			$post_bold_option_date = $_POST['resume_option_bold_date'];
			$post_bold_option_dates = explode("/",$post_bold_option_date);
			if($post_bold_option_date) array_push($pay_service,'resume_option_bold');

			$post_icon_option = $_POST['resume_option_icon'];
			$post_icon_option_date = $_POST['resume_option_icon_date'];
			$post_icon_option_dates = explode("/",$post_icon_option_date);
			if($post_icon_option_date) array_push($pay_service,'resume_option_icon');

			$post_color_option = $_POST['resume_option_color'];
			$post_color_option_date = $_POST['resume_option_color_date'];
			$post_color_option_dates = explode("/",$post_color_option_date);
			if($post_color_option_date) array_push($pay_service,'resume_option_color');

			$post_blink_option_date = $_POST['resume_option_blink_date'];
			$post_blink_option_dates = explode("/",$post_blink_option_date);
			if($post_blink_option_date) array_push($pay_service,'resume_option_blink');


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

			$resume_option_jump_date = $_POST['resume_option_jump_date'];
			$resume_option_jump_dates = explode("/",$resume_option_jump_date);
			if($resume_option_jump_date) array_push($pay_service,'resume_option_jump');

			$etc_alba_date = $_POST['etc_alba_date'];
			$etc_alba_dates = explode("/",$etc_alba_date);
			if($etc_alba_date) array_push($pay_service,'etc_alba');

			$etc_sms_date = $_POST['etc_sms_date'];
			$etc_sms_dates = explode("/",$etc_sms_date);
			if($etc_sms_date) array_push($pay_service,'etc_sms');

			$post_total_price = $_POST['total_price'];

			$good_name = "이력서 서비스 복합 선택";

			$is_gold_service = false;	// 골드 서비스 사용유무
			if($main_focus_gold['is_pay']){
				$main_focus_is_gold = true;
			}
			if($alba_resume_focus_gold['is_pay']){
				$alba_resume_focus_is_gold = true;
			}

		}

		$package_no = $_POST['package_no'];	// 패키지 선택 상품 no
		$package = $package_control->get_package($package_no);
		$package_content = unserialize($package['wr_content']);
		if($package_no){
			$post_total_price += $package['wr_price'];
		}

		/*
		echo "<pre>";
		print_R($_POST);
		echo "</pre>";
		*/

		// 열람권 기간/건수 확인		
		$is_open_service = false;
		if( $utility->valid_day($member_service['mb_service_alba_open']) ){
			$is_open_service = $member_service['mb_service_alba_open'];
		}
		$is_open_count = false;
		if( $utility->valid_day($member_service['mb_service_alba_open']) && $member_service['mb_service_alba_count'] ){
			$is_open_count = $member_service['mb_service_alba_count'];
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
				include_once $alice['paygate_path'] . "/kcp/cfg/site_conf_inc.php";

			break;

		}

		$bank_list = $bank_control->__BankList();

		echo $config->_plugin( array('form') );

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_resume_pay.html'))
			include_once $alice['self'] . 'views/alba_resume_pay.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_resume_pay.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>