<?php
		/*
		* /application/main/views/_load/alba.php
		* @author Harimao
		* @since 2013/08/26
		* @last update 2015/03/24
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

		$list = $alba_user_control->get_alba_list($no);

		switch($mode){

			## 플래티넘 채용정보
			case 'platinum':
?>
				<div class="companyName positionR">
					<h2><a style="color:#fff;" href="../alba/alba_detail.php?no=<?php echo $no;?>"><?php echo stripslashes($get_alba['wr_company_name']);?></a></h2>
					<a class="btn1 positionA" style="top:3px; right:125px; width:120px;" href="../alba/alba_detail.php?no=<?php echo $no;?>">상세모집내용확인</a>
					<a class="btn1 positionA" style="top:3px; right:40px;  width:80px;" href="javascript:alba_scrap('<?php echo $no;?>');">공고 스크랩</a>
					<em class="fr positionA" style="top:6px; right:6px;"><a href="javascript:platinum_close();"><img class="vm" src="../images/icon/icon_close3.gif" alt="close" /></a></em>
				</div>
				<div class="titleArea positionR">
					<p class="title"><strong><a href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><?php echo $list['subject'];?></a></strong></p>
					<p class="desc"><?php echo $list['job_type'];?></p>
					<div style="bottom:5px; right:5px;" class="icons positionA">
						<div><a id="" class="window" href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
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
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView4.gif" alt="복리후생"></strong> <?php echo $wr_welfare_read;?> 
					</li>
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

			## 프라임 채용정보
			case 'prime':
?>
				<div class="companyName positionR">
					<h2><a style="color:#fff;" href="../alba/alba_detail.php?no=<?php echo $no;?>"><?php echo stripslashes($get_alba['wr_company_name']);?></a></h2>
					<a class="btn1 positionA" style="top:3px; right:125px; width:120px;" href="../alba/alba_detail.php?no=<?php echo $no;?>">상세모집내용확인</a>
					<a class="btn1 positionA" style="top:3px; right:40px;  width:80px;" href="javascript:alba_scrap('<?php echo $no;?>');">공고 스크랩</a>
					<em class="fr positionA" style="top:6px; right:6px;"><a href="javascript:prime_close();"><img class="vm" src="../images/icon/icon_close3.gif" alt="close" /></a></em>
				</div>
				<div class="titleArea positionR">
					<p class="title"><strong><a href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><?php echo $list['subject'];?></a></strong></p>
					<p class="desc"><?php echo $list['job_type'];?></p>
					<div style="bottom:5px; right:5px;" class="icons positionA">
						<div><a id="" class="window" href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
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
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView4.gif" alt="복리후생"></strong> <?php echo $wr_welfare_read;?> 
					</li>
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

			## 그랜드 채용정보
			case 'grand':
?>
				<div class="companyName positionR">
					<h2><a style="color:#fff;" href="../alba/alba_detail.php?no=<?php echo $no;?>"><?php echo stripslashes($get_alba['wr_company_name']);?></a></h2>
					<a class="btn1 positionA" style="top:3px; right:125px; width:120px;" href="../alba/alba_detail.php?no=<?php echo $no;?>">상세모집내용확인</a>
					<a class="btn1 positionA" style="top:3px; right:40px;  width:80px;" href="javascript:alba_scrap('<?php echo $no;?>');">공고 스크랩</a>
					<em class="fr positionA" style="top:6px; right:6px;"><a href="javascript:grand_close();"><img class="vm" src="../images/icon/icon_close3.gif" alt="close" /></a></em>
				</div>
				<div class="titleArea positionR">
					<p class="title"><strong><a href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><?php echo $list['subject'];?></a></strong></p>
					<p class="desc"><?php echo $list['job_type'];?></p>
					<div style="bottom:5px; right:5px;" class="icons positionA">
						<div><a id="" class="window" href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
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
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView4.gif" alt="복리후생"></strong> <?php echo $wr_welfare_read;?> 
					</li>
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
					<h2><a style="color:#fff;" href="../alba/alba_detail.php?no=<?php echo $no;?>"><?php echo stripslashes($get_alba['wr_company_name']);?></a></h2>
					<a class="btn1 positionA" style="top:3px; right:125px; width:120px;" href="../alba/alba_detail.php?no=<?php echo $no;?>">상세모집내용확인</a>
					<a class="btn1 positionA" style="top:3px; right:40px;  width:80px;" href="javascript:alba_scrap('<?php echo $no;?>');">공고 스크랩</a>
					<em class="fr positionA" style="top:6px; right:6px;"><a href="javascript:banner_close();"><img class="vm" src="../images/icon/icon_close3.gif" alt="close" /></a></em>
				</div>
				<div class="titleArea positionR">
					<p class="title"><strong><a href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><?php echo $list['subject'];?></a></strong></p>
					<p class="desc"><?php echo $list['job_type'];?></p>
					<div style="bottom:5px; right:5px;" class="icons positionA">
						<div><a id="" class="window" href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
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
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView4.gif" alt="복리후생"></strong> <?php echo $wr_welfare_read;?> 
					</li>
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
					<h2><a style="color:#fff;" href="../alba/alba_detail.php?no=<?php echo $no;?>"><?php echo stripslashes($get_alba['wr_company_name']);?></a></h2>
					<a class="btn1 positionA" style="top:3px; right:125px; width:120px;" href="../alba/alba_detail.php?no=<?php echo $no;?>">상세모집내용확인</a>
					<a class="btn1 positionA" style="top:3px; right:40px;  width:80px;" href="javascript:alba_scrap('<?php echo $no;?>');">공고 스크랩</a>
					<em class="fr positionA" style="top:6px; right:6px;"><a href="javascript:list_close();"><img class="vm" src="../images/icon/icon_close3.gif" alt="close" /></a></em>
				</div>
				<div class="titleArea positionR">
					<p class="title"><strong><a href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><?php echo $list['subject'];?></a></strong></p>
					<p class="desc"><?php echo $list['job_type'];?></p>
					<div style="bottom:5px; right:5px;" class="icons positionA">
						<div><a id="" class="window" href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
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
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView4.gif" alt="복리후생"></strong> <?php echo $wr_welfare_read;?> 
					</li>
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

			## 19금 리스트형 채용정보
			case 'adult_list':
?>
				<div class="companyName positionR">
					<h2><a style="color:#fff;" href="../alba/alba_detail.php?no=<?php echo $no;?>"><?php echo stripslashes($get_alba['wr_company_name']);?></a></h2>
					<a class="btn1 positionA" style="top:3px; right:125px; width:120px;" href="../alba/alba_detail.php?no=<?php echo $no;?>">상세모집내용확인</a>
					<a class="btn1 positionA" style="top:3px; right:40px;  width:80px;" href="javascript:alba_scrap('<?php echo $no;?>');">공고 스크랩</a>
					<em class="fr positionA" style="top:6px; right:6px;"><a href="javascript:adult_list_close();"><img class="vm" src="../images/icon/icon_close3.gif" alt="close" /></a></em>
				</div>
				<div class="titleArea positionR">
					<p class="title"><strong><a href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><?php echo $list['subject'];?></a></strong></p>
					<p class="desc"><?php echo $list['job_type'];?></p>
					<div style="bottom:5px; right:5px;" class="icons positionA">
						<div><a id="" class="window" href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
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
					<li>
						<strong><img width="43" height="14" src="../images/icon/ico_job_quickView4.gif" alt="복리후생"></strong> <?php echo $wr_welfare_read;?> 
					</li>
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
			## 포커스 인재정보
			case 'focus':

				$list = $alba_resume_user_control->get_resume_service($no,"","", 100, 130);

				/* 희망지역 */
				$wr_area_0 = "";
				if($list['wr_area0']){
					$wr_area_0 .= $category_control->get_categoryCodeName($list['wr_area0']);
				}
				if($list['wr_area1']){
					$wr_area_0 .= " > " . $category_control->get_categoryCodeName($list['wr_area1']);
				}
				$wr_area_1 = "";
				if($list['wr_area2']){
					$wr_area_1 .= $category_control->get_categoryCodeName($list['wr_area2']);
				}
				if($list['wr_area3']){
					$wr_area_1 .= " > " . $category_control->get_categoryCodeName($list['wr_area3']);
				}
				$wr_area = $wr_area_0;
				if($wr_area_1 != '' ){
					$wr_area .= ", ".$wr_area_1;
				}
				$wr_areas = $wr_area;
				/* // 희망지역 */
				
				$wr_date = $category_control->get_categoryCodeName($list['wr_date']);

				// 알바 이력서 열람 정보 저장
				$get_resume = $alba_individual_control->get_resume_no($no);	// 이력서 정보
				$alba_company_control->open_insert($no,$get_resume['wr_id'],"alba");

