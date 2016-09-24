<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script type="text/javascript" src="<?php echo $alice['alba_path'];?>/skins/default/alba_adult.skin.js"></script>
<script>
$(function(){
	$(":input[placeholder]").placeholder();
});
</script>

<!--   본문 내용 영역   -->
<section id="content" class="content_wrap clearfix">
	<div class="adult mt50">
		<div class="textImg">
			<img src="../images/basic/img_19adult1.gif" width="148" height="148" alt="19">
			<img style="padding-bottom:15px;" src="../images/basic/img_19adult2.gif" width="538" height="114" alt="19">
		</div>
		<div class="outBtn clearfix">
			<ul>
				<li class="text">
					<strong>19세 미만 또는 성인인증을 원하지 않으실 경우</strong></br>
					청소년 유해 매체물을 제외한 <?php echo $env['site_name'];?>의 모든컨텐츠 및 서비스를 이용 하실 수 있습니다.
				</li>
				<li class="btn">
					<a href="/"><img src="../images/basic/btn_19adult.gif" width="145" height="37" alt="19세 미만 나가기"></a>
				</li>
			</ul>
		</div>
		<div class="loginWrap">
			<ul class="loginBox clearfix">
			<li class="certify">
				<dl>
					<dt><img src="../images/tit/tit_19adult<?php echo ($is_member)?'1':'2';?>.gif" width="127" height="21" alt="비회원 성인인증"></dt>
					<dd>
					<ul class="clearfix">
						<?//php if($use_ipin){ ?>
						<li>
							<input type="radio" name="certify_type" id="certify_type_ipin" value="ipin" onclick="certify_types(this);">
							<label for="certify_type_ipin">IPIN인증</label>
						</li>
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
						<form name="ipinStepFrm" action="<?php echo $alice['okname_path'];?>/ipin/adult1.php" method="post"></form>
						<?//php } ?>
						<?//php if($use_hphone){ ?>
						<li>
							<input type="radio" name="certify_type" id="certify_type_hphone" value="hphone" onclick="certify_types(this);">
							<label for="certify_type_hphone">휴대폰인증</label>
						</li>
						<div  class="phoneType" id="certify_info" style="display:none; width:100%; clear:both;">
							<ul>
							<li>
								<label class="title">이름</label>
								<input type="text" class="ipText2" style="width:130px;" maxlength="12" id="certify_name" name="certify_name" value="<?php echo $member['mb_name'];?>"/>
								<span class="option pl10">
									<input type="radio" class="chk" value="0" name="certify_gender" id="certify_gender_0" checked>
									<label>남</label>
									<input type="radio" class="chk" value="1" name="certify_gender" id="certify_gender_1" <?php echo ($member['mb_gender']=='1')?'checked':'';?>>
									<label>여</label>
								</span> 
							</li>	
								<li>
								<label class="title">생년월일</label>
								<span>
								<select title="년도선택" class="ipSelect2" name="certify_year" id="certify_year" style="width:80px">
								<option value="">년도</option>
								<?php for($i=date('Y')-15;$i>=1900;--$i){ ?>
									<option value='<?=$i?>' <?php echo ($birth_year==$i)?'selected':'';?>><?=$i?>년</option>
								<?php } ?>
								</select>
								<select title="월 선택" class="ipSelect2" name="certify_month" id="certify_month" style="width:59px">
								<option value="">월</option>
								<?php for($i=1;$i<=12;$i++){?>
								<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($birth_month==sprintf('%02d',$i))?'selected':'';?>><?php echo sprintf('%02d',$i);?>월</option>
								<?php } ?>
								</select>
								<select title="일 선택" class="ipSelect2" name="certify_day" id="certify_day" style="width:59px">
								<option value="">일</option>
								<?php for($i=1;$i<=31;$i++){?>
								<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($birth_day==sprintf('%02d',$i))?'selected':'';?>><?php echo sprintf('%02d',$i);?>일</option>
								<?php } ?>
								</select>
								</span> 
								</li>
								<li>
								<label class="title">휴대폰 번호</label>
								<span class="option">
									<input type="radio" name="telecom_cd" value="01" checked id="telecom_cd_01"><label for="telecom_cd_01">SKT</label>
									<input type="radio" name="telecom_cd" value="02" id="telecom_cd_02"><label for="telecom_cd_02">KT</label>
									<input type="radio" name="telecom_cd" value="03" id="telecom_cd_03"><label for="telecom_cd_03">LGU</label>
								</span>
								</li>
								<div class="option" style="margin-left:85px;">
									<select class="vm ipSelect2" name="certify_mobile_0" id="certify_mobile_0" style="width:45px">
									<?php for($i=0;$i<$hp_num_cnt;$i++){?>
									<option value="<?php echo $config->hp_num[$i];?>"><?php echo $config->hp_num[$i];?></option>
									<?php } ?>
									</select>
									<input type="text" class="ipText2" style="width:40px;" maxlength="4" name="certify_mobile_1" id="certify_mobile_1">
									<input type="text" class="ipText2" style="width:40px;" maxlength="4" name="certify_mobile_2" id="certify_mobile_2">
									<input style="cursor:pointer; width:90px; border-radius:0; border:1px solid #ddd;" type="button" value="인증번호 전송" onclick="certify_check();"/>
								</div>
								</ul>
							</div>
						<form name="cnFrm" action="<?php echo $alice['okname_path'];?>/hs_cnfrm/adultfrm_popup1.php" method="post" id="cnFrm">
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
						<?//php } ?>
					</ul>
					</dd>
				</dl>
			</li>

			<?php if(!$is_member){ // 비회원일때 ?>
			<li class="login">

			<form method="post" name="MemberLoginFrm" action="<?php echo $alice['member_path'];?>/process/login.php" id="MemberLoginFrm" onsubmit="return validate(this);">
			<input type="hidden" name="url" value="<?php echo $urlencode;?>"/>
			<input type="hidden" name="adult_certify" value="1"/>

				<dl>
					<dt><img src="../images/tit/tit_19adult3.gif" width="94" height="21" alt="회원 로그인"></dt>
					<dd>
					<ul>
						<li class="radio">
							<span><input type="radio" value="individual" name="mb_type" id="mb_individual" checked><label for="mb_individual">개인회원</label></span>
							<span><input type="radio" value="company" name="mb_type" id="mb_company" <?php echo ($type=='company')?'checked':'';?>><label for="mb_company">기업회원</label></span>
						</li>
						<li class="loginBox">
							<div style="width:212px;">
								<label class="skip">아이디</label>
								<input type="text" name="login_id" id="login_id" placeholder="아이디" style="width:180px;" class="ipText" required hname="아이디">
								<label class="skip">비밀번호</label>
								<input type="password" name="login_passwd" id="login_passwd" placeholder="비밀번호" style="width:180px;ime-mode:disabled;" class="ipText" required hname="비밀번호">
							</div>
							<div><a href="javascript:member_login();" class="loginButton"><span>로그인</span></a></div>
						</li>
					</ul>
					</dd>
				</dl>

			</form>
			</li>
			<?php } ?>

			</ul>
		</div>
		<div class="adultCopy">
		<p><strong><?php echo $HOST;?></strong></p>
		</div>
	</div>

</section>
<script>
<?php if($is_member){ ?>
alert("회원으로 로그인 하셨으나, 성인인증은 하지 않으셨습니다.\n\n성인인증을 진행해 주세요.");
<?php } ?>
</script>