<?php
		/*
		* /application/member/sms_pay.php
		* @author Harimao
		* @since 2015/04/02
		* @last update 2015/04/02
		* @Module v3.5 ( Alice )
		* @Brief :: Member sms paying
		* @Comment :: 회원 SMS 충전 결제 페이지
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "member";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$mode = $_POST['mode'];
		$sel_service = $_POST['sel_service'];

		$etc_sms_date = $_POST['etc_sms_date'];
		$etc_sms_dates = explode("/",$etc_sms_date);

		$post_total_price = ($_POST['total_price']) ? $_POST['total_price'] : $etc_sms_dates[4];

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

		$good_name = "이력서 열람 서비스";

		$bank_list = $bank_control->__BankList();

		echo $config->_plugin( array('form') );

		##
		# Include view
		if(is_file($alice['self'] . 'views/sms_pay.html'))
			include_once $alice['self'] . 'views/sms_pay.html';
		else
			$config->error_info( $alice['self'] . 'views/sms_pay.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close
?>