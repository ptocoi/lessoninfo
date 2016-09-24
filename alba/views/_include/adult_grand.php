<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<div id="grand" class="style2 border<?php echo $design['adult_grand_border'];?><?php echo ($design['adult_grand_margin'])?' margin':'';?> number<?php echo $adult_grand_row;?> mt25 clearfix">
	<h2 class="mb5 title clearfix">
		<div class="fl"><img src="../images/tit/tit_03.gif" width="51" height="19" alt="title"></div>
		<div class="fl pr5 pt4" style="background-color:#fff;"><img style=" vertical-align:baseline;" src="../images/tit/tit_s_01.gif" width="55" height="15" alt="title"></div>
		<div class="fr pl5" style="background-color:#fff;"><a href="<?php echo $alice['service_path'];?>/"><img src="../images/main/btn_info_1.gif" width="54" height="17" alt="상품안내"></a></div>
	</h2>
	<ul class="clearfix">

		<!-- view layer -->
		<div class="quickView clearfix positionA" style="display:none; left:5px; z-index:2000;" id="grand_quickView"></div>
		<!-- // view layer -->

		<?php 
			foreach($grand_list['result'] as $key => $val){ 
			$no = $val['no'];
			$list = $alba_user_control->get_alba_service($no,"adult_grand");
		?>
		<li class="bth <?php echo $list['gold_service'];?>" id="grand_list_<?php echo $no;?>">
			<dl>
				<dt> 
					<a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>">
					<span class="logo"><?php echo $list['wr_logo'];?></span>
					<span class="logo_tit"><?php echo $list['company_name'];?></span>
					</a> 
				</dt>
				<dd class="text1"><?php echo $list['service_icon'];?><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?> <span class="edy edyEn"><?php echo $list['volume'];?></span></a></dd>
				<dd class="text2 clearfix">
					<span class="pay">
						<?php 
						if(!$list['wr_pay'] || $list['wr_pay']==0){ 
							echo "<strong>급여협의</strong>";
						} else { 
						?>
						<em class="icon"><?php echo $list['wr_pay_type'];?></em> <em class="number"><?php echo $list['wr_pay'];?></em>원
						<?php } ?>
					</span>
					<span class="add"><?php echo $list['wr_area'];?></span>
				</dd>                
				<dd class="icons">
					<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
					<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png"></a></div>
					<?php } ?>
					<div><a class="plus" href="javascript:grand_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
				</dd>
			</dl>
		</li>
		<?php } // foreach end. ?>

		<?php 
		if($grand_rest != $adult_grand_row){
			for($i=0;$i<$grand_rest;$i++){ 
			$Rend = ($i == ($grand_rest-1)) ? '' : '';
		?>
			<li class="bth bg <?php echo $Rend;?>"><!--신규광고 신청 -->
				<a style="background:url(../images/basic/bg_service1.gif) no-repeat 50% 50%;" class="service" href="<?php echo $alice['service_path'];?>/" target="_blank"></a>
			</li><!--신규광고 신청// -->
		<?php 
			}	// for end.
		}	// if end.
		?>
	</ul>
</div>

<script>
var grand_open = function( no ){	// 플래티넘 공고 상세보기
	var $grand_list = $('#grand_list_'+no);
	var position_top = $grand_list.position().top;

	$('#grand_quickView').hide();
	$('#grand_quickView').load('../main/views/_load/alba.php', { mode:'grand', no:no }, function(){
		position_tops = position_top - 2;
		$(this).css({
			"top" : position_tops+"px",
			"left" : "2px"
		});
		$(this).show();
	});
}
var grand_close = function(){	// 플래티넘 레이어 닫기
	$('#grand_quickView').hide();
}
</script>