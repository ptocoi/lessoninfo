<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/index.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
			<div class="listWrap positionR mt20">
				<h2 class="skip"> 기업서비스 메인페이지</h2>
				
				<div class="companyContentWrap"><!-- 컨텐츠 -->
					
				<form method="post" name="MemberUpdateFrm" action="<?php echo $alice['member_path'];?>/process/regist.php" id="MemberUpdateFrm" enctype="multipart/form-data">
				<input type="hidden" name="ajax" value="true"/>
				<input type="hidden" name="mode" value="logo_upload" id="upload_mode"/>
				<input type="hidden" name="mb_type" value="<?php echo $mb_type;?>"/>
				<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
				<input type="hidden" name="no" value="<?php echo $member['no'];?>"/>
				<input type="hidden" name="company_no" value="<?php echo $company_member['no'];?>"/>

					<!-- 기업정보 -->
					<div class="companyTopBox">
						<table>
						<caption><span class="skip">회사정보출력</span></caption>
						<colgroup><col width="210px"><col width="100px"><col width="*"><col width="100px"><col width="*"></colgroup>
						<tbody>
						<tr>
							<td class="logoWrap" rowspan="5">
								<img src="<?php echo $mb_logo;?>" alt="<?php echo $company_member['mb_company_name'];?> 로고" id="companylogo" style="max-width:200px; max-height:100px;"/>

								<!--  로고등록 창 layer -->
								<div style="display:none; width:420px; top:0; left:25%; text-align:left;" class="layerPop positionA border_color5" id="LogoPop">
									<dl style="">
										<dt class="bg_gray1" style="padding:20px 15px;">
											<strong>로고 등록</strong>
											<em class="closeBtn" onclick="logo_close();"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em>
										</dt>
										<dd style="padding:10px 15px;">
										<p style="padding-bottom:20px;"><strong>GIF,JPEG,JPG</strong> 파일형식으로,<br>
											<strong>200*100픽셀, 100KB</strong> 용량 이내의 파일만 등록 가능합니다.<br></p>
											<div style="border:1px solid #ddd; padding:10px;" class="box2">
												<input type="file" class="txtForm" style="height:20px;" size="32" id="mb_logo" name="mb_logo">
											</div>
											<div class="btn font_gray bg_white" style="margin:20px auto;">
												<a href="javascript:logo_submit();">등록하기<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a>
											</div>
										</dd>
									</dl>
								</div> 
								<!--  //로고등록 창 layer -->
							</td>
							<td colspan="4">
								<strong class="title text_color1"><?php echo $company_member['mb_company_name'];?>(<?php echo $member['mb_id'];?>)님</strong> 반갑습니다.!
								<em class="positionA" style="top:6px; right:5px;"><a class="button white" href="<?php echo $alice['member_path'];?>/update_form.php"><span>기업정보수정</span></a></em>
							</td>
						</tr>
						<tr>
							<th scope="row"> <label>대표자명</label></th>
							<td><?php echo $company_member['mb_ceo_name'];?></td>
							<?php if($biz_member_count['view']=='yes'){ ?>
							<th scope="row"> <label>사원수</label></th>
							<td><?php echo $company_member['mb_biz_member_count'];?>명</td>
							<?php } else { ?>
							<th scope="row" colspan="2"></th>
							<?php } ?>
						</tr>
						<tr>
							<?php if($biz_stock['view']=='yes'){ ?>
							<th scope="row"> <label>자본금</label></th>
							<td><?php echo $company_member['mb_biz_stock'];?>원</td>
							<?php } ?>
							<?php if($biz_sale['view']=='yes'){ ?>
							<th scope="row"> <label>매출액</label></th>
							<td><?php echo $company_member['mb_biz_sale'];?>원</td>
							<?php } ?>
						</tr>
						<tr>
						<?php if($biz_content['view']=='yes'){ ?>
							<th scope="row"><label>사업내용</label></th>
							<td colspan="3"><?php echo $company_member['mb_biz_content'];?></td>
						<?php } ?>
						</tr>
						<tr>
							<th scope="row"> <label>회사주소</label></th>
							<td colspan="3">[<?php echo $member['mb_zipcode'];?>] <?php echo $member['mb_address0']." ".$member['mb_address1'];?></td>
						</tr>
						<tr>
							<td class="Btn">
								<a class="button white" onclick="logo_pop();"><span id="companyphoto_status"><?php echo ($company_member['mb_logo'])?'수정':'등록';?><img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a>
								<span id="logo_remove" style="display:<?php echo ($company_member['mb_logo'])?'':'none';?>;">
								<a class="button white" onclick="logo_remove('<?php echo $company_member['no'];?>');"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a>
								</span>
								<?php if($biz_homepage['view']=='yes') { ?>
									<?php if($member['mb_homepage']){ ?>
									<div class="url mt10"><a href="<?php echo $utility->add_http($member['mb_homepage']);?>" target="_blank"><?php echo $utility->add_http($member['mb_homepage']);?></a></div>
									<?php } ?>
								<?php } ?>
							</td>
							<td class="summaryWrap brend" colspan="4">
								<div class="summaryBox">
								<dl style="*margin-left:-2px;">
									<dt><strong>진행중인 채용공고</strong></dt>
									<dd><span class="text"><a class="url text_color1" href="./alba_list.php"><?php echo number_format($continue_cnt);?></a></span>건</dd>
								</dl>
								<dl>
									<dt><strong>마감된 채용정보</strong></dt>
									<dd><span class="text"><a class="url text_color1" href="./alba_list.php?type=finish"><?php echo number_format($end_cnt);?></a></span>건</dd>
								</dl>
								<dl>
									<dt><strong>입사지원한 인재정보</strong></dt>
									<dd><span class="text"><a class="url text_color1" href="./alba_apply_list.php"><?php echo number_format($apply_cnt);?></a></span>건</dd>
								</dl>
								<dl>
									<dt><strong>스크랩한 인재정보</strong></dt>
									<dd><span class="text"><a class="url text_color1" href="./alba_scrap.php"><?php echo number_format($scrap_cnt);?></a></span>건</dd>
								</dl>
								</div>
							</td>
						</tr>
						</tbody>
						</table>
					</div>
					<!-- //기업정보 -->

				</form>

					<!--  채용공고   --> 
					<div id="listForm" class="mainTab positionR mt30 clearfix">
						<h2 class="skip">채용공고</h2>
						<ul class="tabMenu clearfix">
							<li class="tab1 on"><a href="javascript:tabs('tab1');"><strong>진행중인 채용공고</strong></a></li>
							<li class="tab2"><a href="javascript:tabs('tab2');"><strong>마감된 채용공고</strong></a></li>
						</ul>  
						<em style="top:10px; right:0;" class="positionA"><a class="button white" href="./alba_regist.php"><span>채용공고 등록</span></a></em>   

						<div id="tab1" class="tabs" style="display:block;">
						<table cellspacing="0">
						<caption class="skip">진행중인 채용공고</caption>
						<colgroup><col width="*"><col width="230px"><col width="90px"><col width="90px"><col width="90px"></colgroup>
						<thead>
						<tr>
							<th scope="col">채용공고</th>
							<th scope="col">유료서비스</th>
							<th scope="col">지원자수</th>
							<th scope="col">작성일</th>
							<th scope="col">마감일</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							foreach( $continue_list['result'] as $val){ 
							$wdate = strtr(substr($val['wr_wdate'],0,11),'-','.');
							$job_type = @implode($alba_company_control->print_job_type($val),', ');
							$desire = number_format($val['wr_desire']);
							$end_day = $alba_company_control->print_end_day($val);

							$service_valid = $alba_company_control->service_valid($val['no']);
							$service_platinum = strtr($service_valid['service_platinum'],'-','.');	// 메인 플래티넘
							$service_platinum_sub = strtr($service_valid['service_platinum_sub'],'-','.');	// 채용정보 플래티넘
							$service_prime = strtr($service_valid['service_prime'],'-','.');	// 메인 프라임
							$service_grand = strtr($service_valid['service_grand'],'-','.');	// 메인 그랜드
							$service_banner = strtr($service_valid['service_banner'],'-','.');	// 메인 배너형
							$service_banner_sub = strtr($service_valid['service_banner_sub'],'-','.');	// 채용정보 배너형
							$service_list = strtr($service_valid['service_list'],'-','.');	// 메인 리스트형
							$service_list_sub = strtr($service_valid['service_list_sub'],'-','.');	// 채용정보 리스트형
							$service_basic = strtr($service_valid['service_basic'],'-','.');	// 메인 일반
							$service_basic_sub = strtr($service_valid['service_basic_sub'],'-','.');	// 채용정보 일반
						?>
							<tr>
								<td class="title">
									<div class="pl10 pt5">
										<span><strong><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $val['no'];?>" target="_blank"><?php echo stripslashes($val['wr_subject']);?></a></strong></span> 
										<!-- <span>(~2013.05.15)</span> -->
									</div>
									<div class="pl10 text_color1"><?php echo $job_type;?></div>
								</td>
								<td class="tl">
									<?php if($service_valid['service_platinum']){ ?><li><?php echo $service_valid['service_platinum_text'];?> (~ <?php echo $service_platinum;?>)</li><?php } ?>
									<?php if($service_valid['service_prime']){ ?><li><?php echo $service_valid['service_prime_text'];?> (~ <?php echo $service_prime;?>)</li><?php } ?>
									<?php if($service_valid['service_grand']){ ?><li><?php echo $service_valid['service_grand_text'];?> (~ <?php echo $service_grand;?>)</li><?php } ?>
									<?php if($service_valid['service_banner']){ ?><li><?php echo $service_valid['service_banner_text'];?> (~ <?php echo $service_banner;?>)</li><?php } ?>
									<?php if($service_valid['service_list']){ ?><li><?php echo $service_valid['service_list_text'];?> (~ <?php echo $service_list;?>)</li><?php } ?>
									<?php if($service_valid['service_basic']){ ?><li><?php echo $service_valid['service_basic_text'];?> (~ <?php echo $service_basic;?>)</li><?php } ?>
									<?php if($service_valid['service_platinum_sub']){ ?><li><?php echo $service_valid['service_platinum_sub_text'];?> (~ <?php echo $service_platinum_sub;?>)</li><?php } ?>
									<?php if($service_valid['service_banner_sub']){ ?><li><?php echo $service_valid['service_banner_sub_text'];?> (~ <?php echo $service_banner_sub;?>)</li><?php } ?>
									<?php if($service_valid['service_list_sub']){ ?><li><?php echo $service_valid['service_list_sub_text'];?> (~ <?php echo $service_list_sub;?>)</li><?php } ?>
									<?php if($service_valid['service_basic_sub']){ ?><li><?php echo $service_valid['service_basic_sub_text'];?> (~ <?php echo $service_basic_sub;?>)</li><?php } ?>
								</td>
								<td class="tc"><span><strong><a class="text_color1 url" href="<?php echo $alice['company_path'];?>/alba_apply_list.php?no=<?php echo $val['no'];?>"><?php echo $desire;?></a></strong> 명</span></td>
								<td class="tc"><span><?php echo $wdate;?></span></td>
								<td class="tc"><span><?php echo $end_day;?></span></td>
							</tr>
						<?php } // foreach end.?>
						</tbody>
						</table>
						</div>

						<div id="tab2" class="tabs" style="display:none;">
						<table cellspacing="0">
						<caption class="skip">마감된 채용공고</caption>
						<colgroup><col width="*"><col width="100px"><col width="90px"><col width="90px"><col width="90px"></colgroup>
						<thead>
						<tr>
							<th scope="col">채용공고</th>
							<th scope="col">유료서비스</th>
							<th scope="col">지원자수</th>
							<th scope="col">작성일</th>
							<th scope="col">마감일</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							foreach( $end_list['result'] as $val){ 
							$wdate = strtr(substr($val['wr_wdate'],0,11),'-','.');
							$job_type = @implode($alba_company_control->print_job_type($val),', ');
							$desire = number_format($val['wr_desire']);
							$end_day = $alba_company_control->print_end_day($val);

							$service_day = $utility->valid_day($val['wr_service_list']);	 // 일반
							$wr_service = strtr($val['wr_service_list'],'-','.');
							$platinum_day = $utility->valid_day($val['wr_service_platinum']);	 // 플래티넘
							$wr_platinum = strtr($val['wr_service_platinum'],'-','.');
							$prime_day = $utility->valid_day($val['wr_service_prime']);	 // 프라임
							$wr_prime = strtr($val['wr_service_prime'],'-','.');
							$grand_day = $utility->valid_day($val['wr_service_grand']);	 // 그랜드
							$wr_grand = strtr($val['wr_service_grand'],'-','.');
							$banner_day = $utility->valid_day($val['wr_service_banner']);	 // 배너형
							$wr_banner = strtr($val['wr_service_banner'],'-','.');

							$service_days = false;
							if($service_day) $service_days = true;
							if($platinum_day) $service_days = true;
							if($prime_day) $service_days = true;
							if($grand_day) $service_days = true;
							if($banner_day) $service_days = true;
							if($banner_day) $service_days = true;
							$service_msg = ($service_days) ? "연장" : "신청";
						?>
							<tr>
								<td class="title">
									<div class="pl10 pt5">
										<span><strong><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $val['no'];?>" target="_blank"><?php echo stripslashes($val['wr_subject']);?></a></strong></span> 
										<!-- <span>(~2013.05.15)</span> -->
									</div>
									<div class="pl10 text_color1"><?php echo $job_type;?></div>
								</td>
								<td class="tc">
									<?php if($service_day){ ?><span>리스트(~ <?php echo $wr_service;?>)</span><br/><?php } ?>
									<?php if($platinum_day){ ?><span>플래티넘(~ <?php echo $wr_platinum;?>)</span><br/><?php } ?>
									<?php if($prime_day){ ?><span>프라임(~ <?php echo $wr_prime;?>)</span><br/><?php } ?>
									<?php if($grand_day){ ?><span>그랜드(~ <?php echo $wr_grand;?>)</span><br/><?php } ?>
									<?php if($banner_day){ ?><span>배너형(~ <?php echo $wr_banner;?>)</span><?php } ?>
								</td>
								<td class="tc"><span><strong><a class="text_color1 url" href="<?php echo $alice['company_path'];?>/alba_apply_list.php?no=<?php echo $val['no'];?>"><?php echo $desire;?></a></strong> 명</span></td>
								<td class="tc"><span><?php echo $wdate;?></span></td>
								<td class="tc"><span><?php echo $end_day;?></span></td>
							</tr>
						<?php } // foreach end.?>
						</tbody>
						</table>
						</div>

					</div>
					<!--  //채용공고 --> 

					<!--  입사지원한 인재정보   -->
					<div id="listForm" class="positionR mt50 clearfix"> 
						<h2 class="clearfix">
							<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 최근 입사지원자</strong><em class="pl10">[총 <span class=""><?php echo number_format($receive_list['total_count']);?></span> 건]</em>
							<em style="top:0; right:0;" class="positionA"><a href="./alba_apply_list.php"><img width="42" height="15" alt="" src="../images/icon/icon_more1.gif" class="vb bg_color4"></a></em>   
						</h2>
						<table cellspacing="0">
						<caption class="skip">최근 입사지원자</caption>
						<colgroup><col width="*"><col width="160px"><col width="100px"><col width="100px"></colgroup>
						<thead>
						<tr>
							<th class="applicant" scope="col">지원자</th>
							<th class="license" scope="col">경력/자격증</th>
							<th class="readDate" scope="col">열람일</th>
							<th class="applDate" scope="col">지원일</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if($receive_list){
							foreach($receive_list['result'] as $val){ 
							$get_member = $user_control->get_member($val['wr_id']);
							$mb_photo_file = $alice['data_member_path']."/".$get_member['mb_id']."/".$get_member['mb_photo'];
							$mb_photo = (is_file($mb_photo_file)) ? $mb_photo_file : '../images/basic/bg_noPhoto.gif';
							$mb_gender_txt = $user_control->mb_gender_txt[$get_member['mb_gender']];	// 성별
							$mb_birth = explode('-',$get_member['mb_birth']);
							$now_date = date('Y');
							$mb_age = $mb_birth[0] - $now_date + 1; // 우리나라 나이
							if($val['wr_from']){
								$resume_href = $alice['resume_path'] . "/alba_resume_detail.php?no=".$val['wr_from']."&receive=".$val['no'];
								$get_resume = $alba_individual_control->get_resume_no($val['wr_from']);	// 이력서 정보
								/* 경력사항 */
								$wr_career = unserialize($get_resume['wr_career']);
								if($wr_career){
									$period = "";
									foreach($wr_career as $key => $val){
										$sdate = $val['sdate'];
										$sdate_exp = explode('-',$sdate);
										$edate = $val['edate'];
										$edate_exp = explode('-',$edate);
										$period =+ $utility->date_diff($sdate,$edate);
									}
									$periods = round(($period/30),1);
									$periods_exp = explode('.',$periods);
									if($periods_exp[0] >= 12){
										$career_period_year = round(($periods_exp[0] / 12),0);
										$career_period_month = round($periods_exp[1],0);
									}
									$career_periods = "약 " . $career_period_year . "년 " . $career_period_month . "개월";
								} else {
									$career_periods = "없음";
								}
								/* //경력사항 */
								/* 자격증 */
								$license = "";
								if($get_resume['wr_license']){
									$wr_license = unserialize($get_resume['wr_license']);
									$wr_license_cnt = count($wr_license);
									if($wr_license){
										foreach($wr_license as $key => $val){
											if($key==0){
												$license .= $val['name'];
											}
										}
										if($wr_license_cnt >= 2){
											$license .= " 외 " . ($wr_license_cnt-1) . "개";
										}
									} else {
										$license .= "없음";
									}
								} else {
									$license .= "없음";
								}
								/* //자격증 */
								$open_date = ($val['etc_4']) ? strtr(substr($val['etc_4'],0,11),'-','.') : "열람전";



							} else {
								$resume_href = "javascript:is_forms();";
								$career_periods = $license = "자사양식 참고";
								$open_date = "이메일 참고";
							}
							$wdate = strtr(substr($val['wdate'],0,11),'-','.');
						?>
						<tr>
							<td class="applicant">
								<div class="photo"><a target="_blank" href="<?php echo $resume_href;?>"><img src="<?php echo $mb_photo;?>"></a></div>
								<div class="name pt5"><span><strong><?php echo $get_member['mb_name'];?>(<?php echo $mb_gender_txt;?> <?php echo $mb_age;?>세)</strong></span> <span><?php echo $get_member['mb_address0'];?></span></div>
								<div class="mobileEmail"><span class="pr10"><?php echo $get_member['mb_hphone'];?></span>l<span class="pl10"><a class="url" href="mailto://<?php echo $get_member['mb_email'];?>"><?php echo $get_member['mb_email'];?></a></span></div>
							</td>
							<td class="license">
								<div class="career"><img  class="vb"alt="경력" src="../images/icon/icon_career.gif" width="23" height="14"> 	<?php echo $career_periods;?></div>
								<div class="license" style="letter-spacing:-1px;"><img class="vb" alt="자격증" src="../images/icon/icon_license.gif" width="36" height="14"> <?php echo $license;?></div>
							</td>
							<td class="readDate tc"><span><?php echo $open_date;?></span></td>
							<td class="applDate tc"><span><?php echo $wdate;?></span></td>
						</tr>
						<?php 
							}	// foreach end.
						}	// if end.
						?>
						</tbody>
						</table>
					</div>
					<!--  //입사지원한 인재정보 --> 

					<!--  맞춤인재정보   --> 
					<div id="listForm" class="positionR mt50 clearfix">
						<h2 class="clearfix">
							<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 맞춤 인재정보</strong><em class="pl10">[총 <span class=""><?php echo number_format($custom_list['total_count']);?></span> 건]</em>
							<em style="top:0; right:0;" class="positionA"><a href="./alba_customized.php"><img width="42" height="15" alt="" src="../images/icon/icon_more1.gif" class="vb"></a></em>   
						</h2>
						<table cellspacing="0" summary="맞춤인재정보">
						<caption class="skip">맞춤인재정보</caption>
						<colgroup><col width="105px"><col width="*"><col width="110px"><col width="110px"><col width="70px"></colgroup>
						<thead>
						<tr>
							<th class="name" scope="col">이름</th>
							<th class="title" scope="col">이력서정보</th>
							<th class="pay" scope="col">희망급여</th>
							<th class="local" scope="col">희망지역</th>
							<th class="modDate" scope="col">수정일</th>
						</tr>
						</thead>
						<tbody>
						<?php if(!$custom_list['total_count']){ ?>
						<tr>
							<td scope="row" class="basic" colspan="5" >
								<span>검색된 맞춤인재가 없습니다.</span>
							</td>
						</tr>
						<?php } else { 
							foreach($custom_list['result'] as $val){ 
							$no = $val['no'];
							$list = $alba_resume_user_control->get_resume_service($no,"",80);
							if($list['is_delete']){	// 삭제된 이력서 체크
								$resume_href = "javascript:is_delete();";
								$href_target = "";
							} else {
								$resume_href = $alice['resume_path'] . "/alba_resume_detail.php?no=" . $no;
								$href_target = "target=\"_blank\"";
							}
							$mailto = ($list['is_delete']) ? "javascript:is_delete();" : "mailto://".$list['mb_email'];
						?>
						<tr>
							<td scope="row" class="name">
								<span>
								<?php echo $list['name'];?>
								<?php if($list['is_photo']){?>
									<em class="pl5 photo"><img class="vb" src="../images/icon/icon_photo1.gif" width="16" height="16"></em>
								<?php } ?>
								</span>
								<span class="block">(<?php echo $list['wr_gender'];?> <span><?php echo $list['wr_age'];?></span>세)</span>
							</td>
							<td class="title">
								<a href="<?php echo $resume_href;?>"><span class="title"><?php echo $list['subject'];?></span></a>
								<span class="kind text_color1"><?php echo $list['job_type'];?></span>
								<span class="career">
									<img  class="vb"alt="경력" src="../images/icon/icon_career.gif" width="23" height="14"> 	
									<?php echo $list['career'];?>
								</span>
								<?php if($list['license']){ ?>
								<span class="license">
									<img class="vb" alt="자격증" src="../images/icon/icon_license.gif" width="36" height="14"> <?php echo $list['license'];?>
								</span>
								<?php } ?>
							</td>
							<td class="tr pr10 pay">
								<span class="pay">
									<em class="number"><?php echo $list['wr_pay'];?></em> 
									<em class="icon"><?php echo $list['wr_pay_type'];?></em>
								</span>
							</td>
							<td class="local"><?php echo $list['wr_area'];?></td>
							<td class="modDate"><span><?php echo $list['last2'];?></span></td>
						</tr>
						<?php
							}	// foreach end.
						}	// if end.
						?>
						</tbody>
						</table>
					</div>
					<!--  //맞춤인재정보 --> 

				</div><!--  컨텐츠 end   --> 

			</div>
		</div>
	</div>
</section>
