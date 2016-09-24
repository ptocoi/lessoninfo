<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var mode = "<?php echo $mode;?>";
var send_url = "<?php echo $list_list['send_url'];?>";
</script>

<script type="text/javascript" src="<?php echo $alice['alba_path'];?>/skins/default/index.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['alba_path'];?>/">채용정보</a> > <a href="<?php echo $alice['alba_path'];?>/alba_list.php">일반 채용정보</a> > <strong>오늘의 채용정보</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<!--  오늘의 정규직 정보 검색영역 -->
		<div class="listWrap mt20">
			<h2 class=""><img src="../images/tit/job_tit_05.gif" width="130" height="21" alt="오늘의 정규직 정보"></h2>
			<div class="jobContentWrap positionR mt10 clearfix" style="border-top:3px solid #404660;">
				<?php include_once "./views/_include/search.php";?>
			</div>
		</div>
		<!--  // 오늘의 정규직 정보 검색영역 -->

		<!--  일반채용   --> 
		<div id="JobListForm" class="positionR mt30 clearfix">
			<h2 class="clearfix">
				<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 일반채용정보</strong>
				<em class="pl10"><?php echo number_format($list_list['total_count']);?>건</em>
			</h2>
			<div class="ListFunc positionA" style="top:-5px; right:0;">
				<span class="choiceLink pr5">
					<span class="Link1"><a href="./alba_list.php?<?php echo $list_list['send_url'];?>&view_type=list"><img width="25" height="19" alt="" src="../images/icon/icon_choiceLink1_<?php echo (!$view_type||$view_type=='list')?'on':'off';?>.gif" class="vb" id="choiceLink_list"></a></span>
					<span class="Link2"><a href="./alba_list.php?<?php echo $list_list['send_url'];?>&view_type=gallery"><img width="25" height="19" alt="" src="../images/icon/icon_choiceLink2_<?php echo ($view_type=='gallery')?'on':'off';?>.gif" class="vb" id="choiceLink_gallery"></a></span>
				</span>
				<span>
					<select title="pagesize" name="sort" style="width:100px;" class="ipSelect2" onchange="list_sorting(this,'alba_list');">
					<option value="wr_wdate" <?php echo ($sort=='wr_wdate')?'selected':'';?>>최근등록순</option>
					<option value="wr_volume_date" <?php echo ($sort=='wr_volume_date')?'selected':'';?>>마감임박순</option>
					</select>
				</span>
				<span>
					<select title="pagesize" name="page_rows" style="width:100px;" class="ipSelect2" onchange="list_rows(this,'alba_list');">
					<option value="20" <?php echo ($page_rows=='20')?'selected':'';?>>20개씩 보기</option>
					<option value="30" <?php echo ($page_rows=='30')?'selected':'';?>>30개씩 보기</option>
					<option value="50" <?php echo ($page_rows=='50')?'selected':'';?>>50개씩 보기</option>
					</select>
				</span>
			</div>
			</span>

			<?php if(!$view_type || $view_type=='list'){?>
			<div id="list_view">
				<!--  일반보기  -->   
				<table cellspacing="0" summary="정규직 정보입니다">
				<caption class="skip">일반채용</caption>
				<colgroup><col width="90px"><col width="50px"><col width="*"><col width="110px"><col width="60px"><col width="90px"><col width="55px"><col width="60px">  </colgroup>
				<thead>
				<tr>
					<th class="local" scope="col">근무지</th>
					<th class="icons" scope="col"></th>
					<th class="title" scope="col">채용제목</th>
					<th class="company" scope="col">병원명</th>
					<th class="gender" scope="col">성별</th>
					<th class="pay" scope="col">급여</th>
					<th class="date" scope="col">등록일</th>
					<th class="finish" scope="col" width="60px">마감일</th>
				</tr>
				</thead>
				<tbody>
				<?php 
				if($list_list['result']){
					foreach($list_list['result'] as $key => $val){ 
					$no = $val['no'];
					$lists = $alba_user_control->get_alba_service($no,"sub_list",49);
					$wdate = strtr($lists['datetime3'],"-","/");
				?>
				<tr id="list_<?php echo $no;?>" style="display:;">
					<td class="local"><?php echo $utility->str_cut($lists['wr_area'],19,"");?></td>
					<td  class="icons">
						<div><a class="window" href="./alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
						<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
						<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png" class="bg_orang"></a></div>
						<?php } ?>
						<div><a class="plus" href="javascript:list_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png" class="bg_orang"></a></div>
					</td>        
					<td class="title"><?php echo $lists['service_busy'];?><?php echo $lists['service_icon'];?><a href="./alba_detail.php?no=<?php echo $no;?>"><span><?php echo $lists['subject'];?> </span></a></td>
					<td class="company"><a href="./alba_detail.php?no=<?php echo $no;?>"><span><?php echo $lists['company_name'];?> </span></a></td>
					<td class="gender"><?php echo $lists['wr_gender'];?>&nbsp;</td>
					<td class="pay">
						<?php 
						if(!$lists['wr_pay'] || $lists['wr_pay']==0){ 
							echo "협의";
						} else { 
						?>
						<span class="number"><?php echo $lists['wr_pay'];?>원</span>
						<em class="icon"><?php echo $lists['wr_pay_type'];?></em>
						<?php } ?>
					</td>
					<td class="date"><?php echo $wdate;?></td>
					<td class="finish"><?php echo $lists['volume'];?></td>
				</tr>
				<?php 
					} // foreach end.
				} else {
				?>
				<tr><td colspan="8" class="tc no_listText"><span>채용정보가 없습니다.</span></td></tr>
				<?php } // if end.?>

				</tbody>
				</table>
				<!--  // 일반보기 --> 
			</div>

			<!-- view layer -->
			<div class="quickView clearfix positionA" style="display:none; left:5px; z-index:2000;" id="list_quickView"></div>
			<!-- // view layer -->

			<?php } else if($view_type=='gallery'){ ?>

			<div id="gallery_view">
			<?php 
			if($list_list['result']){
				foreach($list_list['result'] as $key => $val){ 
				$no = $val['no'];
				$list = $alba_user_control->get_alba_list($no);

				$biz_foundation = $category_control->get_categoryCode('20130626171611_2769');	// 설립일
				$biz_sale = $category_control->get_categoryCode('20130626172556_1808');	 // 매출액
				$biz_member_count = $category_control->get_categoryCode('20130626172544_6551');	 // 사원수
				$form_option = $category_control->get_categoryCode('20130626171524_3156');	// 병원형태

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
					$biz_form_option = ($list['biz_form_option']) ? "<li>병원형태 : ".$list['biz_form_option']."</li>" : "";
				}
			?>
				<div class="quickView clearfix">
					<div class="leftView positionR">
						<p class="logo"> 
							<span class="spacer"></span> 
							<a target="blank" href="./alba_detail.php?no=<?php echo $no;?>"><?php echo $list['wr_logo'];?></a> 
						</p>
						<p class="companySubject pt10"> <strong><?php echo stripslashes($get_alba['wr_company_name']);?></strong></p>
						<ul class="companyDesc pt5">
							<?php echo $mb_biz_foundation;?>
							<?php echo $mb_biz_sale;?>
							<?php echo $mb_biz_member_count;?>
							<?php echo $biz_form_option;?>
						</ul>
						<?//php if($member['mb_type'] != 'company' && $list['is_online']){	// 개인회원만 온라인입사지원 가능 ( 온라인, 이메일 )?>
						<div class="tag mt20">
							<a href="javascript:online_becomes('<?php echo $no;?>','<?php echo $list['wr_requisition']?>');"><img width="145" height="42" alt="온라인입사지원" src="../images/basic/btn_online1.gif"></a>
						</div>
						<?//php } ?>
					</div>

					<div class="contView">
						<div class="titleArea positionR">
							<p class="title"><strong><a target="_blank" href="./alba_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?></a></strong></p>
							<p class="desc"><?php echo $list['job_type'];?></p>
							<div class="icons positionA" style="bottom:5px; right:5px;">
								<div><a target="_blank" href="./alba_detail.php?no=<?php echo $no;?>" class="window" id=""><img width="13" height="13" class="bg_orang" src="../images/icon/icon_newWindow.png" alt="새창으로 열기"></a></div>
								<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
								<div><a href="javascript:alba_scrap('<?php echo $no;?>');" class="star" id=""><img width="13" height="13" class="bg_orang" src="../images/icon/icon_star.png" alt="공고스크랩"></a></div>
								<?php } ?>
							</div>
						</div>
						<div class="infoArea">
							<ul class="detailItem">
								<li>
									<strong><img alt="근무지역" src="../images/icon/ico_job_quickView1.gif" width="43" height="14"></strong> 
									<?php echo $list['job_subway'];?>
									<span class="district" title="<?php echo $list['job_area'];?>"><?php echo $list['job_area'];?></span>
								</li>

								<li><strong><img alt="근무기간" src="../images/icon/ico_job_quickView2.gif" width="43" height="14"></strong> <?php echo $list['wr_date'];?></li>
								<li><strong><img alt="근무요일" src="../images/icon/ico_job_quickView3.gif" width="43" height="14"></strong> <?php echo $list['wr_week'];?>, <?php echo $list['wr_time'];?> </li>
								<?php if($list['welfare_read']){ ?>
								<li><strong><img alt="복리후생" src="../images/icon/ico_job_quickView4.gif" width="43" height="14"></strong> <?php echo $list['welfare_read'];?> </li>
								<?php } ?>
								<li><strong><img alt="마감일" src="../images/icon/ico_job_quickView5.gif" width="43" height="14"></strong> <?php echo $list['volume_date']['text'];?> </li>
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
										<em class="icon"><?php echo $list['wr_pay_type'];?></em> <em class="number"><?php echo $list['wr_pay'];?>원</em>
										</span>
									</dd>
									</div>
								</li>
								<li> 
									<div class="boxTxt">
									<strong>성별</strong> 
									<span class="txt"><?php echo $list['wr_gender'];?></span> 
									</div>
								</li>
								<li> 
									<div class="boxTxt">
									<strong>연령</strong>
									<span class="txt"><?php echo $list['age']['result'];?><?php echo ($list['age']['etc'])?"<p>[".$list['age']['etc']."]</p>":'';?></span> 
									</div>
								</li>
								<li class="shape"> 
									<div class="boxTxt">
									<strong>모집인원</strong> 
									<span class="txt"><?php echo $list['volmue'];?></span> 
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			<?php 
				} // foreach end.
			} else {	
			?>
				<div class="quickView clearfix"><div class="tc no_listText">채용정보가 없습니다.</div></div></div>
			<?php } // if end.?>
			</div>

			<?php } // view_type if end. ?>

			<?php include_once $alice['include_path']."/paging.php";?>
		</div>
		<!-- // 일반채용 --> 

		</div>
	</div>
</section>