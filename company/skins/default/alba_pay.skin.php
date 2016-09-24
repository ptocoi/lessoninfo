<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

	<style type="text/css">
	/* ========================  기본컬러설정   ========================= */
	#list li .icons div img{background-color:#c9c9c9;}

	/* 포커스 인재정보 */
	#photo > ul > li {border-color:#<?php echo $design['main_focus_border_color'];?>;}	/* 테두리 일반 */
	#photo li dd.icons > div > a > img{background-color:#<?php echo $design['main_focus_border_color'];?>;}	/* 테두리 일반 */
	#photo .name_wrap{background-color:#<?php echo $design['main_focus_background_color'];?>;} /* 배경칼라 일반 */

	#platinum dd.icons > div > a > img{background-color:#<?php echo $design['main_platinum_border_color'];?>;}	/* 테두리 일반 */
	#platinum  > ul > li{border-color:#<?php echo $design['main_platinum_border_color'];?>;}	/* 테두리 일반 */
	#platinum .text1{background-color:#<?php echo $design['main_platinum_background_color'];?>;}	/* 배경칼라 일반 */
	#platinum .text2{background-color:#<?php echo $design['main_platinum_background_color'];?>;}	/* 배경칼라 일반 */
	#platinum.number5  > ul > li .logo_tit{background-color:#<?php echo $design['main_platinum_background_color'];?>;}	/* 배경칼라 일반 */

	#prime dd.icons > div > a > img{background-color:#<?php echo $design['main_prime_border_color'];?>;}
	#prime  > ul > li{border-color:#<?php echo $design['main_prime_border_color'];?>;}
	#prime .text1{background-color:#<?php echo $design['main_prime_background_color'];?>;}
	#prime .text2{background-color:#<?php echo $design['main_prime_background_color'];?>;}
	#prime.number5  > ul > li .logo_tit{background-color:#<?php echo $design['main_prime_background_color'];?>;}

	#grand dd.icons > div > a > img{background-color:#<?php echo $design['main_grand_border_color'];?>;}
	#grand  > ul > li{border-color:#<?php echo $design['main_grand_border_color'];?>;}
	#grand .text1{background-color:#<?php echo $design['main_grand_background_color'];?>;}
	#grand .text2{background-color:#<?php echo $design['main_grand_background_color'];?>;}
	#grand.number5  > ul > li .logo_tit{background-color:#<?php echo $design['main_grand_background_color'];?>;}

	#box dd.icons > div > a > img{background-color:#<?php echo $design['main_banner_border_color'];?>;}
	#box  > ul > li{border-color:#<?php echo $design['main_banner_border_color'];?>;}
	#box .text1{background-color:#<?php echo $design['main_banner_background_color'];?>;}
	#box .text2{background-color:#<?php echo $design['main_banner_background_color'];?>;}
	/* ========================  기본컬러설정 // ========================= */

	/* ========================  골드컬러설정 ========================= */
	.border1 > ul > li.gold {z-index:1000;}
	.border2 > ul > li.gold {z-index:1000;}

	#list > ul > li.gold {background:#<?php echo $design['main_list_background_gold_color'];?>;border-color:#c3b39e;}
	#list > ul > li.gold .icons div img{background-color:#fdb301;}

	#photo  > ul > li.gold {border-color:#<?php echo $design['main_focus_border_gold_color'];?>; /*border:1px solid #afc0ff;*/} /* 테두리 골드 */
	#photo  > ul > li.gold .icons div img{background-color:#<?php echo $design['main_focus_border_gold_color'];?>;} /* 테두리 골드 */
	#photo  > ul > li.gold .name_wrap{background-color:#<?php echo $design['main_focus_background_gold_color'];?>; } /* 배경 골드 */

	#platinum  > ul > li.gold {border-color:#<?php echo $design['main_platinum_border_gold_color'];?>;}	/* 테두리 골드 */
	#platinum  > ul > li.gold .icons div img{background-color:#<?php echo $design['main_platinum_border_gold_color'];?>;}	/* 테두리 골드 */
	#platinum  > ul > li.gold .text1 a{color:#fff;}
	#platinum  > ul > li.gold .text1,#platinum li.gold .text2{background-color:#<?php echo $design['main_platinum_background_gold_color'];?>; color:#fff;}	/* 배경칼라 골드 */
	#platinum  > ul > li.gold .text2 .icon{background-color:#fff; font-style:normal; color:#<?php echo $design['main_platinum_background_gold_color'];?>;}	/* 배경칼라 골드 */
	#platinum.number5  > ul > li.gold .logo_tit{background-color:#<?php echo $design['main_platinum_background_gold_color'];?>;color:#fff;}	/* 배경칼라 골드 */

	#prime  > ul > li.gold {border-color:#<?php echo $design['main_prime_border_gold_color'];?>;}
	#prime  > ul > li.gold .icons div img{background-color:#<?php echo $design['main_prime_border_gold_color'];?>;}
	#prime  > ul > li.gold .text1 a{color:#fff;}
	#prime  > ul > li.gold .text1,#prime li.gold .text2{background-color:#<?php echo $design['main_prime_background_gold_color'];?>; color:#fff;}
	#prime  > ul > li.gold .text2 .icon{background-color:#fff; font-style:normal; color:#<?php echo $design['main_prime_background_gold_color'];?>;}
	#prime.number5  > ul > li.gold .logo_tit{background-color:#<?php echo $design['main_prime_background_gold_color'];?>;color:#fff;}

	#grand  > ul > li.gold {border-color:#<?php echo $design['main_grand_border_gold_color'];?>;}
	#grand  > ul > li.gold .icons div img{background-color:#<?php echo $design['main_grand_border_gold_color'];?>;}
	#grand  > ul > li.gold .text1 a{color:#fff;}
	#grand  > ul > li.gold .text1,#grand li.gold .text2{background-color:#<?php echo $design['main_grand_background_gold_color'];?>; color:#fff;}
	#grand  > ul > li.gold .text2 .icon{background-color:#fff; font-style:normal; color:#<?php echo $design['main_grand_background_gold_color'];?>;}
	#grand.number5  > ul > li.gold .logo_tit{background-color:#<?php echo $design['main_grand_background_gold_color'];?>;color:#fff;}

	#box  > ul > li.gold {border-color:#<?php echo $design['main_banner_border_gold_color'];?>;}
	#box  > ul > li.gold .icons div img{background-color:#<?php echo $design['main_banner_border_gold_color'];?>;}
	#box  > ul > li.gold .text1 a{color:#fff;}
	#box  > ul > li.gold .text1,#box li.gold .text2{background-color:#<?php echo $design['main_banner_background_gold_color'];?>; color:#fff;}
	#box  > ul > li.gold .text2 .icon{background-color:#fff; font-style:normal; color:#<?php echo $design['main_banner_background_gold_color'];?>;}
	/* ========================  골드컬러설정 // ========================= */
	</style>  


<script>
var pg_company = "<?php echo $pg_company;?>";
var cycle_direction = "<?php echo $alba_option_logo_effects[1];?>";
var sel_service = "<?php echo $sel_service;?>";
var sel_service_price = Number("<?php echo $post_total_price;?>");
var busy_icon = "<?php echo $alice['data_icon_path'].'/'.$alba_option_busy['busy_icon'];?>";
<?php if($post_blink_option_date) { ?>
var colour;
setInterval(function(){
	colour = '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6);	
	$('.text1 a.blink, .title a.blink').animate({
		color: colour
	});
}, 500);
<?php } ?>
var mid = "<?php echo $mid;?>";
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/alba_pay.js"></script>

