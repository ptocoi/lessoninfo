<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>
<script>
var mode = "";
</script>
<script type="text/javascript" src="<?php echo $alice['js_plugin'];?>/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo $alice['js_plugin'];?>/jquery.placeholder.js"></script>
<script type="text/javascript" src="<?php echo $alice['individual_path'];?>/skins/default/alba_resume_regist.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
			<div class="listWrap positionR mt20">
				<h2 class="skip"> 개인회원 서비스 메인페이지 </h2>

				<div class="personContentWrap"><!--  컨텐츠  -->
				
					<form method="post" name="MemberUpdateFrm" action="<?php echo $alice['member_path'];?>/process/regist.php" id="MemberUpdateFrm" enctype="multipart/form-data">
					<input type="hidden" name="ajax" value="true"/>
					<input type="hidden" name="mode" value="profile_photo_upload"/>
					<input type="hidden" name="mb_type" value="<?php echo $mb_type;?>"/>
					<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
					<input type="hidden" name="no" value="<?php echo $member['no'];?>"/>

					<!--  회원정보  -->
					<div class="personTopBox">
						<table>
						<caption><span class="skip">회원정보출력</span></caption>
						<colgroup><col width="163px"><col width="104px"><col width="*"><col width="104px"><col width="*"></colgroup>
						<tbody>
							<tr>
								<td class="photoWrap" rowspan="4">
								<img src="<?php echo $mb_photo;?>" width="100" height="130" alt="photo" id="personphoto"/>
								
								<!-- 프로필 사진 등록 layer -->
								<div style="display:none; width:420px; top:0; left:25%; text-align:left;z-index:9999;" class="layerPop positionA border_color5" id="profilePhotoPop">
									<dl style="">
										<dt class="bg_gray1"  id="profilePhotoPop_handle" style="padding:20px 15px; cursor:pointer;"><strong>프로필사진 수정</strong>
											<em class="closeBtn" id="profilePhotoPop_close"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em>
										</dt>
										<dd style="padding:10px 15px;">
											<p style="padding-bottom:20px;">
												<strong>GIF,JPG,PNG</strong> 파일형식으로,<br>
												<strong>100*130픽셀, 100KB</strong> 용량 이내의 파일만 등록 가능합니다.<br>
											</p>
											<div style="border:1px solid #ddd; padding:10px;" class="box2">
												<input type="file" class="txtForm" style="height:20px;" size="32" id="photo_file" name="photo_file">
											</div>
											<div class="btn font_gray bg_white" style="margin:20px auto;">
												<a href="javascript:photo_submit();">등록하기<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a>
											</div>
										</dd>
									</dl>
								</div>
								<!-- //프로필 사진 등록 layer -->

								</td>
								<td colspan="4">
									<strong class="title text_color1"><?php echo $member['mb_name'];?>(<?php echo $member['mb_id'];?>)님</strong> 반갑습니다.!<span class="pl10">(최종수정:<?php echo $mb_udate;?>)</span>       
									<em class="positionA" style="top:6px; right:5px;"><a class="button white" href="<?php echo $alice['member_path'];?>/update_form.php"><span>개인정보수정</span></a></em>
								</td>
							</tr>
							<tr>
								<th scope="row"> <label>주소</label></th>
								<td>[<?php echo $member['mb_zipcode'];?>] <?php echo $member['mb_address0']." ".$member['mb_address1'];?></td>
								<th scope="row"> <label>e-메일</label></th>
								<td><?php echo $member['mb_email'];?></td>
							</tr>
							<tr>
								<th scope="row"> <label>연락처</label></th>
								<td><?php echo $member['mb_phone'];?></td>
								<th scope="row"> <label>휴대폰</label></th>
								<td><?php echo $member['mb_hphone'];?></td>
							</tr>
							<tr>
								<td colspan="4" class="resumeViewWrap">
									<div class="resumeView bg_color2 border_color1">
										<span class="tit pl10"><strong>총 이력서등록수 <a class="text_color1 url" href="<?php echo $alice['individual_path'];?>/alba_resume_list.php"><?php echo number_format($member['mb_alba_resume_count']);?></a> 개</strong></span>
										<span class="rightView text pr10">
										<em class="pl10"><a href="<?php echo $alice['individual_path'];?>/alba_resume_list.php"><img  class="bg_color8 vm" width="98" height="22" alt="이력서관리" src="../images/icon/icon_resumeEdit.png"></a></em></span>
									</div>
								</td>
							</tr>
						<tr>
							<td class="Btn">
								<a class="button white" onclick="profile_photo_pop();"><span id="personphoto_status"><?php echo ($member['mb_photo'])?'수정':'등록';?><img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a>
								<span id="photo_remove" style="display:<?php echo ($member['mb_photo'])?'':'none';?>;">
								<a class="button white" onclick="profile_photo_remove();"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a>
								</span>
							</td>
							<td class="summaryWrap brend" colspan="4">
								<div class="summaryBox">
									<dl>
										<dt><strong>채용공고 스크랩</strong></dt>
										<dd><span class="text"><a class="url text_color1" href="./alba_scrap.php"><?php echo number_format($scrap_cnt);?></a></span>건</dd>
									</dl>
									<dl>
										<dt><strong>내 이력서 열람기업</strong></dt>
										<dd><span class="text"><a class="url text_color1" href="./alba_resume_open.php"><?php echo number_format($open_cnt);?></a></span>개 기업</dd>
									</dl>
									<dl class="favor">
										<dt><strong>관심기업</strong></dt>
										<dd><span class="text"><a class="url text_color1" href="./favorite_company.php"><?php echo number_format($favorite_cnt);?></a></span>개 기업</dd>
									</dl>
									<dl>
										<dt><strong>이력서 열람제한</strong></dt>
										<dd><span class="text"><a class="url text_color1" href="./alba_resume_denied.php"><?php echo number_format($denied_cnt);?></a></span>개 기업</dd>
									</dl>
									<dl>
										<dt><strong>맞춤채용정보</strong></dt>
										<dd><span class="text"><a class="url text_color1" href="./alba_customized.php"><?php echo number_format($custom_list['total_count']);?></a></span>개</dd>
									</dl>
								</div>
							</td>
						</tr>
						</tbody>
						</table>
					</div>
					<!--  //회원정보 -->
					</form>


					<!--  입사지원현황   --> 
					<div id="listForm" class="mainTab positionR mt30 clearfix">
						<h2 class="skip">채용공고</h2>
						<ul class="tabMenu clearfix">
							<li class="tab1 on"><a href="javascript:tabs('tab1');"><strong>온라인 입사지원현황</strong></a></li>
							<li class="tab2"><a href="javascript:tabs('tab2');"><strong>이메일 입사지원현황</strong></a></li>
						</ul>  
						<em class="positionA" style="top:21px; right:0;"><a href="./alba_resume_onlines.php"><img width="42" height="15" class="vb" src="../images/icon/icon_more1.gif" alt=""></a></em>
						
						<div id="tab1" class="tabs" style="display:block;">
						<table cellspacing="0">
						<caption class="skip">온라인지원현황</caption>
						<colgroup><col width="90px"><col width="110px"><col width="*"> <col width="100px"><col width="120px"></colgroup>
						<thead>
						<tr>
							<th scope="col">지원일</th>
							<th scope="col">회사명</th>
							<th scope="col">지원내역</th>
							<th scope="col">열람여부</th>
							<th scope="col">모집마감일</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							foreach($online_list['result'] as $val){ 
							$wdate = strtr(substr($val['wdate'],0,11),'-','.');
							$get_alba = $alba_company_control->get_alba_no($val['wr_to']);
							if($val['etc_4']){
								$open_date = "<div class=\"text_red\">열람</div> <div>" . strtr(substr($val['etc_4'],0,11),'-','.') . "</div>";
							} else {
								$open_date = "<div class=\"text_red\"><img width=\"39\" height=\"14\" alt=\"\" src=\"../images/icon/icon_jobView2.png\" class=\"vb bg_color7\"></div>";
							}
							if($get_alba['wr_volume_always']){	 // 상시모집이라면
								$end_date = "<div>상시모집</div>";
							} else {
								$end_date = "<div>" . strtr($get_alba['wr_volume_date'],'-','.') . "</div>";
							}
							if($get_alba['wr_volume_end']){	// 채용시까지라면
								$volume_date = "<div>(모집시마감)</div>";
							} else {
								if($utility->valid_day($get_alba['wr_volume_date'])){
									$wr_volume_date = $utility->date_diff( $get_alba['wr_volume_date'], date('Y-m-d') );
									$volume_date = "<div class=\"text_red\">(".$wr_volume_date."일후마감)</div>";
								} else {
									$volume_date = "<div>마감됨</div>";
								}
							}
						?>
						<tr>
							<td class="tc"><span><?php echo $wdate;?></span></td>
							<td class="tl pl10"><span><a href="<?php echo $alice['alba_path'];?>/company_info.php?mb_id=<?php echo $val['wr_to_id'];?>" target="_blank"><?php echo stripslashes($get_alba['wr_company_name']);?></a></span></td>
							<td class="title" >
								<div class="pl10 pt5"><span><strong><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $val['wr_to'];?>" target="_blank"><?php echo stripslashes($get_alba['wr_subject']);?></a></strong></span></div>
								<?php if($val['type']!='become_email'){ // 이메일 일땐 출력 안됨?>
								<div class="pl10 text_color1" style="width:320px;">지원이력서 : <a href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $val['wr_to'];?>" class="url"><?php echo stripslashes($val['etc_0']);?></a></div>
								<?php } ?>
							</td>
							<td class="tc"><?php echo $open_date;?></td>
							<td class="tc">
								<?php echo $end_date;?>
								<?php echo $volume_date;?>
							</td>
						</tr>
						<?php } ?>
						</tbody>
						</table>
						</div>

						<div id="tab2" class="tabs" style="display:none;">
						<table cellspacing="0">
						<caption class="skip">이메일지원현황</caption>
						<colgroup><col width="90px"><col width="110px"><col width="*"> <col width="100px"><col width="120px"></colgroup>
						<thead>
						<tr>
							<th scope="col">지원일</th>
							<th scope="col">회사명</th>
							<th scope="col">지원내역</th>
							<th scope="col">열람여부</th>
							<th scope="col">모집마감일</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							foreach($email_list['result'] as $val){ 
							$wdate = strtr(substr($val['wdate'],0,11),'-','.');
							$get_alba = $alba_company_control->get_alba_no($val['wr_to']);
							if($val['etc_4']){
								$open_date = "<div class=\"text_red\">열람</div> <div>" . strtr(substr($val['etc_4'],0,11),'-','.') . "</div>";
							} else {
								$open_date = "<div class=\"text_red\"><img width=\"39\" height=\"14\" alt=\"\" src=\"../images/icon/icon_jobView2.png\" class=\"vb bg_color7\"></div>";
							}
							if($get_alba['wr_volume_always']){	 // 상시모집이라면
								$end_date = "<div>상시모집</div>";
							} else {
								$end_date = "<div>" . strtr($get_alba['wr_volume_date'],'-','.') . "</div>";
							}
							if($get_alba['wr_volume_end']){	// 채용시까지라면
								$volume_date = "<div>(모집시마감)</div>";
							} else {
								if($utility->valid_day($get_alba['wr_volume_date'])){
									$wr_volume_date = $utility->date_diff( $get_alba['wr_volume_date'], date('Y-m-d') );
									$volume_date = "<div class=\"text_red\">(".$wr_volume_date."일후마감)</div>";
								} else {
									$volume_date = "<div>마감됨</div>";
								}
							}
						?>
						<tr>
							<td class="tc"><span><?php echo $wdate;?></span></td>
							<td class="tl pl10"><span><a href="<?php echo $alice['alba_path'];?>/company_info.php?mb_id=<?php echo $val['wr_to_id'];?>" target="_blank"><?php echo stripslashes($get_alba['wr_company_name']);?></a></span></td>
							<td class="title" >
								<div class="pl10 pt5"><span><strong><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $val['wr_to'];?>" target="_blank"><?php echo stripslashes($get_alba['wr_subject']);?></a></strong></span></div>
								<?php if($val['type']!='become_email'){ // 이메일 일땐 출력 안됨?>
								<div class="pl10 text_color1" style="width:320px;">지원이력서 : <a href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $val['wr_to'];?>" class="url"><?php echo stripslashes($val['etc_0']);?></a></div>
								<?php } ?>
							</td>
							<td class="tc"><?php echo $open_date;?></td>
							<td class="tc">
								<?php echo $end_date;?>
								<?php echo $volume_date;?>
							</td>
						</tr>
						<?php } ?>
						</tbody>
						</table>
						</div>
					</div>
					<!--  //입사지원현황 --> 

					<!--  맞춤 채용정보   --> 
					<div id="listForm" class="positionR mt50 clearfix">
						<h2 class="clearfix">
							<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 맞춤 채용정보</strong><em class="pl10">[총 <span class=""><?php echo number_format($custom_list['total_count']);?></span> 건]</em>
							<em style="top:0; right:0;" class="positionA"><a href="./alba_customized.php"><img width="42" height="15" alt="" src="../images/icon/icon_more1.gif" class="vb"></a></em>   
						</h2>
						<table cellspacing="0">
						<colgroup><col width="110px"><col width="*"><col width="100px"><col width="50px"><col width="100px"><col width="80px"><col width="80px"></colgroup>
						<thead>
						<tr>
							<th scope="col">회사명</th>
							<th scope="col">채용공고</th>
							<th scope="col">근무지역</th>
							<th scope="col">성별</th>
							<th scope="col">급여</th>
							<th scope="col">등록일</th>
							<th scope="col">마감일</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if($custom_list['result']){
							foreach($custom_list['result'] as $val){ 
							$no = $val['no'];
							$list = $alba_user_control->get_alba_service($no,"",80);
							$wdate = strtr($list['datetime'],'-','.');
						?>
						<tr>
							<td class="tl pl10"><span><a target="_blank" href="<?php echo $alice['alba_path'];?>/company_info.php?mb_id=<?php echo $val['wr_id'];?>"><?php echo stripslashes($list['company_name']);?></a></span></td>
							<td class="tl">
								<div class="pl10"><span><a target="_blank" href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?></a></span></div>
							</td>
							<td class="tc"><span><?php echo $utility->str_cut($list['wr_area'],16,'');?></span></td>
							<td class="tc"><span><?php echo $list['wr_gender'];?></span></td>
							<td class="tr pr5 pay">
								<span class="pay">
									<?php
									if($list['wr_pay_conference']){
										echo $alba_user_control->pay_conference[$list['wr_pay_conference']];
									} else {
									?>
										<em class="number"><?php echo $list['wr_pay'];?></em>원
										<em class="icon"><?php echo $list['wr_pay_type'];?></em>
									<?php } ?>
								</span>
							</td>
							<td class="tc"><span><?php echo $wdate;?></span></td>
							<td class="tc"><span><?php echo $list['volume'];?></span></td>
						</tr>
						<?php 
							}	// foreach end.
						}	// if end.
						?>
						</tbody>        
						</table>
					</div>
					<!--  //맞춤 채용정보 --> 

					<!--  맞춤인재정보   --> 
					<div id="listForm" class="positionR mt50 clearfix">
						<h2 class="clearfix">
							<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 스크랩한 채용정보</strong><em class="pl10">[총 <span class=""><?php echo number_format($scrap_list['total_count']);?></span> 건]</em>
							<em style="top:0; right:0;" class="positionA"><a href="./alba_scrap.php"><img width="42" height="15" alt="" src="../images/icon/icon_more1.gif" class="vb"></a></em>   
						</h2>
						<table cellspacing="0" summary="스크랩한 채용정보">
						<caption class="skip">스크랩한 채용정보</caption>
						<colgroup><col width="80px"><col width="110px"><col width="*"><col width="100px"><col width="90px"><col width="80px"></colgroup>
						<thead>
						<tr>
							<th scope="col">스크랩일</th>
							<th scope="col">회사명</th>
							<th scope="col">채용제목</th>
							<th scope="col">급여</th>
							<th scope="col">근무지역</th>
							<th scope="col">마감일</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							foreach($scrap_list['result'] as $val){ 
							$no = $val['scrap_rel_id'];
							$wdate = strtr(substr($val['wdate'],0,10),'-','.');
							$list = $alba_user_control->get_alba_service($no,"",65);
							$get_alba = $alba_control->get_alba($no);
						?>
						<tr>
							<td class="tc"><span><?php echo $wdate;?></span></td>
							<td class="tl pl10"><span><a href="<?php echo $alice['alba_path'];?>/company_info.php?mb_id=<?php echo $get_alba['wr_id'];?>" target="_blank"><?php echo $list['company_name'];?></a></span></td>
							<td class="tl" ><span><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>" target="_blank"><?php echo $list['subject'];?></a></span></td>
							<td class="tr pr10 pay">
								<?php
								if($list['wr_pay_conference']){
									echo $alba_user_control->pay_conference[$list['wr_pay_conference']];
								} else {
								?>
									<span class="number"><?php echo $list['wr_pay'];?></span>원
									<em class="icon"><?php echo $list['wr_pay_type'];?></em>
								<?php } ?>
							</td>
							<td class="tc"><span><?php echo $list['wr_area'];?></span></td>
							<td class="tc"><span><?php echo $list['volume'];?></span></td>
						</tr>
						<?php } ?>
						</tbody>
						</table>
					</div>
					<!--  맞춤인재정보 end   --> 

				</div><!--  컨텐츠 end   --> 

			</div>
		</div>
	</div>
</section>