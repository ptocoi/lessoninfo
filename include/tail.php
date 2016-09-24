<?php  if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<footer id="footer" class="clearfix">
	<div class="ftr_ad mt30 clearfix">
		<ul>			
			<?php echo ($bottom_banner) ? stripslashes($bottom_banner) : ""; ?>
		</ul>
	</div>
	<div class="ftr_banner">
		<div class="bannerWrap">
		<?php echo ($etc_bottom_banner)? stripslashes($etc_bottom_banner) : "";?>
		</div>
	</div>
	<div class="ftr_info">
		<div class="flogo"><?php echo $design_control->view_logo($logo['bottom']);?></div>
		<div class="adress"><?php echo stripslashes($env['site_bottom']);?></div>
		<?php if($env['use_digital']){ ?>
		<div class="online">
			<dl>
				<dt>온라인 디지털 콘텐츠 산업발전에 의한표시</dt>
				<dt><?php echo nl2br(stripslashes($env['digital_content']));?></dt>
			</dl>
		</div>
		<?php } ?>
		<button title="맨 위로 이동하기" onclick="window.scrollTo(0,0);" class="btn btnTop_1" type="button"></button>
	</div>
	<div class="ftr_service mb15">
		<ul>
			<li><a href="<?php echo $alice['service_path'];?>/company_info.php">회사소개</a></li>
			<li><a href="<?php echo $alice['service_path'];?>/agreement.php">이용약관</a></li>
			<li><a href="<?php echo $alice['service_path'];?>/privacy.php">개인정보취급방침</a></li>
			<li><a href="<?php echo $alice['service_path'];?>/advert.php">배너광고문의</a></li>
			<li><a href="<?php echo $alice['service_path'];?>/concert.php">제휴문의</a></li>
			<li><a href="<?php echo $alice['service_path'];?>/">서비스안내</a></li>
			<li><a href="<?php echo $alice['service_path'];?>/direct.php">다이렉트 결제</a></li>
			<li><a href="<?php echo $alice['service_path'];?>/email.php">이메일무단수집거부</a></li>
			<li class="Bgend"><a href="<?php echo $alice['rss_path'];?>/index.php?section=<?php echo $page_name;?>"><img src="../images/icon/icon_rss1.gif" width="12" height="11" alt="RSS"> RSS</a></li>
		</ul>
	</div>
	<div class="ftr_copy mb5">
		<p>Copyright ⓒ <strong><?php echo $HOST;?></strong> All Rights Reserved.</p>
	</div>

</footer>

<div style="clear:both"></div>

<?php if( $is_mobile || $_GET['device']=='pc' || $config->is_mobile() ){ ?>
<style>
.back55{padding:20px;display:block; clear:both; text-align:center; background-color:#d3d7d9;}
.PosiM{width:154px; margin:0 auto;}
</style>
<div class="back55">
<div class="PosiM"><ul class="Mbox"><li><a href="<?php echo $mobile_info['wr_mobile_url'];?>"><img src="http://netfu.co.kr/images/mobile/mobile_txt_big.gif"></a></li></ul></div></div>
<?php } ?>

<?php 
	$config_control->alice_visit_page($page_name);	 // 페이지별 방문자
	echo $config_control->_tail(true); 
?>