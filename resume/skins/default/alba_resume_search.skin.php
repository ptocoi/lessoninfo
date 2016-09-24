<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var send_url = "<?php echo $search_list['send_url'];?>";
</script>

<script type="text/javascript" src="<?php echo $alice['resume_path'];?>/skins/default/alba_resume_search.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['resume_path'];?>/">인재정보</a> > <a href="<?php echo $alice['resume_path'];?>/alba_resume_list.php">일반 인재정보</a> > <strong>상세검색</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<form method="get" name="resumeSearchFrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="resumeSearchFrm">
		<input type="hidden" name="mode" value="search"/>
		<input type="hidden" name="view_type" value="<?php echo $view_type;?>"/>
		<input type="hidden" name="page" value="<?php echo $page;?>"/>
		<input type="hidden" name="sort" value="<?php echo $sort;?>"/>

			<!--  인재정보 상세 검색영역 -->
			<div class="listWrap mt20">
				<h2 class=""><img src="../images/tit/job_tit_00.gif"  alt="상세검색"></h2>
				<div class="resumeContentWrap positionR mt10 clearfix" style="border-top:3px solid #404660;">
					<div class="searchBox">
						<ul>
							<li class="workArea clearfix">
								<dl>
									<dt><strong>희망근무지역</strong></dt>
									<dd class="itemBoxArea">

										<div class="bigArea clearfix">
											<ul class="listArea">
											<?php
											if($category_area){
												foreach($category_area as $val){ 
												$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
												$checked = (@in_array($val['code'],$wr_area_0)) ? "checked" : "";
											?>
												<li id="area_top_<?php echo $val['code'];?>"><span><input type="checkbox" name="wr_area_0[]" id="wr_area_0_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" onclick="javascript:area_firsts(this);" <?php echo $checked;?>/><label for="wr_area_0_<?php echo $val['code'];?>"><?php echo $name;?></label></span></li>
											<?php 
												}	// category_area foreach end.
											}	// category_area if end.
											?>
											</ul>
										</div>

										<div id="area_second">
										<?php 
										if($wr_area_1){ 
											foreach($wr_area_0 as $first_area){	// 검색한 2차 값 출력
											$pcode_list = $category_control->category_pcodeList('area',$first_area,""," and `view` = 'yes' ");
											//$first_area_checked = (@in_array($first_area,$_GET['wr_area_0'])) ? 'checked' : '';
											$first_area_checked = ($_GET[$first_area.'_all']) ? 'checked' : '';
											$first_name = $category_control->get_categoryCodeName($first_area);
										?>
										<div class="mt5 middleArea border_blue clearfix" id="area_second_<?php echo $first_area;?>">
											<ul class="listArea">
												<!-- <li id="area_middle_<?php echo $first_area;?>_all" class="area_middle_<?php echo $first_area;?>">
													<span>
														<input type="checkbox" name="wr_area_1[<?php echo $first_area;?>][]" id="wr_area_1_<?php echo $first_area;?>_all" value="all" onclick="area_seconds(this,'<?php echo $first_area;?>',true);"/>
														<label for="wr_area_1_<?php echo $first_area;?>_all">전체</label>
													</span>
												</li> -->
											<?php
											$a = 0;
											foreach($pcode_list as $p_val){
											$name = $utility->remove_quoted($p_val['name']);	 // (쌍)따옴표 등록시 필터링
											$checked = (@in_array($p_val['code'],$wr_area_1[$first_area])) ? 'checked' : '';
											$second_all = (stristr($p_val['code'],'all')) ? 'second_all' : '';
											?>
												<li id="area_middle_<?php echo $p_val['code'];?>" class="area_middle_<?php echo $first_area;?>"><span><input type="checkbox" name="wr_area_1[<?php echo $first_area;?>][]" id="wr_area_1_<?php echo $p_val['code'];?>" value="<?php echo $p_val['code'];?>" onclick="area_seconds(this,'<?php echo $first_area?>');" class="<?php echo $first_area;?> <?php echo $second_all;?>" <?php echo $checked;?>/><label for="wr_area_1_<?php echo $p_val['code'];?>"><?php echo $name;?></label></span></li>
											<?php
											$a++;
											}	// pcode_list foreach end.
											?>
											</ul>
										</div>
										
										<div id="area_third_<?php echo $first_area;?>">
										<?php
										if($wr_area_2){
											if($wr_area_1[$first_area]){
											foreach($wr_area_1[$first_area] as $t_key => $t_list){
											if(stristr($t_list,'all')) continue;	 // all 은 걍 고
											$pcode_list = $category_control->category_pcodeList('area',$t_list,""," and `view` = 'yes' ");
											$second_area_checked = ($_GET[$t_list.'_all']) ? 'checked' : '';
											$first_name = $category_control->get_categoryCodeName($first_area);
											$second_name = $category_control->get_categoryCodeName($t_list);
										?>
										<div class="mt5 smallArea border_color1 bg_color2 clearfix area_third_<?php echo $first_area;?>" id="area_third_<?php echo $t_list;?>">
											<ul class="listArea">
												<!-- <li id="area_sub_<?php echo $second_area;?>_all" class="area_sub_<?php echo $second_area;?>">
													<span>
														<input type="checkbox" name="<?php echo $second_area;?>" id="<?php echo $second_area;?>_all" value="all" onclick="area_thirds(this,'<?php echo $second_area;?>','<?php echo $first_area;?>',true);"/>
														<label for="<?php echo $second_area;?>_all">전체</label>
													</span>
												</li> -->
											<?php 
												foreach($pcode_list as $p_val){ 
												$name = $utility->remove_quoted($p_val['name']);	 // (쌍)따옴표 등록시 필터링
												$checked = (@in_array($p_val['code'],$wr_area_2[$first_area][$p_val['p_code']])) ? "checked" : "";
												$third_all = (stristr($p_val['code'],'all')) ? 'third_all' : '';
											?>
												<li id="area_sub_<?php echo $p_val['code'];?>"><span><input type="checkbox" name="wr_area_2[<?php echo $first_area;?>][<?php echo $t_list;?>][]" id="wr_area_2_<?php echo $p_val['code'];?>" value="<?php echo $p_val['code'];?>" onclick="area_thirds(this,'<?php echo $t_list;?>','<?php echo $first_area;?>');" class="<?php echo $first_area;?>_<?php echo $t_list;?> <?php echo $first_area;?> <?php echo $t_list;?> <?php echo $third_all;?>" <?php echo $checked;?>/><label for="wr_area_2_<?php echo $p_val['code'];?>"><?php echo $name;?></label></span></li>
											<?php } // third area foreach end.?>
											</ul>
										</div>
										<?php
											}
											}
										}
										?>
										</div>

										<?php 
											}	// wr_area_0 foreach end.
										} // wr_area_1 if end.
										?>
										</div>

									</dd>
								</dl>
							</li>
							<li class="partSet clearfix">
								<dl>
									<dt><strong>희망 업직종</strong></dt>
									<dd class="itemBoxPartSet">

										<div class="bigPartSet clearfix">
											<ul class="listJobtype">
												<?php 
												if($job_types){
													foreach($job_types as $val){ 
													$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링							
													$checked = (@in_array($val['code'],$wr_jobtype_0)) ? "checked" : "";
												?>
												<li id="jobtype_top_<?php echo $val['code'];?>"><span><input type="checkbox" name="wr_jobtype_0[]" id="wr_jobtype_0_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" onclick="javascript:jobtype_firsts(this);" <?php echo $checked;?>/><label for="wr_jobtype_0_<?php echo $val['code'];?>"><?php echo $name;?></label></span></li>
												<?php 
													} // foreach end.
												}	// if end.
												?>
											</ul>
										</div>

										<div id="jobtype_second">
										<?php 
										if($wr_jobtype_1){ 
											foreach($wr_jobtype_0 as $first_jobtype){	// 검색한 1차 값 출력
											$pcode_list = $category_control->category_pcodeList('job_type',$first_jobtype,""," and `view` = 'yes' ");
										?>
										<div class="mt5 middlePartSet border_color1 clearfix" id="jobtype_second_<?php echo $first_jobtype;?>">
											<ul class="listArea">
											<?php
											foreach($pcode_list as $p_val){
											$name = $utility->remove_quoted($p_val['name']);	 // (쌍)따옴표 등록시 필터링
											$checked = (in_array($p_val['code'],$wr_jobtype_1[$first_jobtype])) ? 'checked' : '';
											?>
												<li id="jobtype_middle_<?php echo $p_val['code'];?>" class="jobtype_middle_<?php echo $first_jobtype;?>"><span><input type="checkbox" name="wr_jobtype_1[<?php echo $first_jobtype;?>][]" id="wr_jobtype_1_<?php echo $p_val['code'];?>" value="<?php echo $p_val['code'];?>" onclick="jobtype_seconds(this,'<?php echo $first_jobtype?>');" class="<?php echo $first_jobtype;?>" <?php echo $checked;?>/><label for="wr_jobtype_1_<?php echo $p_val['code'];?>"><?php echo $name;?></label></span></li>
											<?php
											}	// pcode_list foreach end.
											?>
											</ul>
										</div>

										<div id="jobtype_third_<?php echo $first_jobtype;?>">
										<?php
										if($wr_jobtype_2){
											foreach($wr_jobtype_1[$first_jobtype] as $t_key => $t_list){
											$pcode_list = $category_control->category_pcodeList('job_type',$t_list,""," and `view` = 'yes' ");
										?>
										<div class="mt5 smallPartSet border_color1 bg_color2 clearfix jobtype_third_<?php echo $first_jobtype;?>" id="jobtype_third_<?php echo $t_list;?>">
											<ul class="listArea">
												<?php 
													foreach($pcode_list as $p_val){ 
													$name = $utility->remove_quoted($p_val['name']);	 // (쌍)따옴표 등록시 필터링
													$checked = (@in_array($p_val['code'],$wr_jobtype_2[$first_jobtype][$p_val['p_code']])) ? "checked" : "";
												?>
												<li id="jobtype_sub_<?php echo $p_val['code'];?>"><span><input type="checkbox" name="wr_jobtype_2[<?php echo $first_jobtype;?>][<?php echo $t_list;?>][]" id="wr_jobtype_2_<?php echo $p_val['code'];?>" value="<?php echo $p_val['code'];?>" onclick="jobtype_thirds(this,'<?php echo $t_list;?>','<?php echo $first_jobtype;?>');" class="<?php echo $first_jobtype;?>_<?php echo $t_list;?> <?php echo $first_jobtype;?>" <?php echo $checked;?>/><label for="wr_jobtype_2_<?php echo $p_val['code'];?>"><?php echo $name;?></label></span></li>
												<?php } // third jobtype foreach end.?>
											</ul>
										</div>
										<?php
											}
										}
										?>
										</div>

										<?php 
											}	// wr_jobtype_0 foreach end.
										} // wr_jobtype_1 if end.
										?>
										</div>

									</dd>
								</dl>    
							</li>
							<li style="display:block;" class="detailGender clearfix">
								<dl>
									<dt><strong>성별</strong></dt>
									<dd class="itemBox clearfix">
										<ul class="listArea">
											<li><input type="radio" name="wr_gender" value="0" id="wr_gender_0" <?php echo ($wr_gender=='0')?'checked':'';?>><label for="wr_gender_0">남자</label></li>
											<li><input type="radio" name="wr_gender" value="1" id="wr_gender_1" <?php echo ($wr_gender=='1')?'checked':'';?>><label for="wr_gender_1">여자</label></li>
											<li><input type="radio" name="wr_gender" value="3" id="wr_gender_3" <?php echo ($wr_gender=='3')?'checked':'';?>><label for="wr_gender_3">무관</label></li>
										</ul>
									</dd>
								</dl>  
							</li>
							<li style="display:block;" class="detailAge clearfix">
								<dl>
									<dt><strong>연령</strong></dt>
									<dd class="itemBox clearfix">
										<span>
											<input type="text" name="wr_age[]" style="width:30px;" id="wr_age_high" class="ipText2" maxlength="3" value="<?php echo $wr_age[0];?>" <?php echo ($wr_age_limit)?'disabled':'';?>> 세 이상 ~ <input type="text" name="wr_age[]" style="width:30px;" id="wr_age_low" class="ipText2" maxlength="3" value="<?php echo $wr_age[1];?>" <?php echo ($wr_age_limit)?'disabled':'';?>> 세 이하
										</span>
										<span class="inc">
											<input type="checkbox" name="wr_age_limit" id="wr_age_limit" value="1" <?php echo ($wr_age_limit)?'checked':'';?> onclick="wr_age_limits(this);">
											<label for="wr_age_limit">무관</label>
										</span>
									</dd>
								</dl>  
							</li>
							<li style="display:block;" class="period clearfix">
								<dl>
									<dt><strong>근무기간</strong></dt>
									<dd class="itemBox clearfix">
										<ul class="listArea">
											<?php 
											if($alba_date_list){
												foreach($alba_date_list as $val){ 
												$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
												$checked = (@in_array($val['code'],$wr_date)) ? "checked" : "";
											?>
												<li><input type="checkbox" value="<?php echo $val['code'];?>" name="wr_date[]" id="wr_date_<?php echo $val['code'];?>" <?php echo $checked;?>><label for="wr_date_<?php echo $val['code'];?>"><?php echo $name;?></label></li>
											<?php
												}	// foreach end.
											}	// if end.
											?>
										</ul>
									</dd>
								</dl>
							</li> 
							<li style="display:block;" class="workweek clearfix">
								<dl>
									<dt><strong>근무요일</strong></dt>
									<dd class="itemBox clearfix">
										<ul class="listArea">
										<?php 
										if($alba_week_list){
											foreach($alba_week_list as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$checked = ($val['code']==$wr_week) ? "checked" : "";
										?>
											<li><input type="radio" name="wr_week" id="wr_week_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" <?php echo $checked;?>><label for="wr_week_<?php echo $val['code'];?>"><?php echo $name;?></label></li>
										<?php
											}	// foreach end.
										}	// if end.
										?>
										</ul>                          
									</dd>
								</dl>
							</li>
							<li style="display:block;" class="workTime clearfix">
								<dl>
									<dt><strong>근무시간</strong></dt>
									<dd class="itemBox clearfix">
										<ul class="listArea">
										<?php
										if($alba_time_list){
											foreach($alba_time_list as $val){
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$checked = (@in_array($val['code'],$wr_time)) ? "checked" : "";
										?>
											<li><input type="checkbox" name="wr_time[]" id="wr_time_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" <?php echo $checked;?>><label for="wr_time_<?php echo $val['code'];?>"><?php echo $name;?></label></li>
										<?php
											}	// foreach end.
										}	// if end.
										?>
										</ul>
									</dd>
								</dl>  
							</li>
							<li style="display:block;" class="jobtype clearfix">
								<dl>
									<dt><strong>근무형태</strong></dt>
									<dd class="itemBox clearfix">
										<ul class="listArea">
										<?php 
										if($work_type_list){ 
											foreach($work_type_list as $val){
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$checked = (@in_array($val['code'],$wr_work_type)) ? "checked" : "";
										?>
										<li><input type="checkbox" name="wr_work_type[]" value="<?php echo $val['code'];?>" id="wr_work_type_<?php echo $val['code'];?>" <?php echo $checked;?>><label for="wr_work_type_<?php echo $val['code'];?>"><?php echo $name;?></label></li>
										<?php
											}	// foreach end.
										}	// if end.
										?>
										</ul>
									</dd>
								</dl>  
							</li>
							<li style="display:block;" class="detailCareer clearfix">
								<dl>
									<dt><strong>경력</strong></dt>
									<dd class="itemBox clearfix">
										<ul class="listArea">
											<li>
												<input type="radio" id="wr_career_use_0" name="wr_career_use" value="0" <?php echo ($wr_career_use=='0')?'checked':'';?> onclick="career_sel(this);">
												<label for="wr_career_use_0" class="pr10" id="label_career_use_0">무관</label>
											</li>
											<li>
												<input type="radio" id="wr_career_use_1" name="wr_career_use" value="1" <?php echo ($wr_career_use=='1')?'checked':'';?> onclick="career_sel(this);">
												<label for="wr_career_use_1" class="pr10" id="label_career_use_1">신입</label>
											</li>
											<li>
												<input type="radio" id="wr_career_use_2" name="wr_career_use" value="2" <?php echo ($wr_career_use=='2')?'checked':'';?> onclick="career_sel(this);">
												<label for="wr_career_use_2" class="pr10" id="label_career_use_2">경력</label>
												<span id="wr_career_display" style="display: <?php echo ($wr_career_use=='2')?'':'none';?>;">
													<select class="ipSelect2" name="wr_career" id="wr_career" hname="경력" option="select">
													<option value=""> 경력선택 </option>
													<?php
													if($job_career_list) {
														foreach($job_career_list as $val){
														$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
														$selected = ($wr_career==$val['code']) ? "selected" : "";
													?>
													<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
													<?php 
														} // foreach end.
													}	// if end.
													?>
													</select>
													이하
												</span>
											</li>
										</ul>
									</dd>
								</dl>
							</li>
							<li style="display:block;" class="detailedu clearfix">
								<dl>
									<dt><strong>학력</strong></dt>
									<dd class="itemBox clearfix">
										<ul class="listArea">
										<?php
										if($indi_ability_list){
											foreach($indi_ability_list as $val){
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$checked = ($val['code']==$wr_school_ability) ? "checked" : "";
										?>
											<li><input type="radio" name="wr_school_ability" id="wr_school_ability_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" <?php echo $checked;?>><label for="wr_school_ability_<?php echo $val['code'];?>"><?php echo $name;?></label></li>
										<?php 
											}	// foreach end.
										}	// if end.
										?>
										</ul>
									</dd>
								</dl>  
							</li> 
							<li style="display:block;" class="license clearfix">
								<dl>
									<dt><strong>보유자격증</strong></dt>
									<dd class="itemBox">
										<span>
											<label class="skip">자격증명</label>
											<input type="text" style="width:200px;" name="wr_license" class="ipText2" id="wr_license" value="<?php echo $wr_license;?>">
											<!-- <em class="pr10"><a class="button"><span>선택</span></a></em> -->
										</span>
									</dd>
								</dl>    
							</li>
							<li style="display:block;" class="foreign clearfix">
								<dl>
									<dt><strong>외국어능력</strong></dt>
									<dd class="itemBox">
										<span class="pb5 positionR">
											<select title="외국어 선택" name="wr_language_name" id="wr_language_name" style="width:130px;" class="ipSelect" hname="외국어">
											<option value=""> 외국어선택 </option>
											<?php
												foreach($indi_language_list as $val){
												$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
												$selected = ($wr_language_name==$val['code']) ? "selected" : "";
											?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
											<?php } ?>
											</select>
										</span>
										<span>
											<input type="radio" name="wr_language_level" value="0" id="wr_language_level_0" <?php echo ($wr_language_level=='0')?'checked':'';?>> <label for="wr_language_level_0">상 <span>(회화능숙)</span></label>
											<input type="radio" name="wr_language_level" value="1" id="wr_language_level_1" <?php echo ($wr_language_level=='1')?'checked':'';?>> <label for="wr_language_level_1">중 <span>(일상대화)</span></label>
											<input type="radio" name="wr_language_level" value="2" id="wr_language_level_2" <?php echo ($wr_language_level=='2')?'checked':'';?>> <label for="wr_language_level_2">하 <span>(간단대화)</span></label>
											<input type="checkbox" class="typeCheckbox" name="wr_language_study" value="1" id="wr_language_study" <?php echo ($wr_language_study=='1')?'checked':'';?>> <label for="wr_language_study" class="experience">어학연수 경험있음</label>
										</span>
									</dd>
								</dl>
							</li>
							<li style="display:block;" class="oaskill clearfix">
								<dl>
									<dt><strong>OA능력</strong></dt>
									<dd class="itemBox">
										<span class="pb5 positionR">
											<select class="ipSelect2" id="wr_oa" name="wr_oa">
											<option value="">선택</option>
											<option value="internet" <?php echo ($wr_oa=='internet')?'selected':'';?>>인터넷</option>
											<option value="word" <?php echo ($wr_oa=='word')?'selected':'';?>>워드</option>
											<option value="sheet" <?php echo ($wr_oa=='sheet')?'selected':'';?>>엑셀</option>
											<option value="pt" <?php echo ($wr_oa=='pt')?'selected':'';?>>파워포인트</option>						    
											</select>
										</span>
										<span>
											<input type="radio" name="wr_oa_level" value="0" id="wr_oa_level_0" <?php echo ($wr_oa_level=='0')?'checked':'';?>> <label for="wr_oa_level_0">상 <span>(고급사용)</span></label>
											<input type="radio" name="wr_oa_level" value="1" id="wr_oa_level_1" <?php echo ($wr_oa_level=='1')?'checked':'';?>> <label for="wr_oa_level_1">중 <span>(중급사용)</span></label>
											<input type="radio" name="wr_oa_level" value="2" id="wr_oa_level_2" <?php echo ($wr_oa_level=='2')?'checked':'';?>> <label for="wr_oa_level_2">하 <span>(기본사용)</span></label>
										</span>
									</dd>
								</dl>    
							</li>
							<li style="display:block;" class="pcskill clearfix">
								<dl>
									<dt><strong>컴퓨터능력</strong></dt>
									<dd class="itemBox clearfix">
										<ul class="listArea">
										<?php 
										if($indi_oa_list){
											foreach($indi_oa_list as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$checked = (@in_array($val['code'],$wr_computer)) ? "checked" : "";
										?>
											<li><input type="checkbox" name="wr_computer[]" id="wr_computer_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" <?php echo $checked;?>><label for="wr_computer_<?php echo $val['code'];?>"><?php echo $name;?></label></li>
										<?php
											}	// foeach end.
										}	// if end.
										?>
										</ul>
									</dd>
								</dl>  
							</li>					
							<li style="display:block;" class="specialty clearfix">
								<dl>
									<dt><strong>특기사항</strong></dt>
									<dd class="itemBox clearfix">
										<ul class="listArea">
										<?php
										if($indi_special_list){
											foreach($indi_special_list as $val){
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$checked = (@in_array($val['code'],$wr_specialty)) ? "checked" : "";
										?>
											<li><input type="checkbox" name="wr_specialty[]" id="wr_specialty_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" <?php echo $checked;?>> <label for="wr_specialty_<?php echo $val['code'];?>"><?php echo $name;?></label></li>
										<?php 
											}	// foreach end.
										}	// if end.
										?>
										</ul>
									</dd>
								</dl>  
							</li>
							<li style="display:block;" class="etc clearfix">
								<dl>
									<dt><strong>기타</strong></dt>
									<dd class="itemBox clearfix">
										<ul class="listArea">
											<!-- <li><input type="checkbox" name="wr_treatment[]" value="photo" id="wr_treatment_photo" <?php echo (@in_array('photo',$wr_treatment))?'checked':'';?>><label for="wr_treatment_photo">사진있는 이력서</label></li> -->
											<li><input type="checkbox" name="wr_treatment[]" value="military" id="wr_treatment_military" <?php echo (@in_array('military',$wr_treatment))?'checked':'';?>><label for="wr_treatment_military">군필자</label></li>
											<li><input type="checkbox" name="wr_treatment[]" value="impediment" id="wr_treatment_impediment" <?php echo (@in_array('impediment',$wr_treatment))?'checked':'';?>><label for="wr_treatment_impediment">장애인</label></li>
											<li><input type="checkbox" name="wr_treatment[]" value="treatment" id="wr_treatment_treatment" <?php echo (@in_array('treatment',$wr_treatment))?'checked':'';?>><label for="wr_treatment_treatment">고용지원금대상자</label></li>
											<?php
											if($indi_treatment_list){
												foreach($indi_treatment_list as $val){
												$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
												$checked = (@in_array($val['code'],$wr_treatment_service)) ? "checked" : "";
											?>
											<li><input type="checkbox" name="wr_treatment_service[]" value="<?php echo $val['code'];?>" id="wr_treatment_service_<?php echo $val['code'];?>" <?php echo $checked;?>><label for="wr_treatment_service_<?php echo $val['code'];?>"><?php echo $name;?></label></li>
											<?php
												}	// foreach end.
											}	// if end.
											?>
										</ul>
									</dd>
								</dl>  
							</li>
							<li class="search clearfix">
								<dl>
									<dt><strong>검색어</strong></dt>
									<dd class="keywordSearch"><input type="text" maxlength="20" style="width:400px;" class="ipText2" id="search_keyword" name="search_keyword" value="<?php echo $search_keyword;?>"></dd>
								</dl>
							</li>
							<li class="resultSet clearfix">
								<div class="resultBox clearfix">
									<dl class="selectBox clearfix" style="display:<?php echo ( $mode=='search' && ($wr_area_0 || $wr_jobtype_0) )?'':'none';?>;">
										<dt class="pb5"><strong>선택된 조건(희망 근무지역,희망 업직종)</strong></dt>
										<dd>
											<ul class="selectList">
											<?php
											if( $mode=='search' ){
												if($area_sels){	// 지역검색
													$k = 0;
													foreach($area_sels as $val){
														$vals_id = strtr($val,'/','_');
														$val_exp = explode('/',$val);
														$val_exp_cnt = count($val_exp);
														$area_sel = array();
														for($i=0;$i<$val_exp_cnt;$i++){
															$area_sel[$k][$i] = $category_control->get_categoryCodeName($val_exp[$i]);
														}
														$area_text = implode($area_sel[$k]," > ");
														if($val_exp[2]){
															$select_id = $val_exp[0]."_".$val_exp[1]."_".$val_exp[2];
														} else if($val_exp[1]){
															$select_id = $val_exp[0]."_".$val_exp[1];
														} else if($val_exp[0]){
															$select_id = $val_exp[0];
														}
														echo "<li id=\"select_".$select_id."\" class=\"area\">".$area_text."&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('area','".$val_exp[0]."','".$val_exp[1]."','".$val_exp[2]."');\">x</button><input type=\"hidden\" name=\"area_sels[]\" value=\"".$val."\" id=\"area_sels_".$vals_id."\"></li>";

													$k++;
													}
												}

												if($jobtype_sels){	// 직종 검색
													$k = 0;
													foreach($jobtype_sels as $val){
														$vals_id = strtr($val,'/','_');
														$val_exp = explode('/',$val);
														$val_exp_cnt = count($val_exp);
														$jobtype_sel = array();
														for($i=0;$i<$val_exp_cnt;$i++){
															$jobtype_sel[$k][$i] = $category_control->get_categoryCodeName($val_exp[$i]);
														}
														$jobtype_text = implode($jobtype_sel[$k]," > ");
														if($val_exp[2]){
															$select_id = $val_exp[0]."_".$val_exp[1]."_".$val_exp[2];
														} else if($val_exp[1]){
															$select_id = $val_exp[0]."_".$val_exp[1];
														} else if($val_exp[0]){
															$select_id = $val_exp[0];
														}
														echo "<li id=\"select_".$select_id."\" class=\"jobtypes\">".$jobtype_text."&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('jobtype','".$val_exp[0]."','".$val_exp[1]."','".$val_exp[2]."');\">x</button><input type=\"hidden\" name=\"jobtype_sels[]\" value=\"".$val."\" id=\"jobtype_sels_".$vals_id."\"></li>";

													$k++;
													}
												}

											}
											?>
											</ul>
										</dd>
									</dl>
									<p class="noSelect" style="display:<?php echo ( $mode=='search' && ($wr_area_0 || $wr_jobtype_0) )?'none':'';?>;">선택된 조건(희망 근무지역,희망 업직종)이 없습니다.</p>
									<p class="btnAction">
										<a href="javascript:searchFrm_submit();" class="searchBtn"><span class="Btn border_color3 bg_color4">검색</span></a><a class="resetBtn" onclick="searchFrm_reset();"><span class="Btn">초기화</span></a>
									</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!--  // 인재정보 상세 검색영역 -->

		</form>

		<!--  일반인재   --> 
		<div id="listForm" class="positionR mt30 clearfix">
			<a name="result"></a>
			<h2 class="clearfix">
				<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 일반인재정보</strong>
				<em class="pl10" style="background: url(../images/main/bg_line_2.gif) no-repeat scroll 3px 50% ;">총 <span class="b"><?php echo number_format($search_list['total_count']);?></span> 건</em>
			</h2>
			<span class="positionA" style="top:-5px; right:0;">
				<select title="pagesize" name="page_rows" style="width:100px;" class="ipSelect2" onchange="list_rows(this);">
				<option value="20" <?php echo ($page_rows=='20')?'selected':'';?>>20개씩 보기</option>
				<option value="30" <?php echo ($page_rows=='30')?'selected':'';?>>30개씩 보기</option>
				<option value="50" <?php echo ($page_rows=='50')?'selected':'';?>>50개씩 보기</option>
				</select>
			</span>
			<table cellspacing="0" summary="일반인재 정보입니다">
			<caption class="skip">일반 인재</caption>
			<colgroup><col width="105px"><col width="*"><col width="50px"><col width="100px"><col width="90px"><col width="70px"></colgroup>
			<thead>
			<tr>
				<th class="name" scope="col">이름</th>
				<th class="title" scope="col">이력서정보</th>
				<th scope="col"></th>
				<th class="pay" scope="col">희망급여</th>
				<th class="local" scope="col">희망지역</th>
				<th class="modDate" scope="col">수정일</th>
			</tr>
			</thead>
			<tbody>
			<?php 
			if($search_list['result']) {
				foreach($search_list['result'] as $val){ 
				$no = $val['no'];
				$list = $alba_resume_user_control->get_resume_service($no,"",80);
			?>
			<tr id="list_<?php echo $no;?>">
				<td class="name">
					<span><?php echo $list['name'];?>
						<?php if($list['is_photo']){?>
						<em class="photo"><img class="vb pb2" src="../images/icon/icon_photo1.gif" width="16" height="16"></em>
						<?php } ?>
					</span>
					<span class="block">(<?php echo $list['wr_gender'];?> <span><?php echo $list['wr_age'];?></span>세)</span>
				</td>
				<td class="title">
					<a href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $no;?>">
					<?php echo $list['service_busy'];?>
					<?php echo $list['service_icon'];?>
					<span class="title"><?php echo $list['subject'];?></span>
					<span class="kind text_color1"><?php echo $list['job_type'];?></span>
					<span class="career">
						<img class="vb"alt="경력" src="../images/icon/icon_career.gif" width="23" height="14"> 	
						<?php echo $list['career'];?>
					</span>
					<?php if($list['license']){ ?>
					<span class="license">
						<img class="vb" alt="자격증" src="../images/icon/icon_license.gif" width="36" height="14"> <?php echo $list['license'];?>
					</span>
					<?php } ?>
					</a>
				</td>
				<td class="icons">
					<div><a target="_blank" href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $no;?>" class="window" id=""><img class="bg_orang" width="13" height="13" src="../images/icon/icon_newWindow.png" alt="새창으로 열기"></a></div>
					<div><a href="javascript:resume_scrap('<?php echo $no;?>');" class="star" id=""><img class="bg_orang" width="13" height="13" src="../images/icon/icon_star.png" alt="공고스크랩"></a></div>
					<div><a href="javascript:list_open('<?php echo $no;?>');" class="plus" id=""><img class="bg_orang" width="13" height="13" src="../images/icon/icon_plus.png" alt="상세보기"></a></div>
				</td>
				<td class="pay">
					<span class="pay">
						<em class="number"><?php echo $list['wr_pay'];?></em> 
						<em class="icon"><?php echo $list['wr_pay_type'];?></em>
					</span>
				</td>
				<td class="local"><?php echo $utility->str_cut($list['wr_area'],18,"");?> </td>
				<td class="modDate"><span><?php echo $list['last2'];?></span></td>
			</tr>
			<?php
				}	// foreach end.
			} else {
			?>
			<tr><td colspan="5" class="tc no_listText"><span>검색된 인재정보가 없습니다.</span></td></tr>
			<?php } // if end.?>
			</tbody>
			</table>

			<!-- view layer -->
			<div class="quickView clearfix positionA" style="display:none; left:5px; z-index:2000;" id="list_quickView"></div>
			<!-- // view layer -->

			<?php include_once $alice['include_path']."/paging.php";?>

		</div>
		<!--  // 일반인재  --> 

		</div>
	</div>
</section>

<script>
var list_open = function( no ){	// 공고 상세보기
	var $list = $('#list_'+no);
	var position_top = $list.position().top;

	$('#list_quickView').hide();
	$('#list_quickView').load('./views/_load/alba_resume.php', { mode:'list', no:no }, function(){
		position_tops = position_top;
		$(this).css({
			"top" : position_tops+"px",
			"left" : "0px"
		});
		$(this).show();
	});

}
var list_close = function(){	// 플래티넘 레이어 닫기
	$('#list_quickView').hide();
}
</script>