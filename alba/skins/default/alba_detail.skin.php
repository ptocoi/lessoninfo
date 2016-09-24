<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
<?php if(in_array('kakao_story',$sns_feed)){ ?>
var send_kakao_story = function(){	 // 카카오스토리로 전송
	// 사용할 앱의 Javascript 키를 설정해 주세요.
	Kakao.init("<?php echo $env['kakao_key'];?>");
	Kakao.Auth.getStatus(function(statusObj) {	
		if (statusObj.status == "not_connected") {
			Kakao.Auth.createLoginButton({
			  container: '#kakao-login-btn',
			  success: function() {
				// 로그인 성공시, API를 호출합니다.
				Kakao.API.request( {
				  url : '/v1/api/story/linkinfo',
				  data : {
					url : "<?php echo $alice['url'];?>/alba_detail.php?no=<?php echo $no;?>"
				  }
				}).then(function(res) {
				  // 이전 API 호출이 성공한 경우 다음 API를 호출합니다.
				  return Kakao.API.request( {
					url : '/v1/api/story/post/link',
					data : {
					  link_info : res
					}
				  });
				}).then(function(res) {
				  return Kakao.API.request( {
					url : '/v1/api/story/mystory',
					data : { id : res.id }
				  });
				}).then(function(res) {
				  alert("카카오스토리로 전송 되었습니다.");
				}, function (err) {
				  alert(JSON.stringify(err));
				});
			  },
			  fail: function(err) {
				alert(JSON.stringify(err))
			  }
			});
		} else {
			// 로그인 성공시, API를 호출합니다.
			Kakao.API.request( {
			  url : '/v1/api/story/linkinfo',
			  data : {
				url : "<?php echo $alice['url'];?>/alba_detail.php?no=<?php echo $no;?>"
			  }
			}).then(function(res) {

				alert( "AAAA :: " + res.id + "\n\n" + res.title+"\n\n"+res.image+"\n\n"+res.description );

			  // 이전 API 호출이 성공한 경우 다음 API를 호출합니다.
			  return Kakao.API.request( {
				url : '/v1/api/story/post/link',
				data : {
				  link_info : res
				}
			  });
			}).then(function(res) {
			  return Kakao.API.request( {
				url : '/v1/api/story/mystory',
				data : { id : res.id }
			  });
			}).then(function(res) {
			  alert("카카오스토리로 전송 되었습니다.");
			}, function (err) {
			  alert(JSON.stringify(err));
			});
		}
	});
}
<?php } ?>
</script>
<script type="text/javascript" src="<?php echo $alice['alba_path'];?>/skins/default/alba_detail.skin.js"></script>

