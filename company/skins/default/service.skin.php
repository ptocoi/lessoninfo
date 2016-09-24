<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var mode = "<?php echo $mode;?>";
var pay_sdate = [];
<?php if($pay_sdate){
	for($i=0;$i<$pay_sdate_cnt;$i++){
?>
pay_sdate.push("<?php echo $pay_sdate[$i];?>");
<?php 
	}
} else { 
?>
var pay_sdate = [];
<?php } ?>

var pay_edate = [];
<?php if($pay_edate){
	for($i=0;$i<$pay_edate_cnt;$i++){
?>
pay_edate.push("<?php echo $pay_edate[$i];?>");
<?php 
	}
} else { 
?>
var pay_edate = [];
<?php } ?>

var start_day = "<?php echo $start_day?>";
var end_day = "<?php echo $end_day?>";
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/service.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <a href="<?php echo $alice['member_path'];?>/update_form.php">기업정보 관리</a> > <strong>유료 이용내역</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/person_tit_10.gif" width="145" height="25" alt="유료이용내역"></h2>
			<em class="titEm mb20">
				<ul>
				<li>회원님께서 구매하신 모든 유료서비스 이용내역을 확인할 수 있습니다.</li>
				<li>최근 3개월 이내 조회만 확인할 수 있으며, 과거 이용내역은 고객센터로 문의해 주세요.</li>
				</ul>
			</em>
			<div class="companyContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="positionR mt40 clearfix"> <!--  유료이용내역   --> 

					<form method="get" name="serviceListFrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="serviceListFrm">
					<input type="hidden" name="mode" value="search"/>
					<!-- <input type="hidden" name="page_rows" value="<?//php echo $page_rows;?>" id="page_rows"/> -->
					<input type="hidden" name="sel_date" id="sel_date"/>

					<h2 class="skip">유료이용내역</h2>
					<div class="positionA" style="top:-25px; right:0;">
						<select class="ipSelect2" style="width:100px;" id="page_rows" name="page_rows" title="출력수설정" onchange="page_rows(this);">
						<option value="20" <?php echo ($page_rows=='20')?'selected':'';?>>20개씩 보기</option>
						<option value="40" <?php echo ($page_rows=='40')?'selected':'';?>>40개씩 보기</option>
						<option value="60" <?php echo ($page_rows=='60')?'selected':'';?>>60개씩 보기</option>
						</select>
					</div>
					<div class="customList1 mb30"> 

						<div class="selectList tl pt5 pb5">
							<dl>
								<dt class="pl10 pr10">조회기간</dt>
								<dd class="line">
									<a class="button small" href="javascript:sel_date('7day');"><span id="sel_7day" class="sel_date <?php echo ($sel_date=='7day')?"text_red":"";?>">최근 1주일</span></a>
									<a class="button small" href="javascript:sel_date('30day');"><span id="sel_30day" class="sel_date <?php echo ($sel_date=='30day')?"text_red":"";?>">최근 1개월</span></a>
									<a class="button small" href="javascript:sel_date('90day');"><span id="sel_90day" class="sel_date <?php echo ($sel_date=='90day')?"text_red":"";?>">최근 3개월</span></a>
								</dd>
								<dd class="calendar">
									<select class="ipSelect" name="pay_sdate[]" id="pay_sdate_year">
										<option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
										<?php $j = 1; for($i = (date('Y')-3); $i < (date('Y')-1); $i++){ ?>
										<option value="<?php echo date('Y')-$j;?>"><?php echo date('Y')-$j;?></option>
										<?php $j++; } ?>
									</select> 
									년 
									<select class="ipSelect" name="pay_sdate[]" id="pay_sdate_month">
										<?php 
											for($i=1;$i<=12;$i++){
											if($pay_sdate){
												$selected = ($pay_sdate[1] == sprintf('%02d',$i)) ? 'selected' : '';
											} else {
												$selected = (sprintf('%02d',$i) == date('m')) ? 'selected' : '';
											}
										?>
										<option value="<?php echo sprintf('%02d',$i);?>" <?php echo $selected;?>><?php echo sprintf('%02d',$i);?></option>
										<?php } ?>
									</select> 
									월
									<select class="ipSelect" name="pay_sdate[]" id="pay_sdate_date">
										<?php
											for($i=1;$i<=31;$i++){
											if($pay_edate){
												$selected = ($pay_sdate[2] == sprintf('%02d',$i)) ? 'selected' : '';
											} else {
												$selected = (sprintf('%02d',$i) == date('d')) ? 'selected' : '';
											}
										?>
										<option value="<?php echo sprintf('%02d',$i);?>" <?php echo $selected;?>><?php echo sprintf('%02d',$i);?></option>
										<?php } ?>
									</select> 
									일 ~                      
									<select class="ipSelect" name="pay_edate[]" id="pay_edate_year">
										<option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
										<?php $j = 1; for($i = (date('Y')-3); $i < (date('Y')-1); $i++){ ?>
										<option value="<?php echo date('Y')-$j;?>"><?php echo date('Y')-$j;?></option>
										<?php $j++; } ?>
									</select> 
									년 
									<select class="ipSelect" name="pay_edate[]" id="pay_edate_month">
										<?php 
											for($i=1;$i<=12;$i++){
											if($pay_edate){
												$selected = ($pay_edate[1] == sprintf('%02d',$i)) ? 'selected' : '';
											} else {
												$selected = (sprintf('%02d',$i) == date('m')) ? 'selected' : '';
											}
										?>
										<option value="<?php echo sprintf('%02d',$i);?>" <?php echo $selected;?>><?php echo sprintf('%02d',$i);?></option>
										<?php } ?>
									</select> 
									월
									<select class="ipSelect" name="pay_edate[]" id="pay_edate_date">
										<?php
											for($i=1;$i<=31;$i++){
											if($pay_edate){
												$selected = ($pay_edate[2] == sprintf('%02d',$i)) ? 'selected' : '';
											} else {
												$selected = (sprintf('%02d',$i) == date('d')) ? 'selected' : '';
											}
										?>
										<option value="<?php echo sprintf('%02d',$i);?>" <?php echo $selected;?>><?php echo sprintf('%02d',$i);?></option>
										<?php } ?>
									</select> 
									일
									<em class="pr10"><a class="button" onclick="serviceListFrmSubmit();"><span>검색</span></a></em>
								</dd>
							</dl>
						</div>

						<table cellspacing="0">
						<caption class="skip">유료이용내역</caption>
						<colgroup><col width="80"><col width="150"><col width="180"><col width="80"><col width="100"><col width="80"></colgroup>
						<thead>
						<tr>
							<th  scope="col">신청일</th>
							<th  scope="col">상품명</th>
							<th  scope="col">기간/건수</th>
							<th  scope="col">결제방법</th>
							<th  scope="col">결제금액</th>
							<th  scope="col">결제승인</th>
						</tr>
						</thead>
						<tbody>
						<?php if(!$list['total_count']){ ?>
						<tr><td class="tc no_listText" colspan="7"><span>서비스 이용내역이 없습니다.</span></td></tr>
						<?php } else { 
							foreach($list['result'] as $val){
							$pay_wdate = strtr(substr($val['pay_wdate'],0,11),'-','.');
							$pay_info = $payment_control->payment_list($val['no']);	// 결제정보

							$pay_sdate = strtr(substr($val['pay_sdate'],0,11),'-','.');
							if($val['pay_total']==$val['pay_dc'] && $val['pay_price']==0){
								$pay_method = ($val['pay_dc']) ? "전액 포인트" : "무료";
							} else {
								$pay_method = $payment_control->pay_method[$val['pay_method']];
							}
							$pay_sdates = explode(" ",$val['pay_sdate']);
							$pay_sdate = strtr($pay_sdates[0],'-','.');
							$pay_stime = substr($pay_sdates[1],0,5);
							$package_info = $payment_control->get_payment_for_oid($val['pay_oid']," and `pay_package` != '0' ");
						?>
						<tr>
							<td class="tc"><span><?php echo $pay_wdate;?></span></td>
							<td class="tl" width="120">
								<?php 
								if($pay_info){
									foreach($pay_info as $_pay){ if(!$_pay['service_name']||$_pay['service_name']=='') continue; ?>
									<div><span><strong><?php echo $_pay['service_name'];?></strong></span></div>
								<?php 
									}	// foreache end.
								}	// if end. 
								?>
							</td>
							<td class="tl" width="120">
							<?php 
							if($pay_info){
								foreach($pay_info as $_pay){ 
								if(!$_pay['service_name']||$_pay['service_name']=='' || trim($_pay['service_name'])== ' ') continue;
								if(!$_pay['service_day'][$_pay['service_code']] || $_pay['service_day'][$_pay['service_code']]=='') continue;
							?>
								<div><span>
									<?php 
									if($_pay['service_code']=='etc_open' || $_pay['service_code']=='etc_sms'){
										$service_day_code = explode("/",$_pay['service_day'][$_pay['service_code']]);
										$service_type = $service_day_code[0];
										$service_day = $service_day_code[1];
										echo ($service_type=='date') ? $pay_sdate."~".$service_day : $service_day;
									} else {
										echo $pay_sdate."~".$_pay['service_day'][$_pay['service_code']];
									}
									?>
								</span></div>
							<?php 
								}	// foreach end.
							}	// if end.
							?>
							</td>
							<td class="tc"><span><?php echo $pay_method;?></span></td>
							<td class="tc"><span class="text_red"><strong>\<?php echo number_format($val['pay_price']);?></strong></span></td>
							<td class="tc">
								<div><strong><?php echo $pay_sdate;?></strong></div>
								<div><?php echo $pay_stime;?></div>
							</td>
						</tr>
						<?php 
							}	// foreach end.
						}	// if end.
						?>
						</tbody>
						</table>
						<!-- <div class="btnBottom mt10">
							<a class="button white" onclick="service_extend();"><span>서비스연장</span></a> 
						</div>         -->
						<?php include_once $alice['include_path']."/paging.php";?>

						</div>

						</form>

					</div> <!--  유료이용내역 end   --> 

				</div><!--  컨텐츠 end   --> 
			</div>
		</div>
	</div>
</section>