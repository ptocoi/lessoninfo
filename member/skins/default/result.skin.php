<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<section id="content" class="content_wrap clearfix">
	<div class="content1_wrap clearfix"> 
		<!--  banner  -->
		<div class="top_banner mt10 clearfix">
			<ul>
				<li class=""><a href="#"><img src="../images/ban/banner_content_01.gif" width="234" height="126" alt="banner"></a></li>
				<li class=""><a href="#"><img src="../images/ban/banner_content_04.gif" width="476" height="126" alt="banner"></a></li>
				<li class="Rend"><a href="#"><img src="../images/ban/banner_content_01.gif" width="234" height="126" alt="banner"></a></li>
			</ul>
		</div>
		<!--  banner end   --> 
		<!--  navigation  -->
		<div class="NowLocation mt20 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['member_path'];?>/register.php">회원가입</a> > <strong>회원가입완료</strong> </p>
		</div>
		<!--  navigation end  --> 
		<!--  sec navigation -->
		<div class="secNav mt10 clearfix">
			<ul>
				<li class="mn1"><em><img src="../images/basic/img_step1_off.png" width="69" height="24" alt="step1"></em><img src="../images/basic/img_tit_step1_off.png" width="150" height="19" alt="약관동의 및 본인확인"></li>
				<li class="mn2"><em><img src="../images/basic/img_step2_off.png" width="69" height="24" alt="step2"></em><img src="../images/basic/img_tit_step2_off.png" width="100" height="19" alt="정보입력"></li>
				<li class="mn3 on Rend"><em><img src="../images/basic/img_step3_on.png" width="69" height="24" alt="step3"></em><img src="../images/basic/img_tit_step3_on.png" width="64" height="19" alt="가입완료"></li>
			</ul>
		</div>
		<!-- sec navigation end  --> 
		<!--  content -->
		<div class="memberResult mt10">
			<h2 class="pb20"> <img src="../images/basic/img_member_end1.gif" width="286" height="37" alt="회원가입을 축하합니다."> </h2>
			<p><?php echo $member['mb_name'];?>님은 <span class="memberId text_blue"><?php echo $member['mb_id'];?></span>로 회원가입이 완료되었습니다.<br />
			<?php echo $env['site_name'];?>와 함께 행복한 취업 활동 하세요.</p>
			<div class="joinbtn clearfix mt30" style="width:150px;">
				<ul> 
				<li><div class="btn font_white bg_blueBlack"><a href="/">메인페이지</a></div></li>
				</ul>
			</div>
		</div>
		<!--  content end --> 
	</div>
</section>
