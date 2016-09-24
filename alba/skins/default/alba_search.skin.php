<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var send_url = "<?php echo $search_list['send_url'];?>";
</script>

<script type="text/javascript" src="<?php echo $alice['alba_path'];?>/skins/default/alba_search.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['alba_path'];?>/">채용정보</a> > <a href="<?php echo $alice['alba_path'];?>/alba_list.php">일반 채용정보</a> > <strong>상세검색</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<form method="get" name="albaSearchFrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="albaSearchFrm">
		<input type="hidden" name="mode" value="search"/>
		<input type="hidden" name="view_type" value="<?php echo $view_type;?>"/>
		<input type="hidden" name="page" value="<?php echo $page;?>"/>
		<input type="hidden" name="sort" value="<?php echo $sort;?>"/>

		<!--  전체 정규직 정보 검색영역 -->
		<div class="listWrap mt20">
			<h2 class=""><img src="../images/tit/job_tit_00.gif"  alt="상세검색"></h2>
			<div class="jobContentWrap positionR mt10 clearfix" style="border-top:3px solid #404660;">
				<div class="searchBox">
				<ul>
				<li class="workArea clearfix" style="display:block;"><!--  시도별 정규직 정보,대학가 정규직 정보에서 display:none -->
					<dl>
					<dt><strong>근무지역</strong></dt>
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
							$pcode_list = $category_control->category_pcodeList('area',$first_area,"", " and `view` = 'yes' ");
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
							$pcode_list = $category_control->category_pcodeList('area',$t_list,"", " and `view` = 'yes' ");
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
				<li class="subway clearfix" style="display:block;"><!--  역세권 정규직 정보에서 display:none -->
					<dl>
					<dt><strong>역세권</strong></dt>
					<dd class="itemBoxSubway ">

						<div class="bigSubway clearfix">
							<ul class="listSubway">
								<?php 
								if($category_subway){
									foreach($category_subway as $val){
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링							
									$checked = (@in_array($val['code'],$wr_subway_0)) ? "checked" : "";
								?>
								<li id="subway_top_<?php echo $val['code'];?>"><span><input type="checkbox" name="wr_subway_0[]" id="wr_subway_0_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" onclick="javascript:subway_firsts(this);" <?php echo $checked;?>/><label for="wr_subway_0_<?php echo $val['code'];?>"><?php echo $name;?></label></span></li>
								<?php 
									} // foreach end.
								}	// if end.
								?>
							</ul>
						</div>

						<div id="subway_second">
						<?php 
						if($wr_subway_1){ 
							foreach($wr_subway_0 as $first_subway){	// 검색한 1차 값 출력
							$pcode_list = $category_control->category_pcodeList('subway',$first_subway,"", " and `view` = 'yes' ");
						?>
						<div class="mt5 middleSubway border_color1 clearfix" id="subway_second_<?php echo $first_subway;?>">
							<ul class="listArea">
							<?php
							foreach($pcode_list as $p_val){
							$name = $utility->remove_quoted($p_val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = (in_array($p_val['code'],$wr_subway_1[$first_subway])) ? 'checked' : '';
							?>
								<li id="subway_middle_<?php echo $p_val['code'];?>" class="subway_middle_<?php echo $first_subway;?>"><span><input type="checkbox" name="wr_subway_1[<?php echo $first_subway;?>][]" id="wr_subway_1_<?php echo $p_val['code'];?>" value="<?php echo $p_val['code'];?>" onclick="subway_seconds(this,'<?php echo $first_subway?>');" class="<?php echo $first_subway;?>" <?php echo $checked;?>/><label for="wr_subway_1_<?php echo $p_val['code'];?>"><?php echo $name;?></label></span></li>
							<?php
							}	// pcode_list foreach end.
							?>
							</ul>
						</div>

						<div id="subway_third_<?php echo $first_subway;?>">
						<?php
						if($wr_subway_2){
							foreach($wr_subway_1[$first_subway] as $t_key => $t_list){
							$pcode_list = $category_control->category_pcodeList('subway',$t_list,"", " and `view` = 'yes' ");
						?>
						<div class="mt5 smallSubway border_color1 bg_color2 clearfix subway_third_<?php echo $first_subway;?>" id="subway_third_<?php echo $t_list;?>">
							<ul class="listArea">
								<?php 
									foreach($pcode_list as $p_val){ 
									$name = $utility->remove_quoted($p_val['name']);	 // (쌍)따옴표 등록시 필터링
									$checked = (@in_array($p_val['code'],$wr_subway_2[$first_subway][$p_val['p_code']])) ? "checked" : "";
								?>
								<li id="subway_sub_<?php echo $p_val['code'];?>"><span><input type="checkbox" name="wr_subway_2[<?php echo $first_subway;?>][<?php echo $t_list;?>][]" id="wr_subway_2_<?php echo $p_val['code'];?>" value="<?php echo $p_val['code'];?>" onclick="subway_thirds(this,'<?php echo $t_list;?>','<?php echo $first_subway;?>');" class="<?php echo $first_subway;?>_<?php echo $t_list;?> <?php echo $first_subway;?>" <?php echo $checked;?>/><label for="wr_subway_2_<?php echo $p_val['code'];?>"><?php echo $name;?></label></span></li>
								<?php } // third subway foreach end.?>
							</ul>
						</div>
						<?php
							}
						}
						?>
						</div>

						<?php 
							}	// wr_subway_0 foreach end.
						} // wr_subway_1 if end.
						?>
						</div>

					</dd>
					</dl>    
				</li>
				<li class="subway clearfix" style="display:block;"><!--  역세권 정규직 정보에서 display:none -->
					<dl>
					<dt><strong>대학가</strong></dt>
					<dd class="itemBoxSubway ">
						<div class="schoolWrap pb5 positionR">
							<select title="지역 선택" name="wr_college_area" id="wr_college_area" style="width:75px;" class="ipSelect2" onchange="search_college(this);">
							<option value="">지역</option>
							<?php 
							if($category_area) { 
								foreach($category_area as $key => $val){
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_college_area==$val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
								}	// foreach end.
							}	// if end.
							?>
							</select>
							<span id="college_vicinity">
							<?php 
							if($wr_college_vicinity){ 
								$vicinity_list = $category_control->category_pcodeList('job_college',$wr_college_area,"", " and `view` = 'yes' ");	// 지역별 대학

							?>
								<select title="인근대학 선택" name="wr_college_vicinity" id="wr_college_vicinity" style="width:305px;" class="ipSelect2">
									<option value="">인근대학 선택</option>
									<?php 
										foreach($vicinity_list as $val){ 
										$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
										$selected = ($wr_college_vicinity==$val['code']) ? "selected" : "";
									?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php } // vicinity_list foreach end. ?>
								</select>
							<?php } else { ?>
								<select title="인근대학 선택" name="wr_college_vicinity" id="wr_college_vicinity" style="width:305px;" class="ipSelect2"><option value="">인근대학 선택</option></select>
							<?php } // wr_college_vicinity if end. ?>
							</span>
						</div>
					</dd>
					</dl>    
				</li>

				<li class="partSet clearfix" style="display:block;"><!--  업직종 정규직 정보에서 display:none -->
					<dl>
					<dt><strong>업직종</strong></dt>
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
							$pcode_list = $category_control->category_pcodeList('job_type',$first_jobtype,"", " and `view` = 'yes' ");
						?>
						<div class="mt5 middlePartSet border_color1 clearfix" id="jobtype_second_<?php echo $first_jobtype;?>">
							<ul class="listArea">
							<?php
							foreach($pcode_list as $p_val){
							$name = $utility->remove_quoted($p_val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = @(in_array($p_val['code'],$wr_jobtype_1[$first_jobtype])) ? 'checked' : '';
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
							$pcode_list = $category_control->category_pcodeList('job_type',$t_list,"", " and `view` = 'yes' ");
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

				<!--  근무기간 -->
				<li class="period clearfix" style="display:block;">
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
				<!--  // 근무기간 -->

				<!--  근무요일 -->
				<li class="workweek clearfix" style="display:block;">
					<dl>
					<dt><strong>근무요일</strong></dt>
					<dd class="itemBox clearfix">
						<ul class="listArea">
						<?php 
						if($alba_week_list){
							foreach($alba_week_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = (@in_array($val['code'],$wr_week)) ? "checked" : "";
						?>
							<li><input type="checkbox" value="<?php echo $val['code'];?>" name="wr_week[]" id="wr_week_<?php echo $val['code'];?>" <?php echo $checked;?>><label for="wr_week_<?php echo $val['code'];?>"><?php echo $name;?></label></li>
						<?php
							}	// foreach end.
						}	// if end.
						?>
						</ul>
					</dd>
					</dl>  
				</li>
				<!--  // 근무요일 -->  

				<!--  근무시간 -->
				<li class="workTime clearfix" style="display:block;">
					<dl>
					<dt><strong>근무시간</strong></dt>
					<dd class="itemBox clearfix">
						<select  style="width:122px;" class="ipSelect2 wr_time" name="wr_stime[]" id="wr_stime" <?php echo ($wr_time_conference)?'disabled':'';?>>
						<option value="">선택</option>
						<?php for($i=0;$i<=23;$i++){ ?>
						<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($mode=='search'&&!$wr_time_conference&&$wr_stime[0]==sprintf('%02d',$i))?'selected':'';?>><?php echo sprintf('%02d',$i);?>시 </option>
						<?php } ?>
						</select>
						<select style="width:122px;" class="ipSelect2 wr_time" name="wr_stime[]" id="wr_smin" <?php echo ($wr_time_conference)?'disabled':'';?>>
						<option value="">선택</option>
						<?php for($i=0;$i<=5;$i++){?>
						<option value="<?php echo $i;?>0" <?php echo (!$wr_time_conference&&$wr_stime[1]==$i.'0')?'selected':'';?>><?php echo $i;?>0분</option>
						<?php } ?>
						</select>
						<span id="nextworktime">~</span>
						<select style="width:122px;" class="ipSelect2 wr_time" name="wr_etime[]" id="wr_etime" <?php echo ($wr_time_conference)?'disabled':'';?>>
						<option value="">선택</option>
						<?php for($i=0;$i<=23;$i++){ ?>
						<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($mode=='search'&&!$wr_time_conference&&$wr_etime[0]==sprintf('%02d',$i))?'selected':'';?>><?php echo sprintf('%02d',$i);?>시</option>
						<?php } ?>
						</select>
						<select style="width:122px;" class="ipSelect2 wr_time" name="wr_etime[]" id="wr_emin" <?php echo ($wr_time_conference)?'disabled':'';?>>
						<option value="">선택</option>
						<?php for($i=0;$i<=5;$i++){?>
						<option value="<?php echo $i;?>0" <?php echo (!$wr_time_conference&&$wr_etime[1]==$i.'0')?'selected':'';?>><?php echo $i;?>0분</option>
						<?php } ?>
						</select>
						<input type="checkbox" id="wr_time_conference" name="wr_time_conference" value="1" onclick="time_conference(this);" <?php echo ($wr_time_conference)?'checked':'';?>>
						<label for="wr_time_conference">시간협의</label>
					</dd>
					</dl>  
				</li>
				<!-- // 근무시간 -->  

				<!--  급여 -->
				<li class="workPay clearfix" style="display:block;">
					<dl>
					<dt><strong>급여</strong></dt>
					<dd class="itemBox clearfix">
						<ul class="listArea">
						<?php
						if($alba_pay_list){
							foreach($alba_pay_list as $val){
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = (@in_array($val['code'],$wr_pay_type)) ? "checked" : "";
						?>
							<li><input type="checkbox" value="<?php echo $val['code'];?>" name="wr_pay_type[]" id="wr_pay_type_<?php echo $val['code'];?>" <?php echo $checked;?>><label for="wr_pay_type_<?php echo $val['code'];?>"><?php echo $name;?></label></li>
						<?php
							}	// foreach end.
						}	// if end.
						?>
							<span>
								<input type="text" name="wr_pay[]" style="width:50px;" id="wr_pay_high" class="ipText2" maxlength="10" value="<?php echo $wr_pay[0];?>"> 원 이상 ~ 
								<input type="text" name="wr_pay[]" style="width:50px;" id="wr_pay_low" class="ipText2" maxlength="10" value="<?php echo $wr_pay[1];?>"> 원 이하
							</span>
						</ul>
					</dd>
					</dl>  
				</li>
				<!-- // 급여 -->  

				<!-- 성별 -->
				<li class="detailGender clearfix" style="display:block;">
					<dl>
					<dt><strong>성별</strong></dt>
					<dd class="itemBox clearfix">
						<ul class="listArea">
							<li><input type="radio" name="wr_gender" value="1" id="wr_gender_1" <?php echo ($wr_gender=='1')?'checked':'';?>><label for="wr_gender_1">남자</label></li>
							<li><input type="radio" name="wr_gender" value="2" id="wr_gender_2" <?php echo ($wr_gender=='2')?'checked':'';?>><label for="wr_gender_2">여자</label></li>
							<li><input type="checkbox" value="1" name="wr_gender_not" id="wr_gender_not" <?php echo ($wr_gender_not)?'checked':'';?>><label for="wr_gender_not">무관포함</label></li>
						</ul>
					</dd>
					</dl>  
				</li>
				<!-- // 성별  -->  

				<!--  연령 -->
				<li class="detailAge clearfix" style="display:block;">
					<dl>
					<dt><strong>연령</strong></dt>
					<dd class="itemBox clearfix">
						<span><input type="text" style="width:50px;" class="ipText2" maxlength="3" id="wr_age" name="wr_age" value="<?php echo $wr_age;?>"> 세</span>
						<span class="inc"><input type="checkbox" value="1" id="wr_age_limit" name="wr_age_limit" <?php echo ($wr_age_limit)?'checked':'';?>><label for="wr_age_limit">무관포함</label></span>
					</dd>
					</dl>  
				</li>
				<!--  // 연령 --> 

				<!--  학력 -->
				<li class="detailedu clearfix" style="display:block;">
					<dl>
					<dt><strong>학력</strong></dt>
					<dd class="itemBox clearfix">
						<ul class="listArea">
						<?php
						if($job_ability_list) {
							foreach($job_ability_list as $val){
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = ($wr_ability==$val['code']) ? "checked" : "";
						?>
							<li><input type="radio" name="wr_ability" id="wr_ability_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" <?php echo $checked;?>><label for="wr_ability_<?php echo $val['code'];?>"><?php echo $name;?></label></li>
						<?php
							}	// foreach end.
						}	// if end.
						?>
						</ul>
					</dd>
					</dl>  
				</li>
				<!-- // 학력  -->

				<!--  우대조건 -->
				<li class="preference clearfix" style="display:block;">
					<dl>
					<dt><strong>우대조건</strong></dt>
					<dd class="itemBox clearfix">
						<ul class="preferenceTerms">
						<?php 
						if($preferential_list) {
							foreach($preferential_list as $val){
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = (@in_array($val['code'],$wr_preferential)) ? "checked" : "";
						?>
							<li><input type="checkbox" name="wr_preferential[]" value="<?php echo $val['code'];?>"  id="wr_preferential_<?php echo $val['code'];?>" <?php echo $checked;?>><label for="wr_preferential_<?php echo $val['code'];?>"><?php echo $name;?></label></li>
						<?php
							}	// foreach end.
						}	// if end.
						?>
						</ul>
					</dd>
					</dl>  
				</li>
				<!--  // 우대조건 -->

				<!--  복리후생 -->
				<li class="welfare clearfix" style="display:block;">
					<dl>
					<dt><strong>복리후생</strong></dt>
					<dd class="itemBox clearfix">
					<?php
					if($job_welfare){
						foreach($job_welfare as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					?>
						<dl class="clearfix">
							<dt scope="row"><?php echo $name;?></dt>
							<dd>
								<?php
									$pcodeList = $category_control->category_pcodeList('job_welfare', $val['code'],"", " and `view` = 'yes' ");
									foreach($pcodeList as $pval){
									$p_name = $utility->remove_quoted($pval['name']);	 // (쌍)따옴표 등록시 필터링
									$checked = (@in_array($pval['code'],$wr_welfare)) ? "checked" : "";
								?>
								<span><input type="checkbox" name="wr_welfare[]" id="wr_welfare_<?php echo $pval['code'];?>" value="<?php echo $pval['code'];?>" <?php echo $checked;?>><label for="wr_welfare_<?php echo $pval['code'];?>"><?php echo $p_name;?></label></span>
								<?php
									}	// foreach end.
								?>
							</dd>
						</dl>
					<?php
						}	// foreach end.
					}	// if end.
					?>
					</dd>
					</dl>  
				</li>
				<!--  // 복리후생 --> 

				<!--  모집대상 -->
				<li class="etc clearfix" style="display:block;">
					<dl>
					<dt><strong>모집대상</strong></dt>
					<dd class="itemBox clearfix">
						<ul class="listArea">
						<?php
						if($job_targets){
							foreach($job_targets as $val){
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = (@in_array($val['code'],$wr_target)) ? "checked" : "";
						?>
							<li><input type="checkbox" name="wr_target[]" value="<?php echo $val['code'];?>" id="wr_target_<?php echo $val['code'];?>" <?php echo $checked;?>><label for="wr_target_<?php echo $val['code'];?>"><?php echo $name;?></label></li>
						<?php
							}	// foreach end.
						}	// if end.
						?>
						</ul>
					</dd>
					</dl>  
				</li>
				<!--  // 모집대상 -->  

				<!--  고용형태 -->
				<li class="jobtype clearfix" style="display:block;">
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
				<!--  // 고용형태 -->

				<!--  지원방법 -->
				<li class="passtype clearfix" style="display:block;">
					<dl>
					<dt><strong>지원방법</strong></dt>
					<dd class="itemBox clearfix">
						<ul class="listArea">
							<li><input type="checkbox" name="wr_requisition[]" id="wr_requisition_online" value="online" <?php echo (@in_array('online',$wr_requisition))?'checked':'';?>><label for="wr_requisition_online">온라인지원</label></li>
							<li><input type="checkbox" name="wr_requisition[]" id="wr_requisition_email" value="email" <?php echo (@in_array('email',$wr_requisition))?'checked':'';?>><label for="wr_requisition_email">e-메일지원</label></li>
							<li><input type="checkbox" name="wr_requisition[]" id="wr_requisition_phone" value="phone" <?php echo (@in_array('phone',$wr_requisition))?'checked':'';?>><label for="wr_requisition_phone">전화연락</label></li>
							<li><input type="checkbox" name="wr_requisition[]" id="wr_requisition_meet" value="meet" <?php echo (@in_array('meet',$wr_requisition))?'checked':'';?>><label for="wr_requisition_meet">방문접수</label></li>
							<li><input type="checkbox" name="wr_requisition[]" id="wr_requisition_post" value="post" <?php echo (@in_array('post',$wr_requisition))?'checked':'';?>><label for="wr_requisition_post">우편</label></li>                
							<li><input type="checkbox" name="wr_requisition[]" id="wr_requisition_fax" value="fax" <?php echo (@in_array('fax',$wr_requisition))?'checked':'';?>><label for="wr_requisition_fax">팩스</label></li>
							<li><input type="checkbox" name="wr_requisition[]" id="wr_requisition_homepage" value="homepage" <?php echo (@in_array('homepage',$wr_requisition))?'checked':'';?>><label for="wr_requisition_homepage">홈페이지</label></li> 
						</ul>
					</dd>
					</dl>  
				</li>
				<!--  // 지원방법 -->   

				<!--  검색기간 -->
				<li class="searchterm clearfix" style="display:block;">
					<dl>
					<dt><strong>등록일</strong></dt>
					<dd class="itemBox clearfix">
						<ul class="listArea">
							<li><input type="radio" value="all" id="wr_wdate_all" name="wr_wdate" <?php echo ($wr_wdate=='all')?'checked':'';?>><label for="wr_wdate_all"><em class="slt">전체</em></label></li>
							<li><input type="radio" value="7 day" id="wr_wdate_7day" name="wr_wdate" <?php echo ($wr_wdate=='7 day')?'checked':'';?>><label for="wr_wdate_7day">7일 이내 등록</label></li>
							<li><input type="radio" value="3 day" id="wr_wdate_3day" name="wr_wdate" <?php echo ($wr_wdate=='3 day')?'checked':'';?>><label for="wr_wdate_3day">3일 이내 등록</label></li>
							<li><input type="radio" value="today" id="wr_wdate_today" name="wr_wdate" <?php echo ($wr_wdate=='today')?'checked':'';?>><label for="wr_wdate_today">오늘 등록</label></li>
						</ul>
					</dd>
					</dl>  
				</li>
				<!--  // 검색기간 -->

				<li class="search clearfix">
					<dl>
						<dt><strong>검색어</strong></dt>
						<dd class="keywordSearch">
							<input type="text" maxlength="20" style="width:400px;" class="ipText2" id="search_keyword" name="search_keyword"  value="<?php echo $search_keyword;?>">
						</dd>
					</dl>
				</li>
				<li class="resultSet clearfix">
					<div class="resultBox clearfix">
					<!-- 선택조건 있을때 display-->
						<dl class="selectBox clearfix" style="display:<?php echo ( $mode=='search' && ($wr_area_0 || $wr_subway_0 || $wr_jobtype_0) )?'':'none';?>;">
							<dt class="pb5"><strong>선택된 조건(근무지역,역세권,업직종)</strong></dt>
							<dd>
								<ul class="selectList ">
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

									if($subway_sels){	// 역세권 검색
										$k = 0;
										foreach($subway_sels as $val){
											$vals_id = strtr($val,'/','_');
											$val_exp = explode('/',$val);
											$val_exp_cnt = count($val_exp);
											$subway_sel = array();
											for($i=0;$i<$val_exp_cnt;$i++){
												$subway_sel[$k][$i] = $category_control->get_categoryCodeName($val_exp[$i]);
											}
											$subway_text = implode($subway_sel[$k]," > ");
											if($val_exp[2]){
												$select_id = $val_exp[0]."_".$val_exp[1]."_".$val_exp[2];
											} else if($val_exp[1]){
												$select_id = $val_exp[0]."_".$val_exp[1];
											} else if($val_exp[0]){
												$select_id = $val_exp[0];
											}
											echo "<li id=\"select_".$select_id."\" class=\"subways\">".$subway_text."&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('subway','".$val_exp[0]."','".$val_exp[1]."','".$val_exp[2]."');\">x</button><input type=\"hidden\" name=\"subway_sels[]\" value=\"".$val."\" id=\"subway_sels_".$vals_id."\"></li>";

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
						<p class="noSelect" style="display:<?php echo ( $mode=='search' && ($wr_area_0 || $wr_subway_0 || $wr_jobtype_0) )?'none':'';?>;">선택된 조건이 없습니다.</p><!-- 선택조건 없을때 display-->
						<p class="btnAction">
							<a href="javascript:searchFrm_submit();" class="searchBtn"><span class="Btn border_color3 bg_color6">검색</span></a><a class="resetBtn" onclick="searchFrm_reset();"><span class="Btn">초기화</span></a>
						</p>
					</div>
				</li>
				</ul>
				</div>
			</div>
		</div>
		<!--  // 전체 정규직 정보 검색영역 -->

		</form>

		<div id="popup" class="positionA content_wrap clearfix" style="z-index:9999;display:none;left:50%;"></div>

		<!--  일반채용   --> 
			<div id="JobListForm" class="positionR mt30 clearfix">
				<a name="result"></a>
				<h2 class="clearfix">
					<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 일반채용정보</strong>
					<em class="pl10" style="background: url(../images/main/bg_line_2.gif) no-repeat scroll 3px 50% ;">총 <span class="b"><?php echo number_format($search_list['total_count']);?></span> 건</em>
				</h2>
				<div class="ListFunc positionA" style="top:-5px; right:0;">
				<span class="choiceLink pr5">
					<span class="Link1"><a href="./alba_search.php?<?php echo $search_list['send_url'];?>&view_type=list#result"><img width="25" height="19" alt="" src="../images/icon/icon_choiceLink1_<?php echo (!$view_type||$view_type=='list')?'on':'off';?>.gif" class="vb" id="choiceLink_list"></a></span>
					<span class="Link2"><a href="./alba_search.php?<?php echo $search_list['send_url'];?>&view_type=gallery#result"><img width="25" height="19" alt="" src="../images/icon/icon_choiceLink2_<?php echo ($view_type=='gallery')?'on':'off';?>.gif" class="vb" id="choiceLink_gallery"></a></span>
				</span>
					<span>
						<select title="pagesize" name="sort" style="width:100px;" class="ipSelect2" onchange="list_sorting(this);">
						<option value="wr_wdate" <?php echo ($sort=='wr_wdate')?'selected':'';?>>최근등록순</option>
						<option value="wr_volume_date" <?php echo ($sort=='wr_volume_date')?'selected':'';?>>마감임박순</option>
						</select>
					</span>
					<span>
						<select title="pagesize" name="page_rows" style="width:100px;" class="ipSelect2" onchange="list_rows(this);">
						<option value="20" <?php echo ($page_rows=='20')?'selected':'';?>>20개씩 보기</option>
						<option value="30" <?php echo ($page_rows=='30')?'selected':'';?>>30개씩 보기</option>
						<option value="50" <?php echo ($page_rows=='50')?'selected':'';?>>50개씩 보기</option>
						</select>
					</span>
				</div>
				</span>

			<?php if(!$view_type || $view_type=='list'){?>
			<div id="list_view">
				<!--  일반보기  -->   
				<table cellspacing="0" summary="정규직 정보입니다">
				<caption class="skip">일반채용</caption>
				<colgroup><col width="90px"><col width="50px"><col width="*"><col width="110px"><col width="60px"><col width="100px"><col width="55px"><col width="80px"></colgroup>
				<thead>
				<tr>
					<th class="local" scope="col">근무지</th>
					<th class="icons" scope="col"></th>
					<th class="title" scope="col">채용제목</th>
					<th class="company" scope="col">기업명</th>
					<th class="gender" scope="col">성별</th>
					<th class="pay" scope="col">급여</th>
					<th class="date" scope="col">등록일</th>
					<th class="finish" scope="col" width="80px">마감일</th>
				</tr>
				</thead>
				<tbody>
				<?php 
				if($search_list['result']){
					foreach($search_list['result'] as $val){ 
					$no = $val['no'];
					//$list = $alba_user_control->get_alba_list($no,"","",60);
					$list = $alba_user_control->get_alba_service($no,"sub_list",49);
					$wdate = strtr($list['datetime3'],'-','/');
				?>
				<tr id="list_<?php echo $no;?>">
					<td class="local"><?php echo $utility->str_cut($list['wr_area'],19,"");?></td>
					<td  class="icons">
						<div><a id="" class="window" href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
						<div><a id="" class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png" class="bg_orang"></a></div>
						<div><a id="" class="plus" href="javascript:list_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png" class="bg_orang"></a></div>
					</td>        
					<td class="title"><?php echo $list['service_busy'];?><?php echo $list['service_icon'];?><a class="color1" href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $no;?>"><span><?php echo $list['subject'];?></span></a></td>
					<td class="company"><a href="#"><span><?php echo $list['company_name'];?> </span></a></td>
					<td class="gender"><?php echo $list['wr_gender'];?>&nbsp;</td>
					<td class="pay">
						<?php 
						if(!$list['wr_pay'] || $list['wr_pay']==0){ 
							echo "협의";
						} else { 
						?>
						<span class="number"><?php echo $list['wr_pay'];?>원</span><em class="icon"><?php echo $list['wr_pay_type'];?></em>
						<?php } ?>
					</td>
					<td class="date"><?php echo $wdate;?></td>
					<td class="finish"><?php echo $list['volume'];?></td>
				</tr>
				<?php 
					} // foreach end.
				} else {
				?>
				<tr><td colspan="8" class="tc no_listText"><span>채용정보가 없습니다.</span></td></tr>
				<?php } // if end.?>
				</tbody>
				</table>
				<!--  // 일반보기  --> 
			</div>

				<!-- view layer -->
				<div class="quickView clearfix positionA" style="display:none; left:5px; z-index:2000;" id="list_quickView"><div class="positionA" style="top:0;right:0;">close</div></div>
				<!-- // view layer -->

			<?php } else if($view_type=='gallery'){ ?>

			<div id="gallery_view">
			<?php 
			if($search_list['result']){
				foreach($search_list['result'] as $key => $val){ 
				$no = $val['no'];
				$list = $alba_user_control->get_alba_list($no);

				$biz_foundation = $category_control->get_categoryCode('20130626171611_2769');	// 설립일
				$biz_sale = $category_control->get_categoryCode('20130626172556_1808');	 // 매출액
				$biz_member_count = $category_control->get_categoryCode('20130626172544_6551');	 // 사원수
				$form_option = $category_control->get_categoryCode('20130626171524_3156');	// 기업형태

				if($biz_foundation['view']=='yes'){
					$mb_biz_foundation = ($list['company_info']['mb_biz_foundation']) ? "<li>설립일 : ".$list['company_info']['mb_biz_foundation']."년 설립(".$list['company_year']."년차)</li>" : "";
				}
				if($biz_sale['view']=='yes'){
					$mb_biz_sale = ($list['company_info']['mb_biz_sale']) ? "<li>매출액 : ".$list['company_info']['mb_biz_sale']."원</li>":"";
				}
				if($biz_member_count['view']=='yes'){
					$mb_biz_member_count = ($list['company_info']['mb_biz_member_count']) ? "<li>사원수 : ".$list['company_info']['mb_biz_member_count']."명</li>" : "";
				}
				if($form_option['view']=='yes'){
					$biz_form_option = ($list['biz_form_option']) ? "<li>기업형태 : ".$list['biz_form_option']."</li>" : "";
				}
			?>
				<div class="quickView clearfix">
					<div class="leftView positionR">
						<p class="logo"> 
							<span class="spacer"></span> 
							<a target="blank" href="./alba_detail.php?no=<?php echo $no;?>"><?php echo $list['wr_logo'];?></a> 
						</p>
						<p class="companySubject pt10"> <strong><?php echo stripslashes($get_alba['wr_company_name']);?></strong></p>
						<ul class="companyDesc pt5">
							<?php echo $mb_biz_foundation;?>
							<?php echo $mb_biz_sale;?>
							<?php echo $mb_biz_member_count;?>
							<?php echo $biz_form_option;?>
						</ul>
						<?//php if($member['mb_type'] != 'company' && $list['is_online']){	// 개인회원만 온라인입사지원 가능 ( 온라인, 이메일 )?>
						<div class="tag mt20">
							<a href="javascript:online_becomes('<?php echo $no;?>','<?php echo $list['wr_requisition']?>');"><img width="145" height="42" alt="온라인입사지원" src="../images/basic/btn_online1.gif"></a>
						</div>
						<?//php } ?>
					</div>

					<div class="contView positionR">
						<div class="titleArea positionR">
							<p class="title"><strong><a target="_blank" href="./alba_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?></a></strong></p>
							<p class="desc"><?php echo $list['job_type'];?></p>
							<div class="icons positionA" style="bottom:5px; right:5px;">
								<div><a target="_blank" href="./alba_detail.php?no=<?php echo $no;?>" class="window" id=""><img width="13" height="13" class="bg_orang" src="../images/icon/icon_newWindow.png" alt="새창으로 열기"></a></div>
								<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
								<div><a href="javascript:alba_scrap('<?php echo $no;?>');" class="star" id=""><img width="13" height="13" class="bg_orang" src="../images/icon/icon_star.png" alt="공고스크랩"></a></div>
								<?php } ?>
							</div>
						</div>
						<div class="infoArea">
							<ul class="detailItem">
								<li>
									<strong><img alt="근무지역" src="../images/icon/ico_job_quickView1.gif" width="43" height="14"></strong> 
									<?php echo $list['job_subway'];?>
									<span class="district" title="<?php echo $list['job_area'];?>"><?php echo $list['job_area'];?></span>
								</li>

								<li><strong><img alt="근무기간" src="../images/icon/ico_job_quickView2.gif" width="43" height="14"></strong> <?php echo $list['wr_date'];?></li>
								<li><strong><img alt="근무요일" src="../images/icon/ico_job_quickView3.gif" width="43" height="14"></strong> <?php echo $list['wr_week'];?>, <?php echo $list['wr_time'];?> </li>
								<?php if($list['welfare_read']){ ?>
								<li><strong><img alt="복리후생" src="../images/icon/ico_job_quickView4.gif" width="43" height="14"></strong> <?php echo $list['welfare_read'];?> </li>
								<?php } ?>
								<li><strong><img alt="마감일" src="../images/icon/ico_job_quickView5.gif" width="43" height="14"></strong> <?php echo $list['volume_date']['text'];?> </li>
							</ul>
						</div> 
						<div class="item clearfix">
							<ul>
								<li class="first">
									<div class="boxTxt">
									<strong>급여조건</strong> 
									<span class="txt">
									<dd class="text2 clearfix">
										<span class="pay">
										<em class="icon"><?php echo $list['wr_pay_type'];?></em> <em class="number"><?php echo $list['wr_pay'];?>원</em>
										</span>
									</dd>
									</div>
								</li>
								<li> 
									<div class="boxTxt">
									<strong>성별</strong> 
									<span class="txt"><?php echo $list['wr_gender'];?></span> 
									</div>
								</li>
								<li> 
									<div class="boxTxt">
									<strong>연령</strong>
									<span class="txt"><?php echo $list['age']['result'];?><?php echo ($list['age']['etc'])?"<p>[".$list['age']['etc']."]</p>":'';?></span> 
									</div>
								</li>
								<li class="shape"> 
									<div class="boxTxt">
									<strong>모집인원</strong> 
									<span class="txt"><?php echo $list['volmue'];?></span> 
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			<?php 
				} // foreach end.
			} else {	
			?>
				<div class="quickView clearfix"><div class="tc no_listText">채용정보가 없습니다.</div></div></div>
			<?php } // if end.?>
			</div>
			<?php } // view_type if end. ?>

			<?php include_once $alice['include_path']."/paging.php";?>

		</div>
	</div>
</section>
<script>
var list_open = function( no ){	// 공고 상세보기
	var $list = $('#list_'+no);
	var position_top = $list.position().top;

	$('#list_quickView').hide();
	$('#list_quickView').load('./views/_load/alba.php', { mode:'basic', no:no }, function(){
		position_tops = position_top - 2;
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
var sub_list_close = function(){	// 플래티넘 레이어 닫기
	$('#list_quickView').hide();
}
</script>