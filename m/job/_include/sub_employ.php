<div class="mList">
	<h2><em class="icon"><img  class="bg_color1" src="../images/icon/icon_mList1.png"></em><span>일반채용정보</span></h2>
	<ul class="boxWrap clearfix positionR">
	<?php
	$li_class = "";
	for($i=0;$i<$sub_count;$i++){
		$sub_no = $sub['result'][$i]['no'];
		$get_alba = $alba_user_control->get_alba_no($sub_no);
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
		$wr_gender = $alba_user_control->gender_val[$get_alba['wr_gender']];	 // 성별

		$wr_stime = $get_alba['wr_stime'];
		$wr_etime = $get_alba['wr_etime'];
		$time_conference = $get_alba['wr_time_conference'];
		$wr_time = ($time_conference) ? "시간협의" : $wr_stime . " ~ " . $wr_etime;
		$get_scrap = $alba_user_control->get_scrap_cnt($member['mb_id'], 'alba', $sub_no, date('Y-m-d'));

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
		<li class="bth positionR <?php echo $li_class;?>">
			<dl class="clearfix">
				<dt> 
					<a href="./detail.html?no=<?php echo $sub_no;?>">
					<span class="logo_tit"><?php echo stripslashes($get_alba['wr_company_name']);?></span>
					</a> 
				</dt>
				<dd class="text1" >
					<?php echo $is_service_icon;?><a href="./detail.html?no=<?php echo $sub_no;?>" class=""><span <?php echo $style_add;?> <?php echo $class;?>><?php echo stripslashes($get_alba['wr_subject']);?></span> </a>
				</dd>
				<dd class="text2">
					<span class="add"><?php echo $wr_area;?></span>
					<span class="gender"><?php echo $wr_gender;?></span>
					<span class="time"><?php echo $wr_time;?></span>
				</dd>
				<dd class="etc">
					<span class="edy edyEn"><?php echo $volume_date['text'];?></span>
					<span class="pay">
					<?php
					if($get_alba['wr_pay_conference']){
						echo "<strong>".$alba_user_control->pay_conference[$get_alba['wr_pay_conference']]."</strong>";
					} else {
					?>
						<em class="payIcon"><?php echo $wr_pay_type;?></em> <em class="number"><?php echo number_format($get_alba['wr_pay']);?></em>원
					<?php } ?>
					</span>
					<!-- <span class="pay"><em class="number"><?php echo $wr_pay;?></em>원<em class="payIcon"><?php echo $wr_pay_type;?></em></span> -->
				</dd>
				<dd class="scrap" ><!-- bg_color1 -->
					<a onclick="alba_scrap('<?php echo $sub_no;?>');"><img class="<?php echo ($get_scrap['cnt'])?'bg_color1':'bg_gray1';?>" src="../images/icon/icon_scrap1.png" alt="스크랩"></a>
				</dd>
			</dl>
		</li>
	<?php } ?>
	</ul>
</div>