<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<script type="text/javascript" src="<?php echo $alice['individual_path'];?>/skins/default/open_service.skin.js"></script>


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

			<form method="post" name="ServiceFrm" action="<?php echo $alice['member_path'];?>/sms_pay.php" id="ServiceFrm">
			<input type="hidden" name="mode" value="service_pay" id="service_mode"/>
			<input type="hidden" name="sel_service" value="etc_sms"/>

			<!--  이력서열람 --> 
			<div class="serviceListWrap num1 mb30 positionR" id="etc_sms">
				<h3 class="title">SMS 충전 서비스</h3>
				<div class="serviceBox  num1  positionR">
					<div class="resumBg clearfix">
						<ul><li class="ml10 mb20"><span class=""></span><em>SMS 충전</em></li> </ul>
					</div> 
					<div class="goods goods_1">
					<table class="typeA">
					<colgroup><col width="115px"><col width="*"><col width="220px"><col width="60px"></colgroup>
					<tr class="zone1">
						<th>
							<p class="zone"><img  alt="title" src="../images/tit/service_tit_10.gif"></p>
						</th>
						<td class="content">
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
			<!--  이력서열람 end --> 
			<input type="hidden" name="total_price" id="total_price"/>
			</form>

		</div>

	</div>

	</div>
	</div>  
</section>