<section id="content" class="content_wrap clearfix">
	<div class="content1_wrap clearfix"> 
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<?php /* navigation */ ?>
	<div class="NowLocation mt35 clearfix">
		<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <strong>결제하기</strong> </p>
	</div>
	<?php /* //navigation */ ?>

	<div class="listWrap positionR mt20">
		<h2 class="pb5"><img src="../images/tit/company_tit_10.gif" width="88" height="25" alt="결제하기"></h2>
		<!--  컨텐츠  -->
		<div class="companyContentWrap">

		<form method="post" name="ServicePayment" id="ServicePayment" onsubmit="return false;">
		<input type="hidden" name="no" value="<?php echo $no;?>"/>
		<!-- <input type="hidden" name="order_no" value="<?php echo $utility->getOrderNumber(10);?>" id="order_no"/> -->
		<input type="hidden" name="pay_method" id="pay_method"/>
		<input type="hidden" name="pay_type" value="alba" id="pay_type"/>
		<input type="hidden" name="pay_service" value="<?php echo $pay_service_val;?>" id="pay_service"/>

		<?php if($sel_service!='alba_option_jump' && $sel_service!='etc_open'){ ?>
			<!-- 상품결제 -->
			<div class="feeBox">
				<!-- 상품정보 및 기간별 가격// -->
				<div id="dev_DefaultGuinOptForm" class="feeSet">
				
					<?php if($main_platinum_date||$main_prime_date||$main_grand_date||$main_banner_date||$main_list_date||$alba_platinum_date||$alba_banner_date||$alba_list_date||$alba_option_busy_date||$alba_option_color_date||$main_basic_date||$alba_basic_date||$package_no){ ?>
					<div class="feeinnerBox"><!-- 테이블 헤더 // -->
					<table class="feeTable" width="100%">
						<colgroup><col width="32%"><col width="43%"><col width="25%"></colgroup>
						<thead>
							<tr>
								<th><strong>상품적용</strong></th>
								<th><strong>상품내용</strong></th>
								<th><strong>상품가격</strong></th>
							</tr>
						</thead>
					</table>
					</div>
					<?php } ?>

				<?php if($package_no){ // 패키지 결제시 ?>
				<input type="hidden" name="package_no" value="<?php echo $package_no;?>" id="package_no"/>
				<input type="hidden" name="package_price" value="<?php echo $package['wr_price'];?>" id="package_price"/>
				<div class="feeinnerBox" style="margin-top:-2px; border-top:0;">
					<table class="feeTable" width="100%">
					<tbody>
					<tr>
						<td class="service" colspan="2">
							<div class="pointTit bg_color2 border_color pl10">
								<strong class="pr10"><?php echo stripslashes($package['wr_subject']);?></strong>
							</div>
							<div class="serviceWrap mb20 positionR"  style="padding:10px 20px;">
							<?php
							$package_name = "";
							$package_count = 0;
							foreach($package_content as $key => $content){
								if($content['use']){
								//$package_service = $service_control->package_service['employ'][$key]." ".$content['service_count'].$service_control->_unit($content['service_unit']);
								$service_name = $service_control->package_service['employ'][$key];
								if($package_count==0){
									$package_name = $service_name;
								}
							?>
								<dd class="clearfix positionR" >
									<p><label class="pl5 text_color13"><strong><?php echo $service_control->package_service['employ'][$key];?></strong></label></p>

									<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;">
										<p class="priceSelect" style="display:;">
											<span class="today"><strong>오늘</strong> +</span>
											<?php echo $content['service_count'].$service_control->_unit($content['service_unit']);?>
										</p>
									</div>
								</dd>
							<?php 
								$package_count++;
								}	// if end.
							}	// foreach end.
							?>
							<dd class="clearfix positionR" >
								<p><label class="pl5 text_color13"><strong>패키지 금액</strong></label></p>

								<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;">
									<span style="display:;">
										<strong class="pay pl5"><span class="text_orange"><?php echo number_format($package['wr_price']);?></span></strong><span class="won positionR">원</span>
									</span>
								</div>
							</dd>

							</div>
						</td>
					</tr>
					</tbody>
					</table>
				</div>
				<?php } // 패키지 결제시?>

				<?php if($sel_service && stristr($sel_service,'option') == false && $sel_service != 'etc_sms'){ // 단일 서비스 선택시 ?>

				<div class="feeinnerBox" style="display:block;">
				<table class="feeTable" width="100%">
				<colgroup><col width="32%"><col width="43%"><col width="25%"></colgroup>
				<tbody>
				<tr>
					<td class="preView pt20">

					<?php if($box_id=='box'){ // 서브 박스형 공고 ?>
					<div id="<?php echo $box_id;?>" class="style<?php echo $main_left;?> border<?php echo $border;?><?php echo $margin;?> number<?php echo $num_row;?> mt25 clearfix <?php echo $sel_service;?>_gold">
					<ul class="is_gold">
					<li class="bth">
						<dl>
							<dt>
								<a><span class="logo_tit">㈜회사명</span></a> 
							</dt>
							<dd class="text1"><!-- opt_color1 opt_bold opt_pen2 -->
								<span class="icon"></span>
								<a>함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
							</dd>
							<dd class="text2 clearfix">
								<span class="pay"><em class="icon">월</em> <em class="number">5,000,000</em>원</span>
								<span class="add" style="">서울 구로구</span>
							</dd> 
						</dl>
					</li>
					</ul>
					</div>
					<?php } else if($box_id=='list') { // 리스트 공고 ?>
					<div style="display:block;" id="<?php echo $box_id;?>" class="style1 color1 mt30 clearfix" >
					<ul class="clearfix">  
						<li class="bth">
							<span style="color:#8f8f8f" class="add">서울 구로구</span>
							<a><span class="logo_tit">㈜이마트</span></a> 
							<span class="text1">
								<span class="icon">
									<!-- <img class="vm pr5" alt="HOT" src="../images/icon/icon_hot.gif"> -->
									<span class="icons pr5"></span>
								</span>
								<a>함께할 성실한 인재모집</a><!-- opt_color1 opt_bold opt_pen2 -->
							</span>
						</li>
						<li class="bth">
							<span style="color:#8f8f8f" class="add">서울 구로구</span>
							<a><span class="logo_tit">㈜이마트</span></a> 
							<span class="text1"><span></span><a>함께할 성실한 인재모집</a></span>
						</li>
					</ul>
					</div> 
					<?php } else { // 메인 공고 ?>
					<div id="<?php echo $box_id;?>" class="style<?php echo $main_left;?> border<?php echo $border;?><?php echo $margin;?> number<?php echo $num_row;?> mt25 clearfix <?php echo $sel_service;?>_gold">
						<ul class="clearfix positionR is_gold">
						<li class="bth">
							<dl class="clearfix">
								<dt>
									<a>
									<span class="logo <?php echo $sel_service;?>_logo_preview">
										<img width="106" height="42" src="../images/basic/img_aniLogo.gif" alt="㈜logo" id="<?php echo $sel_service;?>_preview_logo">
										<div style="text-align:center;display:none;" class="<?php echo $sel_service;?>_slide_preview">
											<img src="../images/basic/img_aniLogo.gif" width="106" height="42"/>
											<img src="../images/basic/img_aniLogo.gif" width="106" height="42"/>
										</div>
									</span>
									<span class="logo_tit">㈜회사명</span>
									</a> 
								</dt>
								<dd class="text1">
									<span class="icon"></span>
									<a>함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a><!-- opt_color1 opt_bold opt_pen2 -->
								</dd>
								<dd class="text2">
									<span>서울 구로구</span>
									<span><em class="icon">월</em><em class="number">5,000,000</em>원</span></dd>
								</dd>
							</dl>
						</li>
						</ul>
					</div>
					<?php } ?>

					<div class="guide mt10 pb20 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>
					</td>
					<td class="service" colspan="2">
					<dl class="serviceWrap mt20 mb20 positionR">
						
						<?php if($box_id=='box'){ // 박스형 ?>
						<dt class="positionR content" style="border-bottom:1px solid #ddd;">
							<ul class="clearfix">
								<li class="priceInfo mb10">
									<span class="title pr10"><?php echo $title_icon;?><!-- <img class="vb" src="../images/tit/tit_01.gif" alt="title"> --></span>
									<span id="<?php echo $sel_service;?>_orange_block">
									(<?php if($service_date[4]=='0'){ ?><strong class="unitPrice text_orange" id="<?php echo $sel_service;?>_orange">무료</strong><?php } else { ?><span id="<?php echo $sel_service;?>_orange"><strong class="unitPrice text_orange"><?php echo number_format($service_date[4]);?></strong>원</span><?php } ?>)
									</span>
								</li>
								<li class="loca text_color13 mb10"><strong><?php echo $title_position?></strong></li>
							</ul>
							<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="<?php echo $sel_service;?>_date" id="<?php echo $sel_service;?>_date" onchange="once_service_price_print('<?php echo $sel_service;?>',this);">
								<?php /* ?><option value="">선택</option><?php */ ?>
								<?php 
									foreach($service_rows as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
									$selected = ($service_val==$_POST[$sel_service."_date"]) ? "selected" : "";
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:;" id="<?php echo $sel_service;?>_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($service_date[4]=='0')?"무료":number_format($service_date[4]);?></span></strong>
									<span class="won positionR" style="display:<?php echo ($service_date[4]=='0')?'none':'';?>;">원
										<em class="positionA" style="top:-21px; right:0;display:<?php echo ($service_date[3]!='0')?'':'none';?>;">
											<span class="price"><?php echo number_format($service_date[2]);?></span>원
											<span class="priceDc text_orange"><?php echo number_format($service_date[3]);?>%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	
						</dt>
						<?php } else if($box_id=='list') { // 리스트형 공고 ?>
						<dt class="positionR content" style="border-bottom:1px solid #ddd;">
							<ul class="clearfix">
								<li class="priceInfo mb10">
									<span class="title pr10"><?php echo $title_icon;?></span>
									<span id="<?php echo $sel_service;?>_orange_block">
									(<?php if($service_date[4]=='0'){ ?><strong class="unitPrice text_orange" id="<?php echo $sel_service;?>_orange">무료</strong><?php } else { ?><span id="<?php echo $sel_service;?>_orange"><strong class="unitPrice text_orange"><?php echo number_format($service_date[4]);?></strong>원</span><?php } ?>)
									</span>
								</li>
								<li class="loca text_color13 mb10"><strong><?php echo $title_position?></strong></li>
							</ul>
							<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;">
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="<?php echo $sel_service;?>_date" id="<?php echo $sel_service;?>_date" onchange="once_service_price_print('<?php echo $sel_service;?>',this);">
								<?php /* ?><option value="">선택</option><?php */ ?>
								<?php 
									foreach($service_rows as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
									$selected = ($service_val==$_POST[$sel_service."_date"]) ? "selected" : "";
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:;" id="<?php echo $sel_service;?>_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($service_date[4]=='0')?"무료":number_format($service_date[4]);?></span></strong>
									<span class="won positionR" style="display:<?php echo ($service_date[4]=='0')?'none':'';?>;">원
										<em class="positionA" style="top:-21px; right:0;display:<?php echo ($service_date[3]!='0')?'':'none';?>;">
											<span class="price"><?php echo number_format($service_date[2]);?></span>원
											<span class="priceDc text_orange"><?php echo number_format($service_date[3]);?>%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	
						</dt>
						<?php } else { // 메인 공고 ?>
						<dt class="positionR content" style="border-bottom:1px solid #ddd;">
							<ul class="clearfix">
								<li class="priceInfo mb10">
									<span class="title pr10"><?php echo $title_icon;?></span>
									<span id="<?php echo $sel_service;?>_orange_block">
									(<?php if($service_date[4]=='0'){ ?><strong class="unitPrice text_orange" id="<?php echo $sel_service;?>_orange">무료</strong><?php } else { ?><span id="<?php echo $sel_service;?>_orange"><strong class="unitPrice text_orange"><?php echo number_format($service_date[4]);?></strong>원</span><?php } ?>)
									</span>
								</li>
								<li class="loca text_color13 mb10"><strong><?php echo $title_position?></strong></li>
							</ul>
							<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="<?php echo $sel_service;?>_date" id="<?php echo $sel_service;?>_date" onchange="once_service_price_print('<?php echo $sel_service;?>',this);">
								<?php /* ?><option value="">선택</option><?php */ ?>
								<?php 
									foreach($service_rows as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
									$selected = ($service_val==$_POST[$sel_service."_date"]) ? "selected" : "";
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:;" id="<?php echo $sel_service;?>_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($service_date[4]=='0')?"무료":number_format($service_date[4]);?></span></strong>
									<span class="won positionR" style="display:<?php echo ($service_date[4]=='0')?'none':'';?>;">원
										<em class="positionA" style="top:-21px; right:0;display:<?php echo ($service_date[3]!='0')?'':'none';?>;">
											<span class="price"><?php echo number_format($service_date[2]);?></span>원
											<span class="priceDc text_orange"><?php echo number_format($service_date[3]);?>%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	
						</dt>
						<?php } ?>

						<?php if($is_gold_service){ // 골드 서비스 ?>
						<dd class="clearfix positionR">
							<p>
								<input type="checkbox" class="chk" value="1" id="<?php echo $sel_service;?>_gold" name="<?php echo $sel_service;?>_gold" onclick="once_gold_service('<?php echo $sel_service;?>_gold',this);">
								<label class="pl5 text_color13" for="<?php echo $sel_service;?>_gold"><strong>Gold</strong><img class="vm pl5" alt="Gold" src="../images/icon/icon_gold1.gif"></label>
								<span class="suv_num <?php echo $sel_service;?>_gold" id="<?php echo $sel_service;?>_gold_msg" style="display:none;">배경색으로 강조</span>
								<!-- (배경색으로 강조 : <strong>+11,000</strong>원/1일) -->
							</p>
							<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect <?php echo $sel_service;?>_gold  <?php echo $sel_service;?>_gold_info" style="display:none;">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="<?php echo $sel_service;?>_gold_date" id="<?php echo $sel_service;?>_gold_date">
								<option value="">선택</option>
								<?php 
									foreach($gold_service_rows as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="<?php echo $sel_service;?>_gold_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
							</div>
						</dd>
						<?php } ?>

						<?php if($is_logo_service){ // 로고강조 ?>
						<dd class="clearfix positionR">
							<p>
								<input type="checkbox" class="chk" value="1" id="<?php echo $sel_service;?>_logo" name="<?php echo $sel_service;?>_logo" onclick="once_option_logo(this,'<?php echo $sel_service;?>');">
								<label class="pl5 text_color13" for="<?php echo $sel_service;?>_logo"><strong>로고강조</strong></label>
								<span class="suv_num <?php echo $sel_service;?>_logo" id="<?php echo $sel_service;?>_logo_msg" style="display:none;">움직이는 로고가 노출</span>
								<!-- (움직이는 로고가 노출 : <strong>+5,500</strong>원/1일) -->
							</p>
							<ul class="aniLogo <?php echo $sel_service;?>_logo" style="display:none;">
								<li>
									<input type="radio" class="chk" name="<?php echo $sel_service;?>_logo_effect" value="0" id="<?php echo $sel_service;?>_logo_0" checked onclick="logo_effects(this,'<?php echo $sel_service;?>');">
									<label for="<?php echo $sel_service;?>_logo_0"><img class="vm <?php echo $sel_service;?>_fade_image"  width="72"  alt="반짝로고1" src="../images/basic/img_aniLogo1.gif"/></label>
								</li>
								<li>
									<input type="radio" class="chk" name="<?php echo $sel_service;?>_logo_effect" value="1" id="<?php echo $sel_service;?>_logo_1" onclick="logo_effects(this,'<?php echo $sel_service;?>');">
									<label for="<?php echo $sel_service;?>_logo_1"><img class="vm"  width="72"  alt="반짝로고2" src="../images/basic/img_aniLogo2.gif" /></label>
								</li>
								<li>
									<input type="radio" class="chk" name="<?php echo $sel_service;?>_logo_effect" value="2" id="<?php echo $sel_service;?>_logo_2" onclick="logo_effects(this,'<?php echo $sel_service;?>');">
									<label class="vm" for="<?php echo $sel_service;?>_logo_2">
										<div style="display:inline-block; " class="vm slide_image">
											<img src="../images/basic/img_aniLogo3.gif" width="72" height="29"/>
											<img src="../images/basic/img_aniLogo3.gif" width="72" height="29"/>
										</div>
									</label>
								</li>
							</ul>
							<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect <?php echo $sel_service;?>_logo" style="display:none;">
								<span class="today"><strong>오늘</strong> +</span>
								<!-- onchange="once_service_price_print('<?php echo $sel_service;?>',this);" -->
								<select class="ipSelect2" title="신청기간" name="<?php echo $sel_service;?>_logo_date" id="<?php echo $sel_service;?>_logo_date">
								<option value="">선택</option>
								<?php 
									foreach($logo_service_rows as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="<?php echo $sel_service;?>_logo_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	   
						</dd>
						<?php } ?>

					</dl>

					</td>
				</tr>
				</tbody>
				</table>
				</div>

				<?php } else { // 복합 서비스 선택시 ?>

				<div class="feeinnerBox">

				<table class="feeTable" width="100%">
				<colgroup><col width="32%"><col width="43%"><col width="25%"></colgroup>
				<tbody>
				<?php if(!$sel_service && $_POST['main_platinum_date']!=''){ // 메인 플래티넘 ?>
				<tr>
					<td class="preView pt20">

					<div id="platinum" class="style<?php echo $main_left;?> border<?php echo $design['main_platinum_border'];?> number<?php echo $main_platinum_row;?> mt25 clearfix main_platinum_gold">
						<ul class="clearfix positionR is_gold">
						<li class="bth">
							<dl class="clearfix">
								<dt>
									<a>
									<span class="logo main_platinum_logo_preview">
										<img width="106" height="42" src="../images/basic/img_aniLogo.gif" alt="㈜logo" id="main_platinum_preview_logo">
										<div style="text-align:center;display:none;" class="main_platinum_slide_preview">
											<img src="../images/basic/img_aniLogo.gif" width="106" height="42"/>
											<img src="../images/basic/img_aniLogo.gif" width="106" height="42"/>
										</div>
									</span>
									<span class="logo_tit">㈜회사명</span>
									</a> 
								</dt>
								<dd class="text1">
									<span class="icon"><?php echo $icon_options;?></span>
									<a <?php echo $style_options;?> <?php echo $blink_options;?>>함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a><!-- opt_color1 opt_bold opt_pen2 -->
								</dd>
								<dd class="text2">
									<span>서울 구로구</span>
									<span><em class="icon">월</em><em class="number">5,000,000</em>원</span></dd>
								</dd>
							</dl>
						</li>
						</ul>
					</div>
					<div class="guide mt10 pb20 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>
					</td>
					<td class="service" colspan="2">
					<dl class="serviceWrap positionR">

						<dt class="positionR content" style="border-bottom:1px solid #ddd;">
							<ul class="clearfix">
								<li class="priceInfo mb10">
									<span class="title pr10">메인 플래티넘</span>
									<span id="main_platinum_orange_block">
									(<?php if($post_main_platinum[4]=='0'){ ?><strong class="unitPrice text_orange" id="main_platinum_orange">무료</strong><?php } else { ?><span id="main_platinum_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_main_platinum[4]);?></strong>원</span><?php } ?>)
									</span>
								</li>
								<li class="loca text_color13 mb10"><strong>메인 최상단</strong></li>
							</ul>
							<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_platinum_date" id="main_platinum_date" onchange="once_service_price_print('main_platinum',this);">
								<?php /* ?><option value="">선택</option><?php */ ?>
								<?php 
									foreach($main_platinum_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
									$selected = ($service_val==$post_main_platinum_date) ? "selected" : "";
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:;" id="main_platinum_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_main_platinum[4]=='0')?"무료":number_format($post_main_platinum[4]);?></span></strong>
									<span class="won positionR" style="display:<?php echo ($post_main_platinum[4]=='0')?'none':'';?>;">원
										<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_main_platinum[3]!='0')?'':'none';?>;">
											<span class="price"><?php echo number_format($post_main_platinum[2]);?></span>원
											<span class="priceDc text_orange"><?php echo number_format($post_main_platinum[3]);?>%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	
						</dt>
						<?php if($main_platinum_gold['is_pay']){ // 메인 플래티넘 골드 ?>
						<dd class="clearfix positionR">
							<p>
								<input type="checkbox" class="chk" value="1" id="main_platinum_gold" name="main_platinum_gold" onclick="once_gold_service('main_platinum_gold',this);">
								<label class="pl5 text_color13" for="main_platinum_gold"><strong>Gold</strong><img class="vm pl5" alt="Gold" src="../images/icon/icon_gold1.gif"></label>
								<span class="suv_num main_platinum_gold" id="main_platinum_gold_msg" style="display:none;">배경색으로 강조</span>
								<!-- (배경색으로 강조 : <strong>+11,000</strong>원/1일) -->
							</p>
							<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect main_platinum_gold main_platinum_gold_info" style="display:none;">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_platinum_gold_date" id="main_platinum_gold_date">
								<option value="">선택</option>
								<?php 
									foreach($main_platinum_gold_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="main_platinum_gold_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
							</div>
						</dd>
						<?php } ?>
						<?php if($main_platinum_logo['is_pay']){ // 메인 플래티넘 로고강조 ?>
						<dd class="clearfix positionR">
							<p>
								<input type="checkbox" class="chk" value="1" id="main_platinum_logo" name="main_platinum_logo" onclick="once_option_logo(this,'main_platinum');">
								<label class="pl5 text_color13" for="main_platinum_logo"><strong>로고강조</strong></label>
								<span class="suv_num main_platinum_logo" id="main_platinum_logo_msg" style="display:none;">움직이는 로고가 노출</span>
								<!-- (움직이는 로고가 노출 : <strong>+5,500</strong>원/1일) -->
							</p>
							<ul class="aniLogo main_platinum_logo" style="display:none;">
								<li>
									<input type="radio" class="chk" name="main_platinum_logo_effect" value="0" id="main_platinum_logo_0" checked onclick="logo_effects(this,'main_platinum');">
									<label for="main_platinum_logo_0"><img class="vm fade_image"  width="72"  alt="반짝로고1" src="../images/basic/img_aniLogo1.gif"/></label>
								</li>
								<li>
									<input type="radio" class="chk" name="main_platinum_logo_effect" value="1" id="main_platinum_logo_1" onclick="logo_effects(this,'main_platinum');">
									<label for="main_platinum_logo_1"><img class="vm"  width="72"  alt="반짝로고2" src="../images/basic/img_aniLogo2.gif" /></label>
								</li>
								<li>
									<input type="radio" class="chk" name="main_platinum_logo_effect" value="2" id="main_platinum_logo_2" onclick="logo_effects(this,'main_platinum');">
									<label for="main_platinum_logo_2">
										<div style="display:inline-block; " class="vm slide_image">
											<img src="../images/basic/img_aniLogo3.gif" width="72" height="29"/>
											<img src="../images/basic/img_aniLogo3.gif" width="72" height="29"/>
										</div>
									</label>
								</li>
							</ul>
							<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect main_platinum_logo" style="display:none;">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_platinum_logo_date" id="main_platinum_logo_date"><!-- onchange="once_service_price_print('main_platinum',this);" -->
								<option value="">선택</option>
								<?php 
									foreach($main_platinum_logo_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="main_platinum_logo_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	   
						</dd>
						<?php } ?>

					</dl>
					</td>
				</tr>
				<?php } ?>
				<?php if(!$sel_service && $_POST['main_prime_date']!=''){ // 메인 프라임 ?>
				<tr>
					<td class="preView pt20">
					<div id="prime" class="style<?php echo $main_left;?> border<?php echo $design['main_prime_border'];?> number<?php echo $main_prime_row;?> mt25 clearfix main_prime_gold">
						<ul class="clearfix positionR is_gold">
						<li class="bth">
							<dl class="clearfix">
								<dt>
									<a>
									<span class="logo main_prime_logo_preview">
										<img width="106" height="42" src="../images/basic/img_aniLogo.gif" alt="㈜logo" id="main_prime_preview_logo">
										<div style="text-align:center;display:none;" class="main_prime_slide_preview">
											<img src="../images/basic/img_aniLogo.gif" width="106" height="42"/>
											<img src="../images/basic/img_aniLogo.gif" width="106" height="42"/>
										</div>
									</span>
									<span class="logo_tit">㈜회사명</span>
									</a> 
								</dt>
								<dd class="text1">
									<span class="icon"><?php echo $icon_options;?></span>
									<a <?php echo $style_options;?> <?php echo $blink_options;?>>함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
								</dd>
								<dd class="text2">
									<span>서울 구로구</span>
									<span><em class="icon">월</em><em class="number">5,000,000</em>원</span></dd>
								</dd>
							</dl>
						</li>
						</ul>
					</div>
					<div class="guide mt10 pb20 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>
					</td>
					<td class="service" colspan="2">
					<dl class="serviceWrap positionR">

						<dt class="positionR content" style="border-bottom:1px solid #ddd;">
							<ul class="clearfix">
								<li class="priceInfo mb10">
									<span class="title pr10">메인 프라임</span>
									<span id="main_prime_orange_block">
									(<?php if($post_main_prime[4]=='0'){ ?><strong class="unitPrice text_orange" id="main_prime_orange">무료</strong><?php } else { ?><span id="main_prime_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_main_prime[4]);?></strong>원</span><?php } ?>)
									</span>
								</li>
								<li class="loca text_color13 mb10"><strong>메인 상단 두번째</strong></li>
							</ul>
							<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_prime_date" id="main_prime_date" onchange="once_service_price_print('main_prime',this);">
								<?php /* ?><option value="">선택</option><?php */ ?>
								<?php 
									foreach($main_prime_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
									$selected = ($service_val==$post_main_prime_date) ? "selected" : "";
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:;" id="main_prime_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_main_prime[4]=='0')?"무료":number_format($post_main_prime[4]);?></span></strong>
									<span class="won positionR" style="display:<?php echo ($post_main_prime[4]=='0')?'none':'';?>;">원
										<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_main_prime[3]!='0')?'':'none';?>;">
											<span class="price"><?php echo number_format($post_main_prime[2]);?></span>원
											<span class="priceDc text_orange"><?php echo number_format($post_main_prime[3]);?>%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	
						</dt>
						<?php if($main_prime_gold['is_pay']){ // 메인 프라임 골드 ?>
						<dd class="clearfix positionR">
							<p>
								<input type="checkbox" class="chk" value="1" id="main_prime_gold" name="main_prime_gold" onclick="once_gold_service('main_prime_gold',this);">
								<label class="pl5 text_color13" for="main_prime_gold"><strong>Gold</strong><img class="vm pl5" alt="Gold" src="../images/icon/icon_gold1.gif"></label>
								<span class="suv_num main_prime_gold" id="main_prime_gold_msg" style="display:none;">배경색으로 강조</span>
							</p>
							<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect main_prime_gold main_prime_gold_info" style="display:none;">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_prime_gold_date" id="main_prime_gold_date">
								<option value="">선택</option>
								<?php 
									foreach($main_prime_gold_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="main_prime_gold_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
							</div>
						</dd>
						<?php } ?>
						<?php if($main_prime_logo['is_pay']){ // 메인 프라임 로고강조 ?>
						<dd class="clearfix positionR">
							<p>
								<input type="checkbox" class="chk" value="1" id="main_prime_logo" name="main_prime_logo" onclick="once_option_logo(this,'main_prime');">
								<label class="pl5 text_color13" for="main_prime_logo"><strong>로고강조</strong></label>
								<span class="suv_num main_prime_logo" id="main_prime_logo_msg" style="display:none;">움직이는 로고가 노출</span>
								<!-- (움직이는 로고가 노출 : <strong>+5,500</strong>원/1일) -->
							</p>
							<ul class="aniLogo main_prime_logo" style="display:none;">
								<li>
									<input type="radio" class="chk" name="main_prime_logo_effect" value="0" id="main_prime_logo_0" checked onclick="logo_effects(this,'main_prime');">
									<label for="main_prime_logo_0"><img class="vm fade_image"  width="72"  alt="반짝로고1" src="../images/basic/img_aniLogo1.gif"/></label>
								</li>
								<li>
									<input type="radio" class="chk" name="main_prime_logo_effect" value="1" id="main_prime_logo_1" onclick="logo_effects(this,'main_prime');">
									<label for="main_prime_logo_1"><img class="vm"  width="72"  alt="반짝로고2" src="../images/basic/img_aniLogo2.gif" /></label>
								</li>
								<li>
									<input type="radio" class="chk" name="main_prime_logo_effect" value="2" id="main_prime_logo_2" onclick="logo_effects(this,'main_prime');">
									<label for="main_prime_logo_2">
										<div style="display:inline-block; " class="vm slide_image">
											<img src="../images/basic/img_aniLogo3.gif" width="72" height="29"/>
											<img src="../images/basic/img_aniLogo3.gif" width="72" height="29"/>
										</div>
									</label>
								</li>
							</ul>
							<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect main_prime_logo" style="display:none;">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_prime_logo_date" id="main_prime_logo_date"><!-- onchange="once_service_price_print('main_prime',this);" -->
								<option value="">선택</option>
								<?php 
									foreach($main_prime_logo_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="main_prime_logo_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	   
						</dd>
						<?php } ?>

					</dl>
					</td>
				</tr>
				<?php } ?>
				<?php if(!$sel_service && $_POST['main_grand_date']!=''){ // 메인 그랜드 ?>
				<tr>
					<td class="preView pt20">
					<div id="grand" class="style<?php echo $main_left;?> border<?php echo $design['main_grand_border'];?> number<?php echo $main_grand_row;?> mt25 clearfix main_grand_gold">
						<ul class="clearfix positionR is_gold">
						<li class="bth">
							<dl class="clearfix">
								<dt>
									<a>
									<span class="logo main_grand_logo_preview">
										<img width="106" height="42" src="../images/basic/img_aniLogo.gif" alt="㈜logo" id="main_grand_preview_logo">
										<div style="text-align:center;display:none;" class="main_grand_slide_preview">
											<img src="../images/basic/img_aniLogo.gif" width="106" height="42"/>
											<img src="../images/basic/img_aniLogo.gif" width="106" height="42"/>
										</div>
									</span>
									<span class="logo_tit">㈜회사명</span>
									</a> 
								</dt>
								<dd class="text1">
									<span class="icon"><?php echo $icon_options;?></span>
									<a <?php echo $style_options;?> <?php echo $blink_options;?>>함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
								</dd>
								<dd class="text2">
									<span>서울 구로구</span>
									<span><em class="icon">월</em><em class="number">5,000,000</em>원</span></dd>
								</dd>
							</dl>
						</li>
						</ul>
					</div>
					<div class="guide mt10 pb20 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>
					</td>
					<td class="service" colspan="2">
					<dl class="serviceWrap positionR">

						<dt class="positionR content" style="border-bottom:1px solid #ddd;">
							<ul class="clearfix">
								<li class="priceInfo mb10">
									<span class="title pr10">메인 그랜드</span>
									<span id="main_grand_orange_block">
									(<?php if($post_main_grand[4]=='0'){ ?><strong class="unitPrice text_orange" id="main_grand_orange">무료</strong><?php } else { ?><span id="main_grand_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_main_grand[4]);?></strong>원</span><?php } ?>)
									</span>
								</li>
								<li class="loca text_color13 mb10"><strong>메인 상단 세번째</strong></li>
							</ul>
							<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_grand_date" id="main_grand_date" onchange="once_service_price_print('main_grand',this);">
								<?php /* ?><option value="">선택</option><?php */ ?>
								<?php 
									foreach($main_grand_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
									$selected = ($service_val==$post_main_grand_date) ? "selected" : "";
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:;" id="main_grand_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_main_grand[4]=='0')?"무료":number_format($post_main_grand[4]);?></span></strong>
									<span class="won positionR" style="display:<?php echo ($post_main_grand[4]=='0')?'none':'';?>;">원
										<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_main_grand[3]!='0')?'':'none';?>;">
											<span class="price"><?php echo number_format($post_main_grand[2]);?></span>원
											<span class="priceDc text_orange"><?php echo number_format($post_main_grand[3]);?>%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	
						</dt>
						<?php if($main_grand_gold['is_pay']){ // 메인 그랜드 골드 ?>
						<dd class="clearfix positionR">
							<p>
								<input type="checkbox" class="chk" value="1" id="main_grand_gold" name="main_grand_gold" onclick="once_gold_service('main_grand_gold',this);">
								<label class="pl5 text_color13" for="main_grand_gold"><strong>Gold</strong><img class="vm pl5" alt="Gold" src="../images/icon/icon_gold1.gif"></label>
								<span class="suv_num main_grand_gold" id="main_grand_gold_msg" style="display:none;">배경색으로 강조</span>
							</p>
							<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect main_grand_gold main_grand_gold_info" style="display:none;">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_grand_gold_date" id="main_grand_gold_date">
								<option value="">선택</option>
								<?php 
									foreach($main_grand_gold_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="main_grand_gold_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
							</div>
						</dd>
						<?php } ?>
						<?php if($main_grand_logo['is_pay']){ // 메인 그랜드 로고강조 ?>
						<dd class="clearfix positionR">
							<p>
								<input type="checkbox" class="chk" value="1" id="main_grand_logo" name="main_grand_logo" onclick="once_option_logo(this,'main_grand');">
								<label class="pl5 text_color13" for="main_grand_logo"><strong>로고강조</strong></label>
								<span class="suv_num main_grand_logo" id="main_grand_logo_msg" style="display:none;">움직이는 로고가 노출</span>
								<!-- (움직이는 로고가 노출 : <strong>+5,500</strong>원/1일) -->
							</p>
							<ul class="aniLogo main_grand_logo" style="display:none;">
								<li>
									<input type="radio" class="chk" name="main_grand_logo_effect" value="0" id="main_grand_logo_0" checked onclick="logo_effects(this,'main_grand');">
									<label for="main_grand_logo_0"><img class="vm fade_image"  width="72"  alt="반짝로고1" src="../images/basic/img_aniLogo1.gif"/></label>
								</li>
								<li>
									<input type="radio" class="chk" name="main_grand_logo_effect" value="1" id="main_grand_logo_1" onclick="logo_effects(this,'main_grand');">
									<label for="main_grand_logo_1"><img class="vm"  width="72"  alt="반짝로고2" src="../images/basic/img_aniLogo2.gif" /></label>
								</li>
								<li>
									<input type="radio" class="chk" name="main_grand_logo_effect" value="2" id="main_grand_logo_2" onclick="logo_effects(this,'main_grand');">
									<label for="main_grand_logo_2">
										<div style="display:inline-block; " class="vm slide_image">
											<img src="../images/basic/img_aniLogo3.gif" width="72" height="29"/>
											<img src="../images/basic/img_aniLogo3.gif" width="72" height="29"/>
										</div>
									</label>
								</li>
							</ul>
							<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect main_grand_logo" style="display:none;">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_grand_logo_date" id="main_grand_logo_date"><!-- onchange="once_service_price_print('main_grand',this);" -->
								<option value="">선택</option>
								<?php 
									foreach($main_grand_logo_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="main_grand_logo_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	   
						</dd>
						<?php } ?>

					</dl>
					</td>
				</tr>
				<?php } ?>
				<?php if(!$sel_service && $_POST['main_banner_date']!=''){ // 메인 배너형 ?>
				<tr>
					<td class="preView pt20">
					<div id="box" class="style<?php echo $main_left;?> border<?php echo $design['main_banner_border'];?> number<?php echo $main_banner_row;?> mt25 clearfix main_banner_gold">
					<ul class="is_gold">
					<li class="bth">
						<dl>
							<dt>
								<a><span class="logo_tit">㈜회사명</span></a> 
							</dt>
							<dd class="text1"><!-- opt_color1 opt_bold opt_pen2 -->
								<span class="icon"><?php echo $icon_options;?></span>
								<a <?php echo $style_options;?> <?php echo $blink_options;?>>함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
							</dd>
							<dd class="text2 clearfix">
								<span class="pay"><em class="icon">월</em> <em class="number">5,000,000</em>원</span>
								<span class="add" style="">서울 구로구</span>
							</dd> 
						</dl>
					</li>
					</ul>
					</div>
					<div class="guide mt10 pb20 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>
					</td>
					<td class="service" colspan="2">
					<dl class="serviceWrap positionR">

						<dt class="positionR content" style="border-bottom:1px solid #ddd;">
							<ul class="clearfix">
								<li class="priceInfo mb10">
									<span class="title pr10">메인 배너형</span>
									<span id="main_banner_orange_block">
									(<?php if($post_main_banner[4]=='0'){ ?><strong class="unitPrice text_orange" id="main_banner_orange">무료</strong><?php } else { ?><span id="main_banner_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_main_banner[4]);?></strong>원</span><?php } ?>)
									</span>
								</li>
								<li class="loca text_color13 mb10"><strong>메인 하단 배너형태</strong></li>
							</ul>
							<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_banner_date" id="main_banner_date" onchange="once_service_price_print('main_banner',this);">
								<?php /* ?><option value="">선택</option><?php */ ?>
								<?php 
									foreach($main_banner_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
									$selected = ($service_val==$post_main_banner_date) ? "selected" : "";
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:;" id="main_banner_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_main_banner[4]=='0')?"무료":number_format($post_main_banner[4]);?></span></strong>
									<span class="won positionR" style="display:<?php echo ($post_main_banner[4]=='0')?'none':'';?>;">원
										<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_main_banner[3]!='0')?'':'none';?>;">
											<span class="price"><?php echo number_format($post_main_banner[2]);?></span>원
											<span class="priceDc text_orange"><?php echo number_format($post_main_banner[3]);?>%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	
						</dt>
						<?php if($main_banner_gold['is_pay']){ // 메인 배너형 골드 ?>
						<dd class="clearfix positionR">
							<p>
								<input type="checkbox" class="chk" value="1" id="main_banner_gold" name="main_banner_gold" onclick="once_gold_service('main_banner_gold',this);">
								<label class="pl5 text_color13" for="main_banner_gold"><strong>Gold</strong><img class="vm pl5" alt="Gold" src="../images/icon/icon_gold1.gif"></label>
								<span class="suv_num main_banner_gold" id="main_banner_gold_msg" style="display:none;">배경색으로 강조</span>
							</p>
							<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect main_banner_gold main_banner_gold_info" style="display:none;">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_banner_gold_date" id="main_banner_gold_date">
								<option value="">선택</option>
								<?php 
									foreach($main_banner_gold_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="main_banner_gold_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
							</div>
						</dd>
						<?php } ?>

					</dl>
					</td>
				</tr>
				<?php } ?>
				<?php if(!$sel_service && $_POST['main_list_date']!=''){ // 메인 리스트형 ?>
				<tr>
					<td class="preView pt20">
					<div style="display:block;" id="list" class="style1 color1 mt30 clearfix main_list_gold" >
					<ul class="clearfix is_gold">  
						<li class="bth">
							<span style="color:#8f8f8f" class="add">서울 구로구</span>
							<a><span class="logo_tit">㈜이마트</span></a> 
							<span class="text1">
								<span class="icon"><?php echo $icon_options;?></span>
								<a <?php echo $style_options;?> <?php echo $blink_options;?>>함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
								<a>함께할 성실한 인재모집</a><!-- opt_color1 opt_bold opt_pen2 -->
							</span>
						</li>
						<li class="bth">
							<span style="color:#8f8f8f" class="add">서울 구로구</span>
							<a><span class="logo_tit">㈜이마트</span></a> 
							<span class="text1"><span></span><a>함께할 성실한 인재모집</a></span>
						</li>
					</ul>
					</div> 
					<div class="guide mt10 pb20 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>
					</td>
					<td class="service" colspan="2">
					<dl class="serviceWrap positionR">

						<dt class="positionR content" style="border-bottom:1px solid #ddd;">
							<ul class="clearfix">
								<li class="priceInfo mb10">
									<span class="title pr10">메인 리스트형</span>
									<span id="main_list_orange_block">
									(<?php if($post_main_list[4]=='0'){ ?><strong class="unitPrice text_orange" id="main_list_orange">무료</strong><?php } else { ?><span id="main_list_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_main_list[4]);?></strong>원</span><?php } ?>)
									</span>
								</li>
								<li class="loca text_color13 mb10"><strong>메인 하단</strong></li>
							</ul>
							<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_list_date" id="main_list_date" onchange="once_service_price_print('main_list',this);">
								<?php /* ?><option value="">선택</option><?php */ ?>
								<?php 
									foreach($main_list_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
									$selected = ($service_val==$post_main_list_date) ? "selected" : "";
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:;" id="main_list_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_main_list[4]=='0')?"무료":number_format($post_main_list[4]);?></span></strong>
									<span class="won positionR" style="display:<?php echo ($post_main_list[4]=='0')?'none':'';?>;">원
										<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_main_list[3]!='0')?'':'none';?>;">
											<span class="price"><?php echo number_format($post_main_list[2]);?></span>원
											<span class="priceDc text_orange"><?php echo number_format($post_main_list[3]);?>%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	
						</dt>

						<?php if($main_list_gold['is_pay']){ // 메인 리스트형 골드 ?>
						<dd class="clearfix positionR">
							<p>
								<input type="checkbox" class="chk" value="1" id="main_list_gold" name="main_list_gold" onclick="once_gold_service('main_list_gold',this);">
								<label class="pl5 text_color13" for="main_list_gold"><strong>Gold</strong><img class="vm pl5" alt="Gold" src="../images/icon/icon_gold1.gif"></label>
								<span class="suv_num main_list_gold" id="main_list_gold_msg" style="display:none;">배경색으로 강조</span>
							</p>
							<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect main_list_gold main_list_gold_info" style="display:none;">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_list_gold_date" id="main_list_gold_date">
								<option value="">선택</option>
								<?php 
									foreach($main_list_gold_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="main_list_gold_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
							</div>
						</dd>
						<?php } ?>

					</dl>
					</td>
				</tr>
				<?php } ?>

				<?php if(!$sel_service && $_POST['main_basic_date']!=''){ // 메인 일반리스트 ?>
				<tr>
					<td class="preView pt20">
					<div style="display:block;" id="list" class="style1 color1 mt30 clearfix main_list_gold" >
					<ul class="clearfix is_gold">  
						<li class="bth">
							<span style="color:#8f8f8f" class="add">서울 구로구</span>
							<a><span class="logo_tit">㈜이마트</span></a> 
							<span class="text1">
								<span class="icon"><?php echo $icon_options;?></span>
								<a <?php echo $style_options;?> <?php echo $blink_options;?>>함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
								<a>함께할 성실한 인재모집</a><!-- opt_color1 opt_bold opt_pen2 -->
							</span>
						</li>
						<li class="bth">
							<span style="color:#8f8f8f" class="add">서울 구로구</span>
							<a><span class="logo_tit">㈜이마트</span></a> 
							<span class="text1"><span></span><a>함께할 성실한 인재모집</a></span>
						</li>
					</ul>
					</div> 
					<div class="guide mt10 pb20 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>
					</td>
					<td class="service" colspan="2">
					<dl class="serviceWrap positionR">

						<dt class="positionR content" <?php echo ($alba_basic_date) ? "" : "style='border-bottom:1px solid #ddd;'"?>>
							<ul class="clearfix">
								<li class="priceInfo mb10">
									<span class="title pr10">메인 일반리스트</span>
									<span id="main_basic_orange_block">
									(<?php if($post_main_basic[4]=='0'){ ?><strong class="unitPrice text_orange" id="main_basic_orange">무료</strong><?php } else { ?><span id="main_basic_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_main_basic[4]);?></strong>원</span><?php } ?>)
									</span>
								</li>
								<li class="loca text_color13 mb10"><strong>메인 하단 리스트형</strong></li>
							</ul>
							<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_basic_date" id="main_basic_date" onchange="once_service_price_print('main_basic',this);">
								<?php /* ?><option value="">선택</option><?php */ ?>
								<?php 
									foreach($main_basic_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
									$selected = ($service_val==$post_main_basic_date) ? "selected" : "";
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:;" id="main_basic_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_main_basic[4]=='0')?"무료":number_format($post_main_basic[4]);?></span></strong>
									<span class="won positionR" style="display:<?php echo ($post_main_basic[4]=='0')?'none':'';?>;">원
										<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_main_basic[3]!='0')?'':'none';?>;">
											<span class="price"><?php echo number_format($post_main_basic[2]);?></span>원
											<span class="priceDc text_orange"><?php echo number_format($post_main_basic[3]);?>%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	
						</dt>

						<?php if($alba_basic_date){ ?>
						<dt class="positionR content" style="border-bottom:1px solid #ddd;">
							<ul class="clearfix">
								<li class="priceInfo mb10">
									<span class="title pr10">채용공고 일반 리스트</span>
									<span id="alba_basic_orange_block">
									(<?php if($post_alba_basic[4]=='0'){ ?><strong class="unitPrice text_orange" id="alba_basic_orange">무료</strong><?php } else { ?><span id="alba_basic_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_alba_basic[4]);?></strong>원</span><?php } ?>)
									</span>
								</li>
								<li class="loca text_color13 mb10"><strong>메인 하단 리스트형</strong></li>
							</ul>
							<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_basic_date" id="alba_basic_date" onchange="once_service_price_print('alba_basic',this);">
								<?php /* ?><option value="">선택</option><?php */ ?>
								<?php 
									foreach($alba_basic_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
									$selected = ($service_val==$post_alba_basic_date) ? "selected" : "";
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:;" id="alba_basic_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_alba_basic[4]=='0')?"무료":number_format($post_alba_basic[4]);?></span></strong>
									<span class="won positionR" style="display:<?php echo ($post_alba_basic[4]=='0')?'none':'';?>;">원
										<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_alba_basic[3]!='0')?'':'none';?>;">
											<span class="price"><?php echo number_format($post_alba_basic[2]);?></span>원
											<span class="priceDc text_orange"><?php echo number_format($post_alba_basic[3]);?>%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	
						</dt>
						<?php } ?>

					</dl>
					</td>
				</tr>
				<?php } ?>

				</tbody>
				</table>

				</div>

				<?php if(!$sel_service && ($_POST['alba_platinum_date'] || $_POST['alba_banner_date'] || $_POST['alba_list_date'])){ ?>
				<div class="feeinnerBox" style="display:block;">
				<table class="feeTable" width="100%">
				<colgroup><col width="32%"><col width="43%"><col width="25%"></colgroup>
				<tbody>
				<?php if(!$sel_service && $_POST['alba_platinum_date']){	 // 알바 플래티넘 ?>
				<tr>
					<td class="preView pt20">

					<div id="platinum" class="style<?php echo $main_left;?> border<?php echo $design['sub_platinum_border'];?> number<?php echo $sub_platinum_row;?> mt25 clearfix alba_platinum_gold">
						<ul class="clearfix positionR is_gold">
						<li class="bth">
							<dl class="clearfix">
								<dt>
									<a>
									<span class="logo alba_platinum_logo_preview">
										<img width="106" height="42" src="../images/basic/img_aniLogo.gif" alt="㈜logo" id="alba_platinum_preview_logo">
										<div style="text-align:center;display:none;" class="alba_platinum_slide_preview">
											<img src="../images/basic/img_aniLogo.gif" width="106" height="42"/>
											<img src="../images/basic/img_aniLogo.gif" width="106" height="42"/>
										</div>
									</span>
									<span class="logo_tit">㈜회사명</span>
									</a> 
								</dt>
								<dd class="text1">
									<span class="icon"><?php echo $icon_options;?></span>
									<a <?php echo $style_options;?> <?php echo $blink_options;?>>함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
								</dd>
								<dd class="text2">
									<span>서울 구로구</span>
									<span><em class="icon">월</em><em class="number">5,000,000</em>원</span></dd>
								</dd>
							</dl>
						</li>
						</ul>
					</div>
					<div class="guide mt10 pb20 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>

					</td>
					<td class="service" colspan="2">
					<dl class="serviceWrap positionR">

						<dt class="positionR content" style="border-bottom:1px solid #ddd;">
							<ul class="clearfix">
								<li class="priceInfo mb10">
									<span class="title pr10">채용정보 플래티넘</span>
									<span id="alba_platinum_orange_block">
									(<?php if($post_alba_platinum[4]=='0'){ ?><strong class="unitPrice text_orange" id="alba_platinum_orange">무료</strong><?php } else { ?><span id="alba_platinum_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_alba_platinum[4]);?></strong>원</span><?php } ?>)
									</span>
								</li>
								<li class="loca text_color13 mb10"><strong>메인 최상단</strong></li>
							</ul>
							<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_platinum_date" id="alba_platinum_date" onchange="once_service_price_print('alba_platinum',this);">
								<?php /* ?><option value="">선택</option><?php */ ?>
								<?php 
									foreach($alba_platinum_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
									$selected = ($service_val==$post_alba_platinum_date) ? "selected" : "";
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:;" id="alba_platinum_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_alba_platinum[4]=='0')?"무료":number_format($post_alba_platinum[4]);?></span></strong>
									<span class="won positionR" style="display:<?php echo ($post_alba_platinum[4]=='0')?'none':'';?>;">원
										<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_alba_platinum[3]!='0')?'':'none';?>;">
											<span class="price"><?php echo number_format($post_alba_platinum[2]);?></span>원
											<span class="priceDc text_orange"><?php echo number_format($post_alba_platinum[3]);?>%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	
						</dt>
						<?php if($alba_platinum_gold['is_pay']){ // 알바 플래티넘 골드 ?>
						<dd class="clearfix positionR">
							<p>
								<input type="checkbox" class="chk" value="1" id="alba_platinum_gold" name="alba_platinum_gold" onclick="once_gold_service('alba_platinum_gold',this);">
								<label class="pl5 text_color13" for="alba_platinum_gold"><strong>Gold</strong><img class="vm pl5" alt="Gold" src="../images/icon/icon_gold1.gif"></label>
								<span class="suv_num alba_platinum_gold" id="alba_platinum_gold_msg" style="display:none;">배경색으로 강조</span>
								<!-- (배경색으로 강조 : <strong>+11,000</strong>원/1일) -->
							</p>
							<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect alba_platinum_gold alba_platinum_gold_info" style="display:none;">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_platinum_gold_date" id="alba_platinum_gold_date">
								<option value="">선택</option>
								<?php 
									foreach($alba_platinum_gold_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="alba_platinum_gold_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
							</div>
						</dd>
						<?php } ?>
						<?php if($alba_platinum_logo['is_pay']){ // 알바 플래티넘 로고강조 ?>
						<dd class="clearfix positionR">
							<p>
								<input type="checkbox" class="chk" value="1" id="alba_platinum_logo" name="alba_platinum_logo" onclick="once_option_logo(this,'alba_platinum');">
								<label class="pl5 text_color13" for="alba_platinum_logo"><strong>로고강조</strong></label>
								<span class="suv_num alba_platinum_logo" id="alba_platinum_logo_msg" style="display:none;">움직이는 로고가 노출</span>
								<!-- (움직이는 로고가 노출 : <strong>+5,500</strong>원/1일) -->
							</p>
							<ul class="aniLogo alba_platinum_logo" style="display:none;">
								<li>
									<input type="radio" class="chk" name="alba_platinum_logo_effect" value="0" id="alba_platinum_logo_0" checked onclick="logo_effects(this,'alba_platinum');">
									<label for="alba_platinum_logo_0"><img class="vm fade_image"  width="72"  alt="반짝로고1" src="../images/basic/img_aniLogo1.gif"/></label>
								</li>
								<li>
									<input type="radio" class="chk" name="alba_platinum_logo_effect" value="1" id="alba_platinum_logo_1" onclick="logo_effects(this,'alba_platinum');">
									<label for="alba_platinum_logo_1"><img class="vm"  width="72"  alt="반짝로고2" src="../images/basic/img_aniLogo2.gif" /></label>
								</li>
								<li>
									<input type="radio" class="chk" name="alba_platinum_logo_effect" value="2" id="alba_platinum_logo_2" onclick="logo_effects(this,'alba_platinum');">
									<label for="alba_platinum_logo_2">
										<div style="display:inline-block; " class="vm slide_image">
											<img src="../images/basic/img_aniLogo3.gif" width="72" height="29"/>
											<img src="../images/basic/img_aniLogo3.gif" width="72" height="29"/>
										</div>
									</label>
								</li>
							</ul>
							<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect alba_platinum_logo" style="display:none;">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_platinum_logo_date" id="alba_platinum_logo_date"><!-- onchange="once_service_price_print('alba_platinum',this);" -->
								<option value="">선택</option>
								<?php 
									foreach($alba_platinum_logo_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="alba_platinum_logo_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	   
						</dd>
						<?php } ?>

					</dl>
					</td>
				</tr>
				<?php } ?>
				<?php if(!$sel_service && $_POST['alba_banner_date']){	 // 알바 배너형 ?>
				<tr>
					<td class="preView pt20">

					<div id="box" class="style<?php echo $main_left;?> border<?php echo $design['sub_banner_border'];?> number<?php echo $sub_banner_row;?> mt25 clearfix alba_banner_gold">
					<ul class="is_gold">
					<li class="bth">
						<dl>
							<dt>
								<a><span class="logo_tit">㈜회사명</span></a> 
							</dt>
							<dd class="text1"><!-- opt_color1 opt_bold opt_pen2 -->
									<span class="icon"><?php echo $icon_options;?></span>
									<a <?php echo $style_options;?> <?php echo $blink_options;?>>함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
							</dd>
							<dd class="text2 clearfix">
								<span class="pay"><em class="icon">월</em> <em class="number">5,000,000</em>원</span>
								<span class="add" style="">서울 구로구</span>
							</dd> 
						</dl>
					</li>
					</ul>
					</div>
					<div class="guide mt10 pb20 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>

					</td>
					<td class="service" colspan="2">
					<dl class="serviceWrap positionR">

						<dt class="positionR content" style="border-bottom:1px solid #ddd;">
							<ul class="clearfix">
								<li class="priceInfo mb10">
									<span class="title pr10">채용정보 배너형</span>
									<span id="alba_banner_orange_block">
									(<?php if($post_alba_banner[4]=='0'){ ?><strong class="unitPrice text_orange" id="alba_banner_orange">무료</strong><?php } else { ?><span id="alba_banner_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_alba_banner[4]);?></strong>원</span><?php } ?>)
									</span>
								</li>
								<li class="loca text_color13 mb10"><strong>배너형</strong></li>
							</ul>
							<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_banner_date" id="alba_banner_date" onchange="once_service_price_print('alba_banner',this);">
								<?php /* ?><option value="">선택</option><?php */ ?>
								<?php 
									foreach($alba_banner_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
									$selected = ($service_val==$post_alba_banner_date) ? "selected" : "";
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:;" id="alba_banner_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_alba_banner[4]=='0')?"무료":number_format($post_alba_banner[4]);?></span></strong>
									<span class="won positionR" style="display:<?php echo ($post_alba_banner[4]=='0')?'none':'';?>;">원
										<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_alba_banner[3]!='0')?'':'none';?>;">
											<span class="price"><?php echo number_format($post_alba_banner[2]);?></span>원
											<span class="priceDc text_orange"><?php echo number_format($post_alba_banner[3]);?>%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	
						</dt>
						<?php if($alba_banner_gold['is_pay']){ // 알바 배너형 골드 ?>
						<dd class="clearfix positionR">
							<p>
								<input type="checkbox" class="chk" value="1" id="alba_banner_gold" name="alba_banner_gold" onclick="once_gold_service('alba_banner_gold',this);">
								<label class="pl5 text_color13" for="alba_banner_gold"><strong>Gold</strong><img class="vm pl5" alt="Gold" src="../images/icon/icon_gold1.gif"></label>
								<span class="suv_num alba_banner_gold" id="alba_banner_gold_msg" style="display:none;">배경색으로 강조</span>
								<!-- (배경색으로 강조 : <strong>+11,000</strong>원/1일) -->
							</p>
							<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect alba_banner_gold alba_banner_gold_info" style="display:none;">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_banner_gold_date" id="alba_banner_gold_date">
								<option value="">선택</option>
								<?php 
									foreach($alba_banner_gold_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="alba_banner_gold_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
							</div>
						</dd>
						<?php } ?>

					</dl>
					</td>
				</tr>
				<?php } ?>
				<?php if(!$sel_service && $_POST['alba_list_date']){	 // 알바 리스트형 ?>
				<tr>
					<td class="preView pt20">

					<div style="display:block;" id="list" class="style1 color1 mt30 clearfix alba_list_gold" >
					<ul class="clearfix is_gold">  
						<li class="bth">
							<span style="color:#8f8f8f" class="add">서울 구로구</span>
							<a><span class="logo_tit">㈜이마트</span></a> 
							<span class="text1">
								<span class="icon"><?php echo $icon_options;?></span>
								<a <?php echo $style_options;?> <?php echo $blink_options;?>>함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
								<a>함께할 성실한 인재모집</a><!-- opt_color1 opt_bold opt_pen2 -->
							</span>
						</li>
						<li class="bth">
							<span style="color:#8f8f8f" class="add">서울 구로구</span>
							<a><span class="logo_tit">㈜이마트</span></a> 
							<span class="text1"><span></span><a>함께할 성실한 인재모집</a></span>
						</li>
					</ul>
					</div> 
					<div class="guide mt10 pb20 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>

					</td>
					<td class="service" colspan="2">
					<dl class="serviceWrap positionR">

						<dt class="positionR content" style="border-bottom:1px solid #ddd;">
							<ul class="clearfix">
								<li class="priceInfo mb10">
									<span class="title pr10">채용정보 리스트형</span>
									<span id="alba_list_orange_block">
									(<?php if($post_alba_list[4]=='0'){ ?><strong class="unitPrice text_orange" id="alba_list_orange">무료</strong><?php } else { ?><span id="alba_list_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_alba_list[4]);?></strong>원</span><?php } ?>)
									</span>
								</li>
								<li class="loca text_color13 mb10"><strong>리스트형</strong></li>
							</ul>
							<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_list_date" id="alba_list_date" onchange="once_service_price_print('alba_list',this);">
								<?php /* ?><option value="">선택</option><?php */ ?>
								<?php 
									foreach($alba_list_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
									$selected = ($service_val==$post_alba_list_date) ? "selected" : "";
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:;" id="alba_list_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_alba_list[4]=='0')?"무료":number_format($post_alba_list[4]);?></span></strong>
									<span class="won positionR" style="display:<?php echo ($post_alba_list[4]=='0')?'none':'';?>;">원
										<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_alba_list[3]!='0')?'':'none';?>;">
											<span class="price"><?php echo number_format($post_alba_list[2]);?></span>원
											<span class="priceDc text_orange"><?php echo number_format($post_alba_list[3]);?>%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	
						</dt>
						<?php if($alba_list_gold['is_pay']){ // 메인 리스트형 골드 ?>
						<dd class="clearfix positionR">
							<p>
								<input type="checkbox" class="chk" value="1" id="alba_list_gold" name="alba_list_gold" onclick="once_gold_service('alba_list_gold',this);">
								<label class="pl5 text_color13" for="alba_list_gold"><strong>Gold</strong><img class="vm pl5" alt="Gold" src="../images/icon/icon_gold1.gif"></label>
								<span class="suv_num alba_list_gold" id="alba_list_gold_msg" style="display:none;">배경색으로 강조</span>
							</p>
							<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect alba_list_gold alba_list_gold_info" style="display:none;">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_list_gold_date" id="alba_list_gold_date">
								<option value="">선택</option>
								<?php 
									foreach($alba_list_gold_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="alba_list_gold_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
							</div>
						</dd>
						<?php } ?>

					</dl>
					</td>
				</tr>
				<?php } ?>

				<?php if(!$sel_service && $_POST['alba_basic_date']){	 // 채용정보 일반리스트 ?>
				<tr>
					<td class="preView pt20">

					<div style="display:block;" id="list" class="style1 color1 mt30 clearfix alba_basic_gold" >
					<ul class="clearfix is_gold">  
						<li class="bth">
							<span style="color:#8f8f8f" class="add">서울 구로구</span>
							<a><span class="logo_tit">㈜이마트</span></a> 
							<span class="text1">
								<span class="icon"><?php echo $icon_options;?></span>
								<a <?php echo $style_options;?> <?php echo $blink_options;?>>함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
								<a>함께할 성실한 인재모집</a><!-- opt_color1 opt_bold opt_pen2 -->
							</span>
						</li>
						<li class="bth">
							<span style="color:#8f8f8f" class="add">서울 구로구</span>
							<a><span class="logo_tit">㈜이마트</span></a> 
							<span class="text1"><span></span><a>함께할 성실한 인재모집</a></span>
						</li>
					</ul>
					</div> 
					<div class="guide mt10 pb20 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>

					</td>
					<td class="service" colspan="2">
					<dl class="serviceWrap positionR">

						<dt class="positionR content" style="border-bottom:1px solid #ddd;">
							<ul class="clearfix">
								<li class="priceInfo mb10">
									<span class="title pr10">채용정보 일반리스트</span>
									<span id="alba_basic_orange_block">
									(<?php if($post_alba_basic[4]=='0'){ ?><strong class="unitPrice text_orange" id="alba_basic_orange">무료</strong><?php } else { ?><span id="alba_basic_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_alba_basic[4]);?></strong>원</span><?php } ?>)
									</span>
								</li>
								<li class="loca text_color13 mb10"><strong>채용정보 하단</strong></li>
							</ul>
							<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_basic_date" id="alba_basic_date" onchange="once_service_price_print('alba_basic',this);">
								<?php /* ?><option value="">선택</option><?php */ ?>
								<?php 
									foreach($alba_basic_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
									$selected = ($service_val==$post_alba_basic_date) ? "selected" : "";
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:;" id="alba_basic_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_alba_basic[4]=='0')?"무료":number_format($post_alba_basic[4]);?></span></strong>
									<span class="won positionR" style="display:<?php echo ($post_alba_basic[4]=='0')?'none':'';?>;">원
										<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_alba_basic[3]!='0')?'':'none';?>;">
											<span class="price"><?php echo number_format($post_alba_basic[2]);?></span>원
											<span class="priceDc text_orange"><?php echo number_format($post_alba_basic[3]);?>%</span>
										</em>
									</span>
								</span>
							</p>
							</div>	
						</dt>

					</dl>
					</td>
				</tr>
				<?php } ?>

				</tbody>
				</table>
				</div>
				<?php } ?>
				<?php if(!$sel_service && $_POST['alba_option_busy_date']){ // 급구 아이콘 유무 ?>
				<div class="feeinnerBox" style="display:block;">
				<table class="feeTable" width="100%">
				<colgroup><col width="32%"><col width="43%"><col width="25%"></colgroup>
				<tbody>
					<tr>
						<td class="preView pt20">
							<div class="style1  color1 mt30 clearfix" id="nomalList" style="display:block; width:239px; margin:0 auto;">
							<dl class="clearfix">  
								<dt>채용제목</dt>
								<dd>
									<div class="title">
										<span class="icon">
											<img src="<?php echo $alice['data_icon_path'].'/'.$alba_option_busy['busy_icon'];?>"/>
											<span class="icons pr5"><?php echo $icon_options;?></span>
										</span>
										<a <?php echo $style_options;?> <?php echo $blink_options;?>>함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a><!-- opt_color1 opt_bold opt_pen2 -->
									</div>
								</dd>
							</dl>
							</div>
							<div class="guide mt10 pb20 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>
						</td>
						<td class="service" colspan="2">
							<dl class="serviceWrap mt20 mb20 positionR">
							<dt class="positionR content" style="border-bottom:1px solid #ddd;">
								<ul class="clearfix">
									<li class="priceInfo mb10">
										<span class="title pr10">일반 리스트 급구 아이콘 <img src="<?php echo $alice['data_icon_path'].'/'.$alba_option_busy['busy_icon'];?>"/> 강조</span>
										<span id="alba_option_busy_orange_block">
										(<?php if($post_busy_option[4]=='0'){ ?><strong class="unitPrice text_orange" id="alba_option_busy_orange">무료</strong><?php } else { ?><span id="alba_list_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_busy_option[4]);?></strong>원</span><?php } ?>)
										</span>
									</li>
								</ul>
								<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
									<p class="priceSelect">
										<span class="today"><strong>오늘</strong> +</span>
										<select class="ipSelect2" title="신청기간" name="alba_option_busy_date" id="alba_option_busy_date" onchange="once_service_price_print('alba_option_busy',this);">
										<?php /* ?><option value="">선택</option><?php */ ?>
										<?php 
											foreach($alba_option_busy_service as $key => $val){ 
											$service_cnt = $val['service_cnt'];
											$service_unit = $service_control->_unit($val['service_unit']);
											$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
											$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
											$service_text = $service_cnt . $service_unit;
											$selected = ($service_val==$post_busy_option_date) ? "selected" : "";
										?>
										<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
										<?php } ?>
										</select>
										<span style="display:;" id="alba_option_busy_price_info">
											<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_busy_option[4]=='0')?"무료":number_format($post_busy_option[4]);?></span></strong>
											<span class="won positionR" style="display:<?php echo ($post_busy_option[4]=='0')?'none':'';?>;">원
												<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_busy_option[3]!='0')?'':'none';?>;">
													<span class="price"><?php echo number_format($post_busy_option[2]);?></span>원
													<span class="priceDc text_orange"><?php echo number_format($post_busy_option[3]);?>%</span>
												</em>
											</span>
										</span>
									</p>
								</div>	
							</dt>
							</dl>  
						</td>
					</tr>
				</tbody>
				</table>
				</div>
				<?php } ?>

				<?php } // 복합 서비스 선택 if end.?>


				<?php if($sel_service && (stristr($sel_service,'option')) ){ // 단일 / 옵션만 선택시 ?>
				<!-- 옵션만 선택시 -->
				<div class="feeinnerBox">
					<table class="feeTable" width="100%">
					<colgroup><col width="32%"><col width="43%"><col width="25%"></colgroup>
					<tbody>
					<tr>
						<td class="preView pt20">
							<div class="style1  color1 mt30 clearfix" id="nomalList" style="display:block; width:239px; margin:0 auto;">
							<dl class="clearfix">  
								<dt>채용제목</dt>
								<dd>
									<div class="title">
										<span class="icon">
											<?php if($alba_option_busy_date){ ?><img src="<?php echo $alice['data_icon_path'].'/'.$alba_option_busy['busy_icon'];?>"/><?php } ?>
											<span class="icons pr5"><?php echo $icon_options;?></span>
										</span>
										<a <?php echo $style_options;?> <?php echo $blink_options;?>>함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a><!-- opt_color1 opt_bold opt_pen2 -->
									</div>
								</dd>
							</dl>
							</div>
							<div class="guide mt10 pb20 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>
						</td>
						<?php if($sel_service=='alba_option_busy'){ // 급구 아이콘 ?>
						<td class="service" colspan="2">
							<dl class="serviceWrap mt20 mb20 positionR">
							<dt class="positionR content" style="border-bottom:1px solid #ddd;">
								<ul class="clearfix">
									<li class="priceInfo mb10">
										<span class="title pr10"><?php echo $title_icon;?></span>
										(<?php if($service_date[4]=='0'){ ?><strong class="unitPrice text_orange">무료</strong><?php } else { ?><strong class="unitPrice text_orange"><?php echo number_format($service_date[4]);?></strong>원<?php } ?>/<?php echo $service_date[0];?><?php echo $service_control->_unit($service_date[1]);?>)
									</li>
								</ul>
								<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
									<p class="priceSelect">
										<span class="today"><strong>오늘</strong> +</span>
										<select class="ipSelect2" title="신청기간" name="alba_option_busy_date" id="alba_option_busy_date" onchange="once_service_price_print('alba_option_busy',this);">
										<option value="">선택</option>
										<?php 
											foreach($busy_service_rows as $key => $val){ 
											$service_cnt = $val['service_cnt'];
											$service_unit = $service_control->_unit($val['service_unit']);
											$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
											$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
											$service_text = $service_cnt . $service_unit;
											$selected = ($service_val==$_POST[$sel_service."_date"]) ? "selected" : "";
										?>
										<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
										<?php } ?>
										</select>
										<span style="display:;" id="alba_option_busy_price_info">
											<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($service_date[4]=='0')?"무료":number_format($service_date[4]);?></span></strong>
											<span class="won positionR" style="display:<?php echo ($service_date[4]=='0')?'none':'';?>;">원
												<em class="positionA" style="top:-21px; right:0;display:<?php echo ($service_date[3]!='0')?'':'none';?>;">
													<span class="price"><?php echo number_format($service_date[2]);?></span>원
													<span class="priceDc text_orange"><?php echo number_format($service_date[3]);?>%</span>
												</em>
											</span>
										</span>
									</p>
								</div>	
							</dt>
							</dl>  
						</td>
						<?php } else if($sel_service=='alba_option_neon') { // 형광펜 ?>
						<td class="service" colspan="2">
							<dl class="serviceWrap mt20 mb20 positionR">
							<dt class="positionR content" style="border-bottom:1px solid #ddd;">
								<ul class="clearfix">
									<li class="priceInfo mb10">
										<span class="title pr10"><?php echo $title_icon;?></span>
										(<?php if($service_date[4]=='0'){ ?><strong class="unitPrice text_orange">무료</strong><?php } else { ?><strong class="unitPrice text_orange"><?php echo number_format($service_date[4]);?></strong>원<?php } ?>/<?php echo $service_date[0];?><?php echo $service_control->_unit($service_date[1]);?>)
									</li>
								</ul>
								<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
									<p class="priceSelect">
										<span class="today"><strong>오늘</strong> +</span>
										<select class="ipSelect2" title="신청기간" name="alba_option_neon_date" id="alba_option_neon_date" onchange="once_service_price_print('alba_option_neon',this);">
										<option value="">선택</option>
										<?php 
											foreach($neon_service_rows as $key => $val){ 
											$service_cnt = $val['service_cnt'];
											$service_unit = $service_control->_unit($val['service_unit']);
											$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
											$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
											$service_text = $service_cnt . $service_unit;
											$selected = ($service_val==$_POST[$sel_service."_date"]) ? "selected" : "";
										?>
										<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
										<?php } ?>
										</select>
										<span style="display:;" id="alba_option_neon_price_info">
											<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($service_date[4]=='0')?"무료":number_format($service_date[4]);?></span></strong>
											<span class="won positionR" style="display:<?php echo ($service_date[4]=='0')?'none':'';?>;">원
												<em class="positionA" style="top:-21px; right:0;display:<?php echo ($service_date[3]!='0')?'':'none';?>;">
													<span class="price"><?php echo number_format($service_date[2]);?></span>원
													<span class="priceDc text_orange"><?php echo number_format($service_date[3]);?>%</span>
												</em>
											</span>
										</span>
									</p>
								</div>
							</dt>
							<dt class="positionR content" style="border-bottom:1px solid #ddd;">								
								<div style="display:;" class="boxRadio bg_color2 ml10 mt10 pl10 pt5 pb5 alba_option_neon" ><strong>칼라선택:</strong>
								<?php 
									for($i=0;$i<$alba_option_neon_color_cnt;$i++){ 
									if($post_neon_option){
										$checked = ($alba_option_neon_color[$i]==$post_neon_option)?'checked':'';
									} else {
										$checked = ($i==0) ? 'checked' : '';
									}
								?>
									<span class="">
										<input type="radio" value="<?php echo $alba_option_neon_color[$i];?>" name="alba_option_neon_sel" id="alba_option_neon_<?php echo $i;?>" class="chk" <?php echo $checked;?> onclick="alba_option_neons(this);">
										<label for="alba_option_neon_<?php echo $i;?>" style="color:#fff; background:#<?php echo $alba_option_neon_color[$i];?>;">형광펜</label>
									</span>
								<?php } ?>
								</div>
							</td>
							</dl>  
						</td>
						<?php } else if($sel_service=='alba_option_bold') { // 굵게 ?>
						<td class="service" colspan="2">
							<dl class="serviceWrap mt20 mb20 positionR">
							<dt class="positionR content" style="border-bottom:1px solid #ddd;">
								<ul class="clearfix">
									<li class="priceInfo mb10">
										<span class="title pr10"><?php echo $title_icon;?></span>
										(<?php if($service_date[4]=='0'){ ?><strong class="unitPrice text_orange">무료</strong><?php } else { ?><strong class="unitPrice text_orange"><?php echo number_format($service_date[4]);?></strong>원<?php } ?>/<?php echo $service_date[0];?><?php echo $service_control->_unit($service_date[1]);?>)
									</li>
								</ul>
								<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
									<p class="priceSelect">
										<span class="today"><strong>오늘</strong> +</span>
										<select class="ipSelect2" title="신청기간" name="alba_option_bold_date" id="alba_option_bold_date" onchange="once_service_price_print('alba_option_bold',this);">
										<option value="">선택</option>
										<?php 
											foreach($bold_service_rows as $key => $val){ 
											$service_cnt = $val['service_cnt'];
											$service_unit = $service_control->_unit($val['service_unit']);
											$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
											$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
											$service_text = $service_cnt . $service_unit;
											$selected = ($service_val==$_POST[$sel_service."_date"]) ? "selected" : "";
										?>
										<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
										<?php } ?>
										</select>
										<span style="display:;" id="alba_option_bold_price_info">
											<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($service_date[4]=='0')?"무료":number_format($service_date[4]);?></span></strong>
											<span class="won positionR" style="display:<?php echo ($service_date[4]=='0')?'none':'';?>;">원
												<em class="positionA" style="top:-21px; right:0;display:<?php echo ($service_date[3]!='0')?'':'none';?>;">
													<span class="price"><?php echo number_format($service_date[2]);?></span>원
													<span class="priceDc text_orange"><?php echo number_format($service_date[3]);?>%</span>
												</em>
											</span>
										</span>
									</p>
								</div>	
							</dt>
							</dl>  
						</td>
						<?php } else if($sel_service=='alba_option_icon') { // 아이콘 ?>
						<td class="service" colspan="2">
							<dl class="serviceWrap mt20 mb20 positionR">
							<dt class="positionR content" style="border-bottom:1px solid #ddd;">
								<ul class="clearfix">
									<li class="priceInfo mb10">
										<span class="title pr10"><?php echo $title_icon;?></span>
										(<?php if($service_date[4]=='0'){ ?><strong class="unitPrice text_orange">무료</strong><?php } else { ?><strong class="unitPrice text_orange"><?php echo number_format($service_date[4]);?></strong>원<?php } ?>/<?php echo $service_date[0];?><?php echo $service_control->_unit($service_date[1]);?>)
									</li>
								</ul>
								<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
									<p class="priceSelect">
										<span class="today"><strong>오늘</strong> +</span>
										<select class="ipSelect2" title="신청기간" name="alba_option_icon_date" id="alba_option_icon_date" onchange="once_service_price_print('alba_option_icon',this);">
										<option value="">선택</option>
										<?php 
											foreach($icon_service_rows as $key => $val){ 
											$service_cnt = $val['service_cnt'];
											$service_unit = $service_control->_unit($val['service_unit']);
											$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
											$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
											$service_text = $service_cnt . $service_unit;
											$selected = ($service_val==$_POST[$sel_service."_date"]) ? "selected" : "";
										?>
										<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
										<?php } ?>
										</select>
										<span style="display:;" id="alba_option_icon_price_info">
											<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($service_date[4]=='0')?"무료":number_format($service_date[4]);?></span></strong>
											<span class="won positionR" style="display:<?php echo ($service_date[4]=='0')?'none':'';?>;">원
												<em class="positionA" style="top:-21px; right:0;display:<?php echo ($service_date[3]!='0')?'':'none';?>;">
													<span class="price"><?php echo number_format($service_date[2]);?></span>원
													<span class="priceDc text_orange"><?php echo number_format($service_date[3]);?>%</span>
												</em>
											</span>
										</span>
									</p>
								</div>	
							</dt>
							<dt class="positionR content" style="border-bottom:1px solid #ddd;">
								<div style="display:;" class="boxIcon ml10 mt10  pt5 pb5 alba_option_icon">
								<?php 
									foreach($alba_option_icon_list as $key => $val){ 
									if($_POST['alba_option_icon']){
										$checked = ($val['no']==$_POST['alba_option_icon'])?'checked':'';
									} else {
										$checked = ($key==0) ? 'checked' : '';
									}
								?>
									<span class="pr15"><input type="radio" name="alba_option_icon_sel" value="<?php echo $val['no'];?>" id="alba_option_icon_<?php echo $key;?>" class="chk" <?php echo $checked;?> onclick="option_service('icon',this,true);">
										<label for="alba_option_icon_<?php echo $key;?>" id="alba_option_icon_<?php echo $val['no'];?>"><img src="<?php echo $alice['data_icon_path']."/".$val['name'];?>"></label>
									</span>
								<?php } ?>
								</div>
							</dt>
							</dl>  
						</td>
						<?php } else if($sel_service=='alba_option_color') { // 글자색 ?>
						<td class="service" colspan="2">
							<dl class="serviceWrap mt20 mb20 positionR">
							<dt class="positionR content" style="border-bottom:1px solid #ddd;">
								<ul class="clearfix">
									<li class="priceInfo mb10">
										<span class="title pr10"><?php echo $title_icon;?></span>
										(<?php if($service_date[4]=='0'){ ?><strong class="unitPrice text_orange">무료</strong><?php } else { ?><strong class="unitPrice text_orange"><?php echo number_format($service_date[4]);?></strong>원<?php } ?>/<?php echo $service_date[0];?><?php echo $service_control->_unit($service_date[1]);?>)
									</li>
								</ul>
								<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
									<p class="priceSelect">
										<span class="today"><strong>오늘</strong> +</span>
										<select class="ipSelect2" title="신청기간" name="alba_option_color_date" id="alba_option_color_date" onchange="once_service_price_print('alba_option_color',this);">
										<option value="">선택</option>
										<?php 
											foreach($color_service_rows as $key => $val){ 
											$service_cnt = $val['service_cnt'];
											$service_unit = $service_control->_unit($val['service_unit']);
											$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
											$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
											$service_text = $service_cnt . $service_unit;
											$selected = ($service_val==$_POST[$sel_service."_date"]) ? "selected" : "";
										?>
										<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
										<?php } ?>
										</select>
										<span style="display:;" id="alba_option_color_price_info">
											<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($service_date[4]=='0')?"무료":number_format($service_date[4]);?></span></strong>
											<span class="won positionR" style="display:<?php echo ($service_date[4]=='0')?'none':'';?>;">원
												<em class="positionA" style="top:-21px; right:0;display:<?php echo ($service_date[3]!='0')?'':'none';?>;">
													<span class="price"><?php echo number_format($service_date[2]);?></span>원
													<span class="priceDc text_orange"><?php echo number_format($service_date[3]);?>%</span>
												</em>
											</span>
										</span>
									</p>
								</div>	
							</dt>
							<dt class="positionR content" style="border-bottom:1px solid #ddd;">
								<div style="display:;" class="boxRadio bg_color2 ml10 mt10 pl10 pt5 pb5 alba_option_color"><strong>칼라선택:</strong>
								<?php 
									for($i=0;$i<$alba_option_colors_cnt;$i++){
									if($_POST['alba_option_color']){
										$checked = ($_POST['alba_option_color']==$alba_option_colors[$i])?'checked':'';
									} else {
										$checked = ($i==0) ? 'checked' : '';
									}
								?>
									<span class=""><input type="radio" name="alba_option_color_sel" id="alba_option_color_sel_<?php echo $i;?>" value="<?php echo $alba_option_colors[$i];?>" class="chk" <?php echo $checked;?> onclick="option_service('color',this);"><label for="alba_option_color_sel_<?php echo $i;?>" style="color:#<?php echo $alba_option_colors[$i];?>"> 글자색</label></span>
								<?php } ?>
								</div>
							</dt>
							</dl>  
						</td>
						<?php } else if($sel_service=='alba_option_blink') { // 반짝칼라 ?>
						<td class="service" colspan="2">
							<dl class="serviceWrap mt20 mb20 positionR">
							<dt class="positionR content" style="border-bottom:1px solid #ddd;">
								<ul class="clearfix">
									<li class="priceInfo mb10">
										<span class="title pr10"><?php echo $title_icon;?></span>
										(<?php if($service_date[4]=='0'){ ?><strong class="unitPrice text_orange">무료</strong><?php } else { ?><strong class="unitPrice text_orange"><?php echo number_format($service_date[4]);?></strong>원<?php } ?>/<?php echo $service_date[0];?><?php echo $service_control->_unit($service_date[1]);?>)
									</li>
								</ul>
								<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
									<p class="priceSelect">
										<span class="today"><strong>오늘</strong> +</span>
										<select class="ipSelect2" title="신청기간" name="alba_option_blink_date" id="alba_option_blink_date" onchange="once_service_price_print('alba_option_blink',this);">
										<option value="">선택</option>
										<?php 
											foreach($blink_service_rows as $key => $val){ 
											$service_cnt = $val['service_cnt'];
											$service_unit = $service_control->_unit($val['service_unit']);
											$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
											$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
											$service_text = $service_cnt . $service_unit;
											$selected = ($service_val==$_POST[$sel_service."_date"]) ? "selected" : "";
										?>
										<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
										<?php } ?>
										</select>
										<span style="display:;" id="alba_option_blink_price_info">
											<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($service_date[4]=='0')?"무료":number_format($service_date[4]);?></span></strong>
											<span class="won positionR" style="display:<?php echo ($service_date[4]=='0')?'none':'';?>;">원
												<em class="positionA" style="top:-21px; right:0;display:<?php echo ($service_date[3]!='0')?'':'none';?>;">
													<span class="price"><?php echo number_format($service_date[2]);?></span>원
													<span class="priceDc text_orange"><?php echo number_format($service_date[3]);?>%</span>
												</em>
											</span>
										</span>
									</p>
								</div>	
							</dt>
							</dl>  
						</td>
						<?php } ?>
					</tr>
					</tbody>
					</table>
				</div>
				<!-- 옵션만 선택시 //-->
				<?php } ?>

				<?php if($main_platinum_date||$main_prime_date||$main_grand_date||$main_banner_date||$main_list_date||$alba_platinum_date||$alba_banner_date||$alba_list_date||$alba_option_busy_date||$alba_option_color_date){ ?>
				<!-- 공통 옵션 -->
				<div class="feeinnerBox" style="margin-top:-2px; border-top:0;">
					<table class="feeTable" width="100%">
					<tbody>
					<tr>
						<td class="service" colspan="2">
							<div class="pointTit bg_color2 border_color pl10">
								<strong class="pr10">강조옵션</strong>(로고형/배너형/박스형/줄광고와 일반채용정보 리스트 모두 적용)
							</div>
							<div class="serviceWrap mb20 positionR"  style="padding:10px 20px;">

							<?php if($alba_option_neon['is_pay'] && $sel_service != 'alba_option_neon'){ ?>
							<dd class="clearfix positionR" >
								<p>
									<input type="checkbox" class="chk" name="alba_option_neon" value="1" id="alba_option_neon" onclick="option_service('neon',this);" <?php echo ($alba_option_neon_date)?'checked':'';?>>
									<label class="pl5 text_color13" for="alba_option_neon"><strong>형광펜</strong></label>
									<span class="suv_num alba_option_neon" id="alba_option_neon_msg" style="display:none;">채용공고 제목을 형광펜 강조 효과</span>
								</p>

								<div style="display:<?php echo ($alba_option_neon_date)?'':'none';?>;" class="boxRadio bg_color2 ml10 mt10 pl10 pt5 pb5 alba_option_neon" ><strong>칼라선택:</strong>
								<?php 
									for($i=0;$i<$alba_option_neon_color_cnt;$i++){ 
									if($post_neon_option){
										$checked = ($alba_option_neon_color[$i]==$post_neon_option)?'checked':'';
									} else {
										$checked = ($i==0) ? 'checked' : '';
									}
								?>
									<span class="">
										<input type="radio" value="<?php echo $alba_option_neon_color[$i];?>" name="alba_option_neon_sel" id="alba_option_neon_<?php echo $i;?>" class="chk" <?php echo $checked;?> onclick="alba_option_neons(this);">
										<label for="alba_option_neon_<?php echo $i;?>" style="color:#fff;background:#<?php echo $alba_option_neon_color[$i];?>;">형광펜</label>
									</span>
								<?php } ?>
								</div>

								<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;">
								<p class="priceSelect alba_option_neon" style="display:<?php echo ($alba_option_neon_date)?'':'none';?>;">
									<span class="today"><strong>오늘</strong> +</span>
									<select class="ipSelect2" title="신청기간" name="alba_option_neon_date" id="alba_option_neon_date" onchange="option_price_print('alba_option_neon',this);">
									<option value="">선택</option>
									<?php 
										foreach($alba_option_neon_service as $key => $val){ 
										$service_cnt = $val['service_cnt'];
										$service_unit = $service_control->_unit($val['service_unit']);
										$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
										$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
										$service_text = $service_cnt . $service_unit;
										$selected = ($service_val==$post_neon_option_date)?"selected":"";
									?>
									<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
									<?php } ?>
									</select>

									<?php if($post_neon_option_date){ ?>
									<span style="display:;" id="alba_option_neon_price_info">
										<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_neon_option_dates[4]=='0')?"무료":number_format($post_neon_option_dates[4]);?></span></strong>
										<span class="won positionR" style="display:<?php echo ($post_neon_option_dates[4]=='0')?'none':'';?>;">원
											<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_neon_option_dates[3]!='0')?'':'none';?>;">
												<span class="price"><?php echo number_format($post_neon_option_dates[2]);?></span>원
												<span class="priceDc text_orange"><?php echo number_format($post_neon_option_dates[3]);?>%</span>
											</em>
										</span>
									</span>
									<?php } else { ?>
									<span style="display:none;" id="alba_option_neon_price_info">
										<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
										<span class="won positionR">원
											<em class="positionA" style="top:-21px; right:0;">
												<span class="price">0</span>원
												<span class="priceDc text_orange">0%</span>
											</em>
										</span>
									</span>
									<?php } ?>

								</p>
								</div>
							</dd>
							<?php } ?>

							<?php if($alba_option_bold['is_pay'] && $sel_service != 'alba_option_bold'){ ?>
							<dd class="clearfix positionR">
								<p>
									<input type="checkbox" class="chk" name="alba_option_bold" value="1" id="alba_option_bold" onclick="option_service('bold',this);" <?php echo ($post_bold_option_date)?'checked':'';?>>
									<label class="pl5 text_color13" for="alba_option_bold"><strong>굵은글자</strong></label>
									<span class="suv_num alba_option_bold" id="alba_option_bold_msg" style="display: <?php echo ($post_bold_option_date)?'':'none';?>;">채용공고 제목을 굵은 글자로 강조 효과</span>
									<!-- (굵은 글자로 강조 효과 : <strong>+5,500</strong>원/1일) -->
								</p>

								<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
								<p class="priceSelect alba_option_bold" style="display:<?php echo ($post_bold_option_date)?'':'none';?>;">
									<span class="today"><strong>오늘</strong> +</span>
									<select class="ipSelect2" title="신청기간" name="alba_option_bold_date" id="alba_option_bold_date" onchange="option_price_print('alba_option_bold',this);">
									<option value="">선택</option>
									<?php 
										foreach($alba_option_bold_service as $key => $val){ 
										$service_cnt = $val['service_cnt'];
										$service_unit = $service_control->_unit($val['service_unit']);
										$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
										$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
										$service_text = $service_cnt . $service_unit;
										$selected = ($service_val==$post_bold_option_date)?"selected":"";
									?>
									<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
									<?php } ?>
									</select>
									
									<?php if($post_bold_option_date){ ?>
									<span style="display:;" id="alba_option_bold_price_info">
										<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_bold_option_dates[4]=='0')?"무료":number_format($post_bold_option_dates[4]);?></span></strong>
										<span class="won positionR" style="display:<?php echo ($post_bold_option_dates[4]=='0')?'none':'';?>;">원
											<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_bold_option_dates[3]!='0')?'':'none';?>;">
												<span class="price"><?php echo number_format($post_bold_option_dates[2]);?></span>원
												<span class="priceDc text_orange"><?php echo number_format($post_bold_option_dates[3]);?>%</span>
											</em>
										</span>
									</span>
									<?php } else { ?>
									<span style="display:none;" id="alba_option_bold_price_info">
										<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
										<span class="won positionR">원
											<em class="positionA" style="top:-21px; right:0;">
												<span class="price">0</span>원
												<span class="priceDc text_orange">0%</span>
											</em>
										</span>
									</span>
									<?php } ?>

								</p>
								</div>	   
							</dd>		
							<?php } ?>

							<?php if($alba_option_icon['is_pay'] && $sel_service != 'alba_option_icon'){ ?>
							<dd class="clearfix positionR">
								<p>
									<input type="checkbox" class="chk" name="alba_option_icon" value="1" id="alba_option_icon" onclick="option_service('icon',this);" <?php echo ($post_icon_option_date)?'checked':'';?>>
									<label class="pl5 text_color13" for="alba_option_icon"><strong>아이콘</strong></label>
									<span class="suv_num alba_option_icon" id="alba_option_icon_msg" style="display:<?php echo ($post_icon_option_date)?'':'none';?>;">채용공고 제목을 아이콘으로 강조 효과</span>
									<!-- (아이콘으로 강조 효과 : <strong>+5,500</strong>원/1일) -->
								</p>

								<div style="display:<?php echo ($post_icon_option_date)?'':'none';?>;" class="boxIcon ml10 mt10  pt5 pb5 alba_option_icon">
								<?php 
									foreach($alba_option_icon_list as $key => $val){ 
									if($post_icon_option){
										$checked = ($val['no']==$post_icon_option)?'checked':'';
									} else {
										$checked = ($key==0) ? 'checked' : '';
									}
								?>
									<span class="pr15"><input type="radio" name="alba_option_icon_sel" value="<?php echo $val['no'];?>" id="alba_option_icon_<?php echo $key;?>" class="chk" <?php echo $checked;?> onclick="option_service('icon',this);">
										<label for="alba_option_icon_<?php echo $key;?>" id="alba_option_icon_<?php echo $val['no'];?>"><img src="<?php echo $alice['data_icon_path']."/".$val['name'];?>"></label>
									</span>
								<?php } ?>
								</div>
								<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
								<p class="priceSelect alba_option_icon" style="display:<?php echo ($post_icon_option_date)?'':'none';?>;">
									<span class="today"><strong>오늘</strong> +</span>
									<select class="ipSelect2" title="신청기간" name="alba_option_icon_date" id="alba_option_icon_date" onchange="option_price_print('alba_option_icon',this);">
									<option value="">선택</option>
									<?php 
										foreach($alba_option_icon_service as $key => $val){ 
										$service_cnt = $val['service_cnt'];
										$service_unit = $service_control->_unit($val['service_unit']);
										$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
										$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
										$service_text = $service_cnt . $service_unit;
										$selected = ($service_val==$post_icon_option_date)?"selected":"";
									?>
									<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
									<?php } ?>
									</select>

									<?php if($post_icon_option_date){ ?>
									<span style="display:;" id="alba_option_icon_price_info">
										<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_icon_option_dates[4]=='0')?"무료":number_format($post_icon_option_dates[4]);?></span></strong>
										<span class="won positionR" style="display:<?php echo ($post_icon_option_dates[4]=='0')?'none':'';?>;">원
											<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_icon_option_dates[3]!='0')?'':'none';?>;">
												<span class="price"><?php echo number_format($post_icon_option_dates[2]);?></span>원
												<span class="priceDc text_orange"><?php echo number_format($post_icon_option_dates[3]);?>%</span>
											</em>
										</span>
									</span>
									<?php } else { ?>
									<span style="display:none;" id="alba_option_icon_price_info">
										<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
										<span class="won positionR">원
											<em class="positionA" style="top:-21px; right:0;">
												<span class="price">0</span>원
												<span class="priceDc text_orange">0%</span>
											</em>
										</span>
									</span>
									<?php } ?>

								</p>
								</div>	   
							</dd>
							<?php } ?>

							<?php if($alba_option_color['is_pay'] && $sel_service != 'alba_option_color'){ ?>
							<dd class="clearfix positionR">
								<p>
									<input type="checkbox" class="chk" name="alba_option_color" value="1" id="alba_option_color" onclick="option_service('color',this);" <?php echo ($post_color_option_date)?'checked':'';?>>
									<label class="pl5 text_color13" for="alba_option_color"><strong>글자색</strong></label>
									<span class="suv_num alba_option_color" id="alba_option_color_msg" style="display:<?php echo ($post_color_option_date)?'':'none';?>;">채용공고 제목을 글자색으로 강조 효과</span>
									<!-- (글자색으로 강조 효과 : <strong>+5,500</strong>원/1일) -->
								</p>

								<div style="display:<?php echo ($post_color_option_date)?'':'none';?>;" class="boxRadio bg_color2 ml10 mt10 pl10 pt5 pb5 alba_option_color"><strong>칼라선택:</strong>
								<?php 
									for($i=0;$i<$alba_option_colors_cnt;$i++){
									if($post_color_option){
										$checked = ($post_color_option==$alba_option_colors[$i])?'checked':'';
									} else {
										$checked = ($i==0) ? 'checked' : '';
									}
								?>
									<span class=""><input type="radio" name="alba_option_color_sel" id="alba_option_color_sel_<?php echo $i;?>" value="<?php echo $alba_option_colors[$i];?>" class="chk" <?php echo $checked;?> onclick="option_service('color',this);"><label for="alba_option_color_sel_<?php echo $i;?>" style="color:#<?php echo $alba_option_colors[$i];?>"> 글자색</label></span>
								<?php } ?>
								</div>
								<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
								<p class="priceSelect alba_option_color" style="display:<?php echo ($post_color_option_date)?'':'none';?>;">
									<span class="today"><strong>오늘</strong> +</span>
									<select class="ipSelect2" title="신청기간" name="alba_option_color_date" id="alba_option_color_date" onchange="option_price_print('alba_option_color',this);">
									<option value="">선택</option>
									<?php 
										foreach($alba_option_color_service as $key => $val){ 
										$service_cnt = $val['service_cnt'];
										$service_unit = $service_control->_unit($val['service_unit']);
										$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
										$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
										$service_text = $service_cnt . $service_unit;
										$selected = ($service_val==$post_color_option_date)?"selected":"";
									?>
									<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
									<?php } ?>
									</select>

									<?php if($post_color_option_date){ ?>
									<span style="display:;" id="alba_option_color_price_info">
										<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_color_option_dates[4]=='0')?"무료":number_format($post_color_option_dates[4]);?></span></strong>
										<span class="won positionR" style="display:<?php echo ($post_color_option_dates[4]=='0')?'none':'';?>;">원
											<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_color_option_dates[3]!='0')?'':'none';?>;">
												<span class="price"><?php echo number_format($post_color_option_dates[2]);?></span>원
												<span class="priceDc text_orange"><?php echo number_format($post_color_option_dates[3]);?>%</span>
											</em>
										</span>
									</span>
									<?php } else { ?>
									<span style="display:none;" id="alba_option_color_price_info">
										<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
										<span class="won positionR">원
											<em class="positionA" style="top:-21px; right:0;">
												<span class="price">0</span>원
												<span class="priceDc text_orange">0%</span>
											</em>
										</span>
									</span>
									<?php } ?>
								</p>
								</div>
							</dd>
							<?php } ?>
							
							<?php if($alba_option_blink['is_pay'] && $sel_service != 'alba_option_blink'){ ?>
							<dd class="clearfix positionR">
								<p>
									<input type="checkbox" class="chk" name="alba_option_blink" value="1" id="alba_option_blink" onclick="option_service('blink',this);" <?php echo ($post_blink_option_date)?'checked':'';?>>
									<label class="pl5 text_color13" for="alba_option_blink"><strong>반짝칼라</strong></label>
									<span class="suv_num alba_option_blink jumble" id="alba_option_blink_msg" style="display:<?php echo ($post_blink_option_date)?'':'none';?>;">채용공고 제목을 반짝컬러 강조 효과</span>
									<!-- (빤짝컬러 강조 효과 : <strong>+5,500</strong>원/1일) -->
								</p>

								<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
								<p class="priceSelect alba_option_blink" style="display:<?php echo ($post_blink_option_date)?'':'none';?>;">
									<span class="today"><strong>오늘</strong> +</span>
									<select class="ipSelect2" title="신청기간" name="alba_option_blink_date" id="alba_option_blink_date" onchange="option_price_print('alba_option_blink',this);">
									<option value="">선택</option>
									<?php 
										foreach($alba_option_blink_service as $key => $val){ 
										$service_cnt = $val['service_cnt'];
										$service_unit = $service_control->_unit($val['service_unit']);
										$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
										$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
										$service_text = $service_cnt . $service_unit;
										$selected = ($service_val==$post_blink_option_date)?"selected":"";
									?>
									<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
									<?php } ?>
									</select>

									<?php if($post_blink_option_date){ ?>
									<span style="display:;" id="alba_option_blink_price_info">
										<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_blink_option_dates[4]=='0')?"무료":number_format($post_blink_option_dates[4]);?></span></strong>
										<span class="won positionR" style="display:<?php echo ($post_blink_option_dates[4]=='0')?'none':'';?>;">원
											<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_blink_option_dates[3]!='0')?'':'none';?>;">
												<span class="price"><?php echo number_format($post_blink_option_dates[2]);?></span>원
												<span class="priceDc text_orange"><?php echo number_format($post_blink_option_dates[3]);?>%</span>
											</em>
										</span>
									</span>
									<?php } else { ?>
									<span style="display:none;" id="alba_option_blink_price_info">
										<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
										<span class="won positionR">원
											<em class="positionA" style="top:-21px; right:0;">
												<span class="price">0</span>원
												<span class="priceDc text_orange">0%</span>
											</em>
										</span>
									</span>
									<?php } ?>
								</p>
								</div>	   
							</dd>
							<?php } ?>
							</div>  
						</td>
					</tr>
					</tbody>
					</table>
				</div>
				<!-- 공통 옵션// -->
				<?php } ?>
				
				</div>
				<!-- //상품정보 및 기간별 가격 -->

			</div>
			<!-- 상품결제 // -->      
		<?php } ?>


			<!--  결제하기   --> 
			<div id="listForm" class="mainTopBorder positionR mt30 clearfix" style="display:<?php echo ($mode=='service_pay')?'':'none';?>;">

				<h3 class="pb5 h3">
					<img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="bg_color4"> <strong>신청상품</strong>
				</h3>

				<!--  신청상품   --> 
				<div class="customList1 mb10">
					<table cellspacing="0" summary="신청상품 리스트">
					<caption class="skip">신청상품 리스트</caption>
					<colgroup><col width="180px"><col width="*"><col width="150px"><col width="150px"></colgroup>
					<thead>
						<tr>
							<th scope="col">상품명</th>
							<th scope="col">기간/건수</th>
							<th scope="col">금액</th>
							<th scope="col">할인금액</th>
						</tr>
					</thead>
					<tbody id="service_list">
					<?php if($package_no) { ?>
					<tr id="package_service">
						<td class="tc"  height="50"><span><strong><?php echo stripslashes($package['wr_subject']);?></strong></span></td>
						<td class="tl"><?php echo ($package_count >= 1) ? $package_name." 외 ".($package_count-1)."건" : $package_name;?></td>
						<td class="tc"><span id="package_price_val"><?php echo number_format($package['wr_price']);?>원</span></td>
						<td class="tc"><span class="text_red"><strong id="package_total_val">\<?php echo number_format($package['wr_price']);?></strong></span></td>
					</tr>
					<?php } ?>
					<?php if($sel_service){ // 단일 서비스 일때 ?>

						<?php if($sel_service=='alba_option_jump' || $sel_service=='etc_open' || $sel_service=='etc_sms'){ ?>
						<input type="hidden" name="<?php echo $sel_service;?>_date" value="<?php echo $_POST[$sel_service."_date"];?>"/>
						<tr id="<?php echo $sel_service;?>">
							<td class="tc"  height="50"><span><strong><?php echo $title_icon;?></strong></span></td>
							<td class="tl">
								<span>
								<?php 
								if($service_date[1]=='count') {	// 건별 결제
									echo "<span class='b'>".$service_date[0].$service_control->_unit($service_date[1])."</span>";
									echo ($service_date[5]) ? " (".$service_date[5].$service_control->_unit($service_date[6])." 이후 자동 소멸)" : "";
									if($is_open_service && !$is_open_count){
										echo "<br/><Br/><span class='text_gray'>열람 서비스 기간이 <span class='b'>".$is_open_service."</span> 까지 남아있습니다<br/>결제하시면 기존 열람 서비스 기간이 초기화 됩니다.</span>";
									}
								} else {		// 기간 결제
									echo "오늘 + ".$service_date[0].$service_control->_unit($service_date[1]);
									echo "(".date('Y.m.d')."~".date('Y.m.d',strtotime("+".$service_date[0]." ".$service_date[1])).")";
									if($is_open_count){
										echo "<br/><br/><span class='text_gray'>열람 서비스가 <span class='b'>".$is_open_count."</span> 건 남아있습니다<br/>결제하시면 기존 열람 서비스 건수가 초기화 됩니다.</span>";
									}
								}
								?>
								</span>
							</td>
							<td class="tc"><span id="<?php echo $sel_service;?>_price_val"><?php echo ($service_date[2]=='0')?"무료":number_format($service_date[2])."원";?></span></td>
							<td class="tc"><span class="text_red"><strong id="<?php echo $sel_service;?>_total_val">\<?php echo number_format($service_date[4]);?></strong></span></td>
						</tr>          
						<?php } else { ?>
						<tr id="<?php echo $sel_service;?>">
							<td class="tc"  height="50"><span><strong><?php echo $title_icon;?></strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $service_date[0].$service_control->_unit($service_date[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$service_date[0]." ".$service_date[1]));?>)
								</span>
							</td>
							<td class="tc"><span id="<?php echo $sel_service;?>_price_val"><?php echo ($service_date[2]=='0')?"무료":number_format($service_date[2])."원";?></span></td>
							<td class="tc"><span class="text_red"><strong id="<?php echo $sel_service;?>_total_val">\<?php echo number_format($service_date[4]);?></strong></span></td>
						</tr>
						<?php } ?>
					
					<?php } else { // 복합 서비스 일때 ?>

						<?php if($post_main_platinum_date){ ?>
						<tr id="main_platinum">
							<td class="tc"  height="50"><span><strong>메인 플래티넘</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_main_platinum[0].$service_control->_unit($post_main_platinum[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_main_platinum[0]." ".$post_main_platinum[1]));?>)
								</span>
							</td>
							<td class="tc"><span id="main_platinum_price_val"><?php echo ($post_main_platinum[2]=='0')?"무료":number_format($post_main_platinum[2])."원";?></span></td>
							<td class="tc"><span class="text_red"><strong id="main_platinum_total_val">\<?php echo number_format($post_main_platinum[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($post_main_prime_date){ ?>
						<tr id="main_prime">
							<td class="tc"  height="50"><span><strong>메인 프라임</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_main_prime[0].$service_control->_unit($post_main_prime[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_main_prime[0]." ".$post_main_prime[1]));?>)
								</span>
							</td>
							<td class="tc"><span id="main_prime_price_val"><?php echo ($post_main_prime[2]=='0')?"무료":number_format($post_main_prime[2])."원";?></span></td>
							<td class="tc"><span class="text_red"><strong id="main_prime_total_val">\<?php echo number_format($post_main_prime[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($post_main_grand_date){ ?>
						<tr id="main_grand">
							<td class="tc"  height="50"><span><strong>메인 그랜드</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_main_grand[0].$service_control->_unit($post_main_grand[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_main_grand[0]." ".$post_main_grand[1]));?>)
								</span>
							</td>
							<td class="tc"><span id="main_grand_price_val"><?php echo ($post_main_grand[2]=='0')?"무료":number_format($post_main_grand[2])."원";?></span></td>
							<td class="tc"><span class="text_red"><strong id="main_grand_total_val">\<?php echo number_format($post_main_grand[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($post_main_banner_date){ ?>
						<tr id="main_banner">
							<td class="tc"  height="50"><span><strong>메인 배너형</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_main_banner[0].$service_control->_unit($post_main_banner[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_main_banner[0]." ".$post_main_banner[1]));?>)
								</span>
							</td>
							<td class="tc"><span id="main_banner_price_val"><?php echo ($post_main_banner[2]=='0')?"무료":number_format($post_main_banner[2])."원";?></span></td>
							<td class="tc"><span class="text_red"><strong id="main_banner_total_val">\<?php echo number_format($post_main_banner[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($post_main_list_date){ ?>
						<tr id="main_list">
							<td class="tc"  height="50"><span><strong>메인 리스트형</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_main_list[0].$service_control->_unit($post_main_list[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_main_list[0]." ".$post_main_list[1]));?>)
								</span>
							</td>
							<td class="tc"><span id="main_list_price_val"><?php echo ($post_main_list[2]=='0')?"무료":number_format($post_main_list[2])."원";?></span></td>
							<td class="tc"><span class="text_red"><strong id="main_list_total_val">\<?php echo number_format($post_main_list[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($post_main_basic_date){ ?>
						<tr id="main_basic">
							<td class="tc"  height="50"><span><strong>메인 일반리스트</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_main_basic[0].$service_control->_unit($post_main_basic[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_main_basic[0]." ".$post_main_basic[1]));?>)
								</span>
							</td>
							<td class="tc"><span id="main_basic_price_val"><?php echo ($post_main_basic[2]=='0')?"무료":number_format($post_main_basic[2])."원";?></span></td>
							<td class="tc"><span class="text_red"><strong id="main_basic_total_val">\<?php echo number_format($post_main_basic[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($post_alba_platinum_date){ ?>
						<tr id="alba_platinum">
							<td class="tc"  height="50"><span><strong>채용정보 플래티넘</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_alba_platinum[0].$service_control->_unit($post_alba_platinum[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_alba_platinum[0]." ".$post_alba_platinum[1]));?>)
								</span>
							</td>
							<td class="tc"><span id="alba_platinum_price_val"><?php echo ($post_alba_platinum[2]=='0')?"무료":number_format($post_alba_platinum[2])."원";?></span></td>
							<td class="tc"><span class="text_red"><strong id="alba_platinum_total_val">\<?php echo number_format($post_alba_platinum[4]);?></strong></span></td>
						</tr>
						<?php } ?>


						<?php if($post_alba_banner_date){ ?>
						<tr id="alba_banner">
							<td class="tc"  height="50"><span><strong>채용정보 배너형</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_alba_banner[0].$service_control->_unit($post_alba_banner[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_alba_banner[0]." ".$post_alba_banner[1]));?>)
								</span>
							</td>
							<td class="tc"><span id="alba_banner_price_val"><?php echo ($post_alba_banner[2]=='0')?"무료":number_format($post_alba_banner[2])."원";?></span></td>
							<td class="tc"><span class="text_red"><strong id="alba_banner_total_val">\<?php echo number_format($post_alba_banner[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($post_alba_list_date){ ?>
						<tr id="alba_list">
							<td class="tc"  height="50"><span><strong>채용정보 리스트형</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_alba_list[0].$service_control->_unit($post_alba_list[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_alba_list[0]." ".$post_alba_list[1]));?>)
								</span>
							</td>
							<td class="tc"><span id="alba_list_price_val"><?php echo ($post_alba_list[2]=='0')?"무료":number_format($post_alba_list[2])."원";?></span></td>
							<td class="tc"><span class="text_red"><strong id="alba_list_total_val">\<?php echo number_format($post_alba_list[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($post_alba_basic_date){ ?>
						<tr id="alba_basic">
							<td class="tc"  height="50"><span><strong>채용정보 일반리스트</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_alba_basic[0].$service_control->_unit($post_alba_basic[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_alba_basic[0]." ".$post_alba_basic[1]));?>)
								</span>
							</td>
							<td class="tc"><span id="alba_basic_price_val"><?php echo ($post_alba_basic[2]=='0')?"무료":number_format($post_alba_basic[2])."원";?></span></td>
							<td class="tc"><span class="text_red"><strong id="alba_basic_total_val">\<?php echo number_format($post_alba_basic[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($post_busy_option_date){ ?>
						<tr id="alba_option_busy">
							<td class="tc"  height="50"><span><strong>일반 리스트 급구 아이콘</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_busy_option[0].$service_control->_unit($post_busy_option[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_busy_option[0]." ".$post_busy_option[1]));?>)
								</span>
							</td>
							<td class="tc"><span id="alba_option_busy_price_val"><?php echo ($post_busy_option[2]=='0')?"무료":number_format($post_busy_option[2])."원";?></span></td>
							<td class="tc"><span class="text_red"><strong id="alba_option_busy_total_val">\<?php echo number_format($post_busy_option[4]);?></strong></span></td>
						</tr>
						<?php } ?>
						
						<?php if($post_neon_option_date){ // 형광펜 ?>
						<tr id="alba_option_neon">
							<td class="tc"  height="50"><span><strong>형광펜</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_neon_option_dates[0].$service_control->_unit($post_neon_option_dates[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_neon_option_dates[0]." ".$post_neon_option_dates[1]));?>)
								</span>
							</td>
							<td class="tc">
								<span id="alba_option_neon_price_val">
									<?php echo ($post_neon_option_dates[2]=='0')?"무료":number_format($post_neon_option_dates[2])."원";?>
									<input type="hidden" name="alba_option_neon_price" id="alba_option_neon_price" value="<?php echo $post_neon_option_date;?>"/>
								</span>
							</td>
							<td class="tc"><span class="text_red"><strong id="alba_option_neon_total_val">\<?php echo number_format($post_neon_option_dates[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($post_bold_option_date){ // 굵은글자 ?>
						<tr id="alba_option_bold">
							<td class="tc"  height="50"><span><strong>굵은글자</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_bold_option_dates[0].$service_control->_unit($post_bold_option_dates[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_bold_option_dates[0]." ".$post_bold_option_dates[1]));?>)
								</span>
							</td>
							<td class="tc">
								<span id="alba_option_bold_price_val">
									<?php echo ($post_bold_option_dates[2]=='0')?"무료":number_format($post_bold_option_dates[2])."원";?>
									<input type="hidden" name="alba_option_bold_price" id="alba_option_bold_price" value="<?php echo $post_bold_option_date;?>"/>
								</span>
							</td>
							<td class="tc"><span class="text_red"><strong id="alba_option_bold_total_val">\<?php echo number_format($post_bold_option_dates[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($post_icon_option_date){ // 아이콘 ?>
						<tr id="alba_option_icon">
							<td class="tc"  height="50"><span><strong>아이콘</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_icon_option_dates[0].$service_control->_unit($post_icon_option_dates[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_icon_option_dates[0]." ".$post_icon_option_dates[1]));?>)
								</span>
							</td>
							<td class="tc">
								<span id="alba_option_icon_price_val">
									<?php echo ($post_icon_option_dates[2]=='0')?"무료":number_format($post_icon_option_dates[2])."원";?>
									<input type="hidden" name="alba_option_icon_price" id="alba_option_icon_price" value="<?php echo $post_icon_option_date;?>"/>
								</span>
							</td>
							<td class="tc"><span class="text_red"><strong id="alba_option_icon_total_val">\<?php echo number_format($post_icon_option_dates[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($post_color_option_date){ // 글자색 ?>
						<tr id="alba_option_color">
							<td class="tc"  height="50"><span><strong>글자색</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_color_option_dates[0].$service_control->_unit($post_color_option_dates[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_color_option_dates[0]." ".$post_color_option_dates[1]));?>)
								</span>
							</td>
							<td class="tc">
								<span id="alba_option_color_price_val">
									<?php echo ($post_color_option_dates[2]=='0')?"무료":number_format($post_color_option_dates[2])."원";?>
									<input type="hidden" name="alba_option_color_price" id="alba_option_color_price" value="<?php echo $post_color_option_date;?>"/>
								</span>
							</td>
							<td class="tc"><span class="text_red"><strong id="alba_option_color_total_val">\<?php echo number_format($post_color_option_dates[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($post_blink_option_date){ // 반짝칼라 ?>
						<tr id="alba_option_blink">
							<td class="tc"  height="50"><span><strong>반짝칼라</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $post_blink_option_dates[0].$service_control->_unit($post_blink_option_dates[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_blink_option_dates[0]." ".$post_blink_option_dates[1]));?>)
								</span>
							</td>
							<td class="tc">
								<span id="alba_option_blink_price_val">
									<?php echo ($post_blink_option_dates[2]=='0')?"무료":number_format($post_blink_option_dates[2])."원";?>
									<input type="hidden" name="alba_option_blink_price" id="alba_option_blink_price" value="<?php echo $post_color_option_date;?>"/>
								</span>
							</td>
							<td class="tc"><span class="text_red"><strong id="alba_option_blink_total_val">\<?php echo number_format($post_blink_option_dates[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($alba_option_jump_date){ // 점프 서비스 ?>
						<tr id="alba_option_jump">
							<td class="tc"  height="50"><span><strong>점프 서비스</strong></span></td>
							<td class="tl">
								<span>
									오늘 +<?php echo $alba_option_jump_dates[0].$service_control->_unit($alba_option_jump_dates[1]);?> 
									(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$alba_option_jump_dates[0]." ".$alba_option_jump_dates[1]));?>)
								</span>
							</td>
							<td class="tc">
								<span id="alba_option_jump_price_val">
									<?php echo ($alba_option_jump_dates[2]=='0')?"무료":number_format($alba_option_jump_dates[2])."원";?>
									<input type="hidden" name="alba_option_jump_price" id="alba_option_jump_price" value="<?php echo $alba_option_jump_date;?>"/>
								</span>
							</td>
							<td class="tc"><span class="text_red"><strong id="alba_option_jump_total_val">\<?php echo number_format($alba_option_jump_dates[4]);?></strong></span></td>
						</tr>
						<?php } ?>
						
						<?php if($etc_open_date){ // 이력서 열람 서비스 ?>
						<tr id="etc_open">
							<td class="tc"  height="50"><span><strong>이력서 열람 서비스</strong></span></td>
							<td class="tl">
								<span>
								<?php 
								if($etc_open_dates[1]=='count') {	// 건별 결제
									echo "<span class='b'>".$etc_open_dates[0].$service_control->_unit($etc_open_dates[1])."</span>";
									echo ($etc_open_dates[5]) ? " (".$etc_open_dates[5].$service_control->_unit($etc_open_dates[6])." 이후 자동 소멸)" : "";
									if($is_open_service && !$is_open_count){
										echo "<br/><Br/><span class='text_gray'>열람 서비스 기간이 <span class='b'>".$is_open_service."</span> 까지 남아있습니다<br/>결제하시면 기존 열람 서비스 기간이 초기화 됩니다.</span>";
									}
								} else {		// 기간 결제
									echo "오늘 + ".$etc_open_dates[0].$service_control->_unit($etc_open_dates[1]);
									echo "(".date('Y.m.d')."~".date('Y.m.d',strtotime("+".$etc_open_dates[0]." ".$etc_open_dates[1])).")";
									if($is_open_count){
										echo "<br/><br/><span class='text_gray'>열람 서비스가 <span class='b'>".$is_open_count."</span> 건 남아있습니다<br/>결제하시면 기존 열람 서비스 건수가 초기화 됩니다.</span>";
									}
								}
								?>
								</span>
							</td>
							<td class="tc">
								<span id="etc_open_price_val">
									<?php echo ($etc_open_dates[2]=='0')?"무료":number_format($etc_open_dates[2])."원";?>
									<input type="hidden" name="etc_open_price" id="etc_open_price" value="<?php echo $etc_open_date;?>"/>
								</span>
							</td>
							<td class="tc"><span class="text_red"><strong id="etc_open_total_val">\<?php echo number_format($etc_open_dates[4]);?></strong></span></td>
						</tr>
						<?php } ?>

						<?php if($etc_sms_date){ // SMS 충전 서비스 ?>
						<tr id="etc_sms">
							<td class="tc"  height="50"><span><strong>SMS 충전 서비스</strong></span></td>
							<td class="tl">
								<span>
								<?php echo "<span class='b'>".number_format($etc_sms_dates[0]).$service_control->_unit($etc_sms_dates[1])."</span>"; ?>
								</span>
							</td>
							<td class="tc">
								<span id="etc_sms_price_val">
									<?php echo ($etc_sms_dates[2]=='0')?"무료":number_format($etc_sms_dates[2])."원";?>
									<input type="hidden" name="etc_sms_price" id="etc_sms_price" value="<?php echo $etc_sms_date;?>"/>
								</span>
							</td>
							<td class="tc"><span class="text_red"><strong id="etc_sms_total_val">\<?php echo number_format($etc_sms_dates[4]);?></strong></span></td>
						</tr>
						<?php } ?>

					<?php } ?>
					</tbody>
					</table>
				</div>
				<!--  신청상품 end   --> 

				<div class="total">
					<strong>최종 결제금액 : </strong>
					<span>
						<strong class="sumTot text_orange" id="sumTotal_Price"><?php echo number_format($post_total_price);?></strong>
						<strong>원</strong>
					</span> 
				</div>        
			</div>
		</div> 
		<!--  // 결제하기 -->

		<div style="display:block;"id="listForm" class="mainTopBorder positionR mt30 clearfix"> <!--결제정보// 사이버머니 연동시--> 
			<h3 class="pb5 h3">
			<img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="bg_color4"> <strong>결제정보</strong>
			</h3>
			<div class="customList1 mb30"><!--  결제정보   --> 
				<div class="companyRegistWrap">          
					<table>
					<caption><span class="skip">결제정보출력</span></caption>
					<colgroup><col width="159px"><col width="*"></colgroup>
					<tbody>
					<tr>
						<th scope="row"><label>총 신청금액</label></th>
						<td>
							<span>
								<strong class="text_orange" id="total_pay_price"><?php echo number_format($post_total_price);?></strong>원
								<input type="hidden" name="pay_price" value="<?php echo $post_total_price;?>" id="pay_price"/>
							</span>
						</td>
					</tr>
					<?php if($env['use_point'] && $member['mb_point'] > 0){ // 포인트가 있을때 ?>
					<tr>
						<th scope="row"> <label>할인내역</label></th>
						<td>
							<div class="partnameWrap positionR">
							<input type="text" style="width:200px;" class="ipText" id="pay_use_point" name="pay_use_point" value="0" style="ime-mode:disabled;" onKeyPress="return numbersonly(event, false)"> 포인트
							<em class="pr10"><a class="button" onclick="use_points();"><span>사용하기</span></a></em><span class="text_orange">(보유 포인트 : <strong><?php echo number_format($member['mb_point']);?></strong>포인트)</span>
							</div>
							<input type="hidden" name="use_point" id="use_point"/>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<th scope="row" class="bbend"> <label>최종 결제금액</label></th>
						<td class="bbend">
							<span>
								<strong class="sumTot text_orange" id="sumTotal_price"><?php echo number_format($post_total_price);?></strong>
								<strong>원</strong>
							</span>
							<input type="hidden" name="total_price" id="total_price" value="<?php echo $post_total_price;?>"/>
						</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div> 
		<!--  결제정보// end   -->

		</form>

		<?php
		switch($pg_company){
			case 'inicis':	## 이니시스
				include_once "./views/_include/inicis.php";
			break;
			case 'allthegate':	## 올더게이트
				include_once "./views/_include/allthegate.php";
			break;
			case 'kcp':	## KCP
				include_once "./views/_include/kcp.php";
			break;
		}	// pg_company switch end.
		?>


					<div style="margin:30px auto;" class="singleBtn clearfix">
						<ul> 
							<li><div class="btn font_white bg_blueBlack"><a href="javascript:pay_submit();">결제하기<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
						</ul>
					</div>        
					</div><!--  조건설정수정 end   --> 
					</div> <!--  맞춤 서비스 관리 end   --> 

				</div><!--  컨텐츠 end   --> 
			</div>
		</div>
	</div>  
</section>