<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<script type="text/javascript" src="<?php echo $alice['individual_path'];?>/skins/default/alba_customized.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['individual_path'];?>/alba_scrap.php">맞춤서비스 관리</a> > <strong>맞춤 채용정보</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/person_tit_01.gif" width="146" height="25" alt="맞춤 채용정보"></h2>
			<em class="titEm mb20">
			<ul>
				<li>나만을 위한 맞춤 채용정보를 설정하여 확인할수 있습니다.</li>
			</ul>
			</em>
			<div class="personContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="positionR mt30 clearfix"> <!--  맞춤 서비스 관리   --> 
					<h2 class="skip">맞춤채용정보</h2>
					<ul class="tabMenu clearfix">
						<li class="tab1 <?php echo $tab1_on;?>"><a href="javascript:sel_tabs('tab1');"><strong>맞춤 채용정보</strong> [<?php echo number_format($custom_list['total_count']);?>건]</a></li>
						<li class="tab2 <?php echo $tab2_on;?>"><a href="javascript:sel_tabs('tab2');"><strong>조건 설정·수정</strong></a></li>
					</ul>

					<div class="customList1 mb30" style="display:<?php echo $tab1_display;?>;"><!--  맞춤채용정보   --> 

						<form method="get" name="CustomSearchFrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="CustomSearchFrm">
						<input type="hidden" name="mode" value="search"/>
						<input type="hidden" name="wr_id" value="<?php echo $member['mb_id'];?>"/>

						<div class="corpList1 tc pt5 pb5">
							<span>
								<label for="item1"><strong class="pr10">맞춤 조건 선택</strong></label>        
								<select class="ipSelect" style="width:280px;" name="no" id="search_no" title="맞춤조건 선택">
								<?php 
								if($custom_titles){
									$n = 1;
									foreach($custom_titles as $val){ 
									$selected = ($search_no==$val['no']) ? 'selected' : '';
								?>
								<option value="<?php echo $val['no'];?>" <?php echo $selected;?>><?php echo "[".sprintf('%02d',$n)."] ".$val['wdate']." 저장";?></option>
								<?php 
									$n++;
									} // foreach end.
								} else {
								?>
								<option value="">설정하신 맞춤 조건이 없습니다.</option>
								<?php }	// if end. ?>
								</select>      
								<a class="button pl5" onclick="CustomSearchFrmSubmit();"><span>검색</span></a>
							</span>
						</div>
						</form>
						<table cellspacing="0">
						<colgroup><!-- <col width="10px"> --><col width="100px"><col width="*"><col width="100px"><col width="60px"><col width="100px"><col width="70px"><col width="80px"></colgroup>
						<thead>
						<tr>
							<!-- <th scope="col"><input type="checkbox"  value="1" name="chkAll"></th> -->
							<th scope="col">회사명</th>
							<th scope="col">채용공고</th>
							<th scope="col">근무지역</th>
							<th scope="col">성별</th>
							<th scope="col">급여</th>
							<th scope="col">등록일</th>
							<th scope="col">마감일</th>
						</tr>
						</thead>
						<tbody>
						<?php if(!$custom_list['total_count']){ ?>
						<tr><td class="tc no_listText" colspan="8"><span>맞춤 채용정보 기업이 없습니다.</span></td></tr>
						<?php } else { ?>
						
						<?php 
							foreach($custom_list['result'] as $val){ 
							$no = $val['no'];
							$list = $alba_user_control->get_alba_service($no,"",80);
							$wdate = strtr($list['datetime'],'-','.');
							if($list['is_delete']){
								$alba_href = $mail_view = "javascript:is_delete();";
								$target_href = "";
							} else {
								$alba_href = $alice['alba_path'] . "/alba_detail.php?no=" . $no;
								$target_href = "target=\"_blank\"";
								$mail_view = "javascript:mail_view('".$val['no']."');";
							}
							$company_info = $user_control->get_member_company($val['wr_id']);
							if($company_info['mb_left']){
								$company_href = "javascript:is_left();";
								$company_target = "";
							} else {
								$company_href = $alice['alba_path'] . "/company_info.php?mb_id=" . $val['wr_id'];
								$company_target = "target=\"_blank\"";
							}
						?>
						<tr>
							<!-- <td class="tc"><input type="checkbox" name='no[]' class='check_all' value="<?php echo $val['no'];?>"></td> -->
							<td class="tl pl10"><span><a <?php echo $company_target;?> href="<?php echo $company_href;?>"><?php echo stripslashes($list['company_name']);?></a></span></td>
							<td class="tl"><div class="pl10"><span><a <?php echo $target_href;?> href="<?php echo $alba_href;?>"><?php echo $list['subject'];?></a></span></div></td>
							<td class="tc"><span><?php echo $utility->str_cut($list['wr_area'],16,'');?></span></td>
							<td class="tc"><span><?php echo $list['wr_gender'];?></span></td>
							<td class="tr pr10 pay">
								<span class="pay">
									<?php
									if($list['wr_pay_conference']){
										echo $alba_user_control->pay_conference[$list['wr_pay_conference']];
									} else {
									?>
										<em class="number"><?php echo $list['wr_pay'];?></em>원
										<em class="icon"><?php echo $list['wr_pay_type'];?></em>
									<?php } ?>
								</span>
							</td>
							<td class="tc"><span><?php echo $wdate;?></span></td>
							<td class="tc"><span><?php echo $list['volume'];?></span></td>
						</tr>
						<?php } // foreach end. ?>

						<?php } // if end. ?>
						</tbody>  
						</table>
						<!-- <div class="btnBottom mt10">
							<a class="button white"><span>공고스크랩</span></a> 
						</div> -->
						
						<?php include_once $alice['include_path']."/paging.php";?>

					</div>

					<div class="customList2 mb30" style="display:<?php echo $tab2_display;?>;"><!--  조건설정수정   --> 

					<form method="post" name="CustomSetFrm" action="./process/custom.php" id="CustomSetFrm">
					<input type="hidden" name="mode" value="custom_update"/><!-- 맞춤 인재정보 조건 설정.수정 -->
					<input type="hidden" name="wr_id" value="<?php echo $member['mb_id'];?>"/>

						<div class="corpList2 tc pt5 pb5">
							<span class="tc">
								<label for="item1"><strong class="pr10">맞춤 조건 선택</strong></label>        
								<select class="ipSelect" style="width:280px;" name="sel_custom" id="sel_custom" title="맞춤조건 선택" onchange="sel_customs(this);">
								<option value="">---------------------------------------</option>
								<?php 
									$n = 1;
									foreach($custom_titles as $val){ 
									$selected = ($_GET['no']==$val['no']) ? 'selected' : '';
								?>
								<option value="<?php echo $val['no'];?>" <?php echo $selected;?>><?php echo "[".sprintf('%02d',$n)."] ".$val['wdate']." 저장";?></option>
								<?php 
									$n++;
									} 
								?>
								</select>      
							</span>
							&nbsp;<em class="help text_help" style="background: url(../images/icon/icon_bul_!1.gif) no-repeat scroll 0 0; padding-left: 15px;">선택하시고 저장하시면 선택하신 맞춤 조건이 수정됩니다.</em>
						</div>
						<div class="personRegistWrap">          
							<table>
							<caption><span class="skip">희망근무조건출력</span></caption>
							<colgroup><col width="159px"><col width="*"></colgroup>
							<tbody>
							<tr>
								<th scope="row"><label>업직종</label></th>
								<td>
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
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row"> <label>근무지</label></th>
								<td>
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
										</div>

										<div id="wr_area2_block" style="display:<?php echo ($wr_area4)?'':'none';?>;">
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
										</div>
									</li>  
								</td>
							</tr>
							<tr>
								<th scope="row"> <label>근무일시</label></th>
								<td>
									<div class="wantpayWrap positionR">
										<select class="ipSelect" style="width:130px;" id="wr_date" name="wr_date" title="근무기간" required hname="근무기간">
										<option value=""> -- 근무기간 --</option>
										<?php 
											foreach($alba_date_list as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($get_custom['wr_date'] == $val['code']) ? "selected" : "";
										?>
										<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
										<?php } ?>
										</select>
										<select class="ipSelect" style="width:130px;" id="wr_week" name="wr_week" title="근무요일" required hname="근무요일">
										<option value=""> -- 근무요일 --</option>
										<?php 
											foreach($alba_week_list as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($get_custom['wr_week'] == $val['code']) ? "selected" : "";
										?>
										<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
										<?php } ?>
										</select>
										
										<select class="ipSelect wr_time" name="wr_stime[]" id="wr_stime" hname="근무시간" option="select" <?php echo ($wr_time_conference)?'disabled':'';?>>
										<option value="">선택</option>
										<?php for($i=0;$i<=23;$i++){ ?>
										<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($wr_stime[0]&&$wr_stime[0]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?>시</option>
										<?php } ?>
										</select>
										<select class="ipSelect wr_time" name="wr_stime[]" id="wr_smin" hname="근무시간" option="select" <?php echo ($wr_time_conference)?'disabled':'';?>>
										<option value="">선택</option>
										<?php for($i=0;$i<=5;$i++){?>
										<option value="<?php echo $i;?>0" <?php echo ($wr_stime[1]==$i.'0')?'selected':'';?>><?php echo $i;?>0분</option>
										<?php } ?>
										</select>
										<span id="nextworktime">~</span>
										<select class="ipSelect wr_time" name="wr_etime[]" id="wr_etime" <?php echo ($wr_time_conference)?'':'required';?> hname="근무시간" option="select" <?php echo ($wr_time_conference)?'disabled':'';?>>
										<option value="">선택</option>
										<?php for($i=0;$i<=23;$i++){ ?>
										<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($wr_etime[0]&&$wr_etime[0]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?>시</option>
										<?php } ?>
										</select>
										<select class="ipSelect wr_time" name="wr_etime[]" id="wr_emin" <?php echo ($wr_time_conference)?'':'required';?> hname="근무시간" option="select" <?php echo ($wr_time_conference)?'disabled':'';?>>
										<option value="">선택</option>
										<?php for($i=0;$i<=5;$i++){?>
										<option value="<?php echo $i;?>0" <?php echo ($wr_etime[1]==$i.'0')?'selected':'';?>><?php echo $i;?>0분</option>
										<?php } ?>
										</select>
										<input type="checkbox" class="typeCheckbox" id="wr_time_conference" name="wr_time_conference" value="1" onclick="time_conference(this);"  <?php echo ($wr_time_conference)?'checked':'';?>>
										<label for="wr_time_conference">시간협의</label>

									</div>
								</td>
							</tr>
							<tr>
								<th scope="row"> <label>성별</label></th>
								<td>
									<div class="genderWrap">
										<input type="radio" name="wr_gender" id="wr_gender_0" value="0" class="chk" checked>
										<label for="wr_gender_0">성별무관</label>
										<input type="radio" name="wr_gender" id="wr_gender_1" value="1" class="chk" <?php echo ($get_custom['wr_gender']=='1')?'selected':'';?>><label for="wr_gender_1">남자</label>
										<input type="radio" name="wr_gender" id="wr_gender_2" value="2" class="chk" <?php echo ($get_custom['wr_gender']=='2')?'selected':'';?>><label for="wr_gender_2">여자</label>
									</div>
								</td>
							</tr>              
							<tr>
								<th class="vt" scope="row"> <label>연령</label></th>
								<td>
									<div class="ageWrap positionR">
										<input type="radio" class="chk" id="wr_age_limit_0" name="wr_age_limit" value="0" onclick="age_sel(this);" hname="연령" option="radio" checked>
										<label for="wr_age_limit_0">연령무관</label>
										<input type="radio"  class="chk" id="wr_age_limit_1" name="wr_age_limit" value="1" onclick="age_sel(this);" hname="연령" option="radio" <?php echo ($wr_age_limit=='1')?'checked':'';?>>
										<label for="wr_age_limit_1">연령제한 있음</label>

										<span id="wr_age_display" style="display:<?php echo ($wr_age_limit)?'':'none';?>;">
											<input type="text"  maxlength="2" style="width:30px;text-align:center;" class="ipText wr_age" id="wr_sage" name="wr_sage" value="<?php echo $wr_age[0];?>" hname="제한연령">
											<label>세 이상~</label>
											<input type="text"  maxlength="2" style="width:30px;text-align:center;" class="ipText wr_age" id="wr_eage" name="wr_eage" value="<?php echo $wr_age[1];?>" hname="제한연령">
											<label>세 이하</label>
										</span>
									</div>
								</td>
							</tr>              
							<tr>
								<th class="vt" scope="row"> <label>근무형태</label></th>
								<td>
									<div class="jobtypeWrap positionR">
										<ul>
										<?php 
											foreach($work_type_list as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$checked = (@in_array($val['code'],$wr_work_type)) ? "checked" : "";
										?>
											<li>
												<input type="checkbox" name="wr_work_type[]" id="wr_work_type_<?php echo $val['code'];?>" class="chk" value="<?php echo $val['code'];?>" hname="근무형태" <?php echo $checked;?>>
												<label for="wr_work_type_<?php echo $val['code'];?>"><?php echo $name;?></label>
											</li>
										<?php } ?>
										</ul>
									</div>                  
								</td>
							</tr>
							<tr>
								<th class="bbend" scope="row"> <label>메일링수신</label></th>
								<td class="bbend">
									<div class="jobtypeWrap positionR">
										<ul>
											<li>
												<input type="checkbox" name="wr_email" id="wr_email" class="chk" value="1" hname="메일링수신" <?php echo ($get_custom['wr_email'])?'checked':'';?>>
												<label for="wr_email">이메일수신</label>&nbsp;&nbsp;
												<input type="checkbox" name="wr_sms" id="wr_sms" class="chk" value="1" hname="SMS수신" <?php echo ($get_custom['wr_sms'])?'checked':'';?>>
												<label for="wr_sms">SMS수신</label>
											</li>
										</ul>
									</div>
								</td>
							</tr>
							</tbody>
							</table>
							</div>
							<div style="margin:30px auto;" class="doubleBtn clearfix">
							<ul> 
								<li><div class="btn font_white bg_blueBlack"><a href="javascript:customFrmSubmit();">저장<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
								<?php if($no){ ?>
								<li><div class="btn font_gray bg_white"><a href="javascript:customDelete('<?php echo $_GET['no'];?>');">조건 삭제<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
								<?php } else { ?>
								<li><div class="btn font_gray bg_white"><a href="javascript:history.go(-1);">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
								<?php } ?>
							</ul>
							</div>        
						</div>
					
					</form>

					</div><!--  조건설정수정 end   --> 
				
				</div>

			</div>
		</div>
	</div>
</section>