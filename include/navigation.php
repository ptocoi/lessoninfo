<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

	<div class="NowLocation mt20 clearfix">
		<?php if($sub_navi_name){ ?>
		<p> <a href="/">HOME</a> > <a href="#"><?php echo $navi_name;?></a> > <strong><?php echo $sub_navi_name;?></strong> </p>
		<?php } else {?>
		<p> <a href="/">HOME</a> > <strong><?php echo $navi_name;?></strong> </p>
		<?php } ?>
	</div>
