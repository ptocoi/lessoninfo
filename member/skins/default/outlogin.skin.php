<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script type="text/javascript" src="<?php echo $alice['member_path'];?>/views/_js/member.js"></script>

	<fieldset>
	<legend>회원로그인</legend>         
<?php if($is_member){  ?>

	<?php /* 로그인후(개인회원) */ 
		if($mb_type=='individual'){
	?>
	<div style="display:block;">
		<div class="loginPerson clearfix">
			<dl style="padding-top: 12px;">
				<dt><a href="<?php echo $alice['individual_path'];?>/"><strong><?php echo $member['mb_name'];?></strong></a>님 (<?php echo stripslashes($member['mb_nick']);?>)</dt>
				<dd class="text"><span>등록 이력서</span><strong ><a class="text_blue"  href="<?php echo $alice['individual_path'];?>/alba_resume_list.php"><?php echo number_format($member['mb_alba_resume_count']);?> 건</a></strong></dd>
				<dd class="text"><span>스크랩 채용공고</span><strong class="text_blue"><a class="text_blue" href="<?php echo $alice['individual_path'];?>/alba_scrap.php"><?php echo number_format($member['mb_alba_scrap_count']);?> 건</a></strong></dd>
				<dd class="text"><span>포인트</span><strong class="text_blue"><a class="text_blue"><?php echo number_format($member['mb_point']);?> p</a></strong></dd>
				<?php if($env['memo_use']){ ?>
				<dd class="text"><span>미확인 쪽지<img class="psa" style="bottom:40px;" src="../images/icon/sms_mess.gif"></span><strong class="text_blue"><a class="text_blue" onclick="win_open('/send/memo_from.php','send_window',721,500);" style="cursor:pointer;"><?php echo number_format($viewed_memo['total_count']);?> 건</a></strong></dd>
				<?php } ?>
				<dd class="pic"><a href="<?php echo $alice['individual_path'];?>/"><img  src="<?php echo $mb_photo;?>"></a></dd>
			</dl>
		</div>
		<ul class="btn clearfix">
			<li><strong><a href="<?php echo $alice['member_path'];?>/update_form.php">개인정보수정</a></strong></li>
			<li class="logOutbtn"><a href="javascript:member_logout();">로그아웃</a></li>
		</ul>
	</div>
	<?php /* 로그인후(기업회원) */ 
		} else if($mb_type=='company'){ 
	?>
	<div  style="display:block;">
		<div class="loginCompany clearfix">
			<dl class="pt15">
				<dt><a href="<?php echo $alice['company_path'];?>/"><strong><?php echo $member['mb_name'];?></strong></a>님</dt>
				<dd class="text"><span>게재 중 공고</span><strong ><a class="text_blue"  href="<?php echo $alice['company_path'];?>/alba_list.php"><?php echo number_format($member['mb_alba_count']);?> 건</a></strong></dd>
				<dd class="text"><span>입사 지원자</span><strong class="text_blue"><a class="text_blue" href="<?php echo $alice['company_path'];?>/alba_apply_list.php"><?php echo number_format($member['mb_alba_resume_count']);?> 건</a></strong></dd>
				<dd class="text"><span>스크랩 인재</span><strong class="text_blue"><a class="text_blue" href="<?php echo $alice['company_path'];?>/alba_scrap.php"><?php echo number_format($member['mb_alba_scrap_count']);?> 건</a></strong></dd>
				<dd class="text"><span>포인트</span><strong class="text_blue"><a class="text_blue"><?php echo number_format($member['mb_point']);?> P</a></strong></dd>
				<?php if($env['memo_use']){ ?>
				<dd class="text"><span>미확인<img class="psa" style="bottom:40px;" src="../images/icon/sms_mess.gif"></span><strong class="text_blue"><a class="text_blue" onclick="win_open('/send/memo_from.php','send_window',721,500);" style="cursor:pointer;"><?php echo number_format($viewed_memo['total_count']);?> 건</a></strong></dd>
				<?php } ?>
				<dd class="pic"><a href="<?php echo $alice['company_path'];?>/"><img src="<?php echo $mb_logo;?>"><!--<img  src="../images/basic/bg_noLogo.gif"> 로고no --></a></dd>
			</dl>
		</div>
		<ul class="btn clearfix">
			<li><strong><a href="<?php echo $alice['company_path'];?>/alba_regist.php">채용공고 등록</a></strong></li>
			<li class="logOutbtn"><a href="javascript:member_logout();">로그아웃</a></li>
		</ul>
	</div>
	<?php } // 로그인 후 (개인/기업회원 구분) end.?>

<?php } else { // 로그인 전 ?>
	<div style="display:block;">
		<form method="post" name="MemberLoginFrm" action="<?php echo $alice['member_path'];?>/process/login.php" id="MemberLoginFrm" onsubmit="return validate(this);">
		<input type="hidden" name="url" value="<?php echo $urlencode;?>"/>
		<ul class="selectMem clearfix">
			<li><input type="radio" class="chk" value="individual" name="mb_type" id="mb_individual" checked> <label for="mb_individual">개인회원</label></li>
			<li class="pl5"><input type="radio" class="chk" value="company" name="mb_type" id="mb_company"> <label for="mb_company">기업회원</label></li>
			<li class="btnLogin"><input type="checkbox" class="chk" name="save_id" id="save_id" value="1" <?php echo ($save_id)?'checked':'';?>><label class="pl5" for="save_id">아이디저장</label></li>
		</ul>
		<div class="enter">
			<ul class="clearfix">
			<li>
				<p><label class="skip">아이디</label><input type="text" class="inputText" maxlength="20" name="login_id" id="login_id" value="<?php echo $save_id;?>" required hname="아이디"></p>
				<p><label class="skip">비밀번호</label><input type="password" class="inputText" size="18" name="login_passwd" id="login_passwd" required hname="비밀번호" value="<?php echo $save_password;?>"></p>
			</li>
			<li><p class="login"><a href="javascript:member_login();">로그인</a></p></li>
			</ul>
		</div>
		<ul class="btn">
			<li class="join"><a href="<?php echo $alice['member_path'];?>/register.php">회원가입</a></li>
			<li><a href="<?php echo $alice['member_path'];?>/find_id.php">아이디 찾기</a> / <a href="<?php echo $alice['member_path'];?>/find_pw.php">비밀번호 찾기</a></li>
		</ul>
		</form>
	</div>
<?php 
	}	// is_member if end.
?>
	</fieldset>
