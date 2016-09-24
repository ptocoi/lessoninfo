<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<div id="list" class="style2 mt30 clearfix">
	<h2 class="mb5 title clearfix">
		<div class="fl"><img src="../images/tit/tit_05.gif" width="68" height="19" alt="title"></div>
		<div class="fl pr5 pt4" style="background-color:#fff;"><img style=" vertical-align:baseline;" src="../images/tit/tit_s_01.gif" width="55" height="15" alt="title"></div>
		<div class="fr pl5" style="background-color:#fff;"><a href="<?php echo $alice['service_path'];?>/"><img src="../images/main/btn_info_1.gif" width="54" height="17" alt="상품안내"></a></div>
	</h2>
	<ul class="clearfix">

		<!-- view layer -->
		<div class="quickView clearfix positionA" style="display:none; left:5px; z-index:2000;" id="list_quickView"></div>
		<!-- // view layer -->

		<?php 
			foreach($list_list['result'] as $key => $val){ 
			$no = $val['no'];
			$list = $alba_user_control->get_alba_service($no,"sub_list");
		?>
		<li class="bth <?php echo $list['gold_service'];?>" id="list_<?php echo $no;?>">
			<div class="listWrap clearfix">
				<span class="add"><?php echo $list['wr_area_cut'];?></span>
				<a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><span class="logo_tit"><?php echo $list['company_name'];?></span></a> 
				<span class="text1">
					<?php echo $list['service_icon'];?><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?> </a>
				</span>
				<div class="icons">
					<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
					<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png"></a></div>
					<?php } ?>
					<div><a class="plus" href="javascript:list_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
				</div>
			</div>
		</li>
		<?php } // foreach end. ?>

		<?php 
		if($list_rest != 2){ 
			for($i=0;$i<$list_rest;$i++){ 
		?>
		<!--신규광고 신청 -->
		<li class="bg">
			<a style="background:url(../images/basic/bg_service3.gif) no-repeat 50% 50%;" class="service" href="<?php echo $alice['service_path'];?>/" target="_blank"></a>
		</li>
		<!--신규광고 신청// -->
		<?php 
			} // for end.
		}	// if end.
		?>
		
	</ul>
</div>

<script>
var list_open = function( no ){	// 리스트형 공고 상세보기
	var $list = $('#list_'+no);
	var position_top = $list.position().top;

	$('#list_quickView').hide();
	$('#list_quickView').load('./views/_load/alba.php', { mode:'list', no:no }, function(){
		position_tops = position_top - 2;
		$(this).css({
			"top" : position_tops+"px",
			"left" : "0px"
		});
		$(this).show();
	});
}
var list_close = function(){	// 플래티넘 레이어 닫기
	$('#list_quickView').hide();
}
</script>