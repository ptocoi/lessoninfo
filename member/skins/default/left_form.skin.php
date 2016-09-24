<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script type="text/javascript" src="<?php echo $alice['member_path'];?>/skins/default/left_form.js"></script>
<script>
$(function(){
	$(":input[placeholder]").placeholder();
});
var left_reasons = function( vals ){
	var sel = vals.value;
	if(sel=='self'){
		$('#left_reason_txt').attr('required',true);
		$('#left_reason_txt_display').show();
	} else {
		$('#left_reason_txt').val("");
		$('#left_reason_txt').removeAttr('required');
		$('#left_reason_txt_display').hide();
	}
}
</script>

<section id="content" class="content_wrap clearfix">
	<div class="content1_wrap clearfix"> 
	<?php include_once $alice['include_path']."/banner.php"; ?>
		<?php /* navigation */ ?>
		<div class="NowLocation mt20 clearfix">
			<p> <a href="/">HOME</a> > <strong>회원탈퇴하기</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<?php /* sec navigation */ ?>
		<div class="secNav mt10 clearfix">
		<?php if($mb_type=='individual'){ // 개인회원 ?>
		<ul id="user">
			<li class="mn1"><a href="<?php echo $alice['member_path']?>/update_form.php"><em><img src="../images/basic/img_step4_off.png" width="69" height="31" alt="icon1"></em><img src="../images/basic/img_my_tit_step1_off.png" width="100" height="19" alt="개인정보 수정"></a></li>
			<li class="mn2"><a href="<?php echo $alice['member_path'];?>/password_form.php"><em><img src="../images/basic/img_step5_off.png" width="69" height="31" alt="icon2"></em><img src="../images/basic/img_my_tit_step2_off.png" width="100" height="19" alt="비밀번호 변경"></a></li>
			<li class="mn3 Rend on"><a href="<?php echo $alice['member_path'];?>/left_form.php"><em><img src="../images/basic/img_step6_on.png" width="69" height="31" alt="icon3"></em><img src="../images/basic/img_my_tit_step3_on.png" width="64" height="19" alt="회원탈퇴"></a></li>
		</ul>
		<?php } else if($mb_type=='company'){ // 기업회원 ?>
		<ul id="company">
			<li class="mn1"><a href="<?php echo $alice['member_path']?>/update_form.php"><em><img src="../images/basic/img_step4_off.png" width="69" height="31" alt="icon1"></em><img src="../images/basic/img_my_tit_step4_off.png" width="100" height="19" alt="개인정보 수정"></a></li>
			<li class="mn2"><a href="<?php echo $alice['member_path'];?>/password_form.php"><em><img src="../images/basic/img_step5_off.png" width="69" height="31" alt="icon2"></em><img src="../images/basic/img_my_tit_step2_off.png" width="100" height="19" alt="비밀번호 변경"></a></li>
			<li class="mn3 Rend on"><a href="<?php echo $alice['member_path'];?>/left_form.php"><em><img src="../images/basic/img_step6_on.png" width="69" height="31" alt="icon3"></em><img src="../images/basic/img_my_tit_step3_on.png" width="64" height="19" alt="회원탈퇴"></a></li>
		</ul>
		<?php } ?>
		</div>
		<?php /* //sec navigation */ ?>

		<form method="post" name="MemberLeftFrm" action="<?php echo $alice['member_path'];?>/process/regist.php" id="MemberLeftFrm" enctype="multipart/form-data" onsubmit="return validate(this);">
		<input type="hidden" name="ajax" value="false"/>
		<input type="hidden" name="mode" value="member_left" id="mode"/>
		<input type="hidden" name="mb_type" value="<?php echo $mb_type;?>"/>
		<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
		<input type="hidden" name="no" value="<?php echo $member['no'];?>"/>

		<div class="breakaway mt30">
			<h2 class="pb5"> <img src="../images/tit/my_nav_tit_03.gif" width="109" height="21" alt="비밀번호 확인"> </h2>      
			<ul class="titBox">
				<li> 1. 사용하고 계신 아이디 <?php echo $member['mb_id'];?>는 재사용 및 복구가 불가능합니다.</li>
				<li> 2. 추후 재가입 시 동일한 아이디로 재가입하실 수 없습니다.</li>
				<li> 3. 채용정보, 이력서 정보, 구인구직 활동내역, 유료서비스, e-머니가 모두 삭제됩니다.</li>
			</ul>
			<p class="help">
				<input type="checkbox" class="typeCheckbox" id="left_agreement" name="left_agreement" value="1" checked>
				<label class="help" for="left_agreement">위 내용에 동의합니다.</label>
			</p>
			<div class="registWrap mt20">
				<table>
				<caption><span class="skip">회원탈퇴 입력</span></caption>
				<colgroup><col width="214px"><col width="*"></colgroup>
				<tbody>
				<tr>
					<th scope="row"> <label>회원구분</label></th>
					<td><?php echo $member_control->mb_type[$mb_type];?></td>
				</tr>
				<tr>
					<th scope="row"> <label>아이디</label></th>
					<td><strong><?php echo $member['mb_id'];?></strong></td>
				</tr>  
				<tr>
					<th scope="row"> 
						<label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >비밀번호확인</label>
					</th>
					<td>
						<input type="password" class="ipText checkPwd" style="width:200px;" maxlength="16" id="mb_password" name="mb_password" required hname="비밀번호">
						<em class="help  text_help icon">비밀번호를 입력해 주십시오.</em>
					</td>
				</tr>           
				<tr>
					<th scope="row"><label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >e-mail</label></th>
					<td>
						<div class="mbrHelpWrap">
						<input type="text" class="ipText" style="width:200px;" maxlength="30" id="mb_email" name="mb_email" required hname="e-mail">
						</div>
					</td>
				</tr>
				<tr>
					<th class="bbend" scope="row" style="vertical-align:top;"><label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >탈퇴사유</label></th>
					<td class="bbend">
							<?php 
							if($left_reason){
								foreach($left_reason as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							?>
							<div>
							<input type="radio" name="left_reason" id="left_reason_<?php echo $val['code'];?>" value="<?php echo $name;?>" onclick="left_reasons(this);"/> 
							<label for="left_reason_<?php echo $val['code'];?>"><?php echo $name;?></label>
							<?php 
								} // foreach end.
							?>
							</div>
							<div>
							<input type="radio" name="left_reason" id="left_reason_self" value="self" onclick="left_reasons(this);"/> 
							<label for="left_reason_self">직접입력</label>
							</div>
							<?php
							}	// if end.
							?>
						<div id="left_reason_txt_display" style="padding-top:5px;display:<?php echo ($left_reason)?'none':'';?>;">
							<textarea name="left_reason_txt" class="ipTextarea" <?php echo ($left_reason)?"":'placeholder="*탈퇴 사유를 직접입력 해주세요."';?> id="left_reason_txt" style="width:680px; height:100px; padding:10px;" hname="탈퇴사유"></textarea>
						</div>
					</td>
				</tr>
				</tbody>
				</table>
				</div>
			</div>

			<div class="joinbtn clearfix mt30">
				<ul> 
				<li><div class="btn font_white bg_blueBlack"><a href="javascript:leftFrm_submit();">신청<img class="pb5"src="../images/icon/icon_arrow_right2.png" width="30" height="9" alt="arrow"></a></div></li>
				<li><div class="btn font_gray bg_white"><a href="/">취소<img class="pb5" src="../images/icon/icon_arrow_right3.png" width="30" height="9" alt="arrow"></a></div></li>
				</ul>
			</div>
		</div>

		</form>

	</div>
</section>