?>
				<div class="personName positionR">
					<h2 style="color:#fff;"><?php echo $list['name'];?>(<?php echo $list['wr_gender'];?>, <?php echo $list['wr_age'];?>세)</h2>
					<a class="btn1 positionA" style="top:3px; right:125px; width:120px;" href="../resume/alba_resume_detail.php?no=<?php echo $no;?>">이력서 상세보기</a>
					<a class="btn1 positionA" style="top:3px; right:40px;  width:80px;" href="javascript:resume_scrap('<?php echo $no;?>');">공고 스크랩</a>
					<em class="fr positionA" style="top:6px; right:6px;"><a href="javascript:focus_close();"><img class="vm" src="../images/icon/icon_close3.gif" alt="close" /></a></em>
				</div>
				<div class="infoArea clearfix">
					<div class="photo pr20"><?php echo $list['wr_photo'];?></div>
					<ul class="detailItem">
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView1.gif" alt="희망근무지역"> <span><?php echo $wr_areas;?></span></li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView2.gif" alt="희망 근무직종"> <?php echo $list['job_type'];?></li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView3.gif" alt="희망 근무기간"> <?php echo $wr_date;?></li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView4.gif" alt="학력사항"> <?php echo $list['school_ability'];?> </li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView5.gif" alt="경력사항"> <?php echo $list['wr_career'];?></li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView6.gif" alt="자격증"> <?php echo $list['license'];?></li>
					</ul>
				</div> 
<?php
			break;

		}	// switch end.
?>