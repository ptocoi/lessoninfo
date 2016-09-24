<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<script type="text/javascript" src="<?php echo $alice['member_path'];?>/skins/default/find_id.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<div class="content1_wrap clearfix"> 
		<?php include_once $alice['include_path']."/banner.php"; ?>

		<?php /* navigation */ ?>
		<div class="NowLocation mt20 clearfix">
			<p> <a href="/">HOME</a> > <strong>아이디찾기</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<?php /* sec navigation */ ?>
		<div class="secNav mt10 clearfix">
			<ul>
				<li class="mn1 on"><a href="./find_id.php"><em><img src="../images/basic/img_step7_on.png" width="69" height="31" alt="step1"></em><img src="../images/basic/img_tit_search_step1_on.png" width="84" height="19" alt="아이디찾기"></a></li>
				<li class="mn2 off"><a href="./find_pw.php"><em><img src="../images/basic/img_step8_off.png" width="69" height="31" alt="step2"></em><img src="../images/basic/img_tit_search_step2_off.png" width="100" height="19" alt="비밀번호찾기"></a></li>
				<li class="mn3 Rend"></li>
			</ul>
		</div>
		<?php /* //sec navigation */ ?>

		<div class="globalidSearchWrap mt10">
			<div class="idSearchWrap clearfix">
			<h2 class="mt40 pb5"><img width="120" height="26" alt="아이디찾기" src="../images/tit/member_tit_02.gif"></h2>
				<div class="text mt20 mb20"><strong>아래의 찾기 방법 중 하나를 선택해 주세요.</strong><br /></div>


				<ul class="idSearchBoxWrap clearfix">

					<li class="companySearch positionR clearfix">
					
					<dl>
						<dt><img width="160" height="21" alt="기업회원 아이디찾기" src="../images/tit/member_tit2_01.gif"></dt>
						<dd>
							<?php if($use_ipin){ ?>
								<div class="button positionA" style="display:none; text-align:center; bottom:30px; left:50%; margin-left:-80px;" id="company_ipin_button">
									<a href="javascript:jsSubmit();"><span><strong>기업회원 아이핀인증</strong></span></a>
								</div>
							<?php } ?>
							<?php if($use_hphone){ ?>
								<div class="button positionA" style="display:none; text-align:center; bottom:15px;*bottom:3px; left:50%; margin-left:-80px;" id="company_hphone_button">
									<a href="javascript:certify_hphone();"><span><strong>기업회원 아이디찾기</strong></span></a>
								</div>
							<?php } ?>
							<ul>
							<?php if($use_ipin || $use_hphone){ ?>
							<li class="radio">
								<?php if($use_ipin){ ?>
								<span> <input type="radio" id="certify_type_ipin" name="certify_type" value="ipin" onclick="certify_types(this,'company');"><label for="certify_type_ipin">아이핀(i-pin)</label></span>
								<?php } ?>
								<?php if($use_hphone){ ?>
								<span> <input type="radio" id="certify_type_hphone" name="certify_type" value="hphone" onclick="certify_types(this,'company');"><label for="certify_type_hphone">휴대폰 번호</label></span>
								<?php } ?>
							</li>
							<li class="ipinBox" style="display:none;" id="certify_type_ipins">
								<span><em class="text_blue">아이핀(I-PIN)인증</em>을 통해 회원님의<br /> <strong>아이디를 확인</strong>하실 수 있습니다.</span>
							</li>

							<?php if($use_hphone){ ?>
							<li class="emailBox hphone_set" style="display:none;">
								<ul class="Data">
								<li>
									<span><label class="title"><strong>가입자명</strong></label></span>
									<input type="text" name="certify_name" id="certify_name" maxlength="12" style="width:201px;" class="ipText">
								</li>
								<li>
									<span><label class="title"><strong>생년월일</strong></label></span>
									<span>
										<select title="년도선택" class="ipSelect" name="mb_birth_year" id="certify_year" style="width:80px" required hname="생년">
										<option value="">년도</option>
										<?php for($i=date('Y')-15;$i>=1900;--$i){ ?>
											<option value='<?=$i?>'><?=$i?>년</option>
										<?php } ?>
										</select>
										<select title="월 선택" class="ipSelect" name="mb_birth_month" id="certify_month" style="width:59px" required hname="생월">
										<option value="">월</option>
										<?php for($i=1;$i<=12;$i++){?>
										<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?>월</option>
										<?php } ?>
										</select>
										<select title="일 선택" class="ipSelect" name="mb_birth_day" id="certify_day" style="width:59px" required hname="생일">
										<option value="">일</option>
										<?php for($i=1;$i<=31;$i++){?>
										<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?>일</option>
										<?php } ?>
										</select>
									</span> 
								</li>
								<li>
									<span><label class="title"><strong>성별</strong></label></span>
									<input type="radio" value="0" name="certify_gender" id="certify_gender_0">
									<label>남</label>
									<input type="radio" value="1" name="certify_gender" id="certify_gender_1">
									<label>여</label>
								</li>
									<li class="hphone_set" style="display:none;">
								<span><label class="title"><strong>휴대폰</strong></label></span>
								<select title="통신사" name="telecom_cd" id="telecom_cd" style="width:202px;" class="mb3 ipSelect">
								<option value="01">SKT</option>
								<option value="02">KT</option>
								<option value="03">LGU</option>
								</select>

								<select title="휴대폰 국번" name="certify_mobile_0" id="certify_mobile_0" style="width:58px;" class="ipSelect">
								<?php for($i=0;$i<$hp_num_cnt;$i++){?>
								<option value="<?php echo $config->hp_num[$i];?>"><?php echo $config->hp_num[$i];?></option>
								<?php } ?>
								</select>
								<span class="delimiter">-</span>
								<input type="text" name="certify_mobile_1" id="certify_mobile_1" maxlength="4" title="휴대폰 앞자리" style="width:55px;" class="ipText">
								<span class="delimiter">-</span>
								<input type="text" name="certify_mobile_2" id="certify_mobile_2" maxlength="4" title="휴대폰 뒷자리" style="width:55px;" class="ipText">
							</li>
								</ul>
							</li>

						
							<?php } ?>

							<?php } else { ?>

							<li class="phoneBox" style="display:block;" >
								<ul class="Data">
								<li>
									<span><label class="title"><strong>사업자번호</strong></label></span>
									<span>
										<input type="text" name="mb_biz_no[]" id="mb_biz_no_0" maxlength="3" title="사업자번호1" class="ipText" style="width:50px;">
										<span class="delimiter">-</span>
										<input type="text" name="mb_biz_no[]" id="mb_biz_no_1" maxlength="2" title="사업자번호2" class="ipText" style="width:40px;">
										<span class="delimiter">-</span>
										<input type="text" name="mb_biz_no[]" id="mb_biz_no_2" maxlength="5" title="사업자번호3" class="ipText" style="width:73px;">
									</span> 
								</li>
								<li>
									<span><label class="name"><strong>가입자명</strong></label></span>
									<input type="text" name="mb_name" id="mb_name" maxlength="12" style="width:201px;" class="ipText">
								</li>
								<li class="boxes email_box">
									<span><label class="title"><strong>이메일</strong></label></span>
									<input type="text" class="ipText" maxlength="30" style="width:89px;" id="company_email" name="company_email[]" required hname="이메일">
									<span class="delimiter">@</span>
									<input type="text" maxlength="25" class="ipText" style="width:89px" title="이메일 서비스 제공자" id="company_email_tail" name="company_email[]" required hname="이메일 서비스 제공자">
								</li>
								</ul>
							</li>
							<div class="button positionA" style="display:<?php echo (!$use_ipin&&!$use_hphone)?'':'none';?>; text-align:center; bottom:30px; left:50%; margin-left:-80px" id="company_hphone_button">
								<a href="javascript:company_find_pw();"><span><strong>기업회원 아이디찾기</strong></span></a>
							</div>
							<!-- <div class="button positionA" style="display:<?php echo (!$use_ipin&&!$use_hphone)?'':'none';?>; text-align:center; bottom:7px; left:50%; margin-left:-80px" id="company_hphone_button">
								<a href=""><span><strong>기업회원 아이디찾기</strong></span></a>
							</div> -->
							<?php } ?>
							</ul>
						</dd>
					</dl>
					</li>

					<li class="personSearch positionR clearfix" style="display:block;">

					<dl>
						<dt><img width="160" height="21" alt="개인회원 아이디찾기" src="../images/tit/member_tit2_02.gif"></dt>
						<dd>
							<div class="button positionA individual_button" style="display:none; text-align:center; bottom:30px; left:50%; margin-left:-80px" id="individual_email_button">
								<a href="javascript:individual_find_id_email();"><span><strong>개인회원 아이디찾기</strong></span></a>
							</div>
							
							<div class="button positionA individual_button" style="display:none; text-align:center; bottom:15px; *bottom:3px; left:50%; margin-left:-80px" id="individual_hphone_button">
								<a href="javascript:individual_certify_hphone();"><span><strong>개인회원 아이디찾기</strong></span></a>
							</div>
							
							<div class="button positionA individual_button" style="display:none; text-align:center; bottom:30px; left:50%; margin-left:-80px" id="individual_ipin_button">
								<a href="javascript:jsSubmit();"><span><strong>개인회원 아이핀인증</strong></span></a>
							</div>

							<div class="button positionA individual_button" style="display:none; text-align:center; bottom:30px; left:50%; margin-left:-80px" id="individual_foreigner_button">
								<a href="#"><span><strong>외국인 아이디찾기</strong></span></a>
							</div>

							<ul class="clearfix">
							<li class="radio">
								<span><input type="radio" name="individual_find_set" id="individual_find_email" value="email" onclick="individual_find_sets(this);"><label for="individual_find_email">이메일</label></span>
								<?php if($use_hphone){ ?>
								<span><input type="radio" name="individual_find_set" id="individual_find_hp" value="hphone" onclick="individual_find_sets(this);"><label for="individual_find_hp">휴대폰 번호</label></span>
								<?php } ?>
								<?php if($use_ipin){ ?>
								<span><input type="radio" name="individual_find_set" id="individual_find_ipin" value="ipin" onclick="individual_find_sets(this);"><label for="individual_find_ipin">아이핀(i-pin)</label></span>
								<?php } ?>
								<!-- <span><input type="radio" name="individual_find_set" id="individual_find_foreigner" value="foreigner" onclick="individual_find_sets(this);"><label for="individual_find_foreigner">외국인</label></span> -->
							</li>

							<li class="emailBox" style="display:none;" id="individual_box">
								<ul class="Data">

								<li class="boxes email_box hphone_box">
									<span><label class="title"><strong>이름</strong></label></span>
									<input type="text" name="certify_name" id="individual_certify_name" maxlength="12" style="width:201px;" class="ipText">
								</li>

								<li class="boxes email_box">
									<span><label class="title"><strong>이메일</strong></label></span>
									<input type="text" class="ipText" maxlength="30" style="width:89px;" id="individual_email" name="certify_email[]" required hname="이메일">
									<span class="delimiter">@</span>
									<input type="text" maxlength="25" class="ipText" style="width:89px" title="이메일 서비스 제공자" id="individual_email_tail" name="certify_email[]" required hname="이메일 서비스 제공자">
								</li>

								<li class="boxes hphone_box ipin_box">
									<span><label class="title"><strong>생년월일</strong></label></span>
									<span>
										<select title="년도선택" class="ipSelect" name="mb_birth_year" id="individual_certify_year" style="width:80px" required hname="생년">
										<option value="">년도</option>
										<?php for($i=date('Y')-15;$i>=1900;--$i){ ?>
											<option value='<?=$i?>'><?=$i?>년</option>
										<?php } ?>
										</select>
										<select title="월 선택" class="ipSelect" name="mb_birth_month" id="individual_certify_month" style="width:59px" required hname="생월">
										<option value="">월</option>
										<?php for($i=1;$i<=12;$i++){?>
										<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?>월</option>
										<?php } ?>
										</select>
										<select title="일 선택" class="ipSelect" name="mb_birth_day" id="individual_certify_day" style="width:59px" required hname="생일">
										<option value="">일</option>
										<?php for($i=1;$i<=31;$i++){?>
										<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?>일</option>
										<?php } ?>
										</select>
									</span> 
								</li>
								<li class="boxes hphone_box">
									<span><label class="title"><strong>성별</strong></label></span>
									<input type="radio" value="0" name="individual_certify_gender" id="individual_certify_gender_0">
									<label>남</label>
									<input type="radio" value="1" name="individual_certify_gender" id="individual_certify_gender_1">
									<label>여</label>
								</li>
								<li class="boxes hphone_box">
									<span class="vt"><label class="title vt"><strong>휴대폰</strong></label></span>
										<select title="통신사" name="telecom_cd" id="individual_telecom_cd" style="width:202px;" class="mb3 ipSelect">
										<option value="01">SKT</option>
										<option value="02">KT</option>
										<option value="03">LGU</option>
									</select>
									<!--<div style="display:inline-block;">
										<div style="padding-bottom:5px;">
											<input type="radio" value="01" name="telecom_cd" id="telecom_cd_01">
											<label for="telecom_cd_01">SKT</label>
											<input type="radio" value="02" name="telecom_cd" id="telecom_cd_02">
											<label for="telecom_cd_02">KT</label>
											<input type="radio" value="03" name="telecom_cd" id="telecom_cd_03">
											<label for="telecom_cd_03">LGU</label>
										</div>-->
										<select title="휴대폰 국번" name="certify_mobile_0" id="individual_certify_mobile_0" style="width:56px;" class="ipSelect">
											<?php for($i=0;$i<$hp_num_cnt;$i++){?>
											<option value="<?php echo $config->hp_num[$i];?>"><?php echo $config->hp_num[$i];?></option>
											<?php } ?>
										</select>
										<span class="delimiter">-</span>
										<input type="text" name="certify_mobile_1" id="individual_certify_mobile_1" maxlength="4" title="휴대폰 앞자리" style="width:55px;" class="ipText">
										<span class="delimiter">-</span>
										<input type="text" name="certify_mobile_2" id="individual_certify_mobile_2" maxlength="4" title="휴대폰 뒷자리" style="width:55px;" class="ipText">
									<!--</div>-->
								</li>

								<li class="boxes foreigner_box">
									<span><label class="title" style="letter-spacing:-0.1em;"><strong>외국인등록번호</strong></label></span>
									<input type="text" name="foreigner_ssn[]" id="foreigner_ssn_0" maxlength="6" title="앞자리" style="width:91px;" class="ipText">
									<span class="delimiter">-</span>
									<input type="password" name="foreigner_ssn[]" id="foreigner_ssn_1" maxlength="7" title="뒷자리" style="width:91px;" class="ipText">
									<!-- <p class="text mt5"><input type="checkbox" value="Y" name="agree_fgn" id="dev_foreChk">
									<label for="dev_foreChk">외국인등록번호 처리에 동의합니다.</label></p> -->
								</li>

								</ul>
							</li>

							<li class="boxes ipinBox" style="display:none;" id="ipin_box">
								<span><em class="text_blue">아이핀(I-PIN)인증</em>을 통해 회원님의<br /> <strong>아이디를 확인</strong>하실 수 있습니다.</span>
							</li>

							</ul>
						</dd>
					</dl>
					</li>
				</ul>

			</div>
		</div>
	</div>
