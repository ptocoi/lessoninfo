<?php
		/**
		* /application/nad/payment/controller/alice_payment_control.class.php
		* @author Harimao
		* @since 2013/07/23
		* @last update 2015/06/04
		* @Module v3.5 ( Alice )
		* @Brief :: Payment Control class
		* @Comment :: 결제모듈 컨트롤 클래스
		*/
		class alice_payment_control extends alice_payment_model {


				/**
				* 결제 페이지 사용 정보 수정
				*/
				function update_payment_page( $vals, $no ){

					global $utility;

						$val = $utility->QueryString($vals);

						$query = " update `".$this->pg_page_table."` set " . $val . " where `no` = '".$no."' ";

						$result = $this->_query($query);


					return $result;

				}


				/**
				* 결제 모듈 사용 정보 수정
				* pg_company 기준
				*/
				function update_pg_page( $vals, $pg_company ){

					global $utility;

						$get_pgInfoCompany = $this->get_pgInfoCompany($pg_company);
						
						$val = $utility->QueryString($vals);

						$this->_query(" update `".$this->pg_config_table."` set `pg_result` = 0 ");	// 전체 pg_result 끄기

						if($get_pgInfoCompany){	// 기존 데이터가 있다면 update

							$query = " update `".$this->pg_config_table."` set " . $val . " where `pg_company` = '".$pg_company."' ";

						} else {	 // 없다면 insert
							
							$query = " insert into `".$this->pg_config_table."` set " . $val;

						}

						$result = $this->_query($query);


					return $result;

				}
				

				/**
				* 결제 정보 데이터 입력
				*/
				function insert_payment( $vals ){

					global $utility;

						$val = $utility->QueryString($vals);

						$query = " insert into `".$this->payment_table."` set " . $val;

						$result = $this->_query($query);


					return $result;

				}


				/**
				* 결제 정보 데이터 수정 :: no 기준
				*/
				function update_payment( $vals, $no ){

					global $utility;

						$val = $utility->QueryString($vals);

						$query = " update `".$this->payment_table."` set " . $val . " where `no` = '".$no."' ";

						$result = $this->_query($query);


					return $result;

				}


				/**
				* 결제 정보 데이터 수정 :: oid 기준
				*/
				function update_payment_for_oid( $vals, $oid, $con="" ){

					global $utility;

						$val = $utility->QueryString($vals);

						$query = " update `".$this->payment_table."` set " . $val . " where `pay_oid` = '".$oid."' " . $con;

						$result = $this->_query($query);


					return $result;

				}


				/**
				* 결제 정보 데이터 삭제 (실제 데이터는 삭제 안됨 => is_delete)
				*/
				function delete_payment( $no ){

					global $utility;

						$val = $utility->QueryString($vals);

						$query = " update `".$this->payment_table."` set `is_delete` = '1' where `no` = '".$no."' ";

						$result = $this->_query($query);


					return $result;

				}


				/**
				* 결제 완료시
				* 서비스 기간 업데이트 / 결제 완료 처리
				* 주문번호 기준
				*/
				function success_payment( $oid ){

					global $alice, $utility, $env;
					global $member_control, $alba_control, $alba_resume_control, $point_control;

						$get_package = $this->get_payment_for_oid($oid," and `pay_package` != '0' ");

						if($get_package['pay_package']){
							$get_payment = $this->get_payment($get_package['no']);	 // 결제정보
						} else {
							$get_payment = $this->get_payment_for_oid($oid);	 // 결제정보
						}

						$get_member = $member_control->get_member($get_payment['pay_uid']);	// 회원 정보

						$pay_no = $get_payment['pay_no'];	// 서비스 데이터 번호


						if($get_payment['pay_type']=='alba'){	 // 알바 추출

							$get_service_alba = $this->get_service_alba_date($get_payment);	// 알바 서비스 기간 정보

							$get_alba = $alba_control->get_alba($pay_no);

							$pay_service = explode("/",$get_payment['pay_service']);


							if( in_array('etc_open',$pay_service) || in_array('etc_sms',$pay_service) ){
								$pay_service_cnt = count($pay_service);
								for($i=0;$i<$pay_service_cnt;$i++){
									if( $pay_service[$i] == 'etc_open' || $pay_service[$i] == 'etc_sms') unset($pay_service[$i]);
								}
							}

							if( $get_payment['pay_service'] != 'etc_open' && $get_payment['pay_service'] != 'etc_sms' ){
								// 서비스 기간 업데이트
								$alba_update_query = " update `alice_alba` set " . $get_service_alba . ", `wr_oid` = '".$oid."', `wr_udate` = now() where `no` = '".$pay_no."' ";
								$this->_query($alba_update_query);
							}

							// 사용한 포인트가 있다면 차감
							$use_point = $get_payment['pay_dc'];
							if($use_point){

								//$point = $get_member['mb_point'] - $use_point;
								$content = $alice['time_ymd'] . " 채용공고 [".stripslashes($get_alba['wr_subject'])."] 등록시 사용";
								$point_control->point_insert($get_member['mb_id'], "-".$use_point, $content, "alba", $pay_no, $alice['time_ymdhis']." 등록");

							} else {	 // 사용한 포인트가 없는 경우 관리자에서 설정한 유료결제 포인트를 지급한다.

								if($env['alba_point_percent']){	// 지급 % 가 설정되어 있다면
									$pay_price = $get_payment['pay_price'];	 // 결제 금액
									$pay_point = ($pay_price / 100 ) * $env['alba_point_percent'];
									$content = $alice['time_ymd'] . " 채용공고 [".stripslashes($get_alba['wr_subject'])."] 등록시 적립";
									$point_control->point_insert($get_member['mb_id'], $pay_point, $content, "alba", $pay_no, $alice['time_ymdhis']." 등록");
								}

							}

						} else if($get_payment['pay_type']=='alba_resume'){	// 알바 이력서 추출

							$get_service_resume = $this->get_service_alba_resume_date($get_payment);	// 알바 이력서 서비스 기간 정보

							$get_alba_resume = $alba_resume_control->get_resume($pay_no);

							if( @in_array('etc_alba',$pay_service) || @in_array('etc_sms',$pay_service) ){
								$pay_service_cnt = count($pay_service);
								for($i=0;$i<$pay_service_cnt;$i++){
									if( $pay_service[$i] == 'etc_alba' || $pay_service[$i] == 'etc_sms') unset($pay_service[$i]);
								}
							}

							// 서비스 기간 업데이트
							$alba_resume_update_query = " update `alice_alba_resume` set " . $get_service_resume . ", `wr_oid` = '".$oid."', `wr_udate` = now() where `no` = '".$pay_no."' ";
							$this->_query($alba_resume_update_query);

							$get_alba_resume = $alba_resume_control->get_resume($pay_no);


							// 사용한 포인트가 있다면 차감
							$use_point = $get_payment['pay_dc'];
							if($use_point){

								$content = $alice['time_ymd'] . " 이력서 [".stripslashes($get_alba_resume['wr_subject'])."] 등록시 사용";
								$point_control->point_insert($get_member['mb_id'], "-".$use_point, $content, "alba_resume", $pay_no, $alice['time_ymdhis']." 등록");

							} else {	 // 사용한 포인트가 없는 경우 관리자에서 설정한 유료결제 포인트를 지급한다.

								if($env['alba_resume_point_percent']){	// 지급 % 가 설정되어 있다면
									$pay_price = $get_payment['pay_price'];	 // 결제 금액
									$pay_point = ($pay_price / 100 ) * $env['alba_resume_point_percent'];
									$content = $alice['time_ymd'] . " 이력서 [".stripslashes($get_alba_resume['wr_subject'])."] 등록시 적립";
									$point_control->point_insert($get_member['mb_id'], $pay_point, $content, "alba_resume", $pay_no, $alice['time_ymdhis']." 등록");
								}

							}

						} else if($get_payment['pay_type']=='resume_open' || $get_payment['pay_type']=='etc_open' || $get_payment['pay_service']=='etc_open'){	// 이력서 열람권 결제

							/*
							30/count/30000/15/25500/5/day
							0 => 30
							1 => count
							2 => 30000
							3 => 15
							4 => 25500

							5 => 5
							6 => day
							*/
							$pay_etc_open = explode("/",$get_payment['pay_etc_open']);
							
							if($pay_etc_open[1]=='count'){	// 건별 결제
								if($pay_etc_open[5] && $pay_etc_open[6]){
									$pay_etc_open_day = $pay_etc_open[5] . " " . $pay_etc_open[6];
								} else {
									$pay_etc_open_day = "12 month";	// 무제한일때 유예 기간 1년
								}
								$member_service = $member_control->get_service_member($get_payment['pay_uid']);	 // 서비스 정보
								$pay_etc_open_count = $member_service['mb_service_open_count'] + $pay_etc_open[0];
								$this->_query(" update `alice_member_service` set `mb_service_open` = date_add( curdate(), interval ".$pay_etc_open_day."), `mb_service_open_count` = '".$pay_etc_open_count."' where `mb_id` = '".$get_payment['pay_uid']."' ");	 // 열람 서비스 기간 부여
							} else {	 // 기간 결제
								$pay_etc_open_day = $pay_etc_open[0] . " " . $pay_etc_open[1];
								$this->_query(" update `alice_member_service` set `mb_service_open` = date_add( curdate(), interval ".$pay_etc_open_day."), `mb_service_open_count` = '0' where `mb_id` = '".$get_payment['pay_uid']."' ");	 // 열람 서비스 기간 부여
							}

						} else if($get_payment['pay_type']=='etc_alba'){	// 채용공고 열람권 결제

							$pay_etc_alba = explode("/",$get_payment['pay_etc_alba']);

							if($pay_etc_alba[1]=='count'){	// 건별 결제
								if($pay_etc_alba[5] && $pay_etc_alba[6]){
									$pay_etc_alba_day = $pay_etc_alba[5] . " " . $pay_etc_alba[6];
								} else {
									$pay_etc_alba_day = "12 month";	// 무제한일때 유예 기간 1년
								}
								$member_service = $member_control->get_service_member($get_payment['pay_uid']);	 // 서비스 정보
								$pay_etc_alba_count = $member_service['mb_service_alba_count'] + $pay_etc_alba[0];
								$this->_query(" update `alice_member_service` set `mb_service_alba_open` = date_add( curdate(), interval ".$pay_etc_alba_day."), `mb_service_alba_count` = '".$pay_etc_alba_count."' where `mb_id` = '".$get_payment['pay_uid']."' ");	 // 열람 서비스 기간 부여
							} else {	 // 기간 결제
								$pay_etc_alba_day = $pay_etc_alba[0] . " " . $pay_etc_alba[1];
								$this->_query(" update `alice_member_service` set `mb_service_alba_open` = date_add( curdate(), interval ".$pay_etc_alba_day."), `mb_service_alba_count` = '0' where `mb_id` = '".$get_payment['pay_uid']."' ");	 // 열람 서비스 기간 부여
							}

						} else if($get_payment['pay_type']=='etc_sms'){	// SMS 건수 충전

							$pay_etc_sms = explode("/",$get_payment['pay_etc_sms']);

							$member_service = $member_control->get_service_member($get_payment['pay_uid']);	 // 서비스 정보
							$pay_etc_sms_count = $member_service['mb_service_sms_count'] + $pay_etc_sms[0];

							$mb_vals['mb_sms'] = $pay_etc_sms_count;
							$mb_vals['mb_udate'] = $alice['time_ymdhis'];
							$member_control->update_member($mb_vals,$get_payment['pay_uid']);	// 회원 테이블 mb_sms 카운트 조절

							$mb_service_vals['mb_service_sms_count'] = $pay_etc_sms_count;
							$member_control->service_upate($mb_service_vals,$get_payment['pay_uid']);	// 회원 서비스 테이블 sms 카운트 조절

						}

						// 결제 정보 업데이트
						$pay_update_query = " update `".$this->payment_table."` set `pay_status` = 1, `pay_sdate` = now() where `pay_oid` = '".$oid."' ";	// oid 를 기준으로 수정
						$result = $this->_query($pay_update_query);


					return $result;

				}


				// 결제 정보 리스팅시 데이터 정렬
				function payment_listing( $no ){

					global $alice, $utility;
					global $service_control;

						$result = array();

						$get_payment = $this->get_payment($no);	// 결제 정보

						$pay_service = explode('/',$get_payment['pay_service']);
						$pay_service_cnt = count($pay_service);

						for($i=0;$i<$pay_service_cnt;$i++){
							
//  || $pay_service[$i]=='main_focus' || $pay_service[$i]=='main_rbasic' || $pay_service[$i]=='alba_resume_focus' || $pay_service[$i]=='alba_resume_basic'

							if($pay_service[$i]=='etc_alba'){
								$field_name = "pay_etc_alba";
							} else if($pay_service[$i]=='direct'){
								$field_name = "*";
							} else if($pay_service[$i]=='main_rbasic'){
								$field_name = "pay_main_resume_basic";
							} else if($pay_service[$i]=='alba_resume_basic'){
								$field_name = "pay_resume_basic";
							} else if($pay_service[$i]=='pay_alba_resume_basic'){
								$field_name = "pay_resume_basic";
							} else {
								if($pay_service[$i]){
									$field_name = "pay_" . $pay_service[$i];
								} else {
									$field_name = "*";
								}
							}

							$service_field = explode('_',$pay_service[$i]);	 // 결제 서비스 항목별 필드
							$service_info = $this->get_service_field($no,$field_name);

							$service_day = explode('/',$service_info);	// 결제 서비스 기간 / 금액

/*
Array
(
    [0] => etc
    [1] => alba
)
5/count/10000/10/9000/7/day
Array
(
    [0] => 5
    [1] => count
    [2] => 10000
    [3] => 10
    [4] => 9000
    [5] => 7
    [6] => day
)
*/

							//echo $service_field[0]." ".$service_field[1]." ".$service_field[2]." <==<Br/>";

							if($service_day[0]) {

								if($service_field[3]){	// 골드 서비스
									
									$service_name = $service_control->service_name[ $service_field[0] . "_" . $service_field[1] ]['name'];
									$service_name .= " " . $service_control->service_name[ $service_field[0] . "_" . $service_field[1] ]['service'][ $service_field[2] . "_" . $service_field[3] ];

								} else if($service_field[2]){	// 결제 서비스명

									$service_name = $service_control->service_name[ $service_field[0] . "_" . $service_field[1] ]['name'];
									$service_name .= " " . $service_control->service_name[ $service_field[0] . "_" . $service_field[1] ]['service'][ $service_field[2] ];

								} else {

									$service_name  = $service_control->service_name[ $service_field[0] ]['name'];
									$service_name .= " " . $service_control->service_name[ $service_field[0] ]['service'][ $service_field[1] ];

								}

								$open_day = ($service_day[5]) ? ", ".$service_day[5].$service_control->_unit($service_day[6])." 이후 자동 소멸" : "";

								$service_day_name = number_format($service_day[0]) . $service_control->_unit($service_day[1]) . $open_day . " (".number_format($service_day[4])."원)";

							} else {

								continue;

							}

							$result[$i] = $service_name . " : " . $service_day_name;

						}

					
					return $result;

				}


				// 결제 정보 리스팅시 데이터 쪼개기
				function payment_list( $no ){

					global $alice, $utility;
					global $service_control, $alba_control, $alba_resume_control;

						$result = array();

						$payment = $this->get_payment($no);	// 결제 정보

						$get_package = $this->get_payment_for_oid($payment['pay_oid']," and `pay_package` != '0' ");

						if($get_package['pay_package']){
							$get_payment = $this->get_payment($get_package['no']);	 // 결제정보
						} else {
							$get_payment = $this->get_payment_for_oid($payment['pay_oid']);	 // 결제정보
						}

						/*
						echo "<pre>";
						//print_R($payment);
						print_R($get_payment);
						echo "</pre>";
						*/


						if($get_payment['pay_type']=='alba'){
							$get_alba = $alba_control->get_alba($get_payment['pay_no']);		// 채용정보
						} else if($get_payment['pay_type']=='alba_resume'){
							$get_resume = $alba_resume_control->get_resume($get_payment['pay_no']);	// 이력서 정보
						}


						$pay_service = explode('/',$get_payment['pay_service']);
						$pay_service_cnt = count($pay_service);

						for($i=0;$i<$pay_service_cnt;$i++){

							if($pay_service[$i]=='alba_resume_basic'){
								$field_name = "pay_resume_basic";
							} else {
								if($pay_service[$i]){
									$field_name = "pay_" . $pay_service[$i];
								} else {
									$field_name = "*";
								}
							}

							$service_field = explode('_',$pay_service[$i]);	 // 결제 서비스 항목별 필드
							/*
							if($get_payment['pay_type']=='alba'){
								$service_info = $this->get_service_field($payment['no'],$field_name);
							} else if($get_payment['pay_type']=='alba_resume'){
								$service_info = $this->get_service_field($payment['no'],$field_name);
							}
							*/
							$service_info = $this->get_service_field($payment['no'],$field_name);

							$service_day = explode('/',$service_info);	// 결제 서비스 기간 / 금액

							if($service_day[0]) {

								if(count($service_field) > 2 ){	// 결제 서비스명
									
									$service_name = $service_control->service_name[ $service_field[0] . "_" . $service_field[1] ]['name'];
									if($service_field[3]){
										$service_name .= " " . $service_control->service_name[ $service_field[0] . "_" . $service_field[1] ]['service'][ $service_field[2] . "_" . $service_field[3] ];
										$service_code = $service_field[0] . "_" . $service_field[1]. "_" . $service_field[2]. "_" . $service_field[3];
									} else {
										$service_name .= " " . $service_control->service_name[ $service_field[0] . "_" . $service_field[1] ]['service'][ $service_field[2] ];
										$service_code = $service_field[0] . "_" . $service_field[1]. "_" . $service_field[2];
									}

								} else {

									$service_name  = $service_control->service_name[ $service_field[0] ]['name'];
									$service_name .= " " . $service_control->service_name[ $service_field[0] ]['service'][ $service_field[1] ];
									$service_code = $service_field[0] . "_" . $service_field[1];
								}

								## 채용공고 서비스 기간 / 건수
								if($get_payment['pay_type']=='alba'){

									if( $get_alba['wr_service_platinum'] != '0000-00-00' ){
										$result[$i]['service_day']['main_platinum'] = $get_alba['wr_service_platinum'];
									}
									if( $get_alba['wr_service_platinum_main_gold'] != '0000-00-00' ){
										$result[$i]['service_day']['main_platinum_gold'] = $get_alba['wr_service_platinum_main_gold'];
									}
									if( $get_alba['wr_service_platinum_main_logo'] != '0000-00-00' ){
										$result[$i]['service_day']['main_platinum_logo'] = $get_alba['wr_service_platinum_main_logo'];
									}

									if( $get_alba['wr_service_platinum_sub'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_platinum'] = $get_alba['wr_service_platinum_sub'];
									}
									if( $get_alba['wr_service_platinum_sub_gold'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_platinum_gold'] = $get_alba['wr_service_platinum_sub_gold'];
									}
									if( $get_alba['wr_service_platinum_sub_logo'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_platinum_logo'] = $get_alba['wr_service_platinum_sub_logo'];
									}

									if( $get_alba['wr_service_prime'] != '0000-00-00' ){
										$result[$i]['service_day']['main_prime'] = $get_alba['wr_service_prime'];
									}
									if( $get_alba['wr_service_prime_main_gold'] != '0000-00-00' ){
										$result[$i]['service_day']['main_prime_gold'] = $get_alba['wr_service_prime_main_gold'];
									}
									if( $get_alba['wr_service_prime_main_logo'] != '0000-00-00' ){
										$result[$i]['service_day']['main_prime_logo'] = $get_alba['wr_service_prime_main_logo'];
									}

									if( $get_alba['wr_service_grand'] != '0000-00-00' ){
										$result[$i]['service_day']['main_grand'] = $get_alba['wr_service_grand'];
									}
									if( $get_alba['wr_service_grand_main_gold'] != '0000-00-00' ){
										$result[$i]['service_day']['main_grand_gold'] = $get_alba['wr_service_grand_main_gold'];
									}
									if( $get_alba['wr_service_grand_main_logo'] != '0000-00-00' ){
										$result[$i]['service_day']['main_grand_logo'] = $get_alba['wr_service_grand_main_logo'];
									}

									if( $get_alba['wr_service_banner'] != '0000-00-00' ){
										$result[$i]['service_day']['main_banner'] = $get_alba['wr_service_banner'];
									}
									if( $get_alba['wr_service_banner_main_gold'] != '0000-00-00' ){
										$result[$i]['service_day']['main_banner_gold'] = $get_alba['wr_service_banner_main_gold'];
									}

									if( $get_alba['wr_service_banner_sub'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_banner'] = $get_alba['wr_service_banner_sub'];
									}
									if( $get_alba['wr_service_banner_sub_gold'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_banner_gold'] = $get_alba['wr_service_banner_sub_gold'];
									}

									if( $get_alba['wr_service_list'] != '0000-00-00' ){
										$result[$i]['service_day']['main_list'] = $get_alba['wr_service_list'];
									}
									if( $get_alba['wr_service_list_main_gold'] != '0000-00-00' ){
										$result[$i]['service_day']['main_list_gold'] = $get_alba['wr_service_list_main_gold'];
									}

									if( $get_alba['wr_service_list_sub'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_list'] = $get_alba['wr_service_list_sub'];
									}
									if( $get_alba['wr_service_list_sub_gold'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_list_gold'] = $get_alba['wr_service_list_sub_gold'];
									}

									if( $get_alba['wr_service_basic'] != '0000-00-00' ){
										$result[$i]['service_day']['main_basic'] = $get_alba['wr_service_basic'];
									}
									if( $get_alba['wr_service_basic_sub'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_basic'] = $get_alba['wr_service_basic_sub'];
									}

									if( $get_alba['wr_service_busy'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_option_busy'] = $get_alba['wr_service_busy'];
									}
									if( $get_alba['wr_service_neon'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_option_neon'] = $get_alba['wr_service_neon'];
									}
									if( $get_alba['wr_service_bold'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_option_bold'] = $get_alba['wr_service_bold'];
									}
									if( $get_alba['wr_service_color'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_option_color'] = $get_alba['wr_service_color'];
									}
									if( $get_alba['wr_service_icon'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_option_icon'] = $get_alba['wr_service_icon'];
									}
									if( $get_alba['wr_service_blink'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_option_blink'] = $get_alba['wr_service_blink'];
									}
									if( $get_alba['wr_service_jump'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_option_jump'] = $get_alba['wr_service_jump'];
									}

									if($get_payment['pay_etc_open']){	// 이력서 열람권
										$pay_etc_open = explode("/",$get_payment['pay_etc_open']);
										$etc_open = explode("/",$payment['pay_etc_open']);

										if($pay_etc_open[1]=='count'){	// 건수
											$result[$i]['service_day']['etc_open'] = "count/".number_format($pay_etc_open[0]);
										} else {	 // 기간
											$pay_etc_open_date = date('Y-m-d', strtotime('+'.$pay_etc_open[0].' '.$pay_etc_open[1]) );
											if($etc_open){
												sscanf($pay_etc_open_date,'%4d-%2d-%2d',$y,$m,$d); 
												switch($etc_open[1]){
													case 'day':
														$pay_etc_open_date = date('Y-m-d',mktime(0,0,0,$m,$d+$etc_open[0],$y));
													break;
													case 'month':
														$pay_etc_open_date = date('Y-m-d',mktime(0,0,0,$m+$etc_open[0],$d,$y));
													break;
													case 'year':
														$pay_etc_open_date = date('Y-m-d',mktime(0,0,0,$m,$d,$y+$etc_open[0]));
													break;
												}
											}

											$result[$i]['service_day']['etc_open'] = "date/".$pay_etc_open_date;
										}
									}

									if($get_payment['pay_etc_sms']){	// SMS 건수
										$pay_etc_sms = explode("/",$get_payment['pay_etc_sms']);
										$etc_sms = explode("/",$payment['pay_etc_sms']);
										if($pay_etc_sms[1]=='count'){	// 건수
											$result[$i]['service_day']['etc_sms'] = "count/".number_format($pay_etc_sms[0]+$etc_sms[0]) . "건";
											$service_type = "count";
										} else {	 // 기간
											$result[$i]['service_day']['etc_sms'] = "date/".date('Y-m-d', strtotime('+'.$pay_etc_sms[0].' '.$pay_etc_sms[1]) );
											$service_type = "date";
										}
									}

								## 이력서 서비스 기간 / 건수
								} else if($get_payment['pay_type']=='alba_resume'){

									if( $get_resume['wr_service_main_focus'] != '0000-00-00' ){
										$result[$i]['service_day']['main_focus'] = $get_resume['wr_service_main_focus'];
									}
									if( $get_resume['wr_service_main_focus_gold'] != '0000-00-00' ){
										$result[$i]['service_day']['main_focus_gold'] = $get_resume['wr_service_main_focus_gold'];
									}

									if( $get_resume['wr_service_sub_focus'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_resume_focus'] = $get_resume['wr_service_sub_focus'];
									}
									if( $get_resume['wr_service_sub_focus_gold'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_resume_focus_gold'] = $get_resume['wr_service_sub_focus_gold'];
									}

									if( $get_resume['wr_service_basic'] != '0000-00-00' ){
										$result[$i]['service_day']['main_resume_basic'] = $get_resume['wr_service_basic'];
									}
									if( $get_resume['wr_service_basic_sub'] != '0000-00-00' ){
										$result[$i]['service_day']['alba_resume_basic'] = $get_resume['wr_service_basic_sub'];
									}


									if( $get_resume['wr_service_busy'] != '0000-00-00' ){
										$result[$i]['service_day']['resume_option_busy'] = $get_resume['wr_service_busy'];
									}
									if( $get_resume['wr_service_neon'] != '0000-00-00' ){
										$result[$i]['service_day']['resume_option_neon'] = $get_resume['wr_service_neon'];
									}
									if( $get_resume['wr_service_bold'] != '0000-00-00' ){
										$result[$i]['service_day']['resume_option_bold'] = $get_resume['wr_service_bold'];
									}
									if( $get_resume['wr_service_color'] != '0000-00-00' ){
										$result[$i]['service_day']['resume_option_color'] = $get_resume['wr_service_color'];
									}
									if( $get_resume['wr_service_icon'] != '0000-00-00' ){
										$result[$i]['service_day']['resume_option_icon'] = $get_resume['wr_service_icon'];
									}
									if( $get_resume['wr_service_blink'] != '0000-00-00' ){
										$result[$i]['service_day']['resume_option_blink'] = $get_resume['wr_service_blink'];
									}
									if( $get_resume['wr_service_jump'] != '0000-00-00' ){
										$result[$i]['service_day']['resume_option_jump'] = $get_resume['wr_service_jump'];
									}

									if($get_payment['pay_etc_alba']){	// 채용정보 열람권
										$pay_etc_alba = explode("/",$get_payment['pay_etc_alba']);
										$etc_alba = explode("/",$payment['pay_etc_alba']);

										if($pay_etc_alba[1]=='count'){	// 건수
											$result[$i]['service_day']['etc_alba'] = "count/".number_format($pay_etc_alba[0]);
										} else {	 // 기간
											$pay_etc_alba_date = date('Y-m-d', strtotime('+'.$pay_etc_alba[0].' '.$pay_etc_alba[1]) );
											if($etc_alba){
												sscanf($pay_etc_alba_date,'%4d-%2d-%2d',$y,$m,$d); 
												switch($etc_alba[1]){
													case 'day':
														$pay_etc_alba_date = date('Y-m-d',mktime(0,0,0,$m,$d+$etc_alba[0],$y));
													break;
													case 'month':
														$pay_etc_alba_date = date('Y-m-d',mktime(0,0,0,$m+$etc_alba[0],$d,$y));
													break;
													case 'year':
														$pay_etc_alba_date = date('Y-m-d',mktime(0,0,0,$m,$d,$y+$etc_alba[0]));
													break;
												}
											}
											$result[$i]['service_day']['etc_alba'] = "date/".$pay_etc_alba_date;
										}
									}

									if($get_payment['pay_etc_sms']){	// SMS 건수
										$pay_etc_sms = explode("/",$get_payment['pay_etc_sms']);
										$etc_sms = explode("/",$payment['pay_etc_sms']);
										if($pay_etc_sms[1]=='count'){	// 건수
											$result[$i]['service_day']['etc_sms'] = "count/".number_format($pay_etc_sms[0]+$etc_sms[0]) . "건";
											$service_type = "count";
										} else {	 // 기간
											$result[$i]['service_day']['etc_sms'] = "date/".date('Y-m-d', strtotime('+'.$pay_etc_sms[0].' '.$pay_etc_sms[1]) );
											$service_type = "date";
										}
									}

								}

							} else {

								continue;

							}

							$result[$i]['service_name'] = $service_name;
							$result[$i]['service_code'] = $service_code;

						}

					
					return $result;

				}


				/**
				* 결제 상태별 처리 로직 (상태, 결제번호를 받아 처리)
				* 단수/복수 데이터 모두 사용하도록 단일 함수 형태로 구성한다.
				*/
				function payment_status( $status, $oid ){

					global $alice, $utility, $env;
					global $member_control, $alba_control, $alba_resume_control, $point_control, $package_control;
						
						if(!$oid) return false;

						$get_package = $this->get_payment_for_oid($oid," and `pay_package` != '0' ");

						if($get_package['pay_package']){
							$get_payment = $this->get_payment($get_package['no']);	 // 결제정보
						} else {
							$get_payment = $this->get_payment_for_oid($oid);	 // 결제정보
						}

						$get_member = $member_control->get_member($get_payment['pay_uid']);	// 회원 정보

						$pay_no = $get_payment['pay_no'];	// 서비스 데이터 번호

						$pay_type = $get_payment['pay_type'];	// 알바/이력서 구분 필드

						$pay_service = explode("/",$get_payment['pay_service']);

						switch($status){

							case 0:	## 결제대기
							case 2:	## 취소요청
							case 3:	## 취소완료

								// 01. 결제 정보를 추출하여 결제대기 상태 변경
								$pay_update_query = " update `".$this->payment_table."` set `pay_status` = '".$status."' where `pay_oid` = '".$oid."' ";	// oid 를 기준으로 수정
								$this->_query($pay_update_query);


								if($pay_type=='alba'){	// 공고 결제시
									
									$get_alba = $alba_control->get_alba($pay_no);

									// 02. 결제시 지급된 포인트가 있다면 차감
									if($env['alba_point_percent'] && !$get_payment['pay_dc']){
										$pay_price = $get_payment['pay_price'];	 // 결제 금액
										$pay_point = ($pay_price / 100 ) * $env['alba_point_percent'];
										$content = $alice['time_ymd'] . " 채용공고 [".stripslashes($get_alba['wr_subject'])."] '".$this->pay_status[$status]."' 차감";
										$point_control->point_insert($get_member['mb_id'], "-".$pay_point, $content, "alba", $pay_no, $alice['time_ymdhis']." 등록");
									}

									// 03. 서비스 된 정보가 있다면 삭제 한다.
									$pay_service = explode("/",$get_payment['pay_service']);

									if(@in_array('main_platinum',$pay_service) || @in_array('main_platinum_gold',$pay_service) || @in_array('main_platinum_logo',$pay_service) || @in_array('main_prime',$pay_service) || @in_array('main_prime_gold',$pay_service) || @in_array('main_prime_logo',$pay_service) || @in_array('main_grand',$pay_service) || @in_array('main_grand_gold',$pay_service) || @in_array('main_grand_logo',$pay_service) || @in_array('main_banner',$pay_service) || @in_array('main_banner_gold',$pay_service) || @in_array('main_list',$pay_service) || @in_array('main_list_gold',$pay_service) || @in_array('alba_platinum',$pay_service) || @in_array('alba_platinum_gold',$pay_service) || @in_array('alba_platinum_logo',$pay_service) || @in_array('alba_banner',$pay_service) || @in_array('alba_banner_gold',$pay_service) || @in_array('alba_list',$pay_service) || @in_array('alba_list_gold',$pay_service) || @in_array('alba_option_busy',$pay_service) || @in_array('alba_option_neon',$pay_service) || @in_array('alba_option_bold',$pay_service) || @in_array('alba_option_icon',$pay_service) || @in_array('alba_option_color',$pay_service) || @in_array('alba_option_blink',$pay_service) || @in_array('alba_option_jump',$pay_service) || @in_array('etc_open',$pay_service) || @in_array('main_basic',$pay_service) || @in_array('alba_basic',$pay_service) || @in_array('etc_sms',$pay_service) ){
										
										if(@in_array('main_platinum',$pay_service)){
											$vals['wr_service_platinum'] = "0000-00-00";
										}
										if(@in_array('main_platinum_gold',$pay_service)){
											$vals['wr_service_platinum_main_gold'] = "0000-00-00";
										}
										if(@in_array('main_platinum_logo',$pay_service)){
											$vals['wr_service_platinum_main_logo'] = "0000-00-00";
										}

										if(@in_array('main_prime',$pay_service)){
											$vals['wr_service_prime'] = "0000-00-00";
										}
										if(@in_array('main_prime_gold',$pay_service)){
											$vals['wr_service_prime_main_gold'] = "0000-00-00";
										}
										if(@in_array('main_prime_logo',$pay_service)){
											$vals['wr_service_prime_main_logo'] = "0000-00-00";
										}

										if(@in_array('main_grand',$pay_service)){
											$vals['wr_service_grand'] = "0000-00-00";
										}
										if(@in_array('main_grand_gold',$pay_service)){
											$vals['wr_service_grand_main_gold'] = "0000-00-00";
										}
										if(@in_array('main_grand_logo',$pay_service)){
											$vals['wr_service_grand_main_logo'] = "0000-00-00";
										}

										if(@in_array('main_banner',$pay_service)){
											$vals['wr_service_banner'] = "0000-00-00";
										}
										if(@in_array('main_banner_gold',$pay_service)){
											$vals['wr_service_banner_main_gold'] = "0000-00-00";
										}

										if(@in_array('main_list',$pay_service)){
											$vals['wr_service_list'] = "0000-00-00";
										}
										if(@in_array('main_list_gold',$pay_service)){
											$vals['wr_service_list_main_gold'] = "0000-00-00";
										}

										if(@in_array('main_basic',$pay_service)){	// 메인 일반 리스트
											$vals['wr_service_basic'] = "0000-00-00";
										}
										if(@in_array('alba_basic',$pay_service)){	 // 서브 일반 리스트
											$vals['wr_service_basic_sub'] = "0000-00-00";
										}

										if(@in_array('alba_platinum',$pay_service)){
											$vals['wr_service_platinum_sub'] = "0000-00-00";
										}
										if(@in_array('alba_platinum_gold',$pay_service)){
											$vals['wr_service_platinum_sub_gold'] = "0000-00-00";
										}
										if(@in_array('alba_platinum_logo',$pay_service)){
											$vals['wr_service_platinum_sub_logo'] = "0000-00-00";
										}

										if(@in_array('alba_banner',$pay_service)){
											$vals['wr_service_banner_sub'] = "0000-00-00";
										}
										if(@in_array('alba_banner_gold',$pay_service)){
											$vals['wr_service_banner_sub_gold'] = "0000-00-00";
										}

										if(@in_array('alba_option_busy',$pay_service)){
											$vals['wr_service_busy'] = "0000-00-00";
										}
										if(@in_array('alba_option_neon',$pay_service)){
											$vals['wr_service_neon'] = "0000-00-00";
										}
										if(@in_array('alba_option_bold',$pay_service)){
											$vals['wr_service_bold'] = "0000-00-00";
										}
										if(@in_array('alba_option_icon',$pay_service)){
											$vals['wr_service_icon'] = "0000-00-00";
										}
										if(@in_array('alba_option_color',$pay_service)){
											$vals['wr_service_color'] = "0000-00-00";
										}
										if(@in_array('alba_option_blink',$pay_service)){
											$vals['wr_service_blink'] = "0000-00-00";
										}
										if(@in_array('alba_option_jump',$pay_service)){
											$vals['wr_service_jump'] = "0000-00-00";
										}

										if(@in_array('etc_open',$pay_service)){	// 이력서 열람권은 회원 테이블에서 수정한다.
											$this->_query(" update `alice_member_service` set `mb_service_open` = '0000-00-00' where `mb_id` = '".$get_member['mb_id']."' ");	 // 열람 서비스 기간 차감
										}

										/*
										if(@in_array('etc_sms',$pay_service)){	// SMS 충전 건수는 회원 테이블에서 수정한다.
											$this->_query(" update `alice_member_service` set `mb_service_sms` = '0000-00-00' where `mb_id` = '".$get_member['mb_id']."' ");	 // SMS 충전 기간 차감
										}
										*/

										$alba_control->alba_update($vals,$pay_no);


									}
									

								} else if($pay_type=='alba_resume'){	// 알바 이력서 결제시


									$get_resume = $alba_resume_control->get_resume($pay_no);

									// 02. 결제시 지급된 포인트가 있다면 차감
									if($env['alba_resume_point_percent'] && !$get_payment['pay_dc']){
										$pay_price = $get_payment['pay_price'];	 // 결제 금액
										$pay_point = ($pay_price / 100 ) * $env['alba_resume_point_percent'];
										$content = $alice['time_ymd'] . " 이력서 [".stripslashes($get_resume['wr_subject'])."] '".$this->pay_status[$status]."' 차감";
										$point_control->point_insert($get_member['mb_id'], "-".$pay_point, $content, "alba_resume", $pay_no, $alice['time_ymdhis']." 등록");
									}

									// 03. 서비스 된 정보가 있다면 삭제 한다.
									$pay_service = explode("/",$get_payment['pay_service']);

									if(@in_array('main_focus',$pay_service) || @in_array('main_focus_gold',$pay_service) || @in_array('alba_resume_focus_gold',$pay_service) || @in_array('resume_option_busy',$pay_service) || @in_array('resume_option_neon',$pay_service) || @in_array('resume_option_bold',$pay_service) || @in_array('resume_option_icon',$pay_service) || @in_array('resume_option_color',$pay_service) || @in_array('resume_option_blink',$pay_service) || @in_array('resume_option_jump',$pay_service) || @in_array('main_resume_basic',$pay_service) || @in_array('alba_resume_basic',$pay_service)){

										if(@in_array('main_focus',$pay_service)){
											$vals['wr_service_main_focus'] = "0000-00-00";
										}

										if(@in_array('main_resume_basic',$pay_service)){
											$vals['wr_service_basic'] = "0000-00-00";
										}
										if(@in_array('alba_resume_basic',$pay_service)){
											$vals['wr_service_basic_sub'] = "0000-00-00";
										}

										if(@in_array('main_focus_gold',$pay_service)){
											$vals['wr_service_main_focus_gold'] = "0000-00-00";
										}
										if(@in_array('alba_resume_focus',$pay_service)){
											$vals['wr_service_sub_focus'] = "0000-00-00";
										}
										if(@in_array('alba_resume_focus_gold',$pay_service)){
											$vals['wr_service_sub_focus_gold'] = "0000-00-00";
										}
										if(@in_array('resume_option_busy',$pay_service)){
											$vals['wr_service_busy'] = "0000-00-00";
										}
										if(@in_array('resume_option_neon',$pay_service)){
											$vals['wr_service_neon'] = "0000-00-00";
										}
										if(@in_array('resume_option_bold',$pay_service)){
											$vals['wr_service_bold'] = "0000-00-00";
										}
										if(@in_array('resume_option_icon',$pay_service)){
											$vals['wr_service_icon'] = "0000-00-00";
										}
										if(@in_array('resume_option_color',$pay_service)){
											$vals['wr_service_color'] = "0000-00-00";
										}
										if(@in_array('resume_option_blink',$pay_service)){
											$vals['wr_service_blink'] = "0000-00-00";
										}
										if(@in_array('resume_option_jump',$pay_service)){
											$vals['wr_service_jump'] = "0000-00-00";
										}

										$alba_resume_control->update_resume($vals,$pay_no);	// 알바 이력서 기간 차감


									}

								} else if($pay_type=='resume_open'){	// 이력서 열람권 결제시

								}

								$result = true;

							break;

							## 결제완료
							case 1:

								// 01. success_payment 함수를 이용하여 완료 처리 한다.
								$result = $this->success_payment($oid);

							break;


						}	// switch end.

					
					return $result;

				}


		}	// class end.
?>