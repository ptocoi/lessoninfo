<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var mode = "<?php echo $mode;?>";
var sdate = [];
<?php if($sdate){
	for($i=0;$i<$sdate_cnt;$i++){
?>
sdate.push("<?php echo $sdate[$i];?>");
<?php 
	}
} else { 
?>
var sdate = [];
<?php } ?>

var edate = [];
<?php if($edate){
	for($i=0;$i<$edate_cnt;$i++){
?>
edate.push("<?php echo $edate[$i];?>");
<?php 
	}
} else { 
?>
var edate = [];
<?php } ?>

var start_day = "<?php echo $start_day?>";
var end_day = "<?php echo $end_day?>";
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/alba_sms_skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['company_path'];?>/alba_resume_onlines.php">입사지원 관리</a> > <strong>SMS 문자발송 현황</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<div id="popup" class="positionF content_wrap clearfix" style="top:15%;left:5%;z-index:9999;display:none;"></div>

		<?php if($sms_use){ ?>
		<!--  문자보내기   -->   
		<div class="mobileWrap" style="display:none;" id="mobileWrap">

		<form name="smsSendFrm" method="post" action="<?php echo $alice['alba_path'];?>/process/sms.php" id="smsSendFrm">
		<input type="hidden" name="rphone" id="rphone"/><!-- 받는사람 -->
		<input type="hidden" name="wr_person" id="wr_person"/>
		<input type="hidden" name="wr_receive" id="wr_receive"/>

			<div class="mobileBox">
				<div class="editor mt10">
					<div class="topIcon"><img class="vb" src="../images/icon/ico_bg_mobile1.gif" width="184" height="18" alt="icon" /></div>
					<div class="initMsg">
					<?php if($sms_config['lms_use']){ // LMS 사용시 ?>
						<textarea name="send_msg" id="send_msg" onkeyup="length_count(this, 2000)" onchange="length_count(this, 2000)" onfocus="length_count(this, 2000)" style="padding:5px;ime-mode:active;" required hname="문자내용"></textarea>
					<?php } else { ?>
						<textarea name="send_msg" id="send_msg" onKeyUp="CountChar(this, 80);" style="padding:5px;ime-mode:active;" required hname="문자내용"></textarea>
					<?php } ?>
					</div>
					<div class="msgByte"><span id="msg_bytes">0</span> Byte<b></b></div>
				</div>
				<div class="mobileNum">
					<ul>
						<li>
							<label>보내는 사람</label>
							<input type="text" maxlength="13" name="sphone" id="sphone" value="<?php echo $member['mb_hphone'];?>" required hname="보내는사람">
						</li>
					</ul>
				</div>
				<div class="sendBtn"><a onclick="smsSendFrmSubmit();">보내기</a></div>
				<div class="closeBtn"><a onclick="smsSendFrmClose();"><img class="vb" src="../images/icon/icon_close.gif" width="19" height="19" alt="닫기" /></a></div>
			</div>
		
		</form>

		</div>
		<!--  문자보내기 //  -->      
		<?php } ?>

		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/person_tit_<?php echo ($type=='receive')?'15':'13';?>.gif" width="187" height="25" alt="SMS 문자발송 현황"></h2>
			<h3 style="padding:10px;" class="font11 fongrb">맞춤 채용 정보를 설정하시면  원하는 형태의 채용정보를 이메일이나 SMS 문자를 통해 수신하실 수 있습니다.<a href="/individual/alba_customized.php"><img class="vm positionR" style="left:115px;"src="/images/tit/more_man.gif"></a></h3>
			<em style="border:0px;padding:10px 0px 0px 3px !important" class="titEm mb20">
					<ul>						
						<li>문자를 발송하신 내역을 리스트로 보실 수 있습니다.</li>
						<li>SMS 문자 충전하기 메뉴에서 SMS를 충전하실 수 있습니다</li>
					</ul>
				</em>
			<div class="personContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="positionR mt40 clearfix"> <!--  SMS문자발송현황   --> 

					<form method="get" name="smsListFrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="smsListFrm">
					<input type="hidden" name="mode" value="search"/>
					<input type="hidden" name="type" value="<?php echo $type;?>"/>
					<input type="hidden" name="sel_date" id="sel_date"/>

					<h2 class="skip">취업활동증명서</h2>
						<div class="positionA" style="top:-25px; right:0;">						
						<select name="page_rows" title="pagesize" class="ipSelect2" style="width: 100px;" onchange="page_rows(this);">
							<option value="15">15개씩 보기</option>
							<option value="30">30개씩 보기</option>
							<option value="50">50개씩 보기</option>
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
									<select class="ipSelect" name="sdate[]" id="sdate_year">
										<option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
										<?php $j = 1; for($i = (date('Y')-3); $i < (date('Y')-1); $i++){ ?>
										<option value="<?php echo date('Y')-$j;?>"><?php echo date('Y')-$j;?></option>
										<?php $j++; } ?>
									</select> 
									년 
									<select class="ipSelect" name="sdate[]" id="sdate_month">
										<?php 
											for($i=1;$i<=12;$i++){
											if($sdate){
												$selected = ($sdate[1] == sprintf('%02d',$i)) ? 'selected' : '';
											} else {
												$selected = (sprintf('%02d',$i) == date('m')) ? 'selected' : '';
											}
										?>
										<option value="<?php echo sprintf('%02d',$i);?>" <?php echo $selected;?>><?php echo sprintf('%02d',$i);?></option>
										<?php } ?>
									</select> 
									월
									<select class="ipSelect" name="sdate[]" id="sdate_date">
										<?php
											for($i=1;$i<=31;$i++){
											if($edate){
												$selected = ($sdate[2] == sprintf('%02d',$i)) ? 'selected' : '';
											} else {
												$selected = (sprintf('%02d',$i) == date('d')) ? 'selected' : '';
											}
										?>
										<option value="<?php echo sprintf('%02d',$i);?>" <?php echo $selected;?>><?php echo sprintf('%02d',$i);?></option>
										<?php } ?>
									</select> 
									일 ~                      
									<select class="ipSelect" name="edate[]" id="edate_year">
										<option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
										<?php $j = 1; for($i = (date('Y')-3); $i < (date('Y')-1); $i++){ ?>
										<option value="<?php echo date('Y')-$j;?>"><?php echo date('Y')-$j;?></option>
										<?php $j++; } ?>
									</select> 
									년 
									<select class="ipSelect" name="edate[]" id="edate_month">
										<?php 
											for($i=1;$i<=12;$i++){
											if($edate){
												$selected = ($edate[1] == sprintf('%02d',$i)) ? 'selected' : '';
											} else {
												$selected = (sprintf('%02d',$i) == date('m')) ? 'selected' : '';
											}
										?>
										<option value="<?php echo sprintf('%02d',$i);?>" <?php echo $selected;?>><?php echo sprintf('%02d',$i);?></option>
										<?php } ?>
									</select> 
									월
									<select class="ipSelect" name="edate[]" id="edate_date">
										<?php
											for($i=1;$i<=31;$i++){
											if($edate){
												$selected = ($edate[2] == sprintf('%02d',$i)) ? 'selected' : '';
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
					<div style="border-top:1px solid #dddddd;"class="pt10 mb10">
						<font class="listFormsms pr10 pl10 b">SMS / LMS</font> 
						<span class="pl10">
							<input name="wr_type" id="wr_type_sms" type="radio" checked="" value="sms"> <label for="wr_type_sms">SMS</label>
							<input name="wr_type" id="wr_type_lms" type="radio" value="LMS"> <label for="wr_type_lms">LMS</label>
						</span>
					</div>
					<caption class="skip">SMS 발송현황</caption>
					<colgroup><col width="10"><col width="100"></colgroup>
					<thead>
					<tr>
						<th scope="col"><input name="check_all" type="checkbox"></th>
						<th scope="col"><?php echo ($type=='receive')?'수신':'보낸';?>날짜</th>
						<th scope="col"><?php echo ($type=='receive')?'보낸회원':'받은회원';?>명</th>
						<th scope="col"><?php echo ($type=='receive')?'수신':'발송';?> 내용</th>
						<?php if($type=='receive'){ ?>
						<th scope="col">답장</th>
						<?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php if($list['total_count']){ ?>
						<?php foreach($list['result'] as $val){ 
						$get_member = $member_control->get_member($val['wr_id']);
						?>
						<tr>
							<td class="tc"><input name="no[]" class="check_all" type="checkbox" value="13"></td>
							<td class="tc"><span><?php echo str_replace("-",".",substr($val['wr_wdate'],0,10));?> </span></td>
							<td class="tl pl15"><span><?php echo $get_member['mb_name'];?></span></td>
							<td class="tl"><span title="<?php echo $val['wr_content'];?>" alt="<?php echo $val['wr_content'];?>"><?php echo $utility->str_cut($val['wr_content'],125);?></span></td>
							<?php if($type=='receive'){ ?>
							<td class="tc"><span><a href="javascript:sms_send('<?php echo $val['no'];?>', '<?php echo $val['wr_rphone'];?>','<?php echo $get_member['mb_name'];?>','<?php echo $get_member['mb_id'];?>');">답장</a></span></td>
							<?php } ?>
						</tr>
						<?php } ?>
					<?php } else { ?>
					<tr><td class="tc" colspan="<?php echo ($type=='receive')?'5':'4';?>">발송 내역이 없습니다.</td></tr>
					<?php } ?>
					</tbody>
					</table>       

					<?php include_once $alice['include_path']."/paging.php";?>

					</div>

					</form>

					</div> <!--  SMS문자발송현황 end   --> 

				</div><!--  컨텐츠 end   --> 
			</div>
		</div>
	</div>
</section>