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
var data_icon_path = "<?php echo $alice['data_icon_path'];?>";
</script>

<script type="text/javascript" src="<?php echo $alice['individual_path'];?>/skins/default/alba_resume_service.js"></script>

<section id="content" class="content_wrap clearfix">
  <div class="content1_wrap clearfix"> 
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<?php /* navigation */ ?>
	<div class="NowLocation mt20 clearfix">
		<p> <a href="/">HOME</a> >  <strong>서비스안내</strong> </p>
	</div>
	<?php /* //navigation */ ?>
    <!--  content -->
    <div class="serviceGuideWrap mt10">
      <div class="serviceGuide mt30">
      <h2 class="skip">서비스안내</h2>
        <ul class="serviceGuideTab clearfix">
			<!-- <li class="tab1 "><a href="#tab1">기업회원서비스</a></li> -->
			<li class="tab2 on"><a href="#tab2">개인회원서비스</a></li>
		</ul>
          
		<div class="serviceContentWrap" style="display:block;">
			<div class="goodsNav mb20 pb10 pt10 pl10 positionR">
				<!-- 위치별 
				<ul class="loc clearfix positionR">
				<li class="all"><a class="on first" href="#all">전체</a></li>
				<li class="main"><a class="" href="#main">메인페이지</a></li>
				<li class="rcmain"><a class="" href="#rcmain">인재정보 메인</a></li>
				<li class="areamain"><a class="" href="#areamain">지역별 인재정보</a></li>
				<li class="rckind"><a class="" href="#rckind">급구인재정보</a></li>
				</ul>
				-->
			</div> 
            
		<form method="post" name="ServiceFrm" action="<?php echo $alice['individual_path'];?>/alba_resume_pay.php" id="ServiceFrm">
		<input type="hidden" name="mode" value="service_pay" id="service_mode"/>
		<input type="hidden" name="sel_service" id="sel_service"/>
		<input type="hidden" name="no" value="<?php echo $no;?>"/>

		<?php if($package_list['total_count']){ // 패키지 결제?>
		<div class="serviceListWrap num1 positionR"  style="z-index:900;">
			<h3 style="border-bottom:2px solid #404660;background-color:#" class="title"><font color="#ff0000;">패키지</font> 결제</h3>
		</div>	
		<div class="mb20">
			<TABLE style="line-height: 32px; WIDTH: 960px; background-color:#fbfbfb;" cellSpacing=0>
			<TBODY>
			<TR>
				<TD><!--구분타이틀-->
					<TABLE style="WIDTH: 100%" cellSpacing=0>
					<TBODY>
					<TR>
						<TD align="center" class="svcbd_b" style="HEIGHT: 30px; WIDTH: 140px; COLOR: #676565">패키지정보</TD>
						<TD align="center" class="svcbd_b" style="COLOR: #676565">선택</TD>
					</TR>
					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>

			<TABLE style="WIDTH: 100%" border=0 cellSpacing=0>
			<TBODY>
			<?php 
				foreach($package_list['result'] as $val){ 
				$wr_content = unserialize($val['wr_content']);
				$service_value = array();
				$service_text = array();
				foreach($wr_content as $key => $content){
					if($content['use']){
						$values = $key."/".$content['service_count']."/".$content['service_unit'];
						array_push($service_value,$values);
						$package_service = $service_control->package_service['individual'][$key]." ".$content['service_count'].$service_control->_unit($content['service_unit']);
						array_push($service_text,$package_service);
					}
				}
			?>
			<TR>
				<TD class="svcbd_b svcbd_r" style="WIDTH: 130px;">
					<TABLE style="WIDTH: 100%" cellSpacing=0>
					<TBODY>
					<TR>
						<TD vAlign="top" class="pl10" style="WIDTH: 10px;"><INPUT name="package_no" id="package_<?php echo $val['no'];?>" type="checkbox" value="<?php echo $val['no'];?>" onclick="package_on(this);"></TD>
						<TD class="pl5"style="LETTER-SPACING: -1px"><B style="COLOR: #494949"><label for="package_<?php echo $val['no'];?>"><?php echo stripslashes($val['wr_subject']);?></label></B><BR></TD>
					</TR>
					</TBODY>
					</TABLE>
				</TD>
				<TD class="svcbd_r svcbd_b" style="width: 728.87px;padding:20px 0px 20px 20px;">
					<div class="b pl5 pb5">패키지 내용</div>
					<DIV class="ml3 packname">
						<?php echo @implode($service_text," + ");?> <br><b> <font class="b lh26" size="4px">= <font size="4px;" class="fonta fonred"><?php echo number_format($val['wr_price']);?>원</font></font></b>
					</DIV>
					<TABLE style="WIDTH: 430px" cellSpacing=0>
					<TBODY>
					<TR>
						<TD vAlign="top" class="font11" style="COLOR: #8c8c8c; LETTER-SPACING: -1px; LINE-HEIGHT: 150%"><?php echo nl2br(stripslashes($val['wr_brief']));?></TD>
						<TD vAlign="top" class="font11" style="COLOR: #8c8c8c; LETTER-SPACING: -1px; LINE-HEIGHT: 150%"></TD>
					</TR>
					</TBODY>
					</TABLE>
				</TD>
				<td class="svcbd_b" style="padding:20px 0px 20px 5px;"><a class="btnReg" href="javascript:serviceFrm_submit('<?php echo $val['no'];?>', true);"><img width="70" height="56" class="vm" alt="신청하기" src="../images/basic/btn_reg1.gif"></a></td>
			</TR>
			<?php } ?>
			</TBODY>
			</TABLE>
		</div>
		<?php } ?>

		<?php if($main_focus['is_pay']){ //  && $main_focus_limit == false?>
		<!--  1st 메인 --> 
		<div class="serviceListWrap num1 mb30 positionR"  style="z-index:900;">
			<h3 class="title">메인페이지</h3>
			<div class="serviceBox  num1 positionR">

				<div class="capturePerson main">
					<a class="captureMain no1" href="javascript:service_preview('main_focus');" style="top:34px; left:10px; width:160px; height:18px;cursor:pointer;"><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">포커스</em></a> 
					<a class="captureMain no2" style="top:60px; left:10px; width:160px; height:54px;"><em class="positionA" style="right:-2px; bottom:-1px; width:85px;">일반리스트</em></a> 
				</div>

				<!-- //상품미리보기 포커스 -->       
				<div class="goodsPreview positionA" style="display:none; top:25px; left:190px; width:352px;" id="main_focus_preview"> 
					<h3 class=""><strong>상품 미리보기 :</strong>(포커스 인재정보)</h3>
					<em class="positionA" style="top:5px; right:5px;"><a href="javascript:service_preview('main_focus');"><img width="11" height="11" alt="닫기" src="../images/icon/icon_close3.gif"></a></em>
					<div class="preViewWrap">
						<div class="style1 border1  color1  clearfix" id="photo" style="display:block; width:312px; margin:0 auto;">
							<ul>
								<li>
								<dl>
									<dt>
										<a> <span class="photo"><img width="49" height="63" src="../images/basic/bg_noPhoto.gif" alt="사진"></span></a> 
									</dt>
									<dd class="name_wrap ">
										<span class="name ">이00</span>
										<span>(男40)</span>
										<span>13년 1개월</span>
									</dd>
									<dd class="text1"><a>상반기 각 부문 경력직 및</a></dd>
									<dd class="text2"><span style="color:#8f8f8f" class="school">대학교(4년)졸업: 시각디자인</span></dd>
									<dd class="icons" style="display:none;">
										<div><a href="#" class="star" id=""><img width="13" height="13" src="../images/icon/icon_star.png" alt="공고스크랩"></a></div>
										<div><a href="#" class="plus" id=""><img width="13" height="13" src="../images/icon/icon_plus.png" alt="상세보기"></a></div>
									</dd>
								</dl>
								</li>
							</ul>                
						</div> <!--  포커스인재정보// -->
					</div>            
				</div> 
				<!-- 상품미리보기 포커스인재정보 // -->

				<div class="goods goods_1">
				<table class="typeA">
				<colgroup><col width="130px"><col width="*"><col width="200px"><col width="60px"></colgroup>
				<tr class="zone1">
					<th>
						<p class="zone">
							<img  alt="title" src="../images/tit/tit_06.gif">
							<span class=" iconBooth"><img class="vm" alt="" width="29" height="16" src="../images/icon/icon_logoBox1.gif"> 로고형</span>
							<?php if($main_focus_gold['is_pay']){ ?>
							<span class="pt3 iconGold"><img class="vm" alt="" width="35" height="16" src="../images/icon/icon_gold1.gif"> 신청가능</span>
							<?php } ?>
						</p>
					</th>
					<td class="content">
						<?php echo stripslashes($design['main_focus_content']);?>
					</td>
					<td class="price">
						<?php if($main_focus_limit){ ?>
							<p class="priceSelect">서비스 마감</p>
						<?php } else { ?>
						<p class="priceSelect">
							<span class="today"><strong>오늘</strong> +</span>
							<select class="ipSelect2" title="신청기간" name="main_focus_date" id="main_focus_date" onchange="service_price_print('main_focus',this);">
							<option value="">선택</option>
							<?php 
								foreach($main_focus_service as $key => $val){
								$service_cnt = $val['service_cnt'];
								$service_unit = $service_control->_unit($val['service_unit']);
								$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
								$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
								$service_text = $service_cnt . $service_unit;
							?>
							<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
							<?php } ?>
							</select>
							<div style="margin-top:5px; display:none;" id="main_focus_price_info">
									<em class="mr5">
										<span class="price">0</span>원
										<span class="priceDc text_orange">0%</span>
									</em>
									<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
							</div>
						</p>
						<?php } ?>
					</td>
					<td class="rbend">
						<a class="btnReg" href="javascript:<?php echo ($main_focus_limit)?"serviceFrm_ended();":"serviceFrm_submit('main_focus');";?>"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
					</td>
				</tr>
				</table>
				</div>

				<?php if($design['main_bottom_resume_use'] && $main_rbasic['is_pay']){ // 메인 최근 인재 리스트 ?>
				<div class="goods goods_1">
				<table class="typeA">
				<colgroup><col width="130px"><col width="*"><col width="200px"><col width="60px"></colgroup>
				<tr class="zone1">
					<th>
						<p class="zone">
							<img  alt="title" src="../images/tit/tit_08.gif">
							<span class=" iconBooth"><img class="vm" alt="" width="29" height="16" src="../images/icon/icon_logoBox1.gif"> 줄광고</span>
						</p>
					</th>
					<td class="content">
						<?php echo stripslashes($design['main_rbasic_content']);?>
					</td>
					<td class="price">
						<p class="priceSelect">
							<span class="today"><strong>오늘</strong> +</span>
							<select class="ipSelect2" title="신청기간" name="main_rbasic_date" id="main_rbasic_date" onchange="service_price_print('main_rbasic',this);">
							<option value="">선택</option>
							<?php 
								foreach($main_rbasic_service as $key => $val){
								$service_cnt = $val['service_cnt'];
								$service_unit = $service_control->_unit($val['service_unit']);
								$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
								$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
								$service_text = $service_cnt . $service_unit;
							?>
							<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
							<?php } ?>
							</select>
							<div style="margin-top:5px; display:none;" id="main_rbasic_price_info">
									<em class="mr5">
										<span class="price">0</span>원
										<span class="priceDc text_orange">0%</span>
									</em>
									<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
							</div>
						</p>
					</td>
					<td class="rbend">
						<a class="btnReg" href="javascript:serviceFrm_submit('main_rbasic');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
					</td>
				</tr>
				</table>
				</div>
				<?php } ?>

			</div> 
		</div>
		<!--  1st 메인 end -->
		<?php } // use main_focus if end. ?>

		<?php if($alba_resume_focus['is_pay']){ //  && $alba_resume_focus_limit == false?>
		<!--  2st 인재정보메인 --> 
		<div class="serviceListWrap num1 mb30 positionR"  style="z-index:800;">
			<h3 class="title">인재정보 메인</h3>
			<div class="serviceBox  num1 positionR">

				<div class="capturePerson sub1">
					<a class="captureSub1 no1" href="javascript:service_preview('alba_resume_focus');" style="top:10px; left:40px; width:130px; height:29px;cursor:pointer;"><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">포커스</em></a> 
					<a class="captureMain no2" style="top:48px; left:10px; width:160px; height:54px;"><em class="positionA" style="right:-2px; bottom:-1px; width:85px;">일반리스트</em></a> 
				</div> 

				<!-- //상품미리보기 포커스 -->       
				<div class="goodsPreview positionA" style="display:none; top:25px; left:190px; width:352px;" id="alba_resume_focus_preview"> 
					<h3 class=""><strong>상품 미리보기 :</strong>(포커스 인재정보)</h3>
					<em class="positionA" style="top:5px; right:5px;"><a href="javascript:service_preview('alba_resume_focus');"><img width="11" height="11" alt="닫기" src="../images/icon/icon_close3.gif"></a></em>
					<div class="preViewWrap">
						<div class="style1 border1  color1  clearfix" id="photo" style="display:block; width:312px; margin:0 auto;">
							<ul>  
								<li>
								<dl>
									<dt>
										<a> <span class="photo"><img width="49" height="63" src="../images/basic/bg_noPhoto.gif" alt="사진"></span></a> 
									</dt>
									<dd class="name_wrap ">
										<span class="name ">이00</span>
										<span>(男40)</span>
										<span>13년 1개월</span>
									</dd>
									<dd class="text1"><a>상반기 각 부문 경력직 및</a></dd>
									<dd class="text2"><span style="color:#8f8f8f" class="school">대학교(4년)졸업: 시각디자인</span></dd>
									<dd class="icons" style="display:none;">
										<div><a href="#" class="star" id=""><img width="13" height="13" src="../images/icon/icon_star.png" alt="공고스크랩"></a></div>
										<div><a href="#" class="plus" id=""><img width="13" height="13" src="../images/icon/icon_plus.png" alt="상세보기"></a></div>
									</dd>
								</dl>
								</li>
							</ul>                
						</div> <!--  포커스인재정보// -->
					</div>            
				</div> <!-- 상품미리보기 포커스인재정보 // -->

				<div class="goods goods_1">
					<table class="typeA">
					<colgroup><col width="130px"><col width="*"><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone">
								<img  alt="title" src="../images/tit/tit_06.gif">
								<span class=" iconBooth"><img class="vm" alt="" width="29" height="16" src="../images/icon/icon_logoBox1.gif"> 로고형</span>
								<?php if($alba_resume_focus_gold['is_pay']){ ?>
								<span class="pt3 iconGold"><img class="vm" alt="" width="35" height="16" src="../images/icon/icon_gold1.gif"> 신청가능</span>
								<?php } ?>
							</p>
						</th>
						<td class="content">
							<?php echo stripslashes($design['sub_focus_content']);?>
						</td>
						<td class="price">
							<?php if($alba_resume_focus_limit){ ?>
								<p class="priceSelect">서비스 마감</p>
							<?php } else { ?>
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_resume_focus_date" id="alba_resume_focus_date" onchange="service_price_print('alba_resume_focus',this);">
								<option value="">선택</option>
								<?php 
									foreach($alba_resume_focus_service as $key => $val){
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="alba_resume_focus_price_info">
										<em class="mr5">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
										<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
								</div>
							</p>
							<?php } ?>
						</td>
						<td class="rbend">
							<a class="btnReg" href="javascript:<?php echo ($alba_resume_focus_limit)?"serviceFrm_ended();":"serviceFrm_submit('alba_resume_focus');";?>"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
				</div>
				<?php if($alba_resume_basic['is_pay']){ ?>
				<div class="goods goods_1">
					<table class="typeA">
					<colgroup><col width="130px"><col width="*"><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone">
								<img  alt="title" src="../images/tit/tit_08.gif">
								<span class=" iconBooth"><img class="vm" alt="" width="29" height="16" src="../images/icon/icon_logoBox1.gif"> 줄광고</span>
							</p>
						</th>
						<td class="content">
							<?php echo stripslashes($design['sub_rbasic_content']);?>
						</td>
						<td class="price">
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_resume_basic_date" id="alba_resume_basic_date" onchange="service_price_print('alba_resume_basic',this);">
								<option value="">선택</option>
								<?php 
									foreach($alba_resume_basic_service as $key => $val){
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="alba_resume_basic_price_info">
										<em class="mr5">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
										<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
								</div>
							</p>
						</td>
						<td class="rbend">
							<a class="btnReg" href="javascript:serviceFrm_submit('alba_resume_basic');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
				</div>
				<?php } ?>
			</div> 
		</div>
		<!--  2st 인재정보메인 end -->
		<?php } ?>

		<?php if($resume_option_busy['is_pay']){ ?>
		<!--  급구상품 --> 
		<div class="serviceListWrap num1 mb30 positionR">
			<h3 class="title">급구 상품</h3>
			<div class="serviceBox  num1  positionR">
				<div class="wanted clearfix">
					<ul>
						<li class="mt20 ml10"><span><img class="vm pr5" src="<?php echo $resume_option_busy_icon;?>" alt="급구">최선을다하겠습니다.</span><em>급구</em></li> 
					</ul>
				</div> 
				<div class="goods goods_1">
					<table class="typeA">
					<colgroup><col width="130px"><col width="*"><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th><p class="zone"><img  alt="title" src="../images/tit/service_tit_09.gif"></p></th>
						<td class="content">
							<?php echo stripslashes($design['sub_busy_content']);?>
						</td>
						<td class="price">
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="resume_option_busy_date" id="resume_option_busy_date" onchange="service_price_print('resume_option_busy',this);">
								<option value="">선택</option>
								<?php 
									foreach($resume_option_busy_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="resume_option_busy_price_info">
										<em class="mr5">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
										<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
								</div>
							</p>
						</td>
						<td class="rbend">
							<a class="btnReg" href="javascript:serviceFrm_submit('resume_option_busy');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
				</div>
			</div> 
		</div>
		<?php } ?>

		<?php if($resume_option_neon['is_pay'] || $resume_option_bold['is_pay'] || $resume_option_icon['is_pay'] || $resume_option_color['is_pay'] || $resume_option_blink['is_pay']){ ?>
		<!--  3st 강조효과 --> 
		<div class="serviceListWrap num1 mb30 positionR" id="resume_option">
			<h3 class="title">강조옵션 상품</h3>
			<div class="serviceBox  num1 positionR">
				<div class="option clearfix">
					<ul>
						<?php if($resume_option_neon['is_pay']){ ?>
						<li class="ml10 mt30" style="margin-bottom:40px;"><span class="pl5 neon_preview" style="background:#<?php echo $resume_option_neon_color[0];?>;">최선을다하겠습니다.</span><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">형광펜</em></li> 
						<?php } ?>
						<?php if($resume_option_bold['is_pay']){ ?>
						<li class="ml10" style="margin-bottom:60px;"><span class="opt_bold">최선을다하겠습니다.</span><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">굵은글자</em></li> 
						<?php } ?>
						<?php if($resume_option_icon['is_pay']){ ?>
						<li class="ml10" style="margin-bottom:50px;"><span><img class="vm pr5 icon_preview" alt="HOT" src="<?php echo $alice['data_icon_path']."/".$resume_option_icon_list[0]['name'];?>">최선을다하겠습니다.</span><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">아이콘</em></li> 
						<?php } ?>
						<?php if($resume_option_color['is_pay']){ ?>
						<li class="ml10" style="margin-bottom:50px;"><span class="color_preview" style="color:#<?php echo $resume_option_colors[0];?>;">최선을다하겠습니다.</span><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">글자색</em></li> 
						<?php } ?>
						<?php if($resume_option_blink['is_pay']){ ?>
						<li class="ml10" style="margin-bottom:50px;"><span class="jumble">최선을다하겠습니다.</span><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">반짝칼라</em></li> 
						<?php } ?>
					</ul>
				</div> 

				<?php if($resume_option_neon['is_pay']){ ?>
				<div class="goods goods_1">
				<table class="typeA">
				<colgroup><col width="130px"><col width="*"><col width="200px"><col width="60px"></colgroup>
				<tr class="zone1">
					<th><p class="zone"><img  alt="title" src="../images/tit/service_tit_02.gif"></p></th>
					<td class="content">
						<ul>
							<li class=""><span class="neon_preview" style="background:#<?php echo $resume_option_neon_color[0];?>;">인재정보 리스트 제목을 형광펜 강조 효과</span></li>
						</ul>
						<div class="boxRadio bg_color2 ml10 mt10 pl10 pt5 pb5"><strong>칼라선택:</strong>
							<?php for($i=0;$i<$resume_option_neon_color_cnt;$i++){ ?>
								<span class="">
									<input type="radio" name="resume_option_neon" id="resume_option_neon_<?php echo $i;?>" value="<?php echo $resume_option_neon_color[$i];?>" class="chk" <?php echo ($i==0)?'checked':'';?> onclick="option_neon_sel(this);">
									<label for="resume_option_neon_<?php echo $i;?>" style="color:#fff;background:#<?php echo $resume_option_neon_color[$i];?>;">형광펜</label>
								</span>
							<?php } ?>
						</div>
					</td>
					<td class="price">
						<p class="priceSelect">
							<span class="today"><strong>오늘</strong> +</span>
							<select class="ipSelect2" title="신청기간" name="resume_option_neon_date" id="resume_option_neon_date" onchange="service_price_print('resume_option_neon',this);">
							<option value="">선택</option>
							<?php 
								foreach($resume_option_neon_service as $key => $val){ 
								$service_cnt = $val['service_cnt'];
								$service_unit = $service_control->_unit($val['service_unit']);
								$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
								$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
								$service_text = $service_cnt . $service_unit;
							?>
							<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
							<?php } ?>
							</select>
							<div style="margin-top:5px; display:none;" id="resume_option_neon_price_info">
									<em class="mr5">
										<span class="price">0</span>원
										<span class="priceDc text_orange">0%</span>
									</em>
									<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
							</div>
						</p>
					</td>
					<td class="rbend">
						<a class="btnReg" href="javascript:serviceFrm_submit('resume_option_neon');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
					</td>
				</tr>
				</table>
				</div>
				<?php } ?>

				<?php if($resume_option_bold['is_pay']){ ?>
				<div class="goods goods_2">
				<table class="typeA">
				<colgroup><col width="130px"><col width="*"><col width="200px"><col width="60px"></colgroup>
				<tr class="zone1">
					<th><p class="zone"><img  alt="title" src="../images/tit/service_tit_03.gif"></p></th>
					<td class="content">
						<ul>
							<li class="item_bold"><span class="opt_bold">인재정보 리스트 제목을 굵은 글자로 강조 효과</span></li>
						</ul>
					</td>
					<td class="price">
						<p class="priceSelect">
							<span class="today"><strong>오늘</strong> +</span>
							<select class="ipSelect2" title="신청기간" name="resume_option_bold_date" id="resume_option_bold_date" onchange="service_price_print('resume_option_bold',this);">
							<option value="">선택</option>
							<?php 
								foreach($resume_option_bold_service as $key => $val){ 
								$service_cnt = $val['service_cnt'];
								$service_unit = $service_control->_unit($val['service_unit']);
								$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
								$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
								$service_text = $service_cnt . $service_unit;
							?>
							<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
							<?php } ?>
							</select>
							<div style="margin-top:5px; display:none;" id="resume_option_bold_price_info">
								<em class="mr5">
									<span class="price">0</span>원
									<span class="priceDc text_orange">0%</span>
								</em>
								<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
							</div>
						</p>
					</td>
					<td class="rbend">
						<a class="btnReg" href="javascript:serviceFrm_submit('resume_option_bold');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
					</td>
				</tr>
				</table>
				</div>
				<?php } ?>

				<?php if($resume_option_icon['is_pay']){ ?>
				<div class="goods goods_3">
				<table class="typeA">
				<colgroup><col width="130px"><col width="*"><col width="200px"><col width="60px"></colgroup>
				<tr class="zone1">
					<th><p class="zone"><img  alt="title" src="../images/tit/service_tit_05.gif"></p></th>
					<td class="content">
						<ul>
							<li class="opt_icon"><span class="">인재정보 리스트 제목 앞을 아이콘으로 강조 효과</span></li>
						</ul>
						<div class="boxIcon ml10 mt10  pt5 pb5">
							<?php foreach($resume_option_icon_list as $key => $val){ ?>
								<span style="padding-right:22px;"><input type="radio" name="resume_option_icon" id="resume_option_icon_<?php echo $key;?>" value="<?php echo $val['no'];?>" class="chk" <?php echo ($key==0)?'checked':'';?> onclick="option_icon_sel('<?php echo $val['name'];?>');"><label for="resume_option_icon_<?php echo $key;?>"><img src="<?php echo $alice['data_icon_path']."/".$val['name'];?>"></label></span>
							<?php } // icon list foreach end. ?>
						</div>
					</td>
					<td class="price">
						<p class="priceSelect">
							<span class="today"><strong>오늘</strong> +</span>
							<select class="ipSelect2" title="신청기간" name="resume_option_icon_date" id="resume_option_icon_date" onchange="service_price_print('resume_option_icon',this);">
							<option value="">선택</option>
							<?php 
								foreach($resume_option_icon_service as $key => $val){ 
								$service_cnt = $val['service_cnt'];
								$service_unit = $service_control->_unit($val['service_unit']);
								$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
								$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
								$service_text = $service_cnt . $service_unit;
							?>
							<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
							<?php } ?>
							</select>
							<div style="margin-top:5px; display:none;" id="resume_option_icon_price_info">
									<em class="mr5">
										<span class="price">0</span>원
										<span class="priceDc text_orange">0%</span>
									</em>
									<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
							</div>
						</p>
					</td>
					<td class="rbend">
						<a class="btnReg" href="javascript:serviceFrm_submit('resume_option_icon');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
					</td>
				</tr>
				</table>
				</div>
				<?php } ?>

				<?php if($resume_option_color['is_pay']){ ?>
				<div class="goods goods_4">
				<table class="typeA">
				<colgroup><col width="130px"><col width="*"><col width="200px"><col width="60px"></colgroup>
				<tr class="zone1">
					<th><p class="zone"><img  alt="title" src="../images/tit/service_tit_04.gif"></p></th>
					<td class="content">
						<ul>
							<li class="item_color"><span class="color_preview" style="color:#<?php echo $resume_option_colors[0];?>;">인재정보 리스트 제목을 글자색으로 강조 효과</span></li>
						</ul>
						<div class="boxRadio bg_color2 ml10 mt10 pl10 pt5 pb5"><strong>칼라선택:</strong>
							<?php for($i=0;$i<$resume_option_colors_cnt;$i++){?>
								<span class=""><input type="radio" name="resume_option_color" id="resume_option_color_<?php echo $i;?>" value="<?php echo $resume_option_colors[$i];?>" class="chk" <?php echo ($i==0)?'checked':'';?> onclick="option_color_sel(this);"><label for="resume_option_color_<?php echo $i;?>" style="color:#<?php echo $resume_option_colors[$i];?>"> 글자색</label>&nbsp;</span>
							<?php } ?>
						</div>
					</td>
					<td class="price">
						<p class="priceSelect">
							<span class="today"><strong>오늘</strong> +</span>
							<select class="ipSelect2" title="신청기간" name="resume_option_color_date" id="resume_option_color_date" onchange="service_price_print('resume_option_color',this);">
							<option value="">선택</option>
							<?php 
								foreach($resume_option_color_service as $key => $val){ 
								$service_cnt = $val['service_cnt'];
								$service_unit = $service_control->_unit($val['service_unit']);
								$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
								$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
								$service_text = $service_cnt . $service_unit;
							?>
							<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
							<?php } ?>
							</select>
							<div style="margin-top:5px; display:none;" id="resume_option_color_price_info">
								<em class="mr5">
									<span class="price">0</span>원
									<span class="priceDc text_orange">0%</span>
								</em>
								<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
							</div>
						</p>
					</td>
					<td class="rbend">
						<a class="btnReg" href="javascript:serviceFrm_submit('resume_option_color');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
					</td>
				</tr>
				</table>
				</div>
				<?php } ?>

				<?php if($resume_option_blink['is_pay']){ ?>
				<div class="goods goods_5">
				<table class="typeA">
				<colgroup><col width="130px"><col width="*"><col width="200px"><col width="60px"></colgroup>
				<tr class="zone1">
					<th><p class="zone"><img  alt="title" src="../images/tit/service_tit_06.gif"></p></th>
					<td class="content">
						<ul>
							<li class="item_anicolor"><span class="jumble">인재정보 리스트 제목을 빤짝컬러 강조 효과</span></li>
						</ul>
					</td>
					<td class="price">
						<p class="priceSelect">
							<span class="today"><strong>오늘</strong> +</span>
							<select class="ipSelect2" title="신청기간" name="resume_option_blink_date" id="resume_option_blink_date" onchange="service_price_print('resume_option_blink',this);">
							<option value="">선택</option>
							<?php 
								foreach($resume_option_blink_service as $key => $val){ 
								$service_cnt = $val['service_cnt'];
								$service_unit = $service_control->_unit($val['service_unit']);
								$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
								$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
								$service_text = $service_cnt . $service_unit;
							?>
							<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
							<?php } ?>
							</select>
							<div style="margin-top:5px; display:none;" id="resume_option_blink_price_info">
								<em class="mr5">
									<span class="price">0</span>원
									<span class="priceDc text_orange">0%</span>
								</em>
								<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
							</div>
						</p>
					</td>
					<td class="rbend">
						<a class="btnReg" href="javascript:serviceFrm_submit('resume_option_blink');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
					</td>
				</tr>
				</table>
				</div>
				<?php } ?>
			</div> 
		</div>
		<!--  3st 메인 end --> 
		<?php } ?>

		<?php if($resume_option_jump['is_pay']){ ?>
		<!--  점프 --> 
		<div class="serviceListWrap num1 mb30 positionR">
			<h3 class="title">점프 서비스</h3>
			<div class="serviceBox  num1  positionR">
				<div class="jump clearfix">
					<ul>
						<li class="ml10 mb20"><span class=""></span><em>점프서비스</em></li> 
					</ul>
				</div> 
				<div class="goods goods_1">
				<table class="typeA">
				<colgroup><col width="130px"><col width="*"><col width="200px"><col width="60px"></colgroup>
				<tr class="zone1">
					<th><p class="zone"><img  alt="title" src="../images/tit/service_tit_08.gif"></p></th>
					<td class="content">
						<?php echo stripslashes($design['resume_jump_content']);?>
					</td>
					<td class="price">
						<p class="priceSelect">
							<span class="today"><strong>오늘</strong> +</span>
							<select class="ipSelect2" title="신청기간" name="resume_option_jump_date" id="resume_option_jump_date" onchange="service_price_print('resume_option_jump',this);">
							<option value="">선택</option>
							<?php 
								foreach($resume_option_jump_service as $key => $val){ 
								$service_cnt = $val['service_cnt'];
								$service_unit = $service_control->_unit($val['service_unit']);
								$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
								$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
								$service_text = $service_cnt . $service_unit;
							?>
							<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
							<?php } ?>
							</select>
							<div style="margin-top:5px; display:none;" id="resume_option_jump_price_info">
								<em class="mr5">
									<span class="price">0</span>원
									<span class="priceDc text_orange">0%</span>
								</em>
								<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
							</div>
						</p>
					</td>
					<td class="rbend">
						<a class="btnReg" href="javascript:serviceFrm_submit('resume_option_jump');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
					</td>
				</tr>
				</table>
				</div>
			</div> 
		</div>
		<!--  // 점프 --> 
		<?php } ?>
		
		<?php if($etc_alba['is_pay']){ ?>
		<!--  열람 서비스 --> 
		<div class="serviceListWrap num1 mb30 positionR">
			<h3 class="title">채용공고 열람 서비스</h3>
			<div class="serviceBox  num1  positionR">
				<div class="resumBg clearfix">
					<ul>
						<li class="ml10 mb20"><span class=""></span><em>채용공고열람</em></li> 
					</ul>
				</div> 
				<div class="goods goods_1">
				<table class="typeA">
				<colgroup><col width="130px"><col width="*"><col width="200px"><col width="60px"></colgroup>
				<tr class="zone1">
					<th><p class="zone"><img  alt="title" src="../images/tit/service_tit_10.gif"></p></th>
					<td class="content">
						<?php echo stripslashes($design['alba_open_content']);?>
					</td>
					<td class="price">
						<p class="priceSelect">
							<span class="today" id="etc_alba_today"><strong>오늘</strong> +</span>
							<select class="ipSelect2" title="신청기간" name="etc_alba_date" id="etc_alba_date" onchange="service_price_print('etc_alba',this);">
							<option value="">선택</option>
							<?php 
								foreach($etc_alba_service as $key => $val){ 
								$service_cnt = $val['service_cnt'];
								$service_unit = $service_control->_unit($val['service_unit']);
								$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
								$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price']."/".$val['etc_0']."/".$val['etc_1'];
								$service_text = $service_cnt . $service_unit;
							?>
							<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
							<?php } ?>
							</select>
							<div style="margin-top:5px; display:none;" id="etc_alba_price_info">
								<em class="mr5">
									<span class="price">0</span>원
									<span class="priceDc text_orange">0%</span>
								</em>
								<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
							</div>
						</p>
					</td>
					<td class="rbend">
						<a class="btnReg" href="javascript:serviceFrm_submit('etc_alba');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
					</td>
				</tr>
				</table>
				</div>
			</div> 
		</div>
		<!--  // 열람 서비스 --> 
		<?php } ?>

		<?php if($etc_sms['is_pay']){ ?>
		<!--  SMS 충전 서비스 --> 
		<div class="serviceListWrap num1 mb30 positionR">
			<h3 class="title">SMS 충전 서비스</h3>
			<div class="serviceBox  num1  positionR">
				<div class="resumBg clearfix">
					<ul>
						<li style="background:url(/images/tit/sms_service_bg.jpg) no-repeat 0 4px;"class="ml10 mb20"><span class=""></span><em>SMS충전</em></li> 
					</ul>
				</div> 
				<div class="goods goods_1">
				<table class="typeA">
				<colgroup><col width="130px"><col width="*"><col width="200px"><col width="60px"></colgroup>
				<tr class="zone1">
					<th><p class="zone"><img  alt="title" src="../images/tit/service_tit_13.gif"></p></th>
					<td class="content">
					<img class="pl5 pr5 vm"src="/images/main/blank2.gif">
						<?php echo stripslashes($design['etc_resume_sms_content']);?>
					</td>
					<td class="price">
						<p class="priceSelect">
							<select class="ipSelect2" title="신청기간" name="etc_sms_date" id="etc_sms_date" onchange="service_price_print('etc_sms',this);">
							<option value="">선택</option>
							<?php 
								foreach($etc_sms_service as $key => $val){ 
								$service_cnt = $val['service_cnt'];
								$service_unit = $service_control->_unit($val['service_unit']);
								$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
								$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price']."/".$val['etc_0']."/".$val['etc_1'];
								$service_text = number_format($service_cnt) . $service_unit;
							?>
							<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
							<?php } ?>
							</select>
							<div style="margin-top:5px; display:none;" id="etc_sms_price_info">
								<em class="mr5">
									<span class="price">0</span>원
									<span class="priceDc text_orange">0%</span>
								</em>
								<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
							</div>
						</p>
					</td>
					<td class="rbend">
						<a class="btnReg" href="javascript:serviceFrm_submit('etc_sms');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
					</td>
				</tr>
				</table>
				</div>
			</div> 
		</div>
		<!--  // SMS 충전 서비스 --> 
		<?php } ?>

		<input type="hidden" name="total_price" id="total_price"/>

		</form>

    </div>
    <!--  content end --> 

		<div class="total" style="display:;" id="totalPrice">
			<strong>최종 결제금액 : </strong>
			<span><strong class="sumTot text_orange" id="sumTotal_Price">0</strong><strong>원</strong></span> 
		</div>
		<input type="hidden" name="total_price" id="total_price"/>

		<!--  신청하기 버튼   --> 
		<div class="singleBtn clearfix" style="margin:30px auto;">
			<ul> 
			<li><div class="btn font_white bg_blueBlack"><a href="javascript:serviceFrm_submit();">신청하기<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right2.png" class="pb5"></a></div></li>
			</ul>
		</div>
		<!--  // 신청하기 버튼 -->  

  </div>
 </div>
</div>  
</section>

<?php
// 결제 정보
$get_pg = $payment_control->get_use_pg(1);
$pg_company = $get_pg['pg_company'];
if($pg_company == 'inicis') {
echo"
	<script language=javascript src=\"http://plugin.inicis.com/pay61_secuni_cross.js\"></script>
	<script language=javascript>
		StartSmartUpdate();
	</script>
";
}else if($pg_company == 'allthegate') {
echo"
	<script language=javascript src=\"http://www.allthegate.com/plugin/AGSWallet_utf8.js\"></script>
	<script language=javascript>
		StartSmartUpdate();
	</script>
";
}else if($pg_company == 'kcp') {
echo"
	<script type=\"text/javascript\" src=\"http://pay.kcp.co.kr/plugin/payplus_test_un.js\"></script>
	<script type=\"text/javascript\">	
		StartSmartUpdate();
	</script>
";
}
?>  
