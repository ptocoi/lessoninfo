<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var use_all = <?php echo ($use_ipin && $use_hphone) ? 'true' : 'false';?>;	 // 인증 방식을 둘다 사용하는지 확인
var use_ipin = <?php echo ($use_ipin) ? 'true' : 'false';?>;	// 아이핀 사용 유무
var use_hphone = <?php echo ($use_hphone) ? 'true' : 'false';?>;	// 휴대폰 인증 사용 유무
</script>

<script type="text/javascript" src="<?php echo $alice['member_path'];?>/skins/default/register.js"></script>

<section id="content" class="content_wrap clearfix">

	<div class="content1_wrap clearfix">

		<?php 
			include_once $alice['include_path']."/banner.php"; 
			include_once $alice['include_path']."/navigation.php"; 
		?>

		<?php /* sec navigation */ ?>
		<div class="secNav mt10 clearfix">
			<ul>
				<li class="mn1 on"><em><img src="../images/basic/img_step1_on.png" width="69" height="24" alt="step1"></em><img src="../images/basic/img_tit_step1_on.png" width="150" height="19" alt="약관동의 및 본인확인"></li>
				<li class="mn2"><em><img src="../images/basic/img_step2_off.png" width="69" height="24" alt="step2"></em><img src="../images/basic/img_tit_step2_off.png" width="100" height="19" alt="정보입력"></li>
				<li class="mn3 Rend"><em><img src="../images/basic/img_step3_off.png" width="69" height="24" alt="step3"></em><img src="../images/basic/img_tit_step3_off.png" width="64" height="19" alt="가입완료"></li>
			</ul>
		</div>
		<?php /* //sec navigation */ ?>


		<?php /* content */ ?>
		<div class="adultWrap mt10">
			<div class="provWrap">
				<ul>
					<li class="prov mt15 mb15">
						<h2 class="mb5"><img src="../images/tit/member_nav_tit_01.gif" width="74" height="24" alt="회원약관"></h2>
						<div class="provBox"> <?php echo $utility->conv_content($site_agreement,1);?> </div>
						<ul class="agree mt5">
							<li>
								<label><input type="radio" name="member_agreement" value="1" checked id="member_agreement_1">동의합니다.</label>
							</li>
							<li>
								<label><input type="radio" name="member_agreement" value="0" id="member_agreement_0">동의하지 않습니다.</label>
							</li>
						</ul>
					</li>

					<li class="privacy mt15 mb15">
						<h2 class="mb5"><img src="../images/tit/member_nav_tit_02.gif" width="141" height="24" alt="개인정보보호정책"></h2>
						<div class="privacyBox"> <?php echo $utility->conv_content($site_privacy,1);?> </div>
						<ul class="agree mt5">
							<li>
								<label><input type="radio" name="site_privacy" value="1" checked id="site_privacy_1">동의합니다.</label>
							</li>
							<li>
								<label><input type="radio" name="site_privacy" value="0" id="site_privacy_0">동의하지 않습니다.</label>
							</li>
						</ul>
					</li>
				</ul>
			</div>

			<div class="confirm mt30">
				<?php if($use_ipin || $use_hphone){ ?>
				<h2><img src="../images/tit/member_nav_tit_03.gif" width="86" height="26" alt="본인인증"></h2>
				<?php if($register_form){ ?>
					<ul class="confirmTab clearfix">
					<?php if($register_form==1){ // 외국인 ?>
						<li class="tab2 foreigner_tab on"><a href="javascript:certify_foreigner(true);">외국인</a></li>
					<?php } else if($register_form==2){ // 모두 사용?>
						<li class="tab1 foreigner_tab on"><a href="javascript:certify_foreigner(false);">내국인</a></li>
						<li class="tab2 foreigner_tab"><a href="javascript:certify_foreigner(true);">외국인</a></li>
					<?php } else { // 내국인 ?>
						<li class="tab1 foreigner_tab on"><a href="javascript:certify_foreigner(false);">내국인</a></li>
					<?php } ?>
					</ul>
				<?php } else { // 기본 :: 내국인 ?>
					<ul class="confirmTab clearfix">
						<li class="tab1 foreigner_tab on"><a href="javascript:certify_foreigner(false);">내국인</a></li>
					</ul>
				<?php } ?>

				<div class="confirmWrap positionR" style="display:<?php echo (!$register_form||$register_form==2)?'':'none';?>;" id="native_form">
					<ul class="Data1">
						<li class="mt10">
							<label class="title">이름</label>
							<input type="text" class="ipText" style="width:202px;" maxlength="12" id="certify_name" name="certify_name" value="<?php echo $realname;?>"/>
						</li>
						<li class="birth">
							<label class="title">생년월일</label>
							<span>
							<select title="년도선택" class="ipSelect" name="certify_year" id="certify_year" style="width:80px">
							<option value="">년도</option>
							<?php for($i=date('Y')-15;$i>=1900;--$i){ ?>
								<option value='<?=$i?>' <?php echo ($birth_year==$i)?'selected':'';?>><?=$i?>년</option>
							<?php } ?>
							</select>
							<select title="월 선택" class="ipSelect" name="certify_month" id="certify_month" style="width:59px">
							<option value="">월</option>
							<?php for($i=1;$i<=12;$i++){?>
							<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($birth_month==sprintf('%02d',$i))?'selected':'';?>><?php echo sprintf('%02d',$i);?>월</option>
							<?php } ?>
							</select>
							<select title="일 선택" class="ipSelect" name="certify_day" id="certify_day" style="width:59px">
							<option value="">일</option>
							<?php for($i=1;$i<=31;$i++){?>
							<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($birth_day==sprintf('%02d',$i))?'selected':'';?>><?php echo sprintf('%02d',$i);?>일</option>
							<?php } ?>
							</select>
							</span> 
							<span class="option">
								<input type="radio" value="0" name="certify_gender" id="certify_gender_0" <?php echo ($sex=='1')?'checked':'';?>>
								<label>남</label>
								<input type="radio" value="1" name="certify_gender" id="certify_gender_1" <?php echo ($sex=='2')?'checked':'';?>>
								<label>여</label>
							</span> 
						</li>
						<?php if(!$virtualno){ ?>
						<li class="oddType bg_color2">
							<label class="title">인증방법</label>
							<div class="option">
								<?php if($use_ipin){ ?>
								<label><input type="radio" value="ipin" name="certify_type" id="certify_type_ipin" <?php echo ($use_ipin && !$use_hphone)?'checked':'';?> onclick="certify_types(this);">아이핀</label>
								<?php } ?>
								<?php if($use_hphone){ ?>
								<label><input type="radio" value="hphone" name="certify_type" id="certify_type_hphone" <?php echo (!$use_ipin && $use_hphone)?'checked':'';?> onclick="certify_types(this);">휴대폰</label>
								<?php } ?>
							</div>
						</li>
						<?php } ?>
						<?php if($use_hphone){ ?>
						<li class="oddType" style="display:<?php echo (!$use_ipin&&$use_hphone)?'':'none';?>;" id="hphone_set">
							<label class="title">휴대폰 번호</label>
							<div class="option">
								<input type="radio" name="telecom_cd" value="01" checked id="telecom_cd_01"><label for="telecom_cd_01">SKT</label>
								<input type="radio" name="telecom_cd" value="02" id="telecom_cd_02"><label for="telecom_cd_02">KT</label>
								<input type="radio" name="telecom_cd" value="03" id="telecom_cd_03"><label for="telecom_cd_03">LGU</label>
							</div>
							<div class="option">
								<select class="ipSelect" name="certify_mobile_0" id="certify_mobile_0" style="width:80px">
								<?php for($i=0;$i<$hp_num_cnt;$i++){?>
								<option value="<?php echo $config->hp_num[$i];?>"><?php echo $config->hp_num[$i];?></option>
								<?php } ?>
								</select> - 
								<input type="text" class="ipText" style="width:50px;" maxlength="4" name="certify_mobile_1" id="certify_mobile_1"> - 
								<input type="text" class="ipText" style="width:50px;" maxlength="4" name="certify_mobile_2" id="certify_mobile_2"> <!-- &nbsp;<input type="button" value="인증번호 전송" onclick="certify_check();"/> -->
							</div>
						</li>
						<?php } ?>
					</ul>
					<dl class="Tip" id="Tip_default">
						<dt>알림.</dt>
						<dd>아이디/비밀번호 찾기 등 본인 여부 확인이 필요한 경우를 위해 반드시 신분증에
						기재된 정보를 입력해 주세요.</br>
						(허위 정보를 입력한 경우 본인 확인이 불가할 수 있습니다.)</dd>
					</dl>
					<dl class="Tip" id="Tip_ipin" style="display:none;">
						<dt>알림.</dt>
						<dd>아이핀(I-Pin) 은 이용자의 개인정보 보호를 위해 주민등록번호를 제공하지 않고
						본인임을 확인 받을 수 있는 “인터넷상개인식별번호”입니다.
						</dd>
					</dl>
					<dl class="Tip" id="Tip_hphone" style="display:none;">
						<dt>알림.</dt>
						<dd>입력하신 휴대폰 번호로 [가입 인증번호]가 발송됩니다.<br/>
						인증번호 입력 후에 회원가입을 진행해 주세요. 휴대폰 인증은 1일 5회까지만
						가능합니다.<br/>
						3분 이상 기다려도 인증번호 문자가 수신되지 않을 경우 [인증번호 재전송]을
						클릭해 주세요. (인증비용 무료)</dd>
					</dl>
				</div>
				<?php } // use_ipin, use_hphone if end. ?>

				<div class="confirmWrap" style="display:<?php echo (!$register_form||$register_form==2)?'none':'';?>;" id="foreigner_form">
					<ul class="Data1">
						<li class="mt20">
							<label class="title">이름</label>
							<input type="text" class="ipText" style="width:202px;" maxlength="12" name="foreigner_name" id="foreigner_name">
						</li>
						<li class="birth">
							<label class="title">외국인등록번호</label>
							<span>
								<input type="text"  class="ipText" style="width:94px;" name="foreigner_num_0" id="foreigner_num_0" maxlength="6">
								<span class="delimiter">-</span> 
								<input type="password" class="ipText" style="width:93px;" name="foreigner_num_1" id="foreigner_num_1" maxlength="7">
							</span> 
						</li>
					</ul>
					<dl class="Tip">
						<dt>알림.</dt>
						<dd>
						<p>입력하신 외국인등록번호는 <?php echo $env['site_name'];?>에 별도 저장되지 않으며, 신용평가기관을 통한
						실명확인용으로만 이용됩니다.</p>
						<p>타인의 외국인등록번호를 임의로 사용하면 ‘출입국관리법’에 의해 이용제한 될 수
						있습니다.</p>
						</dd>
					</dl>
				</div>

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
				<form name="ipinStepFrm" action="<?php echo $alice['okname_path'];?>/ipin/step1.php" method="post"></form>
				<?php } ?>
				<?php if($use_hphone){ // 실명인증을 사용한다면 ?>
				<form name="cnFrm" action="<?php echo $alice['okname_path'];?>/hs_cnfrm/cnfrm_popup1.php" method="post" id="cnFrm">
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

				<!-- <div class="joinbtn clearfix">
					<span class="btn bg_blueBlack"><a href="javascript:<?php echo ($virtualno)?"next_step('individual');":"member_next('individual');";?>"><img  class="pr10" src="../images/basic/img_btn_tit1.png" width="92" height="18" alt="개인회원 가입"><img class="pb5"src="../images/icon/icon_arrow_right2.png" width="30" height="9" alt="arrow"></a></span>
					<span class="btn bg_Black"><a href="javascript:<?php echo ($virtualno)?"next_step('company');":"member_next('company');";?>"><img class="pr10" src="../images/basic/img_btn_tit2.png" width="92" height="18" alt="기업회원 가입"><img class="pb5" src="../images/icon/icon_arrow_right2.png" width="30" height="9" alt="arrow"></a></span>
				</div> -->
				<div class="joinbtn_info">
					<p>레슨인포의 회원가입은 모두 무료입니다. 아래의 유형 중 해당되는 곳을 클릭해 주세요.</p>	
				</div>
				
				<div class="joinbtn_box w100p row boot">
							<div class="col-xs-4">
								<div class="panel panel-default">
								  <div class="panel-heading center-block">
								    <h3 class="panel-title">학생(학부모)회원</h3>
								  </div>
								  <div class="panel-body">
								   <div>
								   		<ul>
								    		<li>학생</li>
								    		<li>학부모</li>
								    		<li>성인 등</li>
								    		<li>선생님을 구하는 개인회원</li>
								    	</ul>
								   	</div>
								  </div>
								  <div class="bottom-btn">
								  		<a class="bbtn btn-primary btn-block" href="javascript:<?php echo ($virtualno)?"next_step('student');":"member_next('student');";?>" role="button">가입신청</a>
								  </div>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="panel panel-default">
								  <div class="panel-heading">
								    <h3 class="panel-title">선생님(반주자)회원</h3>
								  </div>
								  <div class="panel-body">
								    <div>
								    	<ul>
								    		<li>개인레슨선생님</li>
								    		<li>학원강사</li>
								    		<li>지휘자 ,연주자, 반주자</li>
								    		<li>예체능 선생님</li>
								    	</ul>
								    </div>
								    
								  </div>
								  <div class="bottom-btn">
								  		<a class="bbtn btn-primary btn-block" href="javascript:<?php echo ($virtualno)?"next_step('individual');":"member_next('individual');";?>" role="button">가입신청</a>
								  </div>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="panel panel-default">
								  <div class="panel-heading center-block">
								    <h3 class="panel-title">학원(업체)회원</h3>
								  </div>
								  <div class="panel-body">
								   <div>
								   		<ul>
								   			<li>학원, 방문레슨 업체</li>
								   			<li>부동산, 컨설팅 업체</li>
								   			<li>악기, 용품판매 업체</li>
								   			<li>연습실, 공연장 대여</li>
								   			<li>기타 홍보/판매 업체</li>
								   		</ul>
								   </div>
								  </div>
								  <div class="bottom-btn">
								  		<a class="bbtn btn-primary btn-block" href="javascript:<?php echo ($virtualno)?"next_step('company');":"member_next('company');";?>" role="button">가입신청</a>
								  </div>
								</div>
							</div>
								
						</div>		
						

		</div>
		<?php /* //content */ ?>

	</div>

</section>
