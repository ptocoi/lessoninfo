<?php
		/*
		* /application/company/process/alba_resume_pay.php
		* @author Harimao
		* @since 2013/10/01
		* @last update 2015/04/14
		* @Module v3.5 ( Alice )
		* @Brief :: Alba Resume Pay process
		* @Comment :: 정규직 이력서 결제 처리프로세스
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?type=individual&url=".$urlencode);
			exit;
		}
		if($mb_type=='company'){	 // 기업회원 접근시
			$utility->popup_msg_js($user_control->_errors('0030'));
			exit;
		}

		$get_pg = $payment_control->get_use_pg(1);

		$no = $_POST['no'];	// 정규직 이력서 no

		$package_no = $_POST['package_no'];	// 패키지 상품 정보

		$pay_services = explode('/',$_POST['pay_service']);

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

		$pay_service = array();

		$main_focus_date = $_POST['main_focus_date'];	// 메인 포커스
		if($main_focus_date){
			$vals['pay_main_focus'] = $main_focus_date;
			array_push($pay_service,"main_focus");
		}

		$main_focus_gold = $_POST['main_focus_gold'];	// 메인 포커스 골드
		$main_focus_gold_date = $_POST['main_focus_gold_date'];	// 메인 포커스 골드 기간
		if($main_focus_gold_date){
			$vals['pay_main_focus_gold'] = $main_focus_gold_date;
			array_push($pay_service,"main_focus_gold");
		}

		$main_rbasic_date = $_POST['main_rbasic_date'];	// 메인 일반리스트
		if($main_rbasic_date){
			$vals['pay_main_resume_basic'] = $main_rbasic_date;
			array_push($pay_service,"main_resume_basic");
		}

		$resume_focus_date = $_POST['alba_resume_focus_date'];	// 서브 포커스
		if($resume_focus_date){
			$vals['pay_alba_resume_focus'] = $resume_focus_date;
			array_push($pay_service,"alba_resume_focus");
		}

		$resume_focus_gold = $_POST['alba_resume_focus_gold'];	// 서브 포커스 골드
		$resume_focus_gold_date = $_POST['alba_resume_focus_gold_date'];	// 서브 포커스 골드 기간
		if($resume_focus_gold_date){
			$vals['pay_alba_resume_focus_gold'] = $resume_focus_gold_date;
			array_push($pay_service,"alba_resume_focus_gold");
		}

		$alba_resume_basic_date = $_POST['alba_resume_basic_date'];	// 인재정보 일반리스트
		if($alba_resume_basic_date){
			$vals['pay_resume_basic'] = $alba_resume_basic_date;
			array_push($pay_service,"alba_resume_basic");
		}

		$resume_option_busy_date = $_POST['resume_option_busy_date'];	// 급구 아이콘
		if($resume_option_busy_date){
			$vals['pay_resume_option_busy'] = $resume_option_busy_date;
			array_push($pay_service,"resume_option_busy");
		}
		

		$resume_option_neon = $_POST['resume_option_neon'];	// 형광펜
		$resume_option_neon_sel = $_POST['resume_option_neon_sel'];	// 형광펜 선택 값
		$resume_option_neon_date = $_POST['resume_option_neon_date'];	// 형광펜 기간
		if($resume_option_neon_date){
			$vals['pay_resume_option_neon'] = $resume_option_neon_date;
			$vals['pay_resume_option_neon_color'] = $resume_option_neon_sel;
			array_push($pay_service,"resume_option_neon");
		}

		$resume_option_bold = $_POST['resume_option_bold'];	// 굵은글자
		$resume_option_bold_date = $_POST['resume_option_bold_date'];	// 굵은글자 기간
		if($resume_option_bold_date){
			$vals['pay_resume_option_bold'] = $resume_option_bold_date;
			array_push($pay_service,"resume_option_bold");
		}

		$resume_option_icon = $_POST['resume_option_icon'];	// 아이콘
		$resume_option_icon_sel = $_POST['resume_option_icon_sel'];	// 아이콘 선택 값 (category 에서 추출)
		$resume_option_icon_date = $_POST['resume_option_icon_date'];	// 아이콘 기간
		if($resume_option_icon_date){
			$vals['pay_resume_option_icon'] = $resume_option_icon_date;
			$vals['pay_resume_option_icon_sel'] = $resume_option_icon_sel;
			array_push($pay_service,"resume_option_icon");
		}

		$resume_option_color = $_POST['resume_option_color'];	// 글자색
		$resume_option_color_sel = $_POST['resume_option_color_sel'];	// 글자색 선택 값
		$resume_option_color_date = $_POST['resume_option_color_date'];	// 글자색 기간
		if($resume_option_color_date){
			$vals['pay_resume_option_color'] = $resume_option_color_date;
			$vals['pay_resume_option_color_sel'] = $resume_option_color_sel;
			array_push($pay_service,"resume_option_color");
		}


		$resume_option_blink = $_POST['resume_option_blink'];	// 반짝글자
		$resume_option_blink_date = $_POST['resume_option_blink_date'];	// 반짝글자 기간
		if($resume_option_blink_date){
			$vals['pay_resume_option_blink'] = $resume_option_blink_date;
			array_push($pay_service,"resume_option_blink");
		}


		$resume_option_jump_price = $_POST['resume_option_jump_price'];	// 점프 기간/금액
		if($resume_option_jump_price){
			$vals['pay_resume_option_jump'] = $resume_option_jump_price;
			array_push($pay_service,"resume_option_jump");
		}

		$etc_alba_price = $_POST['etc_alba_price'];	// 열람 기간/금액
		if($etc_alba_price){
			$vals['pay_etc_alba'] = $etc_alba_price;
			array_push($pay_service,"etc_alba");
		}

		$etc_sms_price = $_POST['etc_sms_price'];	// SMS 충전 건/금액
		if($etc_sms_price){
			$vals['pay_etc_sms'] = $etc_sms_price;
			array_push($pay_service,"etc_sms");
		}

		if( count($pay_services) > 1 ){ // 복합 서비스

			$vals['pay_service'] = implode($pay_service,"/");

		} else {	 // 단일 서비스

			$vals['pay_service'] = $_POST['pay_service'];

		}


		$pay_price = $_POST['pay_price'];					// 본 금액
		$vals['pay_total'] = $pay_price;

		$pay_use_point = $_POST['pay_use_point'];	// 사용 포인트
		
		$use_point = $_POST['use_point'];					// 실제 사용 포인트
		$vals['pay_dc'] = $use_point;

		$total_price = $_POST['total_price'];				// 할인이 적용된 최종 결제 금액
		$vals['pay_price'] = $total_price;
		
		$vals['pay_wdate'] = $now_date;	// 결제신청일

		/*
		echo "<pre>";
		print_R($_POST);
		print_R($vals);
		exit;
		*/

		$result = $payment_control->insert_payment($vals);

		if($package_no){
			$package = $package_control->get_package($package_no);
			$package_content = unserialize($package['wr_content']);
			
			$package_vals['pay_no'] = $vals['pay_no'];
			$package_vals['pay_oid'] = $vals['pay_oid'];
			$package_vals['pay_type'] = $vals['pay_type'];
			$package_vals['pay_pg'] = $vals['pay_pg'];
			$package_vals['pay_method'] = $vals['pay_method'];
			$package_vals['pay_service'] = $vals['pay_service'];
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
						/*
						$package_date = $val['service_count']."/".$val['service_unit']."/".$package['wr_price']."/0/".$package['wr_price'];
						if($main_focus_date && $key=='main_focus') 
							$main_focus_service = $package_control->package_service($main_focus_date,$package_date);
						*/
						$package_vals['pay_'.$key] = $val['service_count']."/".$val['service_unit']."/".$package['wr_price']."/0/".$package['wr_price'];
						if(!in_array($key,$pay_service)){
							array_push($pay_service,$key);
						}
					}
				}
			}

			/*
			$resume_option_busy_date = $_POST['resume_option_busy_date'];	// 급구 아이콘
			if($resume_option_busy_date){
				$package_vals['pay_resume_option_busy'] = $resume_option_busy_date;
				if(!in_array("resume_option_busy",$pay_service)){
					array_push($pay_service,"resume_option_busy");
				}
			}

			$resume_option_neon = $_POST['resume_option_neon'];	// 형광펜
			$resume_option_neon_sel = $_POST['resume_option_neon_sel'];	// 형광펜 선택 값
			$resume_option_neon_date = $_POST['resume_option_neon_date'];	// 형광펜 기간
			if($resume_option_neon_date){
				$package_vals['pay_resume_option_neon'] = $resume_option_neon_date;
				$package_vals['pay_resume_option_neon_color'] = $resume_option_neon_sel;
				if(!in_array("resume_option_neon",$pay_service)){
					array_push($pay_service,"resume_option_neon");
				}
			}

			$resume_option_bold = $_POST['resume_option_bold'];	// 굵은글자
			$resume_option_bold_date = $_POST['resume_option_bold_date'];	// 굵은글자 기간
			if($resume_option_bold_date){
				$package_vals['pay_resume_option_bold'] = $resume_option_bold_date;
				if(!in_array("resume_option_bold",$pay_service)){
					array_push($pay_service,"resume_option_bold");
				}
			}

			$resume_option_icon = $_POST['resume_option_icon'];	// 아이콘
			$resume_option_icon_sel = $_POST['resume_option_icon_sel'];	// 아이콘 선택 값 (category 에서 추출)
			$resume_option_icon_date = $_POST['resume_option_icon_date'];	// 아이콘 기간
			if($resume_option_icon_date){
				$package_vals['pay_resume_option_icon'] = $resume_option_icon_date;
				$package_vals['pay_resume_option_icon_sel'] = $resume_option_icon_sel;
				if(!in_array("resume_option_icon",$pay_service)){
					array_push($pay_service,"resume_option_icon");
				}
			}

			$resume_option_color = $_POST['resume_option_color'];	// 글자색
			$resume_option_color_sel = $_POST['resume_option_color_sel'];	// 글자색 선택 값
			$resume_option_color_date = $_POST['resume_option_color_date'];	// 글자색 기간
			if($resume_option_color_date){
				$package_vals['pay_resume_option_color'] = $resume_option_color_date;
				$package_vals['pay_resume_option_color_sel'] = $resume_option_color_sel;
				if(!in_array("resume_option_color",$pay_service)){
					array_push($pay_service,"resume_option_color");
				}
			}

			$resume_option_blink = $_POST['resume_option_blink'];	// 반짝글자
			$resume_option_blink_date = $_POST['resume_option_blink_date'];	// 반짝글자 기간
			if($resume_option_blink_date){
				$package_vals['pay_resume_option_blink'] = $resume_option_blink_date;
				if(!in_array("resume_option_blink",$pay_service)){
					array_push($pay_service,"resume_option_blink");
				}
			}
			*/


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
				//$utility->popup_msg_js("",$alice['company_path']."/success.php?oid=".$oid);
			}
			// pay_no / pay_oid / pay_price / pay_method
			echo $no . "/" . $vals['pay_oid'] . "/" . $vals['pay_price'] . "/" . $vals['pay_method'];
		}

?>