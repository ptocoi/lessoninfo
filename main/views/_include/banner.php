<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<div id="box" class="style<?php echo $main_left;?> border<?php echo $design['main_banner_border'];?><?php echo ($design['main_banner_margin'])?' margin':'';?> number<?php echo $main_banner_row;?> mt25 clearfix">
	<h2 class="mb5 title clearfix">
		<div class="fl"><img src="../images/tit/tit_04.gif" width="51" height="19" alt="title"></div>
		<div class="fl pr5 pt4" style="background-color:#fff;"><img style=" vertical-align:baseline;" src="../images/tit/tit_s_01.gif" width="55" height="15" alt="title"></div>
		<div class="fr pl5" style="background-color:#fff;"><a href="<?php echo $alice['service_path'];?>/"><img src="../images/main/btn_info_1.gif" width="54" height="17" alt="상품안내"></a></div>
	</h2>
	<ul class="clearfix">  

		<!-- view layer -->
		<div class="quickView clearfix positionA" style="display:none; left:5px; z-index:2000;" id="banner_quickView"></div>
		<!-- // view layer -->

		<?php 
			foreach($banner_list['result'] as $key => $val){ 
			$no = $val['no'];
			$list = $alba_user_control->get_alba_service($no,"main_banner");
			switch($design['main_banner']){
				case '01':	// 배너형 디자인1
		?>
				<li class="bth <?php echo $list['gold_service'];?>" id="banner_list_<?php echo $no;?>">
					<dl class="clearfix">
						<dt><span class="logo_tit"> <a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['company_name'];?> </a></span></dt>
						<dd class="text1"><?php echo $list['service_icon'];?><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?> <span class="edy edyEn"><?php echo $list['volume'];?></span></a></dd>
						<dd class="text2 clearfix">
							<span class="pay">
								<?php
								if($list['wr_pay_conference']){
									echo "<strong>".$alba_user_control->pay_conference[$list['wr_pay_conference']]."</strong>";
								} else {
								?>
									<em class="icon"><?php echo $list['wr_pay_type'];?></em> <em class="number"><?php echo $list['wr_pay'];?></em>원
								<?php } ?>
							</span>
							<span class="add"><?php echo $list['wr_area_cut'];?></span>
						</dd>                
						<dd class="icons">
							<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
							<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png"></a></div>
							<?php } ?>
							<div><a class="plus" href="javascript:banner_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
						</dd>
					</dl>
				</li>
		<?php
				break;
				case '02':	// 배너형 디자인2
		?>
				<li class="bth <?php echo $list['gold_service'];?>" id="banner_list_<?php echo $no;?>">
					<dl class="clearfix">
						<dt><span style="text-align:right;padding-top:15px;" class=" logo_tit"> <a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['company_name'];?> </a></span></dt>
						<dd class="text1" style="text-align:right;" ><?php echo $list['service_icon'];?><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?> <span class="edy edyEn"><?php echo $list['volume'];?></span></a></dd>
						<dd class="text2 pr5 clearfix" style="text-align:right;">
							<span class="pay">
								<?php
								if($list['wr_pay_conference']){
									echo "<strong>".$alba_user_control->pay_conference[$list['wr_pay_conference']]."</strong>";
								} else {
								?>
									<em class="icon"><?php echo $list['wr_pay_type'];?></em> <em class="number"><?php echo $list['wr_pay'];?></em>원
								<?php } ?>
							</span>
							<span class="add"><?php echo $list['wr_area_cut'];?></span>
						</dd>                
						<dd class="icons">
							<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
							<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png"></a></div>
							<?php } ?>
							<div><a class="plus" href="javascript:banner_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
						</dd>
					</dl>
				</li>
		<?php
				break;
				case '03':	// 배너형 디자인3
		?>
				<li class="bth <?php echo $list['gold_service'];?>" id="banner_list_<?php echo $no;?>">
					<dl class="clearfix">
						<dt><span style="text-align:center;padding-top:15px;" class=" logo_tit"> <a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['company_name'];?> </a></span></dt>
						<dd class="text1" style="text-align:center;" ><?php echo $list['service_icon'];?><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?> <span class="edy edyEn"><?php echo $list['volume'];?></span></a></dd>
						<dd class="text2 pr5 clearfix" style="text-align:center;">
							<span class="pay">
								<?php
								if($list['wr_pay_conference']){
									echo "<strong>".$alba_user_control->pay_conference[$list['wr_pay_conference']]."</strong>";
								} else {
								?>
									<em class="icon"><?php echo $list['wr_pay_type'];?></em> <em class="number"><?php echo $list['wr_pay'];?></em>원
								<?php } ?>
							</span>
							<span class="add"><?php echo $list['wr_area_cut'];?></span>
						</dd>                
						<dd class="icons">
							<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
							<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png"></a></div>
							<?php } ?>
							<div><a class="plus" href="javascript:banner_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
						</dd>
					</dl>
				</li>
		<?php
				break;
				case '04':	// 배너형 디자인4
		?>
				<li class="bth <?php echo $list['gold_service'];?>" id="banner_list_<?php echo $no;?>">
					<dl class="clearfix">			
						<dd class="text1" style="padding-top: 17px;" ><?php echo $list['service_icon'];?><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?> <span class="edy edyEn"><?php echo $list['volume'];?></span></a></dd>
						<dd class="text2 clearfix">
							<span class="pay">
								<?php
								if($list['wr_pay_conference']){
									echo "<strong>".$alba_user_control->pay_conference[$list['wr_pay_conference']]."</strong>";
								} else {
								?>
									<em class="icon"><?php echo $list['wr_pay_type'];?></em> <em class="number"><?php echo $list['wr_pay'];?></em>원
								<?php } ?>
							</span>
							<span class="add"><?php echo $list['wr_area_cut'];?></span>
						</dd>                
						<dd class="icons">
							<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
							<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png"></a></div>
							<?php } ?>
							<div><a class="plus" href="javascript:banner_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
						</dd>
						<dt><span style="padding-top: 9px;" class=" logo_tit"> <a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['company_name'];?> </a></span></dt>
					</dl>
				</li>
		<?php
				break;
				case '05':	// 배너형 디자인5
		?>
				<li class="bth <?php echo $list['gold_service'];?>" id="banner_list_<?php echo $no;?>">
					<dl class="clearfix">			
						<dd class="text1" style="text-align:right;padding-top: 17px;" ><?php echo $list['service_icon'];?><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?> <span class="edy edyEn"><?php echo $list['volume'];?></span></a></dd>
						<dd style="text-align:right;" class="pr5 text2 clearfix">
							<span class="pay">
								<?php
								if($list['wr_pay_conference']){
									echo "<strong>".$alba_user_control->pay_conference[$list['wr_pay_conference']]."</strong>";
								} else {
								?>
									<em class="icon"><?php echo $list['wr_pay_type'];?></em> <em class="number"><?php echo $list['wr_pay'];?></em>원
								<?php } ?>
							</span>
							<span class="add"><?php echo $list['wr_area_cut'];?></span>
						</dd>                
						<dd class="icons">
							<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
							<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png"></a></div>
							<?php } ?>
							<div><a class="plus" href="javascript:banner_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
						</dd>
						<dt><span style="padding-top: 9px;text-align:right;" class=" logo_tit"> <a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['company_name'];?> </a></span></dt>
					</dl>
				</li>
		<?php
				break;
				case '06':	// 배너형 디자인6
		?>
				<li class="bth <?php echo $list['gold_service'];?>" id="banner_list_<?php echo $no;?>">
					<dl class="clearfix">			
						<dd class="text1" style="text-align:center;padding-top: 17px;" ><?php echo $list['service_icon'];?><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?> <span class="edy edyEn"><?php echo $list['volume'];?></span></a></dd>
						<dd style="text-align:center;" class="text2 clearfix">
							<span class="pay">
								<?php
								if($list['wr_pay_conference']){
									echo "<strong>".$alba_user_control->pay_conference[$list['wr_pay_conference']]."</strong>";
								} else {
								?>
									<em class="icon"><?php echo $list['wr_pay_type'];?></em> <em class="number"><?php echo $list['wr_pay'];?></em>원
								<?php } ?>
							</span>
							<span class="add"><?php echo $list['wr_area_cut'];?></span>
						</dd>                
						<dd class="icons">
							<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
							<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png"></a></div>
							<?php } ?>
							<div><a class="plus" href="javascript:banner_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
						</dd>
						<dt><span style="padding-top: 9px;text-align:center;" class=" logo_tit"> <a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['company_name'];?> </a></span></dt>
					</dl>
				</li>
		<?php
				break;
			}	// switch end.
		} // foreach end. 
		?>

		<?php 
		if($banner_rest != $main_banner_row){
			for($i=0;$i<$banner_rest;$i++){ 
			$Rend = ($i == ($banner_rest-1)) ? '' : '';
		?>
			<li class="bth bg <?php echo $Rend;?>"><!--신규광고 신청 -->
				<a style="background:url(../images/basic/bg_service2.gif) no-repeat 50% 50%;" class="service" href="<?php echo $alice['service_path'];?>/" target="_blank"></a>
			</li><!--신규광고 신청// -->
		<?php 
			}	// for end.
		}	// if end.
		?>
	</ul>
</div>

<script>
var banner_open = function( no ){	// 플래티넘 공고 상세보기
	var $banner_list = $('#banner_list_'+no);
	var position_top = $banner_list.position().top;

	$('#banner_quickView').hide();
	$('#banner_quickView').load('./main/views/_load/alba.php', { mode:'banner', no:no }, function(){
		position_tops = position_top - 2;
		$(this).css({
			"top" : position_tops+"px",
			"left" : "0px"
		});
		$(this).show();
	});
}
var banner_close = function(){	// 플래티넘 레이어 닫기
	$('#banner_quickView').hide();
}
</script>