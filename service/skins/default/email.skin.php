<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>


<section id="content" class="content_wrap clearfix">
	<div class="content1_wrap clearfix"> 
		<?php include_once $alice['include_path']."/banner.php"; ?>
		<?php /* navigation */ ?>
		<div class="NowLocation mt20 clearfix">
			<p> <a href="/">HOME</a> >  <strong>이메일무단수집거부</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<!--  content -->
		<div class="company mt30">
			<h2 class="pb5"> <img src="../images/tit/etc_tit_07.gif" alt="이메일무단수집거부"></h2>
			<div class="registWrap mt10" style="padding:15px;">
				<div class=" mt10"><?php echo nl2br(stripslashes($env['email_denied']));?></div>
			</div>
		</div>
	</div>
</section>