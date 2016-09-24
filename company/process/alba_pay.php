<?php
		/*
		* /application/company/process/alba_pay.php
		* @author Harimao
		* @since 2013/09/06
		* @last update 2015/04/14
		* @Module v3.5 ( Alice )
		* @Brief :: Alba Pay process
		* @Comment :: 알바 결제 처리프로세스
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?type=company&url=".$urlencode);
			exit;
		}
		if($mb_type=='individual'){	 // 개인회원 접근시
			$utility->popup_msg_js($user_control->_errors('0031'));
			exit;
		}

		$get_pg = $payment_control->get_use_pg(1);

		$no = $_POST['no'];	// 알바 공고 no

		$package_no = $_POST['package_no'];	// 패키지 상품 정보

		$pay_service = array();

		$oid = $utility->getOrderNumber(10);	 // 주문번호
		$vals['pay_no'] = $no;
		$vals['pay_oid'] = $oid;
		$vals['pay_type'] = $_POST['pay_type'];
		$vals['pay_pg'] = $get_pg['pg_company'];
		$vals['pay_method'] = $_POST['pay_method'];
		$vals['pay_uid'] = $member['mb_id'];
		$vals['pay_name'] = $member['mb_name'];
		$vals['pay_phone'] = ($member['mb_hphone']) ? $member['mb_hphone'] : $member['mb_phone'];
		$vals['pay_email'] = $member['mb_email'];


		## 메인 서비스
		$main_platinum_date = $_POST['main_platinum_date'];	// 메인 플래티넘 
		if($main_platinum_date){
			$vals['pay_main_platinum'] = $main_platinum_date;
			array_push($pay_service,'main_platinum');
		}

		$main_platinum_gold = $_POST['main_platinum_gold'];	// 메인 플래티넘 골드
		$main_platinum_gold_date = $_POST['main_platinum_gold_date'];	// 메인 플래티넘 골드 기간
		if($main_platinum_gold_date){
			$vals['pay_main_platinum_gold'] = $main_platinum_gold_date;
			array_push($pay_service,'main_platinum_gold');
		}

		$main_platinum_logo = $_POST['main_platinum_logo'];	// 메인 플래티넘 로고강조
		$main_platinum_logo_effect = $_POST['main_platinum_logo_effect'];	// 메인 플래티넘 로고강조 효과
		$main_platinum_logo_date = $_POST['main_platinum_logo_date'];	// 메인 플래티넘 로고강조 기간
		if($main_platinum_gold_date){
			$vals['pay_main_platinum_logo'] = $main_platinum_logo_date;
			$vals['pay_main_platinum_logo_effect'] = $main_platinum_logo_effect;
			array_push($pay_service,'main_platinum_logo');
		}


		$main_prime_date = $_POST['main_prime_date'];	// 메인 프라임
		if($main_prime_date){
			$vals['pay_main_prime'] = $main_prime_date;
			array_push($pay_service,'main_prime');
		}

		$main_prime_gold = $_POST['main_prime_gold'];	// 메인 프라임 골드
		$main_prime_gold_date = $_POST['main_prime_gold_date'];	// 메인 프라임 골드 기간
		if($main_prime_date){
			$vals['pay_main_prime_gold'] = $main_prime_gold_date;
			array_push($pay_service,'main_prime_gold');
		}

		$main_prime_logo = $_POST['main_prime_logo'];	// 메인 프라임 로고강조
		$main_prime_logo_effect = $_POST['main_prime_logo_effect'];	// 메인 프라임 로고강조 효과
		$main_prime_logo_date = $_POST['main_prime_logo_date'];	// 메인 프라임 로고강조 기간
		if($main_prime_logo_date){
			$vals['pay_main_prime_logo'] = $main_prime_logo_date;
			$vals['pay_main_prime_logo_effect'] = $main_prime_logo_effect;
			array_push($pay_service,'main_prime_logo');
		}


		$main_grand_date = $_POST['main_grand_date'];	// 메인 그랜드
		if($main_grand_date){
			$vals['pay_main_grand'] = $main_grand_date;
			array_push($pay_service,'main_grand');
		}

		$main_grand_gold = $_POST['main_grand_gold'];	// 메인 그랜드 골드
		$main_grand_gold_date = $_POST['main_grand_gold_date'];	// 메인 그랜드 골드 기간
		if($main_grand_gold_date){
			$vals['pay_main_grand_gold'] = $main_grand_gold_date;
			array_push($pay_service,'main_grand_gold');
		}

		$main_grand_logo = $_POST['main_grand_logo'];	// 메인 그랜드 로고강조
		$main_grand_logo_effect = $_POST['main_grand_logo_effect'];	// 메인 그랜드 로고강조 효과
		$main_grand_logo_date = $_POST['main_grand_logo_date'];	// 메인 그랜드 로고강조 기간
		if($main_grand_logo_date){
			$vals['pay_main_grand_logo'] = $main_grand_logo_date;
			$vals['pay_main_grand_logo_effect'] = $main_grand_logo_effect;
			array_push($pay_service,'main_grand_logo');
		}


		$main_banner_date = $_POST['main_banner_date'];	// 메인 배너형
		if($main_banner_date){
			$vals['pay_main_banner'] = $main_banner_date;
			array_push($pay_service,'main_banner');
		}

		$main_banner_gold = $_POST['main_banner_gold'];		// 메인 배너형 골드
		$main_banner_gold_date = $_POST['main_banner_gold_date'];		// 메인 배너형 골드 기간
		if($main_banner_gold_date){
			$vals['pay_main_banner_gold'] = $main_banner_gold_date;
			array_push($pay_service,'main_banner_gold');
		}


		$main_list_date = $_POST['main_list_date'];	// 메인 리스트형
		if($main_list_date){
			$vals['pay_main_list'] = $main_list_date;
			array_push($pay_service,'main_list');
		}

		$main_list_gold = $_POST['main_list_gold'];		// 메인 리스트형 골드
		$main_list_gold_date = $_POST['main_list_gold_date'];		// 메인 리스트형 골드 기간
		if($main_list_gold_date){
			$vals['pay_main_list_gold'] = $main_list_gold_date;
			array_push($pay_service,'main_list_gold');
		}



		## 알바 서비스
		$alba_platinum_date = $_POST['alba_platinum_date'];	// 알바 플래티넘
		if($alba_platinum_date){
			$vals['pay_alba_platinum'] = $alba_platinum_date;
			array_push($pay_service,'alba_platinum');
		}

		$alba_platinum_gold = $_POST['alba_platinum_gold'];	// 알바 플래티넘 골드
		$alba_platinum_gold_date = $_POST['alba_platinum_gold_date'];	// 알바 플래티넘 골드 기간
		if($alba_platinum_gold_date){
			$vals['pay_alba_platinum_gold'] = $alba_platinum_gold_date;
			array_push($pay_service,'alba_platinum_gold');
		}

		$alba_platinum_logo = $_POST['alba_platinum_logo'];	// 알바 플래티넘 로고강조
		$alba_platinum_logo_effect = $_POST['alba_platinum_logo_effect'];	// 알바 플래티넘 로고강조 효과
		$alba_platinum_logo_date = $_POST['alba_platinum_logo_date'];	// 알바 플래티넘 로고강조 기간
		if($alba_platinum_logo_date){
			$vals['pay_alba_platinum_logo'] = $alba_platinum_logo_date;
			$vals['pay_alba_platinum_logo_effect'] = $alba_platinum_logo_effect;
			array_push($pay_service,'alba_platinum_logo');
		}


		$alba_banner_date = $_POST['alba_banner_date'];	// 알바 배너형
		if($alba_banner_date){
			$vals['pay_alba_banner'] = $alba_banner_date;
			array_push($pay_service,'alba_banner');
		}

		$alba_banner_gold = $_POST['alba_banner_gold'];		// 알바 배너형 골드
		$alba_banner_gold_date = $_POST['alba_banner_gold_date'];		// 알바 배너형 골드 기간
		if($alba_banner_gold_date){
			$vals['pay_alba_banner_gold'] = $alba_banner_gold_date;
			array_push($pay_service,'alba_banner_gold');
		}


		$alba_list_date = $_POST['alba_list_date'];	// 알바 리스트형
		if($alba_list_date){
			$vals['pay_alba_list'] = $alba_list_date;
			array_push($pay_service,'alba_list');
		}
		$alba_list_gold = $_POST['alba_list_gold'];		// 알바 리스트형 골드
		$alba_list_gold_date = $_POST['alba_list_gold_date'];		// 알바 리스트형 골드 기간
		if($alba_list_gold_date){
			$vals['pay_alba_list_gold'] = $alba_list_gold_date;
			array_push($pay_service,'alba_list_gold');
		}


		$main_basic_date = $_POST['main_basic_date'];	// 메인 일반 리스트
		if($main_basic_date){
			$vals['pay_main_basic'] = $main_basic_date;
			array_push($pay_service,'main_basic');
		}

		
		$alba_basic_date = $_POST['alba_basic_date'];	// 공고 일반 리스트
		if($alba_basic_date){
			$vals['pay_alba_basic'] = $alba_basic_date;
			array_push($pay_service,'alba_basic');
		}



		## 옵션 서비스
		$alba_option_busy_date = $_POST['alba_option_busy_date'];	// 급구 아이콘
		if($alba_option_busy_date){
			$vals['pay_alba_option_busy'] = $alba_option_busy_date;
			array_push($pay_service,'alba_option_busy');
		}
		

		$alba_option_neon = $_POST['alba_option_neon'];	// 형광펜
		$alba_option_neon_sel = $_POST['alba_option_neon_sel'];	// 형광펜 선택 값
		$alba_option_neon_date = $_POST['alba_option_neon_date'];	// 형광펜 기간
		if($alba_option_neon_date){
			$vals['pay_alba_option_neon'] = $alba_option_neon_date;
			$vals['pay_alba_option_neon_color'] = $alba_option_neon_sel;
			array_push($pay_service,'alba_option_neon');
		}

		$alba_option_bold = $_POST['alba_option_bold'];	// 굵은글자
		$alba_option_bold_date = $_POST['alba_option_bold_date'];	// 굵은글자 기간
		if($alba_option_bold_date){
			$vals['pay_alba_option_bold'] = $alba_option_bold_date;
			array_push($pay_service,'alba_option_bold');
		}

		$alba_option_icon = $_POST['alba_option_icon'];	// 아이콘
		$alba_option_icon_sel = $_POST['alba_option_icon_sel'];	// 아이콘 선택 값 (category 에서 추출)
		$alba_option_icon_date = $_POST['alba_option_icon_date'];	// 아이콘 기간
		if($alba_option_icon_date){
			$vals['pay_alba_option_icon'] = $alba_option_icon_date;
			$vals['pay_alba_option_icon_sel'] = $alba_option_icon_sel;
			array_push($pay_service,'alba_option_icon');
		}

		$alba_option_color = $_POST['alba_option_color'];	// 글자색
		$alba_option_color_sel = $_POST['alba_option_color_sel'];	// 글자색 선택 값
		$alba_option_color_date = $_POST['alba_option_color_date'];	// 글자색 기간
		if($alba_option_color_date){
			$vals['pay_alba_option_color'] = $alba_option_color_date;
			$vals['pay_alba_option_color_sel'] = $alba_option_color_sel;
			array_push($pay_service,'alba_option_color');
		}

		$alba_option_blink = $_POST['alba_option_blink'];	// 반짝글자
		$alba_option_blink_date = $_POST['alba_option_blink_date'];	// 반짝글자 기간
		if($alba_option_blink_date){
			$vals['pay_alba_option_blink'] = $alba_option_blink_date;
			array_push($pay_service,'alba_option_blink');
		}

		$alba_option_jump_price = $_POST['alba_option_jump_price'];	// 점프 기간/금액
		if($alba_option_jump_price){
			$vals['pay_alba_option_jump'] = $alba_option_jump_price;
			array_push($pay_service,'alba_option_jump');
		}

		$alba_option_jump_date = $_POST['alba_option_jump_date'];	// 점프 기간/금액
		if($alba_option_jump_date){
			$vals['pay_alba_option_jump'] = $alba_option_jump_date;
			array_push($pay_service,'alba_option_jump');
		}

		/*
		$main_platinum_date = $_POST['main_platinum_date'];	// 메인 플래티넘 
		if($main_platinum_date){
			$vals['pay_main_platinum'] = $main_platinum_date;
			array_push($pay_service,'main_platinum');
		}
		*/

		$etc_open_date = ($_POST['etc_open_date']) ? $_POST['etc_open_date'] : $_POST['etc_open_price'];	// 이력서 열람 기간/금액
		if($etc_open_date){
			$vals['pay_etc_open'] = $etc_open_date;
			array_push($pay_service,'etc_open');
		}

		$etc_sms_date = ($_POST['etc_sms_date']) ? $_POST['etc_sms_date'] : $_POST['etc_sms_price'];		// SMS 충전 건/금액
		if($etc_sms_date){
			$vals['pay_etc_sms'] = $etc_sms_date;
			array_push($pay_service,'etc_sms');
		}


		// 옵션 서비스 선택 금액
		$alba_option_neon_price	 = $_POST['alba_option_neon_price'];
		$alba_option_bold_price	 = $_POST['alba_option_bold_price'];
		$alba_option_color_price	 = $_POST['alba_option_color_price'];
		$alba_option_blink_price	 = $_POST['alba_option_blink_price'];


		if($pay_service=='option_extend'){	 // 옵션 연장 결제일때
			$pay_service_val = array();
			if($alba_option_neon)
				array_push($pay_service_val,'alba_option_neon');
			if($alba_option_bold)
				array_push($pay_service_val,'alba_option_bold');
			if($alba_option_icon)
				array_push($pay_service_val,'alba_option_icon');
			if($alba_option_color)
				array_push($pay_service_val,'alba_option_color');
			if($alba_option_blink)
				array_push($pay_service_val,'alba_option_blink');
			$vals['pay_service'] = implode($pay_service_val,'/');
		} else {
			$vals['pay_service'] = $pay_service;
		}

		$pay_price = $_POST['pay_price'];					// 본 금액
		$vals['pay_total'] = $pay_price;

		$pay_use_point = $_POST['pay_use_point'];	// 사용 포인트
		
		$use_point = $_POST['use_point'];					// 실제 사용 포인트
		$vals['pay_dc'] = $use_point;

		$total_price = $_POST['total_price'];				// 할인이 적용된 최종 결제 금액
		$vals['pay_price'] = $total_price;

		
		$vals['pay_wdate'] = $now_date;	// 결제신청일

		$vals['pay_service'] = implode($pay_service,"/");

		$result = $payment_control->insert_payment($vals);


		if($package_no){
			
			$package = $package_control->get_package($package_no);
			$package_content = unserialize($package['wr_content']);
			
			$package_vals['pay_no'] = $vals['pay_no'];
			$package_vals['pay_oid'] = $vals['pay_oid'];
			$package_vals['pay_type'] = $vals['pay_type'];
			$package_vals['pay_pg'] = $vals['pay_pg'];
			$package_vals['pay_method'] = $vals['pay_method'];
			$package_vals['pay_uid'] = $vals['pay_uid'];
			$package_vals['pay_name'] = $vals['pay_name'];
			$package_vals['pay_phone'] = $vals['pay_phone'];
			$package_vals['pay_email'] = $vals['pay_email'];

			$package_vals['pay_package'] = $package_no;

			$package_vals['pay_total'] = $package['wr_price'];
			$package_vals['pay_dc'] = 0;
			$package_vals['pay_price'] = $package['wr_price'];

			$package_vals['pay_wdate'] = $vals['pay_wdate'];
			$package_vals['pay_sdate'] = $vals['pay_sdate'];
			$package_vals['pay_cdate'] = $vals['pay_cdate'];
			$package_vals['pay_ccdate'] = $vals['pay_cddate'];

			if($package_content){
				foreach($package_content as $key => $val){
					if($val['use']){	// 사용 서비스
						$package_vals['pay_'.$key] = $val['service_count']."/".$val['service_unit']."/".$package['wr_price']."/0/".$package['wr_price'];
						if(!in_array($key,$pay_service)){
							array_push($pay_service,$key);
						}
					}
				}
			}

			$package_vals['pay_service'] = implode($pay_service,"/");

			$payment_control->insert_payment($package_vals);
		}


		if(!$result){
			echo "0006";
			exit;
		} else {

			$get_payment = $payment_control->get_payment_for_oid($oid);

			// 무료일때
			if($get_payment['pay_price']==0){
				$payment_control->success_payment( $oid );
				//$utility->popup_msg_js("",$alice['company_path']."/success.php?oid=".$vals['pay_oid']);
			}

			/*
			} else {
				// pay_no / pay_oid / pay_price / pay_method
				echo $no . "/" . $vals['pay_oid'] . "/" . $vals['pay_price'] . "/" . $vals['pay_method'];
			}
			*/
			echo $no . "/" . $vals['pay_oid'] . "/" . $vals['pay_price'] . "/" . $vals['pay_method'];
		}

?>