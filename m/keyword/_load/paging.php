<?php
	$alice_path = "../../../";

	$cat_path = "../../../";

	include_once $alice_path . "_core.php";

	$page = $_POST['page'];
	$page_rows = 5;
	$list_service = $_POST['list_service'];

	switch($list_service){
		
		## 알바정보 페이징
		case 'alba':

			$alba_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 ";
			$alba_list = $mobile_control->__AlbaList($page, $page_rows, $alba_list_con);
			$alba_list_count = count($alba_list['result']);
			$alba_list_total_page = $alba_list['total_page'];
			$alba_list_pages = $mobile_control->get_ajax_paging($page_rows, $page, $alba_list_total_page, "alba");

			$li_class = "";
			for($i=0;$i<$alba_list_count;$i++){
				$list_no = $alba_list['result'][$i]['no'];
				if($i==0) {
					$li_class = "positionR";	// gold
				} else {
					if($i > 3 ){
						$li_class = "clearfix";
					} else {
						$li_class = "";
					}
				}
				$get_alba = $alba_user_control->get_alba_no($list_no);
				$get_payment = $payment_control->get_payment_for_oid($get_alba['wr_oid']);	 // 결제정보
				$company_info = $user_control->get_member_company($get_alba['wr_id']);	// 등록 기업회원 정보

				$volume_arr = array( "volume_date" => $get_alba['wr_volume_date'], "volume_always" => $get_alba['wr_volume_always'], "volume_end" => $get_alba['wr_volume_end'] );
				$volume_date = $alba_user_control->volume_date($volume_arr,true);

				$wr_pay_type = $category_control->get_categoryCodeName($get_alba['wr_pay_type']);	// 급여조건
				$wr_pay = number_format($get_alba['wr_pay']);
				$wr_pay_conference = $get_alba['wr_pay_conference'];	// 협의가능
				$wr_area = $alba_user_control->list_area($get_alba['wr_area_0']);	// 2차 지역까지 출력
				$get_scrap = $alba_user_control->get_scrap_cnt($member['mb_id'], 'alba', $list_no, date('Y-m-d'));

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
							<a href="./detail.html?no=<?php echo $list_no;?>">
							<span class="logo_tit"><?php echo stripslashes($get_alba['wr_company_name']);?></span>
							</a> 
						</dt>
						<dd class="text1" >
							<?php echo $is_service_icon;?><a href="./detail.html?no=<?php echo $list_no;?>" class=""><span <?php echo $style_add;?> <?php echo $class;?>><?php echo stripslashes($get_alba['wr_subject']);?></span> </a>
						</dd>
						<dd class="text2">
							<span class="add"><?php echo $wr_area;?></span>
							<span class="gender"><?php echo $wr_gender;?></span>
							<span class="time"><?php echo $wr_time;?></span>
						</dd>
						<dd class="etc">
							<span class="edy edyEn"><?php echo $volume_date['text'];?></span>
							<span class="pay"><em class="number"><?php echo $wr_pay;?></em>원<em class="payIcon"><?php echo $wr_pay_type;?></em></span>
						</dd>
						<dd class="scrap" ><!-- bg_color1 -->
							<a onclick="alba_scrap('<?php echo $list_no;?>')"><img  class="<?php echo ($get_scrap['cnt'])?'bg_color1':'bg_gray1';?>" src="../images/icon/icon_scrap1.png" alt="스크랩"></a>
						</dd>
					</dl>
				</li>
<?php
			}	// for end.

		break;

		## 알바 이력서 페이징
		case 'alba_resume':

			$alba_resume_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 ";
			$alba_resume_list = $mobile_control->__AlbaResumeList($page, $page_rows, $alba_resume_con);
			$alba_resume_list_count = count($alba_resume_list['result']);
			$alba_resume_list_total_page = $alba_resume_list['total_page'];
			$alba_resume_list_pages = $mobile_control->get_ajax_paging($page_rows, $page, $alba_resume_list_total_page, "alba_resume");

			for($i=0;$i<$alba_resume_list_count;$i++){
			$no = $alba_resume_list['result'][$i]['no'];
			$wr_id = $alba_resume_list['result'][$i]['wr_id'];
			$list = $alba_resume_user_control->get_resume_service($no,"",44);
			$get_scrap = $alba_user_control->get_scrap_cnt($member['mb_id'], 'alba_resume', $no, date('Y-m-d'));
?>
		<li class="bth">
			<dl class="resumeList clearfix">
				<dt class="name_wrap"> 
					<a href="./detail.html?no=<?php echo $no;?>">
						<span class="name"><?php echo $list['wr_name'];?></span>
						<?php if($list['wr_photo']){ ?><span class="photo"><img width="16" height="16" src="../images/icon/icon_photo1.gif" class="vb pb2"></span><?php } ?>
						<span class="gender">(<?php echo $list['wr_gender'];?><?php echo $list['wr_age'];?>)</span>
						<span class="career"><?php echo $list['career'];?></span>
					</a> 
				</dt>
				<dd class="text1 positionR">
					<a href="./detail.html?no=<?php echo $no;?>" class=""><?php echo $list['subject'];?></a>
				</dd>
				<dd class="text2 clearfix positionR">
					<span class="pay">
						<em class="number"><?php echo $list['wr_pay'];?></em> 
						<?php if($list['wr_pay']!='추후협의'){ ?>
						<em class="payIcon"><?php echo $list['wr_pay_type'];?></em>
						<?php } ?>
					</span>
					<span class="etc"><?php echo $list['school_ability'];?></span>
					<span class="etc"><?php echo $utility->str_cut($list['wr_area'],18,"");?></span>
				</dd>
				<dd class="scrap" ><!-- bg_color1 -->
					<a onclick="resume_scrap('<?php echo $no;?>');"><img alt="스크랩" src="../images/icon/icon_scrap1.png" class="<?php echo ($get_scrap['cnt'])?'bg_color1':'bg_gray1';?>"></a>
				</dd>
			</dl>
		</li>
<?php
			}	// for end.

		break;

		## 게시판 페이징
		case 'board':

		break;
	}

?>