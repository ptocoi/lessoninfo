<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var pg_company = "<?php echo $pg_company;?>";
var sel_service = "<?php echo $sel_service;?>";
var sel_service_price = Number("<?php echo $post_total_price;?>");
var mid = "<?php echo $mid;?>";
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/sms_pay.skin.js"></script>

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
		<input type="hidden" name="pay_method" id="pay_method"/>
		<input type="hidden" name="pay_type" value="etc_sms" id="pay_type"/>

			<!--  결제하기   --> 
			<div id="listForm" class="mainTopBorder positionR mt30 clearfix">
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
				
					<?php if($etc_sms_date){ // SMS 충전 서비스 ?>
					<input type="hidden" name="<?php echo $sel_service;?>_date" value="<?php echo $_POST[$sel_service."_date"];?>"/>
					<tr id="etc_sms">
						<td class="tc"  height="50"><span><strong>SMS 충전 서비스</strong></span></td>
						<td class="tl">
							<span><?php echo number_format($etc_sms_dates[0]).$service_control->_unit($etc_sms_dates[1]);?> </span>
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