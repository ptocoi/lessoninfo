<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<div class="searchBox">
	<ul>
		<li class="subway clearfix" style="display:block;"><!--  역세권정규직정보에서 display:none -->
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
					$pcode_list = $category_control->category_pcodeList('subway',$first_subway,"" , " and `view` = 'yes' ");
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
					$pcode_list = $category_control->category_pcodeList('subway',$t_list,"" , " and `view` = 'yes' ");
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
		<li class="partSet clearfix" style="display:block;"><!--  업직종정규직정보에서 display:none -->
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
					$pcode_list = $category_control->category_pcodeList('job_type',$first_jobtype,"" , " and `view` = 'yes' ");
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
					$pcode_list = $category_control->category_pcodeList('job_type',$t_list,"" , " and `view` = 'yes' ");
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
		<li class="workTerms clearfix" style="display:block;"><!--  기간별채용정보에서 display:none -->
		<dl>
			<dt><strong>근무조건</strong></dt>
			<dd class="workTermsBox clearfix">
				<select title="근무기간" name="wr_date" id="wr_date" style="width:250px;" class="ipSelect2"><!-- onchange="wr_date_sel(this);" -->
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
				<select title="근무요일" name="wr_week" id="wr_week" style="width:250px;" class="ml10 ipSelect2"><!-- onchange="wr_week_sel(this);" -->
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
			</dd>
		</dl>
		</li>
		<li class="workTerms clearfix" style="display:block;"><!--  기간별채용정보에서 display:none -->
		<dl>
			<dt><strong>근무시간</strong></dt>
			<dd class="workTermsBox clearfix">
				<select style="width:122px;" class="ipSelect2 wr_time" name="wr_stime[]" id="wr_stime" <?php echo ($wr_time_conference)?'disabled':'';?>>
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
		<li class="Info clearfix">
			<div class="school">
			<dl>
				<dt class="pb5"><strong>학력</strong></dt>
				<dd>
					<select title="학력" name="wr_ability" id="wr_ability" style="width:130px;" class="ipSelect2">
					<option value="">학력선택</option>
					<?php
					if($job_ability_list) {
						foreach($job_ability_list as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$selected = ($wr_ability==$val['code']) ? "selected" : "";
					?>
					<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
					<?php
						}	// foreach end.
					}	// if end.
					?>
					</select>
				</dd>
			</dl>
			</div>
			<div class="career">
			<dl>
				<dt class="pb5"><strong>경력</strong></dt>
				<dd>
					<input type="radio" id="wr_career_type_0" name="wr_career_type" value="0" <?php echo ($wr_career_type=='0')?'checked':'';?>>
					<label for="wr_career_type_0" class="pr10" id="label_career_type_0">무관</label>
					<input type="radio" id="wr_career_type_1" name="wr_career_type" value="1" onclick="career_sel(this);" <?php echo ($wr_career_type=='1')?'checked':'';?>>
					<label for="wr_career_type_1" class="pr10" id="label_career_type_1">신입</label>
					<input type="radio" id="wr_career_type_2" name="wr_career_type" value="2" onclick="career_sel(this);" <?php echo ($wr_career_type=='2')?'checked':'';?>>
					<label for="wr_career_type_2" class="pr10" id="label_career_type_2">경력</label>

					<span id="wr_career_display" style="display: <?php echo ($wr_career_type=='2')?'':'none';?>;">
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

		<li class="resultSet clearfix" id="devResultSet">
			<div class="resultBox clearfix resultSetEmpty">

				<!-- 선택조건 있을때 display-->
				<dl class="selectBox clearfix" style="display:<?php echo ( $mode=='search' && ($category_top_val || $wr_subway_0 || $wr_jobtype_0) )?'':'none';?>;">
					<dt class="pb5"><strong>선택된 조건(대학가,역세권,업직종)</strong></dt>
					<dd>
						<ul class="selectList">
						<?php
						if( $mode=='search' ){

							if($search_mode_sels){
								$k = 0;
								foreach($search_mode_sels as $val){
									$vals_id = strtr($val,'/','_');
									$val_exp = explode('/',$val);
									$val_exp_cnt = count($val_exp);
									$search_sel = array();
									for($i=0;$i<$val_exp_cnt;$i++){
										$search_sel[$k][$i] = $category_control->get_categoryCodeName($val_exp[$i]);
									}
									
									$search_text = implode($search_sel[$k]," > ");
									if($val_exp[2]){
										$select_id = $val_exp[0]."_".$val_exp[1]."_".$val_exp[2];
									} else if($val_exp[1]){
										$select_id = $val_exp[0]."_".$val_exp[1];
									} else if($val_exp[0]){
										$select_id = $val_exp[0];
									}
									echo "<li id=\"select_".$select_id."\" class=\"category\">".$search_text."&nbsp;<button type=\"button\" class=\"close\" onclick=\"search_close('category','".$search_mode."','".$val_exp[0]."','".$val_exp[1]."','".$val_exp[2]."');\">x</button><input type=\"hidden\" name=\"".$search_mode."_sels[]\" value=\"".$val."\" id=\"".$search_mode."_sels_".$vals_id."\"></li>";

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

				<p class="noSelect" style="display:<?php echo ( $mode=='search' && ($category_top_val || $wr_subway_0 || $wr_jobtype_0) )?'none':'';?>;">선택된 조건(대학가,역세권,업직종)이 없습니다.</p>

				<p class="btnAction">
					<a href="javascript:searchFrm_submit();" class="searchBtn"><span class="Btn border_color3 bg_color4">검색</span></a><a class="resetBtn" onclick="searchFrm_reset();"><span class="Btn">초기화</span></a>
				</p>

			</div>
		</li>

	</ul>
</div>
