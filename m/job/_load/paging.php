<?php
	$alice_path = "../../../";

	$cat_path = "../../../";

	include_once $alice_path . "_core.php";

	$page = $_POST['page'];
	$list_service = $_POST['list_service'];

	switch($list_service){

		## 서브 박스형 채용정보
		case 'sub_box':

			$sub_box_total = $mobile_info['wr_sub_box_total'];		// 전체 출력수
			$sub_box_page = $mobile_info['wr_sub_box_page'];	// 1페이지당 출력수

			$sub_box_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 ";
			$sub_box_con .= " and (`wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";
			$sub_box_con .= " and ( `wr_service_platinum_sub` >= now() or `wr_service_banner_sub` >= now() ) ";

			$sub_box_list = $mobile_control->alba_listing( $page, $sub_box_page, $sub_box_con, $sub_box_total );
			$sub_box_list_count = count($sub_box_list['result']);

			$sub_box_total_page = $sub_box_list['total_page'];
			$sub_box_pages = $mobile_control->get_ajax_paging($sub_box_page, $page, $sub_box_total_page, "sub_box");

			$li_class = "";
			for($i=0;$i<$sub_box_list_count;$i++){
				$sub_box_list_no = $sub_box_list['result'][$i]['no'];
				if($i==0) {
					$li_class = "positionR";	// gold
				} else {
					if($i > 3 ){
						$li_class = "clearfix";
					} else {
						$li_class = "";
					}
				}

				$get_alba = $alba_user_control->get_alba_no($sub_box_list_no);
				$wr_id = $get_alba['wr_id'];
				$get_payment = $payment_control->get_payment_for_oid($get_alba['wr_oid']);	 // 결제정보
				$company_info = $user_control->get_member_company($get_alba['wr_id']);	// 등록 기업회원 정보

				$volume_arr = array( "volume_date" => $get_alba['wr_volume_date'], "volume_always" => $get_alba['wr_volume_always'], "volume_end" => $get_alba['wr_volume_end'] );
				$volume_date = $alba_user_control->volume_date($volume_arr,true);

				$wr_pay_type = $category_control->get_categoryCodeName($get_alba['wr_pay_type']);	// 급여조건
				$wr_pay = number_format($get_alba['wr_pay']);
				$wr_pay_conference = $get_alba['wr_pay_conference'];	// 협의가능
				$wr_area = $alba_user_control->list_area($get_alba['wr_area_0']);	// 2차 지역까지 출력

				$is_service = $alba_user_control->service_valid( $get_alba );	// 서비스 정보

				## Gold service
				$is_gold = false;
				if($is_service['service_platinum_sub_gold'] || $is_service['service_banner_sub_gold']){
					$is_gold = true;
				}
				if($is_gold){
					$li_class .= " gold";
				}
				## // Gold service

				## Logo service
		if($get_alba['input_type']=='self'){	// 관리자 직접 입력
			$logo_path = $alice['data_alba_path'];
			if(file_exists($logo_path."/".$get_alba['etc_0']) && is_file($logo_path."/".$get_alba['etc_0'])){
				if($is_service['service_platinum_sub_logo']){
					$logo = $alba_user_control->logo_print( $logo_path."/".$get_alba['etc_0'], $get_payment['pay_alba_platinum_logo_effect'], $get_alba['company_name'] );
					$wr_logo = $logo;
				} else {
					$wr_logo = "<img alt=\"".$get_alba['company_name']."\" src=\"".$logo_path . "/". $get_alba['etc_0']."\" title=\"".$get_alba['company_name']."\"/>";
				}
			} else {
				$wr_logo = "<img src=\"".$alice['images_path']."/basic/bg_noLogo.gif\"/>";
			}
		} else {
				$logo_path = $alice['data_alba_path'];
				if(file_exists($logo_path."/".$get_alba['etc_0']) && is_file($logo_path."/".$get_alba['etc_0'])){
					if($is_service['service_platinum_sub_logo']){
						$logo = $alba_user_control->logo_print( $logo_path."/".$get_alba['etc_0'], $get_payment['pay_alba_platinum_logo_effect'], $get_alba['company_name'], true );
						$wr_logo = $logo;
					} else {
						$wr_logo = "<img alt=\"".$get_alba['company_name']."\" src=\"".$logo_path . "/". $get_alba['etc_0']."\" title=\"".$get_alba['company_name']."\"/>";
					}
				} else {
					$wr_logo = $company_info['mb_logo'];
					if($wr_logo){
						$logo_path = $alice['data_member_path'] . '/' . $wr_id . '/logo';
						if($is_service['service_platinum_sub_logo']){
							$logo = $alba_user_control->logo_print( $logo_path."/".$company_info['mb_logo'], $get_payment['pay_alba_platinum_logo_effect'], $get_alba['company_name'], true );
							$wr_logo = $logo;
						} else {
							$wr_logo = "<img alt=\"".$get_alba['company_name']."\" src=\"".$logo_path . "/". $company_info['mb_logo']."\" title=\"".$get_alba['company_name']."\"/>";
						}
					} else {
						if(file_exists($alice['data_alba_path']."/".$get_alba['etc_0']) && is_file($alice['data_alba_path']."/".$get_alba['etc_0'])){
							$wr_logo = "<img alt=\"".$get_alba['company_name']."\" src=\"".$alice['data_alba_path'] . "/". $get_alba['etc_0']."\" title=\"".$get_alba['company_name']."\"/>";
						} else {
							$wr_logo = "<img src=\"".$alice['images_path']."/basic/bg_noLogo.gif\"/>";
						}
					}
				}
		}
				## // Logo service

				// 급구 아이콘
				$alice['data_icon_path'] = "../../data/icon";
				$is_service_busy = "";
				if($is_service['service_busy']){
					$service_check = $service_control->service_check('alba_option_busy');
					$is_service_busy = "<img src=\"".$alice['data_icon_path'] . "/" . $service_check['busy_icon']."\" class=\"vm pr5\"/>";
				}

				// 강조 아이콘
				$is_service_icon = "";
				if($is_service['service_icon']){	
					$icon_sel = $category_control->get_category($get_payment['pay_alba_option_icon_sel']);
					$is_service_icon = "<img src=\"".$alice['data_icon_path'] . "/" . $icon_sel['name']."\" class=\"vm pr5\">";
				}

				$style_add = " style=\"";

				// 형광펜
				if($is_service['service_neon']){
					$style_add .= "background-color:#".$get_payment['pay_alba_option_neon_color'].";";
				}

				// 굵은글자
				if($is_service['service_bold']){
					$style_add .= "font-weight:bold;";
				}

				// 글자색
				if($is_service['service_color']){
					$style_add .= "color:#".$get_payment['pay_alba_option_color_sel'].";";
				}

				$style_add .= "\" ";

				// 반짝임
				$class = "";
				if($is_service['service_blink']){
					$class = "class=\"jumble\"";
				}
?>
				<li class="bth <?php echo $li_class;?>">
					<dl class="clearfix">
						<dt>
							<a href="../job/detail.html?no=<?php echo $sub_box_list_no;?>">
							<span class="logo"><?php echo $wr_logo;?></span>
							<span class="logo_tit"><?php echo stripslashes($get_alba['wr_company_name']);?></span>
							</a> 
						</dt>
						<dd class="text1">
							<?php echo $is_service_icon;?><a href="../job/detail.html?no=<?php echo $sub_box_list_no;?>" class=""><span <?php echo $style_add;?> <?php echo $class;?>><?php echo stripslashes($get_alba['wr_subject']);?></span> </a><span class="edy edyEn"><?php echo $volume_date['text'];?></span>
						</dd>
						<dd class="text2 clearfix">
							<span class="pay"><em class="payIcon"><?php echo $wr_pay_type;?></em> <em class="number"><?php echo $wr_pay;?></em>원</span>
							<span class="add"><?php echo $wr_area;?></span>
						</dd>
					</dl>
				</li>

<?php
			}	// for end.

		break;

		## 서브 리스트형 채용정보
		case 'sub_list':

			$sub_list_total = $mobile_info['wr_sub_list_total'];
			$sub_list_page = $mobile_info['wr_sub_list_page'];

			$sub_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 and `wr_service_list_sub` >= now() ";
			$sub_list_con .= " and (`wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";

			$sub_list = $mobile_control->alba_listing( $page, $sub_list_page, $sub_list_con, $sub_list_total );
			$sub_list_count = count($sub_list['result']);

			$sub_list_total_page = $sub_list['total_page'];
			$sub_list_pages = $mobile_control->get_ajax_paging($sub_list_page, $page, $sub_list_total_page, "sub_list");

			$li_class = "";
			for($i=0;$i<$sub_list_count;$i++){
				$sub_list_no = $sub_list['result'][$i]['no'];
				if($i==0) {
					$li_class = "positionR";	// gold
				} else {
					if($i > 3 ){
						$li_class = "clearfix";
					} else {
						$li_class = "";
					}
				}
				$get_alba = $alba_user_control->get_alba_no($sub_list_no);
				$wr_id = $get_alba['wr_id'];
				$get_payment = $payment_control->get_payment_for_oid($get_alba['wr_oid']);	 // 결제정보
				$company_info = $user_control->get_member_company($get_alba['wr_id']);	// 등록 기업회원 정보

				$volume_arr = array( "volume_date" => $get_alba['wr_volume_date'], "volume_always" => $get_alba['wr_volume_always'], "volume_end" => $get_alba['wr_volume_end'] );
				$volume_date = $alba_user_control->volume_date($volume_arr,true);

				$wr_pay_type = $category_control->get_categoryCodeName($get_alba['wr_pay_type']);	// 급여조건
				$wr_pay = number_format($get_alba['wr_pay']);
				$wr_pay_conference = $get_alba['wr_pay_conference'];	// 협의가능
				$wr_area = $alba_user_control->list_area($get_alba['wr_area_0']);	// 2차 지역까지 출력
				$is_service = $alba_user_control->service_valid( $get_alba );	// 서비스 정보

				## Gold service
				$is_gold = false;
				if($is_service['service_platinum_sub_gold'] || $is_service['service_banner_sub_gold']){
					$is_gold = true;
				}
				if($is_gold){
					$li_class .= " gold";
				}
				## // Gold service

				## Logo service
		if($get_alba['input_type']=='self'){	// 관리자 직접 입력
			$logo_path = $alice['data_alba_path'];
			if(file_exists($logo_path."/".$get_alba['etc_0']) && is_file($logo_path."/".$get_alba['etc_0'])){
				if($is_service['service_platinum_sub_logo']){
					$logo = $alba_user_control->logo_print( $logo_path."/".$get_alba['etc_0'], $get_payment['pay_alba_platinum_logo_effect'], $get_alba['company_name'] );
					$wr_logo = $logo;
				} else {
					$wr_logo = "<img alt=\"".$get_alba['company_name']."\" src=\"".$logo_path . "/". $get_alba['etc_0']."\" title=\"".$get_alba['company_name']."\"/>";
				}
			} else {
				$wr_logo = "<img src=\"".$alice['images_path']."/basic/bg_noLogo.gif\"/>";
			}
		} else {
				$logo_path = $alice['data_alba_path'];
				if(file_exists($logo_path."/".$get_alba['etc_0']) && is_file($logo_path."/".$get_alba['etc_0'])){
					if($is_service['service_platinum_sub_logo']){
						$logo = $alba_user_control->logo_print( $logo_path."/".$get_alba['etc_0'], $get_payment['pay_alba_platinum_logo_effect'], $get_alba['company_name'], true );
						$wr_logo = $logo;
					} else {
						$wr_logo = "<img alt=\"".$get_alba['company_name']."\" src=\"".$logo_path . "/". $get_alba['etc_0']."\" title=\"".$get_alba['company_name']."\"/>";
					}
				} else {
					$wr_logo = $company_info['mb_logo'];
					if($wr_logo){
						$logo_path = $alice['data_member_path'] . '/' . $wr_id . '/logo';
						if($is_service['service_platinum_sub_logo']){
							$logo = $alba_user_control->logo_print( $logo_path."/".$company_info['mb_logo'], $get_payment['pay_alba_platinum_logo_effect'], $get_alba['company_name'], true );
							$wr_logo = $logo;
						} else {
							$wr_logo = "<img alt=\"".$get_alba['company_name']."\" src=\"".$logo_path . "/". $company_info['mb_logo']."\" title=\"".$get_alba['company_name']."\"/>";
						}
					} else {
						if(file_exists($alice['data_alba_path']."/".$get_alba['etc_0']) && is_file($alice['data_alba_path']."/".$get_alba['etc_0'])){
							$wr_logo = "<img alt=\"".$get_alba['company_name']."\" src=\"".$alice['data_alba_path'] . "/". $get_alba['etc_0']."\" title=\"".$get_alba['company_name']."\"/>";
						} else {
							$wr_logo = "<img src=\"".$alice['images_path']."/basic/bg_noLogo.gif\"/>";
						}
					}
				}
		}
				## // Logo service

				// 급구 아이콘
				$alice['data_icon_path'] = "../../data/icon";
				$is_service_busy = "";
				if($is_service['service_busy']){
					$service_check = $service_control->service_check('alba_option_busy');
					$is_service_busy = "<img src=\"".$alice['data_icon_path'] . "/" . $service_check['busy_icon']."\" class=\"vm pr5\"/>";
				}

				// 강조 아이콘
				$is_service_icon = "";
				if($is_service['service_icon']){	
					$icon_sel = $category_control->get_category($get_payment['pay_alba_option_icon_sel']);
					$is_service_icon = "<img src=\"".$alice['data_icon_path'] . "/" . $icon_sel['name']."\" class=\"vm pr5\">";
				}

				$style_add = " style=\"";

				// 형광펜
				if($is_service['service_neon']){
					$style_add .= "background-color:#".$get_payment['pay_alba_option_neon_color'].";";
				}

				// 굵은글자
				if($is_service['service_bold']){
					$style_add .= "font-weight:bold;";
				}

				// 글자색
				if($is_service['service_color']){
					$style_add .= "color:#".$get_payment['pay_alba_option_color_sel'].";";
				}

				$style_add .= "\" ";

				// 반짝임
				$class = "";
				if($is_service['service_blink']){
					$class = "class=\"jumble\"";
				}
?>
				<li class="bth <?php echo $li_class;?>">
					<dl class="clearfix">
						<dt>
							<a href="../job/detail.html?no=<?php echo $sub_list_no;?>">
							<span class="logo"><?php echo $wr_logo;?></span>
							<span class="logo_tit"><?php echo stripslashes($get_alba['wr_company_name']);?></span>
							</a> 
						</dt>
						<dd class="text1">
							<?php echo $is_service_icon;?><a href="../job/detail.html?no=<?php echo $sub_list_no;?>" class=""><span <?php echo $style_add;?> <?php echo $class;?>><?php echo stripslashes($get_alba['wr_subject']);?></span> </a><span class="edy edyEn"><?php echo $volume_date['text'];?></span>
						</dd>
						<dd class="text2 clearfix">
							<span class="pay"><em class="payIcon"><?php echo $wr_pay_type;?></em> <em class="number"><?php echo $wr_pay;?></em>원</span>
							<span class="add"><?php echo $wr_area;?></span>
						</dd>
					</dl>
				</li>
<?php
			}	// for end.
		break;

	}	// switch end.
?>