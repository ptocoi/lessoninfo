<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<section id="content" class="content_wrap clearfix">
	<div class="content1_wrap clearfix"> 
		<?php include_once $alice['include_path']."/banner.php"; ?>
		<?php /* navigation */ ?>
		<div class="NowLocation mt20 clearfix">
			<p> <a href="/">HOME</a> >  <strong>이용약관</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<!--  content -->
		<div class="company mt30">
			<h2 class="pb5"> <img src="../images/tit/etc_tit_03.gif" alt="이용약관"> </h2>
			<div class="registWrap mt10" style="padding:15px;"><?php echo nl2br(stripslashes($env['site_agreement']));?></div>
		</div>
	</div>
</section>