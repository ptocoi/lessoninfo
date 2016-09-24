<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<style type="text/css">
/* ========================  기본컬러설정   ========================= */
#list li .icons div img{background-color:#c9c9c9;}

#photo li {border-color:#7dc2f6;}
#photo li dd.icons > div > a > img{background-color:#7dc2f6;}
#photo .name_wrap{background-color:#F5FAFF;}

#platinum dd.icons > div > a > img{background-color:#8694b7;}
#platinum  > ul > li{border-color:#8694b7;}
#platinum .text1{background-color:#f5f7fb;}
#platinum .text2{background-color:#f5f7fb;}
#platinum.number5  > ul > li .logo_tit{background-color:#f5f7fb;}

#prime dd.icons > div > a > img{background-color:#c3b39e;}
#prime  > ul > li{border-color:#c3b39e;}
#prime .text1{background-color:#fcf7c6;}
#prime .text2{background-color:#fcf7c6;}
#prime.number5  > ul > li .logo_tit{background-color:#fcf7c6;}

#grand dd.icons > div > a > img{background-color:#7dc2f6;}
#grand  > ul > li{border-color:#7dc2f6;}
#grand .text1{background-color:#f5faff;}
#grand .text2{background-color:#f5faff;}
#grand.number5  > ul > li .logo_tit{background-color:#f5faff;}

#box dd.icons > div > a > img{background-color:#c9c9c9;}
#box  > ul > li{border-color:#c9c9c9;}
#box .text1{background-color:#f7f7f7;}
#box .text2{background-color:#f7f7f7;}
/* ========================  기본컬러설정 // ========================= */

/* ========================  골드컬러설정 ========================= */
.border1 > ul > li.gold {z-index:1000;}
.border2 > ul > li.gold {z-index:1000;}

#list > ul > li.gold {background:#fcf7c6;border-color:#c3b39e;}
#list > ul > li.gold .icons div img{background-color:#fdb301;}

#photo  > ul > li.gold {border-color:#ff8f00; /*border:1px solid #afc0ff;*/}
#photo  > ul > li.gold .icons div img{background-color:#ff8f00;}
#photo  > ul > li.gold .name_wrap{background-color:#fdb301; color:#fff;}

#platinum  > ul > li.gold {border-color:#ff8f00;}
#platinum  > ul > li.gold .icons div img{background-color:#ff8f00;}
#platinum  > ul > li.gold .text1 a{color:#fff;}
#platinum  > ul > li.gold .text1,#platnium li.gold .text2{background-color:#fdb301; color:#fff;}
#platinum  > ul > li.gold .text2 .icon{background-color:#fff; font-style:normal; color:#fdb301;}
#platinum.number5  > ul > li.gold .logo_tit{background-color:#fdb301;color:#fff;}

#prime  > ul > li.gold {border-color:#ff8f00;}
#prime  > ul > li.gold .icons div img{background-color:#ff8f00;}
#prime  > ul > li.gold .text1 a{color:#fff;}
#prime  > ul > li.gold .text1,#prime li.gold .text2{background-color:#fdb301; color:#fff;}
#prime  > ul > li.gold .text2 .icon{background-color:#fff; font-style:normal; color:#fdb301;}
#prime.number5  > ul > li.gold .logo_tit{background-color:#fdb301;color:#fff;}

#grand  > ul > li.gold {border-color:#ff8f00;}
#grand  > ul > li.gold .icons div img{background-color:#ff8f00;}
#grand  > ul > li.gold .text1 a{color:#fff;}
#grand  > ul > li.gold .text1,#grand li.gold .text2{background-color:#fdb301; color:#fff;}
#grand  > ul > li.gold .text2 .icon{background-color:#fff; font-style:normal; color:#fdb301;}
#grand.number5  > ul > li.gold .logo_tit{background-color:#fdb301;color:#fff;}

#box  > ul > li.gold {border-color:#ff8f00;}
#box  > ul > li.gold .icons div img{background-color:#ff8f00;}
#box  > ul > li.gold .text1 a{color:#fff;}
#box  > ul > li.gold .text1,#box li.gold .text2{background-color:#fdb301; color:#fff;}
#box  > ul > li.gold .text2 .icon{background-color:#fff; font-style:normal; color:#fdb301;}
/* ========================  골드컬러설정 // ========================= */
</style>  

<script>
var pg_company = "<?php echo $pg_company;?>";
var sel_service = "<?php echo $sel_service;?>";
var sel_service_price = Number("<?php echo $post_total_price;?>");
var busy_icon = "<?php echo $alice['data_icon_path'].'/'.$resume_option_busy_icon['busy_icon'];?>";
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

<script type="text/javascript" src="<?php echo $alice['individual_path'];?>/skins/default/alba_resume_pay.js"></script>

