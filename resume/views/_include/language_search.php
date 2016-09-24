<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

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

	<li class="workTerms clearfix">
		<dl>
			<dt><strong>희망 근무조건</strong></dt>
			<dd class="workTermsBox clearfix">
				<select title="근무기간" name="wr_date" id="wr_date" style="width:150px;" class="ipSelect2"><!-- onchange="wr_date_sel(this);" -->
				<option value="">근무기간</option>
				<?php 
				if($alba_date_list){
					foreach($alba_date_list as $val){ 
					$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링							
					$selected = ($wr_date==$val['code']) ? 'selected' : '';
				?>
				<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
				<?php 
					} // foreach end.
				}	// if end.
				?>
				</select>
				<select title="근무요일" name="wr_week" id="wr_week" style="width:150px;" class="ipSelect2"><!-- onchange="wr_week_sel(this);" -->
				<option value="">근무요일</option>
				<?php 
				if($alba_week_list){
					foreach($alba_week_list as $val){ 
					$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링							
					$selected = ($wr_week==$val['code']) ? 'selected' : '';
				?>
				<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
				<?php 
					}	// foreach end.
				}	// if end.
				?>
				</select>
				<select title="근무시간" name="wr_time" id="wr_time" style="width:150px;" class="ipSelect2">
				<option value="">근무시간</option>
				<?php 
				if($alba_time_list){
					foreach($alba_time_list as $val){ 
					$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링							
					$selected = ($wr_time==$val['code']) ? 'selected' : '';
				?>
				<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
				<?php 
					}	// foreach end.
				}	// if end.
				?>
				</select>
				<span class="pr10">
					<input type="checkbox" name="wr_work_direct" id="wr_work_direct" value="1" <?php echo ($wr_work_direct)?'checked':'';?>><label for="wr_work_direct">즉시출근가능</label>
				</span>
			</dd>
		</dl>
	</li>

	<li class="Info clearfix">
		<div class="school">
			<dl>
				<dt class="pb5"><strong>최종학력</strong></dt>
				<dd>
					<select title="학력" name="wr_school_ability" id="wr_school_ability" style="width:130px;" class="ipSelect2">
					<option value="">학력선택</option>
					<?php
						foreach($indi_ability_list as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$selected = ($wr_school_ability==$val['code']) ? "selected" : "";
					?>
					<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
					<?php
						}	// foreach end.
					?>
					</select>
				</dd>
			</dl>
		</div>
		<div class="career">
			<dl>
				<dt class="pb5"><strong>경력</strong></dt>
				<dd>
					<input type="radio" id="wr_career_use_0" name="wr_career_use" value="0" <?php echo ($wr_career_use=='0')?'checked':'';?> onclick="career_sel(this);">
					<label for="wr_career_use_0" class="pr10" id="label_career_use_0">무관</label>
					<input type="radio" id="wr_career_use_1" name="wr_career_use" value="1" <?php echo ($wr_career_use=='1')?'checked':'';?> onclick="career_sel(this);">
					<label for="wr_career_use_1" class="pr10" id="label_career_use_1">신입</label>
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
				</dd>
			</dl>
		</div>
		<div class="age">
			<dl>
				<dt class="pb5"><strong>나이</strong></dt>
				<dd>
					<input type="text" maxlength="2" style="width:30px;text-align:center;" class="ipText2" id="wr_age" name="wr_age" value="<?php echo $wr_age;?>"> 세&nbsp;
					<input type="checkbox" id="wr_age_limit" name="wr_age_limit" value="1" class="pl10" <?php echo ($wr_age_limit)?'checked':'';?>><label for="wr_age_limit">무관포함</label>
				</dd>
			</dl>
		</div>

		<div class="gender">
			<dl>
				<dt class="pb5"><strong>성별</strong></dt>
				<dd>
					<input type="radio" value="0" id="wr_gender_0" name="wr_gender" <?php echo ($wr_gender=='0')?'checked':'';?>><label for="wr_gender_0" class="pr10">무관</label>
					<input type="radio" value="1" id="wr_gender_1" name="wr_gender" <?php echo ($wr_gender=='1')?'checked':'';?>><label for="wr_gender_1" class="pr10">남자</label>
					<input type="radio" value="2" id="wr_gender_2" name="wr_gender" <?php echo ($wr_gender=='2')?'checked':'';?>><label for="wr_gender_2" class="pr10">여자</label>
				</dd>
			</dl>
		</div>
	</li>

	<li class="search clearfix">
		<dl>
			<dt><strong>검색어</strong></dt>
			<dd class="keywordSearch">
				<input type="text" maxlength="20" style="width:400px;" class="ipText2" id="alba_search_keyword" name="search_keyword" value="<?php echo urldecode($search_keyword);?>">
			</dd>
		</dl>
	</li>
	<li class="resultSet clearfix">
		<div class="resultBox clearfix">
			
			<!-- 선택조건 있을때 display-->
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