</section>

<?php if($use_ipin){	// ipin 을 사용한다면 ?>
<form name="kcbOutForm" method="post">
	<input type="hidden" name="encPsnlInfo" />
	<input type="hidden" name="virtualno" />
	<input type="hidden" name="dupinfo" />
	<input type="hidden" name="realname" />
	<input type="hidden" name="cprequestnumber" />
	<input type="hidden" name="age" />
	<input type="hidden" name="sex" />
	<input type="hidden" name="nationalinfo" />
	<input type="hidden" name="birthdate" />
	<input type="hidden" name="coinfo1" />
	<input type="hidden" name="coinfo2" />
	<input type="hidden" name="ciupdate" />
	<input type="hidden" name="cpcode" />
	<input type="hidden" name="authinfo" />
</form>
<form name="ipinStepFrm" action="<?php echo $alice['okname_path'];?>/ipin/find_id1.php" method="post"></form>
<?php } ?>

<?php if($use_hphone){ // 휴대폰 인증을 사용한다면 ?>
<form name="cnFrm" action="<?php echo $alice['okname_path'];?>/hs_cnfrm/find_id1.php" method="post" id="cnFrm">
<input type="hidden" name="in_tp_bit" value="15"/><!-- 성명+생년월일+성별,내외국인구분+통신사,휴대폰번호 -->
<input type="hidden" name="name" id="cnfrm_name"/>
<input type="hidden" name="birthday" id="cnfrm_birthday"/>
<input type="hidden" name="gender" id="cnfrm_gender"/>
<input type="hidden" name="nation" id="cnfrm_nation"/><!-- 1 :: 내국인, 2 :: 외국인 -->
<input type="hidden" name="tel_com_cd" id="tel_com_cd"/><!-- 통신사 -->
<input type="hidden" name="tel_no" id="tel_no"/><!-- 휴대폰 번호 -->
</form>
<form name="kcbResultForm" method="post" >
	<input type="hidden" name="idcf_mbr_com_cd" 		value="" 	/>
	<input type="hidden" name="hs_cert_svc_tx_seqno" 	value=""	/>
	<input type="hidden" name="hs_cert_rqst_caus_cd" 	value="" 	/>
	<input type="hidden" name="result_cd" 				value="" 	/>
	<input type="hidden" name="result_msg" 				value="" 	/>
	<input type="hidden" name="cert_dt_tm" 				value="" 	/>
	<input type="hidden" name="di" 						value="" 	/>
	<input type="hidden" name="ci" 						value="" 	/>
	<input type="hidden" name="name" 					value="" 	/>
	<input type="hidden" name="birthday" 				value="" 	/>
	<input type="hidden" name="gender" 					value="" 	/>
	<input type="hidden" name="nation" 					value="" 	/>
	<input type="hidden" name="tel_com_cd" 				value="" 	/>
	<input type="hidden" name="tel_no" 					value="" 	/>
	<input type="hidden" name="return_msg" 				value="" 	/>
</form>  
<?php } ?>