<section id="content" class="content_wrap clearfix">

	<div class="content1_wrap clearfix"> 
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<?php /* navigation */ ?>
	<div class="NowLocation mt35 clearfix">
		<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <strong>결제하기</strong> </p>
	</div>
	<?php /* //navigation */ ?>
	<div class="listWrap positionR mt20">
		<h2 class="pb5"><img src="../images/tit/company_tit_10.gif" width="88" height="25" alt="결제하기"></h2>
		<!--  컨텐츠  -->
		<div class="companyContentWrap">

		<form method="post" name="ServicePayment" id="ServicePayment" onsubmit="return false;">
		<input type="hidden" name="no" value="<?php echo $no;?>"/>
		<input type="hidden" name="pay_method" id="pay_method"/>
		<input type="hidden" name="pay_type" value="alba_resume" id="pay_type"/>
		<input type="hidden" name="pay_service" value="<?php echo (is_array($pay_service))?implode('/',$pay_service):$pay_service;?>" id="pay_service"/>

		<?php if($sel_service!='resume_option_jump' && $sel_service!='etc_alba'){ ?>

			<!-- 상품결제 -->        
			<div class="feeBox">
				<!-- 상품정보 및 기간별 가격// -->
				<div id="dev_DefaultGuinOptForm" class="feeSet">
					<div class="feeinnerBox">
					<table class="feeTable" width="100%">
					<colgroup><col width="32%"><col width="43%"><col width="25%"></colgroup>
					<thead>
					<tr>
						<th><strong>상품적용</strong></th>
						<th><strong>상품내용</strong></th>
						<th><strong>상품가격</strong></th>
					</tr>
					</thead>
					<tbody>
					<?php if($package_no){ // 패키지 결제시 ?>
					<input type="hidden" name="package_no" value="<?php echo $package_no;?>" id="package_no"/>
					<input type="hidden" name="package_price" value="<?php echo $package['wr_price'];?>" id="package_price"/>
					<tr>
						<td colspan="3">
							<div style="margin-top:-2px; border-top:0;border-bottom:2px solid #404660;">
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
											$service_name = $service_control->package_service['individual'][$key];
											if($package_count==0){
												$package_name = $service_name;
											}
										?>
											<dd class="clearfix positionR" >
												<p><label class="pl5 text_color13"><strong><?php echo $service_control->package_service['individual'][$key];?></strong></label></p>

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

						</td>
					</tr>

					<?php } // 패키지 결제시?>
					<tr>
						<td class="preView pt20">
							<?php if($main_focus_date || $alba_resume_focus_date){ //if($sel_service != 'resume_option_busy' && ($sel_service != 'main_rbasic' && $sel_service != 'alba_resume_basic')){ ?>
							<!-- 포커스인재정보 -->
							<div style="display:block; width:239px; margin:0 auto;" id="photo" class="style1 border1 color1 clearfix <?php echo $sel_service;?>_gold main_focus_gold alba_resume_focus_gold">
								<ul class="is_gold">
									<li style="width:239px;">
									<dl>
										<dt>
											<a><span class="photo"><img width="49" height="63" alt="사진" src="../images/basic/bg_noPhoto.gif"></span></a> 
										</dt>
										<dd class="name_wrap">
											<span class="name">이00</span>
											<span>(男40)</span>
											<span>13년 1개월</span>
										</dd>
										<dd class="text1">
											<span class="icon"><?php echo $icon_options;?></span>
											<a <?php echo $style_options;?> <?php echo $blink_options;?>>상반기 각 부문 경력직 및</a>
										</dd>
										<dd class="text2"><span class="school" style="color:#8f8f8f">대학교(4년)졸업: 시각디자인</span></dd>
										<dd style="display:none;" class="icons">
											<div><a id="" class="star" href="#"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png"></a></div>
											<div><a id="" class="plus" href="#"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
										</dd>
									</dl>
									</li>
								</ul>                
							</div>
							<!-- 포커스인재정보// -->
							<?php } ?>

							<!-- 리스트형 -->
							<div style="display:block; width:239px; margin:0 auto;" id="nomalList" class="pt10 style1 color1 mt30 clearfix" >
								<dl class="clearfix">  
								<dt>이력서정보</dt>
								<dd>
									<div class="title">
										<span id="pre_busy_icon" style="display:none;"><?php echo $alice['data_icon_path'].'/'.$resume_option_busy['busy_icon'];?></span>
										<img src="<?php echo $alice['data_icon_path'].'/'.$resume_option_busy['busy_icon'];?>" id="busy_icon" style="display:<?php echo ($resume_option_busy_date)?'':'none';?>;"/>
										<span class="icon"><?php echo $icon_options;?></span>
										<span class="text1"><a <?php echo $style_options;?> <?php echo $blink_options;?>>정규직 원합니다.</a></span>
									</div>
									<div class="kind text_color1">제조·가공,포장·조립,품질검사·관리</div>
									<span class="career"><img width="23" height="14" src="../images/icon/icon_career.gif" alt="경력" class="vm"> 	<span>1</span>년 	<span>4</span>개월</span>
									<span class="license"><img width="36" height="14" src="../images/icon/icon_license.gif" alt="자격증" class="vmb"> 자동차운전면허</span>
								</dd>
								</dl>
							</div>
							<!-- 리스트형// -->

							<div class="guide mt10 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>				
						</td>

						<td class="service" colspan="2">

							<dl class="serviceWrap mt20 mb20 positionR">

							<?php if($sel_service){ // 단일 서비스 선택시 
							if($sel_service=='main_rbasic' || $sel_service=='alba_resume_basic'){
							?>
								<dt class="positionR content">
									<ul class="clearfix">
										<li class="priceInfo mb10">
											<span class="title pr10"><?php echo ($sel_service=='main_rbasic')?'메인':'인재정보';?> 일반리스트</span>
											<span id="<?php echo $sel_service;?>_orange_block">
											(<?php if($service_date[4]=='0'){ ?><strong class="unitPrice text_orange" id="<?php echo $sel_service;?>_orange">무료</strong><?php } else { ?><span id="<?php echo $sel_service;?>_orange"><strong class="unitPrice text_orange"><?php echo number_format($service_date[4]);?></strong>원</span><?php } ?>)
											</span>
										</li>
										<li class="loca text_color13"><strong><?php echo $title_position;?></strong></li>
										<!-- <li class="mb20">파워점프, 지역 Grand, TOP-Logo</li> -->
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
							<?php } else { ?>
								<dt class="positionR content">
									<ul class="clearfix">
										<li class="priceInfo mb10">
											<span class="title pr10"><img class="vb" src="../images/tit/tit_06.gif" alt="title"></span>
											<span id="<?php echo $sel_service;?>_orange_block">
											(<?php if($service_date[4]=='0'){ ?><strong class="unitPrice text_orange" id="<?php echo $sel_service;?>_orange">무료</strong><?php } else { ?><span id="<?php echo $sel_service;?>_orange"><strong class="unitPrice text_orange"><?php echo number_format($service_date[4]);?></strong>원</span><?php } ?>)
											</span>
										</li>
										<li class="loca text_color13"><strong><?php echo $title_position;?></strong></li>
										<!-- <li class="mb20">파워점프, 지역 Grand, TOP-Logo</li> -->
									</ul>

									<?php if($service_rows){ ?>
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
									<?php } ?>
								</dt>
							<?php } ?>

								<?php if($is_gold_service){ // 골드 서비스 ?>
									<dd class="clearfix positionR">
										<p>
											<input type="checkbox" class="chk" value="1" id="<?php echo $sel_service;?>_gold" name="<?php echo $sel_service;?>_gold" onclick="once_gold_service('<?php echo $sel_service;?>_gold',this);">
											<label class="pl5 text_color13" for="<?php echo $sel_service;?>_gold"><strong>Gold</strong><img class="vm pl5" alt="Gold" src="../images/icon/icon_gold1.gif"></label>
											<!-- <span class="suv_num <?php echo $sel_service;?>_gold" id="<?php echo $sel_service;?>_gold_msg" style="display:;">(배경색으로 강조)</span> -->
											<span class="suv_num" style="display:;">(배경색으로 강조)</span>
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

							<?php } else { // 복합 서비스 선택시 ?>

								<?php if($main_focus_date){ // 메인 포커스 인재정보 ?>
								<dt class="positionR content">
									<ul class="clearfix">
										<li class="priceInfo mb10">
											<span class="title pr10">메인 포커스</span>
											<span id="main_focus_orange_block">
											(<?php if($post_main_focus[4]=='0'){ ?><strong class="unitPrice text_orange" id="main_focus_orange">무료</strong><?php } else { ?><span id="main_focus_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_main_focus[4]);?></strong>원</span><?php } ?>)
											</span>
										</li>
										<li class="loca text_color13"><strong>메인 하단</strong></li>
									</ul>
									<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
										<p class="priceSelect">
											<span class="today"><strong>오늘</strong> +</span>
											<select class="ipSelect2" title="신청기간" name="main_focus_date" id="main_focus_date" onchange="once_service_price_print('main_focus',this);">
											<?php 
												foreach($main_focus_service as $key => $val){ 
												$service_cnt = $val['service_cnt'];
												$service_unit = $service_control->_unit($val['service_unit']);
												$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
												$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
												$service_text = $service_cnt . $service_unit;
												$selected = ($service_val==$post_main_focus_date) ? "selected" : "";
											?>
											<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
											<?php } ?>
											</select>

											<span style="display:;" id="main_focus_price_info">
												<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_main_focus[4]=='0')?"무료":number_format($post_main_focus[4]);?></span></strong>
												<span class="won positionR" style="display:<?php echo ($post_main_focus[4]=='0')?'none':'';?>;">원
													<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_main_focus[3]!='0')?'':'none';?>;">
														<span class="price"><?php echo number_format($post_main_focus[2]);?></span>원
														<span class="priceDc text_orange"><?php echo number_format($post_main_focus[3]);?>%</span>
													</em>
												</span>
											</span>
										</p>
									</div>	
								</dt>
								<?php } // $main_focus_date if end. ?> 

								<?php if($main_focus_is_gold && $main_focus_date){ // 메인 포커스 골드 서비스 ?>
									<dd class="clearfix positionR">
										<p>
											<input type="checkbox" class="chk" value="1" id="main_focus_gold" name="main_focus_gold" onclick="once_gold_service('main_focus_gold',this);">
											<label class="pl5 text_color13" for="main_focus_gold"><strong>메인 포커스 Gold</strong><img class="vm pl5" alt="Gold" src="../images/icon/icon_gold1.gif"></label>
											<span class="suv_num" style="display:;">(배경색으로 강조)</span>
										</p>
										<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
										<p class="priceSelect main_focus_gold  main_focus_gold_info" style="display:none;">
											<span class="today"><strong>오늘</strong> +</span>
											<select class="ipSelect2" title="신청기간" name="main_focus_gold_date" id="main_focus_gold_date">
											<option value="">선택</option>
											<?php 
												foreach($main_focus_gold_service as $key => $val){ 
												$service_cnt = $val['service_cnt'];
												$service_unit = $service_control->_unit($val['service_unit']);
												$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
												$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
												$service_text = $service_cnt . $service_unit;
											?>
											<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
											<?php } ?>
											</select>

											<span style="display:none;" id="main_focus_gold_price_info">
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

								<?php if($main_rbasic_date){ // 메인 일반리스트?>
								<dd class="clearfix positionR">
									<ul class="clearfix">
										<li class="priceInfo mb10">
											<span class="title pr10">메인 일반리스트</span>
											<span id="main_rbasic_orange_block">
											(<?php if($post_main_rbasic[4]=='0'){ ?><strong class="unitPrice text_orange" id="main_rbasic_orange">무료</strong><?php } else { ?><span id="main_rbasic_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_main_rbasic[4]);?></strong>원</span><?php } ?>)
											</span>
										</li>
										<li class="loca text_color13"><strong>메인 하단</strong></li>
									</ul>
									<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
										<p class="priceSelect">
											<span class="today"><strong>오늘</strong> +</span>
											<select class="ipSelect2" title="신청기간" name="main_rbasic_date" id="main_rbasic_date" onchange="once_service_price_print('main_rbasic',this);">
											<?php 
												foreach($main_rbasic_service as $key => $val){ 
												$service_cnt = $val['service_cnt'];
												$service_unit = $service_control->_unit($val['service_unit']);
												$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
												$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
												$service_text = $service_cnt . $service_unit;
												$selected = ($service_val==$post_main_rbasic_date) ? "selected" : "";
											?>
											<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
											<?php } ?>
											</select>

											<span style="display:;" id="main_rbasic_price_info">
												<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_main_rbasic[4]=='0')?"무료":number_format($post_main_rbasic[4]);?></span></strong>
												<span class="won positionR" style="display:<?php echo ($post_main_rbasic[4]=='0')?'none':'';?>;">원
													<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_main_rbasic[3]!='0')?'':'none';?>;">
														<span class="price"><?php echo number_format($post_main_rbasic[2]);?></span>원
														<span class="priceDc text_orange"><?php echo number_format($post_main_rbasic[3]);?>%</span>
													</em>
												</span>
											</span>
										</p>
									</div>
								</dd>
								<?php } ?>

								<?php if($alba_resume_focus_date){ // 정규직 포커스 인재정보 ?>
								<dt class="positionR content">
									<ul class="clearfix">
										<li class="priceInfo mb10">
											<span class="title pr10">인재정보 포커스</span>
											<span id="alba_resume_focus_orange_block">
											(<?php if($post_alba_resume_focus[4]=='0'){ ?><strong class="unitPrice text_orange" id="alba_resume_focus_orange">무료</strong><?php } else { ?><span id="alba_resume_focus_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_alba_resume_focus[4]);?></strong>원</span><?php } ?>)
											</span>
										</li>
										<li class="loca text_color13"><strong>인재정보 상단</strong></li>
									</ul>
									<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
										<p class="priceSelect">
											<span class="today"><strong>오늘</strong> +</span>
											<select class="ipSelect2" title="신청기간" name="alba_resume_focus_date" id="alba_resume_focus_date" onchange="once_service_price_print('alba_resume_focus',this);">
											<?php 
												foreach($alba_resume_focus_service as $key => $val){ 
												$service_cnt = $val['service_cnt'];
												$service_unit = $service_control->_unit($val['service_unit']);
												$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
												$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
												$service_text = $service_cnt . $service_unit;
												$selected = ($service_val==$post_alba_resume_focus_date) ? "selected" : "";
											?>
											<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
											<?php } ?>
											</select>

											<span style="display:;" id="alba_resume_focus_price_info">
												<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_alba_resume_focus[4]=='0')?"무료":number_format($post_alba_resume_focus[4]);?></span></strong>
												<span class="won positionR" style="display:<?php echo ($post_alba_resume_focus[4]=='0')?'none':'';?>;">원
													<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_alba_resume_focus[3]!='0')?'':'none';?>;">
														<span class="price"><?php echo number_format($post_alba_resume_focus[2]);?></span>원
														<span class="priceDc text_orange"><?php echo number_format($post_alba_resume_focus[3]);?>%</span>
													</em>
												</span>
											</span>
										</p>
									</div>	
								</dt>
								<?php } // $alba_resume_focus_date if end. ?>

								<?php if($alba_resume_focus_is_gold && $alba_resume_focus_date){ // 메인 포커스 골드 서비스 ?>
									<dd class="clearfix positionR">
										<p>
											<input type="checkbox" class="chk" value="1" id="alba_resume_focus_gold" name="alba_resume_focus_gold" onclick="once_gold_service('alba_resume_focus_gold',this);">
											<label class="pl5 text_color13" for="alba_resume_focus_gold"><strong>인재정보 포커스 Gold</strong><img class="vm pl5" alt="Gold" src="../images/icon/icon_gold1.gif"></label>
											<span class="suv_num" style="display:;">(배경색으로 강조)</span>
										</p>
										<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
										<p class="priceSelect alba_resume_focus_gold  alba_resume_focus_gold_info" style="display:none;">
											<span class="today"><strong>오늘</strong> +</span>
											<select class="ipSelect2" title="신청기간" name="alba_resume_focus_gold_date" id="alba_resume_focus_gold_date">
											<option value="">선택</option>
											<?php 
												foreach($alba_resume_focus_gold_service as $key => $val){ 
												$service_cnt = $val['service_cnt'];
												$service_unit = $service_control->_unit($val['service_unit']);
												$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
												$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
												$service_text = $service_cnt . $service_unit;
											?>
											<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
											<?php } ?>
											</select>

											<span style="display:none;" id="alba_resume_focus_gold_price_info">
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

								<?php if($alba_resume_basic_date){ // 서브 일반리스트?>
								<dd class="clearfix positionR">
									<ul class="clearfix">
										<li class="priceInfo mb10">
											<span class="title pr10">인재정보 일반리스트</span>
											<span id="alba_resume_basic_orange_block">
											(<?php if($post_alba_resume_basic[4]=='0'){ ?><strong class="unitPrice text_orange" id="alba_resume_basic_orange">무료</strong><?php } else { ?><span id="alba_resume_basic_orange"><strong class="unitPrice text_orange"><?php echo number_format($post_alba_resume_basic[4]);?></strong>원</span><?php } ?>)
											</span>
										</li>
										<li class="loca text_color13"><strong>인재정보 하단</strong></li>
									</ul>
									<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
										<p class="priceSelect">
											<span class="today"><strong>오늘</strong> +</span>
											<select class="ipSelect2" title="신청기간" name="alba_resume_basic_date" id="alba_resume_basic_date" onchange="once_service_price_print('alba_resume_basic',this);">
											<?php 
												foreach($alba_resume_basic_service as $key => $val){ 
												$service_cnt = $val['service_cnt'];
												$service_unit = $service_control->_unit($val['service_unit']);
												$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
												$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
												$service_text = $service_cnt . $service_unit;
												$selected = ($service_val==$post_alba_resume_basic_date) ? "selected" : "";
											?>
											<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
											<?php } ?>
											</select>

											<span style="display:;" id="alba_resume_basic_price_info">
												<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_alba_resume_basic[4]=='0')?"무료":number_format($post_alba_resume_basic[4]);?></span></strong>
												<span class="won positionR" style="display:<?php echo ($post_alba_resume_basic[4]=='0')?'none':'';?>;">원
													<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_alba_resume_basic[3]!='0')?'':'none';?>;">
														<span class="price"><?php echo number_format($post_alba_resume_basic[2]);?></span>원
														<span class="priceDc text_orange"><?php echo number_format($post_alba_resume_basic[3]);?>%</span>
													</em>
												</span>
											</span>
										</p>
									</div>
								</dd>
								<?php } ?>

							<?php } ?>


							<?php if($resume_option_busy['is_pay']){ ?>
								<dd class="clearfix positionR">
									<p>
										<input type="checkbox" class="chk" name="resume_option_busy" value="1" id="resume_option_busy" onclick="option_service('busy',this);" <?php echo ($resume_option_busy_date)?'checked':'';?>>
										<label class="pl5 text_color13" for="resume_option_busy"><strong>급구아이콘</strong></label>
										<span class="suv_num">(급구 아이콘으로 강조)</span>
									</p>
									<div class="price positionA resume_option_busy" style="margin-bottom:-10px; bottom:50%; right:3%;display:<?php echo ($resume_option_busy_date)?'':'none';?>;"><!-- 상품 기간별 가격// -->
										<p class="priceSelect">
											<span class="today"><strong>오늘</strong> +</span>
											<select class="ipSelect2" title="신청기간" name="resume_option_busy_date" id="resume_option_busy_date" onchange="once_service_price_print('resume_option_busy',this);">
											<option value="">선택</option>
											<?php 
												foreach($resume_option_busy_service as $key => $val){ 
												$service_cnt = $val['service_cnt'];
												$service_unit = $service_control->_unit($val['service_unit']);
												$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
												$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
												$service_text = $service_cnt . $service_unit;
												$selected = ($service_val==$post_busy_option_date || $service_val==$_POST['resume_option_busy_date']) ? "selected" : "";
											?>
											<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>" <?php echo $selected;?>><?php echo $service_text;?></option>
											<?php } ?>
											</select>

											<?php if($post_busy_option_date){ ?>
											<span style="display:;" id="resume_option_busy_price_info">
												<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_busy_option_dates[4]=='0')?"무료":number_format($post_busy_option_dates[4]);?></span></strong>
												<span class="won positionR" style="display:<?php echo ($post_busy_option_dates[4]=='0')?'none':'';?>;">원
													<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_busy_option_dates[3]!='0')?'':'none';?>;">
														<span class="price"><?php echo number_format($post_busy_option_dates[2]);?></span>원
														<span class="priceDc text_orange"><?php echo number_format($post_busy_option_dates[3]);?>%</span>
													</em>
												</span>
											</span>
											<?php } else { ?>
											<span style="display:none;" id="resume_option_busy_price_info">
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

							<?php if($resume_option_neon['is_pay'] && $sel_service != 'resume_option_neon'){ ?>
								<dd class="clearfix positionR">
									<p>
										<input type="checkbox" class="chk" name="resume_option_neon" value="1" id="resume_option_neon" onclick="option_service('neon',this);" <?php echo ($resume_option_neon_date)?'checked':'';?>>
										<label class="pl5 text_color13" for="resume_option_neon"><strong>형광펜</strong></label>
										<!-- <span class="suv_num resume_option_neon" id="resume_option_neon_msg" style="display:none;">형광펜 강조 효과</span> -->
										<span class="suv_num">(형광펜 강조 효과)</span>
									</p>
									<div style="display:none;" class="boxRadio bg_color2 ml10 mt10 pl10 pt5 pb5 resume_option_neon" ><strong>칼라선택:</strong>
									<?php 
										for($i=0;$i<$resume_option_neon_color_cnt;$i++){ 
										if($post_neon_option){
											$checked = ($resume_option_neon_color[$i]==$post_neon_option)?'checked':'';
										} else {
											$checked = ($i==0) ? 'checked' : '';
										}
									?>
										<span class="">
											<input type="radio" value="<?php echo $resume_option_neon_color[$i];?>" name="resume_option_neon_sel" id="resume_option_neon_<?php echo $i;?>" class="chk" <?php echo $checked;?> onclick="resume_option_neons(this);">
											<label for="resume_option_neon_<?php echo $i;?>" style="background:#<?php echo $resume_option_neon_color[$i];?>;">형광펜</label>
										</span>
									<?php } ?>
									</div>
									<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
									<p class="priceSelect resume_option_neon" style="display:<?php echo ($resume_option_neon_date)?'':'none';?>;">
										<span class="today"><strong>오늘</strong> +</span>
										<select class="ipSelect2" title="신청기간" name="resume_option_neon_date" id="resume_option_neon_date" onchange="option_price_print('resume_option_neon',this);">
										<option value="">선택</option>
										<?php 
											foreach($resume_option_neon_service as $key => $val){ 
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
										<span style="display:;" id="resume_option_neon_price_info">
											<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_neon_option_dates[4]=='0')?"무료":number_format($post_neon_option_dates[4]);?></span></strong>
											<span class="won positionR" style="display:<?php echo ($post_neon_option_dates[4]=='0')?'none':'';?>;">원
												<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_neon_option_dates[3]!='0')?'':'none';?>;">
													<span class="price"><?php echo number_format($post_neon_option_dates[2]);?></span>원
													<span class="priceDc text_orange"><?php echo number_format($post_neon_option_dates[3]);?>%</span>
												</em>
											</span>
										</span>
										<?php } else { ?>
										<span style="display:none;" id="resume_option_neon_price_info">
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

							<?php if($resume_option_bold['is_pay'] && $sel_service != 'resume_option_bold'){ ?>
								<dd class="clearfix positionR">
									<p>
										<input type="checkbox" class="chk" name="resume_option_bold" value="1" id="resume_option_bold" onclick="option_service('bold',this);" <?php echo ($post_bold_option_date)?'checked':'';?>>
										<label class="pl5 text_color13" for="resume_option_bold"><strong>굵은글자</strong></label>
										<!-- <span class="suv_num resume_option_bold" id="resume_option_bold_msg" style="display: <?php echo ($post_bold_option_date)?'':'none';?>;font-weight:bold;">굵은 글자로 강조 효과</span> -->
										<span class="suv_num">(굵은 글자로 강조 효과)</span>
									</p>
									<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
									<p class="priceSelect resume_option_bold" style="display:<?php echo ($post_bold_option_date)?'':'none';?>;">
										<span class="today"><strong>오늘</strong> +</span>
										<select class="ipSelect2" title="신청기간" name="resume_option_bold_date" id="resume_option_bold_date" onchange="option_price_print('resume_option_bold',this);">
										<option value="">선택</option>
										<?php 
											foreach($resume_option_bold_service as $key => $val){ 
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
										<span style="display:;" id="resume_option_bold_price_info">
											<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_bold_option_dates[4]=='0')?"무료":number_format($post_bold_option_dates[4]);?></span></strong>
											<span class="won positionR" style="display:<?php echo ($post_bold_option_dates[4]=='0')?'none':'';?>;">원
												<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_bold_option_dates[3]!='0')?'':'none';?>;">
													<span class="price"><?php echo number_format($post_bold_option_dates[2]);?></span>원
													<span class="priceDc text_orange"><?php echo number_format($post_bold_option_dates[3]);?>%</span>
												</em>
											</span>
										</span>
										<?php } else { ?>
										<span style="display:none;" id="resume_option_bold_price_info">
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

							<?php if($resume_option_icon['is_pay'] && $sel_service != 'resume_option_icon'){ ?>
								<dd class="clearfix positionR">
									<p>
										<input type="checkbox" class="chk" name="resume_option_icon" value="1" id="resume_option_icon" onclick="option_service('icon',this);" <?php echo ($post_icon_option_date)?'checked':'';?>>
										<label class="pl5 text_color13" for="resume_option_icon"><strong>아이콘</strong></label>
										<!-- <span class="suv_num resume_option_icon" id="resume_option_icon_msg" style="display:<?php echo ($post_icon_option_date)?'':'none';?>;">아이콘으로 강조 효과</span> -->
										<span class="suv_num" >(아이콘으로 강조 효과)</span>
									</p>
									<div style="display:<?php echo ($post_icon_option_date)?'':'none';?>;" class="boxIcon ml10 mt10  pt5 pb5 resume_option_icon">
									<?php 
										foreach($resume_option_icon_list as $key => $val){ 
										if($post_icon_option){
											$checked = ($val['no']==$post_icon_option)?'checked':'';
										} else {
											$checked = ($key==0) ? 'checked' : '';
										}
									?>
										<span class="pr15"><input type="radio" name="resume_option_icon_sel" value="<?php echo $val['no'];?>" id="resume_option_icon_<?php echo $key;?>" class="chk" <?php echo $checked;?> onclick="option_service('icon',this);">
											<label for="resume_option_icon_<?php echo $key;?>" id="resume_option_icon_<?php echo $val['no'];?>"><img src="<?php echo $alice['data_icon_path']."/".$val['name'];?>"></label>
										</span>
									<?php } ?>
									</div>
									<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
									<p class="priceSelect resume_option_icon" style="display:<?php echo ($post_icon_option_date)?'':'none';?>;">
										<span class="today"><strong>오늘</strong> +</span>
										<select class="ipSelect2" title="신청기간" name="resume_option_icon_date" id="resume_option_icon_date" onchange="option_price_print('resume_option_icon',this);">
										<option value="">선택</option>
										<?php 
											foreach($resume_option_icon_service as $key => $val){ 
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
										<span style="display:;" id="resume_option_icon_price_info">
											<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_icon_option_dates[4]=='0')?"무료":number_format($post_icon_option_dates[4]);?></span></strong>
											<span class="won positionR" style="display:<?php echo ($post_icon_option_dates[4]=='0')?'none':'';?>;">원
												<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_icon_option_dates[3]!='0')?'':'none';?>;">
													<span class="price"><?php echo number_format($post_icon_option_dates[2]);?></span>원
													<span class="priceDc text_orange"><?php echo number_format($post_icon_option_dates[3]);?>%</span>
												</em>
											</span>
										</span>
										<?php } else { ?>
										<span style="display:none;" id="resume_option_icon_price_info">
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

							<?php if($resume_option_color['is_pay'] && $sel_service != 'resume_option_color'){ ?>
								<dd class="clearfix positionR">
									<p>
										<input type="checkbox" class="chk" name="resume_option_color" value="1" id="resume_option_color" onclick="option_service('color',this);" <?php echo ($post_color_option_date)?'checked':'';?>>
										<label class="pl5 text_color13" for="resume_option_color"><strong>글자색</strong></label>
										<!-- <span class="suv_num resume_option_color" id="resume_option_color_msg" style="display:<?php echo ($post_color_option_date)?'':'none';?>;">글자색으로 강조 효과</span> -->
										<span class="suv_num">(글자색으로 강조 효과)</span>
									</p>
								<div style="display:<?php echo ($post_color_option_date)?'':'none';?>;" class="boxRadio bg_color2 ml10 mt10 pl10 pt5 pb5 resume_option_color"><strong>칼라선택:</strong>
								<?php 
									for($i=0;$i<$resume_option_colors_cnt;$i++){
									if($post_color_option){
										$checked = ($post_color_option==$resume_option_colors[$i])?'checked':'';
									} else {
										$checked = ($i==0) ? 'checked' : '';
									}
								?>
									<span class=""><input type="radio" name="resume_option_color_sel" id="resume_option_color_sel_<?php echo $i;?>" value="<?php echo $resume_option_colors[$i];?>" class="chk" <?php echo $checked;?> onclick="option_service('color',this);"><label for="resume_option_color_sel_<?php echo $i;?>" style="color:#<?php echo $resume_option_colors[$i];?>"> 글자색</label></span>
								<?php } ?>
								</div>
								<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
								<p class="priceSelect resume_option_color" style="display:<?php echo ($post_color_option_date)?'':'none';?>;">
									<span class="today"><strong>오늘</strong> +</span>
									<select class="ipSelect2" title="신청기간" name="resume_option_color_date" id="resume_option_color_date" onchange="option_price_print('resume_option_color',this);">
									<option value="">선택</option>
									<?php 
										foreach($resume_option_color_service as $key => $val){ 
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
									<span style="display:;" id="resume_option_color_price_info">
										<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_color_option_dates[4]=='0')?"무료":number_format($post_color_option_dates[4]);?></span></strong>
										<span class="won positionR" style="display:<?php echo ($post_color_option_dates[4]=='0')?'none':'';?>;">원
											<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_color_option_dates[3]!='0')?'':'none';?>;">
												<span class="price"><?php echo number_format($post_color_option_dates[2]);?></span>원
												<span class="priceDc text_orange"><?php echo number_format($post_color_option_dates[3]);?>%</span>
											</em>
										</span>
									</span>
									<?php } else { ?>
									<span style="display:none;" id="resume_option_color_price_info">
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

							<?php if($resume_option_blink['is_pay'] && $sel_service != 'resume_option_blink'){ ?>
							<dd class="clearfix positionR">
								<p>
									<input type="checkbox" class="chk" name="resume_option_blink" value="1" id="resume_option_blink" onclick="option_service('blink',this);" <?php echo ($post_blink_option_date)?'checked':'';?>>
									<label class="pl5 text_color13" for="resume_option_blink"><strong>반짝칼라</strong></label>
									<!-- <span class="suv_num resume_option_blink jumble" id="resume_option_blink_msg" style="display:<?php echo ($post_blink_option_date)?'':'none';?>;">반짝컬러 강조 효과</span> -->
									<span class="suv_num">(반짝컬러 강조 효과)</span>
								</p>

								<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
								<p class="priceSelect resume_option_blink" style="display:<?php echo ($post_blink_option_date)?'':'none';?>;">
									<span class="today"><strong>오늘</strong> +</span>
									<select class="ipSelect2" title="신청기간" name="resume_option_blink_date" id="resume_option_blink_date" onchange="option_price_print('resume_option_blink',this);">
									<option value="">선택</option>
									<?php 
										foreach($resume_option_blink_service as $key => $val){ 
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
									<span style="display:;" id="resume_option_blink_price_info">
										<span>=</span> <strong class="pay pl5"><span class="text_orange"><?php echo ($post_blink_option_dates[4]=='0')?"무료":number_format($post_blink_option_dates[4]);?></span></strong>
										<span class="won positionR" style="display:<?php echo ($post_blink_option_dates[4]=='0')?'none':'';?>;">원
											<em class="positionA" style="top:-21px; right:0;display:<?php echo ($post_blink_option_dates[3]!='0')?'':'none';?>;">
												<span class="price"><?php echo number_format($post_blink_option_dates[2]);?></span>원
												<span class="priceDc text_orange"><?php echo number_format($post_blink_option_dates[3]);?>%</span>
											</em>
										</span>
									</span>
									<?php } else { ?>
									<span style="display:none;" id="resume_option_blink_price_info">
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

							</dl>  
						</td>

					</tr>
					</tbody>
					</table>
					</div>
				</div>
				<!-- //상품정보 및 기간별 가격 -->

				<?php } // if($sel_service!='resume_option_jump') end. ?>


				</div>

				<!-- 상품결제 // -->      

					<div id="listForm" class="mainTopBorder positionR mt30 clearfix"><!--  결제하기   --> 
						<h3 class="pb5 h3"><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="bg_color4"> <strong>신청상품</strong></h3>
						<div class="customList1 mb30"><!--  신청상품   --> 
						<table cellspacing="0" summary="신청상품 리스트">
						<caption class="skip">오늘의 인재</caption>
						<colgroup><col width="150px"><col width="*"><col width="150px"><col width="150px"></colgroup>
						<thead>
						<tr>
							<th scope="col">상품명</th>
							<th scope="col">기간/건수</th>
							<th scope="col">단가</th>
							<th scope="col">소계</th>
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

							<?php if($sel_service!='etc_alba' && $sel_service!='etc_sms'){ ?>
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

							<?php if($post_resume_busy_option_date){ ?>
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

							<?php if($sel_service=='resume_option_jump'){ ?>
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
							<?php } else { ?>
							<!-- <tr id="<?php echo $sel_service;?>">
								<td class="tc"  height="50"><span><strong><?php echo $title_icon;?></strong></span></td>
								<td class="tl">
									<span>
										오늘 +<?php echo $service_date[0].$service_control->_unit($service_date[1]);?> 
										(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$service_date[0]." ".$service_date[1]));?>)
									</span>
								</td>
								<td class="tc"><span id="<?php echo $sel_service;?>_price_val"><?php echo ($service_date[2]=='0')?"무료":number_format($service_date[2])."원";?></span></td>
								<td class="tc"><span class="text_red"><strong id="<?php echo $sel_service;?>_total_val">\<?php echo number_format($service_date[4]);?></strong></span></td>
							</tr> -->
							<?php } ?>

							<?php if($sel_service=='etc_alba'){ // 채용공고 열람권 ?>
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
									<input type="hidden" name="etc_alba_price" id="etc_alba_price" value="<?php echo $etc_alba_date;?>"/>
								</td>
								<td class="tc"><span id="<?php echo $sel_service;?>_price_val"><?php echo ($service_date[2]=='0')?"무료":number_format($service_date[2])."원";?></span></td>
								<td class="tc"><span class="text_red"><strong id="<?php echo $sel_service;?>_total_val">\<?php echo number_format($service_date[4]);?></strong></span></td>
							</tr>          
							<?php } ?>

							<?php if($sel_service=='etc_sms'){ // SMS 충전 ?>
							<tr id="<?php echo $sel_service;?>">
								<td class="tc"  height="50"><span><strong><?php echo $title_icon;?></strong></span></td>
								<td class="tl">
									<span><?php echo "<span class='b'>".number_format($service_date[0]).$service_control->_unit($service_date[1])."</span>";?></span>
									<input type="hidden" name="etc_sms_price" id="etc_sms_price" value="<?php echo $etc_sms_date;?>"/>
								</td>
								<td class="tc"><span id="<?php echo $sel_service;?>_price_val"><?php echo ($service_date[2]=='0')?"무료":number_format($service_date[2])."원";?></span></td>
								<td class="tc"><span class="text_red"><strong id="<?php echo $sel_service;?>_total_val">\<?php echo number_format($service_date[4]);?></strong></span></td>
							</tr>          
							<?php } ?>

						<?php } else { // 복합 서비스 일때 ?>

							<?php if($post_main_focus_date){ ?>
							<tr id="main_focus">
								<td class="tc"  height="50"><span><strong>메인 포커스</strong></span></td>
								<td class="tl">
									<span>
										오늘 +<?php echo $post_main_focus[0].$service_control->_unit($post_main_focus[1]);?> 
										(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_main_focus[0]." ".$post_main_focus[1]));?>)
									</span>
								</td>
								<td class="tc"><span id="main_focus_price_val"><?php echo ($post_main_focus[2]=='0')?"무료":number_format($post_main_focus[2])."원";?></span></td>
								<td class="tc"><span class="text_red"><strong id="main_focus_total_val">\<?php echo number_format($post_main_focus[4]);?></strong></span></td>
							</tr>
							<?php } ?>

							<?php if($post_main_rbasic_date){ ?>
							<tr id="main_rbasic">
								<td class="tc"  height="50"><span><strong>메인 일반리스트</strong></span></td>
								<td class="tl">
									<span>
										오늘 +<?php echo $post_main_rbasic[0].$service_control->_unit($post_main_rbasic[1]);?> 
										(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_main_rbasic[0]." ".$post_main_rbasic[1]));?>)
									</span>
								</td>
								<td class="tc"><span id="main_rbasic_price_val"><?php echo ($post_main_rbasic[2]=='0')?"무료":number_format($post_main_rbasic[2])."원";?></span></td>
								<td class="tc"><span class="text_red"><strong id="main_rbasic_total_val">\<?php echo number_format($post_main_rbasic[4]);?></strong></span></td>
							</tr>
							<?php } ?>

							<?php if($post_alba_resume_focus_date){ ?>
							<tr id="alba_resume_focus">
								<td class="tc"  height="50"><span><strong>인재정보 포커스</strong></span></td>
								<td class="tl">
									<span>
										오늘 +<?php echo $post_alba_resume_focus[0].$service_control->_unit($post_alba_resume_focus[1]);?> 
										(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_alba_resume_focus[0]." ".$post_alba_resume_focus[1]));?>)
									</span>
								</td>
								<td class="tc"><span id="alba_resume_focus_price_val"><?php echo ($post_alba_resume_focus[2]=='0')?"무료":number_format($post_alba_resume_focus[2])."원";?></span></td>
								<td class="tc"><span class="text_red"><strong id="alba_resume_focus_total_val">\<?php echo number_format($post_alba_resume_focus[4]);?></strong></span></td>
							</tr>
							<?php } ?>

							<?php if($post_alba_resume_basic_date){ ?>
							<tr id="alba_resume_basic">
								<td class="tc"  height="50"><span><strong>인재정보 일반리스트</strong></span></td>
								<td class="tl">
									<span>
										오늘 +<?php echo $post_alba_resume_basic[0].$service_control->_unit($post_alba_resume_basic[1]);?> 
										(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_alba_resume_basic[0]." ".$post_alba_resume_basic[1]));?>)
									</span>
								</td>
								<td class="tc"><span id="alba_resume_basic_price_val"><?php echo ($post_alba_resume_basic[2]=='0')?"무료":number_format($post_alba_resume_basic[2])."원";?></span></td>
								<td class="tc"><span class="text_red"><strong id="alba_resume_basic_total_val">\<?php echo number_format($post_alba_resume_basic[4]);?></strong></span></td>
							</tr>
							<?php } ?>

							<?php if($post_busy_option_date){?>
								<tr id="busy_option">
									<td class="tc"  height="50"><span><strong>급구아이콘</strong></span></td>
									<td class="tl">
										<span>
											오늘 +<?php echo $post_busy_option_dates[0].$service_control->_unit($post_busy_option_dates[1]);?> 
											(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_busy_option_dates[0]." ".$post_busy_option_dates[1]));?>)
										</span>
									</td>
									<td class="tc"><span id="busy_option_price_val"><?php echo ($post_busy_option_dates[2]=='0')?"무료":number_format($post_busy_option_dates[2])."원";?></span></td>
									<td class="tc"><span class="text_red"><strong id="busy_option_total_val">\<?php echo number_format($post_busy_option_dates[4]);?></strong></span></td>
								</tr>
							<?php } ?>

							<?php if($post_neon_option_date){ ?>
							<tr id="resume_option_neon">
								<td class="tc"  height="50"><span><strong>형광펜</strong></span></td>
								<td class="tl">
									<span>
										오늘 +<?php echo $post_neon_option_dates[0].$service_control->_unit($post_neon_option_dates[1]);?> 
										(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_neon_option_dates[0]." ".$post_neon_option_dates[1]));?>)
									</span>
								</td>
								<td class="tc"><span id="resume_option_neon_price_val"><?php echo ($post_neon_option_dates[2]=='0')?"무료":number_format($post_neon_option_dates[2])."원";?></span></td>
								<td class="tc"><span class="text_red"><strong id="resume_option_neon_total_val">\<?php echo number_format($post_neon_option_dates[4]);?></strong></span></td>
							</tr>
							<?php } ?>

							<?php if($post_bold_option_date){ ?>
							<tr id="resume_option_bold">
								<td class="tc"  height="50"><span><strong>굵은글자</strong></span></td>
								<td class="tl">
									<span>
										오늘 +<?php echo $post_bold_option_dates[0].$service_control->_unit($post_bold_option_dates[1]);?> 
										(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_bold_option_dates[0]." ".$post_bold_option_dates[1]));?>)
									</span>
								</td>
								<td class="tc"><span id="resume_option_bold_price_val"><?php echo ($post_bold_option_dates[2]=='0')?"무료":number_format($post_bold_option_dates[2])."원";?></span></td>
								<td class="tc"><span class="text_red"><strong id="resume_option_bold_total_val">\<?php echo number_format($post_bold_option_dates[4]);?></strong></span></td>
							</tr>
							<?php } ?>

							<?php if($post_icon_option_date){ ?>
							<tr id="resume_option_icon">
								<td class="tc"  height="50"><span><strong>아이콘</strong></span></td>
								<td class="tl">
									<span>
										오늘 +<?php echo $post_icon_option_dates[0].$service_control->_unit($post_icon_option_dates[1]);?> 
										(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_icon_option_dates[0]." ".$post_icon_option_dates[1]));?>)
									</span>
								</td>
								<td class="tc"><span id="resume_option_icon_price_val"><?php echo ($post_icon_option_dates[2]=='0')?"무료":number_format($post_icon_option_dates[2])."원";?></span></td>
								<td class="tc"><span class="text_red"><strong id="resume_option_icon_total_val">\<?php echo number_format($post_icon_option_dates[4]);?></strong></span></td>
							</tr>
							<?php } ?>

							<?php if($post_color_option_date){ ?>
							<tr id="resume_option_color">
								<td class="tc"  height="50"><span><strong>글자색</strong></span></td>
								<td class="tl">
									<span>
										오늘 +<?php echo $post_color_option_dates[0].$service_control->_unit($post_color_option_dates[1]);?> 
										(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_color_option_dates[0]." ".$post_color_option_dates[1]));?>)
									</span>
								</td>
								<td class="tc"><span id="resume_option_color_price_val"><?php echo ($post_color_option_dates[2]=='0')?"무료":number_format($post_color_option_dates[2])."원";?></span></td>
								<td class="tc"><span class="text_red"><strong id="resume_option_color_total_val">\<?php echo number_format($post_color_option_dates[4]);?></strong></span></td>
							</tr>
							<?php } ?>

							<?php if($post_blink_option_date){ ?>
							<tr id="resume_option_blink">
								<td class="tc"  height="50"><span><strong>반짝칼라</strong></span></td>
								<td class="tl">
									<span>
										오늘 +<?php echo $post_blink_option_dates[0].$service_control->_unit($post_blink_option_dates[1]);?> 
										(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$post_blink_option_dates[0]." ".$post_blink_option_dates[1]));?>)
									</span>
								</td>
								<td class="tc"><span id="resume_option_blink_price_val"><?php echo ($post_blink_option_dates[2]=='0')?"무료":number_format($post_blink_option_dates[2])."원";?></span></td>
								<td class="tc"><span class="text_red"><strong id="resume_option_blink_total_val">\<?php echo number_format($post_blink_option_dates[4]);?></strong></span></td>
							</tr>
							<?php } ?>

							<?php if($resume_option_jump_date){ // 점프 서비스 ?>
							<tr id="resume_option_jump">
								<td class="tc"  height="50"><span><strong>점프 서비스</strong></span></td>
								<td class="tl">
									<span>
										오늘 +<?php echo $resume_option_jump_dates[0].$service_control->_unit($resume_option_jump_dates[1]);?> 
										(<?php echo date('Y.m.d');?>~<?php echo date('Y.m.d',strtotime("+".$resume_option_jump_dates[0]." ".$resume_option_jump_dates[1]));?>)
									</span>
								</td>
								<td class="tc">
									<span id="resume_option_jump_price_val">
										<?php echo ($resume_option_jump_dates[2]=='0')?"무료":number_format($resume_option_jump_dates[2])."원";?>
										<input type="hidden" name="resume_option_jump_price" id="resume_option_jump_price" value="<?php echo $resume_option_jump_date;?>"/>
									</span>
								</td>
								<td class="tc"><span class="text_red"><strong id="resume_option_jump_total_val">\<?php echo number_format($resume_option_jump_dates[4]);?></strong></span></td>
							</tr>
							<?php } ?>
							
							<?php if($etc_alba_date){	// 이력서 열람 서비스?>
							<tr id="etc_alba">
								<td class="tc"  height="50"><span><strong>채용공고 열람</strong></span></td>
								<td class="tl">
									<span><?php echo "<span class='b'>".number_format($etc_alba_dates[0]).$service_control->_unit($etc_alba_dates[1])."</span>"; ?></span>
								</td>
								<td class="tc">
									<span id="etc_alba_price_val">
										<?php echo ($etc_alba_dates[2]=='0')?"무료":number_format($etc_alba_dates[2])."원";?>
										<input type="hidden" name="etc_alba_price" id="etc_alba_price" value="<?php echo $etc_alba_date;?>"/>
									</span>
								</td>
								<td class="tc"><span class="text_red"><strong id="etc_alba_total_val">\<?php echo number_format($etc_alba_dates[4]);?></strong></span></td>
							</tr>
							<?php } ?>

							<?php if($etc_sms_date){ // SMS 충전 서비스 ?>
							<tr id="etc_sms">
								<td class="tc"  height="50"><span><strong>SMS 충전 서비스</strong></span></td>
								<td class="tl">
									<span><?php echo "<span class='b'>".number_format($etc_sms_dates[0]).$service_control->_unit($etc_sms_dates[1])."</span>"; ?></span>
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
						</div><!--  신청상품 end   --> 

						<div class="total">
							<strong>최종 결제금액 : </strong>
							<span>
								<strong class="sumTot text_orange" id="sumTotal_Price"><?php echo number_format($post_total_price);?></strong>
								<strong>원</strong>
							</span> 
						</div>

					</div>
				</div> <!--  유료이용내역 end   -->        

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
					case 'kcp':	 ## KCP
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