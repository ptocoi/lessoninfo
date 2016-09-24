<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<body>

<script type="text/javascript" src="<?php echo $alice['popup_path'];?>/skins/default/login.skin.js"></script>

<script>
$(function(){
	$(":input[placeholder]").placeholder();
});
</script>

<div id="popup" class="positionR content_wrap clearfix">

	<form method="post" name="PopLoginFrm" action="<?php echo $alice['popup_path'];?>/process/login.php" id="PopLoginFrm" onsubmit="return validate(this);">
	<input type="hidden" name="url" value="<?php echo $urlencode;?>"/>
	<div class="popupLoginBox" style="display:block; width:480px; margin:0 auto; text-align:left; ">              
		<ul class="loginBoxWrap clearfix">
			<li class="login clearfix">
				<dl>
					<dt class=""><h2><img width="67" height="26" src="../images/tit/member_tit_01.gif" alt="로그인"></h2></dt>
					<dd>
						<ul>
							<li class="radio pb10">
								<span><input type="radio" value="individual" name="mb_type" id="mb_individual" checked><label for="mb_individual">개인회원</label></span>
								<span><input type="radio" value="company" name="mb_type" id="mb_company" <?php echo ($type=='company')?'checked':'';?>><label for="mb_company">기업회원</label></span>
							</li>
							<li class="loginBox  clearfix">
								<div class="loginInput">
									<label class="skip">아이디</label>
									<input type="text" name="login_id" id="pop_login_id" placeholder="아이디" style="width:140px;" class="ipText" required hname="아이디">
									<label class="skip">비밀번호</label>
									<input type="password" name="login_passwd" id="pop_login_passwd" placeholder="비밀번호" style="width:140px;ime-mode:disabled;" class="ipText" required hname="비밀번호">
								</div>
								<div><a href="javascript:popup_login();" class="loginButton"><span>로그인</span></a></div>
							</li>
						</ul>
					</dd>
					<dd class="loginLink">
					<a href="javascript:find_id();"><span>아이디</span></a>/<a href="javascript:find_password();"><span>비밀번호 찾기</span></a><a class="joinBtn pl20" href="javascript:popup_regist();"><span><strong>회원가입</strong></span></a>
					</dd>
				</dl>
			</li>
			<li class="banner">
				<!-- <img width="200" height="200" alt="광고배너" src="../images/ban/banner200200.gif"> -->
				<?php echo $etc_pop_login_banner;?>
			</li>
		</ul>
	</div>
	</form>

</div>