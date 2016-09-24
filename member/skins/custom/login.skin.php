<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script type="text/javascript" src="<?php echo $alice['member_path'];?>/views/_js/member.js"></script>
<script>
$(function(){
	$(":input[placeholder]").placeholder();
});
</script>

<section id="content" class="content_wrap clearfix">
	<div class="content1_wrap clearfix"> 

	<?php include_once $alice['include_path']."/banner.php"; ?>

		<form method="post" name="MemberLoginFrm" action="<?php echo $alice['member_path'];?>/process/login.php" id="MemberLoginFrm" onsubmit="return validate(this);">
		<input type="hidden" name="url" value="<?php echo $urlencode;?>"/>

		<div class="globalLoginWrap mt10">
			<div class="loginWrap clearfix">
				<h2 class="mt40 pb5"><img width="67" height="26" alt="로그인" src="../images/tit/member_tit_01.gif"></h2>
				<div class="text mt20 mb20">
					<p><strong>회원 서비스를 이용하시려면, 먼저 로그인하셔야 합니다.</strong></p>
					<p class="pt3">회원이 아니시라면, 지금 회원가입을 해 주세요.</p>
				</div>

				<ul class="loginBoxWrap clearfix">
					<li class="login bg_blue2 clearfix">

					<dl>
						<dt class="skip">로그인</dt>
						<dd>
							<ul>
								<li class="radio">
									<span><input type="radio" value="individual" name="mb_type" id="mb_individual" checked><label for="mb_individual">선생님</label></span>
									<span><input type="radio" value="student" name="mb_type" id="mb_student" <?php echo ($type=='student')?'checked':'';?>><label for="mb_student">학생(학부모)</label></span>
									<span><input type="radio" value="company" name="mb_type" id="mb_company" <?php echo ($type=='company')?'checked':'';?>><label for="mb_company">기업회원</label></span>
								</li>
								<li class="loginBox pt40 clearfix">
									<div class="loginInput">
										<label class="skip">아이디</label>
										<input type="text" name="login_id" id="login_id" placeholder="아이디" style="width:180px;" class="ipText" required hname="아이디" value="<?php echo $login_id;?>">
										<label class="skip">비밀번호</label>
										<input type="password" name="login_passwd" id="login_passwd" placeholder="비밀번호" style="width:180px;ime-mode:disabled;" class="ipText" required hname="비밀번호" value="<?php echo $login_password;?>">
									</div>
									<div><a href="javascript:member_login();" class="loginButton"><span>로그인</span></a></div>
								</li>
								<li class="loginLink pt5 pb50">
									<a href="<?php echo $alice['member_path'];?>/find_id.php"><span>아이디</span></a>/<a href="<?php echo $alice['member_path'];?>/find_pw.php"><span>비밀번호 찾기</span></a><a class="joinBtn pl20" href="<?php echo $alice['member_path'];?>/register.php"><span><strong>회원가입</strong></span></a>
								</li>
							</ul>
						</dd>
					</dl>

					</li>
					<li class="banner">
						<?php echo $etc_login_banner;?>
					</li>
				</ul>
			</div>
		</div>

		</form>

	</div>
</section>
