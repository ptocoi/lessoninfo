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
var cycle_direction = "<?php echo $alba_option_logo_effects[1];?>";
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/alba_service.js"></script>

<section id="content" class="content_wrap clearfix">
	<div class="content1_wrap clearfix"> 
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<?php /* navigation */ ?>
	<div class="NowLocation mt20 clearfix">
		<p> <a href="/">HOME</a> >  <strong>서비스안내</strong> </p>
	</div>
	<?php /* //navigation */ ?>

	<div class="serviceGuideWrap mt10">
		<div class="serviceGuide mt30">
			<h2 class="skip">서비스안내</h2>
			<ul class="serviceGuideTab clearfix">
				<li class="tab1 on"><a href="#tab1">기업회원서비스</a></li>
				<!-- <li class="tab2 "><a onclick="" href="#tab2">개인회원서비스</a></li> -->
			</ul>

			<div class="serviceContentWrap" style="display:block;">
				<div class=" mb20 pb10 pt10 pl10 positionR"></div> 

				<form method="post" name="ServiceFrm" action="<?php echo $alice['company_path'];?>/alba_pay.php" id="ServiceFrm">
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
								$package_service = $service_control->package_service['employ'][$key]." ".$content['service_count'].$service_control->_unit($content['service_unit']);
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

				<?php if($main_platinum['is_pay']||$main_prime['is_pay']||$main_grand['is_pay']||$main_banner['is_pay']||$main_list['is_pay']){ ?>
				<!--  1st 메인 --> 
				<div class="serviceListWrap num1 mb30 positionR"  style="z-index:900;" id="main_service">
				<h3 class="title">메인페이지</h3>
				<div class="serviceBox  num1 positionR">
					<div class="captureCompany main">
						<?php if($main_platinum['is_pay']){ //  && $main_platinum_limit == false?>
						<a class="captureMain no1" href="javascript:service_preview('main_platinum');" style="top:52px; left:10px; width:160px; height:29px;"><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">플래티넘</em></a> 
						<?php } ?>
						<?php if($main_prime['is_pay']){ //  && $main_prime_limit == false?>
						<a class="captureMain no2" href="javascript:service_preview('main_prime');" style="top:87px; left:10px; width:160px; height:32px;"><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">프라임</em></a> 
						<?php } ?>
						<?php if($main_grand['is_pay']){ //  && $main_grand_limit == false?>
						<a class="captureMain no3" href="javascript:service_preview('main_grand');" style="top:125px; left:10px; width:160px; height:28px;"><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">그랜드</em></a> 
						<?php } ?>
						<?php if($main_banner['is_pay']){ //  && $main_banner_limit == false?>
						<a class="captureMain no4" href="javascript:service_preview('main_banner');" style="top:159px; left:10px; width:160px; height:21px;"><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">배너형</em></a> 
						<?php } ?>
						<?php if($main_list['is_pay']){ //  && $main_list_limit == false?>
						<a class="captureMain no5" href="javascript:service_preview('main_list');" style=" top:186px; left:10px; width:160px; height:36px;"><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">리스트형</em></a> 
						<?php } ?>
						<?php if($main_list['is_pay']){ //  && $main_list_limit == false?>
						<a class="captureMain no6" href="javascript:service_preview('main_list');" style="top:228px; left:10px; width:160px; height:54px;"><em class="positionA" style="right:-2px; bottom:-1px; width:85px;">일반 리스트형</em></a> 
						<?php } ?>
					</div>

					<!-- //상품미리보기 플래티넘 -->       
					<div class="goodsPreview positionA" style="display:none; top:65px; left:190px; width:231px;" id="main_platinum_preview"> 
						<h3 class=""><strong>상품 미리보기 :</strong>(플래티넘)</h3>
						<em class="positionA" style="top:5px; right:5px;">
							<a href="javascript:service_preview('main_platinum');"><img width="11" height="11" alt="닫기" src="../images/icon/icon_close3.gif"></a>
						</em>
						<div class="preViewWrap">

							<!-- 플래티넘// -->
							<div id="platinum" class="style1 border1 number5 color1 clearfix" style="display:block; width:191px; margin:0 auto;">
								<ul>
									<li class="bth">
									<dl>
										<dt>
											<a><span class="logo"><img width="106" height="42" alt="㈜logo" src="../images/basic/img_aniLogo.gif"></span><span class="logo_tit">㈜회사명</span></a> 
										</dt>
										<dd class="text1">
											<a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
										</dd>
										<dd class="text2">
											<span style="">서울 구로구</span>
											<span><em class="icon">월</em><em class="number">5,000,000</em>원</span>
										</dd>
									</dl>
									</li>
								</ul>
							</div>
							<!--  플래티넘(일반형) // -->

							<!-- 플래티넘(골드형)// -->
							<div id="platinum" class="pt5 style1 border1 number5 color1 clearfix" style="display:block; width:191px; margin:0 auto;">
								<ul>
									<li class="bth gold">
									<dl>
										<dt>
											<a><span class="logo"><img width="106" height="42" alt="㈜logo" src="../images/basic/img_aniLogo.gif"></span><span class="logo_tit">㈜회사명</span></a> 
										</dt>
										<dd class="text1">
											<a class="  ">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
										</dd>
										<dd class="text2">
											<span style="">서울 구로구</span>
											<span><em class="icon">월</em><em class="number">5,000,000</em>원</span>
										</dd>
									</dl>
									</li>
								</ul>
							</div>
							<!--  플래티넘(골드형) // -->

						</div>
					</div>
					<!-- 상품미리보기 플래티넘 // -->


					<!-- //상품미리보기 프라임 -->        
					<div class="goodsPreview positionA" style="display:none; top:95px; left:190px; width:279px;" id="main_prime_preview"> 
						<h3 class=""><strong>상품 미리보기 :</strong>(프라임)</h3>
						<em class="positionA" style="top:5px; right:5px;">
							<a href="javascript:service_preview('main_prime');"><img width="11" height="11" alt="닫기" src="../images/icon/icon_close3.gif"></a>
						</em>
						<div class="preViewWrap">

							<!-- 프라임// -->
							<div id="prime" class="style1 border1 number4 color1  clearfix" id="prime" style="display:block; width:239px; margin:0 auto;">
								<ul>
									<li class="bth">
									<dl>
										<dt>
											<a><span class="logo"><img width="106" height="42" alt="㈜logo" src="../images/basic/img_aniLogo.gif"></span><span class="logo_tit">㈜회사명</span></a> 
										</dt>
										<dd class="text1">
											<a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
										</dd>
										<dd class="text2">
											<span style="">서울 구로구</span>
											<span><em class="icon">월</em><em class="number">5,000,000</em>원</span>
										</dd>
									</dl>
									</li>
								</ul>
							</div>
							<!--  프라임(일반형) // -->
							
							<!-- 프라임(골드형)// -->
							<div id="prime" class="pt5 style1 border1 number4 color1  clearfix" id="prime" style="display:block; width:239px; margin:0 auto;">
								<ul>
									<li class="bth gold">
									<dl>
										<dt>
											<a><span class="logo"><img width="106" height="42" alt="㈜logo" src="../images/basic/img_aniLogo.gif"></span><span class="logo_tit">㈜회사명</span></a> 
										</dt>
										<dd class="text1">
											<a class="  ">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
										</dd>
										<dd class="text2">
											<span style="">서울 구로구</span>
											<span><em class="icon">월</em><em class="number">5,000,000</em>원</span>
										</dd>
									</dl>
									</li>
								</ul>
							</div>
							<!--  프라임(골드형) // -->

						</div>            
					</div>
					<!-- 상품미리보기 프라임 // -->


					<!-- //상품미리보기 그랜드 -->        
					<div class="goodsPreview positionA" style="display:none; top:115px; left:190px; width:199px;" id="main_grand_preview"> 
						<h3 class=""><strong>상품 미리보기 :</strong>(그랜드)</h3>
						<em class="positionA" style="top:5px; right:5px;">
							<a href="javascript:service_preview('main_grand');"><img width="11" height="11" alt="닫기" src="../images/icon/icon_close3.gif"></a>
						</em>
						<div class="preViewWrap">

							<!-- 그랜드// -->
							<div id="grand" class="style1 border1 number6 color1  clearfix" id="grand" style="display:block; width:159px; margin:0 auto;">
								<ul>
									<li class="bth">
									<dl>
										<dt>
											<a><span class="logo"><img width="106" height="42" alt="㈜logo" src="../images/basic/img_aniLogo.gif"></span><span class="logo_tit">㈜회사명</span>
											</a> 
										</dt>
										<dd class="text1">
											<a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
										</dd>
										<dd class="text2">
											<span style="">서울 구로구</span>
											<span><em class="icon">월</em><em class="number">5,000,000</em>원</span>
										</dd>
									</dl>
									</li>
								</ul>
							</div>
							<!--  그랜드(일반형) // -->

							<!-- 그랜드(골드형)// -->
							<div id="grand" class="pt5 style1 border1 number6 color1  clearfix" id="grand" style="display:block; width:159px; margin:0 auto;">
								<ul>
									<li class="bth gold">
									<dl>
										<dt>
											<a><span class="logo"><img width="106" height="42" alt="㈜logo" src="../images/basic/img_aniLogo.gif"></span><span class="logo_tit">㈜회사명</span></a> 
										</dt>
										<dd class="text1">
											<a class="  ">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
										</dd>
										<dd class="text2">
											<span style="">서울 구로구</span>
											<span><em class="icon">월</em><em class="number">5,000,000</em>원</span>
										</dd>
									</dl>
									</li>
								</ul>
							</div>
							<!--  그랜드(골드형) // -->

						</div>            
					</div>
					<!-- 상품미리보기 그랜드 // -->

					<!-- //상품미리보기 배너형 -->
					<div class="goodsPreview positionA" style="display:none; top:145px; left:190px; width:220px;" id="main_banner_preview"> 
						<h3 class=""><strong>상품 미리보기 : </strong>(배너형)</h3>
						<em class="positionA" style="top:5px; right:5px;">
							<a href="javascript:service_preview('main_banner');"><img width="11" height="11" alt="닫기" src="../images/icon/icon_close3.gif"></a>
						</em>
						<div class="preViewWrap">
							<!-- 배너형// -->
							<div id="box" class="style1 border1  number5 color1  clearfix" id="box" style="display:block; width:190px; margin:0 auto;">
								<ul>
									<li class="bth">
									<dl>
										<dt>
											<a><span class="logo_tit">㈜회사명</span></a> 
										</dt>
										<dd class="text1">
											<a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
										</dd>
										<dd class="text2">
											<span style="">서울 구로구</span>
											<span><em class="icon">월</em><em class="number">5,000,000</em>원</span>
										</dd>
									</dl>
									</li>
								</ul>
							</div>
							<!--  배너형(일반형) // -->

							<!-- 배너형(골드형)// -->
							<div id="box" class="pt5 style1 border1 number5 color1  clearfix" id="box" style="display:block; width:190px; margin:0 auto;">
								<ul>
									<li class="bth gold">
									<dl>
										<dt>
											<a><span class="logo_tit">㈜회사명</span></a> 
										</dt>
										<dd class="text1">
											<a class="  ">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
										</dd>
										<dd class="text2">
											<span style="">서울 구로구</span>
											<span><em class="icon">월</em><em class="number">5,000,000</em>원</span>
										</dd>
									</dl>
									</li>
								</ul>
							</div>
							<!--  배너형(골드형) // -->

						</div>            
					</div>
					<!-- 상품미리보기 배너형 // -->

					<!-- //상품미리보기 리스트형 -->        
					<div class="goodsPreview positionA" style="display:none; top:175px; left:190px; width:352px; z-index:500;" id="main_list_preview"> 
						<h3 class=""><strong>상품 미리보기 : </strong>(리스트형)</h3>
						<em class="positionA" style="top:5px; right:5px;">
							<a href="javascript:service_preview('main_list');"><img width="11" height="11" alt="닫기" src="../images/icon/icon_close3.gif"></a>
						</em>
						<div class="preViewWrap">
							
							<!-- 리스트형// -->
							<div style="display:block; width:312px; overflow:hidden; margin:0 auto;" id="list" class="style1  color1 mt30 clearfix" >
							<ul class="clearfix">  
								<li class="bth">
									<span style="" class="add">서울 구로구</span>
									<a><span class="logo_tit">㈜회사명</span></a> 
									<span class="text1"><img class="vm pr5" alt="HOT" src="../images/icon/icon_hot.gif"><a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집</a></span>
								</li>
								<li class="bth gold">
									<span style="" class="add">서울 구로구</span>
									<a><span class="logo_tit">㈜회사명</span></a> 
									<span class="text1"><span></span><a>함께할 성실한 인재모집</a></span>
								</li>
							</ul>
							</div>

						</div>
					</div> 
					<!-- 상품미리보기 리스트형 // -->

					<?php if($main_platinum['is_pay']){ // 메인 플래티넘  && $main_platinum_limit == false ?>
					<div class="goods goods_1">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone">
								<img  alt="title" src="../images/tit/tit_01.gif">
								<span class=" iconBooth"><img class="vm" alt="" width="29" height="16" src="../images/icon/icon_logoBox1.gif"> 로고형</span>
								<?php if($main_platinum_gold['is_pay']){ ?>
								<span class="pt3 iconGold"><img class="vm" alt="" width="35" height="16" src="../images/icon/icon_gold1.gif"> 신청가능</span>
								<?php } ?>
							</p>
						</th>
						<td class="content">
							<?php echo stripslashes($design['main_platinum_content']);?>
						</td>
						<td class="price">
						<?php if($main_platinum_limit){ ?>
							<p class="priceSelect">서비스 마감</p>
						<?php } else { ?>
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_platinum_date" id="main_platinum_date" onchange="service_price_print('main_platinum',this);">
								<option value="">선택</option>
								<?php 
									foreach($main_platinum_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="main_platinum_price_info">
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
							<a class="btnReg" href="javascript:<?php echo ($main_platinum_limit)?"serviceFrm_ended();":"serviceFrm_submit('main_platinum');";?>"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
					<?php } ?>

					<?php if($main_prime['is_pay']){ // 메인 프라임 ?>
					<div class="goods goods_2">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone">
								<img  alt="title" src="../images/tit/tit_02.gif">
								<span class=" iconBooth"><img class="vm" alt="" width="29" height="16" src="../images/icon/icon_logoBox1.gif"> 로고형</span>
								<?php if($main_prime_gold['is_pay']){ ?>
								<span class="pt3 iconGold"><img class="vm" alt="" width="35" height="16" src="../images/icon/icon_gold1.gif"> 신청가능</span>
								<?php } ?>
							</p>
						</th>
						<td class="content">
							<?php echo stripslashes($design['main_prime_content']);?>
						</td>
						<td class="price">
							<?php if($main_prime_limit){ ?>
								<p class="priceSelect">서비스 마감</p>
							<?php } else { ?>
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_prime_date" id="main_prime_date" onchange="service_price_print('main_prime',this);">
								<option value="">선택</option>
								<?php 
									foreach($main_prime_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="main_prime_price_info">
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
							<a class="btnReg" href="javascript:<?php echo ($main_prime_limit)?"serviceFrm_ended();":"serviceFrm_submit('main_prime');";?>"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
					<?php } ?>

					<?php if($main_grand['is_pay']){ // 메인 그랜드 ?>
					<div class="goods goods_3">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone">
								<img  alt="title" src="../images/tit/tit_03.gif">
								<span class=" iconBooth"><img class="vm" alt="" width="29" height="16" src="../images/icon/icon_logoBox1.gif"> 로고형</span>
								<?php if($main_grand_gold['is_pay']){ ?>
								<span class="pt3 iconGold"><img class="vm" alt="" width="35" height="16" src="../images/icon/icon_gold1.gif"> 신청가능</span>
								<?php } ?>
							</p>
						</th>
						<td class="content">
							<?php echo stripslashes($design['main_grand_content']);?>
						</td>
						<td class="price">
							<?php if($main_grand_limit){ ?>
								<p class="priceSelect">서비스 마감</p>
							<?php } else { ?>
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_grand_date" id="main_grand_date" onchange="service_price_print('main_grand',this);">
								<option value="">선택</option>
								<?php 
									foreach($main_grand_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="main_grand_price_info">
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
							<a class="btnReg" href="javascript:<?php echo ($main_grand_limit)?"serviceFrm_ended();":"serviceFrm_submit('main_grand');";?>"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
					<?php } ?>

					<?php if($main_banner['is_pay']){ // 메인 배너형 ?>
					<div class="goods goods_4">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone">
								<img  alt="title" src="../images/tit/tit_04.gif">
								<span class=" iconBooth"><img class="vm" alt="" width="29" height="16" src="../images/icon/icon_logoBox2.gif"> 박스형</span>
								<?php if($main_banner_gold['is_pay']){ ?>
								<span class="pt3 iconGold"><img class="vm" alt="" width="35" height="16" src="../images/icon/icon_gold1.gif"> 신청가능</span>
								<?php } ?>
							</p>
						</th>
						<td class="content">
							<?php echo stripslashes($design['main_banner_content']);?>
						</td>
						<td class="price">
							<?php if($main_banner_limit){ ?>
								<p class="priceSelect">서비스 마감</p>
							<?php } else { ?>
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_banner_date" id="main_banner_date" onchange="service_price_print('main_banner',this);">
								<option value="">선택</option>
								<?php 
									foreach($main_banner_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="main_banner_price_info">
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
							<a class="btnReg" href="javascript:<?php echo ($main_banner_limit)?"serviceFrm_ended();":"serviceFrm_submit('main_banner');";?>"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
					<?php } ?>

					<?php if($main_list['is_pay']){ // 메인 리스트형 ?>
					<div class="goods goods_5">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone">
								<img  alt="title" src="../images/tit/tit_05.gif">
								<span class=" iconBooth"><img class="vm" alt="" width="29" height="16" src="../images/icon/icon_logoBox3.gif"> 줄광고</span>
								<?php if($main_list_gold['is_pay']){ ?>
								<span class="pt3 iconGold"><img class="vm" alt="" width="35" height="16" src="../images/icon/icon_gold1.gif"> 신청가능</span>
								<?php } ?>
							</p>
						</th>
						<td class="content">
							<?php echo stripslashes($design['main_list_content']);?>
						</td>
						<td class="price">
							<?php if($main_list_limit){ ?>
								<p class="priceSelect">서비스 마감</p>
							<?php } else { ?>
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_list_date" id="main_list_date" onchange="service_price_print('main_list',this);">
								<option value="">선택</option>
								<?php 
									foreach($main_list_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="main_list_price_info">
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
							<a class="btnReg" href="javascript:<?php echo ($main_list_limit)?"serviceFrm_ended();":"serviceFrm_submit('main_list');";?>"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
					<?php } ?>

					<?php if($main_basic['is_pay']){ // 메인 일반리스트 ?>
					<div class="goods goods_5">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone">
								<img  alt="title" src="../images/tit/tit_08.gif">
								<span class=" iconBooth"><img class="vm" alt="" width="29" height="16" src="../images/icon/icon_logoBox3.gif"> 줄광고</span>
							</p>
						</th>
						<td class="content">
							<?php echo stripslashes($design['main_basic_content']);?>
						</td>
						<td class="price">
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="main_basic_date" id="main_basic_date" onchange="service_price_print('main_basic',this);">
								<option value="">선택</option>
								<?php 
									foreach($main_basic_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="main_basic_price_info">
									<em class="mr5">
										<span class="price">0</span>원
										<span class="priceDc text_orange">0%</span>
									</em>
									<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
								</div>
							</p>
						</td>
						<td class="rbend">
							<a class="btnReg" href="javascript:serviceFrm_submit('main_basic');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
					<?php } ?>

				</div> 
			</div>
			<!--  1st 메인 end -->
			<?php } ?>

			<?php if($alba_platinum['is_pay']||$alba_banner['is_pay']||$alba_list['is_pay']){?>
			<!--  2st 채용메인 --> 
			<div class="serviceListWrap num1 mb30 positionR" style="z-index:800;" id="alba_service">
				<h3 class="title">채용공고 메인</h3>
				<div class="serviceBox  num1 positionR">
					<div class="captureCompany sub1">
						<?php if($alba_platinum['is_pay']){ //  && $alba_platinum_limit == false?>
						<a class="captureSub1 no1" style="top:157px; left:40px; width:130px; height:18px;" href="javascript:service_preview('alba_platinum');"><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">플래티넘</em></a> 
						<?php } ?>
						<?php if($alba_banner['is_pay']){ //  && $alba_banner_limit == false?>
						<a class="captureSub1 no2" style="top:181px; left:40px; width:130px; height:18px;" href="javascript:service_preview('alba_banner');"><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">배너형</em></a> 
						<?php } ?>
						<?php if($alba_list['is_pay']){ //  && $alba_list_limit == false?>
						<a class="captureSub1 no3" style="top:205px; left:40px; width:130px; height:37px;" href="javascript:service_preview('alba_list');"><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">리스트형</em></a> 
						<?php } ?>
						<?php if($alba_list['is_pay']){ //  && $alba_list_limit == false?>
						<a class="captureSub1 no4" style="top:248px; left:40px; width:130px; height:70px;" href="javascript:service_preview('alba_list');"><em class="positionA" style="right:-2px; bottom:-1px; width:85px;">일반 리스트형</em></a> 
						<?php } ?>
					</div> 

					<!-- //상품미리보기 플래티넘 -->       
					<div class="goodsPreview positionA" style="display:none; top:65px; left:190px; width:231px;" id="alba_platinum_preview"> 
						<h3 class=""><strong>상품 미리보기 :</strong>(플래티넘)</h3>
						<em class="positionA" style="top:5px; right:5px;">
							<a href="javascript:service_preview('alba_platinum');"><img width="11" height="11" alt="닫기" src="../images/icon/icon_close3.gif"></a>
						</em>
						<div class="preViewWrap">

							<!-- 플래티넘// -->
							<div class="style1 border1 number5 color1  clearfix" id="platinum" style="display:block; width:191px; margin:0 auto;">
								<ul>
									<li class="bth">
									<dl>
										<dt>
											<a><span class="logo"><img width="106" height="42" alt="㈜logo" src="../images/basic/img_aniLogo.gif"></span><span class="logo_tit">㈜회사명</span></a> 
										</dt>
										<dd class="text1">
											<a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
										</dd>
										<dd class="text2">
											<span style="">서울 구로구</span>
											<span><em class="icon">월</em><em class="number">5,000,000</em>원</span>
										</dd>
									</dl>
									</li>
								</ul>
							</div> 
							<!--  플래티넘(일반형) // -->
		
							<!-- 플래티넘(골드형)// -->
							<div class="pt5 style1 border1 number5 color1  clearfix" id="platinum" style="display:block; width:191px; margin:0 auto;">
								<ul>
									<li class="bth gold">
									<dl>
										<dt>
											<a><span class="logo"><img width="106" height="42" alt="㈜logo" src="../images/basic/img_aniLogo.gif"></span><span class="logo_tit">㈜회사명</span></a> 
										</dt>
										<dd class="text1">
											<a class="  ">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
										</dd>
										<dd class="text2">
											<span style="">서울 구로구</span>
											<span><em class="icon">월</em><em class="number">5,000,000</em>원</span>
										</dd>
									</dl>
									</li>
								</ul>
							</div>
							<!--  플래티넘(골드형) // -->

						</div>            
					</div> 
					<!-- 상품미리보기 플래티넘 // -->


					<!-- //상품미리보기 배너형 -->         
					<div class="goodsPreview positionA" style="display:none; top:95px; left:190px; width:220px;" id="alba_banner_preview"> 
						<h3 class=""><strong>상품 미리보기 : </strong>(배너형)</h3>
						<em class="positionA" style="top:5px; right:5px;">
							<a href="javascript:service_preview('alba_banner');"><img width="11" height="11" alt="닫기" src="../images/icon/icon_close3.gif"></a>
						</em>
						<div class="preViewWrap">

							<!-- 배너형// -->
							<div class="style1 border1  number5 color1  clearfix" id="box" style="display:block; width:190px; margin:0 auto;">
								<ul>
									<li class="bth">
									<dl>
										<dt>
											<a><span class="logo_tit">㈜회사명</span></a> 
										</dt>
										<dd class="text1">
											<a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
										</dd>
										<dd class="text2">
											<span style="">서울 구로구</span>
											<span><em class="icon">월</em><em class="number">5,000,000</em>원</span>
										</dd>
									</dl>
									</li>
								</ul>
							</div>
							<!--  배너형(일반형) // -->

							<!-- 배너형(골드형)// -->
							<div class="pt5 style1 border1 number5  color1  clearfix" id="box" style="display:block; width:190px; margin:0 auto;">
								<ul>
									<li class="bth gold">
									<dl>
										<dt>
											<a><span class="logo_tit">㈜회사명</span></a> 
										</dt>
										<dd class="text1">
											<a class="  ">함께할 성실한 인재모집 <span class="edy edyEn">~06/14</span></a>
										</dd>
										<dd class="text2">
											<span style="">서울 구로구</span>
											<span><em class="icon">월</em><em class="number">5,000,000</em>원</span>
										</dd>
									</dl>
									</li>
								</ul>
							</div> 
							<!--  배너형(골드형) // -->

						</div>            
					</div> <!-- 상품미리보기 배너형 // -->

					<!-- //상품미리보기 리스트형 -->        
					<div class="goodsPreview positionA" style="display:none; top:115px; left:190px; width:352px;" id="alba_list_preview"> 
						<h3 class=""><strong>상품 미리보기 : </strong>(리스트형)</h3>
						<em class="positionA" style="top:5px; right:5px;">
							<a href="javascript:service_preview('alba_list');"><img width="11" height="11" alt="닫기" src="../images/icon/icon_close3.gif"></a>
						</em>
						<div class="preViewWrap">
							
							<!-- 리스트형// -->
							<div style="display:block; width:312px; overflow:hidden; margin:0 auto;" id="list" class="style1  color1 mt30 clearfix" >
								<ul class="clearfix">  
									<li class="bth">
										<span style="" class="add">서울 구로구</span>
										<a><span class="logo_tit">㈜회사명</span></a> 
										<span class="text1"><img class="vm pr5" alt="HOT" src="../images/icon/icon_hot.gif"><a class="opt_color1 opt_bold opt_pen2">함께할 성실한 인재모집</a></span>
									</li>
									<li class="bth gold">
										<span style="" class="add">서울 구로구</span>
										<a><span class="logo_tit">㈜회사명</span></a> 
										<span class="text1"><span></span><a>함께할 성실한 인재모집</a></span>
									</li>
								</ul>
							</div>
							<!-- 리스트형// -->

						</div>            
					</div>
					<!-- 상품미리보기 리스트형 // -->

					<?php if($alba_platinum['is_pay']){ // 서브 플래티넘 ?>
					<div class="goods goods_1">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone">
								<img  alt="title" src="../images/tit/tit_01.gif">
								<span class=" iconBooth"><img class="vm" alt="" width="29" height="16" src="../images/icon/icon_logoBox1.gif"> 로고형</span>
								<?php if($alba_platinum_gold['is_pay']){ ?>
								<span class="pt3 iconGold"><img class="vm" alt="" width="35" height="16" src="../images/icon/icon_gold1.gif"> 신청가능</span>
								<?php } ?>
							</p>						
						</th>
						<td class="content">
							<?php echo stripslashes($design['sub_platinum_content']);?>
						</td>
						<td class="price">
							<?php if($alba_platinum_limit){ ?>
								<p class="priceSelect">서비스 마감</p>
							<?php } else { ?>
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_platinum_date" id="alba_platinum_date" onchange="service_price_print('alba_platinum',this);">
								<option value="">선택</option>
								<?php 
									foreach($alba_platinum_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="alba_platinum_price_info">
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
							<a class="btnReg" href="javascript:<?php echo ($alba_platinum_limit)?"serviceFrm_ended();":"serviceFrm_submit('alba_platinum');";?>"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
					<?php } ?>

					<?php if($alba_banner['is_pay']){ // 서브 배너형 ?>
					<div class="goods goods_4">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone">
								<img  alt="title" src="../images/tit/tit_04.gif">
								<span class=" iconBooth"><img class="vm" alt="" width="29" height="16" src="../images/icon/icon_logoBox2.gif"> 박스형</span>
								<?php if($alba_banner_gold['is_pay']){ ?>
								<span class="pt3 iconGold"><img class="vm" alt="" width="35" height="16" src="../images/icon/icon_gold1.gif"> 신청가능</span>
								<?php } ?>
							</p>
						</th>
						<td class="content">
							<?php echo stripslashes($design['sub_banner_content']);?>
						</td>
						<td class="price">
							<?php if($alba_banner_limit){ ?>
								<p class="priceSelect">서비스 마감</p>
							<?php } else { ?>
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_banner_date" id="alba_banner_date" onchange="service_price_print('alba_banner',this);">
								<option value="">선택</option>
								<?php 
									foreach($alba_banner_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="alba_banner_price_info">
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
							<a class="btnReg" href="javascript:<?php echo ($alba_banner_limit)?"serviceFrm_ended();":"serviceFrm_submit('alba_banner');";?>"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
					<?php } ?>

					<?php if($alba_list['is_pay']){ // 서브 리스트형 ?>
					<div class="goods goods_5">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone">
								<img  alt="title" src="../images/tit/tit_05.gif">
								<span class=" iconBooth"><img class="vm" alt="" width="29" height="16" src="../images/icon/icon_logoBox3.gif"> 줄광고</span>
								<?php if($alba_list_gold['is_pay']){ ?>
								<span class="pt3 iconGold"><img class="vm" alt="" width="35" height="16" src="../images/icon/icon_gold1.gif"> 신청가능</span>
								<?php } ?>
							</p>
						</th>
						<td class="content">
							<?php echo stripslashes($design['sub_list_content']);?>
						</td>
						<td class="price">
							<?php if($alba_list_limit){ ?>
								<p class="priceSelect">서비스 마감</p>
							<?php } else { ?>
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_list_date" id="alba_list_date" onchange="service_price_print('alba_list',this);">
								<option value="">선택</option>
								<?php 
									foreach($alba_list_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="alba_list_price_info">
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
							<a class="btnReg" href="javascript:<?php echo ($alba_list_limit)?"serviceFrm_ended();":"serviceFrm_submit('alba_list');";?>"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
					<?php 
						} else { // 리스트형 무료 서비스 기간 
							if($alba_etc_0[0]){	 // 서비스 기간이 있을때
					?>
							<input type="hidden" name="alba_list_service" value="<?php echo $alba_list['etc_0'];?>"/>
					<?php 
							}
						} // 서브 리스트형 끝.
					?>

					<?php if($alba_basic['is_pay']){ // 서브 리스트형 ?>
					<div class="goods goods_5">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone">
								<img  alt="title" src="../images/tit/tit_08.gif">
								<span class=" iconBooth"><img class="vm" alt="" width="29" height="16" src="../images/icon/icon_logoBox3.gif"> 줄광고</span>
							</p>
						</th>
						<td class="content">
							<?php echo stripslashes($design['sub_basic_content']);?>
						</td>
						<td class="price">
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_basic_date" id="alba_basic_date" onchange="service_price_print('alba_basic',this);">
								<option value="">선택</option>
								<?php 
									foreach($alba_basic_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="alba_basic_price_info">
									<em class="mr5">
										<span class="price">0</span>원
										<span class="priceDc text_orange">0%</span>
									</em>
									<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
								</div>
							</p>
						</td>
						<td class="rbend">
							<a class="btnReg" href="javascript:<?php echo ($alba_basic_limit)?"serviceFrm_ended();":"serviceFrm_submit('alba_basic');";?>"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
					<?php } // 서브 리스트형 끝. ?>

				</div>
			</div>
			<!--  2st 채용메인 end -->
			<?php } ?>

			<?php if($alba_option_busy['is_pay']){ // 알바 급구 옵션 ?>
			<!--  급구상품 -->
			<div class="serviceListWrap num1 mb30 positionR" id="busy_option">
				<h3 class="title">급구 상품</h3>
				<div class="serviceBox  num1  positionR">
					<div class="wanted clearfix">
						<ul>
							<li class="mt20  ml10">
								<span><img class="vm pr5" src="<?php echo $alba_option_busy_icon;?>" alt="급구">사무보조 사원모집</span><em>급구</em>
							</li> 
						</ul>
					</div> 

					<div class="goods goods_1">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone"><img  alt="title" src="../images/tit/service_tit_09.gif"></p>
						</th>
						<td class="content">
							<?php echo stripslashes($design['main_busy_content']);?>
						</td>
						<td class="price">
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_option_busy_date" id="alba_option_busy_date" onchange="service_price_print('alba_option_busy',this);">
								<option value="">선택</option>
								<?php 
									foreach($alba_option_busy_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="alba_option_busy_price_info">
									<em class="mr5">
										<span class="price">0</span>원
										<span class="priceDc text_orange">0%</span>
									</em>
									<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
								</div>
							</p>
						</td>
						<td class="rbend">
							<a class="btnReg" href="javascript:serviceFrm_submit('alba_option_busy');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>

					</div>
				</div> 
			</div>
			<!-- 급구 상품 end --> 
			<?php } ?>

			<?php if($alba_option_logo['is_pay']){ // 알바 로고강조 옵션 ?>
			<!--  로고강조옵션 상품
			<div class="serviceListWrap num1 mb30 positionR" id="logo_option">
				<h3 class="title">로고강조옵션 상품</h3>
				<div class="serviceBox  num1  positionR">
					<div class="fLogo clearfix">
						<ul>
							<li class="ml10 mb20"><span class=""></span><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">로고강조</em></li> 
						</ul>
					</div> 
					<div class="goods goods_1">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone"><img  alt="title" src="../images/tit/service_tit_01.gif"></p>
						</th>
						<td class="content">
							<ul>
								<li class="loca"><span><strong class="text_blue3">로고형 채용공고에서 로고에 강조효과</strong></span></li>
								<li class="free"><span>로고형 채용공고에만 적용가능</span></li>
							</ul>	
							
							<div class="boxFlogo ml10 mt10 ">
								<span>
									<input type="radio" class="chk" name="alba_option_logo" value="0" id="alba_option_logo_0" checked>
									<label for="">
										<img class="vm fade_image" width="72" height="26" alt="반짝로고1" src="../images/basic/img_aniLogo.gif">
									</label>
								</span>
								<span>
									<input type="radio" class="chk" name="alba_option_logo" id="1" value="alba_option_logo_1">
									<label for="">
										<img class="vm blink_image" width="72" height="26" alt="반짝로고2" src="../images/basic/img_aniLogo.gif">
									</label>
								</span>
								<span>
									<input type="radio" class="chk" name="alba_option_logo" id="2" value="alba_option_logo_2">
									<label for="">
										<div style="float:right;margin-left:5px;" class="slide_image">
											<img src="../images/basic/img_aniLogo.gif" width="72" height="26"/>
											<img src="../images/basic/img_aniLogo.gif" width="72" height="26"/>
										</div>
									</label>
								</span>
							</div>

						</td>
						<td class="price">
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_option_logo_date" id="alba_option_logo_date" onchange="service_price_print('alba_option_logo',this);">
								<option value="">선택</option>
								<?php 
									foreach($alba_option_logo_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>

								<span style="display:none;" id="alba_option_logo_price_info">
									<span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong>
									<span class="won positionR">원
										<em class="positionA" style="top:-21px; right:0;">
											<span class="price">0</span>원
											<span class="priceDc text_orange">0%</span>
										</em>
									</span>
								</span>
							</p>
						</td>
						<td class="rbend">
							<a class="btnReg" href="javascript:serviceFrm_submit('alba_option_logo');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
				</div> 
			</div>
			로고강조옵션 상품 end --> 
			<?php } ?>

			<?php if($alba_option_neon['is_pay']||$alba_option_bold['is_pay']||$alba_option_icon['is_pay']||$alba_option_color['is_pay']||$alba_option_blink['is_pay']){ ?>
			<!--  3st 강조효과 --> 
			<div class="serviceListWrap num1 mb30 positionR" id="alba_option">
				<h3 class="title">강조옵션 상품</h3>
				<div class="serviceBox  num1 positionR">
					<div class="option clearfix">
						<ul>
							<?php if($alba_option_neon['is_pay']){ ?>
							<li class="ml10" style="margin-top:25px; margin-bottom:50px;"><span class="pl5 neon_preview" style="background:#<?php echo $alba_option_neon_color[0];?>;">사무보조 사원모집</span><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">형광펜</em></li> 
							<?php } ?>
							<?php if($alba_option_bold['is_pay']){ ?>
							<li class="ml10 "style="margin-bottom:60px;"><span class="opt_bold">사무보조 사원모집</span><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">굵은글자</em></li> 
							<?php } ?>
							<?php if($alba_option_icon['is_pay']){ ?>
							<li class="ml10" style="margin-bottom:60px;"><span><img class="vm pr5 icon_preview" alt="HOT" src="<?php echo $alice['data_icon_path']."/".$alba_option_icon_list[0]['name'];?>">사무보조 사원모집</span><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">아이콘</em></li> 
							<?php } ?>
							<?php if($alba_option_color['is_pay']){ ?>
							<li class="ml10" style="margin-bottom:45px;"><span class="color_preview" style="color:#<?php echo $alba_option_colors[0];?>;">사무보조 사원모집</span><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">글자색</em></li> 
							<?php } ?>
							<?php if($alba_option_blink['is_pay']){ ?>
							<li class="ml10"><span class="jumble">사무보조 사원모집</span><em class="positionA" style="right:-2px; bottom:-1px; width:55px;">반짝칼라</em></li> 
							<?php } ?>
						</ul>
					</div> 

					<?php if($alba_option_neon['is_pay']){ // 형광펜 옵션 서비스 ?>
					<div class="goods goods_1">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone"><img  alt="title" src="../images/tit/service_tit_02.gif"></p>
						</th>
						<td class="content">
							<ul>
								<li class=""><span class="neon_preview" style="background:#<?php echo $alba_option_neon_color[0];?>;">채용공고 리스트 제목을 형광펜 강조 효과</span></li>
							</ul>
							<div class="boxRadio bg_blue2 ml10 mt10 pl10 pt5 pb5"><strong>칼라선택:</strong>
							<?php for($i=0;$i<$alba_option_neon_color_cnt;$i++){ ?>
								<span class="">
									<input type="radio" name="alba_option_neon" id="alba_option_neon_<?php echo $i;?>" value="<?php echo $alba_option_neon_color[$i];?>" class="chk" <?php echo ($i==0)?'checked':'';?> onclick="option_neon_sel(this);">
									<label for="alba_option_neon_<?php echo $i;?>" style="color:#fff; background:#<?php echo $alba_option_neon_color[$i];?>;">형광펜</label>
								</span>
							<?php } ?>
							</div>
						</td>
						<td class="price">
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_option_neon_date" id="alba_option_neon_date" onchange="service_price_print('alba_option_neon',this);">
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
								<div style="margin-top:5px; display:none;" id="alba_option_neon_price_info">
									<em class="mr5">
										<span class="price">0</span>원
										<span class="priceDc text_orange">0%</span>
									</em>
									<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
								</div>
							</p>
						</td>
						<td class="rbend">
							<a class="btnReg" href="javascript:serviceFrm_submit('alba_option_neon');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
						</tr>
					</table>
					</div>
					<?php } ?>

					<?php if($alba_option_bold['is_pay']){ // 굵은글자 옵션 서비스 ?>
					<div class="goods goods_2">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone"><img  alt="title" src="../images/tit/service_tit_03.gif"></p>
						</th>
						<td class="content">
							<ul>
								<li class="item_bold"><span class="opt_bold">채용공고 리스트 제목을 굵은 글자로 강조 효과</span></li>
							</ul>
						</td>
						<td class="price">
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_option_bold_date" id="alba_option_bold_date" onchange="service_price_print('alba_option_bold',this);">
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
								<div style="margin-top:5px; display:none;" id="alba_option_bold_price_info">
									<em class="mr5">
										<span class="price">0</span>원
										<span class="priceDc text_orange">0%</span>
									</em>
									<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
								</div>
							</p>
						</td>
						<td class="rbend">
							<a class="btnReg" href="javascript:serviceFrm_submit('alba_option_bold');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
					<?php } ?>

					<?php if($alba_option_icon['is_pay']){ // 아이콘 옵션 서비스 && $alba_list_limit == false ?>
					<div class="goods goods_3">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone"><img  alt="title" src="../images/tit/service_tit_05.gif"></p>
						</th>
						<td class="content">
							<ul>
								<li class="opt_icon"><span class="">채용공고 리스트 제목 앞을 아이콘으로 강조 효과</span></li>
							</ul>
							<div class="boxIcon ml10 mt10  pt5 pb5">
							<?php foreach($alba_option_icon_list as $key => $val){ ?>
								<span style="padding-right:22px;"><input type="radio" name="alba_option_icon" id="alba_option_icon_<?php echo $key;?>" value="<?php echo $val['no'];?>" class="chk" <?php echo ($key==0)?'checked':'';?> onclick="option_icon_sel('<?php echo $val['name'];?>');"><label for="alba_option_icon_<?php echo $key;?>"><img src="<?php echo $alice['data_icon_path']."/".$val['name'];?>"></label></span>
							<?php } // icon list foreach end. ?>
							</div>
						</td>
						<td class="price">
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_option_icon_date" id="alba_option_icon_date" onchange="service_price_print('alba_option_icon',this);">
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
								<div style="margin-top:5px; display:none;" id="alba_option_icon_price_info">
									<em class="mr5">
										<span class="price">0</span>원
										<span class="priceDc text_orange">0%</span>
									</em>
									<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
								</div>
							</p>
						</td>
						<td class="rbend">
							<a class="btnReg" href="javascript:serviceFrm_submit('alba_option_icon');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
					<?php } ?>

					<?php if($alba_option_color['is_pay']){ // 글자색 옵션 서비스 ?>
					<div class="goods goods_4">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone"><img  alt="title" src="../images/tit/service_tit_04.gif"></p>
						</th>
						<td class="content">
							<ul>
								<li class="item_color"><span class="color_preview" style="color:#<?php echo $alba_option_colors[0];?>;">채용공고 리스트 제목을 글자색으로 강조 효과</span></li>
							</ul>
							<div class="boxRadio bg_blue2 ml10 mt10 pl10 pt5 pb5"><strong>칼라선택:</strong>
							<?php for($i=0;$i<$alba_option_colors_cnt;$i++){?>
								<span class=""><input type="radio" name="alba_option_color" id="alba_option_color_<?php echo $i;?>" value="<?php echo $alba_option_colors[$i];?>" class="chk" <?php echo ($i==0)?'checked':'';?> onclick="option_color_sel(this);"><label for="alba_option_color_<?php echo $i;?>" style="color:#<?php echo $alba_option_colors[$i];?>"> 글자색</label>&nbsp;</span>
							<?php } ?>
							</div>
						</td>
						<td class="price">
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_option_color_date" id="alba_option_color_date" onchange="service_price_print('alba_option_color',this);">
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
								<div style="margin-top:5px; display:none;" id="alba_option_color_price_info">
									<em class="mr5">
										<span class="price">0</span>원
										<span class="priceDc text_orange">0%</span>
									</em>
									<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
								</div>
							</p>
						</td>
						<td class="rbend">
							<a class="btnReg" href="javascript:serviceFrm_submit('alba_option_color');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
					<?php } ?>

					<?php if($alba_option_blink['is_pay']){ // 반짝칼라 옵션 서비스 ?>
					<div class="goods goods_5">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone">
							<img  alt="title" src="../images/tit/service_tit_06.gif">
							<!--<span class="pt3 iconGold"><img class="vm" alt="" width="35" height="16" src="../images/icon/icon_gold1.gif"> 신청가능</span>-->
							</p>
						</th>
						<td class="content">
							<ul>
								<li class="item_anicolor"><span class="jumble">채용공고 리스트 제목을 빤짝컬러 강조 효과</span></li>
							</ul>
						</td>
						<td class="price">
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_option_blink_date" id="alba_option_blink_date" onchange="service_price_print('alba_option_blink',this);">
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
								<div style="margin-top:5px; display:none;" id="alba_option_blink_price_info">
									<em class="mr5">
										<span class="price">0</span>원
										<span class="priceDc text_orange">0%</span>
									</em>
									<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
								</div>
							</p>
						</td>
						<td class="rbend">
							<a class="btnReg" href="javascript:serviceFrm_submit('alba_option_blink');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
					<?php } ?>

				</div> 
			</div>
			<!--  3st 강조효과 end --> 
			<?php } ?>

			<?php if($alba_option_jump['is_pay']){ // 점프 옵션 서비스 ?>
			<!--  점프 서비스 상품 --> 
			<div class="serviceListWrap num1 mb30 positionR" id="jump_option">
				<h3 class="title">점프 서비스</h3>
				<div class="serviceBox  num1  positionR">
					<div class="jump clearfix">
						<ul><li class="ml10 mb20"><span class=""></span><em>점프서비스</em></li> </ul>
					</div> 
					<div class="goods goods_1">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone"><img  alt="title" src="../images/tit/service_tit_08.gif"></p>
						</th>
						<td class="content">
							<?php echo stripslashes($design['alba_jump_content']);?>
						</td>
						<td class="price">
							<p class="priceSelect">
								<span class="today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="alba_option_jump_date" id="alba_option_jump_date" onchange="service_price_print('alba_option_jump',this);">
								<option value="">선택</option>
								<?php 
									foreach($alba_option_jump_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="alba_option_jump_price_info">
									<em class="mr5">
										<span class="price">0</span>원
										<span class="priceDc text_orange">0%</span>
									</em>
									<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
								</div>
							</p>
						</td>
						<td class="rbend">
							<a class="btnReg" href="javascript:serviceFrm_submit('alba_option_jump');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
				</div> 
			</div>
			<!--  점프 서비스 상품 end --> 
			<?php } ?>

			<?php if($etc_open['is_pay']){ // 이력서 열람 서비스 ?>
			<!--  이력서열람 --> 
			<div class="serviceListWrap num1 mb30 positionR" id="etc_open">
				<h3 class="title">이력서 열람 서비스</h3>
				<div class="serviceBox  num1  positionR">
					<div class="resumBg clearfix">
						<ul><li class="ml10 mb20"><span class=""></span><em>이력서열람</em></li> </ul>
					</div> 
					<div class="goods goods_1">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone"><img  alt="title" src="../images/tit/service_tit_07.gif"></p>
						</th>
						<td class="content">
							<?php echo stripslashes($design['resume_open_content']);?>
						</td>
						<td class="price">
							<p class="priceSelect">
								<span class="today" id="etc_open_today"><strong>오늘</strong> +</span>
								<select class="ipSelect2" title="신청기간" name="etc_open_date" id="etc_open_date" onchange="service_price_print('etc_open',this);">
								<option value="">선택</option>
								<?php 
									foreach($etc_open_service as $key => $val){ 
									$service_cnt = $val['service_cnt'];
									$service_unit = $service_control->_unit($val['service_unit']);
									$service_discount = $service_control->service_discount($val['service_price'],$val['service_percent']);	// 할인정보
									$service_val = $service_cnt."/".$val['service_unit']."/".$val['service_price']."/".$val['service_percent']."/".$service_discount['total_price']."/".$val['etc_0']."/".$val['etc_1'];
									$service_text = $service_cnt . $service_unit;
								?>
								<option value="<?php echo $service_val;?>" price="<?php echo $service_discount['total_price'];?>"><?php echo $service_text;?></option>
								<?php } ?>
								</select>
								<div style="margin-top:5px; display:none;" id="etc_open_price_info">
									<em class="mr5">
										<span class="price">0</span>원
										<span class="priceDc text_orange">0%</span>
									</em>
									<span style="display:block"><span>=</span> <strong class="pay pl5"><span class="text_orange">0</span></strong><span class="won positionR"> 원</span></span>
								</div>
							</p>
						</td>
						<td class="rbend">
							<a class="btnReg" href="javascript:serviceFrm_submit('etc_open');"><img class="vm" alt="신청하기" width="70" height="56" src="../images/basic/btn_reg1.gif"></a>
						</td>
					</tr>
					</table>
					</div>
				</div> 
			</div>
			<!--  이력서열람 end --> 
			<?php } ?>

			<?php if($etc_sms['is_pay']){ // SMS 충전 서비스 ?>
			<!--  SMS 충전--> 
			<div class="serviceListWrap num1 mb30 positionR" id="etc_open">
				<h3 class="title">SMS 충전 서비스</h3>
				<div class="serviceBox  num1  positionR">
					<div class="resumBg clearfix">
						<ul><li style="background:url(/images/tit/sms_service_bg.jpg) no-repeat 0 4px;"class="ml10 mb20"><span class=""></span><em>SMS충전</em></li> </ul>
					</div> 
					<div class="goods goods_1">
					<table class="typeA">
					<colgroup><col width="130px"><col><col width="200px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone"><img  alt="title" src="../images/tit/service_tit_13.gif"></p>
						</th>
						<td class="content">
							<img class="pl5 pr5 vm"src="/images/main/blank2.gif">
							<?php echo stripslashes($design['etc_alba_sms_content']);?>
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
			<!--  SMS 충전 end --> 
			<?php } ?>

			<?php /* ?>
			<div class="total" style="display:;" id="totalPrice">
				<strong>최종 결제금액 : </strong>
				<span><strong class="sumTot text_orange" id="sumTotal_Price">0</strong><strong>원</strong></span> 
			</div>
			<input type="hidden" name="total_price" id="total_price"/>
			<?php */ ?>

			</form>

			</div>

			<!--  신청하기 버튼   --> 
			<div class="singleBtn clearfix" style="margin:30px auto;">
				<ul> 
				<li>
					<div class="btn font_white bg_blueBlack fl mr5"><a href="javascript:serviceFrm_submit();">서비스 신청하기<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right2.png" class="pb5"></a></div>
					<?php /* ?><div class="btn font_gray bg_white fl" style="color:#474747;"><a href="<?php echo $alice['company_path'];?>/alba_list.php">무료등록<img class="pb5" width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png"></a></div><?php */ ?>
				</li>
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