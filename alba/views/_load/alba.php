<?php
		/*
		* /application/alba/views/_load/alba.php
		* @author Harimao
		* @since 2013/08/26
		* @last update 2015/04/10
		* @Module v3.5 ( Alice )
		* @Brief :: Alba detail
		* @Comment :: 채용정보 상세보기
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$no = $_POST['no'];

		$get_alba = $alba_user_control->get_alba_no($no);

		// 직종
		$job_type_arr = array( "job_type0" => $get_alba['wr_job_type0'], "job_type1" => $get_alba['wr_job_type1'], "job_type2" => $get_alba['wr_job_type2'] );
		$job_type = $alba_user_control->list_type($job_type_arr);

		// 역세권
		$subway_arr = array( 
			"subway_area_0" => array( "subway_area" => $get_alba['wr_subway_area_0'], "subway_line" => $get_alba['wr_subway_line_0'], "subway_station" => $get_alba['wr_subway_station_0'], "subway_content" => $get_alba['wr_subway_content_0'] ),
			"subway_area_1" => array( "subway_area" => $get_alba['wr_subway_area_1'], "subway_line" => $get_alba['wr_subway_line_1'], "subway_station" => $get_alba['wr_subway_station_1'], "subway_content" => $get_alba['wr_subway_content_1'] ),
			"subway_area_2" => array( "subway_area" => $get_alba['wr_subway_area_2'], "subway_line" => $get_alba['wr_subway_line_2'], "subway_station" => $get_alba['wr_subway_station_2'], "subway_content" => $get_alba['wr_subway_content_2'] )
		);
		$job_subway = $alba_user_control->list_subway($subway_arr);

		// 지역
		$area_arr = array( "area_0" => $get_alba['wr_area_0'], "area_1" => $get_alba['wr_area_1'], "area_2" => $get_alba['wr_area_2'] );
		$job_area = $alba_user_control->list_area_info($area_arr);

		$wr_date = $category_control->get_categoryCodeName($get_alba['wr_date']);		// 근무날짜
		$wr_week = $category_control->get_categoryCodeName($get_alba['wr_week']);	// 근무주일

		// 근무시간
		$wr_stime = $get_alba['wr_stime'];
		$wr_etime = $get_alba['wr_etime'];
		$wr_time_conference = $get_alba['wr_time_conference'];

		$wr_time = ($wr_time_conference) ? "시간협의" : $wr_stime . " ~ " . $wr_etime;
		$wr_welfare_read = stripslashes($get_alba['wr_welfare_read']);

		// 모집일
		$volume_arr = array( "volume_date" => $get_alba['wr_volume_date'], "volume_always" => $get_alba['wr_volume_always'], "volume_end" => $get_alba['wr_volume_end'] );
		$volume_date = $alba_user_control->volume_date($volume_arr);

		$wr_pay_type = $category_control->get_categoryCodeName($get_alba['wr_pay_type']);	// 급여조건
		$wr_pay = number_format($get_alba['wr_pay']);
		$wr_pay_conference = $get_alba['wr_pay_conference'];	// 협의가능

		$wr_gender = $alba_user_control->gender_val[$get_alba['wr_gender']];	 // 성별

		// 연령
		$age_arr = array( "age_limit" => $get_alba['wr_age_limit'], "age" => $get_alba['wr_age'], "age_etc" => $get_alba['wr_age_etc'] );
		$age = $alba_user_control->list_age($age_arr);

		// 모집인원
		$volume_arr = array( "volume" => $get_alba['wr_volume'], "volumes" => $get_alba['wr_volumes'] );
		$volmue = $alba_user_control->list_volume($volume_arr);

		$company_info = $user_control->get_member_company($get_alba['wr_id']);	// 기업회원 정보

		// 기업회원 로고
		if($get_alba['input_type']=='self'){
			$mb_logo_file = $alice['data_alba_path'] . '/' . $get_alba['etc_0'];
			$mb_logo = (is_file($mb_logo_file)) ? "../data/alba/".$get_alba['etc_0'] : "../images/basic/bg_noLogo.gif";	 // 기업회원 로고 사진
		} else {
			$mb_logo_file = $alice['data_member_path']."/".$company_info['mb_id']."/logo/".$company_info['mb_logo'];
			$mb_logo = (is_file($mb_logo_file)) ? "../data/member/".$company_info['mb_id']."/logo/".$company_info['mb_logo'] : "../images/basic/bg_noLogo.gif";	 // 기업회원 로고 사진
		}

		$resume_list = $alba_individual_control->get_resume_list($member['mb_id']);	// 개인회원 이력서

		switch($mode){

			## 플래티넘 채용정보
			case 'platinum':

?>
				<div class="companyName positionR">
					<h2><a style="color:#fff;" href="./alba_detail.php?no=<?php echo $no;?>"><?php echo stripslashes($get_alba['wr_company_name']);?></a></h2>
					<a class="btn1 positionA" style="top:3px; right:125px; width:120px;" href="./alba_detail.php?no=<?php echo $no;?>">상세모집내용확인</a>
					<a class="btn1 positionA" style="top:3px; right:40px;  width:80px;" href="javascript:alba_scrap('<?php echo $no;?>');">공고 스크랩</a>
					<em class="fr positionA" style="top:6px; right:6px;"><a href="javascript:platinum_close();"><img class="vm" src="../images/icon/icon_close3.gif" alt="close" /></a></em>
				</div>
				<div class="titleArea positionR">
					<p class="title"><strong><a href="./alba_detail.php?no=<?php echo $no;?>" target="_blank"><?php echo stripslashes($get_alba['wr_subject']);?></a></strong></p>
					<p class="desc"><?php echo $job_type;?></p>
					<div style="bottom:5px; right:5px;" class="icons positionA">
						<div><a class="window" href="./alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
						<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png" class="bg_orang"></a></div>
					</div>
				</div>
				<div class="infoArea">
					<ul class="detailItem">
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView1.gif" alt="근무지역"></strong> 
						<?php echo $job_subway;?>
						<span title="<?php echo $job_area;?>"><?php echo $job_area;?></span>
					</li>
					<li><strong><img width="43" height="14" src="../images/icon/ico_job_quickView2.gif" alt="근무기간"></strong> <?php echo $wr_date;?></li>
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView3.gif" alt="근무요일"></strong> <?php echo $wr_week;?>, <?php echo $wr_time;?>
					</li>
					<?php if($wr_welfare_read){ ?>
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView4.gif" alt="복리후생"></strong> <?php echo $wr_welfare_read;?> 
					</li>
					<?php } ?>
					<li><strong><img width="43" height="14" src="../images/icon/ico_job_quickView5.gif" alt="마감일"></strong><?php echo $volume_date['text'];?></li>
					</ul>
				</div> 
				<div class="item clearfix">
					<ul>
					<li class="first">
						<div class="boxTxt">
							<strong>급여조건</strong> 
							<span class="txt">
								<dd class="text2 clearfix">
								<span class="pay">
									<?php 
									if(!$wr_pay || $wr_pay==0){ 
										echo "협의";
									} else { 
									?>
									<em class="icon"><?php echo $wr_pay_type;?></em> <em class="number"><?php echo $wr_pay;?></em>원
									<?php } ?>
								</span>
								</dd>
							</span>
						</div>
					</li>
					<li> 
						<div class="boxTxt">
							<strong>성별</strong> 
							<span class="txt"><?php echo $wr_gender;?></span> 
						</div>
					</li>
					<li> 
						<div class="boxTxt">
							<strong>연령</strong>
							<span class="txt"><?php echo $age['result'];?><?php echo ($age['etc'])?"<p>[".$age['etc']."]</p>":'';?></span> 
						</div>
					</li>
					<li class="shape"> 
						<div class="boxTxt">
							<strong>모집인원</strong> 
							<span class="txt"><?php echo $volmue;?></span> 
						</div>
					</li>
					</ul>
				</div>
<?php
			break;

			## 배너형 채용정보
			case 'banner':
?>
				<div class="companyName positionR">
					<h2><a style="color:#fff;" href="./alba_detail.php?no=<?php echo $no;?>"><?php echo stripslashes($get_alba['wr_company_name']);?></a></h2>
					<a class="btn1 positionA" style="top:3px; right:125px; width:120px;" href="./alba_detail.php?no=<?php echo $no;?>">상세모집내용확인</a>
					<a class="btn1 positionA" style="top:3px; right:40px;  width:80px;" href="javascript:alba_scrap('<?php echo $no;?>');">공고 스크랩</a>
					<em class="fr positionA" style="top:6px; right:6px;"><a href="javascript:banner_close();"><img class="vm" src="../images/icon/icon_close3.gif" alt="close" /></a></em>
				</div>
				<div class="titleArea positionR">
					<p class="title"><strong><a href="./alba_detail.php?no=<?php echo $no;?>" target="_blank"><?php echo stripslashes($get_alba['wr_subject']);?></a></strong></p>
					<p class="desc"><?php echo $job_type;?></p>
					<div style="bottom:5px; right:5px;" class="icons positionA">
						<div><a class="window" href="./alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
						<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png" class="bg_orang"></a></div>
					</div>
				</div>
				<div class="infoArea">
					<ul class="detailItem">
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView1.gif" alt="근무지역"></strong> 
						<?php echo $job_subway;?>
						<span title="<?php echo $job_area;?>"><?php echo $job_area;?></span>
					</li>
					<li><strong><img width="43" height="14" src="../images/icon/ico_job_quickView2.gif" alt="근무기간"></strong> <?php echo $wr_date;?></li>
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView3.gif" alt="근무요일"></strong> <?php echo $wr_week;?>, <?php echo $wr_time;?>
					</li>
					<?php if($wr_welfare_read){ ?>
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView4.gif" alt="복리후생"></strong> <?php echo $wr_welfare_read;?> 
					</li>
					<?php } ?>
					<li><strong><img width="43" height="14" src="../images/icon/ico_job_quickView5.gif" alt="마감일"></strong><?php echo $volume_date['text'];?></li>
					</ul>
				</div> 
				<div class="item clearfix">
					<ul>
					<li class="first">
						<div class="boxTxt">
							<strong>급여조건</strong> 
							<span class="txt">
								<dd class="text2 clearfix">
								<span class="pay">
									<?php 
									if(!$wr_pay || $wr_pay==0){ 
										echo "협의";
									} else { 
									?>
									<em class="icon"><?php echo $wr_pay_type;?></em> <em class="number"><?php echo $wr_pay;?></em>원
									<?php } ?>
								</span>
								</dd>
							</span>
						</div>
					</li>
					<li> 
						<div class="boxTxt">
							<strong>성별</strong> 
							<span class="txt"><?php echo $wr_gender;?></span> 
						</div>
					</li>
					<li> 
						<div class="boxTxt">
							<strong>연령</strong>
							<span class="txt"><?php echo $age['result'];?><?php echo ($age['etc'])?"<p>[".$age['etc']."]</p>":'';?></span> 
						</div>
					</li>
					<li class="shape"> 
						<div class="boxTxt">
							<strong>모집인원</strong> 
							<span class="txt"><?php echo $volmue;?></span> 
						</div>
					</li>
					</ul>
				</div>
<?php
			break;

			## 리스트형 채용정보
			case 'list':
?>
				<div class="companyName positionR">
					<h2><a style="color:#fff;" href="./alba_detail.php?no=<?php echo $no;?>"><?php echo stripslashes($get_alba['wr_company_name']);?></a></h2>
					<a class="btn1 positionA" style="top:3px; right:125px; width:120px;" href="./alba_detail.php?no=<?php echo $no;?>">상세모집내용확인</a>
					<a class="btn1 positionA" style="top:3px; right:40px;  width:80px;" href="javascript:alba_scrap('<?php echo $no;?>');">공고 스크랩</a>
					<em class="fr positionA" style="top:6px; right:6px;"><a href="javascript:list_close();"><img class="vm" src="../images/icon/icon_close3.gif" alt="close" /></a></em>
				</div>
				<div class="titleArea positionR">
					<p class="title"><strong><a href="./alba_detail.php?no=<?php echo $no;?>" target="_blank"><?php echo stripslashes($get_alba['wr_subject']);?></a></strong></p>
					<p class="desc"><?php echo $job_type;?></p>
					<div style="bottom:5px; right:5px;" class="icons positionA">
						<div><a class="window" href="./alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
						<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png" class="bg_orang"></a></div>
					</div>
				</div>
				<div class="infoArea">
					<ul class="detailItem">
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView1.gif" alt="근무지역"></strong> 
						<?php echo $job_subway;?>
						<span title="<?php echo $job_area;?>"><?php echo $job_area;?></span>
					</li>
					<li><strong><img width="43" height="14" src="../images/icon/ico_job_quickView2.gif" alt="근무기간"></strong> <?php echo $wr_date;?></li>
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView3.gif" alt="근무요일"></strong> <?php echo $wr_week;?>, <?php echo $wr_time;?>
					</li>
					<?php if($wr_welfare_read){ ?>
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView4.gif" alt="복리후생"></strong> <?php echo $wr_welfare_read;?> 
					</li>
					<?php } ?>
					<li><strong><img width="43" height="14" src="../images/icon/ico_job_quickView5.gif" alt="마감일"></strong><?php echo $volume_date['text'];?></li>
					</ul>
				</div> 
				<div class="item clearfix">
					<ul>
					<li class="first">
						<div class="boxTxt">
							<strong>급여조건</strong> 
							<span class="txt">
								<dd class="text2 clearfix">
								<span class="pay">
									<?php 
									if(!$wr_pay || $wr_pay==0){ 
										echo "협의";
									} else { 
									?>
									<em class="icon"><?php echo $wr_pay_type;?></em> <em class="number"><?php echo $wr_pay;?></em>원
									<?php } ?>
								</span>
								</dd>
							</span>
						</div>
					</li>
					<li> 
						<div class="boxTxt">
							<strong>성별</strong> 
							<span class="txt"><?php echo $wr_gender;?></span> 
						</div>
					</li>
					<li> 
						<div class="boxTxt">
							<strong>연령</strong>
							<span class="txt"><?php echo $age['result'];?><?php echo ($age['etc'])?"<p>[".$age['etc']."]</p>":'';?></span> 
						</div>
					</li>
					<li class="shape"> 
						<div class="boxTxt">
							<strong>모집인원</strong> 
							<span class="txt"><?php echo $volmue;?></span> 
						</div>
					</li>
					</ul>
				</div>
<?php
			break;

			## 일반 채용정보
			case 'basic':

				$list = $alba_user_control->get_alba_list($no);

				$biz_foundation = $category_control->get_categoryCode('20130626171611_2769');	// 설립일
				$biz_sale = $category_control->get_categoryCode('20130626172556_1808');	 // 매출액
				$biz_member_count = $category_control->get_categoryCode('20130626172544_6551');	 // 사원수
				$form_option = $category_control->get_categoryCode('20130626171524_3156');	// 기업형태

				if($biz_foundation['view']=='yes'){
					$mb_biz_foundation = ($list['company_info']['mb_biz_foundation']) ? "<li>설립일 : ".$list['company_info']['mb_biz_foundation']."년 설립(".$list['company_year']."년차)</li>" : "";
				}
				if($biz_sale['view']=='yes'){
					$mb_biz_sale = ($list['company_info']['mb_biz_sale']) ? "<li>매출액 : ".$list['company_info']['mb_biz_sale']."원</li>":"";
				}
				if($biz_member_count['view']=='yes'){
					$mb_biz_member_count = ($list['company_info']['mb_biz_member_count']) ? "<li>사원수 : ".$list['company_info']['mb_biz_member_count']."명</li>" : "";
				}
				if($form_option['view']=='yes'){
					$biz_form_option = ($list['biz_form_option']) ? "<li>기업형태 : ".$list['biz_form_option']."</li>" : "";
				}

?>
				<div class="leftView positionR">
					<p class="logo"> <span class="spacer"></span> <a target="blank" href="./alba_detail.php?no=<?php echo $no;?>"><img width="106" height="42" src="<?php echo $mb_logo;?>" alt="<?php echo stripslashes($get_alba['wr_company_name']);?> 로고"></a> </p>
					<p class="companySubject pt10"> <strong><?php echo stripslashes($get_alba['wr_company_name']);?></strong></p>
					<ul class="companyDesc pt5">
						<?php echo $mb_biz_foundation;?>
						<?php echo $mb_biz_sale;?>
						<?php echo $mb_biz_member_count;?>
						<?php echo $biz_form_option;?>
					</ul>
					<div class="tag mt20"><a href="javascript:online_becomes('<?php echo $no;?>','<?php echo $list['wr_requisition']?>');"><img width="145" height="42" alt="온라인입사지원" src="../images/basic/btn_online1.gif"></a></div>
				</div>

				<div class="contView positionR">
				<em  style="z-index:1; top:-1px; right:-1px; cursor:pointer; display:block;" class="positionA"><a href="javascript:sub_list_close();"><img alt="닫기" src="../images/icon/icon_close.gif"></a></em>
					<div class="titleArea positionR">
						<p class="title"><strong><a target="_blank" href="./alba_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?></a></strong></p>
						<p class="desc"><?php echo $list['job_type'];?></p>
						<div class="icons positionA" style="bottom:5px; right:5px;">
							<div><a class="window" href="./alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
							<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png" class="bg_orang"></a></div>
						</div>
					</div>
					<div class="infoArea">
						<ul class="detailItem">
							<li>
								<strong><img alt="근무지역" src="../images/icon/ico_job_quickView1.gif" width="43" height="14"></strong> 
								<?php echo $job_subway;?>
								<span title="<?php echo $job_area;?>"><?php echo $job_area;?></span>
							</li>
							<li><strong><img alt="근무기간" src="../images/icon/ico_job_quickView2.gif" width="43" height="14"></strong> <?php echo $wr_date;?></li>
							<li><strong><img alt="근무요일" src="../images/icon/ico_job_quickView3.gif" width="43" height="14"></strong> <?php echo $wr_week;?>, <?php echo $wr_time;?> </li>
							<?php if($wr_welfare_read){ ?>
							<li><strong><img alt="복리후생" src="../images/icon/ico_job_quickView4.gif" width="43" height="14"></strong> <?php echo $wr_welfare_read;?> </li>
							<?php } ?>
							<li><strong><img alt="마감일" src="../images/icon/ico_job_quickView5.gif" width="43" height="14"></strong> <?php echo $volume_date['text'];?> </li>
						</ul>
					</div>
					
					<div class="item clearfix">
					<ul>
						<li class="first">
							<div class="boxTxt">
								<strong>급여조건</strong> 
								<span class="txt">
									<dd class="text2 clearfix">
									<span class="pay">
										<?php 
										if(!$wr_pay || $wr_pay==0){ 
											echo "협의";
										} else { 
										?>
										<em class="icon"><?php echo $wr_pay_type;?></em> <em class="number"><?php echo $wr_pay;?></em>원
										<?php } ?>
									</span>
									</dd>
								</span>
							</div>
						</li>
						<li> 
							<div class="boxTxt">
								<strong>성별</strong> 
								<span class="txt"><?php echo $wr_gender;?></span> 
							</div>
						</li>
						<li> 
							<div class="boxTxt">
								<strong>연령</strong>
								<span class="txt"><?php echo $age['result'];?><?php echo ($age['etc'])?"<p>[".$age['etc']."]</p>":'';?></span> 
							</div>
						</li>
						<li class="shape"> 
							<div class="boxTxt">
								<strong>모집인원</strong> 
								<span class="txt"><?php echo $volmue;?></span> 
							</div>
						</li>
					</ul>
					</div>

				</div>
<?php
			break;

			## 메인 하단 채용정보
			case 'basic_list':
?>
				<div class="companyName positionR">
					<h2><a style="color:#fff;" href="../alba/alba_detail.php?no=<?php echo $no;?>"><?php echo stripslashes($get_alba['wr_company_name']);?></a></h2>
					<a class="btn1 positionA" style="top:3px; right:125px; width:120px;" href="../alba/alba_detail.php?no=<?php echo $no;?>">상세모집내용확인</a>
					<a class="btn1 positionA" style="top:3px; right:40px;  width:80px;" href="javascript:alba_scrap('<?php echo $no;?>');">공고 스크랩</a>
					<em class="fr positionA" style="top:6px; right:6px;"><a href="javascript:sub_list_close();"><img class="vm" src="../images/icon/icon_close3.gif" alt="close" /></a></em>
				</div>
				<div class="titleArea positionR">
					<p class="title"><strong><a href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><?php echo stripslashes($get_alba['wr_subject']);?></a></strong></p>
					<p class="desc"><?php echo $job_type;?></p>
					<div style="bottom:5px; right:5px;" class="icons positionA">
						<div><a class="window" href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
						<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png" class="bg_orang"></a></div>
					</div>
				</div>
				<div class="infoArea">
					<ul class="detailItem">
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView1.gif" alt="근무지역"></strong> 
						<?php echo $job_subway;?>
						<span title="<?php echo $job_area;?>"><?php echo $job_area;?></span>
					</li>
					<li><strong><img width="43" height="14" src="../images/icon/ico_job_quickView2.gif" alt="근무기간"></strong> <?php echo $wr_date;?></li>
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView3.gif" alt="근무요일"></strong> <?php echo $wr_week;?>, <?php echo $wr_time;?>
					</li>
					<?php if($wr_welfare_read){ ?>
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView4.gif" alt="복리후생"></strong> <?php echo $wr_welfare_read;?> 
					</li>
					<?php } ?>
					<li><strong><img width="43" height="14" src="../images/icon/ico_job_quickView5.gif" alt="마감일"></strong><?php echo $volume_date['text'];?></li>
					</ul>
				</div> 
				<div class="item clearfix">
					<ul>
					<li class="first">
						<div class="boxTxt">
							<strong>급여조건</strong> 
							<span class="txt">
								<dd class="text2 clearfix">
								<span class="pay">
									<?php 
									if(!$wr_pay || $wr_pay==0){ 
										echo "협의";
									} else { 
									?>
									<em class="icon"><?php echo $wr_pay_type;?></em> <em class="number"><?php echo $wr_pay;?></em>원
									<?php } ?>
								</span>
								</dd>
							</span>
						</div>
					</li>
					<li> 
						<div class="boxTxt">
							<strong>성별</strong> 
							<span class="txt"><?php echo $wr_gender;?></span> 
						</div>
					</li>
					<li> 
						<div class="boxTxt">
							<strong>연령</strong>
							<span class="txt"><?php echo $age['result'];?><?php echo ($age['etc'])?"<p>[".$age['etc']."]</p>":'';?></span> 
						</div>
					</li>
					<li class="shape"> 
						<div class="boxTxt">
							<strong>모집인원</strong> 
							<span class="txt"><?php echo $volmue;?></span> 
						</div>
					</li>
					</ul>
				</div>
<?php
			break;

			## 온라인 입사지원 레이어
			case 'become_online':

				$wr_form = $get_alba['wr_form'];	// 자사양식지원 유무
				$wr_form_required = $get_alba['wr_form_required'];	// 자사양식지원 필수 여부
				$wr_form_attach = explode('/',$get_alba['wr_form_attach']);	// 자사양식 첨부파일
				$file_ext = $utility->get_extension($wr_form_attach[1]);
				$trans_arr = array( ' ' => '_', '  ' => '_');
				$file_name = strtr($get_alba['wr_company_name'],$trans_arr) . "_지원양식_" . $alice['server_time'] . "." . $file_ext;

				$file_list = $alba_file_control->__FileList("",""," where `wr_id` = '".$member['mb_id']."' ");
?>
				<form method="post" name="BecomeFrm" action="./process/become.php" id="BecomeFrm"  enctype="multipart/form-data">
				<input type="hidden" name="mode" value="become_online"/>
				<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
				<input type="hidden" name="no" value="<?php echo $no;?>"/><!-- 공고번호 -->

				<div id="popup" class="positionR content_wrap clearfix">
					<div class="layerPop  border_color5" style="display:block; width:494px; margin:0 auto; text-align:left; ">              
						<dl>
							<dt style="padding:20px 15px;" class="bg_gray1 font18"><strong>온라인 입사지원</strong>
								<em class="closeBtn" onclick="BecomeFrmCancel();"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em>
							</dt>
							<!--  이력서선택   -->                
							<dd style="padding:20px 15px 10px;">
								<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
									<strong>이력서 선택</strong><br/>
								</p>
								<div class="bgBox2 clearfix" >
									<!--  회사자사양식   -->                 
									<ul class="resume2" style="display:block;">
										<li><span>지원 제목</span><input type="text" name="wr_subject" id="wr_subject" class="ipText2" style="width:250px;" hname="지원제목" required></li>
										<li id="user_form" style="display:;">
											<span>이력서선택</span>
											<select class="ipSelect2" style="width:255px;" id="alba_resume" name="alba_resume" title="이력서선택">
											<option value="">선택</option>
											<?php foreach($resume_list as $val){ ?>
											<option value="<?php echo $val['no'];?>"><?php echo stripslashes($val['wr_subject']);?></option>
											<?php } // foreach end.?>
											</select>
										</li>
									</ul>
									<!--  //회사자사양식 -->
								</div>
							</dd>
							<!--  // 이력서선택  -->

							<!--  첨부파일선택  -->
							<dd style="padding:10px 15px 10px;">
								<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
									<strong>첨부파일 직접 등록</strong><br/>
								</p>
								<div class="bgBox clearfix" >
									<input type="file" name="up_file" id="" size="32" style="width:400px; height:20px;" class="txtForm">
								</div>
							</dd>
							<!--  // 첨부파일선택  -->

							<?php if($file_list['total_count']){ ?>
							<!--  첨부파일선택  -->
							<dd style="padding:10px 15px 10px;">
								<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
									<strong>첨부파일 선택</strong><br/>
								</p>
								<div class="bgBox pb5 clearfix" >
								<?php foreach($file_list['result'] as $val){ ?>
									<div class="pb5"><label><input type="checkbox" name="sel_file[]" value="<?php echo $val['no'];?>"/> <?php echo stripslashes($val['wr_source']);?></label></div>
								<?php } ?>
								</div>
							</dd>
							<!--  // 첨부파일선택  -->
							<?php } ?>

							<!--  사전질문  -->
							<?php if($get_alba['wr_pre_question']){ ?>
							<dd style="padding:10px 15px 10px; display:;">
								<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
									<strong>사전질문</strong><br/>
								</p>
								<div class="bgBox clearfix" >
									<dl>
										<dt class="pb5" style="border:none;"><?php echo nl2br(stripslashes($get_alba['wr_pre_question']));?></dt>
										<dd><textarea name="wr_content" class="ipTextarea" id="wr_content" style="width:420px; height:50px; padding:10px;"></textarea></dd>
									</dl>
								</div>
							</dd>
							<?php } ?>
							<!--  //사전질문 -->

							<!--  연락처공개설정   -->                 
							<dd style="padding:10px 15px 10px;">
								<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
									<strong>연락처공개설정</strong><br/>
								</p>
								<div class="bgBox clearfix" >
									<ul>
										<li>
											<input type="checkbox" name="mb_info[]" id="mb_phone" value="mb_phone">
											<label for="mb_phone">전화번호</label>
										</li>
										<li>
											<input type="checkbox" name="mb_info[]" id="mb_hphone" value="mb_hphone">
											<label for="mb_hphone">휴대폰</label>
										</li>
										<li>
											<input type="checkbox" name="mb_info[]" id="mb_email" value="mb_email">
											<label for="mb_email">e-메일</label>
										</li>
										<li>
											<input type="checkbox" name="mb_info[]" id="mb_address" value="mb_address">
											<label for="mb_address">주소</label>
										</li>
										<li>
											<input type="checkbox" name="mb_info[]" id="mb_homepage" value="mb_homepage">
											<label for="mb_homepage">홈페이지</label>
										</li>
									</ul>
								</div>
							</dd>
							<!--  //연락처공개설정 --> 
						</dl>

						<div style="margin:30px auto;" class="doubleBtn clearfix">
							<ul> 
								<li><div class="btn font_white bg_blueBlack"><a href="javascript:BecomeFrmSubmit();">지원<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
								<li><div class="btn font_gray bg_white"><a href="javascript:BecomeFrmCancel();">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
							</ul>
						</div>

					</div>
				</div>

				</form>
<?php
			break;
			
			## 온라인 입사지원 요청 레이어
			case 'become_online_call':

				$wr_phones = false;	// 담당자 연락처
				if( $get_alba['wr_phone'] || $get_alba['wr_hphone']){
					if($get_alba['wr_phone'] && $get_alba['wr_hphone']){	// 둘다 있다면
						$wr_phone = $get_alba['wr_phone'] . "/" . $get_alba['wr_hphone'];
					} else if($get_alba['wr_phone']){
						$wr_phone = $get_alba['wr_phone'];
					} else if($get_alba['wr_hphone']){
						$wr_phone = $get_alba['wr_hphone'];
					}
					$wr_phones = true;
				}

?>
				<form method="post" name="BecomeFrm" action="./process/become.php" id="BecomeFrm">
				<input type="hidden" name="mode" value="become_online_call"/>
				<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
				<input type="hidden" name="no" value="<?php echo $no;?>"/><!-- 공고번호 -->

				<div class="layerPop border_color5" style="width:494px; margin:0 auto; text-align:left; "> 
					<dl>
						<dt style="padding:20px 15px;" class="bg_gray1 font18"><strong>입사지원 요청</strong>
							<em class="closeBtn" onclick="BecomeFrmCancel();"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em> 
						</dt>
						<!--  이력서선택   -->                
						<dd style="padding:20px 15px 10px;">
							<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
								<strong>이력서 선택</strong><br/>
							</p>
							<div class="bgBox2 clearfix" >
								<!--  회사자사양식   -->
								<ul class="resume2" style="display:block;">
									<li>
										<span>이력서선택</span>
										<select class="ipSelect2" style="width:255px;" id="alba_resume" name="alba_resume" title="이력서선택">
										<option value="">선택</option>
										<?php foreach($resume_list as $val){ ?>
										<option value="<?php echo $val['no'];?>"><?php echo stripslashes($val['wr_subject']);?></option>
										<?php } // foreach end.?>
										</select>
									</li>
									<!-- <li><span>채용공고선택</span><?//php echo stripslashes($get_alba['wr_subject']);?></li> -->
									<li>
										<span>채용담당자명</span><?php echo $get_alba['wr_person'];?>
										<input type="hidden" name="wr_person" value="<?php echo $get_alba['wr_person'];?>"/>
									</li>
									<?php if($wr_phones){?>
									<li>
										<span>담당자연락처</span><?php echo $wr_phone;?>
										<input type="hidden" name="wr_phone" value="<?php echo $get_alba['wr_phone'];?>"/>
										<input type="hidden" name="wr_hphone" value="<?php echo $get_alba['wr_hphone'];?>"/>
									</li>
									<?php } ?>
									<?php if($get_alba['wr_email']){ ?>
									<li>
										<span>회신 e-mail</span><?php echo $get_alba['wr_email'];?>
										<input type="hidden" name="wr_email" value="<?php echo $get_alba['wr_email'];?>"/>
									</li>
									<?php } ?>
								</ul>
								<!--  //회사자사양식 -->
							</div>
						</dd>
						<!--  //이력서선택 -->

						<!--  사전질문 -->                 
						<dd style="padding:10px 15px 10px; display:block;">
							<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
								<strong>입사지원 요청내용</strong><br/>
							</p>
							<div class="bgBox clearfix" >
								<textarea name="wr_content" class="ipTextarea" id="wr_content" style="width:420px; height:100px; padding:10px;"></textarea>
							</div>
						</dd>
						<!--  //사전질문 -->
					</dl>

					<div style="margin:30px auto;" class="doubleBtn clearfix">
						<ul> 
							<li><div class="btn font_white bg_blueBlack"><a href="javascript:BecomeFrmSubmit();">전송<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
							<li><div class="btn font_gray bg_white"><a href="javascript:BecomeFrmCancel();">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
						</ul>
					</div>
				</div>

				</form>
<?php
			break;

			## 이메일 입사지원 요청 레이어
			case 'become_email':

				$wr_form = $get_alba['wr_form'];	// 자사양식지원 유무
				$wr_form_required = $get_alba['wr_form_required'];	// 자사양식지원 필수 여부
				$wr_form_attach = explode('/',$get_alba['wr_form_attach']);	// 자사양식 첨부파일
				$file_ext = $utility->get_extension($wr_form_attach[1]);
				$trans_arr = array( ' ' => '_', '  ' => '_');
				$file_name = strtr($get_alba['wr_company_name'],$trans_arr) . "_지원양식_" . $alice['server_time'] . "." . $file_ext;

				$file_list = $alba_file_control->__FileList("",""," where `wr_id` = '".$member['mb_id']."' ");

?>
				<form method="post" name="BecomeFrm" action="./process/become.php" id="BecomeFrm"  enctype="multipart/form-data">
				<input type="hidden" name="mode" value="become_email"/>
				<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
				<input type="hidden" name="no" value="<?php echo $no;?>"/><!-- 공고번호 -->

				<div class="layerPop  border_color5" style="display:block; width:494px; margin:0 auto; text-align:left; ">              
					<dl>
						<dt style="padding:20px 15px;" class="bg_gray1 font18"><strong>e-메일 입사지원</strong>
							<em class="closeBtn" onclick="BecomeFrmCancel();"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em> 
						</dt>

						<!--  이력서선택   -->                
						<dd style="padding:20px 15px 10px;">
							<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
								<strong>이력서 선택</strong><br/>
							</p>
							<div class="bgBox2 clearfix" >
								<!--  회사자사양식   -->                 
								<ul class="resume2" style="display:block;">
									<li>
										<span>이력서양식</span>
										<input type="radio" name="wr_form" value="user" id="wr_form_user" <?php echo ($wr_form_required)?'disabled':'';?> hname="이력서양식" option="radio" required onclick="wr_forms(this);">
										<label for="wr_form_user">회원 이력서</label>
										<?php if($wr_form){?>
										<input type="radio" name="wr_form" value="company" id="wr_form_company" hname="이력서양식" option="radio" required onclick="wr_forms(this);">
										<label for="wr_form_company">회사 자사양식</label>
										<?php } ?>
									</li>
									<li><span>지원 제목</span><input type="text" name="wr_subject" id="wr_subject" class="ipText2" style="width:250px;" hname="지원제목" required></li>
									<li id="user_form" style="display:none;">
										<span>이력서선택</span>
										<select class="ipSelect2" style="width:255px;" id="alba_resume" name="alba_resume" title="이력서선택" hname="이력서" option="select">
										<option value="">선택</option>
										<?php foreach($resume_list as $val){ ?>
										<option value="<?php echo $val['no'];?>"><?php echo stripslashes($val['wr_subject']);?></option>
										<?php } // foreach end.?>
										</select>
									</li>
									<li id="company_form" style="display:none;" class="bbend">
										<span>자사양식다운</span>
										<a href="javascript:file_download('../alba/download.php?no=<?php echo $no;?>','<?php echo $get_alba['wr_form_attach'];?>');"><?php echo $file_name;?></a>
									</li>
									<li id="company_form" style="display:none;" class="bbend">
										<span>자사양식첨부</span>
										<input type="file" name="etc_2" id="etc_2" size="32" style="width:300px; height:20px;" class="txtForm">		
									</li>
									<!-- <li style="display:;" class="bbend"><span>첨부파일</span><input type="file" name="up_file" id="" size="32" style="width:300px; height:20px;" class="txtForm"></li> -->
								</ul>
								<!--  //회사자사양식 -->
							</div>
						</dd>
						<!--  //이력서선택 -->

						<!--  첨부파일선택   -->                 
						<dd style="padding:10px 15px 10px;">
							<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
								<strong>첨부파일 선택</strong><br/>
							</p>
							<div class="bgBox clearfix" >
								<input type="file" name="up_file" id="up_file" size="32" style="width:400px; height:20px;" class="txtForm">
							</div>
						</dd>
						<!--  //첨부파일선택  -->

						<?php if($file_list['total_count']){ ?>
						<!--  첨부파일선택  -->
						<dd style="padding:10px 15px 10px;">
							<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
								<strong>첨부파일 선택</strong><br/>
							</p>
							<div class="bgBox pb5 clearfix" >
							<?php foreach($file_list['result'] as $val){ ?>
								<div class="pb5"><label><input type="checkbox" name="sel_file[]" value="<?php echo $val['no'];?>"/> <?php echo stripslashes($val['wr_source']);?></label></div>
							<?php } ?>
							</div>
						</dd>
						<!--  // 첨부파일선택  -->
						<?php } ?>

						<!--  사전질문  -->
						<?php if($get_alba['wr_pre_question']){ ?>
						<dd style="padding:10px 15px 10px; display:;">
							<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
								<strong>사전질문</strong><br/>
							</p>
							<div class="bgBox clearfix" >
								<dl>
									<dt class="pb5" style="border:none;"><?php echo nl2br(stripslashes($get_alba['wr_pre_question']));?></dt>
									<dd><textarea name="wr_content" class="ipTextarea" id="wr_content" style="width:420px; height:50px; padding:10px;"></textarea></dd>
								</dl>
							</div>
						</dd>
						<?php } ?>
						<!--  //사전질문 -->

						<!--  연락처공개설정   -->                 
						<dd style="padding:10px 15px 10px;">
							<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
								<strong>연락처공개설정</strong><br/>
							</p>
							<div class="bgBox clearfix" >
								<ul>
									<li>
										<input type="checkbox" name="mb_info[]" id="mb_phone" value="mb_phone">
										<label for="mb_phone">전화번호</label>
									</li>
									<li>
										<input type="checkbox" name="mb_info[]" id="mb_hphone" value="mb_hphone">
										<label for="mb_hphone">휴대폰</label>
									</li>
									<li>
										<input type="checkbox" name="mb_info[]" id="mb_email" value="mb_email">
										<label for="mb_email">e-메일</label>
									</li>
									<li>
										<input type="checkbox" name="mb_info[]" id="mb_address" value="mb_address">
										<label for="mb_address">주소</label>
									</li>
									<li>
										<input type="checkbox" name="mb_info[]" id="mb_homepage" value="mb_homepage">
										<label for="mb_homepage">홈페이지</label>
									</li>
								</ul>
							</div>
						</dd>
						<!--  //연락처공개설정 --> 
					</dl>

					<div style="margin:30px auto;" class="doubleBtn clearfix">
						<ul> 
							<li><div class="btn font_white bg_blueBlack"><a href="javascript:BecomeFrmSubmit();">지원<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
							<li><div class="btn font_gray bg_white"><a href="javascript:BecomeFrmCancel();">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
						</ul>
					</div>              
				</div>

				</form>
<?php
			break;

			## 이메일 전달 레이어
			case 'post_email':
?>
				<form method="post" name="MailFrm" action="./process/email.php" id="MailFrm">
				<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
				<input type="hidden" name="no" value="<?php echo $no;?>"/><!-- 공고번호 -->
				<input type="hidden" name="send_mail" value="<?php echo $member['mb_email'];?>"/>

				<div class="layerPop border_color5" style="display:block; width:494px; margin:0 auto; text-align:left; ">              
					<dl>
						<dt style="padding:20px 15px;" class="bg_gray1 font18"><strong>채용정보 e-메일 전달</strong>
							<em class="closeBtn" onclick="alba_mail_close();"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em> 
						</dt>
						<!--  채용정보   -->                
						<dd style="padding:20px 15px 10px;">
							<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
								<strong>채용정보 e-메일 전달</strong><br/>
							</p>
							<div class="bgBox2 clearfix" >
								<ul class="resume3" style="display:block;">
									<li><span>보내는 사람</span><?php echo $member['mb_name'];?></li>
									<li><span>보내는 사람 e-메일</span><?php echo $member['mb_email'];?></li>
									<li><span>받는 사람  e-메일</span><input type="text" name="receive_mail" id="receive_mail" class="ipText2" style="width:250px;"></li>
								</ul>
							</div>
						</dd>
						<dd style="padding:10px 15px 10px; display:block;">
						<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
							<strong>전달메세지</strong><br/>
						</p>
						<div class="bgBox clearfix" >
							<textarea name="content" class="ipTextarea" id="content" style="width:420px; height:50px; padding:10px;"></textarea>
						</div>
						</dd>
					</dl>

					<div style="margin:30px auto;" class="doubleBtn clearfix">
						<ul> 
							<li><div class="btn font_white bg_blueBlack"><a href="javascript:mailFrmSubmit();">전송<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
							<li><div class="btn font_gray bg_white"><a href="javascript:alba_mail_close();">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
						</ul>
					</div>              
				</div>

				</form>
<?php
			break;

		}	// switch end.
?>