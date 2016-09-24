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

<script type="text/javascript" src="<?php echo $alice['individual_path'];?>/skins/default/alba_resume_applycert.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['individual_path'];?>/alba_resume_onlines.php">입사지원 관리</a> > <strong>취업활동 증명서</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<div id="popup" class="positionF content_wrap clearfix" style="top:15%;left:5%;z-index:9999;display:none;"></div>

		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/person_tit_09.gif" width="165" height="25" alt="취업활동 증명서"></h2>
			<em class="titEm mb20">
			<ul>
				<li>회원님의 입사지원 활동 내역에 대한 증명서를 발급해 드리는 서비스로 노동부 고용안정센터 등에 증명 자료로 제출하실 수 있습니다.</li>				
				<li>온라인 지원 취소, 지원한 기업이 탈퇴한 경우는 증명서 발급이 불가합니다.</li>
			</ul>
			</em>
			<div class="personContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="positionR mt40 clearfix"> <!--  취업활동증명서   --> 

					<form method="get" name="serviceListFrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="serviceListFrm">
					<input type="hidden" name="mode" value="search"/>

					<h2 class="skip">취업활동증명서</h2>
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
								<a class="button small" href="javascript:sel_date('7day');"><span class="text_red">최근 1주일</span></a>
								<a class="button small" href="javascript:sel_date('30day');"><span>최근 1개월</span></a>
								<a class="button small" href="javascript:sel_date('90day');"><span>최근 3개월</span></a>
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
					<caption class="skip">취업활동증명서</caption>
					<colgroup><col width="10px"><col width="80px"><col width="100px"><col width="*"><col width="250px"><col width="70px"></colgroup>
					<thead>
					<tr>
						<th  scope="col"><input name="check_all" type="checkbox"></th>
						<th  scope="col">지원일</th>
						<th  scope="col">회사명</th>
						<th  scope="col">채용제목</th>
						<th  scope="col">주소</th>
						<th  scope="col">연락처</th>
					</tr>
					</thead>
					<tbody>
					<?php if(!$list['total_count']){ ?>
					<tr><td class="tc no_listText" colspan="6"><span >온라인 또는 이메일 입사지원 내역이 없습니다.</span></td></tr>
					<?php } else { ?>

					<?php 
						foreach($list['result'] as $val){ 
						$wdate = strtr(substr($val['wdate'],0,11),'-','.');
						$member_info = $user_control->get_member($val['wr_to_id']);
						$company_info = $user_control->get_member_company($val['wr_to_id']);
						$get_alba = $alba_company_control->get_alba_no($val['wr_to']);
						$wr_phones = ($get_alba['wr_phone']) ? $get_alba['wr_phone'] : $get_alba['wr_hphone'];
						if($get_alba['is_delete']){	// 삭제된 공고
							$alba_href = $mail_view = "javascript:is_delete();";
							$target_href = "";
						} else {
							$alba_href = $alice['alba_path'] . "/alba_detail.php?no=" . $val['wr_to'];
							$target_href = "target=\"_blank\"";
							$mail_view = "javascript:mail_view('".$val['no']."');";
						}
						if($company_info['mb_left']){	// 탈퇴한 기업회원
							$company_href = "javascript:is_left();";
							$company_target = "";
						} else {
							$company_href = $alice['alba_path'] . "/company_info.php?mb_id=" . $val['wr_to_id'];
							$company_target = "target=\"_blank\"";
						}
					?>
					<tr>
						<td class="tc"><input type="checkbox" name='no[]' class='check_all' value="<?php echo $val['no'];?>"></td>
						<td class="tc"><span><?php echo $wdate;?></span></td>
						<td class="tl"><span><a href="<?php echo $company_href;?>" <?php echo $company_target;?>><?php echo stripslashes($company_info['mb_company_name']);?></a></span></td>
						<td class="tl" ><span><a href="<?php echo $alba_href;?>" <?php echo $target_href;?>><?php echo stripslashes($get_alba['wr_subject']);?></a></span></td>
						<td class="tl pl5"><span><?php echo $member_info['mb_address0']." ".$member_info['mb_address1'];?></span></td>
						<td class="tl"><span><?php echo $wr_phones;?></span></td>
					</tr>
					<?php } // foreach end.?>

					<?php } // if end.?>
					</tbody>
					</table>
					<div class="btnBottom mt10">
						<a class="button white" onclick="javascript:sel_applycerts();"><span>취업활동증명서 발급</span></a> 
					</div>        

					<?php include_once $alice['include_path']."/paging.php";?>

					</div>

					</form>

					</div> <!--  취업활동증명서 end   --> 

				</div><!--  컨텐츠 end   --> 
			</div>
		</div>
	</div>
</section>