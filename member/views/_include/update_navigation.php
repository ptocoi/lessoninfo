<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

	<div class="secNav mt10 clearfix">
	<?php if($mb_type=='individual'){ // 개인회원 ?>
	<ul id="user">
		<li class="mn1 <?php echo ($navi_page=='member_update')?'on':'';?>"><a href="<?php echo $alice['member_path']?>/update_form.php"><em><img src="../images/basic/img_step4_<?php echo ($navi_page=='member_update')?'on':'';?>.png" width="69" height="31" alt="icon1"></em><img src="../images/basic/img_my_tit_step1_<?php echo ($navi_page=='member_update')?'on':'';?>.png" width="100" height="19" alt="개인정보 수정"></a></li>

		<li class="mn2"><a href="./pwdchange.html"><em><img src="../images/basic/img_step5_off.png" width="69" height="31" alt="icon2"></em><img src="../images/basic/img_my_tit_step2_off.png" width="100" height="19" alt="비밀번호 변경"></a></li>
		<li class="mn3 Rend"><a href="./breakaway.html"><em><img src="../images/basic/img_step6_off.png" width="69" height="31" alt="icon3"></em><img src="../images/basic/img_my_tit_step3_off.png" width="64" height="19" alt="회원탈퇴"></a></li>
	</ul>
	<?php } else if($mb_type=='company'){ // 기업회원 ?>
	<ul id="company">
		<li class="mn1 <?php echo ($navi_page=='member_update')?'on':'';?>"><a href="<?php echo $alice['member_path']?>/update_form.php"><em><img src="../images/basic/img_step4_<?php echo ($navi_page=='member_update')?'on':'';?>.png" width="69" height="31" alt="icon1"></em><img src="../images/basic/img_my_tit_step4_<?php echo ($navi_page=='member_update')?'on':'';?>.png" width="100" height="19" alt="개인정보 수정"></a></li>

		<li class="mn2"><a href="./pwdchange.html"><em><img src="../images/basic/img_step5_off.png" width="69" height="31" alt="icon2"></em><img src="../images/basic/img_my_tit_step2_off.png" width="100" height="19" alt="비밀번호 변경"></a></li>
		<li class="mn3 Rend"><a href="./breakaway.html"><em><img src="../images/basic/img_step6_off.png" width="69" height="31" alt="icon3"></em><img src="../images/basic/img_my_tit_step3_off.png" width="64" height="19" alt="회원탈퇴"></a></li>
	</ul>
	<?php } ?>
	</div>
