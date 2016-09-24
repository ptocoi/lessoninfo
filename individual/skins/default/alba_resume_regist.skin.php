<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>


<script>
var mode = "<?php echo $mode;?>";
var wr_wr_language_cnt = Number("<?php echo count($wr_language);?>");
$(function(){
	$('#AlbaResumeFrm').submit(function(){
		$('#wr_high_school_graduation').attr('disabled',false);
		<?php echo $utility->input_cheditor('wr_introduce');?>	// 에디터 내용 전달
	});
	var wr_subject = document.AlbaResumeFrm.wr_subject;
	CountCharText(wr_subject,30, 'subject_bytes');

	$('#wr_pay').autoNumeric('init');
});
</script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['individual_path'];?>/alba_resume_list.php">이력서관리</a> > <strong>새 이력서 작성</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<form method="post" name="MemberUpdateFrm" action="<?php echo $alice['member_path'];?>/process/regist.php" id="MemberUpdateFrm" enctype="multipart/form-data">
		<input type="hidden" name="ajax" value="true"/>
		<input type="hidden" name="mode" value="profile_photo_upload"/>
		<input type="hidden" name="mb_type" value="<?php echo $mb_type;?>"/>
		<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
		<input type="hidden" name="no" value="<?php echo $member['no'];?>"/>

		<!--  회원정보  -->
		<div class="listWrap positionR mt30">
			<h2 class="pb5"> 
				<img src="../images/tit/person_nav_tit_01.gif"  alt="회원정보"> 
				<em class="positionA" style="top:0; right:0;"><span class="pr10"><img class="vm" style="margin-top:-2px;" src="../images/icon/icon_b.gif" alt="필수입력사항">표시는 필수 입력사항 입니다.</span><a class="button" href="<?php echo $alice['member_path'];?>/update_form.php"><span>개인정보수정</span></a></em>
			</h2>
	<div class="registWrap">
				<table>
				<caption><span class="skip">개인정보입력</span></caption>
				<colgroup><col width="159px"><col width="180px"><col width="*"></colgroup>
				<tbody>
				<tr>
					<td class="first bbend" rowspan="6">
						<!-- 프로필 사진 -->
						<div class="personphoto">
							<img src="<?php echo $mb_photo;?>" width="100" height="130" alt="photo" id="personphoto"/>
							<div class="mt20"> 
								<a class="button white" onclick="profile_photo_pop();"><span id="personphoto_status"><?php echo ($member['mb_photo'])?'수정':'등록';?><img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span></a> 
								<span id="photo_remove" style="display:<?php echo ($member['mb_photo'])?'':'none';?>;">
								<a class="button white" onclick="profile_photo_remove();"><span>삭제<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span></a> 
								</span>
							</div>
						</div>
						<!-- //프로필 사진 -->

						<!-- 이미지 등록 layer -->
						<div style="display:none; width:420px; top:0; left:25%; text-align:left;" class="layerPop positionA border_color5" id="profilePhotoPop">
							<dl style="">
								<dt class="bg_gray1"  id="profilePhotoPop_handle" style="padding:20px 15px; cursor:pointer;"><strong>프로필사진 수정</strong>
									<em class="closeBtn" id="profilePhotoPop_close"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em>
								</dt>
								<dd style="padding:10px 15px;">
									<p style="padding-bottom:20px;">
										<strong>GIF,JPG,PNG</strong> 파일형식으로,<br>
										<strong>100*130픽셀, 100KB</strong> 용량 이내의 파일만 등록 가능합니다.<br>
									</p>
									<div style="border:1px solid #ddd; padding:10px;" class="box2">
										<input type="file" class="txtForm" style="height:20px;" size="32" id="photo_file" name="photo_file">
									</div>
									<div class="btn font_gray bg_white" style="margin:20px auto;">
										<a href="javascript:photo_submit();">등록하기<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a>
									</div>
								</dd>
							</dl>
						</div>
						<!-- //이미지 등록 layer -->

					</td>
					<th scope="row" class="personchkWrap positionR"> <label>이름</label></th>
					<td><strong><?php echo $member['mb_name'];?></strong> (<?php echo $mb_gender_txt;?>, <?php echo $mb_birth[0];?>년생) / <?php echo $member['mb_id'];?> </td>
				</tr>
				<tr>
					<th scope="row" class="personchkWrap positionR"> 
						<label>전화번호</label>
						<div class="positionA" style="top:0;right:20px;">
						<ul>
							<li>
								<input type="radio" class="chk" id="mb_phone_view_1" name="mb_phone_view" value="1" checked onclick="mb_views('phone',this);">
								<label for="mb_phone_view_1">공개</label>
							</li>
							<li>
								<input type="radio" class="chk" id="mb_phone_view_0" name="mb_phone_view" value="0" <?php echo (!$member['mb_phone_view'])?'checked':'';?> onclick="mb_views('phone',this);">
								<label for="mb_phone_view_0">비공개</label>
							</li>
						</ul>
						</div>
					</th>
					<td><?php echo $member['mb_phone'];?></td>
				</tr>
				<tr>
					<th scope="row" class="personchkWrap positionR"> 
						<label>휴대폰</label>
						<div class="positionA" style="top:0;right:20px;">
							<ul>
								<li>
									<input type="radio" class="chk" id="mb_hphone_view_1" name="mb_hphone_view" value="1" checked onclick="mb_views('hphone',this);">
									<label for="mb_hphone_view_1">공개</label>
								</li>
								<li>
									<input type="radio" class="chk" id="mb_hphone_view_0" name="mb_hphone_view" value="0" <?php echo (!$member['mb_hphone_view'])?'checked':'';?> onclick="mb_views('hphone',this);">
									<label for="mb_hphone_view_0">비공개</label>
								</li>
							</ul>
						</div>
					</th>
					<td><?php echo $member['mb_hphone'];?></td>
				</tr>
				<tr>
					<th scope="row" class="personchkWrap positionR"> 
						<label>이메일</label>
						<div class="positionA" style="top:0;right:20px;">
							<ul>
								<li>
									<input type="radio" class="chk" id="mb_email_view_1" name="mb_email_view" value="1" checked onclick="mb_views('email',this);">
									<label for="mb_email_view_1">공개</label>
								</li>
								<li>
									<input type="radio" class="chk" id="mb_email_view_0" name="mb_email_view" value="0" <?php echo (!$member['mb_email_view'])?'checked':'';?> onclick="mb_views('email',this);">
									<label for="mb_email_view_0">비공개</label>
								</li>
							</ul>
						</div>
					</th>
					<td><?php echo $member['mb_email'];?></td>
				</tr>
				<tr>
					<th scope="row" class="personchkWrap positionR"> 
						<label>홈페이지</label>
						<div class="positionA" style="top:0;right:20px;">
							<ul>
								<li>
									<input type="radio" class="chk" id="mb_homepage_view_1" name="mb_homepage_view" value="1" checked onclick="mb_views('homepage',this);">
									<label for="mb_homepage_view_1">공개</label>
								</li>
								<li>
									<input type="radio" class="chk" id="mb_homepage_view_0" name="mb_homepage_view" value="0" <?php echo (!$member['mb_homepage_view'])?'checked':'';?> onclick="mb_views('homepage',this);">
									<label for="mb_homepage_view_0">비공개</label>
								</li>
							</ul>
						</div>
					</th>
					<td><?php echo $member['mb_homepage'];?></td>
				</tr>
				<tr>
					<th class="bbend vt personchkWrap positionR" scope="row">
						<div class="positionA" style="top:0;right:20px;">
						<ul>
							<li>
								<input type="radio" class="chk" id="mb_address_view_1" name="mb_address_view" value="1" checked onclick="mb_views('address',this);">
								<label for="mb_address_view_1">공개</label></li>
							<li>
								<input type="radio"  class="chk" id="mb_address_view_0" name="mb_address_view" value="0" <?php echo (!$member['mb_address_view'])?'checked':'';?> onclick="mb_views('address',this);">
								<label for="mb_address_view_0">비공개</label>
							</li>
						</ul>
						</div>
						<label>주소</label>
					</th>
					<td class="bbend">[<?php echo $member['mb_zipcode'];?>] <?php echo $member['mb_address0']." ".$member['mb_address1'];?></td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
		<!--  //회원정보  --> 

		</form>

		<form method="post" name="AlbaResumeFrm" action="<?php echo $alice['individual_path'];?>/process/alba_resume.php" id="AlbaResumeFrm" enctype="multipart/form-data" onsubmit="return validate(this);">
		<input type="hidden" name="mode" value="<?php echo $mode;?>" id="mode"/>
		<input type="hidden" name="mb_type" value="<?php echo $mb_type;?>"/>
		<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
		<input type="hidden" name="mb_no" value="<?php echo $member['no'];?>"/>
		<?php if($mode=='update'){ // 수정일때 ?>
		<input type="hidden" name="no" value="<?php echo $get_resume['no'];?>"/>
		<input type="hidden" name="page_rows" value="<?php echo $page_rows;?>"/>
		<input type="hidden" name="page" value="<?php echo $page;?>"/>
		<?php } ?>

		<?php if($mode=='insert'||$mode=='load'){	// 등록 일때만 ?>
		<div class="positionR mt20 clearfix" style="border:1px solid #ddd;padding:10px; background:#edf1fb;">
			<em>이력서를 작성하실때 기본 이력서의 저장된 내용을 불러와서 사용하실 수 있습니다.</em>
			<span class="person button">
			<select title="과거 채용공고 불러오기" name="past_list" id="past_list" style="width:170px;" class="ipSelect" onchange="past_load(this);">
				<option value="">과거 이력서 불러오기</option>
				<?php foreach($past_list as $val){ ?>
				<option value="<?php echo $val['no'];?>"><?php echo stripslashes($val['wr_subject']);?></option>
				<?php } ?>
			</select>      
			</span> 
		</div>
		<?php } ?>

		<!--  희망근무조건 -->
		<div class="listWrap mt30">
			<h2 class="pb5"><img src="../images/tit/person_nav_tit_02.gif"  alt="희망근무조건"></h2>
			<div class="registWrap">
			<table>
			<caption><span class="skip">희망근무조건입력</span></caption>
			<colgroup><col width="159px"><col width="*"></colgroup>
			<tbody>
			<tr>
				<th scope="row"><label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >이력서제목</label></th>
				<td>
					<p class="pb3"><input type="text" maxlength="30" class="ipText" style="width:480px;" id="wr_subject" name="wr_subject" required hname="이력서제목" onKeyUp="CountCharText(this, 30, 'subject_bytes');" value="<?php echo $get_resume['wr_subject'];?>"> (<span id='subject_bytes'>0</span>/30자)</p>
					<em class="help text_help">이력서 제목은 희망직무나 구체적인 지원분야를 입력하시는 것이 좋습니다.</em>
				</td>
			</tr>
			<tr>
				<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >근무지</label></th>
				<td>
					<div class="dutyWrap positionR">
						<li class="pb5 positionR">

							<select class="ipSelect" style="width:180px;" id="wr_area0" name="wr_area0" title="시·도 선택" onchange="area_sel_first(this,'wr_area1');" required hname="근무지 시·도">
							<option value=""> -- 시·도 --</option>
							<?php 
								foreach($area_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_area0 == $val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php } ?>
							</select>
							<span id="wr_area1_display">
								<select class="ipSelect" style="width:180px;" id="wr_area1" name="wr_area1" title="시·군·구 선택">
								<option value=""> -- 시·군·구 --</option>
								<?php
								if($wr_area1){
									$pcodeList = $category_control->category_pcodeList('area', $wr_area0);
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_area1 == $val['code']) ? "selected" : "";
								?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php 
									}	// foreach end.
								} else {
								?>
									<option value="">시·도 를 먼저 선택해 주세요</option>
								<?php
								}	// if end.
								?>
								</select>
							</span>

							<div id="wr_area1_block" style="display:<?php echo ($wr_area2)?'':'none';?>;">
								<select class="ipSelect" style="width:180px;" id="wr_area2" name="wr_area2" title="시·도 선택" onchange="area_sel_first(this,'wr_area3');">
								<option value=""> -- 시·도 --</option>
								<?php 
									foreach($area_list as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_area2 == $val['code']) ? "selected" : "";
								?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php } ?>
								</select>
								<span id="wr_area3_display">
									<select class="ipSelect" style="width:180px;" id="wr_area3" name="wr_area3" title="시·군·구 선택">
									<option value=""> -- 시·군·구 --</option>
									<?php
									if($wr_area3){
										$pcodeList = $category_control->category_pcodeList('area', $wr_area2);
										foreach($pcodeList as $val){ 
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										$selected = ($wr_area3 == $val['code']) ? "selected" : "";
									?>
										<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
										}	// foreach end.
									} else {
									?>
										<option value="">시·도 를 먼저 선택해 주세요</option>
									<?php
									}	// if end.
									?>
									</select>
								</span>
								<em style="right:0; top:2px;" class="positionR insert"> <a class="button white" onclick="area_remove('1');"><span>-제거</span></a></em>
							</div>

							<div id="wr_area2_block" style="display:<?php echo ($wr_area3)?'':'none';?>;">
								<select class="ipSelect" style="width:180px;" id="wr_area4" name="wr_area4" title="시·도 선택" onchange="area_sel_first(this,'wr_area5');">
								<option value=""> -- 시·도 --</option>
								<?php 
									foreach($area_list as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_area4 == $val['code']) ? "selected" : "";
								?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php } ?>
								</select>
								<span id="wr_area5_display">
									<select class="ipSelect" style="width:180px;" id="wr_area5" name="wr_area5" title="시·군·구 선택">
									<option value=""> -- 시·군·구 --</option>
									<?php
									if($wr_area5){
										$pcodeList = $category_control->category_pcodeList('area', $wr_area4);
										foreach($pcodeList as $val){ 
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										$selected = ($wr_area5 == $val['code']) ? "selected" : "";
									?>
										<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
										}	// foreach end.
									} else {
									?>
										<option value="">시·도 를 먼저 선택해 주세요</option>
									<?php
									}	// if end.
									?>
									</select>
								</span>
								<em style="right:0; top:2px;" class="positionR insert"> <a class="button white" onclick="area_remove('2');"><span>-제거</span></a></em>
							</div>

							<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="area_add();"><span>+추가</span></a></em>

						</li>
						<em>
							<input type="checkbox" class="typeCheckbox" id="wr_home_work" name="wr_home_work" value="1" <?php echo ($get_resume['wr_home_work'])?'checked':'';?>>
							<label class="help" for="wr_home_work">재택근무가능</label>
						</em>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row"><label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >업직종</label></th>
				<td>
					<div class="partnameWrap positionR">
						<li class="pb5 positionR">

							<select class="ipSelect" style="width:180px;" id="wr_job_type0" name="wr_job_type0" title="1차직종선택" onchange="job_type_sel_first(this,'wr_job_type1');" required hname="1차직종">
							<option value="">1차직종선택</option>
							<?php 
								foreach($job_type_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_job_type0 == $val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php } ?>
							</select>
							<span id="wr_job_type1_display">
								<select class="ipSelect" style="width:180px;" id="wr_job_type1" name="wr_job_type1" title="2차직종선택" onchange="job_type_sel_first(this,'wr_job_type2');">
								<option value="">2차직종선택</option>
								<?php
								if($wr_job_type1){
									$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type0);
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type1 == $val['code']) ? "selected" : "";
								?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php 
									}	// foreach end.
								} else {
								?>
									<option value="">1차 직종을 먼저 선택해 주세요</option>
								<?php
								}	// if end.
								?>
								</select>
							</span>
							<span id="wr_job_type2_display">
								<select class="ipSelect" style="width:180px;" id="wr_job_type2" name="wr_job_type2" title="3차직종선택">
								<option value="">3차직종선택</option>
								<?php
								if($wr_job_type2){
									$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type1);
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type2 == $val['code']) ? "selected" : "";
								?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php 
									}	// foreach end.
								} else {
								?>
									<option value="">2차 직종을 먼저 선택해 주세요</option>
								<?php
								}	// if end.
								?>
								</select>
							</span>

							<div id="wr_job_type1_block" style="display:<?php echo ($wr_job_type3)?'':'none';?>;">
								<select class="ipSelect" style="width:180px;" id="wr_job_type3" name="wr_job_type3" title="1차직종선택" onchange="job_type_sel_first(this,'wr_job_type4');">
								<option value="">1차직종선택</option>
								<?php 
									foreach($job_type_list as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type3 == $val['code']) ? "selected" : "";
								?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php } ?>
								</select>
								<span id="wr_job_type4_display">
									<select class="ipSelect" style="width:180px;" id="wr_job_type4" name="wr_job_type4" title="2차직종선택">
									<option value="">2차직종선택</option>
									<?php
									if($wr_job_type4){
										$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type3);
										foreach($pcodeList as $val){ 
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										$selected = ($wr_job_type4 == $val['code']) ? "selected" : "";
									?>
										<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
										}	// foreach end.
									} else {
									?>
										<option value="">1차 직종을 먼저 선택해 주세요</option>
									<?php
									}	// if end.
									?>
									</select>
								</span>
								<span id="wr_job_type5_display">
									<select class="ipSelect" style="width:180px;" id="wr_job_type5" name="wr_job_type5" title="3차직종선택">
									<option value="">3차직종선택</option>
									<?php
									if($wr_job_type5){
										$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type4);
										foreach($pcodeList as $val){ 
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										$selected = ($wr_job_type5 == $val['code']) ? "selected" : "";
									?>
										<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
										}	// foreach end.
									} else {
									?>
										<option value="">2차 직종을 먼저 선택해 주세요</option>
									<?php
									}	// if end.
									?>
									</select>
								</span>
								<em style="right:0; top:2px;" class="positionR insert"> <a class="button white" onclick="job_type_remove('1');"><span>-제거</span></a></em>
							</div>

							<div id="wr_job_type2_block" style="display:<?php echo ($wr_job_type6)?'':'none';?>;">
								<select class="ipSelect" style="width:180px;" id="wr_job_type6" name="wr_job_type6" title="1차직종선택" onchange="job_type_sel_first(this,'wr_job_type7');">
								<option value="">1차직종선택</option>
								<?php 
									foreach($job_type_list as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type6 == $val['code']) ? "selected" : "";
								?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
								<?php } ?>
								</select>
								<span id="wr_job_type7_display">
									<select class="ipSelect" style="width:180px;" id="wr_job_type7" name="wr_job_type7" title="2차직종선택">
									<option value="">2차직종선택</option>
									<?php
									if($wr_job_type7){
										$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type6);
										foreach($pcodeList as $val){ 
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										$selected = ($wr_job_type7 == $val['code']) ? "selected" : "";
									?>
										<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
										}	// foreach end.
									} else {
									?>
										<option value="">1차 직종을 먼저 선택해 주세요</option>
									<?php
									}	// if end.
									?>
									</select>
								</span>
								<span id="wr_job_type8_display">
									<select class="ipSelect" style="width:180px;" id="wr_job_type8" name="wr_job_type8" title="3차직종선택">
									<option value="">3차직종선택</option>
									<?php
									if($wr_job_type8){
										$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type7);
										foreach($pcodeList as $val){ 
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										$selected = ($wr_job_type8 == $val['code']) ? "selected" : "";
									?>
										<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
										}	// foreach end.
									} else {
									?>
										<option value="">2차 직종을 먼저 선택해 주세요</option>
									<?php
									}	// if end.
									?>
									</select>
								</span>
								<em style="right:0; top:2px;" class="positionR insert"> <a class="button white" onclick="job_type_remove('2');"><span>-제거</span></a></em>
							</div>
							<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="job_type_add();"><span>+추가</span></a></em>

						</li>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >근무일시</label></th>
				<td>
					<div class="wantpayWrap positionR">
						<select class="ipSelect" style="width:130px;" id="wr_date" name="wr_date" title="근무기간" required hname="근무기간">
						<option value=""> -- 근무기간 --</option>
						<?php 
							foreach($alba_date_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($get_resume['wr_date'] == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php } ?>
						</select>
						<select class="ipSelect" style="width:130px;" id="wr_week" name="wr_week" title="근무요일" required hname="근무요일">
						<option value=""> -- 근무요일 --</option>
						<?php 
							foreach($alba_week_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($get_resume['wr_week'] == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php } ?>
						</select>
						<select class="ipSelect" style="width:130px;" id="wr_time" name="wr_time" title="근무시간" required hname="근무시간">
						<option value=""> -- 근무시간 --</option>
						<?php 
							foreach($alba_time_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($get_resume['wr_time'] == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php } ?>
						</select>
						<em>
							<input type="checkbox" class="typeCheckbox" id="wr_work_direct" name="wr_work_direct" value="1" <?php echo ($get_resume['wr_work_direct'])?'checked':'';?>>
							<label class="help" for="wr_work_direct">즉시출근가능</label>
						</em>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >급여</label></th>
				<td>
					<div class="positionR">
						<select name="wr_pay_type" id="wr_pay_type" class="ipSelect" <?php echo ($get_resume['wr_pay_conference'])?'disabled':'required';?> hname="급여조건">
						<option value="">= 급여 =</option>
						<?php 
							foreach($alba_pay_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($get_resume['wr_pay_type'] == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php } ?>
						</select>
						<input type="text" name="wr_pay" id="wr_pay" class="ipText" maxlength="10" style="ime-mode:inactive;" <?php echo ($get_resume['wr_pay_conference'])?'disabled':'required';?> hname="급여금액" value="<?php echo $get_resume['wr_pay'];?>" placeholder="0" data-v-min="0" data-v-max="10000000000">
						<label>원</label>
						<em class="pl10 pb3"> 
							<input type="checkbox" name="wr_pay_conference" id="wr_pay_conference" class="chk" value="1" onclick="pay_conference(this);" <?php echo ($get_resume['wr_pay_conference'])?'checked':'';?>>
							<label for="wr_pay_conference">추후협의</label>
						</em>
						<?php if($env['pay_view']){?><em class="help text_help"> 최저임금 : 시급 <strong class="txtEng"><?php echo number_format($env['time_pay']);?>원</strong></em><?php } ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" class="bbend"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >근무형태</label></th>
				<td  class="bbend">
					<div class="jobtypeWrap positionR">
						<ul>
						<?php 
							foreach($work_type_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = (@in_array($val['code'],$wr_work_type)) ? "checked" : "";
						?>
							<li>
								<input type="checkbox" name="wr_work_type[]" id="wr_work_type_<?php echo $val['code'];?>" class="chk" value="<?php echo $val['code'];?>" required hname="근무형태" <?php echo $checked;?>>
								<label for="wr_work_type_<?php echo $val['code'];?>"><?php echo $name;?></label>
							</li>
						<?php } ?>
						</ul>
					</div>
				</td>
			</tr>
			</tbody>
			</table>
			</div>
		</div>
		<!--  //희망근무조건  --> 

		<?php if($form_ability['view']=='yes'){ ?>
		<!--  학력사항  -->
		<div class="listWrap mt30">
			<h2 class="pb5"><img src="../images/tit/person_nav_tit_03.gif"  alt="학력사항"></h2>
			<div class="registWrap borderB" style="z-index:500">
				<!--  학교검색 layer  -->
				<div class="layerPop positionA border_color5" style="display:none; width:420px; top:100%; left:25%; text-align:left; z-index:1000; " id="schoolSearchPop">
				<dl>
					<dt style="padding:20px 15px; cursor:pointer;" class="bg_gray1" id="schoolSearchPop_handle">
						<strong class="search_title_txt">대학교 검색</strong>
						<em class="closeBtn" id="schoolSearchPop_close"><img width="11" height="11" class="pb5" src="../images/icon/icon_close2.gif" alt="arrow"></em>
					</dt>
					<dd style="padding:20px 15px 30px;">
						<p style="padding-bottom:10px;padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;"><strong class="search_title_txt">대학교 검색</strong><br/></p>
						<div class="box2" style="background:#F8F8F8; border:1px solid #ddd; padding:20px;">
							<ul>
								<li>
									<span>
									<label class="skip">검색어입력</label>
									<input type="text" style="width:280px;" name="school_search_keyword" class="" id="school_search_keyword">
									<em class="pr10"><a class="button" onclick="school_search();"><span>검색</span></a></em>
									</span>
								</li>
								<li class="pt5">
									<em class="help text_help">※ 한국대학를 찾으실 경우 ‘한국’으로 검색하시면 됩니다.</em>
								</li>
							</ul>
						</div>
						<!--  결과 리스트   -->                 
						<div class="mt20 result">
							<p class="pb5 pl10" style="border-bottom:1px solid #ddd; background:url(../images/icon/icon_arrow_2.gif) no-repeat 0 20%;">학교명을 클릭하시면 <strong>자동으로 등록</strong>됩니다.</p>
							<ul style="max-height:100px; overflow:auto;" id="school_search_result">
								
								<li style="padding:5px; border-bottom:1px solid #eee;height:30px;text-align:center;padding-top:33px;padding-bottom:33px;">
									학교명을 검색해 주세요.
								</li>

								<!-- <li style="cursor:pointer; padding:5px; border-bottom:1px solid #eee;">
									<a href="#">대한 <strong class="text_blue">한국</strong>대학</a>
								</li>
								<li style="cursor: pointer; padding:5px; border-bottom:1px solid #eee;">
									<a href="#">서울 <strong class="text_blue">한국</strong> 예술학교</a>
								</li>
								<li style="cursor:pointer; padding:5px; border-bottom:1px solid #eee;">
									<a href="#">대한 <strong class="text_blue">한국</strong>대학</a>
								</li> -->

							</ul>
						</div>
						<!--  //결과 리스트   -->
					</dd>
					<dd style="padding:20px 15px 10px;">
						<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;"><strong>학교명 직접입력</strong><br/></p>
						<p class="pb5 pl5">찾으시려는 학교명이 없을 경우 직접 입력해주세요.</p>
						<div style="border-top:2px solid #ddd; border-bottom:2px solid #ddd;">
							<table>
							<tr>
								<th style="padding:10px; background:none repeat scroll 0 0 #FAFAFA;">학교명</td>
								<td class="pl10"><input type="text" name="school_name" id="school_name" style="width:180px;"></td>
							</tr>
							</table>
						</div>
					</dd>
				</dl>
				<div style="margin:20px auto 30px;" class="btn font_gray bg_white"><a href="javascript:insert_school();">등록하기<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right3.png" alt="arrow"></a></div>
			</div>
			<!--  //학교검색 layer -->
			
			<table>
			<caption><span class="skip">학력정보입력</span></caption>
			<colgroup><col width="159px"><col width="*"></colgroup>
			<tbody>
			<tr>
				<th scope="row"><label><?php if($form_ability['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>최종학력</label></th>
				<td>
					<div class="schoolWrap positionR">
						<select class="ipSelect" style="width:180px;" id="wr_school_ability" name="wr_school_ability" title="학력" onchange="school_ability(this);" <?php echo ($form_ability['etc_0'])?'required':'';?> hname="학력">
						<option value=""> -- 학력선택 --</option>
						<?php
							foreach($indi_ability_list as $val){
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_school_ability[0] == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code']."/".$val['rank'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php } ?>
						</select>
						<em class="pl10 pb3"> 
							<input type="checkbox" name="wr_school_absence" id="wr_school_absence" class="chk" value="1" <?php echo ($get_resume['wr_school_absence'])?'checked':'';?>>
							<label for="wr_school_absence">휴학중</label>
						</em>
						<div class="schoolSelect pt5" id="schoolSelect" style="display:<?php echo ($schoolSelect_view)?'':'none';?>;">
							<em class="text_help"> 입력할 학력선택:</em>
							<span>
								<input type="checkbox" name="wr_school_type[]" class="chk" id="school_type0" value="high_school" onclick="school_types(this);" <?php echo ($mode=='update'||$mode=='load')?$high_school_disabled:'disabled';?> <?php echo $high_school_checked;?>>
								<label for="school_type0">고등학교</label>
								<input type="checkbox" name="wr_school_type[]" class="chk" id="school_type1" value="half_college" onclick="school_types(this);" <?php echo ($mode=='update'||$mode=='load')?$half_college_disabled:'disabled';?> <?php echo $half_college_checked;?>>
								<label for="school_type1">대학(2,3년)</label>
								<input type="checkbox" name="wr_school_type[]" class="chk" id="school_type2" value="college" onclick="school_types(this);" <?php echo ($mode=='update'||$mode=='load')?$college_disabled:'disabled';?> <?php echo $college_checked;?>>
								<label for="school_type2">대학교(4년)</label>
								<input type="checkbox" name="wr_school_type[]" class="chk" id="school_type3" value="graduate" onclick="school_types(this);" disabled <?php echo $graduate_checked;?>>
								<label for="school_type3">대학원</label>
							</span>
						</div>
					</div>
				</td>
			</tr>

			<tr id="ability_high_school" style="display:<?php echo ($mode=='update'||$mode=='load')?$high_school_display:'none';?>;">
			<?php if($mode=='insert'){ ?>
				<td scope="row"  class="subline "> <label><strong>고등학교</strong></label></td>
				<td  class="">
					<div class="school1">
						<ul>
							<li class="pb5 positionR">
								<!-- <input class="ipText" type="text" name="wr_high_school_name" id="wr_high_school_name" value="출신학교 선택" style="width:100px;" readonly onclick="school_search_pop('high_school','wr_high_school_name');">
								<em class="pr10"><a class="button" onclick="school_search_pop('high_school','wr_high_school_name');"><span>선택</span></a></em> -->
								<input class="ipText" type="text" name="wr_high_school_name" id="wr_high_school_name" value="출신학교 입력" style="width:100px;">

								<select name="wr_high_school_syear" class="ipSelect">
								<option value="">년도</option>
								<?php for($i=date('Y');$i>=1900;--$i){ ?>
								<option value='<?=$i?>'><?=$i?></option>
								<?php } ?>
								</select> 
								년 ~ 
								<span id="high_school_eyear_block">
									<select name="wr_high_school_eyear" class="ipSelect">
									<option value="">년도</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>'><?=$i?></option>
									<?php } ?>
									</select>
									년
								</span>
								<span id="high_school_eyear_now">현재</span>
								<select name="wr_high_school_graduation" id="wr_high_school_graduation" class="ipSelect">
								<option value="">졸업여부</option>
								<option value="0">졸업</option>
								<option value="1">재학</option>
								</select>
								<!-- <input type="checkbox" class="chk" name="wr_high_school_licensing"  id="wr_high_school_licensing" value="1">
								<label for="wr_high_school_licensing">검정고시</label> -->
							</li>
						</ul>
					</div>
				</td>
			<?php } else if($mode=='update'||$mode=='load'){ // 수정/불러오기 일때 ?>
				<td scope="row"  class="subline "> <label><strong>고등학교</strong></label></td>
				<td  class="">
					<div class="school1">
						<ul>
							<li class="pb5 positionR">
								<!-- <input class="ipText" type="text" name="wr_high_school_name" id="wr_high_school_name" value="<?php echo ($get_resume['wr_high_school_name'])?$get_resume['wr_high_school_name']:"출신학교 선택";?>" style="width:100px;" readonly onclick="school_search_pop('high_school','wr_high_school_name');">
								<em class="pr10"><a class="button" onclick="school_search_pop('high_school','wr_high_school_name');"><span>선택</span></a></em> -->
								<input class="ipText" type="text" name="wr_high_school_name" id="wr_high_school_name" value="<?php echo ($get_resume['wr_high_school_name'])?$get_resume['wr_high_school_name']:"출신학교 입력";?>" style="width:100px;">

								<select name="wr_high_school_syear" class="ipSelect">
								<option value="">년도</option>
								<?php for($i=date('Y');$i>=1900;--$i){ ?>
								<option value='<?=$i?>' <?php echo ($get_resume['wr_high_school_syear']==$i)?'selected':'';?>><?=$i?></option>
								<?php } ?>
								</select> 
								년 ~ 
								<span id="high_school_eyear_block">
									<select name="wr_high_school_eyear" class="ipSelect">
									<option value="">년도</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>' <?php echo ($get_resume['wr_high_school_eyear']==$i)?'selected':'';?>><?=$i?></option>
									<?php } ?>
									</select>
									년
								</span>
								<span id="high_school_eyear_now">현재</span>
								<select name="wr_high_school_graduation" id="wr_high_school_graduation" class="ipSelect">
								<option value="">졸업여부</option>
								<option value="0" <?php echo ($get_resume['wr_high_school_graduation']=='0')?'selected':'';?>>졸업</option>
								<option value="1" <?php echo ($get_resume['wr_high_school_graduation']=='1')?'selected':'';?>>재학</option>
								</select>
								<!-- <input type="checkbox" class="chk" name="wr_high_school_licensing"  id="wr_high_school_licensing" value="1">
								<label for="wr_high_school_licensing">검정고시</label> -->
							</li>
						</ul>
					</div>
				</td>
			<?php } ?>
			</tr>
			<tr id="ability_half_college" style="display:<?php echo ($mode=='update'||$mode=='load')?$half_college_display:'none';?>;">
				<td scope="row"  class="subline "> <label><strong>대학(2,3년)</strong></label></td>
				<td>
					<div class="school1 positionR">
						<ul id="half_college_block">
						<?php if($mode=='insert' || ($mode=='update' && !$wr_half_college) ){ ?>
							<li class="pb5 positionR">
								<!-- <input class="ipText graduate" type="text" name="wr_half_college[]" id="wr_half_college_0" style="width:100px;" readonly onclick="school_search_pop('half_college','0');" value="출신학교 선택">
								<em class="pr10"><a class="button" onclick="school_search_pop('half_college','0');"><span>선택</span></a></em> -->
								<input class="ipText graduate" type="text" name="wr_half_college[]" id="wr_half_college_0" style="width:100px;" value="출신학교 입력">
								<input class="ipText specialize" type="text" name="wr_half_college_specialize[]" id="wr_half_college_specialize_0" style="width:80px;" value="전공입력">

								<select name="wr_half_college_syear[]" class="ipSelect">
								<option value="">년도</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>'><?=$i?></option>
									<?php } ?>
								</select> 
								년 ~ 
								<span id="half_college_eyear_block_0">
									<select name="wr_half_college_eyear[]" class="ipSelect">
									<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>'><?=$i?></option>
										<?php } ?>
									</select>
									년
								</span>
								<span id="half_college_eyear_now_0">현재</span>
								<select name="wr_half_college_graduation[]" id="wr_half_college_graduation_0" class="ipSelect">
									<option value="">졸업여부</option>
									<option value="0">졸업</option>
									<option value="1">재학</option>
									<option value="2">중퇴</option>
								</select>
								<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="half_college_add();"><span>+추가</span></a></em>
							</li>
						<?php // 수정시
						} else if($mode=='update'||$mode=='load'){ 
							if($wr_half_college){
								for($j=0;$j<$wr_half_college_cnt;$j++){
								$school_name = $wr_half_college['college'][$j];
								$school_specialize = $wr_half_college['college_specialize'][$j];
								$school_syear = $wr_half_college['college_syear'][$j];
								$school_eyear = $wr_half_college['college_eyear'][$j];
								$school_graduation = $wr_half_college['college_graduation'][$j];
						?>
							<li class="pb5 positionR" id="half_college_<?php echo $j;?>">
								<!-- <input class="ipText graduate" type="text" name="wr_half_college[]" id="wr_half_college_<?php echo $j;?>" style="width:100px;" readonly onclick="school_search_pop('half_college','<?php echo $j;?>');" value="<?php echo ($school_name)?$school_name:'출신학교 선택';?>">
								<em class="pr10"><a class="button" onclick="school_search_pop('half_college','<?php echo $j;?>');"><span>선택</span></a></em> -->
								<input class="ipText graduate" type="text" name="wr_half_college[]" id="wr_half_college_<?php echo $j;?>" style="width:100px;" value="<?php echo ($school_name)?$school_name:'출신학교 입력';?>">
								<input class="ipText specialize" type="text" name="wr_half_college_specialize[]" id="wr_half_college_specialize_<?php echo $j;?>" style="width:80px;" value="<?php echo ($school_specialize)?$school_specialize:'전공입력';?>">

								<select name="wr_half_college_syear[]" class="ipSelect">
								<option value="">년도</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>' <?php echo ($school_syear==$i)?'selected':'';?>><?=$i?></option>
									<?php } ?>
								</select> 
								년 ~ 
								<span id="half_college_eyear_block_<?php echo $j;?>">
									<select name="wr_half_college_eyear[]" class="ipSelect">
									<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>' <?php echo ($school_eyear==$i)?'selected':'';?>><?=$i?></option>
										<?php } ?>
									</select>
									년
								</span>
								<span id="half_college_eyear_now_<?php echo $j;?>">현재</span>
								<select name="wr_half_college_graduation[]" id="wr_half_college_graduation_<?php echo $j;?>" class="ipSelect">
									<option value="">졸업여부</option>
									<option value="0" <?php echo ($school_graduation=='0')?'selected':'';?>>졸업</option>
									<option value="1" <?php echo ($school_graduation=='1')?'selected':'';?>>재학</option>
									<option value="2" <?php echo ($school_graduation=='2')?'selected':'';?>>중퇴</option>
								</select>
								<?php if($j==0){ ?>
									<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="half_college_add();"><span>+추가</span></a></em>
								<?php } else {?>
									<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="half_college_remove('<?php echo $j;?>');"><span>-제거</span></a></em>
								<?php } ?>
							</li>
						<?php 
								}	// wr_half_college for end.
							}	// wr_half_college if end.
						}	// if end.
						?>
						</ul>
					</div>
				</td>
			</tr>

			<tr id="ability_college" style="display:<?php echo ($mode=='update'||$mode=='load')?$college_display:'none';?>;">
				<td scope="row"  class="subline"> <label><strong>대학(4년)</strong></label></td>
				<td>
					<div class="school1 positionR">
						<ul id="college_block">
						<?php if($mode=='insert' || ($mode=='update' && !$wr_college)){ ?>
							<li class="pb5 positionR">
								<!-- <input class="ipText graduate" type="text" name="wr_college[]" id="wr_college_0" style="width:100px;" readonly onclick="school_search_pop('college','0');" value="출신학교 선택">
								<em class="pr10"><a class="button" onclick="school_search_pop('college','0');"><span>선택</span></a></em> -->
								<input class="ipText graduate" type="text" name="wr_college[]" id="wr_college_0" style="width:100px;" value="출신학교 입력">
								<input class="ipText specialize" type="text" name="wr_college_specialize[]" id="wr_college_specialize_0" style="width:80px;" value="전공입력">

								<select name="wr_college_syear[]" class="ipSelect">
								<option value="">년도</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>'><?=$i?></option>
									<?php } ?>
								</select> 
								년 ~ 
								<span id="college_eyear_block_0">
									<select name="wr_college_eyear[]" class="ipSelect">
									<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>'><?=$i?></option>
										<?php } ?>
									</select>
									년
								</span>
								<span id="college_eyear_now_0">현재</span>
								<select name="wr_college_graduation[]" id="wr_college_graduation_0" class="ipSelect">
									<option value="">졸업여부</option>
									<option value="0">졸업</option>
									<option value="1">재학</option>
									<option value="2">중퇴</option>
								</select>
								<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="college_add();"><span>+추가</span></a></em>
							</li>
						<?php // 수정시
						} else if($mode=='update'||$mode=='load'){ 
							if($wr_college){
								for($j=0;$j<$wr_college_cnt;$j++){
								$school_name = $wr_college['college'][$j];
								$school_specialize = $wr_college['college_specialize'][$j];
								$school_syear = $wr_college['college_syear'][$j];
								$school_eyear = $wr_college['college_eyear'][$j];
								$school_graduation = $wr_college['college_graduation'][$j];
						?>
							<li class="pb5 positionR" id="college_<?php echo $j;?>">
								<!-- <input class="ipText graduate" type="text" name="wr_college[]" id="wr_college_<?php echo $j;?>" style="width:100px;" readonly onclick="school_search_pop('college','<?php echo $j;?>');" value="<?php echo ($school_name)?$school_name:'출신학교 선택';?>">
								<em class="pr10"><a class="button" onclick="school_search_pop('college','<?php echo $j;?>');"><span>선택</span></a></em> -->
								<input class="ipText graduate" type="text" name="wr_college[]" id="wr_college_<?php echo $j;?>" style="width:100px;" value="<?php echo ($school_name)?$school_name:'출신학교 입력';?>">
								<input class="ipText specialize" type="text" name="wr_college_specialize[]" id="wr_college_specialize_<?php echo $j;?>" style="width:80px;" value="<?php echo ($school_specialize)?$school_specialize:'전공입력';?>">

								<select name="wr_college_syear[]" class="ipSelect">
								<option value="">년도</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>' <?php echo ($school_syear==$i)?'selected':'';?>><?=$i?></option>
									<?php } ?>
								</select> 
								년 ~ 
								<span id="college_eyear_block_<?php echo $j;?>">
									<select name="wr_college_eyear[]" class="ipSelect">
									<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>' <?php echo ($school_eyear==$i)?'selected':'';?>><?=$i?></option>
										<?php } ?>
									</select>
									년
								</span>
								<span id="college_eyear_now_<?php echo $j;?>">현재</span>
								<select name="wr_college_graduation[]" id="wr_college_graduation_<?php echo $j;?>" class="ipSelect">
									<option value="">졸업여부</option>
									<option value="0" <?php echo ($school_graduation=='0')?'selected':'';?>>졸업</option>
									<option value="1" <?php echo ($school_graduation=='1')?'selected':'';?>>재학</option>
									<option value="2" <?php echo ($school_graduation=='2')?'selected':'';?>>중퇴</option>
								</select>
								<?php if($j==0){ ?>
									<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="college_add();"><span>+추가</span></a></em>
								<?php } else { ?>
									<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="college_remove('<?php echo $j;?>');"><span>-제거</span></a></em>
								<?php } ?>
							</li>
						<?php
								}	// for end.
							}	// wr_college if end.
						}	// if end.
						?>
						</ul>
					</div>
				</td>
			</tr>

			<tr id="ability_graduate" style="display:<?php echo ($mode=='update'||$mode=='load')?$graduate_display:'none';?>;">
				<td scope="row"  class="subline"> <label><strong>대학원</strong></label></td>
				<td>
					<div class="school1 positionR">
						<ul id="graduate_block">
						<?php if($mode=='insert' || ($mode=='update' && !$wr_graduate)){ ?>
							<li class="pb5 positionR">
								<!-- <input class="ipText graduate" type="text" name="wr_graduate[]" id="wr_graduate_0" style="width:100px;" readonly onclick="school_search_pop('graduate','0');" value="출신학교 선택">
								<em class="pr10"><a class="button" onclick="school_search_pop('graduate','0');"><span>선택</span></a></em> -->
								<input class="ipText graduate" type="text" name="wr_graduate[]" id="wr_graduate_0" style="width:100px;" value="출신학교 입력">
								<input class="ipText specialize" type="text" name="wr_graduate_specialize[]" id="wr_graduate_specialize_0" style="width:80px;" value="전공입력">

								<select name="wr_graduate_grade[]" class="ipSelect">
								<option value="">학위</option>
								<option value='0'>석사</option>
								<option value='1'>박사</option>
								</select> 

								<select name="wr_graduate_syear[]" class="ipSelect">
								<option value="">년도</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>'><?=$i?></option>
									<?php } ?>
								</select> 
								년 ~ 
								<span id="graduate_eyear_block_0">
									<select name="wr_graduate_eyear[]" class="ipSelect">
									<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>'><?=$i?></option>
										<?php } ?>
									</select>
									년
								</span>
								<span id="graduate_eyear_now_0">현재</span>
								<select name="wr_graduate_graduation[]" id="wr_graduate_graduation_0" class="ipSelect">
								<option value="">졸업여부</option>
								<option value="0">졸업</option>
								<option value="1">수료</option>
								<option value="2">재학</option>
								<option value="3">중퇴</option>
								</select>
								<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="graduate_add();"><span>+추가</span></a></em>
							</li>
						<?php // 수정시
						} else if($mode=='update'||$mode=='load'){ 
							if($wr_graduate){
								for($j=0;$j<$wr_graduate_cnt;$j++){
								$school_name = $wr_graduate['graduate'][$j];
								$school_specialize = $wr_graduate['graduate_specialize'][$j];
								$school_grade = $wr_graduate['graduate_grade'][$j];
								$school_syear = $wr_graduate['graduate_syear'][$j];
								$school_eyear = $wr_graduate['graduate_eyear'][$j];
								$school_graduation = $wr_graduate['graduate_graduation'][$j];
						?>
							<li class="pb5 positionR" id="graduate_<?php echo $j;?>">
								<!-- <input class="ipText graduate" type="text" name="wr_graduate[]" id="wr_graduate_<?php echo $j;?>" style="width:100px;" readonly onclick="school_search_pop('graduate','<?php echo $j;?>');" value="<?php echo ($school_name)?$school_name:'출신학교 선택';?>">
								<em class="pr10"><a class="button" onclick="school_search_pop('graduate','<?php echo $j;?>');"><span>선택</span></a></em> -->
								<input class="ipText graduate" type="text" name="wr_graduate[]" id="wr_graduate_<?php echo $j;?>" style="width:100px;" value="<?php echo ($school_name)?$school_name:'출신학교 입력';?>">
								<input class="ipText specialize" type="text" name="wr_graduate_specialize[]" id="wr_graduate_specialize_<?php echo $j;?>" style="width:80px;" value="<?php echo ($school_specialize)?$school_specialize:'전공입력';?>">

								<select name="wr_graduate_grade[]" class="ipSelect">
								<option value="">학위</option>
								<option value='0' <?php echo ($school_grade=='0')?'selected':'';?>>석사</option>
								<option value='1' <?php echo ($school_grade=='1')?'selected':'';?>>박사</option>
								</select> 

								<select name="wr_graduate_syear[]" class="ipSelect">
								<option value="">년도</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>' <?php echo ($school_syear==$i)?'selected':'';?>><?=$i?></option>
									<?php } ?>
								</select> 
								년 ~ 
								<?php if($school_graduation=='2'){	 // 재학중 이라면 ?>
								<span id="graduate_eyear_now_<?php echo $j;?>">현재</span>
								<?php } else { ?>
								<span id="graduate_eyear_block_<?php echo $j;?>">
									<select name="wr_graduate_eyear[]" class="ipSelect">
									<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>' <?php echo ($school_eyear==$i)?'selected':'';?>><?=$i?></option>
										<?php } ?>
									</select>
									년
								</span>
								<?php } ?>
								<select name="wr_graduate_graduation[]" id="wr_graduate_graduation_<?php echo $j;?>" class="ipSelect">
								<option value="">졸업여부</option>
								<option value="0" <?php echo ($school_graduation=='0')?'selected':'';?>>졸업</option>
								<option value="1" <?php echo ($school_graduation=='1')?'selected':'';?>>수료</option>
								<option value="2" <?php echo ($school_graduation=='2')?'selected':'';?>>재학</option>
								<option value="3" <?php echo ($school_graduation=='3')?'selected':'';?>>중퇴</option>
								</select>
								<?php if($j==0){ ?>
									<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="graduate_add();"><span>+추가</span></a></em>
								<?php } else { ?>
									<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="graduate_remove('<?php echo $j;?>');"><span>-제거</span></a></em>
								<?php } ?>
							</li>
						<?php
								}	// for end.
							}	// wr_college if end.
						}	// if end.
						?>
						</ul>
					</div>
				</td>
			</tr>

			<tr id="ability_success" style="display:none;">
				<td scope="row"  class="subline"> <label><strong>대학원</strong></label></td>
				<td>
					<div class="school1 positionR">
						<ul id="success_block">

							<li class="pb5 positionR">
								<!-- <input class="ipText graduate" type="text" name="wr_success[]" id="wr_success_0" style="width:100px;" readonly onclick="school_search_pop('success','0');" value="출신학교 선택">
								<em class="pr10"><a class="button" onclick="school_search_pop('success','0');"><span>선택</span></a></em> -->
								<input class="ipText graduate" type="text" name="wr_success[]" id="wr_success_0" style="width:100px;" value="출신학교 입력">
								<input class="ipText specialize" type="text" name="wr_success_specialize[]" id="wr_success_specialize_0" style="width:80px;" value="전공입력">

								<select name="wr_success_grade[]" class="ipSelect">
								<option value="">학위</option>
								<option value='0'>석사</option>
								<option value='1'>박사</option>
								</select> 

								<select name="wr_success_syear[]" class="ipSelect">
								<option value="">년도</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>'><?=$i?></option>
									<?php } ?>
								</select> 
								년 ~ 
								<span id="success_eyear_block_0">
									<select name="wr_success_eyear[]" class="ipSelect">
									<option value="">년도</option>
										<?php for($i=date('Y');$i>=1900;--$i){ ?>
										<option value='<?=$i?>'><?=$i?></option>
										<?php } ?>
									</select>
									년
								</span>
								<select name="wr_success_graduation[]" id="wr_success_graduation_0" class="ipSelect">
								<option value="">졸업여부</option>
								<option value="0">졸업</option>
								<option value="1">수료</option>
								<option value="2">재학</option>
								<option value="3">중퇴</option>
								</select>
								<em style="right:0; top:2px;" class="positionA insert"> <a class="button white" onclick="success_add();"><span>+추가</span></a></em>
							</li>

						</ul>
					</div>
				</td>
			</tr>
			</tbody>
			</table>
			</div>
		</div>
		<!--  //학력사항 --> 
		<?php } ?>

		<?php if($form_career['view']=='yes'){ ?>
		<!--  경력사항  -->
		<div class="listWrap mt30">
			<h2 class="pb5"><img src="../images/tit/person_nav_tit_04.gif" alt="경력사항"></h2>
			<div class="registWrap borderB">
			<table>
			<caption><span class="skip">경력사항정보출력</span></caption>
			<colgroup><col width="159px"><col width="*"></colgroup>
			<tbody id="career_block">
			<tr>
				<th scope="row"><label>경력<?php if($form_career['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?></label></th>
				<td>
					<div class="careerWrap positionR">
					<input type="checkbox" name="wr_career_use" id="wr_career_use" class="chk" value="1" onclick="use_career(this);" <?php echo ($wr_career_use)?'checked':'';?> <?php echo ($form_career['etc_0'])?'required':'';?> hname="경력사항" option="checkbox">
					<label for="wr_career_use"><strong>경력있음</strong></label>
					<em style="right:0; top:0;display:<?php echo ($wr_career_use)?'':'none';?>;" class="positionA insert" id="career_add"> <a class="button white" onclick="career_add();"><span>+추가</span></a></em>
					</div>
				</td>
			</tr>

			<?php if($mode=='insert' || ($mode=='update' && !$wr_career)){ ?>
			<tr class="wr_career_block" id="wr_career_block_0" style="display:none;">
				<td scope="row"  class="subline"> <label><strong>경력사항</strong></label></td>
				<td>
					<div class="career1 positionR">
						<ul>
							<li class="pb5 positionR">
							<table>
							<caption><span class="skip">경력사항 정보입력</span></caption>
							<colgroup><col width="200px"><col width="*"></colgroup>
							<tbody>
							<tr>
								<td>
									<span>
									<label>회사명<img alt="필수입력사항" src="../images/icon/icon_b2.gif"></label>
									<input class="ipText career_required" type="text" name="wr_career_company[]" id="wr_career_company_0" style="width:120px;" hname="회사명">
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<span><label>근무직종<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label></span>
									<select class="ipSelect career_required" style="width:170px;" name="wr_career_type_0[]" id="wr_career_type_0_0" title="1차직종선택" onchange="career_type_sel_first(this,'wr_career_type_0_1');" hname="1차직종">
									<option value="">1차직종선택</option>
									<?php 
										foreach($job_type_list as $val){ 
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									?>
									<option value="<?php echo $val['code'];?>"><?php echo $name;?></option>
									<?php } ?>
									</select>
									<span id="wr_career_type_0_1_display">
										<select class="ipSelect" style="width:170px;" name="wr_career_type_0[]" id="wr_career_type_0_1" title="2차직종선택" onchange="career_type_sel_first(this,'wr_career_type_0_2');">
										<option value="">2차직종선택</option>
										<option value="">1차 직종을 먼저 선택해 주세요</option>
										</select>
									</span>
									<span id="wr_career_type_0_2_display">
										<select class="ipSelect" style="width:170px;" name="wr_career_type_0[]" id="wr_career_type_0_2" title="3차직종선택">
										<option value="">3차직종선택</option>
										<option value="">2차 직종을 먼저 선택해 주세요</option>
										</select>
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<label>근무기간<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label>
									<select name="wr_career_syear[]" class="ipSelect career_required" hname="근무기간">
									<option value="">년</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>'><?=$i?></option>
									<?php } ?>
									</select> 
									년 
									<select name="wr_career_smonth[]" class="ipSelect career_required" hname="근무기간">
									<option value="">월</option>
									<?php for($i=1;$i<=12;$i++){?>
									<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?></option>
									<?php } ?>
									</select>
									월 ~
									<select name="wr_career_eyear[]" class="ipSelect career_required" hname="근무기간">
									<option value="">년</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>'><?=$i?></option>
									<?php } ?>
									</select> 
									년 
									<select name="wr_career_emonth[]" class="ipSelect career_required" hname="근무기간">
									<option value="">월</option>
									<?php for($i=1;$i<=12;$i++){?>
									<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?></option>
									<?php } ?>
									</select>
									월
								</td>
							</tr>
							<tr>
								<td>
									<label>담당업무<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label>
									<input class="ipText career_required" type="text" name="wr_career_job[]" id="wr_career_job_0" style="width:120px;" hname="담당업무">
								</td>
							</tr>
							<tr>
								<td>
									<label>상세업무</label>
									<textarea class="ipTextarea" name="wr_career_content[]" id="wr_career_content_0" style="width:450px; height:50px; padding:10px;" onKeyUp="CountCharText(this, 30, 'career_content_bytes_0');"></textarea>
									(<span id="career_content_bytes_0">0</span>/100자)
								</td>
							</tr>
							</tbody>
							</table>
							</li>
						</ul>
					</div>
				</td>
			</tr>
			<?php // 수정시 
			} else if($mode=='update'||$mode=='load'){ 
			if($wr_career) {
				foreach($wr_career as $ckey => $cval){
				$job_type_0 = $cval['type'][0];
				$job_type_1 = $cval['type'][1];
				$job_type_2 = $cval['type'][2];
				$sdate = explode('-',$cval['sdate']);
				$edate = explode('-',$cval['edate']);
			?>
			<tr class="wr_career_block" id="wr_career_block_<?php echo $ckey;?>">
				<td scope="row"  class="subline"> <label><strong>경력사항</strong></label></td>
				<td>
					<div class="career1 positionR">
						<ul>
							<li class="pb5 positionR">
							<?php if($ckey!=0){?>
							<em style="right:0; top:5px;" class="positionA delete"> <a class="button white" onclick="career_remove('<?php echo $ckey;?>');"><span>-삭제</span></a></em>
							<?php } ?>
							<table>
							<caption><span class="skip">경력사항 정보입력</span></caption>
							<colgroup><col width="200px"><col width="*"></colgroup>
							<tbody>
							<tr>
								<td>
									<span>
									<label>회사명<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label>
									<input class="ipText career_required" type="text" name="wr_career_company[]" id="wr_career_company_<?php echo $ckey;?>" style="width:120px;" hname="회사명" value="<?php echo $cval['company'];?>">
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<span><label>근무직종<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label></span>
									<select class="ipSelect career_required" style="width:170px;" name="wr_career_type_<?php echo $ckey;?>[]" id="wr_career_type_<?php echo $ckey;?>_0" title="1차직종선택" onchange="career_type_sel_first(this,'wr_career_type_<?php echo $ckey;?>_1');" hname="1차직종">
									<option value="">1차직종선택</option>
									<?php 
										foreach($job_type_list as $val){ 
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										$selected = ($job_type_0 == $val['code']) ? "selected" : "";
									?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php } ?>
									</select>
									<span id="wr_career_type_<?php echo $ckey;?>_1_display">
										<select class="ipSelect" style="width:170px;" name="wr_career_type_<?php echo $ckey;?>[]" id="wr_career_type_<?php echo $ckey;?>_1" title="2차직종선택" onchange="career_type_sel_first(this,'wr_career_type_<?php echo $ckey;?>_2');">
										<option value="">2차직종선택</option>
										<?php
										if($job_type_1){
											$pcodeList = $category_control->category_pcodeList('job_type', $job_type_0);
											foreach($pcodeList as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($job_type_1 == $val['code']) ? "selected" : "";
										?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
										<?php 
											}	// foreach end.
										} else {
										?>
											<option value="">1차 직종을 먼저 선택해 주세요</option>
										<?php
										}	// if end.
										?>
										</select>
									</span>
									<span id="wr_career_type_<?php echo $ckey;?>_2_display">
										<select class="ipSelect" style="width:170px;" name="wr_career_type_<?php echo $ckey;?>[]" id="wr_career_type_<?php echo $ckey;?>_2" title="3차직종선택">
										<option value="">3차직종선택</option>
										<?php
										if($job_type_2){
											$pcodeList = $category_control->category_pcodeList('job_type', $job_type_1);
											foreach($pcodeList as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($job_type_2 == $val['code']) ? "selected" : "";
										?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
										<?php 
											}	// foreach end.
										} else {
										?>
											<option value="">2차 직종을 먼저 선택해 주세요</option>
										<?php
										}	// if end.
										?>
										</select>
									</span>
								</td>
							</tr>
							<tr>
								<td >
									<label>근무기간<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label>
									<select name="wr_career_syear[]" class="ipSelect career_required" hname="근무기간">
									<option value="">년</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>' <?php echo ($sdate[0]==$i)?'selected':'';?>><?=$i?></option>
									<?php } ?>
									</select> 
									년 
									<select name="wr_career_smonth[]" class="ipSelect career_required" hname="근무기간">
									<option value="">월</option>
									<?php for($i=1;$i<=12;$i++){?>
									<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($sdate[1]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?></option>
									<?php } ?>
									</select>
									월 ~
									<select name="wr_career_eyear[]" class="ipSelect career_required" hname="근무기간">
									<option value="">년</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>' <?php echo ($edate[0]==$i)?'selected':'';?>><?=$i?></option>
									<?php } ?>
									</select> 
									년 
									<select name="wr_career_emonth[]" class="ipSelect career_required" hname="근무기간">
									<option value="">월</option>
									<?php for($i=1;$i<=12;$i++){?>
									<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($edate[1]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?></option>
									<?php } ?>
									</select>
									월
								</td>
							</tr>
							<tr>
								<td >
									<label>담당업무<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label>
									<input class="ipText career_required" type="text" name="wr_career_job[]" id="wr_career_job_<?php echo $ckey;?>" style="width:120px;" hname="담당업무" value="<?php echo $cval['job'];?>">
								</td>
							</tr>
							<tr>
								<td >
									<label>상세업무</label>
									<textarea class="ipTextarea" name="wr_career_content[]" id="wr_career_content_<?php echo $ckey;?>" style="width:450px; height:50px; padding:10px;" onKeyUp="CountCharText(this, 30, 'career_content_bytes_<?php echo $ckey;?>');"><?php echo nl2br(stripslashes($cval['job']));?></textarea>
									(<span id="career_content_bytes_<?php echo $ckey;?>">0</span>/100자)
								</td>
							</tr>
							<script>
							var career_content_<?php echo $ckey;?> = document.getElementById("wr_career_content_<?php echo $ckey;?>");
							CountCharText(career_content_<?php echo $ckey;?>,30,'career_content_bytes_<?php echo $ckey;?>');
							</script>
							</tbody>
							</table>
							</li>
						</ul>
					</div>
				</td>
			</tr>
			<?php
					}	// foreach end.
				}	// foreach if end.
			}	// if end.
			?>
			</tbody>
			</table>
			</div>
		</div>
		<!--  //경력사항 --> 
		<?php } ?>

		<?php if($form_license['view']=='yes'){ ?>
		<!--  보유자격증  -->
		<div class="listWrap mt30">
			<h2 class="pb5"><img src="../images/tit/person_nav_tit_05.gif"  alt="보유자격증"></h2>
			<div class="registWrap borderB"><!-- style="z-index:500" -->

				<table>
				<caption><span class="skip">보유자격증 입력</span></caption>
				<colgroup><col width="159px"><col width="*"></colgroup>
				<tbody id="license_block">
				<tr>
					<th scope="row"><label>자격증<?php if($form_license['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b2.gif" ><?php } ?></label></th>
					<td>
						<div class="licenseWrap positionR">
							<input type="checkbox" name="wr_license_use"  id="wr_license_use" class="chk" value="1" onclick="use_license(this);" <?php echo ($wr_license_use)?'checked':'';?> <?php echo ($form_license['etc_0'])?'required':'';?> hname="자격증" option="checkbox">
							<label for="wr_license_use"><strong>자격증있음</strong></label>
							<em style="right:0; top:0; display:<?php echo ($wr_license)?'':'none';?>;" class="positionA insert" id="license_add"> <a class="button white" onclick="license_add();"><span>+추가</span></a></em>
						</div>
					</td>
				</tr>
				
				<?php if($mode=='insert' || ($mode=='update' && !$wr_license)){ ?>
				<tr class="wr_license_block" id="wr_license_block_0" style="display:none;">
					<td scope="row"  class="subline"> <label><strong>자격증</strong></label></td>
					<td class="">
						<div class="career1 positionR">
						<ul>
							<li class="pb5 positionR">
							<table>
							<caption><span class="skip">자격증사항 정보입력</span></caption>
							<colgroup><col width="250px"><col width="*"></colgroup>
							<tbody>
							<tr>
								<td>
									<span>
										<label>자격증명<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label>
										<input class="ipText license_required" type="text" name="wr_license_name[]"  id="wr_license_name_0" style="width:150px;" hname="자격증명">
										<!-- <em class="pr10"><a class="button" onclick="license_search_pop('0');"><span>선택</span></a></em> -->
									</span>
								</td>
								<td>
									<span>
										<label>발행처<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label>
										<input class="ipText license_required" type="text" name="wr_license_public[]" id="wr_license_public_0" style="width:150px;" hname="발행처">
									</span>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label>취득년도<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label>
									<select name="wr_license_year[]" class="ipSelect license_required" hname="취득년도">
									<option value="">년</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>'><?=$i?></option>
									<?php } ?>
									</select> 년 
								</td>
							</tr>
							</tbody>
							</table>
							</li>
						</ul>
						</div>
					</td>
				</tr>
				<?php // 수정
					} else if($mode=='update'||$mode=='load'){ 
				if($wr_license){
					foreach($wr_license as $key => $val){
				?>
				<tr class="wr_license_block" id="wr_license_block_<?php echo $key;?>">
					<td scope="row"  class="subline"> <label><strong>자격증</strong></label></td>
					<td class="">
						<div class="career1 positionR">
						<ul>
							<li class="pb5 positionR">
							<em style="right:0; top:5px;" class="positionA delete"> <a class="button white" onclick="license_remove('<?php echo $key;?>');"><span>-삭제</span></a></em>
							<table>
							<caption><span class="skip">자격증사항 정보입력</span></caption>
							<colgroup><col width="250px"><col width="*"></colgroup>
							<tbody>
							<tr>
								<td>
									<span>
										<label>자격증명<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label>
										<input class="ipText license_required" type="text" name="wr_license_name[]"  id="wr_license_name_<?php echo $key;?>" style="width:150px;" hname="자격증명" value="<?php echo $val['name'];?>">
									</span>
								</td>
								<td>
									<span>
										<label>발행처<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label>
										<input class="ipText license_required" type="text" name="wr_license_public[]" id="wr_license_public_<?php echo $key;?>" style="width:150px;" hname="발행처" value="<?php echo $val['public'];?>">
									</span>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label>취득년도<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label>
									<select name="wr_license_year[]" class="ipSelect license_required" hname="취득년도">
									<option value="">년</option>
									<?php for($i=date('Y');$i>=1900;--$i){ ?>
									<option value='<?=$i?>' <?php echo ($val['year']==$i)?'selected':'';?>><?=$i?></option>
									<?php } ?>
									</select> 년 
								</td>
							</tr>
							</tbody>
							</table>
							</li>
						</ul>
						</div>
					</td>
				</tr>
				<?php
						}	// foreach end.
					}	// foreach if end.
				}	// if end.
				?>
				</tbody>
				</table>
			</div>
		</div>
		<!--  //보유자격증 -->
		<?php } ?>

		<?php if($form_language['view']=='yes'){ ?>
		<!--  외국어능력   -->
		<div class="listWrap mt30">
			<h2 class="pb5"> <img src="../images/tit/person_nav_tit_06.gif"  alt="외국어능력"> </h2>
			<div class="registWrap borderB">
				<table>
				<caption><span class="skip">외국어능력 출력</span></caption>
				<colgroup><col width="159px"><col width="*"></colgroup>
				<tbody id="language_block">
				<tr>
					<th scope="row"> <label>외국어능력<?php if($form_language['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b2.gif" ><?php } ?></label></th>
					<td>
						<div class="languageWrap positionR">
						<input type="checkbox" name="wr_language_use" id="wr_language_use" class="chk" value="1" onclick="use_language(this);" <?php echo ($wr_language_use)?'checked':'';?> <?php echo ($form_language['etc_0'])?'required':'';?> hname="자격증" option="checkbox">
						<label for="wr_language_use"><strong>외국어능력 있음</strong></label>
						<em style="right:0; top:0; display:<?php echo ($wr_language)?'':'none';?>;" class="positionA insert" id="language_add"> <a class="button white" onclick="language_add();"><span>+추가</span></a></em>
						</div>
					</td>
				</tr>

				<?php if($mode=='insert' || ($mode=='update' && !$wr_language)){ ?>
				<tr class="wr_language_block" id="wr_language_block_0" style="display:none;">
					<td scope="row"  class="subline"> <label><strong>외국어능력</strong></label></td>
					<td class="">
						<div class="language positionR">
						<ul>
							<li class="positionR">
								<span>
									<label class="pr5">외국어<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label>
									<select title="외국어 선택" name="wr_language_name[]" id="wr_language_name_0" style="width:130px;" class="ipSelect language_required" hname="외국어">
									<option value=""> 외국어선택 </option>
									<?php
										foreach($indi_language_list as $val){
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									?>
									<option value="<?php echo $val['code'];?>"><?php echo $name;?></option>
									<?php } ?>
									</select>
								</span>
								<span>
									<input type="radio" name="wr_language_level_0" id="wr_language_level_0_0" value="0" checked>
									<label for="wr_language_level_0_0">상(회화능숙)</label>
								</span>
								<span>
									<input type="radio" name="wr_language_level_0" id="wr_language_level_0_1" value="1">
									<label for="wr_language_level_0_1">중(일상대화)</label>
								</span>
								<span>
									<input type="radio" name="wr_language_level_0" id="wr_language_level_0_2" value="2">
									<label for="wr_language_level_0_2">하(간단대화)</label>
								</span>
							</li>
							
							<!-- 공인시험 -->                    
							<div id="language_license_block_0">
								<li class="positionR">
									<ul>
										<li class="pb5 positionR">
										<em style="right:0; top:0;" class="positionA delete" id="language_license_addBtn"><a class="button white" onclick="language_license_add(0);"><span>시험추가</span></a></em>
										<span>
											<label>공인시험</label>
											<select title="시험 선택" name="language_license_0[]" id="language_license_0_0" style="width:130px;" class="ipSelect">
											<option value=""> 시험선택 </option>
											<?php
												foreach($indi_language_license_list as $val){
												$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											?>
											<option value="<?php echo $val['code'];?>"><?php echo $name;?></option>
											<?php } ?>
											</select>
										</span>
										<span> 
											<label class="pl10">점수/등급</label>
											<input type="text" style="width:80px;" name="language_license_level_0[]" class="ipText" id="language_license_level_0_0">
										</span>
										<span>
											<label class="pl10">취득년도</label>
											<select name="language_license_year_0[]" class="ipSelect">
											<option value="">년</option>
											<?php for($i=date('Y');$i>=1900;--$i){ ?>
											<option value='<?=$i?>'><?=$i?></option>
											<?php } ?>
											</select> 년
										</span> 
										</li>
									</ul>
								</li>
							</div>
							<!-- //공인시험 -->

							<li class="positionR">
								<span>
									<input type="checkbox" name="wr_language_study_0" id="wr_language_study_0" class="chk" value="1">
									<label class="pr5" for="wr_language_study_0">어학연수 경험있음</label>
									<select title="연수기간 선택" name="wr_language_study_date_0" id="wr_language_study_date_0" style="width:130px;" class="ipSelect">
									<option value="">연수기간 선택</option>
									<?php foreach($language_date as $key => $val){ ?>
									<option value="<?php echo $key;?>"><?php echo $val;?></option>
									<?php } ?>
									</select>
								</span>
							</li>
						</ul>
						</div>
					</td>
				</tr>
				<?php // 수정
					} else if($mode=='update'||$mode=='load'){
				if($wr_language){
					$l_cnt = 0;
					$l = 0;
					foreach($wr_language as $lkey => $lval){
				?>
				<tr class="wr_language_block" id="wr_language_block_<?php echo $lkey;?>">
					<td scope="row"  class="subline"> <label><strong>외국어능력</strong></label></td>
					<td class="">
						<div class="language positionR">
						<ul>
							<em style="right:0; top:0; z-index:100;" class="positionA insert"> <a class="button white" onclick="language_remove('<?php echo $l;?>');"><span>-삭제</span></a></em>
							<li class="positionR">
								<span>
									<label class="pr5">외국어<img alt="필수입력사항" src="../images/icon/icon_b2.gif" ></label>
									<select title="외국어 선택" name="wr_language_name[]" id="wr_language_name_<?php echo $lkey;?>" style="width:130px;" class="ipSelect language_required" hname="외국어">
									<option value=""> 외국어선택 </option>
									<?php
										foreach($indi_language_list as $val){
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										$selected = ($lval['language'] == $val['code']) ? "selected" : "";
									?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php } ?>
									</select>
								</span>
								<span>
									<input type="radio" name="wr_language_level_<?php echo $lkey;?>" id="wr_language_level_<?php echo $lkey;?>_0" value="0" checked>
									<label for="wr_language_level_<?php echo $lkey;?>_0">상(회화능숙)</label>
								</span>
								<span>
									<input type="radio" name="wr_language_level_<?php echo $lkey;?>" id="wr_language_level_<?php echo $lkey;?>_1" value="1" <?php echo ($lval['level']=='1')?'checked':'';?>>
									<label for="wr_language_level_<?php echo $lkey;?>_1">중(일상대화)</label>
								</span>
								<span>
									<input type="radio" name="wr_language_level_<?php echo $lkey;?>" id="wr_language_level_<?php echo $lkey;?>_2" value="2" <?php echo ($lval['level']=='2')?'checked':'';?>>
									<label for="wr_language_level_<?php echo $lkey;?>_2">하(간단대화)</label>
								</span>
							</li>
							
							<!-- 공인시험 -->
							<?php 
								$license = $lval['license'];
								$license_cnt = count($lval['license']['license']);

								for($j=0;$j<$license_cnt;$j++){ 
								$l_cnt++;
									$license_name = $license['license'][$j];
									$license_level = $license['level'][$j];
									$license_year = $license['year'][$j];
							?>
							<div id="language_license_block_<?php echo $lkey;?>" class="language_license_block_<?php echo $lkey;?>">
								<li class="positionR" id="language_license_test_<?php echo $l;?>_<?php echo $l_cnt;?>">
									<ul>
										<li class="pb5 positionR">
										<?php if($j==0){?>
										<em style="right:0; top:0;" class="positionA delete" id="language_license_addBtn"><a class="button white" onclick="language_license_add(<?php echo $l;?>);"><span>시험추가</span></a></em>
										<?php } else { ?>
										<em style="right:0; top:0;" class="positionA delete"><a class="button white" onclick="language_license_remove('<?php echo $l;?>','<?php echo $l_cnt;?>');"><span>시험삭제</span></a></em>
										<?php } ?>
										<span>
											<label>공인시험</label>
											<select title="시험 선택" name="language_license_<?php echo $lkey;?>[]" id="language_license_<?php echo $lkey;?>_<?php echo $j;?>" style="width:130px;" class="ipSelect">
											<option value=""> 시험선택 </option>
											<?php
												foreach($indi_language_license_list as $val){
												$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
												$selected = ($license_name == $val['code']) ? "selected" : "";
											?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
											<?php } ?>
											</select>
										</span>
										<span> 
											<label class="pl10">점수/등급</label>
											<input type="text" style="width:80px;" name="language_license_level_<?php echo $lkey;?>[]" class="ipText" id="language_license_level_<?php echo $lkey;?>_<?php echo $j;?>" value="<?php echo $license_level;?>">
										</span>
										<span>
											<label class="pl10">취득년도</label>
											<select name="language_license_year_<?php echo $lkey;?>[]" class="ipSelect">
											<option value="">년</option>
											<?php for($i=date('Y');$i>=1900;--$i){ ?>
											<option value='<?=$i?>' <?php echo ($license_year==$i)?'selected':'';?>><?=$i?></option>
											<?php } ?>
											</select> 년
										</span> 
										</li>
									</ul>
								</li>
							</div>
							<?php } ?>
							<!-- //공인시험 -->

							<li class="positionR">
								<span>
									<input type="checkbox" name="wr_language_study_<?php echo $lkey;?>" id="wr_language_study_<?php echo $lkey;?>" class="chk" value="1" <?php echo ($lval['study'])?'checked':'';?>>
									<label class="pr5" for="wr_language_study_<?php echo $lkey;?>">어학연수 경험있음</label>
									<select title="연수기간 선택" name="wr_language_study_date_<?php echo $lkey;?>" id="wr_language_study_date_<?php echo $lkey;?>" style="width:130px;" class="ipSelect">
									<option value="">연수기간 선택</option>
									<?php foreach($language_date as $key => $val){ ?>
									<option value="<?php echo $key;?>" <?php echo ($lval['study_date']==$key)?'selected':'';?>><?php echo $val;?></option>
									<?php } ?>
									</select>
								</span>
							</li>
						</ul>
						</div>
					</td>
				</tr>
				<?php
						$l++;
						}	// foreach end.
					}	// foreach if end.
				}	// if end.
				?>
				</tbody>
				</table>
			</div>
		</div>
		<!--  //외국어능력 -->
		<?php } ?>

		<?php if($form_oa['view']=='yes'){ ?>
		<!--  OA능력및특기사항   -->
		<div class="listWrap mt30">
			<h2 class="pb5"> <img src="../images/tit/person_nav_tit_07.gif"  alt="oa능력및특기사항"> </h2>
			<div class="registWrap">
				<table>
				<caption><span class="skip">OA능력및특기사항 입력</span></caption>
				<colgroup><col width="159px"><col width="*"></colgroup>
				<tbody>
				<tr>
					<th scope="row"> <label>OA능력</label></th>
					<td>
						<div class="skillWrap pb5 positionR">
						<ul>
							<li class="sklist">
								<label class="pr5"><img alt="워드" src="../images/icon/icon_word1.gif" width="16" height="16">워드(한글·MS워드)</label>
								<span>
									<input type="radio" name="wr_oa[word]" id="wr_oa_word_0" value="0" checked>
									<label for="wr_oa_word_0">상(표/도구 활용가능)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[word]" id="wr_oa_word_1" value="1" <?php echo ($wr_oa['word']=='1')?'checked':'';?>>
									<label for="wr_oa_word_1">중(문서편집 가능)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[word]" id="wr_oa_word_2" value="2" <?php echo ($wr_oa['word']=='2')?'checked':'';?>>
									<label for="wr_oa_word_2">하(기본 사용)</label>
								</span>
							</li>
							<li class="sklist">
								<label class="pr5"><img alt="프리젠테이션" src="../images/icon/icon_power1.gif" width="16" height="16">프리젠테이션(파워포인트)</label>
								<span>
									<input type="radio" name="wr_oa[pt]" id="wr_oa_pt_0" value="0" checked>
									<label for="wr_oa_pt_0">상(챠트/효과 활용가능)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[pt]" id="wr_oa_pt_1" value="1" <?php echo ($wr_oa['pt']=='1')?'checked':'';?>>
									<label for="wr_oa_pt_1">중(서식/도형 가능)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[pt]" id="wr_oa_pt_2" value="2" <?php echo ($wr_oa['pt']=='2')?'checked':'';?>>
									<label for="wr_oa_pt_2">하(기본사용)</label>
								</span>
							</li>
							<li class="sklist">
								<label class="pr5"><img alt="스프레드시트" src="../images/icon/icon_excel1.gif" width="16" height="16">스프레드시트(엑셀)</label>
								<span>
									<input type="radio" name="wr_oa[sheet]" id="wr_oa_sheet_0" value="0" checked>
									<label for="wr_oa_sheet_0">상(수식/함수 활용가능)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[sheet]" id="wr_oa_sheet_1" value="1" <?php echo ($wr_oa['sheet']=='1')?'checked':'';?>>
									<label for="wr_oa_sheet_1">중(데이터 편집가능)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[sheet]" id="wr_oa_sheet_2" value="2" <?php echo ($wr_oa['sheet']=='2')?'checked':'';?>>
									<label for="wr_oa_sheet_2">하(기본사용)</label>
								</span>
							</li>
							<li class="sklist">
								<label class="pr5"><img alt="인터넷" src="../images/icon/icon_ie1.gif" width="16" height="16">인터넷(정보검색)</label>
								<span>
									<input type="radio" name="wr_oa[internet]" id="wr_oa_internet_0" value="0" checked>
									<label for="wr_oa_internet_0">상(정보수집 능숙)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[internet]" id="wr_oa_internet_1" value="1" <?php echo ($wr_oa['internet']=='1')?'checked':'';?>>
									<label for="wr_oa_internet_1">중(정보수집 가능)</label>
								</span>
								<span>
									<input type="radio" name="wr_oa[internet]" id="wr_oa_internet_2" value="2" <?php echo ($wr_oa['internet']=='2')?'checked':'';?>>
									<label for="wr_oa_internet_2">하(기본사용)</label>
								</span>
							</li>
						</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"> <label>컴퓨터능력<?php if($form_oa['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?></label></th>
					<td>
						<div class="pcskillWrap pb5 clearfix">
						<ul>
						<?php 
							foreach($indi_oa_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = (@in_array($val['code'],$wr_computer)) ? "checked" : "";
						?>
						<li>
							<input type="checkbox" class="chk" id="<?php echo $val['code'];?>" name="wr_computer[]" value="<?php echo $val['code'];?>" <?php echo $checked;?> <?php echo ($form_oa['etc_0'])?'required':'';?> hname="컴퓨터능력" option="checkbox">
							<label for="<?php echo $val['code'];?>"><?php echo $name;?></label>
						</li>
						<?php } ?>
						</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th class="vt" scope="row"> <label>특기사항<?php if($form_oa['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?></label></th>
					<td>
						<div class="specialtyWrap pb5 clearfix">
						<ul>
							<?php 
								foreach($indi_special_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$checked = (@in_array($val['code'],$wr_specialty)) ? "checked" : "";
							?>
							<li><input type="checkbox" class="chk" name="wr_specialty[]" id="<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" <?php echo $checked;?> <?php echo ($form_oa['etc_0'])?'required':'';?> hname="특기사항" option="checkbox"> <label for="<?php echo $val['code'];?>"><?php echo $name;?></label></li>
							<?php } ?>
							<li style="width:250px;">
								<input type="checkbox" class="chk" name="wr_specialty_etc" id="wr_specialty_etc" value="1" onclick="wr_specialty_etc_view(this);" <?php echo ($wr_specialty_etc[0])?'checked':'';?>> <label for="wr_specialty_etc">기타</label>
								<span id="wr_specialty_view" style="display:<?php echo ($wr_specialty_etc[1])?'':'none';?>;">
									<input type="text" style="width:150px; padding:0;" name="wr_specialty_etc_val" class="ipText2" value="<?php echo $wr_specialty_etc[1];?>">
								</span>
							</li>
						</ul>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row" class="bbend"> <label>수상·수료 활동내역<?php if($form_oa['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?></label></th>
					<td class="bbend">
						<div class="licencetextWrap pb5 clearfix">
						<textarea style="width:580px; height:100px; padding:10px;" id="wr_prime" class="ipTextarea" name="wr_prime" <?php echo ($form_oa['etc_0'])?'required':'';?> hname="수상·수료 활동내역"><?php echo stripslashes($get_resume['wr_prime']);?></textarea>
						</div>
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
		<!--  //OA능력및특기사항  -->
		<?php } ?>

		<!--  자기소개서   -->
		<div class="listWrap mt30">
			<h2 class="pb5"><img src="../images/tit/person_nav_tit_08.gif"  alt="자기소개서"><img class="pl5 pb10"alt="필수입력사항" src="../images/icon/icon_b.gif"></h2>
			<div class="registWrap clearfix">
			<table>
			<caption><span class="skip">자기소개서 입력</span></caption>
			<colgroup><col width="159px"><col width="*"></colgroup>
			<tbody>
			<tr>
				<td scope="row" class="bbend vt"> 
					<div class="detailboxWrap pt5 clearfix">
					<ul>
					<li>
						<input type="checkbox" class="chk" id="wr_introduce_all" name="wr_introduce_all" value="1" onclick="ed_wr_introduce.introduce_all(this);">
						<label for="wr_introduce_all"><strong>전체선택</strong></label>
					</li>
					<?php
						foreach($indi_introduce_list as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					?>
					<li>
						<input type="checkbox" class="chk" name="wr_introduce_check" id="<?php echo $val['code'];?>" value="<?php echo $name;?>" onclick="ed_wr_introduce.introduce_checks(this,'<?php echo $val['code'];?>');">
						<label for="<?php echo $val['code'];?>"><?php echo $name;?></label>
					</li>
					<?php } ?>
					</ul>
					</div>
				</td>
				<td class="bbend vt" style="width:720px;">
					<div class="detailbox">
					<?php echo $utility->make_cheditor("wr_introduce", stripslashes($get_resume['wr_introduce']));	// 에디터 생성?>
					</div>
				</td>
			</tr>
			</tbody>
			</table>
			</div>
		</div>
		<!--  //자기소개서  -->

		<!--  포토앨범   -->
		<div class="listWrap mt30">
			<h2 class="pb5"><img src="../images/tit/person_nav_tit_09.gif"  alt="포토앨범"></h2>
			<div class="registWrap clearfix" style="z-index:100;">
				<!--  사진등록 layer  -->        
				<div class="layerPop positionA border_color5" style="display:none; width:420px; top:100%; left:25%; text-align:left;" id="individualPhotoPop">
					<input type="hidden" name="mb_photos" id="mb_photos"/>
					<dl style="">
						<dt style="padding:20px 15px;cursor:pointer;" class="bg_gray1" id="individualPhotoPop_handle">
							<strong>사진 등록</strong>
							<em class="closeBtn"><img width="11" height="11" class="pb5" src="../images/icon/icon_close2.gif" alt="arrow"></em>
						</dt>
						<dd style="padding:10px 15px;">
							<p style="padding-bottom:20px;"><strong>GIF,JPEG,JPG</strong> 파일형식으로,<br>
							<strong>500KB</strong> 용량 이내의 파일만 등록 가능합니다.<br></p>
							<div class="box2" style="border:1px solid #ddd; padding:10px;">
								<input type="file" name="photo_files" id="photo_files" size="32" style="height:20px;" class="txtForm">
							</div>
							<div style="margin:20px auto;" class="btn font_gray bg_white"><a href="javascript:photos_submit();">등록하기<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right3.png" alt="arrow"></a></div>
						</dd>
					</dl>
				</div>
				<!--  //사진등록 layer   -->
				<table>
				<caption><span class="skip">포토앨범 출력</span></caption>
				<colgroup><col width="159px"><col width="*"></colgroup>
				<tbody>
				<tr>
					<td class="bbend vt">
						<div class="pictureWrap positionR clearfix">
						<ul>
							<li>
								<em>사진을 등록하세요</em>
								<div class="picture">
									<img width="150" height="100" alt="photo" src="<?php echo $photo_0;?>" id="mb_photo_0">
									<div class="mt10"> 
										<a class="button white" onclick="update_photos('update', 0);" id="update_0"><span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
										<a class="button white" onclick="update_photos('delete', 0);" id="delete_0"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
									</div>
								</div>
							</li>
							<li>
								<em>사진을 등록하세요</em>
								<div class="picture">
									<img width="150" height="100" alt="photo" src="<?php echo $photo_1;?>" id="mb_photo_1">
									<div class="mt10"> 
										<a class="button white" onclick="update_photos('update', 1);" id="update_1"><span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
										<a class="button white" onclick="update_photos('delete', 1);" id="delete_1"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
									</div>
								</div>
							</li>
							<li>
								<em>사진을 등록하세요</em>
								<div class="picture">
									<img width="150" height="100" alt="photo" src="<?php echo $photo_2;?>" id="mb_photo_2">
									<div class="mt10"> 
										<a class="button white" onclick="update_photos('update', 2);" id="update_2"><span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
										<a class="button white" onclick="update_photos('delete', 2);" id="delete_2"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
									</div>
								</div>
							</li>
							<li>
								<em>사진을 등록하세요</em>
								<div class="picture">
									<img width="150" height="100" alt="photo" src="<?php echo $photo_3;?>" id="mb_photo_3">
									<div class="mt10"> 
										<a class="button white" onclick="update_photos('update', 3);" id="update_3"><span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
										<a class="button white" onclick="update_photos('delete', 3);" id="delete_3"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
									</div>
								</div>
							</li>
						</ul>
						</div>
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
		<!--  //포토앨범  -->

		<?php if($form_etc['view']=='yes' || $form_welfare['view']=='yes'){ ?>
		<!--  부가정보   -->
		<div class="listWrap mt30">
			<h2 class="pb5"><img src="../images/tit/person_nav_tit_10.gif" alt="부가정보"></h2>
			<div class="registWrap">
				<table>
				<caption><span class="skip">부가정보출력</span></caption>
				<colgroup><col width="159px"><col width="*"></colgroup>
				<tbody>
				<?php if($form_etc['view']=='yes'){ ?>
				<tr>
					<th scope="row"><label>장애여부<?php if($form_etc['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?></label></th>
					<td>
						<ul class="handicapWrap clearfix">
							<li class="positionR pr10">
								<input type="radio" class="chk" name="wr_impediment_use" id="wr_impediment_use_0" value="0" checked onclick="impediment_use(this);" <?php echo ($form_etc['etc_0'])?'required':'';?> hname="장애여부" option="radio">
								<label for="wr_impediment_use_0">비대상</label>
							</li>
							<li class="positionR ">
								<input type="radio" class="chk" name="wr_impediment_use" id="wr_impediment_use_1" value="1" onclick="impediment_use(this);" <?php echo ($get_resume['wr_impediment_use'])?'checked':'';?> <?php echo ($form_etc['etc_0'])?'required':'';?> hname="장애여부" option="radio">
								<label for="wr_impediment_use_1">대상</label>
							</li>
						</ul>
						<div class="mt10" id="impediment_block" style="display:<?php echo ($get_resume['wr_impediment_use'])?'':'none';?>;">
							<span class="pr10">
								<label>장애등급</label>
								<select title="장애등급선택" name="wr_impediment_level" id="wr_impediment_level" style="width:130px;" class="ipSelect">
								<option value=""> 장애등급 선택</option>
								<?php 
									foreach($impediment_list as $val){
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($get_resume['wr_impediment_level']==$val['code']) ? "selected" : "";
								?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $val['name'];?></option>
								<?php } ?>
								</select>
							</span>
							<span>
								<label>장애분류</label>
								<input class="ipText" type="text" maxlength="10" name="wr_impediment_name" id="wr_impediment_name" value="<?php echo $get_resume['wr_impediment_name'];?>">
							</span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"> <label>결혼여부<?php if($form_etc['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?></label></th>
					<td>
						<ul class="marriageWrap clearfix">
							<li class="positionR ">
								<input type="radio" class="chk" name="wr_marriage" id="wr_marriage_0" checked value="0" <?php echo ($form_etc['etc_0'])?'required':'';?> hname="결혼여부" option="radio">
								<label for="wr_marriage_0">미혼</label>&nbsp;&nbsp;
							</li>
							<li class="positionR pr10">
								<input type="radio" class="chk" name="wr_marriage" id="wr_marriage_1" value="1" <?php echo ($form_etc['etc_0'])?'required':'';?> hname="결혼여부" option="radio">
								<label for="wr_marriage_1" <?php echo ($get_resume['wr_marriage'])?'checked':'';?>>기혼</label>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<th scope="row"><label>병역여부<?php if($form_etc['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?></label></th>
					<td>
						<ul class="militaryWrap clearfix">
							<li class="positionR pr10">
								<input type="radio" class="chk" name="wr_military" id="wr_military_0" value="0" checked onclick="military_use(this);" <?php echo ($form_etc['etc_0'])?'required':'';?> hname="병역여부" option="radio">
								<label for="wr_military_0">미필</label>
							</li>
							<li class="positionR pr10">
								<input type="radio" class="chk" name="wr_military" id="wr_military_1" value="1" onclick="military_use(this);" <?php echo ($get_resume['wr_military']=='1')?'checked':'';?> <?php echo ($form_etc['etc_0'])?'required':'';?> hname="병역여부" option="radio">
								<label for="wr_military_1">군필</label>
							</li>
							<li class="positionR ">
								<input type="radio" class="chk" name="wr_military" id="wr_military_2" value="2" onclick="military_use(this);" <?php echo ($get_resume['wr_military']=='2')?'checked':'';?> <?php echo ($form_etc['etc_0'])?'required':'';?> hname="병역여부" option="radio">
								<label for="wr_military_2">면제</label>
							</li>
						</ul>
						<div class="mt10" id="military_block" style="display:<?php echo ($get_resume['wr_military']=='1')?'':'none';?>;">
							<span>
								<label>병역내용(군)</label>
								<input class="ipText" type="text" maxlength="10" name="wr_military_type" id="wr_military_type" value="<?php echo $get_resume['wr_military_type'];?>">
							</span>
						</div>
					</td>
				</tr>
				<?php } ?>
				<?php if($form_welfare['view']=='yes'){ ?>
				<tr>
					<th scope="row" class="bbend"> <label>채용우대<?php if($form_welfare['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?></label></th>
					<td  class="bbend">
						<div class="treatmentWrap positionR">
						<ul>
							<li>
								<input type="checkbox" name="wr_preferential_use" id="wr_preferential_use" class="chk" value="1" <?php echo ($get_resume['wr_preferential_use'])?'checked':'';?> <?php echo ($form_welfare['etc_0'])?'required':'';?> hname="채용우대" option="checkbox">
								<label for="wr_preferential_use">국가보훈 대상자</label>
							</li>
							<li  class="treatment2">
								<input type="checkbox" name="wr_treatment_use" id="wr_treatment_use" class="chk" value="1" <?php echo ($get_resume['wr_treatment_use'])?'checked':'';?> <?php echo ($form_welfare['etc_0'])?'required':'';?> hname="채용우대" option="checkbox">
								<label for="wr_treatment_use">고용지원금 대상자</label>
								(
								<?php 
									foreach($indi_treatment_list as $val){
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$checked = (@in_array($val['code'],$wr_treatment_service)) ? "checked" : "";
								?>
								<span>
									<input type="checkbox" name="wr_treatment_service[]" id="<?php echo $val['code'];?>" class="chk" value="<?php echo $val['code'];?>" <?php echo $checked;?>>
									<label for="<?php echo $val['code'];?>"><?php echo $name;?></label>
								</span>
								<?php } ?>
								)
							</li>
						</ul>
						</div>
					</td>
				</tr>
				<?php } ?>
				</tbody>
				</table>
			</div>
		</div>
		<!--  //부가정보   -->
		<?php } ?>

		<!--  이력서설정   -->
		<div class="listWrap mt30">
			<h2 class="pb5"><img src="../images/tit/person_nav_tit_11.gif"  alt="이력서설정"></h2>
			<div class="registWrap">
				<table>
				<caption><span class="skip">이력서설정출력</span></caption>
				<colgroup><col width="159px"><col width="*"></colgroup>
				<tbody>
				<!-- <tr>
					<th scope="row"><label>기본이력서</label></th>
					<td>
						<ul class="basisynWrap clearfix">
						<li class="positionR pr10">
							<input type="checkbox" name="wr_use" id="wr_use" class="chk" value="1">
							<label for="wr_use">기본이력서로 저장합니다</label>
							<em class="help">
								<p>새 이력서 작성시 기본이력서를 불러와서 편집하시면 편리합니다.</p>
								<p>가장 최근에 업데이트된 이력서를 기본이력서로 저장하세요.</p>
							</em>
						</li>
						</ul>
					</td>
				</tr> -->
				<tr>
					<th scope="row"> <label>공개여부</label></th>
					<td>
						<ul class="resumeopenWrap clearfix">
						<li class="positionR pr10">
							<input type="radio" class="chk" name="wr_open" id="wr_open_1" value="1" checked>
							<label for="wr_open_1">공개</label>
						</li>
						<li class="positionR ">
							<input type="radio" class="chk" name="wr_open" id="wr_open_0" value="0" <?php echo ($mode=='update'&&!$get_resume['wr_open'])?'checked':'';?>>
							<label for="wr_open_0">비공개</label>
						</li>
						</ul>
					</td>
				</tr>
				<!-- <tr>
					<th scope="row"><label>공개기간</label></th>
					<td>
						<div class="tropendayselWrap clearfix">
							<select class="ipSelect" name="wr_open_date" id="wr_open_date" title="공개기간선택">
							<option value="">선택</option>
							<?php for($i=1;$i<=12;$i++){?>
							<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?></option>
							<?php } ?>
							</select> 개월
						</div>
					</td>
				</tr> -->
				<tr>
					<th scope="row" class="bbend"> <label>통화가능시간</label></th>
					<td  class="bbend">
						<div class="calltimeWrap positionR">
							<select class="ipSelect" name="wr_calltime[]">
							<option value="">선택</option>
							<?php for($i=0;$i<=23;$i++){ ?>
							<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($wr_calltime[0]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?>시</option>
							<?php } ?>
							</select> 
							~
							<select class="ipSelect" name="wr_calltime[]">
							<option value="">선택</option>
							<?php for($i=0;$i<=23;$i++){ ?>
							<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($wr_calltime[1]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?>시</option>
							<?php } ?>
							</select>
							<em>
								<input type="checkbox" name="wr_calltime_always" id="wr_calltime_always" value="1" <?php echo ($get_resume['wr_calltime_always'])?'checked':'';?>>
								<label class="help" for="wr_calltime_always">언제나가능</label>
							</em>
						</div>
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
		<!--  //이력서설정  -->

		<!--  button -->
		<div class="joinbtn clearfix" style="margin:30px auto;">
			<ul> 
				<li><div class="btn font_white bg_blueBlack"><a onclick="form_submit();">이력서<?php echo ($mode=='insert'||$mode=='load')?'작성':'수정';?><img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right2.png" class="pb5"></a></div></li>
				<li><div class="btn font_gray bg_white"><a href="./alba_resume_list.php">취소<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right3.png" alt="arrow"></a></div></li>
			</ul>
		</div>
		<!--  //button  -->

		</form>

		</div>



	</div>
</section>

<script type="text/javascript" src="<?php echo $alice['individual_path'];?>/skins/default/alba_resume_regist.js"></script>