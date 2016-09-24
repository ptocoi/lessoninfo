<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<script type="text/javascript" src="<?php echo $alice['resume_path'];?>/skins/default/alba_resume_detail.skin.js"></script>


<section id="content" class="content_wrap clearfix">

	<div id="report_popup" class="positionF content_wrap clearfix" style="z-index:5000; left:50%;top:50%; margin-left:-250px;margin-top:-250px;display:none;">

		<form name="reportFrm" method="post" action="./process/report.php" id="reportFrm">
		<input type="hidden" name="mode" value="insert"/>
		<input type="hidden" name="no" value="<?php echo $no;?>"/>

		<div class="layerPop  border_color5" style="display:block; width:494px; margin:0 auto; text-align:left; ">              
			<dl>
				<dt style="padding:20px 15px;" class="bg_gray1 font18"><strong>이력서정보 신고하기</strong>
					<em class="closeBtn" onclick="resume_report_close();"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em> 
				</dt>
				<dd style="padding:20px 15px 10px;">
					<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
						<strong>신고사유</strong><br/>
					</p>
					<div class="bgBox2 clearfix" >
						<!--  신고사유 선택  -->                 
						<ul style="padding:10px;line-height:20px;">
							<?php 
								foreach($resume_report_reason as $val){ 
								$name = $utility->remove_quoted($val['name']);
							?>
							<li><input type="radio" name="wr_report" value="<?php echo $val['code'];?>" id="wr_report_<?php echo $val['no'];?>" onclick="report_sel(this);" required hname="신고사유" option="radio"><label for="wr_report_<?php echo $val['no'];?>"><?php echo $name;?></label></li>
							<?php } ?>
							<li><input type="radio" name="wr_report" value="self" id="wr_report_self" onclick="report_sel(this);" required hname="신고사유" option="radio"><label for="wr_report_self">직접입력</label></li>
						</ul>
						<!--  신고사유 선택 //   -->
					</div>
				</dd>
				<!--  상세 신고사유   -->                 
				<dd style="padding:10px 15px 10px;  display:none;" id="report_self">
					<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
						<strong>상세사유</strong><br/>
					</p>
					<div class="bgBox clearfix" >
						<textarea name="wr_report_content" class="ipTextarea" id="wr_report_content" style="width:420px; height:50px; padding:10px;" hname="상세사유"></textarea>
					</div>
				</dd>
				<!--  상세 신고사유 //   -->
			</dl>
			<div style="margin:30px auto;" class="doubleBtn clearfix">
				<ul> 
					<li><div class="btn font_white bg_blueBlack"><a href="javascript:reportFrmSubmit();">신고<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
					<li><div class="btn font_gray bg_white"><a href="javascript:resume_report_close();">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
				</ul>
			</div>
		</div>

		</form>

	</div>
	<!-- 신고하기 레이어 //-->

	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['resume_path'];?>/">인재정보</a> > <strong>이력서 상세보기</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<!-- <div id="popup" class="positionF content_wrap clearfix" style="z-index:9999;display:none;"></div> -->
		<div id="popup" class="positionF content_wrap clearfix" style="z-index:9999; display: block; left: 50%; top: 50%; margin-left: -250px; margin-top: -250px;"></div>
		
		<?php if($sms_use){ ?>
		<!--  문자보내기   -->   
		<div class="mobileWrap" style="display:none;" id="mobileWrap">

		<form name="smsSendFrm" method="post" action="./process/sms.php" id="smsSendFrm">
		<input type="hidden" name="rphone" value="<?php echo $get_member['mb_hphone'];?>"/><!-- 받는사람 -->
		<input type="hidden" name="wr_person" value="<?php echo $get_member['mb_name'];?>"/>
		<input type="hidden" name="wr_receive" value="<?php echo $get_member['mb_id'];?>"/>

			<div class="mobileBox">
				<div class="editor mt10">
					<div class="topIcon"><img class="vb" src="../images/icon/ico_bg_mobile1.gif" width="184" height="18" alt="icon" /></div>
					<div class="initMsg">
					<?php if($sms_config['lms_use']){ // LMS 사용시 ?>
						<textarea name="send_msg" id="send_msg" onkeyup="length_count(this, 2000)" onchange="length_count(this, 2000)" onfocus="length_count(this, 2000)" style="padding:5px;ime-mode:active;" required hname="문자내용"></textarea>
					<?php } else { ?>
						<textarea name="send_msg" id="send_msg" onKeyUp="CountChar(this, 80);" style="padding:5px;ime-mode:active;" required hname="문자내용"></textarea>
					<?php } ?>
					</div>
					<div class="msgByte"><span id="msg_bytes">0</span> Byte<b></b></div>
				</div>
				<div class="mobileNum">
					<ul>
						<li>
							<label>보내는 사람</label>
							<input type="text" maxlength="13" name="sphone" id="sphone" value="<?php echo $member['mb_hphone'];?>" required hname="보내는사람">
						</li>
					</ul>
				</div>
				<div class="sendBtn"><a onclick="smsSendFrmSubmit();">보내기</a></div>
				<div class="closeBtn"><a onclick="smsSendFrmClose();"><img class="vb" src="../images/icon/icon_close.gif" width="19" height="19" alt="닫기" /></a></div>
			</div>
		
		</form>

		</div>
		<!--  문자보내기 //  -->      
		<?php } ?>

		<!--  회원정보  -->
		<div class="listWrap positionR mt30">
			<h2 class="skip">이력서상세보기 </h2>
			<div class="readBtn clearfix">
			<ul>
				<li class="mb5"><em class="history_1 " onclick="javascript:history.back();"><img width="43" height="18" alt="뒤로가기" src="../images/icon/icon_historyBack.gif"></em><span class="displayIB pl5 pt2">수정일 : <?php echo $wr_udate;?></span></li>
				<li style="display:block;" class="Btn mb5">
					<?php if($member['mb_type']=='company'){ // 기업회원일때 ?>
					<em onclick="<?php echo ($alba_resume_user_control->is_open_resume('resume',$member['mb_id'],$get_resume['wr_id']))?"resume_proposal('".$no."','become');":"denied_resume_proposal('become');";?>"><img id="become_btn" alt="입사지원요청" src="../images/icon/icon_scrap4<?php echo ($is_proposal_become)?'_on':'';?>.gif"></em>
					<em onclick="<?php echo ($alba_resume_user_control->is_open_resume('resume',$member['mb_id'],$get_resume['wr_id']))?"resume_proposal('".$no."','interview');":"denied_resume_proposal('interview');";?>"><img id="interview_btn" alt="면접제의" src="../images/icon/icon_scrap5<?php echo ($is_proposal_interview)?'_on':'';?>.gif"></em>
					<em class="scrap_1" onclick="<?php echo ($is_scrap)?"is_scrap();":"resume_scrap('".$no."');";?>"><img id="scrap_btn" width="71" height="18" alt="인재스크랩" src="../images/icon/icon_scrap1<?php echo ($is_scrap)?'_on':'';?>.gif"></em>
					<?php if($member['mb_type']=='company') {	// 기업회원만 신고 가능 ?>
					<em class="notify_1" onclick="resume_report();"><img src="../images/icon/icon_notify.gif" width="61" height="18" alt="신고하기" ></em>
					<?php } ?>
					<em class="print_1" onclick="resume_print();"><img width="43" height="18" alt="인쇄" src="../images/icon/icon_print1.gif"></em>
					<?php } ?>
				</li>
			 </ul>  
			</div>
			<div class="resumeDetail positionR">
			<?php if($is_member){ ?>
			<?php if(!$service_open){ ?>
			<div style="top:91px; right:0; display:block;" class="guideBox positionA"><!--  배너  -->
				<ul>
				<?php if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 ?>
				<!-- <li style="margin-left:-1px;" class="pr10 pt10 pb10 positionR">
					<em style="top:0; right:0;" class="positionA"><img width="12" height="11" alt="colse" src="../images/icon/icon_close4.gif"></em>
					<span class="pl10 pb10"><img width="126" height="84" alt="이력서 내용확인 서비스안내" src="../images/basic/text_resume4.gif"></span>
					<span><a href="<?php echo $alice['company_path'];?>/open_service.php"><img width="147" height="28" alt="기업회원 로그인 버튼" src="../images/basic/btn_resume5.png" class="bg_color7"></a></span>
				</li> -->
				<?php } ?>
				</ul>
			</div>
			<?php } ?>
			<?php } else { ?>
			<div style="top:91px; right:0; display:block;" class="guideBox positionA"><!--  배너  -->
				<ul>
				<li class="pl10 pt10 pb10 positionR">
					<em style="top:0; right:0;" class="positionA"><img width="12" height="11" alt="colse" src="../images/icon/icon_close4.gif"></em>
					<span class="pb10"><img width="137" height="84" alt="인재 연락 서비스안내" src="../images/basic/text_resume3.gif"></span>
					<span><a href="javascript:win_open('../popup/login.php?type=company', 'pop_login', 480, 200);"><img width="147" height="28" alt="이력서 열람서비스 신청 버튼" src="../images/basic/btn_resume4.png" class="bg_color3"></a></span>
				</li>
				<!-- <li style="margin-left:-1px;" class="pr10 pt10 pb10 positionR">
					<em style="top:0; right:0;" class="positionA"><img width="12" height="11" alt="colse" src="../images/icon/icon_close4.gif"></em>
					<span class="pl10 pb10"><img width="126" height="84" alt="이력서 내용확인 서비스안내" src="../images/basic/text_resume4.gif"></span>
					<span><a href="<?php echo $alice['company_path'];?>/open_service.php"><img width="147" height="28" alt="기업회원 로그인 버튼" src="../images/basic/btn_resume5.png" class="bg_color7"></a></span>
				</li> -->
				</ul>
			</div>
			<?php } ?>
				<table>
				<caption><span class="skip">개인정보출력</span></caption>
				<tbody>
				<tr>
					<th class="brend" colspan="3">
						<div class="positionR"> 
							<p class="title"><?php echo $wr_subject;?></p>
							<?php if($get_resume['wr_work_direct']){ // 즉시출근가능 유무?>
							<em class="positionA" style="right:0; top:15px;">
								<img class="bg_color4" src="../images/icon/icon_atOnce.png" width="116" height="23" alt="즉시출근가능" />
							</em>
							<?php } ?>
						</div>
					</th>
				</tr>              
				<tr>
					<td class="first" rowspan="6" style="width:160px !important">
						<div class="personphoto">
							<img src="<?php echo $mb_photo;?>" width="100" height="130" alt="photo" />
						</div>
					</td>
					<th scope="row"> <p>이름</p></th>
					<td>
						<?php 
							if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 
								if($is_open_count && !$is_open_resume){
									echo "<strong>".$utility->make_pass_○○($get_member['mb_name'])."</strong> ";
									echo "(".$mb_gender_txt.", ".$mb_birth[0]."년생) ";
									if($get_resume['input_type']!='self') echo "/ " . $get_member['mb_id'];
									echo "<em class=\"ml10 calltime displayIB\">통화가능시간: <span class=\"text_color1\">".$wr_calltime[0].":00~".$wr_calltime[1].":00</span></em>";
									if($env['memo_use']){
										echo "<em class=\"letter2\" onclick=\"win_open('/send/index.php?type=resume&no=".$no."','send_window',721,450);\">쪽지보내기</em>";
									}
								} else if( $service_open && $is_open_resume ) {
									echo "<strong>".$get_member['mb_name']."</strong>";
									echo "(".$mb_gender_txt.", ".$mb_birth[0]."년생) ";
									if($get_resume['input_type']!='self') echo "/ " . $get_member['mb_id'];
									echo "<em class=\"ml10 calltime displayIB\">통화가능시간: <span class=\"text_color1\">".$wr_calltime[0].":00~".$wr_calltime[1].":00</span></em>";
									if($env['memo_use']){
										echo "<em class=\"letter2\" onclick=\"win_open('/send/index.php?type=resume&no=".$no."','send_window',721,450);\">쪽지보내기</em>";
									}
								} else {
									echo "<strong>".$utility->make_pass_○○($get_member['mb_name'])."</strong>";
								}
							} else {
						?>
							<strong><?php echo ($is_member || $is_admin)?$get_member['mb_name']:$utility->make_pass_○○($get_member['mb_name']);?></strong> 
							(<?php echo $mb_gender_txt;?>, <?php echo $mb_birth[0]?>년생)<?php if($get_resume['input_type']!='self'){ ?> / <?php echo $get_member['mb_id'];?> <?php } ?>
							<em class="ml10 calltime displayIB">통화가능시간: <span class="text_color1"><?php echo $wr_calltime[0];?>:00~<?php echo $wr_calltime[1];?>:00</span></em>
							<?php if($env['memo_use']){ ?>
							<em class="letter2" onclick="win_open('/send/index.php?type=resume&no=<?php echo $no;?>','send_window',721,450);">쪽지보내기</em>
							<?php } ?>
						<?php
							}
						?>

						<?/*php if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 ?>
							<strong><?php echo ($service_open || $alba_resume_user_control->is_open_resume('resume',$member['mb_id'],$get_resume['wr_id'])) ? $get_member['mb_name'] : $utility->make_pass_○○($get_member['mb_name']);?></strong> 
							(<?php echo $mb_gender_txt;?>, <?php echo $mb_birth[0]?>년생)							
							<?php if($get_resume['input_type']!='self'){ ?> / <?php echo $get_member['mb_id'];?> <?php } ?>
							<em class="ml10 calltime displayIB">통화가능시간: <span class="text_color1"><?php echo $wr_calltime[0];?>:00~<?php echo $wr_calltime[1];?>:00</span></em>
						<?php } else { ?>
							<strong><?php echo ($is_member) ? $get_member['mb_name'] : $utility->make_pass_○○($get_member['mb_name']);?></strong> 
							(<?php echo $mb_gender_txt;?>, <?php echo $mb_birth[0]?>년생)<?php if($get_resume['input_type']!='self'){ ?> / <?php echo $get_member['mb_id'];?> <?php } ?>
							<em class="ml10 calltime displayIB">통화가능시간: <span class="text_color1"><?php echo $wr_calltime[0];?>:00~<?php echo $wr_calltime[1];?>:00</span></em>
						<?php } */ ?>

					</td>
				</tr>
				<tr>
					<th scope="row"> <p>전화번호</p></th>
					<td>
						<?php 
							if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 
								if($get_member['mb_phone_view'] && $is_open_count && !$is_open_resume){	// 열람 건수가 있다면
									echo "<em class=\"vt\"><a href=\"javascript:void(0);\" onclick=\"open_resume('".$no."','".$get_resume['wr_id']."','resume', '".$is_open_count."');\"><img alt=\"열람권사용\" src=\"../images/icon/icon_used.gif\"></a></em> <span style='color: #999999;font-size: 11px;'>(회원님께는 열람권이 <strong>".$is_open_count."</strong>건 있습니다)</span>";
								} else if( $get_member['mb_phone_view'] && ($service_open || $is_open_resume) ) {	// 열람 기간이 있다면
									echo "<p>".$get_member['mb_phone']."</p>";
								} else {
									echo "<em class=\"vt\"><img width=\"41\" height=\"14\" alt=\"비공개\" src=\"../images/icon/icon_closed.gif\"></em>";
								}
							} else {
								if(($is_member && $get_member['mb_phone_view']) || $is_admin){
									echo "<p>".$get_member['mb_phone']."</p>";
								} else {
									echo "<em class=\"vt\"><img width=\"41\" height=\"14\" alt=\"비공개\" src=\"../images/icon/icon_closed.gif\"></em>";
								}
							}
						?>
						
						<?/*php if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 ?>
							<?php if($get_member['mb_phone_view'] && ($service_open||$alba_resume_user_control->is_open_resume('resume',$member['mb_id'],$get_resume['wr_id']))){?>
							<p style="display:;"><?php echo $get_member['mb_phone'];?></p>
							<?php } else { ?>
							<em class="vt"><img width="41" height="14" alt="비공개" src="../images/icon/icon_closed.gif"></em>
							<?php } ?>
						<?php } else { ?>
							<?php if(($is_member && $get_member['mb_phone_view']) || $is_admin){?>
							<p style="display:;"><?php echo $get_member['mb_phone'];?></p>
							<?php } else { ?>
							<em class="vt"><img width="41" height="14" alt="비공개" src="../images/icon/icon_closed.gif"></em>
							<?php } ?>
						<?php } */ ?>

					</td>
				</tr>
				<tr>
					<th scope="row"> <p>휴대폰</p></th>
					<td>
						<?php 
							if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 
								if($get_member['mb_hphone_view'] && $is_open_count && !$is_open_resume){	// 열람 건수가 있다면
									echo "<em class=\"vt\"><a href=\"javascript:void(0);\" onclick=\"open_resume('".$no."','".$get_resume['wr_id']."','resume', '".$is_open_count."');\"><img alt=\"열람권사용\" src=\"../images/icon/icon_used.gif\"></a></em> <span style='color: #999999;font-size: 11px;'>(회원님께는 열람권이 <strong>".$is_open_count."</strong>건 있습니다)</span>";
								} else if( $get_member['mb_hphone_view'] && ($service_open || $is_open_resume) ) {	// 열람 기간이 있다면
									echo "<p>".$get_member['mb_hphone'].$sms_button."</p>";
								} else {
									echo "<em class=\"vt\"><img width=\"41\" height=\"14\" alt=\"비공개\" src=\"../images/icon/icon_closed.gif\"></em>";
								}
							} else {
								if(($is_member && $get_member['mb_hphone_view']) || $is_admin){
									echo "<p>".$get_member['mb_hphone'].$sms_button."</p>";
								} else {
									echo "<em class=\"vt\"><img width=\"41\" height=\"14\" alt=\"비공개\" src=\"../images/icon/icon_closed.gif\"></em>";
								}
							}
						?>

						<?/*php if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 ?>
							<?php if($get_member['mb_hphone_view'] && ($service_open||$alba_resume_user_control->is_open_resume('resume',$member['mb_id'],$get_resume['wr_id']))){?>
							<p><?php echo $get_member['mb_hphone'];?></p>
							<?php } else { ?>
							<em class="vt"><img width="41" height="14" alt="비공개" src="../images/icon/icon_closed.gif"></em>
							<?php } ?>
						<?php } else { ?>
							<?php if(($is_member && $get_member['mb_hphone_view']) || $is_admin){?>
							<p><?php echo $get_member['mb_hphone'];?></p>
							<?php } else { ?>
							<em class="vt"><img width="41" height="14" alt="비공개" src="../images/icon/icon_closed.gif"></em>
							<?php } ?>
						<?php } */ ?>
					</td>
				</tr>
				<tr>
					<th scope="row"> <p>이메일</p></th>
					<td>
						<?php 
							if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 
								if($get_member['mb_email_view'] && $is_open_count && !$is_open_resume){	// 열람 건수가 있다면
									echo "<em class=\"vt\"><a href=\"javascript:void(0);\" onclick=\"open_resume('".$no."','".$get_resume['wr_id']."','resume', '".$is_open_count."');\"><img alt=\"열람권사용\" src=\"../images/icon/icon_used.gif\"></a></em> <span style='color: #999999;font-size: 11px;'>(회원님께는 열람권이 <strong>".$is_open_count."</strong>건 있습니다)</span>";
								} else if( $get_member['mb_email_view'] && ($service_open || $is_open_resume) ) {	// 열람 기간이 있다면
									echo "<p>".$get_member['mb_email']."</p>";
								} else {
									echo "<em class=\"vt\"><img width=\"41\" height=\"14\" alt=\"비공개\" src=\"../images/icon/icon_closed.gif\"></em>";
								}
							} else {
								if(($is_member && $get_member['mb_email_view']) || $is_admin){
									echo "<p>".$get_member['mb_email']."</p>";
								} else {
									echo "<em class=\"vt\"><img width=\"41\" height=\"14\" alt=\"비공개\" src=\"../images/icon/icon_closed.gif\"></em>";
								}
							}
						?>

						<?/*php if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 ?>
							<?php if($get_member['mb_email_view'] && ($service_open||$alba_resume_user_control->is_open_resume('resume',$member['mb_id'],$get_resume['wr_id']))){?>
							<p><?php echo $get_member['mb_email'];?></p>
							<?php } else { ?>
							<em class="vt"><img width="41" height="14" alt="비공개" src="../images/icon/icon_closed.gif"></em>
							<?php } ?>
						<?php } else { ?>
							<?php if(($is_member && $get_member['mb_email_view']) || $is_admin){?>
							<p><?php echo $get_member['mb_email'];?></p>
							<?php } else { ?>
							<em class="vt"><img width="41" height="14" alt="비공개" src="../images/icon/icon_closed.gif"></em>
							<?php } ?>
						<?php } */ ?>
					</td>
				</tr>
				<tr>
					<th scope="row"> <p>홈페이지</p></th>
					<td>
						<?php 
							if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 
								if($get_member['mb_homepage_view'] && $is_open_count && !$is_open_resume){	// 열람 건수가 있다면
									echo "<em class=\"vt\"><a href=\"javascript:void(0);\" onclick=\"open_resume('".$no."','".$get_resume['wr_id']."','resume', '".$is_open_count."');\"><img alt=\"열람권사용\" src=\"../images/icon/icon_used.gif\"></a></em> <span style='color: #999999;font-size: 11px;'>(회원님께는 열람권이 <strong>".$is_open_count."</strong>건 있습니다)</span>";
								} else if( $get_member['mb_homepage_view'] && ($service_open || $is_open_resume) ) {	// 열람 기간이 있다면
									echo "<a href=\"".$mb_homepage."\" target=\"_blank\">".$mb_homepage."</a>";
								} else {
									echo "<em class=\"vt\"><img width=\"41\" height=\"14\" alt=\"비공개\" src=\"../images/icon/icon_closed.gif\"></em>";
								}
							} else {
								if(($is_member && $get_member['mb_homepage_view']) || $is_admin){
									echo "<a href=\"".$mb_homepage."\" target=\"_blank\">".$mb_homepage."</a>";
								} else {
									echo "<em class=\"vt\"><img width=\"41\" height=\"14\" alt=\"비공개\" src=\"../images/icon/icon_closed.gif\"></em>";
								}
							}
						?>

						<?/*php if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 ?>
							<?php if($get_member['mb_homepage_view'] && ($service_open || $is_open_resume)){?>
							<a href="<?php echo $mb_homepage;?>" target="_blank"><?php echo $mb_homepage;?></a>
							<?php } else { ?>
							<em class="vt"><img width="41" height="14" alt="비공개" src="../images/icon/icon_closed.gif"></em>
							<?php } ?>
						<?php } else { ?>
							<?php if(($is_member && $get_member['mb_homepage_view']) || $is_admin){?>
							<a href="<?php echo $mb_homepage;?>" target="_blank"><?php echo $mb_homepage;?></a>
							<?php } else { ?>
							<em class="vt"><img width="41" height="14" alt="비공개" src="../images/icon/icon_closed.gif"></em>
							<?php } ?>
						<?php } */ ?>
					</td>
				</tr>
				<tr>
					<th class="vt" scope="row"><p>주소</p></th>
					<td>
						<?php 
							if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 
								if($get_member['mb_address_view'] && $is_open_count && !$is_open_resume){	// 열람 건수가 있다면
									echo "<em class=\"vt\"><a href=\"javascript:void(0);\" onclick=\"open_resume('".$no."','".$get_resume['wr_id']."','resume', '".$is_open_count."');\"><img alt=\"열람권사용\" src=\"../images/icon/icon_used.gif\"></a></em> <span style='color: #999999;font-size: 11px;'>(회원님께는 열람권이 <strong>".$is_open_count."</strong>건 있습니다)</span>";
								} else if( $get_member['mb_address_view'] && ($service_open || $is_open_resume) ) {	// 열람 기간이 있다면
									echo "[".$get_member['mb_zipcode']."] ".$get_member['mb_address0']." ".$get_member['mb_address1'];
								} else {
									echo "<em class=\"vt\"><img width=\"41\" height=\"14\" alt=\"비공개\" src=\"../images/icon/icon_closed.gif\"></em>";
								}
							} else {
								if(($is_member && $get_member['mb_address_view']) || $is_admin){
									echo "[".$get_member['mb_zipcode']."] ".$get_member['mb_address0']." ".$get_member['mb_address1'];
								} else {
									echo "<em class=\"vt\"><img width=\"41\" height=\"14\" alt=\"비공개\" src=\"../images/icon/icon_closed.gif\"></em>";
								}
							}
						?>

						<?/*php if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 ?>
							<?php if($get_member['mb_address_view'] && ($service_open || $is_open_resume)){?>
							[<?php echo $get_member['mb_zipcode'];?>] <?php echo $get_member['mb_address0']." ".$get_member['mb_address1'];?>
							<?php } else { ?>
							<em class="vt"><img width="41" height="14" alt="비공개" src="../images/icon/icon_closed.gif"></em>
							<?php } ?>
						<?php } else { ?>
							<?php if(($is_member && $get_member['mb_address_view']) || $is_admin){?>
							[<?php echo $get_member['mb_zipcode'];?>] <?php echo $get_member['mb_address0']." ".$get_member['mb_address1'];?>
							<?php } else { ?>
							<em class="vt"><img width="41" height="14" alt="비공개" src="../images/icon/icon_closed.gif"></em>
							<?php } ?>
						<?php } */ ?>
					</td>
				</tr>
				<tr>
					<td colspan="3" class="etcWrap bbend vt" scope="row" style="padding:0; ">
					<!--  기타정보  -->
					<table style="width:100%">
					<colgroup><col width="159px"><col width="159px"><col width="159px"><col width="159px"><col width="159px"></colgroup>
					<tbody>
					<tr>
						<th>최종학력</th>
						<th>경력사항</th>
						<th>희망급여</th>
						<th>자격증</th>
						<th class="brend">외국어능력</th>
					</tr>
					<tr>
						<td><?php echo stripslashes($wr_school_ability['name']);?></td>
						<td><?php echo $career_periods;?></td>
						<td><?php echo $pay_type;?></td>
						<td><?php echo $license;?></td>
						<td class="brend"><?php echo $language;?></td>
					</tr>
					</tbody>
					</table>    
					<!--  //기타정보 -->
					</td>
				</tr>
				</tbody>
				</table>
				</div>
			</div>
			<!-- //회원정보  --> 

			<?php if($member['mb_type']!='company' && $is_admin==false){ ?>
			<div class="loginClose mt20"><!--  기업회원 열람 로그인 배너 -->
				<ul>
					<li>
						<img width="499" height="30" src="../images/basic/text_resume1.gif" alt="기업회원으로 로그인 하시면 열람하실 수 있습니다!">
					</li>
					<li class="pt5">
						<img width="466" height="39" src="../images/basic/text_resume2.gif" alt="기업회원으로 로그인 후 열람하실 수 있습니다.">
					</li>
					<li class="pt20">
						<a href="javascript:win_open('../popup/login.php?type=company', 'pop_login', 480, 200);"><img width="138" height="28" alt="기업회원로그인" src="../images/basic/btn_resume2.gif"></a>
						<a href="<?php echo $alice['member_path'];?>/register.php"><img width="138" height="28" alt="기업회원가입" src="../images/basic/btn_resume1.gif"></a>
					</li>
				</ul>
			</div>
			<?php } // 기업회원이 아닐때 ?>
	<!--  희망근무조건 -->
			<div class="listWrap mt30">
				<h2 class="pb5"><img src="../images/tit/person_nav_tit_02.gif"  alt="희망근무조건"></h2>
				<div class="resumeDetail jobtype">
					
					<table>
					<caption><span class="skip">희망근무조건출력</span></caption>
					<colgroup><col width="159px"><col width="*"></colgroup>
					<tbody>
					<tr>
						<th scope="row"><label>희망근무지</label></th>
						<td>
							<ul>
								<?php echo $wr_area_0;?>
								<?php echo $wr_area_1;?>
								<?php echo $wr_area_2;?>
							</ul>
						</td>
					</tr>
					<tr>
						<th scope="row"><label>희망직종</label></th>
						<td>
							<ul>
								<?php echo $wr_job_type_0;?>
								<?php echo $wr_job_type_1;?>
								<?php echo $wr_job_type_2;?>
							</ul>
						</td>
					</tr>
					<tr>
						<th scope="row"><label>근무일시</label></th>
						<td>
							<ul>
								<li><?php echo $wr_date;?></li>,
								<li><?php echo $wr_week;?></li>,
								<li><?php echo $wr_time;?></li>
								<?php echo $wr_work_direct;?>
							</ul>
						</td>
					</tr>
					<tr>
						<th scope="row"><label>희망급여</label></th>
						<td><?php echo $pay_type;?></td>
					</tr>
					<tr>
						<th scope="row" class="bbend"><label>근무형태</label></th>
						<td  class="bbend">
							<ul><?php echo $work_type;?></ul>
						</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
			<!--  //희망근무조건 --> 

			<!--  학력사항  -->
			<div class="listWrap mt30">
				<h2 class="pb5">
					<img src="../images/tit/person_nav_tit_03.gif"  alt="학력사항">
					<em class="resumeText pb5"><strong><span class="text_color1"><?php echo $school_ability[0];?></span> <?php echo $school_ability[1];?></strong></em>
				</h2>
				<div class="resumeDetail borderB table">
				<table>
				<caption><span class="skip">학력사항출력</span></caption>
				<colgroup><col width="245px"><col width="200px"><!-- <col width="80px"> --><col width="*"></colgroup>
				<tbody>
				<tr>
					<th scope="col"> <label>재학기간</label></th>
					<th scope="col"> <label>학교명</label></th>
					<!-- <th scope="col"> <label>소재지</label></th> -->
					<th scope="col" class="brend"> <label>전공</label></th>
				</tr>

				<?php
				if($wr_school_type) {
					foreach($wr_school_type as $key => $val){
						// 고등학교
						if($val=='high_school'){	// 고등학교
							$school_syear = $get_resume['wr_high_school_syear'] . "년 입학 ";	// 입학년도
							$school_eyear = "~ " . $get_resume['wr_high_school_eyear'] ."년 ";		// 졸업년도
							$high_school_graduation = $get_resume['wr_high_school_graduation'];	// 졸업여부
							$school_graduation = ($high_school_graduation) ? "재학" : "졸업";
							$school_name = $get_resume['wr_high_school_name'];
				?>
							<tr>
								<td><?php echo $school_syear;?><?php echo $school_eyear;?><?php echo $school_graduation;?></td>
								<td class="pl20 tl"><strong><?php echo $school_name;?></strong></td>
								<!-- <td>경기</td> -->
								<td class="pl20 tl brend"></td>
							</tr>
				<?php
						} else if($val=='half_college'){	// 대학 (2,3년)
							if($wr_half_college){
								for($j=0;$j<$wr_half_college_cnt;$j++){
									$school_syear = $wr_half_college['college_syear'][$j] . "년 입학 ";	// 입학년도
									$school_eyear = "~ " . $wr_half_college['college_eyear'][$j] . "년 ";	// 졸업년도
									$half_college_school_graduation = $wr_half_college['college_graduation'][$j];
									$school_graduation_arr = array( 0 => "졸업", 1 => "재학", 2 => "중퇴");
									$school_graduation = $school_graduation_arr[$half_college_school_graduation];
									$school_name = $wr_half_college['college'][$j];
									$school_specialize = $wr_half_college['college_specialize'][$j];
				?>
							<tr>
								<td>
									<?php echo $school_syear;?><?php echo $school_eyear;?><?php echo $school_graduation;?>
									<?php if( ($j+1) ==$wr_half_college_cnt ) echo ($get_resume['wr_school_absence']) ? "휴학중" : "";?>
								</td>
								<td class="pl20 tl"><strong><?php echo $school_name;?></strong></td>
								<!-- <td>경기</td> -->
								<td class="pl20 tl brend"><?php echo $school_specialize;?></td>
							</tr>
				<?php
								}	// half_college for end.
							}	// wr_half_college if end.

						} else if($val=='college'){	// 대학 (4년)
							if($wr_college){
								for($j=0;$j<$wr_college_cnt;$j++){
									$school_syear = $wr_college['college_syear'][$j] . "년 입학 ";	// 입학년도
									$school_eyear = "~ " . $wr_college['college_eyear'][$j] . "년 ";	// 졸업년도
									$college_school_graduation = $wr_college['college_graduation'][$j];
									$school_graduation_arr = array( 0 => "졸업", 1 => "재학", 2 => "중퇴");
									$school_graduation = $school_graduation_arr[$college_school_graduation];
									$school_name = $wr_college['college'][$j];
									$school_specialize = $wr_college['college_specialize'][$j];
				?>
							<tr>
								<td>
									<?php echo $school_syear;?><?php echo $school_eyear;?><?php echo $school_graduation;?>
									<?php if( ($j+1) ==$wr_college_cnt ) echo ($get_resume['wr_school_absence']) ? "휴학중" : "";?>
								</td>
								<td class="pl20 tl"><strong><?php echo $school_name;?></strong></td>
								<!-- <td>경기</td> -->
								<td class="pl20 tl brend"><?php echo $school_specialize;?></td>
							</tr>
				<?php
								}	// college for end.
							}	// college if end.

						} else if($val=='graduate'){	// 대학원
							if($wr_graduate){
								for($j=0;$j<$wr_graduate_cnt;$j++){
									$school_syear = $wr_graduate['graduate_syear'][$j] . "년 입학 ";	// 입학년도
									$school_eyear = "~ " . $wr_graduate['graduate_eyear'][$j] . "년 ";	// 졸업년도
									$graduate_school_graduation = $wr_graduate['graduate_graduation'][$j];
									$school_graduation_arr = array( 0 => "졸업", 1 => "수료", 2 => "재학", 3 => "중퇴");
									$school_graduation = $school_graduation_arr[$graduate_school_graduation];
									$school_name = $wr_graduate['graduate'][$j];
									$school_specialize = $wr_graduate['graduate_specialize'][$j];
				?>
							<tr>
								<td>
									<?php echo $school_syear;?><?php echo $school_eyear;?><?php echo $school_graduation;?>
									<?php if( ($j+1) ==$wr_graduate_cnt ) echo ($get_resume['wr_school_absence']) ? "휴학중" : "";?>
								</td>
								<td class="pl20 tl"><strong><?php echo $school_name;?></strong></td>
								<!-- <td>경기</td> -->
								<td class="pl20 tl brend"><?php echo $school_specialize;?></td>
							</tr>
				<?php
								}	// college for end.
							}	// college if end.

						} else if($val=='success'){	// 대학원 이상
							if($wr_success){
								for($j=0;$j<$wr_success_cnt;$j++){
									$school_syear = $wr_success['success_syear'][$j] . "년 입학 ";	// 입학년도
									$school_eyear = "~ " . $wr_success['success_eyear'][$j] . "년 ";	// 졸업년도
									$success_school_graduation = $wr_success['success_graduation'][$j];
									$school_graduation_arr = array( 0 => "졸업", 1 => "수료", 2 => "재학", 3 => "중퇴");
									$school_graduation = $school_graduation_arr[$success_school_graduation];
									$school_name = $wr_success['success'][$j];
									$school_specialize = $wr_success['success_specialize'][$j];
				?>
							<tr>
								<td>
									<?php echo $school_syear;?><?php echo $school_eyear;?><?php echo $school_graduation;?>
									<?php if( ($j+1) ==$wr_success_cnt ) echo ($get_resume['wr_school_absence']) ? "휴학중" : "";?>
								</td>
								<td class="pl20 tl"><strong><?php echo $school_name;?></strong></td>
								<!-- <td>경기</td> -->
								<td class="pl20 tl brend"><?php echo $school_specialize;?></td>
							</tr>
				<?php
								}	// college for end.
							}	// college if end.
						}	// if end.
				
					} // foreach end. 
				} // foreach if end.
				?>
				<!-- <tr>
					<td class="bbend">2004년 입학 ~ 2011년 졸업</td>
					<td class="bbend"><strong>○○○○ 대학교</strong></td>
					<td class="bbend">경기</td>
					<td class="bbend brend">예/체능학 > 프로덕트 디자인 학과</td>
				</tr> -->
				</tbody>
				</table>
				</div>
			</div>
			<!--  //학력사항 -->

			<!--  경력사항  -->
			<?php if($wr_career_use){ ?>
			<div class="listWrap mt30">
				<h2 class="pb5">
					<img src="../images/tit/person_nav_tit_04.gif"   alt="경력사항">
					<em class="resumeText pb5"><strong>총 경력<span class="text_color1"> <?php echo $career_periods;?></span></strong></em>
				</h2>
				<div class="resumeDetail  table">
				<?php if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 ?>

					<?php if( $is_open_count && !$is_open_resume ) { // 열람 건수가 있다면 ?>
						<div class="resumeOpen  tc">
							<ul>
								<li class="pt20"><strong>사용가능한 이력서 열람권이 <?php echo $is_open_count;?>건 있습니다 열람권을 사용하시면 열람이 가능합니다.</strong></li>
								<li class="pt20">
								<a href="javascript:void(0);" onclick="open_resume('<?php echo $no;?>','<?php echo $get_resume['wr_id'];?>','resume', '<?php echo $is_open_count;?>');"><img width="192" height="28" alt="이력서열람서비스 신청" src="../images/basic/btn_resume6.png" class="bg_color5"></a>
								</li>
							</ul>
						</div>
					<?php } else if( $service_open || $is_open_resume) { // 열람 기간이 있다면 ?>
						<table style="display:;">
						<caption><span class="skip">경력사항출력</span></caption>
						<colgroup><col width="100px"><col width="150px"><col width="150px"><col width="*"></colgroup>
						<tbody>
						<tr>
							<th scope="col"> <label>근무기간</label></th>
							<th scope="col"> <label>회사명</label></th>
							<th scope="col"> <label>담당업무</label></th>
							<th scope="col" class="brend"> <label>상세업무</label></th>
						</tr>
						<?php
						if($wr_career){
							foreach($wr_career as $key => $val){
								$date_val = "";
								$sdate = ($val['sdate']) ? explode('-',$val['sdate']) : "";
								$date_val = $sdate[0]."년 " . $sdate[1] . "월 ~<br/>";
								$edate = ($val['edate']) ? explode('-',$val['edate']) : "";
								$date_val .= $edate[0]."년 " . $edate[1] . "월";
								$career_type = $val['type'];
								$career_type_cnt = count($val['type']);
						?>
						<tr>
							<td class="tl"><p><?php echo $date_val;?></p></td>
							<td class="tl">
								<strong><?php echo $val['company'];?></strong>
								<ul>
									<?php 
									for($k=0;$k<$career_type_cnt;$k++){ 
										if($career_type[$k]){
									?>
									<li><img src="../images/icon/ico_job_category1.gif" width="27" height="14" alt="업종" /> <?php echo $category_control->get_categoryCodeName($career_type[$k]);?></li>
									<?php 
										} // if end.
									}	// for end.
									?>
									<!-- <li><img src="../images/icon/ico_job_category2.gif" width="27" height="14" alt="직종" /> 웹디자인</li> -->
								</ul>
							</td>
							<td class="tl"><?php echo $val['job'];?></td>
							<td class="tl brend"><?php echo nl2br(stripslashes($val['content']));?></td>
						</tr>
						<?php 
							}	// foreach end.
						}	// wr_career if end.
						?>
						<!-- <tr>
							<td class="tl bbend"><p>2004년 3월 ~<br/>2011년 5월</p></td>
							<td class="tl bbend">
								<strong>넷퓨알바</strong>
								<ul>
									<li><img src="../images/icon/ico_job_category1.gif" width="27" height="14" alt="업종" /> 구인구직</li>
									<li><img src="../images/icon/ico_job_category2.gif" width="27" height="14" alt="직종" /> 웹디자인</li>
								</ul>
							</td>
							<td class="tl bbend">편집디자인</td>
							<td class="tl bbend brend"><p>넷퓨알바 홍보실에서 편집디자인 작업</p></td>
						</tr> -->
						</tbody>
						</table>
					<?php } else { ?>
						<div class="resumeOpen  tc"><!--  경력사항 열람서비스 신청 배너 -->
							<ul>
								<li class="pt20"><strong>경력사항 내용을 열람하시려면 <span class="text_color">이력서 열람서비스</span>를 신청하세요.</strong></li>
								<li class="pt20">
								<a href="<?php echo $alice['company_path'];?>/open_service.php"><img width="192" height="28" alt="이력서열람서비스 신청" src="../images/basic/btn_resume3.png" class="bg_color5"></a>
								</li>
							</ul>
						</div>
					<?php } ?>

				<?php } else { ?>
				
					<table style="display:;">
					<caption><span class="skip">경력사항출력</span></caption>
					<colgroup><col width="100px"><col width="150px"><col width="150px"><col width="*"></colgroup>
					<tbody>
					<tr>
						<th scope="col"> <label>근무기간</label></th>
						<th scope="col"> <label>회사명</label></th>
						<th scope="col"> <label>담당업무</label></th>
						<th scope="col" class="brend"> <label>상세업무</label></th>
					</tr>
					<?php
					if($wr_career){
						foreach($wr_career as $key => $val){
							$date_val = "";
							$sdate = ($val['sdate']) ? explode('-',$val['sdate']) : "";
							$date_val = $sdate[0]."년 " . $sdate[1] . "월 ~<br/>";
							$edate = ($val['edate']) ? explode('-',$val['edate']) : "";
							$date_val .= $edate[0]."년 " . $edate[1] . "월";
							$career_type = $val['type'];
							$career_type_cnt = count($val['type']);
					?>
					<tr>
						<td class="tl"><p><?php echo $date_val;?></p></td>
						<td class="tl">
							<strong><?php echo $val['company'];?></strong>
							<ul>
								<?php 
								for($k=0;$k<$career_type_cnt;$k++){ 
									if($career_type[$k]){
								?>
								<li><img src="../images/icon/ico_job_category1.gif" width="27" height="14" alt="업종" /> <?php echo $category_control->get_categoryCodeName($career_type[$k]);?></li>
								<?php 
									} // if end.
								}	// for end.
								?>
								<!-- <li><img src="../images/icon/ico_job_category2.gif" width="27" height="14" alt="직종" /> 웹디자인</li> -->
							</ul>
						</td>
						<td class="tl"><?php echo $val['job'];?></td>
						<td class="tl brend"><?php echo nl2br(stripslashes($val['content']));?></td>
					</tr>
					<?php 
						}	// foreach end.
					}	// wr_career if end.
					?>
					</tbody>
					</table>

				<?php } ?>
				</div>
			</div>
			<?php } ?>
			<!--  //경력사항  -->

			<!--  보유자격증  -->
			<?php if($wr_license){ ?>
			<div class="listWrap mt30">
				<h2 class="pb5"><img src="../images/tit/person_nav_tit_05.gif"   alt="보유자격증"></h2>
				<div class="resumeDetail borderB table">
				<table>
				<caption><span class="skip">자격증출력</span></caption>
				<colgroup><col width="245px"><col width="*"><col width="200px"></colgroup>
				<tbody>
				<tr>
					<th scope="col"> <label>취득일</label></th>
					<th scope="col"> <label>자격증명</label></th>
					<th scope="col" class="brend"> <label>발행처</label></th>
				</tr>
				<?php
				if($wr_license){
					foreach($wr_license as $key => $val){
				?>
				<tr>
					<td><?php echo $val['year'];?>년</td>
					<td><strong><?php echo $val['name'];?></strong></td>
					<td class="brend"><?php echo $val['public'];?></td>
				</tr>
				<!-- <tr>
					<td class="bbend">2006년</td>
					<td class="bbend"><strong>웹디자인 1급</strong></td>
					<td class="bbend brend">산업인력공단</td>
				</tr> -->
				<?php 
					} // foreach end.
				}	// foreach if end.
				?>
				</tbody>
				</table>
				</div>
			</div>
			<?php } ?>
			<!--  //보유자격증 -->

			<!--  외국어능력   -->
			<?php if($wr_language){ ?>
			<div class="listWrap mt30">
				<h2 class="pb5"> <img src="../images/tit/person_nav_tit_06.gif"  alt="외국어능력"> </h2>
				<div class="resumeDetail borderB table">
				<table>
				<caption><span class="skip">외국어출력</span></caption>
				<colgroup><col width="200px"><col width="*"></colgroup>
				<tbody>
				<tr>
					<th scope="col"> <label>외국어명</label></th>
					<th scope="col" class="brend"> <label>구사능력 / 공인시험 / 어학연수</label></th>
				</tr>
				<?php
				if($wr_language){
					foreach($wr_language as $key => $val){
					$language_name = $category_control->get_categoryCodeName($val['language']);
					$level_name = $alba_individual_control->language_level[$val['level']]['name'];
					$level_icon = $alba_individual_control->language_level[$val['level']]['icon'];
					$level_text = $alba_individual_control->language_level[$val['level']]['text'];
					$study_date = $alba_resume_control->language_date[$val['study_date']];
				?>
				<tr>
					<td><?php echo $language_name;?></td>
					<td class="tl brend">
						<ul>
							<li>[구사능력] <strong><em><img class="vm pb3" width="17" height="14" alt="<?php echo $level_name;?>" src="../images/icon/<?php echo $level_icon;?>"></em>
							<?php echo $level_text;?></strong></li>
							<?php 
							if($val['license']){
								//foreach($val['license']['license'] as $lkey => $lval){
								$license = $val['license']['license'];
								$level = $val['license']['level'];
								$year = $val['license']['year'];
								$license_cnt = count($license);
								for($j=0;$j<$license_cnt;$j++){
								$license_name = $category_control->get_categoryCodeName($license[$j]);
								$license_level = $level[$j];
								$license_year = $year[$j];
							?>
							<li>[공인시험] <strong><?php echo $license_name;?> <?php echo $license_level;?>점 (취득년도:<?php echo $license_year;?>년)</strong></li>
							<?php 
								} 
							}
							if($val['study']){
							?>
							<li>[어학연수] <strong>어학연수 경험있음 (연수기간:<?php echo $study_date;?>)</strong></li>
							<?php } ?>
						</ul>
					</td>
				</tr>
				<?php
					}	// foreach end.
				}	// foreach if end.
				?>
				<!-- <tr>
					<td class="bbend">중국어</td>
					<td class="tl bbend brend">
						<ul>
							<li>[구사능력] <strong><em><img class="vm pb3" width="17" height="14" alt="중" src="../images/icon/icon_average.gif"></em>
							일상대화</strong></li>
							<li>[공인시험] <strong>HSK회화 초급 (취득년도:2005년)</strong></li>
							<li>[어학연수] <strong>어학연수 경험있음 (연수기간:1년)</strong></li>
						</ul>
					</td>
				</tr> -->
				</tbody>
				</table>
				</div>
			</div>
			<?php } ?>
			<!--  //외국어능력   -->

			<!--  OA능력및특기사항   -->
			<div class="listWrap mt30">
				<h2 class="pb5"><img src="../images/tit/person_nav_tit_07.gif" alt="oa능력및특기사항"></h2>
				<div class="resumeDetail list">
				<table>
				<caption><span class="skip">OA능력및특기사항 출력</span></caption>
				<tbody>
				<tr>
					<th class="brend">
						<ul>
							<li>
							<label><em class="pr5"><img class="vm pb2" width="16" height="16" src="../images/icon/icon_word1.gif" alt="워드"></em>한글/ms워드</label>
							</li>
							<li>
							<label><em class="pr5"><img class="vm pb2" width="16" height="16" src="../images/icon/icon_power1.gif" alt="파워포인트"></em>파워포인트</label>
							</li>
							<li>
							<label><em class="pr5"><img class="vm pb2" width="16" height="16" src="../images/icon/icon_excel1.gif" alt="엑셀"></em>엑셀</label>
							</li>
							<li class="brend">
							<label><em class="pr5"><img class="vm pb2" width="16" height="16" src="../images/icon/icon_ie1.gif" alt="인터넷"></em>인터넷</label>
							</li>
						</ul>
					</th>
				</tr>

				<tr>
					<td>
						<ul>
							<li>
							<em class="pl5"><img class="vm pb3" width="17" height="14" alt="<?php echo $oa_word['name'];?>" src="../images/icon/<?php echo $oa_word['icon'];?>"></em>
							<?php echo $oa_word['text'];?>
							</li>
							<li>
							<em class="pl5"><img class="vm pb3" width="17" height="14" alt="<?php echo $oa_pt['name'];?>" src="../images/icon/<?php echo $oa_pt['icon'];?>"></em>
							<?php echo $oa_pt['text'];?>
							</li>
							<li>
							<em class="pl5"><img class="vm pb3" width="17" height="14" alt="<?php echo $oa_sheet['name'];?>" src="../images/icon/<?php echo $oa_sheet['icon'];?>"></em>
							<?php echo $oa_sheet['text'];?>
							</li>
							<li class="brend">
							<em class="pl5"><img class="vm pb3" width="17" height="14" alt="<?php echo $oa_internet['name'];?>" src="../images/icon/<?php echo $oa_internet['icon'];?>"></em>
							<?php echo $oa_internet['text'];?>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<th class="brend"><label class="pl20">컴퓨터능력</label></th>
				</tr>
				<tr>
					<td class="brend"><p class="pl20"><?php echo @implode($computers,', ');?></p></td>
				</tr>
				<tr>
					<th class="brend"><label class="pl20">특기사항</label></th>
				</tr>
				<tr>
					<td class="brend"><p class="pl20"><?php echo @implode($specialty,', ');?></p></td>
				</tr>
				<tr>
					<th class="brend"><label class="pl20">수상·수료활동내역</label></th>
				</tr>
				<tr>
					<td class="brend bbend"><p class="pl20"><?php echo $wr_prime;?></p></td>
				</tr>
				</tbody>
				</table>
				</div>
			</div>
			<!--  //OA능력및특기사항  -->

			<!--  자기소개서  -->
			<div class="listWrap mt30">
				<h2 class="pb5"><img src="../images/tit/person_nav_tit_08.gif" alt="자기소개서"></h2>
				<div class="resumeDetail clearfix">
				<?php if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 ?>

					<?php if( $is_open_count && !$is_open_resume) { // 열람 건수가 있다면 ?>
						<div class="resumeOpen  tc">
							<ul>
								<li class="pt20"><strong>사용가능한 이력서 열람권이 <?php echo $is_open_count;?>건 있습니다 열람권을 사용하시면 열람이 가능합니다.</strong></li>
								<li class="pt20">
								<a href="javascript:void(0);" onclick="open_resume('<?php echo $no;?>','<?php echo $get_resume['wr_id'];?>','resume', '<?php echo $is_open_count;?>');"><img width="192" height="28" alt="이력서열람서비스 신청" src="../images/basic/btn_resume6.png" class="bg_color5"></a>
								</li>
							</ul>
						</div>
					<?php } else if( $service_open || $is_open_resume ) { // 열람 기간이 있다면 ?>
						<div style="display:;" class="pt20 pl20 pr20 pb20"><?php echo $wr_introduce;?></div>
					<?php } else { ?>
						<div class="resumeOpen  tc"><!--  자기소개서 열람서비스 신청 배너 -->
							<ul>
								<li class="pt20"><strong>자기소개서 내용을 열람하시려면 <span class="text_color">이력서 열람서비스</span>를 신청하세요.</strong></li>
								<li class="pt20">
									<a href="<?php echo $alice['company_path'];?>/open_service.php"><img width="192" height="28" alt="이력서열람서비스 신청" src="../images/basic/btn_resume3.png" class="bg_color5"></a>
								</li>
							</ul>
						</div>
					<?php } ?>

					<?/*php if($service_open || $is_open_resume){ ?>
					<div style="display:;" class="pt20 pl20 pr20 pb20"><?php echo $wr_introduce;?></div>
					<?php } else { ?>
					<div class="resumeOpen  tc"><!--  자기소개서 열람서비스 신청 배너 -->
						<ul>
						<li class="pt20"><strong>자기소개서 내용을 열람하시려면 <span class="text_color">이력서 열람서비스</span>를 신청하세요.</strong></li>
						<li class="pt20">
						<a href="<?php echo $alice['company_path'];?>/open_service.php"><img width="192" height="28" alt="이력서열람서비스 신청" src="../images/basic/btn_resume3.png" class="bg_color5"></a>
						</li>
						</ul>
					</div>
					<?php } */ ?>

				<?php } else { ?>
					<?php if(!$is_member && $is_admin==false){ ?>
					<div class="loginClose"><!--  기업회원 열람 로그인 배너 -->
						<ul>
							<li>
								<img width="499" height="30" src="../images/basic/text_resume1.gif" alt="기업회원으로 로그인 하시면 열람하실 수 있습니다!">
							</li>
							<li class="pt5">
								<img width="466" height="39" src="../images/basic/text_resume2.gif" alt="기업회원으로 로그인 후 열람하실 수 있습니다.">
							</li>
							<li class="pt20">
								<a href="javascript:win_open('../popup/login.php?type=company', 'pop_login', 480, 200);"><img width="138" height="28" alt="기업회원로그인" src="../images/basic/btn_resume2.gif"></a>
								<a href="<?php echo $alice['member_path'];?>/register.php"><img width="138" height="28" alt="기업회원가입" src="../images/basic/btn_resume1.gif"></a>
							</li>
						</ul>
					</div>
					<?php } else { // 기업회원이 아닐때 ?>
					<div style="display:;" class="pt20 pl20 pr20 pb20"><?php echo $wr_introduce;?></div>
					<?php } ?>
				<?php } ?>
				</div>
			</div>
			<!--  //자기소개서  -->

			<!--  포토앨범   -->
			<div class="listWrap mt30">
				<h2 class="pb5"><img src="../images/tit/person_nav_tit_09.gif" alt="포토앨범"></h2>
				<div class="resumeDetail clearfix" style="z-index:100;">
				<table>
				<caption><span class="skip">포토앨범 출력</span></caption>
				<colgroup><col width="159px"><col width="*"></colgroup>
				<tbody>
				<tr>
				<td class="bbend vt">
					<div class="pictureWrap positionR clearfix">
						<ul>
							<li>
								<div class="pt20 picture">
									<img width="150" height="100" alt="photo" src="<?php echo $photo_0;?>" <?php echo ($is_photo_0)?"style='cursor:pointer;' onclick=\"photo_view('".$get_resume['wr_id']."',0);\"":"";?>>
								</div>
								<em>&nbsp;</em>
							</li>
							<li>
								<div class="pt20 picture">
									<img width="150" height="100" alt="photo" src="<?php echo $photo_1;?>" <?php echo ($is_photo_1)?"style='cursor:pointer;' onclick=\"photo_view('".$get_resume['wr_id']."',1);\"":"";?>>
								</div>
								<em>&nbsp;</em>
							</li>
							<li>
								<div class="pt20 picture">
									<img width="150" height="100" alt="photo" src="<?php echo $photo_2;?>" <?php echo ($is_photo_2)?"style='cursor:pointer;' onclick=\"photo_view('".$get_resume['wr_id']."',2);\"":"";?>>
								</div>
								<em>&nbsp;</em>
							</li>
							<li>
								<div class="pt20 picture">
									<img width="150" height="100" alt="photo" src="<?php echo $photo_3;?>" <?php echo ($is_photo_3)?"style='cursor:pointer;' onclick=\"photo_view('".$get_resume['wr_id']."',3);\"":"";?>>
								</div>
								<em>&nbsp;</em>
							</li>
						</ul>
					</div>
				</td>
				</tr>
				</tbody>
				</table>
				</div>
			</div>
			<!--  //포토앨범  -->

			<!--  부가정보   -->
			<div class="listWrap mt30">
				<h2 class="pb5"><img src="../images/tit/person_nav_tit_10.gif"  alt="부가정보"></h2>
				<div class="resumeDetail table">
				<table>
				<caption><span class="skip">학력사항출력</span></caption>
				<colgroup><col width="25%"><col width="25%"><col width="25%"><col width="*"></colgroup>
				<tbody>
				<tr>
					<th scope="col"> <label>장애여부</label></th>
					<th scope="col"> <label>결혼여부</label></th>
					<th scope="col"> <label>병역여부</label></th>
					<th scope="col" class="brend"> <label>채용우대</label></th>
				</tr>
				<tr>
					<td class="bbend"><?php echo $impediment;?> </td>
					<td class="bbend"><?php echo $wr_marriage;?></td>
					<td class="bbend">[<?php echo $wr_military;?>] <?php echo $get_resume['wr_military_type']?> </td>
					<td class="bbend brend"><?php echo @implode($wr_preferential,', ');?> <?php echo $treatment;?> </td>
				</tr>
				</tbody>
				</table>
				</div>
			</div>
			<!--  //부가정보  -->

			<!--  주의사항   -->
			<div style="display:block;" class="Caution mt50 mb20">
			<h3 class="skip">주의사항</h3>
			<ul>
			<li>본 정보는 취업활동을 위해 등록한 이력서 정보이며 <?php echo $env['site_name'];?>는(은) 기재된 내용에 대한 오류와 사용자가 신뢰하여 취한 조치에 대한 책임을 지지 않습니다.</li> 
			<li>누구든 본 정보를 <?php echo $env['site_name'];?>의 동의없이 재배포할 수 없으며 본 정보를 출력 및 복사하더라도 채용목적 이외의 용도로 사용할 수 없습니다.</li> 
			<li>본 정보를 출력 및 복사한 경우의 개인정보보호에 대한 책임은 출력 및 복사한 당사자에게 있으며 정보통신부 고시 제2005-18호 (개인정보의 기술적·관리적 보호조치 기준)에 따라 개인정보가 담긴 이력서 등을 불법유출 및 배포하게 되면 법에 따라 책임지게 됨을 양지하시기 바랍니다. <저작권자 ⓒ <?php echo $env['site_name'];?>. 무단전재-재배포 금지></li>
			</ul>
			</div>
		<!--  주의사항 end   -->
		</div>

	</div>
</section>