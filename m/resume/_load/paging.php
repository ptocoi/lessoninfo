<?php
	$alice_path = "../../../";

	$cat_path = "../../../";

	include_once $alice_path . "_core.php";

	$page = $_POST['page'];
	$list_service = $_POST['list_service'];

	switch($list_service){

		## 서브 포커스 인재정보
		case 'sub_focus':

			$sub_focus_total = $mobile_info['wr_sub_focus_total'];
			$sub_focus_page = $mobile_info['wr_sub_focus_page'];

			$sub_focus_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 and `wr_service_sub_focus` >= now() ";

			$sub_focus_list = $mobile_control->alba_resume_listing( $page, $sub_focus_page, $sub_focus_con, $sub_focus_total );
			$sub_focus_list_count = count($sub_focus_list['result']);

			$sub_focus_total_page = $sub_focus_list['total_page'];
			$sub_focus_pages = $mobile_control->get_ajax_paging($sub_focus_total_page, $page, $sub_focus_total_page, "sub_focus");

			for($i=0;$i<$sub_focus_list_count;$i++){
				$no = $sub_focus_list['result'][$i]['no'];
				$wr_id = $sub_focus_list['result'][$i]['wr_id'];
				$get_member = $user_control->get_member($wr_id);	// 작성 회원 정보
				$list = $alba_resume_user_control->get_resume_service($no,"sub_focus",44);
				if($list['is_photo']){	 // 이력서 사진이 있다면
					$alice['data_member_path'] = "../../data/member";
					$thumb_path = $alice['data_member_path'] . "/" . $wr_id;
					$src = $thumb_path . "/". $get_member['mb_photo'];
					$get_img = @getimagesize($src); // 파일정보를 가져옴
					$img_step1 = explode("/",$src);
					$img_step2 = explode(".",$img_step1[4]);
					$new_imgname = $img_step2[0];
					$thumb_file_list = $thumb_path . "/70x91_".$new_imgname;
					if(!file_exists($thumb_file_list)){
						$gd = gd_info();		// gd lib 체크
						$gdversion = substr(preg_replace("/[^0-9]/", "", $gd['GD Version']), 0, 2); // gd 버전이 2.0 이상인지 체크
						if(!$gdversion){ 
							$thumb_file_list = $src; // gd 2.0 이하면 강제적으로 줄임
						}else{
							if($get_img[0] <= $re_img_width){
								$thumb_file_list = $src;
								$img_height = $re_img_height;
								$img_width = $re_img_width;
							}else{
								// 정비율
								if ($get_img[0] >= $re_img_width){
									$rate = $re_img_width / $get_img[0];
									$img_width = $re_img_width;
									$img_height = (int)($get_img[1] * $rate);
								}

								// 섬네일 파일 체크
								if(!file_exists($thumb_file_list)){
									$utility->createThumb_list(70,91,$src, $thumb_file_list); // list 페이지 썸네일
								}
							}
						}
					}
				} else {	 // 없다면
					$thumb_file_list = $alice['images_path'] . "/basic/bg_noPhoto.gif";
				}
?>
			<li class="<?php echo $list['gold_service'];?>">
				<dl>
					<dt>
						<a href="./detail.html?no=<?php echo $no;?>"><span class="photo"><img src="<?php echo $thumb_file_list;?>" alt="사진" style="width:70px;height:91px;"></span></a> 
					</dt>
					<dd class="name_wrap">
						<span class="name"><?php echo $list['wr_name'];?></span>
						<span>(<?php echo $list['wr_gender'];?><?php echo $list['wr_age'];?>)</span>
					</dd>
					<dd class="text1"><a href="./detail.html?no=<?php echo $no;?>" class=""><?php echo $list['subject'];?></a></dd>
				</dl>
			</li>
<?php
			}	// for end.

		break;
		
		## 서브 일반 인재정보
		case 'sub_individual':

			$sub_individual_total = $mobile_info['wr_sub_individual_total'];
			$sub_individual_page = $mobile_info['wr_sub_individual_page'];

			$sub_individual_con = " where `wr_open` = 1 and `wr_report` = 0 and `is_delete` = 0 ";

			$sub_individual_list = $mobile_control->alba_resume_listing( $page, $sub_individual_page, $sub_individual_con, $sub_individual_total );
			$sub_individual_list_count = count($sub_individual_list['result']);

			$sub_individual_total_page = $sub_individual_list['total_page'];
			$sub_individual_pages = $mobile_control->get_ajax_paging($sub_individual_page, $page, $sub_individual_total_page, "sub_individual");

			for($i=0;$i<$sub_individual_list_count;$i++){
				$no = $sub_individual_list['result'][$i]['no'];
				$wr_id = $sub_individual_list['result'][$i]['wr_id'];
				$list = $alba_resume_user_control->get_resume_service($no,"",44);
				$get_scrap = $alba_user_control->get_scrap_cnt($member['mb_id'], 'alba_resume', $no, date('Y-m-d'));
?>
			<li class="bth positionR">
				<dl class="resumeList clearfix">
					<dt class="name_wrap"> 
						<a href="./detail.html?no=<?php echo $no;?>">
							<span class="name"><?php echo $list['wr_name'];?></span>
							<?php if($list['wr_photo']){ ?><span class="photo"><img width="16" height="16" src="../images/icon/icon_photo1.gif" class="vb pb2"></span><?php } ?>
							<span class="gender">(<?php echo $list['wr_gender'];?><?php echo $list['wr_age'];?>)</span>
							<span class="career"><?php echo $list['career'];?></span>
						</a> 
					</dt>
					<dd class="text1 positionR" >
						<a href="./detail.html?no=<?php echo $no;?>" class=""><?php echo $list['subject'];?></a>
					</dd>
					<dd class="text2 clearfix positionR">
						<span class="school"><?php echo $list['school_ability'];?></span>
						<span class="add"><?php echo $utility->str_cut($list['wr_area'],18,"");?></span>
						<?php if($list['license']){ ?>
						<span class="license"><em class="payIcon"><?php echo $list['license'];?></em></span>
						<?php } ?>
					</dd>
					<dd class="etc">
						<span class="pay"><em class="number"><?php echo $list['wr_pay'];?></em> 
						<?php if($list['wr_pay']!='추후협의'){ ?>
						<em class="payIcon"><?php echo $list['wr_pay_type'];?></em></span>
						<?php } ?>
					</dd>
					<dd class="scrap" ><!-- bg_color1 -->
						<a onclick="resume_scrap('<?php echo $no;?>');"><img alt="스크랩" src="../images/icon/icon_scrap1.png" class="<?php echo ($get_scrap['cnt'])?'bg_color1':'bg_gray1';?>"></a>
					</dd>
				</dl>
			</li>
<?php
			}	// for end.
		break;


	} // switch end.
?>