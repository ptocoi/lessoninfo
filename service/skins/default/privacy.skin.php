<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<section id="content" class="content_wrap clearfix">
	<div class="content1_wrap clearfix"> 
		<?php include_once $alice['include_path']."/banner.php"; ?>
		<?php /* navigation */ ?>
		<div class="NowLocation mt20 clearfix">
			<p> <a href="/">HOME</a> >  <strong>개인정보취급방침</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<!--  content -->
		<div class="company mt30">
			<h2 class="pb5"> <img src="../images/tit/etc_tit_04.gif" alt="개인정보취급방침"> </h2>
			<?php echo nl2br(stripslashes($env['site_privacy']));?>
		</div>
	</div>
</section>