<section id="content" class="content_wrap clearfix">

	<div id="report_popup" style="z-index: 9999; display: none; left: 50%; top: 50%; margin-left: -250px; margin-top: -250px;" class="positionF content_wrap clearfix">
		
		<form name="reportFrm" method="post" action="./process/report.php" id="reportFrm">
		<input type="hidden" name="mode" value="insert"/>
		<input type="hidden" name="no" value="<?php echo $no;?>"/>

		<div class="layerPop  border_color5" style="display:block; width:494px; margin:0 auto; text-align:left; ">              
		<dl>
			<dt style="padding:20px 15px;" class="bg_gray1 font18"><strong>채용정보 신고하기</strong>
				<em class="closeBtn" onclick="alba_report_close();"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em> 
			</dt>

			<dd style="padding:20px 15px 10px;">
				<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
					<strong>신고사유</strong><br/>
				</p>
				<div class="bgBox2 clearfix" >
				<!--  신고사유 선택  -->                 
				<ul style="padding:10px;line-height:20px;">
					<?php 
						foreach($alba_report_reason as $val){ 
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
			<dd style="padding:10px 15px 10px; display:none;" id="report_self">
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
				<li><div class="btn font_gray bg_white"><a href="javascript:alba_report_close();">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
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
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['alba_path'];?>/">채용정보</a> > <strong>상세보기</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<div id="popup" style="z-index: 9999; display: none; left: 50%; top: 40%; margin-left: -250px; margin-top: -250px;" class="positionF content_wrap clearfix"></div>
		<!-- <div id="popup" class="positionF content_wrap clearfix" style="z-index:9999; display: block; left: 50%; top: 50%; margin-left: -250px; margin-top: -250px;"></div> -->

		<!--  채용공고 안내  -->
		<div class="listWrap positionR mt10">
			<h2 class="skip">채용공고  </h2>
			<div class="readBtn clearfix">
				<!-- <div style="float:right;">http://www.netfu.co.kr/1145<em class="pl5 vt"><a href=""><img  src="../images/basic/btn_urlCopy.gif" width="49" height="14" alt="url복사"/></a></em></div> -->
				<ul class="clearfix" style="clear:both;">
					<li><em class="history_1" onclick="javascript:history.back();"><img width="43" height="18" alt="뒤로가기" src="../images/icon/icon_historyBack.gif"></em><span class="displayIB pl5 pt2">등록일 : <?php echo $wdate;?></span></li>
					<li class="Btn mb5">
						<ul class="snsWrap">						
						<em class="scrap_1" onclick="<?php echo ($is_scrap)?"is_scrap();":"alba_scrap('".$no."');";?>"><img  src="../images/icon/icon_scrap2<?php echo ($is_scrap)?'_on':'';?>.gif" width="71" height="18" alt="채용공고스크랩" id="scrap_icon"/></em>
						<?php if($member['mb_type']=='individual') {	// 개인회원만 신고 가능 ?>
						<em class="notify_1" onclick="alba_report();"><img src="../images/icon/icon_notify.gif" width="61" height="18" alt="신고하기" ></em>
						<?php } ?>
						<em class="email_1" onclick="<?php echo ($is_member)?"alba_mail('".$no."');":"is_mail();";?>"><img  src="../images/icon/icon_email1.gif" width="55" height="18" alt="e-메일" /></em>
						<em class="print_1" onclick="alba_print('<?php echo $no;?>');"><img  src="../images/icon/icon_print1.gif" width="43" height="18" alt="인쇄" /></em>
						<?php if(in_array('twitter',$sns_feed)){ ?>
						<li class="sns" style="cursor:pointer;"><a href="<?php echo $twitter;?>" target="_blank"><img  src="../images/icon/icon_sns_twitter.gif" width="20" height="20" alt="twitter" /></a></li>
						<?php } ?>
						<?php if(in_array('facebook',$sns_feed)){ ?>
						<li class="sns" style="cursor:pointer;">
							<a href="<?php echo $facebook;?>" target="_blank"><img  src="../images/icon/icon_sns_facebook.gif" width="20" height="20" alt="facebook" /></a>
							<!-- <div class="fb-share-button" data-href="http://njob.netfu.co.kr/alba/alba_detail.php?no=<?php echo $no;?>" data-layout=""></div> -->
							<!-- <div class="fb-share-button" data-href="http://njob.netfu.co.kr/alba/alba_detail.php?no=<?php echo $no;?>" data-layout="button"></div> -->
						</li>
						<?php } ?>
						<?php if(in_array('google',$sns_feed)){ ?>
						<li class="sns" style="cursor:pointer;">
							<a href="<?php echo $google;?>" target="_blank"><img  src="../images/icon/icon_sns_google.gif" width="20" height="20" alt="google" /></a>
						</li>
						<?php } ?>
						<?php if(in_array('kakao_story',$sns_feed)){ ?>
						<li class="sns" style="cursor:pointer;">
							<a onclick="send_kakao_story();"><img  src="../images/ic/sns/story_android_36x36.png" width="20" height="20" alt="kakao_story" /></a>
							<a id="kakao-login-btn" style="z-index:9999;position:absolute;right:0px;top:28px;"></a>
						</li>
						<?php } ?>
						<?php if(in_array('naver_band',$sns_feed)){ ?>
						<li class="sns" style="cursor:pointer;">
							<span>
							<script type="text/javascript" src="//developers.band.us/js/share/band-button.js?v=20150309"></script>
							<script type="text/javascript">
							new ShareBand.makeButton({"lang":"ko","type":"b"}  );
							</script>
							</span>
							<!-- <a href="#" target="_blank"><img  src="../images/ic/sns/band.jpg" width="20" height="18" alt="naver_band" /></a> -->
						</li>
						<?php } ?>
						<?php if(in_array('clog',$sns_feed)){ ?>
						<li class="sns" style="cursor:pointer;"><a href="<?php echo $clog;?>" target="_blank"><img  src="../images/icon/icon_sns_clog.gif" width="20" height="20" alt="clog" /></a></li>
						<?php } ?>
						</ul>
					</li>
				</ul>
			</div>

			<!--  채용공고내용  -->
			<div class="jobDetail clearfix positionR" id="jobDetail">

				<?php if($sms_use){ ?>
				<!--  문자보내기   -->   
				<div class="mobileWrap" style="display:none;" id="mobileWrap">

				<form name="smsSendFrm" method="post" action="./process/sms.php" id="smsSendFrm">
				<input type="hidden" name="rphone" value="<?php echo $get_alba['wr_hphone'];?>"/><!-- 받는사람 -->
				<input type="hidden" name="wr_person" value="<?php echo $get_alba['wr_person'];?>"/>
				<input type="hidden" name="wr_receive" value="<?php echo $get_alba['wr_id'];?>"/>

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

				<ul>
				<li ><p class="title"><?php echo $wr_subject;?></p></li>
				<li class="clearfix">
				<ul style="overflow:hidden; background:url(../images/basic/alba_bg1.gif) repeat-y scroll 0 0;">

					<li class="jobDleft" style="height:auto">
					<!--  left: 내용  --> 
					<div class="logoImg positionR">                    
						<?php echo $wr_logo;?>
						<?php  if(!$is_self){  ?>
							<em class="companyDetail positionA" style="bottom:-1px; right:-1px;"><a href="<?php echo $company_info_url;?>" target="_blank">회사정보상세보기</a></em>
						<?php } ?>
					</div>

					<div class="companyTit">
						<h3 class="mb3"><?php echo $company_name;?></h3>
						<p><?php echo $wr_homepage;?></p> 
					</div>

					<div class="jobContent5 positionR">
						<h3 class="skip"><?php echo $wr_id;?></h3> 
						<ul>
						<em class="positionA" style="top:12px; right:10px;">(최저시급 <strong><?php echo $time_pay;?></strong>원)</em> 
						<li>
							<span><strong>급여</strong></span>: 
							<?php echo ($pay_conference) ? "<strong>".$alba_user_control->pay_conference[$pay_conference]."</strong>" : $pay_type." <strong>".$wr_pay."</strong>"; ?>
						</li>
						<li><span>모집인원</span>: <?php echo $volmue;?></li>
						<li><span>경력</span>: <?php echo $wr_career;?></li>
						<li><span>성별</span>: <?php echo $wr_gender;?></li>
						<li><span>연령</span>: <?php echo $age;?></li>
						<li><span>학력</span>: <?php echo $wr_ability;?></li>
						</ul>
					</div>
					<!--  left: 내용 end -->
					</li>

					<li class="jobDright pb10">
					<!--  right: 내용  --> 
					<div class="jobContent1 pb10">
						<ul> 
						<a href="<?php echo $info_link;?>" target="_blank"><h3 class="tit mb10"><?php echo $wr_company_name;?></h3></a>
						<li><span>마감일</span>: <?php echo $volume_date['text'];?></li>
						<li><span>근무지주소</span>: <strong><?php echo $wr_area_info;?></strong></li>
						<li><span>근무기간</span>: <?php echo $wr_date;?></li>
						<li><span>근무요일</span>: <?php echo $wr_week;?></li>
						<li><span>근무시간</span>: <?php echo $wr_time;?></li>
						<li><span>근무형태</span>: <?php echo $wr_work_type;?></li>
						<?php if($is_preferential){ ?>
						<li><span>우대조건</span>: <?php echo $wr_preferential;?></li>
						<?php } ?>
						<?php if($is_welfare){ ?>
						<li><span>복리후생</span>: <?php echo $wr_welfare_read;?></li>
						<?php } ?>
						</ul>
					</div>
					<div class="jobContent2">
						<h3 class="tit">모집직종</h3>
						<p> : <?php echo $wr_job_type0;?> <?php echo $wr_job_type1;?> <?php echo $wr_job_type2;?></p>
						<?php if($wr_job_type3){ ?>
							<h3 class="tit">&nbsp;</h3>
							<p> : <?php echo $wr_job_type3;?> <?php echo $wr_job_type4;?> <?php echo $wr_job_type5;?></p>
						<?php } ?>
						<?php if($wr_job_type6){ ?>
							<h3 class="tit">&nbsp;</h3>
							<p> : <?php echo $wr_job_type6;?> <?php echo $wr_job_type7;?> <?php echo $wr_job_type8;?></p>
						<?php } ?>
					</div>

					<div class="jobContent3">
						<ul>
							<li>
								<span>담당자</span>: 
								<strong><?php echo $wr_person;?></strong> 
								<?php if($open_is_pay && $is_admin==false){ ?>
									<?php if($is_open_count && $is_open_alba && $service_open){ ?>
										<?php if($sms_use && ($member['mb_type'] == 'individual' && $get_alba['wr_hphone'])){ ?>
											<em class="letter" onclick="sms_send('<?php echo $no;?>','<?php echo $wr_id;?>');">문자보내기</em>
										<?php } ?>
									<?php } ?>
								<?php } else { ?>
									<?php if($sms_use && ($member['mb_type'] == 'individual' && $get_alba['wr_hphone'])){ ?>
										<em class="letter" onclick="sms_send('<?php echo $no;?>','<?php echo $wr_id;?>');">문자보내기</em>
									<?php } ?>
								<?php } ?>
								<?php 
								if($env['memo_use']){
									if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 
										if( $is_open_alba && $service_open ){
								?>
									<em class="letter2" onclick="win_open('/send/index.php?type=employ&no=<?php echo $no;?>','send_window',721,450);">쪽지보내기</em>
								<?php
										}
									} else {
										if($is_member){
								?>
									<em class="letter2" onclick="win_open('/send/index.php?type=employ&no=<?php echo $no;?>','send_window',721,450);">쪽지보내기</em>
								<?php
										}
									}
								}
								?>
							</li>
							<li><span>e-메일</span>: <?php echo $wr_email;?></li>
							<li><span>전화번호</span>: <?php echo $wr_phone;?></li>
							<li><span>휴대폰</span>: <?php echo $wr_hphone;?></li>
							<li><span>팩스번호</span>: <?php echo $wr_fax;?></li>
						</ul>
					</div>
					<?php if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 ?>
						<?php if( $is_open_alba && $service_open ) { // $is_open_count && ?>
							<div class="jobContent4">
								<h3>지원방법</h3>
								<ul class="type01">
									<li class="<?php echo (@in_array('phone',$wr_requisition))?'on':'off';?>">전화연락</li>
									<li class="<?php echo (@in_array('meet',$wr_requisition))?'on':'off';?>">방문접수</li>
									<li class="<?php echo (@in_array('post',$wr_requisition))?'on':'off';?>">우편</li>
									<li class="<?php echo (@in_array('fax',$wr_requisition))?'on':'off';?>">팩스</li>
									<li class="<?php echo (@in_array('homepage',$wr_requisition))?'on':'off';?>">홈페이지</li>
								</ul>
								<ul style="width:506px;margin-left:25px;">
									<?//php if(!$get_alba['wr_is_admin']){ // 관리자 등록이 아닐때만 지원 가능 ?>
										<?php if(@in_array('online',$wr_requisition)){ ?>
										<li class="online"><a href="javascript:online_becomes('<?php echo $no;?>','online');"><img  src="../images/basic/btn_online1.gif" width="145" height="42" alt="온라인입사지원" /></a></li>
										<?php } ?>
									<?//php } ?>
									<?php if(@in_array('email',$wr_requisition)){ ?>
									<li class="online"><a href="javascript:online_becomes('<?php echo $no;?>','email');"><img  src="../images/basic/btn_email1.gif" width="145" height="42" alt="이메일입사지원" /></a></li>
									<?php } ?>
									<?php if(@in_array('homepage',$wr_requisition)){ ?>
									<li class="email"><a href="<?php echo $get_alba['wr_homepage'];?>" target="_blank"><img  src="../images/basic/btn_home.gif" width="145" height="42" alt="홈페이지입사지원" /></a></li>
									<?php } ?>
								</ul>
							</div>
						<?php } ?>
					<?php } else { ?>
					<div class="jobContent4">
						<h3>지원방법</h3>
						<ul class="type01">
							<li class="<?php echo (@in_array('phone',$wr_requisition))?'on':'off';?>">전화연락</li>
							<li class="<?php echo (@in_array('meet',$wr_requisition))?'on':'off';?>">방문접수</li>
							<li class="<?php echo (@in_array('post',$wr_requisition))?'on':'off';?>">우편</li>
							<li class="<?php echo (@in_array('fax',$wr_requisition))?'on':'off';?>">팩스</li>
							<li class="<?php echo (@in_array('homepage',$wr_requisition))?'on':'off';?>">홈페이지</li>
						</ul>
						<ul style="width:506px;margin-left:25px;">
							<?php if(!$get_alba['wr_is_admin']){ // 관리자 등록이 아닐때만 지원 가능 ?>
								<?php if(@in_array('online',$wr_requisition)){ ?>
								<li class="online"><a href="javascript:online_becomes('<?php echo $no;?>','online');"><img  src="../images/basic/btn_online1.gif" width="145" height="42" alt="온라인입사지원" /></a></li>
								<?php } ?>
							<?php } ?>
							<?php if(@in_array('email',$wr_requisition)){ ?>
							<li class="email"><a href="javascript:online_becomes('<?php echo $no;?>','email');"><img  src="../images/basic/btn_email1.gif" width="145" height="42" alt="이메일입사지원" /></a></li>
							<?php } ?>
							<?php if(@in_array('homepage',$wr_requisition)){ ?>
							<li class="email"><a href="<?php echo $get_alba['wr_homepage'];?>" target="_blank"><img  src="../images/basic/btn_home.gif" width="145" height="42" alt="홈페이지입사지원" /></a></li>
							<?php } ?>
						</ul>
					</div>
					<?php } ?>
					<!--  right: 내용 end  --> 
					</li>
				</ul>
				</li>
				</ul>
			</div><!--  채용공고내용 end -->
		</div>
		<!--  채용공고 end --> 

		<!--  상세요강 -->
		<div class="listWrap mt30">
			<h2 class="skip">상세요강</h2>
			<ul id="tab1" class="detailTab clearfix">
				<li class="tab1 on"><a onclick="" class="on" href="#tab1">상세요강</a></li>
				<li class="tab2"><a onclick="" href="#tab2">지원정보/방법</a></li>
				<li class="tab3"><a onclick="" href="#tab3">근무환경</a></li>
				<li class="tab4"><a onclick="" href="#tab4">채용댓글</a></li>
			</ul> 

			<?php if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 ?>

				<?php if( $service_open || $is_open_alba ) { // 열람 기간이 있다면 ?>
				<div class="jobContentBox clearfix positionR mt10">
					<ul>
						<li><?php echo $wr_content;?></li>
					</ul>
				</div>
				<?php } else if( $is_open_count && !$is_open_alba ){ ?>
				<div class="resumeOpen  tc">
					<ul>
						<li class="pt20"><strong>사용가능한 채용공고 열람권이 <?php echo $is_open_count;?>건 있습니다 열람권을 사용하시면 열람이 가능합니다.</strong></li>
						<li class="pt20">
							<a href="javascript:void(0);" onclick="open_alba('<?php echo $no;?>','<?php echo $get_alba['wr_id'];?>','alba', '<?php echo $is_open_count;?>');"><img width="192" height="28" alt="채용공고열람서비스 신청" src="../images/basic/btn_job1.png" class="bg_color5"></a>
						</li>
					</ul>
				</div>
				<?php } else { ?>
				<div class="resumeOpen  tc"><!--  자기소개서 열람서비스 신청 배너 -->
					<ul>
						<li class="pt20"><strong>상세요강 내용을 열람하시려면 <span class="text_color">채용공고 열람서비스</span>를 신청하세요.</strong></li>
						<li class="pt20">
							<a href="<?php echo $alice['individual_path'];?>/open_service.php"><img width="192" height="28" alt="채용공고열람서비스 신청" src="../images/basic/btn_job2.png" class="bg_color5"></a>
						</li>
					</ul>
				</div>
				<?php } ?>
			<?php } else { ?>
				<div class="jobContentBox clearfix positionR mt10">
					<ul>
						<li><?php echo $wr_content;?></li>
					</ul>
				</div>
			<?php } ?>

		</div>
		<!--  상세요강end--> 

		<!--  접수기간방법 -->
		<div class="listWrap mt30">
			<h2 class="skip">접수기간/방법</h2>
			<ul id="tab2" class="detailTab clearfix">
				<li class="tab1"><a class="on" href="#tab1">상세요강</a></li>
				<li class="tab2 on"><a href="#tab2">지원정보/방법</a></li>
				<li class="tab3"><a href="#tab3">근무환경</a></li>
				<li class="tab4"><a href="#tab4">채용댓글</a></li>
			</ul> 
			<div class="jobContentWrap clearfix positionR mt10">
				<ul>
					<li>
						<span><strong>모집마감일</strong></span>
						<strong><?php echo $volume_end_date;?></strong>
					</li>
					<li>
						<span><strong>담당자명</strong></span>
						<?php echo $wr_person;?>
						<?php if($open_is_pay && $is_admin==false){ ?>
							<?php if($is_open_count && $is_open_alba && $service_open){ ?>
								<?php if($sms_use && ($member['mb_type'] == 'individual' && $get_alba['wr_hphone'])){ ?>
									<em class="letter" onclick="sms_send('<?php echo $no;?>','<?php echo $wr_id;?>');">문자보내기</em>
								<?php } ?>
							<?php } ?>
						<?php } else { ?>
							<?php if($sms_use && ($member['mb_type'] == 'individual' && $get_alba['wr_hphone'])){ ?>
								<em class="letter" onclick="sms_send('<?php echo $no;?>','<?php echo $wr_id;?>');">문자보내기</em>
							<?php } ?>
						<?php } ?>
					</li>                  
					<li>
						<span><strong>연락처</strong></span>
						<?php if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 ?>
							<?php if( $is_open_count && $is_open_alba && $service_open ) { ?>
								<em><strong>TEL:</strong> <?php echo $wr_phone;?></em> <em><strong>HP:</strong><?php echo $wr_hphone;?></em> <em><strong>FAX:</strong><?php echo $wr_fax;?></em>
							<?php } else { ?>
								<?php echo $wr_phone;?>
							<?php } ?>
						<?php } else { ?>
							<em><strong>TEL:</strong> <?php echo $wr_phone;?></em> <em><strong>HP:</strong><?php echo $wr_hphone;?></em> <em><strong>FAX:</strong><?php echo $wr_fax;?></em>
						<?php } ?>
					</li>

					<?php if($is_papers){?>
					<li><span><strong>제출서류</strong></span><?php echo $get_alba['wr_papers'];?></li>
					<?php } ?>

					<?php if($open_is_pay && $is_admin==false){	// 열람서비스를 사용한다면 ?>
						<?php if( $is_open_count && $is_open_alba && $service_open ) { ?>
						<li class="gibReadSum positionR pt5 clearfix">
							<span><strong>지원방법</strong></span>
							<div class="clearfix">
								<ul>
									<li class="<?php echo (@in_array('phone',$wr_requisition))?'on':'off';?>">전화연락</li>
									<li class="<?php echo (@in_array('meet',$wr_requisition))?'on':'off';?>">방문접수</li>
									<li class="<?php echo (@in_array('post',$wr_requisition))?'on':'off';?>">우편</li>
									<li class="<?php echo (@in_array('fax',$wr_requisition))?'on':'off';?>">팩스</li>
									<li class="<?php echo (@in_array('homepage',$wr_requisition))?'on':'off';?>">홈페이지</li>
								</ul>
							</div>
							<div class="imgBtn clearfix">
								<ul>
									<?php if(!$get_alba['wr_is_admin']){ // 관리자 등록이 아닐때만 지원 가능 ?>
										<?php if(@in_array('online',$wr_requisition)){ ?>
										<li class="online"><a href="javascript:online_becomes('<?php echo $no;?>','online');"><img  src="../images/basic/btn_online1.gif" width="145" height="42" alt="온라인입사지원" /></a></li>
										<?php } ?>
									<?php } ?>
									<?php if(@in_array('email',$wr_requisition)){ ?>
									<li class="email"><a href="javascript:online_becomes('<?php echo $no;?>','email');"><img  src="../images/basic/btn_email1.gif" width="145" height="42" alt="이메일입사지원" /></a></li>
									<?php } ?>
								</ul>
							</div>
						</li>
						<?php } ?>
					<?php } else { ?>
						<li class="gibReadSum positionR pt5 clearfix">
							<span><strong>지원방법</strong></span>
							<div class="clearfix">
								<ul>
									<li class="<?php echo (@in_array('phone',$wr_requisition))?'on':'off';?>">전화연락</li>
									<li class="<?php echo (@in_array('meet',$wr_requisition))?'on':'off';?>">방문접수</li>
									<li class="<?php echo (@in_array('post',$wr_requisition))?'on':'off';?>">우편</li>
									<li class="<?php echo (@in_array('fax',$wr_requisition))?'on':'off';?>">팩스</li>
									<li class="<?php echo (@in_array('homepage',$wr_requisition))?'on':'off';?>">홈페이지</li>
								</ul>
							</div>
							<div class="imgBtn clearfix">
								<ul>
									<?php if(!$get_alba['wr_is_admin']){ // 관리자 등록이 아닐때만 지원 가능 ?>
										<?php if(@in_array('online',$wr_requisition)){ ?>
										<li class="online"><a href="javascript:online_becomes('<?php echo $no;?>','online');"><img  src="../images/basic/btn_online1.gif" width="145" height="42" alt="온라인입사지원" /></a></li>
										<?php } ?>
									<?php } ?>
									<?php if(@in_array('email',$wr_requisition)){ ?>
									<li class="email"><a href="javascript:online_becomes('<?php echo $no;?>','email');"><img  src="../images/basic/btn_email1.gif" width="145" height="42" alt="이메일입사지원" /></a></li>
									<?php } ?>
									<?php if(@in_array('homepage',$wr_requisition)){ ?>
									<li class="email"><a href="<?php echo $get_alba['wr_homepage'];?>" target="_blank"><img  src="../images/basic/btn_home.gif" width="145" height="42" alt="홈페이지입사지원" /></a></li>
									<?php } ?>
								</ul>
							</div>
						</li>
					<?php } ?>
					<?php if($form_question['view']=='yes'){ ?>
					<li class="interview clearfix pt5 mt20" >
						<span><strong>사전질문</strong></span>
						<dl>
							<dt class="info"><strong><?php echo $company_name;?></strong>에 입사지원시 아래 질문에 대한 답변을  함께 보내주세요.</dt> 
							<dd class="question"><?php echo nl2br(stripslashes($get_alba['wr_pre_question']));?></span>
							</dd>
						</dl>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<!--  접수기간방법 end--> 

		<!--  근무환경 -->
		<div class="listWrap mt30">
			<h2 class="skip">근무환경</h2>
			<ul id="tab3" class="detailTab clearfix">
				<li class="tab1"><a class="on" href="#tab1">상세요강</a></li>
				<li class="tab2"><a href="#tab2">지원정보/방법</a></li>
				<li class="tab3 on"><a href="#tab3">근무환경</a></li>
				<li class="tab4"><a href="#tab4">채용댓글</a></li>
			</ul> 
			<div class="jobContentWrap clearfix positionR mt10">
				<ul class="welfare">
					<?php if($wr_welfare){ ?>
					<li class="positionR clearfix">
						<span><strong>복리후생</strong></span>
						<ul class="welfarelist">
						<?php 
							foreach($wr_welfare as $key => $val){ 
							$keys = $category_control->get_categoryCodeName($key);
							$vals_cnt = count($val);
							$vals_arr = array();
							for($i=0;$i<$vals_cnt;$i++){
								$val_name = $category_control->get_categoryCodeName($val[$i]);
								array_push($vals_arr,$val_name);
							}
						?>
							<li class="">
								<span><strong><?php echo $keys;?></strong></span>
								<?php echo implode($vals_arr,", ");?>
							</li>
						<?php }	// foreach end. ?>
						</ul>
					</li>
					<?php } ?>
					<li>
						<span><strong>급여조건</strong></span>
						<?php echo ($pay_conference) ? "<strong>".$alba_user_control->pay_conference[$pay_conference]."</strong>" : $pay_type." ".$wr_pay; ?>
					</li>
					<?php if($job_subway){ ?>
					<li>
						<span><strong>인근지하철</strong></span>
						<img class="vm pr5" src="<?php echo $job_subway['line_icon'];?>" width="35" height="15"/><?php echo $job_subway['station'];?> <?php echo $job_subway['content'];?>
					</li>
					<?php } ?>
					<li class="clearfix">
						<span><strong>근무지역</strong></span>
						<?php echo $wr_area;?>
						<?php if($is_map){ // 지도 좌표값이 있는 경우 지도 출력 ?>
						<div class="map pt5">
							<div id="map" style="border:1px solid #999; width:672px;height:319px;"></div>
							<em>※ 지도는 근무지 위치를 나타내며 회사 소재지와 일치하지 않을 수 있습니다.</em>
						</div> 
						<?php } ?>
					</li>
					<li class="photo clearfix">
						<span><strong>Photo</strong></span>
						<div class="positionR clearfix">
						<ul>
							<li>
								<div class=" picture">
									<img src="<?php echo $wr_photo_0;?>" style="max-width:116px;max-height:85px;<?php echo (is_file($photo_0_file))?'cursor:pointer;':'';?>" <?php if(is_file($photo_0_file)){ ?>onclick="photo_view('<?php echo $wr_id;?>',0,'<?php echo $get_alba['wr_company'];?>','<?php echo $no;?>');"<?php } ?>>
								</div>
							</li>
							<li>
								<div class=" picture">
									<img src="<?php echo $wr_photo_1;?>" style="max-width:116px;max-height:85px;<?php echo (is_file($photo_1_file))?'cursor:pointer;':'';?>" <?php if(is_file($photo_1_file)){ ?>onclick="photo_view('<?php echo $wr_id;?>',1,'<?php echo $get_alba['wr_company'];?>','<?php echo $no;?>');"<?php } ?>>
								</div>
							</li>
							<li>
								<div class=" picture">
									<img src="<?php echo $wr_photo_2;?>" style="max-width:116px;max-height:85px;<?php echo (is_file($photo_2_file))?'cursor:pointer;':'';?>" <?php if(is_file($photo_2_file)){ ?>onclick="photo_view('<?php echo $wr_id;?>',2,'<?php echo $get_alba['wr_company'];?>','<?php echo $no;?>');"<?php } ?>>
								</div>
							</li>
							<li>
								<div class=" picture">
									<img src="<?php echo $wr_photo_3;?>" style="max-width:116px;max-height:85px;<?php echo (is_file($photo_3_file))?'cursor:pointer;':'';?>" <?php if(is_file($photo_3_file)){ ?>onclick="photo_view('<?php echo $wr_id;?>',3,'<?php echo $get_alba['wr_company'];?>','<?php echo $no;?>');"<?php } ?>>
								</div>
							</li>
							<li>
								<div class=" picture">
									<img src="<?php echo $wr_photo_4;?>" style="max-width:116px;max-height:85px;<?php echo (is_file($photo_4_file))?'cursor:pointer;':'';?>" <?php if(is_file($photo_4_file)){ ?>onclick="photo_view('<?php echo $wr_id;?>',4,'<?php echo $get_alba['wr_company'];?>','<?php echo $no;?>');"<?php } ?>>
								</div>
							</li>
						</ul>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<!--  근무환경 end--> 

		<!--  채용댓글 -->
		<div class="listWrap mt30">
		<h2 class="skip">채용댓글</h2>
		<ul id="tab4" class="detailTab clearfix">
			<li class="tab1"><a class="on" href="#tab1">상세요강</a></li>
			<li class="tab2"><a href="#tab2">지원정보/방법</a></li>
			<li class="tab3"><a href="#tab3">근무환경</a></li>
			<li class="tab4 on"><a href="#tab4">채용댓글</a></li>
		</ul> 
		<?php include_once $alice['alba_path']."/comment.php"; ?>
		</div>
		<!--  채용댓글 end--> 

			<!--  주의사항   -->
			<div style="display:block;" class="Caution mt50 mb20">
				<h3 class="skip">주의사항</h3>
				<ul>
				<li>본 정보는 <?php echo $wr_company_name;?>에서 <?php echo strtr($wdate,'-','/');?> 이후로 제공한 자료이며, <?php echo $env['site_name'];?>(은)는 그 내용상의 오류 및 지연, 그 내용을 신뢰하여 취해진 조치에 대하여 책임을 지지 않습니다.</li> 
				<li>본 정보는 <?php echo $env['site_name'];?>의 동의없이 재배포할 수 없습니다.<저작권자 ⓒ <?php echo $env['site_name'];?>. 무단전재-재배포 금지></li> 
				</ul>
			</div>
			<!--  주의사항 end   -->

		</div>

	</div>
</section>

<?php 
if($is_map){ 
	echo $map_script;
?>
<script>
<?php if($use_map=='daum'){ ?>
	var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
		mapOption = { 
			center: new daum.maps.LatLng(<?php echo $area_point;?>), // 지도의 중심좌표
			level: 3 // 지도의 확대 레벨
		};

	var map = new daum.maps.Map(mapContainer, mapOption);
	// 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
	var mapTypeControl = new daum.maps.MapTypeControl();
	// 지도에 컨트롤을 추가해야 지도위에 표시됩니다
	// daum.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
	map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);
	// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
	var zoomControl = new daum.maps.ZoomControl();
	map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);
	// 마커가 표시될 위치입니다 
	var markerPosition  = new daum.maps.LatLng(<?php echo $area_point;?>); 
	// 마커를 생성합니다
	var marker = new daum.maps.Marker({
		position: markerPosition
	});
	// 마커가 지도 위에 표시되도록 설정합니다
	marker.setMap(map);
	<?php if($company_info){?>
	var iwContent = '<div style="padding:5px;margin:0 auto;min-width:135px;text-align:center;"><?php echo $company_name;?></div>', // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
		iwPosition = new daum.maps.LatLng(<?php echo $area_point;?>); //인포윈도우 표시 위치입니다
	// 인포윈도우를 생성합니다
	var infowindow = new daum.maps.InfoWindow({
		position : iwPosition, 
		content : iwContent 
	});  
	// 마커 위에 인포윈도우를 표시합니다. 두번째 파라미터인 marker를 넣어주지 않으면 지도 위에 표시됩니다
	infowindow.open(map, marker);
	<?php } ?>

<?php } else if($use_map=='naver'){ ?>
	
	map_api.map_use("map", "", true);	// 지도 띄우기
	map_api.map_location_move(<?php echo $area_point;?>);
	map_api.addMark();

<?php } else if($use_map=='google'){ ?>

	map_api.map_point = [<?php echo $area_point;?>,'18'];
	map_api.map_use("map", "", true);
	map_api.addMark();

<?php } ?>

</script>
<?php } ?>