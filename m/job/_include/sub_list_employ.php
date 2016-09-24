<div id="mPrime">
	<h2><em class="icon"><img  class="bg_color1" src="../images/icon/icon_mList1.png"></em><span>리스트형 채용정보</span></h2>
	<ul class="boxWrap clearfix positionR" id="sub_list">
	<?php
	$li_class = "";
	for($i=0;$i<$sub_list_count;$i++){
		$sub_list_no = $sub_list['result'][$i]['no'];
		if($i==0) {
			$li_class = "positionR"; // gold
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

		// 회사 로고
		$wr_logo = $company_info['mb_logo'];
		if($wr_logo){
			$logo_path = $alice['data_member_path'] . '/' . $get_alba['wr_id'] . '/logo';
			$wr_logo = "<img src=\"".$logo_path."/".$company_info['mb_logo']."\" width=\"200\" height=\"100\"/>";
		} else {
			$wr_logo = "<img src=\"".$alice['images_path']."/basic/bg_noLogo.gif\" width=\"200\" height=\"100\"/>";
		}
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
			$wr_logo = $company_info['mb_logo'];
			if($wr_logo){
				$logo_path = $alice['data_member_path'] . '/' . $wr_id . '/logo';
				if($is_service['service_platinum_sub_logo']){
					$logo = $alba_user_control->logo_print( $logo_path."/".$company_info['mb_logo'], $get_payment['pay_alba_platinum_logo_effect'], $get_alba['company_name'] );
					$wr_logo = $logo;
				} else {
					$wr_logo = "<img alt=\"".$get_alba['company_name']."\" src=\"".$logo_path . "/". $company_info['mb_logo']."\" title=\"".$get_alba['company_name']."\"/>";
				}
			} else {
				$wr_logo = "<img src=\"".$alice['images_path']."/basic/bg_noLogo.gif\"/>";
			}
		}
		## // Logo service

		// 급구 아이콘
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
					<span class="pay">
					<?php
					if($get_alba['wr_pay_conference']){
						echo "<strong>".$alba_user_control->pay_conference[$get_alba['wr_pay_conference']]."</strong>";
					} else {
					?>
						<em class="payIcon"><?php echo $wr_pay_type;?></em> <em class="number"><?php echo number_format($get_alba['wr_pay']);?></em>원
					<?php } ?>					
					</span>
					<span class="add"><?php echo $wr_area;?></span>
				</dd>
			</dl>
		</li>
	<?php } // for end.?>
	</ul>
</div>

<div class="paging mt20 mb50">
	<span class="page">
	<span id="sub_list_first"></span>
	<?php
		$sub_list_pages = str_replace("처음", "<img src=\"../images/btn/btn_leftArrow2.png\" class=\"bg_color1\"><img src=\"../images/btn/btn_leftArrow2.png\" class=\"bg_color1\">", $sub_list_pages);
		$sub_list_pages = str_replace("이전", "<img src=\"../images/btn/btn_leftArrow2.png\" class=\"bg_color1\">", $sub_list_pages);
		$sub_list_pages = str_replace("다음", "<img src=\"../images/btn/btn_rightArrow2.png\" class=\"bg_color1\">", $sub_list_pages);
		$sub_list_pages = str_replace("맨끝", "<img src=\"../images/btn/btn_rightArrow2.png\" class=\"bg_color1\"><img src=\"../images/btn/btn_rightArrow2.png\" class=\"bg_color1\">", $sub_list_pages);
		$sub_list_pages = preg_replace("/<b>([0-9]*)<\/b>/", "$1", $sub_list_pages);
		echo $sub_list_pages;
	?>
	</span>
</div>
