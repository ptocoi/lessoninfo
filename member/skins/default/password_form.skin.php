<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script type="text/javascript" src="<?php echo $alice['member_path'];?>/skins/default/password_form.js"></script>
<script>
var passwordFrm_submit = function(){
	$('#PasswordUpdateFrm').submit();
}
</script>
<section id="content" class="content_wrap clearfix">
	<div class="content1_wrap clearfix"> 
	<?php include_once $alice['include_path']."/banner.php"; ?>
		<?php /* navigation */ ?>
		<div class="NowLocation mt20 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $mypage_path;?>">마이페이지</a> > <strong>비밀번호 수정</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<?php /* sec navigation */ ?>
		<div class="secNav mt10 clearfix">
		<?php if($mb_type=='individual'){ // 개인회원 ?>
		<ul id="user">
			<li class="mn1"><a href="<?php echo $alice['member_path']?>/update_form.php"><em><img src="../images/basic/img_step4_off.png" width="69" height="31" alt="icon1"></em><img src="../images/basic/img_my_tit_step1_off.png" width="100" height="19" alt="개인정보 수정"></a></li>
			<li class="mn2 on"><a href="<?php echo $alice['member_path'];?>/password_form.php"><em><img src="../images/basic/img_step5_on.png" width="69" height="31" alt="icon2"></em><img src="../images/basic/img_my_tit_step2_on.png" width="100" height="19" alt="비밀번호 변경"></a></li>
			<li class="mn3 Rend"><a href="<?php echo $alice['member_path'];?>/left_form.php"><em><img src="../images/basic/img_step6_off.png" width="69" height="31" alt="icon3"></em><img src="../images/basic/img_my_tit_step3_off.png" width="64" height="19" alt="회원탈퇴"></a></li>
		</ul>
		<?php } else if($mb_type=='company'){ // 기업회원 ?>
		<ul id="company">
			<li class="mn1"><a href="<?php echo $alice['member_path']?>/update_form.php"><em><img src="../images/basic/img_step4_off.png" width="69" height="31" alt="icon1"></em><img src="../images/basic/img_my_tit_step4_off.png" width="100" height="19" alt="개인정보 수정"></a></li>
			<li class="mn2 on"><a href="<?php echo $alice['member_path'];?>/password_form.php"><em><img src="../images/basic/img_step5_on.png" width="69" height="31" alt="icon2"></em><img src="../images/basic/img_my_tit_step2_on.png" width="100" height="19" alt="비밀번호 변경"></a></li>
			<li class="mn3 Rend"><a href="<?php echo $alice['member_path'];?>/left_form.php"><em><img src="../images/basic/img_step6_off.png" width="69" height="31" alt="icon3"></em><img src="../images/basic/img_my_tit_step3_off.png" width="64" height="19" alt="회원탈퇴"></a></li>
		</ul>
		<?php } ?>
		</div>
		<?php /* //sec navigation */ ?>

		<form method="post" name="PasswordUpdateFrm" action="<?php echo $alice['member_path'];?>/process/regist.php" id="PasswordUpdateFrm" enctype="multipart/form-data" onsubmit="return validate(this);">
		<input type="hidden" name="ajax" value="false"/>
		<input type="hidden" name="mode" value="password_update" id="mode"/>
		<input type="hidden" name="mb_type" value="<?php echo $mb_type;?>"/>
		<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
		<input type="hidden" name="no" value="<?php echo $member['no'];?>"/>

		<div class="password mt30">
			<h2 class="pb5"> <img src="../images/tit/my_nav_tit_04.gif" width="109" height="21" alt="비밀번호 확인"> </h2>
			<p class="help">비밀번호는 주기적(최소 6개월)으로 변경해 주시기 바랍니다.</p>
			<div class="registWrap mt10">
				<table>
				<caption><span class="skip">개인회원정보 입력폼</span></caption>
				<colgroup><col width="214px"><col width="*"></colgroup>
				<tbody>
				<tr>
					<th scope="row"> 
						<label><img alt="필수입력사항" src="../images/icon/icon_b.gif">현재 비밀번호</label>
					</th>
					<td><input type="password" class="ipText checkPwd" style="width:200px;" maxlength="16" id="mb_password" name="mb_password" required hname="비밀번호"></td>
				</tr>     
				<tr>
					<th scope="row"> 
						<label><img alt="필수입력사항" src="../images/icon/icon_b.gif">새로운 비밀번호</label>
					</th>
					<td>
						<input type="password" class="ipText checkPwd" style="width:200px;" maxlength="16" id="new_password" name="new_password" required hname="비밀번호" option="userpw">
						<em class="help  text_help icon">8~20자 사이의 영문, 숫자, 특수문자등으로 조합</em>
					</td>
				</tr>     
				<tr>
					<th scope="row" class="bbend"> 
						<label><img alt="필수입력사항" src="../images/icon/icon_b.gif">새로운 비밀번호확인</label>
					</th>
					<td class="bbend">
						<input type="password" class="ipText checkPwd" style="width:200px;" maxlength="16" id="new_password_re" name="new_password_re" required hname="비밀번호확인" option="userpw" matching="new_password">
						<em class="help  text_help icon">비밀번호를 입력해 주십시오.</em>
					</td>
				</tr>           

				</tbody>
				</table>
				</div>
			</div>

			<div class="passbtn clearfix mt30">
				<ul> 
					<li><div class="btn font_white bg_blueBlack"><a href="javascript:passwordFrm_submit();">수정<img class="pb5"src="../images/icon/icon_arrow_right2.png" width="30" height="9" alt="arrow"></a></div></li>     
				</ul>
			</div>
		</div>

	</div>
</section>