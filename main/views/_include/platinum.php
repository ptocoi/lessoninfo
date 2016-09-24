<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<div id="platinum" class="style<?php echo $main_left;?> border<?php echo $design['main_platinum_border'];?><?php echo ($design['main_platinum_margin'])?' margin':'';?> number<?php echo $main_platinum_row;?> mt25 clearfix">
	<h2 class="mb5 title clearfix">
		<div class="fl"><img src="../images/tit/tit_01.gif" width="66" height="19" alt="title"></div>
		<div class="fl pr5 pt4" style="background-color:#fff;"><img style=" vertical-align:baseline;" src="../images/tit/tit_s_01.gif" width="55" height="15" alt="title"></div>
		<div class="fr pl5" style="background-color:#fff;"><a href="<?php echo $alice['service_path'];?>/"><img src="../images/main/btn_info_1.gif" width="54" height="17" alt="상품안내"></a></div>
	</h2>
	<ul class="clearfix">

		<!-- view layer -->
		<div class="quickView clearfix positionA" style="display:none; left:5px; z-index:2000;" id="platinum_quickView"></div>
		<!-- // view layer -->

		<?php 
			foreach($platinum_list['result'] as $key => $val){ 
			$no = $val['no'];
			$list = $alba_user_control->get_alba_service($no,"main_platinum");
			//if($list['volume_result']==false) continue;	 // 마감된 공고
			switch($design['main_platinum']){
				case '01':	// 플래티넘디자인1
		?>
				<li class="bth <?php echo $list['gold_service'];?>" id="platinum_list_<?php echo $no;?>">
					<dl class="clearfix">
						<dt> 
							<a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>">
							<span style="float:right;" class="logo"><?php echo $list['wr_logo'];?></span>
							<span class="logo_tit" ><?php echo $list['company_name'];?></span>
							</a> 
						</dt>
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
							<div><a class="plus" href="javascript:platinum_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
						</dd>
					</dl>
				</li>
		<?php
				break;
				case '02':	// 플래티넘디자인2
		?>
				<li class="bth <?php echo $list['gold_service'];?>" id="platinum_list_<?php echo $no;?>">
					<dl class="clearfix">
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
							<div><a class="plus" href="javascript:platinum_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
						</dd>
					</dl>
				</li>
		<?php
				break;
				case '03':	// 플래티넘디자인3
		?>
				<li class="bth <?php echo $list['gold_service'];?>" id="platinum_list_<?php echo $no;?>">
					<dl class="clearfix">				
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
							<div><a class="plus" href="javascript:platinum_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
						</dd>
						<dt> 
							<a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>">
							<span style="float:right;" class="logo"><?php echo $list['wr_logo'];?></span>
							<span class="logo_tit" ><?php echo $list['company_name'];?></span>
							</a> 
						</dt>
					</dl>
				</li>
		<?php
				break;
				case '04':
		?>
				<li class="bth <?php echo $list['gold_service'];?>" id="platinum_list_<?php echo $no;?>">
					<dl class="clearfix">				
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
							<div><a class="plus" href="javascript:platinum_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
						</dd>
						<dt> 
							<a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>">
							<span class="logo"><?php echo $list['wr_logo'];?></span>
							<span class="logo_tit"><?php echo $list['company_name'];?></span>
							</a> 
						</dt>
					</dl>
				</li>
		<?php
				break;
				case '05':
		?>
				<li class="bth <?php echo $list['gold_service'];?>" id="platinum_list_<?php echo $no;?>">
					<dl class="clearfix">
						<dt> 
							<a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>">
							<span style="float:right;" class="logo"><?php echo $list['wr_logo'];?></span>
							<span class="logo_tit" ><?php echo $list['company_name'];?></span>
							</a> 
						</dt>
						<dd style="text-align:center;" class="text1"><?php echo $list['service_icon'];?><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?> <span class="edy edyEn"><?php echo $list['volume'];?></span></a></dd>
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
							<div><a class="plus" href="javascript:platinum_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
						</dd>
					</dl>
				</li>
		<?php
				break;
				case '06':	// 플래티넘디자인6
		?>
				<li class="bth <?php echo $list['gold_service'];?>" id="platinum_list_<?php echo $no;?>">
					<dl class="clearfix">
						<dt> 
							<a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>">
							<span class="logo_tit" ><?php echo $list['company_name'];?></span>
							</a> 
						</dt>
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
							<div><a class="plus" href="javascript:platinum_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
						</dd>
					</dl>
				</li>
		<?php
				break;
				case '07':	// 플래티넘디자인7
		?>
				<li class="bth <?php echo $list['gold_service'];?>" id="platinum_list_<?php echo $no;?>">
					<dl class="clearfix">
						<dt> 
							<a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>">
							<span style="float:left;"class="pl5 logo_tit" ><?php echo $list['company_name'];?></span>
							</a> 
						</dt>
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
							<div><a class="plus" href="javascript:platinum_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
						</dd>
					</dl>
				</li>
		<?php
				break;
				case '08':	// 플래티넘디자인8
		?>
				<li class="bth <?php echo $list['gold_service'];?>" id="platinum_list_<?php echo $no;?>">
					<dl class="clearfix">				
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
							<div><a class="plus" href="javascript:platinum_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
						</dd>
						<dt> 
							<a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>">					
							<span class="logo_tit"><?php echo $list['company_name'];?></span>
							</a> 
						</dt>
					</dl>
				</li>
		<?php
				break;
			}	// switch end.
		} // foreach end. 
		?>

		<?php 
		if($platinum_rest != $main_platinum_row){
			for($i=0;$i<$platinum_rest;$i++){ 
			$Rend = ($i == ($platinum_rest-1)) ? '' : '';
		?>
			<!-- 신규광고 신청 -->
			<li class="bth bg <?php echo $Rend;?>">
				<a style="background:url(../images/basic/bg_service1.gif) no-repeat 50% 50%;" class="service" href="<?php echo $alice['service_path'];?>/" target="_blank"></a>
			</li>
			<!-- // 신규광고 신청 -->
		<?php 
			}	// for end.
		}	// if end.
		?>
	</ul>
</div>

<script>
var platinum_open = function( no ){	// 플래티넘 공고 상세보기
	var $platinum_list = $('#platinum_list_'+no);
	var position_top = $platinum_list.position().top;

	$('#platinum_quickView').hide();
	$('#platinum_quickView').load('./main/views/_load/alba.php', { mode:'platinum', no:no }, function(){
		//alert( position_top );
		position_tops = position_top - 2;
		$(this).css({
			"top" : position_tops+"px",
			"left" : "0px"
		});
		$(this).show();
	});
}
var platinum_close = function(){	// 플래티넘 레이어 닫기
	$('#platinum_quickView').hide();
}
</script>