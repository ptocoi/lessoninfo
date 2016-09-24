<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/alba_customized.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <a href="<?php echo $alice['company_path'];?>/alba_scrap.php">서비스 관리</a> > <strong>맞춤 인재정보</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/company_tit_03.gif" width="142" height="25" alt="맞춤 인재정보"></h2>
			<em class="titEm mb20">
				<ul>
				<li>맞춤정보를 이용하시면 매번 검색을 이용하실 필요가 없습니다.</li>
				</ul>
			</em>
			<!--  컨텐츠  -->
			<div class="companyContentWrap">

				<!--  맞춤 서비스 관리   --> 
				<div id="listForm" class="positionR mt30 clearfix"> 
					<h2 class="skip">맞춤 인재정보 설정</h2>

						<ul class="tabMenu clearfix">
							<li class="tab1 <?php echo $tab1_on;?>"><a href="javascript:sel_tabs('tab1');"><strong>맞춤 인재정보</strong> [<?php echo number_format($custom_list['total_count']);?>건]</a></li>
							<li class="tab2 <?php echo $tab2_on;?>"><a href="javascript:sel_tabs('tab2');"><strong>조건 설정·수정</strong></a></li>
						</ul>

						<div class="customList1 mb30" style="display:<?php echo $tab1_display;?>;"><!--  맞춤인재정보   --> 

						<form method="get" name="CustomSearchFrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="CustomSearchFrm">
						<input type="hidden" name="mode" value="search"/>
						<input type="hidden" name="wr_id" value="<?php echo $member['mb_id'];?>"/>

							<div class="corpList1 tc pt5 pb5">
								<span>
								<label for="item1"><strong class="pr10">맞춤 조건 선택</strong></label>        
								<select class="ipSelect" style="width:280px;" name="no" id="search_no" title="맞춤조건 선택">
								<!-- <option value="">---------------------------------------</option> -->
								<?php 
									$n = 1;
									foreach($custom_titles as $val){ 
									$selected = ($search_no==$val['no']) ? 'selected' : '';
								?>
								<option value="<?php echo $val['no'];?>" <?php echo $selected;?>><?php echo "[".sprintf('%02d',$n)."] ".$val['wdate']." 저장";?></option>
								<?php 
									$n++;
									} // foreach end.
								?>
								</select>      
								<a class="button pl5" onclick="CustomSearchFrmSubmit();"><span>검색</span></a>
								</span>
							</div>        
							<table cellspacing="0" summary="오늘 등록된 인재의  정보입니다">
							<caption class="skip">오늘의 인재</caption>
							<colgroup><col width="10px"><col width="105px"><col width="*"><col width="100px"><col width="90px"><col width="70px"></colgroup>
							<thead>
							<tr>
								<th scope="col"><input name="check_all" type="checkbox"></th>
								<th scope="col">이름</th>
								<th scope="col">이력서정보</th>
								<th scope="col">희망급여</th>
								<th scope="col">희망지역</th>
								<th scope="col">수정일</th>
							</tr>
							</thead>
							<tbody>
							<?php if(!$custom_list['total_count']){ ?>
							<?php } else { ?>
							
							<?php 
								foreach($custom_list['result'] as $val){ 
								$no = $val['no'];
								$list = $alba_resume_user_control->get_resume_service($no,"",80);
								if($list['is_delete']){	// 삭제된 이력서 체크
									$resume_href = "javascript:is_delete();";
									$href_target = "";
								} else {
									$resume_href = $alice['resume_path'] . "/alba_resume_detail.php?no=" . $no;
									$href_target = "target=\"_blank\"";
								}
								$mailto = ($list['is_delete']) ? "javascript:is_delete();" : "mailto://".$list['mb_email'];
							?>
							<tr>
								<td class="tc"><input type="checkbox" name='no[]' class='check_all' value="<?php echo $val['no'];?>" resume_no="<?php echo $val['no'];?>"></td>
								<td scope="row" class="name">
									<span><?php echo $list['name'];?>
										<?php if($list['is_photo']){ ?>
										<em class="pl5 photo"><img class="vb" src="../images/icon/icon_photo1.gif" width="16" height="16"></em>
										<?php } ?>
									</span>
									<span class="block">(<?php echo $list['wr_gender'];?> <span><?php echo $list['wr_age'];?></span>세)</span>
								</td>
								<td class="title">
									<a <?php echo $href_target;?> href="<?php echo $resume_href;?>">
										<span class="title"><?php echo $val['wr_subject'];?></span>
									</a>
									<span class="kind text_blue"><?php echo $list['job_type'];?></span>
									<span class="career">
										<img  class="vb"alt="경력" src="../images/icon/icon_career.gif" width="23" height="14"> 	
										<?php echo $list['career'];?>
									</span>
									<?php if($list['license']){ ?>
									<span class="license">
										<img class="vb" alt="자격증" src="../images/icon/icon_license.gif" width="36" height="14"> <?php echo $list['license'];?>
									</span>
									<?php } ?>
								</td>
								<td class="pay">
									<span class="pay">
										<em class="number"><?php echo $list['wr_pay'];?></em> 
										<em class="icon"><?php echo $list['wr_pay_type'];?></em>
									</span>
								</td>
								<td class="local"><?php echo $list['wr_area'];?> </td>
								<td class="modDate"><span><?php echo $list['last2'];?></span></td>
							</tr>
							<?php } // foreach end. ?>

							<?php } // if end. ?>
							</tbody>
							</table>
							<div class="btnBottom mt10"><a class="button white" onclick="sel_resume_scrap();"><span>인재스크랩</span></a> </div>
							<?php include_once $alice['include_path']."/paging.php";?>

						</form>

						</div>
						<!--  맞춤인재정보 end   --> 

						<div class="customList2 mb30" style="display:<?php echo $tab2_display;?>;">

						<form method="post" name="CustomSetFrm" action="./process/custom.php" id="CustomSetFrm">
						<input type="hidden" name="mode" value="custom_update"/><!-- 맞춤 인재정보 조건 설정.수정 -->
						<input type="hidden" name="wr_id" value="<?php echo $member['mb_id'];?>"/>

							<div class="corpList2 tc pt5 pb5">
								<!-- <span class="pt5" style="float:left;">
									<input type="radio" name="type" id="type_insert" value="insert" checked> <label for="type_insert"><strong>신규등록</strong></label>
									<input type="radio" name="type" id="type_update" value="update"> <label for="type_update"><strong>수정하기</strong></label>
								</span> -->
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
									<!-- <a class="button pl5"><span>초기화</span></a> -->
								</span>
								<em style="background: url(../images/icon/icon_bul_!1.gif) no-repeat scroll 0 0; padding-left:15px;" class="help text_help">선택하시고 저장하시면 선택하신 맞춤 조건이 수정됩니다.</em>
							</div>
							<div class="companyRegistWrap">          
								<table>
								<caption><span class="skip">희망근무조건출력</span></caption>
								<colgroup><col width="159px"><col width="*"></colgroup>
								<tbody>
								<tr>
									<th scope="row"><label>업직종</label></th>
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
													<em style="right:0; top:5px;" class="positionR insert"> <a class="button white" onclick="job_type_remove(1);"><span>-삭제</span></a></em>
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
													<em style="right:0; top:5px;" class="positionR insert"> <a class="button white" onclick="job_type_remove(2);"><span>-삭제</span></a></em>
												</div>

											</li>
										</div>
									</td>
								</tr>
								<tr>
									<th scope="row"> <label>근무지</label></th>
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
													<em style="right:0; top:5px;" class="positionR insert"> <a class="button white" onclick="area_remove(1);"><span>-제거</span></a></em>
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
													<em style="right:0; top:5px;" class="positionR insert"> <a class="button white" onclick="area_remove(2);"><span>-제거</span></a></em>
												</div>
											</li>
											<em>
												<input type="checkbox" class="typeCheckbox" id="wr_home_work" name="wr_home_work" value="1" <?php echo ($get_custom['wr_home_work'])?'checked':'';?>>
												<label class="help" for="wr_home_work">재택근무가능</label>
											</em>
										</div>
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
											<select class="ipSelect" style="width:130px;" id="wr_time" name="wr_time" title="근무시간" required hname="근무시간">
											<option value=""> -- 근무시간 --</option>
											<?php 
												foreach($alba_time_list as $val){ 
												$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
												$selected = ($get_custom['wr_time'] == $val['code']) ? "selected" : "";
											?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
											<?php } ?>
											</select>
											<em>
												<input type="checkbox" class="typeCheckbox" id="wr_work_direct" name="wr_work_direct" value="1" <?php echo ($get_custom['wr_work_direct'])?'checked':'';?>>
												<label class="help" for="wr_work_direct">즉시출근가능</label>
											</em>
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
											<!-- <p class="addCnt">
												<?php
												if($job_age) {
													foreach($job_age as $val){
													$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
													$checked = (@in_array($val['code'],$wr_age_etc)) ? "checked" : "";
												?>
												<input type="checkbox" id="wr_age_etc_<?php echo $val['code'];?>" name="wr_age_etc[]" value="<?php echo $val['code'];?>" <?php echo $checked;?>>
												<label for="wr_age_etc_<?php echo $val['code'];?>"><?php echo $name;?></label>
												<?php 
													} // foreach end.
												}	// if end.
												?>
											</p> -->
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
													<input type="checkbox" name="wr_work_type[]" id="wr_work_type_<?php echo $val['code'];?>" class="chk" value="<?php echo $val['code'];?>" required hname="근무형태" <?php echo $checked;?>>
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
									<li><div class="btn font_gray bg_white"><a href="javascript:customDelete('<?php echo $no;?>');">조건 삭제<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
									<?php } else { ?>
									<li><div class="btn font_gray bg_white"><a href="javascript:history.go(-1);">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
									<?php } ?>
								</ul>
							</div>        
						</div>

						</form>
					
					</div>
					<!--  컨텐츠 end   --> 
				</div>
			</div>
		</div>
	</div>  
</section>