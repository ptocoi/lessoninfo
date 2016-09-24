<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var cycle_direction = "<?php echo $alba_option_logo_effects[1];?>";
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

		<form method="post" name="ServicePayment" action="<?php echo $_SERVER['PHP_SELF'];?>" id="ServicePayment">
			<!-- 상품결제 -->
			<div class="feeBox">
				<!-- 상품정보 및 기간별 가격// -->
				<div id="dev_DefaultGuinOptForm" class="feeSet">
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

<div class="feeinnerBox"><!-- 리스트형 -->
<table class="feeTable" width="100%">
<colgroup><col width="32%"><col width="43%"><col width="25%"></colgroup>
<tbody>
<tr>
	<td class="preView pt20">

		<div style="display:block;" id="list" class="style1  color1 mt30 clearfix" >
			<ul class="clearfix">  
			<li class="bth">
				<span style="color:#8f8f8f" class="add">서울 구로구</span>
				<a><span class="logo_tit">㈜이마트</span></a> 
				<span class="text1"><img class="vm pr5" alt="HOT" src="../images/icon/icon_hot.gif"><a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집</a></span>
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

		<dl class="serviceWrap mt20 mb20 positionR">
			<dt class="positionR content" style="border-bottom:1px solid #ddd;">
				<ul class="clearfix">
					<li class="priceInfo mb10">
					<span class="title pr10"><?php echo $title_icon;?><!-- <img class="vb" src="../images/tit/tit_05.gif" alt="title"> --></span>
					(<?php if($service_date[4]=='0'){ ?><strong class="unitPrice text_orange">무료</strong><?php } else { ?><strong class="unitPrice text_orange"><?php echo number_format($service_date[4]);?></strong>원<?php } ?>/<?php echo $service_date[0];?><?php echo $service_control->_unit($service_date[1]);?>)
					<!-- <li class="mb20">파워점프, 지역 Grand, TOP-Logo</li> -->
					<li class="loca text_color13"><strong><?php echo (stristr($sel_service,'main'))?"메인":"채용정보";?> 하단 리스트</strong></li>
				</ul>
				<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
				<p class="priceSelect">
					<span class="today"><strong>오늘</strong> +</span>
					<select class="ipSelect2" title="신청기간" name="<?php echo $sel_service;?>_date" id="<?php echo $sel_service;?>_date" onchange="once_service_price_print('<?php echo $sel_service;?>',this);">
					<option value="">선택</option>
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
						<span>=</span> 
						<strong class="pay pl5"><span class="text_orange"><?php echo ($service_date[4]=='0')?"무료":number_format($service_date[4]);?></span></strong>
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
</tr>
</tbody>
</table>
</div><!-- 리스트형// -->



				<?php if($sel_service && (stristr($sel_service,'option')) ){ // 단일 / 옵션만 선택시 ?>
				<!-- 옵션만 선택시 -->
				<div class="feeinnerBox">
					<table class="feeTable" width="100%">
					<colgroup><col width="32%"><col width="43%"><col width="25%"></colgroup>
					<tbody>
						<tr>
						<td class="preView pt20">
							<div style="display:none;" id="" class="style1 border1 number4 color1  clearfix">
							<ul>
								<li class="bth">
								<dl>
									<dt>
										<a>
										<span class="logo"><img width="106" height="42" src="../images/basic/img_aniLogo1.gif" alt="㈜logo"></span>
										<span class="logo_tit">㈜회사명</span>
										</a> 
									</dt>
									<dd class="text1">
										<a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
									</dd>
									<dd class="text2">
										<span style="color:#8f8f8f">서울 구로구</span>
										<span><em class="icon">월</em><em class="number">5,000,000</em>원</span></dd>
									</dd>
								</dl>
								</li>
							</ul>
							</div>
							<div class="style1  color1 mt30 clearfix" id="nomalList" style="display:block; width:239px; margin:0 auto;">
							<dl class="clearfix">  
								<dt>채용제목</dt>
								<dd>
									<div class="title"><img class="vm pr5" alt="HOT" src="../images/icon/icon_hot.gif"><a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a></div>
								</dd>
							</dl>
							</div>
							<div class="guide mt10 pb20 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>
						</td>
						<td class="service" colspan="2">
							<dl class="serviceWrap mt20 mb20 positionR">
							<dt class="positionR content" style="border-bottom:1px solid #ddd;">
								<ul class="clearfix">
									<li class="priceInfo mb10"><strong class="unitPrice text_orange">88,000</strong>원/1일</li>
								</ul>
								<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
									<p class="priceSelect">
										<span class="today"><strong>오늘</strong> +</span>
										<select id="idPubDay_8" name="j_publishday_8" title="신청기간" class="ipSelect2">
											<option value="0">선택</option>
											<option value="2">2일</option>
											<option value="3">3일</option>
											<option value="4">4일</option>
											<option value="5">5일</option>
											<option value="6">6일</option>
											<option value="7">7일</option>
											<option value="15">15일</option>
											<option value="30">30일</option>
										</select>
										<span>=</span> <strong class="pay pl5"><span class="text_orange">77,000</span></strong><span class="won positionR">원
										<em style="top:-21px; right:0;" class="positionA pl5">20일 <span class="priceDc text_orange">50%</span></em></span>
									</p>
								</div>	
							</dt>
							</dl>  
						</td>
						</tr>
					</tbody>
					</table>
				</div>
				<!-- 옵션만 선택시 //-->
				<?php } ?>

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

							<?php if($alba_option_neon['is_pay']){ ?>
							<dd class="clearfix positionR" >
								<p>
									<input type="checkbox" class="chk" name="alba_option_neon" value="1" id="alba_option_neon" onclick="option_service('neon',this);">
									<label class="pl5 text_color13" for="alba_option_neon"><strong>형광펜</strong></label>
									<span class="suv_num alba_option_neon" id="alba_option_neon_msg" style="display:none;">형광펜 강조 효과</span>
									<!-- (형광펜 강조 효과 : <strong>+5,500</strong>원/1일) -->
								</p>

								<div style="display:none;" class="boxRadio bg_color2 ml10 mt10 pl10 pt5 pb5 alba_option_neon" ><strong>칼라선택:</strong>
								<?php for($i=0;$i<$alba_option_neon_color_cnt;$i++){ ?>
									<span class="">
										<input type="radio" value="<?php echo $alba_option_neon_color[$i];?>" name="alba_option_neon_sel" id="alba_option_neon_<?php echo $i;?>" class="chk" <?php echo ($i==0)?'checked':'';?>>
										<label for="alba_option_neon_<?php echo $i;?>" style="background:#<?php echo $alba_option_neon_color[$i];?>;">형광펜</label>
									</span>
								<?php } ?>
								</div>

								<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;">
								<p class="priceSelect alba_option_neon" style="display:none;">
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
									?>
									<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
									<?php } ?>
									</select>

									<span style="display:none;" id="alba_option_neon_price_info">
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

							<?php if($alba_option_bold['is_pay']){ ?>
							<dd class="clearfix positionR">
								<p>
									<input type="checkbox" class="chk" name="alba_option_bold" value="1" id="alba_option_bold" onclick="option_service('bold',this);">
									<label class="pl5 text_color13" for="alba_option_bold"><strong>굵은글자</strong></label>
									<span class="suv_num alba_option_bold" id="alba_option_bold_msg" style="display:none;">굵은 글자로 강조 효과</span>
									<!-- (굵은 글자로 강조 효과 : <strong>+5,500</strong>원/1일) -->
								</p>

								<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
								<p class="priceSelect alba_option_bold" style="display:none;">
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
									?>
									<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
									<?php } ?>
									</select>

									<span style="display:none;" id="alba_option_bold_price_info">
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

							<?php if($alba_option_icon['is_pay']){ ?>
							<dd class="clearfix positionR">
								<p>
									<input type="checkbox" class="chk" name="alba_option_icon" value="1" id="alba_option_icon" onclick="option_service('icon',this);">
									<label class="pl5 text_color13" for="alba_option_icon"><strong>아이콘</strong></label>
									<span class="suv_num alba_option_icon" id="alba_option_icon_msg" style="display:none;">아이콘으로 강조 효과</span>
									<!-- (아이콘으로 강조 효과 : <strong>+5,500</strong>원/1일) -->
								</p>

								<div style="display:none;" class="boxIcon ml10 mt10  pt5 pb5 alba_option_icon">
								<?php foreach($alba_option_icon_list as $key => $val){ ?>
									<span class="pr15"><input type="radio" name="alba_option_icon_sel" value="<?php echo $val['no'];?>" id="alba_option_icon_<?php echo $key;?>" class="chk" <?php echo ($key==0)?'checked':'';?> onclick="option_service('icon',this);">
										<label for="alba_option_icon_<?php echo $key;?>" ><img src="<?php echo $alice['data_icon_path']."/".$val['name'];?>"></label>
									</span>
								<?php } ?>
								</div>
								<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
								<p class="priceSelect alba_option_icon" style="display:none;">
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
									?>
									<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
									<?php } ?>
									</select>

									<span style="display:none;" id="alba_option_icon_price_info">
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

							<?php if($alba_option_color['is_pay']){ ?>
							<dd class="clearfix positionR">
								<p>
									<input type="checkbox" class="chk" name="alba_option_color" value="1" id="alba_option_color" onclick="option_service('color',this);">
									<label class="pl5 text_color13" for="alba_option_color"><strong>글자색</strong></label>
									<span class="suv_num alba_option_color" id="alba_option_color_msg" style="display:none;">글자색으로 강조 효과</span>
									<!-- (글자색으로 강조 효과 : <strong>+5,500</strong>원/1일) -->
								</p>

								<div style="display:none;" class="boxRadio bg_color2 ml10 mt10 pl10 pt5 pb5 alba_option_color"><strong>칼라선택:</strong>
								<?php for($i=0;$i<$alba_option_colors_cnt;$i++){?>
									<span class=""><input type="radio" name="alba_option_color_sel" id="alba_option_color_sel_<?php echo $i;?>" value="<?php echo $alba_option_colors[$i];?>" class="chk" <?php echo ($i==0)?'checked':'';?> onclick="option_service('color',this);"><label for="alba_option_color_sel_<?php echo $i;?>" style="color:#<?php echo $alba_option_colors[$i];?>"> 글자색</label></span>
								<?php } ?>
								</div>                       
								<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
								<p class="priceSelect alba_option_color" style="display:none;">
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
									?>
									<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
									<?php } ?>
									</select>

									<span style="display:none;" id="alba_option_color_price_info">
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
							
							<?php if($alba_option_blink['is_pay']){ ?>
							<dd class="clearfix positionR">
								<p>
									<input type="checkbox" class="chk" name="alba_option_blink" value="1" id="alba_option_blink" onclick="option_service('blink',this);">
									<label class="pl5 text_color13" for="alba_option_blink"><strong>반짝칼라</strong></label>
									<span class="suv_num alba_option_blink" id="alba_option_blink_msg" style="display:none;">빤짝컬러 강조 효과</span>
									<!-- (빤짝컬러 강조 효과 : <strong>+5,500</strong>원/1일) -->
								</p>

								<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
								<p class="priceSelect alba_option_blink" style="display:none;">
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
									?>
									<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
									<?php } ?>
									</select>

									<span style="display:none;" id="alba_option_blink_price_info">
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
							</div>  
						</td>
					</tr>
					</tbody>
					</table>
				</div>
				<!-- 공통 옵션// -->
					
					
					<?php /* ?>
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
						<tr>
							<td class="preView pt20">
								<!-- 플래티넘 -->
								<div style="display:block;" id="" class="style1 border1 number4 color1  clearfix">
									<ul>
										<li class="bth">
											<dl>
												<dt>
													<a>
													<span class="logo"><img width="106" height="42" src="../images/basic/img_aniLogo1.gif" alt="㈜logo"></span>
													<span class="logo_tit">㈜회사명</span>
													</a> 
												</dt>
												<dd class="text1"><a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a></dd>
												<dd class="text2">
													<span style="color:#8f8f8f">서울 구로구</span>
													<span><em class="icon">월</em><em class="number">5,000,000</em>원</span></dd>
												</dd>
											</dl>
										</li>
									</ul>
								</div>
								<!-- // 플래티넘 -->
								<!-- 배너형 -->
								<div style="display:none;" id="box" class="style1 border1  color1 mt30 clearfix">
									<ul>  
										<li class="bth">
											<dl>
												<dt><a><span class="logo_tit">㈜회사명</span></a> </dt>
												<dd class="text1"><a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a></dd>
												<dd class="text2 clearfix">
													<span class="pay"><em class="icon">월</em> <em class="number">5,000,000</em>원</span>
													<span style="color:#8f8f8f" class="add">서울 구로구</span>
												</dd> 
											</dl>
										</li>
									</ul>
								</div>
								<!-- // 배너형 -->

								<!-- 리스트형 -->
								<div style="display:block;" id="list" class="style1  color1 mt30 clearfix" >
									<ul class="clearfix">  
										<li class="bth">
											<span style="color:#8f8f8f" class="add">서울 구로구</span>
											<a><span class="logo_tit">㈜이마트</span></a> 
											<span class="text1"><img class="vm pr5" alt="HOT" src="../images/icon/icon_hot.gif"><a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집</a></span>
										</li>
										<li class="bth">
											<span style="color:#8f8f8f" class="add">서울 구로구</span>
											<a><span class="logo_tit">㈜이마트</span></a> 
											<span class="text1"><span></span><a>함께할 성실한 인재모집</a></span>
										</li>
									</ul>
								</div> 
								<!-- nomal 리스트형 -->
								<div style="display:block; width:239px; margin:0 auto;" id="nomalList" class="style1  color1 mt30 clearfix" >
									<dl class="clearfix">  
										<dt>채용제목</dt>
										<dd>
											<div class="title"><img src="../images/icon/icon_hot.gif" alt="HOT" class="vm pr5"><a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a></div>
										</dd>
									</dl>
								</div> 
								<!-- // nomal 리스트형 -->

								<!-- // 리스트형 -->
								<div class="guide mt10 text_color1">강조옵션을 선택하시면 상품에 적용되어<br>미리 확인하실 수 있습니다</div>
							</td>

							<td class="service" colspan="2">
								<dl class="serviceWrap mt20 mb20 positionR">
									<dt class="positionR content">
										<ul class="clearfix">
											<li class="priceInfo mb10"><span class="title pr10"><img class="vb" src="../images/tit/tit_01.gif" alt="title"></span>(<strong class="unitPrice text_orange">88,000</strong>원/1일)</li>
											<li class="loca text_color13"><strong>메인 최상단</strong></li>
											<li class="mb20">파워점프, 지역 Grand, TOP-Logo</li>
										</ul>
										<div class="price positionA" style="margin-bottom:-10px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
											<p class="priceSelect">
												<span class="today"><strong>오늘</strong> +</span>
												<select id="idPubDay_8" name="j_publishday_8" title="신청기간" class="ipSelect2">
												<option value="0">선택</option>
												<option value="2">2일</option>
												<option value="3">3일</option>
												<option value="4">4일</option>
												<option value="5">5일</option>
												<option value="6">6일</option>
												<option value="7">7일</option>
												<option value="15">15일</option>
												<option value="30">30일</option>
												</select>
												<span>=</span> <strong class="pay pl5"><span class="text_orange">77,000</span></strong><span class="won positionR">원
												<em style="top:-21px; right:0;" class="positionA pl5">20일 <span class="priceDc text_orange">50%</span></em></span>
											</p>
										</div>	
									</dt>
									<div class="pointTit bg_color2 border_color pl10"><strong class="pr10">강조옵션</strong>강조옵션을 선택하시면 상품에 적용되어 미리 확인하실 수 있습니다.</div>
									<dd class="clearfix positionR">
										<p><input type="checkbox" class="chk"  value="2" id="Platinum_Type" name="Platinum_Type"><label class="pl5 text_color13" for="Platinum_Type"><strong>Gold</strong><img class="vm pl5" alt="Gold" src="../images/icon/icon_gold1.gif"></label>
										<span class="suv_num">(배경색으로 강조 : <strong>+11,000</strong>원/1일)</span></p>
										<!-- 상품 기간별 가격// -->
										<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;">
											<p class="priceSelect">
												<span class="today"><strong>오늘</strong> +</span>
												<select id="idPubDay_8" name="j_publishday_8" title="신청기간" class="ipSelect2">
												<option value="0">선택</option>
												<option value="2">2일</option>
												<option value="3">3일</option>
												<option value="4">4일</option>
												<option value="5">5일</option>
												<option value="6">6일</option>
												<option value="7">7일</option>
												<option value="15">15일</option>
												<option value="30">30일</option>
												</select>
												<span>=</span> <strong class="pay pl5"><span class="text_orange">77,000</span></strong><span class="won positionR">원
												<em style="display:none; top:-21px; right:0;" class="positionA pl5">20일 <span class="priceDc text_orange">50%</span></em></span>
											</p>
										</div>	   
									</dd>
									<dd class="clearfix positionR">
										<p><input type="checkbox" class="chk"  value="1" id="PlatinumFLChk" name="PlatinumFLChk"><label class="pl5 text_color13" for="PlatinumFLChk"><strong>로고강조</strong></label><span class="suv_num">(움직이는 로고가 노출 : <strong>+5,500</strong>원/1일)</span></p>
										<ul class="aniLogo" style="display:block;">
											<li><input type="radio" class="chk"  value="2" id="PlatinumFL1" name="PlatinumFL"><label  for="PlatinumFL1"><img class="vm"  width="72"  alt="반짝로고1" src="../images/basic/img_aniLogo1.gif" /></label></li>
											<li><input type="radio" class="chk"  value="3" id="PlatinumFL2" name="PlatinumFL"><label  for="PlatinumFL1"><img class="vm"  width="72"  alt="반짝로고2" src="../images/basic/img_aniLogo2.gif" /></label></li>
											<li><input type="radio" class="chk"  value="4" id="PlatinumFL3" name="PlatinumFL"><label  for="PlatinumFL1"><img class="vm"  width="72"  alt="반짝로고3" src="../images/basic/img_aniLogo3.gif" /></label></li>
										</ul>
										<!-- 상품 기간별 가격// -->
										<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;">
											<p class="priceSelect">
												<span class="today"><strong>오늘</strong> +</span>
												<select id="idPubDay_8" name="j_publishday_8" title="신청기간" class="ipSelect2">
												<option value="0">선택</option>
												<option value="2">2일</option>
												<option value="3">3일</option>
												<option value="4">4일</option>
												<option value="5">5일</option>
												<option value="6">6일</option>
												<option value="7">7일</option>
												<option value="15">15일</option>
												<option value="30">30일</option>
												</select>
												<span>=</span> <strong class="pay pl5"><span class="text_orange">77,000</span></strong><span class="won positionR">원
												<em style="display:none; top:-21px; right:0;" class="positionA pl5">20일 <span class="priceDc text_orange">50%</span></em></span>
											</p>
										</div>	   
									</dd>
									<dd class="clearfix positionR">
										<p><input type="checkbox" class="chk"  value="1" id="PlatinumFLChk" name="PlatinumFLChk"><label class="pl5 text_color13" for="PlatinumFLChk"><strong>형광펜</strong></label><span class="suv_num">(형광펜 강조 효과 : <strong>+5,500</strong>원/1일)</span></p>
										<div style="display:block;" class="boxRadio bg_color2 ml10 mt10 pl10 pt5 pb5" >
											<strong>칼라선택:</strong>
											<span class=""><input type="radio" name="opt_pen" id="opt_pen1" value="2" class="chk"><label for="opt_pen1" class="opt_pen1">형광펜</label></span>
											<span class=""><input type="radio" name="opt_pen" id="opt_pen2" value="2" class="chk"><label for="opt_pen2" class="opt_pen2">형광펜</label></span>
											<span class=""><input type="radio" name="opt_pen" id="opt_pen3" value="2" class="chk"><label for="opt_pen3" class="opt_pen3">형광펜</label></span>
											<span class=""><input type="radio" name="opt_pen" id="opt_pen4" value="2" class="chk"><label for="opt_pen4" class="opt_pen4">형광펜</label></span>
										</div>
										<!-- 상품 기간별 가격// -->
										<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;">
											<p class="priceSelect">
												<span class="today"><strong>오늘</strong> +</span>
												<select id="idPubDay_8" name="j_publishday_8" title="신청기간" class="ipSelect2">
												<option value="0">선택</option>
												<option value="2">2일</option>
												<option value="3">3일</option>
												<option value="4">4일</option>
												<option value="5">5일</option>
												<option value="6">6일</option>
												<option value="7">7일</option>
												<option value="15">15일</option>
												<option value="30">30일</option>
												</select>
												<span>=</span> <strong class="pay pl5"><span class="text_orange">77,000</span></strong><span class="won positionR">원
												<em style="display:none; top:-21px; right:0;" class="positionA pl5">20일 <span class="priceDc text_orange">50%</span></em></span>
											</p>
										</div>	   
									</dd>		
									<dd class="clearfix positionR">
										<p><input type="checkbox" class="chk"  value="1" id="PlatinumFLChk" name="PlatinumFLChk"><label class="pl5 text_color13" for="PlatinumFLChk"><strong>굵은글자</strong></label><span class="suv_num">(굵은 글자로 강조 효과 : <strong>+5,500</strong>원/1일)</span></p>
										<!-- 상품 기간별 가격// -->
										<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;">
											<p class="priceSelect">
												<span class="today"><strong>오늘</strong> +</span>
												<select id="idPubDay_8" name="j_publishday_8" title="신청기간" class="ipSelect2">
												<option value="0">선택</option>
												<option value="2">2일</option>
												<option value="3">3일</option>
												<option value="4">4일</option>
												<option value="5">5일</option>
												<option value="6">6일</option>
												<option value="7">7일</option>
												<option value="15">15일</option>
												<option value="30">30일</option>
												</select>
												<span>=</span> <strong class="pay pl5"><span class="text_orange">77,000</span></strong><span class="won positionR">원
												<em style="display:none; top:-21px; right:0;" class="positionA pl5">20일 <span class="priceDc text_orange">50%</span></em></span>
											</p>
										</div>	   
									</dd>		
									<dd class="clearfix positionR">
										<p><input type="checkbox" class="chk"  value="1" id="PlatinumFLChk" name="PlatinumFLChk"><label class="pl5 text_color13" for="PlatinumFLChk"><strong>아이콘</strong></label><span class="suv_num">(아이콘으로 강조 효과 : <strong>+5,500</strong>원/1일)</span></p>
										<div style="display:none;" class="boxIcon ml10 mt10  pt5 pb5">
											<span class="pr15"><input type="radio" name="opt_icon" id="opt_icon1" value="2" class="chk"><label for="opt_icon1" ><img alt="HOT" src="../images/icon/icon_hot.gif"></label></span>
											<span class="pr15"><input type="radio" name="opt_icon" id="opt_icon2" value="2" class="chk"><label for="opt_icon2" ><img alt="초보" src="../images/icon/icon_first.gif"></label></span>
											<span class="pr15"><input type="radio" name="opt_icon" id="opt_icon3" value="2" class="chk"><label for="opt_icon3" ><img alt="식사" src="../images/icon/icon_eat.gif"></label></span>
											<span class="pr15"><input type="radio" name="opt_icon" id="opt_icon4" value="2" class="chk"><label for="opt_icon4" ><img alt="재택" src="../images/icon/icon_home.gif"></label></span>
											<span class="pr15"><input type="radio" name="opt_icon" id="opt_icon5" value="2" class="chk"><label for="opt_icon5" ><img alt="장기" src="../images/icon/icon_long.gif"></label></span>
											<span class="pr15"><input type="radio" name="opt_icon" id="opt_icon6" value="2" class="chk"><label for="opt_icon6" ><img alt="단기" src="../images/icon/icon_short.gif"></label></span>
											<span class="pr15"><input type="radio" name="opt_icon" id="opt_icon7" value="2" class="chk"><label for="opt_icon7" ><img alt="주말" src="../images/icon/icon_week.gif"></label></span>
											<span class="pr15"><input type="radio" name="opt_icon" id="opt_icon8" value="2" class="chk"><label for="opt_icon8" ><img alt="주5일" src="../images/icon/icon_week5.gif"></label></span>
										</div>
										<!-- 상품 기간별 가격// -->
										<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;">
											<p class="priceSelect">
												<span class="today"><strong>오늘</strong> +</span>
												<select id="idPubDay_8" name="j_publishday_8" title="신청기간" class="ipSelect2">
												<option value="0">선택</option>
												<option value="2">2일</option>
												<option value="3">3일</option>
												<option value="4">4일</option>
												<option value="5">5일</option>
												<option value="6">6일</option>
												<option value="7">7일</option>
												<option value="15">15일</option>
												<option value="30">30일</option>
												</select>
												<span>=</span> <strong class="pay pl5"><span class="text_orange">77,000</span></strong><span class="won positionR">원
												<em style="display:none; top:-21px; right:0;" class="positionA pl5">20일 <span class="priceDc text_orange">50%</span></em></span>
											</p>
										</div>	   
									</dd>
									<dd class="clearfix positionR">
										<p><input type="checkbox" class="chk"  value="1" id="PlatinumFLChk" name="PlatinumFLChk"><label class="pl5 text_color13" for="PlatinumFLChk"><strong>글자색</strong></label><span class="suv_num">(글자색으로 강조 효과 : <strong>+5,500</strong>원/1일)</span></p>
										<div style="display:none;" class="boxRadio bg_color2 ml10 mt10 pl10 pt5 pb5"><strong>칼라선택:</strong>
											<span class=""><input type="radio" name="opt_color" id="opt_color1" value="2" class="chk"><label for="opt_color1" class="opt_color1">글자색</label></span>
											<span class=""><input type="radio" name="opt_color" id="opt_color2" value="2" class="chk"><label for="opt_color2" class="opt_color2">글자색</label></span>
											<span class=""><input type="radio" name="opt_color" id="opt_color3" value="2" class="chk"><label for="opt_color3" class="opt_color3">글자색</label></span>
											<span class=""><input type="radio" name="opt_color" id="opt_color4" value="2" class="chk"><label for="opt_color4" class="opt_color4">글자색</label></span>
										</div>                       
										<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
											<p class="priceSelect">
												<span class="today"><strong>오늘</strong> +</span>
												<select id="idPubDay_8" name="j_publishday_8" title="신청기간" class="ipSelect2">
												<option value="0">선택</option>
												<option value="2">2일</option>
												<option value="3">3일</option>
												<option value="4">4일</option>
												<option value="5">5일</option>
												<option value="6">6일</option>
												<option value="7">7일</option>
												<option value="15">15일</option>
												<option value="30">30일</option>
												</select>
												<span>=</span> <strong class="pay pl5"><span class="text_orange">77,000</span></strong><span class="won positionR">원
												<em style="display:none; top:-21px; right:0;" class="positionA pl5">20일 <span class="priceDc text_orange">50%</span></em></span>
											</p>
										</div>	   
									</dd>		
									<dd class="clearfix positionR">
										<p><input type="checkbox" class="chk"  value="1" id="PlatinumFLChk" name="PlatinumFLChk"><label class="pl5 text_color13" for="PlatinumFLChk"><strong>반짝칼라</strong></label><span class="suv_num">(빤짝컬러 강조 효과 : <strong>+5,500</strong>원/1일)</span></p>
										<div class="price positionA" style="margin-bottom:-15px; bottom:50%; right:3%;"><!-- 상품 기간별 가격// -->
											<p class="priceSelect">
												<span class="today"><strong>오늘</strong> +</span>
												<select id="idPubDay_8" name="j_publishday_8" title="신청기간" class="ipSelect2">
												<option value="0">선택</option>
												<option value="2">2일</option>
												<option value="3">3일</option>
												<option value="4">4일</option>
												<option value="5">5일</option>
												<option value="6">6일</option>
												<option value="7">7일</option>
												<option value="15">15일</option>
												<option value="30">30일</option>
												</select>
												<span>=</span> <strong class="pay pl5"><span class="text_orange">77,000</span></strong><span class="won positionR">원
												<em style="display:none; top:-21px; right:0;" class="positionA pl5">20일 <span class="priceDc text_orange">50%</span></em></span>
											</p>
										</div>	   
									</dd>		
								</dl>  
							</td>
						</tr>
						</tbody>
						</table>
					</div>
					<?php */ ?>
				</div>
				<!-- //상품정보 및 기간별 가격 -->

			</div>
			<!-- 상품결제 // -->      

			<!--  결제하기   --> 
			<div id="listForm" class="mainTopBorder positionR mt30 clearfix" style="display:<?php echo ($mode=='service_pay')?'':'none';?>;">

				<h3 class="pb5 h3">
					<img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="bg_color4"> <strong>신청상품</strong>
				</h3>

				<!--  신청상품   --> 
				<div class="customList1 mb10">
					<table cellspacing="0" summary="신청상품 리스트">
					<caption class="skip">신청상품 리스트</caption>
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
					<tr>
						<td class="tc"  height="50"><span><strong>이력서열람</strong></span></td>
						<td class="tl"><span>오늘+7일(2013.04.15~2014.04.05)</span></td>
						<td class="tc"><span>88,000원</span></td>
						<td class="tc"><span class="text_red"><strong>\1,555,000</strong></span></td>
					</tr>          
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
					<input type="hidden" name="total_price" id="total_price" value="<?php echo number_format($post_total_price);?>"/>
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
					<caption><span class="skip">희망근무조건출력</span></caption>
					<colgroup><col width="159px"><col width="*"></colgroup>
					<tbody>
					<tr>
						<th scope="row"><label>총 신청금액</label></th>
						<td><span><strong class="text_orange">2,100,000</strong>원</span></td>
					</tr>
					<tr>
						<th scope="row"> <label>할인내역</label></th>
						<td>
							<div class="partnameWrap positionR">
							<input type="text" style="width:200px;" class="ipText" id="" name=""> 원
							<em class="pr10"><a class="button"><span>사용하기</span></a></em><span class="text_orange">(보유 e-머니 : <strong>0</strong>원)</span>
							</div>
						</td>
					</tr>
					<tr>
						<th scope="row" class="bbend"> <label>최종 결제금액</label></th>
						<td class="bbend"><span><strong class="sumTot text_orange">2,100,000</strong><strong>원</strong></span></td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div> 
		<!--  결제정보// end   -->

		<div id="listForm" class="mainTopBorder positionR mt30 clearfix"> <!--  결제수단 선택   --> 
			<h3 class="pb5 h3">
				<img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="bg_color4"> <strong>결제수단 선택</strong>
			</h3>
			<div class="customList1 mb30"><!--  결제수단 선택   --> 
				<div class="CashDone">
					<ul class="option clearfix">
						<li>
							<input type="radio" id="" name="lb_certifytype" value="1">
							<label>신용카드</label>
						</li>
						<li>        
							<input type="radio" id="" name="lb_certifytype" value="1">
							<label>휴대폰</label>                
						</li>
						<li>    
							<input type="radio" id="" name="lb_certifytype" value="1">
							<label>가상계좌 입금</label>
						</li>
						<li>    
							<input type="radio" id="" name="lb_certifytype" value="2">
							<label>실시간 계좌이체</label>
						</li>
					</ul>        
				</div>
			</div>
		</div> 
		<!--  결제수단 선택 end   -->          


					<div style="margin:30px auto;" class="singleBtn clearfix">
						<ul> 
							<li><div class="btn font_white bg_blueBlack"><a href="#">결제하기<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
						</ul>
					</div>        
					</div><!--  조건설정수정 end   --> 
					</div> <!--  맞춤 서비스 관리 end   --> 

				</div><!--  컨텐츠 end   --> 
			</div>
		</div>
	</div>  
</section>