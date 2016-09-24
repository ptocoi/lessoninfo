<?php
	$alice_path = "../../../";

	$cat_path = "../../../";

	include_once $alice_path . "_core.php";

	$page = $_POST['page'];
	$list_service = $_POST['list_service'];

	switch($list_service){

		## 메인 박스형 채용정보
		case 'main_box':

			$main_box_total = $mobile_info['wr_main_box_total'];		// 전체 출력수
			$main_box_page = $mobile_info['wr_main_box_page'];	// 1페이지당 출력수

			$main_box_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 ";
			$main_box_con .= " and (`wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";
			$main_box_con .= " and ( `wr_service_platinum` >= now() ";
			$main_box_con .= " or `wr_service_prime` >= now() ";
			$main_box_con .= " or `wr_service_grand` >= now() ";
			$main_box_con .= " or `wr_service_banner` >= now() ) ";

			$main_box_list = $mobile_control->alba_listing( $page, $main_box_page, $main_box_con, $main_box_total );
			$main_box_list_count = count($main_box_list['result']);

			$li_class = "";
			for($i=0;$i<$main_box_list_count;$i++){
				$main_box_list_no = $main_box_list['result'][$i]['no'];
				if($i==0) {
					$li_class = "positionR"; // gold
				} else {
					if($i > 3 ){
						$li_class = "clearfix";
					} else {
						$li_class = "";
					}
				}

				$get_alba = $alba_user_control->get_alba_no($main_box_list_no);
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
				if($is_service['service_platinum_main_gold'] || $is_service['service_prime_main_gold'] || $is_service['service_grand_main_gold'] || $is_service['service_banner_main_gold']){
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

				$wr_pay_type = $category_control->get_categoryCodeName($get_alba['wr_pay_type']);	// 급여조건
	?>
				<li class="bth <?php echo $li_class;?>">
					<dl class="clearfix">
						<dt>
							<a href="../job/detail.html?no=<?php echo $main_box_list_no;?>">
							<span class="logo"><?php echo $wr_logo;?></span>
							<span class="logo_tit"><?php echo stripslashes($get_alba['wr_company_name']);?></span>
							</a> 
						</dt>
						<dd class="text1">
							<?php echo $is_service_icon;?><a href="../job/detail.html?no=<?php echo $main_box_list_no;?>" class=""><span <?php echo $style_add;?> <?php echo $class;?>><?php echo stripslashes($get_alba['wr_subject']);?></span> </a><span class="edy edyEn"><?php echo $volume_date['text'];?></span>
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
<?php 
			} // for end.
			
		break;

		## 메인 리스트형 채용정보
		case 'main_list':

			$main_list_total = $mobile_info['wr_main_list_total'];
			$main_list_page = $mobile_info['wr_main_list_page'];

			$main_list_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 and `wr_service_list` >= now() ";
			$main_list_con .= " and (`wr_volume_date` >= curdate() or `wr_volume_always` = 1 or `wr_volume_end` = 1 ) ";

			$main_list = $mobile_control->alba_listing( $page, $main_list_page, $main_list_con, $main_list_total );
			$main_list_count = count($main_list['result']);


			$li_class = "";
			for($i=0;$i<$main_list_count;$i++){
				$main_list_no = $main_list['result'][$i]['no'];
				if($i==0) {
					$li_class = "positionR";	// gold
				} else {
					if($i > 3 ){
						$li_class = "clearfix";
					} else {
						$li_class = "";
					}
				}

				$get_alba = $alba_user_control->get_alba_no($main_list_no);
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
				if($is_service['service_platinum_main_gold'] || $is_service['service_prime_main_gold'] || $is_service['service_grand_main_gold'] || $is_service['service_banner_main_gold']){
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

				$wr_pay_type = $category_control->get_categoryCodeName($get_alba['wr_pay_type']);	// 급여조건
?>
		<li class="bth <?php echo $li_class;?>">
			<dl class="clearfix">
				<dt>
					<a href="../job/detail.html?no=<?php echo $main_list_no;?>">
					<span class="logo"><?php echo $wr_logo;?></span>
					<span class="logo_tit"><?php echo stripslashes($get_alba['wr_company_name']);?></span>
					</a> 
				</dt>
				<dd class="text1">
					<?php echo $is_service_icon;?><a href="../job/detail.html?no=<?php echo $main_list_no;?>" class=""><span <?php echo $style_add;?> <?php echo $class;?>><?php echo stripslashes($get_alba['wr_subject']);?></span> </a><br/>
				</dd>
				<dd class="text2 clearfix" style="margin-bottom:10px;">
					<span class="edyEn"><?php echo $volume_date['text'];?></span>
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
<?php
			}	// for end.

		break;

		## 메인 포커스 인재정보
		case 'main_focus':

			$main_focus_total = $mobile_info['wr_main_focus_total'];
			$main_focus_page = $mobile_info['wr_main_focus_page'];

			$main_focus_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 and `wr_service_main_focus` >= now() ";

			$main_focus = $mobile_control->resume_listing( $page, $main_focus_page, $main_focus_con, $main_focus_total );
			$main_focus_count = count($main_focus['result']);

			for($i=0;$i<$main_focus_count;$i++){
				$main_focus_no = $main_focus['result'][$i]['no'];
				$get_resume = $alba_resume_user_control->get_resume_no($main_focus_no);	// 이력서 정보
				$wr_id = $get_resume['wr_id'];
				$get_member = $user_control->get_member($wr_id);	// 작성 회원 정보
				$get_payment = $payment_control->get_payment_for_oid($get_resume['wr_oid']);	 // 결제정보

				/* 회원 사진 */
				$wr_photo = $get_member['mb_photo'];
				if($wr_photo){
					$photo_path = "/data/member/" . $wr_id;
					$wr_photo = "<img src=\"".$photo_path."/".$get_member['mb_photo']."\" width=\"70\" height=\"91\"/>";
				} else {
					$wr_photo = "<img src=\"".$alice['images_path']."/basic/bg_noPhoto.gif\"/>";
				}
				/* // 회원 사진 */

				/* 이력서 이름 */
				if($is_member){		// 회원일때
					if($member['mb_type']=='company'){	 // 기업회원의 경우 열람권 체크
						$get_service = $member_control->get_service_member($member['mb_id']);
						$open_service_valid = $utility->valid_day($get_service['mb_service_open']);
						$is_open_resume = $alba_resume_user_control->is_open_resume('alba',$member['mb_id'],$wr_id);
						if($is_open_resume){	 // 열람 기록이 있다면 보여준다
							$wr_name = $name = stripslashes($get_member['mb_name']);
						} else {	 // 없음 감추기
							$wr_name = trim( $utility->make_pass_00( stripslashes($get_member['mb_name']) ) );
							$name = trim( $utility->make_pass_○○( stripslashes($get_member['mb_name']) ) );
						}
					} else if($member['mb_type']=='individual'){	 // 개인회원의 경우 자신의 이력서 인지 체크
						if($wr_id==$member['mb_id']){	// 내 이력서 라면
							$wr_name = $name = stripslashes($get_member['mb_name']);
						} else {	 // 내 이력서가 아니라면
							$wr_name = trim( $utility->make_pass_00( stripslashes($get_member['mb_name']) ) );
							$name = trim( $utility->make_pass_○○( stripslashes($get_member['mb_name']) ) );
						}
					}
				} else {	 // 회원이 아닐때 (무조건 감춤)
					$wr_name = trim( $utility->make_pass_00( stripslashes($get_member['mb_name']) ) );
					$name = trim( $utility->make_pass_○○( stripslashes($get_member['mb_name']) ) );
				}
				/* // 이력서 이름 */
				$wr_gender = $alba_resume_user_control->gender_text[$get_member['mb_gender']];	// 성별
				$get_age = $member_control->get_age($get_member['mb_birth']);	// 나이 (내/외국인 구분)
				
				$list = $alba_resume_user_control->get_resume_service($main_focus_no,"main_focus",44);

?>
				<li class="<?php echo $list['gold_service'];?>">
					<dl>
						<dt>
							<a href="../resume/detail.html?no=<?php echo $get_resume['no'];?>" onclick=""> 
							<span class="photo"><?php echo $wr_photo;?></span></a> 
						</dt>
						<dd class="name_wrap">
							<span class="name"><?php echo $wr_name;?></span>
							<span>(<?php echo $wr_gender;?><?php echo $get_age;?>)</span>
						</dd>
						<dd class="text1"><a href="../resume/detail.html?no=<?php echo $get_resume['no'];?>" class=""><?php echo stripslashes($get_resume['wr_subject']);?></a></dd>
					</dl>
				</li>
<?php
			} // for end.

		break;

	}

?>