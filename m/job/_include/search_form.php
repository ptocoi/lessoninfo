<form method="get" name="albaSearchFrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="albaSearchFrm">
<input type="hidden" name="mode" value="search"/>
<input type="hidden" name="search_mode" value="<?php echo $search_mode;?>"/>

<div class="location clearfix">
	<h2 class="clearfix">
		<em class="icon shadowBox"><img src="../images/icon/icon_local1.png" class="bg_color1"></em>
		<div class="styled-select list1  clearfix positionR shadowBox">
			<img alt="" src="../images/btn/btn_down2.png" class="bg_color1">
			<select class="h30" id="wr_area_00" name="wr_area_0[]" title="시/도" onchange="area_sel_first(this,'wr_area_01');">
			<option value="">시/도</option>
			<?php 
			if($category_area) {
				foreach($category_area as $val){
				$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
				$selected = ($first_code == $val['code']) ? "selected" : "";
			?>
			<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
			<?php 
				}	// foreach end.
			} // if end.
			?>
			</select>
		</div>
		<div class="styled-select list2 clearfix positionR shadowBox">
			<img alt="" src="../images/btn/btn_down2.png" class="bg_color1">
			<div id="wr_area_01_display">
			<select class="h30" style="" id="wr_area_01" name="wr_area_0[]" title="시/구/군" onchange="area_sel_first(this,'wr_area_02');">
				<option value="">시/구/군</option>
				<?php
				if($wr_area_0 || $second_code){
					$pcodeList = $category_control->category_pcodeList('area', $first_code, "", " and `view` = 'yes' ");
					if($pcodeList){
						foreach($pcodeList as $val){ 
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$selected = ($second_code == $val['code']) ? "selected" : "";
				?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
				<?php 
						}	// foreach end.
					}	// if end.
				}	// if end.
				?>
				</select>
			</div>
		</div>
		<div class="styled-select list3 clearfix positionR shadowBox">
			<img alt="" src="../images/btn/btn_down2.png" class="bg_color1">
			<div id="wr_area_02_display">
				<select class="h30" style="" id="wr_area_02" name="wr_area_0[]" title="읍/면/동">
				<option value="">읍/면/동</option>
				<?php
				if($wr_area_0 || $third_code){
					$pcodeList = $category_control->category_pcodeList('area', $second_code, "", " and `view` = 'yes' ");
					if($pcodeList){
						foreach($pcodeList as $val){ 
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$selected = ($third_code == $val['code']) ? "selected" : "";
				?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
				<?php 
						}	// foreach end.
					}	// if end.
				}	// if end.
				?>
				</select>
			</div>
		</div>
		<div class="detailSearch clearfix positionR shadowBox bg_color1 " >
			<a><span>상세검색<span><img alt="" src="../images/btn/btn_down4.png" class="bg_color1"></a>                
		</div>
	</h2><!-- 지역별 검색 select box //-->

	<div class="detailSearchBox bg_color1 shadowBox" style="display:none;"><!-- 상세검색 리스트 -->
		<div class="selectWrap clearfix" >
			<div class="selectListWrap clearfix">
				<div class="styled-select list4 clearfix positionR ">
					<select class="" style="" id="wr_job_type0" name="wr_job_type0" title="업직종1차 분류선택" onchange="jobtype_sels(this,'wr_job_type1');">
					<option value="">업직종1차</option>
					<?php 
					if($job_types){
						foreach($job_types as $val){ 
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링							
						$selected = ($val['code']==$wr_job_type0) ? "selected" : "";
					?>
					<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
					<?php 
						} // foreach end.
					}	// if end.
					?>
					</select>
				</div><!-- 업직종1차// -->
				<div class="styled-select list4 clearfix positionR">
					<img alt="" src="../images/btn/btn_down2.png" class="bg_color1">
					<div id="wr_job_type1_display">
						<select class="" style="" id="wr_job_type1" name="wr_job_type1" title="업직종2차 분류선택">
						<option value="">업직종2차</option>
						<?php
						if($wr_job_type1){
							$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type0, "", " and `view` = 'yes' ");
							if($pcodeList){
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_job_type1 == $val['code']) ? "selected" : "";
						?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
								}	// foreach end.
							}	// if end.
						}	// if end.
						?>
						</select>
					</div>
				</div><!-- 업직종2차 //-->
				<div class="styled-select list4 clearfix positionR">
					<img alt="" src="../images/btn/btn_down2.png" class="bg_color1">
					<div id="wr_job_type2_display">
						<select class="" style="" id="wr_job_type2" name="wr_job_type2" title="업직종3차 분류선택">
						<option value="">업직종3차</option>
						<?php
						if($wr_job_type2){
							$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type1, "", " and `view` = 'yes' ");
							if($pcodeList){
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_job_type2 == $val['code']) ? "selected" : "";
						?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
								}	// foreach end.
							}	// if end.
						}	// if end.
						?>
						</select>
					</div>
				</div><!-- 업직종3차 //-->
			</div>
			<div class="styled-select list clearfix positionR mt10 ">
				<img alt="" src="../images/btn/btn_down2.png" class="bg_color1">
				<select class="" style="" id="wr_career" name="wr_career" title="경력선택">
				<option value="">경력선택</option>
				<?php
				if($job_career_list) {
					foreach($job_career_list as $val){
					$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					$selected = ($wr_career==$val['code']) ? "selected" : "";
				?>
				<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?> 이상</option>
				<?php 
					} // foreach end.
				}	// if end.
				?>
				</select>
			</div>
		</div>
		<div class="styled-radio bg_color2">
			<span>
				<input type="radio" id="wr_career_type_0" name="wr_career_type" value="0" <?php echo ($wr_career_type=='0')?'checked':'';?>>
				<label for="wr_career_type_0">무관</label>
			</span>
			<span>
				<input type="radio" id="wr_career_type_1" name="wr_career_type" value="1" <?php echo ($wr_career_type=='1')?'checked':'';?>>
				<label for="wr_career_type_1">신입</label>
			</span>
			<span>
				<input type="radio" id="wr_career_type_2" name="wr_career_type" value="2" <?php echo ($wr_career_type=='2')?'checked':'';?>>
				<label for="wr_career_type_2">경력</label>
			</span>
		</div><!-- 경력선택 // -->
		<div class="styled-select list clearfix positionR mt10">
			<img alt="" src="../images/btn/btn_down2.png" class="bg_color1">
			<select class="" style="" id="wr_ability" name="wr_ability" title="학력선택">
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
		</div>

		<div class="styled-select list clearfix positionR mt10">
			<img alt="" src="../images/btn/btn_down2.png" class="bg_color1">
			<select class="" style="" id="wr_age" name="wr_age" title="나이선택">
			<option value="">나이선택</option>
			<option value="10" <?php echo ($wr_age=='10')?'selected':'';?>>10세</option>
			<option value="15" <?php echo ($wr_age=='15')?'selected':'';?>>15세</option>
			<option value="20" <?php echo ($wr_age=='20')?'selected':'';?>>20세</option>
			<option value="25" <?php echo ($wr_age=='25')?'selected':'';?>>25세</option>
			<option value="30" <?php echo ($wr_age=='30')?'selected':'';?>>30세</option>
			<option value="35" <?php echo ($wr_age=='35')?'selected':'';?>>35세</option>
			<option value="40" <?php echo ($wr_age=='40')?'selected':'';?>>40세</option>
			<option value="45" <?php echo ($wr_age=='45')?'selected':'';?>>45세</option>
			<option value="50" <?php echo ($wr_age=='50')?'selected':'';?>>50세</option>
			<option value="55" <?php echo ($wr_age=='55')?'selected':'';?>>55세</option>
			<option value="60" <?php echo ($wr_age=='60')?'selected':'';?>>60세</option>
			<option value="65" <?php echo ($wr_age=='65')?'selected':'';?>>65세</option>
			<option value="70" <?php echo ($wr_age=='70')?'selected':'';?>>70세</option>
			<option value="75" <?php echo ($wr_age=='75')?'selected':'';?>>75세</option>
			<option value="80" <?php echo ($wr_age=='80')?'selected':'';?>>80세</option>
			<option value="85" <?php echo ($wr_age=='85')?'selected':'';?>>85세</option>
			<option value="90" <?php echo ($wr_age=='90')?'selected':'';?>>90세</option>
			<option value="95" <?php echo ($wr_age=='95')?'selected':'';?>>95세</option>
			<option value="100" <?php echo ($wr_age=='100')?'selected':'';?>>100세</option>
			</select>
		</div>
		<div class="styled-radio bg_color2">
			<span>
				<input type="radio" id="wr_age_low" name="wr_age_lows" value="low" <?php echo ($wr_age_low=='low')?'checked':'';?>>
				<label for="wr_age_low">이하</label>
			</span>
			<span>
				<input type="radio" id="wr_age_high" name="wr_age_lows" value="high" <?php echo ($wr_age_low=='high')?'checked':'';?>>
				<label for="wr_age_high">이상</label>
			</span>
			<span>
				<input type="checkbox" id="wr_age_limit" name="wr_age_limit" value="1" class="chk" <?php echo ($wr_age_limit)?'checked':'';?>>
				<label for="wr_age_limit" class="lbl_long">나이무관 포함</label>
			</span>
		</div><!-- 나이선택 // -->
		<div class="styled-radio bg_color2 mt10">
			<span>
				<input type="radio" id="wr_gender_1" name="wr_gender" value="1" <?php echo ($wr_gender=='1')?'checked':'';?>>
				<label for="wr_gender_1">남자</label>
			</span>
			<span>
				<input type="radio" id="wr_gender_2" name="wr_gender" value="2" <?php echo ($wr_gender=='2')?'checked':'';?>>
				<label for="wr_gender_2">여자</label>
			</span>
			<span>
				<input type="checkbox" id="wr_gender_0" name="wr_gender" class="chk" value="0" <?php echo ($wr_gender=='0')?'checked':'';?>>
				<label for="wr_gender_0" class="lbl_long">성별무관</label>
			</span>
		</div><!-- 성별선택 // -->
		<div class="doubleBtn mt10">
			<!-- <a  href=""><span>초기화<img alt="" src="../images/btn/btn_rightArrow3.png"></span></a> -->
			<a href="javascript:searchFrm_submit();"><span>검색<img alt="" src="../images/btn/btn_rightArrow3.png"></span></a>
		</div>
	</div><!-- 상세검색 리스트 //-->
</div>

</form>